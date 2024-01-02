---
date: "2009-11-27 12:00:00"
title: "Run-length encoding (part 2)"
---



(This is a follow-up to [my previous blog post](/lemire/blog/2009/11/24/run-length-encoding-part-i/), there is also a follow-up: [part 3](/lemire/blog/2009/12/09/run-length-encoding-part-3/).)

Any run-length encoding requires you to store the number of repetitions. In my example, AAABBBBBZWWK becomes 3A-5B-1Z-2W-1K, we must store 5 counters (3,5,1,2,1) and 5 characters.

__Storing counters using a fixed number of bits__

Most programming languages represent integers using a fixed number of bits in __[binary format](https://en.wikipedia.org/wiki/Binary_numeral_system)__. For example, Java represents integers (<tt>int</tt>) using 32 bits. However, in my example (3A-5B-1Z-2W-1K) storing the counters using 32 bits and the characters using 8 bits means that I use 25 bytes which is more than twice the length of the original string (AAABBBBBZWWK).

Thus, we have a simple optimization problem: determine the best number of bits.  In practice, it might be better to store the data in a byte-aligned way. That is, you should be using 8, 16, 32 or 64 bits. Indeed, reading numbers represented using an arbitrary number of bits may involve a CPU processing overhead.

If you use too few bits, some long runs will have to count as several small runs. If you use too many bits, you are wasting storage. Unfortunately, determining on a case-by-case basis the best number of bits requires multiple scans of the data. It also implies added software complexity.

__But you don&rsquo;t have to use the binary format!__

You can still use  a fixed number of bits for your counters, but with <em>quantized codes</em> instead of the binary format. For example, using 3 bits, you could only allow the counter values 1,2,16, 24, 32,128,256,1024. In this example, the sequence of bits 000 is interpreted as the value 1, the sequence of bits 001 as the value 2, the sequence 010 as 16, and so on. Determining the best codes implies that you must scan the data, compute the histogram of the counters, and then apply some optimization algorithm (such as dynamic programming). The decoding speed might be slight slower as you need to look-up the codes from a table.

__Using variable-length counters for optimal compression__

If you are willing to sacrifice coding and decoding speed, then you can represent the counters using [universal codes](https://en.wikipedia.org/wiki/Universal_code_(data_compression)). Thus, instead of using a fixed number of bits and optimizing the representation (as in the quantized coding idea), you seek an optimal variable-length representation of the counters. With this added freedom, you can be much more efficient.

The illustrate the idea behind variable-length codes, we consider Gamma codes: the code 1 is 1, the code 01 is 2, the code 001 is 3, the code 0001 is 4, and so on. Thus, we use _x_ bits to represent the number <em>x</em>.

Fortunately, we can do much better than Gamma codes and represent the number _x_ using roughly 2 log _x_ bits with delta codes. Firstly, write x as <em>x</em>=2<sup><em>N</em></sup> +(<em>x</em> modulo 2<sup><em>N</em></sup>) where N is the logarithm. Then we can represent the number <em>N</em>-1 as a Gamma code using <em>N</em>-1 bits, and then store (x modulo 2<sup><em>N</em></sup>) in binary format (using <em>N</em>-1 bits). Thus, we can represent all numbers up to 2<sup><em>N</em></sup>-1 using 2<em>N</em>-2 bits.

Unfortunately, the current breed of microprocessors are not kind to variable-length representations so the added compression is at the expense decoding speed.

Continue with [part 3](/lemire/blog/2009/12/09/run-length-encoding-part-3/).

__References and further reading: __Holloway et al., [How to Barter Bits for Chronons](http://pages.cs.wisc.edu/~ahollowa/sigmod357-holloway.pdf), 2007. See also the slides of my recent talk [Compressing column-oriented indexes](http://www.slideshare.net/lemire/compressing-columnoriented-indexes).

