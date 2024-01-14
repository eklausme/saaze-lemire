---
date: "2005-04-05 12:00:00"
title: "Attention.XML"
---



I just became aware of the Attention.XML specification. The goal of Attention.XML is:

> 
- How many sources of information must you keep up with?
- Tired of clicking the same link from a dozen different blogs?
- RSS readers collect updates, but with so many unread items, how do you know which to read first?- 
Attention.XML is designed to to solve these problems and enable a whole new class of blog and feed related applications.




Technically, Attention.XML is about making available to others the posts and feeds you like and the ones you dislike.

>Attention.XML is an XML file (specifically an XOXO file) that contains an outline of feeds/blogs, where each feed itself is an outline, and each post is also an outline under the feed. This hierarchical outline structure is then annotated with per-feed and per-post information which captures such information as, the last time the feed/post was accessed, the duration of time spent on the feed/post, recent times of feed/post access, user set (dis)approval of posts, etc.<br/>
Attention.XML is an XML file (specifically an XOXO file) that contains an outline of feeds/blogs, where each feed itself is an outline, and each post is also an outline under the feed. This hierarchical outline structure is then annotated with per-feed and per-post information which captures such information as, the last time the feed/post was accessed, the duration of time spent on the feed/post, recent times of feed/post access, user set (dis)approval of posts, etc.



The idea is then to use collaborative filtering to find out what you may like.

This sounds like a great idea, except for what Dare Obasanjo points out:

> The only cloud I see on the horizon is that if anyone figures out how to do this right, it is unlikely that it will be made available as an open pool of data. The &lsquo;attention.xml&rsquo; for each user would be demographic data that would be worth its weight in gold to advertisers. If Bloglines could figure out my likes and dislikes right down to what blog posts I&rsquo;d want to read, I find it hard to imagine why the Bloglines team would make that information available to anyone including the user. For comparison, it&rsquo;s not like Amazon makes my &lsquo;attention.xml&rsquo; for books and CDs available to myself or their competitors.

It seems to me that what we need is a legal solution. We need to make it so that companies using publicly available Attention.XML files must give back (Ã  la GPL). For example, if you use my Attention.XML, then you need to make yours available. This way, companies like blogline would be forced to either use only internal data, or else make available their data sets when requested to do so.

Indeed, Attention.XML is very different from RSS. With RSS, you provide content that you want to be used&hellip; everyone wants more readers, so RSS is a winner. But Attention.XML provide my preferences, and why would I share my preferences? What do I win? Why would a company share my preferences if not for financial gain?

(For further reading on collaborative filtering, see Slope One Predictors for Online Rating-Based Collaborative Filtering [SDM&rsquo;05] and Scale And Translation Invariant Collaborative Filtering Systems [Journal of Information Retrieval, 2005].)

