---
date: "2006-08-29 12:00:00"
title: "Scam Spam, the death of email, and Machine Learning"
---



Tim Bray has [predicted the end of email](http://www.tbray.org/ongoing/When/200x/2006/08/28/Stock-Spam) as we know it:

> I don&rsquo;t know about you, but in recent weeks I&rsquo;ve been hit with high volumes of spam promoting penny stocks. They are elaborately crafted and go through my spam defenses like a hot knife through butter. (&hellip;) This could be the straw that finally breaks the back of email as we know it, the kind that costs nothing to send and something to receive.


Yes, Tim, I&rsquo;ve been bombed by spam mail too. To the point that the fraction of non-spam email has gone below 10% for the first time in years. Before you think I&rsquo;m an extreme case, ask your local IT experts about the amount of spam they are receiving. __Currently, no spam filter can cope with the amount of spam I&rsquo;m receiving.__

The only spam filter that does anything to help is Google Mail&rsquo;s spam filter, but it still let more spam through than legit emails (if I exclude mailing lists).

What is really failing us here is not the Internet per se: it is rather trivial to think of a better way to design email protocols. What is failing us is the __blunt application of [Machine Learning](https://en.wikipedia.org/wiki/Machine_learning) to a real-world problem__.

Many [Machine Learning](https://en.wikipedia.org/wiki/Machine_learning) researchers would have you believe, mostly because they really believe it, that Bayes or [Neural Networks](https://en.wikipedia.org/wiki/Neural_networks) (add your favorite algorithm here) are ideally suited to solve most classification problems. That they can be tweaked to a particular problem. That in some small way, we have [strong AI](https://en.wikipedia.org/wiki/Strong_AI) at our door. But we don&rsquo;t. The failure of spam filters is symbolic. There is really [no free lunch](https://en.wikipedia.org/wiki/No-free-lunch_theorem) as far as algorithms go.

This is not to say that Machine Learning does not work. Recommender systems like those based on [collaborative filtering](https://en.wikipedia.org/wiki/Collaborative_Filtering) or [PageRank](https://en.wikipedia.org/wiki/Pagerank) work. But in the real world, the best they can do is assist us. And how fancy your algorithm is does not change the equation.

The lesson here is that until we have strong AI, and this could be a long way still, if ever, we should collectively work on finding algorithms that can assist us better instead of trying to replace us.

For example, spam filters should work with the user on defining what is spam. And I don&rsquo;t mean having the user train the algorithm. I mean that the user should be allowed to change and add to the spam filter. Naturally, in practice, this is hard work, very hard work, and thus, it might be simpler and better to replace the email protocols.

We have to move away from black box algorithms and embrace the fact that we lack strong AI. The intelligence is in your users, not in your software.

