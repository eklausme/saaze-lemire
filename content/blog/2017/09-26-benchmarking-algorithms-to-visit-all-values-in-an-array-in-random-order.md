---
date: "2017-09-26 12:00:00"
title: "Benchmarking algorithms to visit all values in an array in random order"
---



[In an earlier post](/lemire/blog/2017/09/18/visiting-all-values-in-an-array-exactly-once-in-random-order/), I described how to visit all values in an array in a pseudo-random order quite fast. The idea is simple, given an array of size <tt>n</tt>, pick a value `a` that is coprime with <tt>n</tt>. Then for any value of <tt>b</tt>, you have that <tt>(a x + b ) modulo n</tt> will visit all values in <tt>[0,n)</tt> exactly once as `x` goes from `0` to <tt>n</tt>. The word &ldquo;coprime&rdquo; is a fancy way of saying that the two numbers do not have a non-trivial (different from 1) common divisor.

[I published my Java code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/09/18_2/VisitInDisorder.java).

It is nice because you can visit all values while using very little memory and without changing the order of the values in your array.

After some trivial optimization, the resulting code is as simple as this application of the [ternary operator](https://en.wikipedia.org/wiki/%3F:)&hellip;
```C
value = (value + prime < n) ? 
                  value + prime : 
                  value + prime - n;
```


where we initialize `value` to a random number in <tt>[0,n)</tt>, and we set `prime` to be an adequately chosen random number that is coprime with `n` and not too small.

(The ternary operator <tt>x ? y : z</tt> just means: if `x` is true, return `y` otherwise return <tt>z</tt>.)

Though the ternary operator looks like a branch, recent compilers are likely to compile this code, when targeting recent processors, as a conditional move. Though conditional moves used to be slow and generally a bad idea, they are now quite cheap. Very few CPU cycles are needed.

Many readers insisted that I was silly to design a method that fits values in <tt>[0,n)</tt>. All one needs to do is to find the largest power of two larger or equal to `n` (let us call it <tt>2<sup>L</sup></tt>), and then visit all of these values, skipping over up to <tt>n/2</tt> values in the process. 

We have many nice algorithms to visit all values in an interval <tt>[0,n)</tt> exactly once. One approach is to use a [linear congruential generator](https://en.wikipedia.org/wiki/Linear_congruential_generator). (The term linear congruential generator or LCG, is a fancy way to say that you have recursive linear function involving a modulo reduction. There is a bit of non-trivial mathematics from the 1960s involved. Many widely used random number generators rely on an LCG.).

In the end, the code then looks something like this&hellip;
```C
lcg = (a * lcg + 1) & (size2 - 1);
while (lcg >= size) {
      lcg = (a * lcg + 1) & (size2 - 1);
}
```


That is, we move to the next value within <tt>[0,2<sup>L</sup>)</tt>, and must keep hoping to another value, as long as we are outside of <tt>[0,n)</tt>. In the worst case, we may need to hop <tt>n/2</tt> times, so you cannot guarantee that this code has a constant-time complexity. 

More critically, this creates mispredicted branches. Mispredicted branches can cost tens of CPU cycles!

So while it looks like the clever and natural approach, padding your sizes to the nearest power of two has potential downsides.

So what is the performance?

[I rewrote my code in C](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/09/25) because I hate benchmarking in Java. My benchmark takes values from one source array and rewrite them, shuffled, into another array. I record the number of CPU cycles used per cycle. I think that the absolute minimum on an x64 processor would be one cycle, because you cannot store more than one word per cycle. It is an array of integers.

<tt>n</tt>               |fast (<tt>[0,n)</tt>)    |LCG (<tt>[0,2<sup>L</sup>)</tt>, <tt>[0,n)</tt>) |
-------------------------|-------------------------|-------------------------|
3500                     |4.4                      |6.9                      |
24,500                   |4.3                      |12.9                     |
171,500                  |4.1                      |17.6                     |
1,200,500                |4.3                      |23.1                     |
8,403,500                |4.1                      |32.1                     |


Clearly, my weakly random approach is very fast compared to the power-of-two LCG. Interestingly, my approach is consistently fast as the arrays get larger.

What could be causing such a large difference in performance? Thankfully, Linux makes it very easy to measure the number of mispredicted branches. So we can check what happens in this respect with our fast code when the array size grows&hellip;
```C

$ ./run-fast.sh
100
             5,756      branch-misses
1000
             5,550      branch-misses
10000
             6,163      branch-misses
100000
             6,417      branch-misses
1000000
             7,448      branch-misses
10000000
             8,154      branch-misses
100000000
            13,444      branch-misses
```


So the number of mispredicted branches is tiny and grows very slowly. What about the approach that consists in iterating over values in a power-of-two array, using branches to fall back within <tt>[0,n)</tt>?
```C

$ ./run.sh
100
             6,584      branch-misses
1000
             6,481      branch-misses
10000
           315,945      branch-misses
100000
         1,724,468      branch-misses
1000000
         2,519,027      branch-misses
10000000
       374,239,031      branch-misses
100000000
     1,873,408,379      branch-misses
```


It is an entirely different matter. For some large values of <tt>n</tt>, the processor is unable to accurately predict branches. The performance collapses.

I should add that neither of these techniques is likely to generate unbiased random shuffles. If you work for an online casino, please don&rsquo;t use these techniques to shuffle cards. They might be good enough, however, if you need to select randomly where some computing jobs should go.

I should add, also, that we could adapt the LCG so that it directly work in the interval <tt>[0,n)</tt>. This could potentially generate better random numbers. Sadly, while there is well established mathematics to help you find the right parameters so that your recurrence formula visits all values exactly once, I am not aware of equally convenient mathematics that you can apply to get &ldquo;nice randomness&rdquo;.

