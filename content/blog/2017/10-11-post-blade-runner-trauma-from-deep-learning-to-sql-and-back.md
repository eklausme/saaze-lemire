---
date: "2017-10-11 12:00:00"
title: "Post-Blade-Runner trauma: From Deep Learning to SQL and back"
---



Just after posting my review of the movie [Blade Runner 2049](/lemire/blog/2017/10/09/on-blade-runner-2049/), I went to attend the Montreal Deep Learning summit. Deep Learning is this &ldquo;new&rdquo; artificial-intelligence paradigm that has taken the software industry by storm. Everything, image recognition, voice recognition, and even translation, has been improved by deep learning. Folks who were working on these problems have often been displaced by deep learning.

There has been a lot of &ldquo;bull shit&rdquo; in artificial intelligence, things that were supposed to help but did not really help. Deep learning does work, at least when it is applicable. It can read labels on pictures. It can identify a cat in a picture. Some of the time, at least.

How do we know it works for real? It works for real because we can try it out every day. For example, Microsoft has a free app for iPhones called &ldquo;Seeing AI&rdquo; that lets you take arbitrary pictures. It can tell you what is on the picture with remarkable accuracy. You can also go to [deepl.com](https://www.deepl.com) and get great translations, presumably based on deep-learning techniques. The standard advice I provide is not to trust the academic work. It is too easy to publish remarkable results that do not hold up in practice. However, when Apple, Google and Facebook start to put a technique in their products, you know that there is something of a good idea&hellip; because engineers who expose users to broken techniques get instant feedback.

Besides lots of wealthy corporations, the event featured talks by three highly regarded professors in the field: Yoshua Bengio (Université de Montréal), Geoffrey Hinton (University of Toronto) and Yann LeCun (New York University). Some described it as a historical event to see these three in Montreal, the city that saw some of the first contemporary work on deep learning. Yes, deep learning has Canadian roots.

For some context, here is what I wrote in my Blade Runner 2049 review:

>Losing data can be tragic, akin to losing a part of yourself.



Data matters a lot. A key feature that makes deep learning work in 2017 is that we have lots of labeled data with the computers to process this data at an affordable cost.

Yoshua Bengio spoke first. Then, as I was listening to Yoshua Bengio, I randomly went to my blog&hellip; only to discover that the blog was gone! No more data.

My blog engine (wordpress) makes it difficult to find out what happened. It complained about not being able to connect to the database which sent me on a wild hunt to find out why it could not connect. Turns out that the database access was fine. Why was my blog dead?

I carried with me to the event my smartphone and an iPad. A tablet with a pen is a much better supporting tool when attending a talk. Holding a laptop on your lap is awkward.

Next, Geoffrey Hinton gave a superb talk, though I am sure non-academics will think less of him than I do. He presented recent, hands-on results. Though LeCun, Bengio and Hinton supposedly agree on most things, I felt that Hinton presented things differently. He is clearly not very happy about deep learning as it stands. One gets the impression that he feels that whatever they have &ldquo;works&rdquo;, but it is not because it &ldquo;works&rdquo; that it is the right approach.

Did I mention that Hinton predicted that computers would have common-sense reasoning within 5 years? He did not mention this prediction at the event I was at, though he did hint that major breakthroughs in artificial intelligence could happen as early as next week. He is an optimistic fellow.

Well. The smartest students are flocking to deep learning labs if only because that is where the money is. So people like Hinton can throw graduate students at problems faster than I can write blog posts.

What is the problem with deep learning? For the most part, it is a brute force approach. Throw in lots of data, lots of parameters, lots of engineering and lots of CPU cycles, and out comes good results. But don&rsquo;t even ask why it works. That is not clear.

&ldquo;It is supervised gradient descent.&rdquo; Right. So is Newton&rsquo;s method.

I once gave a talk about the [Slope One algorithm](https://arxiv.org/abs/cs/0702144) at the University of Montreal. It is an algorithm that I designed and that has been widely used in e-commerce systems. In that paper, we set forth the following requirements:

- easy to implement and maintain: all aggregated data should be easily interpreted by the average engineer and algorithms should be easy to implement and test;
- updateable on the fly;
- efficient at query time: queries should be fast.


I don&rsquo;t know if Bengio was present when I gave this talk, but it was not well received. Every point of motivation I put forward contradicts deep learning.

It sure seems that I am on the losing side of history on this one, if you are an artificial intelligence person. But I do not do artificial intelligence, I do data engineering. I am the janitor that gets you the data you need at the right time. If I do my job right, artificial intelligence folks won&rsquo;t even know I exist. But you should not make the mistake of thinking that data engineering does not matter. That would be about as bad as assuming that there is no plumbing in your building.

Back to deep learning. In practical terms, even if you throw deep learning behind your voice assistant (e.g., Siri), it will still not be able to &ldquo;understand&rdquo; you. It may be able to answer correctly to common queries, but anything that is unique will throw it off entirely. And your self-driving car? It relies on very precise maps, and it is likely to get confused at anything &ldquo;unique&rdquo;.

There is an implicit assumption in the field that deep learning has finally captured how the brain works. But that does not seem to be quite right. I submit to you that no matter how &ldquo;deep&rdquo; your deep learning gets, you will not pass the Turing test.

The way the leading deep-learning researchers describe it is by saying that they have not achieved &ldquo;common sense&rdquo;. Common sense can be described as the ability to interpolate or predict from what you know.

How close is deep learning to common sense? I don&rsquo;t think we know, but I think Hinton believes that common sense might require quite different ideas.

I pulled out my iPad, and I realized after several precious minutes that the database had been wiped clean. I am unsure what happened&hellip; maybe a faulty piece of code?

Because I am old, I have seen these things happen before: I destroyed the original files of my Ph.D. thesis despite having several backup copies. So I have multiple independent backups of my blog data. I had never needed this backup data before now.

Meanwhile, I heard Yoshua Bengio tell us that there is no question now that we are going to reach human-level intelligence, as a segue into his social concerns regarding how artificial intelligence could end up in the wrong hands. In the &ldquo;we are going to reach human-level intelligence&rdquo;, I heard the clear indication that he included himself has a researcher. That he means to say that we are within striking distance of having software that can match human beings at most tasks.

Because it is 2017, I was always watching my twitter feed and noticed that someone I follow had tweeted about one of the talks, so I knew he was around. I tweeted him back, suggesting we meet. He tweeted me back, suggesting we meet for drinks upstairs. I replied back that I was doing surgery on a web application using an iPad.

It was the end of the day by now, everyone was gone. Well. The Quebec finance minister was giving a talk, telling us about how his government was acutely aware of the importance of artificial intelligence. He was telling us about how they mean to use artificial intelligence to help fight tax fraud.

Anyhow, I copied a blog backup file up to the blog server. I googled the right command to load up a backup file into my database. I was a bit nervous at this point. Sweating it as they say.

You see, even though I taught database courses for years, and wrote research papers about it, even designed my own engines, I still have to look up most commands whenever I actually work on a database&hellip; because I just so rarely need to do it. Database engines in 2017 are like gasoline engines&hellip; we know that they are there, but rarely have to interact directly with them.

The minister finished his talk. Lots of investment coming. I cannot help thinking about how billions have already been invested in deep learning worldwide. Honestly, at this point, throwing more money in the pot won&rsquo;t help.

After a painful minute, the command I had entered returned. I loaded up my blog and there it was. Though as I paid more attention, I noticed that last entry, my [Blade Running 2049](/lemire/blog/2017/10/09/on-blade-runner-2049/) post, was gone. This makes sense because my backups are on a daily basis, so my database was probably wiped out before my script could grab a copy.

What do you do when the data is gone?

Ah. Google creates a copy of my post to serve them to you faster. So I went to Twitter, looked up the tweet where I shared my post, followed the link and, sure enough, Google served me the cached copy. I grabbed the text, copied it over and recreated the post manually.

My whole system is somewhat fragile. Securing a blog and doing backups ought to be a full-time occupation. But I am doing ok so far.

So I go meet up my friend for drinks, relaxed. I snap a picture or two of the Montreal landscape while I am at it. Did I mention that I grabbed the pictures on my phone and I immediately shared them with my wife, who is an hour away? It is all instantaneous, you know.

He suggests that I could use artificial intelligence in my own work, you know, to optimize software performance.
I answer with some skepticism. The problems we face with data engineering are often architectural problems. That is, it is not the case that we have millions of labeled instances from which to learn from. And, often, the challenge is to come up with a whole new category, a whole new concept, a whole new architecture.

As I walk back home, I listen to a podcast where people discuss the manner in which artificial intelligence can exhibit creativity. The case is clear that there is nothing magical in human creativity. Computers can write poems, songs. One day, maybe next week, they will do data engineering better than us. By then, I will be attending research talks prepared by software agents.

As I get close to home, my wife texts me. &ldquo;Where are you?&rdquo; I text her. She says that she is 50 meters away. I see in the distance, it is kind of dark, a lady with a dog. It is my wife with her smartphone. No word was spoken, but we walk back home together.

