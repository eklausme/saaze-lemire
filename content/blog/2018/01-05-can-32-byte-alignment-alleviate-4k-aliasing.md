---
date: "2018-01-05 12:00:00"
title: "Can 32-byte alignment alleviate 4K aliasing?"
---



[In my previous post](/lemire/blog/2018/01/04/dont-make-it-appear-like-you-are-reading-your-own-recent-writes/), I considered some performance problems that can plague simple loops that read and write data&hellip;
```C
for (int i = 0; i < a.length; ++i) {
  a[i] += s * b[i];
}
```


Once vectorized, such a loop can suffer from what Intel calls 4K Aliasing: if the arrays are stored in memory at locations that differ by &ldquo;almost&rdquo; a multiple of 4kB, then it can look to the processor like you are storing data and quickly reading it again. This confuses the processor because it only discriminates on addresses using the least significant 12 bits of addresses.

In my previous blog post, I conjectured that the problem is harder to generate if your arrays are aligned on 32-byte boundaries (that is, if the array starts at an address that is divisible by 32).

Aleksey Shipilev disagreed and [stated on Twitter](https://twitter.com/shipilev/status/949202328489426944) that the problem was easily reproducible even when arrays are 32-byte aligned.

[Aleksey refers to work done on OpenJDK to prevent this problem](https://bugs.openjdk.java.net/browse/JDK-8150730) with respect to array copies. 

Aleksey used an older Haswell processor, instead of the more recent Skylake processor that I am using. So I am going to go back to a Haswell processor.

What I am going to do this time is align the destination array (a) on 32-byte boundaries, always. Then I am going to set the other array 4096 bytes ahead, minus some offset in bytes. I then report the number of cycles used per array element.
```C

$ gcc -O3 -o align32byte align32byte.c -mavx2  && ./align32byte
offset: 0 bytes
vecdaxpy(a, b, s, N)	:  0.543 cycles per operation
offset: 1 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 2 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 3 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 4 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 5 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 6 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 7 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 8 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 9 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 10 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 11 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 12 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 13 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 14 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 15 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 16 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 17 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 18 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 19 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 20 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 21 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 22 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 23 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 24 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 25 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 26 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 27 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 28 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 29 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 30 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 31 bytes
vecdaxpy(a, b, s, N)	:  0.707 cycles per operation
offset: 32 bytes (1 32-byte)
vecdaxpy(a, b, s, N)	:  0.648 cycles per operation
offset: 64 bytes (2 32-byte)
vecdaxpy(a, b, s, N)	:  0.637 cycles per operation
offset: 96 bytes (3 32-byte)
vecdaxpy(a, b, s, N)	:  0.625 cycles per operation
offset: 128 bytes (4 32-byte)
vecdaxpy(a, b, s, N)	:  0.613 cycles per operation
offset: 160 bytes (5 32-byte)
vecdaxpy(a, b, s, N)	:  0.613 cycles per operation
offset: 192 bytes (6 32-byte)
vecdaxpy(a, b, s, N)	:  0.613 cycles per operation
offset: 224 bytes (7 32-byte)
vecdaxpy(a, b, s, N)	:  0.625 cycles per operation
offset: 256 bytes (8 32-byte)
vecdaxpy(a, b, s, N)	:  0.613 cycles per operation
offset: 288 bytes (9 32-byte)
vecdaxpy(a, b, s, N)	:  0.625 cycles per operation
offset: 320 bytes (10 32-byte)
vecdaxpy(a, b, s, N)	:  0.613 cycles per operation
offset: 352 bytes (11 32-byte)
vecdaxpy(a, b, s, N)	:  0.602 cycles per operation
offset: 384 bytes (12 32-byte)
vecdaxpy(a, b, s, N)	:  0.590 cycles per operation
offset: 416 bytes (13 32-byte)
vecdaxpy(a, b, s, N)	:  0.566 cycles per operation
offset: 448 bytes (14 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 480 bytes (15 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 512 bytes (16 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
```


So there is a 30% performance penalty for offsets by a small number of bytes. The penalty drops to 20% or less as soon as the second array is aligned on a 32-byte boundary. The penalty eventually goes away entirely when the offset reaches about 512 bytes.

Let us run the same experiment on my Skylake processor:
```C

$ gcc -O3 -o align32byte align32byte.c -mavx2  && ./align32byte
offset: 0 bytes
vecdaxpy(a, b, s, N)	:  0.477 cycles per operation
offset: 1 bytes
vecdaxpy(a, b, s, N)	:  0.805 cycles per operation
offset: 2 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 3 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 4 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 5 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 6 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 7 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 8 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 9 bytes
vecdaxpy(a, b, s, N)	:  0.805 cycles per operation
offset: 10 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 11 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 12 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 13 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 14 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 15 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 16 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 17 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 18 bytes
vecdaxpy(a, b, s, N)	:  0.812 cycles per operation
offset: 19 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 20 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 21 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 22 bytes
vecdaxpy(a, b, s, N)	:  0.805 cycles per operation
offset: 23 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 24 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 25 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 26 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 27 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 28 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 29 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 30 bytes
vecdaxpy(a, b, s, N)	:  0.797 cycles per operation
offset: 31 bytes
vecdaxpy(a, b, s, N)	:  0.789 cycles per operation
offset: 32 bytes (1 32-byte)
vecdaxpy(a, b, s, N)	:  0.586 cycles per operation
offset: 64 bytes (2 32-byte)
vecdaxpy(a, b, s, N)	:  0.570 cycles per operation
offset: 96 bytes (3 32-byte)
vecdaxpy(a, b, s, N)	:  0.562 cycles per operation
offset: 128 bytes (4 32-byte)
vecdaxpy(a, b, s, N)	:  0.562 cycles per operation
offset: 160 bytes (5 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 192 bytes (6 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 224 bytes (7 32-byte)
vecdaxpy(a, b, s, N)	:  0.547 cycles per operation
offset: 256 bytes (8 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 288 bytes (9 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 320 bytes (10 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 352 bytes (11 32-byte)
vecdaxpy(a, b, s, N)	:  0.555 cycles per operation
offset: 384 bytes (12 32-byte)
vecdaxpy(a, b, s, N)	:  0.523 cycles per operation
offset: 416 bytes (13 32-byte)
vecdaxpy(a, b, s, N)	:  0.508 cycles per operation
offset: 448 bytes (14 32-byte)
vecdaxpy(a, b, s, N)	:  0.500 cycles per operation
offset: 480 bytes (15 32-byte)
vecdaxpy(a, b, s, N)	:  0.484 cycles per operation
offset: 512 bytes (16 32-byte)
vecdaxpy(a, b, s, N)	:  0.477 cycles per operation
```


Interestingly, the penalty on Skylake is higher (over 50%) for offsets by arbitrary numbers of bytes. But when the arrays differ by multiple of 32 bytes, the penalty is reduced to about 20%, and it eventually goes away entirely.

My numbers suggest the following observations:

- It does not look like 4K aliasing improved between Haswell and Skylake. I have a recent laptop with an even more recent Kaby Lake processor, and the problem is still there. I am not including my laptop numbers because I do not trust benchmarking on a laptop&hellip; but I have enough confidence to state that the 4k aliasing problem is still a thing on the very latest Intel processors. What about AMD processors?
- Aligning arrays on 32-byte boundaries does seem to alleviate the problem. In my particular experiments, I only got a 20% penalty due to aliasing which seems more acceptable than a 50% penalty.


To me, it is an annoying problem because it means that when doing rather common computations over loops, your performance will differ quite a bit depending on where in the memory your arrays are located. Memory addresses is not something you have a lot of control over in the normal course of software. It is also not obvious to me how to make the problem go away. You can try to detect the problem and make the loop run in reverse&hellip; but it is not entirely trivial.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/05).

