---
date: "2008-12-19 12:00:00"
title: "Parsing CSV files is CPU bound: a C++ test case (Update 2)"
---



I am continuing my fun saga to determine whether parsing [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) files is CPU bound or I/O bound. Recall that [I posted some C++](https://lemire.me/parsecsv/parsecsv.zip) code and reported that it took 96 seconds of process time to parse a given 2GB CSV file and just 27 seconds to read the lines without parsing. Preston L. Bannister correctly pointed out that using the clock() function is wrong. So I updated my code using his ZTimer class instead. The new numbers are 103 seconds for the full parsing and 57 seconds to just parse the lines.

Some anonymous reader [claimed](/lemire/blog/2008/12/19/parsing-csv-files-is-cpu-bound-a-c-test-case-update-1/#comment-50359) that my code was still grossly inefficient. I do not like arguing without evidence.

Ah! But Unix utilities can also parse CSV files. They are usually efficient. Let us use the cut command:

<code><br/>
$ time cut -f 1,2,3,4 -d , ./netflix.csv &gt; /dev/null<br/>
real 1m59.596s<br/>
user 1m53.163s<br/>
sys 0m3.775s<br/>
</code>

So, 120 seconds?

What about sorting the CSV file? Of course, it is a lot more expensive: 504 seconds.<br/>
<code><br/>
$ time sort -t, ./netflix.csv &gt; /dev/null<br/>
real 8m23.985s<br/>
user 2m28.855s<br/>
sys 1m1.467s<br/>
</code>

Finally, for a basis of comparison, let us just dump the file to /dev/null:

<code> $ time cat ./netflix.csv &gt; /dev/null<br/>
real 0m29.337s<br/>
user 0m0.029s<br/>
sys 0m2.541s<br/>
</code>

The final story:

parsing method           |time elapsed             |
-------------------------|-------------------------|
cat Unix command         |29 s                     |
Daniel&rsquo;s line parser |57 s                     |
Daniel&rsquo;s CSV parser |103 s                    |
cut Unix command         |120 s                    |
sort Unix command        |504 s                    |


__Analysis__: My [C++ code](https://lemire.me/parsecsv/parsecsv.zip) is not grossly inefficient. If the I/O cost of reading the file is about 30 seconds, parsing it takes about 100 seconds. My preliminary conclusion is that parsing CSV files is more CPU than I/O bound.

