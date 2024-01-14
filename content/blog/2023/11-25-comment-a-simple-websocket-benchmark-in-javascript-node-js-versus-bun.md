---
date: "2023-11-25 12:00:00"
title: "A simple WebSocket benchmark in JavaScript: Node.js versus Bun"
index: false
---

[6 thoughts on &ldquo;A simple WebSocket benchmark in JavaScript: Node.js versus Bun&rdquo;](/lemire/blog/2023/11-25-a-simple-websocket-benchmark-in-javascript-node-js-versus-bun)

<ol class="comment-list">
<li id="comment-656371" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/056e636fac4b96ae394ff707ab7bc5e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/056e636fac4b96ae394ff707ab7bc5e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Devdev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-26T18:29:47+00:00">November 26, 2023 at 6:29 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s the dumbest article I&rsquo;ve read this week, you haven&rsquo;t shown your test data, your test code, the transmission between client -server and worst of all, you haven&rsquo;t shared your configuration of servers/dockers/kubernetes</p>
<p>Articles like those are cancer for dev community.</p>
</div>
<ol class="children">
<li id="comment-656374" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-26T20:15:46+00:00">November 26, 2023 at 8:15 pm</time></a> </div>
<div class="comment-content">
<p>The link is in the blog post. It points at <a href="https://github.com/lemire/jswebsocket_bench" rel="nofollow ugc">https://github.com/lemire/jswebsocket_bench</a></p>
</div>
</li>
<li id="comment-657293" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aea6bf84a1c9f733fe64ebfad5aeba51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aea6bf84a1c9f733fe64ebfad5aeba51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-24T11:12:53+00:00">December 24, 2023 at 11:12 am</time></a> </div>
<div class="comment-content">
<p>Why is there so much anger in your comment?</p>
</div>
</li>
</ol>
</li>
<li id="comment-656377" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/028365cf3295dff77307a372160f048b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/028365cf3295dff77307a372160f048b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rusty</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-27T01:05:52+00:00">November 27, 2023 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>Was initially interested in this article but upon looking at code I see is using ws npm package for both runtimes. If using Bun you&rsquo;d want to use the natively supported websocket server (no dependencies required). It might also be interesting to use the included websocket clients that both Bun the latest node.js release salso has</p>
</div>
</li>
<li id="comment-656387" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b26ec3c2769168c2cbc64cc3df9cdd9c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b26ec3c2769168c2cbc64cc3df9cdd9c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Juho Vepsäläinen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-27T07:34:03+00:00">November 27, 2023 at 7:34 am</time></a> </div>
<div class="comment-content">
<p>It would be interesting to see how Deno fares.</p>
<p>I would expect it to be perhaps somewhere between Node and Bun although it could be slower than Node. At least in the beginning they weren&rsquo;t focused on performance although that may have changed.</p>
</div>
</li>
<li id="comment-656396" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d9c2fc85dfb064d52a682c7db1cf95b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d9c2fc85dfb064d52a682c7db1cf95b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nedgeva</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-27T18:58:08+00:00">November 27, 2023 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Obviously uWebSockets is missing from perf comparison, especially in light where Bun with it&rsquo;s very own ws implementation outshines node&rsquo;s one.</p>
</div>
</li>
</ol>
