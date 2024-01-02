---
date: "2006-11-08 12:00:00"
title: "Querying the library of congress using Search/Retrieve via URL"
---



SRU (Search/Retrieve via URL) is an interesting [REST](https://en.wikipedia.org/wiki/REST) Web Service protocol. 

Enough technobabble. Let&rsquo;s run an example.

 Suppose you want to retrieve the data that the library of congress has on a book called &ldquo;First Impressions of the New World&rdquo; by &ldquo;Trotter Isabella Strange&rdquo;, you issue the following query (follow the hyperlink for the XML result):

[(dc.title=&rdquo;First Impressions of the New World&rdquo;) and (dc.creator all &ldquo;Trotter Isabella Strange&rdquo;)](http://z3950.loc.gov:7090/voyager?operation=searchRetrieve&#038;version=1.1&#038;recordPacking=xml&#038;startRecord=1&#038;maximumRecords=20&#038;query=(dc.title%3D%22First%20Impressions%20of%20the%20New%20World%22)%20and%20(dc.creator%20all%20%22Trotter%20Isabella%20Strange%22))

You want to use this in software? Download my corresponding Perl and Python code examples: srucodeexamples.zip.

__Further reading__: See the [wikipedia entry](https://en.wikipedia.org/wiki/SRW) or even better, [check the refbase entry](http://wiki.refbase.net/index.php/Search/Retrieve_web_services).

(Special thanks to Owen Kaser for making me discover this exciting new technology.)

