---
date: "2017-08-15 12:00:00"
title: "On Melissa O´Neill´s PCG random number generator"
---



Computers often need random numbers. Most times, random numbers are not actually random&hellip; in the sense that they are the output of a mathematical function that is purely deterministic. And it is not even entirely clear what &ldquo;really random&rdquo; would mean. It is not clear that we live in a randomized universe&hellip; it seems more likely that our universe is deterministic but that our limited access to information makes randomness a useful concept. Still, very smart people have spent a lot of time defining what random means, and it turns out that mathematical functions can be said to produce &ldquo;random&rdquo; outputs in a reasonable sense.

In any case, many programmers have now adopted a new random number generator called PCG and designed by [professor Melissa O&rsquo;Neill from Harvey Mudd college](https://www.cs.hmc.edu/~oneill/index.html).
What O&rsquo;Neill did is quite reasonable. She asked herself whether we could produce better random number generators, she wrote a paper and published code. The result was quickly adopted by engineers worldwide.

She also submitted her paper for consideration in what I expect to be a good, well-managed journal.

Her manuscript became lengthy in time and maybe exceeded some people&rsquo;s style sensibilities, [she justifies herself in this manner](http://www.pcg-random.org/posts/history-of-the-pcg-paper.html):

>I prefer to write papers that are broadly accessible. I&rsquo;d rather write a paper that can be enjoyed by people who are interested in the topic than one that can only be understood by a tiny number of experts. I don&rsquo;t agree with the philosophy that the more impenetrable the paper, the better the work must be! Describing desirable qualities in detail seemed to be necessary for the paper to make sense to anyone not deeply entrenched in the field. Doing so also seemed necessary for anyone in the field who only cared about a subset of the qualities I considered desirableâ€”I would need to convince them that the qualities they usually didn&rsquo;t care about were actually valuable too.



As I pointed out, she had a real-world impact:

>While attending PLDI and TRANSACT in June of 2015, I got one of the first clues that my work had had real impact. I can&rsquo;t remember the talk or the paper, but someone was saying how their results had been much improved from prior work by switching to a new, better, random number generator. At the end I asked which one. It was PCG.



Meanwhile, at least one influential researcher (whose work I respect) had [harsh words publicly for her result](https://v8project.blogspot.ca/2015/12/theres-mathrandom-and-then-theres.html?showComment=1452592903162#c1549004517443909784):
>I&rsquo;d be extremely careful before taking from granted any claim made about PCG generators. Wait at least until the paper is published, if it ever happens. (&hellip;) Several claims on the PCG site are false, or weasel words (&hellip;) You should also be precise about which generator you have in mindâ€”the PCG general definition covers basically any generator ever conceived. (&hellip;) Note that (smartly enough) the PCG author avoids carefully to compare with xorshift128+ or xorshift1024*.



Her paper was not accepted. She put it in those terms:

> What was more interesting were the ways in which the journal reviewing differed from the paper&rsquo;s Internet reception. Some reviewers found my style of exposition enjoyable, but others found it too leisurely and inappropriately relaxed. (&hellip;) An additional difference from the Internet reaction was that some of the TOMS reviewers felt that what I&rsquo;d done just wasn&rsquo;t very mathematically sophisticated and was thus trivial/uninteresting. (&hellip;) Finally, few Internet readers had complained that the paper was too long but, as I mentioned earlier, the length of the paper was a theme throughout all the reviewing. (&hellip;) Regarding that latter point, I am, on reflection, unrepentant. I wanted to write something that was broadly accessible, and based on other feedback I succeeded.


I emailed O&rsquo;Neill questions a couple of times, but she never got back to me.
So we end up with this reasonably popular random number generator, based on a paper that [you can find online](http://www.pcg-random.org/pdf/hmc-cs-2014-0905.pdf). As far as I can tell, the work has not been described and reviewed in a standard peer-reviewed manner. Note that though she is the inventor, nothing precludes us to study her work and write papers about it.
[John D. Cook has been doing some work in this direction on his blog](https://www.johndcook.com/blog/2017/08/14/testing-rngs-with-practrand/), but I think that if we believe in the importance of formal scientific publications, then we ought to cover PCG in such publications, if only to say why it is not worth consideration.

What is at stake here is whether we care for formal scientific publications. I suspect that Cook and O&rsquo;Neill openly do not care. The reason you would care, fifty years ago, is that without the formal publication, you would have a hard time distributing your work. That incentive is gone. As O&rsquo;Neill points out, her work is receiving citations, and she has significant real-world impact.

At least in software, there has long been a relatively close relationship between engineering and academic publications. These do not live in entirely separate worlds. I do not have a good sense as to whether they are moving apart. I think that they might be. Aside from hot topics like deep learning, I wonder whether the academic publications are growing ever less relevant to practice.

__Further reading__: You might also enjoy my post [Testing non-cryptographic random number generators: my results](/lemire/blog/2017/08/22/testing-non-cryptographic-random-number-generators-my-results/).

