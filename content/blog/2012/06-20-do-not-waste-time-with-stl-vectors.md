---
date: "2012-06-20 12:00:00"
title: "Do not waste time with STL vectors"
---



I spend a lot of time with the C++ [Standard Template Library](https://en.wikipedia.org/wiki/Standard_Template_Library). It is available on diverse platforms, it is fast and it is (relatively) easy to learn. It has been perhaps too conservative at times: we only recently got a standard hash table data structure (with [C++11](https://en.wikipedia.org/wiki/C%2B%2B11#Hash_tables)). However, using STL is orders of magnitude safer than dealing with pointers.

I use the vector template in almost all my C++ software. Essentially, you can use it whenever you need a dynamic array. The title of my blog post is word play: please use vectors, but use them properly if you need speed!

When using the vector template in high performance code, we must be aware of several important facts. For example, the capacity (memory usage) of a vector will never decrease, even if you call the clear method, unless you use the [swap method](http://www.cplusplus.com/reference/vector/vector/swap/). In my opinion, making it difficult to release memory was a poor design decision. (This was fixed in the C++11 language update with the addition of the `shrink_to_fit` method.) Another problem with the vector template is that whenever you copy a vector, you copy all the data it contains. Again, to avoid this problem, you must use the swap method.

But a trickier problem with STL vectors is that there are many ways to build them. Suppose I want to create an array in C++ containing the numbers from 0 to N in increasing order. Then I want to compute the sum. I hear that mathematicians have come up with a formula for this problem, but your Intel microprocessor does not know this.

- The conventional approach is to allocate the memory using C++&rsquo;s new:
```C
int * bigarray = new int[N];
for(unsigned int k = 0; k<N; ++k)
  bigarray[k] = k;
int sum = total(bigarray,N);
delete [] bigarray;
return sum;
```

- Or, you can do the exact equivalent in STL:
```C
vector<int> bigarray(N);
for(unsigned int k = 0; k<N; ++k)
  bigarray[k] = k;
int sum = total(bigarray,N);
return sum;
```


It is nicer because you don&rsquo;t need to remember to recover the memory allocated. There is a price to pay however because when you first construct the vector, the memory is initialized to zero.
- You can do it in pure STL fashion, with the push_back method:
```C
vector<int> bigarray;
for(unsigned int k = 0; k<N; ++k)
  bigarray.push_back(k);
int sum = total(bigarray,N);
return sum;
```

- We can improve the push_back method by using the fact that we know ahead of time how big the array will be. Thus, we can reserve the memory before the push_backs.
```C
vector<int> bigarray;
bigarray.reserve(N);
for(unsigned int k = 0; k<N; ++k)
  bigarray.push_back(k);
int sum = total(bigarray,N);
return sum;
```


It is likely to be slightly faster.


So what is the result? On my Intel Core i7 desktop, I get the following numbers of CPU cycles per integer processed:

method                   |ns per integer           |
-------------------------|-------------------------|
C++ new                  |0.37                     |
STL vector               |0.37                     |
push_back                |3.0                      |
reserve + push_back      |1.2                      |


As usual, my code is [freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvector.cpp).

__Conclusion__ STL vectors can be quite fast but if you use them to store integers, but the push_back method can be relatively expensive.

