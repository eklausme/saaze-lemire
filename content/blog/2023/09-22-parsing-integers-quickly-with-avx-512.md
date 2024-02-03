---
date: "2023-09-22 12:00:00"
title: "Parsing integers quickly with AVX-512"
---



If I give a programmer a string such as <tt>"9223372036854775808"</tt> and I ask them to convert it to an integer, they might do the following in C++:
```C
std::string s = ....
uint64_t val;
auto [ptr, ec] =
std::from_chars(s.data(), s.data() + s.size(), val);
if (ec != std::errc()) {} // I have an error !
// val holds the value

```


It is very fast: you can parse a sequence of random 32-bit integers at about 40 cycles per integer, using about 128 instructions.

Can you do better?

The recent Intel processors have new instructions, AVX-512, that can process multiple bytes at once and do it with masking, so that you can select just a range of data.

I am going to assume that you know the beginning and the end of sequence of digits. The following code with AVX-512 intrinsic does the following:

1. Computes the span in bytes (digit_count),
1. If we have more than 20 bytes, we know that the integer is too large to fit in a 64-bit integer,
1. We compute a &ldquo;mask&rdquo;: a 32-bit value that only the most significant digit_count bits set to 1,
1. We load an ASCII or UTF-8 string in a 256-bit register,
1. We subtract character value &lsquo;0&rsquo; to get values between 0 and 9 (digit values),
1. We check whether some value exceeds 9, in which case we had a non-digit character.

```C
size_t digit_count = size_t(end - start);
// if (digit_count > 20) { error ....}
const simd8x32 ASCII_ZERO = _mm256_set1_epi8('0');
const simd8x32 NINE = _mm256_set1_epi8(9);
uint32_t mask = uint32_t(0xFFFFFFFF) << (start - end + 32);
auto in = _mm256_maskz_loadu_epi8(mask, end - 32);
auto base10_8bit = _mm256_maskz_sub_epi8(mask, in, ASCII_ZERO);
auto nondigits = _mm256_mask_cmpgt_epu8_mask(mask, base10_8bit, NINE);
if (nondigits) {
// there is a non-digit
}
```


This is the key step that uses the functionality of AVX-512. Afterward, we can use &lsquo;old-school&rsquo; processing, for folks familiar with advanced Intel intrinsics on conventional x64 processors&hellip; Mostly, we just multiply by 10, by 100, by 100000 to create four 32-bit values: the first one corresponds to the least significant 8 ASCII bytes, the second one to the next most significant 8 ASCII bytes, and the their one to up to 4 most significant bytes. When the numbers has 8 digits or less, only one of these words is relevant, and when there are 16 or less, on the first two are significant. We always waste one 32-bit value that is made of zeroes. The code might look as follows:
```C
 auto DIGIT_VALUE_BASE10_8BIT =
_mm256_set_epi8(1, 10, 1, 10, 1, 10, 1, 10,
1, 10, 1, 10, 1, 10, 1, 10,
1, 10, 1, 10, 1, 10, 1, 10,
1, 10, 1, 10, 1, 10, 1, 10);
auto DIGIT_VALUE_BASE10E2_8BIT = _mm_set_epi8(
1, 100, 1, 100, 1, 100, 1, 100, 1, 100, 1, 100, 1, 100, 1, 100);
auto DIGIT_VALUE_BASE10E4_16BIT =
_mm_set_epi16(1, 10000, 1, 10000, 1, 10000, 1, 10000);
auto base10e2_16bit =
_mm256_maddubs_epi16(base10_8bit, DIGIT_VALUE_BASE10_8BIT);
auto base10e2_8bit = _mm256_cvtepi16_epi8(base10e2_16bit);
auto base10e4_16bit =
_mm_maddubs_epi16(base10e2_8bit, DIGIT_VALUE_BASE10E2_8BIT);
auto base10e8_32bit =
_mm_madd_epi16(base10e4_16bit, DIGIT_VALUE_BASE10E4_16BIT);

```


[I have implemented this function in C++](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/09/22), and compiled it using GCC12. I run the benchmark on an Ice Lake server. I use random 32-bit integers for testing. The AVX-512 is over twice as fast as the standard approach.

AVX-512                  |1.8 GB/s                 |57 instructions/number   |17 cycles/number         |
-------------------------|-------------------------|-------------------------|-------------------------|
std::from_chars          |0.8 GB/s                 |128 instructions/number  |39 cycles/number         |


The comparison is not currently entirely fair because the AVX-512 function assumes that it knows the start and the end of the sequence of digits.

You can boost the performance by using an inline function, which brings it up to 2.3 GB/s, so a 30% performance boost. However, that assumes that you are parsing the numbers in sequence within a loop.

My original code would return fancy std::optional values, but GCC was negatively affected, so I changed my function signatures to be more conventional. Even, LLVM/clang is slightly faster in my tests, compared to GCC.

__Credit__: The original code and the problem were suggested to me by John Keiser. My code is largely derivative of his code.

