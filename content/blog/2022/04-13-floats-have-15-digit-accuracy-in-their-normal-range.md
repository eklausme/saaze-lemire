---
date: "2022-04-13 12:00:00"
title: "Floats have 15-digit accuracy in their normal range"
---



In programming languages like JavaScript or Python, numbers are typically represented using 64-bit IEEE number types (binary64). For these numbers, we have 15 digits of accuracy. It means that you can pick a 15-digit number, such as 1.23456789012345e100 and it can be represented exactly: there exists a floating-point number that has exactly these 15-most significant digits. In this particular case, it is the number 6355009312518497 * 2<sup>280</sup>. Having 15-digit of accuracy is excellent: few engineering processes can ever exceed this accuracy.

This 15-digit accuracy fails for numbers that outside the valid range. For example, the number 1e500 is too large and cannot be directly represented using standard 64-bit floating-point numbers. Similarly, 1e-500 is too small and it can only be represented as zero.

[The range of 64-bit floating-point number](/lemire/blog/2022/01/17/what-is-the-range-of-a-number-type/) might be defined as going from 4.94e-324 to 1.8e308 and -1.8e308 to -4.94e-324, together with exactly 0. However, this range includes subnormal numbers where the relative accuracy can be small. For example, the number 5.00000000000000e-324 is best represented as 4.94065645841247e-324, meaning that we have zero-digit accuracy.

For the 15-digit accuracy rule to work, you might remain in the normal range, e.g., from 2.225e−308 to 1.8e308 and -1.8e308 to -2.225e−308. There are other good reasons to remain in the normal range, such as poor performance and low accuracy in the subnormal range.

To summarize, standard floating-point numbers have excellent accuracy (at least 15 digits) as long you remain in their normal range which is between 2.225e−308 to 1.8e308 for positive numbers.

