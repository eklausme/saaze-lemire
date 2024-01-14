---
date: "2021-06-30 12:00:00"
title: "Compressing JSON: gzip vs zstd"
---



[JSON](https://en.wikipedia.org/wiki/JSON) is the de facto standard for exchanging data on the Internet. It is relatively simple text format inspired by JavaScript. I say &ldquo;relatively simple&rdquo; because you can read and understand [the entire JSON specification in minutes](https://www.rfc-editor.org/rfc/rfc8259.txt).

Though JSON is a concise format, it is also better used over a slow network in compressed mode. Without any effort, you can compress often JSON files by a factor of ten or more.

Compressing files adds an overhead. It takes time to compress the file, and it takes time again to uncompress it. However, it may be many times faster to send over the network a file that is many times smaller. The benefits of compression go down as the network bandwidth increases. Given the large gains we have experienced in the last decade, compression is maybe less important today. The bandwidth between nodes in a cloud setting (e.g., AWS) can be gigabytes per second. Having fast decompression is important.

There are many compression formats. <a href="https://www.ietf.org/rfc/rfc1952.txt">The conventional approach, supported by many web servers, is <tt>gzip</tt></a>. There are also more recent and faster alternatives. I pick one popular choice: <tt>zstd</tt>.

For my tests, I choose a JSON file that is representative of real-world JSON: <tt>twitter.json</tt>. It is an output from the Twitter API.

Generally, you should expect `zstd` to compress slightly better than <tt>gzip</tt>. My results are as follow using standard Linux command-line tools with default settings:

uncompressed             |617 KB                   |
-------------------------|-------------------------|
gzip (default)           |51 KB                    |
zstd (default)           |48 KB                    |


To test the decompression performance, I uncompress repeatedly the same file. Because it is a relatively small file, we should expect disk accesses to be buffered and fast.

Without any tweaking, I get twice the performance with `zstd` compared to the standard command-line `gzip` (which may differ from what your web server uses) while also having better compression. It is win-win. Modern compression algorithms like `zstd` can be really fast. For a fairer comparison, I have also included [Eric Biggers&rsquo; libdeflate utility](https://github.com/ebiggers/libdeflate). It comes out ahead of zstd which stresses once more the importance of using good software!

gzip                     |175 MB/s                 |
-------------------------|-------------------------|
gzip (Eric Biggers)      |424 MB/s                 |
zstd                     |360 MB/s                 |


[My script is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/06/30). I run it under a Ubuntu system. [I can create a RAM disk](https://www.linuxbabe.com/command-line/create-ramdisk-linux) and the numbers go up slightly.

I expect that I understate the benefits of a fast compression routines:

<li style="list-style-type: none;">

1. I use a docker container. If you use containers, then disk and network accesses are slightly slower.
1. I use the standard command-line tools. With a tight integration of the software libraries within your software, you can probably avoid many system calls and bypass the disk entirely.



Thus my numbers are somewhat pessimistic. In practice, you are even more bounded by computational overhead and by the choice of algorithm.

The lesson is that there can be large differences in decompression speed and that these differences matter. You ought to benchmark.

What about parsing the uncompressed JSON? [We have demonstrated that you can often parse JSON at 3 GB/s or better](https://github.com/simdjson/simdjson). I expect that, in practice,  you can make JSON parsing almost free compared to compression, disk and network delays.

__Update__: This blog post was updated to include[ Eric Biggers&rsquo; libdeflate utility](https://github.com/ebiggers/libdeflate).

__Note__: There has been many requests for more to expand this blog post with various parameters and so forth. The purpose of the blog post was to illustrate that there are large performance differences, not to provide a survey of the best techniques. It is simply out of the scope of the current blog post to identify the best approach. I mean to encourage you to run your own benchmarks.

__See also__: [Cloudflare has its own implementation of the algorithm behind gzip](https://github.com/cloudflare/zlib). They claim massive performance gains. I have not tested it.

__Further reading__: [Parsing Gigabytes of JSON per Second](https://arxiv.org/abs/1902.08318), VLDB Journal 28 (6), 2019

