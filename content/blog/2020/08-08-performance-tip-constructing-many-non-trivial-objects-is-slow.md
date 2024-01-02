---
date: "2020-08-08 12:00:00"
title: "Performance tip: constructing many non-trivial objects is slow"
---



I started programming professionally when Java came out and right about when C++ was the &ldquo;hot new thing&rdquo;. Following the then-current fashion, I looked down at C and Pascal programming.

I fully embraced object-oriented programming. Everything had to be represented as an object. It was the right thing to do. Like many young (and not so young) programmers, I suffered from [cargo cult programming](https://en.wikipedia.org/wiki/Cargo_cult_programming). There was a new fashion and its advocates were convincing. I became a staunch advocate myself.

When you program in C, allocating and de-allocating dynamic ressources is hard work. Thus you tend to give much consideration to how and when you are going to allocate ressources. More &ldquo;modern&rdquo; languages like Java and C++ have freed us from such considerations. Largely, the trend has continued with a few isolated exceptions.

Over time, I came to recognize one vicious performance anti-pattern that comes with object-oriented programming: the widespread use of small but non-trivial objects. Objects that do a non-trivial amount of work at the beginning or end of their life are &ldquo;non-trivial&rdquo;. For example, arrays and strings with sizes determined at runtime are non-trivial.

The net result is that in many instances, with a few lines of code, you can generate thousands or millions of tiny non-trivial objects. For example, in JavaScript, the JSON.parse function takes an input JSON string (a single string), and maps it into lots and lots of tiny objects. Another example is the programmer who loads a file, line by line, storing each line into a new string instance, and then splits the line into dynamically allocated substrings. These programming strategies are fine as long as they are not used in performance sensitive code.

Let us run a little experiment using a fast programming language (C++). Starting from a long random strings, I am going to randomly generate 100,000 small substrings, having a random length of less than 16 bytes using non-trivial objects (<tt>std::string</tt>). For comparison, I am going to create 100,000 identical small strings using trivial objects (C++17 <tt>std::string_view</tt>). A <tt>std::string_view</tt> is basically just a pointer to a memory region otherwise managed.

How quickly can I copy these strings? [I published the source code of a benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/08/08).

I am expressing the speed in volume per second (GB/s) where the volume is given by the sum of all of the small strings. Your results will vary, but here is what I get under GNU GCC 9 (Linux) with an AMD Rome processor:

non-trivial objects (<tt>std::string</tt>) |0.8 GB/s                 |
-------------------------|-------------------------|
trivial objects (<tt>std::string_view</tt>) |15 GB/s                  |


The <tt>std::string</tt> implementation is likely optimized for handling small strings. If you repeat the same experiment while storing your data in a <tt>std::vector</tt> instance, you may get catastrophic performance.

Though 0.8 GB/s may sound fast, keep in mind that it is the speed to do something trivial (copying the strings). If even the trivial parts of your software are slow, there is no hope that your whole system is going to be fast.

Furthermore, do not expect higher-level languages like Python or JavaScript to do better. The C++ performance is likely a sensible upper bound on how well the approach works.

__Recommendation:__ In performance-sensitive code, you should avoid creating or copying thousands or millions of non-trivial objects.

