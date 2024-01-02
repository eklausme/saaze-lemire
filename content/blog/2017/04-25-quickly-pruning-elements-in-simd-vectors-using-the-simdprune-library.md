---
date: "2017-04-25 12:00:00"
title: "Quickly pruning elements in SIMD vectors using the simdprune library"
---



Modern processors have powerful vector instructions. However, some algorithms are tricky to implement using vector instructions. 

I often need to prune selected values from a vector. On x64 processors, we can achieve this result using table lookups and an efficient shuffle instruction. Building up the table each time gets tiring, however.

Let us consider two of my recent blog posts [Removing duplicates from lists quickly](/lemire/blog/2017/04/10/removing-duplicates-from-lists-quickly/) and [How quickly can you remove spaces from a string?](/lemire/blog/2017/01/20/how-quickly-can-you-remove-spaces-from-a-string/) They follow the same pattern. We take a vector, identify the values that we want to remove, build a corresponding bit mask and then remove them. In one case, we want to remove repeated values, in another, we want to remove spaces. 

Building the bit mask is efficient and takes only a few instructions:

- We can identify the values to remove using vectorized comparisons (e.g., using the intrinsics `_mm_cmpeq_epi8` or <tt>_mm256_cmpeq_epi32</tt>). This is typically very inexpensive.
- We then build the bit mask from the comparison vector using what Intel calls a movemask (e.g., using the intrinsics `_mm_movemask_epi8` or <tt>_mm256_movemask_ps</tt>). The movemask is relatively cheap, though it can have a high latency.


The pruning itself is ugly, and it requires a table lookup. I decided to publish a software library called [simdprune](https://github.com/lemire/simdprune) to make it easier.

The library is quite simple. If you need to remove every other value in a 256-bit vector, you can get this result with the function call <tt>prune256_epi32(x,0b10101010)</tt>.

__Link__: [https://github.com/lemire/simdprune](https://github.com/lemire/simdprune)

