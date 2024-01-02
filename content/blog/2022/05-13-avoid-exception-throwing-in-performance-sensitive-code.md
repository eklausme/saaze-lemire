---
date: "2022-05-13 12:00:00"
title: "Avoid exception throwing in performance-sensitive code"
---



There are various ways in software to handle error conditions. In C or Go, one returns error code. Other programming languages like C++ or Java prefer to throw <em>exceptions</em>. One benefit of using exceptions is that it keeps your code mostly clean since the error-handling code is often separate.

It is debatable whether handling exceptions is better than dealing with error codes. I will happily use one or the other.

What I will object to, however, is the use of exceptions for control flow. It is fine to throw an exception when a file cannot be opened, unexpectedly. But you should not use exceptions to branch on the type of a value.

Let me illustrate.

Suppose that my code expects integers to be always positive. I might then have a function that checks such a condition:
```C
int get_positive_value(int x) {
    if(x < 0) { throw std::runtime_error("it is not positive!"); }
    return x;
}
```


So far, so good. I am assuming that the exception is normally never thrown. It gets thrown if I have some kind of error.

If I want to sum the absolute values of the integers contained in an array, the following branching code is fine:
```C
    int sum = 0;
    for (int x : a) {
        if(x < 0) {
            sum += -x;
        } else {
            sum += x;
        }
    }

```


Unfortunately, I often see solutions abusing exceptions:
```C
    int sum = 0;
    for (int x : a) {
        try {
            sum += get_positive_value(x);
        } catch (...) {
            sum += -x;
        }
    }
```


The latter is obviously ugly and hard-to-maintain code. But what is more, it can be highly inefficient. To illustrate, [I wrote a small benchmark over random arrays containing a few thousand elements](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/05/13). I use the LLVM clang 12 compiler on a skylake processor. The normal code is 10000 times faster in my tests!

normal code              |0.05 ns/value            |
-------------------------|-------------------------|
exception                |500 ns/value             |


Your results will differ but it is generally the case that using exceptions for control flow leads to suboptimal performance. And it is ugly too!

