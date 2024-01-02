---
date: "2020-03-18 12:00:00"
title: "Avoiding cache line overlap by replacing one 256-bit store with two 128-bit stores"
---



Memory is organized in cache lines, frequently blocks of 64 bytes. On Intel and AMD processors, you can store and load memory in blocks of various sizes, such as 64 bits, 128 bits or 256 bits.

In the old days, and on some limited devices today, reading and storing to memory required you to respect alignment. You could not simply write any block memory anywhere. Today you mostly can write wherever you like. There is a small penalty for misalignment but the penalty is typically under 10% as I argued in my 2012 post [Data alignment for speed: myth or reality?](/lemire/blog/2012/05/31/data-alignment-for-speed-myth-or-reality/)

Yet writing or reading from two cache lines (what Intel calls a cache line split) instead of a single one is likely to be more expensive at least some of the time. Let us explore an interesting scenario. It is sometimes possible to avoid crossing a cache line boundary by doing two memory accesses instead of a single large one. Is it worth it?

Cache lines in memory are aligned on addresses that are divisible by 64 bytes. Suppose that you would want to store 256 bits of data every 64 bytes, at just the right offset so that the 256 bits overlap two cache lines. You hit last 16 bytes of one cache line and the first 16 bytes of the second one. You can achieve the desired results by starting with an offset of 48 bytes. That is, you find find a memory address that is divisible by 64 bytes, and then you add 48 bytes.

In code, using Intel intrinsics, it looks as follow:
```C
char * p = ...
for (size_t i = 0; i < ... ; i++) {
  _mm256_storeu_si256(p + i * 64, vec);
}
```


You can avoid entirely crossing the cache line bounding by first storing 128-bit of data at the 48-byte offset, and then storing another 128-bit of data. The first store is at the end of the first cache line and the second store is at the beginning of the second one.
```C
char * p = ...
for (size_t i = 0; i < ... ; i++) {
      _mm_storeu_si128(p + i * 64, vec);
      _mm_storeu_si128(p + i * 64 + 16, vec);
}
```


How do these two approaches fare? I wrote a simple benchmark that stores many blocks of 256-bit at a 48-byte offset. It either stores it in one 256-bit step or in two 128-bit steps. I record the number of cycles per iteration on an AMD Rome processor. I rely on the the pre-installed RedHat LLVM compiler (clang version 3.4.2).

A single 256-bit write   |2.33 cycles              |
-------------------------|-------------------------|
Two 128-bit writes       |2.08 cycles              |


It is a gain of slightly over 10% for the two 128-bit writes. What if you remove the 48-byte offset (or set it to zero)? Then both benchmark clock at 2.08 cycles per iteration. I expect that the 48-byte offset is a best-case scenario for the two 128-bit writes: if you change it then both approaches have the same cache-line overlap problems. So this 10% gain requires you to choose the alignment carefully.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/03/17). Of course, your results will depend on the processor and to some extend on the compiler. You should be able to run my benchmark program on your own Linux x64 system.

Be mindful that if you are getting worse results on a per cycle basis on comparable hardware, you might be limited by your compiler. An analysis of the assembly might be required.

__Further reading__: Travis Downs has an [interesting complementary analysis](https://twitter.com/trav_downs/status/1240512089787170816?s=21). He finds that unaligned stores crossing a 32-byte boundary can be tremendously expensive (i.e., 5 cycles) on the type of processor I am using for these tests (Zen 2). The 32-byte boundary exists irrespective of cache lines. Meanwhile, he finds that stores aligned exactly on a 32-byte boundary are much cheaper (1 cycle).

