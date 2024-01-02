---
date: "2020-11-30 12:00:00"
title: "Java Buffer types versus native arrays: which is faster?"
---



When programming in C, one has to allocate and de-allocate memory by hand. It is an error prone process. In contrast, newer languages like Java often manage their memory automatically. Java relies on garbage collection. In effect, memory is allocated as needed by the programmer, and then Java figures out that some piece of data is no longer needed, and it retrieves the corresponding memory. The garbage collection process is fast and safe, but it is not free: despite decades of optimization, it can still cause major headaches to developers.

Java has native arrays (e.g., the int[] type). These arrays are typically allocated on the &ldquo;Java heap&rdquo;. That is, they are allocated and managed by Java as dynamic data, subject to garbage collection.

Java also has Buffer types such as the IntBuffer. These are high-level abstractions that can be backed by native Java arrays but also by other data sources, including data that is outside of the Java heap. Thus you can use Buffer types to avoid relying so much on the Java heap.

But my experience is that it comes with some performance penalty compared to native arrays. I would not say that Buffers are slow. In fact, given a choice between a Buffer and a stream (DataInputStream), [you should strongly favour Buffer types](/lemire/blog/2019/03/18/dont-read-your-data-from-a-straw/). However, they are not as fast as native arrays in my experience.

I can create an array of 50,000 integers, either with &ldquo;new int[50000]&rdquo; or as &ldquo;IntBuffer.allocate(50000)&rdquo;. The latter should essentially create an array (on the Java heap) but wrappred with an IntBuffer &ldquo;interface&rdquo;.

A possible intuition is that wrapping an array with an high-level interface should be free. Though it is true that high level abstractions can come with no performance penalty (and sometimes, even, performance gains), whether they do is an empirical matter. You should never just assume that your abstraction comes for free.

Because I am making an empirical statement, let us test it out empirically with the simplest test I can imagine. I am going to add one to every element in the array/IntBuffer.
```C
for(int k = 0; k  < s.array.length; k++) { 
    s.array[k] += 1;
}
```

```C
for(int k = 0; k  < s.buffer.limit(); k++) { 
    s.buffer.put(k, s.buffer.get(k) + 1);
}
```


I get the following results on my desktop (OpenJDK 14, 4.2 GHz Intel processor):

int[]                    |2.5 mus                  |
-------------------------|-------------------------|
IntBuffer                |12 mus                   |


That is, arrays are over 4 times faster than IntBuffers in this test.

[You can run the benchmark yourself if you&rsquo;d like](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/11/30).

My expectation is that many optimizations that Java applies to arrays are not applied to Buffer types.

Of course, this tells us little about what happens when Buffers are used to map values from outside of the Java heap. My experience suggests that things can be even worse.

Buffer types have not made native arrays obsolete, at least not as far as performance is concerned.

