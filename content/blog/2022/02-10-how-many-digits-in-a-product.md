---
date: "2022-02-10 12:00:00"
title: "How many digits in a product?"
---



We often represent integers with digits. E.g., the integer 1234 has 4 digits. By extension, we use &lsquo;binary&rsquo; digits, called bits, within computers. Thus the integer  7 requires three bits: 0b111.

If I have two integers that use 3 digits, say, how many digits will their product have?

Mathematically, we might count the number of digits of an integer using the formula ceil(log(x+1)) where the log is the in the base you are interested in. In base 10, the integers with three digits go from 100 to 999, or from 10<sup>2</sup> to 10<sup>3</sup>-1, inclusively. For example, to compute the number of digits in base 10, you might use the following Python expression <tt>ceil(log10(x+1))</tt>. More generally, an integer has _d_ digits in base b if it is between <em>b</em><sup><em>d</em>-1</sup> and <em>b</em><sup><em>d</em></sup>-1, inclusively. By convention, the integer 0 has no digit in this model.

The product between an integer having d1 digits and integer having <em>d</em><sub>2</sub> digits is between <em>b</em><sup><em>d</em><sub>1</sub>+<em>d</em><sub>2</sub>-2</sup> and <em>b</em><sup><em>d</em><sub>1</sub>+<em>d</em><sub>2</sub></sup>&#8211;<em>b</em><sup><em>d</em><sub>1</sub></sup>&#8211;<em>b</em><sup><em>d</em><sub>2</sub></sup>+1 (inclusively). Thus the product has either <em>d</em><sub>1</sub>+<em>d</em><sub>2</sub>-1 digits or <em>d</em><sub>1</sub>+<em>d</em><sub>2</sub> digits.

To illustrate, let us consider the product between two integers having three digits. In base 10, the smallest product is 100 times 100 or 10,000, so it requires 5 digits. The largest product is 999 times 999 or 998,001 so 6 digits.

Thus if you multiply a 32-bit number with another 32-bit number, you get a number than has at most 64 binary digits. The maximum value will be 2<sup>64</sup> &#8211; 2<sup>33</sup> + 1.

It seems slightly counter-intuitive that the product of two 32-bit numbers does not span the full range of 64-bit numbers because it cannot exceed 2<sup>64</sup> &#8211; 2<sup>33</sup> + 1. A related observation is that any given product may have several possible pairs of 32-bit numbers. For example, the product 4 can be achieved by the multiplication of 1 with 4 or the multiplication of 2 times 2. Furthermore, many other 64-bit values may not be produced from two 32-bit values: e.g., any prime number larger or equal than 2<sup>32</sup> and smaller than 2<sup>64</sup> .

__Further reading__: [Computing the number of digits of an integer even faster](/lemire/blog/2021/06/03/computing-the-number-of-digits-of-an-integer-even-faster/)

