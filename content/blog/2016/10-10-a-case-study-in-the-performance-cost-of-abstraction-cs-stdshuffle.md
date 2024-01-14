---
date: "2016-10-10 12:00:00"
title: "A case study in the performance cost of abstraction (C++´s std::shuffle)"
---



Statisticians and machine-learning experts sometimes need to shuffle data quickly and repeatedly. There is one standard and simple algorithm to shuffle an array, the so-called Fisher-Yates shuffle:
```C
for (i=size; i>1; i--) {
  nextpos = random_numbers_in_range(0,i);
  swap(storage[i-1], storage[nextpos]);
}
```


Not very difficult, is it? The C++ programming language, like many others, have a standard function to solve this problem ([std::shuffle](http://en.cppreference.com/w/cpp/algorithm/random_shuffle)).

How does it fare against a very basic Fisher-Yates shuffle without any optimization whatsoever? To make sure that the comparison is fair, let us work with the same data (an array of strings) and use the same random number generator (I chose [PCG](http://www.pcg-random.org/)). To avoid caching issues, let us use a small array that fits in cache.

Here is my unoptimized C++ code:```C
template <class T>
void  shuffle(T *storage, uint32_t size) {
    for (uint32_t i=size; i>1; i--) {
        uint32_t nextpos = pcg32_random_bounded(i);
        std::swap(storage[i-1],storage[nextpos]);
    }
}
```


I claim that this is the &ldquo;textbook&rdquo; implementation&hellip; meaning that it is the closest thing you can get to taking a textbook and coding up the pseudo-code in C++. (Yes I know that people copy code from Wikipedia or StackOverflow, not textbooks, but humor me.)

The `pcg32_random_bounded` function I call is implemented in a standard (but suboptimal way) to get a random number in a range with two divisions. [You can do it with a single multiplication instead](/lemire/blog/2016/06/30/fast-random-shuffling/) but let us ignore optimizations.

Here are my results, expressed in CPU clock cycles per value&hellip; (Skylake processor, clang++ 4.0)

technique                |clock cycles per value   |
-------------------------|-------------------------|
<tt>std::shuffle</tt>    |73                       |
<tt>textbook code</tt>   |29                       |


So the textbook code is twice as fast as the standard C++ function.

Why is that?
It is often the case that [default random number generators are slow](/lemire/blog/2016/02/01/default-random-number-generators-are-slow/) due to concurrency issues. But we provide our own random number generators, so it should not be an issue.

A cursory analysis reveals that the most likely reason for the slowdown is that the standard C++ library tends to use 64-bit arithmetic throughout (on 64-bit systems). I implicitly assume, in my textbook implementation, that you are not going to randomly shuffle arrays containing more than 4 billion elements. I don&rsquo;t think I am being unreasonable: an array of 4 billion <tt>std::string</tt> values would use at least 128 GB of RAM. If you need to shuffle that much data, you probably want to parallelize the problem. But, from the point of view of the engineers working on the standard library, they have to work with the requirements set forth by the specification. So 64-bit arithmetic it is! And that&rsquo;s how I can beat them without any effort.

The absolute numbers might also surprise you. The Fisher-Yates shuffle is very efficient. We do a single pass over the data. We do not really need to look at the data, just move it. We use a fast random number generator (PCG). How can we end up with 30 or 70 cycles per array element?

Part of the problem is our use of <tt>std::string</tt>. On my system, a single (empty) <tt>std::string</tt> uses 32 bytes whereas a pointer (<tt>char *</tt>) uses only 8 bytes. If we fall back on C strings (<tt>char *</tt>), we can accelerate the processing simply because there is less data to move. Without going overboard with optimizations, I can bring the computational cost to about 7 cycles per element by avoiding divisions and using C strings instead of <tt>std::string</tt> objects. That&rsquo;s an order of magnitude faster than the standard shuffle function.

So while <tt>std::shuffle</tt> is very general, being able to sort just about any array using just about any random-number generator&hellip; this generality has a cost in terms of performance.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/10/10).

