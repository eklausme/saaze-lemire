---
date: "2018-02-21 12:00:00"
title: "Iterating over set bits quickly"
---



A common problem in my line of work is to iterate over the set bits (bits having value 1) in a large array.

My standard approach involves a &ldquo;counting trailing zeroes&rdquo; function. Given an integer, this function counts how many consecutive bits are zero starting from the less significant bits. Any odd integer has no &ldquo;trailing zero&rdquo;. Any even integer has at least one &ldquo;trailing zero&rdquo;, and so forth. Many compilers such as LLVM&rsquo;s clang and GNU GCC have an intrinsic called `__builtin_ctzl` for this purpose. There are equivalent standard functions in Java (numberOfTrailingZeros), Go and so forth. [There is a whole Wikipedia page dedicated to these functions](https://en.wikipedia.org/wiki/Find_first_set#CTZ), but recent x64 processors have a fast dedicated instruction so the implementation is taken care at the processor level.

The following function will call the function &ldquo;callback&rdquo; with the index of each set bit:
```C
uint64_t bitset;
for (size_t k = 0; k < bitmapsize; ++k) {
    bitset = bitmap[k];
    while (bitset != 0) {
      uint64_t t = bitset & -bitset;
      int r = __builtin_ctzl(bitset);
      callback(k * 64 + r);
      bitset ^= t;
    }
}
```


The trick is that <tt>bitset &amp; -bitset</tt> returns an integer having just the least significant bit of `bitset` turned on, all other bits are off. With this observation, you should be able to figure out why the routine work.

Note that your compiler can probably optimize <tt>bitset &amp; -bitset</tt> to a single instruction on x64 processors. Java has an equivalent function called lowestOneBit.

If you are in a rush, that&rsquo;s probably not how you&rsquo;d program it. You would probably iterate through all bits, in this manner:
```C
uint64_t bitset;
for (size_t k = 0; k < bitmapsize; ++k) {
    bitset = bitmap[k];
    size_t p = k * 64;
    while (bitset != 0) {
      if (bitset & 0x1) {
        callback(p);
      }
      bitset >>= 1;
      p += 1;
    }
}
```


Which is faster?

Obviously, you have to make sure that your code compiles down to the fast x64 trailing-zero instruction. If you do, then the trailing-zero approach is much faster.

I designed a benchmark where the callback function just adds the indexes together. The speed per decoded index will depend on the density (fraction of set bits). I ran my benchmark on Skylake processor:

density                  |trailing-zero            |naive                    |
-------------------------|-------------------------|-------------------------|
0.125                    |~5 cycles per int        |40 cycles per int        |
0.25                     |~3.5 cycles per int      |30 cycles per int        |
0.5                      |~2.6 cycles per int      |23 cycles per int        |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/02/20).

Thus using a fast trailing-zero function is about ten times faster.

__Credit__: This post was inspired by Wojciech Mula.

