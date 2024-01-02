---
date: "2019-12-19 12:00:00"
title: "Xor Filters: Faster and Smaller Than Bloom Filters"
---



In software, you frequently need to check whether some objects is in a set. For example, you might have a list of forbidden Web addresses. As someone enters a new Web address, you may want to check whether it is part of your black list. Or maybe you have a large list of already used passwords and you want to check whether the proposed new password is part of this list of compromised passwords.

The standard way to solve this problem is to create some key-value data structure. If you have enough memory, you might create a hash table. Or you might use a good old database.

However, such approaches might use too much memory or be too slow. So you want to use a small data structure that can quickly filter the requests. For example, what if you had a tiny data structure that could reliably tell you that your password is not in the list of compromised password?

One way to implement such a filter would be to compute a hash value of all your objects. A hash value is a random-looking number that you generate from your object, in such a way that the same object always generate the same random-looking number, but such that other objects are likely to generate other numbers. So the password &ldquo;Toronto&rdquo; might map to the hash value 32. You can then store these small numbers into a key-value store, like a hash table. Hence, you do not need to store all of the objects. For example, you might store 32-bit numbers for each possible password. If you give me a potential password, I check whether its corresponding 32-bit value is in the list and if it is not, then I tell you that it is safe. So if you give me &ldquo;Toronto&rdquo;, I check whether 32 is in my table. Otherwise, I send your request to a larger database, for a full lookup. The probability that I send you in vain for a full lookup is called the &ldquo;false positive probability&rdquo;.

Though this hash table approach might be practical, you could end up using 4 bytes per value. Maybe this is too much? [Bloom filters](https://en.wikipedia.org/wiki/Bloom_filter) come to the rescue. A Bloom filter works similarly, except that you compute several hash values from your object. You use these hash values as indexes inside an array of bits. When adding an object to the set, you set all bits corresponding to the objects to one. When you receive a new object and you want to check whether it belongs to the set, you can just check whether all of the bits have been set. In practice, you will use far fewer than 4 bytes per value (say 12 bits) and still be able to achieve a false positive rate of less than 1%.

While the Bloom filter is a textbook algorithm, it has some significant downsides. A major one is that it needs many data accesses and many hash values to check that an object is part of the set. In short, it is not optimally fast.

Can you do better? Yes. Among other alternatives, [Fan et al. introduced Cuckoo filters which use less space and are faster than Bloom filters](https://en.wikipedia.org/wiki/Cuckoo_filter). While implementing a Bloom filter is a relatively simple exercise, Cuckoo filters require a bit more engineering.

Could we do even better while limiting the code to something you can hold in your head?

It turns out that you can with xor filters. We just published a paper called [Xor Filters: Faster and Smaller Than Bloom and Cuckoo Filters](https://arxiv.org/abs/1912.08258) that will appear in the Journal of Experimental Algorithmics.

The following figure gives the number of bits per entry versus the false positive probability. Xor filters offer better accuracy for a given memory budget. With only 9 bits per entry, you can get a false positive probability much less than 1%.

<a href="https://lemire.me/blog/wp-content/uploads/2019/12/comparison.png"><img fetchpriority="high" decoding="async" class="alignnone size-full wp-image-18114" src="https://lemire.me/blog/wp-content/uploads/2019/12/comparison.png" alt width="1442" height="1282" srcset="https://lemire.me/blog/wp-content/uploads/2019/12/comparison.png 1442w, https://lemire.me/blog/wp-content/uploads/2019/12/comparison-300x267.png 300w, https://lemire.me/blog/wp-content/uploads/2019/12/comparison-1024x910.png 1024w, https://lemire.me/blog/wp-content/uploads/2019/12/comparison-768x683.png 768w" sizes="(max-width: 1442px) 100vw, 1442px" /></a>

[The complete implementation in Go fits in less than 300 lines](https://github.com/FastFilter/xorfilter/blob/master/xorfilter.go) and I did not even try to be short. In fact, any semi-competent Go coder can make it fit within 200 lines.

[We also have an optimized C version that can be easily integrated into your projects since it is a single-header](https://github.com/FastFilter/xor_singleheader). It is larger than 300 lines, but contains different alternatives including an approach with slightly faster construction. I wrote a small demonstration in C with [a compromised password detection problem](https://github.com/FastFilter/FilterPassword). The xor filters takes a bit longer to build, but once built, it uses less memory and is about 25% faster.

We also have [Java](https://github.com/FastFilter/fastfilter_java) and [C++ implementations](https://github.com/FastFilter/fastfilter_cpp). We have [Rust](https://github.com/bnclabs/xorfilter), [Python](https://github.com/GreyDireWolf/pyxorfilter)<br/>
and [Erlang](https://github.com/mpope9/exor_filter) versions.

An xor filter is meant to be immutable. You build it once, and simply rebuild it when needed. Though you can update a Bloom filter, by adding keys to it, it means either overallocating the initial filter, or sacrificing accuracy. These filters are typically not meant to be used as dynamic data structure (unlike a hash table) since they have a fixed capacity. In the case of cuckoo filters, once you approach the maximum capacity (say within 94%), then the insertion of new values may fail, and the solution when it does is to rebuild the whole thing.

Deletions are generally unsafe with these filters even in principle because they track hash values and cannot deal with collisions without access to the object data: if you have two objects mapping to the same hash value, and you have a filter on hash values, it is going to be difficult to delete one without the other. No matter what, you must somehow keep track of what was added in the filter and what was removed, and the filter itself cannot tell you. The same issue is at play when you are building the filter: the filter itself cannot tell you whether you already added an element: you have to keep track of this information yourself.

Furthermore all these filters are frequently used in a concurrent setting, with multiple threads. You typically cannot safely modify the filter while querying it. The simplest solution to avoid expensive locks, is to make it immutable. Keep in mind that these filters are meant to be small.

The construction of the xor filter requires several bytes of temporary memory per entry, but this memory can be released immediately after construction and a compact data structure remains, using just a few bits per entry.

If you do not have stringent requirements regarding memory usage, other techniques might be preferable like blocked Bloom filters which have unbeatable speed (at the expense of higher memory usage). The xor filters are really at their best when you want high speed and tight memory usage.

__Credit__: This is joint work with Thomas Mueller Graf. Xor filters are basically an efficient implementation and specialization of a theoretical construction, the Bloomier filter.

