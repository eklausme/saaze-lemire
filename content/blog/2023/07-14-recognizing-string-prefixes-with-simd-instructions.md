---
date: "2023-07-14 12:00:00"
title: "Recognizing string prefixes with SIMD instructions"
---



Suppose that I give you a long list of string tokens (e.g., &ldquo;A&rdquo;, &ldquo;A6&rdquo;, &ldquo;AAAA&rdquo;, &ldquo;AFSDB&rdquo;, &ldquo;APL&rdquo;, &ldquo;CAA&rdquo;, &ldquo;CDS&rdquo;, &ldquo;CDNSKEY&rdquo;, &ldquo;CERT&rdquo;, &ldquo;CH&rdquo;, &ldquo;CNAME&rdquo;, &ldquo;CS&rdquo;, &ldquo;CSYNC&rdquo;, &ldquo;DHC&rdquo;, etc.). I give you a pointer inside a much larger string and I ask you whether you are pointing at one of these tokens, and if so, which one. To make things slightly more complicated, you want the token to be followed by a valid separator (e.g., a space, a semi-colon, etc.) and you want to ignore the case (so that &ldquo;aaaa&rdquo; matches &ldquo;AAAA&rdquo;).

How might you solve this efficiently?

Comparing against each token might do well if you have few of them, but it is clearly a bad idea if you have many (say 70).

A reasonable approach is to do a binary search through the sorted list of tokens. The C function `bsearch` is well suited. You need a comparison function as part of the implementation. You may use the C function `strncasecmp` to compare the strings while ignoring the case, and you add a check to make sure that you only return a match (value 0) when the input has a terminating character at the right position.

Then the linearithmic (<em>O</em>(<em>n</em> log <em>n</em>)) implementation looks like this&hellip;
```C
std::string *lookup_symbol(const char *input) {
  return bsearch(input, strings.data(), strings.size(),
  sizeof(std::string), compare);
}

```


Simple enough.

