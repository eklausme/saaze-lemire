---
date: "2022-07-27 12:00:00"
title: "Comparing strtod with from_chars (GCC 12)"
---



A reader (Richard Ebeling) invited me to revisit an older blog post: [Parsing floats in C++: benchmarking strtod vs. from_chars](/lemire/blog/2020/09/10/parsing-floats-in-c-benchmarking-strtod-vs-from_chars/). Back then I reported that switching from strtod to from_chars in C++ to parse numbers could lead to a speed increase (by 20%). The code is much the same, we go from&hellip;
```C
char * string = "3.1416";
char * string_end = string;
double x = strtod(string, &string_end);
if(string_end == string) { 
  //you have an error!
}
```


&hellip; to something more modern in C++17&hellip;
```C
std::string st = "3.1416";
double x; 
auto [p, ec] = std::from_chars(st.data(), st.data() + st.size(), x);
if (p == st.data()) {
      //you have errors!
}
```


Back when I first reported on this result, only Visual Studio had support for from_chars. The C++ library in GCC 12 now has full support for from_chars. [Let us run the benchmark again](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/09/10):

strtod                   |270 MB/s                 |
-------------------------|-------------------------|
from_chars               |1 GB/s                   |


So it is almost four times faster! The benchmark reads random values in the [0,1] interval.

Internally, GCC 12 adopted [the fast_float library](https://github.com/fastfloat/fast_float).

__Further reading__: [Number Parsing at a Gigabyte per Second](https://arxiv.org/abs/2101.11408), Software: Pratice and Experience 51 (8), 2021.

