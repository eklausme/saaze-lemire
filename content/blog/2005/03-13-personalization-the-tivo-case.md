---
date: "2005-03-13 12:00:00"
title: "Personalization: the TiVo case"
---



Michael Pazzani offers a course on Web Personalization. I have no time to check it further, but it looks like a very interesting course and the slides are available online.

What&rsquo;s more interesting is that he offers his students a Word version of a 2004 TiVo paper (TiVo is a company that sells a TV show recording device). The paper is also available as a PDF file through [ACM (but you need to be a member)](http://portal.acm.org/citation.cfm?id=1014097).

> We describe the TiVo television show collaborative recommendation system which has been fielded in over one million TiVo clients for four years. Over this install base, TiVo currently has approximately 100 million ratings by users over approximately 30,000 distinct TV shows and movies. TiVo uses an item-item (show to show) form of collaborative filtering which obviates the need to keep any persistent memory of each user&rsquo;s viewing preferences at the TiVo server. Taking advantage of TiVo&rsquo;s client-server architecture has produced a novel collaborative filtering system in which the server does a minimum of work and most work is delegated to the numerous clients. Nevertheless, the server-side processing is also highly scalable and parallelizable. Although we have not performed formal empirical evaluations of its accuracy, internal studies have shown its recommendations to be useful even for multiple user households. TiVo&rsquo;s architecture also allows for throttling of the server so if more server-side resources become available, more correlations can be computed on the server allowing TiVo to make recommendations for niche audiences.


Now, together with Verizon and Amazon, this is the third large company to use item-item collaborative filtering as in our Slope One algorithm used by [inDiscover.net](http://www.indiscover.net) (which we licensed/sold to Bell/MSN). The TiVo paper itself is not so interesting: the details are conveniently hidden away.

Remember my post about the use of mathematical notations and how it was very useful in making papers precise? Well, the TiVo paper hardly use any mathematical notation, so it looks friendly, but try to really understand what they do and how they do it precisely. Maybe I&rsquo;m just not smart enough, but I can&rsquo;t really figure out. If they had expressed themselves in clearly stated and detailed equations, it would be clear. Now, all you have to go on is &ldquo;we used a linear weighted average&rdquo;. It is enough to understand the big idea, we could approximatively reproduce their work, we could, but we would have to guess our way through.

Maybe I&rsquo;m just an old geek complaining too much&hellip;

