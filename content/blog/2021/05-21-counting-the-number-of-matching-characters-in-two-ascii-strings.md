---
date: "2021-05-21 12:00:00"
title: "Counting the number of matching characters in two ASCII strings"
---



Suppose that you give me two ASCII strings having the same number of characters. I wish to compute efficiently the number of matching characters (same position, same character). E.g., the strings &lsquo;012c&rsquo; and &lsquo;021c&rsquo; have two matching characters (&lsquo;0&rsquo; and &lsquo;c&rsquo;).

The conventional approach in C would look as follow:
```C
uint64_t standard_matching_bytes(char * c1, char * c2, size_t n) {
    size_t count = 0;
    size_t i = 0;
    for(; i < n; i++) {
        if(c1[i]  == c2[i]) { count++; }
    }
    return count;
}
```


There is nothing wrong with this code. An optimizing compiler can auto-vectorize this code so that it will do far fewer than one instruction per byte, given long enough strings.

However, it does appear that the routine looks at every character, one by one. So it looks like you are loading two values, then you are comparing and then incrementing a counter, for each character. So it might compile to over 5 instructions per character (prior to auto-vectorization).

What you can do instead is load the data in blocks of 8 bytes, into 64-bit integers as in the following code. Do not be mislead by the apparently expensive memcpy calls: an optimizing compiler will turn these function calls into a single load instruction.
```C
uint64_t matching_bytes(char * c1, char * c2, size_t n) {
    size_t count = 0;
    size_t i = 0;
    uint64_t x, y;
    for(; i + sizeof(uint64_t) <= n; i+= sizeof(uint64_t)) {
      memcpy(&x, c1 + i, sizeof(uint64_t) );
      memcpy(&y, c2 + i, sizeof(uint64_t) );
      count += matching_bytes_in_word(x,y);
    }
    for(; i < n; i++) {
        if(c1[i]  == c2[i]) { count++; }
    }
    return count;
}
```


So we just need a function that can compare two 64-bit integers and find how many matching bytes there are. Thankfully there are fairly standard techniques to do so such as the following. (I borrowed part of the routine from [Wojciech Muła](http://0x80.pl/articles/simd-strfind.html).)
```C
uint64_t matching_bytes_in_word(uint64_t x, uint64_t y) {
  uint64_t xor_xy = x ^ y;
  const uint64_t t0 = (~xor_xy & 0x7f7f7f7f7f7f7f7fllu) + 0x0101010101010101llu;
  const uint64_t t1 = (~xor_xy & 0x8080808080808080llu);
  uint64_t zeros = t0 & t1;
  return ((zeros >> 7) * 0x0101010101010101ULL) >> 56;
}```


With this routine, you can bring down the instruction count to about 2 per character, including all the overhead and the data loading. It is strictly better than what you could with character-by-character processing by a factor of two (for long strings).

Though I seem to restrict the problem to ASCII inputs, my code actually counts the number of matching bytes. If you know that the input is ASCII, you can further optimize the routine.

I leave it as an exercise for the reader to write a function that counts the number of matching characters within a range, or to determine whether all characters in a given range match.

The proper way to solve this problem is with SIMD instructions, and most optimizing compilers should do that for you starting from a simple loop. However, if it is not possible and you have relatively long strings, then the approach I described could be beneficial.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/05/21).

