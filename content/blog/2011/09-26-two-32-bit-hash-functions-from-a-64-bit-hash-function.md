---
date: "2011-09-26 12:00:00"
title: "Two 32-bit hash functions from a 64-bit hash function?"
---



A few years ago, we worked on [automatically removing boilerplate text](http://arxiv.org/abs/0707.1913) from e-books taken from the [Project Gutenberg](https://en.wikipedia.org/wiki/Project_Gutenberg). In this type of problem, you want to quickly identify whether a line of text is likely part of the boilerplate text. You could build a [hash table](https://en.wikipedia.org/wiki/Hash_table), but hash tables tend to be use a lot of memory because they must store all the keys. This is especially bad if the keys are long strings.

Can you implement a hash table without storing the keys? You cannot, of course. However, you can learn from [Bloom filters](https://en.wikipedia.org/wiki/Bloom_filter): [hash functions](https://en.wikipedia.org/wiki/Hash_functions) are sufficient to test quickly whether an element is not part of a set.

Let me consider an example. Suppose that I have three strings (&ldquo;dad&rdquo;, &ldquo;mom&rdquo; and &ldquo;dog&rdquo;) and they have the hash values 2, 4,&nbsp; and 5. Suppose that I want to check whether &ldquo;cat&rdquo; is part of the set. Maybe its hash value is 3. In this case, I can immediately see that 3 is not part of the set (because 3 is not in {2,4,5}). Of course, if &ldquo;cat&rdquo; hashes to 2, I could falsely conclude that &ldquo;cat&rdquo; is part of my set. We can increase the accuracy of this method by using several hash functions.

In my e-book scenario, I can check quickly whether a line is __not__ part of the boilerplate. This might be good enough.

There is a catch however: computing many hash functions is expensive. Thankfully, [Kirsch and Mitzenmacher](http://citeseer.ist.psu.edu/viewdoc/download;jsessionid=4060353E67A356EF9528D2C57C064F5A?doi=10.1.1.152.579&amp;rep=rep1&amp;type=pdf) showed that only two hash functions were enough. Will Fitzgerald went a step further and [hinted that a single hash](http://willwhim.wpengine.com/) function might be required. Indeed, you can compute a 64-bit hash function and make two 32-bit hash functions out of it: use the first 32 bits for the first hash function and the remaining 32 bits for the other. On 64-bit processors, computing a 64-bit hash function might be just as fast as computing a 32-bit hash function. Will&rsquo;s idea is perfectly sound. However, it might be trickier to implement than one might expect.

Let me consider a simple form of [Fowler-Noll-Vo](https://en.wikipedia.org/wiki/Fowler_Noll_Vo_hash) hashing: given a 32-bit integer <em>c</em>, the hash value is given by _cp_ mod 2<sup>64</sup> for some prime <em>p</em>. This a decent hash functions: as remarked by [Dietzfelbinger et al. (1997)](http://www.sciencedirect.com/science/article/pii/S0196677497908737), it is [almost universal](https://en.wikipedia.org/wiki/Universal_hashing) if you pick the prime _p_ at random. But the first 32 bits are not a good hash function. Indeed, simply pick _c_ to be 2<sup>31</sup>: all but the last of the first 32 bits will be zero irrespective of <em>p</em>. It also does not help if you apply a bitwise exclusive or (XOR) on <em>c </em>using a random seed before multiplying it by <em>p,</em> that is if you compute (<em>c ^ y </em>)<em> p</em>: the first 31 bits will be determined by the product of the prime _p_ and the random seed <em>y</em>. I can extend this analysis to string hashing as well.

__Hence, even if you have a good 64-bit hash function (say it is almost universal), it may not be true that the first 32 bits form a good hash function.__ How can you avoid this problem? If your hash function is [strongly universal](https://en.wikipedia.org/wiki/UMAC#Strongly_universal_hashing), then the first few bits will indeed form a strongly universal hash function of its own. But this may not be practical if you require 32-bit hash functions: I do not know how to compute quickly a strongly universal 64-bit hash function using 64-bit arithmetic. You can, however, generate a strongly universal 32-bit hash function using 64-bit arithmetic. Just compute <em>h</em>(<em>x</em>)=(<em>ax</em>+<em>b</em>) / 2<sup>32</sup> where _a_ and _b_ are random 64-bit integers and the value _x_ is a 32-bit integer. Then, you can safely consider the first and the last 16 bits: they will be strongly universal.

So it is simply not true that a 64-bit hash function can be treated safely as two 32-bit hash functions.

__Further reading__: Daniel Lemire and Owen Kaser, [Recursive n-gram hashing is pairwise independent, at best](http://arxiv.org/abs/0705.4676), Computer Speech &amp; Language 24 (4), pages 698-710, 2010.

__Note__: I am abusing the language since a single function cannot be universal or strongly universal, but I did not want to talk about families of hash functions.

