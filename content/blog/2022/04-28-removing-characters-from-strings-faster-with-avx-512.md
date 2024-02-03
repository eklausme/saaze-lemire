---
date: "2022-04-28 12:00:00"
title: "Removing characters from strings faster with AVX-512"
---



In software, it is a common problem to want to remove specific characters from a string. To make the problem precise, let us consider the removal of all ASCII control characters and spaces. In practice, it means the removal of all byte values smaller or equal than 32.

[I covered a related problem before](/lemire/blog/2017/01/20/how-quickly-can-you-remove-spaces-from-a-string/), the [removal of all spaces from strings](/lemire/blog/2017/01/20/how-quickly-can-you-remove-spaces-from-a-string/). At the time, I concluded that the fastest approach might be to use SIMD instructions coupled with a large lookup table. A SIMD instruction is such that it can operate on many words at any given time: most commodity processors have instructions able to operate on 16 bytes at a time. Thus, using a single instruction, you can compare 16 consecutive bytes and identify the location of all spaces, for example. Once it is done, you must somehow move the unwanted characters. Most instruction sets do not have instructions for that purpose, however x64 processors have an instruction that can move bytes around as long as you have a precomputed shuffle mask (<tt>pshufb</tt>). ARM NEON has similar instructions as well. Thus you proceed in the following manner:

1. Identify all unwanted characters in a block (e.g., 16 bytes).
1. Lookup a shuffle mask in a large table.
1. Move the unwanted bytes using the shuffle mask.


Such an approach is fast but it requires possibly large tables.  Indeed, if you load 16 bytes, you need a table with 65536 shuffle masks. Storing such large tables is not very practical.

Recent Intel processors have handy new instructions that do exactly what we want: they prune out unwanted bytes (<tt>vpcompressb</tt>). It requires a recent processor with [AVX-512 VBMI2](https://en.wikipedia.org/wiki/AVX-512) such as Ice Lake, Rocket Lake, Alder Lake, or Tiger Lake processors. Intel makes it difficult to figure out which features is available on which processor, so you need to do some research to find out if your favorite Intel processors supports the desired instructions. AMD processors do not support VBMI2.

On top of the new instructions, AVX-512 also allows you process the data in larger blocks (64 bytes). Using Intel instructions, the code is almost readable. I create a register containing only the space byte, and I then iterate over my data, each time loading 64 bytes of data. I compare it with the space: I only want to keep values that are large (in byte values) than the space. I then call the compress instruction which takes out the unwanted bytes. I read at regular intervals (every 64 bytes) but I write a variable number of bytes, so I advance the write pointer by the number of set bits in my mask: I count those using a fast instruction (<tt>popcnt</tt>).
```C
  __m512i spaces = _mm512_set1_epi8(' ');
  size_t i = 0;
  for (; i + 63 < howmany; i += 64) {
    __m512i x = _mm512_loadu_si512(bytes + i);
    __mmask64  notwhite = _mm512_cmpgt_epi8_mask  (x, spaces);
    _mm512_mask_compressstoreu_epi8  (bytes + pos, notwhite, x);
    pos += _popcnt64(notwhite);
  }
```


I have updated the [despacer library](https://github.com/lemire/despacer) and its benchmark. With a Tiger Lake processor (3.3 GHz) and GCC 9 (Linux), I get the following results:

function                 |speed                    |
-------------------------|-------------------------|
conventional (despace32) |0.4 GB/s                 |
SIMD with large lookup (sse42_despace_branchless) |2.0 GB/s                 |
AVX-512 (vbmi2_despace)  |8.5 GB/s                 |


Your results will differ. Nevertheless, we find that AVX-512 is highly useful for this task and the related function surpasses all other such functions. It is not merely the raw speed, it is also the fact that we do not require a lookup table and that the code does not rely on branch prediction: there is no hard-to-predict branches that may harm your speed in practice.

The result should not surprise us since, for the first time, we almost have direct hardware support for the operation (&ldquo;pruning unwanted bytes&rdquo;). The downside is that few processors support the desired instruction set. And it is not clear whether AMD will ever support these fancy instructions.

[I should conclude with Linus Torvalds take regarding AVX-512](https://www.zdnet.com/article/linus-torvalds-i-hope-intels-avx-512-dies-a-painful-death/):

<em>I hope AVX-512 dies a painful death, and that Intel starts fixing real problems instead of trying to create magic instructions to then create benchmarks that they can look good on</em>

I cannot predict what will happen to Intel or AVX-512, but if the past is any indication, specialized and powerful instructions have a bright future.

