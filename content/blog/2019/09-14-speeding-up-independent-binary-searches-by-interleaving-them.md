---
date: "2019-09-14 12:00:00"
title: "Speeding up independent binary searches by interleaving them"
---



Given a long list of sorted values, how do you find the location of a particular value? A simple strategy is to first look at the middle of the list. If your value is larger than the middle value, look at the last half of the list, if not look at the first half of the list. Then repeat with select half, looking again in the middle. This algorithm is called a binary search. One of the first algorithms that computer science students learn is the binary search. I suspect that many people figure it out as a kid.

It is hard to drastically improve on the binary search if you only need to do one.

But what if you need to execute multiple binary searches, over distinct lists? Maybe surprisingly, in such cases, you can multiply the speed.

Let us first reason about how a binary search works. The processor needs to retrieve the middle value and compare it with your target value. Before the middle value is loaded, the processor cannot tell whether it will need to access the last or first half of the list. It might speculate. Most processors have branch predictors. In the case of a binary search, the branch is hard to predict so we might expect that the branch predictor will get it wrong half the time. Still: when it speculates properly, it is a net win. Importantly, we are using the fact that processors can do multiple memory requests at once.

What else could the processor do? If there are many binary searches to do, it might initiate the second one. And then maybe initiate the third one and so forth. This might be a lot more beneficial than speculating wastefully on a single binary search.

How can it start the second or third search before it finishes the current one? Again, due to speculation. If it is far along in the first search to predict its end, it might see the next search coming and start it even though it is still waiting for data regarding the current binary search. This should be especially easy if your sorted arrays have a predictable size.

There is a limit to how many instructions your processor might reorder in this manner. Let us say, for example, that the limit is 200 instructions. If each binary search takes 100 instructions, and that this value is reliable (maybe because the arrays have fixed sizes), then your processor might be able do up to two binary searches at once. So it might go twice as fast. But it probably cannot easily go much further (to 3 or 4).

But the programmer can help. We can manually tell the processor initiate right away four binary searches:
```C
given arrays a1, a2, a3, a4
given target t1, t2, t3, t4

compare t1 with middle of a1
compare t2 with middle of a2
compare t3 with middle of a3
compare t4 with middle of a4

cut a1 in two based on above comparison
cut a2 in two based on above comparison
cut a3 in two based on above comparison
cut a4 in two based on above comparison

compare t1 with middle of a1
compare t2 with middle of a2
compare t3 with middle of a3
compare t4 with middle of a4

...
```


You can go far higher than 4 interleaved searches. You can do 8, 16, 32&hellip; I suspect that there is no practical need to go beyond 32.

How well does it work? Let us take 1024 sorted arrays containing a total of 64 million integers. In each array, I want to do one and just one binary search. Between each test, I access all of data in all of the arrays a couple of times to fool the cache.

By default, if you code a binary search, the resulting assembly will be made of comparisons and jumps. Hence your processor will execute this code in a speculative manner. At least with GNU GCC, we can write the C/C++ code in such a way that the branches are implemented as &ldquo;conditional move&rdquo; instructions which prevents the processor from speculating.

My results on a recent Intel processor (Cannon Lake) with GNU GCC 8 are as follows:

algorithm                |time per search          |relative speed           |
-------------------------|-------------------------|-------------------------|
1-wise (independent, see below) |2100 cycles/search       |1.0 ×                   |
1-wise (speculative)     |900 cycles/search        |2.3 ×                   |
1-wise (branchless)      |1100 cycles/search       |2.0 ×                   |
2-wise (branchless)      |800 cycles/search        |2.5 ×                   |
4-wise (branchless)      |600 cycles/search        |3.5 ×                   |
8-wise (branchless)      |350 cycles/search        |6.0 ×                   |
16-wise (branchless)     |280 cycles/search        |7.5 ×                   |
32-wise (branchless)     |230 cycles/search        |9 ×                     |


So we are able to go 3 to 4 times faster, on what is effectively a memory bound problem, by interleaving 32 binary searches together. Interleaving merely 16 searches might also be preferable on some systems.

But why is this not higher than 4 times faster? Surely the processor can issue more than 4 memory loads at once?

That is because the 1-wise search, even without speculation, already benefits from the fact that we are streaming multiple binary searches, so that more than one is ongoing at any one time. When running a loop, the processor will not, in general, complete the first iteration, then proceed with the next iteration: instead the execution of the successive iterations will overlap. I can prevent the processor from usefully executing more than one search either by inserting memory fences between each search, or by making the target of one search dependent on the index found in the previous search (see &lsquo;independent&rsquo; in the table). When I do so the time goes up to 2100 cycles/array which is approximately 9 times longer than 32-wise approach. The exact ratio (9) varies depending on the exact processor: I get a factor of 7 on the older Skylake architecture and a factor of 5 on an ARM Skylark processor.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/09/14).

Implementation-wise, I code my algorithms in pure C/C++. There is no need for fancy, esoteric instructions. The condition move instructions are pretty much standard and old at this point. Sadly, I only know how to convince one compiler (GNU GCC) to reliably produce conditional move instructions. And I have no clue how to control how Java, Swift, Rust or any other language deals with branches.

Could you do better than my implementation? Maybe but there are arguments suggesting that you can&rsquo;t beat it by much in general. Each data access is done using fewer than 10 instructions in my implementation, which is far below the number of cycles and small compared to the size of the instruction buffers, so finding ways to reduce the instruction count should not help. Furthermore, it looks like I am already nearly maxing out the amount of memory-level parallelism at least on some hardware (9 on Cannon Lake, 7 on Skylake, 5 on Skylark). On Cannon Lake, however, you should be able to do better.

Credit: This work is the result of a collaboration with Travis Downs and Nathan Kurz, though all of the mistakes are mine.

