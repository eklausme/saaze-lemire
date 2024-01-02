---
date: "2019-02-08 12:00:00"
title: "Faster remainders when the divisor is a constant: beating compilers and libdivide"
---



Not all instructions on modern processors cost the same. Additions and subtractions are cheaper than multiplications which are themselves cheaper than divisions. For this reason, compilers frequently replace division instructions by multiplications. Roughly speaking, it works in this manner. Suppose that you want to divide a variable `n` by a constant <tt>d</tt>. You have that <tt>n/d</tt> = `n` <tt>*</tt> (2<sup>N</sup>/<tt>d</tt>) <tt>/</tt> (2<sup>N</sup>). The division by a power of two (<tt>/</tt> (2<sup>N</sup>)) can be implemented as a right shift if we are working with unsigned integers, which compiles to single instruction: that is possible because the underlying hardware uses a base 2. Thus if 2<sup>N</sup>/<tt>d</tt> has been precomputed, you can compute the division <tt>n/d</tt> as a multiplication and a shift. Of course, if `d` is not a power of two, 2<sup>N</sup>/<tt>d</tt> cannot be represented as an integer. Yet for `N` large enough<sup>[footnote](#footnote123)</sup>, we can approximate 2<sup>N</sup>/<tt>d</tt> by an integer and have the exact computation of the remainder for all possible `n` within a range. I believe that all optimizing C/C++ compilers know how to pull this trick and it is generally beneficial irrespective of the processor&rsquo;s architecture.

The idea is not novel and goes back to at least 1973 (Jacobsohn). However, engineering matters because computer registers have finite number of bits, and multiplications can overflow. I believe that, historically, this was first introduced into a major compiler (the GNU GCC compiler) by [Granlund and Montgomery (1994)](https://dl.acm.org/citation.cfm?id=178249). While GNU GCC and the Go compiler still rely on the approach developed by Granlund and Montgomery, other compilers like LLVM&rsquo;s clang use a slightly improved version described by [Warren in his book Hacker&rsquo;s Delight](https://www.amazon.com/Hackers-Delight-2nd-Henry-Warren/dp/0321842685/).

What if `d` is a constant, but not known to the compiler? Then you can use a library like [libdivide](https://libdivide.com). In some instances, libdivide can even be more efficient than compilers because it uses an approach introduced by [Robison (2005)](https://www.computer.org/csdl/proceedings/arith/2005/2366/00/23660131-abs.html) where we not only use multiplications and shifts, but also an addition to avoid arithmetic overflows.

Can we do better? It turns out that in some instances, we can beat both the compilers and a library like libdivide.

Everything I have described so far has to do with the computation of the quotient (<tt>n/d</tt>) but quite often, we are looking for the remainder (noted <tt>n % d</tt>). How do compilers compute the remainder? They first compute the quotient <tt>n/d</tt> and then they multiply it by the divisor, and subtract all of that from the original value (using the identity <tt>n % d = n - (n/d) * d</tt>).

Can we take a more direct route? We can.

Let us go back to the intuitive formula <tt>n/d</tt> = `n` <tt>*</tt> (2<sup>N</sup>/<tt>d</tt>) <tt>/</tt> (2<sup>N</sup>). Notice how we compute the multiplication and then drop the least significant `N` bits? It turns out that if, instead, we keep these least significant bits, and multiply them by the divisor, we get the remainder, directly without first computing the quotient.

The intuition is as follows. To divide by four, you might choose to multiply by 0.25 instead. Take 5 * 0.25, you get 1.25. The integer part (1) gives you the quotient, and the decimal part (0.25) is indicative of the remainder: multiply 0.25 by 4 and you get 1, which is the remainder. Not only is this more direct and potential useful in itself, it also gives us a way to check quickly whether the remainder is zero. That is, it gives us a way to check that we have an integer that is divisible by another: do <tt>x * 0.25</tt>, the decimal part is less than 0.25 if and only if `x` is a multiple of 4.

This approach was known to Jacobsohn in 1973, but as far as I can tell, he did not derive the mathematics. Vowels in 1994 worked it out for the case where the divisor is 10, but (to my knowledge), nobody worked out the general case. It has now been worked out in a paper to appear in Software: Practice and Experience called [Faster Remainder by Direct Computation](https://arxiv.org/abs/1902.01961).

In concrete terms, here is the C code to compute the remainder of the division by some fixed divisor <tt>d</tt>:
```C
uint32_t d = ...;// your divisor > 0

uint64_t c = UINT64_C(0xFFFFFFFFFFFFFFFF) / d + 1;

// fastmod computes (n mod d) given precomputed c
uint32_t fastmod(uint32_t n ) {
  uint64_t lowbits = c * n;
  return ((__uint128_t)lowbits * d) >> 64; 
}
```


The divisibility test is similar&hellip;
```C
uint64_t c = 1 + UINT64_C(0xffffffffffffffff) / d;


// given precomputed c, checks whether n % d == 0
bool is_divisible(uint32_t n) {
  return n * c <= c - 1; 
}
```


To test it out, we did many things, but in one particular tests, we used a hashing function that depends on the computation of the remainder. We vary the divisor and compute many random values. In one instance, we make sure that the compiler cannot assume that the divisor is known (so that the division instruction is used), in another case we let the compiler do its work, and finally we plug in our function. On a recent Intel processor (Skylake), we beat state-of-the-art compilers (e.g., LLVM&rsquo;s clang, GNU GCC).

<a href="https://lemire.me/blog/wp-content/uploads/2019/02/hashbenches-skylake-clang.png"><img decoding="async" class="alignnone size-medium wp-image-17128" src="https://lemire.me/blog/wp-content/uploads/2019/02/hashbenches-skylake-clang-300x180.png" alt width="80%" srcset="https://lemire.me/blog/wp-content/uploads/2019/02/hashbenches-skylake-clang-300x180.png 300w, https://lemire.me/blog/wp-content/uploads/2019/02/hashbenches-skylake-clang.png 750w" sizes="(max-width: 300px) 100vw, 300px" /></a>

The computation of the remainder is nice, but I really like better the divisibility test. Compilers generally don&rsquo;t optimize divisibility tests very well. A line of code like <tt>(n % d) = 0</tt> is typically compiled to the computation of the remainder (<tt>(n % d)</tt>) and a test to see whether it is zero. Granlund and Montgomery have a better approach if `d` is known ahead of time and it involves computing the inverse of an odd integer using Newton&rsquo;s method. Our approach is simpler and faster (on all tested platforms) in our tests. It is a multiplication by a constant followed by a comparison of the result with said constant: it does not get much cheaper than that. It seems that compilers could easily apply such an approach.

[We packaged the functions as part of a header-only library](https://github.com/lemire/fastmod) which works with all major C/C++ compilers (GNU GCC, LLVM&rsquo;s clang, Visual Studio). [We also published our benchmarks](https://github.com/lemire/constantdivisionbenchmarks) for research purposes.

I feel that the paper is short and to the point. There is some mathematics, but we worked hard so that it is as easy to understand as possible. And don&rsquo;t skip the introduction! It tells a nice story.

The paper contains carefully crafted benchmarks, but I came up with a fun one for this blog post which I call &ldquo;fizzbuzz&rdquo;. Let us go through all integers in sequence and count how many are divisible by 3 and how many are divisible by 5. There are far more efficient ways to do that, but here is the programming 101 approach in C:
```C
  for (uint32_t i = 0; i < N; i++) {
    if ((i % 3) == 0)
      count3 += 1;
    if ((i % 5) == 0)
      count5 += 1;
  }
```


Here is the version with our approach:
```C
static inline bool is_divisible(uint32_t n, uint64_t M) {
  return n * M <= M - 1;
}

...


  uint64_t M3 = UINT64_C(0xFFFFFFFFFFFFFFFF) / 3 + 1;
  uint64_t M5 = UINT64_C(0xFFFFFFFFFFFFFFFF) / 5 + 1;
  for (uint32_t i = 0; i < N; i++) {
    if (is_divisible(i, M3))
      count3 += 1;
    if (is_divisible(i, M5))
      count5 += 1;
  }
```


Here is the number of CPU cycles spent on each integer checked (average):

Compiler                 |4.5 cycles per integer   |
-------------------------|-------------------------|
Fast approach            |1.9 cycles per integer   |


[I make my benchmarking code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/02/08). For this test, I am using an Intel (skylake) processing and GCC 8.1.

Your results will vary. Our proposed approach may not always be faster. However, we can claim that some of time, it is advantageous.

__Update__: There is a [Go library](https://github.com/bmkessler/fastdiv) implementing this technique.

__Further reading__: [Faster Remainder by Direct Computation: Applications to Compilers and Software Libraries](https://arxiv.org/abs/1902.01961), Software: Practice and Experience 49 (6), 2019.

<a name="footnote123"></a>__Footnote__: What is <tt>N</tt>? If both the numerator `n` and the divisor `d` are 32-bit unsigned integers, then you can pick <tt>N=64</tt>. This is not the smallest possible value. [The smallest possible value is given by Algorithm 2 in our paper](https://arxiv.org/abs/1902.01961) and it involves a bit of mathematics (note: the notation in my blog post differs from the paper, `N` becomes <tt>F</tt>).

__Follow-up blog post__: [More fun with fast remainders when the divisor is a constant](/lemire/blog/2019/02/20/more-fun-with-fast-remainders-when-the-divisor-is-a-constant/) (where I discuss finer points)

