---
date: "2023-04-07 12:00:00"
title: "Programming-language popularity by GitHub pull requests"
---



GitHub is probably the most popular software repository in the world. One important feature on GitHub is the &lsquo;pull request&rsquo;: we often contribute to a piece of software by proposing changes to a piece of code.

The number of pull requests is not, per se, an objective measure of how much one contributes to a piece of software. Pull requests can be large or small. It is also possible to commit directly to a software project without ever creating a pull request. Furthermore, some automated tools will generate pull requests (for security patches). This is especially common in JavaScript and TypeScript.

Nevertheless, in my view, the number of pull requests is an important indicator of how much people are willing and capable of contributing to your software in the open source domain.

The gist of the story goes as follows:

1. The most popular languages are JavaScript/TypeScript and Python with roughly 20% of all pull requests each. In effect, if you put JavaScript/TypeScript and Python together, you get about 40% of all pull requests.
1. Then you get the second tier languages: Java and Scala, C/C++, and Go. They all are in the 10% to 15% range.
1. Finally, you have PHP, Ruby and C# that all manage to get about 5% of all pull requests.
1. Other languages are typically far below 5%.


The popularity of JavaScript and derivative languages is strong. It matches my experience. I have published a few JavaScript/TypeScript librairies ([FastPriorityQueue.js](https://github.com/lemire/FastPriorityQueue.js) and [FastBitSet.js](https://github.com/lemire/FastBitSet.js)) and they have received a continuous flow of contributions. It appears that TypeScript is progressively replacing part of JavaScript, but they are often used interchangeably.

Python is close behind: 15% to 20% of the pull requests. I suspect that being the default programming language of data science is helping sustain its well deserved popularity. I mostly use Python for quick scripts.

Java and Scala are still quite strong (10% to 15%): we do not observe a decline in the popularity of Java and it may even be gaining. It seems that the bet on faster release cycles in Java is beneficial. The language and the JVM are fast improving. Our [RoaringBitmap library](https://github.com/RoaringBitmap/RoaringBitmap) is receiving a constant flow of high-quality pull requests. I am a little bit surprised at the sustained popularity of Java, but it is undeniable. I find that building and publishing Java artefacts is unnecessarily challenging, compared to JavaScript and Python.

C/C++ is on the rise (above 10%). C++ has roughly doubled its relative popularity in terms of pull requests in the last ten years. I suspect that the great work that the C++ standard committee is doing, modernizing the language with every new standard, is helping. The tooling in C++ is also fast improving: it is easier than ever to write good C++ code. I have probably never spent as much time programming in C++ ([simdjson](https://github.com/simdjson/simdjson), [simdutf](https://github.com/simdutf/simdutf), [ada](https://github.com/ada-url/ada), [fast_float](https://github.com/fastfloat/fast_float)). I find it easy to find really smart collaborators.

Go is holding at nearly 10%: it underwent a fast rise but seems to have plateaued starting in 2018. I imagine that the imminent release of Go 2.0 could help. Our [Bloom and bitset libraries in Go](https://github.com/bits-and-blooms) (see [roaring](https://github.com/RoaringBitmap/roaring) too) receive many pull requests. Go is still one of my favourite programming languages. You can teach Go in a week-end, it comes with all the necessary tools (benchmarking, formatting, testing), its runtime library is accessible and complete, it is trivial to deploy a Go binary on a server, it builds quickly.

PHP and Ruby are falling (both at 5%) to C# level (around 5%). Ten years ago, both PHP and Ruby were default programming languages on the web. I am not exactly sure why PHP is falling in popularity among open source developers, but I  suspect that it might be suffering at the hands of JavaScript/TypeScript. C# is holding steady but I consider that it is an underrated programming language.

Source: [A small place to discover languages in GitHub](https://madnight.github.io/githut/#/pull_requests/2022/4).

