---
date: "2023-11-28 12:00:00"
title: "A simple WebSocket benchmark in Python"
index: false
---

[3 thoughts on &ldquo;A simple WebSocket benchmark in Python&rdquo;](/lemire/blog/2023/11-28-a-simple-websocket-benchmark-in-python)

<ol class="comment-list">
<li id="comment-656411" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/60ee843454e504c164c2dfb30717bafa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/60ee843454e504c164c2dfb30717bafa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sergey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-28T03:55:26+00:00">November 28, 2023 at 3:55 am</time></a> </div>
<div class="comment-content">
<p>Hi Lemire</p>
<p>Did you try Aiohttp as a server?</p>
<p>Also<br/>
I’ve noticed that uvloop wasn’t used. It’s much faster than built in event loop</p>
</div>
<ol class="children">
<li id="comment-656430" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-28T16:41:59+00:00">November 28, 2023 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p><em>Did you try Aiohttp as a server?</em></p>
<p>I did. It is no faster in my tests.</p>
<p><em>I’ve noticed that uvloop wasn’t used. It’s much faster than built in event loop</em></p>
<p>I expect at least sanic to use uvloop by default. That is what their documentation says. They even describe how you can disallow uvloop.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656520" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Twirrim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-30T17:16:06+00:00">November 30, 2023 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>Quick nit: You&rsquo;re missing defining the variable &ldquo;message&rdquo; in the client code you uploaded to github.</p>
<p>pypy saw me go from ~7k to ~11k vs python 3.11 on my laptop using the sanic version (without doing any of the usual stuff around disabling power management etc.)</p>
<p>It looks like both server and client are both at their speed limits, I had to run both client and server under pypy to get the increased speed, if I ran one or the other under python with the counterpart under pypy, I got the same ~7k.</p>
</div>
</li>
</ol>
