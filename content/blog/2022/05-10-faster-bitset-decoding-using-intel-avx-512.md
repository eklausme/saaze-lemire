---
date: "2022-05-10 12:00:00"
title: "Faster bitset decoding using Intel AVX-512"
---



I refer to &ldquo;bitset decoding&rdquo; as the action of finding the positions of the 1s in a stream of bits. For example, given the integer value 0b11011 (or 27 in decimal),  I want to find 0,1,3,4.

In my previous post, <em><a href="https://lemire.me/blog/2022/05/06/fast-bitset-decoding-using-intel-avx-512/" rel="bookmark">Fast bitset decoding using Intel AVX-512</a></em>, I explained how you can use Intel&rsquo;s new instructions, from the AVX-512 family, to decode bitsets faster. The AVX-512 instructions, as the name implies, often can process 512-bit (or 64-byte) registers.

At least two readers (Kim Walisch and Jatin Bhateja) pointed out that you could do better if you used the very latest AVX-512 instructions available on Intel processors with the Ice Lake or Tiger Lake microarchitectures. These processors support VBMI2 instructions including the `vpcompressb` instruction and its corresponding intrinsics (such as <tt>_mm512_maskz_compress_epi8</tt>). What this instruction does is take a 64-bit word and a 64-byte register, and it outputs (in packed manner) only the bytes corresponding to set bits in the 64-bit word. Thus if you use as the 64-bit word the value 0b11011 and you provide a 64-byte register with the values 0,1,2,3,4&hellip; you will get as a result 0,1,3,4. That is, the instruction effectively does the decoding already, with the caveat that it will only write bytes. In practice, you often want the indexes as 32-bit integers. Thankfully, you can go from packed bytes to packed 32-bit integers easily. One possibility is to extract successive 128-bit subwords (using the `vextracti32x4` instruction or its intrinsic <tt>_mm512_extracti32x4_epi32</tt>), and expand them (using the `vpmovzxbd` instruction or its intrinsic <tt>_mm512_cvtepu8_epi32</tt>). You get the following result:
```C
void vbmi2_decoder_cvtepu8(uint32_t *base_ptr, uint32_t &base,
                                           uint32_t idx, uint64_t bits) {
  __m512i indexes = _mm512_maskz_compress_epi8(bits, _mm512_set_epi32(
    0x3f3e3d3c, 0x3b3a3938, 0x37363534, 0x33323130,
    0x2f2e2d2c, 0x2b2a2928, 0x27262524, 0x23222120,
    0x1f1e1d1c, 0x1b1a1918, 0x17161514, 0x13121110,
    0x0f0e0d0c, 0x0b0a0908, 0x07060504, 0x03020100
  ));
  __m512i t0 = _mm512_cvtepu8_epi32(_mm512_castsi512_si128(indexes));
  __m512i t1 = _mm512_cvtepu8_epi32(_mm512_extracti32x4_epi32(indexes, 1));
  __m512i t2 = _mm512_cvtepu8_epi32(_mm512_extracti32x4_epi32(indexes, 2));
  __m512i t3 = _mm512_cvtepu8_epi32(_mm512_extracti32x4_epi32(indexes, 3));
  __m512i start_index = _mm512_set1_epi32(idx);
  
  _mm512_storeu_si512(base_ptr + base, _mm512_add_epi32(t0, start_index));
  _mm512_storeu_si512(base_ptr + base + 16, _mm512_add_epi32(t1, start_index));
  _mm512_storeu_si512(base_ptr + base + 32, _mm512_add_epi32(t2, start_index));
  _mm512_storeu_si512(base_ptr + base + 48, _mm512_add_epi32(t3, start_index));
  
  base += _popcnt64(bits);
}
```


If you try to use this approach unconditionally, you will write 256 bytes of data for each 64-bit word you decode. In practice, if your word contains mostly just zeroes, you will be writing a lot of zeroes.

Branching is bad for performance, but only when it is hard to predict. However, it should be rather easy for the processor to predict whether we have fewer than 16 bits set in the provided word, of fewer than 32 bits, and so forth. So some level of branching is adequate. The following function should do:
```C
void vbmi2_decoder_cvtepu8_branchy(uint32_t *base_ptr, uint32_t &base,
                                           uint32_t idx, uint64_t bits) {
  if(bits == 0) { return; }

  __m512i indexes = _mm512_maskz_compress_epi8(bits, _mm512_set_epi32(
    0x3f3e3d3c, 0x3b3a3938, 0x37363534, 0x33323130,
    0x2f2e2d2c, 0x2b2a2928, 0x27262524, 0x23222120,
    0x1f1e1d1c, 0x1b1a1918, 0x17161514, 0x13121110,
    0x0f0e0d0c, 0x0b0a0908, 0x07060504, 0x03020100
  ));
  __m512i start_index = _mm512_set1_epi32(idx);
  
  int count = _popcnt64(bits);
  __m512i t0 = _mm512_cvtepu8_epi32(_mm512_castsi512_si128(indexes));
  _mm512_storeu_si512(base_ptr + base, _mm512_add_epi32(t0, start_index));
  
  if(count > 16) {   
    __m512i t1 = _mm512_cvtepu8_epi32(_mm512_extracti32x4_epi32(indexes, 1));
    _mm512_storeu_si512(base_ptr + base + 16, _mm512_add_epi32(t1, start_index));
    if(count > 32) {   
      __m512i t2 = _mm512_cvtepu8_epi32(_mm512_extracti32x4_epi32(indexes, 2));
      _mm512_storeu_si512(base_ptr + base + 32, _mm512_add_epi32(t2, start_index));
      if(count > 48) {   
        __m512i t3 = _mm512_cvtepu8_epi32(_mm512_extracti32x4_epi32(indexes, 3));
        _mm512_storeu_si512(base_ptr + base + 48, _mm512_add_epi32(t3, start_index));
      }
    }
  }
  base += count;
}
```


The results will vary depending on the input data, but I already have a realistic case with moderate density (about 10% of the bits are set) that I am reusing. Using a Tiger-Lake processor and GCC 9, I get the following timings per set value, when using a sizeable input:

&nbsp;                   |nanoseconds/value        |
-------------------------|-------------------------|
basic                    |0.95                     |
unrolled (simdjson)      |0.74                     |
AVX-512 (previous post)  |0.57                     |
AVX-512 (new)            |0.29                     |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/05/10).

That is a rather remarkable performance, especially considering how we do not need any large table or sophisticated algorithm. All we need are fancy AVX-512 instructions.

