---
date: "2022-12-06 12:00:00"
title: "Fast midpoint between two integers without overflow"
---



Let us say that I ask you to find the number I am thinking about between -1000 and 1000, by repeatedly guessing a number. With each guess, I tell you whether your guess is correct, smaller or larger than my number. A binary search algorithm tries to find a value in an interval by repeating finding the midpoint, using smaller and smaller intervals. You might start with 0, then use either -500 or 500 and so forth.

Thus we sometimes need a fast algorithm to find the midpoint in an interval of integers.The following simple routine to find the midpoint is incorrect:
```C
int f(int x, int y) {
  return (x + y)/2;
}
```


If the integers use a 64-bit two&rsquo;s complement representation, we could pick 1 for x and 9223372036854775807 for y, and then the result of the function could be a large negative value.

Efficient solutions are provided by Warren in Hacker&rsquo;s Delight (section 2.5):
```C
int f(int x, int y) {
  return (x|y) - ((x^y)>>1);
}
```


```C
int f(int x, int y) {
  return ((x^y)>>1) + (x&y);
}
```


They provide respectively the smallest value no smaller than (x+y)/2 and the largest value no larger than (x+y)/2. The difference between the two values is <tt>(x ^ y) &amp; 1</tt> (credit: Harold Aptroot).

They follow from the following identities: <tt>x+y=(x^y)+2*(x&amp;y)</tt> and <tt>x+y=2*(x|y)-(x^y)</tt>.

__Update__: Reader BartekF observes that C++20 added a dedicated function for this problem: [std::midpoint](https://en.cppreference.com/w/cpp/numeric/midpoint).

