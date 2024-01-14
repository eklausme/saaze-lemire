---
date: "2005-10-12 12:00:00"
title: "Logitech USB Desktop Microphone under Linux"
index: false
---

[5 thoughts on &ldquo;Logitech USB Desktop Microphone under Linux&rdquo;](/lemire/blog/2005/10-12-logitech-usb-desktop-microphone-under-linux)

<ol class="comment-list">
<li id="comment-3297" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Herbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-16T14:45:41+00:00">November 16, 2005 at 2:45 pm</time></a> </div>
<div class="comment-content">
<p>I got mine working just plugging it in &#8211; in the sense that KDE recognizes it. But getting skype to work it (even though it sees /dev/dsp1), or to get programs, where you can&rsquo;t choose the source, I haven&rsquo;t gotten it to work.</p>
<p>Skype was the reason to buy this thing (cost me 31,90â‚¬, about 35-40$), and now it doesn&rsquo;t work..</p>
</div>
</li>
<li id="comment-3328" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0bd262eed2ce6403eb2386349fa3f7fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0bd262eed2ce6403eb2386349fa3f7fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Adam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-30T08:24:01+00:00">November 30, 2005 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>you need this:<br/>
<a href="http://195.38.3.142:6502/skype/" rel="nofollow ugc">http://195.38.3.142:6502/skype/</a></p>
</div>
</li>
<li id="comment-3864" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-05T20:05:26+00:00">April 5, 2006 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>Tane: try</p>
<p><code>ls /usr/src/linux/sound/usb/</code></p>
<p>and see what&rsquo;s there.</p>
</div>
</li>
<li id="comment-3863" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aad8d8fc171565e6cda901e59d361595?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aad8d8fc171565e6cda901e59d361595?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tane</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-05T16:39:50+00:00">April 5, 2006 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>I have problems with loading the module snd-usb-audio, i always get this error FATAL: Module snd_usb_audio not found.I have compiled it into my kernel as a module, but i always get this error on start up and when i try to load it manually, i am using kernel version 2.6.15-r1, i hope u can help me with this little problem since u r the only have way decent page i could find. Thanks<br/>
Tane</p>
</div>
</li>
<li id="comment-4548" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c0484b83c34608c15ded7e7730ae5145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c0484b83c34608c15ded7e7730ae5145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">crache</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-06T05:16:08+00:00">May 6, 2006 at 5:16 am</time></a> </div>
<div class="comment-content">
<p>I got this mic and messed around for a bit as well. I&rsquo;ve set up alsa to combine my primary soundcard and the usb capture device. Detailed here:</p>
<p><a href="http://crache.net/2006/05/06/logitech-usb-desktop-microphone-in-linux/" rel="nofollow ugc">http://crache.net/2006/05/06/logitech-usb-desktop-microphone-in-linux/</a></p>
<p>Your post helped as well though!</p>
<p> &#8211;josh</p>
</div>
</li>
</ol>
