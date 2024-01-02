---
date: "2018-01-08 12:00:00"
title: "How fast can you bit-interleave 32-bit integers?"
---



A practical trick in software is to &ldquo;bit-interleave&rdquo; your data. Suppose that I have two 4-bit integers like 0b1011 (11 in decimal) and 0b1100 (12 in decimal). I can interleave the two numbers to get one 8-bit number 0b11011010 where I simply pick the most significant bit from the first number, then the most significant bit from the second integer, and then the second most significant bit from the first integer, and so forth. This is a useful trick because if you sort the interleaved numbers, you can then quickly filter numbers on the most significant bits of all components at once. For example, if you are looking for coordinates such as the first and second component is greater or equal to 0b1000, then all values you are looking for will take the form 0b11****** and thus, they will be sorted toward at the end. [This is called a z-order](https://en.wikipedia.org/wiki/Z-order_curve).

Of course, you still have to interleave and de-interleave bits. How expensive is that?

The problem is rather symmetrical, so I will only present the code for interleaving. A useful function is one that takes a 32-bit integer, and spreads its bits over a 64-bit integer, effectively interleaving it with zeros:
```C
uint64_t interleave_uint32_with_zeros(uint32_t input)  {
    uint64_t word = input;
    word = (word ^ (word << 16)) & 0x0000ffff0000ffff;
    word = (word ^ (word << 8 )) & 0x00ff00ff00ff00ff;
    word = (word ^ (word << 4 )) & 0x0f0f0f0f0f0f0f0f;
    word = (word ^ (word << 2 )) & 0x3333333333333333;
    word = (word ^ (word << 1 )) & 0x5555555555555555;
    return word;
}
```


Given this function, you can interleave in the following manner:
```C
interleave_uint32_with_zeros(x) 
  | (interleave_uint32_with_zeros(y) << 1);
```


I believe that this is the standard approach. It seems efficient enough.

Can you go faster? You might. On recent x64 processors, there are bit manipulation instructions ideally suited to the problem (<tt>pdep</tt> and <tt>pext</tt>). The interleaving code looks like this:
```C
uint64_t interleave_pdep(uint32_2 input)  {
    return _pdep_u64(input.x, 0x5555555555555555) 
     | _pdep_u64(input.y,0xaaaaaaaaaaaaaaaa);
}
```


The decoding is similar but uses the `pext` instruction instead. 

Suppose that you have a bunch of data points, is it worth it to use the fancy x64 instructions?

Let us record how many cycles are needed to interleave a pair of 32-bit values:

shifts                   |3.6 cycles               |
-------------------------|-------------------------|
pdep                     |2.1 cycles               |


So, roughly speaking, using specialized instructions doubles the speed. In some cases, it might be worth the effort.

The `pdep` function is probably optimal in the sense that `pdep` has a throughput of one instruction per cycle, and I need two `pdep` instructions to interleave a pair of values.

Deinterleaving takes about as long when using my implementation and the clang compiler. The GCC compiler seems to hate my deinterleaving code and produces very slow binaries. 

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/08).

Is this the best we can do? I suspect not. My guess is that with more careful engineering, we can go down to 1 cycle per interleave.

__Update__: [I have a follow-up blog post](/lemire/blog/2018/01/09/how-fast-can-you-bit-interleave-32-bit-integers-simd-edition/).

