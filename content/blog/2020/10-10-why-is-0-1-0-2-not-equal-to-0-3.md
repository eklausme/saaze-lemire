---
date: "2020-10-10 12:00:00"
title: "Why is 0.1 + 0.2 not equal to 0.3?"
---



In most programming languages, the value 0.1 + 0.2 differs from 0.3. Let us try it out in Node (JavaScript):
```C
> 0.1 + 0.2 == 0.3
false
```


Yet 1 + 2 is equal to 3.

Why is that? Let us look at it a bit more closely. In most instances, your computer will represent numbers like 0.1 or 0.2 using [binary64](https://en.wikipedia.org/wiki/Double-precision_floating-point_format). In this format, numbers are represented using a 53-bit mantissa (a number between 2<sup>52</sup> and 2<sup>53</sup>) multiplied by a power of two.

When you type 0.1 or 0.2, the computer does not represent 0.1 or 0.2 exactly.

Instead, it tries to find the closest possible value. For the number 0.1, the best match is 7205759403792794 times 2<sup>-56</sup>. It is just slightly larger than 0.1, about 0.10000000000000000555. Importantly, this is a bit larger than 0.1. The compute could have used 7205759403792793 times 2<sup>-56</sup> or 0.099999999999999991 instead, but it is a slightly worse approximation.

For 0.2, the computer will use 7205759403792794 times 2<sup>-55</sup> or about 0.2000000000000000111. Again, this is just slightly larger than than 0.2.

What about 0.3? The compute will use 5404319552844595 times 2<sup>-54</sup>, or approximately 0.29999999999999998889776975, so just under 0.3.

When the computer adds 0.1 and 0.2, it has no longer any idea what the original numbers are. It only has 0.10000000000000000555 and 0.2000000000000000111. When it adds them together, it seeks the best approximation to the sum of these two numbers. It finds, unsurprisingly, the a value just above 0.3 is the best match: 5404319552844596 times 2<sup>-54</sup>, or approximately 0.30000000000000004440.

And that is why 0.1 + 0.2 is not equal to 0.3 in software. When you stream different sequences of approximations, even if the exact values would be equal, there is no reason to expect that your approximations will match.

If you are working a lot with decimals, you can try to rely on another computer type, the decimal. It is much slower, but it would not have this exact problem since it is designed specifically for decimal values:
```C
>>> Decimal(1)/Decimal(10) + Decimal(2)/Decimal(10)
Decimal('0.3')
```


However, decimals have other problems:
```C
>>> Decimal(1)/Decimal(3)*Decimal(3) == Decimal(1)
False
```


What is going on? What can&rsquo;t computers support numbers the way human beings do?

Computers can do computations the way human beings do. For example, [WolframAlpha](https://www.wolframalpha.com) has none of the problems above. Effectively, it gives the impression that it processes values a bit like human beings do. But it is slow.

You may think that computers being so fast, there is really no reason of being inconvenienced at the expense of speed. And that may well be true, but many software projects that start out believing that performance is irrelevant, end up being asked to optimize later. And it can be really difficult to engineer speed back into a system that sacrificed performance at every step.

Speed matters.

[AMD recently released its latest processors (zen3)](https://wccftech.com/amd-zen-3-epyc-milan-cpus-up-to-20-faster-than-zen-2-epyc-rome/). They are expected to be 20% faster than their previous family of processors (zen2). This 20% performance boost is viewed as a remarkable achievement. Going only 20% faster is worth billions of dollars to AMD.

