---
date: "2019-10-31 12:00:00"
title: "Parsing numbers in C++: streams, strtod, from_chars"
---



When programming, we often want to convert strings (e.g., &ldquo;1.0e2&rdquo;) into numbers (e.g., 100). In C++, we have many options. [In a previous post](/lemire/blog/2019/10/26/how-expensive-is-it-to-parse-numbers-from-a-string-in-c/), I reported that it is an expensive process when using the standard approach (<tt>streams</tt>).

Many people pointed out to me that there are faster alternatives. In C++, we can use the C approach (e.g., <tt>strtod</tt>). We can also use the `from_chars` function. The net result is slightly more complicated code.
```C
do {
    number = strtod(s, &end);
    if(end == s) break;
    sum += number;
    s = end; 
} while (s < theend);
```


I use long strings (100,000 numbers), and the GNU GCC 8.3 compiler on an Intel Skylake processor.

integers (stream)        |200 MB/s                 |
-------------------------|-------------------------|
integers (<tt>from_chars</tt>) |750 MB/s                 |
floats (stream)          |50 MB/s                  |
floats (<tt>strtod</tt>) |90 MB/s                  |


We see that for integers, the `from_chars` function almost four times faster than the stream approach. Unfortunately my compiler does not support the `from_chars` function when parsing floating-point numbers. However, I can rely on the similar C function (<tt>strtod</tt>). It is nearly twice as fast as the floating-point approach. Even so, it still costs nearly 38 cycles per byte to parse floating-point numbers.

For each floating-point number, there are almost 10 branch misses in my tests, even though I generate numbers using a fixed format. The number of branch misses is nearly the same whether we use a C++ stream or the C function.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/10/30).

