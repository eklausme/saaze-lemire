---
date: "2022-11-22 12:00:00"
title: "What is the size of a byte[] array in Java?"
---



Java allows you to create an array just big enough to contain 4 bytes, like so:
```C
byte[] array = new byte[4];
```



How much memory does this array take? If you have answered &ldquo;4 bytes&rdquo;, you are wrong. A more likely answer is 24 bytes.

[I wrote a little Java program that relies on the jamm library](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/22) to print out some answers, for various array sizes:

size of the array        |estimated memory usage   |
-------------------------|-------------------------|
0                        |16 bytes                 |
1                        |24 bytes                 |
2                        |24 bytes                 |
3                        |24 bytes                 |
4                        |24 bytes                 |
5                        |24 bytes                 |
6                        |24 bytes                 |
7                        |24 bytes                 |
8                        |24 bytes                 |
9                        |32 bytes                 |


This is not necessarily the exact memory usage on your system, but it is a reasonable guess.

__Further work__: A library such as [JOL](https://github.com/openjdk/jol) might provide a more accurate measure, according to a reader (Bempel).

&nbsp;

