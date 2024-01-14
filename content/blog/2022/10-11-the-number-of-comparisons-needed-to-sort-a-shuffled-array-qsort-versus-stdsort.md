---
date: "2022-10-11 12:00:00"
title: "The number of comparisons needed to sort a shuffled array: qsort versus std::sort"
---



Given an array of `N` numbers of type <tt>double</tt>, the standard way to sort it in C is to invoke the `qsort` function
```C
qsort(array, N, sizeof(double), compare);
```


where `compare` is a function which returns an integer less than, equal to, or greater than zero if the first argument is less than, equal to, or greater than the second. Because it is a C function, it takes in void pointers which we must convert back to actual values. The following is a reasonable implementation of a comparison function:
```C
int compare(const void *a, const void *b) {
  double x = *(double *)a;
  double y = *(double *)b;
  counter++;
  if (x < y) {
    return -1;
  }
  if (x == y) {
    return 0;
  }
  return 1;
}
```


Though the function appears to have branches, optimizing compilers can generate binary code without any jumps in this case.

Though the name suggests that `qsort` might be implemented using the textbook algorithm [Quicksort](https://en.wikipedia.org/wiki/Quicksort), the actual implementation depends on the standard library.

The standard approach in C++ is similar. The code might look as follows:
```C
    std::sort(array, array + N, compare);
```


Again, we have a compare function. In C++, the compare function can refer directly to the type, since the <tt>std::sort</tt> is actually a template function, and not a mere function. It makes that the C++ compiler effectively generates a function for each comparison function you provide. It trades an increase in binary size for a potential increase in performance. A reasonable implementation of the comparison function is as follows:
```C
bool compare(const double x, const double y) {
  return x < y;
}
```


The signature of the C++ comparison function is different: we return a Boolean value as opposed to a three-class integer value.

An interesting question is how many comparisons each function makes. Typically, the comparisons are inexpensive and a bad predictor of the performance, but you can imagine cases where comparing your values could be expensive.

The exact number of comparisons depends on the underlying implementation provided by your system. As inputs, I use random arrays.

I choose to count the average number of times that the comparison function is called. Experimentally, I find that the C++ function makes many more calls to the comparison function than the C function (<tt>qsort</tt>). The C library that comes with GCC (glibc) uses `k` &#8211; 1.2645 comparisons per element on average to sort arrays of size 2<sup><tt>k</tt></sup>, matching the theoretical average case performance of [merge sort](https://en.wikipedia.org/wiki/Merge_sort).

LLVM 13 (Apple):

<tt>N</tt>               |calls to the comparison function (<tt>qsort</tt>) per input value |calls to the comparison function (<tt>std::sort</tt>) per input value |
-------------------------|-------------------------|-------------------------|
2<sup>10</sup>           |10.04                    |12.26                    |
2<sup>11</sup>           |11.13                    |13.41                    |
2<sup>12</sup>           |12.21                    |14.54                    |


GCC 9:

<tt>N</tt>               |calls to the comparison function (<tt>qsort</tt>) per input value |calls to the comparison function (<tt>std::sort</tt>) per input value |
-------------------------|-------------------------|-------------------------|
2<sup>10</sup>           |8.74                     |11.98                    |
2<sup>11</sup>           |9.74                     |13.22                    |
2<sup>12</sup>           |10.74                    |14.40                    |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2022/10/11/count_comparisons.cpp).

__Further reading__.

- [Beating Up on Qsort](https://travisdowns.github.io/blog/2019/05/22/sorting.html) by Travis Downs
- [a libc qsort() shootout of sorts](http://calmerthanyouare.org/2013/05/31/qsort-shootout.html) by Mats Linander


