---
date: "2019-04-27 12:00:00"
title: "Speeding up a random-access function?"
---



A common problem in software performance is that you are essentially limited by memory access. Let us consider such a function where you write at random locations in a big array.
```C
 for ( i = 0; i < N; i++) {
    // hash is a randomized hash function
    bigarray[hash(i)] = i; 
 }
```


This is a good model for how one might construct a large hash table, for example.

It can be terribly slow if the big array is really large because each and every access is likely to be an expensive cache miss.

Can you speed up this function?

It is difficult, but you might be able to accelerate it a bit, or maybe more than a bit. However, it will involve doing extra work.

Here is a strategy which works, if you do it just right. Divide your big array into regions. For each region, create a stack. Instead of writing directly to the big array, when you are given a hash value, locate the corresponding stack, and append the hash value to it. Then, later, go through the stacks and apply them to the big array.
```C
 
 for ( i = 0; i < N; i++) {
    loc = hash(i)
    add loc, i to buffer[loc / bucketsize]
 }
 for each buffer {
   for each loc,i in buffer
     bigarray[loc] = i
 }
```


It should be clear that this second strategy is likely to save some expensive cache misses. Indeed, during the first phase, we append to only a few stacks: the top of each stack is likely to be in cache because we have few stacks. Then when you unwind the stacks, you are writing in random order, but within a small region of the big array.

This is a standard &ldquo;external memory&rdquo; algorithm: people used to design a lot of these algorithms when everything was on disk and when disks were really slow.

So how well do I do? Here are my results on a Skylake processor using GNU GCC 8 (with <tt>-O3 -march=native</tt>, THP set to madvise).

&nbsp;                   |cycles/access            |instructions/access      |
-------------------------|-------------------------|-------------------------|
standard                 |57                       |13                       |
buffered                 |45                       |36                       |


So while the buffered version I coded uses three times as many instructions, and while it needs to allocate a large buffer, it still comes up on top.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/04/26).

