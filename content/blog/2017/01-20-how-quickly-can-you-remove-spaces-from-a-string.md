---
date: "2017-01-20 12:00:00"
title: "How quickly can you remove spaces from a string?"
---



Sometimes programmers want to prune out characters from a string of characters. For example, maybe you want to remove all line-ending characters from a piece of text.

Let me consider the problem where I want to remove all spaces (&lsquo; &lsquo;) and linefeed characters (&lsquo;\n&rsquo; and &lsquo;\r&rsquo;).

How would you do it efficiently?
```C
size_t despace(char * bytes, size_t howmany) {
  size_t pos = 0;
  for(size_t i = 0; i < howmany; i++) {
      char c = bytes[i];
      if (c == '\r' || c == '\n' || c == ' ') {
        continue;
      }
      bytes[pos++] = c;
  }
  return pos;
}
```


This code will work on all UTF-8 encoded strings&hellip; which is the bulk of the strings found on the Internet if you consider that UTF-8 is a superset of ASCII.

That&rsquo;s simple and should be fast&hellip; I had a blast looking at how various compilers process this code. It ends up being a handful of instructions per processed byte.

But we are processing bytes one by one while our processors have a 64-bit architecture. Can we process the data by units of 64-bit words?

There is a somewhat mysterious bit-twiddling expression that returns true whenever your word contains a zero byte:
```C
(((v)-UINT64_C(0x0101010101010101)) & ~(v)&UINT64_C(0x8080808080808080))
```


All we need to know is that it works. With this tool, we can write a faster function&hellip;
```C
uint64_t mask1 = ~UINT64_C(0) / 255 * (uint64_t)('\r');
uint64_t mask2 = ~UINT64_C(0) / 255 * (uint64_t)('\n');
uint64_t mask3 = ~UINT64_C(0) / 255 * (uint64_t)(' ');

for (; i + 7 < howmany; i += 8) {
    memcpy(&word, bytes + i, sizeof(word));
    uint64_t xor1 = word ^ mask1;
    uint64_t xor2 = word ^ mask2;
    uint64_t xor3 = word ^ mask3;

    if (haszero(xor1) || haszero(xor2) || haszero(xor3)) {
      // check each of the eight bytes by hand?
    } else {
      memmove(bytes + pos, bytes + i, sizeof(word));
      pos += 8;
    }
}
```


It is going to be faster as long as most blocks of eight characters do not contain any white space. When this occurs, we are basically copying 64-bit words one after the other, along with a moderately expensive check that our superscalar processors can do quickly.

As it turns out, we can better without using 64-bit words.
```C
// table with zeros at indexes corresponding  to white spaces
int jump_table[256] = { 1, 1, 1, 1, 1, 1, 1, 1, 1, 1,
  0, 1, 1, 0, 1,  ...};

size_t faster_despace( char* bytes, size_t howmany ) {
  size_t i = 0, pos = 0;
  while( i < howmany )
  {
    bytes[pos] = bytes[i++];
    pos += jump_table[ (unsigned char)bytes[pos] ];
  }
  return pos;
}
```


This approach proposed by Robin Leffmann is very clever, and it is fast because it avoids penalties due to mispredicted branches.

Can we do even better? Sure! Ever since the Pentium 4 (in 2001), we have had 128-bit (SIMD) instructions.

Let us solve the same problem with these nifty 128-bit SSE instructions, using the (ugly?) intel intrinsics&hellip;
```C
__m128i spaces = _mm_set1_epi8(' ');
__m128i newline = _mm_set1_epi8('\n');
__m128i carriage = _mm_set1_epi8('\r');
size_t i = 0;
for (; i + 15 < howmany; i += 16) {
    __m128i x = _mm_loadu_si128((const __m128i *)(bytes + i));
    __m128i xspaces = _mm_cmpeq_epi8(x, spaces);
    __m128i xnewline = _mm_cmpeq_epi8(x, newline);
    __m128i xcarriage = _mm_cmpeq_epi8(x, carriage);
    __m128i anywhite = _mm_or_si128(_mm_or_si128(xspaces,
                xnewline), xcarriage);
    int mask16 = _mm_movemask_epi8(anywhite);
    x = _mm_shuffle_epi8(
          x, _mm_loadu_si128(despace_mask16 + mask16));
    _mm_storeu_si128((__m128i *)(bytes + pos), x);
    pos += 16 - _mm_popcnt_u32(mask16);
}
```


The code is fairly straight-forward __if__ you are familiar with SIMD instructions on Intel processors. I have made no effort to optimize it&hellip; so it is possible, even likely, that we could make it run faster. My original SIMD code had a branch but Nathan Kurz realized that it was best to simplify the code and remove it.

Let us see how fast it runs!

I designed a benchmark using a recent (Skylake) Intel processor over text entries where only a few characters are white space.

regular code             |5.5 cycles / byte        |
-------------------------|-------------------------|
using 64-bit words       |2.56 cycles/byte         |                         |with jump table          |1.7 cycles/byte          |                         |SIMD (128 bits) code     |0.39 cycles / byte       |
<tt>memcpy</tt>          |0.08 cycles / byte       |


So the vectorized code is nearly 14 times faster than the regular code. That&rsquo;s pretty good.

Yet pruning a few spaces is 5 times slower than copying the data with <tt>memcpy</tt>. So maybe we can go even faster. How fast could we be?

One hint: Our Intel processors can actually process 256-bit registers (with AVX/AVX2 instructions), so it is possible we could go twice as fast. Sadly, 256-bit SIMD instructions on x64 processors work on two 128-bit independent lanes which make the algorithmic design more painful.

Leffmann&rsquo;s approach is not as fast as SIMD instructions, but it is more general and portable&hellip; and it is still three times faster than the regular code!

[My C code is available](https://github.com/lemire/despacer).

__Further reading__: [Quickly pruning elements in SIMD vectors using the simdprune library](/lemire/blog/2017/04/25/quickly-pruning-elements-in-simd-vectors-using-the-simdprune-library/)

__Note__: In practice, we could remove all characters with code values less or equal to 32.

