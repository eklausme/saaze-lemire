---
date: "2019-07-23 12:00:00"
title: "Arbitrary byte-to-byte maps using ARM NEON?"
---



Modern processors have fast instructions that can operate on wide registers (e.g., 128-bit). ARM processors, the kind of processors found in your phone, have such instructions called &ldquo;NEON&rdquo;. [Sebastian Pop](https://www.linkedin.com/in/sebpop/) pointed me to some of his work doing fast string transformations using NEON instructions. Sebastian has done some great work to accelerate the PHP interpreter on ARM processors. One of his recent optimization is a way to transform the case of strings quickly.

It suggested the following problem to me. Suppose that you have a stream of bytes. You want to transform byte values in an arbitrary manner. Maybe you want to map the byte value 1 to the byte value 12, the byte value 2 to the byte value 53&hellip; and so forth.

Here is how you might implement such a function in plain C:
```C
 for(size_t i = 0; i < volume; i++) {
    values[i] = map[values[i]];
 }
```


For each byte, you need two loads (to get to map<span style="color: #808030;">[</span>values<span style="color: #808030;">[</span>i<span style="color: #808030;">]</span><span style="color: #808030;">]</span>) and one store, assuming that the compiler does not do any magic.

To implement such a function on block of 16 bytes with NEON, we use the `vqtbl4q_u8` function which is essentially a way to do 16 independent look-up in a 64-byte table. It uses the least significant 5 bits as a look-up index. If any of the other bits are non-zero, it outputs zero. Because there are 256 different values, we need four distinct calls to the `vqtbl4q_u8` function. One of them will give non-zero results for byte values in [0,64), another one for bytes values in [64,128), another one for byte values in [128,192), and a final one for byte values in [192,256). We select the right values with a bitwise XOR (and the `veorq_u8` function). Finally, we just need to apply bitwise ORs to glue the results back together (via the `vorrq_u8` function).
```C
uint8x16_t simd_transform16(uint8x16x4_t * table, uint8x16_t input) {
  uint8x16_t  t1 = vqtbl4q_u8(table[0],  input);
  uint8x16_t  t2 = vqtbl4q_u8(table[1],  
       veorq_u8(input, vdupq_n_u8(0x40)));
  uint8x16_t  t3 = vqtbl4q_u8(table[2],  
       veorq_u8(input, vdupq_n_u8(0x80)));
  uint8x16_t  t4 = vqtbl4q_u8(table[3],  
       veorq_u8(input, vdupq_n_u8(0xc0)));
  return vorrq_u8(vorrq_u8(t1,t2), vorrq_u8(t3,t4));
}
```


In terms of loads and stores, assuming that you enough registers, you only have one load and one store per block of 16 bytes. 

A more practical scenario might be to assume that all my byte values fit in [0,128), as is the case with a stream of ASCII characters&hellip;
```C
uint8x16_t simd_transform16_ascii(uint8x16x4_t * table, 
               uint8x16_t input) {
  uint8x16_t  t1 = vqtbl4q_u8(table[0],  input);
  uint8x16_t  t2 = vqtbl4q_u8(table[1],  
     veorq_u8(input, vdupq_n_u8(0x40)));
  return vorrq_u8(t1,t2);
}
```


To test it out, I wrote a benchmark which I ran on a Cortex A72 processor. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/07/23). I get a sizeable speed bump when I use NEON with an ASCII input, but the general NEON scenario is slower than a plain C version.

plain C                  |1.15 ns/byte             |
-------------------------|-------------------------|
neon                     |1.35 ns/byte             |
neon (ascii)             |0.71 ns/byte             |


What about Intel and AMD processors? Most of them do not have 64-byte lookup tables. They are limited to 16-byte tables. We need to wait for AVX-512 instructions for wider vectorized lookup tables. Unfortunately, AVX-512 is only available on some Intel processors and it is unclear when it will appear on AMD processors.

