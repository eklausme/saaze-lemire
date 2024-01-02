---
date: "2023-01-30 12:00:00"
title: "Move or copy your strings? Possible performance impacts"
---



You sometimes want to add a string to an existing data structure. For example, the C++17 template &lsquo;std::optional&rsquo; may be used to represent a possible string value. You may copy it there, as this code would often do&hellip;

<span style="color: #666616;">std</span><span style="color: #800080;">::</span><span style="color: #603000;">string</span> mystring<span style="color: #800080;">;</span><br/>
<span style="color: #666616;">std</span><span style="color: #800080;">::</span>optional<span style="color: #800080;">&lt;</span><span style="color: #666616;">std</span><span style="color: #800080;">::</span><span style="color: #603000;">string</span><span style="color: #800080;">&gt;</span> myoption<span style="color: #800080;">;</span><br/>
myoption <span style="color: #808030;">=</span> mystring<span style="color: #800080;">;</span><br/>


Or you can move it:

<span style="color: #666616;">std</span><span style="color: #800080;">::</span><span style="color: #603000;">string</span> mystring<span style="color: #800080;">;</span><br/>
<span style="color: #666616;">std</span><span style="color: #800080;">::</span>optional<span style="color: #800080;">&lt;</span><span style="color: #666616;">std</span><span style="color: #800080;">::</span><span style="color: #603000;">string</span><span style="color: #800080;">&gt;</span> myoption<span style="color: #800080;">;</span><br/>
myoption <span style="color: #808030;">=</span> <span style="color: #666616;">std</span><span style="color: #800080;">::</span><span style="color: #603000;">move</span><span style="color: #808030;">(</span>mystring<span style="color: #808030;">)</span><span style="color: #800080;">;</span><br/>


In C++, when &lsquo;moving&rsquo; a value, the compiler does not need to create a whole new copy of the string. So it is often cheaper.

[I wrote a little benchmark to assess the performance difference](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/01/30). It is a single test, but it should illustrate.

Firstly, for relatively long strings (a phrase or a sentence), the move is 5 times to 20 times faster.

&nbsp;                   |copy                     |move                     |
-------------------------|-------------------------|-------------------------|
Apple LLVM 14, M2 processor |24 ns/string             |1.2 ns/string            |
GCC 11, Intel Ice Lake   |19 ns/string             |4 ns/string              |


Secondly, for short strings (a single word), the move is 1.5 times to 3 times faster but the absolute difference is small (as small as a fraction of a nanosecond). Your main concern should be with long strings.

&nbsp;                   |copy                     |move                     |
-------------------------|-------------------------|-------------------------|
Apple LLVM 14, M2 processor |2.0 ns/string            |1.2 ns/string            |
GCC 11, Intel Ice Lake   |7 ns/string              |2.6 ns/string            |


My results illustrate that moving your sizeable data structure instead of copying them is beneficial.

But that&rsquo;s not the fastest approach: the fastest approach is to just hold a pointer. Copying an address is unbeatably fast. A slightly less optimal approach is to use a lightweight object like an std::string_view: copying or creating an std::string_view is cheaper than doing the same with a C++ string.

