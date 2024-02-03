---
date: "2020-11-08 12:00:00"
title: "Benchmarking theorem provers for programming tasks: yices vs. z3"
---



One neat family of tools that most programmers should know about are &ldquo;theorem provers&rdquo;. If you went to college in computer science, you may have been exposed to them&hellip; but you may not think of using them when programming.

Though I am sure that they can be used to prove theorems, I have never used them for such a purpose. They are useful for quickly checking some assumptions and finding useful constants. Let me give a simple example.

We have that unsigned odd integers in software have multiplicative inverses. That is,  if you are given the number 3, you can find another number such that when you multiply it with 3, you get 1. There are efficient algorithms to find such multiplicative inverses, but a theorem prover can do it without any fuss or domain knowledge. You can write the following Python program:
```C
s = Solver()
a = BitVec('a', 64)
s.add(a*3  == 1)
s.check()
print(s.model()[a])
```


It will return 12297829382473034411. As 64-bit unsigned integers, if you multiply 12297829382473034411 with 3, you get back 1. If there was no possible solution, the theorem prover would tell as well. So it can find useful constants, or prove that no constant can be found.

For some related tasks, I have been using the popular z3 theorem prover and it has served me well. But it can be slow at times. So I asked Geoff Langdale for advice and he recommended yices, another theorem prover that might be faster for the kind of work that programmers do, e.g., using fixed-bit integer values.

Though I trust Geoff, I wanted to derive some measures. So I built the following benchmark. For all integers between 0 and 1000, I try to find a multiplicative inverse. It will not always work (even numbers do not have inverse), but the theorem prover is left to figure that out.

What are the results?

z3                       |15 s                     |
-------------------------|-------------------------|
yices                    |1 s                      |


So, at least in this one test, yices is 15 times faster than z3. [My Python scripts are available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/11/08). You can install z3 and yices by using the standard pip tool. Be mindful that yices should be present on your system, but [the authors provide easy instructions](https://yices.csl.sri.com).

I found the Python interface of yices to be quite painful compared to z3. So if performance is not a concern, z3 might serve you well.

But why refer to performance? Go back the numbers above. To solve 1000 inverse problems in 15 s is really quite slow on a per number basis. It is on the order of 60 million CPU cycles per number. And it is an easy problem. As you start asking more complicated questions, a theorem prover can quickly slow down to the point of becoming unusable. Being able to go just 10x faster can make a large difference in practice.

__Caveat__: It is just one test and it does not, in any way, establish the superiority (in general) of yices over z3.

