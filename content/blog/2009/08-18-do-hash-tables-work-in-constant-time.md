---
date: "2009-08-18 12:00:00"
title: "Do hash tables work in constant time?"
---



Theory in Computer Scienceâ€”as in any other fieldâ€”is based on models. These models make many hidden assumptions. This is one of the fundamental reason why [pure theory is wasteful](/lemire/blog/2008/06/05/why-pure-theory-is-wasteful/). We must constantly revisit our old assumptions and run experiments to determine whether our models are useful.

<img decoding="async" style="float: right; width: 40%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7d/Hash_table_3_1_1_0_1_0_0_SP.svg/315px-Hash_table_3_1_1_0_1_0_0_SP.svg.png" alt /><br/>
[Hash tables](https://en.wikipedia.org/wiki/Hash_table) are a fundamental data structure. They are part of every elementary introduction to Computer Science. From a programmer&rsquo;s point of view, they associate keys with values. Hash tables go back to the beginnings of Computer Science even though new variations keep being invented (e.g.,&nbsp;[Cuckoo hashing](https://en.wikipedia.org/wiki/Cuckoo_hashing)).&nbsp;Incredibly, hash tables were [just recently integrated in the C++ language](https://en.wikipedia.org/wiki/Unordered_map_(C%2B%2B_class)), but less conservative languages like Java, Python, Ruby, Perl, PHP, all have hash tables built-in.

The secret sauce is that the key is first transformed (or hashed) to a number between 1 and _m_ corresponding to a cell in an array. As long as this number of generated with [sufficient randomness](https://en.wikipedia.org/wiki/Universal_hashing), hash tables are almost equivalent to looking up values in an arrayâ€”except for the overhead of hashing the key.

Thus, <em>everyone knows</em> that hash table queries run in amortized constant time. That is, as the number of keys increases, the average time necessary to recover a key-value pair does not increase.

But wait! How do we compute hash values? Consider the standard universal hashing technique described in Corman et al.&nbsp;[Introduction to Algorithms](https://www.amazon.com/Introduction-Algorithms-Second-Thomas-Cormen/dp/0262032937). We pick any prime number <em>m</em>. Pick randomly a number a in [0,m). Then <em>h</em>(<em>x</em>)= _x_ <em>a</em> modulo <em>m </em>is a [universal hash function](https://en.wikipedia.org/wiki/Universal_hashing). Multiplications of numbers in [0,<em>m</em>) can [almost be done](https://en.wikipedia.org/wiki/F%C3%BCrer%27s_algorithm) in time <em>O</em>(log <em>m</em>). &nbsp;For the purposes of hash tables, the number _m_ must be close to the number of different keys <em>n</em>. Thusâ€”formallyâ€”hash tables often run in time <em>O</em>(log <em>n</em>).

Am I being pedantic? Does the time required to multiply integers on modern machine depend on the size of the integers? It certainly does if you are using&nbsp;__[vectorization](https://en.wikipedia.org/wiki/Vectorization_(computer_science))__. And vectorization is&nbsp;[used in commercial databases](http://www.dbms2.com/2009/08/04/vectorwise-ingres-and-monetdb/)!

And what if your key is a string? As you have more keys, you are more likely to encounter longer strings which take longer to hash.

__Thus, it is possible for hash tables to run in time__ <em>__O__</em>__(____log__ <em>__n__</em>__) in practice, despite what the textbooks say.__

What other hidden assumptions are you making right now?

__Note 1__: Fortunately, universal hashing&nbsp;[can be computed in linear time](http://arxiv.org/abs/0705.4676) with respect to the number of bits, by avoiding multiplications.

__Note 2:__ The problems that result from picking the wrong model of computation are well known and addressed by most textbooks. I have not discovered anything new.

__Note 3:__ In a recent paper on [fast string hashing](http://arxiv.org/abs/1202.4961), we show that, in practice, you can hash strings for a fraction of a CPU cycles per byte.

__Update:__ See my more recent post [Sensible hashing of variable-length strings is impossible](/lemire/blog/2009/10/02/sensible-hashing-of-variable-length-strings-is-impossible/).

