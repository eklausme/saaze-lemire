---
date: "2018-07-02 12:00:00"
title: "Predicting the truncated xorshift32* random number generator"
---



Software programmers need random number generators. For this purpose, the often use functions with outputs that appear random. Gerstmann has a nice post about [Better C++ Pseudo Random Number Generator](https://arvid.io/2018/07/02/better-cxx-prng/). He investigates the following generator:
```C
uint32_t xorshift(uint64_t *m_seed) {
  uint64_t result = *m_seed * 0xd989bcacc137dcd5ull;
  *m_seed ^= *m_seed >> 11;
  *m_seed ^= *m_seed << 31;
  *m_seed ^= *m_seed >> 18;
  return (uint32_t)(result >> 32ull);
}
```


This &ldquo;truncated xorshift32*&rdquo; function returns 32-bit &ldquo;random&rdquo; integers, and takes in a 64-bit state function. Each time you call the function, the state is updated, so that following random integers will vary. Thus the state and the returned random numbers are distinct concepts. [The PCG family of random number generators also uses this nice trick](http://www.pcg-random.org).

Gerstmann asks whether the generator is &ldquo;predictable&rdquo; and writes &ldquo;Unknown?&rdquo; as an answer. What is the missing answer? The answer is that it is predictable.

What does predictable means? 

Suppose that I tell you that the first random number generated is 1 and the second is 2&hellip; can you infer what the state is? If you try to setup the probably mathematically, you may find that the problem is quite vexing. 

But, in fact, it is easy. I wrote a small program that gives you the answer in 4 seconds, using brute force. And once you know what the state is, you can predict all following random integers.

How does it work? Simply put, from the first 32-bit output of the function (1 in my case), you know the equivalent of 32 bits of the state. Thus you only have a bit over 4 billion possibilities. That&rsquo;s too much for a human being, but remember that your processor does billions of instructions per second&hellip; so 4 billion possibilities is not very many.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/07/02/cracktrunc.c).

To be clear, it is not an argument against this particular generator.

