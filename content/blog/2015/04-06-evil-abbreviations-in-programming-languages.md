---
date: "2015-04-06 12:00:00"
title: "Evil abbreviations in programming languages"
---



Programming language designers often abbreviate common function names. The benefits are sometimes dubious in an era where most programmers commonly use meaningful variable names like `MyConnection` or `current_set` as opposed to single letters like `m` or <tt>t</tt>.

Here are a few evil examples:

- The C language provides the `memcpy` function to copy data. The clearer alternative `memcopy` requires one extra key stroke.<a href="#memcpy"><sup>1</sup></a>- To query for the length of an object like an array in Python and Go, we use the `len` function as in <tt>len(array)</tt>. The expression <tt>length(array)</tt> would be clearer to most and require only three additional characters.- Though most languages use the instruction `if` or the equivalent to indicate a conditional clause, when it comes to &ldquo;else if&rdquo;, designers get creative. Ruby uses <tt>elsif</tt>, helpfully saving us from typing the character <tt>e</tt>. Python uses <tt>elif</tt>, saving us two key strokes. PHP alone seems to get it right by using <tt>elseif</tt>.- In Python, we abbreviate string to <tt>str</tt>. Most languages seem to abbreviate Boolean as <tt>bool</tt>.

I am not opposed to a judicious use of abbreviations. However, by going too far, we create [a jargon](https://en.wikipedia.org/wiki/Jargon). We make the code harder to read for those unfamiliar with the language without providing any benefit to anyone. Let us not forget that source code is often the ultimate documentation of our ideas.
__Credit__: [John Cook&rsquo;s comment on G+](https://plus.google.com/+JohnCook/posts/UG1rGxhFqHh) inspired this blog post.

__<a id="memcpy">Update</a>__: Commenters point out that `memcpy` had to be shortened due to technical limitations restricting the length of functions to 6 characters in the old days. Fair enough. However, common C functions that use more than 6 characters also look like alphabet soup: <tt>fprintf</tt>, <tt>strcspn</tt>, <tt>strncpy</tt>, etc.

