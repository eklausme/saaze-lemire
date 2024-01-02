---
date: "2022-11-25 12:00:00"
title: "Making all your integers positive with zigzag encoding"
---



You sometimes feel the need to make all of your integers positive, without losing any information. That is, you want to map all of your integers from &lsquo;signed&rsquo; integers (e.g., -1, 1, 3, -3) to &lsquo;unsigned integers&rsquo; (e.g., 3,2,6,7). This could be useful if you have a fast function to compress integers that fails to work well for negative integers.

Many programming languages (Go, C, etc.) allow you just &lsquo;cast&rsquo; the integer. For example, the following Go code will print out -1, 18446744073709551615, -1 under most systems:
```C
	var x = -1
	var y = uint(x)
	var z = int(y)
	fmt.Println(x, y, z)
```


That is, you can take a small negative value, interpret it as a large integer, and then &lsquo;recover&rsquo; back your small value.

What if you want to have that small values remain small ? Then  a standard approach is to use zigzag encoding. The recipe is as follows:

- Compute twice the absolute value of your integer.
- Subtract 1 to the result when the original integer was negative.


Effectively, what you are doing is that all positive integers become even integers (exactly twice as big), and all negative integers become odd integers. We interleave negative and positive integers (odd and even).

original value           |zigzag value             |
-------------------------|-------------------------|
-20                      |39                       |
-19                      |37                       |
-18                      |35                       |
-17                      |33                       |
-16                      |31                       |
-15                      |29                       |
-14                      |27                       |
-13                      |25                       |
-12                      |23                       |
-11                      |21                       |
-10                      |19                       |
-9                       |17                       |
-8                       |15                       |
-7                       |13                       |
-6                       |11                       |
-5                       |9                        |
-4                       |7                        |
-3                       |5                        |
-2                       |3                        |
-1                       |1                        |
0                        |0                        |
1                        |2                        |
2                        |4                        |
3                        |6                        |
4                        |8                        |
5                        |10                       |
6                        |12                       |
7                        |14                       |
8                        |16                       |
9                        |18                       |
10                       |20                       |
11                       |22                       |
12                       |24                       |
13                       |26                       |
14                       |28                       |
15                       |30                       |
16                       |32                       |
17                       |34                       |
18                       |36                       |
19                       |38                       |
20                       |40                       |


In Python, you might implement the encoding and the decoding as follows:
```C
def zigzag_encode(val) :
    if val < 0:
        return - 2 * val  - 1
    return 2 * val

def zigzag_decode(val) :
    if val & 1 == 1 :
        return - val // 2
    return val // 2
```




The same code in C/C++ might work, but it could be more efficient to use optimized code which assumes that the underlying hardware represents signed integers with [two&rsquo;s complement encoding](https://en.wikipedia.org/wiki/Two%27s_complement) (which is a safe assumption in 2022 and a requirement in C++20) and that bytes span 8 bits (another safe assumption)&hellip;
```C
int fast_decode(unsigned int x) {
    return (x >> 1) ^ (-(x&1));
}

unsigned int fast_encode(int x) {
    return (2*x) ^ (x >>(sizeof(int) * 8 - 1));
}
```




Much the same code will work in Go, Rust, Swift, etc.

