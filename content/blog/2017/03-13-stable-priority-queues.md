---
date: "2017-03-13 12:00:00"
title: "Stable Priority Queues?"
---



A [priority queue](https://en.wikipedia.org/wiki/Priority_queue) is a data structure that holds a set of elements and can return quickly the smallest (or alternatively the largest) element. It is usually implemented using a [binary heap](https://en.wikipedia.org/wiki/Binary_heap).

So you &ldquo;add&rdquo; elements to the priority queue, and then you can &ldquo;poll&rdquo; them out.

Suppose however that you insert elements that are equal. What happens? Because [binary heaps are not stable](http://cstheory.stackexchange.com/questions/593/is-there-a-stable-heap), your elements may not come out in insertion order.

For example, suppose you add the following tuples to a priority queue:
```C
[{ name: 'player', energy: 10},
 { name: 'monster1', energy: 10},
 { name: 'monster2', energy: 10},
 { name: 'monster3', energy: 10}
]
```


You could poll them back out based on their &ldquo;energy&rdquo; value in a different order&hellip; even though they all have the same &ldquo;energy&rdquo;&hellip;
```C
[{ name: 'player', energy: 10},
 { name: 'monster3', energy: 10},
 { name: 'monster2', energy: 10},
 { name: 'monster1', energy: 10}
]
```


That&rsquo;s not very elegant.

Thankfully, there is an almost trivial approach to get a stable priority queue. Just add some kind of counter recording the insertion order, and when you insert elements in the binary heap, just use the insertion order as to differentiate elements. Thus, for _a_ to be smaller than <em>b</em>, it is enough for the value of _a_ to be smaller than the value _b_ or that _a_ be the same as _b_ in value, but with a smaller insertion counter.

For example, we might store the following:
```C
[{ value: { name: 'player', energy: 10 }, counter: 0 }
{ value: { name: 'monster1', energy: 10 }, counter: 1 }
{ value: { name: 'monster2', energy: 10 }, counter: 2 }
{ value: { name: 'monster3', energy: 10 }, counter: 3 }]
```


When comparing any two objects in this example, we not only compare them by their &ldquo;energy&rdquo; attribute, but also by their &ldquo;counter&rdquo; attribute.

So I implemented it in JavaScript as a package called [StablePriorityQueue.js](https://github.com/lemire/StablePriorityQueue.js).

Easy!

I can&rsquo;t promise that the performance will be as good as [a speed-optimized priority queue](https://github.com/lemire/FastPriorityQueue.js), however.

This lead me to a follow-up question: what is the best (most efficient) way to implement a stable priority queue?

Since the standard binary heap does not support tracking the insertion order, we chose to append an insertion counter. That&rsquo;s reasonable, but is it the most efficient approach?

And, concretely, what would be the best way to implement it in a given language? (Java, JavaScript&hellip;)

The ultimate goal would be to get a stable priority queue that has nearly the same speed as a regular priority. How close can we get to this goal?

__Credit__: Thanks to [David Ang](https://github.com/mickeyren) for inspiring this question.

