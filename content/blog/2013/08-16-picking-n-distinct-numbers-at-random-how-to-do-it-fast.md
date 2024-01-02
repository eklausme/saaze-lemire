---
date: "2013-08-16 12:00:00"
title: "Picking N distinct numbers at random: how to do it fast?"
---



To test my algorithms, I like to generate synthetic data. To do so, I often need to generate distinct randomly chosen numbers from a range of values. For example, maybe I want to pick 2 distinct integers in the interval [0,10]. For my purposes, I need these numbers to appear in order, but we can just generate them in any order and sort them later.

Picking the first number at random is easy: most programming languages come with fast pseudo-random number generators. However, when you try to pick the second number, there is a small probability that you pick the first one again. If this happens, you need to start again. To check quickly whether a number has already been picked, we might use a hash table. This suggests the first algorithm one might try:



```C
HashSet<Integer> s = new HashSet<Integer>();
while (s.size() < N)
  s.add(rand.nextInt(Max));
```



(This code generates N distinct integers in the interval [0,Max).)

Intuitively, this algorithm is hard to beat when you need to pick few integers from a large range. In this case, the probability that you will pick an already picked number is small. But, in fact, even if you need to pick one out of every two values from a range (say pick 10 integers in the interval [0, 20)), this algorithm is still reasonably efficient. Indeed, the probability that a given number is already picked is no larger than 50%. How many times (on average) do you need to generate new random numbers if you have a 50% probability of rejecting them? You can check that the answer 2. This means that as long as you don&rsquo;t need to pick more than half the values (N is no more than Max/2), you can expect to need to generate no more than Max random numbers.

What if you need to pick more than Max/2 integers in [0,Max)? This can become a problem if you are not careful. Thankfully, there is a nice fix: picking N integers in [0,Max) for N large to Max is equivalent to picking Max-N integers in [0,Max) and then selecting the numbers you did not pick. Computing this complement can be done efficiently if you first sort the numbers you picked. This means that you can always assume that N is no larger than Max/2. 

Still, it is reasonable to think that the performance of the hash-based algorithm degrade as N becomes closer to Max/2. 

One possibly better alternative in this case&hellip; one that your typical Computer Science professor might propose&hellip; is [Reservoir Sampling](https://en.wikipedia.org/wiki/Reservoir_sampling). Though it sounds fancy, Reservoir Sampling is actually easily implemented:



```C
        int[] ans = new int[N];
        for (int k = 0; k < N; ++k)
                ans[k]=k;
        for(int k = N ; k < Max; ++k) {
        	int v = rand.nextInt(k+1);
        	if(v < N) {
        		ans[v] = k;
        	}
        }
```



It is not immediately obviously why this algorithm would work. However, it is correct. The nice thing about Reservoir Sampling is that we know exactly how many random numbers we need to generate: we need Max of them, no matter what. This means that Reservoir Sampling has a running time that depends on Max, but not a lot of N. 

However, it turns out that an even better alternative might be to replace the hash table by a bitmap. A bitmap is just an array of bits. We need Max bits. If the value has already been picked, we set the bit to 1, otherwise the bit is set to 0. The algorithm is otherwise identical to the first hash-based algorithm:



```C
        BitSet bs = new BitSet(Max);
        int cardinality = 0;
        while(cardinality < N) {
        	int v = rand.nextInt(Max);
        	if(!bs.get(v)) {
        		bs.set(v);
        		cardinality++;
        	}
        }
```



It turns out that a good heuristic is to use the bitmap algorithm when N is smaller than Max / 1024. Otherwise, the hash-based algorithm appears better. Reservoir Sampling is not a good choice for this problem.

The following table shows the speed (in millions of integers picked per second) of the various techniques on a recent i7 processor using C++. Note how much faster the bitmap approach is.

&nbsp;Max/N&nbsp;        |&nbsp;Hash&nbsp;         |&nbsp;Bitmap&nbsp;       |&nbsp;Reservoir Sampling&nbsp; |
-------------------------|-------------------------|-------------------------|-------------------------|
16384                    |2.0                      |1.0                      |0.0                      |
1024                     |7.5                      |28                       |0.1                      |
2                        |1.3                      |64                       |14                       |


For good measure, I coded up these algorithms in both Java and C++. The results are consistent. My code is [available for review](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2013/08/14).

__Credit__: I thank Nathan Kurz for challenging me on this problem.

__Further reading__: [Almost picking N distinct numbers at random](/lemire/blog/2019/05/07/almost-picking-n-distinct-numbers-at-random/)

