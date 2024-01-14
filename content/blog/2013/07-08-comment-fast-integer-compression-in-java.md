---
date: "2013-07-08 12:00:00"
title: "Fast integer compression in Java"
index: false
---

[8 thoughts on &ldquo;Fast integer compression in Java&rdquo;](/lemire/blog/2013/07-08-fast-integer-compression-in-java)

<ol class="comment-list">
<li id="comment-89636" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Itman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-09T06:19:42+00:00">July 9, 2013 at 6:19 am</time></a> </div>
<div class="comment-content">
<p>I was recently contemplating on whether I should use Java for algorithmic programming and I came to a conclusion. Java is not good. I mean it is great if you consider the number of libraries available. The performance is generally good. Yet, if you need top-notch performance, it is quite hard to get in Java. You would need to use awful things like manual memory management and parallel arrays&#8230;. This is awful and counterproductive. You can do much better in C++. But, if you don&rsquo;t mind 2-3x loss in performance Java (Scala, or, say, OCaml) can be a nice choice.</p>
</div>
</li>
<li id="comment-89635" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-09T05:48:20+00:00">July 9, 2013 at 5:48 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;The assumption is that most (but not all) values in your array use less than 32 bits.&rdquo;<br/>
I think this statement belongs in this post, otherwise nothing makes sense.</p>
</div>
</li>
<li id="comment-89642" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-09T08:25:31+00:00">July 9, 2013 at 8:25 am</time></a> </div>
<div class="comment-content">
<p>@Anonymous</p>
<p>Thanks for pointing out a shortcoming in my post. However, we do not make this assumption. Instead, we just assume that the integers have been sorted. I have edited the post accordingly.</p>
</div>
</li>
<li id="comment-89643" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-09T08:30:35+00:00">July 9, 2013 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>What is true is that there is a whole range of optimizations that are simply not possible in Java (by design).</p>
</div>
</li>
<li id="comment-89654" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eae790503a48a8b0f7c392c6a5152cc9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eae790503a48a8b0f7c392c6a5152cc9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ishan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-09T14:17:56+00:00">July 9, 2013 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>Does it support streaming compression as integers keep appearing in the stream?</p>
</div>
</li>
<li id="comment-89658" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-07-09T15:41:24+00:00">July 9, 2013 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>@Ishan</p>
<p>You can compress and uncompress data in blocks&#8230; See the &ldquo;advanced&rdquo; example in the example.java file:</p>
<p><a href="https://github.com/lemire/JavaFastPFOR/blob/master/example.java" rel="nofollow ugc">https://github.com/lemire/JavaFastPFOR/blob/master/example.java</a></p>
<p>So, yes, I would say that you can building streaming applications using this library.</p>
</div>
</li>
<li id="comment-209627" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40d4bb2f7a66c6eccc011c41854aa6d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40d4bb2f7a66c6eccc011c41854aa6d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-20T22:24:53+00:00">November 20, 2015 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>*noob here</p>
<p>I want to ask you for advice about compressing integers. I have integers in range 0-255 so each of them is 8-bit long. Which compresor schould I use? JavaFastPFOR is only for &ldquo;in memory&rdquo; compress right?</p>
</div>
<ol class="children">
<li id="comment-209629" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-20T22:48:01+00:00">November 20, 2015 at 10:48 pm</time></a> </div>
<div class="comment-content">
<p>The best strategy is to try various codecs and see which one works best for your data. There is no need to guess.</p>
<p>The library is low-level and won&rsquo;t handle issues such as writing data to disk.</p>
</div>
</li>
</ol>
</li>
</ol>
