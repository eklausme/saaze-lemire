---
date: "2008-07-07 12:00:00"
title: "Sorting 1 terabyte in 209 seconds"
---



Yahoo! [managed to sort 10 billion 100-byte elements in 209 seconds](http://www.dehora.net/journal/2008/07/06/3-12-minutes-to-sort-a-terabyte-hadoops-code-structure/). This was done in Java using Hadoop.

As a basis for comparison, on a fast and recent Mac Pro, it takes 6000 seconds to sort a 2 GB text file using Unix file utilities. Yahoo!&rsquo;s problem is 500 times larger, and they solve it 30 times faster : they are 4 orders of magnitude faster! Of course, they have fixed-length records which helps tremendously. 

However, I wonder how much energy (power usage) was spent on the sort operation? 

