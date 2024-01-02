---
date: "2018-10-19 12:00:00"
title: "Validating UTF-8 bytes using only 0.45 cycles per byte (AVX edition)"
---



When receiving bytes from the network, we often assume that they are unicode strings, encoded using something called UTF-8. Sadly, not all streams of bytes are valid UTF-8. So we need to check the strings. It is probably a good idea to optimize this problem as much as possible.

In earlier work, we showed [that you could validate a string using a little as 0.7 cycles](/lemire/blog/2018/05/16/validating-utf-8-strings-using-as-little-as-0-7-cycles-per-byte/) per byte, using commonly available 128-bit SIMD registers (in C). SIMD stands for Single-Instruction-Multiple-Data, it is a way to parallelize the processing on a single core.

What if we use 256-bit registers instead?

Reference naive function |10 cycles per byte       |
-------------------------|-------------------------|
fast SIMD version (128-bit) |0.7 cycles per byte      |
new SIMD version (256-bit) |0.45 cycles per byte     |


That&rsquo;s good, almost twice as fast.

A common problem is that you receive as inputs ASCII characters. That&rsquo;s a common scenario. It is much faster to check that a string in made of ASCII characters than to check that it is made of valid UTF-8 characters. Indeed, to check that it is made of ASCII characters, you only have to check that one bit per byte is zero (since ASCII uses only 7 bits per byte).

It turns out that only about 0.05 cycles are needed to check that a string is made of ASCII characters. Maybe up to 0.08 cycles. That makes us look bad.

You could start checking the file for ASCII characters and then switch to our function when non-ASCII characters are found, but this has a problem: what if the string starts with a non-ASCII character followed by a long stream of ASCII characters?

A quick solution is to add an ASCII path. Each time we read a block of 32 bytes, we check whether it is made of 32 ASCII characters, and if so, we take a different (fast) path. Thus if it happens frequently that we have long streams of ASCII characters, we will be quite fast.

The new numbers are quite appealing when running benchmarks on ASCII characters:

new SIMD version (256-bit) |0.45 cycles per byte     |
-------------------------|-------------------------|
new SIMD version (256-bit), w. ASCII path |0.088 cycles per byte    |
ASCII check (SIMD + 256-bit) |0.051 cycles per byte    |


[My code is available](https://github.com/lemire/fastvalidate-utf-8).

__Update__: This work ended up making a research paper under the title [Validating UTF-8 In Less Than One Instruction Per Byte](https://arxiv.org/abs/2010.03090), Software: Practice &amp; Experience (to appear).

__Update__: For a production-ready UTF-8 validation function, please see the [simdjson library](https://github.com/simdjson/simdjson).

