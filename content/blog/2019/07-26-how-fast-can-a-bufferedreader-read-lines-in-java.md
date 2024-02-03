---
date: "2019-07-26 12:00:00"
title: "How fast can a BufferedReader read lines in Java?"
---



[In an earlier post](/lemire/blog/2019/06/18/how-fast-is-getline-in-c/), I asked how fast the `getline` function in C++ could run through the lines in a text file. The answer was about 2 GB/s, certainly over 1 GB/s. That is slower than some of the best disk drives and network connections. If you take into account that software rarely only need to &ldquo;just&rdquo; access the lines, it is easy to build a system where text-file processing is processor-bound, as opposed to disk or network bound.

What about Java? In Java, the standard way to access lines in a text file is to use a <tt>BufferedReader</tt>. To avoid system calls, I create a large string containing many lines of text, and then I call a very simple processing function that merely records the length of the strings&hellip;
```C
StringReader fr = new StringReader(data);
BufferedReader bf = new BufferedReader(fr);
bf.lines().forEach(s -> parseLine(s));

// elsewhere:
public void parseLine(String s) {
  volume += s.length();
}
```


The result is that Java is at least two times slower than C++, on the same system, for this benchmark:

<tt>BufferedReader.lines</tt> |0.5 GB/s                 |
-------------------------|-------------------------|


This is not the best that Java can do: Java can ingest data much faster. However, my results suggest that on modern systems, Java file parsing might be frequently processor-bound, as opposed to system bound. That is, you can buy much better disks and network cards, and your system won&rsquo;t go any faster. Unless, of course, you have really good Java engineers.

Many firms probably just throw more hardware at the problem.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/07/26).

__Update__: An earlier version of the code had a small typo that would create just one giant line. This turns out not to impact the results too much. Some people asked for more technical details. I ran the benchmark on a Skylake processor using GNU GCC 8.1 as a C++ compiler and Java 12, all under Linux. Results will vary depending on your exact configuration.

