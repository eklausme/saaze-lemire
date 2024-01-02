---
date: "2020-02-26 12:00:00"
title: "Fast divisionless computation of binomial coefficients"
---



Suppose that I give you a set of _n_ objects and I ask you to pick _k_ distinct objects, thus forming a new subset. How many such subsets are there? If you have taken college mathematics, you have probably learned that the answer is given by [binomial coefficients](https://en.wikipedia.org/wiki/Binomial_coefficient). They are defined as n!/(k! * (n-k)!) where the exclamation point refers to the factorial. For a programmer, it is easier to think of binomial coefficients as the result of this loop:
```C
def binom(n,k):
    top = 1
    bottom = 1
    for i in 1, 2, ..., k:
        top *= n - i + 1
        bottom *= i
    return top/bottom
```


Though simple enough, this algorithmic definition is not practical if you are interested in performance. Both the numerator and the denominator grow large quickly. They will soon require several machine words. A programming language like Python will happily give you the correct answer, but slowly. In Java or C, you are likely to get the wrong result due to a silent overflow.

Of course, if you know that the binomial coefficient is too large to fit in a machine word (64 bits), then you may as well go to a big-integer library. But what if you know that the result fits in a machine word? Maybe you have a reasonable bound on the size of <em>n</em>.

Then instead of waiting at the very end before doing the division, you can divide at each iteration in the loop:
```C
def binom(n,k):
    answer = 1
    for i in 1, 2, ..., k:
        answer = answer * (n - k + 1) / k
    return answer
```


This new approach may still overflow even if the binomial coefficient itself fits in a machine word because we multiply before dividing. You can get around this issue by first finding a common divisor to both the multiplier and the divisor, and factoring it out. Or else, you can further restrict the values of _n_ and <em>k</em>. Let us choose this last path.

We still have as a problem that we need <em>k-1</em> multiplications and divisions. The multiplications are relatively cheap, but the divisions have longer latencies. We would prefer to avoid divisions entirely. If we assume that _k_ is small, then [we can just use the fact that we can always replace a division by a known value with a shift and a multiplication](https://arxiv.org/abs/1902.01961). All that is needed is that we precompute the shift and the multiplier. If there are few possible values of <em>k</em>, we can precompute it with little effort.

Hence, if you know that, say, _n_ is smaller than 100 and _k_ smaller than 10, the following function will work&hellip;
```C
uint64_t fastbinomial(int n, int k) {
  uint64_t np = n - k;
  uint64_t answer = np + 1;
  for (uint64_t z = 2; z <= (uint64_t)k; z++) {
    answer = answer * (np + z); 
    fastdiv_t f = precomputed[z];
    answer >>= f.shift;
    answer *= f.inverse;
  }
  return answer;
}
```


[I provide a full portable implementation complete with some tests](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/02/26). Though I use C, it should work as-is in many other programming languages. It should only take tens of CPU cycles to run. It is going to be much faster than implementations relying on divisions.

Another trick that you can put to good use is that the binomial coefficient is symmetric: you can replace _k_ by <em>n</em>&#8211;<em>k</em> and get the same value. Thus if you can handle small values of <em>k</em>, you can also handle values of _k_ that are close to <em>n</em>. That is, the above function will also work for _n_ is smaller than 100 and _k_ larger than 90, if you just replace _k_ by <em>n</em>&#8211;<em>k</em>.

Is that the fastest approach? Not at all. Because _n_ is smaller than 100 and _k_ smaller than 10, we can precompute (memoize) all possible values. You only need an array of 1000 values. It should fit in 8kB without any attempt at compression. And I am sure you can make it fit in 4kB with a little bit of compression effort. Still, there are instances where relying on a precomputed table of several kilobytes and keeping them in cache is inconvenient. In such cases, the divisionless function would be a good choice.

Alternatively, if you are happy with approximations, you will find floating-point implementations.

