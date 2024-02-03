---
date: "2018-05-24 12:00:00"
title: "Graph algorithms and software prefetching"
---



A lot of data in the real world can be represented as graphs: you have nodes connected through edges. For example, you are a node in a graph where friendships are edges.

I recently met with professor [Semih Salihoglu](https://cs.uwaterloo.ca/~ssalihog/), an expert in graph databases and algorithms. We discussed fun problem like how one can find the shortest path between two nodes in a very large graph.

Semih argued something to the effect that, often, the best you can do is a [breadth-first search](https://en.wikipedia.org/wiki/Breadth-first_search). That sounds scary and fancy&hellip; but it is actually super simple. Start from a given node. This node is at level 0. Then visit all its neighbors (by iterating through its edges). These nodes are at level 1. Then visit all the nodes connected to the nodes at level 1 (excluding your starting node), these are at level 2. And so forth. The magic is that you will end up visiting once (and exactly once) all nodes that can be reached from your starting node.

With this approach, you can find the distance between any two nodes. Just keep exploring, starting from one of the two nodes, until you encounter the other node.

But what happens if the graph is very large? These nodes you are visiting are all over your memory. This means that each node access is a potential cache fault. Our processors are super fast, and they have super fast memory close to them (cache memory), but your main memory (RAM) is comparatively much slower.

Thus, when processing a large graph, you are likely memory-bound&hellip; meaning that much of the time is spent waiting for memory access. It is worse than it appears because memory access is a shared resource in multicore processors, which means that you cannot make this problem go away cheaply by buying a processor with many more cores.

Can we quantify this?

I built a large random graph made of 10 million nodes where each node has 16 random neighbors.

I pick a node at random, seek another node far away, and then I measure the time it takes to do the breadth-first search from one to the other. On a per-edge basis, it takes 23 cycles. Don&rsquo;t worry, things get much worse if the graph gets larger, but let us reflect on the fact that 23 cycles to merely look at the node identifier, check if it has been visited and if not, add it to our list&hellip; is a lot. Not counting memory accesses, we should be able to do this work in 5 cycles or less.

 Can we do better than 23 cycles?

What if, right before you start processing the neighbors of one node, you told your processor to go fetch the neighbors of the next node? I have a recent post on this very topic: [Is software prefetching (__builtin_prefetch) useful for performance?](/lemire/blog/2018/04/30/is-software-prefetching-__builtin_prefetch-useful-for-performance/)

In that post, I explained that Intel processors have prefetching instructions that the software can call. I also recommended to avoid them.

So what happens if I add a prefetch instruction to my graph code? I go down to 16 cycles&hellip; saving a third of the running time.

naive breadth-first search |23 cycles per edge visited |
-------------------------|-------------------------|
prefetched breadth-first search |16 cycles per edge visited |


[My code is available (in C)](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/05/24).

My result would seem to invalidate my recommendation to avoid software prefetches. But keep in mind that my implementation is naive and limited, thrown together in a couple of hours. It is a proof of concept. What it demonstrates is that even if you are limited by memory accesses, there are still software choices you can make to help you.

I would only change my recommendation against software prefetches if we definitively could not rewrite the code differently to get the same benefits. I think we can write more clever code.

There are many problems with software prefetches. In some cases, as is the case here, it is better than nothing&hellip; But it is still a fragile hack. It helps in my particular case, but change the parameters of the graph, and things might go to hell. Update your processor and things could go to hell. And there is no way to know whether the exact way I did it is close to optimal&hellip; it works well in my case, but it might require much tuning in other instances.

So how can we write the code better? I am not certain yet.

__Follow-up__: [Greater speed in memory-bound graph algorithms with just straight C code](/lemire/blog/2018/05/28/greater-speed-inâ€¦-straight-c-code/)

