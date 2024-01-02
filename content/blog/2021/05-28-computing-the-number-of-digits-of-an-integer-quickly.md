---
date: "2021-05-28 12:00:00"
title: "Computing the number of digits of an integer quickly"
---



Suppose I give you an integer. How many decimal digits would you need to write it out? The number &lsquo;100&rsquo; takes 3 digits whereas the number &rsquo;99&rsquo; requires only two.

You are effectively trying to compute the integer logarithm in base 10 of the number. I say &lsquo;integer logarithm&rsquo; because you need to round up to the nearest integer.

Computers represent numbers in binary form, so it is easy to count the logarithm in base two. In C using GCC or clang, you can do so as follows using a counting leading zeroes function:
```C
int int_log2(uint32_t x) { return 31 - __builtin_clz(x|1); }
```


Though it looks ugly, it is efficient. Most optimizing compilers on most systems will turn this into a single instruction.

How do you convert the logarithm in base 2 into the logarithm in base 10? From elementary mathematics, we have that log10 (x) = log2(x) / log2(10). So all you need is to divide by log2(10)&hellip; or get close enough. You do not want to actually divide, especially not by a floating-point value, [so you want mutiply and shift instead](https://arxiv.org/abs/2012.12369). Multiplying and shifting is a standard technique to emulate the division.

You can get pretty close to a division by log2(10) if you multiply by 9 and then divide by 32 (2 to the power of 5). The division by a power of two is just a shift. (I initially used a division by a much larger power but readers corrected me.)

Unfortunately, that is not quite good enough because we do not actually have the logarithm in base 2, but rather a truncated version of it. Thus you may need to do a off-by-one correction. The following code works:
```C
    static uint32_t table[] = {9, 99, 999, 9999, 99999, 
    999999, 9999999, 99999999, 999999999};
    int y = (9 * int_log2(x)) >> 5;
    y += x > table[y];
    return y + 1;
```


It might compile to the following assembly:
```C
        or      eax, 1
        bsr     eax, eax
        lea     eax, [rax + 8*rax]
        shr     eax, 5
        cmp     dword ptr [4*rax + table], edi
        adc     eax, 0
        add     eax, 1
```


Loading from the table probably incurs multiple cycles of latency (e.g., 3 or 4). The x64 `bsr` instruction has also a long latency of 3 or 4 cycles. [My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/05/28).

You can port this function to Java as follows if you assume that the number is non-negative:
```C
        int l2 = 31 - Integer.numberOfLeadingZeros(num|1);
        int ans = ((9*l2)>>>5);
        if (num > table[ans]) { ans += 1; }
        return ans + 1;
```


I wrote this blog post to answer a question [by Chris Seaton on Twitter](https://twitter.com/ChrisGSeaton/status/1398312274830495748). After writing it up, I found that the always-brilliant Travis Downs had proposed a similar solution with a table lookup. I believe he requires a larger table. [Robert Clausecker once posted a solution that might be close to what Travis has in mind](https://www.reddit.com/r/C_Programming/comments/k0bgr7/fastest_find_integer_buffer_length/gdh9wrl/).

Furthermore, [if the number of digits is predictable, then you can write code with branches and get better results in some cases](https://quick-bench.com/q/eGtecNEbJdMBivUcFzgenej8SvM). However, you should be concerned with the fact that a single branch miss can cost you 15 cycles and  tens of instructions.

__Update__: There is a followup to this blog post&hellip; [Computing the number of digits of an integer even faster](/lemire/blog/2021/06/03/computing-the-number-of-digits-of-an-integer-even-faster/)

__Further reading__: [Converting binary integers to ASCII character](/lemire/blog/2021/05/17/converting-binary-integers-to-ascii-characters-apple-m1-vs-amd-zen2/) and [Integer log 10 of an unsigned integer — SIMD version](http://0x80.pl/notesen/2014-03-09-simd-int-log-10.html)

__Note__: [Victor Zverovich stated on Twitter than the fmt C++ library relies on a similar approach](https://twitter.com/vzverovich/status/1398369950499180547). [Pete Cawley showed that you could achieve the same result that I got initially by multiplying by 77 and then shifting by 8, instead of my initially larger constants](https://github.com/LuaJIT/LuaJIT/blob/fca488c715fd1592b8840b28e88346f9fb8a93f9/src/lj_strfmt_num.c#L65). He implemented his solution for LuaJIt. Giulietti pointed out to me by email that almost exactly the same routine appears in Hacker&rsquo;s Delight at the end of chapter 11.

