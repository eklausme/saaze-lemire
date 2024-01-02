---
date: "2013-05-17 12:00:00"
title: "A criticism of computer science: models or modèles?"
---



I was recently on a review committee for a PhD proposal. The student was brilliant. His proposal sounded deep and engaging. The methodology looked scientific: build a model, program the software, gather data, compute the metrics. Yet the student&rsquo;s hypothesis could never be realistically be proven false. The project was not conducive to telling us anything about the world. At best, we could learn something about an abstract construction. This is, I fear, all too common in computer science. To make it worse, I believe that most computer scientists are unaware of this methodological failing.

In medicine, medical doctors read scientific papers or, at least, executive summaries of said papers. The papers contribute useful knowledge. However, even the best software practitioners can go years without reading any research, assuming that they ever read any. I believe that it is because they rightly feel that the papers will not teach them much about the real world.

You would probably be upset if you learned that your medical doctor is unaware of the latest clinical research concerning your condition. However, how concerned would a manager at Facebook be if he learned that a software engineer is not up-to-date with computer science research?

The problem comes from the fact that computer scientists rarely work with models or, rather, that they are confused about what a scientific model is.

A model in science is an algorithm that enables you to make meaningful predictions about the real world. In computer science, it might go as follows:

> Software X will be faster than software Y on data Z.


A model can often be falsified. In my computer-science example, you should be able to run X and Y and you check which is faster. Because they make actual predictions about the world, models are tremendously useful. Not all scientific models are cleanly falsifiable. For example, natural evolution is a scientific model. The belief that unit testing makes software more reliable is part of another. However, scientific models are always sustained by real-world observations as opposed to our own mental constructions.

But that is not what computer science offers you typically. Instead, computer scientists tend to make statements that avoid scientific falsifiability:

> According to some cost model that may or may not be indicative of actual running speed, algorithm X is better than algorithm Y on data Z.


Oldberg [proposed](http://wmbriggs.com/blog/?p=7923) to reserve the word model for the genuine scientific models, and to use the French word <em>modèle</em> for the other kind.

You can compare a modèle with reality (what Oldberg calls <em>evaluating</em>), but you can never prove it wrong. A modèle is true as long as it is logically consistent, irrespective of reality.

Computer scientists love their modèles!

The problem is made worse by the fact that researchers working on modèles more easily get the upper hand. They are never wrong. They can endlessly refine their modèles and re-evaluate them. As long as there is no actual problem to be solved, the modèles will tend to displace the models. [Cargo cult science](https://en.wikipedia.org/wiki/Cargo_cult_science) wins.

Of course, the reverse phenomenon may exist within industry. People working with modèles are at a disadvantage. They can&rsquo;t make useful predictions. They can only explain, in retrospect, what is observed. All their sophistication fails to help them when real-world results are what matters.

Continue reading with my post [Should computer scientists run experiments?](/lemire/blog/2013/07/10/should-computer-scientists-run-experiments/) or skip ahead to my post on [Big-O notation and real-world performance](/lemire/blog/2013/07/11/big-o-notation-and-real-world-performance/).

