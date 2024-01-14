---
date: "2005-10-28 12:00:00"
title: "Comments are back! But you need to pass a reverse Turing test!"
index: false
---

[6 thoughts on &ldquo;Comments are back! But you need to pass a reverse Turing test!&rdquo;](/lemire/blog/2005/10-28-comments-are-back-but-you-need-to-pass-a-reverse-turing-test)

<ol class="comment-list">
<li id="comment-3248" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://expert-opinion.blogspot.com/" class="url" rel="ugc external nofollow">Michael Stiber</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-10-28T20:08:35+00:00">October 28, 2005 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>Great to see your comments are back! They&rsquo;re what make blogs more interesting than plain old web pages.</p>
</div>
</li>
<li id="comment-3249" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99cc12547377fdec39231922cd5ac49a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99cc12547377fdec39231922cd5ac49a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.boriel.com/en/" class="url" rel="ugc external nofollow">Boriel</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-10-29T06:35:52+00:00">October 29, 2005 at 6:35 am</time></a> </div>
<div class="comment-content">
<p>Nice to see you&rsquo;re using captcha! 🙂</p>
<p>Thanks for your suggestions.<br/>
I didn&rsquo;t want to change the original hn_captcha class. That&rsquo;s why I used tmp and ttf folders that way. But you&rsquo;re right:</p>
<p>Some other people have told me about TTF slash and tmp directory. </p>
<p>TTF Folder can be (not tested, but should work) in any directory readable by Apache/PHP, but TMP directory must be inside the apache published directories, because the image is served as a jpg. 😕</p>
<p>I was thinking of showing the image &ldquo;on the fly&rdquo; with a php script, so the TMP could be anywhere in the filesystem (and not into the www) or even not necessary at all.</p>
<p>If you&rsquo;re interested, I will tell you, and again, Thanks. 🙂</p>
</div>
</li>
<li id="comment-3254" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2989a3f5004eb74588a9d7ad00eebb1c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2989a3f5004eb74588a9d7ad00eebb1c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Leavitt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-01T17:15:17+00:00">November 1, 2005 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p>I ran into the same problem with ImageMagick, and installed this instead. Nice. Works cleanly. Agree that it would be better if I could use a system TMP directory rather than a WWW accessible one.</p>
<p>Thomas</p>
</div>
</li>
<li id="comment-3255" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-01T17:49:36+00:00">November 1, 2005 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Ido:</p>
<p>You have to insure your directory structure lies inside a www directory. To get this result, say your web directory is&#8230;</p>
<p>/something/HTTP/&#8230;</p>
<p>then do</p>
<p>ln -s /something/HTTP /something/www</p>
<p>In your case, your problem seems more complex&#8230; for example, it tells me the image is at&#8230;.</p>
<p>/opt/www/dubrawsky_org/tmp/hn_captcha_075efa.jpg</p>
<p>But I&rsquo;ve tried the following URLs and can&rsquo;t find it&#8230;</p>
<p><a href="http://www.dubrawsky.org/tmp/hn_captcha_075efa.jpg" rel="nofollow ugc">http://www.dubrawsky.org/tmp/hn_captcha_075efa.jpg</a></p>
<p><a href="http://www.dubrawsky.org/dubrawsky_org/tmp/hn_captcha_075efa.jpg" rel="nofollow ugc">http://www.dubrawsky.org/dubrawsky_org/tmp/hn_captcha_075efa.jpg</a></p>
<p>So, I&rsquo;m not sure what you are saying when you say that the &ldquo;the DOCUMENT_ROOT is /opt/www/dubrawsky_org&rdquo;, if so, the first URL should work. Have you set permissions right?</p>
</div>
</li>
<li id="comment-3253" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8ea59d1829d4b20b384c82cc5d8bc7be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8ea59d1829d4b20b384c82cc5d8bc7be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.dubrawsky.org" class="url" rel="ugc external nofollow">Ido Dubrawsky</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-01T16:45:08+00:00">November 1, 2005 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>What exactly did you do to get around the problem with the directory structure? When you go to the URL for my website (<a href="http://www.dubrawsky.org" rel="nofollow ugc">http://www.dubrawsky.org</a>) the DOCUMENT_ROOT is /opt/www/dubrawsky_org and captcha doesn&rsquo;t seem to want to work. I&rsquo;m interested to know how you got around the problem.</p>
</div>
</li>
<li id="comment-3258" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8ea59d1829d4b20b384c82cc5d8bc7be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8ea59d1829d4b20b384c82cc5d8bc7be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.dubrawsky.org" class="url" rel="ugc external nofollow">Ido Dubrawsky</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-02T09:12:29+00:00">November 2, 2005 at 9:12 am</time></a> </div>
<div class="comment-content">
<p>I found the problem. For reasons I don&rsquo;t know the gd library didn&rsquo;t get compiled with jpeg support. I actually had to recompile the jpeg library first (it didn&rsquo;t include the set_jpeg_defaults() function call for some reason), then the gd library, then PHP and re-install PHP and now everything works great. Thanks for the help!</p>
</div>
</li>
</ol>
