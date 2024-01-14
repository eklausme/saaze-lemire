---
date: "2004-11-08 12:00:00"
title: "Funny differences between Mysql and Postgresql"
index: false
---

[4 thoughts on &ldquo;Funny differences between Mysql and Postgresql&rdquo;](/lemire/blog/2004/11-08-funny-differences-between-mysql-and-postgresql)

<ol class="comment-list">
<li id="comment-345" class="trackback even thread-even depth-1">
<div class="comment-body">
Pingback: <a href="https://josephscott.org/archives/2004/11/mysqls-funny-math/" class="url" rel="ugc external nofollow">Joseph Scott's Blog</a> </div>
</li>
<li id="comment-346" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f027bbba0fec2ba9126385681361406c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f027bbba0fec2ba9126385681361406c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2004-11-09T12:20:03+00:00">November 9, 2004 at 12:20 pm</time></a> </div>
<div class="comment-content">
<p>Regarding the rounding of 0.5, I was also taught that it should round to 1. But what about 1.5? I would guess that Daniel was taught that it rounds to 2; I was taught that it also rounds to 1. I learned this in lab courses in undergraduate physics. The general rule was (is) that if the digit to the immediate left of the positition being rounded is even, round up; otherwise round down. The rationale is that otherwise, on average, you will end up<br/>
rounding up more often than down, skewing results slightly.</p>
</div>
</li>
<li id="comment-347" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f027bbba0fec2ba9126385681361406c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f027bbba0fec2ba9126385681361406c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2004-11-09T12:23:47+00:00">November 9, 2004 at 12:23 pm</time></a> </div>
<div class="comment-content">
<p>Hmm. Should have tried it BEFORE posting the last comment so as to avoid having to post another. It looks to me like MySQL follows a similar rounding rule, but with even/odd reversed: if the preceding digit is odd, round up; otherwise round down. So, for example, 1.5 and 2.5 both round to 2.</p>
</div>
</li>
<li id="comment-390" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/407fb36bbf6a01e151680be9f408b5af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/407fb36bbf6a01e151680be9f408b5af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://josephscott.org/" class="url" rel="ugc external nofollow">Joseph Scott</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2004-11-10T11:30:19+00:00">November 10, 2004 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>As to why MySQL rounds the way it does, that was directly from the MySQL docs. I didn&rsquo;t really but it either, but it looks like that is their &ldquo;official&rdquo; explanation.</p>
</div>
</li>
</ol>
