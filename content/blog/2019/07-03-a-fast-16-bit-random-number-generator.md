---
date: "2019-07-03 12:00:00"
title: "A fast 16-bit random number generator?"
---



In software, we often need to generate random numbers. Commonly, we use pseudo-random number generators.

A simple generator is wyhash. It is a multiplication followed by an XOR:
```C
uint64_t wyhash64_x; 


uint64_t wyhash64() {
  wyhash64_x += 0x60bee2bee120fc15;
  __uint128_t tmp;
  tmp = (__uint128_t) wyhash64_x * 0xa3b195354a39b70d;
  uint64_t m1 = (tmp >> 64) ^ tmp;
  tmp = (__uint128_t)m1 * 0x1b03738712fad5c9;
  uint64_t m2 = (tmp >> 64) ^ tmp;
  return m2;
}
```


It generates 64-bit numbers. I was recently asked whether we could build the equivalent but a smaller scale.

What if you only wanted 16-bit integers and you wanted to follow the model of the `wyhash64` function? This might be useful if you are working with a limited processor and you only had modest needs. Here is my proposal:
```C
uint16_t wyhash16_x; 

uint32_t hash16(uint32_t input, uint32_t key) {
  uint32_t hash = input * key;
  return ((hash >> 16) ^ hash) & 0xFFFF;
}


uint16_t wyhash16() {
  wyhash16_x += 0xfc15;
  return hash16(wyhash16_x, 0x2ab);
}
```


To use this code, you should first initialize `wyhash16_x` to a value of your choice. You may also be interested in replacing the increment (0xfc15) by any other odd integer. The period of this generator is 65536 meaning that after 65536 values, it comes back in full circle.

The essential idea is in the `hash16` function. For a given `key` value, we have a map from 16-bit values to 16-bit values. The map is not invertible, in general. I pick the `key` value to 0xfc15. This choice &ldquo;maximizes&rdquo; the avalanche effect. That is, if you take a given value, hash it with <tt>hash16</tt>, then modify a single bit, and hash it again, the difference between the two outputs should have about 8 bits flipped (out of 16). That is, changing a little bit the input value should change the output a lot.

The `hash16` function is not invertible&hellip; to make it invertible I would need to make the avalanche effect quite weak. With 0xfc15, its domain (set of output values) is only of size 44,114 whereas there are 65536 distinct 16-bit values. Is that bad? Well. If you generate 65536 random values between 0 and 65536, how many distinct values do you expect? The answer is about 41,427. So, if anything, my `hash16` function might have too large of a domain.

If you only need to generate a few thousand 16-bit values, this simple generator might be good enough. It is also going to be fast if you have a fast 32-bit multiplier. Evidently, if you are planning to do serious number crunching, it will quickly show its limits. I did not even try to push it through standard statistical tests as none of them are designed for such small generators.

What I found interesting is that by optimizing the avalanche effect, I also got a generator that had a decent image size.

[The source code I used to analyze this problem is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/07/02).

__Appendix__. Furthermore you can generate integer values in a range [0,s) efficiently:
```C
uint16_t rand_range16(const uint16_t s) {
    uint16_t x = wyhash16();
    uint32_t m = (uint32_t)x * (uint32_t)s;
    uint16_t l = (uint16_t)m;
    if (l < s) {
        uint16_t t = -s % s;
        while (l < t) {
            x = wyhash16();
            m = (uint32_t)x * (uint32_t)s;
            l = (uint16_t)m;
        }
    }
    return m >> 16;
}
```


