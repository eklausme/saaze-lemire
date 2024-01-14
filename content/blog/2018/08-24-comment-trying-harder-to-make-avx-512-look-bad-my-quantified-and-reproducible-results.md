---
date: "2018-08-24 12:00:00"
title: "Trying harder to make AVX-512 look bad: my quantified and reproducible results"
index: false
---

[One thought on &ldquo;Trying harder to make AVX-512 look bad: my quantified and reproducible results&rdquo;](/lemire/blog/2018/08-24-trying-harder-to-make-avx-512-look-bad-my-quantified-and-reproducible-results)

<ol class="comment-list">
<li id="comment-344280" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/plokhotnyuk" class="url" rel="ugc external nofollow">Andriy Plokhotnyuk</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-25T00:53:36+00:00">August 25, 2018 at 12:53 am</time></a> </div>
<div class="comment-content">
<p>Some cipher routines with AVX-512 instructions can affect performance of web servers by slowing down them on ~10% when running them on 24-core Xeon:<br/>
<a href="https://blog.cloudflare.com/on-the-dangers-of-intels-frequency-scaling/amp/" rel="nofollow ugc">https://blog.cloudflare.com/on-the-dangers-of-intels-frequency-scaling/amp/</a></p>
<p>BTW, latest RC of JDK 11 disables AVX-512 by default:<br/>
<a href="http://hg.openjdk.java.net/jdk/jdk11/rev/943cf1675b59?revcount=10000" rel="nofollow ugc">http://hg.openjdk.java.net/jdk/jdk11/rev/943cf1675b59?revcount=10000</a></p>
</div>
</li>
</ol>
