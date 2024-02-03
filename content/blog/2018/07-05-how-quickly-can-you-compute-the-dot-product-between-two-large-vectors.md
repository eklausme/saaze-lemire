---
date: "2018-07-05 12:00:00"
title: "How quickly can you compute the dot product between two large vectors?"
---



A dot (or scalar) product is a fairly simple operation that simply sums the many products:
```C
float sum = 0;
for (size_t i = 0; i < len; i++) {
    sum += x1[i] * x2[i];
}
return sum;
```


It is nevertheless tremendously important. You know these fancy machine learning algorithms we keep hearing about? If you dig deep under all the sophistication, you often find lots and lots of dot products.

[Xavier Arteaga](https://github.com/xarteaga) had a few interesting comments on a previous post of mine:

1. &ldquo;I would say that CPU frequency does not really make a difference when computing large amounts of data.&rdquo;
1. &ldquo;I guess for intensive computations which require little memory and lots of operations AVX512 [new fancy instruction sets provided by Intel] provides a better performance.&rdquo;


I feel the need to provide some analysis. So let us evaluate Xavier&rsquo;s observations with the dot product. Before I begin, let me point out that I am not a linear algebra expert, there has been lots and lots of fancy engineering done on these problems. If you need fast dot product software, find a good library, don&rsquo;t grab it out of my blog.

[I implemented a simple benchmark that computes dot products over increasingly larger vectors](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/07/05). I use three modes: &ldquo;standard&rdquo; math which is what you get when you simply compile a dot-product loop, a version with 128-bit vectors (SSE) and a version with 256-bit vectors (AVX2).

total input size         |cycles per pair of floats |bytes per cycle          |mode                     |
-------------------------|-------------------------|-------------------------|-------------------------|
8 kB                     |4                        |2                        |standard math            |
8 kB                     |1.0                      |7.8                      |fast math (SSE)          |
8 kB                     |0.55                     |15                       |fast math (AVX2)         |
16 MB                    |4                        |2                        |standard math            |
16 MB                    |1.0                      |7                        |fast math (SSE)          |
16 MB                    |0.9                      |9                        |fast math (AVX2)         |
256 MB                   |4                        |2                        |standard math            |
256 MB                   |1.3                      |6.0                      |fast math (SSE)          |
256 MB                   |1.2                      |6.7                      |fast math (AVX2)         |


For small inputs, my AVX2 code can process eight pairs of values in fewer than 5 cycles. What is apparent is that we are quickly hitting a wall&hellip; for large inputs (e.g., 256 MB and more). This wall has to do with how quickly our single core can grab data from the memory subsystem. I suspect that Xavier is correct: this wall has probably little dependency on the CPU frequency. Furthermore, having fancier instructions (e.g., those from the AVX-512 instruction sets) will not help you.

What can we conclude?

1. If you have to process lots of data, and do dirt cheap operations (e.g., a vectorized dot product), then your single processor core is easily starved for data. That&rsquo;s the part where Xavier is right.
1. However, it is important to qualify what we mean by &ldquo;cheap tasks&rdquo;. Even just computing the dot product in a standard-compliant manner is entirely compute-bound in my experiments. Lots and lots of streaming operations like parsing a document, compressing data, and so forth, are likely to be compute bound.


To put it otherwise, I would say that while it is possible to design functions that stream through data in such a way that they are memory-bound over large inputs (e.g., copying data), these functions need to be able to eat through several bytes of data per cycle. Because our processors are vectorized and superscalar, it is certainly in the realm of possibilities, but harder than you might think.

