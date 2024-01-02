---
date: "2022-06-06 12:00:00"
title: "Data structure size and cache-line accesses"
---



On many systems, memory is accessed in fixed blocks called &ldquo;cache lines&rdquo;. On Intel systems, the cache line spans 64 bytes. That is, if you access memory at byte address 64, 65&hellip; up to 127&hellip; it is all on the same cache line. The next cache line starts at address 128, and so forth.

In turn, data in software is often organized in data structures having a fixed size (in bytes). We often organize these data structures in arrays. In general, a data structure may reside on more than one cache line. For example, if I put a 5-byte data structure at byte address 127, then it will occupy the last byte of one cache line, and four bytes in the next cache line.

When loading a data structure from memory, a naive model of the cost is the number of cache lines that are accessed. If your data structure spans 32 bytes or 64 bytes, and you have aligned the first element of an array, then you only ever need to access one cache line every time you load a data structure.

What if my data structures has 5 bytes? Suppose that I packed them in an array, using only 5 bytes per instance. What if I pick one at random&hellip; how many cache lines do I touch? Expectedly, the answer is barely more than 1 cache line on average.

Let us generalize.

Suppose that my data structure spans z bytes. Let g be the greatest common divisor between z and 64. Suppose that you load one instance of the data structure at random from a large array. In general, the expected number of additional cache lines accesses is (z &#8211; g)/64. The expected total number of cache line accesses is one more: 1 + (z &#8211; g)/64. You can check that it works for z = 32, since g is then 32 and you have (z &#8211; g)/64 is (32-32)/64 or zero.

I created the following table for all data structures no larger than a cache line. The worst-case scenario is a data structure spanning 63 bytes: you then almost always touch two cache lines.

I find it interesting that you have the same expected number of cache line accesses for data structures of size 17, 20, 24. It does not follow that computational cost a data structure spanning 24 bytes is the same as the cost of a data structure spanning 17 bytes. Everything else being identical, a smaller data structure should fare better, as it can fit more easily in CPU cache.

size of data structure (z) |expected cache line access |
-------------------------|-------------------------|
1                        |1.0                      |
2                        |1.0                      |
3                        |1.03125                  |
4                        |1.0                      |
5                        |1.0625                   |
6                        |1.0625                   |
7                        |1.09375                  |
8                        |1.0                      |
9                        |1.125                    |
10                       |1.125                    |
11                       |1.15625                  |
12                       |1.125                    |
13                       |1.1875                   |
14                       |1.1875                   |
15                       |1.21875                  |
16                       |1.0                      |
17                       |1.25                     |
18                       |1.25                     |
19                       |1.28125                  |
20                       |1.25                     |
21                       |1.3125                   |
22                       |1.3125                   |
23                       |1.34375                  |
24                       |1.25                     |
25                       |1.375                    |
26                       |1.375                    |
27                       |1.40625                  |
28                       |1.375                    |
29                       |1.4375                   |
30                       |1.4375                   |
31                       |1.46875                  |
32                       |1.0                      |
33                       |1.5                      |
34                       |1.5                      |
35                       |1.53125                  |
36                       |1.5                      |
37                       |1.5625                   |
38                       |1.5625                   |
39                       |1.59375                  |
40                       |1.5                      |
41                       |1.625                    |
42                       |1.625                    |
43                       |1.65625                  |
44                       |1.625                    |
45                       |1.6875                   |
46                       |1.6875                   |
47                       |1.71875                  |
48                       |1.5                      |
49                       |1.75                     |
50                       |1.75                     |
51                       |1.78125                  |
52                       |1.75                     |
53                       |1.8125                   |
54                       |1.8125                   |
55                       |1.84375                  |
56                       |1.75                     |
57                       |1.875                    |
58                       |1.875                    |
59                       |1.90625                  |
60                       |1.875                    |
61                       |1.9375                   |
62                       |1.9375                   |
63                       |1.96875                  |
64                       |1.0                      |


Thanks to Maximilian Böther for the motivation of this post.

