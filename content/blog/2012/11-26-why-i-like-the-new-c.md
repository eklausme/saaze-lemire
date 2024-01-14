---
date: "2012-11-26 12:00:00"
title: "Why I like the new C++"
---



I was reading [Vivek Haldar&rsquo;s post](http://blog.vivekhaldar.com/post/36517698671/the-new-c) on the new C++ ([C++11](https://en.wikipedia.org/wiki/C%2B%2B11)) and I was reminded that I need to write such a post myself.

C++ is a standardized language. And they came up with a new version of the standard called C++11. Usually, for complex languages like C++, new versions tend to make things worse. The reason is simple: every vendor is eager to see its features standardized. So the whole standardization process becomes highly political as mutually contradictory features must be glued on. But, for once, the design-by-committee process worked really well: C++11 is definitively superior to previous versions of C++.

In one of my recent research projects, we produced a [C++ library](https://github.com/lemire/FastPFor) leveraging several of the new features of C++11. The use of C++11 is still a bit problematic. For example, our library only compiles under GCC 4.7 and better or LLVM 3.2.
So, why did we bother with C++11?
__1. The move semantics__

In conventional C++, values are either copied or passed by reference. If you are adding large objects (e.g., the data of an image) to a container such as an STL vector, then they are necessarily copied unless you do tricks involving pointers and other magical incantations. Performance-wise, this is absolutely terrible!

The new C++ introduces the move semantics: you can move data to a container (such as an STL vector) without copying it! For example, the following code took over 4s to run using the regular C++, and only 0.6s using C++11: it is a performance boost by a factor of 5, without changing a line of code.```C
vector<vector<int> > V;
for(int k = 0; k < 100000; ++k) {
    vector<int> x(1000);
    V.push_back(x);
}
```


__2. No hassle initialization__

Initializing containers used to be a major pain in C++. It has now become ridiculously easy:
```C
const map<string,int> m = {{"Joe",2},{"Jack",3}};
```


There are still a few things that I could not get to work, such as initializing static members within the class itself. But, at least, you no longer waste minutes initializing a trivial data structure.

__3. Auto__

STL uses iterators. And iterators are cool. But old C++ forces you to fully qualify the type each time (e.g., vector<int>::iterator) even when the compiler could deduce the type. It gets annoying and it makes the code hard to parse. C++11 is much better:
```C
vector<int> x = {1,2,3,4};
for(auto i : x)
  cout<< i <<endl;
```


These lines of code initialize a container and print it out. I never want to go back to the old ways!

__4. Constexpr__

Suppose that you have a function that can be called safely by the compiler because it has no side effect: most mathematical functions are of this form. Think about a function that computes the square root of a number, or the greatest common diviser of two numbers.

In old-style C++, you often have to hard-code the result of these functions. For example, you cannot write <tt>enum{x=sqrt(9)}</tt>. Now you can!
For example, let us define a simple constexpr function:
```C
// returns the greater common divisor
constexpr int gcd(int x, int y) {
    return (x % y) == 0 ? y :  gcd(y,x % y);
}
```


If gcd was just any function, then it might be called multiple times in the following loop, but thanks to C++11, it will never get called when the program is running (just once by the compiler):
```C
for(int k = 0; k < 100000; ++k) {
    vector<int> x(gcd(1000,100000)); 
    V.push_back(x);
}
```


</int>

(Naturally, a buggy C++ compiler might fail to optimize away the constexpr function call, but you can then file a bug report with your compiler vendor.)

__Conclusion__

C++11 is not yet supported by all compilers, but if you are serious about C++, you should switch to C++11 as fast as possible.

As usual, [my code is available from github](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/11/26).

