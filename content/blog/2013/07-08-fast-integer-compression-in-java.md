---
date: "2013-07-08 12:00:00"
title: "Fast integer compression in Java"
---



Last year, we published [a fast C++ library](https://github.com/lemire/FastPFor) to quickly compress and decompress arrays of integers. To get good compression, we use differential coding: the arrays of integers are sorted and instead of storing the integers themselves, we store the difference between successive integers. The differences are typically small integers that can be compressed efficiently. Out of habit, I [ported our code to Java](https://github.com/lemire/JavaFastPFOR) and published it under the name [JavaFastPFOR library](https://github.com/lemire/JavaFastPFOR).
Unlike generic compression techniques like gzip or Google Snappy, we only wish to compress and uncompress integers. We provide a less general solution, but we can also get much more impressive speeds in some cases (e.g., an order of magnitude faster).
Though you cannot reach the same kind of speed in Java as you can in C++, there are many good reasons to use Java instead of C++. How good is Java at this task? Direct comparisons between Java and C++ are difficult. I would estimate that the difference is a factor of 3 and more. But Java can still be more than fast enough.

I decided to compare our results with the popular Kamikaze PForDelta library. I used a fast core i7 processor with synthetic data. We vary the compressibility of the data. For each test, I report the speed in millions of integers per second as well as the storage cost in bits per integer (in parenthesis).
&nbsp;Binary Packing&nbsp; |&nbsp;Kamikaze PForDelta&nbsp; |
-------------------------|-------------------------|
1200 (3.1)               |300 (3.3)                |
1100 (7.4)               |300 (7.7)                |
1000 (13)                |300 (14)                 |


The numbers show that the Binary Packing technique implemented in the [JavaFastPFOR library](https://github.com/lemire/JavaFastPFOR) can easily exceed 1 billion of integers per second in decompression speed. This is likely fast enough for most applications.

I posted the [raw results](https://github.com/lemire/JavaFastPFOR/blob/master/benchmarkresults/benchmarkresults_icore7_10may2013.txt) if you wish the examine them more closely.

The library is available under the Apache license and is part of the Maven repository. It includes many more schemes.

__Warning__: These results may not be representative of what you get in an actual application. They will vary depending on the machine you use and your data. I am only providing these numbers as a ballpark indication.

__Credit__: This work is the result of a fruitful collaboration with many super smart people including L. Boytsov, O. Kaser, N. Kurz. All mistakes are my fault.

