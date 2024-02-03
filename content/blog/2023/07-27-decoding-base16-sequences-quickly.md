---
date: "2023-07-27 12:00:00"
title: "Decoding base16 sequences quickly"
---



We sometimes represent binary data using the hexadecimal notation. We use a base-16 representation where the first 10 digits are 0, 1, 2, 3, 5, 6, 7, 8, 9 and where the following digits are A, B, C, D, E, F (or a, b, c, d, e, f). Thus each character represents 4 bits. A pair of characters can represent any byte value (8 bits).

In [Parsing short hexadecimal strings efficiently](/lemire/blog/2019/04/17/parsing-short-hexadecimal-strings-efficiently/), I examined the problem of decoding short sequences (e.g., 4 characters). A conventional parser can be based on table lookups, where unexpected characters are mapped to a special value (e.g., -1) but where the characters 0 to 9 are mapped to 0 to 9, and A to F are mapped to 10 to 15. A conventional decoder can rely on a simple routine such as&hellip;
```C
int8_t n1 = digittoval[src[0]];
int8_t n2 = digittoval[src[1]];
src += 2;
*dst = (uint8_t)((n1 << 4) | n2);
dst += 1;

```


Can we go faster? In [Parsing hex numbers with validation](http://0x80.pl/notesen/2022-01-17-validating-hex-parse.html), Langdale and Muła considered the question. They use [SIMD](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data) instructions. They get good results, but let us revisit the question.

I am considering the problem of parsing sequences of 56 characters (representing 28 bytes). I want to compare the best approach described by Langdale and Muła with a straight adaptation of our [base32 decoder](/lemire/blog/2023/07/20/fast-decoding-of-base32-strings/). Generally speaking, the main difference between our approach and the Langdale-Muła is in the validation. The Langdale-Muła approach does straight-forward arithmetic and comparisons, whereas we favour vectorized classification (e.g., we use vectorized table lookups).

Our main routine to decode 16 characters goes as follows:

1. Load 16 bytes into a vector register.
1. Subtract 1 from all character values.
1. Using a 4-bit shift and a mask, select the most significant 4 bits of each byte value.
1. Do a vectorized table lookup using the most significant 4 bits, and add the result to the value. This inexpensive computation can detect any non-hexadecimal character: any such character would map to a byte value with the most significant bit set. We later branch out based on a movemask which detects these bytes.
1. We do a similar computation, a vectorized table lookup using the most significant 4 bits, and add the result to the value, to map the character to a 4-bit value (between 0 and 16).
1. We use a multiply-add and a pack instruction to pack the 4-bit values, going from 16 bytes to 8 bytes.
1. We write the 8 bytes to the output.


Using Intel instructions, the hot loop looks as follows:
```C
  __m128i v = _mm_loadu_si128((__m128i *)src);
  __m128i vm1 = _mm_add_epi8(v, _mm_set1_epi8(-1));
  __m128i hash_key =
  _mm_and_si128(_mm_srli_epi32(vm1, 4), _mm_set1_epi8(0x0F));
 __m128i check = _mm_add_epi8(_mm_shuffle_epi8(delta_check, hash_key), vm1);
  v = _mm_add_epi8(vm1, _mm_shuffle_epi8(delta_rebase, hash_key));
  unsigned int m = (unsigned)_mm_movemask_epi8(check);
  if (m) {
   // error
  }
__m128i t3 = _mm_maddubs_epi16(v, _mm_set1_epi16(0x0110));
__m128i t5 = _mm_packus_epi16(t3, t3);
_mm_storeu_si128((__m128i *)dst, t5);

```


You can do the equivalent with 256-bit (and even 512-bit) registers if you want. I refer the interested reader to our paper [Faster Base64 Encoding and Decoding using AVX2 Instructions](https://arxiv.org/abs/1704.00605).

Your results will vary depending on the system. I use GCC 11 and an Ice Lake server. The inputs are rather small and there is overhead due to the function calls so it is not an ideal case for fancy algorithms.

technique                |CPU cycles/string        |instructions/string      |
-------------------------|-------------------------|-------------------------|
conventional             |72                       |360                      |
Langdale-Muła (128 bits) |24                       |110                      |
ours (128 bits)          |21                       |88                       |
ours (256 bits)          |16                       |61                       |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/07/27).

Compared to a conventional decoder, our fast techniques are 3 to 5 times faster.

At least in this code, our approach is slightly faster than the Langdale-Muła approach. However, the difference is small and if you consider different hardware or different compilers, the results might flip. The 256-bit approach is noticeably faster, but if your inputs are small (shorter than 32 characters), then that would not hold.

If you have access to AVX-512, you can assuredly go much faster, but I did not consider this case.

In the real-world, you may need to handle spaces in the encoded sequence. My benchmark does not handle such cases and some careful engineering based on real-world data would be needed to deal efficiently with such inputs at high speed. I nevertheless include a fast decoder that can ignore spaces in the input for demonstration purposes (see source code). It would be easier to prune spaces using AVX-512.

Porting this code to ARM NEON would be easy.

__Conclusion__: You can decode base16 inputs using about one instruction per input character which is about six times better than a conventional decoder. It seems that you can beat the fast Langdale-Muła decoder, at least on my test system. Your main tool to go faster is to use wider SIMD registers. Future work should consider AVX-512: it might be possible to double the performance.

__Credit__: The work was motivated by the simdzone project by NLnetLabs. GitHub user @aqrit lent his expertise.

