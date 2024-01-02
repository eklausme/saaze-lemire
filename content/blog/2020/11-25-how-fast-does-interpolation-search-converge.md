---
date: "2020-11-25 12:00:00"
title: "How fast does interpolation search converge?"
---



When searching in a sorted array, the standard approach is to rely on a binary search. If the input array contains N elements, after log(N) + 1 random queries in the sorted array, you will find the value you are looking for. The algorithm is well known, even by kids. You first guess that the value is in the middle, you check the value in the middle, you compare it against your target and go either to the upper half of lower half of the array based on the result of the comparison.

Binary search only requires that the values be sorted. What if the values are not only sorted, but they also follow a regular distribution. Maybe you are generating random values, uniformly distributed. Maybe you are using hash values.

[In a classical paper](https://dl.acm.org/doi/abs/10.1145/359545.359557?casa_token=uVDE2jNVz9kAAAAA:7JU_k3wj3XzQAa8vUPW-g4LH7dtIfZA8B9il39At0irMcWMTP75nCDpPzMBYrxiEKu8jeo0hEhs), Perl et al. described a potentially more effective approach called interpolation search. It is applicable when you know the distribution of your data. The intuition is simple: instead of guessing that the target value is in the middle of your range, you adjust your guess based on the value. If the value is smaller than average, you aim near the beginning of the array. If the value much larger than average, you guess that the index should be near the end.

The expected search time is then much better: log(log(N)). To gain some intuition, [I quickly implemented interpolation search in C++](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/11/25) and ran a little experiment, generating large arrays and search in them using interpolation search. As you can see,  as you multiply the size of the array by 10, the number of hits or comparisons remains nearly constant. Furthermore, interpolation search is likely to quickly get very close to the target. Thus the results are better than they look if memory locality is a factor.

N                        |hits                     |
-------------------------|-------------------------|
100                      |2.9                      |
1000                     |3.5                      |
10000                    |3.8                      |
100000                   |4.0                      |
100000                   |4.5                      |
1000000                  |4.6                      |
10000000                 |4.9                      |


You might object that such a result is inferior to a hash table, and I do expect well implemented hash tables to perform better, but you should be mindful that many hash table implementations gain performance at the expense of higher memory usage, and that they often lose the ability to visit the values in sorted order at high speed. It is also easier to merge two sorted arrays than to merge two hash tables.

This being said, I am not aware of interpolation search being actually used productively in software today. If you have a reference to such an artefact, please share!

&nbsp;

__Update__: [Some readers suggest that Big table relies on a form of interpolation search](https://arxiv.org/abs/1712.01208).

__Update__: It appears that interpolation search was tested out in git ([1](https://github.com/git/git/commit/628522ec1439f414dcb1e71e300eb84a37ad1af9), [2](https://github.com/git/git/commit/f1068efefe6dd3beaa89484db5e2db730b094e0b)). Credit: Jeff King.

__Further reading__: [Interpolation search revisited](http://0x80.pl/articles/interpolation-search.html) by Muła

