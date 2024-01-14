---
date: "2022-12-15 12:00:00"
title: "Checking for the absence of a string, naive AVX-512 edition"
---



Suppose you would like to check that a string is not present in a large document. In C, you might do the following using the standard function <tt>strstr</tt>:
```C
bool is_present = strstr(mydocument, needle);
```


It is simple and likely very fast. The implementation is algorithmically sophisticated.

Can you do better?

Recent Intel and AMD processors have instructions that operate on 512-bit registers. So we can compare 64 bytes using a single instruction. The simplest algorithm to search for a string might look as follows&hellip;

1. Load 64 bytes from our input document, compare them against 64 copies of the first character of the target string.
1. If we find a match, load the second character of the target string, copy it 64 times within a register. Load 64 bytes from our input document, with an offset of one byte.
1. Repeat as needed for the second, third, and so forth characters&hellip;
1. Then advance in the input by 64 bytes and repeat.


Using Intel intrinsic functions, the algorithm looks as follows:
```C
  
  for (size_t i = 0; ...; i += 64) {
    __m512i comparator = _mm512_set1_epi8(needle[0]);
    __m512i input = _mm512_loadu_si512(in + i);
    __mmask64 matches = _mm512_cmpeq_epi8_mask(comparator, input);
    for (size_t char_index = 1; matches && char_index < needle_len; 
         char_index++) {
      comparator = _mm512_set1_epi8(needle[char_index]);
      input = _mm512_loadu_si512(in + i + char_index);
      matches =
          _kand_mask64(matches, _mm512_cmpeq_epi8_mask(comparator, input));
    }
    if(matches) { return true; }
  }
  return false;
```


It is about the simplest algorithm I could think of.

We are now going to benchmark it against <tt>strstr</tt>. To make it interesting, I will pick a string that it designed to be repeatedly &lsquo;almost&rsquo; in the input document, except for its last character. It is a worst-case scenario.

I use GCC 11 on an Intel Icelake processor. [The source code of my benchmark is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/12/15).

number of characters in the string |AVX-512 (naive)          |strstr                   |
-------------------------|-------------------------|-------------------------|
2                        |33 GB/s                  |13 GB/s                  |
5                        |22 GB/s                  |9 GB/s                   |
10                       |13 GB/s                  |8 GB/s                   |
14                       |10 GB/s                  |7 GB/s                   |


Unsuprisingly, my naive AVX-512 approach scales poorly in this benchmark with the string length. However, it is somewhat pessimistic, I would expect better results with a more realistic use case.

It should be possible to do much better with some more sophistication. However, for short strings, we are already twice as fast as `strstr` which is encouraging.

