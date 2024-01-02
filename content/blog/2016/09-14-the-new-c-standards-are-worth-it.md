---
date: "2016-09-14 12:00:00"
title: "The new C standards are worth it"
---



The C language is one of the oldest among the popular languages in use today. C is a conservative language.

The good news is that the language is aging well and it has been rejuvenated by the latest standards. The C99 and C11 standards bring many niceties&hellip;

- Fixed-length types such as `uint32_t` for unsigned 32-bit integers.
- A Boolean type called <tt>bool</tt>.
- Actual `inline` functions.
- Support for the `restrict` keyword.
- Builtin support for memory alignment (<tt>stdalign.h</tt>).
- Full support for unicode strings.
- Mixing variable declaration and code.
- Designated initializers (e.g., <tt>Point p = { .x = 0, .y = 0};</tt>).
- Compound literals (e.g., <tt>int y[] = (int []) {1, 2, 3, 4};</tt>).
- Multi-thread support (via <tt>threads.h</tt>).


These changes make the code more portable, easier to maintain and more readable.

The new C standards are also widely supported (<tt>clang</tt>, <tt>gcc</tt>, Intel). This year, Microsoft made it possible to use the clang compiler within Visual Studio which enables compiling [C11-compliant code in Visual Studio](https://github.com/mrboojum/CRoaring4VS).

