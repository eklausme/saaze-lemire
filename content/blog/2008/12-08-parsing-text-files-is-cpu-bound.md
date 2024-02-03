---
date: "2008-12-08 12:00:00"
title: "Parsing text files is CPU bound"
---



Computer Science researchers often stress the importance of compression to get better performance. I believe this is a good illustration of an academic bias. Indeed, file size is easy to measure. It is oblivious to Computer and CPU architectures. We even have a beautiful theory that tells you how far from the optimal compression ratio you stand. And better compression __is__ important: YouTube would not be possible without aggressive video compression.

However, the following theorem is false:

> __Theorem 1__. The time required to parse a file is proportional to its size.


Matt Casters [showed](http://www.ibridge.be/?p=150) that using an open source data warehousing tool, parsing simple [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) files is [CPU bound](https://en.wikipedia.org/wiki/CPU_bound). That is, he gets (slightly) better parsing speed when using two CPU cores to parse the file than a single one. On a strongly I/O bound process, using two threads to read a file would make things worse because it introduces  disk random access.

I decided to verify this claim. I have an optimized CSV file parser written in C++. It may not be as fast as it can possibly be, but the 100 lines of C++ are reasonable. It is single-threaded. I launched the script on a large CSV file and, sure enough, the command &ldquo;top -o cpu&rdquo; reported the process as using 100% of the CPU (on a 2 dual-core systems). So, yes, __parsing CSV files is CPU bound!__

This has serious implications. For example, comparable tests will reveal that XML parsing of large files is also CPU bound. Hence, it is a bit strange to see the [binary XML people](http://www.w3.org/TR/exi-evaluation/) stress that they can compress XML by an average of 10 times, but report little regarding CPU usage.

__Note:__ You mileage may vary. I do not claim that file parsing is always CPU bound. Also, compression is an important technique to accelerate databases.

__Update.__  Here are the file characteristics: number of columns = 4, size in GB = 2.6.


