---
date: "2020-09-03 12:00:00"
title: "Sentinels can be faster"
---



A standard trick in programming is to use &ldquo;sentinel values&rdquo;. These are special values that represent metadata efficiently.

The C language represents strings as a sequences of characters terminated with the null character. The null character is a sentinel that indicates the string length. E.g., my name (&ldquo;Lemire&rdquo;) would be represent as the string &ldquo;Lemire\0&rdquo; in memory when using the C language where I represent the null character as &lsquo;\0&rsquo; . The length of my name (6 characters) is never stored explicitly.

If you are a long-time C programmer, you probably think that the null sentinel is an &ldquo;obvious&rdquo; concept but newcomers to programming often find it counterintuitive. It is a non-trivial idea.

The null sentinel is &ldquo;space efficient&rdquo; in C. It is almost surely the case that other programming languages have more memory overhead per string.

Yet I remember reading that null-terminated strings were a design flaw in the C language from the point of view of performance. Indeed, you frequently need to know the length of a string and when you do, you need to scan all of the string to find the null sentinel and compute the string length. Other ancient programming languages like Pascal had string values with length prefixes. Today, I expect most programming languages to have steered clear of null-terminated strings.

But the use of sentinels can also lead to computationally efficient code though you do not need null characters per se. Let me illustrate.

Suppose that you are given a string and that you want to skip all of the leading spaces. If you are only given the starting point of the string and either its length or its ending point, then you might be stuck with code like so:
```C
const char * skip_leading_spaces(const char * start, const char * end) {
  while((start != end) && (is_space(*start))) {
    start++;
  }
  return start;
}
```


For each character, you have to check that you are still within the string, and you have to check whether it is a space. You end up doing two comparisons! The C++ programming languages has a strong bias in favour of such constructions. The popular functional programming idioms are often built on top of similar code.

Of course, you could get smarter. For example, you could branch on the string size to try to avoid one of the check at each character.  But if the string length is hard to predict, you may end up with small benefits and complicated code.

What if you know that the string is either null-terminated, or that it contains at least one non-space character that can serve as a de facto sentinel ? Then you can use simpler code where you only have to load a new character and check that it is a space:
```C
const char * skip_leading_spaces(const char * start) {
  while(is_space(*start)) {
    start++;
  }
  return start;
}
```


You end up with half the number of comparisons!

Is it faster?

It can be a lot faster. I [wrote a little benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/09/03) where I generate random strings having a random number of leading spaces. The sentinel approach is 40% faster in my tests.

Of course, the results depend critically on your data and on the exact problem you are trying to solve. Yet I think it is worth keeping sentinels in mind when you need to write high performance code, and you are dealing with irregular data.

