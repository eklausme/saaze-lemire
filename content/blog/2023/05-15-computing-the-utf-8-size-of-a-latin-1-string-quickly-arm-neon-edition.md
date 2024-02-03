---
date: "2023-05-15 12:00:00"
title: "Computing the UTF-8 size of a Latin 1 string quickly (ARM NEON edition)"
---



While most of our software relies on Unicode strings, we often still encounter legacy encodings such as Latin 1. JavaScript strings are often stored as either Latin 1, UTF-8 or UTF-16 internally. Before we convert Latin 1 strings to Unicode (e.g., UTF-8), we must compute the size of the UTF-8 string. It is fairly easy: all ASCII characters map 1 byte to 1 byte, while other characters (with code point values from 128 to 256) map 1 Latin byte to 2 Unicode bytes (in UTF-8).

Computers represent strings using bytes. Most often, we use the Unicode standard to represent characters in bytes. The universal format to exchange strings online is called UTF-8. It can represent over a million characters while retaining compatibility with the ancient ASCII format.

Though most of our software stack has moved to Unicode strings, there are still older standards like Latin 1 used for European strings. Thus we often need to convert Latin 1 strings to UTF-8. It is useful to first compute the size (in bytes) of the eventual UTF-8 strings. You can code a simple C function to compute the UTF-8 size from the Latin 1 input as follow:
```C
size_t scalar_utf8_length(const char * c, size_t len) {
  size_t answer = 0;
  for(size_t i = 0; i<len; i++) {
    if((c[i]>>7)) { answer++;}
  }
  return answer + len;
}

```


In [Computing the UTF-8 size of a Latin 1 string quickly (AVX edition)](/lemire/blog/2023/02/16/computing-the-utf-8-size-of-a-latin-1-string-quickly-avx-edition/), I reviewed faster techniques to solve this problem on x64 processors.

What about ARM processors (as in your recent MacBook)?

Keyhan Vakil came up with a nice solution with relies on the availability for &ldquo;narrowing instructions&rdquo; in ARM processors. Basically you can take a 16-byte vector registers and create a 8-byte register (virtually) by truncating or rounding the results. Conveniently, you can also combine bit shifting with narrowing.

Consider pairs of successive 8-bit words as a 16-bit word. E.g., if the 16 bits start out as `aaaaaaaabbbbbbbb` then a shift-by-four-and-narrow creates the byte value <tt>aaaabbbb</tt>. Indeed, if you shift a 16-bit word by 4 bits and keep only the least significant 8 bits of the result, then

1. the most significant 4 bits from the second 8-bit word become the least significant 4 bits in the result
1. and the least significant 4 bits from the first 8-bit word become the most significant 4 bits.


This is convenient because vectorized comparison functions often generate filled bytes when the comparison is true (all 1s). The final algorithm in C looks as follows:
```C
uint64_t utf8_length_kvakil(const uint8_t *data, uint32_t length) {
  uint64_t result = 0;
  const int lanes = sizeof(uint8x16_t);
  uint8_t rem = length % lanes;
  const uint8_t *simd_end = data + (length / lanes) * lanes;
  const uint8x16_t threshold = vdupq_n_u8(0x80);
  for (; data < simd_end; data += lanes) {
    // load 16 bytes
    uint8x16_t input = vld1q_u8(data);
    // compare to threshold (0x80)
    uint8x16_t withhighbit = vcgeq_u8(input, threshold);
    // shift and narrow
    uint8x8_t highbits = vshrn_n_u16(vreinterpretq_u16_u8(withhighbit), 4);
    // we have 0, 4 or 8 bits per byte
    uint8x8_t bitsperbyte = vcnt_u8(highbits);
    // sum the bytes vertically to uint16_t
   result += vaddlv_u8(bitsperbyte);
  }
  result /= 4; // we overcounted by a factor of 4
  // scalar tail
  for (uint8_t j = 0; j < rem; j++) {
    result += (simd_end[j] >> 7);
  }
  return result + length;
}

```


Can you beat Vakil? You can surely reduce the instruction count but once you reach speeds like 20 GB/s, it becomes difficult to go much faster without hitting memory and cache speed limits.

Pete Cawley proposed a simpler algorithm which avoids the narrowing shifts, and does a vertical addition instead:
```C
uint64_t utf8_length_simpler(const uint8_t *data, uint32_t length) {
  uint64_t result = 0;
  const int lanes = sizeof(uint8x16_t);
  uint8_t rem = length % lanes;
  const uint8_t *simd_end = data + (length / lanes) * lanes;
  const uint8x16_t threshold = vdupq_n_u8(0x80);
  for (; data < simd_end; data += lanes) {
    // load 16 bytes
    uint8x16_t input = vld1q_u8(data);
    // compare to threshold (0x80)
    uint8x16_t withhighbit = vcgeq_u8(input, threshold);
    // vertical addition
    result -= vaddvq_s8(withhighbit);
  }
  // scalar tail
  for (uint8_t j = 0; j < rem; j++) {
    result += (simd_end[j] >> 7);
  }
  return result + length;
}

```


Are the hand-tuned NEON functions fast?

On my Apple M2, they are three times as fast as what the compiler produces from the scalar code on large enough inputs. Observe that the compiler already relies on vector instructions even when compiling scalar code.

scalar code              |~6 GB/s                  |
-------------------------|-------------------------|
NEON code (both functions) |~20 GB/s                 |


On my Apple laptop, both NEON functions are equally fast. Using Graviton 3 processors on AWS (with GCC 11), I can tell them apart:

scalar code              |~7 GB/s                  |
-------------------------|-------------------------|
NEON code (Vakil)        |~27 GB/s                 |
NEON code (Cawley)       |~30 GB/s                 |


The Cawley function is slightly better. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/05/15). Your results will vary.

__Update__: if you check out my source code, you will find two new versions that are quite fast. It seems that there is a lot of room for optimization on this problem.

__Remark__. Whenever I mention Latin 1, some people are prone to remark that browsers treat HTML pages declared as Latin 1 and ASCII as windows-1252. That is because modern web browsers do not support Latin 1 and ASCII in HTML. Even so, you should not use Latin 1, ASCII or even windows-1252 for your web pages. I recommend using Unicode (UTF-8). However, if you code in Python, Go or Node.js, and you declare a string as Latin 1, it should be Latin 1, not windows-1252. It is bug to confuse Latin 1, ASCII and windows-1252. They are different formats.

