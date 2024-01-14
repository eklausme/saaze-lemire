---
date: "2019-05-19 12:00:00"
title: "Measuring the system clock frequency using loops (Intel and ARM)"
---



In my previous post, [Bitset decoding on Apple’s A12](/lemire/blog/2019/05/15/bitset-decoding-on-apples-a12/), I showed that Apple&rsquo;s latest ARM-based processor can decode set bits out of a stream of words using 3 cycles per set bit. This compares favourably to Intel processors since I never could get one of them to do better than 3.5 cycles per set bit on the same benchmark. It is also more than twice as efficient as [an ARM-based server](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2019/05/03/RESULTS_AARCH64_AMPERE.md) on a per cycle basis.

In my initial blog post on the Apple A12, I complained that I was merely speculating regarding the clock speed. That is, I read on Wikipedia that the A12 could run at 2.5GHz and I assumed that this was the actual speed.

It was immediately pointed out to me by Vlad Krasnov of Cloudflare, and later by Travis Downs, that I can measure the clock speed, if only indirectly, by writing a small loop in assembly.

There are many ways to achieve the desired goal. On Intel x64 processor, you can write a tight loop that decrements a counter by one with each iteration. At best, this can run in one subtraction per cycle and Intel processors are good enough to achieve this rate:
```C
; initialize 'counter' with the desired number
label:
dec counter ; decrement counter
jnz label ; goes to label if counter is not zero
```


In fact, Intel processors fuse the two instruction (dec and jnz) into a single microinstruction and they have special optimizations for tight loops.

You can write a function that runs in almost exactly &ldquo;x&rdquo; cycles for any &ldquo;x&rdquo; large enough. Of course, it could take a bit longer but if &ldquo;x&rdquo; is small enough and you try enough times, you can get a good result.

What about ARM processors? You can apply the same recipe, though you have to use different instructions.
```C
; initialize 'counter' with the desired number
label:
subs counter, counter, #1 ; decrement counter
bne label ; goes to label if counter is not zero
```


In my initial version, I had unrolled these loops. The intuition was that I could bring the overhead of the cost down to zero. However, the code just looked ugly. Yet Travis Downs and Steve Canon insisted that the unrolled loop was the way to do. So I do it two ways: as an unrolled loop, and as a tight loop.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/05/18). I also provide a script which can run the executable several times. Keep in mind that the frequency of your cores can change, and it takes some time before an unsolicited processor gets back to its highest frequency.

The tight loop is pretty, but the price I pay is that I must account for the cost of the loop. Empirically, I found that the [ARM Skylark as well as the ARM Cortex A72 take two cycles per iteration](/lemire/blog/2019/05/14/setting-up-a-rockpro64-powerful-single-card-computer/). The Apple A12 takes a single cycle per iteration. It appears that the other ARM processors might not be able to take a branch every cycle, so they may be unable to support a one-cycle-per-iteration loop.

Of course, you can measure the CPU frequency with performance counters, so my little program is probably useless on systems like Linux. However, you can also grab [my updated ios application](https://github.com/lemire/iosbitmapdecoding), it will tell you about your processor speed on your iPhone. On the Apple A12, I do not need to do anything sophisticated to measure the frequency as I consistently get 2.5 GHz with a simple tight loop after I have stressed the processor enough.

__Credit__: I thank Vlad Krasnov (Cloudflare), Travis Downs and Steve Canon (Apple) for their valuable inputs.

