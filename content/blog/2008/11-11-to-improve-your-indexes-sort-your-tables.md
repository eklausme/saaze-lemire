---
date: "2008-11-11 12:00:00"
title: "To improve your indexes: sort your tables!"
---



Many database indexes, including bitmap indexes, are sensitive to the order of the rows in your table. Many data warehousing practitioners urge you to sort your tables to get better results, especially with Oracle systems. In fact, column-oriented database systems like Vertica are built on sorted tables.

What do I mean by sorting the rows? It turns out that finding the best row reordering is a NP-hard problem. You might as well use something cheap like lexicographical sort as a heuristic. Finding an equally scalable technique that work much better is probably impossible. Ah! But there are different ways to sort lexicographically!

We wrote a few papers on this issue including one for [DOLAP 2008](http://arxiv.org/abs/0808.2083). Here are the slides of our presentation:
<a style="font:14px Helvetica,Arial,Sans-serif;display:block;margin:12px 0 3px 0;text-decoration:underline;" title="Histogram-Aware Sorting for Enhanced Word-Aligned Compression in Bitmap Indexes" href="http://www.slideshare.net/lemire/histogramaware-sorting-for-enhanced-wordaligned-compression-in-bitmap-indexes-presentation?type=powerpoint">Histogram-Aware Sorting for Enhanced Word-Aligned Compression in Bitmap Indexes</a><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="425" height="355" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="src" value="http://static.slideshare.net/swf/ssplayer2.swf?doc=dolaphandout-1226428379721064-8&amp;stripped_title=histogramaware-sorting-for-enhanced-wordaligned-compression-in-bitmap-indexes-presentation" /><embed type="application/x-shockwave-flash" width="425" height="355" src="http://static.slideshare.net/swf/ssplayer2.swf?doc=dolaphandout-1226428379721064-8&amp;stripped_title=histogramaware-sorting-for-enhanced-wordaligned-compression-in-bitmap-indexes-presentation" allowscriptaccess="always" allowfullscreen="true"></embed></object>
View SlideShare <a style="text-decoration:underline;" title="View Histogram-Aware Sorting for Enhanced Word-Aligned Compression in Bitmap Indexes on SlideShare" href="http://www.slideshare.net/lemire/histogramaware-sorting-for-enhanced-wordaligned-compression-in-bitmap-indexes-presentation?type=powerpoint">presentation</a> or <a style="text-decoration:underline;" href="http://www.slideshare.net/upload?type=powerpoint">Upload</a> your own. (tags: <a style="text-decoration:underline;" href="http://slideshare.net/tag/dolarp2008">dolarp2008</a>)


