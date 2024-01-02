---
date: "2023-04-12 12:00:00"
title: "Consider using constexpr static function variables for performance in C++"
---



When programming, we often need constant variables that are used within a single function. For example, you may want to look up characters from a table. The following function is efficient:
```C
char table(int idx) {
  const char array[] = {'z', 'b', 'k', 'd'};
  return array[idx];
}

```


It gets trickier if you have constants that require initialization. For example, the following is terrible code:
```C
std::string table(int idx) {
  const std::string array[] = {"a", "l", "a", "z"};
  return array[idx];
}

```


It is terrible because it is possible that the compiler will create all string instances each time you enter the function, and then throw them away immediately. To fix this problem, you may declare the array to be &lsquo;static&rsquo;. It tells the compiler that you want the string instances to be initialized just exactly once in C++11. There is a one-to-one map between the string instances and the function instances.
```C
const std::string& table(int idx) {
  const static std::string array[] = {"a", "l", "a", "z"};
  return array[idx];
}

```


But how does the compiler ensures that the initialization occurs just once? It may do so by using a guard variable, and loading this guard variable each time the function is called. If the variable indicates that the strings may not have been instantiated yet, a thread-safe routine is called and such a routine proceeds with the initialization if needed, setting the guard variable to indicate that no initialization is required in the future.

This initialization is inexpensive, and the latter checks are inexpensive as well. But they are not free and they generate a fair amount of binary code (e.g., 60 instructions or more!). A better approach is to tell the compiler that you want the initialization to occur at compile time. In this manner, there is no overhead whatsoever when you call the function. There is no guard variable. You get direct access to your constants. Unfortunately, it is not generally possible to have C++ string instances be instantiated at compile time, but it is possible with the C++17 counterpart &lsquo;string_view&rsquo;. We can declare the constant variables with the attributes <tt>constexpr static</tt>. The attribute `constexpr` tells the compiler to do the work at compile time. The resulting code is most efficient:
```C
std::string_view table(int idx) {
  constexpr static std::string_view array[] = {"a", "l", "a", "z"};
  return array[idx];
}

```


It may compile to just this assembly:
```C
  movsx rdi, edi
  sal rdi, 4
  mov rax, QWORD PTR table(int)::array[rdi]
  mov rdx, QWORD PTR table(int)::array[rdi+8]
```


I wrote a little benchmark to illustrate the effect. Your results will vary depending on your system. I using an Apple M1 processing with LLVM 14 and an Ice Lake processor with GCC 12. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/04/12).

function                 |Apple M1, LLVM 14        |Intel Ice Lake, GCC 12   |
-------------------------|-------------------------|-------------------------|
constexpr static string_view |0.9 ns/call              |2.2 ns/call              |
static string            |2.0 ns/call              |2.3 ns/call              |
string                   |6.6 ns/call              |16 ns/call               |


Though the performance difference between the static string approach and the <tt>constexpr static string_view</tt> is small and may not matter if the function is called often, the <tt>constexpr static string_view</tt> code will generate less bloat in general.

