---
date: "2017-11-21 12:00:00"
title: "Do relational databases evolve toward rigidity?"
---



The [Hanson law of computing](/lemire/blog/2015/07/03/would-an-artificial-intelligence-grow-old/) states that:

> Any software system, including advanced intelligence, is bound to decline over time. It becomes less flexible and more fragile.


[I have argued at length that Hanson is wrong](/lemire/blog/2015/07/03/would-an-artificial-intelligence-grow-old/). My main argument is empirical: we build much of our civilization on old software, including a lot of open-source software.

We often build new software to do new things, but that&rsquo;s on top of older software. Maybe you are looking at your smartphone and you think that you are using software built in the last 4 years. If you think so, you are quite wrong.

So it is not the case that old software becomes obviously less useful or somehow less flexible with time. Yet, to adapt to new conditions, old software often needs &ldquo;rejuvenation&rdquo; which we typically call &ldquo;refactoring&rdquo;. Old database systems like MySQL were designed before JSON and XML even existed. They have since been updated so that they can deal with these data types efficiently.

So old widely used software tends to get updated, refactored, reengineered&hellip;

Viewed at a global scale, software evolves by natural selection. [Old software that cannot adapt tends to die off](/lemire/blog/2016/11/23/software-evolves-by-natural-selection/).

There has been a fair amount of work in [software aging](http://wpage.unina.it/roberto.natella/papers/natella_aging_survey_2013.pdf). However, much of the work is of an interested nature: they want to provide guidance to engineers as to when they should engage into refactoring work (to rejuvenate their software). They are less interested in the less practical problem of determining how software evolves and dies.

Software often relies on database tables. These tables are defined by the attributes that make them up. In theory, we can change these attributes, add new ones, remove old ones. Because open-source software gives us access to these tables, we can see how they evolve. [Vassiliadis and Zarras recently published an interesting empirical paper on this question](https://link.springer.com/article/10.1007/s13740-017-0083-x).

Their core result is that tables with lots of attributes (wide tables) tend to survive a long time unchanged. Thinner tables (with fewer attributes) die young. Why is that? One reason might be that wide tables covering lots of attributes tend to have lots of code depending on it. Thus changing these tables is expensive: it might require a large refactoring effort. Thus these wide tables tend to stick around and they contribute to &ldquo;software rigidity&rdquo;. That is, old software will accumulate these wide tables that are too expensive to change.

I believe that this &ldquo;evolution toward rigidity&rdquo; is real. But it is less of a general feature of software, and more of a particular defect of the relational database model.

This defect, in my view, is as follows. The relational model makes the important recognition that some attributes depend on other attributes (sometimes called &ldquo;functional dependencies&rdquo;). So if you have the employee identifier, you can get his name and his rank. From his rank, you might get his salary. From this useful starting point, we get two problems:

1. Instead of simply treating these dependencies between attributes as first-class citizens, the relational model does away with them, by instead representing them as &ldquo;tables&rdquo; where, somehow, attributes need to be regrouped. So, incredibly, the SQL language has no notion of functional dependency. Instead, it has keys and tables. These are not the same ideas!
Why did functional dependencies get mapped to keys and tables? Simply because this is a natural and convenient way to implement functional dependencies. So we somehow get that &ldquo;employee identifier, name, rank&rdquo; get aggregated together. This arbitrary glue leads to rigidity as more and more attributes get lumped together. You cannot reengineer just one dependency or one attribute, without possibly affecting a lot of code.
1. Functional dependencies are nice, but far more inflexible and limited than it seems at first. For example, some people have more than one name. People change name, actually quite often. Some information might be unknown, uncertain. To cope with uncertain or unknown data, the inventor of the relational model added &ldquo;null&rdquo; markers to his model, and some kind of three-value logic that is [not even consistent](/lemire/blog/2013/03/05/do-null-markers-in-sql-cause-harm/). [In a recent paper with Badia, I showed that it is not even possible, in principle, to extend functional dependencies to a open-world model](https://lemire.me/en/publication/arxiv1703.08198/) (e.g., as represented by disjunctive tables).


So I would say that relational databases tend to favor rigidity over time.

There are some counterpoints that may contribute to explain why the sky is not falling despite this very real problem:

- Programmers have a pragmatic approach. In practice, people have never really taken the relational model to its word: SQL is not a faithful implementation of the relational model. Ultimately, you can use a relational database as a simple key-value store. Nobody is forcing you to adopt wide tables. So there is more flexibility than it appears.
- There are many other instances of rigidity. [Constitutions change incrementally](http://www.nature.com/news/what-countries-constitutions-reveal-about-how-societies-evolve-1.23001) because it is too hard to negotiate large changes. Biology is based on DNA and it is unlikely to change anytime soon. Mathematics is based on standard axioms, and we are not likely to revisit them anytime soon. So it is not surprising that we end up locked into patterns. And it is not necessarily dramatic. (But we should not underestimate the cost: mammals have lungs that are far less efficient than the lungs of birds. Yet there is no obvious way for mammals to evolve a different lung architecture.)
- We have limited the rigidity when we stopped relying universally on SQL as the standard interface to access data. In the web era, we create services that we typically access via HTTP requests. So the rigidity does not have to propagate to the whole of a large organization.


__Credit__: Thanks to Antonio Badia and Peter Turney for providing me with references and insights for this post.

