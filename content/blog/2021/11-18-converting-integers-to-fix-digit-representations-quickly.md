---
date: "2021-11-18 12:00:00"
title: "Converting integers to fix-digit representations quickly"
---



It is tricky to convert integers into strings because the number of characters can vary according to the amplitude of the integer. The integer &lsquo;1&rsquo; requires a single character whereas the integer &lsquo;100&rsquo; requires three characters. So a solution might possible need a hard-to-predict branch.

Let us simplify the problem.

Imagine that you want to serialize integers to fixed-digit strings. Thus you may want to convert 16-digit integers (up to 10000000000000000) to exactly 16 digits, including leading zeros if needed. In this manner, it is easy to write code that contains only trivial branches.

The simplest approach could be a character-by-character routine where I use the fact that the character &lsquo;0&rsquo; in ASCII is just 0x30 (in hexadecimal):
```C
void to_string_backlinear(uint64_t x, char *out) {
    for(int z = 0; z < 16; z++) {
        out[15-z] = (x % 10) + 0x30;
        x /= 10;
    }
}
```




It is somewhat strange to write the characters backward, starting from the less significant digit. You can try to go forward, but it is a bit trickier. Here is one ugly approach that is probably not efficient:
```C
void to_string_linear(uint64_t x, char *out) {
  out[0] = x / 1000000000000000 + 0x30;
  x %= 1000000000000000;
  out[1] = x / 100000000000000 + 0x30;
  x %= 100000000000000;
  out[2] = x / 10000000000000 + 0x30;
  x %= 10000000000000;
  out[3] = x / 1000000000000 + 0x30;
  x %= 1000000000000;
  out[4] = x / 100000000000 + 0x30;
  x %= 100000000000;
  out[5] = x / 10000000000 + 0x30;
  x %= 10000000000;
  out[6] = x / 1000000000 + 0x30;
  x %= 1000000000;
  out[7] = x / 100000000 + 0x30;
  x %= 100000000;
  out[8] = x / 10000000 + 0x30;
  x %= 10000000;
  out[9] = x / 1000000 + 0x30;
  x %= 1000000;
  out[10] = x / 100000 + 0x30;
  x %= 100000;
  out[11] = x / 10000 + 0x30;
  x %= 10000;
  out[12] = x / 1000 + 0x30;
  x %= 1000;
  out[13] = x / 100 + 0x30;
  x %= 100;
  out[14] = x / 10 + 0x30;
  x %= 10;
  out[15] = x + 0x30;
}
```


Instead we could try to do it in a tree-like manner to reduce data dependency during the computation and hope for more core-level parallelism. We first divide the integer 100000000 to compute the first and last 8 digits separately, and so forth. It should drastically decrease data dependencies:
```C
void to_string_tree(uint64_t x, char *out) {
  uint64_t top = x / 100000000;
  uint64_t bottom = x % 100000000;      
  uint64_t toptop = top / 10000;
  uint64_t topbottom = top % 10000;
  uint64_t bottomtop = bottom / 10000;
  uint64_t bottombottom = bottom % 10000;
  uint64_t toptoptop = toptop / 100;
  uint64_t toptopbottom = toptop % 100;
  uint64_t topbottomtop = topbottom / 100;
  uint64_t topbottombottom = topbottom % 100;
  uint64_t bottomtoptop = bottomtop / 100;
  uint64_t bottomtopbottom = bottomtop % 100;
  uint64_t bottombottomtop = bottombottom / 100;
  uint64_t bottombottombottom = bottombottom % 100;
  //
  out[0] = toptoptop / 10 + 0x30;
  out[1] = toptoptop % 10 + 0x30;
  out[2] = toptopbottom / 10 + 0x30;
  out[3] = toptopbottom % 10 + 0x30;
  out[4] = topbottomtop / 10 + 0x30;
  out[5] = topbottomtop % 10 + 0x30;
  out[6] = topbottombottom / 10 + 0x30;
  out[7] = topbottombottom % 10 + 0x30;
  out[8] = bottomtoptop / 10 + 0x30;
  out[9] = bottomtoptop % 10 + 0x30;
  out[10] = bottomtopbottom / 10 + 0x30;
  out[11] = bottomtopbottom % 10 + 0x30;
  out[12] = bottombottomtop / 10 + 0x30;
  out[13] = bottombottomtop % 10 + 0x30;
  out[14] = bottombottombottom / 10 + 0x30;
  out[15] = bottombottombottom % 10 + 0x30;
}
```


