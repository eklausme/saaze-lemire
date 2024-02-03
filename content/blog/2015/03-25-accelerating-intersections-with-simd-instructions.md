---
date: "2015-03-25 12:00:00"
title: "Accelerating intersections with SIMD instructions"
---



Most people have a mental model of computation based on the [Turing machine](https://en.wikipedia.org/wiki/Turing_machine). The computer does one operation at a time. For example, maybe it adds two numbers and outputs the result.

In truth, most modern processor cores are superscalar. They execute several instructions per CPU cycle (e.g., 4 instructions). That is above and beyond the fact that [many processors have several cores](https://en.wikipedia.org/wiki/Multi-core_processor).

Programmers should care about superscalarity because it impacts performance significantly. For example, consider an array of integers. You can compute the gaps between the integers, <tt>y[i+1]=x[i+1]-x[i]</tt>, faster than you can recover the original values from the gaps, <tt>x[i+1]=y[i+1]+x[i]</tt>. That is because the processor can compute several gaps at once whereas it needs to recover the values in sequence (e.g., <tt>x[i]</tt> before <tt>x[i+1]</tt>).

Superscalar execution is truly a wonderful piece of technology. It is amazing that our processors can reorder and regroup instructions without causing any bugs. And though you should be aware of it, it is mostly transparent: there is no need to rewrite your code to benefit from it.

There is another great modern feature that programmers need to be aware of: most modern processors support [SIMD instructions](https://en.wikipedia.org/wiki/SIMD). Instead of, say, adding two numbers, they can add two _vectors_ of integers together. Recent Intel processors can add eight 32-bit integers using one instruction (<tt>vpaddd</tt>).

It is even better than it sounds: SIMD instructions are superscalar too&hellip; so that your processor could possibly add, say, sixteen 32-bit integers in one CPU cycle by executing two instructions at once. And it might yet squeeze a couple of other instructions, in the same CPU cycle!

Vectorization is handy to process images, graphics, arrays of data, and so on. However, unlike superscalar execution, vectorization does not come for free. The processor will not vectorize the computation for you. Thankfully, compilers and interpreters do their best to leverage SIMD instructions.

However, we are not yet at the point where compilers will rewrite your algorithms for you. If your algorithm does not takes into account vectorization, it may not be possible for the compiler to help you in this regard.

An important problem when working with databases or search engines is the computation of the intersection between sorted arrays. For example, given {1, 2, 10, 32} and {2, 3, 32}, you want {2, 32}.

If you assume that you are interested in arrays having about the same length, there are clever SIMD algorithms to compute the intersection. Ilya Katsov describes an [elegant approach](https://highlyscalable.wordpress.com/2012/06/05/fast-intersection-sorted-lists-sse/) for 32-bit integers. If your integers fit in 16 bits, [Schlegel et al.](http://adms-conf.org/p1-SCHLEGEL.pdf) have similar algorithms using special string comparison functions available on Intel processors.

These algorithms are efficient, as long as the two input arrays have similar length&hellip; But life is not so easy. In many typical applications, you frequently need to compute the intersection between arrays having vastly different lengths. Maybe one array contains a hundred integers and the other one thousand. In such cases, you should fall back on a standard intersection algorithm based on a [binary search](https://en.wikipedia.org/wiki/Binary_search_algorithm) (a technique sometimes called &ldquo;galloping&rdquo;).

Or should you fall back? In a recent paper, [SIMD Compression and the Intersection of Sorted Integers](http://arxiv.org/abs/1401.6399), we demonstrate the power of a very simple idea to design better intersection algorithms. Suppose that you are given the number 5 and you want to know whether it appears in the list {1,2,4,6,7,8,15,16}. You can try to do it by binary search, or do a sequential scan&hellip; or better yet, you can do it with a simple vectorized algorithm:

- First represent your single number as a vector made entirely of this value: 5 becomes {5,5,5,5,5,5,5,5}. Intel processors can do this operation very quickly with one instruction.
- Compare the two vectors {5,5,5,5,5,5,5,5} and {1,2,4,6,7,8,15,16} using one instruction. That is, you can check eight equalities at once cheaply. In this instance, I would get {false,false,false,false,false,false,false,false}. It remains to check whether the resulting vector contains a true value which can be done using yet another instruction.


With this simple idea, we can accelerate a range of intersection algorithms with SIMD instructions. In our paper, we show that, on practical and realistic problems, you can double the speed of the state-of-the-art.

To learn more, you can [grab our paper](http://arxiv.org/abs/1401.6399) and [check out our C++ code](https://github.com/lemire/SIMDCompressionAndIntersection).

__Reference__:
<li>Daniel Lemire, Nathan Kurz, Leonid Boytsov, SIMD Compression and the Intersection of Sorted Integers, Software: Practice and Experience, 2015. ([arXiv:1401.6399](http://arxiv.org/abs/1401.6399))

__Further reading__: [Efficient Intersections of compressed posting lists thanks to SIMD instructions](http://searchivarius.org/blog/efficient-intersections-compressed-posting-lists-thanks-simd-instructions) by Leonid Boytsov.

