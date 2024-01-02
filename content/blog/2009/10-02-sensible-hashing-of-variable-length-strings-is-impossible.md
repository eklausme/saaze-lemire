---
date: "2009-10-02 12:00:00"
title: "Sensible hashing of variable-length strings is impossible"
---



Consider the problem of hashing an infinite number of keysâ€”such as the set of all strings of any lengthâ€”to the set of numbers in {1,2,&hellip;,<em>b</em>}. Random hashing proceeds by first picking at random a hash function _h_ in a family of _H_ functions.

I will show that __there is always an infinite number of keys that are certain to collide over all _H_ functions__, that is, they always have the same hash value for all hash functions.

Pick any hash function <em>h</em>: there is at least one hash value _y_ such that the set <em>A</em>={<em>s</em>:<em>h</em>(<em>s</em>)=<em>y</em>} is infinite, that is, you have infinitely many strings colliding. Pick any other hash function <em>h</em>&lsquo; and hash the keys in the set <em>A</em>. There is at least one hash value <em>y</em>&lsquo; such that the set <em>A</em>&lsquo;={<em>s</em> is in <em>A</em>: <em>h</em>&lsquo;(<em>s</em>)=<em>y</em>&lsquo;} is infinite, that is, there are infinitely many strings colliding on two hash functions. You can repeat this argument any number of times. Repeat it _H_ times. Then you have an infinite set of strings where all strings collide over all of your _H_ hash functions. CQFD.

__Further reading:__ [Do hash tables work in constant time?](/lemire/blog/2009/08/18/do-hash-tables-work-in-constant-time/) (blog post) and [Recursive n-gram hashing is pairwise independent, at best](http://arxiv.org/abs/0705.4676) (research paper).

