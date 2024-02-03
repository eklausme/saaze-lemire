---
date: "2022-11-29 12:00:00"
title: "How big are your SVE registers ? (AWS Graviton)"
---



Amazon has some neat ARM-based systems based on Amazon&rsquo;s own chips (Graviton). You can access them through Amazon&rsquo;s web services (AWS). These processors have advanced vector instructions able to process many values at once. These instructions are part of an instruction sets called SVE for Scalable Vector Extension. SVE has a trick: it hides its internal register size from you. Thus, to the question &ldquo;how many values can it process at once?&rdquo;, the answer is &lsquo;&rdquo;it depends&rdquo;.

Thankfully, you can still write a program to find out. The svcntb intrinsic tells you how many 8-bit integers fits in a full register. Thus the following C++ line should tell you the vector register size in bytes:
```C
std::cout << "detected vector register size (SVE): "
  << svcntb() << " bytes" << std::endl;
```


And here is what I get currently on an AWS server:
```C
$ ./svesize
detected vector register size (SVE): 32 bytes
```


It is hard to find ARM processors with such wide registers (32 bytes) and it is unclear whether future iterations will still have 32 bytes registers.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/11/29).

