---
date: "2017-01-27 12:00:00"
title: "How expensive are the union and intersection of two unordered_set in C++?"
index: false
---

[16 thoughts on &ldquo;How expensive are the union and intersection of two unordered_set in C++?&rdquo;](/lemire/blog/2017/01-27-how-expensive-are-the-union-and-intersection-of-two-unordered_set-in-c)

<ol class="comment-list">
<li id="comment-268703" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b60bca5476cfee54d072fc5023e45b38?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b60bca5476cfee54d072fc5023e45b38?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">bsf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-28T03:30:34+00:00">January 28, 2017 at 3:30 am</time></a> </div>
<div class="comment-content">
<p>It would have been cool to compare std::map and std::set, as these are ordered by design but have the pointer chasing issues.</p>
</div>
<ol class="children">
<li id="comment-268704" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b60bca5476cfee54d072fc5023e45b38?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b60bca5476cfee54d072fc5023e45b38?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">bsf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-28T03:32:59+00:00">January 28, 2017 at 3:32 am</time></a> </div>
<div class="comment-content">
<p>Or are you not including the time spent to insert() in your measurements? That&rsquo;s a little confusing.</p>
<p>If I have to add the elements to a set in order to sort them (by your proposed algorithm) then we should be including that time.</p>
<p>Anyways, if you are including insert time then it doesn&rsquo;t compare a plain prepopulated set, and if you aren&rsquo;t including insert time then the numbers are not totally correct.</p>
<p>I think</p>
</div>
<ol class="children">
<li id="comment-268709" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-28T04:02:22+00:00">January 28, 2017 at 4:02 am</time></a> </div>
<div class="comment-content">
<p><em>Or are you not including the time spent to insert() in your measurements? That&rsquo;s a little confusing.</em></p>
<p>I think I describe the benchmark accurately, and I provide the full source code that you can review. There should be no confusion.</p>
<p>The test is as follow: take two objects of some class (<tt>std::vector</tt>, <tt>std::set</tt>, <tt>std::unordered_set</tt>) and produce a new one of the same class that represents either the union or the intersection.</p>
<p>So, we do not include the time necessary to create the original two sets, but we measure the time required to create either the intersection or the union.</p>
<p>Obviously, you can question whether it is &ldquo;fair&rdquo; but that becomes subjective.</p>
</div>
</li>
</ol>
</li>
<li id="comment-268707" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-28T03:54:35+00:00">January 28, 2017 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>I have updated my code and the blog post to include results with <tt>std::set</tt>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-268767" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/457c9206354c61388c3f811b0945a412?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/457c9206354c61388c3f811b0945a412?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-28T15:32:48+00:00">January 28, 2017 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried a flat_set implementation? I&rsquo;d imagine it would avoid some of the data locality cost.</p>
</div>
<ol class="children">
<li id="comment-269040" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T15:11:16+00:00">January 30, 2017 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>I have not tested Boost&rsquo;s <tt>flat_set</tt>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-268828" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd31ec80478a31167be81b9e81add45c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd31ec80478a31167be81b9e81add45c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alanwj</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-28T22:27:27+00:00">January 28, 2017 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>You need to tell us which implementation of C++ you used for any benchmarks to be meaningful.</p>
<p>It would also be interesting to run your benchmarks on several implementations and compare results.</p>
</div>
<ol class="children">
<li id="comment-269037" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T15:03:22+00:00">January 30, 2017 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p><em>You need to tell us which implementation of C++ you used for any benchmarks to be meaningful.<br/>
It would also be interesting to run your benchmarks on several implementations and compare results.</em></p>
<p>I do a lot better than that&#8230; I provide my source code so that you can get your own numbers quickly.</p>
</div>
</li>
</ol>
</li>
<li id="comment-268898" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathias Gaunard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-29T13:27:13+00:00">January 29, 2017 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>That comparison is pretty meaningless.<br/>
Of course set_intersection is faster. The costly operation here is sorting.</p>
<p>But still, an unordered_set is a different thing than a sorted array, it is optimized for lookup, not merging.</p>
</div>
<ol class="children">
<li id="comment-269035" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T14:56:31+00:00">January 30, 2017 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p><em>The costly operation here is sorting.</em></p>
<p>There is no sorting done in the case of <tt>unordered_set</tt>.</p>
<p><em>But still, an unordered_set is a different thing than a sorted array, it is optimized for lookup, not merging.</em></p>
<p>I agree but I am not sure it is a priori obvious to the programmer.</p>
</div>
</li>
<li id="comment-269066" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://iki.fi/jouni.siren/" class="url" rel="ugc external nofollow">Jouni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T19:02:05+00:00">January 30, 2017 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>Sorting integers is actually pretty cheap. I got something like 4-10 cycles/element, depending on the contents of the array.</p>
<p>The lesson is that random memory accesses are expensive, and it&rsquo;s hard to avoid them in a data structure that supports updates.</p>
<p>Mutable data structures are optimized for latency. If you&rsquo;re more interested in throughput, batch processing with sorted arrays can easily be an order of magnitude faster.</p>
</div>
</li>
</ol>
</li>
<li id="comment-269070" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T19:53:11+00:00">January 30, 2017 at 7:53 pm</time></a> </div>
<div class="comment-content">
<p><em>Mutable data structures are optimized for latency. If you&rsquo;re more interested in throughput, batch processing with sorted arrays can easily be an order of magnitude faster.</em></p>
<p>Yes.</p>
</div>
</li>
<li id="comment-427962" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ae31c2cfd89881ee52f7e1e97420439d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ae31c2cfd89881ee52f7e1e97420439d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sami</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-20T08:06:29+00:00">September 20, 2019 at 8:06 am</time></a> </div>
<div class="comment-content">
<p>Comment avez vous fait pour calculer le nombre de cycles? Il y&rsquo;a une option dans le compilateur qui permet ça?<br/>
Merci</p>
</div>
<ol class="children">
<li id="comment-428021" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-20T15:36:30+00:00">September 20, 2019 at 3:36 pm</time></a> </div>
<div class="comment-content">
<p>Je vous invite à consulter mon code source.</p>
</div>
</li>
</ol>
</li>
<li id="comment-583826" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1629487ddf943f62c682c846b4954e06?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1629487ddf943f62c682c846b4954e06?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ciprian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-11T21:40:12+00:00">May 11, 2021 at 9:40 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>I have read your source code.<br/>
setunion could be improved by copying one of the sets (the larger, obviously, though in your code the two sets have the same size) instead of &ldquo;insert&rdquo;ing it front to back.<br/>
I don&rsquo;t know what sort of code is generated behind for std::set intersection and union, but generic stuff like the example possible implementations shown on en.cppreference.com will work exceptionally bad for BSTs. And that&rsquo;s on top of BSTs (std::set is usually a red/black tree) being particularly unsuited for such operations. In fact, if I&rsquo;d ever want to intersect/join two std::sets, I&rsquo;d probably copy them to std::vectors (no need of sorting), do the operation on the latter and bulkload somehow the result to the output std::set.</p>
</div>
<ol class="children">
<li id="comment-583830" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-11T22:22:53+00:00">May 11, 2021 at 10:22 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>setunion could be improved by copying one of the sets (the larger, obviously, though in your code the two sets have the same size) instead of “insert”ing it front to back.</p>
</blockquote>
<p>Yes. It is still going to be slow, but your proposal would help make it a bit less terrible.</p>
</div>
</li>
</ol>
</li>
</ol>
