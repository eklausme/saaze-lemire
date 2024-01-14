---
date: "2019-03-02 12:00:00"
title: "Parsing JSON quickly: early comparisons in the wild"
---



[JSON](https://en.wikipedia.org/wiki/JSON) is arguably the standard data interchange format on the Internet. It is text-based and needs to be &ldquo;parsed&rdquo;: the input string needs to be transformed into a conveniently data structure. In some instances, when the data volume is large, ingesting JSON is a performance bottleneck.

Last week, we discreetly made available a new library to parse JSON called [simdjson](https://github.com/lemire/simdjson). The objective of the library is to parse large volumes of JSON data as quickly as possible, possibly reaching speeds in the gigabytes per second, while providing full validation of the input. We parse everything and still try to go fast.

As far as we can tell, it might be the first JSON parser able to process data at a rate of gigabytes per second.

The library quickly become popular, and for a few days it was the second most popular repository on GitHub. As I am writing these lines, more than a week later,[ the library is still the second &ldquo;hottest&rdquo; C++ library on GitHub](https://github.com/trending/c++?since=daily), ahead of famous machine-learning libraries like tensorflow and opencv. I joked that we have beaten, for a time, deep learning: tensorflow is a massively popular deep-learning library.

[We have paper full of benchmarks](https://arxiv.org/abs/1902.08318) and my co-author (Geoff) has [a great blog post presenting our work](https://branchfree.org/2019/02/25/paper-parsing-gigabytes-of-json-per-second/).

As is sure to happen when a piece of software becomes a bit popular, a lot of interesting questions are raised. Do the results hold to scrutiny?

One point that we have anticipated in our paper and in the documentation of the software is that parsing small JSON inputs is outside of our scope. There is a qualitative difference between parsing millions of tiny documents and a few large ones. We are only preoccupied with sizeable JSON documents (e.g., 50kB and more).

With this scope in mind, how are our designs and code holding up?

There is already a [C# port by Egor Bogatov](https://github.com/EgorBo/SimdJsonSharp), a Microsoft engineer. He finds that in several instances, his port is several times faster than the alternatives. I should stress that his code is less than a week old.

The C++ library has been available for less than a week, so it is still early days. Nevertheless, clever programmers have published prototypical bindings in [Python](https://github.com/TkTech/pysimdjson) and [Javascript (node)](https://github.com/luizperes/simdjson_nodejs). In both instances, we are able to beat the standard parsers in some reasonable tasks. A significant fraction of the running is spent converting raw results from C++ into either Python or JavaScript objects. But even with this obstacle, the Python wrapper can be several times faster than the standard Python JSON parser.

It is always going to require significant engineering to get great performance when you need to interface tightly with a high-level language like Python or JavaScript&hellip;  When you really need the performance, the trick is to push the computation down within the guts of the C/C++ code.

Where next? I do not know. We have many exciting ideas. Porting this design to ARM processors is among them.

