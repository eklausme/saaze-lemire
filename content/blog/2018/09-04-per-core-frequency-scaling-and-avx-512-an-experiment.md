---
date: "2018-09-04 12:00:00"
title: "Per-core frequency scaling and AVX-512: an experiment"
---



Intel has fancy new instructions (AVX-512) that are powerful, in part for heavy numerical work. When a core uses these heaviest of these new instructions, the core&rsquo;s frequency comes down to maintain the power usage within bounds.

I wanted to test it out so I wrote a little threaded program. It runs on four threads which, probabilistically, might run each on its own core. It helps that my Xeon W-2104 does not have hyperthreading (as far as I know) so that only one (physical) thread should run per core at any time.

I use X of these cores to do heavy AVX-512 work while the test do normal floating-point operations. My variable X varies from 0 to 4. I measure the average system frequency.

number of heavy cores    |average measured frequency |
-------------------------|-------------------------|
0                        |3.178 GHz                |
1                        |3.073 GHz                |
2                        |2.911 GHz                |
3                        |2.751 GHz                |
4                        |2.491 GHz                |


I could figure out the per-core frequency, but I do not have good tool handy to do the work right now, and I don&rsquo;t want to add more code to my short experiment. 

Let us do some math instead.

My benchmark is not perfect. For example, the heavy threads might finish earlier than the regular threads. Still, let us assume that the heavy cores run at a frequency of 2.491 GHz while the other cores run at a frequency of 3.178 GHz, and let us compute the expected average frequency.

number of heavy cores    |expected average frequency |
-------------------------|-------------------------|
0                        |3.178 GHz                |
1                        |3.006 GHz                |
2                        |2.835 GHz                |
3                        |2.663 GHz                |
4                        |2.491 GHz                |


My model is correct within 3%. So it is not an unreasonable mental model, on this machine, to assume that cores on which you run heavy AVX-512 run slower (at 2.491 GHz) while the rest of cores run at full speed (3.178 GHz).

[My code is available, run it under Linux](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/09/04).

__Further reading__: [AVX-512: when and how to use these new instructions](/lemire/blog/2018/09/07/avx-512-when-and-how-to-use-these-new-instructions/)

