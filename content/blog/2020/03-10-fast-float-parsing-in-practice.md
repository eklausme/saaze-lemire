---
date: "2020-03-10 12:00:00"
title: "Fast float parsing in practice"
---



In our work [parsing JSON documents as quickly as possible](https://github.com/lemire/simdjson), we found that one of the most challenging problem is to parse numbers. That is, you want to take the string &ldquo;1.3553e142&rdquo; and convert it quickly to a double-precision floating-point number. You can use the strtod function from the standard C/C++ library, but it is quite slow. People who write fast parsers tend to roll their own number parsers (e.g., RapidJSON, sajson), and so we did. However, we sacrifice some standard compliance. You see, the floating-point standard that we all rely on (IEEE 754) has some hard-to-implement features like &ldquo;round to even&rdquo;. Sacrificing such fine points means that you can be off by one bit when decoding a string. As such, this never matters: double-precision numbers have more accuracy than any engineering project will ever need and a difference on the last bit is irrelevant. Nevertheless, it is mildly annoying.

A better alternative in C++ might be [from_chars](https://en.cppreference.com/w/cpp/utility/from_chars). Unfortunately, many standard libraries have not yet caught up the standard and they fail to support from_chars properly. One can get around this problem by using the [excellent abseil library](https://github.com/abseil/abseil-cpp). It tends to be much faster than venerable [strtod](http://www.cplusplus.com/reference/cstdlib/strtod/) function.

Unfortunately, for our use cases, even abseil&rsquo;s from_chars is much too slow. It can be two or three times slower than our fast-but-imperfect number parser.

I was going to leave it be. Yet Michael Eisel kept insisting that it should be possible to both follow the standard and achieve great speed. Michael gave me an outline. I was unconvinced. And then he gave me a code sample: it changed my mind. The full idea requires a whole blog post to explain, but the gist of it is that we can attempt to compute the answer, optimistically using a fast algorithm, and fall back on something else (like the standard library) as needed. It turns out that for the kind of numbers we find in JSON documents, we can parse 99% of them using a simple approach. All we have to do is correctly detect the error cases and bail out.

Your results will vary, but the next table gives the speed numbers from my home iMac (2017). [The source code is available](https://github.com/lemire/fast_double_parser) along with everything necessary to test it out (linux and macOS).

parser                   |MB/s                     |
-------------------------|-------------------------|
fast_double_parser (new) |660 MB/s                 |
abseil, from_chars       |330 MB/s                 |
double_conversion        |250 MB/s                 |
strtod                   |70 MB/s                  |


