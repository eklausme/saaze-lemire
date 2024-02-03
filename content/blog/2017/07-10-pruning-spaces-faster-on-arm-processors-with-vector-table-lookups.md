---
date: "2017-07-10 12:00:00"
title: "Pruning spaces faster on ARM processors with Vector Table Lookups"
---



Last week, [I asked how fast one could remove spaces from a string using ARM processors](/lemire/blog/2017/07/03/pruning-spaces-from-strings-quickly-on-arm-processors/). On a particular benchmark, I got 2.4 cycles per byte using regular (scalar) code and as little as 1.8 cycles per byte using ARM NEON instructions. These are &ldquo;vectorized instructions&rdquo; that you find in virtually all ARM processors. Vectorized instructions operate over wide registers (spanning at least 16 bytes), often executing the same operation (such as addition or multiplication) over several values at once. However, my trick using ARM NEON instructions relied on the fact that my input stream would contain few spaces. So it was not a very positive blog post for ARM processors.

But then I got feedback from several experts such as [Martins Mozeiko](https://github.com/mmozeiko), [Cyril Lashkevich](https://speakerdeck.com/notorca) and [Derek Ledbetter](https://stackoverflow.com/users/25653/derek-ledbetter). This feedback made me realize that I had grossly underestimated the power of ARM NEON instructions. One reason for my mistake is that I had been looking at older ARM NEON instructions instead of the current AArch64 instructions, which are much more powerful.

To recap, on an x64 processor, you can remove spaces from strings very quickly using vectorized instructions in the following manner:

- Compare 16 bytes of input characters with white space characters to determine where (if anywhere) there are white space characters.
- The result of the comparison is itself a 16-byte register, where matching characters have the byte value 255 whereas non-matching characters have the byte value 0. Turn this vector register to a 16-bit integer value by &ldquo;downsampling&rdquo; the bits. This can be achieved by a &ldquo;movemask&rdquo; instruction present in all x64 processors since the introduction of the Pentium 4 a long time ago.
- From this mask, compute the number of white space characters by counting the 1s. This can be done with the `popcnt` instruction.
- From this mask also, load up a &ldquo;shuffling register&rdquo; that tells you how to reorder the bytes so that white space characters are omitted. Then use what Intel and AMD call a &ldquo;shuffling instruction&rdquo; (<tt>pshufb</tt> introduced with the SSSE3 instruction set many years ago) to quickly reorder the bytes.


I thought that the same could not be done with ARM NEON, but I was wrong. If you have access to recent AMD processors (supporting AArch64), then you can closely mimic the x64 processors and get good performance.

Let us review the various components.

To start, we can quickly compare 16 byte values with the byte value 33 to quickly identify common white space characters such as the space, the line ending, the carriage return and so forth.
```C
uint8x16_t is_nonwhite(uint8x16_t data) {
  return vcgeq_u8(data, vdupq_n_u8(' '+1));
}
```


ARM NEON has convenient &ldquo;reduce&rdquo; instructions, so I can sum up the values of a vector. I can put this to go use to quickly compute how many matching characters I have:
```C
uint8_t bytepopcount(uint8x16_t v) {
  return vaddvq_u8(vshrq_n_u8(v,7));
}
```


To compute a 16-bit mask, I also use such a reduce function after computing the bitwise AND of my comparison with some convenient vector (which allows me to distinguish which characters match)&hellip;
```C
uint16_t neonmovemask_addv(uint8x16_t input8) {
  uint16x8_t input = vreinterpretq_u16_u8(input8);
  const uint16x8_t bitmask = { 0x0101 , 0x0202, 0x0404, 0x0808, 0x1010, 0x2020, 0x4040, 0x8080 };
  uint16x8_t minput = vandq_u16(input, bitmask);
  return vaddvq_u16(minput);
}
```


Finally, I call a Vector Table Lookup instruction which is pretty much equivalent to Intel/AMD&rsquo;s shuffle instruction:
```C
int mask16bits =  neonmovemask_addv(data);
uint8x16_t shuf = vld1q_u8(shufmask + 16 * mask16bits);
uint8x16_t reshuf = vqtbl1q_u8(data,shuf);
```


Of course, I am not explaining everything in detail. [My full source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/07/10). All you need is access to a recent ARM processor with Linux running on it, and you are all set to run it.

It turns out that we can double my previous best score:

scalar                   |1.40 ns                  |
-------------------------|-------------------------|
NEON (old code)          |0.92 ns                  |
NEON (Vector Table Lookup)  |0.52 ns                  |


What is better is that my new code is effectively branchless: its performance is not very sensitive to the input data.

Using the fact that I know the clock speed of my processor, I can make a quick comparison in terms of CPU cycles per input byte&hellip;

scalar                   |ARM                      |recent x64               |
-------------------------|-------------------------|-------------------------|
scalar                   |2.4 cycles               |1.2 cycles               |
vectorized (NEON AArch64 and SSSE3)  |0.88 cycles              |0.25 cycles              |


([The source code for x64 processors is available on GitHub](https://github.com/lemire/despacer).)

What is interesting is that we are getting under one cycle per input byte which is a kind of performance that is difficult to achieve with scalar code that writes byte values one by one. It is still the case that the ARM NEON code is over three times slower than the equivalent on x64 processors, but I am using a relatively weak core (A57 on a [Softiron Overdrive 1000](https://softiron.com/products/overdrive-1000/)) and my code might be subject to further optimization.

