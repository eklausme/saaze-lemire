---
date: "2006-01-18 12:00:00"
title: "Google was eating all my bandwidth!"
---



Some of you who tried to access my web site in recent days have noticed that it was getting increasingly sluggish. In an [earlier post](/lemire/blog/2006/01/13/googlebot-accounts-for-one-fourth-of-my-page-hits/), I reported that Google accounted for 25% of my page hits, sometimes much more. As it turns out, these two issues are related. Google was eating all my bandwidth.

I investigated the matter and found out that Google was spending a lot of time spidering some posting boards I host. So, I did two things: I created a [robots.txt](https://lemire.me/robots.txt) file which tells Google to stop indexing the content of the posting boards, and I deleted all messages older than 90 days in these posting boards (which resulted in the deletion of 200,000+ messages). Both of these actions are bad for the web. I wanted people to have access to these archives. I wanted to keep them. I have gigabytes of storage, but I&rsquo;m far more limited on bandwidth!
I&rsquo;ll report here about how it goes, but this tells me that Google has reached the limits of freshness and exhaustivity. And no, [I&rsquo;m not the only one worrying about Google using up too much of my bandwidth](http://www.thesitewizard.com/archive/robotstxt.shtml). If we get to a point where Google accounts for 25% of all web traffic, what are we going to do collectively?

I don&rsquo;t believe the solution lies in the webmasters. I don&rsquo;t want to have to tell Google, in details, what to index and when to index it. However, I could imagine a standard by which Google could query a web service and determine what content, if any, has changed. Similarly, given a directory of static HTML page, there is got to be a way for Apache to tell Google what files have changed in the recent past. I&rsquo;m amazed there isn&rsquo;t a standard way to do this yet.

I know Robin will tell me to use [Sitemaps](https://accounts.google.com/ServiceLogin?service=sitemaps&amp;passive=1209600&amp;continue=https%3A%2F%2Fwww.google.com%2Fwebmasters%2Ftools%2F&amp;followup=https%3A%2F%2Fwww.google.com%2Fwebmasters%2Ftools%2F), but from the look of it, while it looks easy to create a Google Sitemap for static content, creating a Sitemap for a complex site made of static content, wordpress pages, posting boards and so on, is far more daunting. I don&rsquo;t want to spend the next week working on such a stupid project. This has to be automated.

