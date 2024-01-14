---
date: "2005-08-13 12:00:00"
title: "Want a free mirror of your site?"
---



The famous [Robin Millette](http://robin.millette.info/) let me know about Coral. Coral lets you create a [free mirror](http://www.coralcdn.org/) of any site of your choosing. It is a research project in peer-to-peer web caching:

> Coral is peer-to-peer content distribution network, comprised of a world-wide network of web proxies and nameservers. It allows a user to run a web site that offers high performance and meets huge demand, all for the price of a $50/month cable modem.

Publishing through Coral is as simple as appending a short string to the hostname of objects&rsquo; URLs; a peer-to-peer DNS layer transparently redirects browsers to participating caching proxies, which in turn cooperate to minimize load on the source web server. These volunteer sites that run Coral automatically replicate content as a side effect of users accessing it, improving its availability. Using modern peer-to-peer indexing techniques, Coral will efficiently find a cached object if it exists anywhere in the network, requiring that it use the origin server only to initially fetch the object once.

One of Coral&rsquo;s key goals is to avoid ever creating hot spots that might dissuade volunteers from running the software for fear of load spikes. It achieves this through a novel indexing abstraction we introduce called a distributed sloppy hash table (DSHT), and it creates self-organizing clusters of nodes that fetch information from each other to avoid communicating with more distant or heavily-loaded servers.

I must admit. I have no idea what this means, how it works. I&rsquo;m too tired to investigate, but it sounds fascinating and crazy at the same time. If you know more about it, please tell me!

