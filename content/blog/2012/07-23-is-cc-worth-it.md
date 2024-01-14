---
date: "2012-07-23 12:00:00"
title: "Is C++ worth it?"
---



We routinely attribute the long battery life and power of our tablets and tiny laptops to better hardware. However, in many cases, this better hardware runs software that is an order of magnitude faster than older software. For example, our web browsers feel faster because JavaScript interpreters are 10 to 20 times faster than the original ones.
But surely, not all software developers write tighter code than they used to? Certainly not. However, software developers have much better tools. For example, compilers have gotten much better and they are continuing to improve. Thus, all programmers produce faster software everything else being equal.

But we are also moving away from low-level programming and, yet, our software is still getting faster. I believe that a major understated trend in the last decade or so has been the increase in performance of the higher level languages.

Let me consider a simple case. Suppose you need to compute a cumulative sum. For example, starting from 1,2,0,4,5 you want to compute 1,3,3,7,12. Most C++ programmers would implement it as follows:
```C
for (size_t i = 1; i != data.size(); ++i) {
  data[i] += data[i - 1] ;
}
```


The implementation in Java is quite similar, of course.

On a recent Intel Core&nbsp;i7 Linux desktop, I have tried different compilers (using the -O3 flag each time) along with Java 7:

compiler                 |&nbsp;millions of int. per s&nbsp; |
-------------------------|-------------------------|
Java                     |1785                     |
GCC 4.5                  |520                      |
GCC 4.7                  |1667                     |
GCC 4.7 (with -funroll-loops) |2000                     |
clang 3.1                |1923                     |


Notice how Java beats GCC in these tests?
As usual, [my source code is freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/07/23). Of course, from a sample of 3 compilers on a single problem, I only provide an anecdote, but there are extensive and well established benchmarks supporting my points:

- Higher level languages such as Java and JavaScript can be surprising fast. Java is typically no more than twice as slow as C++. JavaScript is often no more than 4 times as slow.- Really clever and hard working C/C++ programmers can beat higher-level languages by a wide margin given enough time. However, their code will typically become less portable and harder to maintain.


__Conclusion__: If your sole reason for using C++ is speed, and you lack the budget for intensive optimization, you might be misguided.

__Update__: A straight C implementation is faster than the C++/STL version under GCC. However, with clang 3.1, both are just as fast, as expected. Whether you use C or C++, you cannot beat Java by more than 10% on my machine.

__Update 2__: I have quite a bit of experience porting software back and forth between Java and C++. I do not, nor have I ever, <em>based my conclusions on 3 lines of code</em>. This is just a nice example.

__Credit__: This post was inspired by private discussions with Leonid Boytsov. Some of the code using during testing was provided by Vasily Volkov.

__Translation__: This article has been translated to [Serbo-Croatian](http://science.webhostinggeeks.com/dali-koristiti-C%2B%2B) by Anja Skrba.

