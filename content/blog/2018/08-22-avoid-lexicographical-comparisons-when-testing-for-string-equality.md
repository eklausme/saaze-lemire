---
date: "2018-08-22 12:00:00"
title: "Avoid lexicographical comparisons when testing for string equality?"
---



By default, programmers like to compare their bytes and strings using a lexicographical order. &ldquo;Lexicographical&rdquo; is a fancy word for &ldquo;dictionary order&rdquo;. That is, you compare the first two elements, check if they differ, if they do you report which string is largest, if not you repeat with the next two elements and so forth.

In C and C++, there is a super fast function for this purpose: <tt>memcmp</tt>. Derrick Stolee reported to me [a performance regression in Git](https://public-inbox.org/git/20180821212923.GB24431@sigill.intra.peff.net/T/#u) (a well-known tool among programmers). The problem has to do with <tt>memcmp</tt>. 

Let us examine the problematic function in Git:
```C
static inline int hashcmp(const unsigned char *sha1, const unsigned char *sha2)
{
	return memcmp(sha1, sha2, the_hash_algo->rawsz);
}
```


This returns a lexicographical comparison between two hash values, return a negative value when the first is smallest, zero if they are equal, and a positive value otherwise. As it is written, I do not know how to make this faster in general. It seems that we can often assume that <tt>the_hash_algo-&gt;rawsz</tt> will be 20 or 32, but that is not terribly useful.

However, let us look at an instance of how the function is used:
```C
if (!hashcmp(sha1, pdata->objects[pos].idx.oid.hash)) {
	*found = 1;
	return i;
}
```


Do you see what is happening?

In this particular usage (and in others), we only check whether the two strings of bytes are identical. We do not need a lexicographical comparison. 

It can be easier to decide whether two strings of bytes are identical than to compare them lexicographically. Lexicographical sort critically depends on the order of the bytes whereas byte comparisons is order oblivious. Even if you just have 8 bytes to compare lexicographically on an x64 processor, the compiler will need three instructions because it needs to reorder the bytes:
```C
bswap   rcx
bswap   rdx
cmp     rcx, rdx
```


In contrast, a single instruction (<tt>cmp</tt>) is needed to determine whether the two 8-byte words are identical. It is even worse than that because x64 processors can compare a register against a memory value, thus potentially saving a load operation.

There used to be a standard C function for this purpose (<tt>bcmp</tt>) but it has been deprecated, and it is probably not highly optimized.

It is possible that your compiler is smart enough to figure out that checking that the returned value of `memcmp` is zero is equivalent to checking for equality. And your particular compiler might, indeed, be that smart. It is also possible the the overhead of the lexicographical order is irrelevant. But should you risk it?

So let me write something silly, assuming that we have exactly 20 bytes to compare:
```C
bool memeq20(const char * s1, const char * s2) {
    uint64_t w1, w2;
    memcpy(&w1, s1, sizeof(w1));
    memcpy(&w2, s2, sizeof(w2));
    if(w1 != w2) return false;
    memcpy(&w1, s1 + sizeof(w1), sizeof(w1));
    memcpy(&w2, s2 + sizeof(w2), sizeof(w2));
    if(w1 != w2) return false;
    uint32_t ww1, ww2;
    memcpy(&ww1, s1 + 2 * sizeof(w1), sizeof(ww1));
    memcpy(&ww2, s2 + 2 * sizeof(w1), sizeof(ww2));
    return (ww1 == ww2);
}
```


That should be safe and portable. I am sure that good hackers can make it faster. 

How fast is it already? Quite fast:

memcmp                   |10.5 cycles              |
-------------------------|-------------------------|
hand-rolled memcmp       |12.8 cycles              |
bcmp                     |10.5 cycles              |
check equal only         |5.2 cycles               |


My version is twice as fast as <tt>memcmp</tt>. So while I probably couldn&rsquo;t roll my own super fast `memcmp` function in 5 minutes, I certainly can beat `memcmp` with some basic code if I ask a different question instead: are the two strings of bytes identical? 

I am using GCC 5.5. Your results will vary quite a bit depending on the compiler. In some settings, it will not be possible to beat `memcmp` at all, if the compiler is sufficiently smart. Also, there might be branching involved, so the results will depend on the statistics of your data.

Nate Lawson points out another reason to shy away from unnecessary lexicographical comparison: security. [He writes](https://rdist.root.org/2014/06/24/timing-safe-memcmp-and-api-parity/):

> The most important concern is if this will encourage unsafe designs. I can&rsquo;t come up with a crypto design that requires ordering of secret data that isn&rsquo;t also a terrible idea. Sorting your AES keys? Why? Don&rsquo;t do that. (&hellip;) In any scenario that involves the need for ordering of secret data, much larger architectural issues need to be addressed than a comparison function.


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/08/22).

