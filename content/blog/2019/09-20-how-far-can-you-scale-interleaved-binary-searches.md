---
date: "2019-09-20 12:00:00"
title: "How far can you scale interleaved binary searches?"
---



The binary search is the standard, textbook, approach when searching through sorted arrays. In a [previous post](/lemire/blog/2019/09/14/speeding-up-independent-binary-searches-by-interleaving-them/), I showed how you can do multiple binary searches faster if you interleave them. The core idea is that while the processor is waiting for data from one memory access, you can squeeze in several more from another search. So you effectively compute them &ldquo;in parallel&rdquo; even though the code itself is single-threaded.

I hinted that it probably made no sense to scale this up beyond 32 interleaved searches. That is, you cannot do much better than a factor of 9 speedup using a recent Intel processor (Cannon Lake), with a lesser benefit on older architectures (Skylake). I have since written a benchmark to prove that it is so by trying all possible interleave counts between 2 and 64.

So how could we squeeze even more performance? Why can&rsquo;t we reach a speedup factor of 15 or 20? A significant cost might be related to pages: computers organize their memory in blocks (pages) spanning a small number of bytes (e.g., 4kB). Yet they also can only keep thousands of pages available at any one time. If you ask for a page that has not been recently accessed, the processor needs to remap it, an expensive process. If you are doing lots of random access in a large array, it is likely that you will frequently hit a page that has not been recently accessed, and you might be limited speed-wise by the resulting miss. You can alleviate this problem by asking that the operating system use &ldquo;huge pages&rdquo;.

I present the results as a figure which I hope will be intuitive. There is quite a bit of measurement noise, which I leave as a sort of error bar.

<a href="https://lemire.me/blog/wp-content/uploads/2019/09/results.png"><img decoding="async" class="alignnone size-full wp-image-17854" src="https://lemire.me/blog/wp-content/uploads/2019/09/results.png" alt width="60%" srcset="https://lemire.me/blog/wp-content/uploads/2019/09/results.png 640w, https://lemire.me/blog/wp-content/uploads/2019/09/results-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" /></a>

- Huge pages help: we go from a maximum speedup of about 9 to 11. This suggests that page size is a concern. Using huge pages is not very practical, however. Thankfully, there are other ways to alleviate page issues, such as well timed prefetching.
- The plot shows that there is a very nice performance progression up to about 9 parallel searches, and that up to 9 parallel searches, there is little difference between the version with regular pages and the version with huge pages. I suspect that up to that point (9 searches), we are not fast enough for page size to be a performance concern.
- Whether we use regular or huge pages, we reach a &ldquo;noisy&rdquo; plateau, some kind of hard speed limit. Furthermore, we do not scale up the performance linearly with the number of parallel searches, and even when we do, the slope is much smaller than one. What might be the limiting  factors? I am not sure. If you know, please share your thoughts!


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/09/20), it should run everywhere C++ runs. Yet the benchmark assumes that you use the GNU GCC compiler, because I do not know how to deliberately generate the needed conditional move instructions with other compilers. Again, this is the result of joint work with Nathan Kurz and Travis Downs, but the mistakes are mine.

