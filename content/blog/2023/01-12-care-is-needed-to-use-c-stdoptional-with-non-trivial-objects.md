---
date: "2023-01-12 12:00:00"
title: "Care is needed to use C++ std::optional with non-trivial objects"
---



We often have to represent in software a value that might be missing. Different programming languages have abstraction for this purpose.

A recent version of C++ (C++17) introduces std::optional templates. It is kind of neat. You can write code that prints a string, or a warning if no string is available as follows:
```C
void f(std::optional<std::string> s) {
  std::cout << s.value_or("no string") << std::endl;
}
```


I expect std::optional to be relatively efficient when working with trivial objects (an integer, a std::string_view, etc.). However if you want to avoid copying your objects, you should use std::optional with care.

Let us consider this example:
```C
A f(std::optional<A> z) {
    return z.value_or(A());
}

A g() { 
    A a("message"); 
    auto z = std::optional<A>(a); 
    return f(z); 
}
```


How many instances of the string class are constructed when call the function g()? It is up to five instances:

1. At the start of the function we construct one instance of A.
1. We then copy-construct this instance when passing it to std::optional&lt;A&gt;.
1. Passing std::optional&lt;A&gt; to the function f involves another copy.
1. In the value_or construction, we have a default construction of A (which is wasteful work in this instance).
1. Finally, we copy construct an instance of A when the call to value_or terminates.


It is possible for an optimizing compiler to elide some or all of the superfluous constructions, especially if you can inline the functions, so that the compiler can see the useless work and prune it. However, in general, you may encounter inefficient code.

I do not recommend against using std::optional. There are effective strategies to avoid the copies. Just apply some care if performance is a concern.

