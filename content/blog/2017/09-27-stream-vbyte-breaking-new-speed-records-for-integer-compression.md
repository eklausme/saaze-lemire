---
date: "2017-09-27 12:00:00"
title: "Stream VByte: breaking new speed records for integer compression"
---



In many information systems, we work with arrays of integers. For example, maybe you need to keep track of which records in a database contain a given value. This sort of mapping can be expressed as an array of integers.

These arrays can end up taking up a large fraction of your memory or disk space. Though storage is cheap, having too much data can hurt performance. And, at the margin, storage is not always cheap: disks fail and need to be replaced, a labor-intensive process. Adding more hardware to your system adds to the running costs and to the complexity.

So we often want to compress this data. However, our primary motivation for compression is often performance and engineering, rather than saving space per se. We want compression techniques that will enhance our overall performance and reduce cost&hellip; Getting the absolutely best compression can be a net negative if you end up with a slower system.

One should have some notion of computer architecture when dealing with these problems. So we have disks and networks from which data flow into CPU cache and memory (RAM). Commonly used data is typically stored in memory (RAM) for fast reuse, but it needs to be brought back to CPU cache before it can be processed. Moving data from CPU cache to memory (RAM) is a performance bottleneck, so you want to do as little of it as you can.

If you are doing data processing and your data is constantly moving from memory and cache and back to memory and back to cache&hellip; You are probably going to end up in a state where your CPU is wasting most of its cycles waiting for data. You do not want that.

That is where compression can help: it can be faster to bring data from RAM in compressed form and uncompress it in the cache than it can be to just copy uncompressed data from RAM to CPU cache.

So, we are not uncompressing from the disk to the disk, or even from the RAM to the RAM. In an ideal world, the important data is in RAM and we want to bring it to the CPU cache where it will be uncompressed and processed. At no point do you want to bring back the uncompressed data to RAM, as that would be wasteful.

We also prefer simple data structures and simple algorithms. This gives us more room, as engineers, to write optimized code that operates directly on the data, without relying on black-box functions.

So how do you compress integers efficiently? Most people think of something like zip or gzip. If they are somewhat more sophisticated, they think of Snappy or Zstandard.

This all works, but these techniques do not know that you are compressing integers. So you end up calling lots of code and have at least an order of magnitude less performance than you could have.

If you are really performance conscious, you are probably going to use specialized compression techniques dedicated to integers.

These techniques work with the assumption that even though programming languages dedicated a fixed 32 bits or a fixed 64 bits for each integer, there are many instances where far fewer bits would be required. That is, you can often assume that your arrays of integers all contain small integers.

What? I hear you say that you cannot assume that your identifiers are all small integers? Ah. That&rsquo;s where a nifty trick comes in: though you cannot always assume that your integers are small, you can often assume that they are sorted. And the successive differences between these sorted integers are often small.

So you can either compress arrays containing small integers, or the successive differences of small integers. From the successive differences, you can reconstruct the original integers by computing a prefix sum: if you have <tt>y[0] = x[0], y[1] = x[1] - x[0], y[2] = x[2] - x[1],...</tt> you can compute <tt>y[0], y[0] + y[1], y[0] + y[1] + y[2],...</tt> to recover <tt>x[0], x[1], x[2],...</tt> There are fast techniques to compute a prefix sum and, better, you can embed it within the uncompression routines so that it is all done within registers.

