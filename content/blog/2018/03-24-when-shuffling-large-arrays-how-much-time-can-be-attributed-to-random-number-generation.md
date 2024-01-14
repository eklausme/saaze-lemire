---
date: "2018-03-24 12:00:00"
title: "When shuffling large arrays, how much time can be attributed to random number generation?"
---



It is well known that contemporary computers don&rsquo;t like to randomly access data in an unpredictible manner in memory. However, not all forms of random accesses are equally harmful.

To randomly shuffle an array, the textbook algorithm, often attributed to Knuth, is simple enough:
```C
void swap(int[] arr, int i, int j) {
  int tmp = arr[i];
  arr[i] = arr[j];
  arr[j] = tmp;
}

void shuffle_java(int arr[]) {
  ThreadLocalRandom tlc = ThreadLocalRandom.current();
  int size = arr.length;
  for (int i = size; i > 1; i--)
    swap(arr, i - 1, tlc.nextInt(i));
  }
}
```


Suppose that the array is large. Take an array made of 100 million elements. It far exceeds the CPU cache on the machines I own. Because a random shuffle tends to read data at random locations (by design), you expect many cache misses.

But what fraction of the running time can be attributed to the computation of the random indexes? To answer this question, we can precompute the random indexes and pass them to the shuffle function:
```C
void shuffle_precomp(int arr[], int indexes[]) {
     int size = arr.length;
     for (int i = size; i > 1; i--)
        swap(arr, i - 1, indexes[i]);
}
```


This saves computations. It also makes it easier for the processor to avoid expensive cache misses because the processor can easily predict (correctly) where the next few reads will be long before it is needed.

To assess the difference, [I designed a small benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/03/23). My results are clear:

Random shuffle           |Precomputed shuffle      |
-------------------------|-------------------------|
1.9 s                    |0.8 s                    |


The bulk of the running time can be attributed to the generation of the random numbers and the accompanying latency involved.

I am not advocating that you precompute your ranged random numbers in this manner! It is not a good idea in practice. The sole purpose of my test is to show that a significant fraction of the running time of a shuffle function is due to the computation of the random indexes, even when working with large arrays.

For good measure, [I also implemented a similar benchmark in C++](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/03/23/rngshuf.cpp) based on code from Arseny Kapoulkine. Arseny&rsquo;s code uses O&rsquo;Neill&rsquo;s PCG instead of Java&rsquo;s LCG, but that is a small difference. On the same machines, I get similar numbers: 1.6 s for the full shuffle and 0.8 s for the precomputed shuffle. So the issue is not specific to Java or to the random number generator it provides.

Java&rsquo;s thread-local random number generation is a simple linear congruential generator. It is very fast. [And I have done a fair amount of work comparing different random number generators](https://github.com/lemire/testingRNG). So you cannot make the problem go away by using a &ldquo;faster&rdquo; random number generators.
__Further reading__: You can make shuffle functions faster, [I have a whole blog post on this](/lemire/blog/2016/06/30/fast-random-shuffling/), but it does not involve replacing the random number generator.

