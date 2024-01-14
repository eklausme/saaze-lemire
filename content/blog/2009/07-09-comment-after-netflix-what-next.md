---
date: "2009-07-09 12:00:00"
title: "After Netflix? What next?"
index: false
---

[7 thoughts on &ldquo;After Netflix? What next?&rdquo;](/lemire/blog/2009/07-09-after-netflix-what-next)

<ol class="comment-list">
<li id="comment-51218" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b465642dfa8c42643a0f499b2142a21?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b465642dfa8c42643a0f499b2142a21?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://top-domains.ch/domain/b-tec.ch" class="url" rel="ugc external nofollow">marcel blattner</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-10T06:22:28+00:00">July 10, 2009 at 6:22 am</time></a> </div>
<div class="comment-content">
<p>Hi all<br/>
What about research on the upper performance limit of RC systems? If there is a good model, telling you the performance expectations for a given setup (&lsquo;data topology&rsquo;) according certain metrics and methods,we can slow down with the trial and error procedures. I think it would give us new inputs and insights..<br/>
Cheers<br/>
Marcel</p>
</div>
</li>
<li id="comment-51219" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed7e4cf9e8ba22e8a8f7e4e01e036708?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed7e4cf9e8ba22e8a8f7e4e01e036708?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sylvie Noel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-10T07:56:58+00:00">July 10, 2009 at 7:56 am</time></a> </div>
<div class="comment-content">
<p>Testing user satisfaction should be fairly straightforward. I&rsquo;d use a before/after method, with same people in the two conditions. You can either directly ask people how good the recommendations are, or you can do a behavioural approach, where you ask people to click on the items that interest them and see if there are more items in the after than in the before.</p>
</div>
</li>
<li id="comment-51220" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-10T08:33:45+00:00">July 10, 2009 at 8:33 am</time></a> </div>
<div class="comment-content">
<p>@blattner</p>
<p>From a Machine Learning perspective, it is likely to be extremely difficult to compute such a bound on the accuracy. Unless you specify what type of algorithm you are allowed to use or can make some assumption about the data. Indeed, it is always possible that there is some unknown exotic structure within the data that can be exploited. How do you prove that there is no such structure? Hard.</p>
<p>From a practical user perspective, we can obviously bound the accuracy by how well human beings can guess their own ratings. Frankly, when I got back to my past ratings, I am sometimes surprised by how highly or lowly I rated certain items. However, this &ldquo;accuracy&rdquo; will depend on the user and its context. For example, maybe one person always give a rating of 3 to all items, no matter what. In this case, clearly, it is easy to make perfect predictions. Other users will be more frivolous, changing their minds from day to day. So, it is unlikely that there is some universal constant regarding the unaccuracy out there.</p>
</div>
</li>
<li id="comment-51221" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3b465642dfa8c42643a0f499b2142a21?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3b465642dfa8c42643a0f499b2142a21?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://top-domains.ch/domain/b-tec.ch" class="url" rel="ugc external nofollow">marcel blattner</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-10T09:27:42+00:00">July 10, 2009 at 9:27 am</time></a> </div>
<div class="comment-content">
<p>@lemire<br/>
I agree on your thoughts about &ldquo;self-correlation&rdquo; (see also <a href="http://www.apparentwind.com/navigation/videos.html" rel="nofollow ugc">http://www.apparentwind.com/navigation/videos.html</a> section Reliability).<br/>
However, as a physicist I believe in simple, but controllable models. I think on can do pretty much :-). One big class of algorithms use an overlap based approach (common rated items between users, or common audiance shared by two objects in question). For such a class we could do some assumptions: the way people rate objects depends obviously on what prior information they have about objects they rate. Let&rsquo;s take movies: everybody does a pre-selection and is influenced by many sources. So the probability density over the rating space is clearly influenced by that fact. And I would expect a right shifted (gaussian?) distribution over the rating space. Furthermore we could setup different ways (distributions) what movie will be rated by a user. From these simple facts only, we could do a small model and compute the expected error (i.e. RMS) for different levels of correlation.<br/>
Now take something like jokes. You don&rsquo;t have any prior information when somebody is telling you a joke. So I would expect a much broader distribution over the rating space. And indeed, when I compare movielens and jester distributions, they differ in that manner. I don&rsquo;t think we could built a model telling us the whole story about every RC system. But I think we could do a good one, telling if a certain method makes sense in a particular situation (data).<br/>
cheers<br/>
Marcel</p>
</div>
</li>
<li id="comment-51222" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-10T09:42:56+00:00">July 10, 2009 at 9:42 am</time></a> </div>
<div class="comment-content">
<p>@blattner</p>
<p>Interesting take on the subject.</p>
</div>
</li>
<li id="comment-51223" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd180bbb9fdc0c5692f2428e3a9ad008?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd180bbb9fdc0c5692f2428e3a9ad008?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://synthesis.williamgunn.org" class="url" rel="ugc external nofollow">Mr. Gunn</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-14T23:30:01+00:00">July 14, 2009 at 11:30 pm</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t been following this real closely, but are any of the winning algorithms actually cheap enough for Netflix to use in production?</p>
</div>
</li>
<li id="comment-51224" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-15T08:28:48+00:00">July 15, 2009 at 8:28 am</time></a> </div>
<div class="comment-content">
<p>@Gunn</p>
<p>This is a valid question. Netflix will probably not put these algo. in practice &ldquo;as-is&rdquo; due to scalability and business reasons.</p>
</div>
</li>
</ol>
