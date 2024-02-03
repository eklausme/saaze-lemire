---
date: "2021-02-09 12:00:00"
title: "On the cost of converting ASCII to UTF-16"
---



Many programming languages like Java, JavaScript and C# represent strings using UTF-16 by default. In UTF-16, each &lsquo;character&rsquo; uses 16 bits. To represent all 1 million unicode characters, some special &lsquo;characters&rsquo; can be combined in pairs (surrogate pairs), but for much of the common text, one character is truly 16 bits.

Yet much of the text content processed in software is simple ASCII. Strings of numbers for example are typically just ASCII. ASCII characters can be represented using only 7 bits.

It implies that software has frequently to convert ASCII to UTF-16. In practice, it amounts to little more than to interleave our ASCII bytes with zero bytes. We can model such a function with a simple C loop.
```C
void toutf16(const uint8_t *array, size_t N,
              uint16_t *out) {
  for (size_t i = 0; i < N; i++) {
    out[i] = array[i];
  }
}
```


How expensive do we expect this code to be?

Compared to simple copy from _N_ bytes to _N_ bytes, we are writing an extra _N_ bytes. With code that reads and writes a lot of data, it is often sensible to use as a model the number of written bytes.

In terms of instructions, an x64 processor can use SIMD instructions to accelerate the processing. However, you would hope that most processors can do this processing at high speed.

[I wrote a benchmark in C](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/02/09) and ran it on different systems. I use a small input ASCII string (10kB). I measure the throughput based on the input size.

&nbsp;                   |to utf16                 |memcpy                   |
-------------------------|-------------------------|-------------------------|
AMD Zen 2 (x64), GNU GCC 8, -O3 |24 GB/s                  |46 GB/s                  |
Apple M1, clang 12       |35 GB/s                  |68 GB/s                  |


Of course results will vary and I expect that it is entirely possible to greatly accelerate my C function. However, it seems reasonable to estimate that the computational cost alone might be twice that of a memory copy. In practice, it is likely that memory allocation and structure initialization might add a substantial overhead when copying ASCII content into a UTF-16 string.

