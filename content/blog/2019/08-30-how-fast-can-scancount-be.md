---
date: "2019-08-30 12:00:00"
title: "How fast can scancount be?"
---



[In an earlier post](/lemire/blog/2019/08/16/faster-threshold-queries-with-cache-sensitive-scancount/), I described the following problem. Suppose that you have tens of arrays of integers. You wish to find all integer that are in more than 3 (say) of the sets. This is neither a union nor an intersection. A simple algorithm to solve this problem is to use a counter for each possible value, and increment the counter each time the value is seen. We can finally check the counters and output the answer.
```C
counter <- array of zeros
for array x in set of arrays {
    for value y in array x {
      counter[y] += 1
}
for i = 0; i < counter.size(); i++ {
  if(counter[i] > threshold)
     output i;
}
```


You can do much better if you break down the space of the problem, so that all of your counters fit in the CPU cache. You solve the problem using multiple passes. It also helps if you use small counters, say 8-bit counters.

With this early optimization, I was happy to report a performance of about 16 cycles per input value. It is pretty good&hellip; but Nathan Kurz and Travis Downs pointed out that you can do much better.

What are some of the issues?

1. I was using textbook C++ with iterators and STL algorithms. Converting the problem into lower-level code (using pointers or indexes) seems better for performance.
1. Using 8-bit counters triggers all sorts of nasty &ldquo;aliasing&rdquo; problems: effectively, the compiler becomes paranoid and thinks that you might be writing all over the memory. [Travis wrote a blog post on the topic and on how you can mitigate the issue](https://travisdowns.github.io/blog/2019/08/26/vector-inc.html).
1. There are many low-level issues one might want to handle. For example, if you have 8-bit counter values and an 32-bit threshold value, an extra instruction might be needed to zero-extend your counter value.


We now have two much faster versions to offer. They run at between 3 to 4 cycles per input element. If you are keeping track, it is better than four times faster than my original &ldquo;optimized&rdquo; version. [I make the code available on GitHub as a header-only C++ library](https://github.com/lemire/fastscancount.git).

<li style="list-style-type: none;">

1. The first version is derived from a comment by Nathan Kurz. It works identically to my original version, but instead of using a second pass through the counters, we check the counter values as we modify them. Other than that, I just carefully rewrote my original C++ in &ldquo;plain C&rdquo;. I achieve 4 cycles per input element and a number of instructions per cycle of 3.1 on a skylake processor with GNU GCC and around 3.5 cycles per input element under LLVM clang. The implementation should be portable.
1. Travis was nice enough to share his implementation which follows the same original algorithm, but has been vectorized: it uses fast AVX2 instructions. It is slightly faster under the GNU GCC 8 compiler, sometimes approaching 3 cycles per input element.



&nbsp;

So how fast can scancount be? I have not yet answered this question.

In an earlier comment, Travis gave a bound. If each input element must result into the increment of a counter that is not a register, then we have one store per input element, and thus we need at least one cycle per input element on processors that are limited to one store per cycle.

Of course, we also need to load data: say one load to get the element, and one load to get the corresponding counter. Assuming that our hardware can do either two loads per cycle or one store per cycle, then we get a limit of at least two cycles per input element. Based on this napkin mathematics, if we achieve 4 cycles, then we are within a factor of two of the best possible algorithm.

Still: we could go much faster without breaking the speed of light. We are almost solving an embarrassingly parallel problem: we break the problem into subspaces (for the caching benefits) but this means that should be able to dispatch independent components of the problem to distinct cores.

