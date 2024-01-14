---
date: "2012-02-08 12:00:00"
title: "Effective compression using frame-of-reference and delta coding"
---



Most generic compression techniques are based on variations on [run-length encoding](/lemire/blog/2009/11/24/run-length-encoding-part-i/) (RLE) and [Lempel-Ziv](https://en.wikipedia.org/wiki/Lempel%E2%80%93Ziv) compression. Compared to these techniques and on the right data set, frame-of-reference and delta coding can be faster for a comparable compression rate.
Mathematically, frame-of-reference and delta coding use the same principle: we apply an invertible transformation that maps a set of (relatively) large integers to mostly smaller integers. (This is a common pattern when compressing data).

Suppose that you wish to compress a sequence of (non-negative) integers. Consider the following sequence:
<code>107,108,110,115,120,125,132,132,131,135.</code>

We could store these 10 numbers as 8-bit integers using 80 bits in total. For example, we have that 135 is 10000111 in binary notation.

The frame-of-reference approach begins by computing the range and minimum of the array. We see that the numbers range from 107 and 135. Thus, instead of coding the original sequence, we can subtract 107 from each value and code this difference instead:

<code>0, 1, 3, 8, 13, 18, 25, 25, 24, 28.</code>

We can code each offset value using no more than 5 bits. For example, 28 is 11100 in binary notation. Of course, we still need to store the minimum value (107) using 8 bits, and we need at least 3 bits to record the fact that only 5 bits per value are used. Nevertheless, the total (8+3+9*5=45) is much less than the original 80 bits. In actual compression software, you would decompose the data into blocks that are maybe larger than 10 values (say 16, 128 or 2048 values). The overhead of storing the minimal value would be small. Moreover, there are computational side benefits to this format: if we seek the value 1000, we know it cannot be in the block if its minimum is 107 and we use only 5 bits to store the offset from 107.
Frame-of-reference works when the range of values in each block is relatively small. We can sometimes get better compression if the difference between the values is small. In this case, it is useful to look at the differences between successive values (e.g., 108-107=1, 110-108=2, 115-110=5):

<code>1,2,5,5,5,7,0,-1,4.</code>

Given this set of differences and the initial value (107), we can reconstruct the original sequence. <em>Delta coding</em> is the compression strategy where we store these differences instead of the original values. Some people like to think of delta coding as a predictive scheme: you constantly predict that the next value will be like the previous one, and you just code the difference between your prediction and the observed value.

In binary, the values 1,2,5,7 and 4 can be written as 001, 010, 101, 111, 100. If we did not have a negative value (-1), we could store these differences using only 3 bits per value. The negative value comes from the fact that our values are not entirely sorted (just locally so). However, as we shall see, this single negative value will cause us some trouble. How do we code the -1?
- The original values are 8-bit values. This means that -1 and 256-1 are the same numbers (modulo 256). That is 25+255 modulo 256 is 24. In effect, we compute differences in an integer ring. The differences become <code>1,2,5,5,5,7,0,255,4.</code> Computing the modulo with a power of two is fast because computers use the binary format natively.
- If you know the value that was predicted (25 in our case). You know that the range of differences goes from -25 to 230. Thus for differences _x_ between -25 and 25, we store them as 2<em>x</em> if it is positive and as -2<em>x</em>-1 if it is negative. Otherwise, we store it as <em>x</em>+25. One problem with this approach is that it may require much branching: the processor has to constantly check conditions before proceeding further. There may be a substantial penalty to pay when using modern superscalar processors.<br/>
Thankfully, you can use a trick called zig-zag encoding to avoid the branching. In effect, you map `x` to <tt>(x << 1) ^ (x >> 31)</tt> (in C or Java). This transformation can then be reversed by<br/>
mapping the result `y` to <tt>((y >>> 1) ^ ((y << 31) >> 31)</tt> where <tt>>>></tt> is the unsigned right shift.
- We can replace subtractions by bitwise exclusive or (xor) operations. It bypasses the issue entirely because xoring integers never generates negative values. The successive xor values are <code>7,2,29,11,5,249,0,7,4.</code> A benefit of the xor operation is that it is symmetric: x xor y is y xor x. This means that inverting the order of the original list, we would simply invert the order of the list of differences. Obviously, computing the xor is quite fast.


Once we have the list of differences as non-negative numbers, we can then try to store them by using as few bits as possible. Unfortunately, in our case, we could to the conclusion that we need 8 bits to store the differences. We remarked however that for all but one value, 3 bits per difference would suffice.
So a sensible solution is to code the first 3 bits of each differences: <code>001, 010, 101, 101, 101, 111, 000, 111, 100.</code> And then we add a pointer to the second last difference to indicate that we are missing 5 bits (11111). The cost of coding this exception is about 13 bits. So the total storage cost would be (8+3+9*3+13=51). In this case, frame-of-reference is preferable to delta coding, but both are preferable to the original 8-bit coding which used 80 bits.

There are many possible variations. For example, you can also use exception technique with the frame-of-reference approach when almost all values fit in a range of values, except for a few.

__Further reading__: the document [SZIP Compression in HDF Products](https://www.hdfgroup.org/doc_resource/SZIP/) and the corresponding CCSDS 120.0-G-2 data compression standard describe the application of delta coding for scientific data. [Michael Dipperstein&rsquo;s page](http://michael.dipperstein.com/) provides a nice overview of generic compression techniques. The specific exception technique I described is from the NewPFD scheme first described in:
>H. Yan, S. Ding, T. Suel, Inverted index compression and query processing with optimized document ordering, in: WWW &rsquo;09, 2009.



See also my blog post [How fast is bit packing?](/lemire/blog/2012/03/06/how-fast-is-bit-packing/)

