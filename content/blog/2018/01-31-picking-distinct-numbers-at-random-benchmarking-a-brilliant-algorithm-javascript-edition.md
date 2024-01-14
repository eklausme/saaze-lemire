---
date: "2018-01-31 12:00:00"
title: "Picking distinct numbers at random: benchmarking a brilliant algorithm (JavaScript edition)"
---



Suppose you want to choose m distinct integers at random within some interval ([0,n)). How would you do it quickly?

[I have a blog post on this topic dating back to 2013](/lemire/blog/2013/08/16/picking-n-distinct-numbers-at-random-how-to-do-it-fast/). [This week I came across Adrian Colyer&rsquo;s article where he presents a very elegant algorithm to solve this problem, attributed to Floyd by Bentley](https://blog.acolyer.org/2018/01/30/a-sample-of-brilliance/). The algorithm was presented in an article entitled &ldquo;A sample of brilliance&rdquo; in 1987.

Adrian benchmarks the brilliant algorithm and finds it to be very fast. I decided the revisit Adrian&rsquo;s work. Like Adrian, I used JavaScript.

The simplest piece of code to solve this problem is a single loop&hellip;
```JavaScript
let s = new Set();
while(s.size < m) {
      s.add(randInt(n));
}
```


The algorithm is &ldquo;non-deterministic&rdquo; in the sense that you will generally loop more than m times to select m distinct integers.

The brilliant algorithm is slightly more complicated, but it always loops exactly m times:
```JavaScript
let s = new Set();
for (let j = n - m; j < n; j++) {
        const t = randInt(j);
        s.add( s.has(t) ? j : t );
}
```


It may seem mysterious, but it is actually an intuitive algorithm, as Adrian explains in his original article.

It seems like the second algorithm is much better and should be faster. But how much better is it?

Before I present you my results, [let me port over to JavaScript my 2013 algorithm](/lemire/blog/2013/08/16/picking-n-distinct-numbers-at-random-how-to-do-it-fast/). Firstly, we introduce a function that can generate the answer using a bitset instead of a generic JavaScript Set.
```JavaScript
function sampleBitmap(m, n) {
   var s = new FastBitSet();
   var cardinality = 0
   while(cardinality < m) {
      cardinality += s.checkedAdd(randInt(n));
   }
   return s
}
```


Bitsets are can be much faster than generic sets, see my post [JavaScript and fast data structures](/lemire/blog/2015/10/05/javascript-and-fast-data-structures-some-initial-experiments/).

Secondly, consider the fact that when you need to generate more than m = n/2 integers in the range [0,n), you can, instead, generate m &#8211; n integers, and then negate the result:
```JavaScript
function negate(s, n) {
  var news = new FastBitSet()
  let i = 0
  s.forEach(j => {while(i<j) {
             news.add(i);
             i++}; 
             i = j+1})
  while(i<n) {news.add(i);i++}
  return news
}
```


My complete algorithm is as follows:
```JavaScript
function fastsampleS(m, n) {
    if(m > n / 2 ) {
      let negatedanswer = fastsampleS(n-m, n)
      return negate(negatedanswer)
    }
    if(m * 1024 > n) {
      return sampleBitmap(m, n)
    }
    return sampleS(m, n)
}
```


So we have three algorithms, a naive algorithm, a brilliant algorithm, and my own (fast) version. How do they compare?

m                        |n                        |naive                    |brilliant                |my algo                  |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
10,000                   |1,000,000                |1,200 ops/sec            |1,000 ops/sec            |4,000 ops/sec            |
100,000                  |1,000,000                |96 ops/sec               |80 ops/sec               |700 ops/sec              |
500,000                  |1,000,000                |14 ops/sec               |14 ops/sec               |120 ops/sec              |
750,000                  |1,000,000                |6 ops/sec                |8 ops/sec                |80 ops/sec               |
1,000,000                |1,000,000                |0.4 ops/sec              |5 ops/sec                |200 ops/sec              |


So the brilliant algorithm does not fare better than the naive algorithm (in my tests), except when you need to select more than half of the values in the interval. However, in that case, you should probably optimize the problem by selecting the values you do not want to pick.

My fast bitset-based algorithm is about an order of magnitude faster. [It relies on the FastBitSet.js library](https://github.com/lemire/FastBitSet.js).
[My complete source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/01/31).

