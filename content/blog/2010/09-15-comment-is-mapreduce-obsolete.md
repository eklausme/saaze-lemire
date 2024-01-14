---
date: "2010-09-15 12:00:00"
title: "Is MapReduce obsolete?"
index: false
---

[7 thoughts on &ldquo;Is MapReduce obsolete?&rdquo;](/lemire/blog/2010/09-15-is-mapreduce-obsolete)

<ol class="comment-list">
<li id="comment-53802" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d7bcda27533da25e5e0183de67b2206?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d7bcda27533da25e5e0183de67b2206?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Seb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-15T08:41:03+00:00">September 15, 2010 at 8:41 am</time></a> </div>
<div class="comment-content">
<p>It does seem like we need methods that refine incrementally. </p>
<p>With the effervescence of activity in social media (many true experts now getting into that game) and increasingly rapid creation of new knowledge, models, and frameworks, knowledge is becoming obsolete faster and it seems like it is more and important to know about activity that occurs in the present, even as it builds on the past.</p>
</div>
</li>
<li id="comment-53803" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d7bcda27533da25e5e0183de67b2206?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d7bcda27533da25e5e0183de67b2206?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Seb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-15T08:43:37+00:00">September 15, 2010 at 8:43 am</time></a> </div>
<div class="comment-content">
<p>(My argument is that there is a necessary coevolution between search and the kind of fine-grained open collaboration that is now emerging on the Web.)</p>
</div>
</li>
<li id="comment-53804" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-15T10:00:15+00:00">September 15, 2010 at 10:00 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s true you don&rsquo;t want to use a system designed for large scale batch processing for tasks that aren&rsquo;t large scale batch processing.</p>
<p>For example, there was an article a while back talking about how GMail ran into problems because the data storage was ultimately layered on top of GFS, which isn&rsquo;t designed for random access workloads:</p>
<p><a href="https://glinden.blogspot.com/2010/03/gfs-and-its-evolution.html" rel="nofollow ugc">http://glinden.blogspot.com/2010/03/gfs-and-its-evolution.html</a></p>
<p>That being said, I think the Register article is badly overstated. Incremental index updates are run out of Bigtable, but full index rebuilds are probably still run out of MapReduce/GFS. Moreover, Bigtable itself is layered on top of GFS.</p>
</div>
</li>
<li id="comment-53805" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-15T11:44:22+00:00">September 15, 2010 at 11:44 am</time></a> </div>
<div class="comment-content">
<p>1. Stonebraker IMHO create a huge mess. Because map-reduce is nowhere close to a database system. All this comparison does not make much sense.</p>
<p>2. Most data is still static. Dynamic data, of course, needs special treatment.</p>
</div>
</li>
<li id="comment-53806" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e8dc52828af38c3237267bfd1718f75f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e8dc52828af38c3237267bfd1718f75f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.snailinaturtleneck.com" class="url" rel="ugc external nofollow">kristina</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-15T14:56:29+00:00">September 15, 2010 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p>Google insiders&rsquo; reactions to that article was &ldquo;What? That&rsquo;s a weird reading. Buh? Lipkovitz was misquoted!&rdquo; and &ldquo;what a crappy article.&rdquo;</p>
<p>The article is, apparently, very misleading and, in places, downright wrong. Google built something cool and new, but in no way are they moving away from MapReduce.</p>
<p>And, on a personal note, Stonebraker seems like an ass.</p>
</div>
</li>
<li id="comment-53807" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc63116d2e524f50dd976e86fc504e8c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc63116d2e524f50dd976e86fc504e8c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rome</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-16T00:54:45+00:00">September 16, 2010 at 12:54 am</time></a> </div>
<div class="comment-content">
<p>I know exactly what happens but can&rsquo;t say because of NDA, the article is not far away from truth.</p>
</div>
</li>
<li id="comment-53825" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28c969628040ef5f0d44b0080b598514?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28c969628040ef5f0d44b0080b598514?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">arkady</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-09-25T14:38:54+00:00">September 25, 2010 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>(a) MapReduce is a wonderful tool for a large open class of problems.<br/>
(b) from the very start, Google had other ways to run distributed processing atop GFS (not just MapReduce)<br/>
(c) if I believed in conspiracy theories, I&rsquo;d state that the original Google&rsquo;s paper about MapReduce was a smart decoy to create a confusion among &ldquo;fast followers&rdquo; and send them on a wrong trail by downplaying the importance of GFS (compared to MapReduce).<br/>
One of the reasons of Hadoop&rsquo;s success is that (unlike other similar attempt) it focused on its file system from the very start.</p>
</div>
</li>
</ol>
