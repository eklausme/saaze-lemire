---
date: "2015-10-15 12:00:00"
title: "On the memory usage of maps in Java"
---



Though we have plenty of memory in our computers, there are still cases where you want to minimize memory usage if only to avoid expensive cache faults.
To compare the memory usage of various standard map data structures, I wrote [a small program](https://github.com/lemire/HashVSTree) where I create a map from the value `k` to the value `k` where `k` ranges from 1 to a 100,000, using either a string or integer representation of the value <tt>k</tt>. As a special case, I also create an array that contains two strings, or two integers, for each value of <tt>k</tt>. This is &ldquo;optimal&rdquo; as far as memory usage is concerned since only the keys and values are stored (plus some small overhead for the one array). Since my test is in Java, I store integers using the Integer class, and strings using the String class.

Class                    |String, String           |Integer, Integer         |
-------------------------|-------------------------|-------------------------|
array                    |118.4                    |40.0                     |
fastutil                 |131.4                    |21.0                     |
HashTable                |150.3                    |71.8                     |
TreeMap                  |150.4                    |72.0                     |
HashMap                  |152.9                    |74.5                     |
LinkedHashMap            |160.9                    |82.5                     |


The worst case is given by the LinkedHashMap which uses twice as much space as an array in the Integer, Integer scenario (82.5 bytes and 40 bytes respectively).
I have also added the fastutil library to the tests. Its hash maps use open addressing, which has reduced memory usage (at the expense of expecting good hash functions). The savings are modest in this test (10%). However, in the Integer-Integer test, I used the library&rsquo;s ability to work with native ints, instead of Integer objects. The savings are much more significant in that instance: for each pair of 32-bit integers, we use only 21 bytes, compared to 74.5 bytes for the HashMap class.

Looking at these number, we must conclude that the relative overhead due to the map data structure is small. Of course, Java objects eat up a lot of memory. Each Integer object appears to take 16 bytes. Each String object appears to use at least 40 bytes. That&rsquo;s for the objects themselves. To use them inside another data structure, you have to pay the price of a pointer to the object.
In Java, the best way to save memory is to use a library, like fastutil, that works directly with native types.

__Conclusion__: Whether you use a TreeMap or HashMap seems to have very little effect on your memory usage.
Note: Please do not trust my numbers, [review my code](https://github.com/lemire/HashVSTree/blob/master/src/test/java/me/lemire/memory/MemoryBenchmarkTest.java) instead.
