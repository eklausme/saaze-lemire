---
date: "2013-04-23 12:00:00"
title: "Share your software early: the Reinhart-Rogoff case"
---



I like stories where prestigious professors screw up spectacularly. It reminds us that everybody gets it wrong some of the time. The Reinhart-Rogoff story is one such case.

Two very reputed professors at Harvard University, Carmen Reinhart and Kenneth Rogoff, published online a working paper in 2010 called [Growth in a time of debt](http://www.nber.org/papers/w15639). The paper has since been cited in the scientific literature about 500 times, or about once every two days. They later wrote a [best-seller book on the same topic](https://www.amazon.com/This-Time-Different-Centuries-Financial/dp/0691152640/). They built a web site to promote their ideas where [they shared some of their data](http://www.reinhartandrogoff.com/data/browse-by-topic/topics/9/).

Their research paper is remarkably easy to understand: countries with large debt tend to have lesser economic growth. This claim is entirely credible. On the one hand, countries with poor economies may tend to grow large debts because they have weak revenues. On the other hand, large debts may lead to tight fiscal policies (e.g., high taxes) or lax monetary policies (e.g., printing money) that may reduce economic growth.

The part that is less credible is that Reinhart and Rogoff were able to find a magical threshold (debt-to-GDP ratio of 0.9) that triggered low growth. In effect, they implicitly claimed that any debt-to-GDP ratio in excess of 0.9 would reduce your economic growth. This gave politicians a scientific justification for austerity measures (e.g., raising taxes and cutting back on government services).

The story then becomes interesting. Thomas Herndon, a graduate student, grabbed data from the Reinhart-Rogoff web site and tried to reproduce their results. He couldn&rsquo;t. He then asked the authors for help. Reinhart and Rogoff shared the [Excel spreadsheet they used](http://www.peri.umass.edu/fileadmin/pdf/working_papers/working_papers_301-350/HAP-RR-GITD-code.zip) with Herndon. He then promptly found basic flaws in their data processing. For example, the two professors ran sums over the wrong cells. It seems that they made several odd choices when processing the data. His paper is [freely available online](http://www.peri.umass.edu/236/hash/31e2ff374b6377b2ddec04deaa6388b1/publication/566/).

Things took a turn for the worse when, faced with this opposition, [Reinhart-Rogoff balked and asserted that these errors did not impact their work](https://myaccount.nytimes.com/auth/login?URI=http%3A%2F%2Fkrugman.blogs.nytimes.com%2F2013%2F04%2F16%2Freinhart-rogoff-continued%2F%3F_r%3D5&amp;REFUSE_COOKIE_ERROR=SHOW_ERROR). Thankfully, they did not deny their mistakes.

This whole incident shows the importance of sharing data and software. Reinhart and Rogoff were almost exemplary regarding data in this case: they widely shared their data. Their mistake was in not widely distributing their software (in the form a spreadsheet) earlier. Had the spreadsheet been available from the start, they would be in a much better position. 

Of course, another version of the story could be that, had Reinhart and Rogoff not shared their data and software, they would have plausible deniability and their work could still be credible. But this only means that you, as a reader, should put more trust in work where the data and software are available. 

In any case, by keeping the software private, the best that Reinhart and Rogoff could have hoped for was to delay the inevitable: once your work is the basis for public policy, it is bound to come under intense scrutiny and significant mistakes will be discovered. By sharing your software, you establish your good faith.

There are other minor points that I find interesting in this story:

- All this work is posted online. To my knowledge, no journal has been directly involved.
- Usually, negative results are unpublishable: journals are not interested. It is unclear that the paper by Herndon et al. can be published in a conventional journal even though it is obviously important work. 
- It seems that Reinhart and Rogoff are credited for much of the suffering due to the austerity measures in Europe. This seems entirely ridiculous to me. I think that Reinhart and Rogoff acted in good faith.


__Further reading__: [Influential Reinhart-Rogoff economics paper suffers spreadsheet error](http://retractionwatch.com/2013/04/18/influential-reinhart-rogoff-economics-paper-suffers-database-error/) (via Scott Guthery) and [My take on Reinhart and Rogoff](http://econlog.econlib.org/archives/2013/05/my_take_on_rein.html) by David Henderson.

