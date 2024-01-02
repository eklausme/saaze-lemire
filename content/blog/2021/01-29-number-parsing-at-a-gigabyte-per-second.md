---
date: "2021-01-29 12:00:00"
title: "Number Parsing at a Gigabyte per Second"
---



Computers typically rely on binary floating-point numbers. Most often they span 64 bits or 32 bits. Many programming languages call them _double_ and <em>float</em>. JavaScript represents all its numbers, by default, with a 64-bit binary floating-point number type.

Human beings most of often represent numbers in decimal notation, such as 0.1 or 1e-1. Thus many systems store numbers in decimal notation using ASCII text. The software must go from binary floating-point numbers to ASCII and back. There has been much work done on the serialization (from binary floating-point numbers to ASCII) but comparatively less work on the deserialization (from ASCII to binary floating-point numbers).

Typically, reading decimal numbers and converting them to binary floating-point numbers is slow. How slow? Often on the order of 200 MB/s. So much slower than your disk, if you have a fast disk. A PlayStation 5 has a disk capable of over 5 GB/s in bandwidth.

You can do much better. I finally published a manuscript that explains a better approach: [Number Parsing at a Gigabyte per Second](https://arxiv.org/pdf/2101.11408.pdf). Do not miss the acknowledgements section of the paper: this was joint work with really smart people.

The benchmarks in the paper are mostly based on the [C++ library fast_float](https://github.com/fastfloat/fast_float). The library requires a C++11 standard compliant compiler. It provides functions that closely emulate the standard [C++ from_chars functions](https://en.cppreference.com/w/cpp/utility/from_chars) for float and double types. It is used by Apache Arrow and Yandex ClickHouse. [It is also part of the fastest Yaml library in the world](https://github.com/biojppm/rapidyaml). These from_char functions are part of the C++17 standard. To my knowledge, only microsoft implemented it at this point: they are not available in GNU GCC.

On my Apple M1 MacBook, using a realistic data file (canada), we get that fast_float can far exceeds a gigabyte per second, and get close to 1.5 GB/s. The conventional C function (strtod) provided by the default Apple standard library does quite poorly on this benchmark.<br/>
<a href="https://lemire.me/blog/wp-content/uploads/2021/01/Screen-Shot-2021-01-30-at-6.51.57-PM.png"><img fetchpriority="high" decoding="async" class="alignnone size-full wp-image-19061" src="https://lemire.me/blog/wp-content/uploads/2021/01/Screen-Shot-2021-01-30-at-6.51.57-PM.png" alt width="612" height="520" srcset="https://lemire.me/blog/wp-content/uploads/2021/01/Screen-Shot-2021-01-30-at-6.51.57-PM.png 612w, https://lemire.me/blog/wp-content/uploads/2021/01/Screen-Shot-2021-01-30-at-6.51.57-PM-300x255.png 300w" sizes="(max-width: 612px) 100vw, 612px" /></a>

What about other programming languages?

A simplified version of the approach is now part of [the Go standard library](https://github.com/golang/go/blob/master/src/strconv/eisel_lemire.go), thanks to Nigel Tao and other great engineers. It accelerated Go processing while helping to provide exact parsing. Nigel Tao has a nice post entitled [The Eisel-Lemire ParseNumberF64 Algorithm](https://nigeltao.github.io/blog/2020/eisel-lemire.html).

What about Rust? There is a [Rust port](https://github.com/aldanor/fast-float-rust/). Unsurprisingly, the Rust version is a match for the C++ version, speed-wise. Here are the results using the same file and the same processor (Apple M1):

from_str (standard)      |130 MB/s                 |
-------------------------|-------------------------|
lexical (popular lib.)   |370 MB/s                 |
fast-float               |1200 MB/s                |


[There is an R binding](https://github.com/eddelbuettel/rcppfastfloat) as well, with the same great results:

> On our machine, <code>fast_float</code> comes out as just over 3 times as fast as the next best alternative (and this counts the function calls and all, so pure parsing speed is still a little bettter).


A C# port is in progress and preliminary results suggest we can beat the standard library by a healthy margin. I am hoping to get a Swift and Java port going this year (help and initiative are invited).

__Video__. Last year, I gave a talk at Go Systems Conf SF 2020 entitled Floating-point Number Parsing w/Perfect Accuracy at GB/sec. [It is on YouTube](https://www.youtube.com/watch?v=AVXgvlMeIm4).

__Further reading__. See my earlier posts&hellip; [Fast float parsing in practice (March 2020 blog post)](/lemire/blog/2020/03/10/fast-float-parsing-in-practice/) and [Multiplying backward for profit (April 2020 blog post)](/lemire/blog/2020/04/05/multiplying-backward-for-profit/).

