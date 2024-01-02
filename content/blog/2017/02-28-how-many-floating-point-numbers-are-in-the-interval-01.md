---
date: "2017-02-28 12:00:00"
title: "How many floating-point numbers are in the interval [0,1]?"
---



Most commodity processors support [single-precision IEEE 754 floating-point numbers](https://en.wikipedia.org/wiki/Single-precision_floating-point_format). Though they are ubiquitous, they are often misunderstood.

[One of my readers left a comment](/lemire/blog/2016/06/27/a-fast-alternative-to-the-modulo-reduction/#comment-273466) suggesting that picking an integer in [0,2<sup>32</sup>) at random and dividing it by 2<sup>32</sup>, was equivalent to picking a number at random in [0,1). I am not assuming that the reader in question made this inference, but it is a tempting one.

That&rsquo;s certainly &ldquo;approximately true&rdquo;, but we are making an error when doing so. How much of an error?

Floating-point numbers are represented as sign bit, a mantissa and an exponent as follows:

- There is a single sign bit. Because we only care about positive number, this bit is fixed and can be ignored.
- The mantissa is straight-forward: 23 bits. It is implicitly preceded by the number 1.
- There are eight bits dedicated to the exponent. It is pretty much straight-forward, as long as the exponents range from -126 to 127. Otherwise, you get funny things like infinity, not-a-number, denormal numbers&hellip; and zero. To represent zero, you need an exponent value of -127 and zero mantissa.


So how many &ldquo;normal&rdquo; non-zero numbers are there between 0 and 1? The negative exponents range from -1 all the way to -126. In each case, we have 2<sup>23</sup> distinct floating-point numbers because the mantissa is made of 23 bits. So we have 126 x 2<sup>23</sup> normal floating-point numbers in [0,1). If you don&rsquo;t have a calculator handy, that&rsquo;s 1,056,964,608. If we want to add the number 1, that&rsquo;s 126 x 2<sup>23</sup> + 1 or 1,056,964,609.

Most people would consider zero to be a &ldquo;normal number&rdquo;, so maybe you want to add it too. Let us make it 1,056,964,610.

There are 4,294,967,296 possible 32-bit words, so about a quarter of them are in the interval [0,1]. Isn&rsquo;t that interesting? Of all the float-pointing point numbers your computer can represent, a quarter of them lie in [0,1]. By extension, half of the floating-point numbers are in the interval [-1,1].

So already we can see that we are likely in trouble. The number 2<sup>32</sup> is not divisible by 1,056,964,610, so we can&rsquo;t take a 32-bit non-negative integer, divide it by 2<sup>32</sup> and hope that this will generate a number in [0,1] in an unbiased way.

How much of a bias is there? We have a unique way of generating the zero number. Meanwhile, there are 257 different ways to generate 0.5: any number in between 2,147,483,584 and 2,147,483,776 (inclusively) gives you 0.5 when divided by the floating-point number 2<sup>32</sup>.

A ratio of 1 to 257 is a fairly sizeable bias. So chances are good that your standard library does not generate random numbers in [0,1] in this manner.

How could you get an unbiased map?

We can use the fact that the mantissa uses 23 bits. This means in particular that you pick any integer in [0,2<sup>24</sup>), and divide it by 2<sup>24</sup>, then you can recover your original integer by multiplying the result again by 2<sup>24</sup>. This works with 2<sup>24</sup> but not with 2<sup>25</sup> or any other larger number.

So you can pick a random integer in [0,2<sup>24</sup>), divide it by 2<sup>24</sup> and you will get a random number in [0,1) without bias&hellip; meaning that for every integer in [0,2<sup>24</sup>), there is one and only one number in [0,1). Moreover, the distribution is uniform in the sense that the possible floating-point numbers are evenly spaced (the distance between them is a flat 2<sup>-24</sup>).

So even though single-precision floating-point numbers use 32-bit words, and even though your computer can represent about 2<sup>30</sup> distinct and normal floating-point numbers in [0,1), chances are good that your random generator only produces 2<sup>24</sup> distinct floating-point numbers in the interval [0,1).

For most purposes, that is quite fine. But it could trip you up. A common way to generate random integers in an interval [0,<em>N</em>) is to first generate a random floating-point number and then multiply the result by <em>N</em>. That is going to be fine as long as _N_ is small compared to 2<sup>24</sup>, but should _N_ exceeds 2<sup>24</sup>, then you have a significant bias as you are unable to generate all integers in the interval [0,<em>N</em>).

I did my analysis using 32-bit words, but it is not hard to repeat it for 64-bit words and come to similar conclusions. Instead of generating 2<sup>24</sup> distinct floating-point numbers in the interval [0,1], you would generate 2<sup>53</sup>.

__Further reading__: The [nextafter function](http://en.cppreference.com/w/cpp/numeric/math/nextafter) and [Uniform random floats: How to generate a double-precision floating-point number in [0, 1] uniformly at random given a uniform random source of bits](http://mumble.net/~campbell/2014/04/28/uniform-random-float).

