---
date: "2023-03-27 12:00:00"
title: "C++20: consteval and constexpr functions"
---



Optimizing compilers seek try to push as much of the computation as possible at compile time. In modern C++, you can declare a function as &lsquo;constexpr&rsquo;, meaning that you state explicitly that the function may be executed at compile time.

The _constexpr_ qualifier is not magical. There may not be any practical difference in practice between an _inline_ function and a _constexpr_ function, as in this example:
```C
inline int f(int x) {
  return x+1;
}

constexpr int fc(int x) {
  return x+1;
}

```


In both cases, the compiler _may_ compute the result at compile time.

The [fast_float C++ library](https://github.com/fastfloat/fast_float) allows you to parsing strings to floating-point numbers at compile time if your compiler supports C++20. Thus you can write the following function which returns either the parsed floating-point value or the number -1.0 in case of error:
```C
constexpr double parse(std::string_view input) {
  double result;
  auto answer = fast_float::from_chars(input.data(),
    input.data()+input.size(), result);
  if(answer.ec != std::errc()) { return -1.0; }
  return result;
}

```


So what happens if you put <tt>parse("3.1416")</tt> in your code? Unfortunately, even at the highest optimization levels, you cannot be certain that the function will be computed at compile time.

Thankfully, C++20 has an another attribute &lsquo;consteval&rsquo; which ensures that the function is evaluated at compile time:
```C
consteval double parse(std::string_view input) {
  double result;
  auto answer = fast_float::from_chars(input.data(),
    input.data()+input.size(), result);
  if(answer.ec != std::errc()) { return -1.0; }
  return result;
}

```


What happens if the parameter of the function cannot be determined at compile time? There should be a compilation error.

With the consteval qualifier, the following two functions should be practically equivalent:
```C
double f1() {
  return parse("3.1416");
}

double f2() {
  return 3.1416;
}
```


You can try it out with [fast_float](https://github.com/fastfloat/fast_float) if you&rsquo;d like.

