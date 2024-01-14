---
date: "2005-11-15 12:00:00"
title: "No loops in Python one-liners?"
index: false
---

[4 thoughts on &ldquo;No loops in Python one-liners?&rdquo;](/lemire/blog/2005/11-15-no-loops-in-python-one-liners)

<ol class="comment-list">
<li id="comment-3436" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9968da3ce53bbbbe4c8743a32f772390?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9968da3ce53bbbbe4c8743a32f772390?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-12-11T14:48:55+00:00">December 11, 2005 at 2:48 pm</time></a> </div>
<div class="comment-content">
<p><a href="http://www.unixuser.org/~euske/pyone/" rel="nofollow">PyOne&gt;</p>
<p>It converts a given script to properly indented Python code and executes it. If a single expression is given it simply eval it and displays the the retuen value.</a></p>
</div>
</li>
<li id="comment-3867" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">FlÃ¡vio Coelho</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-06T07:34:26+00:00">April 6, 2006 at 7:34 am</time></a> </div>
<div class="comment-content">
<p>You can do loops in the form of list comprehensions.</p>
<p>import sys,os,re,fileinput;a=[i[2] for i in os.walk(&lsquo;.&rsquo;) if i[2]] [0];[sys.stdout.write(re.sub(&lsquo;at&rsquo;,&rsquo;op&rsquo;,j)) for j in fileinput(a,inplace=1)]</p>
<p>Careful with this one though, it will edit files on your path without prompt!</p>
<p>Cheers!</p>
</div>
</li>
<li id="comment-396549" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87c37555ef88333ebf714abb63734876?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87c37555ef88333ebf714abb63734876?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">parry_all</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-21T21:52:32+00:00">March 21, 2019 at 9:52 pm</time></a> </div>
<div class="comment-content">
<p>You can do this:</p>
<p><code>for i in [1, 2, 3, 4, 5]: print(i)<br/>
</code></p>
</div>
</li>
<li id="comment-501110" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b713d76a68338e1a1d00ad0045c8717f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b713d76a68338e1a1d00ad0045c8717f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dana</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-14T02:24:03+00:00">April 14, 2020 at 2:24 am</time></a> </div>
<div class="comment-content">
<p>or this way..</p>
<p><code>python -c $'import os\nfor i in os.listdir("."): print i'<br/>
</code></p>
</div>
</li>
</ol>
