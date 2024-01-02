---
date: "2013-01-02 12:00:00"
title: "Are CAPTCHAs a good idea?"
---



A [CAPTCHA](https://en.wikipedia.org/wiki/CAPTCHA) is a small test used to distinguish human users from robots. They are popular as an anti-spam tool.

Until a few months ago, I had an annoying CAPTCHA on this blog. I have since removed it and I will not go back. 

What happened?

1. The long-term problem with CAPTCHAs is that computers are getting so good at passing the Turing tests that we must stretch the cognitive abilities of human beings to distinguish machines from human beings. Thus, we end up requiring users to make greater and greater effort. It is simply unsustainable. It is a race that can only end up as a victory for the spammers.
1. I thought, naively, that I could get around this problem with a home-made CAPTCHA. After all, I am certainly not important enough for spammers to write code specifically to pass my CAPTCHA. Unfortunately, spammers appear to be recruiting human beings. There is a large pool of people on Earth who will gladly get paid just to post spammy comments on minor blogs. Thus, no matter how good you are at distinguishing human beings from bots, you still cannot win with CAPTCHAs.
1. Though not perfect, automated spam detection has gotten quite good. For my blog, I use the free service [Akismet](http://akismet.com/). It can stop most naive attempts to spam bloggers. I also have some fixed rules that will sent a comment directly in the spam box. There is a small fraction of the legitimate comments that I will never get to see, but this is already true with email. I have come to grasp with the fact that messages online sometimes get lost.


So the default on this blog is that comments go to a moderation queue and I have to approve them, one by one. About half of the comments that pass my filters are still spam. If I were hosting a more popular service, I would probably still find a way to prevent abuse without using CAPTCHAs.

__Credit__: Thanks for [John Regehr](http://www.cs.utah.edu/~regehr/) for inspiring this post.

__Update__: [Sathappan Muthu](http://about.me/sathappan) pointed out to me a very cool CAPTCHA service: [http://areyouahuman.com/](http://areyouahuman.com/). 

