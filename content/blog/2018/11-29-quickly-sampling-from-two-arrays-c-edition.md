---
date: "2018-11-29 12:00:00"
title: "Quickly sampling from two arrays (C++ edition)"
---



Suppose that you are given two arrays. Maybe you have a list of cities from the USA and a list of cities from Europe. You want to generate a new list which mixes the two lists, taking a sample from one array (say 50%), and a sample from the other array (say 50%). So if you have 50 cities from the USA and 50 cities from Europe, you want a new array that contains, in random order, 25 cities from the USA and 25 cities from Europe.

We need this kind of mixed sampling all the time in machine learning or data science. This summer, I was running simulations and the bulk of the time was spent mixing arrays. I need to pick, say, 25% of all elements from one array and combine them with, say, 75% of all elements from another array.

There are many bad ways to solve this problem. But here is a reasonable one. First you pick a sample from the first array using [reservoir sampling](https://en.wikipedia.org/wiki/Reservoir_sampling); then you pick a sample from the other array (again using reservoir sampling), and you finally apply a random shuffle to the result.

Reservoir sampling is an efficient way to sample N values from an array:
```C
  for (i = 0; i < N; i++) {
    output[i] = source[i];
  }
  for (; i < ...; i++) {
    r = random_bounded(i);// value in [0,i)
    if (r < howmany) {
      output[r] = source[i];
    }
  }
```


Knuth shuffling is an efficient way to randomly shuffle the elements in an array:
```C
  for (i = size; i > 1; i--) {
    r = random_bounded(i);// value in [0,i)
    swap(array[i-1], array[r]);
  }
```


With these two algorithms in place, I can sample from two source arrays using three function calls:
```C
reservoirsampling(output, N1, source1, length1);
reservoirsampling(output + N1, N2, source2, length2);
shuffle(output, N1 + N2);
```


So how efficient is it? Suppose that I have two arrays made of a million elements each and I want to sample half a million elements from each. On my iMac, I use a bit over 12 CPU cycles per input element (so about 24 million cycles in total). You probably can go even faster, but this approach has the benefit of being both simple and efficient.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/11/28).

