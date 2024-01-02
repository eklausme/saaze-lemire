---
date: "2023-11-28 12:00:00"
title: "Parsing 8-bit integers quickly"
---



Suppose that you want to parse quickly 8-bit integers (0, 1, 2, &hellip;, 254, 255) from an ASCII/UTF-8 string. The problem comes up in the simdzone project lead by Jeroen Koekkoek (NLnet Labs). You are given a string and its length: e.g., &rsquo;22&rsquo; and length is 2. The naive approach in C might be:
```C
int parse_uint8_naive(const char *str, size_t len, uint8_t *num) {
  uint32_t n = 0;
  for (size_t i = 0, r = len & 0x3; i < r; i++) {
    uint8_t d = (uint8_t)(str[i] - '0');
    if (d > 9)
     return 0;
    n = n * 10 + d;
  }
  *num = (uint8_t)n;
  return n < 256 && len && len < 4;
}
```


This code is a C function that takes a string of characters, its length, and a pointer to an unsigned 8-bit integer as input arguments. The function returns a Boolean value indicating whether the input string can be parsed into an unsigned 8-bit integer or not. It restricts the input to at most three characters but it allows leading zeros (e.g. 002 is 2).

The function first initializes a 32-bit unsigned integer <code>n</code> to zero, we will store our answer there. The function then iterates over the input string, extracting each digit character from the string and converting it to an unsigned 8-bit integer. The extracted digit is then added to <code>n</code> after being multiplied by 10. This process continues until the end of the string or until the function has processed 4 bytes of the string. Finally, the function assigns the value of <code>n</code> to the unsigned 8-bit integer pointed to by <code>num</code>. It then returns a boolean value indicating whether the parsed integer is less than 256 and the length of the input string is between 1 and 3 characters.  If the input string contains any non-digit characters or if the length of the string is greater than 3 bytes, the function returns false.

If the length of the input is predictable, then this naive function should be fast. However, if the length varies (between 1 and 3), then the processor will tend to  mispredict branches, and expensive penalty.

In C++, you could call <tt>from_chars</tt>:
```C
int parse_uint8_fromchars(const char *str, size_t len, uint8_t *num) {
  auto [p, ec] = std::from_chars(str, str + len, *num);
  return (ec == std::errc());
}

```


The <code>std::from_chars</code> function takes three arguments: a pointer to the beginning of the input character sequence, a pointer to the end of the input character sequence, and a reference to the output variable that will hold the parsed integer value. The function returns a <code>std::from_chars_result</code> object that contains two members: a pointer to the first character that was not parsed, and an error code that indicates whether the parsing was successful or not.

In this function, the <code>std::from_chars</code> function is called with the input string and its length as arguments, along with a pointer to the unsigned 8-bit integer that will hold the parsed value. The function then checks whether the error code returned by <code>std::from_chars</code> is equal to <code>std::errc()</code>, which indicates that the parsing was successful. If the parsing was successful, the function returns <code>true</code>. Otherwise, it returns <code>false</code>.

Can we do better than these functions? It is not obvious that we can. A function that reads between 1 and 3 bytes is not a function you would normally try to optimize. But still: can we do it? Can we go faster?

Suppose that you can always read 4 bytes, even if the string is shorter (i.e., there is a buffer). This is often a safe assumption. If you numbers are within a larger string, then you can often check efficiently whether you are within 4 bytes of the end of the string. Even if that is not the case, reading 4 bytes is always safe as long as you do not cross a page boundary, something you may check easily.

So you can load your input into a 32-bit word and process all bytes at once, in a single register. This often called SWAR: In computer science, SWAR means SIMD within a register, which is a technique for performing parallel operations on data contained in a processor register.

Jeroen Koekkoek first came up with a valid SWAR approach, but it was only about 40% faster than the naive approach in the case where we had unpredictable inputs, and potentially slower than the naive approach given predictable inputs. Let us examine an approach that might be competitive all around:
```C
int parse_uint8_fastswar(const char *str, size_t len, 
    uint8_t *num) {
  if(len == 0 || len > 3) { return 0; }
  union { uint8_t as_str[4]; uint32_t as_int; } digits;
  memcpy(&digits.as_int, str, sizeof(digits));
  digits.as_int ^= 0x30303030lu;
  digits.as_int <<= ((4 - len) * 8);
  uint32_t all_digits = 
    ((digits.as_int | (0x06060606 + digits.as_int)) & 0xF0F0F0F0) 
       == 0;
  *num = (uint8_t)((0x640a01 * digits.as_int) >> 24);
  return all_digits 
   & ((__builtin_bswap32(digits.as_int) <= 0x020505));
}

```


