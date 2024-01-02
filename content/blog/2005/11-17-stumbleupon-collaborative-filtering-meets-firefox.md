---
date: "2005-11-17 12:00:00"
title: "StumbleUpon: collaborative filtering meets Firefox"
---



[StumbleUpon is a Firefox extension](http://www.stumbleupon.com/) which does collaborative filtering over visited web pages. From the toolbar, it looks like you can give the thumb up or down to a web page.

<img decoding="async" src="http://www.stumbleupon.com/images/happyperson_toolbar_green.png" />

It seems to be a centralized effort. The troubles with centralized collaborative filtering (one database for all people) are numerous including scalability, privacy, perennity, spamming&hellip; Scalability is much harder to achieve than people think unless you are satisfied with batch updates. Spamming is hard to avoid when you have nly one database to go againts.

The ideal collaborative filtering model for me is the social network where each user is a node connected to a set of users. You publish your preferences to your peers in the network and it propagates in a peer-to-peer manner, maybe using RDF. Too bad I don&rsquo;t have time to program something like this.

(Source: thanks to Owen for the StumbleUpon pointer.)

