---
date: "2020-12-14 12:00:00"
title: "Converting floating-point numbers to integers while preserving order"
---



Many programming languages have a number type corresponding to the IEEE binary64. In many languages such as Java or C++, it is called a double. A double value uses 64 bits and it represents a significand (or mantissa) multiplied by a power of two: m * 2<sup>p</sup>. There is also a sign bit.

A simpler data type is the 64-bit unsigned integer. It is a simple binary representation of all numbers between 0 to 2<sup>64</sup>.

In a low-level programming language like C++, you can access a double value as if it were an unsigned integer. After all, bits are bits. For some applications, it can be convenient to regard floating-point numbers as if they were simple 64-bit integers.

In C++, you can do the conversion as follows:
```C
uint64_t to_uint64(double x) {
    uint64_t a;
    ::memcpy(&a,&x,sizeof(x));
    return a;
}
```


Though it looks expensive, an optimizing compiler might turn such code into something that is almost free.

In such an integer representation, a double value looks as follows:

- The most significant bit is the sign bit. It has value 1 when the number is negative, and it has value 0 otherwise.
- The next 11 bits are usually the exponent code (which determines p).
- The other bits (52 of them) are the significand.


If you omit infinite values and not-a-number code, a comparison between two floating-point numbers is almost trivially the same as a comparison two integer values.

If you know that all of your numbers are positive and finite, then you are done. They are already in sorted order. The following comparison function should suffice:
```C
bool is_smaller(double x1, double x2) {
    uint64_t i1 = to_uint64(x1);
    uint64_t i2 = to_uint64(x2);
    return i1 < i2;
}
```


If your values can be negative, then you minimally need to reverse the sign bit, since it is wrong: we want large values to have their most significant bits set, and small values to have it unset. But just flipping one bit is not enough, you want negative values having a large absolute value to become small. To do so, you need to negate all bits, but only when the sign bit is set. It turns out that [some clever programmer has worked up](http://stereopsis.com/radix.html) an efficient solution:
```C
uint64_t sign_flip(uint64_t x) {
   // credit http://stereopsis.com/radix.html
   // when the most significant bit is set, we need to
   // flip all bits
   uint64_t mask = uint64_t(int64_t(x) >> 63);
   // in all case, we need to flip the most significant bit
   mask |= 0x8000000000000000;
   return x ^ mask;
}
```


You have now an efficient comparator between two floating-point values using integer arithmetic:
```C
bool generic_comparator(double x1, double x2) {
    uint64_t i1 = sign_flip(to_uint64(x1));
    uint64_t i2 = sign_flip(to_uint64(x2));
    return i1 < i2;
}
```


For finite numbers, we have shown how to map floating-point numbers to integer values while preserving order. The map is also invertible.

Sometimes you are working with floating-point numbers but would rather process integers. If you only need to preserve order, you can use such a map.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/12/14).

