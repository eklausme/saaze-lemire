---
date: "2009-11-24 12:00:00"
title: "Run-length encoding (part I)"
---



(This is part 1, there is also a [part 2](/lemire/blog/2009/11/27/run-length-encoding-part-2/) and a [part 3](/lemire/blog/2009/12/09/run-length-encoding-part-3/).)

Run-length encoding (RLE) is probably the most important and fundamental string compression technique. Countless multimedia formats and protocols use one form or RLE compression or another.

RLE is also deceptively simple. It represents repeated values as a counter and a character. Thus, the string AAABBBBBZWWK becomes 3A-5B-1Z-2W-1K.

If that is all there was to RLE, then the [wikipedia page on run-length encoding](https://en.wikipedia.org/wiki/Run-length_encoding) would be just fine. Yet, I think it needs help.

__Why do we use RLE?__

- You can read and write RLE data in one pass, using almost no memory.
- Given a vector _V_ compressed with RLE, you can apply any scalar function _f_ to its component in time <em>O</em>(|<em>V </em>|) where |<em>V </em>| is the compressed size of the vector.
- Given two vectors _V_ and <em>V</em>&lsquo; compressed with RLE, you can do arithmetic (e.g. <em>V</em>+<em>V</em>&lsquo;) in time <em>O</em>(|<em>V </em>|+|<em>V&rsquo;</em>|).


(Some RLE formats have worse complexity bounds.)

__Any downsides to RLE?__

- Random access is slower. Sometimes, only sequential read (from the beginning) is possible. Updating an RLE-compressed array can be difficult.
- You need long runs of identical values.
- Some RLE formats negatively affect [CPU vectorization](https://en.wikipedia.org/wiki/Vector_processor). Thus, if the compression rates are modest, it could actually take longer to process an RLE-compressed array.


__What is the RLE format?__

There is no unique RLE format. How you use the RLE idea depends on your goals such as (1) maximize the compression rate (2) maximize the processing speed.

Here are some common variations:

- Instead of using a counter for each run of characters, you only add a counter after a value has been repeated twice. For example, the string AAABBBBBZWWK becomes AA1-BB3-Z-WW-K. Thus, if many characters are not repeated, you will rarely use an unnecessary counter.
- You can use a single bit to decide whether a counter is used. For example, the string AAABBBBZWWK becomes A-True-3, B-True-5, Z-False, W-True-2, K-False. Again, this may avoid many unnecessary counters if values are often not repeated.
- Instead of a counter, you may store the location of the run in the array. For example, the string AAABBBBBZWWK becomes 1A-4B-9Z-10W-11K. The benefit of this approach is to allow random access in logarithmic time using [binary search](https://en.wikipedia.org/wiki/Binary_search). However, it is also incompatible with some techniques to avoid unnecessary counters. So, it is a compression-speed trade-off. For even more speed, you can store both the location of the run and its length (thus avoiding a subtraction).
- To help [vectorization](https://en.wikipedia.org/wiki/Vectorization_(computer_science)), you can group the characters into blocks of _k_ characters. For example, using blocks of two characters, the string AAABBBBBZWWK becomes 1AA-1AB-2BB-1ZW-1WK. Again, this is a compression-speed trade-off because there will be fewer runs to compress after grouping the characters into long blocks.


Continue reading to [part 2](/lemire/blog/2009/11/27/run-length-encoding-part-2/).

__Some References (to my own work):__

- Daniel Lemire, [Compressing column-oriented indexes](http://www.slideshare.net/lemire/compressing-columnoriented-indexes) (slides)
- Daniel Lemire, Owen Kaser, Kamel Aouiche, [Sorting improves word-aligned bitmap indexes](http://arxiv.org/abs/0901.3751). Data &amp; Knowledge Engineering 69 (1), pages 3-28, 2010.
- Daniel Lemire, Owen Kaser, [Reordering Columns for Smaller Indexes](http://arxiv.org/abs/0909.1346), working paper.


