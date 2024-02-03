---
date: "2018-05-28 12:00:00"
title: "Greater speed in memory-bound graph algorithms with just straight C code"
---



Graph algorithms are often memory bound. When you visit a node, there is no reason to believe that its neighbours are located nearby in memory.

[In an earlier post](/lemire/blog/2018/05/24/graph-algorithms-and-software-prefetching/), I showed how we could accelerate memory-bound graph algorithms by using software prefetches. We were able to trim a third of the running time just by adding a line of code. But I do not like nor recommend software prefetching.

In my test case, I am trying to find the distance between two nodes by doing a breadth-first search. I use a random graph containing 10 million nodes and where each node has degree 16 (meaning that each node has 16 neighbours). I start from one node, visit all its neighbours, then visit the neighbours of the neighbours, until I arrive at my destination. The pseudocode is as follows:
```C
insert my starting node in a queue
for each node x in my queue {
  for each node y connected to x {
    // option: prefetch the node y' that follows y
    if (y is my target) {
      // success
    }
    if (y is new) {
       add y to next queue
    }
  }
}
```


I can rewrite this code where I visit the nodes in chunks. So I grab 8 nodes, I look at the first neighbour of each of the 8 nodes, then I look at the second neighbour of the 8 nodes and so forth. We interleave neighbours. The pseudocode looks as follows:
```C
insert my starting node in a queue
// divide the queue into chunks of up to 8 nodes
for each chunk of nodes x1, x2, ..., x8 in my queue {
  for index i in 1, 2..., degree {
     for x in x1, x2, ..., x8 {
       let y be neighbour i of x
       if (y is my target) {
         // success
       }
       if (y is new) {
         add y to next queue
       }
     }
  }
}
```


From a purely computer science perspective, this new pseudocode should not be faster. You will not find it in any textbook I know. Yet it is considerably faster when working over large graphs.

How fast is this new approach? About twice as fast as the naive approach, and faster than the one relying on software prefetches. [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/05/28).

naive breadth-first search |23 cycles per edge visited |
-------------------------|-------------------------|
prefetched breadth-first search |16 cycles per edge visited |
new approach             |12 cycles per edge visited |


I like this example because it illustrates quite well that even if a problem is memory-bound, you can still code a faster solution. There is no need for specialized instructions. There is no need to move anything around in memory. How you access the data matters.

I should point out that this is just something I threw together during a lazy Monday. It is probably nowhere near optimal. It is totally lacking in sophistication. Yet it works. Moreover, it is going to be effective on almost all modern computer architectures.

