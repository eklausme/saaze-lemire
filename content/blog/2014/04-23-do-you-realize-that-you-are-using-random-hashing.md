---
date: "2014-04-23 12:00:00"
title: "Do you realize that you are using random hashing?"
---



Hashing is a common concept in programming. It is the process of mapping any object to an integer. It is used in fast search algorithms (like [Rabin-Karp](https://en.wikipedia.org/wiki/Rabin%E2%80%93Karp_algorithm#Hash_function_used)) and in [hash maps](https://en.wikipedia.org/wiki/Hash_map). Almost all non-trivial software depends on hashing. Hashing often works best when it <em>appears random</em>.

It used to be that hashing was deterministic. The creators of a language would specify once and for all how a given string would be hashed. For example, in Java, the hash value of the string &ldquo;a&rdquo; is 97 (<tt>"a".hashCode()</tt>). No matter how often you run a program, the hash value will always be 97.

This can be a security problem because an adversary can find many strings that hash to the value 97. And then hashing no longer appears random.

For this reason, language designers are migrating to random hashing. In random hashing, the hash value of the string &ldquo;a&rdquo; can change every time you run your program. Random hashing is now the default in Python (as of version 3.3), Ruby (as of version 1.9) and Perl (as of version 5.18).

In Ruby, random hashing means that if you run the following program many times, you will get different outputs&hellip;
```C
puts &quot;a&quot;.hash
```


The same is true of the following Python program&hellip;
```C
print ({&quot;a&quot;:1,&quot;b&quot;:2})
```


Here is the output I got, running it twice:
```C
$ python3 tmp.py
{&#39;a&#39;: 1, &#39;b&#39;: 2}
$ python3 tmp.py
{&#39;b&#39;: 2, &#39;a&#39;: 1}
```


To my knowledge, Java still relies on deterministic hashing by default. However, the specification requires you to expect random hashing: the return value of hashCode() can change from one program execution to another. 

How many Ruby, Python and Perl programmers realize that they are relying on random hashing?

