---
date: "2023-06-29 12:00:00"
title: "Dynamic bit shuffle using AVX-512"
---



Suppose that you want to reorder, arbitrarily, the bits in a 64-bit word. This question [was raised on Twitter by @experquisite](https://twitter.com/experquisite/status/1674408604949004288?s=61&amp;t=IypqrYJfR6opCHxnJ-DUrQ). Formally, you might want to provide, for each of the 64 bit position, an original bit position you want to copy.

Hence, the following code would reverse the bit order in your 64-bit word:
```C
uint64_t w = some value;
uint8_t indexes[64] = {63, 62, 61, 60, 59, 58, 57, 56, 55, 54, 53, 52, 51,
                       50, 49, 48, 47, 46, 45, 44, 43, 42, 41, 40, 39, 38,
                       37, 36, 35, 34, 33, 32, 31, 30, 29, 28, 27, 26, 25,
                       24, 23, 22, 21, 20, 19, 18, 17, 16, 15, 14, 13, 12,
                       11, 10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0};
bit_shuffle(w, indexes); // returns a reversed version 
```


A naive way to do it in C might be as follows:
```C
uint64_t slow_bit_shuffle(uint64_t w, uint8_t indexes[64]) {
  uint64_t out{};
  for (size_t i = 0; i < 64; i++) {
    bool bit_set = w & (uint64_t(1) << indexes[i]);
    out |= (uint64_t(bit_set) << i);
  }
  return out;
}
```


This might be an acceptable implementation, but what if you want do it using few instructions? You can do it on recent Intel and AMD processors with support for AVX-512 instructions. You go from the general-purpose register to a mask register, to a 512-bit AVX-512 register, you apply a shuffle (<tt>vpermb</tt>), you go back to a mask register and finally back to a general-purpose register.

The code with Intel intrinsic functions looks as follows:
```C
uint64_t bit_shuffle(uint64_t w, uint8_t indexes[64]) {
  __mmask64 as_mask = _cvtu64_mask64(w);
  __m512i as_vec_register =
  _mm512_maskz_mov_epi8(as_mask, _mm512_set1_epi8(0xFF));
  __m512i as_vec_register_shuf =
  _mm512_permutexvar_epi8(_mm512_loadu_si512(indexes), as_vec_register);
  return _cvtmask64_u64(_mm512_movepi8_mask(as_vec_register_shuf));
}
```


It might compile to about six instructions:
```C
kmovq k0, rdi
vpmovm2b zmm0, k0
vmovdqu8 zmm1, ZMMWORD PTR [rsi]
vpermb zmm0, zmm1, zmm0
vpmovb2m k1, zmm0
kmovq rax, k1

```


As one reader points out, you can do better because AVX-512 has a dedicated instruction for bit shuffling which directly returns a mask and works directly from the 64-bit word as long as it is loaded in a vector register:
```C
uint64_t faster_bit_shuffle(uint64_t w, uint8_t indexes[64]) {
  __m512i as_vec_register = _mm512_set1_epi64(w);
  __mmask64 as_mask = _mm512_bitshuffle_epi64_mask(as_vec_register,
     _mm512_loadu_si512(indexes));
  return _cvtmask64_u64(as_mask);
}
```


The resulting assembly is quite short:<br/>

```C
vpbroadcastq zmm0, rdi
vpshufbitqmb k0, zmm0, ZMMWORD PTR [rsi]
kmovq rax, k0
```


Loading your indexes is likely to have a long latency, so if you can buffer the load (<tt>_mm512_loadu_si512(indexes)</tt>), you will reduce significantly the latency.<br/>
<br/>
[I have an implementation in C++](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/06/29).

