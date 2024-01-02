---
date: "2019-11-25 12:00:00"
title: "Memory parallelism: AMD Rome versus Intel"
---



When thinking about &ldquo;parallelism&rdquo;, most programmers think about having multiple processors. However, even a single core in a modern processor has plenty of parallelism. It can execute many instructions per cycle and, importantly, it can issue multiple memory requests concurrently.

Our processors are becoming &ldquo;more parallel&rdquo; over time, as is evident by the recent increases in the number of cores. AMD sells 64-core processors. But each individual core is also becoming &ldquo;more parallel&rdquo;.

To demonstrate, let me use a memory access test.

The starting point is a shuffled array. You access one entry in the array, read the result, and it points to the next location in the array. You get a random walk through an array. The test terminates when you have visited every location in the array.

Then you can &ldquo;parallelize&rdquo; this problem. Divide the random walk into two equal-size paths. Or divide it into 10 equal-size paths.

If you can issue only one memory request at any one time, parallelizing the problem won&rsquo;t help. However, processors can issue more than one memory request and so as you parallelize the problem, your running times get smaller and your effective bandwidth higher.

How has this evolved over time? The very latest Intel processors (e.g., Cannon Lake), can sustain more than 20 memory requests at any one time. It is about twice what the prior generation (Skylake) could do. How do the latest AMD processor fare? About the same. They can sustain nearly 20 concurrent memory requests at any one time. AMD does not quite scale as well as Intel, but it is close. In these tests, I am hitting RAM: the array is larger than the CPU cache. I am also using huge pages.

<a href="https://lemire.me/blog/wp-content/uploads/2019/11/results.png"><img fetchpriority="high" decoding="async" class="alignnone size-full wp-image-18009" src="https://lemire.me/blog/wp-content/uploads/2019/11/results.png" alt width="640" height="480" srcset="https://lemire.me/blog/wp-content/uploads/2019/11/results.png 640w, https://lemire.me/blog/wp-content/uploads/2019/11/results-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" /></a>

The important lesson is that if you are thinking about your computer as a sequential machine, you can be dramatically wrong, even if you are just using one core.

And there are direct consequences. It appears that many technical interviews for engineering positions have to do with [linked lists](https://en.wikipedia.org/wiki/Linked_list). In a linked list, you access the element of a list one by one, as the location of the next entry is always coded in the current entry and nowhere else. Obviously, it is a potential problem performance-wise because it makes it hard to exploit memory-level parallelism. And the larger your list, the more recent your processor, the worse it gets.

I make the [raw results available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/11/25). I use the [testingmlp software package](https://github.com/lemire/testingmlp).

