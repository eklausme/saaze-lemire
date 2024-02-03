---
date: "2018-05-09 12:00:00"
title: "How quickly can you check that a string is valid unicode (UTF-8)?"
---



(This blog post is now obsolete, see for example [Validating UTF-8 bytes using only 0.45 cycles per byte (AVX edition)](/lemire/blog/2018/10/19/validating-utf-8-bytes-using-only-0-45-cycles-per-byte-avx-edition/).)

Though character strings are represented as bytes (values in [0,255]), not all sequences of bytes are valid strings. By far the most popular character encoding today is [UTF-8](https://en.wikipedia.org/wiki/UTF-8), part of the unicode standard. How quickly can we check whether a sequence of bytes is valid UTF-8?

Any ASCII string is a valid UTF-8 string. An ASCII character is simply a byte value in [0,127] or [0x00, 0x7F] in [hexadecimal](https://en.wikipedia.org/wiki/Hexadecimal). That is, the most significant bit is always zero.

You can check that a string is made of ASCII characters easily in C:
```C
bool is_ascii(const signed char *c, size_t len) {
  for (size_t i = 0; i < len; i++) {
    if(c[i] < 0) return false;
  }
  return true;
}
```


However, there are many more unicode characters than can be represented using a single byte. For other characters, outside the ASCII set, we need to use two or more bytes. All of these &ldquo;fancier&rdquo; characters are made of sequences of bytes all having the most significant bit set to 1. However, there are somewhat esoteric restrictions:

<li style="list-style-type: none;">

- All of the two-byte characters are made of a byte in [0xC2,0xDF] followed by a byte in [0x80,0xBF].
- There are four types of characters made of three bytes. For example, if the first by is 0xE0, then the next byte must be in [0xA0,0xBF] followed by a byte in [0x80,0xBF].



It is all quite boring but can be summarized by the following table:

First Byte               |Second Byte              |Third Byte               |Fourth Byte              |
-------------------------|-------------------------|-------------------------|-------------------------|
[0x00,0x7F]              |                         |                         |                         |
[0xC2,0xDF]              |[0x80,0xBF]              |                         |                         |
0xE0                     |[0xA0,0xBF]              |[0x80,0xBF]              |                         |
[0xE1,0xEC]              |[0x80,0xBF]              |[0x80,0xBF]              |                         |
0xED                     |[0x80,0x9F]              |[0x80,0xBF]              |                         |
[0xEE,0xEF]              |[0x80,0xBF]              |[0x80,0xBF]              |                         |
0xF0                     |[0x90,0xBF]              |[0x80,0xBF]              |[0x80,0xBF]              |
[0xF1,0xF3]              |[0x80,0xBF]              |[0x80,0xBF]              |[0x80,0xBF]              |
0xF4                     |[0x80,0x8F]              |[0x80,0xBF]              |[0x80,0xBF]              |


So, how quickly can we check whether a string satisfies these conditions?

I went looking for handy C/C++ code. I did not want to use a framework or a command-line tool.

The first thing I found is [Björn Höhrmann&rsquo;s finite-state machine](http://bjoern.hoehrmann.de/utf-8/decoder/dfa/). It looks quite fast. Without getting in the details, given a small table that includes character classes and state transitions, the gist of Höhrmann&rsquo;s code consists in repeatedly calling this small function:
```C
bool is_ok(uint32_t* state, uint32_t byte) {
  uint32_t type = utf8d[byte];
  *state = utf8d[256 + *state * 16 + type];
  return (*state != 1); // true on error
}
```


(In practice, you can do better if you expect the strings to be valid by avoiding the branching on each character.)

Then I went looking for a fancier, vectorized, solution. That is, I want a version that uses advanced vector registers.

I found something sensible by [Olivier Goffart](https://woboq.com/blog/utf-8-processing-using-simd.html). Goffart&rsquo;s original code translates UTF-8 into UTF-16 which is more than I want done. So I modified his code slightly, mostly by removing the unneeded part. His code will only run on x64 processors.

To test these functions, I wanted to generate quickly some random strings, but to measure accurately the string, I need it to be valid UTF-8. So I simply generated ASCII strings. This makes the problem easier, so I probably underestimate the difficulty of the problem. This problem is obviously dependent on the data type and lots of interesting inputs are mostly just ASCII anyhow.

Olivier Goffart&rsquo;s code &ldquo;cheats&rdquo; and short-circuit the processing when detecting ASCII code. That&rsquo;s fine, but I created two versions of his function, one with and one without the &ldquo;cheat&rdquo;.

So, how quickly can these functions check that strings are valid UTF-8?

string size              |is ASCII?                |Hoehrmann&rsquo;s finite-state machine |Goffart&rsquo;s (with ASCII cheat) |Goffart&rsquo;s (no ASCII cheat) |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
32                       |~2.5 cycles per byte     |~8 cycles per byte       |~5 cycles per byte       |~6 cycles per byte       |
80                       |~2 cycles per byte       |~8 cycles per byte       |~1.7 cycles per byte     |~4 cycles per byte       |
512                      |~1.5 cycles per byte     |~8 cycles per byte       |~0.7 cycles per byte     |~3 cycles per byte       |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/05/08).

The vectorized code gives us a nice boost&hellip; Sadly, in many applications, a lot of the strings can be quite small. In such cases, it seems that we need to spend something close to 8 cycles per byte just to check that the string is valid?

In many cases, you could short-circuit the check and just verify that the string is an ASCII string, but it is still not cheap, at about 2 cycles per input byte.

I would not consider any of the code that I have used to be &ldquo;highly optimized&rdquo; so it is likely that we can do much better. How much better remains an open question to me.

__Update__: [Daniel Dunbar wrote on Twitter](https://twitter.com/daniel_dunbar/status/994075356750647296)&hellip;

> I would expect that in practice best version would be highly optimized ascii only check for short segments, with fallback to full check if any in the segment fail


That is close to Goffart&rsquo;s approach.

__Update__: You can accelerate the finite-state machine quite a bit. You can bring it down to about 3 cycles per byte using trick that I attribute to Travis Downs: you split the string into two halves and process both at the same time.

