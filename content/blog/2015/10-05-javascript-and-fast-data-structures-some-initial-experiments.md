---
date: "2015-10-05 12:00:00"
title: "JavaScript and fast data structures: some initial experiments"
---



Two of my favorite data structures are the bitset and the heap. The latter is typically used to implement a priority queue.

Both of these data structures come by default in Java. In JavaScript, there is a multitude of implementations, but few, if any, are focused on offering the best performance. That&rsquo;s annoying because these data structures are routinely used to implement other fast algorithms. So I did what all programmers do, I started coding!

I first implemented a fast heap in JavaScript called [FastPriorityQueue.js](https://github.com/lemire/FastPriorityQueue.js). As a programmer, I found that JavaScript was well suited to the task. [My implementation feels clean](https://github.com/lemire/FastPriorityQueue.js/blob/master/FastPriorityQueue.js).

How does it compare with Java&rsquo;s PriorityQueue? To get some idea, I wrote a [silly Java benchmark](https://github.com/lemire/FastPriorityQueue.js/blob/master/benchmark/javacmp/NaiveJavaVersion.java). The result? My JavaScript version can execute my target function over 27,000 times per second on Google&rsquo;s V8 engine whereas Java can barely do it 13,000 times. So my JavaScript smokes Java in this case. Why? I am not exactly sure, but I believe that Java&rsquo;s PriorityQueue implementation is at fault. I am sure that a heap implementation in Java optimized for the benchmark would fare much better. But I should point out that my JavaScript implementation uses [far fewer lines of code](https://github.com/lemire/FastPriorityQueue.js/blob/master/FastPriorityQueue.js). So bravo for JavaScript!

I also wrote a fast bitset implementation in JavaScript. This was more difficult. JavaScript does not have any support for 64-bit integers as far as I can tell though it supports arrays of 32-bit integers (Uint32Array). I did with what JavaScript had, and I published [the FastBitSet.js library](https://github.com/lemire/FastBitSet.js). How does it compare against Java? One benchmark of interest is the number of times you can compute the union between two bitsets (generating a new bitset in the process). In Java, I can do it nearly 3 million times a second. The JavaScript library appears limited to 1.1 million times per second. That&rsquo;s not bad at all&hellip; especially if you consider that JavaScript is a very ill-suited language to implement a bitset (i.e., no 64-bit integers). When I tried to optimize the JavaScript version, to see if I could get it closer to the Java version, I hit a wall. At least with Google&rsquo;s V8 engine, creating new arrays of integers (Uint32Array) is surprisingly expensive and seems to have nothing to do with just allocating memory and doing basic initialization. You might think that there would be some way to quickly copy an Uint32Array, but it seems to be much slower than I expect.

To illustrate my point, if I replace my bitset union code&hellip;
```JavaScript
answer.words = new Uint32Array(answer.count);
for (var k = 0; k < answer.count; ++k) {
   answer.words[k] = t[k] | o[k];
}
```


by just the allocation&hellip;
```JavaScript
answer.words = new Uint32Array(answer.count);
```


&hellip; the speed goes from 1.1 million times per second to 1.5 million times per second. This means that I have no chance to win against Java. Roughly speaking, JavaScript seems to allocate arrays about an order of magnitude slower than it should. That&rsquo;s not all bad news. With further tests, I have convinced myself that if we can just reuse arrays, and avoid creating them, then we can reduce the gap between JavaScript and Java: Java is only twice as fast when working in-place (without creating new bitsets). I expected such a factor of two because JavaScript works with 32-bit integers whereas Java works with 64-bit integers. 

What my experiments have suggested so far is that JavaScript&rsquo;s single-threaded performance is quite close to Java&rsquo;s. If Google&rsquo;s V8 could gain support for 64-bit integers and faster array creation/copy, it would be smooth sailing.

__Update__: I ended up concluding that typed arrays (Uint32Array) should not be used. I switched to standard arrays for better all around performance.

Links to the JavaScript libraries:

- [FastPriorityQueue.js](https://github.com/lemire/FastPriorityQueue.js): a fast heap-based priority queue in JavaScript.
- [FastBitSet.js](https://github.com/lemire/FastBitSet.js): a fast bitset in JavaScript.


