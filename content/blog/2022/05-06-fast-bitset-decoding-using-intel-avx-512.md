---
date: "2022-05-06 12:00:00"
title: "Fast bitset decoding using Intel AVX-512"
---



In software, we often use &lsquo;bitsets&rsquo;: you work with arrays of bits to represent sets of small integers. It is a concise and fast data structure. Sometimes you want to go from the bitset (e.g., <tt>0b110011</tt>) to the integers (e.g., 0, 1, 5, 6 in this instance). We consider with &lsquo;average&rsquo; density (e.g., more than a handful of bits set per 64-bit word).

You could check the value of each bit, but a better option is to use the fact that processors have fast instructions to compute the number of &ldquo;trailing zeros&rdquo;. Given 0b10001100100, this instruction would give you 2. This gives you the first index. Then you need to unset this least significant bit using code such as <tt>word &amp; (word - 1)</tt>.
```C
  while (word != 0) {
    result[i] = trailingzeroes(word);
    word = word & (word - 1);
    i++;
  }
```


The problem with this code is that the number of iterations might be hard to predict, thus you might often cause your processor to mispredict the number of branches. A misprediction is expensive on modern processor. You can do better by further unrolling this loop. [I describe how in an earlier blog post](/lemire/blog/2019/05/03/really-fast-bitset-decoding-for-average-densities/).

Intel latest processors have new instruction sets (AVX-512) that are quite powerful. In this instance, it allows to do the decoding without any branch and with few instructions. The key is the `vpcompressd` instruction and its corresponding C/C++ _Intel_ function (<tt>_mm512_mask_compressstoreu_epi32</tt>). What it does is that given up to 16 integers, it only selects the ones corresponding to a bit set in a bitset. Thus given the array 0,1,2,3&hellip;.16 and given the bitset 0b111010, you would generate the output 1,3,4,6. The function does not tell you how many relevant values are written out, but you can just count the number of ones, and conveniently, we have a fast instruction for that, available through the `_popcnt64` function. So the following code sequence would process 16-bit masks and write them out to a pointer (<tt>base_ptr</tt>).
```C
  __m512i base_index = _mm512_setr_epi32(0,1,2,3,4,5,
    6,7,8,9,10,11,12,13,14,15);

  _mm512_mask_compressstoreu_epi32(base_ptr, 
    mask, base_index);

  base_ptr += _popcnt64(mask);
```


The full function which processes 64-bit masks is somewhat longer, but it is essentially just 4 copies of the simple sequence.
```C
void avx512_decoder(uint32_t *base_ptr, uint32_t &base,
    uint32_t idx, uint64_t bits) {
  __m512i start_index = _mm512_set1_epi32(idx);
  __m512i base_index = _mm512_setr_epi32(0,1,2,3,4,5,
    6,7,8,9,10,11,12,13,14,15);
  base_index = _mm512_add_epi32(base_index, start_index);
  uint16_t mask;
  mask = bits & 0xFFFF;
  _mm512_mask_compressstoreu_epi32(base_ptr + base, 
    mask, base_index);
  base += _popcnt64(mask);
  const __m512i constant16 = _mm512_set1_epi32(16);
  base_index = _mm512_add_epi32(base_index, constant16);
  mask = (bits>>16) & 0xFFFF;
  _mm512_mask_compressstoreu_epi32(base_ptr + base, 
     mask, base_index);
  base += _popcnt64(mask);
  base_index = _mm512_add_epi32(base_index, constant16);
  mask = (bits>>32) & 0xFFFF;
  _mm512_mask_compressstoreu_epi32(base_ptr + base, 
    mask, base_index);
  base += _popcnt64(mask);
  base_index = _mm512_add_epi32(base_index, constant16);
  mask = bits>>48;
  _mm512_mask_compressstoreu_epi32(base_ptr + base, 
    mask, base_index);
  base += _popcnt64(mask);
}
```


There is a downside to using AVX-512: for a short time, the processor might reduce its frequency when wide registers (512 bits) are used. You can still use the same instructions on shorter registers (e.g., use `_mm256_mask_compressstoreu_epi32` instead of <tt>_mm512_mask_compressstoreu_epi32</tt>) but in this instance, it doubles the number of instructions.

On a skylake-x processor with GCC, my benchmark reveals that the new AVX-512 is superior even with frequency throttling. Compared to the basic approach above, the AVX-512 approach use 45% times fewer cycles and 33% less time. We report the number of instructions, cycles and nanoseconds per value set in the bitset. The AVX-512 generates no branch misprediction.

&nbsp;                   |instructions/value       |cycles/value             |nanoseconds/value        |
-------------------------|-------------------------|-------------------------|-------------------------|
basic                    |9.3                      |4.4                      |1.5                      |
unrolled (simdjson)      |9.9                      |3.6                      |1.2                      |
AVX-512                  |6.2                      |2.4                      |1.0                      |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/05/06).

The AVX-512 routine has record-breaking speed. It is also possible that the routine could be improved.

