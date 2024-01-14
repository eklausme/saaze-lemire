---
date: "2021-11-30 12:00:00"
title: "Can you safely parse a double when you need a float?"
---



In C as well as many other programming languages, we have 32-bit and 64-bit floating-point numbers. They are often referred to as `float` and <tt>double</tt>. Most of systems today follow the IEEE 754 standard which means that you can get consistent results across programming languages and operating systems. Hence, it does not matter very much if you implement your software in C++ under Linux whereas someone else implements it in C# under Windows: if you both have recent systems, you can expect identical numerical outcomes when doing basic arithmetic and square-root operations.

When you are reading these numbers from a string, there are distinct functions. In C, you have <tt>strtof</tt> and <tt>strtod</tt>. One parses a string to a `float` and the other function parses it to a <tt>double</tt>.

At a glance, it seems redundant. Why not just parse your string to a `double` value and cast it back to a <tt>float</tt>, if needed?

Of course, that would be slightly more expensive. But, importantly, it is also gives incorrect results in the sense that it is not equivalent to parsing directly to a float. In other words, these functions are not equivalent:
```C
float parse1(const char * c) {
    char * end;
    return strtod(c, &end);
}

float parse2(const char * c) {
    char * end;
    return strtof(c, &end);
}
```


It is intuitive that if I first parse the number as a `float` and then cast it back to a <tt>double</tt>, I will have lost information in the process. Indeed, if I start with the string &ldquo;3.14159265358979323846264338327950&rdquo;, parsed as a `float` (32-bit), I get 3.1415927410125732421875. If I parse it as a double (32-bit), I get the more accurate result 3.141592653589793115997963468544185161590576171875. The difference is not so small, about 9e-08.

In the other direction, first parsing to a `double` and then casting back to a <tt>float</tt>, I can also lose information, although only a little bit due to the double rounding effect. To illustrate, suppose that I have the number 1.48 and that I round it in one go to the nearest integer: I get 1. If I round it first to a single decimal (1.5) and then to the nearest integer, I might get 2 using the usually rounding conventions (either round up, or round to even). Rounding twice is lossy and not equivalent to a single rounding operation. Importantly, you lose a bit of precision in the sense that you may not get back the closest value.
<p style="text-align: left;">With floating-point numbers, I get this effect with the string &ldquo;0.004221370676532388&rdquo; (for example). You probably cannot tell unless you are a machine, but parsing directly to a `float` is 2e-7 % more accurate.

In most applications, such a small loss of accuracy is not relevant. However, if you ever find yourself having to compare results with another program, you may get inconsistent results. It can make debugging more difficult.

Further reading: [Floating-Point Determinism](https://randomascii.wordpress.com/2013/07/16/floating-point-determinism/) ([part of a series](https://randomascii.wordpress.com/category/floating-point/))

