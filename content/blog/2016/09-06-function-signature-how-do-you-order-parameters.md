---
date: "2016-09-06 12:00:00"
title: "Function signature: how do you order parameters?"
---



Most programming languages force you to order your function parameters. Getting them wrong might break your code.

What is the most natural way to order the parameters?

A language should aim to be generally consistent to minimize surprises. For example, in most languages, to copy the value of the variable `source` into variable <tt>destination</tt>, you&rsquo;d write:
```C
destination = source;
```


So it makes sense that, in C, we have the following copy function:
```C
memcpy(void *destination, const void *source, size_t n);
```


Go, the new language designed by some of the early C programmers, follows the same tradition:
```C
func copy(destination, source []T) int
```


Meanwhile, Java is arguably backward with the `arraycopy` function:
```C
void arraycopy(Object source,
             int sourcePos,
             Object destination,
             int destinationPos,
             int length);
```


The justification for Java&rsquo;s order is that, in English, you say that you copy from the source to the destination. Nobody says &ldquo;I copied to `x` the value <tt>y</tt>&ldquo;. But then why don&rsquo;t we write a value copy from `y` to `x` as follows?
```C
y->x;
```


Sadly, Java is not even consistent in being backward. For example, to copy data from the ByteBuffer `destination` to the ByteBuffer <tt>source</tt>, you have to write:
```C
destination.put(source);
```


This is, in my opinion, the correct order, but if you are used to having the source being first, you might be confused by that particular ordering.

Ok. So what about working with a data structure, like a hash table? A hash table is not very different from an array conceptually, and we set array values in this manner:
```C
array[index] = value
```


So I would argue that the proper function signature for the insertion of a key-value in a hash table should be something of the sort:
```C
insert(hashtable_type hashtable,
        const key_type key,
        const value_type value);
```


In Go, this is how you add an element to a Heap:
```C
func Push(h Interface, x interface{})
```


More generally, when acting on a data structure, I would argue that the data structure being modified (if any) should be the first parameter.

What if you want to implement an in-place operation, for example, maybe you want to compute the bitwise AND of `x` and <tt>y</tt>, and put the result in <tt>x</tt>:
```C
x &= y
```


And this how you&rsquo;d implement it in C++, putting the `x` before the <tt>y</tt>:
```C
type operator&(type & x, const type& y) {
   return x &= y;
}
```


I wonder whether it would be possible to produce a tool that detects confusing or inconsistent parameter ordering?

