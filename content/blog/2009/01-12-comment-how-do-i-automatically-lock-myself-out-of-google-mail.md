---
date: "2009-01-12 12:00:00"
title: "How do I automatically lock myself out of Google Mail?"
index: false
---

[7 thoughts on &ldquo;How do I automatically lock myself out of Google Mail?&rdquo;](/lemire/blog/2009/01-12-how-do-i-automatically-lock-myself-out-of-google-mail)

<ol class="comment-list">
<li id="comment-50545" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebec6abd2b9f1eb4de865aed01242171?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebec6abd2b9f1eb4de865aed01242171?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://mendicantbug.com" class="url" rel="ugc external nofollow">Jason Adams</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-12T13:19:45+00:00">January 12, 2009 at 1:19 pm</time></a> </div>
<div class="comment-content">
<p>There is a Google labs add-on that lets you &ldquo;take a break&rdquo;, effectively locking Gmail for 15 minutes. Of course, you have to actually hit the button to activate it, so it&rsquo;s not a complete solution.</p>
</div>
</li>
<li id="comment-50546" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9a1ce0b75918ac8c05ae1e83ebeab69?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9a1ce0b75918ac8c05ae1e83ebeab69?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://thenoisychannel.com/" class="url" rel="ugc external nofollow">Daniel Tunkelang</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-12T16:32:28+00:00">January 12, 2009 at 4:32 pm</time></a> </div>
<div class="comment-content">
<p>How about configuring Mail Goggles? It won&rsquo;t track cumulative time spent, but you could only allow yourself to use Gmail for a few hours a day.</p>
<p><a href="https://gmailblog.blogspot.com/2008/10/new-in-labs-stop-sending-mail-you-later.html" rel="nofollow ugc">http://gmailblog.blogspot.com/2008/10/new-in-labs-stop-sending-mail-you-later.html</a></p>
</div>
</li>
<li id="comment-50547" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.downes.ca" class="url" rel="ugc external nofollow">Stephen Downes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-12T17:07:52+00:00">January 12, 2009 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>Write a shell script that does an ssh redirect on mail.google.com and that kills the redirect after a certain period of time.</p>
</div>
</li>
<li id="comment-50549" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d98221c72ad0dc0e7b24480161e13cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d98221c72ad0dc0e7b24480161e13cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ragibhasan.com" class="url" rel="ugc external nofollow">Ragib Hasan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-13T00:12:22+00:00">January 13, 2009 at 12:12 am</time></a> </div>
<div class="comment-content">
<p>It would be great if you could configure OpenDNS to block certain sites based on time. But if you want to block based on usage, perhaps a local machine based tool would be better.</p>
<p>&#8212;-</p>
<p>&ldquo;No paper involved!&rdquo;</p>
<p>On a related note, let me pose a question: how much energy / carbon emissions do you save by restricting your student/course interactions on email rather than on print?</p>
<p>At first sight, paper seems to be the bad guy, (imagine chopped trees!!). </p>
<p>However, given that Google would need to archive, replicate and serve the email from spinning hard disks for a long long time, is there a real saving of carbon emissions by communicating to your (local) students by email only? </p>
<p>(<a href="http://www-db.cs.wisc.edu/cidr/cidr2009/Paper_112.pdf" rel="nofollow">Here</a> is a related talk on energy cost of data centers.)</p>
</div>
</li>
<li id="comment-50550" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c9086f8f93bed7ac7f970558bbd3ec95?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c9086f8f93bed7ac7f970558bbd3ec95?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leslie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-13T00:40:14+00:00">January 13, 2009 at 12:40 am</time></a> </div>
<div class="comment-content">
<p>You could try setting a crontab that mods your /etc/hosts twice a day&#8211;once to enable, once to disable.</p>
</div>
</li>
<li id="comment-50551" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/11e0490bf608a4f2743c98910f9f545a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/11e0490bf608a4f2743c98910f9f545a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://jeromyanglim.blogspot.com/" class="url" rel="ugc external nofollow">Jeromy Anglim</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-13T02:24:01+00:00">January 13, 2009 at 2:24 am</time></a> </div>
<div class="comment-content">
<p>I recently turned off the automatic email notification tool in both Outlook and the Google Talk add-on for Gmail. At least this way email is less disruptive with my work flow. However, I&rsquo;m yet to see whether it causes complications when email arrives that does actually requires immediate response. </p>
<p>On a related point it would be good if there were an email system intelligent enough to know when to notify me immediately and when to leave me alone.</p>
</div>
</li>
<li id="comment-50552" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Manor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-01-13T03:39:48+00:00">January 13, 2009 at 3:39 am</time></a> </div>
<div class="comment-content">
<p>In firefox, you can use LeechBlock addon<br/>
<a href="https://addons.mozilla.org/en-US/firefox/addon/4476" rel="nofollow ugc">https://addons.mozilla.org/en-US/firefox/addon/4476</a></p>
</div>
</li>
</ol>
