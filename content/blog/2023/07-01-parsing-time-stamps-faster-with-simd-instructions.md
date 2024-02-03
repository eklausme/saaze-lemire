---
date: "2023-07-01 12:00:00"
title: "Parsing time stamps faster with SIMD instructions"
---



In software, it is common to represent time as a time-stamp string. It is usually specified by a time format string. [Some standards](https://datatracker.ietf.org/doc/html/rfc4034#section-3.2) use the format <tt>%Y%m%d%H%M%S</tt> meaning that we print the year, the month, the day, the hours, the minutes and the seconds. The current time as I write this blog post would be `20230701205436` as a time stamp in this format. It is convenient because it is short, easy to read and if you sort the strings lexicographically, you also sort them chronologically.

You can generate time stamps using any programming language. In C, the following program will print the current time (universal, not local time):
```C
#include <time.h>
#include <stdio.h>
int main() {
  char buffer[15];
  struct tm timeinfo;
  time_t rawtime;
  time(&rawtime);
  gmtime_r(&rawtime, &timeinfo);
  size_t len = strftime(buffer, 15, "%Y%m%d%H%M%S", &timeinfo);
  buffer[14] = '\0';
  puts(buffer);
}
```


We are interested in the problem of parsing these strings. In practice, this means that we want to convert them to an integer presenting the number of seconds since the Unix epoch. The Unix epoch is January 1st 1970. For my purposes, I will consider the time to be an unsigned 32-bit integer so we can represent time between 1970 and 2106. It is not difficult to switch over to a 64-bit integer or to signed integers.

The way you typically solve this problem is to use something like the C function <tt>strptime</tt>. Can we do better?

Modern processors have fast instructions that operate on several words at once, called SIMD instructions. We have a block of 14 characters. Let us assume that we can read 16 characters safely, ignoring the content of the leftover characters.

We load the block of digits in a SIMD register. We subtract 0x30 (the code point value of the character &lsquo;0&rsquo;), and all bytes values should be between 0 and 9, inclusively. We know that some character must be smaller than 9, for example, we _generally_ cannot have more than 59 seconds and never 60 seconds, in the time stamp string. In Unix time, we never allow 60 seconds. So one character must be between 0 and 5. Similarly, we start the hours at 00 and end at 23, so one character must be between 0 and 2. We do a saturating subtraction of the maximum: the result of such a subtraction should be zero if the value is no larger. We then use a special instruction to multiply one byte by 10, and sum it up with the next byte, getting a 16-bit value. We then repeat the same approach as before, checking that the result is not too large.

The code might look as follow using Intel intrinsic functions:
```C
 __m128i v = _mm_loadu_si128((const __m128i *)date_string);
v = _mm_sub_epi8(v, _mm_set1_epi8(0x30));
__m128i limit =
_mm_setr_epi8(9, 9, 9, 9, 1, 9, 3, 9, 2, 9, 5, 9, 5, 9, -1, -1);
__m128i abide_by_limits = _mm_subs_epu8(v, limit); // must be all zero
const __m128i weights = _mm_setr_epi8(
10, 1, 10, 1, 10, 1, 10, 1, 10, 1, 10, 1, 10, 1, 0, 0);
v = _mm_maddubs_epi16(v, weights);
__m128i limit16 =
_mm_setr_epi16(99,99, 12, 31, 23, 59, 59, -1);
__m128i abide_by_limits16 = _mm_subs_epu16(v, limit16);
__m128i limits = _mm_or_si128(abide_by_limits16,abide_by_limits);
if (!_mm_test_all_zeros(limits, limits)) {
  return false;
}

```


It does not get all the parsing done, but at this point, you have the months, days, hours, minutes and seconds as valid binary integer values. The year is parsed in two components (the first two digits, and the next two digits).

We can just use standard C code for the result.

Is it fast? I wrote a benchmark that I compile using GCC 12 on an Intel Ice Lake Linux server.

&nbsp;                   |instructions per stamp   |time per stamp           |
-------------------------|-------------------------|-------------------------|
standard C with <tt>strptime</tt> |700                      |46                       |
SIMD approach            |65                       |7.9                      |


We use about 10 times fewer instructions, and we go 6 times faster. That is not bad, but I suspect it is not nearly optimal.

Importantly, we do full error checking, and abide by the standard.

[The source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/07/01).

__Credit__: Thanks to Jeroen Koekkoek from NLnetLabs for initial work and for proposing the problem, and to @aqrit for sketching the current code.

&nbsp;

