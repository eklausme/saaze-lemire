---
date: "2020-10-28 12:00:00"
title: "What the heck is the value of &#8220;-n % n&#8221; in programming languages?"
---



When coding [efficient algorithms](https://arxiv.org/abs/1805.10941) having to do with hashing, random number generations or even cryptography, a common construction is the expression &ldquo;<tt>-n%n</tt>&ldquo;. My experience has been that it confuses many programmers, so let us examine it further.

To illustrate, <a href="https://github.com/gcc-mirror/gcc/blob/master/libstdc%2B%2B-v3/include/bits/uniform_int_dist.h#L256">let us look at the implementation of <tt>std::uniform_int_distribution</tt> found in the GNU C++ library (Linux) </a> and clean up the line in question:
```C
threshold = -range % range;
```


The percent sign (<tt><span style="color: #808030;">%</span></tt>) in this expression refers to the modulo operation. It returns the remainder of the integer division. To simplify the discussion, let us assume that <tt>range </tt>is strictly positive since dividing by zero causes problems.

We should pay attention to the leading minus sign (<span style="color: #808030;">&#8211;</span>). It is the unary operator that negates a value, and not the subtraction sign. There is a difference between &ldquo;<tt>-range <span style="color: #808030;">%</span> range" </tt>and &ldquo;<tt>0<span style="color: #808030;">-</span>range <span style="color: #808030;">%</span> range"</tt>. They are not at all equivalent. They will actually give you different values; the latter expression is always zero. And that is because of the priority of operation. The negation operation has precedence on the modulo operation which has precedence on the subtraction operation. Thus you can rewrite &ldquo;<tt>-range <span style="color: #808030;">%</span> range" </tt>as &ldquo;(<tt>-range) <span style="color: #808030;">%</span> range"</tt>. And you can write &ldquo;<tt>0<span style="color: #808030;">-</span>range <span style="color: #808030;">%</span> range" </tt>as &ldquo;<tt>0<span style="color: #808030;">- (</span>range <span style="color: #808030;">%</span> range)</tt>&ldquo;.

When the variable `range` is a signed integer, then the expression <tt><span style="color: #808030;">-</span>range <span style="color: #808030;">%</span> range</tt> is zero. In a programming language with only signed integers, like Java, this expression is always zero.

So let us assume that the variable `range` is an unsigned type, as it is meant to be. In such cases, the expression is generally non-zero.

We need to compute <tt>-range. </tt>What does it mean to negate an unsigned value?

When the variable `range` is an unsigned type, Visual Studio is likely to be unhappy at the expression <tt>-range</tt>. A recent Visual Studio returns the following warning:

<tt>warning C4146: unary minus operator applied to unsigned type, result still unsigned</tt>

Nevertheless, I believe that it is [a well defined operation](https://stackoverflow.com/questions/8026694/c-unary-minus-operator-behavior-with-unsigned-operands) in C++, Go and many other programming languages. [Jonathan Adamczewski has a whole blog post](http://brnz.org/hbr/?p=1451) on the topic which suggests that the Visual Studio warning is best explained by a historical deviations from the C++ standard from the Microsoft Visual Studio team. (Note that the current Visual Studio team seems committed to the standards going forward.)

My favorite definition is that &#8211;<tt>range</tt> is defined by `range` + (-<tt>range</tt>) = 0. That is, it is the value such that when you add it to <tt>range</tt>, you get zero. Mathematicians would say that it is the &ldquo;additive inverse&rdquo;. In programming languages (like Go and C++) where unsigned integers wrap around, then there is always one, and only one, additive inverse to every integer value.

You can define this additive inverse without the unary negation: if `max` is the maximum value that you can represent, then you can replace &#8211;<tt>range </tt>by `maximum` &#8211; <tt>range + 1</tt>. Or, maybe more simply, as <tt>(0-range)</tt>. And indeed, [in the Swift programming language, this particular line was represented as follow](https://github.com/apple/swift/blob/aa3e5904f8ba8bf9ae06d96946774d171074f6e5/stdlib/public/core/Random.swift#L111):
```C
      let threshold = (0 &- range) % range
```


The Swift language has two subtraction operations, one that is not allowed to overflow (the usual &lsquo;<tt>-</tt>&lsquo;), and one that is allowed to overflow (&lsquo;<tt>&amp;-</tt>&lsquo;). It is somewhat inconvenient that Swift forces us to write so much code, but we must admit that the result is probably less likely to confuse a good programmer.

In C#, the system will not let you negate an unsigned integer and will instead cast it as a signed integer, so you have to go the long way around if you want to remain in unsigned mode, like so&hellip;
```C
threshold = (uint.MaxValue - scale + 1) % scale
```


This expression is unfortunately type specific (here <tt>uint</tt>).

To conclude: you can learn a lot just by examining one line of code. To put it another way, programming is a much deeper and complex practice than it seems at first. As I was telling a student of mine yesterday: you are not supposed to read new code and understand it right away all of the time.

