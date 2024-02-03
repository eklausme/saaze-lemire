---
date: "2022-09-14 12:00:00"
title: "Escaping strings faster with AVX-512"
---



When programming, we often have to &lsquo;escape&rsquo; strings. A standard way to do it is to insert the backslash character (\) before some characters such as the double quote. For example, the string
```C
<tt>my title is "La vie"</tt>
```


becomes
```C
<tt>my title is \"La vie\"</tt>
```


A simple routine in C++ to escape a string might look as follows:
```C
  for (...) {
    if ((*in == '\\') || (*in == '"')) {
      *out++ = '\\';
    }
    *out++ = *in;
  }
```


Such a character-by-character approach is unlikely to provide the best possible performance on modern hardware.

Recent Intel processors have fast instructions (AVX-512) that are well suited for such problems. I decided to sketch a solution using Intel intrinsic functions. The routine goes as follows:

1. I use two constant registers containing 64 copies of the backslash character and 64 copies of the quote characters.
1. I start a loop by loading 32 bytes from the input.
1. I expands these 32 bytes into a 64 byte register, interleaving zero bytes.
1. I compare these bytes with the quotes and backslash characters.
1. From the resulting mask, I then construct (by shifting and blending) escaped characters.
1. I &lsquo;compress&rsquo; the result, removing the zero bytes that appear before the unescaped characters.
1. I advance the output pointer by the number of written bytes and I continue the loop.


The C++ code roughly looks like this&hellip;
```C
  __m512i solidus = _mm512_set1_epi8('\\');
  __m512i quote = _mm512_set1_epi8('"');
  for (; in + 32 <= finalin; in += 32) {
    __m256i input = _mm256_loadu_si256(in);
    __m512i input1 = _mm512_cvtepu8_epi16(input);
    __mmask64 is_solidus = _mm512_cmpeq_epi8_mask(input1, solidus);
    __mmask64 is_quote = _mm512_cmpeq_epi8_mask(input1, quote);
    __mmask64 is_quote_or_solidus = _kor_mask64(is_solidus, is_quote);
    __mmask64 to_keep = _kor_mask64(is_quote_or_solidus, 0xaaaaaaaaaaaaaaaa);
    __m512i shifted_input1 = _mm512_bslli_epi128(input1, 1);
    __m512i escaped =
        _mm512_mask_blend_epi8(is_quote_or_solidus, shifted_input1, solidus);
    _mm512_mask_compressstoreu_epi8(out, to_keep, escaped);
    out += _mm_popcnt_u64(_cvtmask64_u64(to_keep));
  }
```


This code can be greatly improved. Nevertheless, it is a good first step. What are the results an Intel icelake processor using GCC 11 (Linux) ? A simple benchmark indicates a 5x performance boost compared to a naive implementation:

regular code             |0.6 ns/character         |
-------------------------|-------------------------|
AVX-512 code             |0.1 ns/character         |


It looks quite encouraging ! [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/09/14). I require a recent x64 processor with AVX-512 VBMI2 support.

