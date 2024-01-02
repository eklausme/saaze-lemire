---
date: "2017-07-07 12:00:00"
title: "Are your strings immutable?"
---



A value is _immutable_ if it cannot change.

Immutability is a distinct notion than that of a <em>constant</em>. The speed of light in a vacuum is believed to be a universal constant, for example. Constants are immutable in the sense that they cannot change. However, immutability refers to values, not to the assignment of values. For example, the number 3 is immutable. However, if I say that your rank is 3, this rank could change. That&rsquo;s because your rank is a variable, and variables may change their values even if these values are immutable.

That is, a variable may change its value to point to a different immutable value. That&rsquo;s a somewhat confusing point for non-programmers. For example, my name is &ldquo;Daniel&rdquo;. To say that strings are immutable is to say that I cannot change the string &ldquo;Daniel&rdquo;. However, I can certainly go see the government and have my first name changed so that it is &ldquo;Jack&rdquo;. Yet this change does not modify the string &ldquo;Daniel&rdquo;. If I could change the string &ldquo;Daniel&rdquo; then, possibly, all individuals named &ldquo;Daniel&rdquo; would see their name changed.

So in the world around us, values are typically immutable. And that&rsquo;s largely why it is believed that immutable values are safer and easier.

Working with mutable values requires more experience and more care. For example, not only does changing the string &ldquo;Daniel&rdquo; affect all people named &ldquo;Daniel&rdquo;, but what if two people try to change the string at the same time?

So integer values are always immutable, not only in real life but also in software. There is no programming language where you can redefine the value &ldquo;3&rdquo; to be equal to &ldquo;5&rdquo;.

Yet I believe that most programming languages in widespread use have mutable arrays. That is, once you have created an array of values, you can always change any one of the entries. Why is that? Because immutability could get costly as any change to an immutable array would need to be implemented as a copy.

Arguably, the most important non-numeric type in software is the string. A string can be viewed as an array of characters so it would not be unreasonable to make it mutable, but strings are also viewed as primitive values (e.g., we don&rsquo;t think of &ldquo;Daniel&rdquo; as an array of 6 characters). Consequently, some languages have immutable strings, others have mutable strings. Do you know whether the strings in your favorite language are mutable?

- In Java, C#, JavaScript, Python and Go, strings are immutable. Furthermore, Java, C#, JavaScript and Go have the notion of a constant: a &ldquo;variable&rdquo; that cannot be reassigned. (I am unsure how well constants are implemented and supported in JavaScript, however.)
- In Ruby and PHP, strings are mutable.
- The C language does not really have string objects per se. However, we commonly represent strings as a pointer <tt>char *</tt>. In general, C strings are mutable. The C++ language has its own string class. It is mutable.

In both C and C++, string constants (declared with the `const` qualifier) are immutable, but you can easily &ldquo;cast away&rdquo; the `const` qualifier, so the immutability is weakly enforced.
- In Swift, strings are mutable.

However, if you declare a string to be a constant (keyword <tt>let</tt>), then it is immutable.


