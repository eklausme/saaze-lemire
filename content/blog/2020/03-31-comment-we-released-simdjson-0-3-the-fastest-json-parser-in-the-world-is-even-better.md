---
date: "2020-03-31 12:00:00"
title: "We released simdjson 0.3: the fastest JSON parser in the world is even better!"
index: false
---

[30 thoughts on &ldquo;We released simdjson 0.3: the fastest JSON parser in the world is even better!&rdquo;](/lemire/blog/2020/03-31-we-released-simdjson-0-3-the-fastest-json-parser-in-the-world-is-even-better)

<ol class="comment-list">
<li id="comment-498792" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6cb92a8593df0352e0e2b8cd05ffc334?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6cb92a8593df0352e0e2b8cd05ffc334?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/naver/tamgu" class="url" rel="ugc external nofollow">Claude</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T08:10:14+00:00">April 1, 2020 at 8:10 am</time></a> </div>
<div class="comment-content">
<p>Congratulations is de rigueur here.</p>
<p>I guess the next challenge will be an API to speed up YAML parsing. YAML files are an important part of deploying PyTorch on most platforms, it will be worth seeing if you can easily adapt this library to this type of parsing.</p>
</div>
</li>
<li id="comment-498803" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/67fc9e7ebee46734d34f03f251cfa09f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/67fc9e7ebee46734d34f03f251cfa09f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michal Lazo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T09:20:17+00:00">April 1, 2020 at 9:20 am</time></a> </div>
<div class="comment-content">
<p>Are there any SIMD accelerated XML parser?</p>
</div>
<ol class="children">
<li id="comment-498832" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T12:47:13+00:00">April 1, 2020 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>There has been some XML parsers, at least at the prototype level, that have used SIMD instructions deliberately. However, I do not think that there has ever been something like simdjson for XML.</p>
</div>
</li>
<li id="comment-525927" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T02:38:25+00:00">June 11, 2020 at 2:38 am</time></a> </div>
<div class="comment-content">
<p>The Parabix XML project.</p>
</div>
<ol class="children">
<li id="comment-525970" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T13:35:19+00:00">June 11, 2020 at 1:35 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The Parabix XML project.</p>
</blockquote>
<p>Yes, we know of parabix, but no, it is nothing like simdjson for XML.</p>
</div>
<ol class="children">
<li id="comment-525977" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T14:12:31+00:00">June 11, 2020 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>And? How does it compare? It looks innovative. Is simdjson&rsquo;s approach applicable to XML too?</p>
</div>
<ol class="children">
<li id="comment-525986" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T15:41:32+00:00">June 11, 2020 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://arxiv.org/abs/1902.08318" rel="nofollow ugc">Please see the paper where it is discussed in details</a>. If you have questions after reading the paper, I will be happy to answer them.</p>
</div>
<ol class="children">
<li id="comment-526160" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T19:43:41+00:00">June 14, 2020 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>Okay, I read it. Very nice work.</p>
<p>Q1: Why do you use 8 bytes to encode things like null, true, false, etc.? Couldn&rsquo;t you just use one byte, or even a few bits? After all, there&rsquo;s a null codepoint in ASCII / UTF-8 &#8212; it&rsquo;s the first one, the binary zero byte 0000 0000. Do you need everything to be eight bytes for some reason?</p>
<p>Q2: Why are you focused only on huge files, over 50 KB? For JSON that&rsquo;s huge. The most common use of JSON is slinging around requests and responses on the web, with small payloads. For example, a REST API for payments might involve JSON payloads that are about 1 to 3 KB each. (GraphQL, like REST, also uses JSON.) See PayPal&rsquo;s API, or here&rsquo;s an example of a typical request payload: <a href="https://doc.gopay.com/en/?lang=shell#standard-payment" rel="nofollow ugc">https://doc.gopay.com/en/?lang=shell#standard-payment</a></p>
<p>Q3: What do you do if you can&rsquo;t use <code>tzcnt</code> to count trailing zeros? That instruction is part of BMI, which came out in Haswell. Ivy Bridge and Sandy Bridge won&rsquo;t have it, and there are still a lot of servers running on those families. How far back do you go on SIMD? Is something like Westmere or Nehalem you&rsquo;re floor? They would have SSE4.2, carryless multiplication, and I think AES.</p>
<p>You might be understating simdjson performance with all those number-heavy files, since number parsing should be your slowest.</p>
<p>FYI, I opened an issue on GitHub asking about CPU and memory overhead. That&rsquo;s an important dimension that the paper and the website don&rsquo;t address. It&rsquo;s also important to know if it causes cores to throttle down when you use AVX2 or whatever. I think Skylake and Cascade Lake might be okay on that front, but there might be an issue using AVX or AVX2 on earlier families. If so, using simdjson would slow down all the other applications and workloads on the server. I know that AVX512 throttles cores, but I don&rsquo;t remember about AVX2.</p>
</div>
<ol class="children">
<li id="comment-526172" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T21:59:00+00:00">June 14, 2020 at 9:59 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Why do you use 8 bytes to encode things like null, true, false, etc.? Couldn’t you just use one byte, or even a few bits?</p>
</blockquote>
<p>The tape uses a flat 8-byte per element, with some exceptions (numbers use two 8-byte entries).</p>
<blockquote>
<p>Why are you focused only on huge files, over 50 KB? For JSON that’s huge.</p>
</blockquote>
<p>That is what the paper benchmarks. But you can find other results on GitHub, including on tiny files.</p>
<blockquote>
<p>What do you do if you can’t use tzcnt to count trailing zeros? That instruction is part of BMI, which came out in Haswell. Ivy Bridge and Sandy Bridge won’t have it, and there are still a lot of servers running on those families. How far back do you go on SIMD? Is something like Westmere or Nehalem you’re floor? They would have SSE4.2, carryless multiplication, and I think AES.</p>
</blockquote>
<p>The simdjson relies on runtime dispatching. It runs on every x64 processing under a 64-bit system. It is open source.</p>
<blockquote>
<p>FYI, I opened an issue on GitHub asking about CPU and memory overhead. That’s an important dimension that the paper and the website don’t address. It’s also important to know if it causes cores to throttle down when you use AVX2 or whatever. I think Skylake and Cascade Lake might be okay on that front, but there might be an issue using AVX or AVX2 on earlier families. If so, using simdjson would slow down all the other applications and workloads on the server. I know that AVX512 throttles cores, but I don’t remember about AVX2.</p>
</blockquote>
<p>We do not support AVX-512. No downclocking is expected: we do not use AVX2 instructions requiring it (e.g., FMA). But, in any case, as the user, you are in charge of kernel that runs, so you can select SSSE3 is you prefer, even when your system supports AVX2. The simdjson has a non-allocation policy for parsing, so you can parse terabytes of data without allocating memory.</p>
</div>
<ol class="children">
<li id="comment-526211" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-15T08:53:24+00:00">June 15, 2020 at 8:53 am</time></a> </div>
<div class="comment-content">
<p>Okay, so on the issue of CPU overhead you said on GitHub that speed <strong><em>is</em></strong> CPU overhead or something. That&rsquo;s not quite right. The equation is:</p>
<p><em>Overhead</em> = <em>(JSON GB / Parsing speed)</em> × <em>CPU usage</em></p>
<p>Where CPU usage is the percentage of CPU. There could also be a form that uses CPU clock cycles per byte or something. It&rsquo;s not enough to know how fast some software is – we normally have to know its cost in resources like CPU and memory. It looks like you&rsquo;re good on memory since you don&rsquo;t allocate, but I&rsquo;m surprised that you&rsquo;re unwilling to report CPU overhead.</p>
<p>Another suggestions.</p>
<p>It would be great to know some things about simdjson&rsquo;s security properties, to have some basic assurances. This is a strange era for computing given how insecure and primitive our programming languages and tools are. C++ is an unsafe language where exploitable memory bugs are inevitable on medium to large projects. One light assurance would be if you follow the <a href="https://isocpp.github.io/CppCoreGuidelines/CppCoreGuidelines" rel="nofollow ugc">C++ Core Guidelines</a>. Much stronger assurance would be to pass something <a href="https://scan.coverity.com/" rel="nofollow ugc">Coverity Scan</a>. It&rsquo;s free for open source projects.</p>
<p>A JSON parser might parse untrusted input, which can be malformed or not JSON at all. Ideally a parser would be formally verified, but hardly anyone does that since popular programming languages like C++ aren&rsquo;t designed to facilitate verification and the tooling sucks. So Coverity is about as good as it gets. Address Sanitizer and Memory Sanitizer in the LLVM project are interesting too. The Software Engineering Institute at Carnegie Mellon has a Secure C++ Coding Guidelines too: <a href="https://insights.sei.cmu.edu/sei_blog/2017/04/cert-c-secure-coding-guidelines.html" rel="nofollow ugc">https://insights.sei.cmu.edu/sei_blog/2017/04/cert-c-secure-coding-guidelines.html</a></p>
<p>If you had some kind of formal assurances like those it would be pretty distinctive.</p>
</div>
<ol class="children">
<li id="comment-526220" class="comment byuser comment-author-lemire bypostauthor even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-15T12:24:39+00:00">June 15, 2020 at 12:24 pm</time></a> </div>
<div class="comment-content">
<p><em>I’m surprised that you’re unwilling to report CPU overhead.</em></p>
<p>If you have interesting performance metrics you would like to propose, we are always inviting new pull requests. The simdjson library is a community-based project. Please write up some code, and we shall be glad to discuss it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-498808" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b5a01511b13d8cfff6f3605ba06a70e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b5a01511b13d8cfff6f3605ba06a70e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.metaobject.com/" class="url" rel="ugc external nofollow">Marcel Weiher</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T09:53:49+00:00">April 1, 2020 at 9:53 am</time></a> </div>
<div class="comment-content">
<p>Awesome work! When I looked at integrating the previous version into a higher level parser, it didn&rsquo;t look like it handled streaming. Was that impression correct and if so, has that changed? Thanks!</p>
</div>
<ol class="children">
<li id="comment-498831" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T12:45:02+00:00">April 1, 2020 at 12:45 pm</time></a> </div>
<div class="comment-content">
<p>We do handle long inputs containing multiple JSON documents (e.g., line separated). We even have a nifty API for it (see &ldquo;parse_many&rdquo;).</p>
<p>If you mean streaming as in &ldquo;reading from a C++ istream&rdquo;, then, no, we do not support this and won&rsquo;t. It is too slow. We are faster than getline applied to an in-memory istream.</p>
</div>
<ol class="children">
<li id="comment-498834" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b5a01511b13d8cfff6f3605ba06a70e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b5a01511b13d8cfff6f3605ba06a70e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.metaobject.com/" class="url" rel="ugc external nofollow">Marcel Weiher</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T12:54:20+00:00">April 1, 2020 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>Don&rsquo;t care about C++ istream. In order to stream, the parser must be able to deal with partial/incomplete inputs and with resuming such an incomplete parse.</p>
<p>Feeding it is then Somebody Else&rsquo;s Problem.</p>
<p>One of the things I learned early on in building high-perf components is that having the component itself be fast is (at most) half the bette. The crucial bit is that it must be possible, preferably easy/straightforward, to use it in such a way the the whole ensemble is fast.</p>
<p>A lot of the &ldquo;fast&rdquo; XML parsers tended to fall flat in that regard.</p>
</div>
<ol class="children">
<li id="comment-498835" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b5a01511b13d8cfff6f3605ba06a70e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b5a01511b13d8cfff6f3605ba06a70e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.metaobject.com/" class="url" rel="ugc external nofollow">Marcel Weiher</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T12:55:29+00:00">April 1, 2020 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p><em>battle</em>, of course. I blame autocorrect&#8230;</p>
</div>
</li>
<li id="comment-498839" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T13:13:59+00:00">April 1, 2020 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>The way simdjson is currently designed is that it won&rsquo;t let you access a document (at all) unless it has been fully validated. The rationale behind this is that many people do not want to start ingesting documents that are incorrect. And, of course, you can only know that a document is valid if you have seen all of it.</p>
<p>For line-separated JSON documents, it is not an issue because you get to see the whole JSON document before returning it to the user, it is just that you have a long stream of them.</p>
<p>We plan to offer more options in future releases.</p>
</div>
<ol class="children">
<li id="comment-556534" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d498869d39c19039fce0b2cc55caddaf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d498869d39c19039fce0b2cc55caddaf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pawel Terlecki</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T23:32:59+00:00">October 29, 2020 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>The parsing speed is impressive, great work.</p>
<p>I second Marcel&rsquo;s point. The current interface works well if a processing pipeline starts with a file. However, the parser cannot be used in the middle of a pipeline in a larger system. Without supporting streaming input, materializing large intermediate result clogs the flow. Downloading a file from cloud storage or user-defined document transformations are common scenarios here.</p>
<p>The parser would not have to output incorrect or incomplete documents. It would wait for another chunk of input to continue parsing a document that is in-flight.</p>
</div>
<ol class="children">
<li id="comment-556537" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-29T23:59:25+00:00">October 29, 2020 at 11:59 pm</time></a> </div>
<div class="comment-content">
<p>You write &ldquo;materializing large intermediate&rdquo;, and with that constraint, I agree. But be mindful that large means &ldquo;out of cache&rdquo;, and we have megabytes of cache on current processor cores. For small to medium files, querying cache lines through an interface is an anti-design.</p>
<p>Note that we have since released version 0.6 which introduces a new API that we call On Demand API. So this blog post is somewhat obsolete at this point.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-498817" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f52a99e6bec57a971cbe232b7c5cc49f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f52a99e6bec57a971cbe232b7c5cc49f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">eb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T11:03:02+00:00">April 1, 2020 at 11:03 am</time></a> </div>
<div class="comment-content">
<p>Minor inconsistency in the example: the average tire pressure of the cars will not be what one would expect (only half of it)!</p>
</div>
</li>
<li id="comment-498869" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f35fdbd4e1f1e3d92de7e627085789f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f35fdbd4e1f1e3d92de7e627085789f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex Mikhalev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T16:05:54+00:00">April 1, 2020 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Any plans for Rust bindings?</p>
</div>
<ol class="children">
<li id="comment-498875" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-01T16:36:03+00:00">April 1, 2020 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>There are Rust bindings but help is needed to get it updated:<br/>
<a href="https://github.com/SunDoge/simdjson-rust" rel="nofollow ugc">https://github.com/SunDoge/simdjson-rust</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-518374" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Catherine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:11:25+00:00">May 22, 2020 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>Congrats !</p>
<p>What about a mooc/levure on parsing with C++ ?</p>
</div>
<ol class="children">
<li id="comment-518375" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T20:15:07+00:00">May 22, 2020 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>@Catherine</p>
<p>I have a talk on YouTube, does that count?</p>
<p><a href="https://www.youtube.com/watch?v=wlvKAT7SZIQ" rel="nofollow ugc">https://www.youtube.com/watch?v=wlvKAT7SZIQ</a></p>
</div>
<ol class="children">
<li id="comment-518498" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Catherine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-22T22:28:34+00:00">May 22, 2020 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Great talk and aha moments.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-525928" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T02:47:56+00:00">June 11, 2020 at 2:47 am</time></a> </div>
<div class="comment-content">
<p>By the way, it would be neat to have an ultrafast SIMD JSON <strong>minifier</strong>, something very light in terms of CPU and memory use.</p>
<p>This would presumably be much simpler than a parser, since all it would have to do is strip spaces, tabs, newlines, and carriage returns. Well, it would have to know not to touch the contents of quoted strings.</p>
<p>There&rsquo;s an enormous amount of waste with all the unminified JSON people are slinging around. You can save 10% most of the time by minifying, but there aren&rsquo;t any good minifiers out there.</p>
</div>
<ol class="children">
<li id="comment-525969" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T13:33:48+00:00">June 11, 2020 at 1:33 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>By the way, it would be neat to have an ultrafast SIMD JSON minifier,<br/>
something very light in terms of CPU and memory use.</p>
</blockquote>
<p>But we do have that!!!! It is part of simdjson.</p>
</div>
</li>
</ol>
</li>
<li id="comment-525976" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">José Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T14:09:12+00:00">June 11, 2020 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>Oh nice! Does it minify by default, or is it a flag?</p>
</div>
<ol class="children">
<li id="comment-525982" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T14:46:01+00:00">June 11, 2020 at 2:46 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Oh nice! Does it minify by default, or is it a flag?</p>
</blockquote>
<p>It is a function that you may call on JSON string. It does not parse. It is highly optimized.</p>
<p>It is not currently very well exposed or documented, since it has been updated to be multiplatform only recently.</p>
</div>
</li>
</ol>
</li>
<li id="comment-561186" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c848e4312e9ea7551b2a0755ef61a232?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c848e4312e9ea7551b2a0755ef61a232?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Ryan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-08T00:49:25+00:00">December 8, 2020 at 12:49 am</time></a> </div>
<div class="comment-content">
<p>How&rsquo;s the performance for mobile? E.g Android and iOS devices.<br/>
I&rsquo;m currently using rapidjson for a library that&rsquo;s used for mobile devices and wondering if I should move over to simjson, if it&rsquo;s faster and easier to use.</p>
</div>
<ol class="children">
<li id="comment-561189" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-08T01:05:20+00:00">December 8, 2020 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>We support 64-bit ARM platforms with accelerated kernels. See <a href="https://lemire.me/blog/2019/08/01/a-new-release-of-simdjson-runtime-dispatching-64-bit-arm-support-and-more/" rel="ugc">https://lemire.me/blog/2019/08/01/a-new-release-of-simdjson-runtime-dispatching-64-bit-arm-support-and-more/</a></p>
</div>
</li>
</ol>
</li>
</ol>
