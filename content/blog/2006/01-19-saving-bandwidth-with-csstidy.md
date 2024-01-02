---
date: "2006-01-19 12:00:00"
title: "Saving Bandwidth with CSSTidy"
---



My CSS files get verbose over time. CSS is just not a great language or else, I&rsquo;m not very good at it. Anyhow, I found out about [CSSTidy](http://csstidy.sourceforge.net/) which is a nifty tool to optimize your CSS files. There is also an online version. CSS optimization is a cool topic and it might get to be quite a challenge as selectors become more complex.

However, given the following test:

<code><br/>
montant {<br/>
color: red;<br/>
font-weight: bold;<br/>
background:white;<br/>
font-style: normal;<br/>
text-align: center;<br/>
}<br/>
nom {<br/>
color: white;<br/>
background:white;<br/>
font-style: normal;<br/>
text-align: left;<br/>
}<br/>
texte {<br/>
color: black;<br/>
text-align: center;<br/>
font-style: normal;<br/>
background:white;<br/>
text-align: left;<br/>
}<br/>
</code>

CSSTidy failed to rewrite it in the obvious way:

<code><br/>
montant {<br/>
color: red;<br/>
font-weight: bold;<br/>
text-align: center;<br/>
}<br/>
nom {<br/>
color: white;<br/>
text-align: left;<br/>
}<br/>
texte {<br/>
color: black;<br/>
text-align: left;<br/>
}<br/>
montant, nom, texte {<br/>
background: white;<br/>
font-style: normal;<br/>
}<br/>
</code>

Before you rush out and try to implement your own CSS optimizer, notice that the [Flumpcakes CSS Optimizer](http://flumpcakes.co.uk/css/optimiser/) found the right solution.

