---
date: "2005-12-20 12:00:00"
title: "Making a Creative Labs Instant Webcam work under Linux"
index: false
---

[4 thoughts on &ldquo;Making a Creative Labs Instant Webcam work under Linux&rdquo;](/lemire/blog/2005/12-20-making-a-creative-labs-instant-webcam-work-under-linux)

<ol class="comment-list">
<li id="comment-3543" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7d3e76d7da6aafa98a801dc60a95f25?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7d3e76d7da6aafa98a801dc60a95f25?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">keith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-12-28T22:29:47+00:00">December 28, 2005 at 10:29 pm</time></a> </div>
<div class="comment-content">
<p>I am currently using SuSE 9.3 Professional. As far as I know &ldquo;emerge&rdquo; command is not available under other distro, except for Gentoo.</p>
<p>Do you know any similar commands to install the driver for spca5xxx driver?</p>
<p>For your information, I have performed lsusb and located my Creative Webcam Instant, almost similar to the line that you had there.</p>
</div>
</li>
<li id="comment-3582" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d8265c296a730ee687c5a33c9f861e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d8265c296a730ee687c5a33c9f861e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">slubek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-13T15:30:31+00:00">January 13, 2006 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>Instead of emerge try &lsquo;apt-get&rsquo; (for Debian) or &lsquo;yum&rsquo; (for Fedora Core)</p>
</div>
</li>
<li id="comment-50115" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0f75e61e55b0ecd0dc24d7d16150af8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0f75e61e55b0ecd0dc24d7d16150af8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">nitz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-08-23T10:07:02+00:00">August 23, 2008 at 10:07 am</time></a> </div>
<div class="comment-content">
<p>From my reading online the spca5xx driver is for older kernerls. to find out the kernel you are useing run this command<br/>
`uname -r`</p>
<p>then if you have Kernel 2.6.11 or newer replace spca5xx with gspcav1 and things shuld work great.</p>
<p># gspcav1 &#8211; Kernel 2.6.11 or newer<br/>
# spca5xx &#8211; Kernel 2.6.11 or older<br/>
I got this infomation from : <a href="http://gentoo-wiki.com/HOWTO_Install_a_webcam" rel="nofollow ugc">http://gentoo-wiki.com/HOWTO_Install_a_webcam</a></p>
</div>
</li>
<li id="comment-72261" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/74239c328f2614b3803e6730b03eaf8c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/74239c328f2614b3803e6730b03eaf8c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zegmaarwim.blogspot.com" class="url" rel="ugc external nofollow">Wim</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-02-17T12:11:02+00:00">February 17, 2013 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for this useful post! I got a Creative Labs Webcam Instant from a friend and am still trying to figure out how to exactly use it on my Debian.</p>
<p>I first found <a href="http://mxhaard.free.fr/download.html" rel="nofollow">this post at LibLand</a> but didn&rsquo;t get it running. Now, by your list of commands helping me to remember the command lsusb , I can at least see that my distro recognizes the webcam. But unfortunately, I have no program to test it.</p>
<p>I hope to get this thing running very soon, thank you 🙂</p>
</div>
</li>
</ol>
