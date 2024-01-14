---
date: "2019-03-18 12:00:00"
title: "Don´t read your data from a straw"
---



It is common for binary data to be serialized to bytes. Data structures like indexes can be saved to disk or transmitted over the network in such a form. Many serialized data structures can be viewed as sets of &lsquo;integer&rsquo; values. That is the case, for example, of a [Roaring bitmap](https://github.com/RoaringBitmap/RoaringBitmap). We must then read back this data. An integer could be serialized as four bytes in a stream of bytes.
We are thus interested in the problem where we want to convert an array of bytes into an array of integer values.

In C or C++, you can safely convert from a stream of bytes to in-memory values using a function like &lsquo;memcpy&rsquo;. It is fast. Or you can just cheat and do a &ldquo;cast&rdquo;.

What do you do in Java?

A convenient approach is to wrap the byte array into an InputStream and then wrap that InputStream into a [DataInputStream](https://docs.oracle.com/javase/8/docs/api/java/io/DataInputStream.html), like in this example where we convert an array of bytes into an array of integers:
```C
byte[] array = ...
int[] recipient = new int[N / 4];
DataInput di = new DataInputStream(new 
            ByteArrayInputStream(array));
for(int k = 0; k < recipient.length; k++)
    recipient[k] = di.readInt();
```


The benefit of this approach is improved abstraction: you do not care whether the data comes from an array of bytes or from disk, it is all the same code. If you are have serialization and deserialization code, it is probably written in terms of OutputStream and InputStream anyhow, so why not reuse that perfectly good code?

However, Java offers a performance-oriented concept called a [ByteBuffer](https://docs.oracle.com/javase/8/docs/api/java/nio/ByteBuffer.html) to represent and array of bytes. It is not as high level as an input stream since it assumes that you do have, somewhere, an array of bytes.
You can achieve the same conversion as before using a ByteBuffer instead:
```C
byte[] array = ...
int[] recipient = new int[N / 4];
ByteBuffer bb = ByteBuffer.wrap(s.array);
bb.asIntBuffer().get(recipient);
```


Here is the time required to convert 1 million 32-bit integers on my 4.2GHz 2018 iMac:

DataInputStream          |10 ms                    |
-------------------------|-------------------------|
ByteBuffer               |1 ms                     |


That is, the ByteBuffer is 10x faster. [My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/03/18).

Because I have 1 million integers, we can convert back these timings into &ldquo;time per integer&rdquo;: the ByteBuffer approach achieves a speed of one 32-bit integer converted per nanosecond. Given that my iMac can execute probably something like a dozen operations per nanosecond, that&rsquo;s not impressive&hellip; but it is at least a bit respectable. The DataInputStream takes 10 nanosecond (or something like 40 or 50 cycles) per integer: it is grossly inefficient.

This has interesting practical consequences. In the [RoaringBitmap project](https://github.com/RoaringBitmap/RoaringBitmap/issues/319), [Alvarado pointed out that it is faster](https://github.com/RoaringBitmap/RoaringBitmap/issues/319) to create a bitmap using a ByteBuffer backend, and then convert it back into an normal data structure, than to construct it directly from an input steam. And the difference is not small.

Practically, this means that it may be worth it to provide a special function that can construct a bitmap directly from a ByteBuffer or a byte array, bypassing the stream approach. (Thankfully, we have bitmaps backed with ByteBuffer to support applications such as memory-file mapping.)
Speaking for myself, I was going under the impression that Java would do a fine job reading from a byte array using an input stream. At the very least, we found that ByteArrayInputStream is not the right tool. That a ByteBuffer would be fast is not so surprising: as far as I can tell, they were introduced in the standard API precisely for performance reasons. However, a factor of ten is quite a bit more than I expected.

In any case, it is a perfectly good example of the problem whereas abstractions force you to consume data as if it went through a straw. Streams and iterators are handy abstractions but they often lead you astray with respect to performance.

__Further reading__. [Ondrej Kokes has reproduced these results in Go](https://kokes.github.io/blog/2019/03/19/deserialising-ints-from-bytes.html).

