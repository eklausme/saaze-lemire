---
date: "2006-09-15 12:00:00"
title: "Operators and, or and xor written in English: is this standard C++?"
index: false
---

[3 thoughts on &ldquo;Operators and, or and xor written in English: is this standard C++?&rdquo;](/lemire/blog/2006/09-15-operators-and-or-and-xor-written-in-english-is-this-standard-c)

<ol class="comment-list">
<li id="comment-30375" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/861237251912d3a0a45f6b0b4506363a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/861237251912d3a0a45f6b0b4506363a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://unosgronchos.blogspot.com/p/peronacho.html" class="url" rel="ugc external nofollow">Ignacio</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-16T21:25:32+00:00">September 16, 2006 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>Even if valid, that&rsquo;s so awful methinks, besides: which operation do you mean? bitwise? logical?</p>
</div>
</li>
<li id="comment-31272" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-19T13:54:24+00:00">September 19, 2006 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>These are standard in C++. If Visual C++ doesn&rsquo;t accept them, it&rsquo;s broken. &ldquo;and&rdquo; means &amp;&amp;, while &amp; would be &ldquo;bitand&rdquo;.</p>
</div>
</li>
<li id="comment-43215" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70c96954cd7c273852c6df6a44dbf248?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70c96954cd7c273852c6df6a44dbf248?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Duke Aaron D'Attention</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-01T06:43:01+00:00">November 1, 2006 at 6:43 am</time></a> </div>
<div class="comment-content">
<p>You should be able to use the following operators (logical then bitwise)&#8230;</p>
<p>and = &amp;&amp;, &amp;<br/>
or = ||, |<br/>
xor = ^</p>
<p>&#8230;without having to include &ldquo;iso646.h&rdquo;. This syntax has always been part of ANSI C right from the outset; it also makes no difference which version of VC++ you are using.</p>
<p>Just ensure that you start a command-line project, as opposed to a Windows-based project, in VC++. This should include the basic headers for you, and won&rsquo;t bloat your code.</p>
<p>Hope this helps.</p>
</div>
</li>
</ol>
