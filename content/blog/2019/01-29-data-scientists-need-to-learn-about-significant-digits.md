---
date: "2019-01-29 12:00:00"
title: "Data scientists need to learn about significant digits"
---



Suppose that you classify people on income or gender. Your boss asks you about the precision of your model. Which answer do you give? Whatever your software tells you (e.g., 87.14234%) or a number made of a small and fixed number of significant digits (e.g., 87%).

The latter is the right answer in almost all instances. And the difference matters:

1. There is a general principle at play when communicating with human beings: you should give just the relevant information, nothing more. Most human beings are happy with a 1% error margin. There are, of course, exceptions. High-energy physicists might need the mass of a particle down to 6 significant digits. However, if you are doing data science or statistics, it is highly unlikely that people will care for more than two significant digits.
1. Overly precise numbers are often misleading because your actual accuracy is much lower. Yes, you have 10,000 samples and properly classified 5,124 of them so your mathematical precision is 0.5124. But if you stop there, you show that you have not given much thought to your error margin. First of all, you are probably working out of a sample. If someone else redid your work, they might have a different sample. Even if one uses exactly the same algorithm you have been using, implementation matters. Small things like how your records are ordered can change results. Moreover, most software is not truly deterministic. Even if you were to run exactly the same software twice on the same data, you probably would not get the same answers. Software needs to break ties, and often does so arbitrarily or randomly. Some algorithms involve sampling or other randomization. Cross-validation is often randomized.


I am not advocating that you should go as far as reporting exact error margins for each and every measure you report. It gets cumbersome for both the reader and the author. It is also not the case that you should never use many significant digits. However, if you write a report or a research paper, and you report measures, like precision or timings, and you have not given any thought to significant digits, you are doing it wrong. You must choose the number of significant digits deliberately.

There are objections to my view:

- &ldquo;I have been using 6 significant digits for years and nobody ever objected.&rdquo; That is true. There are entire communities that have never heard about the concept of significant digit. But that is not an excuse.
- &ldquo;It sounds more serious to offer more precision, this way people know that I did not make it up.&rdquo; It may be true that some people are easily impressed by very precise answers, but serious people will not be so easily fooled, and non-specialists will be turned off by the excessive precision.


