---
date: "2016-10-05 12:00:00"
title: "Variable-length strings can be expensive"
---



Much of our software deals with variable-length strings. For example, my name &ldquo;Daniel&rdquo; uses six characters whereas my neighbor&rsquo;s name (&ldquo;Philippe&rdquo;) uses 8 characters.

&ldquo;Old&rdquo; software often shied away from variable-length strings. The Pascal programming language supported fixed-length strings. Most relational databases support fixed-length strings. Flat files with fixed-length lines and fixed-length records were common in the old days.

It seems that people today never worry about variable-length strings. All the recent programming languages I know ignore the concept of fixed-length strings.

Yet fixed-length strings have clear engineering benefits. For example, if I were to store &ldquo;tweets&rdquo; (from Twitter) in memory, using a flat 140 characters per tweet, I would be able to support fast direct access without having to go through pointers. Memory allocation would be trivial.

However, maybe processors have gotten so smart, and string operations so optimized, that there is no clear performance benefits to fixed-length strings in today&rsquo;s software.

I don&rsquo;t think so.

Even today, it is often possible to accelerate software by replacing variable-length strings by fixed-length ones, when you know ahead of time that all your strings are going to be reasonably short.

To examine this idea, I have created lists of strings made simply of the numbers (as strings) from 0 to 1024. Such strings have length ranging between 1 and 4 characters. In C, we use null-terminated characters, so the actual length is between 2 and 5. In C++, they have standard strings (<tt>std::string</tt>), with significant overhead: on my system, a single <tt>std::string</tt> uses 32 bytes, not counting the string content itself.

Instead of using variable-length strings, I can &ldquo;pad&rdquo; my strings so that they have a fixed length (8 characters), adding null characters as needed.

How long does it take, in CPU cycles per string, to sort a short array of strings (1024 strings)?

string type              |CPU cycles per element   |
-------------------------|-------------------------|
C++ <tt>std::string</tt> |520                      |
standard C string        |300                      |
padded C string          |140                      |


So for this experiment, replacing variable-length strings by fixed-length strings more than double the performance! And my code isn&rsquo;t even optimized. For example, to keep the comparison &ldquo;fair&rdquo;, I sorted pointers to strings&hellip; but my padded C strings fit in a machine word and do not require a pointer. So, in fact, fixed-length strings could be nearly three times faster with enough work.

To summarize: Variable-length strings are a convenient abstraction. You may hear that string operations are very cheap, unlikely to be a bottleneck and so forth&hellip; That might be so&hellip;

But I submit to you that the omnipresence of variable-length strings as a universal default can make us blind to very sweet optimization opportunities.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/10/05/pointersort.cpp).

