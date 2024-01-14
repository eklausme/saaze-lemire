---
date: "2009-11-13 12:00:00"
title: "More database compression means more speed? Right?"
---



Current practical database compression techniques stress speed over compression:

- Vectorwise is using Super-scalar RAM-CPU cache compression which includes a carefully implemented [dictionary coder](https://en.wikipedia.org/wiki/Dictionary_coder).
- [C-store](http://db.csail.mit.edu/projects/cstore/)â€”and presumably Verticaâ€”is using similar compression techniques as well as simple run-length encoding of projection indexes.
- Oracle is compressing its bitmaps using [Byte-aligned bitmap compression](http://ieeexplore.ieee.org:80/Xplore/cookiedetectresponse.jsp?reload=true)â€”a variation on run-length encoding.
- Wu et al.&rsquo;s [Fastbit](https://codeforge.lbl.gov/projects/fastbit/) as well as my very own [Lemur Bitmap Index C++ Library](https://github.com/lemire/ewahboolarray) use less aggressive compression techniques, for faster results. In fact, one my recent [empirical results](http://arxiv.org/abs/0901.3751) is that on a two-CPU dualcore machine, using 64-bit words instead of 32-bit words in word-aligned compressionâ€”which nearly halves the compressionâ€”can make the processing faster.
- [LucidDB](http://www.luciddb.org/) similarly compresses its bitmap indexes with a [simple variation](http://www.luciddb.org/wiki/LucidDbDataStorageAndAccess#Compressed_Bitmaps) on run-length encoding.


In a comment to my [previous blog post](/lemire/blog/2009/11/12/which-should-you-pick-a-bitmap-index-or-a-b-tree/#comments), [Rasmus Pagh](http://www.itu.dk/people/pagh/) asks more or less this question:

> Given that we have more and more CPU coresâ€”and generally more powerful CPUsâ€”shouldn&rsquo;t we compress the data more aggressively?


As the CPUs get more powerful, __shouldn&rsquo;t all database become I/O bound__? That is, the main difficulty is to bring enough data into the CPUs?

Apparently not.

- As we have more CPU cores, we also have more bandwidth to bring data to the the cores. Otherwise, CPU cores would be constantly data-starved in most multimedia and business applications.
- Multicore CPUs are not the only game in town: RAM and storage have also been revolutionized. In 2009, it is not unpractical to run entirely database applications from RAM. After all, many business databases fit in 16 GB for RAM. And even when we do not have enough RAM, we have [SSDs](/lemire/blog/2008/02/02/random-write-performance-in-solid-state-drives/).
- Lightweight compression techniques often favor [vectorization](/lemire/blog/2009/08/28/trading-compression-for-speed-with-vectorization/) which is also getting more and more important and powerful.


Hence, for most database applications fast decompression remains preferable to aggressive compression.

