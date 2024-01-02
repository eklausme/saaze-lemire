---
date: "2018-08-25 12:00:00"
title: "AVX-512 throttling: heavy instructions are maybe not so dangerous"
---



Recent Intel processors have fancy instructions operating over 512-bit registers. They are reported to cause a frequency throttling of the core where they are run, and possibly of other cores in some cases. Thus, it has been recommended to avoid AVX-512 instructions. I have written a series of blog posts on the topic trying to reproduce the effect. Though I can measure some level of performance degradation, if [I work hard](/lemire/blog/2018/08/24/trying-harder-to-make-avx-512-look-bad-my-quantified-and-reproducible-results/), [I simply cannot find the &ldquo;obvious&rdquo; performance degradations (50%) that are often advertised](https://blog.cloudflare.com/on-the-dangers-of-intels-frequency-scaling/). I tested on two distinct processors. I tried single-threaded and multi-threaded code. 

There is more to the story than appears at first. 

[Travis Downs wrote a fancy tool to investigate the issue](https://github.com/travisdowns/avx-turbo). Let me reproduce some of his findings in my own words. According to Intel&rsquo;s documentation, there are two types of AVX-512, light instructions (e.g., integer additions) and heavy instructions (e.g., multiplications). Heavy instructions reportedly cause a much greater frequency throttle. None of my tests showed that. Travis found that it is quite hard to trigger: 

> Even a stream of 1 FMAD [fused multiplyâ€“add] every 4 or even 2 cycles doesn&rsquo;t set the frequency down lower. The lowest speed is only reached if FMAs [fused multiplyâ€“add] come at a rate of more than 1 every 2 cycles.


As far as I can tell, this is absent from Intel&rsquo;s documentation. If Travis is right, and I have no reason to doubt him, this means that the reported massive frequency throttling (slowest license) that we find everywhere online (including on Intel&rsquo;s site) requires substantial qualification. Few people will ever achieve the rate of sustained heavy instructions that Travis documents.

For example, if you use AVX-512 to for pattern matching ([Intel Hyperscan](https://github.com/intel/hyperscan)), to [code and decode base64](/lemire/blog/2018/01/17/ridiculously-fast-base64-encoding-and-decoding/), or [to compress and uncompress integers](/lemire/blog/2017/09/27/stream-vbyte-breaking-new-speed-records-for-integer-compression/), you are probably never going to trigger massive throttling. If you do a lot of cryptography, machine learning or number crunching, the story might be different. 

It is important to take into account how much you gain in the first place by going to AVX-512. For example, [openssl found that a particular cryptographic routine involving many multiplications ran 30% faster on a per-cycle basis](https://github.com/openssl/openssl/pull/4838/files) with AVX-512. Once you factor in some throttling, it is easy to see how it could be wasteful. So maybe a sensible approach is to ensure that you make substantial gains when using AVX-512 if it involves many heavy instructions.

__Update__: The same holds true for AVX (256-bit) instructions. For AVX instructions to lead to any throttle at all, you have sustain expensive instructions repeatedly every 1 or 2 cycles.

__Further reading__: [AVX-512: when and how to use these new instructions](/lemire/blog/2018/09/07/avx-512-when-and-how-to-use-these-new-instructions/)

