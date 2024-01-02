---
date: "2017-09-18 12:00:00"
title: "Visiting all values in an array exactly once in &#8220;random order&#8221;"
---



Suppose that you want to visit all values in an array exactly once in &ldquo;random order&rdquo;. You could do it by shuffling your array but it requires some extra storage. 

You want your code to use just a tiny bit of memory, and you want the code to be super fast. You do not want to assume that your array size is a power of two. 

One way to do it is to use the fact that <tt>(a x + b) modulo n</tt> will visit all integer values in <tt>[0,n)</tt> exactly once as `x` iterates through the integers in <tt>[0, n)</tt>, as long as `a` is coprime with <tt>n</tt>. Being coprime just means that the greatest common divisor between `a` and `n` is 1. There are fast functions to compute the [greatest common divisor](/lemire/blog/2013/12/26/fastest-way-to-compute-the-greatest-common-divisor/) between `a` and <tt>n</tt>.

A trivial coprime number would be <tt>a = 1</tt>, but that&rsquo;s bad for obvious reasons. So we pick a coprime number in <tt>[n/2,n)</tt> instead. There is always at least one no matter what `n` is.

Enumerating all coprime numbers in <tt>[n/2,n)</tt> could get tiresome when `n` is very large, so maybe we just look at up to 100,000 of them. There is no need to actually store them in memory, we can just select one at random, so it requires very little memory.

To see why the mathematics work, suppose that <tt>( a x + b ) modulo n = ( a x' + b ) modulo n</tt>, then <tt>a (x - x') modulo n = 0</tt> which only happens when <tt>(x - x')</tt> is a multiple of `n` because `a` and `n` are coprime. Thus if you map a consecutive range of `n` values <tt>x</tt>, you will get `n` distinct values <tt>( a x + b ) modulo n</tt>. The choice of the parameter `a` is critical however: if you set `a` to 1 or 2, even if it is coprime with <tt>n</tt>, the result will not look random.

The running code is ridiculously simple:
```C

    public int getCurrentValue() {
      return ( (long) index * prime + offset ) % ( maxrange);
    }

    public boolean hasNext() {
      return index < maxrange;
    }

    public int next() {
      int answer = getCurrentValue();
      index ++;
      return answer;
    }
```


You can optimize this code by avoiding multiplications and remainder computations:
```C
public int next() {
      runningvalue += prime;
      if(runningvalue >= maxrange) runningvalue -= maxrange;
      index ++;
      // runningvalue == getCurrentValue()) 
      return runningvalue;
}
```


Of course, it is not really random in the sense that no (good) statistician should accept the result as a fair shuffle of the indexes. Still, it might be &ldquo;good enough&rdquo; to fool your colleagues into thinking that it is random.

While my implementation assumes that you are visiting the values in order, you can go back in time, or jump forward and backward arbitrarily.

[I make my Java code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/09/18_2/VisitInDisorder.java). It can be made more elegant, but it should work just fine in your projects.

([As pointed out by Leonid Boytsov, this approach is reminiscent of the Linear congruential generators that are used to produce random numbers](https://en.wikipedia.org/wiki/Linear_congruential_generator).)

If you can find ways to make the result &ldquo;look&rdquo; more random without significantly making it slower and without increasing memory usage, please let us know.

You can find ready-made solutions to visit all values in an array with a power of two number of elements. And by restricting your traversal to the subset of elements in <tt>[0,n)</tt> from a larger virtual array having a power of two size, you will have an alternative to the approach I describe, with the caveat that your main code will require branching. The computational complexity of a call to &ldquo;next&rdquo; becomes <tt>O(n)</tt> whereas I use a small, finite, number of instructions.

__Follow-up__: [Benchmarking algorithms to visit all values in an array in random order](/lemire/blog/2017/09/26/benchmarking-algorithms-to-visit-all-values-in-an-array-in-random-order/)

