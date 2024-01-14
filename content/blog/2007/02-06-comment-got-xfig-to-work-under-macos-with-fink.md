---
date: "2007-02-06 12:00:00"
title: "Got XFig to work under MacOS with fink"
index: false
---

[8 thoughts on &ldquo;Got XFig to work under MacOS with fink&rdquo;](/lemire/blog/2007/02-06-got-xfig-to-work-under-macos-with-fink)

<ol class="comment-list">
<li id="comment-49167" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.seanmcgrath.me/" class="url" rel="ugc external nofollow">Sean McGrath</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-06T15:44:21+00:00">February 6, 2007 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>If you are willing to pay, Omni Graffle is great for diagrams. It should do everything you are looking for (except maybe the Tex formatting).</p>
<p>I find Apple Updates only make you restart if the updates involves the OS, or Quicktime (which is part of the OS).</p>
<p>As for your Finder locking up, I have rearely had that happen myself on my PowerPC powerbooks. Maybe it is an Intel thing.</p>
<p>There must be a way to change the default behavior of control key so you can copy paste with it. Check out this example of changing the key bindings for the home and end keys: <a href="http://chriscraig.net/blog/2006/06/22/key-bindings-on-the-mac/" rel="nofollow ugc">http://chriscraig.net/blog/2006/06/22/key-bindings-on-the-mac/</a></p>
<p>There may be a similar solution for what you are trying to do.</p>
<p>Overall, are you happy with Mac OS? How would you rated it compared to Windows and Linux?</p>
</div>
</li>
<li id="comment-49169" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-06T16:05:36+00:00">February 6, 2007 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p><i> If you are willing to pay, Omni Graffle is great for diagrams. It should do everything you are looking for (except maybe the Tex formatting).</i></p>
<p>Can it run under Linux too? Because I do not want my data to be locked up by proprietary software or proprietary hardware.</p>
<p><i> There must be a way to change the default behavior of control key so you can copy paste with it. </i></p>
<p>No. Apple barely supports X11. It crashed twice today and they have said that they have no intention of fixing the copy and paste. They have a long way to go because their X11 is a port of xfree which is a dead end and has been replaced elsewhere by xorg&#8230; </p>
<p><i> There may be a similar solution for what you are trying to do.</i></p>
<p>Copy and paste is not broken because the keys used are different, it is broken because for it to work, Apple would have needed to do some extra work, like adding a hook for the MacOS clipboard in xfree, which they didn&rsquo;t do.</p>
<p><i><br/>
Overall, are you happy with Mac OS? How would you rated it compared to Windows and Linux?</i></p>
<p>Software-wise, it is clearly inferior both Windows and Linux and that&rsquo;s mostly because of the broken X11. </p>
<p>You know I can run KDE and Gnome applications under MacOS? The same thing is impossible under Windows. But instead of leveraging this, Apple did a half hearted job at porting X11&#8230; and the average Joe can&rsquo;t use a KDE application under MacOS.</p>
<p>What are you left with? Mostly lots and lots of shareware and other payware applications&#8230; all of those lock your data in proprietary format or force you to store serial keys or CDs around. I have been there, done that in the nineties when I was a Windows user. From now on, my data remains free for vendor lock-in, I do not want to have to store serial keys, I do not want to be at the mercy of a single vendor who decides to stop supporting a platform, and so on.</p>
<p>However, hardware-wise, these are beautiful machines that I love.</p>
<p>End result? Linux is a better platform overall. It is more robust, richer, more open, and so on. But MacOS is more fun. I will continue using both.</p>
</div>
</li>
<li id="comment-49170" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-06T16:06:23+00:00">February 6, 2007 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>I do have Adobe Illustrator somewhere&#8230; but it is useless to me. The workflow is different. I do not want to draw I want to diagram, if that&rsquo;s a word. Some people have said that XFig was more of a CAD program.</p>
<p>As for having nicer fonts and shapes&#8230; that is a negative for me. Again, because I do not want to draw pretty pictures. This is not what XFig was designed for.</p>
</div>
</li>
<li id="comment-49166" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4d102649ca02e45a9b0ed6a00ff84804?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4d102649ca02e45a9b0ed6a00ff84804?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wozniak.ca" class="url" rel="ugc external nofollow">Geoff Wozniak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-06T15:40:16+00:00">February 6, 2007 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve always found the figures drawn by XFig to be somewhat ugly. Maybe I&rsquo;m just no good with XFig. 🙂</p>
<p>I like Adobe Illustrator and OmniGraffle, but I don&rsquo;t know if they meet your equation needs. They do have much nicer fonts and crisper looking shapes. I used OmniGraffle to make the images for my latest paper without any trouble. It was quite simple, actually.</p>
<p>Control-A and Command-Left go to the beginning of line and beginning of the visual line, repsectively in Cocoa apps. I don&rsquo;t use X11, but from what you&rsquo;ve said, I doubt those keybindings work there.</p>
</div>
</li>
<li id="comment-49171" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Manor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-07T02:57:45+00:00">February 7, 2007 at 2:57 am</time></a> </div>
<div class="comment-content">
<p>You should try ipe<br/>
<a href="http://tclab.kaist.ac.kr/ipe/" rel="nofollow ugc">http://tclab.kaist.ac.kr/ipe/</a> .<br/>
It&rsquo;s much better than xfig.</p>
</div>
</li>
<li id="comment-49174" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.seanmcgrath.me/" class="url" rel="ugc external nofollow">Sean McGrath</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-09T12:27:56+00:00">February 9, 2007 at 12:27 pm</time></a> </div>
<div class="comment-content">
<p>I stumbled on this today, and thought you may be interested: <a href="http://www.macosxhints.com/article.php?story=20070206110939423" rel="nofollow ugc">http://www.macosxhints.com/article.php?story=20070206110939423</a></p>
</div>
</li>
<li id="comment-49482" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-09-23T06:07:32+00:00">September 23, 2007 at 6:07 am</time></a> </div>
<div class="comment-content">
<p>RE: Somehow, all Apple updates require me to reboot my machine. </p>
<p>I have found that the Software Update application (PPC-machine) gives a menu option to download updates without installing via menu&gt;update&gt;download only. Then you can go back and install the updates at your convenience. The updates are saved in /library/packages.</p>
<p>RE: Apple barely supports X11.</p>
<p>I haven&rsquo;t attempted to use it on Mac except to run MATLAB. I did find a java freeware called jfig that seems to work like xfig. All you need is the java vm which comes with the macOSx anyway. I was up and drawing right after downloading the jFig Bundle for MacOS.<br/>
<a href="http://tech-www.informatik.uni-hamburg.de/applets/jfig/index.html" rel="nofollow ugc">http://tech-www.informatik.uni-hamburg.de/applets/jfig/index.html</a></p>
</div>
</li>
<li id="comment-49483" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/accf266ca6e6339b26f978cbad7c3e95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/accf266ca6e6339b26f978cbad7c3e95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Farhad Farzad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-09-23T06:13:52+00:00">September 23, 2007 at 6:13 am</time></a> </div>
<div class="comment-content">
<p>Last comment was mine; didn&rsquo;t mean to leave it anonymous, only I became frustrated with the spam protection and refreshed the page; then I came to realize you only need the answer and not the complete statement as in the example. However, in my haste, I did not fill in the name category again.</p>
</div>
</li>
</ol>
