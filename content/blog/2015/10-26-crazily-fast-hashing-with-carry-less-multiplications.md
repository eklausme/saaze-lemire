---
date: "2015-10-26 12:00:00"
title: "Crazily fast hashing with carry-less multiplications"
---



We all know the regular multiplication that we learn in school. To multiply a number by 3, you can multiply a number by two and add it with itself. Programmers write:

<tt>a * 3 = a + (a<<1)</tt>

where <tt>a<<1</tt> means "shift the bit values by one to the left, filling in with a zero". That's a multiplication by two. So a multiplication can be described as a succession of shifts and additions.
But there is another type of multiplication that you are only ever going to learn if you study advanced algebra or cryptography: carry-less multiplication (also called "polynomial multiplication). When multiplying by powers of two, it works the same as regular multiplication. However, when you multiply numbers that are not powers of two, you combine the results with a bitwise exclusive OR (XOR). Programmers like to write "XOR" as "^", so multiplying by 3 in carry-less mode becomes:

<tt>a "*" 3 = a ^ (a<<1)</tt>

where I put the multiplication symbol (*) used by programmers in quotes ("*") to indicate that I use the carry-less multiplication.

Why should you care about carry-less multiplications? It is actually handier than you might expect.

When you multiply two numbers by 3, you would assume that
<tt>a * 3 == b * 3</tt>

is only true if `a` has the same value as <tt>b</tt>. And this works because in an actual computer using 64-bit or 32-bit arithmetic because 3 is coprime with any power of two (meaning that their greatest common factor is 1).
The cool thing about this is that there is an inverse for each odd integer. For example, we have that
<tt>0xAAAAAAAB * 3 == 1.</tt>

Sadly, troubles start if you multiply two numbers by an even number. In a computer, it is entirely possible to have
<tt>a * 4 == b * 4</tt>

without `a` being equal to <tt>b</tt>. And, of course, the number 4 has no inverse.

Recall that a good hash function is a function where different inputs are unlikely to produce the same value. So multiplying by an even number is troublesome.

We can "fix" this up by using the regular arithmetic modulo a prime number. For example, Euler found out that 2<sup>31</sup> -1 (or 0x7FFFFFFF) is a prime number. This is called a Mersenne prime because its value is just one off from being a power of two. We can then define a new multiplication modulo a prime:

<tt>a '*' b = (a * b) % 0x7FFFFFFF.</tt>

With this modular arithmetic, everything is almost fine again. If you have

<tt>a '*' 4 == b '*' 4</tt>

then you know that `a` must be equal to <tt>b</tt>.

So problem solved, right? Well... You carry this messy prime number everywhere. It makes everything more complicated. For example, you cannot work with all 32-bit numbers. Both 0x7FFFFFFF and 0 are zero. We have <tt>0x80000000 == 1</tt> and so forth.

What if there were prime numbers that are powers of two? There is no such thing... when using regular arithmetic... But there are "prime numbers" (called "irreducible polynomials" by mathematicians) that act a bit like they are powers of two when using carry-less multiplications.

With carry-less multiplications, it is possible to define a modulo operation such that
<tt>modulo(a "*" c) == modulo(b "*" c)</tt>

implies <tt>a == b</tt>. And it works with all 32-bit or 64-bit integers.

That's very nice, isn't it?

Up until recently, however, this was mostly useful for cryptographers because computing the carry-less multiplications was slow and difficult.

However, something happened in the last few years. All major CPU vendors have introduced fast carry-less multiplications in their hardware (Intel, AMD, ARM, POWER). What is more, the latest Intel processors (Haswell and better) have a carry-less multiplication that is basically as fast as a regular multiplication, except maybe for a higher latency.

Cryptographers are happy: their fancy 128-bit hash functions are now much faster. But could this idea have applications outside cryptography?

To test the idea out, we created a non-cryptographic 64-bit hash function (CLHash). For good measure, we made it XOR universal: a strong property that ensures your algorithms will behave probabilistically speaking. Most of our functions is a series of carry-less multiplications and bitwise XOR.
It is fast. How fast is it? Let us look at the next table...

CPU cycles per input byte:

&nbsp;                   |64B input                |4kB input                |
-------------------------|-------------------------|-------------------------|
__CLHash__               |__0.45__                 |__0.16__                 |
CityHash                 |0.48                     |0.23                     |
SipHash                  |3.1                      |2.1                      |


That's right: CLHash is much faster that competing alternatives as soon as your strings are a bit large. It can hash 8 input bytes per CPU cycles. You are more likely to run out of memory bandwidth than to wait for this hash function to complete. As far as we can tell, it might be the fastest 64-bit universal hash family on recent Intel processors, by quite a margin.

As usual, the [software is available](https://github.com/lemire/StronglyUniversalStringHashing) under a liberal open source license. There is even a clean [C library](https://github.com/lemire/clhash) with no fuss.

__Further reading__:

- [Faster 64-bit universal hashing using carry-less multiplications](http://arxiv.org/abs/1503.03465), Journal of Cryptographic Engineering 6 (3), 2016.


