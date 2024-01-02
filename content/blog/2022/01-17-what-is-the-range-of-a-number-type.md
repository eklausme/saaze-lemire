---
date: "2022-01-17 12:00:00"
title: "What is the `range´ of a number type?"
---



In programming, we often represent numbers using types that have specific ranges. For example, 64-bit signed integer types can represent all integers between -9223372036854775808 and 9223372036854775807, inclusively. All integers inside this range are valid, all integers outside are &ldquo;out of range&rdquo;. It is simple.

What about floating-point numbers? The nuance with floating-point numbers is that they cannot represent all numbers within a continuous range. For example, the real number 1/3 cannot be represented using binary floating-point numbers. So the convention is that given a textual representation, say &ldquo;1.1e100&rdquo;, we seek the closest approximation.

Still, are there ranges of numbers that you should not represent using floating-point numbers? That is, are there numbers that you should reject?

It seems that there are two different interpretation:

- My own interpretation is that floating-point types can represent all numbers from -infinity to infinity, inclusively. It means that &lsquo;infinity&rsquo; or 1e9999 are indeed &ldquo;in range&rdquo;. For 64-bit IEEE floating-point numbers, this means that numbers smaller than 4.94e-324 but greater than 0 can be represented as 0, and that numbers greater than 1.8e308 should be infinity. To recap, all numbers are always in range.
- For 64-bit numbers, another interpretation is that only numbers in the ranges 4.94e-324 to 1.8e308 and -1.8e308 to -4.94e-324, together with exactly 0, are valid. Numbers that are too small (less than 4.94e-324 but greater than 0) or numbers that are larger than 1.8e308 are &ldquo;out of range&rdquo;. Common implementations of the strtod function or of the C++ equivalent follow this convention.


This matters because the C++ specification for the `from_chars` functions state that

> <p dir="auto">If the parsed value is not in the range representable by the type of value, value is unmodified and the member ec of the return value is equal to errc​::​result_­out_­of_­range.



I am not sure programmers have a common understanding of this specification.

