---
date: "2010-04-20 12:00:00"
title: "The mythical reproducibility of science"
---



[David Donoho](https://en.wikipedia.org/wiki/David_Donoho) was among the first researchers to promote reproducible research through software publication (see Buckheit and Donoho, 1995). Fifteen years later, Donoho and his collaborators are even more insistent :

> Scientific computation is emerging as absolutely central to the scientific method. Unfortunately, it&rsquo;s error-prone and currently immatureâ€”traditional scientific publication is incapable of finding and rooting out errors in scientific computationâ€”which must be recognized as a crisis. An important recent development and a necessary response to the crisis is reproducible computational research in which researchers publish the article along with the full computational environment that produces the results. ([Donoho et al., 2009](http://www.computer.org/csdl/mags/cs/2009/01/mcs2009010008-abs.html))


Their [2009 paper on reproducibility](http://www.computer.org/csdl/mags/cs/2009/01/mcs2009010008-abs.html) is insightful and well worth reading. I agree that sharing software is good for science, and  for scientists.

Unfortunately, I fear we might lose sight of why we must publish our software.

1. __In theory, scientists should be constantly checking each other&rsquo;s results. But that is not how science is done.__ You are rewarded for finding something new, not for checking someone&rsquo;s results. So hardly anyone will ever download your code to check whether you cheated.
1. __Reproducibility and repeatability are not the same thing.__ It is great that I can rerun your code. But it does not follow that your code and results are right or useful.


Share your source code __to spread your ideas:__

- __Keep your packages simple.__ People need a few key pieces of code that they can integrate in their own software.
- __Use popular languages.__ Remember that repeatability is not enough: people are likely to tear apart your software to reconstruct their own.
- __Go beyond academia.__ Why assume academic researchers are the people who matter? Spreading your ideas among engineers is important as well.


__The reproducibility that matters is getting people to use your ideas.__ Merely proving you are honest falls short of your potential!

__Further reading__: [Open Sourcing your software hurt your competitiveness as a researcher?](/lemire/blog/2010/02/10/open-sourcing-your-software-hurts-your-competitiveness-as-a-researcher/)

