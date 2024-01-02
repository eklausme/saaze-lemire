---
date: "2011-08-11 12:00:00"
title: "Fast computation of scalar products, and some lessons in optimization"
---



Given two arrays, say (1,2,3,4) and (4,3,1,5), their scalar product is simply the sum of the products: 1 x 4 + 2 x 3 + 3 x 1 + 4 x 5. It is also known as the inner product or dot product and it is a routine operation in software graphics, database systems and machine learning. Many processors even have instructions to optimize the computation of the scalar product (e.g., the [Multiply-accumulate](https://en.wikipedia.org/wiki/Multiply_accumulate) operation on your iPhone, or the SSE instructions on your desktop).

How can you accelerate the scalar product without using assembly language? First, we should recognize that the main bottleneck might be the multiplications. On most processors, multiplying two numbers is several times more expensive than adding them. For example, 3 CPU cycles could be necessary for a multiplication as opposed to a single cycle for an addition.

Can I somehow reduce the number of required multiplications? To begin with, we can rewrite the scalar product

<code><br/>
v1 x w1 + v2 x w2 + v3 x w3 + v4 x w4<br/>
</code>

as

<code><br/>
(v1+w2)x(v2+w1)+(v3+w4)x(v4+w3)<br/>
- (v1 x v2 + w1 x w2 + v3 x v4 + w3 x w4).<br/>
</code><br/>
Even though it looks like the second form has even more multiplications, you must realize that I can precompute values such as v1 x v2 + v3 x v4. For each one of my array, I can store the product of its successive terms. With this, I can replace the scalar product by (v1+w2)x(v2+w1)+(v3+w4)x(v4+w3) minus the sum of two precomputed quantities.

That is, I have reduced the number of multiplications by half! Can I do better? It turns out that you cannot. To compute scalar products, you need at least half as many multiplications as you have components.

Maybe a more interesting question is: is it faster? If I count one cycle per addition (or subtraction) and three cycles per multiplication, I get 15 cycles for the naive scalar product. My fast alternative uses up only 12 cycles. (Of course, the processor needs to do more than just add and multiply, so I am working off a simplified model.)

But how well does it fare in real life? I wrote a [little test in Java](http://pastebin.com/P0v1tAv0).

- Regular scalar product: 460 ms
- Fast scalar product: 1,314 ms


Wow! Even though the fast version uses half the number of multiplications, it is at least twice as slow! Of course, your results may vary depending on the programming language, your coding skills and your processor. Nevertheless, I could have expected a small gain, and instead I get degraded performance. What is wrong with my mathematical analysis in terms of CPU cycles?

It is fundamentally flawed because modern processors are [superscalar](https://en.wikipedia.org/wiki/Superscalar). It may take 3 cycles to complete a multiplication, but while the multiplication is being computed, other operations can be started. The scalar product is highly parallelizable: while one multiplication is computed, other multiplications can be computed (in parallel).

In some sense, when people contemplate the idea that smart software could automatically parallelize their programs, they should realize that, at a low level, their CPUs are already doing just that! The other take away message is that unless you have a lot of experience as a developer, you are unlikely to accurately predict the result of an optimization.

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

__Further reading__: Winograd, S. (1970) On the number of multiplications necessary to compute certain functions. Comm. Pure Appl. Math, 23, 165–179.

