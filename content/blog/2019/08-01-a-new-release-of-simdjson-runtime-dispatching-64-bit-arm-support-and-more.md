---
date: "2019-08-01 12:00:00"
title: "A new release of simdjson: runtime dispatching, 64-bit ARM support and more"
---



JSON is a ubiquitous data exchange format. It is found everywhere on the Internet. To consume JSON, software uses tools called JSON parsers.

Earlier this year, we released the first version of our JSON parsing library, simdjson. It is arguably the fastest standard-compliant parser in the world. It provides full validation. That is, while we try to go as fast as possible, we do not compromise on input validation, and we still process many files at gigabytes per second.

You may wonder why you would care about going fast? But consider that good disks and network chips can provide gigabytes per second of bandwidth. If you can&rsquo;t process simple files like JSON at comparable speeds, all the bandwidth in the world won&rsquo;t help you.

So how do we do it? Our trick is to leverage the advanced instructions found on commodity processors such as SIMD instructions. We are not the first ones to go this route, but I think we are the first ones to go so far.

We have published a new  new major release (0.2.0). It brings about many improvements:

- This first version only ran on recent Intel and AMD processors. We were able to add support for 64-bit ARM processors found on mobile devices. [You can run our library on an iPhone](/lemire/blog/2019/07/10/parsing-json-using-simd-instructions-on-the-apple-a12-processor/). We found that our great speed carries over: we are sometimes close to 2 GB/s.
- We added support for older PC processors. In fact, we did better: we also introduced runtime dispatching on x64 processors. It means that the software will smartly recognize the feature of your processor and adapt, running the best code paths. We support processors as far back as the Intel Westmere or the AMD Jaguar (PlayStation 4).
- We now support [JSON Pointer queries](https://tools.ietf.org/html/rfc6901).


Many people contributed to this new release. It is a true community effort.

This is a lot more coming in the future. Among other things, we expect to go even faster.

__Link__: [GitHub](https://github.com/lemire/simdjson).

