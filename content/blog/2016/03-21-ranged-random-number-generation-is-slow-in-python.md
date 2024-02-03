---
date: "2016-03-21 12:00:00"
title: "Ranged random-number generation is slow in Python&#8230;"
---



A colleague has been running simulations using a library written in Python. She was having serious performance problems&hellip; Her application is parallelizable, but Python does not make parallelization easy. She could switch to another language, but that&rsquo;s expensive.

Further investigations reveal that her simulation relies heavily on random-number generation. Every little step involves a random number. So how good is Python at generating random numbers?

Python has a nice framework to quickly benchmark functions: the `timeit` module.

How fast is the Python random-number generator?

<code>$ python -m timeit -s 'import random' '<span style="color:red">random.random()</span>'<br/>
10000000 loops, best of 3: <span style="color:blue">0.0363 usec</span> per loop</code>

So over 100 CPU cycles to generate one random floating point numbers. However, `timeit` includes an overhead of about 30 cycles or so to every operation, related to the function-call overhead. It is not unreasonable.

What if you want to generate an integer in a range [0,1000]? It gets ugly.

<code>$ python -m timeit -s 'import random' '<span style="color:red">random.randint(0,1000)</span>'<br/>
1000000 loops, best of 3: <span style="color:blue">0.847 usec</span> per loop</code>

Wow! We are now taking over 2000 CPU cycles per random integer. This can easily becoming a limiting factor when writing simulation code. I tried to read Python&rsquo;s source code for <tt>random.randint</tt>, but I could not figure out quickly what it is doing.

If we accept a very small (negligible) bias, we can do it by multiplication instead&hellip;

<code>$ python -m timeit -s 'import random' '<span style="color:red">int(random.random() * 1001)</span>'<br/>
1000000 loops, best of 3: <span style="color:blue">0.206 usec</span> per loop</code>

We are down to 400 CPU cycles per integer. It is still a lot&hellip; but it is four times faster to avoid Python&rsquo;s default API (<tt>random.randint</tt>).

The nice thing with Python is that it is easy to write a C function and access it from Python. Of course, it comes with some significant overhead. I do not hope to use far fewer than 100 cycles per random value by calling a C function. However, the ranged random-number generators are expensive enough that a C function might help. So I took a simple function in C that generates a good-quality (unbiased) ranged random number and made it available to Python:

<code>$python -m timeit -s 'import fastrand' '<span style="color:red">fastrand.pcg32bounded(1001)</span>'<br/>
10000000 loops, best of 3: <span style="color:blue">0.0693 usec</span> per loop</code>

That is about 10 times faster than Python&rsquo;s native <tt>random.randint</tt>.

The lesson is that <tt>random.randint</tt> should probably not be used in performance-sensitive code.

[My source code is available](https://github.com/lemire/fastrand) (Python and C).

__Update__: Marcel Ball reports in the comments that this performance problem does not affect PyPy, only the regular Python. David Andersen points out that using the numpy library via <tt>python -m timeit -s 'import numpy' 'numpy.random.randint(0, 1000)'</tt> is much faster though my own tests do not quite agree.

__Further reading__: Daniel Lemire, [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941), ACM Transactions on Modeling and Computer Simulation (to appear)

__Credit__: This blog post benefited from an exchange with Nathan Kurz.

