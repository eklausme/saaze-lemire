---
date: "2020-06-26 12:00:00"
title: "GNU GCC on x86 does not round floating-point divisions to the nearest value"
---



I know that floating-point arithmetic is a bit crazy on modern computers. For example, floating-point numbers are not associative:
```C
0.1+(0.2+0.3) == 0.599999999999999978
(0.1+0.2)+0.3 == 0.600000000000000089
```


But, at least, this is fairly consistent in my experience. You should simply not assume fancy properties like associativity to work in the real world.

Today I stumbled on a fun puzzle. Consider the following:
```C
double x = 50178230318.0;
double y = 100000000000.0;
double ratio = x/y;
```


If God did exist, the variable ratio would be 0.50178230318 and the story would end there. Unfortunately, there is no floating-point number that is exactly 0.50178230318. Instead it falls between the floating-point number 0.501782303179999944 and the floating-point number 0.501782303180000055.

It important to be a bit more precise. The 64-bit floating-point standard represents numbers as a 53-bit mantissa followed by a power of two. So let us spell it out the way the computer sees it:
```C
0.501782303179999944 == 4519653187245114  * 2 ** -53
0.501782303180000055 == 4519653187245115  * 2 ** -53
```


We have to pick the mantissa 4519653187245114 or the mantissa 4519653187245115. There is no way to represent exactly anything that falls in-between using 64-bit floating-point numbers. So where does 0.50178230318 fall exactly? We have approximately&hellip;
```C
0.50178230318 = 4519653187245114.50011795456 * 2 ** -53
```


So the number is best approximated by the largest of the two values (0.501782303180000055).

Goldberg in [What every computer scientist should know about floating-point arithmatic](https://docs.oracle.com/cd/E19957-01/806-3568/ncg_goldberg.html) tells us that rounding must be to the nearest value:

> The IEEE standard requires that the result of addition, subtraction, multiplication and division be exactly rounded. That is, the result must be computed exactly and then rounded to the nearest floating-point number (using round to even). (&hellip;) One reason for completely specifying the results of arithmetic operations is to improve the portability of software. When a program is moved between two machines and both support IEEE arithmetic, then if any intermediate result differs, it must be because of software bugs, not from differences in arithmetic. Another advantage of precise specification is that it makes it easier to reason about floating-point. Proofs about floating-point are hard enough, without having to deal with multiple cases arising from multiple kinds of arithmetic. Just as integer programs can be proven to be correct, so can floating-point programs, although what is proven in that case is that the rounding error of the result satisfies certain bounds.


Python gets it right:
```C
>>> "%18.18f" % (50178230318.0/100000000000.0)
'0.501782303180000055'
```


JavaScript gets it right:
```C
> 0.50178230318 == 0.501782303180000055
true
> 0.50178230318 == 0.501782303179999944
false
```


So the story would end there, right?

Let us spin up the GNU GCC 7 compiler for x86 systems and run the following C/C++ program:
```C
#include <stdio.h>
int main() {
  double x = 50178230318.0;
  double y = 100000000000.0;
  double ratio = x/y;
  printf("x/y  = %18.18f\n", ratio);
}
```


Can you predict the result?
```C
$ g++ -o round round.cpp
$ ./round
x/y  = 0.501782303179999944
```


So GNU GCC actually picks the smallest and furthest value, instead of the nearest value.

[You may doubt me so I have created a docker-based test](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/06/26).

You might think that it is a bug that should be reported, right?

There are dozens if not hundreds of similar reports to the GNU GCC team. [They are being flagged as invalid](https://gcc.gnu.org/bugzilla/show_bug.cgi?id=35488).

Let me recap: the GNU GCC compiler may round the result of a division between two floating-point numbers to a value that __is not the nearest__. And it is not considered a bug.

The explanation is that the compiler first rounds to nearest using 80 bits and then rounds again (this is called double rounding). This is what fancy numerical folks call <a href="https://en.cppreference.com/w/cpp/types/climits/FLT_EVAL_METHOD"><tt>FLT_EVAL_METHOD = 2</tt></a>.

However, the value of `FLT_EVAL_METHOD` remains at 2 even if you add optimization flags such as <tt>-O2</tt>, and yet the result will change. The explanation is that the optimizer figures out the solution at compile-time and does so ignoring the `FLT_EVAL_METHOD` value. Why it is allowed to do so is beyond me.

Maybe you think it does not matter. After all, the value is going to be close, right? However, if you are an experienced programmer, you know the value of having deterministic code. You run the code and you always get the same results. If the results depend, some of the time, on your exact compiler flag, it makes your life much more difficult.

You can also try to pass GNU GCC the flags <tt>-msse -mfpmath=sse</tt>, as experts recommend, but as my script demonstrates, it does not solve the issue (and then you get <tt>FLT_EVAL_METHOD = -1</tt>). You need to also add an appropriate target (e.g., <tt>-msse -mfpmath=sse -march=pentium4</tt>). In effect, when using GNU GCC, you cannot get away from specifying a target. The flags <tt>-msse -mfpmath=sse</tt> alone will silently fail to help you.

Some people have recommended using other flags to switch the compiler in pc64 mode (<tt>-pc64</tt>). While it would fix this particular example, it does not fix the general problem of floating-point accuracy. It will just create new problems.

If you are confused as to why all of this could be possible without any of it being a bug, welcome to the club. My conclusion is that you should probably never compile C/C++ using GNU GCC for a generic x86 target. It is broken.

You can examine [the assembly on godbolt](https://godbolt.org/z/py3Dw0).

Note: Please run my tests in the specified docker images so that you get the exact same configuration as I do.

