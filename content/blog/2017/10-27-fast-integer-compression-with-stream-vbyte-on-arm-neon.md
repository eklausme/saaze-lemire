---
date: "2017-10-27 12:00:00"
title: "Fast integer compression with Stream VByte on ARM Neon processors"
---



Stream VByte is possibly the fastest byte-oriented integer compression scheme. I presented it briefly last month when [our paper came out](https://arxiv.org/abs/1709.08990). Our [C library](https://github.com/lemire/streamvbyte) has been ported to [Rust](https://bitbucket.org/marshallpierce/stream-vbyte-rust) and [Go](https://github.com/nelz9999/stream-vbyte-go). Our code is used by the [Tantivy search engine](https://github.com/tantivy-search/tantivy) as well as by the [Trinity Information Retrieval framework](https://github.com/phaistos-networks/Trinity). Mark Papadakis [reported excellent results with Stream VByte](https://medium.com/@markpapadakis/trinity-updates-and-integer-codes-benchmarks-6a4fa2eb3fd1). 

The x64 code had this super simple vectorized decoding pass:
```C
uint8_t C = lengthTable[control]; // C is between 4 and 16 
 __m128i Data = _mm_loadu_si128((__m128i *) databytes);
 __m128i Shuf = _mm_loadu_si128(shuffleTable[control]);
 Data = _mm_shuffle_epi8(Data, Shuf); // final decoded data  
 datasource += C;
```


It looks complicated if you are not familiar with vector intrinsic, but this code generates very few instructions.

In my initial announcement, I alluded to the fact that it would be nice to vectorize the code for ARM processors. Indeed, the processors in your iPhone (and other mobile devices) also have vector instructions (called NEON). Could we get good performance there as well?

It turns out that we can. Kendall Willets worked hard not only to vectorize the encoding steps, something we had left for future work, but he also ported the vector code to ARM, with complete vectorization.

What I find beautiful is that the 64-bit ARM NEON code is equivalent, at an abstract level, to the x64 code:
```C
uint8x16_t dec = vld1q_u8(table + key);
uint8x16_t compressed = vld1q_u8(dataPtr);
uint8x16_t data = vqtbl1q_u8(compressed, dec);
dataPtr += length[key];
vst1q_u8(out, data);
```


It &ldquo;looks&rdquo; different because the naming conventions are not the same as Intel&rsquo;s, but it ends up generating the same kind of instruction.

I should point out that this is the 64-bit version of ARM Neon (part of Aarch64). We also support 32-bit ARM systems, but the code is slightly less elegant. As a rule, you should expect most servers as well as most phones to be 64-bit systems, either now or in the near future. However, smartwatches and other tiny devices are probably going to remain 32-bit systems for some time.

So I tested the 64-bit code on a [Softiron 1000](https://shop.softiron.com/product/overdrive-1000/) server. These machines have relatively weak (and cheap) AMD processors with A57 cores. You can copy memory at a rate of about 1.7 billion 32-bit integers per second on these cores.

Kendall produced a quick benchmark where we attempt to decompress random data. That is not a favorable case for any compression algorithm, but it gives us some idea of a typical &ldquo;worst case&rdquo; performance. So how fast is it? Without vectorization, we decode 260 million integers per second. That is not bad. But with vector (NEON) instructions, we reach 1.1 billion integers decode per second, or about 4 times better.

It still early days for ARM processors on servers, but it is getting easier to find them. On this note, I would like to thank Edward Vielmetti from Packet for helping us test with other server-class ARM processors to validate our work.

