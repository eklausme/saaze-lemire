---
date: "2006-08-21 12:00:00"
title: "Efficient FIFO/Queue data structure in Python"
index: false
---

[2 thoughts on &ldquo;Efficient FIFO/Queue data structure in Python&rdquo;](/lemire/blog/2006/08-21-efficient-fifoqueue-data-structure-in-python)

<ol class="comment-list">
<li id="comment-28314" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1aebaf4fe7c5b3aa038d52f8c6c3301a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1aebaf4fe7c5b3aa038d52f8c6c3301a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">b</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-09T09:28:20+00:00">September 9, 2006 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>Weird, I got the following numbers:</p>
<p>&gt;&gt;&gt; execfile(&lsquo;de.py&rsquo;)</p>
<p>8.79299998283</p>
<p>7.91100001335</p>
<p>9.47399997711</p>
<p>Lists are worse but not that much worse. They might have improved performance of lists, I&rsquo;m running 2.4.3.</p>
</div>
</li>
<li id="comment-28535" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1aebaf4fe7c5b3aa038d52f8c6c3301a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1aebaf4fe7c5b3aa038d52f8c6c3301a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">b</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-10T07:34:36+00:00">September 10, 2006 at 7:34 am</time></a> </div>
<div class="comment-content">
<p>I reran the tests with this code and differencese are indeed massive:</p>
<p>&gt;&gt;&gt; execfile(&lsquo;de2.py&rsquo;)<br/>
&ldquo;&rdquo;<br/>
0.911000013351<br/>
&ldquo;&rdquo;<br/>
0.790999889374<br/>
&ldquo;&rdquo;<br/>
2.06299996376</p>
<p>Increasing iterations of each loop 10 times:</p>
<p>&gt;&gt;&gt; execfile(&lsquo;de2.py&rsquo;)<br/>
&ldquo;&rdquo;<br/>
8.94199991226<br/>
&ldquo;&rdquo;<br/>
8.04200005531<br/>
&ldquo;&rdquo;<br/>
136.887000084</p>
</div>
</li>
</ol>
