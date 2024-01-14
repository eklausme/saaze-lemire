---
date: "2019-07-26 12:00:00"
title: "How fast can a BufferedReader read lines in Java?"
index: false
---

[35 thoughts on &ldquo;How fast can a BufferedReader read lines in Java?&rdquo;](/lemire/blog/2019/07-26-how-fast-can-a-bufferedreader-read-lines-in-java)

<ol class="comment-list">
<li id="comment-420271" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://j2eeguys.com" class="url" rel="ugc external nofollow">Steve Davidson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T01:58:29+00:00">July 27, 2019 at 1:58 am</time></a> </div>
<div class="comment-content">
<p>You might want to retry using an StringBuilder rather than a mutex locked StringBuffer. This should get you serious performance increase.</p>
</div>
<ol class="children">
<li id="comment-420353" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T13:15:08+00:00">July 27, 2019 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>I am not benchmarking anything having to do with a StringBuffer.</p>
</div>
<ol class="children">
<li id="comment-420557" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7383784f2c5e6fccb908469f3a11e33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7383784f2c5e6fccb908469f3a11e33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jamesabley.com/" class="url" rel="ugc external nofollow">James Abley</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T12:20:13+00:00">July 28, 2019 at 12:20 pm</time></a> </div>
<div class="comment-content">
<p>BufferedReader internally uses a StringBuffer, which from my reading can be safely swapped out for a StringBuilder.</p>
<p>I seem to get an improvement in performance from using a patched BufferedReader with that change.</p>
<p>Code to be published later:</p>
<p><code>Benchmark Mode Cnt Score Error Units<br/>
MyBenchmark.stdLibBufferedReader thrpt 25 29.542 ± 0.599 ops/s<br/>
MyBenchmark.patchedStdLibBufferedReader thrpt 25 33.426 ± 0.108 ops/s<br/>
MyBenchmark.stringLines thrpt 25 87.141 ± 1.155 ops/s<br/>
</code></p>
<p>I&rsquo;ll check the OpenJDK project to see whether that&rsquo;s a reasonable change.</p>
</div>
<ol class="children">
<li id="comment-420877" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve Davidson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T18:35:49+00:00">July 29, 2019 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s an overdue change.</p>
</div>
</li>
<li id="comment-420889" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve Davidson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T19:55:14+00:00">July 29, 2019 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>Let me know if assistance is needed &#8212; the Java NIO Package is using BufferedReader as well and the Mutex locks in StringBuffer is causing nasty and unnecessary performance hits.</p>
</div>
</li>
<li id="comment-420896" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7383784f2c5e6fccb908469f3a11e33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7383784f2c5e6fccb908469f3a11e33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jamesabley.com/" class="url" rel="ugc external nofollow">James Abley</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T21:20:25+00:00">July 29, 2019 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://github.com/jabley/java-bufferedreader-perf" rel="nofollow">Published my code</a>.</p>
<p>Still waiting for the thing I reported on <a href="https://bugs.java.com/" rel="nofollow ugc">https://bugs.java.com/</a> to be reviewed and published.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-420287" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43fd6613d4a0cb9bd716c49fa61b529f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43fd6613d4a0cb9bd716c49fa61b529f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jay.askren.net" class="url" rel="ugc external nofollow">Jay Askren</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T04:08:33+00:00">July 27, 2019 at 4:08 am</time></a> </div>
<div class="comment-content">
<p>BufferedReader is probably the most common way of reading files but it is also the slowest as shown by Martin Thompson: <a href="https://mechanical-sympathy.blogspot.com/2011/12/java-sequential-io-performance.html" rel="nofollow ugc">https://mechanical-sympathy.blogspot.com/2011/12/java-sequential-io-performance.html</a></p>
</div>
<ol class="children">
<li id="comment-420354" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T13:15:39+00:00">July 27, 2019 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>It is certainly not the slowest! Using Scanner over a raw file is far slower.</p>
</div>
<ol class="children">
<li id="comment-420360" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43fd6613d4a0cb9bd716c49fa61b529f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43fd6613d4a0cb9bd716c49fa61b529f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jay.askren.net" class="url" rel="ugc external nofollow">Jay Askren</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T14:21:27+00:00">July 27, 2019 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s fair. Should have said one of the slowest.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-420312" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14a4d8a678d1c29376ba16cc3fd043fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14a4d8a678d1c29376ba16cc3fd043fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T09:35:03+00:00">July 27, 2019 at 9:35 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;the default buffer size is 8192 characters capacity. Line size is considered as 80 chars capacity.&rdquo;<br/>
form the javaDoc:<br/>
<a href="http://www.docjar.com/html/api/java/io/BufferedReader.java.html" rel="nofollow ugc">http://www.docjar.com/html/api/java/io/BufferedReader.java.html</a></p>
<p>you maybe resize it.</p>
</div>
<ol class="children">
<li id="comment-420361" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43fd6613d4a0cb9bd716c49fa61b529f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43fd6613d4a0cb9bd716c49fa61b529f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jay.askren.net" class="url" rel="ugc external nofollow">Jay Askren</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T14:23:15+00:00">July 27, 2019 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>Good catch. I bet that would speed it up.</p>
</div>
<ol class="children">
<li id="comment-420371" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T15:11:28+00:00">July 27, 2019 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>The ideal buffer size and line size aren&rsquo;t really related. The buffer size is for reading large(ish) chunks of the file which are then parsed into lines. Selecting the buffer size is mostly a function of system call overhead versus the desire to keep stuff in L1. I have repeatedly found 8K to be a sweet spot, although that was pre-Meltdown/Spectre which might have pushed the ideal buffer size up.</p>
</div>
</li>
</ol>
</li>
<li id="comment-420384" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/952b0f7a357e4c95acc7e4716cbb7f68?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/952b0f7a357e4c95acc7e4716cbb7f68?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mt3o</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T17:09:19+00:00">July 27, 2019 at 5:09 pm</time></a> </div>
<div class="comment-content">
<p>You should try resizing the buffer to different sizes and rerun the benchmark. There is no magic behind buffered reader, everything is synchronous and it&rsquo;s filling with data once the buffer is emptied.</p>
</div>
</li>
</ol>
</li>
<li id="comment-420357" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7383784f2c5e6fccb908469f3a11e33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7383784f2c5e6fccb908469f3a11e33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jamesabley.com/" class="url" rel="ugc external nofollow">James Abley</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T13:52:46+00:00">July 27, 2019 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p>Using String.lines in JDK 11 gives me 2 or 3 times better performance.</p>
</div>
</li>
<li id="comment-420362" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T14:27:13+00:00">July 27, 2019 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the point of this post? Java is not easier to write [than C or C++], probably harder, one needs [to have installed] a VM and it&rsquo;s slow, so what&rsquo;s to like?</p>
</div>
<ol class="children">
<li id="comment-420379" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/546aa70b73e6758a48f7762ec3367cef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/546aa70b73e6758a48f7762ec3367cef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">folderk</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T16:36:42+00:00">July 27, 2019 at 4:36 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
<em>What’s the point of this post? Java is not easier to write [than C or C++], probably harder, one needs [to have installed] a VM and it’s slow, so what’s to like?</em>
</p></blockquote>
<p>Java is much easier to write than C or C++ (for one, you don&rsquo;t have to manually manage memory, and for second, it has much less corner points and nuances than C++), it&rsquo;s plenty fast for most tasks (and on par with C/C++ on some), and installing a VM is a non issue.</p>
<p>So you comment in wrong in each and every statement it makes&#8230;</p>
</div>
<ol class="children">
<li id="comment-420600" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T15:29:39+00:00">July 28, 2019 at 3:29 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
for one, you don’t have to manually manage memory, and for second, it has much less corner points and nuances than C++.
</p></blockquote>
<p>Using RAII and smart pointers does away with manual memory management, forget C with classes, we moved on from there.</p>
<p>Yes, it&rsquo;s subtle and one needs to master it, it does not in itself mean it&rsquo;s hard to write [and it got simpler to write fast code since C++1 and following std updates].</p>
<p>I don&rsquo;t need to ask my user to install the JVM, that seems like a major advantage.</p>
</div>
</li>
<li id="comment-420601" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T15:32:25+00:00">July 28, 2019 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Forgot the most important bit, it is 2 times [with the optimizations in some of the other answers, 4 as posted] than plain C++. That&rsquo;s the difference between google needing a mere 500&rsquo;000 servers [to conduct its business] as compared to 1&rsquo;000&rsquo;000.</p>
</div>
</li>
</ol>
</li>
<li id="comment-420423" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30de25d1d65da4ea6756cbe43a384530?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30de25d1d65da4ea6756cbe43a384530?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Foster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T23:55:21+00:00">July 27, 2019 at 11:55 pm</time></a> </div>
<div class="comment-content">
<p>What is the point of your comment? I get you don&rsquo;t like Java, but it&rsquo;s hardly relevant to the speed of I/O.</p>
</div>
</li>
<li id="comment-420470" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/919234aee8cfb614d8fe67d01ea11289?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve Davidson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T02:17:08+00:00">July 28, 2019 at 2:17 am</time></a> </div>
<div class="comment-content">
<p>Folks like you have been providing about 1/2 the work that I get, so THANKS! Java WAS slow, in the 90&rsquo;s and early 2000&rsquo;s. JIT around 2000 &amp; the Runtime Profiler&rsquo;s and Optimizers introduced around 2005 made Java quite performant. And there are lots of &ldquo;extras&rdquo; that the VM is providing if you are doing anything that needs Database, XML, WebServices, or any other non-trivial application.</p>
</div>
</li>
</ol>
</li>
<li id="comment-420375" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8a332144e976bfadf2f97c9a4310146?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8a332144e976bfadf2f97c9a4310146?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">onkobu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T15:47:22+00:00">July 27, 2019 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>Ever tried Files.readAllLines? <a href="https://docs.oracle.com/javase/8/docs/api/java/nio/file/Files.html#readAllLines-java.nio.file.Path-" rel="nofollow">enter link description here</a></p>
</div>
</li>
<li id="comment-420383" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d926cfbc54a290052c2bb0b7acbea183?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d926cfbc54a290052c2bb0b7acbea183?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/jhorstmann23" class="url" rel="ugc external nofollow">Jörn</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T17:01:00+00:00">July 27, 2019 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>In contrast to the C getline function, BufferedReader.readLine and BufferedReader.lines does not include the newline character in the returned strings. It looks like you are building a huge one-lined string in scanFile, which would lead to repeated resizing of the read buffer later on.</p>
</div>
<ol class="children">
<li id="comment-420653" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d926cfbc54a290052c2bb0b7acbea183?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d926cfbc54a290052c2bb0b7acbea183?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/jhorstmann23" class="url" rel="ugc external nofollow">Jörn</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T19:42:56+00:00">July 28, 2019 at 7:42 pm</time></a> </div>
<div class="comment-content">
<p>I played around with the code some more and the above suggestion does not really improve the performance as much as I thought. There is still too much copying of string contents happening.</p>
<p>Using the indexOf/substring loop mentioned on hackernews gets the performance to about 2x the original, but substring is still creating copies. (This actually changed in java7, earlier it would create a view holding on to the original string contents which was deemed to be bad for memory consumption.)</p>
<p>Using subsequence and changing parseLine to accept a CharSequence sounds like it should work, but behaves exactly the same as substring due to backwards compatibility, the subsequence method just delegates to substring.</p>
<p>The one thing that gave a huge improvement was to implement a custom CharSequence implementation which does no copying and create that in an indexof loop. With that approach I finally got to about 2GB/s on this haswell laptop.</p>
<p>So I completely agree with your point, java can be fast, but you&rsquo;d have to know exactly what you&rsquo;re doing. And often the standard library works against you.</p>
<p>Modified code is available at <a href="https://gist.github.com/jhorstmann/9dcdc3c26a26e4ad6f513128942a47d9" rel="nofollow ugc">https://gist.github.com/jhorstmann/9dcdc3c26a26e4ad6f513128942a47d9</a></p>
</div>
<ol class="children">
<li id="comment-420702" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T01:05:12+00:00">July 29, 2019 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>Thanks for sharing your code.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-420390" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69229fcd3f4bf012faa51db42e6fb768?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69229fcd3f4bf012faa51db42e6fb768?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Louis St-Amour</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T17:45:02+00:00">July 27, 2019 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>Further comments on this post at <a href="https://news.ycombinator.com/item?id=20542023" rel="nofollow ugc">https://news.ycombinator.com/item?id=20542023</a> include a potential optimization to the benchmark which might reduce the slowdown from 4x to just twice as slow.</p>
</div>
</li>
<li id="comment-420466" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T01:46:47+00:00">July 28, 2019 at 1:46 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m Java illiterate, but there&rsquo;s a comment on HN (<a href="https://news.ycombinator.com/item?id=20542438" rel="nofollow ugc">https://news.ycombinator.com/item?id=20542438</a>) that suggests you might not be measuring what you think you are measuring. Specifically, the author says that the call to lines() in your preprocessing step (L19) strips all the newlines, so that when you concatenate the results together with append() you are creating a single 23MB &ldquo;line&rdquo;. I&rsquo;m not sure if it affects your conclusion, but given that your benchmarking is over a foreach loop, presumably this wasn&rsquo;t your intent?</p>
<p>It was also suggested (I think usefully) that a few more details about the test environment would be helpful to evaluate your result. While you mention it in the linked earlier post, it would probably help to say again which machine, which version of Java, which C++ compiler, and so forth so that the post is more standalone.</p>
</div>
<ol class="children">
<li id="comment-420703" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T01:10:00+00:00">July 29, 2019 at 1:10 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>you might not be measuring what you think you are measuring</p>
</blockquote>
<p>There was a typo in an earlier version of my code, but this was quickly corrected. It turns out not to affect the result&#8230; or, at least, not the conclusion.</p>
<blockquote>
<p>which version of Java, which C++ compiler, and so forth so that the<br/>
post is more standalone.</p>
</blockquote>
<p>I&rsquo;ll add more details but I think that this is somewhat nitpicking unless one can show that they consistently get 3 GB/s parsing text files in Java. That is, I provide an <em>example</em> that I view as &lsquo;representative&rsquo; or &lsquo;credible&rsquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-420713" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T04:04:39+00:00">July 29, 2019 at 4:04 am</time></a> </div>
<div class="comment-content">
<p>Related&#8230;<br/>
<a href="http://bannister.us/weblog/2008/why-fileinputstream-is-slow" rel="nofollow ugc">http://bannister.us/weblog/2008/why-fileinputstream-is-slow</a></p>
</div>
<ol class="children">
<li id="comment-420817" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T13:46:39+00:00">July 29, 2019 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for sharing. Note that we have much faster disks today than in 2008.</p>
</div>
</li>
</ol>
</li>
<li id="comment-420752" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/db9af190aae5fe1d946f35c84303377e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/db9af190aae5fe1d946f35c84303377e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Craig Macdonald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T09:49:01+00:00">July 29, 2019 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>Have you tried?</p>
<p><code>String s = null; while( (s = br.readLine()) != null) { parseLine(s); }<br/>
</code></p>
<p>I wonder how much overhead there in the streams.</p>
</div>
<ol class="children">
<li id="comment-420813" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-29T13:41:42+00:00">July 29, 2019 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>Yes&#8230; see the code repository.</p>
<p>It seems that streams have some overhead, maybe&#8230; but it is small.</p>
</div>
</li>
</ol>
</li>
<li id="comment-429826" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3902e59b30139010a9a19c1159764fcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3902e59b30139010a9a19c1159764fcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tagir Valeev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T03:17:40+00:00">October 2, 2019 at 3:17 am</time></a> </div>
<div class="comment-content">
<p>Please note that BufferedReader.lines is smarter than getline: it supports any line delimiters: &lsquo;\n&rsquo;, &lsquo;\r&rsquo; or &lsquo;\r\n&rsquo; while getline supports only &lsquo;\n&rsquo;. Clearly having more tests per each character adds some overhead. Though I would pay this overhead, rather than having garbage result if the input file comes from Windows. As it was mentioned above, use String.split(&lsquo;\n&rsquo;) if you specifically need &lsquo;\n&rsquo;.</p>
</div>
<ol class="children">
<li id="comment-429827" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3902e59b30139010a9a19c1159764fcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3902e59b30139010a9a19c1159764fcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tagir Valeev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T03:23:22+00:00">October 2, 2019 at 3:23 am</time></a> </div>
<div class="comment-content">
<p>Oh, sorry, String.split(&lsquo;\n&rsquo;) was not mentioned above, and probably it&rsquo;s not the best solution as it would allocate all the strings at once.</p>
</div>
</li>
</ol>
</li>
<li id="comment-429904" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/033726ace72804fcf9a9a60a0801d303?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/033726ace72804fcf9a9a60a0801d303?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ismael Juma</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T02:41:59+00:00">October 3, 2019 at 2:41 am</time></a> </div>
<div class="comment-content">
<p>FYI, a small improvement was done in OpenJDK as a result of this blog post:</p>
<p><a href="https://bugs.openjdk.java.net/browse/JDK-8229022" rel="nofollow ugc">https://bugs.openjdk.java.net/browse/JDK-8229022</a></p>
<p>Ismael</p>
</div>
<ol class="children">
<li id="comment-429939" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T10:13:21+00:00">October 3, 2019 at 10:13 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the pointer.</p>
</div>
</li>
</ol>
</li>
</ol>
