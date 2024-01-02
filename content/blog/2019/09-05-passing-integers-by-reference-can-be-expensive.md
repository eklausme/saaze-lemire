---
date: "2019-09-05 12:00:00"
title: "Passing integers by reference can be expensive&#8230;"
---



In languages like C++, you can pass values to functions in two ways. You can pass by value: the value is semantically &ldquo;copied&rdquo; before being passed to the function. Any change you made to the value within the function will be gone after the function terminates. The value is ephemeral. You can also pass by pointer or reference: semantically, we point the new function at the value we already have. Changes made within the function to the value will remain after the scope of the function.

As a rule of thumb, whenever a data element is large (e.g., it cannot fit in registers), it is probably faster to pass by reference or pointer. For tiny data elements that fit in registers, like integers, passing them by value ought to be best.

However, sometimes it is convenient to pass integer values by reference because you want to capture how the value changed during the scope of the function. C++ makes this trivially easy as you just need to add the ampersand (&amp;) in front of the parameter. It looks &ldquo;free&rdquo;.

Let us consider the silly example of some function that passes a counter (the variable &lsquo;i&rsquo;) which gets incremented and added to multiple locations in an array:
```C
void incrementr(uint64_t &i, uint64_t *x) {
  for (int k = 0; k < SIZE; k++) {
    x[k] += i++;
  }
}
```


We can write an almost entirely equivalent function without using a reference. We just take the counter by value, modify it, and then return it at the end of the function:
```C
int increment(uint64_t i, uint64_t *x) {
  for (int k = 0; k < SIZE; k++) {
    x[k] += i++;
  }
  return i;
}
```


I expect these two types of functions to be largely equivalent semantically, as long as the counter is assumed not to reside in the array (x). What about performance? The function call itself is different, so there might be a couple of extra move instructions in total in the pass-by-reference case in the best of cases due to calling conventions. However, compilers, like GNU GCC, produce vastly different code that go far beyond a few extra move instructions at the start and end of the function.

GNU GCC 8.3 keeps the value of the passed-by-reference value in memory throughout instead of using a register, due to an aliasing issue. Thus each time you access the counter, you need to reload it. If you modify it, you need to store the new value again. The net result is far worse performance on my Skylake processor&hellip;

&nbsp;                   |cycles per value         |instructions per value   |
-------------------------|-------------------------|-------------------------|
reference                |5.9                      |7.0                      |
value                    |1.3                      |3.5                      |


The effect is quite large as you can see. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/09/05).

You can avoid the penalty by copying the passed-by-reference variable to a local variable at the start, and copying it back at end of the function. Or, if your compiler supports it, you can add the __restrict qualifier on your reference.

Other languages like Swift are likely affected as well. In Swift, you can pass an integer as an _inout_ variable which is semantically equivalent to a reference&hellip;
```C
func fx(_ allints: inout [Int],  _ j : inout Int) {
      for k in allints.indices {
        allints[k] = j
        j &+= 1
      }
 }
```


You should avoid such code if you care for performance.

Of course, these considerations are likely to be irrelevant if the function gets inlined or if the function is very inexpensive.

