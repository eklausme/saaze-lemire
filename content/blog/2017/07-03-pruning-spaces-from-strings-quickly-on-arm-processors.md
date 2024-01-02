---
date: "2017-07-03 12:00:00"
title: "Pruning spaces from strings quickly on ARM processors"
---



Suppose that I give you a relatively long string and you want to remove all spaces from it. In ASCII, we can define spaces as the space character (&lsquo;&nbsp;&lsquo;), and the line ending characters (&lsquo;\r&rsquo; and &lsquo;\n&rsquo;). I am mostly interested in algorithmic and performance issues, so we can simplify the problem by removing all byte values less or equal to 32. 

[In a previous post where I asked how quickly we could prune spaces](/lemire/blog/2017/01/20/how-quickly-can-you-remove-spaces-from-a-string/), the best answer involved vectorization using 128-bit registers (SSSE3). It ends up being between 5 and 10 times faster than the naive approach. 

Conveniently enough, ARM processors all have 128-bit vector registers, just like x64 processors. So can we make ARM processors go as fast as x64 processors?

Let us first consider a fast scalar implementation:
```C
size_t i = 0, pos = 0;
while (i < howmany) {
    char c = bytes[i++];
    bytes[pos] = c;
    pos += (c > 32 ? 1 : 0);
}
```


This prunes all character values less or equal to 32, writing back the data in-place. It is very fast.

Can we do better with vector instructions? Vector instructions are instructions supported by virtually all modern processors that operate over wide registers (16 bytes or more).

On x64 processors, the winning strategy is to grab 16 bytes of data, quickly compare against white space characters, then extract a mask (or bitset) value made of 16 bits, one bit per character, where each bit indicates whether the value found is a white space. The construction of such a bitset is cheap on an x64 processor, as there is a dedicated instruction (<tt>movemask</tt>). There is no such instruction on ARM processors. You can emulate `movemask` using several instructions.

So we cannot proceed as we did on x64 processors. What can we do?

Just like with SSSE3, we can quickly check whether byte values are less or equal to 32, thus identifying white space characters:
```C
static inline uint8x16_t is_white(uint8x16_t data) {
  const uint8x16_t wchar = vdupq_n_u8(' ');
  uint8x16_t isw = vcleq_u8(data, wchar);
  return isw;
}
```


Next we can quickly check whether any of the 16 characters is a white space, by using about two instructions:
```C
static inline uint64_t is_not_zero(uint8x16_t v) {
  uint64x2_t v64 = vreinterpretq_u64_u8(v);
  uint32x2_t v32 = vqmovn_u64(v64);
  uint64x1_t result = vreinterpret_u64_u32(v32);
  return result[0];
}
```


This suggests a useful strategy. Instead of comparing characters one by one, compare 16 characters at once. If none of them is a white space character, just copy the 16 characters back to the input and move on. Otherwise, we fall back on the slow scalar approach, with the added benefit that we do not need to repeat the comparison:
```C
uint8x16_t vecbytes = vld1q_u8((uint8_t *)bytes + i);
uint8x16_t w = is_white(vecbytes);
uint64_t haswhite = is_not_zero(w);
w0 = vaddq_u8(justone, w);
if(!haswhite) {
      vst1q_u8((uint8_t *)bytes + pos,vecbytes);
      pos += 16;
      i += 16;
 } else {
      for (int k = 0; k < 16; k++) {
        bytes[pos] = bytes[i++];
        pos += w[k];
     }
}
```


Most of the benefit from this approach would come if you can often expect streams of 16 bytes to contain no white space character. This seems like a good guess in many applications.

I wrote a benchmark where I try to estimate how long it takes to prune spaces, on a per character basis, using input data where there are few white space characters, placed at random. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/07/03), but you need an ARM processor to run it. I run the benchmark on [a 64-bit ARM processor (made of A57 cores)](https://softiron.com/products/overdrive-1000/technical-specifications/). [John Regher has a few more benchmarks on this same machine](https://blog.regehr.org/archives/1465). I think it is the same cores that you find in the Nintendo Switch.

scalar                   |1.40 ns                  |
-------------------------|-------------------------|
NEON                     |0.92 ns                  |


 [The technical specification is sparse](http://cdn.softiron.com/OD1000_DS_Web_v11.pdf). However, the processor runs at 1.7 GHz as one can verify by using <tt>perf stat</tt>. Here is the number of cycles per character we need&hellip;

scalar                   |ARM                      |recent x64               |
-------------------------|-------------------------|-------------------------|
scalar                   |2.4 cycles               |1.2 cycles               |
vectorized (NEON and SSSE3)  |1.6 cycles               |0.25 cycles              |


([The source code for x64 is available on GitHub](https://github.com/lemire/despacer).)

In comparison, on an x64 processor, the scalar version uses something like 1.2 cycles per character, which would put the ARM machine at half the performance of a recent x64 processor on a per cycle basis. That is to be expected as the A57 cores are hardly meant to compete with recent x64 processors on a cycle per cycle basis. However, with SSSE3 on an x64 machine, I manage to use a little as 0.25 cycles per character, which is more than 5 times better than what I can do with ARM NEON.

This large difference comes from an algorithmic difference. On x64 processors, we are relying on the <tt>movemask</tt>/<tt>pshufb</tt> combo and we end up with a branchless algorithm involving very few instructions. Our ARM NEON version is much less powerful.

There is a lot to like about ARM processors. The assembly code is much more elegant than the equivalent with x86/x64 processors. Even the ARM NEON instructions feel cleaner than the SSE/AVX instructions. However, for many problems, the total lack of a `movemask` instruction might limit the scope of what is possible with ARM NEON.

But maybe I underestimate ARM NEON&hellip; can you do better than I did?

Note: The post has been edited: it is possible on 64-bit ARM processors to reshuffle 16 bits in one instruction as one of the commenters observed.

__Note__: [I get better performance in a follow-up blog post](/lemire/blog/2017/07/10/pruning-spaces-faster-on-arm-processors-with-vector-table-lookups/).

