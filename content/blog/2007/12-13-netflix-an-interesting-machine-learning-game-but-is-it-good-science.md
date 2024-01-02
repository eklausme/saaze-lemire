---
date: "2007-12-13 12:00:00"
title: "Netflix: an interesting Machine Learning game, but is it good science?"
---


<a href="https://login.yahoo.com/config/login?.src=flickrsignin&amp;.pc=8190&amp;.scrumb=0&amp;.pd=c%3DH6T9XcS72e4mRnW3NpTAiU8ZkA--&amp;.intl=ca&amp;.lang=en&amp;mg=1&amp;.done=https%3A%2F%2Flogin.yahoo.com%2Fconfig%2Fvalidate%3F.src%3Dflickrsignin%26.pc%3D8190%26.scrumb%3D0%26.pd%3Dc%253DJvVF95K62e6PzdPu7MBv2V8-%26.intl%3Dca%26.done%3Dhttps%253A%252F%252Fwww.flickr.com%252Fsignin%252Fyahoo%252F%253Fredir%253D%25252Fphoto_zoom.gne%25253Fid%25253D512729050%252526size%25253Ds"><img decoding="async" src="https://s.yimg.com/pw/images/en-us/photo_unavailable_m.png" alt="picture by Mr. Guybrarian" /></a>

The [Netflix competition](http://www.netflixprize.com/) is a $1 million game to build the best possible movie recommender system. It has already contributed to science tremendously by providing the largest freely available collaborative filtering filter data set (about 2GB): it is at least an order of magnitude larger than any other similar data set. It has also generated [many valuable research papers](https://scholar.google.ca/scholar?num=100&amp;hl=en&amp;lr=&amp;q=+%22netflix+dataset%22&amp;btnG=Search). Among interesting contributions is a [paper showing that the anonymized data might not be so anonymized](http://arxiv.org/abs/cs/0610105), after all.

However, [Greg](https://glinden.blogspot.com/2007/12/bellkor-ensemble-for-recommendations.html) wonders whether the game itself will have a valuable output:

> Participants may be overfitting to the strict letter of this contest. Netflix may find that the winning algorithm actually is quite poor at the task at hand &#8212; recommending movies to Netflix customers &#8212; because it is overoptimized to this particular contest data and the particular success metric of this contest.


Because I have written collaborative filtering papers in the past, on [multidimensionality and rules](http://www.daniel-lemire.com/fr/abstracts/ITSE2005.html), on the [Slope One](https://lemire.me/fr/abstracts/SDM2005.html) scheme and on the [data normalization problem](https://lemire.me/fr/abstracts/IR2003.html), people were quick to ask me if I would participate. The issue was quickly settled: the rules of the game forbid people from Quebec from participating. But privately, I expressed concerns that the game would be more about tuning and tweaking than about learning new insights into the science of collaborative filtering. I never expressed these concerns publicly for fear that it might be badly interpreted.

I do not think that the next step in collaborative filtering is to find ways to improve accuracy according to some metric. I think this game got old circa 2000. I am rather looking forward to people coming up with drastically new problems and insights.

__Disclaimer__. If you are working on the Netflix game, please continue. I do not deny that it is an interesting engineering challenge.

