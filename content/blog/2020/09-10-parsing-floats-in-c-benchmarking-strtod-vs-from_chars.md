---
date: "2020-09-10 12:00:00"
title: "Parsing floats in C++: benchmarking strtod vs. from_chars"
---



Programmers often need to convert a string into a floating-point numbers. For example, you might get the string &ldquo;3.1416&rdquo; and you would like to get the resulting value as floating-point type.

In C/C++, the standard way is the strtod function:
```C
char * string = "3.1416";
char * string_end = string;
double x = strtod(string, &string_end);
if(string_end == string) { 
  //you have an error!
}
```


Unfortunately, the strtod function is locale-sensitive like many of these string processing functions. It means that it may behaved differently depending on the system where you run the code. However, all runtime libraries appear to have locale-specific functions like strtod_l or _strtod_l (Windows). You can use these locale-specific functions to specify the default locale and thus get functions that behave the same on all systems.

One nice feature of the strtod function is that it gives you back a pointer at the end of the parsed number. In this manner, you can efficiently parse a sequence of comma-separated numbers, for example.

You can also use C++ streams but they are typically not geared toward performance.

In C++17, we got a nicer option: the from_chars function. It works similarly:
```C
std::string st = "3.1416";
double x; 
auto [p, ec] = std::from_chars(st.data(), st.data() + st.size(), x);
if (p == st.data()) {
      //you have an errors!
}
```


The great thing about from_chars is that it is, by definition, locale-independent. Furthermore, it is standardized, so it should be available everywhere. Unfortunately, to my knowledge, the only C++ compiler to come with a fully implemented from_chars function is Visual Studio 2019. And you need to have a recent release.

Indeed, though C++17 has been out for some time, and many compilers claim to fully support it, the runtime libraries need to catch up! You can get independent from_chars implementations, of course, but it would be nice if runtime librairies supported C++17 out of the box.

Still, we should celebrate that Microsoft is doing the right thing and eagerly supporting the latest standards.

I heard good things about the Visual Studio from_chars. And among other things, that it is very fast.

I wanted to know much faster it was. [So I wrote a benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/09/10)! I generate a large number of random values in the [0,1] interval and I record how long it takes to parse them back.

stdtod (C)               |120 MB/s                 |
-------------------------|-------------------------|
from_chars (C++17)       |140 MB/s                 |


You do get a nice 20% performance boost, at no cost whatsoever. Brilliant.

__Further reading__: [Comparing strtod with from_chars (GCC 12)](/lemire/blog/2022/07/27/comparing-strtod-with-from_chars-gcc-12/) 

