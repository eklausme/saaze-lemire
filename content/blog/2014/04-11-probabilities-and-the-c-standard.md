---
date: "2014-04-11 12:00:00"
title: "Probabilities and the C++ standard"
---



The [new C++ standard](http://www.open-std.org/jtc1/sc22/wg21/docs/papers/2013/n3690.pdfâ€Ž) introduced hash functions and hash tables in the language (as &ldquo;unordered maps&rdquo;).
As every good programmer should know, hash tables only work well if collisions between keys are rare. That is, if you have two distinct keys <em>k</em>1 and <em>k</em>2, you want their hash values <em>h</em>(<em>k</em>1) and <em>h</em>(<em>k</em>2) to differ most of the time.

The C++ standard does not tell us how the keys are hashed but it gives us two rules:

- The value returned by <em>h</em>(<em>k</em>) shall depend only on the argument <em>k</em>.
- For two different values <em>k</em>1 and <em>k</em>2, the probability that <em>h</em>(<em>k</em>1) and <em>h</em>(<em>k</em>2) &ldquo;compare equal&rdquo; (sic) should be very small.


The first rule says that <em>h</em>(<em>k</em>) must be deterministic. This is in contrast with languages like Java where the hash value can depend on a random number if you want (as long as the value remains the same through throughout the execution of a given program).

It is a reasonable rule. It means that if you are iterating through the keys of an &ldquo;unordered set&rdquo;, you will always visit the keys in the same order&hellip; no matter how many times you run your program.

It also means, unfortunately, that if you find two values such that <em>h</em>(<em>k</em>1) and <em>h</em>(<em>k</em>2), then they will always be equal, for every program and every execution of said programs.

The second rule is less reasonable. We have that <em>h</em>(<em>k</em>1) and <em>h</em>(<em>k</em>2) are constant values that are always the same. There is no random model involved. Yet, somehow, we want that the probability that they will be the same be low.

I am guessing that they mean that if you pick <em>k</em>1 and <em>k</em>2 randomly, the probability that they will hash to the same value is low, but I am not sure. If it is what they mean, then it is a very weak requirement: a vendor could simply hash strings down to their first character. That is a terrible hash function!

I am under the impression that the next revision of the C++ standard will fix this issue by following in Java&rsquo;s footstep and allow hash functions to vary from one run of a program to another. That is, C++ will embrace random hashing. [This will help us build safer software](/lemire/blog/2012/01/17/use-random-hashing-if-you-care-about-security/).

