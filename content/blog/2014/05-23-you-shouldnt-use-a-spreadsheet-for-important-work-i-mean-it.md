---
date: "2014-05-23 12:00:00"
title: "You shouldn´t use a spreadsheet for important work (I mean it)"
---



I envy economists. Unlike computer scientists, they seem to be able to publish best-seller books with innovative research. One such book is [Piketty&rsquo;s Capital](https://www.amazon.com/Capital-Twenty-First-Century-Thomas-Piketty/dp/067443000X). The book is reminiscent of Marx&rsquo;s capital in its scope. If you haven&rsquo;t heard about the book yet, it has a simple message: the yield on capital is higher than wage growth which means that those with the capital are bound to get richer and more powerful. The bulk of the population is doomed. A small elite will soon collect all the wealth, leaving none for the regular folks. This observation is hardly original&hellip; the idea of [wealth concentration](https://en.wikipedia.org/wiki/Wealth_condensation) has even a catch phrase: [The rich get richer and the poor get poorer](https://en.wikipedia.org/wiki/The_rich_get_richer_and_the_poor_get_poorer).

Anyone could make similar claims. But it is not easy to prove it, and some economists even found evidence to the contrary ([Kopczuk and Schrager](http://www.foreignaffairs.com/articles/141431/wojciech-kopczuk-and-allison-schrager/the-inequality-illusion)): a big inheritance is less likely to land you in the list of the richest people today than in 1970 (see [Edlund and Kopczuk](http://www.nber.org/papers/w13162), [Kopczuk et al.](http://qje.oxfordjournals.org/content/125/1/91.abstract), and [Kopczuk and Saez](http://www.nber.org/papers/w10399) for further research in this direction).

What is remarkable regarding Piketty&rsquo;s work, is that he backed his work with comprehensive data and thorough analysis. Unfortunately, like too many people, Piketty used speadsheets instead of writing sane software. On the plus side, he published his code&hellip; on the negative side, it appears that Piketty&rsquo;s code contains mistakes, fudging and other problems.

> In his spreadsheets, however, there are transcription errors from the original sources and incorrect formulas. (&hellip;), once the FT cleaned up and simplified the data, the European numbers do not show any tendency towards rising wealth inequality after 1970. An independent specialist in measuring inequality shared the FT&rsquo;s concerns. ([Financial Times](https://www.ft.com/cms/s/2/e1f343ca-e281-11e3-89fd-00144feabdc0.html#ixzz32p4JiZA2), May 23rd 2014)


> The economics profession has been considerably more forgiving than the FT of the constructed data in Prof Piketty&rsquo;s datasets. These include the entire 90-year period between 1870 and 1960 when there is no source material for the top 10 per cent wealth share in the US. For those years Prof Piketty simply adds 36 percentage points to his estimate of the top 1 per cent wealth share. (&hellip;) For France, a similar point is worth noting. Prof Piketty cites his 2006 paper in the American Economic Review as the original source of the French numbers. Footnote 32 of that paper raises doubts about the ability to come up with plausible 20th century numbers for wealth concentration in France. It says: &ldquo;The only wealth-of-the-living concentration estimates we provide for the twentieth century are national estimates for 1947 and 1994.&rdquo; There is no documentation in his book on how he overcomes the problem that stumped him and fellow researchers in the 2006 paper. ([Financial Times](http://blogs.ft.com/money-supply/2014/05/28/follow-up-on-data-problems-in-capital-in-the-21st-century/), May 28th 2014)


> What we therefore seem to have (&hellip;) is less a synthesis of other data sets, or even an update of their numbers using newer data, than a sloppy muddying of the water around them (&hellip;) then the projection of artificial trend lines upon them under the guise of â€œsmoothingâ€ and recalibration. (&hellip;) [the] product was put into print by a major academic press despite serious issues with the rigor of its analysis. ([Magness](http://philmagness.com/?p=809))


I am not surprised. Last year, I reviewed the [Reinhart-Rogoff case](/lemire/blog/2013/04/23/share-your-software-early-the-reinhart-rogoff-case/). Two famous economists had concluded that high debt led to slow economic growth based on an extensive statistical analysis of historical data. Unfortunately, they also used a [spreadsheet](/lemire/blog/2013/04/24/you-probably-shouldnt-use-a-spreadsheet-for-important-work/).

Simply put, spreadsheets are good for quick and dirty work, but they are not designed for serious and reliable work.

- All professional software should contain extensive tests&hellip; how do you know that your functions do what you think they do if you do not test them? Yet spreadsheets do not allow testing.
- Spreadsheets make code review difficult. The code is hidden away in dozens if not hundreds of little cells&hellip; If you are not reviewing your code carefully&hellip; and if you make it difficult for others to review it, how do expect it to be reliable?
- Spreadsheets encourage copy-and-paste programming and ad hoc fudging. It is much harder to review, test and maintain such code.


I will happily use a spreadsheet to estimate the grades of my students, my retirement savings, or how much tax I paid last year&hellip; but I will not use Microsoft Excel to run a bank or to compute the trajectory of the space shuttle. Spreadsheets are convenient but error prone. They are at their best when errors are of little consequence or when problems are simple. It looks to me like Piketty was doing complicated work and he betting his career on the accuracy of his results.

Like [Reinhart and Rogoff](http://blogs.ft.com/money-supply/2014/05/23/piketty-response-to-ft-data-concerns/), Piketty does not deny that there are problems, but (like Reinhart and Rogoff) he claims that his mistakes are probably inconsequential&hellip;

In his first answer to his critics, Piketty puts the burden of proof on them: &ldquo;Of course, if the Financial Times produces statistics and wealth rankings showing the opposite, I would be very interested to see these statistics, and I would be happy to change my conclusion!&rdquo;

He is missing the point. It is not enough to get the right answer&hellip; Would you be happy to fly in a plane run by buggy software&hellip; given that the programmer insists that the bugs are probably inconsequential? Sure, the plane might land safety&hellip; but how much is due to luck?

He is also missing the point when he insists on the fact that he did publish his code. Yes, it does indicate that his analysis was probably done in good faith&hellip; but, no, it does not tell us that it is correct.

We all make mistakes. When you ship software, be it a spreadsheet or an app, it will contain bugs of some sort&hellip; You cannot help it. But you can certainly do a lot of work to prevent, catch and limit bugs. I program every day. At least half the time I spend programming has to do with bug hunting. How much effort did Piketty, or Reinhart and Rogoff, put on checking the accuracy of their analysis? The fact that they use spreadsheets suggests that they spend very little time worrying about accuracy. Sure, a good enough surgeon can probably take out a tumor with a kitchen knife while wearing a tuxedo&hellip; but how much confidence do you have that the job will be done right? If you are going to write a 600-page book based on data crunching, you probably ought to spend months reviewing, testing and documenting your analysis.

It will be interesting to see how it impacts Piketty. I heard a dozen different economists last week state that he was bound to get a Nobel prize&hellip; will he now get the Nobel prize? I suppose that the answer depends on how flawed his analysis is&hellip; and how important the quality of the analysis is to his peers.

It is said that Piketty used an enormous amount of data, for an economist. I think that economists will have to cope with very complex and abundant data. They will need to do ever more complicated analysis. I hope that they will learn to use better tools and techniques.

__Further reading__:

- [Piketty&rsquo;s Data Is Full of Errors](http://www.slate.com/blogs/moneybox/2014/05/23/financial_times_on_piketty_his_data_is_wrong.html) (Slate)
- [Did Piketty Get His Math Wrong?](http://www.nytimes.com/2014/05/24/upshot/did-piketty-get-his-math-wrong.html?_r=0) (New York Times)
- [Thomas Piketty&rsquo;s Inequality Data Contains &lsquo;Unexplained&rsquo; Errors](http://www.huffingtonpost.com/2014/05/23/piketty-data-flaw_n_5380947.html) (Huffington Post)
- [Are there major mistakes in the bombshell economics book of the year?](http://qz.com/213081/are-there-major-mistakes-in-the-bombshell-economics-book-of-the-year/) (Quarz)


__Update__: Richard Tol is another economist who [was recently caught doing careless data analysis](http://andrewgelman.com/2014/05/27/whole-fleet-gremlins-looking-carefully-richard-tols-twice-corrected-paper-economic-effects-climate-change/). He also used Excel.

__Update 2__: I do not know how common it is for economists to use Excel. It might not be so common. Sergio Salgado, an economist, wrote that &ldquo;any serious statistical analysis is done either in STATA, SAS, or even R or FORTRAN. Nobody uses Excel.&rdquo; Representatives from the SAS corporation, who sell statistical software, pointed out to me that they offer [free training to academics](http://www.sas.com/en_us/offers/14q1/122983-sas-analytics-u/overview.html).

__Update 3__: An anonymous reader sent me this email:

> I work in a large company and I can&rsquo;t help but notice the way the business team uses excel for everything. There are times were emergency meetings are pulled because the numbers don&rsquo;t add up. Sometimes the issue is a single cell among 60,000 containing a typo in the formula (a dollar sign missing).


