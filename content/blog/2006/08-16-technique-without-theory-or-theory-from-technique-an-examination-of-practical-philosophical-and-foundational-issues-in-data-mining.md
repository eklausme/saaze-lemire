---
date: "2006-08-16 12:00:00"
title: "Technique without theory or theory from technique? An examination of practical, philosophical, and foundational issues in data mining"
---



Korukonda wrote [a paper](http://link.springer.com/article/10.1007%2Fs00146-006-0064-3) in the Journal of Human-Centred Systems (AI &#038; Society) putting into question the (philosophical) foundation of Data Mining as a science. He puts it quite bluntly:

> the current status of Data Mining as an intellectual discipline is tenuous.


This is of particular interest to me since I consider myself a Data Mining researcher. Unlike Korukonda, however, I consider that Data Mining can be equally user-driven (as in OLAP) or data-driven. I do not think that there is a well established definition of Data Mining, except that we all agree it has to do with analyzing lots of data. The lack of a theoretical foundation for Data Mining is a well known problem which was explicitely identified during IEEE Data Mining 2005 as one of the top 10 challenges facing the community.

Korunda makes some good points. First of all, he reminds us that &ldquo;Knowledge from Data&rdquo; can be misleading. He gives the example of &ldquo;idiot correlation&rdquo; where the wrong hypothesis is tested. He takes an example from the New York Times where a reporter wrote that they noticed a 4.5% increase in sales at Red Lobster in March despite the war in Irak. Why would this be interesting? It is well known that when working over large data sets, you will invariably find surprising relations between different variables, but these relations are not necessarily meaningful. The fact that they are well supported by the historical data is not sufficient to make them useful. Statistically, because the number of possible relations is exponentially large, some of them are always supported by the historical data. A review of the Data Mining literature would prove him right: many researchers design systems to blindly find relationships. This is one reason why I prefer user-driven Data Mining as in OLAP where meaningless relations are automically discarded by the user.

Nevertheless, he correctly points out that even though the process is flawed, it could still be that it is a useful paradigm. When facing large data sets, you can either give up or try <em>something</em>. Data Mining is the best paradigm we have for these types of problems.

Being a nice guy, Korukonda gives us the way out:

> This focus needs to shift to the â€œwhyâ€ questions, if DM is to establish itself as a scientific investigative tool or as a long-term solution to business problems. In other words, the outcome of DM should extend beyond discovery of patterns to finding causal explanations for the observed patterns and relationships.


Meanwhile, he cites Taschek who tells us that Data Mining is dead:

> One reason data mining as a term failed was because data mining products did not work. Sure, the technology theoretically allowed companies to dig through historical data but it never lived up to its promise. (Taschek, eWeek, 2001)


I think that the Taschek quote must refer to data-driven Data Mining, because user-driven Data Mining is doing quite well with a worldwide market of 6 billions$ in software products alone.

Maybe the real question is whether it is sensible to take the human out of the loop. I always think that as long as strong AI escapes us, we have to keep the human in there because that&rsquo;s our only chance for intelligence. Yes, paying an analyst to look at your data is expensive, but you can lower the costs by giving him the best tools money can buy.