We could also try to accelerate the computation with table lookups. We want to keep the tables small. We can effectively process the tail end of the tree-based technique by looking up small integers smaller than 100 by looking up their conversion: the integer 12 becomes the 2-character string &rsquo;12&rsquo; and so forth (my code could be nicer):
```C
void to_string_tree_table(uint64_t x, char *out) {
  static const char table[200] = {
      0x30, 0x30, 0x30, 0x31, 0x30, 0x32, 0x30, 0x33, 0x30, 0x34, 0x30, 0x35,
      0x30, 0x36, 0x30, 0x37, 0x30, 0x38, 0x30, 0x39, 0x31, 0x30, 0x31, 0x31,
      0x31, 0x32, 0x31, 0x33, 0x31, 0x34, 0x31, 0x35, 0x31, 0x36, 0x31, 0x37,
      0x31, 0x38, 0x31, 0x39, 0x32, 0x30, 0x32, 0x31, 0x32, 0x32, 0x32, 0x33,
      0x32, 0x34, 0x32, 0x35, 0x32, 0x36, 0x32, 0x37, 0x32, 0x38, 0x32, 0x39,
      0x33, 0x30, 0x33, 0x31, 0x33, 0x32, 0x33, 0x33, 0x33, 0x34, 0x33, 0x35,
      0x33, 0x36, 0x33, 0x37, 0x33, 0x38, 0x33, 0x39, 0x34, 0x30, 0x34, 0x31,
      0x34, 0x32, 0x34, 0x33, 0x34, 0x34, 0x34, 0x35, 0x34, 0x36, 0x34, 0x37,
      0x34, 0x38, 0x34, 0x39, 0x35, 0x30, 0x35, 0x31, 0x35, 0x32, 0x35, 0x33,
      0x35, 0x34, 0x35, 0x35, 0x35, 0x36, 0x35, 0x37, 0x35, 0x38, 0x35, 0x39,
      0x36, 0x30, 0x36, 0x31, 0x36, 0x32, 0x36, 0x33, 0x36, 0x34, 0x36, 0x35,
      0x36, 0x36, 0x36, 0x37, 0x36, 0x38, 0x36, 0x39, 0x37, 0x30, 0x37, 0x31,
      0x37, 0x32, 0x37, 0x33, 0x37, 0x34, 0x37, 0x35, 0x37, 0x36, 0x37, 0x37,
      0x37, 0x38, 0x37, 0x39, 0x38, 0x30, 0x38, 0x31, 0x38, 0x32, 0x38, 0x33,
      0x38, 0x34, 0x38, 0x35, 0x38, 0x36, 0x38, 0x37, 0x38, 0x38, 0x38, 0x39,
      0x39, 0x30, 0x39, 0x31, 0x39, 0x32, 0x39, 0x33, 0x39, 0x34, 0x39, 0x35,
      0x39, 0x36, 0x39, 0x37, 0x39, 0x38, 0x39, 0x39,
  };
  uint64_t top = x / 100000000;
  uint64_t bottom = x % 100000000;
  uint64_t toptop = top / 10000;
  uint64_t topbottom = top % 10000;
  uint64_t bottomtop = bottom / 10000;
  uint64_t bottombottom = bottom % 10000;
  uint64_t toptoptop = toptop / 100;
  uint64_t toptopbottom = toptop % 100;
  uint64_t topbottomtop = topbottom / 100;
  uint64_t topbottombottom = topbottom % 100;
  uint64_t bottomtoptop = bottomtop / 100;
  uint64_t bottomtopbottom = bottomtop % 100;
  uint64_t bottombottomtop = bottombottom / 100;
  uint64_t bottombottombottom = bottombottom % 100;
  //
  memcpy(out, &table[2 * toptoptop], 2);
  memcpy(out + 2, &table[2 * toptopbottom], 2);
  memcpy(out + 4, &table[2 * topbottomtop], 2);
  memcpy(out + 6, &table[2 * topbottombottom], 2);
  memcpy(out + 8, &table[2 * bottomtoptop], 2);
  memcpy(out + 10, &table[2 * bottomtopbottom], 2);
  memcpy(out + 12, &table[2 * bottombottomtop], 2);
  memcpy(out + 14, &table[2 * bottombottombottom], 2);
}
```


