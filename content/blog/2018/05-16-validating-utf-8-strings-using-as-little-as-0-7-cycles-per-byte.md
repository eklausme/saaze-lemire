---
date: "2018-05-16 12:00:00"
title: "Validating UTF-8 strings using as little as 0.7 cycles per byte"
---



Most strings found on the Internet are encoded using a particular unicode format called [UTF-8](https://en.wikipedia.org/wiki/UTF-8). However, not all strings of bytes are valid UTF-8. The rules as to what constitute a valid UTF-8 string are somewhat arcane. Yet it seems important to quickly validate these strings before you consume them.

In a previous post, I pointed out that it takes about [8 cycles per byte to validate them using a fast finite-state machine](/lemire/blog/2018/05/09/how-quickly-can-you-check-that-a-string-is-valid-unicode-utf-8/). After hacking code found online, I showed that using SIMD instructions, we could bring this down to about 3 cycles per input byte.

Is that the best one can do? Not even close.

Many strings are just ASCII, which is a subset of UTF-8. They are easily recognized because they use just 7 bits per byte, the remaining bit is set to zero. Yet if you check each and every byte with silly scalar code, it is going to take over a cycle per byte to verify that a string is ASCII. For much better speed, you can vectorize the problem in this manner:
```C
__m128i mask = _mm_setzero_si128();
for (...) {
    __m128i current_bytes = _mm_loadu_si128(src);
    mask = _mm_or_si128(mask, current_bytes);
}
__m128i has_error =  _mm_cmpgt_epi8(
         _mm_setzero_si128(), mask);
return _mm_testz_si128(has_error, has_error);
```


Essentially, we are loading up vector registers, computing a logical OR with a running mask. Whenever a character outside the allowed range is present, then the last bit will be set in the running mask. We continue until the very end no matter what, and only then do we examine the mask.

We can use the same general idea to validate UTF-8 strings. [My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/05/15).

finite-state machine (is UTF-8?) |8 to 8.5 cycles per input byte |
-------------------------|-------------------------|
determining if the string is ASCII |0.07 to 0.1 cycles per input byte |
vectorized code (is UTF-8?) |0.7 to 0.9 cycles per input byte |


If you are almost certain that most of your strings are ASCII, then it makes sense to first test whether the string is ASCII, and only then fall back on the more expensive UTF-8 test.

So we are ten times faster than a reasonable scalar implementation. I doubt this scalar implementation is as fast as it can be&hellip; but it is not naive&hellip; And my own code is not nearly optimal. It is not using AVX to say nothing of AVX-512. Furthermore, it was written in a few hours. I would not be surprised if one could double the speed using clever optimizations.

The exact results will depend on your machine and its configuration. [But you can try the code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/05/15).

[I have created a C library out of this little project as it seems useful](https://github.com/lemire/fastvalidate-utf-8). Contributions are invited. For reliable results, please configure your server accordingly: benchmarking on a laptop is hazardous.

__Credit__: Kendall Willets made a key contribution by showing that you could &ldquo;roll&rdquo; counters using saturated subtractions.

__Update__: This work ended up making a research paper under the title [Validating UTF-8 In Less Than One Instruction Per Byte](https://arxiv.org/abs/2010.03090), Software: Practice &amp; Experience (to appear).

__Update__: For a production-ready UTF-8 validation function, please see the [simdjson library](https://github.com/simdjson/simdjson).

__Further reading__: [Validating UTF-8 bytes using only 0.45 cycles per byte (AVX edition)](/lemire/blog/2018/10/19/validating-utf-8-bytes-using-only-0-45-cycles-per-byte-avx-edition/)

