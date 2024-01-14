---
date: "2008-12-19 12:00:00"
title: "Parsing CSV files is CPU bound: a C++ test case (Update 1)"
---



(See [update 2](/lemire/blog/2008/12/19/parsing-csv-files-is-cpu-bound-a-c-test-case-update-2/).)

In a recent [blog post](/lemire/blog/2008/12/16/parsing-csv-files-is-cpu-bound-a-c-test-case/), I said that parsing simple [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) files could be CPU bound. By parsing, I mean reading the data on disk and copying it into an array. I also strip the field values of spurious white space.

You can find [my C++ code](https://lemire.me/parsecsv/parsecsv.zip) on my server.

A reader criticized my implementation as follows:

- I use the [C++ getline function](http://www.cplusplus.com/reference/string/string/getline/) to read the lines. The reader commented that &ldquo;getline does one heap allocation and copy for every line.&rdquo; I doubt that getline generates heap allocation each time it is called: I reuse the same string object for every call.
- For each field value, I did two heap allocations and two copies. I now reuse the same string objects for fields, thus limiting the number of heap allocations.
- The reader commented that I should use a <em>custom allocator</em> to avoid heap allocations. Currently, if the CSV file has _x_ fields, I use <em>x</em>+1 string objects (a tiny number) and small constant number of heap allocations.

Despite these changes, I still get that parsing CSV files is strongly CPU bound:

<code><br/>
$ ./parsecsv ./netflix.csv<br/>
without parsing: 26.55<br/>
with parsing: 95.99<br/>
</code>

However, doing away with the heap allocations at every line did reduce the parsing running time by a factor of two. It is not difficult to believe I could close the gap. But I still see no evidence that <em>parsing CSV files is strongly I/O bound</em> as some of my readers have stated. Consider that in real applications, I would need to convert field values to dates or to numerical values. I might also need to filter values, or support fancier CSV formats.

My experiments are motivated by a [post by Matt Casters](http://www.ibridge.be/?p=150). [Some said](/lemire/blog/2008/12/08/parsing-text-files-is-cpu-bound/) that Java was guilty. I use C++ and I get a similar result. So far at least. Can you tell me where I went wrong?

__Note__: Yet again, I do not claim that my code is nearly optimal. My exact claim is that reading CSV files may be I/O bound using reasonable code. I find this very surprising.

