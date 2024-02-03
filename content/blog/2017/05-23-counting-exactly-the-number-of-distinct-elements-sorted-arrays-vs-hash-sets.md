---
date: "2017-05-23 12:00:00"
title: "Counting exactly the number of distinct elements: sorted arrays vs. hash sets?"
---



Suppose that you have ever larger sets of 64-bit integers, and you want to quickly find out how many distinct integers there are. So given <tt>{10, 12, 10, 16}</tt>, you want an algorithm to output 3, as there are three distinct integers in the set. I choose 64-bit integers, but strings would do fine as well.

There are [sensible algorithms to estimate this number](https://arxiv.org/abs/cs/0703058), but you want an exact count.

Though there are many good ways to solve this problem, most programmers would first attempt to use one of these two techniques:

- Create a hash set. Throw all the values in the hash set (implemented with a hash table). Then check how many values are found in the hash set in the end. In C++, you might implement it as such:
```C
size_t distinct_count_hash(const uint64_t * values, size_t howmany) {
  std::unordered_set<uint64_t> hash(values, values + howmany);
  return hash.size();
}
```

- Put all the values in an array, sort the array then run through it, deduplicating the values. In C++, you might implement it as follows:
```C
size_t distinct_count_sort(const uint64_t * values, size_t howmany) {
  std::vector<uint64_t> array(values, values + howmany);
  std::sort(array.begin(), array.end());
  return std::unique(array.begin(), array.end()) - array.begin();
}
```



Which is best? Sorting has complexity <em>O</em>(<em>n</em> log <em>n</em>) whereas insertion in a hash set has expected constant time <em>O</em>(1). That would seem to predict that the hash set approach would always be best.

However, there are many hidden assumptions behind textbook naive big-O analysis, as is typical. So we should be careful.

Simple engineering considerations do ensure that as long as the number of distinct elements is small (say no larger than some fixed constant), then the hash set approach has to be best. Indeed, sorting and copying a large array with lots of repeated elements is clearly wasteful. There is no need for fancy mathematics to understand that scenario.

But that&rsquo;s not the difficult problem that will give you engineering nightmares. The nasty problem is the one where the number of distinct elements can grow large. In that case, both the array and the hash set can become large.

Which is best in that difficult case? [I wrote a small C++ benchmark which you can run yourself](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/05/23/uniquevalues.cpp).

<em>N</em>               |hash set (cycles/value)  |array sort (cycles/value) |
-------------------------|-------------------------|-------------------------|
<em>1,000</em>           |220                      |161                      |
<em>10,000</em>          |260                      |163                      |
<em>100,000</em>         |340                      |200                      |
<em>1,000,000</em>       |820                      |245                      |
<em>10,000,000</em>      |1,100                    |282                      |


So when there are many distinct values to be counted, sorting an array is an efficient approach whereas the hash table should be avoided.

How can we understand this problem? One issue is that as the hash table becomes large, it comes to reside in RAM (as it no longer fits in CPU cache). Because of how hash sets work, each operation risks incurring an expensive cache miss. A single retrieval from RAM can take dozens of CPU cycles. Meanwhile, sorting and scanning an array can be done while avoiding most cache misses. It may involve many more operations, but avoiding cache misses can be worth it.

What if I kept cranking up the data size (<em>N</em>)? Would the hash set ever catch up? It might not.

The problem is the underlying assumption that you can access all memory using a constant time. That&rsquo;s not even close to true.

