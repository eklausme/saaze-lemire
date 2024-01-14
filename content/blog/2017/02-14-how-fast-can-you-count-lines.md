---
date: "2017-02-14 12:00:00"
title: "How fast can you count lines?"
---



Inspired by [earlier work by Llogiq](https://llogiq.github.io/2016/09/24/newline.html), I decided to look at how fast I could count the number of lines in a string. By assuming that the string relies on ASCII, UTF-8 or other ASCII superset character encoding, the bulk of the work consists in counting the linefeed (&lsquo;\n&rsquo;) characters.
Most programmers would proceed as follows&hellip;
```C
cnt = 0;
 for(i = 0; i < size; i++)
      if(buffer[i] == '\n') cnt ++;
 return cnt;
```


It runs at about 0.66 cycles per input character on a recent x64 processor.

Your compiler achieves this speed by automatically vectorizing the problem.

Can we do better?

Let us try a vectorized approach using AVX intrinsics. The idea is simple. We use a vectorized counter made of 32 individual counters, initialized at zero. Within a loop, we load 32 bytes, we compare them (using a single instruction) with the linefeed character. We add the result to the running counter.```C
__m256i cnt = _mm256_setzero_si256(); // 32 counters
// ...
__m256i newdata = // load 32 bytes
__m256i cmp = _mm256_cmpeq_epi8(newline,newdata);
cnt = _mm256_add_epi8(cnt,cmp);
```


So per blocks of 32 input bytes, we use 3 instructions (one load, one comparison and one addition), plus some overhead. Could we do better? Maybe but I suspect it would be very difficult to use far fewer than 3 instructions per 32 input bytes on current processors.

With appropriate loop unrolling, this vectorized approach runs about ten times faster than the naive approach (0.04 cycles per input byte) or about 1.3 cycles per 32 input bytes. Because x64 processors have a hard time sustaining more than 4 instructions per cycle, we can estimate that our vectorized implementation is probably within a factor of two of optimality.

How does it compare with Llogiq&rsquo;s best approach? I&rsquo;d be interested in knowing, but his code is written in Rust, so this makes a direct comparison with my C code somewhat more difficult.
[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/02/14).

__Note__: I have updated my code following a comment by Turbo.

