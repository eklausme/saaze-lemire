---
date: "2017-09-30 12:00:00"
title: "Stream VByte: first independent assessment"
---



[In an earlier post, I announced Stream VByte](/lemire/blog/2017/09/27/stream-vbyte-breaking-new-speed-records-for-integer-compression/), claiming that it was very fast. [Our paper was peer reviewed](https://arxiv.org/abs/1709.08990) ([Information Processing Letters](http://www.sciencedirect.com/science/article/pii/S0020019017301679)) and [we shared our code](https://github.com/lemire/streamvbyte).

Still, as Feynman said, science is the belief in the ignorance of experts. It is not because I am an expert that you should trust me.

There is a [high-quality C++ framework to build search engines called Trinity](https://github.com/phaistos-networks/Trinity). Its author, Mark Papadakis, decided to take Stream VByte out for a spin to see how well it does. [Here is what Mark had to say](https://medium.com/@markpapadakis/trinity-updates-and-integer-codes-benchmarks-6a4fa2eb3fd1):

> As you can see, Stream VByte is over 30% faster than the second fastest, FastPFOR in decoding, where it matters the most, and also the fastest among the 3 codecs in encoding (though not by much). On the flip side, the index generated is larger than the other two codecs, though not by much (17% or so larger than the smallest index generated when FastPFOR is selected).<br/>
This is quite an impressive improvement in terms of query execution time, which is almost entirely dominated by postings list access time (i.e integers decoding speed).


I was pleased that Mark found the encoding to be fast: we have not optimized this part of the implementation at all&hellip; because everyone keeps telling me that encoding speed is irrelevant. So it is &ldquo;accidentally fast&rdquo;. It should be possible to make it much, much faster.

Mark points out that Stream VByte does not quite compress as well, in terms of compression ratios, than other competitive alternatives. That&rsquo;s to be expected because Stream VByte is a byte-oriented format, not a bit-oriented format. However, Stream VByte really shines with speed and engineering convenience.

