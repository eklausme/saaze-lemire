---
date: "2019-12-12 12:00:00"
title: "Are 64-bit random identifiers free from collision?"
---



It is common in software system to map objects to unique identifiers. For example, you might map all web pages on the Internet to a unique identifier.

Often, these identifiers are integers. For example, many people like to use 64-bit integers. If you assign two 64-bit integers at random to distinct objects, the probability of a collision is very, very small. You can be confident that they will not collide.

However, what about the case where you have 300 million objects? Or maybe 7 billion objects? What is the probably that at least two of them collide?

This is just the [Birthday&rsquo;s paradox](https://en.wikipedia.org/wiki/Birthday_problem). Wikipedia gives us an approximation to the collision probability assuming that the number of objects r is much smaller than the number of possible values N: 1-exp(-r**2/(2N)). Because there are so many 64-bit integers, it should be a good approximation.

Number of objects        |Collision probability    |
-------------------------|-------------------------|
500M                     |0.7%                     |
1B                       |3%                       |
1.5B                     |6%                       |
2B                       |10%                      |
4B                       |35%                      |


Thus if you have a large system with many objects, it is quite conceivable that your randomly assigned 64-bit identifiers might collide. If a collision is a critical flaw, you probably should not use only 64 bits.

__Computation (example)__:
```C
>>> r=500000000
>>> N=2**64
>>> ratio = 2*N / r**2
>>> ratio
147.57395258967642
>>> 1-exp(-1/ratio)
0.00675335647472286
```




