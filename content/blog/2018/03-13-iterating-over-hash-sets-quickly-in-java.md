---
date: "2018-03-13 12:00:00"
title: "Iterating over hash sets quickly in Java"
---



There are many ways in software to represent a set. The most common approach is to use a hash table. We define a &ldquo;hash function&rdquo; that takes as an input our elements and produces as an output an integer that &ldquo;looks random&rdquo;. Then your element is stored at the location indicated by the value of the hash function. To check whether the value is in the hash function, you compute the hash function and look at the appropriate location memory. Your elements will thus appear in &ldquo;random&rdquo; order.

This means that unless you do extra work, iterating through the elements in your hash set will be done in random order. Let me pull out my Swift console to demonstrate:
```C
$ var x = Set<Int>()
$ x.insert(1)
$ x.insert(2)
$ x.insert(3)
$ for i in x { print(i) }
2
3
1
```


That is right: you insert the numbers 1, 2, 3 and the numbers 2, 3, 1 come out.

You get the same kind of result in Python:
```C
>>> x = set()
>>> x.add(-1)
>>> x.add(-2)
>>> x.add(-3)
>>> x
set([-2, -1, -3])
```


That is, the hash set is visited starting with the elements having the smallest hash function value. The hash function is often designed to appear random, so the elements come out randomly.

This randomness can take programmers by surprise, so some programming languages like JavaScript and PHP preserve the &ldquo;insertion order&rdquo;. If you pull out your JavaScript console, you get that the set keeps track of the order in which you inserted the element and gives it back to you:
```C
> var x = new Set()
> x.add(-3)
Set { -3 }
> x.add(-2)
Set { -3, -2 }
> x.add(-1)
Set { -3, -2, -1 }
> x.add(3)
Set { -3, -2, -1, 3 }
> x.add(2)
Set { -3, -2, -1, 3, 2 }
> x.add(1)
Set { -3, -2, -1, 3, 2, 1 }
```


This can be implemented as a [linked list](https://en.wikipedia.org/wiki/Linked_list) working on top of the hash table.
Java supports both approaches through HashSet and LinkedHashSet.

The LinkedHashSet will use more memory, but it gives back the elements in insertion order. The HashSet gives back the element in an order determined in large part by the hash function. The LinkedHashSet may allow you to iterate over the elements faster because you are essentially bypassing the hash table entirely and just following the linked list. Linked lists are not great in the sense that each node being visited can incur a cache miss. However, Java&rsquo;s HashSet is implemented using a [fancy chaining approach](https://zgrepcode.com/java/openjdk/10.0.2/java.base/java/util/hashmap.java), so you will be chasing pointers in memory and possibly also having cache misses.
So it would seem like LinkedHashSet is a good choice in Java if you are not memory bound.

To explore this problem, I took a set made of 1 million integers generated randomly. I insert them into both a HashTable and a LinkedHashTable. Then I sum the values. [I run my benchmark on a Skylake processor with Java 8](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/03/13):

class                    |sum values               |
-------------------------|-------------------------|
HashSet                  |50 ops/s                 |
LinkedHashSet            |150 ops/s                |


My numbers are clear: in my tests, it is three times faster to sum up the values in a LinkedHashSet. [You can reproduce my benchmark.](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/03/13)

