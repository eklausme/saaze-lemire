---
date: "2005-12-22 12:00:00"
title: "AJAX RSS Display"
index: false
---

[18 thoughts on &ldquo;AJAX RSS Display&rdquo;](/lemire/blog/2005/12-22-ajax-rss-display)

<ol class="comment-list">
<li id="comment-3975" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69d9e1e6facc81db897fd403aa5afc00?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69d9e1e6facc81db897fd403aa5afc00?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">AJAX RSS Feed Reader</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-14T22:24:00+00:00">April 14, 2006 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>Here is a PHP based AJAX RSS Feed Reader which display RSS Feeds in draggable auto-arranging AJAX Feed Windows which self-update using AJAX as RSS Feed is updated.</p>
</div>
</li>
<li id="comment-4105" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/29009cafdbe26e987297730c9e9a90d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/29009cafdbe26e987297730c9e9a90d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://simile.wordpress.com/" class="url" rel="ugc external nofollow">Madhu</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-24T20:22:07+00:00">April 24, 2006 at 8:22 pm</time></a> </div>
<div class="comment-content">
<p>how does one use wget so that fresh rss files are loaded to my site /server. I was thinking of using Pbwiki to keep rss files and use similar script as yours !!</p>
</div>
</li>
<li id="comment-4106" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-24T22:18:28+00:00">April 24, 2006 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>a cron file (crontab -e) ought to do it.</p>
</div>
</li>
<li id="comment-4117" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-25T15:52:10+00:00">April 25, 2006 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>cron and wget and unix-tools. You can get them to work under Windows<br/>
with cygwin.</p>
<p><a href="http://www.cygwin.com/" rel="nofollow ugc">http://www.cygwin.com/</a></p>
<p>There are, quite possibly, simpler ways to do it in a Windows-like<br/>
manner, but I don&rsquo;t use Windows.</p>
</div>
</li>
<li id="comment-5389" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7837e5206ccf5954245f8624047cda36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7837e5206ccf5954245f8624047cda36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cameron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-15T12:44:03+00:00">May 15, 2006 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>Finally got it working, but had some trouble with the HTML code. My browser didn&rsquo;t like the &rdquo; double-quotes, and the missing gave some strange formatting results.</p>
</div>
</li>
<li id="comment-5391" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7837e5206ccf5954245f8624047cda36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7837e5206ccf5954245f8624047cda36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cameron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-15T12:50:23+00:00">May 15, 2006 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>Okay, should have said: &#8230; didn&rsquo;t like the &rdquo; double-quotes and the missing &lt;/h1&gt; gave some &#8230;</p>
</div>
</li>
<li id="comment-25436" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af2731c008c33a46d0b3e9452148d134?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af2731c008c33a46d0b3e9452148d134?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Theodor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-08-29T07:19:04+00:00">August 29, 2006 at 7:19 am</time></a> </div>
<div class="comment-content">
<p>Please ensure, that your script takes care about the namespaces. If you don&rsquo;t do it, feeds like them from citeUlike.org won&rsquo;t be accessible.</p>
<p>If you would like to have a look at my additions, hit me via mail!</p>
<p>Cheers!</p>
</div>
</li>
<li id="comment-27654" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">axis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-06T20:08:45+00:00">September 6, 2006 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>Thanks very much !!</p>
</div>
</li>
<li id="comment-28071" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-08T09:21:42+00:00">September 8, 2006 at 9:21 am</time></a> </div>
<div class="comment-content">
<p>Fixed now, see inside the post.</p>
</div>
</li>
<li id="comment-28063" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5133bbddccb9c40246c1012032083387?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5133bbddccb9c40246c1012032083387?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.plungjan.name" class="url" rel="ugc external nofollow">mplungjan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-08T08:24:56+00:00">September 8, 2006 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>Sorry, Your paste of Theodor&rsquo;s code is not complete&#8230; Seems to be a chunk missing around here:<br/>
for(var i=0; i0)?title[i].firstChild.nodeValue:&rdquo;Untitledâ€œ;</p>
</div>
</li>
<li id="comment-33249" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-26T12:57:49+00:00">September 26, 2006 at 12:57 pm</time></a> </div>
<div class="comment-content">
<p>Not sure where these xsrc and mce_src attributes are.</p>
</div>
</li>
<li id="comment-33224" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e7cd011aac547d43731ea34ee846e2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e7cd011aac547d43731ea34ee846e2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://willcode4beer.com" class="url" rel="ugc external nofollow">PaulE</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-09-26T10:55:20+00:00">September 26, 2006 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>Fails for me because of the &ldquo;xsrc&rdquo; and &ldquo;mce_src&rdquo; attributes on the script tag. Using &ldquo;src&rdquo; does work.</p>
<p>What are these attributes (&ldquo;xsrc&rdquo; and &ldquo;mce_src&rdquo;)?<br/>
I can&rsquo;t find any documentation on them and using them causes pages to fail validation.<br/>
Thanks</p>
</div>
</li>
<li id="comment-45983" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7429ebcbb65e26024ba18d535afd59c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7429ebcbb65e26024ba18d535afd59c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ardiansyah</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-09T04:53:35+00:00">November 9, 2006 at 4:53 am</time></a> </div>
<div class="comment-content">
<p>Sorry my mozilla browser only display &ldquo;JavaScript RSS Reader&rdquo;. I have write in my html page <a href="http://rahard.wordpress.com/feed" rel="nofollow ugc">http://rahard.wordpress.com/feed</a> . What should i do?</p>
</div>
</li>
<li id="comment-49241" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b68255c96d4fa84cbea8532caa1c7ff9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b68255c96d4fa84cbea8532caa1c7ff9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">adam smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-04-14T09:03:34+00:00">April 14, 2007 at 9:03 am</time></a> </div>
<div class="comment-content">
<p>Please ensure, that your script takes care about the namespaces. If you don&rsquo;t do it, feeds like them from citeUlike.org won&rsquo;t be accessible.info</p>
</div>
</li>
<li id="comment-49242" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-04-14T18:09:19+00:00">April 14, 2007 at 6:09 pm</time></a> </div>
<div class="comment-content">
<p>You can&rsquo;t load citeulike.org feeds using this script. Only local RSS feeds can be loaded due to the ECMAScript security model.</p>
</div>
</li>
<li id="comment-49473" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3c4dc6a55f22a17441c1091aa1d4fcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3c4dc6a55f22a17441c1091aa1d4fcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alex william</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-09-05T23:28:37+00:00">September 5, 2007 at 11:28 pm</time></a> </div>
<div class="comment-content">
<p>Dear Daniel,</p>
<p>I just came across your RSS feed tutorial. Now, for days I&rsquo;ve been driving myself crazy on how to complete the RSS News feed code. I&rsquo;m a Graphic and Web Designer, but my Ajax skills aren&rsquo;t strong. So I need help on this particular feature. Is this code you have accurate? I used it and got no results. If you can, do u think u can e-mail a code that u would use to get live RSS News feeds? If u could I would really appreciate that!</p>
<p>Thanks</p>
</div>
</li>
<li id="comment-49474" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3c4dc6a55f22a17441c1091aa1d4fcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3c4dc6a55f22a17441c1091aa1d4fcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alex william</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-09-05T23:30:23+00:00">September 5, 2007 at 11:30 pm</time></a> </div>
<div class="comment-content">
<p>I just came across your RSS feed tutorial. Now, for days I&rsquo;ve been driving myself crazy on how to complete the RSS News feed code. but my Ajax skills aren&rsquo;t strong. So I need help on this particular feature. Is this code you have accurate? I used it and got no results. If you can, do u think u can e-mail a code that u would use to get live RSS News feeds?</p>
</div>
</li>
<li id="comment-49475" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3c4dc6a55f22a17441c1091aa1d4fcb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3c4dc6a55f22a17441c1091aa1d4fcb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alex william</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-09-05T23:31:59+00:00">September 5, 2007 at 11:31 pm</time></a> </div>
<div class="comment-content">
<p>hELLO, I need help on this particular feature. Is this code you have accurate? I used it and got no results. If you can, do u think u can e-mail a code that u would use to get live RSS News feeds? If u could I would really appreciate that!</p>
</div>
</li>
</ol>