You can extend this trick if you are willing to include a 40kB table in your code:
```C
void to_string_tree_bigtable(uint64_t x, char *out) {
  #include "bigtable.h"

  uint64_t top = x / 100000000;
  uint64_t bottom = x % 100000000;
  //
  uint64_t toptop = top / 10000;
  uint64_t topbottom = top % 10000;
  uint64_t bottomtop = bottom / 10000;
  uint64_t bottombottom = bottom % 10000;

  memcpy(out, &bigtable[4 * toptop], 4);
  memcpy(out + 4, &bigtable[4 * topbottom], 4);
  memcpy(out + 8, &bigtable[4 * bottomtop], 4);
  memcpy(out + 12, &bigtable[4 * bottombottom], 4);
}
```




An intermediate solution with a 3-character table would only require a 3kB table. [I also consider Muła&rsquo;s SIMD-based approach though I refer you to his article for details](http://www.0x80.pl/articles/sse-itoa.html). Effectively Muła use fancy Intel-specific instructions to get the job done.

If you cannot use SIMD instructions, you can use something similar called SWAR. Effectively, you pack several integer values inside a wide integer (64 bits) and you try to somehow save instructions. Luckily, Khuong has a solution for us:
```C
// credit: Paul Khuong
uint64_t encode_ten_thousands(uint64_t hi, uint64_t lo) {
  uint64_t merged = hi | (lo << 32);
  uint64_t top = ((merged * 10486ULL) >> 20) & ((0x7FULL << 32) | 0x7FULL);
  uint64_t bot = merged - 100ULL * top;
  uint64_t hundreds;
  uint64_t tens;
  hundreds = (bot << 16) + top;
  tens = (hundreds * 103ULL) >> 10;
  tens &= (0xFULL << 48) | (0xFULL << 32) | (0xFULL << 16) | 0xFULL;
  tens += (hundreds - 10ULL * tens) << 8;

  return tens;
}

void to_string_khuong(uint64_t x, char *out) {
  uint64_t top = x / 100000000;
  uint64_t bottom = x % 100000000;
  uint64_t first =
      0x3030303030303030 + encode_ten_thousands(top / 10000, top % 10000);
  memcpy(out, &first, sizeof(first));
  uint64_t second =
      0x3030303030303030 + encode_ten_thousands(bottom / 10000, bottom % 10000);
  memcpy(out + 8, &second, sizeof(second));
}
```




[I refer you to Khuong&rsquo;s blog post for a description](https://pvk.ca/Blog/2017/12/22/appnexus-common-framework-its-out-also-how-to-print-integers-faster/).

I wrote a [small benchmark in C++ which measures the time per integer](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/11/17). Remember that every call to my functions produces 16 digits, exactly.

function                 |Apple M1, LLVM 12        |AMD Zen 2, GCC 10        |
-------------------------|-------------------------|-------------------------|
linear                   |14 ns                    |25 ns                    |
backward linear          |7.7 ns                   |18 ns                    |
tree                     |6.9 ns                   |15 ns                    |
Khuong                   |3.3 ns                   |8.0 ns                   |
small table              |3.7 ns                   |7.1 ns                   |
SIMD                     |non-available            |4.8 ns                   |
big table                |1.5 ns                   |2.9 ns                   |


On both processors, the crazy big-table (40kB) approach is about 2 times faster than the version with a small table. Though a big-table can be justified in some instances, my feeling is that only in niche applications would such a big table be acceptable for such a narrow task. Even a smaller 3kB seems like an overkill given the good results we get with a small table.

The SIMD approach has a rather minimal gain compared to the version with a small table (merely 25%).

At a glance, the small table wins on practical ground. It is small, simple and portable.

&nbsp;

