---
date: "2011-01-11 12:00:00"
title: "Demarchy and probabilistic algorithms"
---



<a href="https://www.amazon.com/dp/0521835402"><img decoding="async" style="margin: 5px; float: right; width: 33%;" src="https://www.eecs.harvard.edu/~michaelm/cover.jpg" alt /></a><br/>
[Demarchy](https://en.wikipedia.org/wiki/Demarchy) are political systems built using randomness. Demarchy has been used to designate political leaders in Ancient Greece and in France (during the French revolution). In many countries, jury selection is random. On [Slashdot](http://slashdot.org/), the comment moderation system relies on randomly selected members: as you use the system, you increase your (digital) karma which increases the probability that you will become a moderator. Demarchy has been depicted by several science-fiction authors including <a title="Arthur C. Clarke" href="https://en.wikipedia.org/wiki/Arthur_C._Clarke">Arthur C. Clarke</a>, <a title="Kim Stanley Robinson" href="https://en.wikipedia.org/wiki/Kim_Stanley_Robinson">Kim Stanley Robinson</a>, <a title="Ken MacLeod" href="https://en.wikipedia.org/wiki/Ken_MacLeod">Ken MacLeod</a> and <a title="Alastair Reynolds" href="https://en.wikipedia.org/wiki/Alastair_Reynolds">Alastair Reynolds</a>.

__Democracy is deterministic__: we send the representative with the most votes. __Demarchy  is probabilistic__: we need a source of random numbers to operate it. Unfortunately, probabilities are less intuitive than simple statistical measures like the most frequent item. It is also much more difficult to implement demarchy, at least without a computer. Meanwhile, most software uses probabilistic algorithms:

- Databases use hash tables to recover values in expected constant time;
- Cryptography is almost entirely about probabilities;
- Most of Machine Learning is based on probabilistic models.


In fact, __probabilistic algorithms work better than deterministic algorithms. __

Some common objections to demarchy:

- <em>Not everyone is equally qualified to run a country or a city.</em> __My counter-argument:__ Demarchy does not imply that everyone has an equal chance of being among the leaders. Just like in a jury selection, some people are disqualified. Moreover, just like Slashdot, there is no reason to believe that everyone would get an equal chance. Active participants in the political life might receive higher &ldquo;digital karma&rdquo;. Of course, from time to time, incompetent leaders would be selected, by random chance. But we also get incompetent leaders in our democratic system.
- <em>There is too much to learn: the average Joe would be unable to cope. </em>__My counter-argument: __Demarchy does not imply that a dictator for life is nominated, or that the leaders can make up all the rules. In the justice system, jury selection covers a short period of time and scope (one case), is closely supervised by an arbitrator (the judge), and typically involves several nominates (a dozen in Canada). And if qualifications are what matters, then why don&rsquo;t we elect leaders based on their objective results to some tests? The truth is that many great leaders did not do so well on tests. Most notably, [Churchill](https://en.wikipedia.org/wiki/Churchill) was terrible at Mathematics. Moreover, experts such as professional politicians are often overrated:  [it has been claimed that picking stock at random is better than hiring an expert](http://arachnoid.com/stocks/).
- <em>Demarchy nominates would be less moral than democratically elected leaders.</em> __My counter-argument:__ I think the opposite would happen. Democratic leaders often feel entitled to their special status. After all, they worked hard for it. Studies show that white collar criminals are not less moral than the rest of us, they just think that the rules don&rsquo;t apply to them because they are special. Politics often attract highly ambitious (and highly entitled) people. Meanwhile, demarchy leaders would be under no illusion as to their status. Most people would see the nomination as a duty to fulfill. It is much easier for lobbyist to target professional politicians than short-lived demarchy nominates.


__Further reading__: [Brian Martin&rsquo;s writings on demarchy and democracy](http://www.uow.edu.au/~bmartin/pubs/demarchy.html) and [How to choose?](https://aeon.co/essays/if-you-can-t-choose-wisely-choose-randomly) by Michael Schulson.

