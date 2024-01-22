---
date: "2017-11-28 12:00:00"
title: "Bit hacking versus memoization: a Stream VByte example"
---



In compression techniques like [Stream VByte](/lemire/blog/2017/09/27/stream-vbyte-breaking-new-speed-records-for-integer-compression/) or Google&rsquo;s varint-GB, we use control bytes to indicate how blocks of data are compressed. Without getting into the details ([see the paper](https://arxiv.org/abs/1709.08990)), it is important to map these control bytes to the corresponding number of compressed bytes very quickly. The control bytes are made of four 2-bit numbers and we must add these four 2-bit numbers as quickly as possible.

There is [a related Stack Overflow question](https://stackoverflow.com/questions/17880178/how-do-i-sum-the-four-2-bit-bitfields-in-a-single-8-bit-byte) from which I am going to steal an example: given the four 2-bits <tt>11 10 01 00</tt> we want to compute <tt>3 + 2 + 1 + 0 = 6</tt>.
- How do we solve this problem in [our implementation](https://github.com/lemire/streamvbyte)? Using table look-ups. Basically, we precompute each of the 256 possible values and just look them in a table. This is often called [memoization](https://en.wikipedia.org/wiki/Memoization). It works fine and a lot of fast code relies on memoization but I don&rsquo;t find it elegant. It makes me sad that so much of the very fastest code ends up relying on memoization.
- What is the simplest piece of code that would do it without table lookup? I think it might be
```C
 (x & 0b11) + ((x>>2) & 0b11) + ((x>>4) & 0b11) + (x>>6). ```

- Can we get slightly more clever? [Yes, aqrit and Kendall Willets came up with a fancier involving two multiplications](https://github.com/lemire/streamvbyte/issues/12#issuecomment-346697198):
```C
((0x11011000 * ((x * 0x0401) & 0x00033033)) >> 28).
```


 The compiler might implement a product like <tt>x * 0x0401</tt> into a shift and an addition. Nevertheless, it is not obvious that two multiplications (even with optimizations) are faster than the naive approach but it is really a nice piece of programming. I expect that most readers will struggle to find out why this expression work, and that&rsquo;s not necessarily a good thing. (John Regher points out that this code has undefined behavior as I have written it. One needs to ensure that all computations are done using unsigned values.)
- In Stream VByte, the control bytes are organized sequentially which means that you can use another fancy approach that processes four bytes at once:
```C

v = ((v >> 2) & 0x33333333) + (v & 0x33333333);
v = ((v >> 4) & 0x0F0F0F0F) + (v & 0x0F0F0F0F);
```


where the variable `v` represents a 32-bit integer. You could generalize to 64-bit integers for even better speed. It might be slightly puzzling at first, but it is not very difficult to work out what the expression is doing.
It has the benefit of being likely to be faster than memoization, but at the expense of some added code complexity since we need to process control bytes in batches. There is also some concern that I could suffer from uneven latency, with the first length in a batch of four being delayed if we are not careful.

We could modify this approach slightly to compute directly the sums of the lengths which could be put to good use in the actual code&hellip; but it is fancy enough as it stands.</tt>.


I could imagine quite a few more alternatives, including some that use SIMD instructions, but I have to stop somewhere.

So how fast are these techniques? [I threw together a quick benchmark to measure the throughput](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/11/27). I am using a recent (Intel Skylake) processor.

memoization              |1.7 cycles/byte          |
-------------------------|-------------------------|
naive                    |2.6 cycles/byte          |
aqrit-Willets            |3.1 cycles/byte          |
batch (32-bit)           |1.4 cycles/byte          |


Sadly, the aqrit-Willets approach, despite its elegance, is not always faster than the naive approach. The batch approach is fastest.

Because the batch approach could be made even faster by using 64-bit words, it would be my best choice right now to replace memoization if speed were my concern. It illustrates how there are potential benefits in a data layout that allows batch processing.

This microbenchmark reinforces the view that memoization is fast, as it does well despite its simplicity. Unfortunately.

__Update__: On Twitter, [Geoff Langdale described](https://twitter.com/geofflangdale/status/936186235772534785) a fast vectorized approach using SIMD instructions. An approach similar to what he advocates is described in the paper [Faster Population Counts Using AVX2 Instructions](https://arxiv.org/abs/1611.07612).

