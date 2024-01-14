---
date: "2008-09-05 12:00:00"
title: "Speed up Python without effort using generator expressions"
index: false
---

[3 thoughts on &ldquo;Speed up Python without effort using generator expressions&rdquo;](/lemire/blog/2008/09-05-speed-up-python-without-effort-using-generator-expressions)

<ol class="comment-list">
<li id="comment-50129" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2bec02e8103bede57545b00b47d6953?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2bec02e8103bede57545b00b47d6953?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Carlos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-05T11:30:36+00:00">September 5, 2008 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>Not only that, but expression 2 doesn&rsquo;t leak a variable!</p>
<p>$ python<br/>
Python 2.5.2 (r252:60911, Feb 22 2008, 07:57:53)<br/>
[GCC 4.0.1 (Apple Computer, Inc. build 5363)] on darwin<br/>
Type &ldquo;help&rdquo;, &ldquo;copyright&rdquo;, &ldquo;credits&rdquo; or &ldquo;license&rdquo; for more information.<br/>
&gt;&gt;&gt; i<br/>
Traceback (most recent call last):<br/>
File &ldquo;&rdquo;, line 1, in<br/>
NameError: name &lsquo;i&rsquo; is not defined<br/>
&gt;&gt;&gt; sum([i for i in xrange(100000)])<br/>
4999950000L<br/>
&gt;&gt;&gt; i<br/>
99999<br/>
&gt;&gt;&gt; sum(j for j in xrange(100000))<br/>
4999950000L<br/>
&gt;&gt;&gt; j<br/>
Traceback (most recent call last):<br/>
File &ldquo;&rdquo;, line 1, in<br/>
NameError: name &lsquo;j&rsquo; is not defined<br/>
&gt;&gt;&gt;</p>
</div>
</li>
<li id="comment-50157" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-19T10:53:15+00:00">September 19, 2008 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>Running code through cProfile is not fair since it adds an overhead for each function call.</p>
<p>Run these commands instead:</p>
<p>echo &ldquo;sum([x for x in xrange(1000000)])&rdquo; > t1.py</p>
<p>echo &ldquo;sum((x for x in xrange(1000000)))&rdquo; > t2.py</p>
<p>python t1.py</p>
<p>python t2.py</p>
</div>
</li>
<li id="comment-50156" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/924a4dc5b4e63c54d3e1f4aeb7b95b56?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/924a4dc5b4e63c54d3e1f4aeb7b95b56?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andres</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-19T09:47:22+00:00">September 19, 2008 at 9:47 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel!<br/>
Reading this post I try myself to do it. The results were not the same as you, I post it here. I work on python and I think that is correct that this happens, because generators in some operations are more expensive that simple list. when you have to read a big file generators are the solution, but in other cases lists are the solution!</p>
<p>cProfile.run(&lsquo;sum((x for x in xrange(1000000)))&rsquo;)<br/>
1000004 function calls in 1.305 CPU seconds</p>
<p> Ordered by: standard name</p>
<p> ncalls tottime percall cumtime percall filename:lineno(function)<br/>
1000001 0.565 0.000 0.565 0.000 :1()<br/>
1 0.000 0.000 1.305 1.305 :1()<br/>
1 0.000 0.000 0.000 0.000 {method &lsquo;disable&rsquo; of &lsquo;_lsprof.Profiler&rsquo; objects}<br/>
1 0.740 0.740 1.305 1.305 {sum}</p>
<p>cProfile.run(&lsquo;sum([x for x in xrange(1000000)])&rsquo;)<br/>
3 function calls in 0.540 CPU seconds</p>
<p> Ordered by: standard name</p>
<p> ncalls tottime percall cumtime percall filename:lineno(function)<br/>
1 0.357 0.357 0.540 0.540 :1()<br/>
1 0.000 0.000 0.000 0.000 {method &lsquo;disable&rsquo; of &lsquo;_lsprof.Profiler&rsquo; objects}<br/>
1 0.182 0.182 0.182 0.182 {sum}</p>
</div>
</li>
</ol>
