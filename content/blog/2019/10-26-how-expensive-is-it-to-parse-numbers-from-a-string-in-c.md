---
date: "2019-10-26 12:00:00"
title: "How expensive is it to parse numbers from a string in C++?"
---



In C++, there are multiple ways to convert strings into numbers. E.g., to convert the string &ldquo;1.0e2&rdquo; into the number 100.

In software, we frequently have to parse numbers from strings. Numbers are typically represented in computers as 32-bit or 64-bit words whereas strings are variable-length sequences of bytes. We need to go from one representation to the other.

For example, given the 3-character string &ldquo;123&rdquo;, we want to recover the integer value 123, which is typically stored as a byte value 0x7b followed by some zero bytes.

Though parsing integers is not trivial, parsing floating-point numbers is trickier: e.g., the strings &ldquo;1e10&rdquo;, &ldquo;10e9&rdquo;, &ldquo;100e+8&rdquo; and &ldquo;10000000000&rdquo; all map to the same value. Typically, we store floating-point values as either 32-bit or 64-bit values using the [IEEE 754 standard](https://en.wikipedia.org/wiki/IEEE_754). Parsing may fail in various fun ways even if we set aside garbage inputs that have no reasonable number value (like &ldquo;4a.14x.10.14&rdquo;). For example, the string &ldquo;1e500&rdquo; cannot be represented, typically, in software (except as the infinity). The string &ldquo;18446744073709551616&rdquo; cannot be represented as either a 64-bit floating-point value or a 64-bit integer. In some instances, we need to &ldquo;round&rdquo; the value: the string &ldquo;1.0000000000000005&rdquo; cannot be represented exactly as a 64-bit floating-point value, so we need to round it down to &ldquo;1.0000000000000004&rdquo; while we might round &ldquo;1.0000000000000006&rdquo; up to 1.0000000000000007.

How expensive is it to parse numbers? To test it out, I wrote a long string containing space-separated numbers. In one case, I generated random 64-bit unsigned integers, and another I generated random 64-bit normal floating-point numbers. Then I benchmark standard C++ parsing code that simply sums up the numbers:
```C
std::stringstream in(mystring);
while(in >> x) {
   sum += x;
}
return sum;
```


I use long strings (100,000 numbers), and the GNU GCC 8.3 compiler on an Intel Skylake processor. I find that parsing numbers is relatively slow:

integers                 |360 cycles/integer       |18 cycles/byte           |200 MB/s                 |
-------------------------|-------------------------|-------------------------|-------------------------|
floats                   |1600 cycles/integer      |66 cycles/byte           |50 MB/s                  |


Most disks and most networks can do much better than 50 MB/s. And good disks and good networks can beat 200 MB/s by an order of magnitude.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/10/25).

