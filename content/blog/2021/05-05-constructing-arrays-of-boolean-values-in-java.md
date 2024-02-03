---
date: "2021-05-05 12:00:00"
title: "Constructing arrays of Boolean values in Java"
---



It is not uncommon that we need to represent an array of Boolean (true or false) values. There are multiple ways to do it.

The most natural way could be to construct an array of booleans (the native Java type). It is likely that when stored in an array, Java uses a byte per value.
```C
boolean[] array = new boolean[listSize];
for(int k = 0; k < listSize; k++) {
  array[k] = ((k & 1) == 0) ? true : false;
}
```


You may also use a byte type:
```C
byte[] array = new byte[listSize];
for(int k = 0; k < listSize; k++) {
  array[k] = ((k & 1) == 0) ? (byte)1 : (byte)0;
}
```


You can get more creative and you could do it using an array of strings:
```C
String[] array = new String[listSize];
for(int k = 0; k < listSize; k++) {
  array[k] = ((k & 1) == 0) ? "Found" : "NotFound";
}
```


In theory, Java could optimize the array so that it requires only one bit per entry. In practice, each reference to a string value will use either 32 bits or 64 bits. The string values themselves use extra memory, but Java is probably smart enough not to store multiple times in memory the string &ldquo;Found&rdquo;. It might store it just once.

And then you can do it using a BitSet, effectively using about a bit per value:
```C
BitSet bitset = new BitSet(listSize);
for(int k = 0; k < listSize; k++) {
  if((k & 1) == 0) { bitset.set(k); }
}
```


The BitSet has tremendous performance advantages: low memory usage, fancy algorithms that benefit from word-level parallelism, and so forth.

Typically, you do not just construct such an array, you also use it. But let us say that I just want to construct it as fast as possible, how do these techniques differ? I am going to use 64K array with OpenJDK 8 on an Apple M1 processor.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/05/05). In my benchmark, the content of the arrays is  known at compile time which is an optimistic case (the compiler could just precompute the results!). My results are as follow:

boolean                  |23 us                    |
-------------------------|-------------------------|
byte                     |23 us                    |
String                   |60 us                    |
BitSet                   |50 us                    |


You may divide by 65536 to get the cost in nanoseconds per entry. You may further divide by 3.2GHz to get the number of cycles per entry.

We should not be surprised that the boolean (and byte) arrays are fastest. It may require just one instruction to set the value. The BitSet is about 3 times slower due to bit manipulations. It will also use 8 times less memory.

I was pleasantly surprised by the performance of the String approach. It will use between 4 and 8 times more memory than the simple array, and thus 32 to 64 times more memory than the BitSet approach, but it is reasonably competitive with the BitSet approach. But we should not be surprised. The string values are known at compile-time. Storing a reference to a string should be more computationally expensive than storing a byte value. These numbers tell us that Java can and will optimize String assignments.

I would still disapprove strongly of the use of String instances to store Boolean values. Java may not be able to always optimize away the computational overhead of class instances.

Furthermore, if you do not care about the extra functionality of the BitSet class, with its dense representation, then an array of boolean values (the native type) is probably quite sane.

