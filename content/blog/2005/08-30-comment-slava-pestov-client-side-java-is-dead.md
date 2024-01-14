---
date: "2005-08-30 12:00:00"
title: "Slava Pestov : Client-side Java is dead"
index: false
---

[5 thoughts on &ldquo;Slava Pestov : Client-side Java is dead&rdquo;](/lemire/blog/2005/08-30-slava-pestov-client-side-java-is-dead)

<ol class="comment-list">
<li id="comment-2452" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-08-30T17:47:36+00:00">August 30, 2005 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>Randy: I don&rsquo;t think there is anything fundamentally wrong about Java regarding client-side. It is a terribly verbose language: just like C++. But people design decent C++ client-side applications. However, the implementation just sucks. For years, Swing didn&rsquo;t support French (or most international) keyboards under Linux. Wait&#8230; did I write Swing? No, Swing under a Sun JVM, because but IBM and Blackdown had no problem with international keyboards. The truth is that Sun failed Java, at least as far as desktop Java is concerned.</p>
<p>What&rsquo;s the alternative? I think AJAX is still too hard, but if we could do it elegantly and easily, then it would eventually replace most business applications.</p>
<p>For most things, a web-based applications does just fine. We just need a bit more maturity.</p>
</div>
</li>
<li id="comment-2453" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand Tony Darugar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-08-30T18:27:19+00:00">August 30, 2005 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>Agree that AJAX is too hard right now; I have access to AJAX experts who did an evaluation of converting one of our Java clients to AJAX, and they unanimously declared it too hard. Give it another year or three and we may be closer.</p>
<p>I haven&rsquo;t tried C# myself, but as a user I&rsquo;ve observed apps written to microsoft platforms performa much better than those written to other APIs. They&rsquo;re just more snappy. I consider C# a good option right now.</p>
<p>It&rsquo;s amazing how badly Sun has botched the UI side of Java, from the terrible first releases of AWT, thru Swing, and apparently continued in their new releases, although I stopped caring quite a while back. Funny thing is, when Java AWT was coming out Sun also had Tcl/Tk, which provided a very usable UI platform. If they&rsquo;d only married the two, we&rsquo;d be in a happier place today.</p>
</div>
</li>
<li id="comment-2454" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-08-30T18:51:39+00:00">August 30, 2005 at 6:51 pm</time></a> </div>
<div class="comment-content">
<p>Parand: Sun suffers from a not-invented-here syndrome. 😉</p>
</div>
</li>
<li id="comment-2451" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/136ca937a2bc63c2cf5ecd00f9989c70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/136ca937a2bc63c2cf5ecd00f9989c70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Randy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-08-30T17:02:18+00:00">August 30, 2005 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>So what should we use to develop GUI applications?</p>
<p>If you&rsquo;re only thinking of developing apps for Windows, then C# is the most fun language available to develop GUI Windows apps.</p>
<p>Cross-platform? Well, the blogosphere is hyping web-based applications that make use of AJAX&#8230; Web-based apps are cross-platform, but are they as cool as desktop apps? In my opinion, no they aren&rsquo;t.</p>
<p>Check out wxWidgets, I think it&rsquo;s a cross-platform solutions for developing desktop applications.</p>
</div>
</li>
<li id="comment-21459" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ada57cae52f7d2d11bd29c33bd16c8b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ada57cae52f7d2d11bd29c33bd16c8b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.greengiraffesolutions.blogspot.com/" class="url" rel="ugc external nofollow">Erwin Katz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-08-14T11:55:02+00:00">August 14, 2006 at 11:55 am</time></a> </div>
<div class="comment-content">
<p>Java Client is far from dead. Swing is having a huge resurgence as businesses realise the benefits of thick client. Most top investment banks use Swing as an interface to their trading systems. IntelliJ IDEA is an amazing Swing app. There is such pure ignorance that pervades peoples thinking on Java Client.</p>
</div>
</li>
</ol>
