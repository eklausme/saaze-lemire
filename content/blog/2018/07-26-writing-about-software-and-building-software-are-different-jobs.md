---
date: "2018-07-26 12:00:00"
title: "Writing about software and building software are different jobs"
---



Code taken from a blog post is meant to illustrate an idea. Blogging is literature, not engineering. Don&rsquo;t build production systems by copying and pasting random code form the Internet. It will not end well.

A reader commented that some of my C code from an earlier [blog post](/lemire/blog/2016/06/30/fast-random-shuffling/) is not proper C:
```C
uint32_t random_bounded(uint32_t range) {
  uint64_t random32bit =  random32(); //32-bit random number 
  multiresult = random32bit * range;
  return multiresult >> 32;
}
```


This is true: the type of the &ldquo;multiresult&rdquo; variable to not specified. In that post, I deliberately omitted to specify the type because anyone familiar with C can correctly infer the type. In fact, a large fraction of the code you will find on my blog post is similarly simplified. I often remove special cases, I roll my loops and so forth. That&rsquo;s because I hope to make it more readable. Real code is often filled with boring details.

It is not that I don&rsquo;t believe in providing working code. I actually think it is super important and I do it systematically. For example, [the post points to the source code in correct C](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/06/29). This blog post is accompanied by a [research paper](https://arxiv.org/abs/1805.10941). The research paper points to a [GitHub repository](https://github.com/lemire/FastShuffleExperiments) that provides reproducible experiments. This code was even peer-reviewed along with the research paper.

However, when someone explains a concept and provides a code sample, I take that as literature, not engineering. You are meant to read the code, not use it as a ready-made reusable artefact.

Simplification is not the same as carelessness. Simplified is not the same as wrong. You should report typographical errors and the like, but if you take the code that served to illustrate an idea, copy it mindlessly in your application code, you have missed a step. You are meant to read the code, not copy it into your production code.

