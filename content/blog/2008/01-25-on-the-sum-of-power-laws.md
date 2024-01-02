---
date: "2008-01-25 12:00:00"
title: "On the sum of power laws"
---



Many real-life data sets have power laws or Zipfian distributions. An integer-valued random variable _X_ follows a power law with parameter _a_ if <em>P</em>(<em>X</em>&nbsp;=&nbsp;<em>k</em>) is proportional to <em>k</em><sup>&#8211;<em>a</em></sup>. Panos [asked what the sum of two power laws was](https://behind-the-enemy-lines.blogspot.com/2008/01/misunderstandings-of-power-law.html). He cites [Wilke at al.](http://arxiv.org/abs/adap-org/9803001) who claim that the sum of two power laws _X_ and _Y_ with parameters _a_ and _b_ is a power law with parameter min(<em>a</em>,&nbsp;<em>b</em>).

I relate this problem to the sum of exponentials. Any engineer knows that if <em>a</em>><em>b</em>, then <em>e</em><sup><em>a</em><em>t</em></sup>&nbsp;+&nbsp;<em>e</em><sup><em>b</em><em>t</em></sup> will be approximately <em>e</em><sup><em>a</em><em>t</em></sup> for _t_ sufficiently large. Hence, the sum of power law distributions _X_ and _Y_ is a power law distribution with parameter min(<em>a</em>,&nbsp;<em>b</em>) if you are only interested in large values of k in <em>P</em>(<em>X</em>&nbsp;+&nbsp;<em>Y</em>&nbsp;=&nbsp;<em>k</em>).

However, the sum of two power laws is not a power law. Egghe showed in [The distribution of N-grams](https://link.springer.com/article/10.1023/A:1005634925734) that even if the words follow a power law, the n-grams won&rsquo;t! 

