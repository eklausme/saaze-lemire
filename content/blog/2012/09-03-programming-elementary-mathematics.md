---
date: "2012-09-03 12:00:00"
title: "Your programming language does not know about elementary mathematics"
---



In Mathematics, we typically require equality to form [equivalence classes](https://en.wikipedia.org/wiki/Equivalence_classes). That is, it should be reflexive: A should be equal to A. Moreover, it should be symmetric: if A is equal to B, then B should be equal to A. Finally, it should be [transitive](https://en.wikipedia.org/wiki/Transitive_relation): if A is equal to B, and B is equal to C, then A must be equal to C. 

These conditions appear to make perfect sense. Yet almost all programming languages fail to enforce reflexivity, symmetry and transitivity.

- Languages such as XPath fail to be transitive. Indeed, consider the following numbers

x = 10000000000000001;<br/>
y = 10000000000000000.0;<br/>
z = 10000000000000000;

Then x = y and y = z are true, but x = z is false. The problem with XPath is that it automatically casts integer-to-float comparisons to float-to-float comparisons. 

But even if you restrict yourself to integer types, XPath still fails to provide transitivity: (1,2) is equal to (2,3) which is equal to (3,4), yet (1,2) fails to be equal to (3,4).
- If you try the same test with the values x, y, z in JavaScript, you will find that transitivity is preserved because&hellip; x = z. That&rsquo;s because JavaScript has no integer type. JavaScript uses finite-precision floating point numbers to represent all numbers.

However, floating-point numbers have problems of their own. For one thing, they are not reflexive. That is, there is a value such as x = x evaluates to false. (The [NaN marker](https://en.wikipedia.org/wiki/NaN).) This is only one of several challenges that floating point numbers represent.


__Conclusion__. When working out a theory, it is easy to come up with simple axioms. People often think that software is just a representation of mathematics that can be whatever we want it to be. Thus, software should obey intuitive and simple axioms. However, what we get, instead, are organically grown compromises. There is sometimes little difference between studying software and studying nature. Both can be surprising.

__Update__: John Regehr pointed me to [comparisons in PHP](http://php.net/manual/en/types.comparisons.php). It is slightly insane trying to figure out what is equal to what.

__Update 2__: Jeff Erickson reminded me of a [very funny presentation by Gary Bernhardt](https://www.destroyallsoftware.com/talks/wat).

