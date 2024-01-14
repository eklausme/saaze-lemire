---
date: "2005-09-28 12:00:00"
title: "Strange KDE bug: can&#8217;t resize or move windows"
index: false
---

[31 thoughts on &ldquo;Strange KDE bug: can&#8217;t resize or move windows&rdquo;](/lemire/blog/2005/09-28-strange-kde-bug-cant-resize-or-move-windows)

<ol class="comment-list">
<li id="comment-3194" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-10-14T10:35:14+00:00">October 14, 2005 at 10:35 am</time></a> </div>
<div class="comment-content">
<p>i get the same problem from time to time and its very annoying</p>
<p>killall kwin returned no processes killed</p>
<p>kwrapper kwin -replace worked!!!</p>
<p>thanks</p>
</div>
</li>
<li id="comment-55207" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T15:27:16+00:00">April 20, 2012 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>Here we are in 2012 and your fix still works, thanks !</p>
<p>I guess no one has debugged the issue for many years</p>
</div>
</li>
<li id="comment-224956" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b349218eddae3dc10c1fddb77d41c06?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b349218eddae3dc10c1fddb77d41c06?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-01T21:05:25+00:00">February 1, 2016 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>2016, still works (kwrapper5).</p>
</div>
</li>
<li id="comment-231263" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5ff24d029c79270d58da9281dfced388?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5ff24d029c79270d58da9281dfced388?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://tech.sid3windr.be" class="url" rel="ugc external nofollow">Tom Laermans</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-03-09T16:24:04+00:00">March 9, 2016 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>Yep, 2016, still needed and works:</p>
<p>kwrapper5 kwin_x11 &#8211;replace</p>
</div>
</li>
<li id="comment-246978" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99aef95821c6e483d1ce586cffadd785?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99aef95821c6e483d1ce586cffadd785?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://phillipblanton.com" class="url" rel="ugc external nofollow">Phillip Blanton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-14T16:21:28+00:00">July 14, 2016 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>I ran into the same problem today. killall kwin reported no processes running. I tried just running kwin, and voila!&#8230; my windows now have handles and headers, and are mobile once again. kwin running in a terminal though is not useful.</p>
<p>Once I rebooted, things began to work again, so I believe that my issue was transient.</p>
</div>
</li>
<li id="comment-269382" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3784cb6f1dc205278c4d6b161c65ca65?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3784cb6f1dc205278c4d6b161c65ca65?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-01T15:23:45+00:00">February 1, 2017 at 3:23 pm</time></a> </div>
<div class="comment-content">
<p>January 2017 &#8211; still broken, fix above still works.</p>
</div>
</li>
<li id="comment-272475" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c948f16e3feec684929858cdd6730fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c948f16e3feec684929858cdd6730fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-21T19:05:08+00:00">February 21, 2017 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>Same. I could move tabs around within Chrome, but all the windows were locked down and immobile. I wish I knew what triggered this condition.</p>
</div>
</li>
<li id="comment-279526" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a3f61cb039c95e6f3ac03892779420dc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a3f61cb039c95e6f3ac03892779420dc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-10T08:03:44+00:00">May 10, 2017 at 8:03 am</time></a> </div>
<div class="comment-content">
<p>May 2017, the fix<br/>
killall kwin_x11<br/>
kwrapper5 kwin_x11 â€“replace<br/>
still works here &#8230;</p>
</div>
<ol class="children">
<li id="comment-281051" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a395fec25a61ea1549afc4560d09b5a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a395fec25a61ea1549afc4560d09b5a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philipe Mota</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-06T21:22:05+00:00">June 6, 2017 at 9:22 pm</time></a> </div>
<div class="comment-content">
<p>I just confirmed that the problem is still present and the above fix (updated from the previous msg) still works! Actually I&rsquo;m very glad to find this fix, I&rsquo;ve been dealing with this problem for a while now.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282752" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e19408072cf159d5e7c76d0012015ef9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e19408072cf159d5e7c76d0012015ef9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jason</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-03T17:18:26+00:00">July 3, 2017 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>man i am so tired of this sh*T..</p>
<p>i&rsquo;ve noticed this twice now!!!<br/>
&gt;after updates<br/>
&gt;after enable/disable kwallet&#8230;</p>
<p>can someone please tell me what is the use of kwallet?<br/>
surely if someone wanted that kind of security they can take 5min to download it&#8230;</p>
<p>please, for the LOVE OF GOD&#8230; please stop trying to go the windows10 way&#8230; at the moment i am bouncing between kde and xfce, my right click does not even work&#8230; sigh, </p>
<p>kde went down the sh*th0le</p>
</div>
</li>
<li id="comment-285410" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8808a6a9857f6a1be7d8b241196a2e6d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8808a6a9857f6a1be7d8b241196a2e6d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-05T19:48:38+00:00">September 5, 2017 at 7:48 pm</time></a> </div>
<div class="comment-content">
<p>The above solution only worked for me until changed desktops. </p>
<p>I ran &lsquo;kwrapper5 kwin &#8211;replace &amp;&rsquo; and could move windows again. Then switched to desktop 2 and I coulldn&rsquo;t move windows. Switched back to desktop 1 and still couldn&rsquo;t move windows.</p>
<p>Repeating the process repeated these symptoms. 🙁</p>
</div>
</li>
<li id="comment-299227" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/512f02a7f8e708fe661cae3308e7825d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/512f02a7f8e708fe661cae3308e7825d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-23T10:56:58+00:00">March 23, 2018 at 10:56 am</time></a> </div>
<div class="comment-content">
<p>2018&#8230; same problem the fix still works kwrapper5 kwin_x11 &#8211;replace &amp;</p>
</div>
</li>
<li id="comment-301071" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e64568f48b1f40430f7db2b331513f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e64568f48b1f40430f7db2b331513f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">av500</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-19T09:43:48+00:00">April 19, 2018 at 9:43 am</time></a> </div>
<div class="comment-content">
<p>also works in April 2018</p>
</div>
</li>
<li id="comment-303534" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cb06246e92c3a55d518dd561be8af40?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cb06246e92c3a55d518dd561be8af40?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aruna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-15T00:22:48+00:00">May 15, 2018 at 12:22 am</time></a> </div>
<div class="comment-content">
<p>My problem is that I cannot move the whole window. Last part of a window remains in right monitor.</p>
</div>
</li>
<li id="comment-305940" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/adb10fab0a67eee096374ce649f221c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/adb10fab0a67eee096374ce649f221c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ä½udovÃ­t</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-30T03:45:45+00:00">May 30, 2018 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>Hi, I am using KDE in debian stretch and encoutered this issue after waking up my laptop from sleep this morning.</p>
<p>After curing it with kwin restart, I managed to reproduce the behaviour after either switching workspace or moving a window to another workspace using keyboard shortcuts. The same happens if I move a window between monitors using keyboard shortcut. If I switch workspaces with mouse (using Workspace switcher panel widget) or move the window to other monitor or workspace using window bar context menu commands everything works as expected.</p>
<p>I also encounter a strange issue with command run dialog not getting focus after being invoked with Alt+F2. Definitively something is not right with either keyboard or KWin that persists the KWin restarts&#8230;</p>
</div>
<ol class="children">
<li id="comment-554641" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/adb10fab0a67eee096374ce649f221c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/adb10fab0a67eee096374ce649f221c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ludovit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-08T09:14:52+00:00">October 8, 2020 at 9:14 am</time></a> </div>
<div class="comment-content">
<p>During the course of time I have found out that the problem becomes incurable after around 49 days of uptime. After this amount of time every desktop switch causes the KWin to crash and it lasts only until the next desktop switch to crash after KWin restart.</p>
<p>Maybe it helps someone to identify the root cause of this bug, that is causing our workstations to be restarted every around 7 weeks 🙁</p>
</div>
</li>
</ol>
</li>
<li id="comment-345205" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/717936e6ac3000f95728b1f3dccc5223?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/717936e6ac3000f95728b1f3dccc5223?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J.S.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-28T23:27:43+00:00">August 28, 2018 at 11:27 pm</time></a> </div>
<div class="comment-content">
<p>For me, the solution was &lsquo;kwrapper5 kwin_x11 &#8211;replace &amp;&rsquo;<br/>
In case this ends up looking the same as several other posts, there are 2* hyphens in front of &lsquo;replace&rsquo;!</p>
</div>
<ol class="children">
<li id="comment-355428" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b97386c03d61d5205f693b8404cc30ed?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b97386c03d61d5205f693b8404cc30ed?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ryan Alizadeh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-09T13:54:42+00:00">October 9, 2018 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>When I run that it gives me an error &ldquo;KInit could not launch kwin_xll&rdquo;</p>
<p>Do you know how to fix this?</p>
<p>Thanks</p>
</div>
</li>
</ol>
</li>
<li id="comment-380783" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25e312517aee0e2300446ee8adad5394?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25e312517aee0e2300446ee8adad5394?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">przemek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-10T10:18:19+00:00">January 10, 2019 at 10:18 am</time></a> </div>
<div class="comment-content">
<p>Woop woop,</p>
<p>2019 and it still works</p>
</div>
</li>
<li id="comment-382290" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0724029f547016dbef01bc6cf3403d05?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0724029f547016dbef01bc6cf3403d05?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benjamin Chausse</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-16T06:37:43+00:00">January 16, 2019 at 6:37 am</time></a> </div>
<div class="comment-content">
<p>The problem started occuring on my computer after messing up an installation of i3 and kde on arch. (I gave up to stay on plasma)<br/>
Only thing is I have to repeat those commands everytime I boot. Does anyone know where the script that is causing this could be?</p>
</div>
</li>
<li id="comment-411782" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d86adb0f88b2024df083dd2f62820c2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d86adb0f88b2024df083dd2f62820c2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kofe.si/" class="url" rel="ugc external nofollow">Simon Mihevc</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-14T05:42:09+00:00">June 14, 2019 at 5:42 am</time></a> </div>
<div class="comment-content">
<p>I thank you for this fix. It&rsquo;s been eating me alive. All windows would loose menubar and resize ability whenever I logged in for the 2nd time into same session.</p>
<p>This in on KDE 5.8.6 Debian stretch 9.9 and I suspect it&rsquo;s due to either dist-upgrade from older KDE/Debian or me messing up the themes somehow.</p>
</div>
</li>
<li id="comment-485565" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc839506326920874818f00e5ea3a035?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc839506326920874818f00e5ea3a035?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roger Lucas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-14T15:49:57+00:00">January 14, 2020 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>Still finding this in 2020! Thanks for the post!</p>
</div>
</li>
<li id="comment-493910" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/504b840a0b61340828362556a99fa8de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/504b840a0b61340828362556a99fa8de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Noel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T21:26:32+00:00">March 4, 2020 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>March 2020, still works!<br/>
Thank you!</p>
</div>
</li>
<li id="comment-539645" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3da62c93ecabecd72372625388c913b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3da62c93ecabecd72372625388c913b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Madhuri Murthy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-21T00:22:40+00:00">July 21, 2020 at 12:22 am</time></a> </div>
<div class="comment-content">
<p>Used to work okay, but now it complains that XDG_RUNTIME_DIR is not set and isn&rsquo;t working anymore 🙁</p>
</div>
</li>
<li id="comment-551034" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4dfb0727ee3028ea56fd76da4697b36f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4dfb0727ee3028ea56fd76da4697b36f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt D.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-30T18:35:02+00:00">August 30, 2020 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>Working for me in 2020, although closing a terminal window breaks kwin again. I also encountered the XDG_RUNTIME_DIR when I tried to re-run on a new terminal window.</p>
</div>
</li>
<li id="comment-554498" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/48b5e358f080c26bbe487b28f347e35f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/48b5e358f080c26bbe487b28f347e35f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ruthvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-07T04:20:10+00:00">October 7, 2020 at 4:20 am</time></a> </div>
<div class="comment-content">
<p>not sure what worked but one of the things worked. all the screens went crazy for a few mins before it started working</p>
</div>
</li>
<li id="comment-555987" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/20f0fecb4ba722d4b7154ef65ad6d792?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/20f0fecb4ba722d4b7154ef65ad6d792?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-24T17:19:01+00:00">October 24, 2020 at 5:19 pm</time></a> </div>
<div class="comment-content">
<p>Oct 2020 and it works.</p>
</div>
</li>
<li id="comment-581896" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e137725000d4736ef9dc99b041116fd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e137725000d4736ef9dc99b041116fd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Titi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-08T12:34:14+00:00">April 8, 2021 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>April 2021 and it still works!</p>
</div>
</li>
<li id="comment-597037" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/add6872806269f48f7f90760655e8555?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/add6872806269f48f7f90760655e8555?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luca</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-04T22:10:21+00:00">September 4, 2021 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p>September 2021 it doesn&rsquo;t work for me 🙁</p>
</div>
</li>
<li id="comment-612497" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/415572064384ba7b80c9c9c66e14cd54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/415572064384ba7b80c9c9c66e14cd54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-21T14:15:15+00:00">December 21, 2021 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>December 22, 2021 and I found a fix to a similar problem (My GTK apps refused to resize). Here&rsquo;s how I fixed it</p>
<p>&#8211; Go to a tty (ctrl+alt+f2), and login to the account you use with KDE<br/>
&#8211; run &ldquo;cd ~/.config&rdquo;, without quotes<br/>
&#8211; open &ldquo;kwinrc&rdquo; in a text editor (&ldquo;nano kwinrc&rdquo;)<br/>
&#8211; Find the line that says &ldquo;OpenGLIsUnsafe=true&rdquo; under &ldquo;[Compositing]&rdquo;, and change it to &ldquo;OpenGLIsUnsafe=false&rdquo;<br/>
&#8211; save the file and reboot.</p>
<p>Hope this helps!</p>
</div>
</li>
<li id="comment-648379" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17cf48b0190d098dc449ef3c04a04ca4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17cf48b0190d098dc449ef3c04a04ca4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.jxtxzzw.com" class="url" rel="ugc external nofollow">jxtxzzw</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-11T00:29:41+00:00">December 11, 2022 at 12:29 am</time></a> </div>
<div class="comment-content">
<p>Thanks so much. It works for me in Dec 2022.</p>
<p>killall kwin_x11<br/>
kwrapper5 kwin_x11 &#8211;replace &amp;</p>
</div>
</li>
</ol>
