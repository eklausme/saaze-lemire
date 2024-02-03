---
date: "2020-04-30 12:00:00"
title: "For case-insensitive string comparisons, avoid char-by-char functions"
---



Sometimes we need to compare strings in a case-insensitive manner. For example, you might want &lsquo;abc&rsquo; and &lsquo;ABC&rsquo; to be considered. It is a well-defined problem for ASCII strings. In C/C++, there are basically two common approaches. You can do whole string comparisons:
```C
bool isequal = (strncasecmp(string1, string2, N) == 0);
```


Or you can do character-by-character comparisons, mapping each and every character to a lower-case version and comparing that:
```C
bool isequal{true};
for (size_t i = 0; i < N; i++) {
      if (tolower(string1[i]) != tolower(string2[i])) {
        is_the_same = false;
        break;
      }
}
```


Intuitively, the second version is worse because it requires more code. We might also expect it to be slower. How much slower? I wrote a quick benchmark to test it out:

strncasecmp              |Linux/GNU GCC            |macOS/LLVM               |
-------------------------|-------------------------|-------------------------|
strncasecmp              |0.15 ns/byte             |1 ns/byte                |
tolower                  |4.5 ns/byte              |4.0 ns/byte              |


I got these results with GNU GCC under Linux. And on a different machine running macOS.

So for sizeable strings, the character-by-character approach might be 4 to 40 times slower! Results will vary depending on your standard library and of the time of the day. However, in all my tests, strncasecmp is always substantially faster. (Note: Microsoft provides similar functions under different names, see _strnicmp for example.)

Could you go faster? I tried rolling my own and it runs at about 0.3 ns/byte. So it is faster than the competition under macOS, but slower under Linux. I suspect that the standard library under Linux must rely on a vectorized implementation which might explain how it beats me by a factor of two.

I bet that if we use vectorization, we can beat the standard librairies.

&nbsp;

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/04/30).

