---
date: "2022-06-06 12:00:00"
title: "Data structure size and cache-line accesses"
index: false
---

[3 thoughts on &ldquo;Data structure size and cache-line accesses&rdquo;](/lemire/blog/2022/06-06-data-structure-size-and-cache-line-accesses)

<ol class="comment-list">
<li id="comment-647713" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d02e5f67a43f9e3317e26caa1c443aa6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d02e5f67a43f9e3317e26caa1c443aa6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">dirtysalt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-23T06:05:46+00:00">November 23, 2022 at 6:05 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s quite bit counter-intuitive. </p>
<p>Take size=2 for example, the offset could be any random value. If address span is [63, 64], then we touch 2 cache lines. So size = 2 can not be 1.0.</p>
<p>I write a python script to compute expected cache line access</p>
<p>def expected_access(size):<br/>
C = 64 # Cache line size<br/>
ss = []<br/>
for off in range(0, C): # offset could be random value.<br/>
a = off // C<br/>
b = (off + size &#8211; 1) // C<br/>
ss.append(b &#8211; a + 1) # access b-a+1 cache lines<br/>
return sum(ss) / len(ss) # compute average </p>
<p>and 2 bytes expected value is 1.015625, 32 bytes expected value is 1.484375.</p>
</div>
<ol class="children">
<li id="comment-647756" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-23T15:07:24+00:00">November 23, 2022 at 3:07 pm</time></a> </div>
<div class="comment-content">
<p>If you have a 2-byte value, and you lay it out in a packed array as described in the blog post, you will never have a 2-byte value covering two cache lines.</p>
<p>I think that you are considering a different model where you put your values anywhere in memory (at a random address).</p>
<p>Then I suspect that the probability of an overlap is <tt>min(1-(64-x+1)/64,1)</tt>.</p>
</div>
<ol class="children">
<li id="comment-647805" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d02e5f67a43f9e3317e26caa1c443aa6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d02e5f67a43f9e3317e26caa1c443aa6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dirtysalt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-24T01:30:47+00:00">November 24, 2022 at 1:30 am</time></a> </div>
<div class="comment-content">
<p>Thanks, I misunderstand your model. I&rsquo;ll try it later.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
