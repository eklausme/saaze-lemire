---
date: "2013-04-24 12:00:00"
title: "You probably shouldn´t use a spreadsheet for important work"
---



Following the [Reinhart-Rogoff case](/lemire/blog/2013/04/23/share-your-software-early-the-reinhart-rogoff-case/), where famous scientists go formulas wrong in the Excel spreadsheet that supported their research, a lot of people commented on the adequacy of a spreadsheet tool for important work.

Excel does have one tremendous benefit: it is accessible. Most people using spreadsheets don&rsquo;t even realize that they are programming. In the Reinhart-Rogoff case, this accessibility was a great virtue: it allowed a regular PhD student to verify the computations.

However, there are several critical problems with a tool like Excel that need to be widely known:

- __Spreadsheets do not support testing.__ For anything that matters, you should validate and test your code automatically and systematically.
- __Spreadsheets make code reviews impractical.__ To inspect the code, you need to look at every cell. In practice, this means that you cannot reasonably ask someone to read over your formulas to make sure that there is no mistake.
- __Spreadsheet encourage redundancies.__ Spreadsheets encourage copy-and-paste. Though copying and pasting is sometimes the right tool, it also creates redundancies. These redundancies make it very difficult to update a spreadsheet: are you absolutely sure that you have changed the formula throughout?


Unfortunately, spreadsheet programming is far more common in research than we would like to admit. I keep reviewing research manuscripts where the figures were obviously made with Excel. It is also very widespread in business: decisions worth millions (if not billions) of dollars are taken on the basis of a spreadsheet all the time. 

Professionals should avoid spreadsheets for activities where mistakes matter. Reinhart and Rogoff should have used a bona fide programming language with proper testing, code review and documentation.

__Further reading__: [Lotus Improv](https://en.wikipedia.org/wiki/Lotus_Improv) was an early attempt to build a spreadsheet tool that did not have some of these problems. It was a market failure. (Credit: Preston L. Bannister)

