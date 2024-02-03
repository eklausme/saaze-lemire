---
date: "2016-08-25 12:00:00"
title: "Faster dictionary decoding with SIMD instructions"
---



A particularly fast and effective compression technique is <em>dictionary coding</em>. Intuitively, it works as follow. Suppose you are given a long document made of millions of words, but containing only 65536 distinct words. You can create a map from words to short integers or indexes (in [0,65536)). So the word &ldquo;the&rdquo; might be replaced by 0, the word &ldquo;friend&rdquo; by 1, and so forth. You then replace your document with an array of 16-bit integers. So you use only 16 bits per word.

In general, given a dictionary of size <tt>N</tt>, you only need <span style="color:#603000; ">ceil</span><span style="color:#808030; ">(</span>log2<span style="color:#808030; ">(</span>N<span style="color:#808030; ">+</span><span style="color:#008c00; ">1</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span> bits to represent each word. Your dictionary can be implemented, simply, as an array pointers (using 64 bits per pointer).

It may help reduce memory usage if words are often repeated. But it can also speed up processing. It much faster for a processor to seek out a given integer in a flat array than it is to seek a given word.

You can also use nice tricks to pack and unpack integers very fast. That is, given arrays of 32-bit integers that fit in `b` bits, you can quickly pack and unpack them. You can easily [process billions of such integers per second](https://github.com/lemire/simdcomp) on a commodity processor.

In my example, I have used the notions of document and word, but dictionary coding is more often found in database systems to code columns or tuples. Systems like Oracle, Apache Kylin, and Apache Parquet use dictionary coding.

What if you want to reconstruct the data by looking it up in the dictionary?

Even if you can unpack the integers so that the processor can get the address in the dictionary, the look-up risks becoming a bottleneck. And there is a lot of data in motion&hellip; you have to unpack the indexes, then read them back, then access the dictionary. The code might look something like this&hellip;
```C
unpack(compressed_data, tmpbuffer, array_length, b);
for(size_t i = 0; i < array_length; ++i) {
    out[i] = dictionary[tmpbuffer[i]];
}
```


Surely, there is no way around looking up the data in the dictionary, so you are stuck?

Except that recent Intel processors, and the upcoming AMD Zen processors have `gather` instructions that can quickly look-up several values at once. In C and C++, you can use the `_mm_i32gather_epi64` intrinsic. It allows you to drastically reduce the number of instructions. You no longer need to write out the unpacked indexes, and read them back.

So how effective is it? The answer, unsurprisingly, depends on the size of the dictionary and your access pattern. In my example, I assumed that you had a dictionary made of 65536 words. Such a large dictionary requires half a megabyte. It won&rsquo;t fit in fast CPU cache. Because dictionary coding only makes sense for when the dictionary size is less than the main data, it would only make sense for very large data. If you have lots of data, a more practical approach might be to partition the problem so have many small dictionaries. A large dictionary might still make sense, but only if most of it is never used.

I [have implemented dictionary decoding](https://github.com/lemire/dictionary) and run it on a recent Intel processor (Skylake). The speed-up from the SIMD/gather approach is comfortably a factor of two.

<td colspan="3">Number of CPU cycles per value decoded |

dictionary size (# keys) |scalar                   |SIMD (gather)            |
512                      |3.1                      |1.2                      |
1024                     |3.1                      |1.2                      |
2048                     |3.1                      |1.2                      |
4096                     |3.3                      |1.3                      |
8192                     |3.7                      |1.7                      |


2x is a nice gain. But we are only getting started. My Skylake processor only supports 256-bit SIMD vectors. This means that I can only gather four 64-bit values from my dictionary at once. Soon, our processors will benefit from AVX-512 and be able to gather eight 64-bit values at once. I don&rsquo;t yet live in this future, so I put AVX-512 to the test on high-throughput Intel hardware (Knights Landing). Short story: you gain another factor of two&hellip; achieving a total speed-up of almost 4x over the basic code.

While the benefits are going to be even larger in the future, I should stress that benefits are likely much smaller on older processors (Haswell or before). For this work, technology is still fast evolving and there are large differences between slightly recent and bleeding-edge processors.

What is optimally fast on today&rsquo;s hardware might be slow on tomorrow&rsquo;s hardware.

__Some relevant software__:

- [A simple C library for compressing lists of integers using binary packing](https://github.com/lemire/simdcomp)
- [High-performance dictionary coding](https://github.com/lemire/dictionary)


__Further reading__:

- Lemire, Daniel and Boytsov, Leonid, &#038; Kurz, Nathan (2016). [SIMD Compression and the Intersection of Sorted Integers](https://arxiv.org/abs/1401.6399). Software: Practice and Experience, 46 (6).
- Lemire, Daniel, and Leonid Boytsov (2015). [Decoding billions of integers per second through vectorization](https://arxiv.org/abs/1209.2137). Software: Practice and Experience 45 (1).
- Lemire, Daniel, Owen Kaser, and Eduardo Gutarra (2012). [Reordering rows for better compression: Beyond the lexicographic order](http://arxiv.org/abs/1207.2189). ACM Transactions on Database Systems (TODS) 37 (3).


__Credit__: Work done with Eric Daniel from the <tt>parquet-cpp</tt> project.

