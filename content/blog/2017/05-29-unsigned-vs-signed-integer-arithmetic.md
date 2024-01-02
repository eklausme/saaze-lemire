---
date: "2017-05-29 12:00:00"
title: "Unsigned vs. signed integer arithmetic"
---



Given any non-negative integers `x` and <tt>d</tt>, we can write uniquely <tt>x = q d + r</tt> where `q` (the quotient) and `r` (the remainder) are non-negative and `r` is less than <tt>d</tt>. We write <tt>r = x mod d</tt>.

Most modern processors represent signed and unsigned integers in the following manner:

- Unsigned integers as simply 32-bit or 64-bit binary numbers. E.g., we write the number 15 as <tt>0b0...01111</tt>. Programmers write bits from right to left, starting with the least significant bits: the right-most bit has value 1, the second right-most bit has value 2, and so forth.

We have to worry about overflows: e.g., when adding two 32-bit integers that won&rsquo;t fit in 32 bits. What happens if there is an overflow? How your programming language handles it is one thing, but processors often make it easy to compute the operations &ldquo;modulo the word size&rdquo;. This means that <tt>x + y</tt> is the same as <tt>(x + y) mod 2<sup>w</sup> </tt> where `w` is the word size in bits (typically 32 or 64).

Dividing by two can be achieved by &ldquo;right-shifting&rdquo; the bits by 1. Multiplying by two is equivalent to &ldquo;left-shifting&rdquo; the bits by 1.
- Signed integers are implemented at the processor level in a manner similar to unsigned integers, using something called [Two&rsquo;s complement](https://en.wikipedia.org/wiki/Two%27s_complement). We can think about Two&rsquo;s complement as a way of mapping signed values to unsigned (binary) values. Positive values (in [0,2<sup>w-1</sup>)) are mapped to themselves (m(<tt>x</tt>)= <tt>x</tt>) whereas negative values (in [-2<sup>w-1</sup>, -1]) are mapped to the complement (m(<tt>x</tt>)= 2<sup>w</sup>&#8211;<tt>x</tt>).

You can distinguish negative integers from positive integers since their left-most bit is set to true. That&rsquo;s convenient.

Programmers prefer to say that we can negate a number by flipping all its bits (sometimes called &ldquo;one&rsquo;s complement&rdquo;) and adding the value one. You can verify that if you take a number, flip all its bits and add the original number, you get a binary value with all the bits set to 1, or 2<sup>w</sup>-1. So the result follows by inspection but I prefer my formulation (m(<tt>x</tt>)= 2<sup>w</sup>&#8211;<tt>x</tt>) as it makes the mathematics clearer.


A fun problem with Two&rsquo;s complement is that you have more negative numbers than you have positive (non-zero) numbers. This means that taking the absolute number of a signed integer is a bit tricky and may lead to an overflow. Thus we cannot do something like <tt>a/b = sign(b) * a / abs(b)</tt> or <tt>a * b = sign(a) * sign(b) * abs(a) * abs(b) </tt> since there is no safe absolute-value function. 

The nice thing with Two&rsquo;s complement is that because the processor implements unsigned integer arithmetic modulo a power of two (e.g., <tt>(x + y) mod 2<sup>w</sup> </tt>), then you &ldquo;almost&rdquo; get the signed arithmetic for free. Indeed, suppose that I want to add two values `x` and `y` but that one of them (<tt>y</tt>) is negative. Then I first apply my map to transform them into unsigned values (<tt>y</tt> becomes <tt>2<sup>w</sup>-y</tt>), and I end up with <tt>x + 2<sup>w</sup>-y mod 2<sup>w</sup> </tt> which is just <tt>x - y mod 2<sup>w</sup></tt> as one would expect. 

So we get that multiplications (including right shifts), additions, and subtractions are nearly identical operations whether you have signed or unsigned integers. 

This means that a language like Java can avoid unsigned integers for the most part. Signed and unsigned integers more or less work the same.

When you program in assembly, it is not quite true. For example, on x86 processors, the [MUL](http://x86.renejeschke.de/html/file_module_x86_id_210.html) (unsigned multiplication) and [IMUL](https://c9x.me/x86/html/file_module_x86_id_138.html) (signed multiplication) instructions are quite different. However, as long as you only care for the multiplication modulo the word size, you can probably use them interchangeably: a critical difference is that the unsigned multiplication actually compute the full result of the multiplication, using another word-sized register to store the more significant bits. Other processors (e.g., ARM) work slightly differently, of course, but the need to distinguish between signed and unsigned integers still arise from time to time.

The division, remainder and right shifts are something else entirely.

Let us divide by two. The value -2 is mapped to <tt>0b111...10</tt>. With unsigned arithmetic, we would simply shift all bits right by one, to get <tt>0b0111...1</tt>, but that&rsquo;s no longer a negative value in Two&rsquo;s complement notation! So when we shift right signed integers, we typically replicate the left-most bit, so that we go from <tt>0b111...10</tt> to <tt>0b111...11</tt>.

This works well as long as we only have negative even numbers, but let us consider a negative odd number like -1. Then doing the signed right shift trick, we go from <tt>0b111...11</tt> to <tt>0b111...11</tt>, that is <tt>(-1>>1)</tt> is <tt>-1</tt>. It is not entirely unreasonable to define -1/2 as -1. That&rsquo;s called &ldquo;rounding toward -infinity&rdquo;. However, in practice people seem to prefer to round toward zero so that -1/2 is 0. 

The net result is that whereas division by two of unsigned integers is implemented as a single shift, the division by two of signed integers ends up taking up a handful of instructions.

