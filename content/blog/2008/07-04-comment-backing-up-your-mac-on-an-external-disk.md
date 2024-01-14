---
date: "2008-07-04 12:00:00"
title: "Backing up your Mac on an external disk"
index: false
---

[4 thoughts on &ldquo;Backing up your Mac on an external disk&rdquo;](/lemire/blog/2008/07-04-backing-up-your-mac-on-an-external-disk)

<ol class="comment-list">
<li id="comment-50015" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e21ae50ae7cd39b695ada61872bbe696?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e21ae50ae7cd39b695ada61872bbe696?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Cyril Goutte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-11T09:50:18+00:00">July 11, 2008 at 9:50 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>I have been using rsync to backup at work, with a different set of options (-Cavuz); I&rsquo;ll check the options you use.</p>
<p>I actually put the command in a Makefile so I just &ldquo;make backup&rdquo; every now and then.</p>
<p>Have you figured out a way to automate the backup? I experimented a bit with Automator and Calendar but never could make it work properly.</p>
<p>At home I use Retrospect Express, which came free with an external disk I bought. It does reasonably good incremental backups, but I find it quite slow.</p>
</div>
</li>
<li id="comment-50016" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-11T11:42:39+00:00">July 11, 2008 at 11:42 am</time></a> </div>
<div class="comment-content">
<p>What is wrong with cron jobs? Type &ldquo;crontab -e&rdquo; to insert a new cron job. Of course, you must deal with a syntax from the seventies, but it is well documented.</p>
</div>
</li>
<li id="comment-50060" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.downes.ca" class="url" rel="ugc external nofollow">Stephen Downes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-30T20:09:02+00:00">July 30, 2008 at 8:09 pm</time></a> </div>
<div class="comment-content">
<p># my external disk is located<br/>
# at /Volumes/G-DRIVE\ MINI/</p>
<p>OK&#8230; how do I find out where *my* external disk is located?</p>
<p>(p.s. related to the math question &#8211; I&rsquo;m not so good at addition &#8211; heh)</p>
</div>
</li>
<li id="comment-50062" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-31T13:45:14+00:00">July 31, 2008 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>All disks on a Mac are located in /Volumes/. So go to shell and type &ldquo;ls /Volumes/&rdquo;. You should find it.</p>
</div>
</li>
</ol>
