---
date: "2017-06-21 12:00:00"
title: "Top speed for top-k queries"
---



Suppose that I give you a stream of values and you want to maintain the top-<em>k</em> smallest or largest values. You could accumulate all these values, sort them all and keep the smallest _k_ values.

You can do somewhat better by using a binary heap to construct a priority queue. And you can also use the QuickSelect algorithm. I compared naive implementations of both the approach based on a binary heap and on QuickSelect in a previous [blog post](/lemire/blog/2017/06/14/quickselect-versus-binary-heap-for-top-k-queries/).

Let us review the code of these techniques. I use JavaScript because it is supported everywhere.

We can sort and slice&hellip;
```C
var a = new Array();
for (var i = 0; i < streamsize; i++) {
            a.push(rand(i));
}
a.sort(function(a, b) {
            return a - b
});
var answer = a.slice(0, k);
```


We can dump everything naively into a priority queue (backed by a binary heap)&hellip;
```C
var reverseddefaultcomparator = function(a, b) {
    return a > b;
};
```

```C
var b = new FastPriorityQueue(reverseddefaultcomparator);
for (var i = 0; i < k; i++) {
            b.add(rand(i));
}
for (i = k; i < streamsize; i++) {
            b.add(rand(i));
            b.poll();
}
var answer = b.array.slice(0, k).sort(function(a, b) {
            return a - b
});
```


Each time we call `poll` in the priority queue, we remove the largest element. Thus we maintain a list of _k_ smallest elements.

I now want to consider less naive implementations of these ideas.

At all time, we have access to the largest element in the priority queue through the `peek` function. Long-time reader Kendall Willets pointed out to me that we can make good use of the `peek` function as follows.
```C
var b = new FastPriorityQueue(reverseddefaultcomparator);
 for (var i = 0; i < k; i++) {
            b.add(rand(i));
 }
 for (i = k; i < streamsize; i++) {
            var x = rand(i);
            if (x < b.peek()) {
                b.add(x);
                b.poll();
            }
 }
 var answer = b.array.slice(0, k).sort(function(a, b) {
            return a - b
 });
```


This has the potential of reducing substantially the amount of work that the priority queue has to do.

What about the QuickSelect algorithm?

Michel Lemay pointed out to me what the [Google Guava library does](https://plus.google.com/+googleguava/posts/QMD74vZ5dxc), which is to use a small buffer (of size <em>k</em>) and to run QuickSelect on this small buffer instead of the whole stream of data.
```C
var a = new Array();
for (var i = 0; i < 2 * k; i++) {
            a.push(rand(i));
}
QuickSelect(a, k, defaultcomparator);
var eaten = 2 * k;
while (eaten < streamsize) {
            for (var i = 0; i < k; i++) {
                a[k + i] = rand(i + eaten);
            }
            QuickSelect(a, k, defaultcomparator);
            eaten += k;
}
var answer = a.slice(0, k).sort(function(a, b) {
            return a - b
});
```


David Eppstein described to me something slightly more complex where we use our knowledge of the pivot in the QuickSelect algorithm to only merge potential candidates.
```C
var a = new Array();
var i = 0;
for (; i < 2 * k; i++) {
            a.push(rand(i));
}
QuickSelect(a, k, defaultcomparator);
var pivotvalue = a[k];
var locationinbuffer = k;
for (; i < streamsize; i += 1) {
            var newvalue = rand(i);
            if (newvalue < pivotvalue) {
                a[locationinbuffer++] = newvalue;
            }
            if (locationinbuffer == 2 * k) {
                QuickSelect(a, k, defaultcomparator);
                locationinbuffer = k;
            }
}
if (locationinbuffer != k) {
            QuickSelect(a, k, defaultcomparator);
}
var answer = a.slice(0, k).sort(function(a, b) {
            return a - b
});
```


It is not exactly what David described, but I believe that it captures the essence of his idea.

So how do these techniques fare?<br/>
[I have implemented a benchmark that you can run yourself](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/06/21), here are my raw results:
```C
$ node test.js
Platform: linux 4.4.0-38-generic x64
Intel(R) Core(TM) i7-6700 CPU @ 3.40GHz
Node version 4.5.0, v8 version 4.5.103.37


starting dynamic queue/enqueue benchmark
FastPriorityQueue x 3,095 ops/sec ±0.15% (97 runs sampled)
FastPriorityQueue-KWillets x 18,875 ops/sec ±0.59% (93 runs sampled)
sort x 490 ops/sec ±0.37% (94 runs sampled)
QuickSelect x 8,576 ops/sec ±0.31% (97 runs sampled)
QuickSelect-naiveGoogleGuava x 6,003 ops/sec ±0.20% (98 runs sampled)
QuickSelect-naiveDavidEppstein x 7,317 ops/sec ±0.22% (98 runs sampled)
```


So in my particular test, the approach proposed by Kendall Willets, using a priority queue with pruning based on the peek value, is a net winner. Your results might vary, but I think that the Willets approach is attractive. It is simple, it uses little memory and it should provide consistent performance.

__Exercise for the reader__: I am using a random input in my benchmark. As pointed out by David Eppstein, this means that we can bound the probability that the <em>i</em>th value is in the top-<em>k</em> by min(1, <em>k</em>/<em>i</em>), so that the Willets check only fails O(<em>k</em> log <em>n</em>) times. How well would the different techniques do for nearly sorted data?

__Update__: As pointed out in the comments, we can further improve the Willets approach by merging the add and poll functions into a single function. The code is similar&hellip;
```C
var b = new FastPriorityQueue(reverseddefaultcomparator);
 for (var i = 0; i < k; i++) {
                b.add(rand(i));
 }
 for (i = k; i < streamsize; i++) {
                var x = rand(i);
                if (x < b.peek()) {
                    b.replaceTop(x);
                }
 }
 var answer = b.array.slice(0, k).sort(function(a, b) {
                return a - b
 });
```


So what is the performance this time?
```C
$ node test.js
Platform: linux 4.4.0-38-generic x64
Intel(R) Core(TM) i7-6700 CPU @ 3.40GHz
Node version 4.5.0, v8 version 4.5.103.37


starting dynamic queue/enqueue benchmark
FastPriorityQueue x 3,137 ops/sec ±0.13% (97 runs sampled)
FastPriorityQueue-KWillets x 19,027 ops/sec ±0.37% (94 runs sampled)
FastPriorityQueue-KWillets-replaceTop x 22,200 ops/sec ±0.46% (95 runs sampled)
sort x 479 ops/sec ±0.42% (92 runs sampled)
QuickSelect x 8,589 ops/sec ±0.31% (98 runs sampled)
QuickSelect-naiveGoogleGuava x 5,661 ops/sec ±0.22% (97 runs sampled)
QuickSelect-naiveDavidEppstein x 7,320 ops/sec ±0.25% (98 runs sampled)
```


So we improve the performance once more!

__Update 2__: You can combine a binary heap and QuickSelect using [introselect](https://en.wikipedia.org/wiki/Introselect). 

