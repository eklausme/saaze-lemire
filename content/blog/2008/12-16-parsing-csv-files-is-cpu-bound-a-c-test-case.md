---
date: "2008-12-16 12:00:00"
title: "Parsing CSV files is CPU bound: a C++ test case"
---



([These results were updated](/lemire/blog/2008/12/19/parsing-csv-files-is-cpu-bound-a-c-test-case-update-2/).)

In [Parsing text files is CPU bound](/lemire/blog/2008/12/08/parsing-text-files-is-cpu-bound/), I claimed that I had a C++ test case proving that parsing [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) files could be [CPU bound](https://en.wikipedia.org/wiki/CPU_bound). By CPU bound, I mean that the overhead of taking each line, finding out where the commas are, and storing the copies of the fields into an array, dominates the running time.

How do I test this theory? I read the file twice. Once, I just read each line and report the time elapsed. Then, I read each line and process them and report the time elapsed. If the two times are similar, the process is I/O bound, if the second time is much larger, the process is CPU bound.

I get this result on a 2 GB file (numbers updated on Dec. 19, 2008):

<code><br/>
$ ./parsecsv ./netflix.csv<br/>
without parsing: 26.55<br/>
with parsing: 95.99<br/>
</code>

Hence, parsing dominates the running time. At least in this case. At least with my C++ code.

Before you start arguing with me, please go download [my reproducible test case](https://lemire.me/parsecsv/parsecsv.zip). All you need is the GNU GCC compiler. I tested out two machines, with two different versions of GCC.

__Note__: I do not claim that this is professional benchmarking.

__Reference__: This quest started out from a [post by Matt Casters](http://www.ibridge.be/?p=150) where he reported that you could parse a CSV file faster using two CPU cores instead of just one.

