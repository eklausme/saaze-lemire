---
date: "2019-08-02 12:00:00"
title: "JSON parsing: simdjson vs. JSON for Modern C++"
---



JSON is the ubiquitous data format on the Internet. There is a lot of JSON that needs to be parsed and validated.

As we just released the latest version of our fast JSON parser ([simdjson](https://github.com/lemire/simdjson)), a reader of this blog asked how it compared in speed against one of the nicest C++ JSON libraries: JSON for Modern C++ ([nlohmann/json](https://github.com/nlohmann/json)).

We have not reported on benchmarks against &ldquo;JSON for Modern C++&rdquo; because we knew that it was not designed for raw speed. It is designed for ease-of-use: it makes the life of the programmer as easy as possible. In contrast, simdjson optimizes for speed, even when it requires a bit more work from the programmer. Nevertheless, it is still interesting to compare speed, to know what your trade-off is.

Let us run some benchmarks&hellip; I use a Skylake processor with GNU GCC 8.3.

file                     |simdjson                 |JSON for Modern C++      |
-------------------------|-------------------------|-------------------------|
apache_builds            |2.3 GB/s                 |0.098 GB/s               |
github_events            |2.5 GB/s                 |0.093 GB/s               |
gsoc-2018                |3.3 GB/s                 |0.091 GB/s               |
twitter                  |2.2 GB/s                 |0.094 GB/s               |


Thus, roughly speaking, simdjson can parse, validate a JSON document and create a DOM tree, at a speed of about 2 GB/s. The easier-to-use &ldquo;JSON for Modern C++&rdquo; has a speed of about 0.1 GB/s, so about 20x slower. As a reference, we can easily read files from disk or the network at speeds higher than 2 GB/s.

Link: [simdjson](https://github.com/lemire/simdjson).