Another approach [is to use a trie](https://en.wikipedia.org/wiki/Trie). You implement a tree where the first level checks for the first character, the second level for the second character and so forth.

It gets a little bit lengthy, but you can use a script or a library to generate the code. You can use a series of switch/case like so&hellip;
```C
switch (s[0]) {
  case 'A': case 'a':
  switch (s[1]) {
    case '6': return is_separator(s[2]) ? 1 : -1;
  case 'A': case 'a':
    switch (s[2]) {
     case 'A': case 'a':
       switch (s[3]) { 
         case 'A': case 'a':
          return is_separator(s[4]) ? 2 : -1;
       default:
         return -1;
...
```


The running time complexity depends on the data, but is at most the length of the longest string in your set. The trie is a tempting solution but it is branchy: if the processor can predict the upcoming content, it should do well, but if the input is random, you might be unlikely and get poor performance.

We can also use a finite-state machine which requires a relative large table, but has really simple execution:
```C
int s = 71;
while (*str && s >= 0) {
  uint8_t tok = char2token[uint8_t(*str)];
  str++;
  s = statetable[32 * s + tok];
}
*token = (uint8_t)s;
return s != 0;

```


With [SIMD instructions](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data), you can write a tight implementation that is effectively branchless: its execution does not depend on the input data.

The code works in this manner:

1. We load unconditionally 16 bytes in a register.
1. We first find the location of the first separator, if any. We can do this with [vectorized classification](https://arxiv.org/pdf/1902.08318.pdf). It is a significant cost.
1. We set to zero all bytes in the register starting from this first separator. We also switch all characters in A-Z to a lower case.
1. We use a hash function to map the processed bytes to a table containing our tokens in 16-byte blocks. The hash function is designed in a such a way that if the input matches one of our tokens, then it should be mapped to an identical value. We can derive the hash function empirically (by trial and error). Computing the hash function is a significant cost so we have the be careful. In this instance, I use a simple function:<br/>
<tt>(((val &gt;&gt; 32) ^ val)&amp;0xffffffff) * (uint64_t)3523216699) &gt;&gt; 32.</tt>
1. We compare the processed input with the loaded value from the hash function.


The C function written using Intel intrinsic functions is as follows:
```C
bool sse_type(const char *type_string, uint8_t *type) {
  __m128i input = _mm_loadu_si128((__m128i *)type_string);
  __m128i delimiters =
    _mm_setr_epi8(0x00, 0x00, 0x22, 0x00, 0x00, 0x00, 
                  0x00, 0x00, 0x28, 0x09, 0x0a, 0x3b, 
                  0x00, 0x0d, 0x00, 0x00);
  __m128i mask = _mm_setr_epi8(-33, -1, -1, -1, -1, 
                  -1, -1, -1, -1, -33, -1, -1,
                  -1, -1, -1, -1);
  __m128i pattern = _mm_shuffle_epi8(delimiters, input);
  __m128i inputc = _mm_and_si128(input, 
      _mm_shuffle_epi8(mask, input));
  int bitmask = _mm_movemask_epi8(
      _mm_cmpeq_epi8(inputc, pattern));
  uint16_t length = __builtin_ctz(bitmask);
  __m128i zero_mask = _mm_loadu_si128(
       (__m128i *)(zero_masks + 16 - length));
  __m128i inputlc = _mm_or_si128(input, _mm_set1_epi8(0x20));
  input = _mm_andnot_si128(zero_mask, inputlc);
  uint8_t idx = hash((uint64_t)_mm_cvtsi128_si64(input));
  *type = idx;
  __m128i compar = _mm_loadu_si128((__m128i *)buffers[idx]);
  __m128i xorthem = _mm_xor_si128(compar, input);
  return _mm_test_all_zeros(xorthem, xorthem);
}
```


We expect it to compile to branchfree code, as follows:
```C
sse_type(char const*, unsigned char*):
  movdqu xmm1, XMMWORD PTR [rdi]
  mov edx, 16
  movdqa xmm2, XMMWORD PTR .LC0[rip]
  movdqa xmm0, XMMWORD PTR .LC1[rip]
  pshufb xmm2, xmm1
  pshufb xmm0, xmm1
  pand xmm0, xmm1
  pcmpeqb xmm0, xmm2
  por xmm1, XMMWORD PTR .LC2[rip]
  pmovmskb eax, xmm0
  bsf eax, eax
  cdqe
  sub rdx, rax
  movdqu xmm0, XMMWORD PTR zero_masks[rdx]
  pandn xmm0, xmm1
  movq rax, xmm0
  movq rdx, xmm0
  shr rax, 32
  xor eax, edx
  mov edx, 3523216699
  imul rax, rdx
  shr rax, 32
  mov BYTE PTR [rsi], al
  movzx eax, al
  sal rax, 4
  pxor xmm0, XMMWORD PTR buffers[rax]
  ptest xmm0, xmm0
  sete al
  ret

```


I wrote a benchmark where we repeatedly try to check for matching tokens, using many thousands random tokens (enough to prevent the processor from having trivial branch prediction). I run it on an Ice Lake server, and the code is compiled with GCC11 (targeting an old processor, Westmere).

technique                |CPU cycles/string        |instructions/string      |
-------------------------|-------------------------|-------------------------|
binary search            |236                      |335                      |
trie                     |71                       |39                       |
finite state             |42                       |61                       |
SIMD                     |15                       |39                       |


In this particular test, the SIMD-based approach is four times faster than the trie despite the fact that it retires as many instructions. The trie struggles with branch mispredictions. The SIMD-based approach has a relatively high number of instructions retired per cycle (2.5). The binary search is disastrous in this case, being more than 10 times slower. The finite-state approach is interesting as it is only three times slower than the SIMD-based approach and significantly faster than the other non-SIMD approaches. It uses near twice as many instructions as  the trie, but it is nearly twice as fast. However, the finite-state approach requires a relatively large table, larger than the alternatives.

The trie can match the SIMD-based approach when the input is predictable. I can simulate this scenario by repeatedly trying to match a small number of tokens (say 100) always in the same order. I get that the trie can then be just as fast in this easy case.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/07/13). It could be easily ported to ARM NEON or to AVX-512.

__Credit__: The problem was suggested to me by Jeroen Koekkoek from NLnet Labs. He sketched part of the solution. I want to thank GitHub user @aqrit for their comments.

__Note__: The problem considered in this blog post is not the recognition of strings from a set. I have a blog post on that other topic: [Quickly checking that a string belongs to a small set](/lemire/blog/2022/12/30/quickly-checking-that-a-string-belongs-to-a-small-set/).

__Further reading__: [Is Prefix Of String In Table?](https://trent.me/is-prefix-of-string-in-table/) by Nelson and [Modern perfect hashing for strings](http://0x80.pl/notesen/2023-04-30-lookup-in-strings.html) by Muła.

