---
date: "2021-06-30 12:00:00"
title: "Compressing JSON: gzip vs zstd"
index: false
---

[9 thoughts on &ldquo;Compressing JSON: gzip vs zstd&rdquo;](/lemire/blog/2021/06-30-compressing-json-gzip-vs-zstd)

<ol class="comment-list">
<li id="comment-588972" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-01T04:34:31+00:00">July 1, 2021 at 4:34 am</time></a> </div>
<div class="comment-content">
<p>Blosc has demonstrated that using a really fast codec with modest compression ratio you can actually speed up processing relative to using uncompressed data by relieving load on the bottleneck of main memory fetching. This only helps for a large number of threads, though. Not single cpu performance.</p>
<p>But if this can be true for DRAM, it can definitely be relevant to disk and network. So while .json.zstd may be good over the internet I expect .json.lz4 to be beneficial almost always.</p>
<p>I wonder how fast a tightly coupled lz4-json decoder with an intermediate buffer size optimized for L1 cache can get.</p>
</div>
<ol class="children">
<li id="comment-589029" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/329d6321d8fecd040220a45544d4cf52?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/329d6321d8fecd040220a45544d4cf52?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://clickhouse.tech/" class="url" rel="ugc external nofollow">Alexey Milovidov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-01T22:34:43+00:00">July 1, 2021 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>Yes, in our experience with ClickHouse, we can improve in-memory processing speed with enabling compression. I have a presentation about it: <a href="https://presentations.clickhouse.tech/meetup53/optimizations/" rel="nofollow ugc">https://presentations.clickhouse.tech/meetup53/optimizations/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-588997" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59bdc242a1e3410f4414a5f183fa567f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59bdc242a1e3410f4414a5f183fa567f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.mricro.com" class="url" rel="ugc external nofollow">Chris Rorden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-01T11:58:10+00:00">July 1, 2021 at 11:58 am</time></a> </div>
<div class="comment-content">
<p>gzip is a legacy format with a lot of design choices from a bygone era. Therefore, zstd has many inherent benefits. Therefore, it is not surprising that zstd dominates the Pareto frontier. However, there are several gz format tools that vastly outperform gzip for <a href="https://github.com/neurolabusc/pigz-bench-python" rel="nofollow ugc">compression and decompression</a>. You note CloudFlare, however if you are focused on de-compression it is worth looking at libdeflate or Intel&rsquo;s igzip which <a href="https://github.com/zlib-ng/zlib-ng/issues/986" rel="nofollow ugc">has extremely fast decompression on x86-64 machines</a>. Related, for web applications Google&rsquo;s Chrome does include a number of optimizations (some of which have found there way into CloudFlare).</p>
</div>
</li>
<li id="comment-589005" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c9dbef154d78b7748f012517b8d37c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c9dbef154d78b7748f012517b8d37c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ImreSamu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-01T14:38:37+00:00">July 1, 2021 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>IMHO: the correct scripts Link :</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/06/30" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/06/30</a></p>
<p>related: The PostgreSQL hackers discussing ZSON (improvements) ( 2021-may-jun )</p>
<p><a href="https://www.postgresql.org/message-id/flat/4aca1d4c-aa07-c168-bcca-236ec9f04c8d%40dunslane.net#ed814406717fc0915178261de7fd7e4a" rel="nofollow ugc">https://www.postgresql.org/message-id/flat/4aca1d4c-aa07-c168-bcca-236ec9f04c8d%40dunslane.net#ed814406717fc0915178261de7fd7e4a</a></p>
<p>ZSON = <em>&ldquo;ZSON is a PostgreSQL extension for transparent JSONB compression. Compression is based on a shared dictionary of strings most frequently used in specific JSONB documents (not only keys, but also values, array elements, etc).&rdquo;</em> <a href="https://github.com/postgrespro/zson" rel="nofollow ugc">https://github.com/postgrespro/zson</a></p>
</div>
</li>
<li id="comment-589009" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e88085394bf8eeaddeb13104d65ccf6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e88085394bf8eeaddeb13104d65ccf6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Boero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-01T15:57:32+00:00">July 1, 2021 at 3:57 pm</time></a> </div>
<div class="comment-content">
<p>Awesome I love a good compression discussion. Zstd blew my mind and in fact I read the zip file standard just added support for the zstd compression standard. So many open source options have been blowing away legacy proprietary compression lately &#8211; it&rsquo;s a great time to be alive.</p>
<p>In addition to Facebook&rsquo;s Zstd Google gave us Brotli, which is tuned for compressing web content like HTML and JSON. Brotli is slower than Zstd but it has a static dictionary based on the most common words or utf8 on the internet, and often compresses my JS/JSON 5-30% better than even Zstd. For example here is an OpenAPI schema that&rsquo;s 412KB raw, 28k-38k in Zstd, and 26k in Brotli. Zstd has blown Brotli out of the water in speed but Brotli still compresses better for static compression of text like this.</p>
<p>412K test.json<br/>
26K test.json.br<br/>
35K test.json.gz<br/>
38K test.json.zst (default level)<br/>
28K test.json.zst (max level 19)</p>
</div>
</li>
<li id="comment-589399" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebf51a24a355b8b6d640992e746d5e00?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebf51a24a355b8b6d640992e746d5e00?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/acip" class="url" rel="ugc external nofollow">Cip</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-05T08:35:37+00:00">July 5, 2021 at 8:35 am</time></a> </div>
<div class="comment-content">
<p>For completeness, can you add the speed benchmarks for compression as well?</p>
</div>
</li>
<li id="comment-590193" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Duarte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-10T14:40:27+00:00">July 10, 2021 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>Dan, which application did you use for gzip compression? This is important because it impacts the results. You mentioned that web servers use gzip. Note that the application / library they use is actually <strong>zlib</strong>. However, the command line application that comes with many Linux and Unix-based OSes is <strong>GNU Gzip</strong>. I can&rsquo;t tell from your script which of these you used, but I&rsquo;m guessing it was GNU Gzip, which is not what web servers use.</p>
<p>This is GNU Gzip: <a href="https://www.gnu.org/software/gzip/" rel="nofollow ugc">https://www.gnu.org/software/gzip/</a></p>
<p>This is zlib: <a href="https://github.com/madler/zlib" rel="nofollow ugc">https://github.com/madler/zlib</a></p>
<p>They&rsquo;re totally different projects and codebases. The zlib library can generate three different formats: deflate, gzip, and the official zlib format. They all use deflate, but the headers are different. Web servers like Apache and nginx generate gzip <em>files</em> using the zlib <em>library</em>.</p>
<p>Also, the compression levels you used are unclear. You didn&rsquo;t specify any in your script, so it would be the defaults. There&rsquo;s nothing special or authoritative about the defaults for benchmarking purposes, so it would be worth trying at least a few levels. I have no idea what the gzip default compression level is for either GNU Gzip or zlib, but for Zstd it&rsquo;s level 3. That&rsquo;s out of 22 possible levels, so it&rsquo;s near the lowest ratio Zstd produces. The difference between your gzip and Zstd results would likely be much greater if you tried higher levels, since Zstd improves dramatically as you go up the levels, whereas gzip generally doesn&rsquo;t improve much beyond level 6 (out of 9).</p>
<p>Note that the current benchmarks for gzip compression are not GNU Gzip or zlib, which are old projects that emphasize compatibility with old computers. The benchmarks are libdeflate (by Eric Biggers) and zopfli (by Google, probably Jyrki Alakuijala and others). They both compress better than zlib, and libdeflate is also much faster (zopfli is super slow). The Cloudflare fork of zlib hasn&rsquo;t been maintained, and it wasn&rsquo;t actually usable or buildable last time I checked.</p>
<p><a href="https://github.com/ebiggers/libdeflate" rel="nofollow ugc">https://github.com/ebiggers/libdeflate</a></p>
<p><a href="https://github.com/google/zopfli" rel="nofollow ugc">https://github.com/google/zopfli</a></p>
</div>
<ol class="children">
<li id="comment-590196" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-10T15:16:27+00:00">July 10, 2021 at 3:16 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the blog post and the script with Eric Biggers&rsquo; code. It is indeed quite fast.</p>
</div>
<ol class="children">
<li id="comment-590458" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Duarte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-12T18:18:29+00:00">July 12, 2021 at 6:18 pm</time></a> </div>
<div class="comment-content">
<p>libdeflate offers more compression levels too. I think it&rsquo;s 1 to 12, compared to 1 to 9 for typical gzip implementations. Those levels do in fact deliver better compression than legacy libraries like zlib – they&rsquo;re not just there for granularity. e.g. libdeflate 12 compresses more than zlib 9 (and libdeflate 9 probably compresses more than zlib 9, and faster).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
