---
date: "2009-07-03 12:00:00"
title: "Column stores and row stores: should you care?"
index: false
---

[3 thoughts on &ldquo;Column stores and row stores: should you care?&rdquo;](/lemire/blog/2009/07-03-column-stores-and-row-stores-should-you-care)

<ol class="comment-list">
<li id="comment-51202" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4443b09ffb634fb76994d519521b047?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4443b09ffb634fb76994d519521b047?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-03T17:24:54+00:00">July 3, 2009 at 5:24 pm</time></a> </div>
<div class="comment-content">
<p>One claim that caught my attention was compressibility in column oriented databases: the column stores tend to compress very well, significantly increasing IO bandwidth (x number of bytes from disk translates to &gt;&gt; x number of bytes of actual data). Since most DBs are IO bound, this turns out to provide a big real-world performance advantage. What do you think?</p>
</div>
</li>
<li id="comment-51204" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-03T18:05:47+00:00">July 3, 2009 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>@Parand</p>
<p>Yes, but &ldquo;most DBs are IO bound&rdquo; is not the entire explanation. Here are two finer points:</p>
<p>A) It is not all that true. </p>
<p>On this blog (search for it), I have run experiments showing that parsing CSV files was easily CPU bound. Of course, you have to define properly what &ldquo;parsing&rdquo; means&#8230; I mean here to find the strings, then copy them into some data structure.</p>
<p>That is why databases use relatively &ldquo;cheap&rdquo; compression techniques. Going out of your way to squeeze the data down might be counterproductive. Compression is not everything.</p>
<p>Thankfully, column-oriented designs allow &ldquo;cheap&rdquo; compression techniques to work well. Basically, you sort the data (a relatively cheap operation) and then you then you apply run-length encoding.</p>
<p>B) Compression is not only about reducing IO costs.</p>
<p>As an example, is it faster to compute the sum of:</p>
<p>111122222<br/>
or<br/>
4&#215;1, 5&#215;2<br/>
?</p>
<p>Clearly, it is faster to compute the sum of the &ldquo;compressed&rdquo; array. So compression can also save CPU cycles when *you are operating directly over the compressed data stream*. Whenever you need to load the data in RAM, then uncompress it, and then work over the uncompressed data, you have to worry that you will overload your memory bandwidth.</p>
</div>
</li>
<li id="comment-51203" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9a1ce0b75918ac8c05ae1e83ebeab69?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9a1ce0b75918ac8c05ae1e83ebeab69?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://thenoisychannel.com/" class="url" rel="ugc external nofollow">Daniel Tunkelang</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-07-03T17:36:09+00:00">July 3, 2009 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>Indeed, compressibility seemed to be a major advantage they observed in using a column store vs. in Hadoop. Wasn&rsquo;t at all clear to me what that was / should be the case.</p>
</div>
</li>
</ol>
