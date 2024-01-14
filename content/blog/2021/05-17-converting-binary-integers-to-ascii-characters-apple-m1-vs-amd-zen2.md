---
date: "2021-05-17 12:00:00"
title: "Converting binary integers to ASCII characters: Apple M1 vs AMD Zen2"
---



Programmers often need to write integers as characters. Thus given the 32-bit value 1234, you might need a function that writes the characters <tt>1234</tt>. We can use the fact that the ASCII numeral characters are in sequence in the ASCII table: &lsquo;0&rsquo;+0 is &lsquo;0&rsquo;, &lsquo;0&rsquo;+1 is &lsquo;1&rsquo; and so forth. With this optimization in mind, the standard integer-to-string algorithm looks as follow:
```C
while(n >= 10)
  p = n / 10
  r = n % 10
  write '0' + r
  n = p
write '0' + n
```


This algorithm writes the digits in reverse. So actual C/C++ code will write a pointer that you decrement (and not increment):
```C
  while (n >= 10) {
    const p = n / 10;
    r = n % 10;
    n = p;
    *c-- = '0' + r;
  }
  *c-- = '0' + n;
```


You can bound the size of the string (10 characters for 32-bit integers, 20 characters for 64-bit integers). If you have signed integers, you can detect the sign initially and make the integer value non-negative, write out the digits and finish with the sign character if needed. If you know that your strings are long, you can do better by writing out the characters two at a time using lookup tables.

How fast is this function ? It is going to take dozens of instructions and CPU cycles. But where is the bottleneck?

If you look at the main loop, and pay only attention to the critical data dependency, you divide your numerator by 10, then you check its value, and so forth. So your performance is bounded by the speed at which you can divide the numerator by 10.

The division instruction is relatively slow, but most compilers [will convert it into a multiplication and a shift](https://arxiv.org/abs/2012.12369). It implies that the whole loop has a latency of about 5 cycles if you count three cycles for the multiplication and one cycle for the shift, with one cycle for the loop overhead. Of course, the function must also compute the remainder and write out the result, but their cost is maybe less important. It is not that these operations are themselves free: computing the remainder is more expensive than computing the quotient. However, we may get them almost for free because they are on a critical data dependency path.

How correct is this analysis? How likely is it that you are just bounded by the division by 10? The wider your processor, the more instructions it can retire per cycle, the more true you&rsquo;d expect this analysis to be. Our commodity processors are already quite wide. Conventional Intel/AMD processors can retire about 4 instructions per cycle. The Apple M1 processor can retire up to 8 instructions per cycle.

To test it out, let us add a function which only writes out the most significant digit.
```C
  while (n >= 10) {
    n /= 10;
    c--;
  }
  c--;
  *c = '0' + char(n);
```


Here is the number of nanoseconds required per integer on average according to [a benchmark I wrote](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/05/17). The benchmark is designed to measure the latency.

function                 |Apple M1 clang 12        |AMD Zen2 gcc 10          |
-------------------------|-------------------------|-------------------------|
fake itoa                |11.6 ns/int              |10.9 ns/int              |
real itoa                |12.1 ns/int              |12.0 ns/int              |


According to these numbers, my analysis seems correct on both processors. The numbers are a bit closer in the case of the Apple M1 processor, but my analysis is not sufficiently fine to ensure that this difference is significant.

Hence, at least in this instance, your best chance of speeding up this function is either by dividing by 10 faster (in latency) or else by reducing the number of iterations (by processing the data in large chunks). The latter is already found in production code.

In the comments, Travis Downs remarks that you can also try to break the chain of dependencies (e.g., by dividing the task in two).

__Further reading__: [Faster Remainder by Direct Computation: Applications to Compilers and Software Libraries](https://arxiv.org/abs/1902.01961), Software: Practice and Experience 49 (6), 2019

