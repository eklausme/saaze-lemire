---
date: "2018-12-21 12:00:00"
title: "Fast Bounded Random Numbers on GPUs"
---



We often use random numbers in software in applications such as simulations or machine learning. Fast random number generators tend to produce integers in [0,2<sup>32</sup>) or [0,2<sup>64</sup>). Yet many applications require integers in a given interval, say the interval {0,1,2,3,4,5,6,7}. Thus standard libraries frequently provide a way to request an integer within a range.

How does it work underneath? Typically, a 64-bit or 32-bit integer is produced, and then it is converted into an integer within the desired range. Unfortunately, [as pointed out in details by Melissa O&rsquo;Neill](http://www.pcg-random.org/posts/bounded-rands.html), doing so without introducing undue biases is slow. That is, it can take more time to convert the integer to the range than to produce the random integer in the first place!

In [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941), we show how to drastically accelerate this computation compared to the standard libraries. The main trick is to avoid as much as possible the use of division instructions (since they are slower). <a href="https://www.youtube.com/watch?v=jWXZ07YBsPM"><g class="gr_ gr_234 gr-alert gr_spell gr_inline_cards gr_run_anim ContextualSpelling ins-del multiReplace" id="234" data-gr-id="234">Bernardt</g> Duvenhage has a great talk on the application of this technique in Python</a>. [There is an illustrative benchmark on GitHub](https://github.com/lemire/FastShuffleExperiments).

In [the paper](https://arxiv.org/abs/1805.10941), there is a precautionary note about the applicability of this technique to GPUs. Indeed, there are substantial differences between general purposes 64-bit processors and common GPUs (32-bit). A reader, Norbert Juffa, reached out to me to point out that the note might be unwarranted. Juffa wrote a benchmark using the NVIDIA API (CUDA) to support his claim.

The fast function that avoids divisions as much as possible can be expressed using a few lines of C.

```C
// returns value in [0,s)
uint64_t nearlydivisionless (uint64_t s)  {
    uint64_t x = random64 ();
   // compute ( x * s ) >> 64
    uint64_t h = __umul64hi (x, s);    uint64_t l = x * s;
    if (l < s) {
        uint64_t t = -s % s;
        while (l < t) {
            x = random64 ();
            h =__umul64hi (x, s);
            l = x * s;
        }
    }
    return h;
}
```


What Juffa does is to generate 10,000,000 integers in the interval [0,500,000] from Marsaglia&rsquo;s&nbsp;KISS64 random number generator. On a Quadro P2000 Nvidia card, he shows that using an approach that minimizes the use of divisions is much faster.

OpenBSD-like             |5 ms                     |
-------------------------|-------------------------|
Java-like                |2.9 ms                   |
Our approach             |1.4 ms                   |


[I make Juffra&rsquo;s code available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2018/12/21/randtest.cu).</p>