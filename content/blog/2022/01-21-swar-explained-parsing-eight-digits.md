---
date: "2022-01-21 12:00:00"
title: "SWAR explained: parsing eight digits"
---



It is common to want to parse long strings of digits into integer values. Because it is a common task, we want to optimize it as much as possible.

In the blog post, [Quickly parsing eight digits](/lemire/blog/2018/10/03/quickly-parsing-eight-digits/), I presented a very quick way to parse eight ASCII characters representing an integers (e.g., 12345678) into the corresponding binary value. I want to come back to it and explain it a bit more, to show that it is not magic. This works in most programming languages, but I will stick with C for this blog post.

To recap, the long way is a simple loop:
```C
uint32_t parse_eight_digits(const unsigned char *chars) {
  uint32_t x = chars[0] - '0';
  for (size_t j = 1; j < 8; j++)
    x = x * 10 + (chars[j] - '0');
  return x;
}
```


We use the fact that in ASCII, the numbers 0, 1, &hellip; are in consecutive order in terms of byte values. The character &lsquo;0&rsquo; is 0x30 (or 48 in decimal), the character &lsquo;1&rsquo; is 0x31 (49 in decimal) and so forth. At each step in the loop, we multiple the running value by 10 and add the value of the next digit.

It assumes that all characters are in the valid range (from &lsquo;0&rsquo; to &lsquo;9&rsquo;): other code should check that it is the case.

An optimizing compiler will probably unroll the loop and produce code that might look like this in assembly:
```C
        movzx   eax, byte ptr [rdi]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 1]
        lea     eax, [rcx + 2*rax]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 2]
        lea     eax, [rcx + 2*rax]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 3]
        lea     eax, [rcx + 2*rax]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 4]
        lea     eax, [rcx + 2*rax]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 5]
        lea     eax, [rcx + 2*rax]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 6]
        lea     eax, [rcx + 2*rax]
        lea     eax, [rax + 4*rax]
        movzx   ecx, byte ptr [rdi + 7]
        lea     eax, [rcx + 2*rax]
        add     eax, -533333328
```




Notice how there are many loads, and a whole lot of operations.

We can substantially shorten the resulting code, down to something that looks like the following:
```C
        imul    rax, qword ptr [rdi], 2561
        movabs  rcx, -1302123111085379632
        add     rcx, rax
        shr     rcx, 8
        movabs  rax, 71777214294589695
        and     rax, rcx
        imul    rax, rax, 6553601
        shr     rax, 16
        movabs  rcx, 281470681808895
        and     rcx, rax
        movabs  rax, 42949672960001
        imul    rax, rcx
        shr     rax, 32
```


How do we do it? We use a technique called SWAR which stands for [SIMD within a register](https://en.wikipedia.org/wiki/SWAR). The intuition behind is that modern computers have 64-bit registers. Processing eight consecutive bytes as eight distinct words, as in the native code above, is inefficient given how wide our registers are.

The first step is to load all eight characters into a 64-bit register. In C, you might do it in this manner:
```C
int64_t val; 
memcpy(&val, chars, 8);
```


It looks maybe expensive, but most compilers will translate the memcpy instruction into a single load, when compiling with optimizations turned on.

Computers store values in little-endian order. This means that the first byte you encounter is going to be used as the least significant byte, and so forth.

Then we want to subtract the character &lsquo;<tt>0</tt>&lsquo; (or `0x30` in hexadecimal). We can do it with a single operation:
```C
val = val - 0x3030303030303030;
```


So if you had the string &lsquo;<tt>12345678</tt>&lsquo;, you will now have the value <tt>0x0807060504030201</tt>.

Next we are going to do a kind of pyramidal computation. We add pairs of successive bytes, then pairs of successive 16-bit values and then pairs of successive 32-bit bytes.

It goes something like this, suppose that you have the sequence of digit values <tt>b1, b2, b3, b4, b5, b6, b7, b8</tt>. You want to do&hellip;

- add pairs of bytes: <tt>10*b1+b2</tt>, <tt>10*b3+b4</tt>, <tt>10*b5+b6</tt>, <tt>10*b7+b8</tt>
- combine first and third sum: <tt>1000000*(10*b1+b2) + 100*(10*b5+b6)</tt>
- combine second and fourth sum: <tt>10*b7+b8 + 10000*(10*b3+b4)</tt>


I will only explain the first step (pairs of bytes) as the other two steps are similar. Consider the least significant two bytes, which have value <tt>256*b2 + b1</tt>. We multiply it by 10, and we add the value shifted by 8 bits, and we get <tt>b1+10*b2</tt> in the least significant byte. We can compute 4 such operations in one operation&hellip;
```C
val = (val * 10) + (val >> 8);
```




The next two steps are similar:
```C
val1 = (((val & 0x000000FF000000FF) * (100 + (1000000ULL << 32)));
```



```C
val2 = (((val >> 16) & 0x000000FF000000FF) 
          * (1 + (10000ULL << 32))) >> 32;
```


And the overall code looks as follows&hellip;
```C
uint32_t  parse_eight_digits_unrolled(uint64_t val) {
  const uint64_t mask = 0x000000FF000000FF;
  const uint64_t mul1 = 0x000F424000000064; // 100 + (1000000ULL << 32)
  const uint64_t mul2 = 0x0000271000000001; // 1 + (10000ULL << 32)
  val -= 0x3030303030303030;
  val = (val * 10) + (val >> 8); // val = (val * 2561) >> 8;
  val = (((val & mask) * mul1) + (((val >> 16) & mask) * mul2)) >> 32;
  return val;
}
```


__Appendix__: You can do much the same in C# starting with a `byte` pointer (<tt>byte* chars</tt>):
```C
ulong val = Unsafe.ReadUnaligned<ulong>(chars);
const ulong mask = 0x000000FF000000FF;
const ulong mul1 = 0x000F424000000064; 
// 100 + (1000000ULL << 32)
const ulong mul2 = 0x0000271000000001; 
// 1 + (10000ULL << 32)
val -= 0x3030303030303030;
val = (val * 10) + (val >> 8); // val = (val * 2561) >> 8;
val = (((val & mask) * mul1) + (((val >> 16) & mask) * mul2)) >> 32;
```


