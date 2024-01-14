---
date: "2011-12-19 12:00:00"
title: "Compressing document-oriented databases by rewriting your documents"
index: false
---

[5 thoughts on &ldquo;Compressing document-oriented databases by rewriting your documents&rdquo;](/lemire/blog/2011/12-19-compressing-document-oriented-databases-by-rewriting-your-documents)

<ol class="comment-list">
<li id="comment-54836" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-12-19T19:11:00+00:00">December 19, 2011 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>@David </p>
<p>The main drawback, beside implementation complexity, is that it would lower the loading/insert speed.</p>
</div>
</li>
<li id="comment-54838" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-12-19T19:40:22+00:00">December 19, 2011 at 7:40 pm</time></a> </div>
<div class="comment-content">
<p>@David</p>
<p>If you have short names, it may not automatically save much to replace the name (as a string) by a pointer to the name in a dictionary, and it may even take more space (and more memory). It would certainly introduce a (small) computational overhead.</p>
<p>So a more reasonable implementation would only use a dictionary for the long names. </p>
<p>This being said, a clever implementation could end up being superior to what MongoDB currently does.</p>
</div>
</li>
<li id="comment-54835" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ea55c7ce3c4326115b3c8e29b53dac43?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ea55c7ce3c4326115b3c8e29b53dac43?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://drmaciver.com" class="url" rel="ugc external nofollow">David R. MacIver</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-12-19T18:44:22+00:00">December 19, 2011 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>This seems particularly bizarre as I&rsquo;d have thought interning your keys was a really easy storage optimisation to do and would basically always be a large win. Any idea why this isn&rsquo;t done?</p>
</div>
</li>
<li id="comment-54837" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ea55c7ce3c4326115b3c8e29b53dac43?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ea55c7ce3c4326115b3c8e29b53dac43?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://drmaciver.com" class="url" rel="ugc external nofollow">David R. MacIver</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-12-19T19:16:26+00:00">December 19, 2011 at 7:16 pm</time></a> </div>
<div class="comment-content">
<p>Would it really lower the insert speed much? With sensible in memory caching (which is probably free given mongo does everything in memory anyway) the costs of looking up the key would be tiny compared to the cost of writing to disk (and for writes of many objects might win due to less data being written</p>
</div>
</li>
<li id="comment-54840" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/67ad59a6c75a4129f972f0a0ef903ad4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/67ad59a6c75a4129f972f0a0ef903ad4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://gdr.name/" class="url" rel="ugc external nofollow">GDR!</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-12-20T04:48:19+00:00">December 20, 2011 at 4:48 am</time></a> </div>
<div class="comment-content">
<p>The disk space is not that important, but fitting whole database in RAM makes a huge difference in execution speed.</p>
</div>
</li>
</ol>
