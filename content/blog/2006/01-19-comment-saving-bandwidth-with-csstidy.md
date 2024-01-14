---
date: "2006-01-19 12:00:00"
title: "Saving Bandwidth with CSSTidy"
index: false
---

[8 thoughts on &ldquo;Saving Bandwidth with CSSTidy&rdquo;](/lemire/blog/2006/01-19-saving-bandwidth-with-csstidy)

<ol class="comment-list">
<li id="comment-3625" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce56978a238760a1bc56fc25aa24d3f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce56978a238760a1bc56fc25aa24d3f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://gonze.com/rel-me/" class="url" rel="ugc external nofollow">Lucas Gonze</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-02T13:15:38+00:00">February 2, 2006 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>I have used the Flumpcakes optimzer for quite a while and like it too much to change to CSS Tidy.</p>
</div>
</li>
<li id="comment-3650" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a00847ed024654a446c317072aefa7a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a00847ed024654a446c317072aefa7a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Matt Sephton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-14T06:55:10+00:00">February 14, 2006 at 6:55 am</time></a> </div>
<div class="comment-content">
<p>Your example is wrong, as nom has a background colour of black. Therfore, CSSTidy and Flumpcake produce identical results.</p>
<p>Even after correcting your error, both produce the same output &#8211; still not the same as your manual solution.</p>
<p>Or am I missing something?</p>
</div>
</li>
<li id="comment-3651" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-14T09:19:23+00:00">February 14, 2006 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>Matt: The solution I give, minus the mistake you point out, is exactly what Flumpcake gives me. Of course, you&rsquo;ve got to turn all Flumpcake optimization on.</p>
</div>
</li>
<li id="comment-3652" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a00847ed024654a446c317072aefa7a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a00847ed024654a446c317072aefa7a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt Sephton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-14T09:31:58+00:00">February 14, 2006 at 9:31 am</time></a> </div>
<div class="comment-content">
<p>Thanks. I did not tick the &ldquo;group styles&rdquo; box.</p>
</div>
</li>
<li id="comment-3653" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a00847ed024654a446c317072aefa7a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a00847ed024654a446c317072aefa7a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt Sephton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-14T09:38:47+00:00">February 14, 2006 at 9:38 am</time></a> </div>
<div class="comment-content">
<p>Thanks. I did not check the &ldquo;group styles&rdquo; box.</p>
</div>
</li>
<li id="comment-3666" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e0047d1829396570c1cb621f59950f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e0047d1829396570c1cb621f59950f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.alamy.com/stock-photography/3FD6BE5B-7DCF-46F5-BFDF-6CF5EEDCF113/Constantin%20Moisei.html" class="url" rel="ugc external nofollow">MC Moisei</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-27T13:41:31+00:00">February 27, 2006 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>Shouldn&rsquo;t the last generated paragraph should be first ?</p>
<p>montant, nom, texte {<br/>
background: white;<br/>
font-style: normal;<br/>
}</p>
<p>For example if later on need to make nom&rsquo;s background red how do I do it ? How is the inheritance applied here, isn&rsquo;t it defined by the order of the defined classes ?</p>
</div>
</li>
<li id="comment-3667" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e0047d1829396570c1cb621f59950f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e0047d1829396570c1cb621f59950f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.alamy.com/stock-photography/3FD6BE5B-7DCF-46F5-BFDF-6CF5EEDCF113/Constantin%20Moisei.html" class="url" rel="ugc external nofollow">MC Moisei</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-27T13:48:57+00:00">February 27, 2006 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>One thing about optimizers, if the css file is pretty big after optimizing it it may be difficult to read it especially if you use the &ldquo;group styles&rdquo; option.</p>
</div>
</li>
<li id="comment-3668" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-27T14:10:14+00:00">February 27, 2006 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>No,</p>
<p>A,B,C {<br/>
}</p>
<p>is the same as</p>
<p>C,B,A {<br/>
}</p>
<p>There is no inheritance here&#8230;</p>
<p>You are getting mixed up with</p>
<p>A B C {<br/>
}</p>
<p>which is *not* the same as</p>
<p>C B A {<br/>
}</p>
</div>
</li>
</ol>
