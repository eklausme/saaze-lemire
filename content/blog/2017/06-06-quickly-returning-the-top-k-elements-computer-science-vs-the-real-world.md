---
date: "2017-06-06 12:00:00"
title: "Quickly returning the top-k elements: computer science vs. the real world"
---



A standard problem in computer science is to quickly return the smallest or largest _K_ elements of a list. If the list is made of _N_ elements, then we can solve this problem in time _N_ log (<em>K</em>) using a [binary heap](https://en.wikipedia.org/wiki/Binary_heap).

How would the average programmer solve this problem? My guess is that unless _K_ is 1, then most programmers would simply sort the list and pick the first or last _K_ elements.

That&rsquo;s not such a bad deal. The difference between log (<em>K</em>) and log (<em>N</em>) might not be so large. The logarithm function grows slowly.

It could even be that a well optimized sort function could beat a poorly optimized binary heap.

To test it out in the real world, I wrote a benchmark using a [JavaScript library](https://github.com/lemire/FastPriorityQueue.js). In this benchmark, I generate 1408 random integers and I seek to select the largest 128 integers.

You might ask: why JavaScript? Because JavaScript is everywhere and we should care about its performance.

The code with a priority queue backed by a binary heap looks like this&hellip; we eat the first 128 integers, and then we do a push/poll dance to maintain always the largest 128 integers. (The `blocks` parameter is set at 10 in my tests, generating <tt>(blocks + 1) * 128</tt> values.)
```C
var b = new FastPriorityQueue(defaultcomparator);
for (var i = 0 ; i < 128  ; i++) {
  b.add(rand(i));
}
for (i = 128 ; i < 128 * blocks  ; i++) {
  b.add(rand(i));
  b.poll();
}
```


The sorting routine is somewhat simpler. Just construct a big array, sort it and then extract the first few values:
```C
var a = new Array();
for (var i = 0 ; i < 128 * (blocks + 1)  ; i++) {
   a.push(rand(i));
}
a.sort(function(a, b) {
  return b - a; // in reverse
});
return a.slice(0,128);
```


How does it fare?

The approach using a binary heap can run about 37,000 times a second, whereas the sorting approach is limited to about 4,000 times a second. So a factor-of-ten difference.

In this instance, computer science wins out: using a binary heap pays handsomely.

Another way programmers might implement a top-<em>K</em> is by a SQL ORDER BY/LIMIT query. My friend, professor [Antonio Badia](https://scholar.google.ca/citations?user=LlBDyJcAAAAJ&#038;hl=en), checked how PostgreSQL solves these queries and he believes that they result in a full sort unless there is a tree index on the relevant attribute. Can other databases, such as Oracle or SQL Server do better than PostgreSQL? It is possible, but PostgreSQL is hardly a naive database engine.

Interestingly, it might be quite challenging for a database user to somehow implement a binary heap solution on top of a relational database. Database engines rarely give you direct access to the underlying data structures.

So all your fancy computer science knowledge might be of limited use if your data is managed by an engine you cannot hack.

