---
date: "2022-11-17 12:00:00"
title: "Rounding modes: std::from_chars versus strtod/strtof"
---



A recent C++ standard (C++17) introduced new functions to parse floating-point numbers <tt>std::from_chars</tt>, from strings (e.g., ASCII text) to binary numbers. How should such a function parse values that cannot be represented exactly? The specification states that the resulting value rounded to nearest. This means that 1.0000000000000000001 and 0.999999999999999999 become exactly 1.0.

The C language has its own functions (<tt>strtod</tt>/<tt>strtof</tt>). I could not find a reference in the standard as to how it should round, but the source code suggests that the functions round according to the current floating-point rounding mode, as determined by the <tt>fegetround()</tt> function. One can round toward zero, up, down or to nearest. [I wrote a small command-line utility](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/17) to test it out. And indeed, I get the following results under LLVM and GCC:

string                   |UPWARD                   |DOWNWARD                 |TONEAREST                |
-------------------------|-------------------------|-------------------------|-------------------------|
1.0000000000000000001    |1.00001                  |1.0                      |1.0                      |
0.999999999999999999     |1.0                      |0.999999                 |0.999999                 |


Thus you cannot assume that, in general, <tt>std::from_chars</tt> will agree with <tt>strtod</tt>/<tt>strtof</tt> even for just boring strings such as 0.999999999999999999.

Thankfully, [you can check the rounding mode efficiently](/lemire/blog/2022/11/16/a-fast-function-to-check-your-floating-point-rounding-mode/).

