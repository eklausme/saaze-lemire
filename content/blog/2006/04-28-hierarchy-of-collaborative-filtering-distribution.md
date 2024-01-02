---
date: "2006-04-28 12:00:00"
title: "Hierarchy of Collaborative Filtering Distribution"
---



I think that, increasingly, both creators and clients want to regain control. The beauty of it is that I think that businesses can be built on putting customers back in charge. To a large extend, I keep prefering Amazon to my local bookstore in part because, I have more control when using Amazon.

 Increasingly, we are seeing that the creator want to stay in control. Publishers increasingly struggle to stay in charge, but they fight a losing war. The next logical step is that the clients will want more &ldquo;control&rdquo; as well.

This issue lead me to designing this &ldquo;Hierarchy of Collaborative Filtering Distribution&rdquo;<sup>[1](#rec1)</sup>. 

__Definition__: <em>In a collaborative filtering recommender system, we have two type of human agents: the creators who want to sell their content, and the clients who are willing to share some of their preferences. By this definition, Google is typically not a collaborative filtering recommender system.</em>

__Level 1__. The data (and goods) are centralized. The creators relinquish total control. The clients need to trust one entity with its preferences. The business value is in controlling the channel, the data and providing good tools. (Think: [Amazon](https://www.amazon.com)) (Think: Standard distribution channels)

__Level 2__. Only the meta-data is centralized. The creators keep the control, but the clients need to trust one entity with their preferences. Some of the business value lies in the client&rsquo;s metadata. (Think: [inDiscover](http://www.indiscover.net).)

__Level 3__. Both the data __and__ the metadata is distributed and only the aggregation needs to happen at one point of contact. The clients and the creators use interoperable tools and data format and keep tight control of their data. The business value is in the tools and services themselses, not in the data. (Think: Semantic Webish applications.)

Regarding Music, going to the level 3 is not hard. Sites like [inDiscover](http://www.indiscover.net) and webjay already make playlists available in XML. This is where the work of people like [Lucas Gonze on XML formats for MP3 playlists](http://gonze.com/playlists/playlist-format-survey.html) can become interesting. 

Imagine a world were artists post on various web sites, not only their MP3s, but also, some standard XML file allowing aggregation. Imagine also that users posts their playlists (indiscover and webjay users do this already). We then have the possibility for a level 3 distributed recommender system &ldquo;Ã  la Semantic Web&rdquo;.

This can then be very interesting research-wise and business-wise.

__Update__: Rod Savoie points me to DLORN (Distributed Learning Object Repository Network) as a related tool.

<small>1- <a name="rec1"></a> I checked and this concept appears to be new. If you ever use it, you have to cite this blog entry! There is related work however, such as Tomas Olsson, [Bootstrapping and Decentralizing Recommender Systems](http://www.it.uu.se/research/publications/lic/2003-006/2003-006.pdf), 2003 and [Resource Profiles](http://www.downes.ca/files/resource_profiles.htm) by Stephen Downes (also in 2003). </small>