Again, this code is a C function that takes a string of characters, its length, and a pointer to an unsigned 8-bit integer as input arguments. The function returns a boolean value indicating whether the input string can be parsed into an unsigned 8-bit integer or not. We check whether the length is in range ([1,3]), if not, we return false, terminating the function. After this initial check, the function first initializes a union <code>digits</code> that contains an array of 4 unsigned 8-bit integers and a 32-bit unsigned integer. The function then copies the input string into the 32-bit unsigned integer using the <code>memcpy</code> function. The <code>memcpy</code> function copies the input string into the 32-bit unsigned integer. In production code where you do not know the target platform, you would want to reverse the bytes when the target is a big-endian system. Big endian systems are vanishingly rare: mostly just mainframes. Modern systems compile a byte reversal to a single fast instructions. For code on my blog post, I assume that you do not have a big-endian system which is 99.99% certain.

The function then flips the bits of the 32-bit unsigned integer using the XOR operator and the constant value <code>0x30303030lu</code>. This operation converts each digit character in the input string to its corresponding decimal value. Indeed, the ASCII characters from 0 to 9 have code point values 0x30 to 0x39 in ASCII. The function then shifts the 32-bit unsigned integer to the left by a certain number of bits, depending on the length of the input string. This operation removes any trailing bytes that were not part of the input string. Technically when the length is not within the allowed range ([1,3]), the shift might be undefined behaviour, but we return a false value in this case earlier, indicating that the result of the computation is invalid.

The next part is where I contributed to the routine. First we check all characters are digits using a concise expression. The function then multiplies the 32-bit unsigned integer by the constant value <code>0x640a01</code> using a 32-bit unsigned integer. It is a concise way to do two multiplications (by 100 and by 10) and two sums at once. Observe that 0x64 is 100 and 0x0a is 10. The result of this multiplication is then shifted to the right by 24 bits. This operation extracts the most significant byte of the 32-bit unsigned integer, which represents the parsed unsigned 8-bit integer. Finally, the function assigns the value of the parsed unsigned 8-bit integer to the unsigned 8-bit integer pointed to by <code>num</code>. It then returns a boolean value indicating whether the parsed integer is less than 256 and made entirely of digits.

The function might compile to 20 assembly instructions or so on x64 processors:
```C
lea rcx, [rsi - 4]
xor eax, eax
cmp rcx, -3
jb .END
mov eax, 808464432
xor eax, dword ptr [rdi]
shl esi, 3
neg sil
mov ecx, esi
shl eax, cl
lea ecx, [rax + 101058054]
or ecx, eax
test ecx, -252645136
sete cl
imul esi, eax, 6556161
shr esi, 24
mov byte ptr [rdx], sil
bswap eax
cmp eax, 132358
setb al
and al, cl
movzx eax, al
.END: # %return
ret

```


To test these functions, [I wrote a benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/11/28). The benchmark uses random inputs, or sequential inputs (0,1,&hellip;), and it ends up being very relevant. I use GCC 12 and an Ice Lake (Intel) linux server running at 3.2 GHz. I report the number of millions of numbers parsed by second.

&nbsp;                   |random numbers           |sequential numbers       |
-------------------------|-------------------------|-------------------------|
std::from_chars          |145 M/s                  |255 M/s                  |
naive                    |210 M/s                  |365 M/s                  |
SWAR                     |425 M/s                  |425 M/s                  |


So the SWAR approach is twice as fast as the naive approach when the inputs are unpredictable. Otherwise, for predictable inputs, we surpass the naive approach by about 15%. Whether it is helpful in you use case depends on your data so you should run your own benchmarks.

Importantly, the SWAR approach is entirely equivalent to the naive approach, except for the fact that it always reads 4 bytes irrespective of the length.

The from_chars results are disappointing all around. I am puzzled as to why the naive approach is so much faster than the standard library. It solves a slightly different problem but the difference is still quite large. It could be that there is room for optimization in the standard library (GCC 12).

Can you do better? [The benchmark is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/11/28). As part of the benchmark, we check exhaustively that the validation is correct.

__Credit__: I am grateful to Jeroen Koekkoek from NLnet Labs for suggesting this problem. The approach described was improved based on proposals by Jean-Marc Bourguet.

__Update__: User &ldquo;Perforated Bob&rdquo;, proposed a version which can be faster under some compilers:
```C
int parse_uint8_fastswar_bob(const char *str, size_t len, uint8_t *num) {
  union { uint8_t as_str[4]; uint32_t as_int; } digits;
  memcpy(&digits.as_int, str, sizeof(digits));
  digits.as_int ^= 0x303030lu;
  digits.as_int <<= (len ^ 3) * 8;
  *num = (uint8_t)((0x640a01 * digits.as_int) >> 16);
  return ((((digits.as_int + 0x767676) | digits.as_int) & 0x808080) == 0) 
   && ((len ^ 3) < 3) 
   && __builtin_bswap32(digits.as_int) <= 0x020505ff;
}

```


&nbsp;

