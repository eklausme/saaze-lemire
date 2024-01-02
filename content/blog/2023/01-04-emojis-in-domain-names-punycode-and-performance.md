---
date: "2023-01-04 12:00:00"
title: "Emojis in domain names, punycode and performance"
---



Most domain names are encoded using ASCII (e.g., yahoo.com). However, you can register domain names with almost any character in them. For example, there is a web site at [💩.la](https://💩.la) called poopla. Yet the underlying infrastructure is basically pure ASCII. To make it work, the text of your domain is first translated into ASCII using a special encoding called &lsquo;[punycode](https://en.wikipedia.org/wiki/Punycode)&lsquo;. The poopla web site is actually at [https://xn--ls8h.la/](https://xn--ls8h.la/).

Punycode is a tricky format. Thankfully, domain names are made of labels (e.g., in microsoft.com, microsoft is a label) and each label can use at most 63 bytes. In total, a domain name cannot exceed 255 bytes, and that is after encoding it to punycode if necessary.

Some time ago, Colm MacCárthaigh suggested that I look at the performance impact of punycode. To answer the question, [I quickly implemented a function that does the job.](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/01/03) It is a single function without much fanfare. It is roughly derived from [the code in the standard](https://www.rfc-editor.org/rfc/rfc3492), but it looks simpler to me. Importantly, I do not claim that my implementation is particularly fast.

As a dataset, I use all of the examples from the wikipedia entry of punycode.

GCC 11, Intel Ice Lake   |75 ns/string             |
-------------------------|-------------------------|
Apple M2, LLVM 14        |27 ns/string             |


The punycode format is relatively complicated, it was not designed for high speed, so there are limits to how fast one can go. Nevertheless, it should be possible to go faster. Yet it is probably &lsquo;fast enough&rsquo; and it is unlikely that punycode encoding would ever be a performance bottleneck if only because domain names are almost always pure ASCII and punycode is unneeded.

__Update__: We wrote our own library to process international domain names according to the standard: it is called [idna](https://github.com/ada-url/idna) and part of the ada-url project. It turns out that punycode encoding and decoding is a small task as part of a much larger and more complex set of problems. It is indeed probably not a performance bottleneck by itself.

