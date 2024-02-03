---
date: "2022-08-20 12:00:00"
title: "Catching sanitizer errors programmatically"
---



The C and C++ languages offer little protection against programmer errors. Errors do not always show up where you expect. You can silently corrupt the content of your memory. It can make bugs difficult to track. To solve this problem, I am a big fan of programming in [C and C++ using sanitizers](/lemire/blog/2016/04/20/no-more-leaks-with-sanitize-flags-in-gcc-and-clang/). They slow your program, but the check that memory accesses are safe, for example.

Thus if you iterate over an array and access elements that are out of bounds, a memory sanitizer will immediately catch the error:
```C
  int array[8];
  for(int k = 0;; k++) {
    array[k] = 0;
  }
```


The sanitizer reports the error, but what if you would like to catch the error and store it in some log? Thankfully, GCC and LLVM sanitizers call a function (<tt>__asan_on_error()</tt>) when when an error is encounter, allowing us to log it. Of course, you need to record the state of your program. The following is an example where the state is recorded in a string.
```C
#include <iostream>
#include <string>
#include <stdlib.h>

std::string message;

extern "C" {
void __asan_on_error() {
  std::cout << "You caused an error: " << message << std::endl;
}
}


int main() {
  int array[8];
  for(int k = 0;; k++) {
    message = std::string("access at ") + std::to_string(k);
    array[k] = 0;
  }
  return EXIT_SUCCESS;
}
```


The `extern` expression makes sure that C++ does not mangle the function name.

[Running this program with memory sanitizers will print the following](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/08):
```C

You caused an error: access at 8
```


You could also write to a file, if you would like.

