---
date: "2019-09-28 12:00:00"
title: "Doubling the speed of std::uniform_int_distribution in the GNU C++ library (libstdc++)"
---



The standard way in C++ to generate a random integer in a range is to call the <tt>std::uniform_int_distribution</tt> function. The current implementation of <tt>std::uniform_int_distribution</tt> in the GNU C++ library (libstdc++) to generate an integer in the interval [0,range] looks as follows.
```C
scaling = random_range / range;
limit = range * scaling;
do
   answer = random;
while ( answer >= limit);
return  answer / scaling;
```


where _random_ generate a 32-bit or 64-bit integer at random. Typically, it requires two divisions by invocation. Even on recent processors, integer division is relatively expensive.

[We can achieve the same algorithmic result with at most one division, and typically no division at all without requiring more calls to the random number generator](https://arxiv.org/abs/1805.10941). [It speeds things up on various systems](/lemire/blog/2019/06/06/nearly-divisionless-random-integer-generation-on-various-systems/). [It was recently added to Swift language](https://github.com/apple/swift/pull/25286).

[Travis Downs suggested that someone should try to fix the GNU C++ implementation](/lemire/blog/2019/06/06/nearly-divisionless-random-integer-generation-on-various-systems/#comment-412365). [So I prepared and submitted a patch](https://www.mail-archive.com/gcc-patches@gcc.gnu.org/msg220766.html). It is currently under review.

The main challenge is that we need to be able to compute the &ldquo;full&rdquo; product. E.g., given two 64-bit integers, we want the 128-bit result; given two 32-bit integers we want the 64-bit result. This is fast on common processors.

The 128-bit product is not natively supported in C/C++ but can be achieved with the `__int128` 128-bit integer extension when it is available. Thankfully, we can check for `__int128` support, and when the support is lacking, we can fall back on another approach. The 128-bit integer extension appears in many compilers (LLMV clang, GNU GCC, Intel icc), but even within a given compiler (say GNU GCC), you cannot rely on the extension being always present, since the compiler implementation might be system specific.

The code I ended up with is somewhat ugly, but it works:
```C
      __product = (unsigned __int128)(__urng() - __urngmin) * __uerange;
      uint64_t __lsb = uint64_t(__product);
      if(__lsb < __uerange)
      {
        uint64_t __threshold = -uint64_t(__uerange) % uint64_t(__uerange);
        while (__lsb < __threshold)
        {
          __product = (unsigned __int128)(__urng() - __urngmin) * __uerange;
          __lsb = uint64_t(__product);
        }
      }
      __ret = __product >> 64;
```


It mostly avoids divisions. I designed a [simple random shuffling benchmark](https://github.com/lemire/simple_cpp_shuffle_benchmark) that mostly just calls <tt>std::shuffle</tt> which, in turn, relies on <tt>std::uniform_int_distribution</tt>. Given an array of one million elements, I get the following timings on a skylake processor with GNU GCC 8.3:

before patch             |15 ns/value              |
-------------------------|-------------------------|
after patch              |8 ns/value               |


For fun, let us compare with the implementation that is present in the Swift standard library:
```C
     var random: T = next()
     var m = random.multipliedFullWidth(by: upperBound)
     if m.low < upperBound {
       let t = (0 &- upperBound) % upperBound
       while m.low < t {
         random = next()
         m = random.multipliedFullWidth(by: upperBound)
       }
     }
     return m.high
```


I think it is more readable in part because the Swift language has built in support for the full multiplication. It is somewhat puzzling that the C++ language does not see fit to make it easy to compute the full product between two integers.

__Update__: [This optimization was merged into libstdc++](https://gcc.gnu.org/git/?p=gcc.git;a=blobdiff;f=libstdc%2B%2B-v3/include/bits/uniform_int_dist.h;h=ecb8574864aee10b9ea164379fffef27c7bdb0df;hp=6e1e3d5fc5fe8f7f22e62a85b35dc8bfa4743372;hb=98c37d3bacbb2f8bbbe56ed53a9547d3be01b66b;hpb=6ce2cb116af6e0965ff0dd69e7fd1925cf5dc68c) by Jonathan Wakely on October 9, 2020.

__Reference__: [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941), ACM Transactions on Modeling and Computer Simulation 29 (1), 2019