So how do you compress and uncompress integers? The most widespread technique is probably VByte (also known as VarInt, varint, escaping and so forth). It is what search engines like Lucene rely upon. It is also part of Google&rsquo;s Protocol Buffers. And it is natively supported in the Go programming language under the name [varint](https://golang.org/pkg/encoding/binary/).

VByte is a &ldquo;byte-oriented scheme&rdquo;. What it does is to first try to store a given integer value using a single byte. If it cannot, it uses two bytes, and so forth. Within each byte, we reserve the most significant bit as a control bit: the bit is set to 0 when the byte is the last one in a coded integer, otherwise, it is set to 1.

This is pretty good, and it can be super fast, as long as your integers all fit in one byte. Once you start having integers that require different numbers of bytes, the performance goes down fast, due to branch mispredictions.

So what do we do?

- [According to Google&rsquo;s top engineer, Jeff Dean](https://dl.acm.org/citation.cfm?doid=1498759.1498761), Google replaced VByte with something called varint-GB. The idea is simply to pack integers in blocks of four. In this manner, you can hope to drastically reduce the number of mispredicted branches.
- Amazon&rsquo;s Stepanov (who also invented C++&rsquo;s STL) and his collaborators [looked at vectorizing VByte](https://dl.acm.org/citation.cfm?doid=2063576.2063627). The idea is to replace the scalar instructions with vector instructions that operate on several integers at once. All modern processors have vector instructions, including the processor in your smartphone, so it makes sense.They failed to get good performance out of a vectorized VByte. The also failed to get good performance out of a vectorized version of varint-GB, but they did very well with their own alternative (varint-G8IU) that they patented. What varint-G8IU does is to try to pack as many integers as they can into a block having a fixed size (e.g., 8 bytes).

Their varint-G8IU works well because it is super convenient for the processor to decode a fixed number of bytes at each iteration.
- One of Indeed.com&rsquo;s top engineers, Jeff Plaisance, wondered whether we could vectorize VByte efficiently despite what Stepanov et al. found? The benefit then is that you can have super fast decoding without having to change your data format.That turns out to be non-trivial engineering, but it can be done. [I co-authored a scheme called Masked VByte with Jeff Plaisance and Nathan Kurz.](http://maskedvbyte.org) It is not as fast as Amazon&rsquo;s patented varint-G8IU, but it is much faster than good old VByte.


This left us at a stage where the fastest byte-oriented integer scheme was Stepanov et al.&rsquo;s varint-G8IU algorithm. I found it tempting to ask whether we could do better. One of my motivations was that varint-G8IU being patented, it cannot be safely used in many open source projects. Yet many big-data applications are reliant on open-source software (e.g., Apache Spark). My friend Nathan Kurz came up with a pretty good design that we call Stream VByte that is not only patent-free but also faster.

We first have to understand why Stepanov et al. got poor performance out of a vectorized version of Jeff Dean&rsquo;s varint-GB. We have that varint-GB stores data into chunks of four compressed integers, but these chunks have variable size. It is made of one control byte with a given number of &ldquo;data bytes&rdquo;. Thus you have to nearly fully decode one chunk before you can even know where the next chunk starts. This creates a bad data dependency that makes it very hard to accelerate varint-GB with fancy instructions.

Our processors are superscalar, so they can do many things at once (many instructions per CPU cycle). But for this to work, we need to keep them fed. Data dependencies stop that. They stall the processors.

So what we did was to reorder the data. Instead of interleaving the data bytes and the control bytes, Stream VByte stores the control bytes continuously, and the data bytes in a separate location. This means that you can decode more than one control byte at a time if needed. This helps keep the processor fully occupied.

So how well do we do? [Let me quote from our paper](https://arxiv.org/abs/1709.08990):

> We show that Stream VByte decoding can be up to twice as fast as varint-G8IU decoding over real data sets. In this sense, Stream VByteE establishes new speed records for byte-oriented integer compression, at times exceeding the speed of the `memcpy` function. On a 3.4 GHz Haswell processor, it decodes more than 4 billion differentially-coded integers per second from RAM to L1 cache.


The paper was also co-authored with Christoph Rupp, the architect of the fast [upscaledb key-value store](https://upscaledb.com).

[I think our paper is nice and readable](https://arxiv.org/abs/1709.08990). It has been accepted for publication in Information Processing Letters, a pretty good journal for this sort of short communications.

What about the code? [We have a software package written in C](https://github.com/lemire/streamvbyte) under a liberal license.

I should mention that unlike Amazon, we did not patent our approach. We want you to use this in your commercial and open-source projects!

How complicated is the code? Here is the gist of it using SSE instrinsics:
```C
uint8_t C = lengthTable[control]; // C is between 4 and 16
 __m128i Data = _mm_loadu_si128((__m128i *) databytes);
 __m128i Shuf = _mm_loadu_si128(shuffleTable[control]);
 Data = _mm_shuffle_epi8(Data, Shuf); // final decoded data
 datasource += C;
```


If you are not familiar with intrinsics, this code might look intimidating, but it is really just a few simple and cheap instructions.

I should stress that if you are stuck with a machine without vector instructions, or using a programming language that does not support vector instructions, then it is not hard to code and decode that data efficiently with ordinary (scalar) code. You are never going to get the same performance as with SIMD instructions, but it won&rsquo;t be terrible.

__Future work__:

- The code is currently limited to x64/x86 processors, but we are looking for help to port it over to ARM processors. That should be an interesting project! (Resolved: the library now fully supports ARM processors, including NEON optimizations.)
- Like varint-GB and varint-G8IU, we are assuming that the uncompressed integers fit in 32-bit words. That&rsquo;s quite practical, but it would be interesting to extend it to 64-bit integers.
- We have C code that can be easily used within C++ code, but it would be tempting to extend support to other programming languages like Rust, Swift and so forth. (Update: [There is now a Rust port](https://bitbucket.org/marshallpierce/stream-vbyte-rust) as well as a [Go port](https://github.com/nelz9999/stream-vbyte-go).)
- When your integers are signed, even if they are small, our approach does not work as such. But it can be made to work with zigzag encoding.


