---
date: "2021-04-09 12:00:00"
title: "How fast can you sort arrays of integers in Java?"
---



Programming languages come with sorting functions by default. We can often do much better. For example, [Downs has showed that radix sort can greatly surpass default sort functions in C++](https://travisdowns.github.io/blog/2019/05/22/sorting.html). Radix sort is you friend if you want to sort large arrays of integers.

What about Java? Richard Startin and Gareth Andrew Lloyd have been working hard to improve the sorting function used inside the [RoaringBitmap library](https://github.com/RoaringBitmap/RoaringBitmap). Though we use a custom [radix sort function](https://en.wikipedia.org/wiki/Radix_sort), it is not difficult to make it more generic, so that it can sort any array of integers. I came up with the following code:
```C
public static void radixSort(int[] data) {
  int[] copy = new int[data.length];
  int[] level0 = new int[257];
  int[] level1 = new int[257];
  int[] level2 = new int[257];
  int[] level3 = new int[257];
  for (int value : data) {
    value -= Integer.MIN_VALUE;
    level0[(value & 0xFF) + 1] ++;
    level1[((value >>> 8) & 0xFF) + 1] ++;
    level2[((value >>> 16) & 0xFF) + 1] ++;
    level3[((value >>> 24) & 0xFF) + 1] ++;
  }
  for (int i = 1; i < level0.length; ++i) {
    level0[i] += level0[i - 1];
    level1[i] += level1[i - 1];
    level2[i] += level2[i - 1];
    level3[i] += level3[i - 1];
  }
  for (int value : data) {
    copy[level0[(value - Integer.MIN_VALUE) & 0xFF]++] = value;
  }
  for (int value : copy) {
    data[level1[((value - Integer.MIN_VALUE)>>>8) & 0xFF]++]
       = value;
  }
  for (int value : data) {
    copy[level2[((value - Integer.MIN_VALUE)>>>16) & 0xFF]++]
       = value;
  }
  for (int value : copy) {
    data[level3[((value - Integer.MIN_VALUE)>>>24) & 0xFF]++]
      = value;
  }
}
```


It is about as unsophisticated as it looks. We compute four histograms, one per byte in an integer: Java stores integers using 4-byte words. Then we do 4 passes through the data. We could make it more sophisticated by examining the histogram: if the higher-level histograms are trivial, we can skip some passes. We could extend it to Java longs though we would then need 4 extra passes. It is also possible to generalize to floating-point numbers.

The strange subtraction with MIN_VALUE are to accommodate the fact that Java has signed integers (positive and negative) under a [two complement&rsquo;s format](https://en.wikipedia.org/wiki/Two%27s_complement).

Let us compare it against the default <tt>Arrays.sort</tt> function in Java. We want to sort 1 million integers, generated uniformly at random. Using Java 8 on an Apple M1 processor, we get that RadixSort is ten times faster than <tt>Arrays.sort</tt>.

Arrays.sort              |60 ms                    |
-------------------------|-------------------------|
RadixSort                |5 ms                     |


There are some caveats. The radix sort function is likely to use more memory. Furthermore, the results are sensitive to the input data (both its size and its distribution). Nevertheless, for some systems, radix sort can be a net win.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/04/09).

