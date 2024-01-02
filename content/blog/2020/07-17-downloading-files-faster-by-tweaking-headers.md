---
date: "2020-07-17 12:00:00"
title: "Downloading files faster by tweaking headers"
---



I was given a puzzle recently. Someone was parsing JSON files downloaded from the network from a [bioinformatics URI](http://bioinfo.hpc.cam.ac.uk/cellbase/webservices/rest/v4/hsapiens/feature/gene/TET1/snp?limit=200&amp;skip=-1&amp;skipCount=false&amp;count=false&amp;Output%20format=json&amp;merge=false). One JSON library was twice as fast at the other one.

Unless you are on a private high-speed network, the time required to parse a file will always be small compared to the time required to download a file. Maybe people at Google have secret high-speed options, but most of us have to make do with speeds below 1 GB/s.

So how could it be?

One explanation might have to do with how the client (such as [curl](https://curl.haxx.se)) and the web server negotiate the transmission format. Even if the actual data is JSON, what is transmitted is often in compressed form. Thankfully, you can tell you client to request some encoding. In my particular case, out of the all of the encodings I tried, gzip was much faster. The reason seems clear enough: when I requested gzip, I got 82 KB back, instead of 766 KB.

__<tt>curl -H 'Accept-Encoding: gzip' $URL </tt>__ |__0.5 s__                |__82 KB__                |
-------------------------|-------------------------|-------------------------|
<tt>curl -H 'Accept-Encoding: deflate' $URL </tt> |1.0 s                    |766 KB                   |
<tt>curl -H 'Accept-Encoding: br' $URL </tt> |1.0 s                    |766 KB                   |
<tt>curl -H 'Accept-Encoding: identity' $URL </tt> |1.0 s                    |766 KB                   |
<tt>curl -H 'Accept-Encoding: compress' $URL</tt> |1.0 s                    |766 KB                   |
<tt>curl -H 'Accept-Encoding: *' $URL</tt> |1.0 s                    |766 KB                   |


Sure enough, if you look at the downloaded file, it has 766 KB, but if you gzip it, you get back 82 KB.

What I find interesting is that my favorite tools (<tt>wget</tt> and <tt>curl</tt>) do not request gzip by default. At least in this instance, it would be much faster. The `curl` tool takes the <tt>--compressed</tt> flag to make life easier.

Of course, the point is moot if the data is already in compressed form on the server.

