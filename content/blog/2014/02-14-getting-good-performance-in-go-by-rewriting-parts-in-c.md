---
date: "2014-02-14 12:00:00"
title: "Getting good performance in Go by rewriting parts in C?"
---



[Go](https://golang.org/) is a new programming language invented by Google engineers. Apparently, it came about because they were tired to wait for their [C++](https://en.wikipedia.org/wiki/C%2B%2B) code to compile.
To run Go programs, you need to compile them. However, compilation is so amazingly fast that Go may as well be an interpreted language like Python or JavaScript.

Compared to C++ or Java, Go is a very simple language. I am no expert, but I learned [the basics](https://golang.org/doc/) in a few hours. This means that, even though I have only been programming in Go for a few days, I can read most Go programs and instantly understand them. In contrast, even though I have 15 years of experience in C++, I often cannot understand C++ code without effort.

In theory, Go can offer the performance of C++. In practice, Go has performance superior to Python and JavaScript, but sometimes inferior to C++ and Java.

My friend [Will Fitzgerald](http://www.willfitzgerald.org/) wrote what has become a reference implementation of the [bitset data structure in Go](https://github.com/willf/bitset). I felt that it could be faster. Will was nice enough to let me contribute some enhancements to his [bitset library](https://github.com/willf/bitset).
Go makes it easy, or even trivial, to call C functions. So I thought optimizing the code was a simple matter of rewriting the performance sensitive parts in C. Let us see how it worked out.

Will&rsquo;s bitset implementation is an array of 64-bit integers were some of the bits are set to 1 and others to 0. An expensive operation is to count the number of bits set to 1. It is implemented as a tight loop which repeatedly calls a [Hamming weight](https://en.wikipedia.org/wiki/Hamming_weight) function written in Go (<tt>popcount_2</tt>):
```Go
for _, word := range b.set {
	cnt += popcount_2(word)
}
```


The `popcount_2` isn&rsquo;t exactly free:
```Go
func popcount_2(x uint64) uint64 {
	x -= (x >> 1) & m1             
	x = (x & m2) + ((x >> 2) & m2) 
	x = (x + (x >> 4)) & m4        
	x += x >> 8                    
	x += x >> 16                   
	x += x >> 32                   
	return x & 0x7f
}
```


In C, when using GCC-like compiler, we would simply call an intrinsic (<tt>__builtin_popcountl</tt>). Presumably, it is as fast or faster than anything we can come up with. Go makes it really easy to call a C function:
```Go
C.__builtin_popcountl(C.ulong(word)))
```


Alternatively, we can write the entire function in C and call it from Go:
```Go
unsigned int totalpop(void * v, int n) {
    unsigned long * x = (unsigned long *) v;
    unsigned int a = 0;
    int k = 0;
    for(; k < n ; ++k) 
        a+= __builtin_popcountl(x[k]);
    return a;
}
```


So how do these three alternatives compare? I created a small benchmark (that you will find in the [bitset package](https://github.com/willf/bitset/blob/master/bitset_test.go#L710)) and tested all three alternatives.

&nbsp;&nbsp;             |&nbsp;microseconds/operation&nbsp; |
-------------------------|-------------------------|
Pure Go                  |12                       |
Calling <tt>__builtin_popcountl</tt> |130                      |
Entire rewrite in C      |9                        |


So while rewriting the entire function in Go helped, repeatedly calling `__builtin_popcountl` made things much worse. This reflects the fact that __calling a C function from Go is expensive__. In contrast, calling a C function from C++ is dirt cheap.

Beside the high cost of calling C function, I have also been unable to call SSE intrinsics in Go while using the default Go compiler. Indeed, the function I would really like to call, when it is available, is <tt>_lzcnt_u64</tt>. I am not sure that it is possible to do so by default.

__Conclusion__: Go is a wonderful language. In theory, you could ensure that it is fast by calling C functions when needed. In practice, the overhead of C function calls in Go is likely to be a bottleneck when working with functions that run for less than a millisecond. You either have to rewrite your entire functions in C, or live with the poor performance.

