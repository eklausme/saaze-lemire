---
date: "2021-04-28 12:00:00"
title: "Ideal divisors: when a division compiles down to just a multiplication"
---



The division instruction is one of the most expensive instruction in your CPU. Thus optimizing compilers often compile divisions by known constants down to a multiplication followed by a shift. However, in some lucky cases, the compiler does not even need a shift. I call the corresponding divisors ideal. For the math. geeks, they are related to Fermat numbers.

For 32-bit unsigned integers, we have two such divisors (641 and 6700417). For 64-bit unsigned integers, we have two different ones (274177 and 67280421310721). They are factors for 2<sup>32</sup> + 1 and 2<sup>64</sup> + 1 respectively. They are prime numbers.

So you have that

<tt>n/274177 = ( n * 67280421310721 ) &gt;&gt; 64</tt>

and

<tt>n/67280421310721 = ( n * 274177 ) &gt;&gt; 64</tt>.

In these expressions, the multiplication is the full multiplication (to a 128-bit result). It looks like there is still a &lsquo;shift&rsquo; by 64 bits, but the &lsquo;shift&rsquo; disappears in practice after compilation.

Of course, not all compilers may be able to pull this trick, but many do. Here is the assembly code produced by GCC when compiling <tt>n/274177</tt> and <tt>n/67280421310721 </tt> respectively for an x64 target.
```C
        movabs  rdx, 67280421310721
        mov     rax, rdi
        mul     rdx
        mov     rax, rdx
        ret
```

```C
        mov     rax, rdi
        mov     edx, 274177
        mul     rdx
        mov     rax, rdx
        ret
```


You get similar results with ARM. It looks like ARM works hard to build the constant, but it is mostly a distraction again.
```C
        mov     x1, 53505
        movk    x1, 0xf19c, lsl 16
        movk    x1, 0x3d30, lsl 32
        umulh   x0, x0, x1
        ret
```

```C
        mov     x1, 12033
        movk    x1, 0x4, lsl 16
        umulh   x0, x0, x1
        ret
```


What about remainders?

What a good compiler will do  is to first compute the quotient, and then do a multiplication and a subtraction to derive the remainder. It is the general strategy. Thus, maybe surprisingly, it is more expensive to compute a remainder than a quotient in many cases!

You can do a bit better in some cases. There is a trick from our [Faster Remainder by Direct Computation](https://arxiv.org/abs/1902.01961) paper that compilers do not know about. You can compute the remainder directly, using exactly two multiplications (and a few move instructions):

n % 274177 = (uint64_t( n * 67280421310721 ) * 274177) &gt;&gt; 64

and

n % 67280421310721 = (uint64_t( n * 274177 ) * 67280421310721) &gt;&gt; 64.

In other words, the following two C++ functions are strictly equivalent:
```C
// computes n % 274177
uint64_t div1(uint64_t n) {
    return n % 274177;
}

// computes n % 274177
uint64_t div2(uint64_t n) {
    return (uint64_t( n * 67280421310721 ) 
              * __uint128_t(274177)) >> 64;
}
```


Though the second function is more verbose and uglier, it will typically compile to more efficient code involving just two multiplications, back to back. It may seem a lot but it is likely better than what the compiler will do.

In any case, if you are asked to pick a prime number and you expect to have to divide by it, you might consider these ideal divisors.

__Further reading__. [Integer Division by Constants: Optimal Bounds](https://arxiv.org/abs/2012.12369)

