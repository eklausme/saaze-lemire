---
date: "2005-02-04 12:00:00"
title: "How to change or modify your Linux kernel under gentoo"
index: false
---

[2 thoughts on &ldquo;How to change or modify your Linux kernel under gentoo&rdquo;](/lemire/blog/2005/02-04-how-to-change-or-modify-your-linux-kernel-under-gentoo)

<ol class="comment-list">
<li id="comment-1164" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e78ba61d5edeb036e8e9827438190f5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e78ba61d5edeb036e8e9827438190f5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Chris Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-10T10:10:50+00:00">February 10, 2005 at 10:10 am</time></a> </div>
<div class="comment-content">
<p>Well, it&rsquo;s a bit challenging.<br/>
I can bring up my prism54 card with WEP well enough under the live CD<br/>
(I position the firmware on a thumb drive, and copy the file to<br/>
/usr/lib/hotplug/firmware/isl3890 after booting), but I have been beaten<br/>
down trying to get genkernel to do the Right Thing for the PCMCIA subsystem.<br/>
This is 2004.3, emerge gentoo-dev-sources, on a Dell D800.<br/>
Thank you for your post, though: genkernel all is apparently too naive for<br/>
my situation.<br/>
The wireless card situation has all the appeal of a winmodem.<br/>
I grasp that the manufacturers have various legal/business reasons for the<br/>
&lsquo;firmware&rsquo; nonsense (what a goofy euphemism), and I understand Linus has a<br/>
Pontius Pilate policy about them, but I hope that the situation can evolve<br/>
to the point that using this hardware under Linux isn&rsquo;t such a flogging for a<br/>
medium-weight geek like me.<br/>
Party!</p>
</div>
</li>
<li id="comment-1201" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Daniel Lemire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-11T23:47:32+00:00">February 11, 2005 at 11:47 pm</time></a> </div>
<div class="comment-content">
<p>Gentoo might not be the best distro in your case. Have you tried Redhat or Mandrake?</p>
</div>
</li>
</ol>
