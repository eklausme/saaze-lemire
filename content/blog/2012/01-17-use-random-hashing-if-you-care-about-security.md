---
date: "2012-01-17 12:00:00"
title: "Use random hashing if you care about security?"
---



Hashing is a programming technique that maps objects (such as strings) to integers. It is a necessary component of [hash tables](https://en.wikipedia.org/wiki/Hash_table), one of the most frequently used data structure in Computer Science. 

Typically, hash tables have the property that looking up or storing a value associated with a key requires constant time. If you use user identifiers to retrieve names and phone numbers, you can scale up to millions and millions of users without performance penalty. However, the worst case complexity of a hash table is linear: it may need to go through most values each time you want to look up a key. Thankfully, the worst case is typically improbable: it only happens when too many objects hash to the same value. In practice, hash functions are chosen so as to spread hash values uniformly (pseudo-randomly). 

Most programming languages like Java or C++ use deterministic hash functions. This means that given a string, it will always hash to the same integer, for all Java software in the whole world. And overall, deterministic hashing works quite well. Unfortunately, deterministic hashing is insecure. If your are building a web application, and hackers know which hash function you are using, they can create a [denial-of-service attack](https://en.wikipedia.org/wiki/Denial-of-service_attack) and bring down your application. The gist of it is not complicated: it suffices to ensure that the hash tables fall back on their worst case performance.

This is very serious: it means that if you rely on the default hash functions of your programming language (e.g., String.hashCode in Java), your application could be at risk. On this issue, Alexander Klink and Julian WÃ¤lde issued a well written security advisory. 

The fix is relatively simple: programming languages need to adopt random hashing. In random hashing, every time the software is initialized, a new hash function is picked, at random. This does not make attacks impossible, but it makes them much more difficult.

The problem is not novel. In 2003, Crosby and Wallach raised the issue and many responsible vendors fixed their products. Alas, the only programming languages to adopt random hashing were Ruby and [Perl](http://perldoc.perl.org/perlsec.html#Algorithmic-Complexity-Attacks). Others are more reluctant.

So, how easy is it to hack the hash functions in, say, Java? Java uses an iterated hash function. At each iteration, iterated hash functions compute a new hash value from the preceding hash value and the next character. Strings in Java are hashed using the function<br/>
<code>F(y,c) = 31 y + c.</code><br/>
where y is the previous hash value and c is the current character value. Thus, the hash value of a string made of the characters 65, 66 (corresponding to &ldquo;AB&rdquo; in ASCII) is 31 times 65 + 66 which is 2081. 

Why does Java uses the number 31? The choice is somewhat arbitrary (and 31 might fail to be ideal) but because it is an odd number, the compression function F is <a href="http://arxiv.org/abs/1008.1715"><em>permuting</em> which helps distribute more uniformly the hash values</a>.

It is fairly hard to construct reasonable strings that collide over 32 bits in Java. However, a modest hash table will use only the first few bits of the hash values. Let us consider only the first 16 bits. It is not difficult to check that the strings &ldquo;Ace&rdquo;,&rdquo;BDe&rdquo;,&rdquo;AdF&rdquo; and &ldquo;BEF&rdquo; all have the same hash value in Java.

Of course, having 4 strings colliding will not disrupt hash tables. But because the hash function is iterated, we can multiply the number of collisions. Indeed, any two same-length sequences of these four colliding strings will also collide. This means that you can construct 16 strings of length 6 all colliding (&ldquo;AceAce&rdquo;,&rdquo;AceBDe&rdquo;,&rdquo;AceAdF&rdquo;, &ldquo;AceBEF&rdquo;, &ldquo;BDeAce&rdquo;,&rdquo;BDeBDe&rdquo;,&rdquo;BDeAdF&rdquo;, &ldquo;BDeBEF&rdquo;, &ldquo;AdFAce&rdquo;,&rdquo;AdFBDe&rdquo;,&rdquo;AdFAdF&rdquo;, &ldquo;AdFBEF&rdquo;, &ldquo;BEFAce&rdquo;,&rdquo;BEFBDe&rdquo;,&rdquo;BEFAdF&rdquo;, and &ldquo;BEFBEF&rdquo;). You can keep going to 64 strings of length 9. And so on.

How badly does this impact the performance of a hash table? I tried inserting all the colliding strings in a Java Hashtable container. For comparison, I also inserted randomly chosen strings into either a Hashtable or a TreeMap (tree structure). The net result is that what should be a tiny cost (0.006 s) becomes a massive cost (30s). A server able to process thousands of queries per second might quickly become bogged down trying to process a couple of queries per second.

number of strings        |hash table: average time (s) |hash table: worst time (s)  |tree: average time (s)   |
-------------------------|-------------------------|-------------------------|-------------------------|
16384                    |0.002                    |1.1                      |0.005                    |
65536                    |0.006                    |30                       |0.03                     |


For these tests, I am using a MacBook Air with a 1.8 GHz Intel Core i7 running Java 6. My code is [available](http://pastebin.com/bznPrDTz). 

Why aren&rsquo;t programming languages adopting random hashing? A potential issue is that language designers like determinism. They much prefer reproducible bugs. Nevertheless, any expert programmer should be aware of this problem.

__Further reading__: 

- Scott A. Crosby and Dan S. Wallach, Denial of Service via Algorithmic Complexity Attacks, Usenix Security&rsquo;03.
- Daniel Lemire, [The universality of iterated hashing over variable-length strings](http://arxiv.org/abs/1008.1715), Discrete Applied Mathematics 160 (4-5), 2012.
- Owen Kaser and Daniel Lemire, [Strongly universal string hashing is fast](http://arxiv.org/abs/1202.4961) 


__Update__: I initially reported that Ruby was the only language to adopt random hashing. In fact, Perl adopted random hashing with version 5.8.1. In version 5.8.2, Perl adopted [an hybrid that switches between a deterministic and a random hash function when needed](http://perldoc.perl.org/perlsec.html#Algorithmic-Complexity-Attacks). (Thanks to Mike Giroux for the pointer.)

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

