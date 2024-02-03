---
date: "2017-04-10 12:00:00"
title: "Removing duplicates from lists quickly"
---



Suppose you have lists of numbers where some values are repeated (e.g., 1,1,2,3,3,3,4,0,0). You want these duplicates (or repeated values) to be removed (e.g., 1,2,3,4,0). To avoid potentially expensive memory allocations, we want to solve the problem in-place, writing back the answer is the current array. This is a surprisingly common problem that arises when merging lists, determining the distinct elements, and in several probabilistic algorithms.

To set a reference, suppose I generate 1024 random numbers in the range [0,1024) and I sort them. This will generate a few repeated values. I want to remove them.

I use integers for my test, but we could equally work with pointers to strings or arbitrary objects.

In C++, we have an STL function for this very purpose: <a href="http://en.cppreference.com/w/cpp/algorithm/unique"><tt>std::unique</tt></a>. On a recent Intel processor, it takes over 11 cycles per value in the array. (Java has a [distinct method](http://www.java2s.com/Tutorials/Java/java.util.stream/Stream/Stream.distinct_.htm) that does the same work.)

You might assume that this result cannot be improved much. Let us see how fast we can go.

You can gain a little bit of efficiency over STL by writing your own function:
```C
size_t unique(uint32_t *out, size_t len) {
    if(len ==  0) return 0;
    size_t pos = 1;
    uint32_t oldv = out[0];
    for (size_t i = 1; i < len; ++i) {
        uint32_t newv = out[i];
        if (newv != oldv) {
            out[pos++] = newv;
        }
        oldv = newv;
    }
    return pos;
}
```


Somehow, this saves about one cycle per array value (we are just under 11 cycles per value). I am not sure why it seems to be a tiny bit faster.

The main benefit of writing our own function, however, is that it gives us a chance to think about the algorithm.

What hurts us in this code are the mispredicted branches that occur when I compare the new value with the previous one. Because I have few repetitions, the processor predicts that there will be none at all. When a repetition does occur, the pipeline must unwind and fix the problems caused by the mispredicted branch.

We can multiply the speed by about a factor of 4 (to less than 3 cycles per array value) with a branchless approach:
```C
static size_t hope_unique(uint32_t *out, size_t len) {
    if(len ==  0) return 0; // duh!
    size_t pos = 1;
    uint32_t oldv = out[0];
    for (size_t i = 1; i < len; ++i) {
        uint32_t newv = out[i];
        out[pos] = newv;
        pos += (newv != oldv);
        oldv = newv;
    }
    return pos;
}
```


Can we do better? It turns out that using SIMD instructions (with the AVX2 instruction set), we can get to about 1 cycle per array value. In that case, the code is not only branchless, but it also operates on vectors of several values at once&hellip;
```C
int _avx_unique_store(__m256i ov, __m256i nv, __m256i *o) {
    // use the last value from ov and takes the rest from nv
    __m256i recon  = _mm256_blend_epi32(ov, nv, 0b01111111);
    // next two lines rotate the value, so that last is first
    const __m256i mbom = _mm256_set_epi32(6,5,4,3,2,1,0,7);
    __m256i vT = _mm256_permutevar8x32_epi32(recon,mbom);
    // we compare the newly generated vector with the original
    // comparing values with their preceeding values
    int M = _mm256_movemask_ps(_mm256_cmpeq_epi32(vT, nv));
    // N records how many values need to be kept
    int N =  8 - _mm_popcnt_u64(M);
    // next two lines prune out the values based on
    // the bit mask M, see https://github.com/lemire/simdprune
    __m256i key = _mm256_loadu_si256(uniqshuf + M);
    __m256i val =_mm256_permutevar8x32_epi32(nv,key);
    _mm256_storeu_si256(o, val);
    return N;
}
```


I realize that the vectorized code looks like gibberish but my goal is to assess the benefits over vectorization.

With vectorization, we are fully one order of magnitude faster than STL&rsquo;s <tt>std::unique</tt> function.

As usual, [my code is freely available on GitHub](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/04/10).

__Further reading__: [Quickly pruning elements in SIMD vectors using the simdprune library](/lemire/blog/2017/04/25/quickly-pruning-elements-in-simd-vectors-using-the-simdprune-library/)

