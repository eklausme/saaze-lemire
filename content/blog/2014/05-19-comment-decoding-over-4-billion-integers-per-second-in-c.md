---
date: "2014-05-19 12:00:00"
title: "Decoding over 4 billion integers per second in C"
index: false
---

[8 thoughts on &ldquo;Decoding over 4 billion integers per second in C&rdquo;](/lemire/blog/2014/05-19-decoding-over-4-billion-integers-per-second-in-c)

<ol class="comment-list">
<li id="comment-126750" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce759cf4c4a1ec23558a0e592e523c14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce759cf4c4a1ec23558a0e592e523c14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-19T14:13:51+00:00">May 19, 2014 at 2:13 pm</time></a> </div>
<div class="comment-content">
<p>Excellent. Very easy to use! Thanks!</p>
</div>
</li>
<li id="comment-126776" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5ffde6fe345b8db1a14c4393e41aac8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5ffde6fe345b8db1a14c4393e41aac8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-19T16:30:11+00:00">May 19, 2014 at 4:30 pm</time></a> </div>
<div class="comment-content">
<p>Has FastPFOR been used/evaluated in a real contex such as lucene text search?</p>
</div>
<ol class="children">
<li id="comment-591775" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28fcb5736d668a79c0c3ab9a288ff8e9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28fcb5736d668a79c0c3ab9a288ff8e9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://manticoresearch.com/" class="url" rel="ugc external nofollow">Sergey Nikolaev</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-23T03:30:57+00:00">July 23, 2021 at 3:30 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s used in <a href="https://github.com/manticoresoftware/columnar" rel="nofollow ugc">https://github.com/manticoresoftware/columnar</a> which can be used with Manticore Search &#8211; <a href="https://github.com/manticoresoftware/manticoresearch/" rel="nofollow ugc">https://github.com/manticoresoftware/manticoresearch/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-126919" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-20T08:10:15+00:00">May 20, 2014 at 8:10 am</time></a> </div>
<div class="comment-content">
<p>@anonymous</p>
<p>Lucene uses what is effectively the FastPFOR algorithm <a href="http://lucene.apache.org/core/4_6_1/core/org/apache/lucene/util/PForDeltaDocIdSet.html" rel="nofollow">inspired by the JavaFastPFOR library</a>. As for using the C++ library, I do not know if it is practical since Lucene is written in Java.</p>
</div>
</li>
<li id="comment-128448" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">powturbo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-28T05:07:20+00:00">May 28, 2014 at 5:07 am</time></a> </div>
<div class="comment-content">
<p>In my tests SIMD bitpacking offer no speed advantage over optimized scalar bitpacking when used with large buffers (see simplebenchmark in FastPFor). This is valable for most applications (ex. inverted index). A realistic benchmark should compare SIMD/Scalar bitpacking only on large buffers.</p>
</div>
</li>
<li id="comment-128461" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-28T08:16:13+00:00">May 28, 2014 at 8:16 am</time></a> </div>
<div class="comment-content">
<p>@powturbo </p>
<p>If you are going to take the data from RAM, bring it all the way to L1 cache, load it in registers, then push it out all the back to RAM&#8230; you are IO bound&#8230; your CPU runs empty and so, saving CPU cycles becomes irrelevant. To make things worse, you can pretty much forget about using more than one core because your L3 cache is going to be overwhelmed by one core.</p>
<p>So? So you avoid decompressing whole arrays to RAM.</p>
<p>We have demonstrated directly the benefit of SIMD bit packing in our latest paper (see <a href="http://arxiv.org/abs/1401.6399" rel="nofollow ugc">http://arxiv.org/abs/1401.6399</a>).</p>
</div>
</li>
<li id="comment-128611" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec878e44d9b54308745fddee07d7b777?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec878e44d9b54308745fddee07d7b777?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Garen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-30T15:59:10+00:00">May 30, 2014 at 3:59 pm</time></a> </div>
<div class="comment-content">
<p>If you&rsquo;re out of disk-space, is there a way to handle updates in a way that won&rsquo;t require additional scratch space?</p>
</div>
</li>
<li id="comment-128616" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-05-30T16:43:08+00:00">May 30, 2014 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>@Garen</p>
<p>This particular library does not handle disk storage at all (by design). However, there is no particular problem with updates and this library. In fact, it compresses super fast so recompressing updating blocks should be quite fast.</p>
</div>
</li>
</ol>
