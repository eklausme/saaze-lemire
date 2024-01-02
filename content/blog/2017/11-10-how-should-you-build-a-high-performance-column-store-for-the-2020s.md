---
date: "2017-11-10 12:00:00"
title: "How should you build a high-performance column store for the 2020s?"
---



Though most relational databases (like MySQL) are &ldquo;row oriented&rdquo;, in that they keep rows stored together&hellip; experience has taught us that pivoting the data arrow so that columns, and not rows, are stored together can be beneficial. This is an old observation that most experienced programmers know about as the array-of-struct versus struct-of-array choice. There is even a [wikipedia page on the topic](https://en.wikipedia.org/wiki/AOS_and_SOA).

For example, in Java you might have a Point object containing three attributes (X, Y, and Z). You can store an array of Point objects. Or you could have three arrays (one for X, one for Y and one for Z). Which one is best depends on how you are using the data, you should consider both.

It is fairly common for databases to have tons of columns, and for analytical queries to bear only on a few columns. So it makes sense to keep the columns together.

There is actually a full spectrum of possibilities. For example, if you have a timestamp column, you might consider it as several separate columns that can be stored together (years, day, seconds). It is impossible in the abstract to tell how to best organize the data, you really need some domain knowledge about how you access the data.

In the data science world, I have been very interested in a new initiative called Apache Arrow. One way to view Apache Arrow is a common column-oriented database format that can be shared by many database engines.

Column-orientation is at its best when used with compression. Indeed, it is arguably easier and more efficient to compress columns stored together, than one they are interleaved with other columns.

Arrow relies on dictionary compression, a tried-and-true technique. It is a great technique that can enable really fast algorithm. The key idea is quite simple. Suppose that there are 256 distinct values in your column. Then you can represent them as numbers in [0,255], with a secondary lookup table to recover the actual values. That is, if you have `N` distinct values, you can store them using <tt>ceil(log(N)/log(2))</tt> bits using [binary packing](https://arxiv.org/pdf/1401.6399.pdf) ([C code](https://github.com/lemire/simdcomp), [Java code](https://github.com/lemire/JavaFastPFOR), [Go code](https://github.com/zhenjl/encoding), [C# code](https://github.com/Genbox/CSharpFastPFOR)). Thus you might use just one byte per value instead of possibly much more. It is a great format that enables superb optimizations. For example [you can accelerate dictionary decoding using SIMD instructions](/lemire/blog/2016/08/25/faster-dictionary-decoding-with-simd-instructions/) on most Intel and AMD processors released in the last 5 years.

In a widely read blog post, [professor Abadi criticized Apache Arrow in these terms](http://dbmsmusings.blogspot.ca/2017/10/apache-arrow-vs-parquet-and-orc-do-we.html):

> I assume that the Arrow developers will eventually read my 2006 paper on compression in column-stores and expand their compression options to include other schemes which can be operated on directly (such as run-length-encoding and bit-vector compression).


I thought I would comment a bit on this objection because I spent a lot of time hacking these problems.

Let me first establish the terminology:

1. Run-length encoding is the idea where you represent repeated values as the value being repeated followed by some count that tells you how often the value is repeated. So if you have 11111, you might store is as &ldquo;value 1 repeated 5 times&rdquo;.
1. A bit-vector (or bitmap, or bit array, or bitset) is simply an array of bits. It is useful to represent sets of integer values. So to repeat the set {1,2,100}, you would create an array containing at least 100 bits (e.g., an array of two 64-bit words) and set only the bits at index 1, 2 and 100 to &lsquo;true&rsquo;, all other bits would be set to false. [I gave a talk at the Spark Summit earlier this year on the topic](https://www.youtube.com/watch?v=ubykHUyNi_0).To make things complicated, many bit-vectors used in practice within indexes rely on some form of compression.

- For example, [Git (as used within GitHub) relies on EWAH](https://githubengineering.com/counting-objects/) ([java code](https://github.com/lemire/javaewah), [C++ code](https://github.com/lemire/EWAHBoolArray), [C# code](https://github.com/lemire/csharpewah), [Go code](https://github.com/zhenjl/bitmap)), which is a from of run-length encoding bit-vector,
- whereas many data-science systems from the Apache family (such as Spark, Kylin) and Druid, and so forth rely on [Roaring bitmaps](http://roaringbitmap.org) (also available in C, Java, Go, Python, C#&hellip;) which combines run-length encoding with other simple techniques (see [the format specification](https://github.com/RoaringBitmap/RoaringFormatSpec)).


You can build an entire data engine on top of bit-vectors: [Pilosa](https://www.pilosa.com/blog/) is a great example.


Here are some considerations:

1. __To sort, or not to sort?__Run-length encoding is very powerful when the data is sorted. But you cannot have all columns in sorted order. If you have 20 columns, you might lexicographically sort the data on column 2 and 3, and then column 2 and 3 will be very highly compressible by run-length encoding, but other columns might not benefit so much from your sorting efforts. That&rsquo;s great if your queries focus on columns 2 and 3, but much less interesting if you have queries hitting all sorts of columns. You can duplicate your data, extracting small sets of overlapping columns, sorting the result, but that brings engineering overhead. [You could try using sorting based on space-filling curves, but if you have lots of columns, that might be worse than useless](https://arxiv.org/pdf/0909.1346.pdf). [There are better alternatives such as Vortex or Multiple-List sort](https://arxiv.org/pdf/1207.2189.pdf).

Should you rely on sorting to improve compression? Certainly, many engines, like Druid, derive a lot of benefits from sorting. But it is more complicated than it seems. There are different ways to sort, and sorting is not always possible. Storing your data in distinct projection indexes like Vertica may or may not be a good option engineering-wise.

The great thing about a simple dictionary encoding is that you do not need to ask these questions&hellip;
1. __There are more ways to compress than you know.__I have been assuming (and I guess Adabi did the same) that dictionary coding was reliant on [binary packing](https://arxiv.org/pdf/1401.6399.pdf). But there are other techniques found in Oracle and SAP platforms. All of them assume that you divide your column data into blocks.

- By using dictionary coding again within each small block, you can achieve great compression because most blocks will see very few distinct column values. That&rsquo;s called <em>indirect coding</em>.
- Another technique is called <em>sparse coding</em>, where you use a bit-vector to mark the occurrences of the most frequent value, followed by a list of the other values.
- You also have <em>prefix coding</em> where you record the first value in the block and how often it is repeated consecutively, before storing the rest of the block the usual manner.


(We review these techniques in [Section 6.1.1 of one of our papers](https://arxiv.org/pdf/1207.2189.pdf).)

But that is not all! You can also use patched coding techniques, such as FastPFor ([C++ code](https://github.com/lemire/FastPFor), [Java code](https://github.com/lemire/JavaFastPFOR)). You could even get a good mileage out of a super fast [Stream VByte](/lemire/blog/2017/09/27/stream-vbyte-breaking-new-speed-records-for-integer-compression/).

There are many, many techniques to choose from, with different trade-offs between engineering complexity, compression rates, and decoding speeds.
1. __Know your hardware!__And every single processor you might care about would support SIMD instructions that can process several values at once. And yes, this includes Java through the Panama project ([there is a great talk by top Oracle engineers on this topic](https://www.youtube.com/watch?v=LGVxiDxIrFM)). So you absolutely want to make it easy to benefit from these instructions since they are only getting better over time. Intel and AMD will popularize AVX-512, [ARM is coming with SVE](https://www.anandtech.com/show/10586/arm-announces-arm-v8a-with-scalable-vector-extensions-aiming-for-hpc-and-data-center).

I think that if you are designing for the future, you want to take into account SIMD instructions in the same way you would take into account multi-core or cloud-based processing. But we know less about doing this well than we could hope for.
1. __Be open, or else&hellip;__Almost every single major data-processing platform that has emerged in the last decade has been either open source, sometimes with proprietary layers (e.g., Apache Hive), or built substantially on open source software (e.g., Amazon Redshift). There are exceptions, of course&hellip; Google has its own things, Vertica has done well. On the whole, however, the business trade-offs involved when building a data processing platform make open source increasingly important. You are either part of the ecosystem, or your are not.


So how do we build a column store for the future? I don&rsquo;t yet know, but my current bet is on Apache Arrow being our best foundation.

__Advertisement__. If you are a recent Ph.D. graduate and you are interested in coming to Montreal to work with me during post-doc to build a next-generation column store, please get in touch. The pay won&rsquo;t be good, but the work will be fun.

