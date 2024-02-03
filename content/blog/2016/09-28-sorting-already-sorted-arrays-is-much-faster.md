---
date: "2016-09-28 12:00:00"
title: "Sorting already sorted arrays is much faster?"
---



If you are reading a random textbook on computer science, it is probably going to tell you all about how good sorting algorithms take linearithmic time. To arrive at this result, they count the number of operations. That&rsquo;s a good model to teach computer science, but working programmers need more sophisticated models of software performance.

On modern superscalar processors, we expect in-memory sorting to limited by how far ahead the processor can predict where the data will go. Though moving the data in memory is not free, it is a small cost if it can be done predictably.

We know that sorting &ldquo;already sorted data&rdquo; can be done in an easy-to-predict manner (just do nothing). So it should be fast. But how much faster is it that sorting randomly shuffled data?

I decided to [run an experiment](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/09/28).

I use arrays containing one million distinct 32-bit integers, and I report the time in CPU cycles per value on a Haswell processor. I wrote my code in C++.

function                 |sorted data              |shuffled data            |sorted in reverse        |
-------------------------|-------------------------|-------------------------|-------------------------|
<tt>std::sort</tt>       |38                       |200                      |30                       |


For comparison, it takes roughly _n_ log(<em>n</em>) comparisons to sort an array of size _n_ in the worst case with a good algorithm. In my experiment, log(<em>n</em>) is about 20.

The numbers bear out our analysis. Sorting an already-sorted array takes a fraction of the time needed to sort a shuffled array. One could object that the reason sorting already-sorted arrays is fast is because we do not have to move the data so much. So I also included initial arrays that were sorted in reverse. Interestingly, <tt>std::sort</tt> is even faster with reversed arrays! This is clear evidence for our thesis.

([The C++ source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/09/28). My software includes [timsort](https://en.wikipedia.org/wiki/Timsort) results if you are interested.)

