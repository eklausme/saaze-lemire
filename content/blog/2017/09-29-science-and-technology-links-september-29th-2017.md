---
date: "2017-09-29 12:00:00"
title: "Science and Technology links (September 29th, 2017)"
---



[Elon Musk presented his plans for space exploration](https://m.youtube.com/watch?feature=youtu.be&amp;v=E4FY894HyF8). It is pretty close to science fiction (right out of Star Trek) with the exception that Musk has a track record of getting things done (e.g., Tesla).

[In the US, women are doing much better in college than men](http://www.aei.org/publication/women-earned-majority-of-doctoral-degrees-in-2016-for-8th-straight-year-and-outnumber-men-in-grad-school-135-to-100/):

> Women earned majority of doctoral degrees in 2016 for 8th straight year and outnumber men in grad school 135 to 100.


[Things are even more uneven in the Middle East](https://www.theatlantic.com/education/archive/2017/09/boys-are-not-defective/540204/):

> At the University of Jordan, the country&rsquo;s largest university, women outnumber men by a ratio of two to oneâ€”and earn higher grades in math, engineering, computer-information systems, and a range of other subjects.


[Things are pretty grim on the education front in my home town](http://www.cbc.ca/news/business/dismal-dropout-rates-among-french-speaking-students-worry-minister-1.2771757):

> Last year alone, only 40.6 percent of the boys (&hellip;) at the French-language Commission scolaire de Montréal graduated in five years.


Our local (Montreal) deep-learning star, Yoshia Bengio, [called for the breakup or regulation of tech leaders](https://www.axios.com/artificial-intelligence-pioneer-calls-for-the-breakup-of-big-tech-2487483705.html):

> We need to create a more level playing field for people and companies, (&hellip;) AI is a technology that naturally lends itself to a winner take all, the country and company that dominates the technology will gain more power with time. More data and a larger customer base give you an advantage that is hard to dislodge. Scientists want to go to the best places. The company with the best research labs will attract the best talent. It becomes a concentration of wealth and power.


Somewhat ironically, Bengio has created a successful start-up called [Element AI](https://www.elementai.com) in Montreal that is very generously funded.

There is a widely held view that &ldquo;peer-reviewed research&rdquo;, the kind that appears in scientific journals, can be trusted. Should you make serious decisions on the assumption that research is correct? You should not. For anything that matters, [you should recheck everything](http://www.openphilanthropy.org/blog/reasonable-doubt-new-look-whether-prison-growth-cuts-crime):

> Empirical social science researchâ€”or at least non-experimental social science researchâ€”should not be taken at face value. Among three dozen studies I reviewed, I obtained or reconstructed the data and code for eight. Replication and reanalysis revealed significant methodological concerns in seven and led to major reinterpretations of four. These studies endured much tougher scrutiny from me than they did from peer reviewers in order to make it into academic journals. Yet given the stakes in lives and dollars, the added scrutiny was worth it. So from the point of view of decision-makers who rely on academic research, today&rsquo;s peer review processes fall well short of the optimal.


What people fail to appreciate, even people who should know better is that peer review mostly involves reading (sometimes quickly) what an author has written on a topic. It is enough to, sometimes, catch the most obvious errors. However, there is no way that I, as a referee, can catch methodological errors deep down in the data processing. And even if I could verify the results, I cannot very well fight against people who are not being entirely honest.

Processor speeds increase over time. Though it is true that the likes of Intel have had trouble easily milking more performance out of new engineering processes, there are regular gains. Certainly, Apple has had no trouble making iPhones faster, year after year. But what about memory? Memory is also getting faster. The new DDR4 standard memory can be about 50% faster than the previous standard DDR3. That&rsquo;s pretty good. However, this gain is misleading because it only factors in &ldquo;throughput&rdquo; (how fast you can read data). It is true that planes are much faster than cars, but it takes a long time to get on the plane, and planes don&rsquo;t necessarily land or takeoff every minute. So planes are fast, but they have a high latency. [Memory is getting faster, but latency is a constant](http://www.crucial.com/usa/en/memory-performance-speed-latency):

> At this point in the discussion, we need to note that when we say true latencies are remaining roughly the same, we mean that from DDR3-1333 to DDR4-2666 (the span of modern memory), true latencies started at 13.5ns and returned to 13.5ns. While there are several instances in this range where true latencies increased, the gains have been by fractions of a nanosecond. In this same span, speeds have increased by over 1,300 MT/s, effectively offsetting any trace latency gains.


This means that though we can move a lot of data around, the minimal delay between the time when you request the data, and the time you get the data, is remaining the same. You can request more data than before, but if your software does not plan ahead, it will still remain stuck, idle.

[The version 9 of the Java language has just been released](https://docs.oracle.com/javase/9/whatsnew/toc.htm#JSNEW-GUID-825576B5-203C-4C8D-85E5-FFDA4CA0B346). There has apparently been a lot of engineering done, but I see little in the way of new features I care about. However, I can happily report that they have deprecated the applet API. This means that by the next release we might finally get rid of Java applets. Meanwhile, my employer still requires me to manage my budget and place orders using a Java applet reliant on some Oracle technology. I find it encouraging to learn that even Oracle admits that Java applets are a thing of the past, better left in the past. (Disclosure: for a time, I paid my bills designing Java applets for medical imaging! It was super fun!)

