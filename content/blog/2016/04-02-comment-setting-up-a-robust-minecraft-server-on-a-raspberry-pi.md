---
date: "2016-04-02 12:00:00"
title: "Setting up a &#8220;robust&#8221; Minecraft server (Java Edition) on a Raspberry Pi"
index: false
---

[396 thoughts on &ldquo;Setting up a &#8220;robust&#8221; Minecraft server (Java Edition) on a Raspberry Pi&rdquo;](/lemire/blog/2016/04-02-setting-up-a-robust-minecraft-server-on-a-raspberry-pi)

<ol class="comment-list">
<li id="comment-237919" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/714deaf48dd7c0a0abf5a76b8d0555c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/714deaf48dd7c0a0abf5a76b8d0555c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-02T10:15:07+00:00">May 2, 2016 at 10:15 am</time></a> </div>
<div class="comment-content">
<p>Hi I followed your tutorial and everything seemed to install correctly. However when i tried to start the server for the first time i get the message Error: Unable to access jarfile spigot-1.9.jar can you tell me what I am need to do to correct this.</p>
</div>
<ol class="children">
<li id="comment-237950" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-02T14:24:25+00:00">May 2, 2016 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p>Right. The command: <tt>java -jar BuildTools.jar</tt> will create a jar file, type <tt>ls spigot*.jar</tt> to find how the jar file is called, it might not be <tt>spigot-1.9.jar</tt> if you are installing a different version of spigot.</p>
</div>
</li>
<li id="comment-277986" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4137ba3d41b75101044c42756f3669b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4137ba3d41b75101044c42756f3669b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francesco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-14T20:25:55+00:00">April 14, 2017 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>Try to use â€œsudoâ€ before starting server.</p>
</div>
<ol class="children">
<li id="comment-285916" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-14T19:01:43+00:00">September 14, 2017 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>If you need to use &ldquo;sudo&rdquo; to start the server, then you did not follow the instructions. I do not recommend running the server through &ldquo;sudo&rdquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-239932" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b40834b20d7d0a41ca01b2921a2ff886?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b40834b20d7d0a41ca01b2921a2ff886?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Young</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-13T05:50:15+00:00">May 13, 2016 at 5:50 am</time></a> </div>
<div class="comment-content">
<p>Easily the best tutorial I have found. Worked a treat. Thanks.</p>
</div>
</li>
<li id="comment-240125" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e1eb12c1fec6d621ad988416c26e2558?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e1eb12c1fec6d621ad988416c26e2558?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.bestofjay.com/" class="url" rel="ugc external nofollow">Jason Jackson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-14T13:27:15+00:00">May 14, 2016 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>use this for the latest version, otherwise 1.9.2 is built</p>
<p>java -jar BuildTools.jar &#8211;rev 1.9.4</p>
</div>
</li>
<li id="comment-241032" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c20e3eed588dbe745f9074addd21f5a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c20e3eed588dbe745f9074addd21f5a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Greg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-18T14:23:56+00:00">May 18, 2016 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>Excellent tutorial, thank you.</p>
<p>My little Pi 3 is running a minecraft server right now.</p>
</div>
</li>
<li id="comment-241891" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2453aa4ac8f0ecea651ee7bd2e4dd22?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2453aa4ac8f0ecea651ee7bd2e4dd22?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-23T14:57:55+00:00">May 23, 2016 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>Hi, thanks for your work! I do have a problem, in the next script:<br/>
if ! screen -list | grep -q &ldquo;minecraft&rdquo;; then<br/>
cd /home/pi/minecraft/1.9.2 ( i did ad a &ldquo;.2&rdquo;)<br/>
while true; do<br/>
screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M spigot-1.9.2.jar nogui &amp;&amp; break ( i did ad a &ldquo;.2 &rdquo; here as wel)<br/>
done<br/>
fi<br/>
it says:&rdquo;no such file or directory&rdquo; When i look in the minecraft folder, i don&rsquo;s see a file or folder named 1.9 or 1.9.2. </p>
<p>any idea&rsquo;s what i am doing wrong?</p>
<p>Regards</p>
</div>
<ol class="children">
<li id="comment-241918" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-23T15:46:58+00:00">May 23, 2016 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>Replace &ldquo;cd /home/pi/minecraft/1.9.2&rdquo; with &ldquo;cd /home/pi/minecraft&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-263993" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/92e0576399a317f66931ca33dd5c03f0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/92e0576399a317f66931ca33dd5c03f0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jaden Wijata</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-28T20:02:44+00:00">December 28, 2016 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>Works great</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-242409" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/22d30bc5cab89ce702c2c7c3d37f3737?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/22d30bc5cab89ce702c2c7c3d37f3737?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adrian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-26T13:48:24+00:00">May 26, 2016 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>Err&#8230; Help..!<br/>
Got to the pint of the start-up script and added the part to call it from &lsquo;rc.local&rsquo;.<br/>
Re-booted the Pi , text scrolls up the screen as normal, gets to the part where it calls the script and then just prints out&#8230;<br/>
&lsquo;/home/pi/minecraft/minecraft.sh: line 4: screen: command not found&rsquo; continuously.<br/>
Any ideas what is wrong, and how do i get back into my Pi?.</p>
</div>
<ol class="children">
<li id="comment-242413" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-26T15:03:06+00:00">May 26, 2016 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>Have you typed <tt>sudo apt-get install netatalk screen</tt>?</p>
</div>
</li>
</ol>
</li>
<li id="comment-242420" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/22d30bc5cab89ce702c2c7c3d37f3737?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/22d30bc5cab89ce702c2c7c3d37f3737?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adrian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-05-26T16:18:14+00:00">May 26, 2016 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>Ah&#8230; that sorted it. It would help if I read your instructions properly. 🙂<br/>
The Minecraft server is working brilliantly now on my Pi3.<br/>
Thanks for you help and a speedy response.</p>
</div>
</li>
<li id="comment-243158" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/39018b2a424fca6295a22775d8955289?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/39018b2a424fca6295a22775d8955289?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Geordie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-04T06:26:28+00:00">June 4, 2016 at 6:26 am</time></a> </div>
<div class="comment-content">
<p>Awesome work and thank you very much. Is it possible to have multiple worlds (survival/creative etc) with different names so that we can play together or apart and log in using different server properties or similar?</p>
</div>
<ol class="children">
<li id="comment-268652" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79452307d1050faba2c4d0b26a9118ab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79452307d1050faba2c4d0b26a9118ab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Heath Mitchell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-27T17:34:06+00:00">January 27, 2017 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>Look up Multiverse Spigot. Put it in your plugins folder (in the folder where the server was set up somewhere) and look up how to use it.</p>
</div>
</li>
<li id="comment-386910" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7e043f2272bccf97e807b5ac906f47b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7e043f2272bccf97e807b5ac906f47b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sombeboydy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-07T15:05:44+00:00">February 7, 2019 at 3:05 pm</time></a> </div>
<div class="comment-content">
<p>There should be a spigotplugin for that</p>
</div>
</li>
</ol>
</li>
<li id="comment-243432" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cbe75c248cccf6778ad972854a33f3d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cbe75c248cccf6778ad972854a33f3d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bokkie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-07T20:59:06+00:00">June 7, 2016 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>When starting with the lite Raspbian image, you need to install the following additional packages: oracle-java8-jdk, git</p>
</div>
<ol class="children">
<li id="comment-246892" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb7b4e057d153a4c0a615a47fe9015fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb7b4e057d153a4c0a615a47fe9015fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jason</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-13T18:05:24+00:00">July 13, 2016 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Absolutely correct! So glad I saw your comment buried in here! I don&rsquo;t want to waste valuable resources for a GUI I&rsquo;ll never use, so I have my Pi multi-server running on lite. Was having a terrible time getting this to work until I saw your comment. I did an apt-get remove openjdk* then apt-get install oracle-java8-jdk and BOOM! IT WORKS!</p>
<p>Thank You!</p>
</div>
<ol class="children">
<li id="comment-246963" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-14T14:48:16+00:00">July 14, 2016 at 2:48 pm</time></a> </div>
<div class="comment-content">
<p><em>I don&rsquo;t want to waste valuable resources for a GUI I&rsquo;ll never use</em></p>
<p>I guess you refer to disk usage. However, large SD cards are quite cheap. You can get an 8GB SD card for less than 10$.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-243488" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Griffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-08T09:06:07+00:00">June 8, 2016 at 9:06 am</time></a> </div>
<div class="comment-content">
<p>I have written your script as you have done but I get the error.</p>
<p>Usage: grep [OPTION]&#8230; PATTERN [FILE]&#8230;<br/>
Try &lsquo;grep &#8211;help&rsquo; for more information.</p>
<p>./minecraft.sh: 4: ./minecraft.sh: minecraft: not found</p>
</div>
<ol class="children">
<li id="comment-243506" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-08T13:26:55+00:00">June 8, 2016 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>Can you type&#8230;</p>
<p><tt>$ grep --version</tt></p>
</div>
<ol class="children">
<li id="comment-243544" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Griffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-09T00:06:59+00:00">June 9, 2016 at 12:06 am</time></a> </div>
<div class="comment-content">
<p>I had the script written wrong but still it didn&rsquo;t work.</p>
<p>When I corrected the script it ran the minecraft server but gave errors and crashed.</p>
<p>I am not sure of the errors as it was going to fast to read.</p>
</div>
</li>
<li id="comment-243552" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Griffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-09T02:33:43+00:00">June 9, 2016 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>the CLI should be sudo grep &#8211;version</p>
<p>the version I am running is 2.20</p>
<p>I am not sure if it is a error with the script or if its the netatalk screen?</p>
<p>I can boot the server up by itself without the script</p>
<p>Cheers</p>
<p>Sean</p>
</div>
<ol class="children">
<li id="comment-243626" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-09T13:31:24+00:00">June 9, 2016 at 1:31 pm</time></a> </div>
<div class="comment-content">
<p><em>the CLI should be sudo grep â€“version</em></p>
<p>You should use <tt>sudo</tt> with care as it can mess up file permissions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-243553" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Griffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-09T02:38:28+00:00">June 9, 2016 at 2:38 am</time></a> </div>
<div class="comment-content">
<p>I am running the latest Raspbian Jessie (Lite) update also running the latest build of BuildTools.jar and running a raspberry pi 3.</p>
<p>Not sure what else I can do to get the script to work.</p>
<p>Do you think a reinstall of Netatalk might work or an older version?</p>
<p>Cheers</p>
<p>Sean</p>
</div>
<ol class="children">
<li id="comment-243627" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-09T13:34:52+00:00">June 9, 2016 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>I recommend starting from a clean image and following the instructions carefully, step by step. They are thoroughly tested and definitively work on a Raspberry Pi 3. If you do not want to do this, you will have to find how your system is messed up.</p>
</div>
<ol class="children">
<li id="comment-243776" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Griffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-10T21:17:45+00:00">June 10, 2016 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>I have installed a new image and the script is not working still.</p>
<p>I followed the instructions to the letter.</p>
<p>If I was rude Daniel I am sorry didn&rsquo;t mean to be.</p>
</div>
<ol class="children">
<li id="comment-243782" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-10T22:11:58+00:00">June 10, 2016 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>You are not rude but these instructions are thoroughly tested and definitively work.</p>
</div>
<ol class="children">
<li id="comment-392754" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4b6022b4ed61c9cb16a2c29494a5ab1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4b6022b4ed61c9cb16a2c29494a5ab1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jos Gordon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-04T01:12:12+00:00">March 4, 2019 at 1:12 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
I wouldn&rsquo;t say it definitely works, but it does in most cases.</p>
<p>For example &#8211; netstat shows the pi listening on ports 22 and 25565 but I am unable to connect on the latter. Fing, on the other hand, shows only port 22 open &#8211; Connections to 25565 fail. Security/firewall settings on the pi possibly.</p>
<p>Your instructions, while very detailed, make certain assumptions. The version of raspian, security settings, Minecraft server version. With the most current full version of raspian there appears to be an issue. It is a great starting point though and I thank you for publishing this.</p>
</div>
<ol class="children">
<li id="comment-392778" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-04T03:05:11+00:00">March 4, 2019 at 3:05 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>With the most current full version of raspian there appears to be an issue.</p>
</blockquote>
<p>I did a fresh setup two weeks ago with the latest Raspbian (2018-11-13) and it worked for me, as it had always done. It is possible that something changed in the ecosystem and that my instructions are no longer adequate, and that I was just lucky&#8230;</p>
<p>However, I would argue that it would be useful for you to qualify what you mean by &ldquo;I am unable to connect&rdquo;. Presumably, you started the server and it runs fine. So everything in my instructions worked for you, except that &ldquo;you are unable to connect&rdquo;. Ok.</p>
<p>Can you elaborate&#8230;?</p>
<p>For example, which Minecraft client are you using?</p>
</div>
<ol class="children">
<li id="comment-392875" class="comment byuser comment-author-lemire bypostauthor even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-04T13:15:05+00:00">March 4, 2019 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>Furthermore, your comment suggests that it is related to the current version. Can we deduce that you did it with an earlier version and that you verified that it worked. Otherwise, how could you tell that the problem is related to the current version of the OS?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-254899" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-07T15:28:25+00:00">October 7, 2016 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p>Please use the full Raspbian as specified in the instructions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-243555" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/83d1517b0f9339a6867ea279b0099897?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean Griffin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-09T02:49:57+00:00">June 9, 2016 at 2:49 am</time></a> </div>
<div class="comment-content">
<p>One error is : ERROR Unable to locate appender File for logger</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-243838" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19c096bb5125ffd0cc629fe6d84c9a19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19c096bb5125ffd0cc629fe6d84c9a19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sissyneck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-11T10:51:32+00:00">June 11, 2016 at 10:51 am</time></a> </div>
<div class="comment-content">
<p>Thanks very much for taking the time to develop this and to write it up, by far the most thorough and clear instructions I&rsquo;ve found. My kids and I got a server up and running in a few hours last weekend.<br/>
Now that the 1.10 update has arrived, I wonder if you have any tips for going about installing the update.<br/>
Thanks again.</p>
</div>
<ol class="children">
<li id="comment-243885" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14c4e16700d0d000aa0e108e6d8cf5cf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14c4e16700d0d000aa0e108e6d8cf5cf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gabe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-11T19:41:29+00:00">June 11, 2016 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve just done this for the first time on our little Pi2 &#8211; it can barely handle the load but it&rsquo;s good enough for some father/son goofing around!</p>
<p>I&rsquo;m not using Spigot, I&rsquo;m using the default minecraft server jar file.<br/>
So: download the new version 1.10 server jar file from minecraft.net.<br/>
Put it in the same directory as your previous server file.<br/>
Update the minecraft.sh script by changing the filename from the old to the new file.<br/>
I&rsquo;m not sure if it will generate a new World or not &#8211; I started at 1.10 because we just today pulled the long-dormant Pi2 out of its storage.</p>
</div>
<ol class="children">
<li id="comment-286602" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T09:47:41+00:00">September 22, 2017 at 9:47 am</time></a> </div>
<div class="comment-content">
<p>I know this post was from last year, but for anyone reading this, don&rsquo;t do what this guy did. The Mojang server is way too slow on the Pi (even a Pi3). Spigot is definitely worth the extra time and effort to build, it&rsquo;s waaay faster than the default Minecraft server!</p>
</div>
<ol class="children">
<li id="comment-290180" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a400edd34585b96eb72c7c03d0fae62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a400edd34585b96eb72c7c03d0fae62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RicG</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-26T13:26:52+00:00">October 26, 2017 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been running a server on a Pi3 using Spigot for nearly a year. Every now and then it kicks me off in the middle of cavorting around the world, but that seems to be happening more recently since updating a few of the plugins. I&rsquo;m running Multiverse, Multiverse Portals, Multiverse Sign Portals, and Slimefun with a few SF addons. I&rsquo;ve also started using BetterFoliage and Conquest resource pack on the client side, and the game has never looked better! I just need to figure out why the crashes seem to be happening a little more frequently, but it&rsquo;s not enough to make the overall experience unpleasant.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-243987" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1c4bd4cb76ac50b8c84ada61c3b594e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1c4bd4cb76ac50b8c84ada61c3b594e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Caleb Allen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-13T16:35:50+00:00">June 13, 2016 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, very helpful guide. If anyone gets a TransportException or some kind of SSL error, the &#8211;disable-certificate-check flag can come in handy with BuildTools. GIT errors can be solved by clearing the working folder and starting again. Also in my case I had time to grab a coffee and two sausage rolls, head out for the afternoon, come back, write this comment and it&rsquo;s still not finished on my Raspberry Pi 3.</p>
</div>
<ol class="children">
<li id="comment-243989" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-13T16:55:10+00:00">June 13, 2016 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>Yes, the whole setup takes a surprisingly long time. Unfortunately, one cannot legally distribute a ready-made image.</p>
</div>
<ol class="children">
<li id="comment-243994" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1c4bd4cb76ac50b8c84ada61c3b594e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1c4bd4cb76ac50b8c84ada61c3b594e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Caleb Allen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-13T19:03:13+00:00">June 13, 2016 at 7:03 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know if it&rsquo;s just me, but from a Raspbian Lite image, I&rsquo;ve been overrun with SSL errors. The only way to get BuildTools to start was to disable cert checking; then I had to restart the process several times to get it to complete a build and when I thought it was nearly done it went on to throw a maven plugin download transport cert error. I thought I had it, but it&rsquo;s just gone and failed now.</p>
</div>
<ol class="children">
<li id="comment-244000" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-13T20:26:14+00:00">June 13, 2016 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>Are you sure you grabbed the right spigot? Check which version you have&#8230;</p>
<pre>
$jar xvf BuildTools.jar META-INF/MANIFEST.MF
$cat META-INF/MANIFEST.MF
</pre>
</div>
<ol class="children">
<li id="comment-244209" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1c4bd4cb76ac50b8c84ada61c3b594e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1c4bd4cb76ac50b8c84ada61c3b594e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Caleb Allen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-15T10:16:10+00:00">June 15, 2016 at 10:16 am</time></a> </div>
<div class="comment-content">
<p>Retried with Raspbian Jessie Full rather than Lite, worked first time with no issues.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-245070" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9c01eda537054956072b9b15bab1f24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9c01eda537054956072b9b15bab1f24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-23T00:51:40+00:00">June 23, 2016 at 12:51 am</time></a> </div>
<div class="comment-content">
<p>Great write-up. Everything worked like a charm.</p>
</div>
</li>
<li id="comment-245867" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dfbb36ee40a571fe02b3f89272d339b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dfbb36ee40a571fe02b3f89272d339b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RaphaÃ«l</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-01T03:57:55+00:00">July 1, 2016 at 3:57 am</time></a> </div>
<div class="comment-content">
<p>Hello Daniel, from Paris.</p>
<p>I am very thankful for this step by step recipe. The only trouble i do encounter is when after launching the server, I&rsquo;d like to return to the shell typing &ldquo;ctrl-a d&rdquo;. Doesn&rsquo;t work. But I do suspect a wrong action on my side which I couldn&rsquo;t figure out.</p>
<p>And I was wondering if there is a way to change the parameters of the world we created from survival to creative / terrain aspect, etc.</p>
<p>Thank you again.</p>
</div>
<ol class="children">
<li id="comment-245916" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-01T14:41:09+00:00">July 1, 2016 at 2:41 pm</time></a> </div>
<div class="comment-content">
<p><em>The only trouble i do encounter is when after launching the server, I&rsquo;d like to return to the shell typing â€œctrl-a dâ€. </em></p>
<p>If you have followed my instructions, then after starting the server, you should still be in the bash shell.</p>
<p>If you open a <tt>screen</tt> to access the server terminal, then, by definition, you will be in a <tt>screen</tt> session, and those can be closed by hitting &ldquo;ctrl-a&rdquo; then &ldquo;d&rdquo;. </p>
<p><em>And I was wondering if there is a way to change the parameters of the world we created from survival to creative / terrain aspect, etc.</em></p>
<p>Of course. You can configure the server in various ways. It is outside the scope of my blog post however.</p>
</div>
</li>
</ol>
</li>
<li id="comment-246189" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/942d0065c3590f68781f56c0435361e9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/942d0065c3590f68781f56c0435361e9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">AJ</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-04T22:20:35+00:00">July 4, 2016 at 10:20 pm</time></a> </div>
<div class="comment-content">
<p>It is important to note that the directions will not work if you are using Raspi 3 with Jessie Lite.<br/>
So far I&rsquo;ve had to install several packages including java and git, change classpath etc. and I am still facing errors.<br/>
Exception in thread &ldquo;main&rdquo; org.eclipse.jgit.api.errors.JGitInternalException: Exception caught during execution of reset command. {0}</p>
</div>
</li>
<li id="comment-246226" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4762cbe7dafca8325c0b2260b9ed2b76?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4762cbe7dafca8325c0b2260b9ed2b76?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zbysek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-05T07:52:33+00:00">July 5, 2016 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>First I want to thank you Daniel.<br/>
So thank you for this guide. I have raspberry pi 3 and right now it is running minecraft server so I can play it with my kids during rainy days.</p>
<p>Zbysek</p>
</div>
</li>
<li id="comment-246438" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d78e356139087ae78f45d268eceed80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d78e356139087ae78f45d268eceed80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aebkea</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-07T14:26:03+00:00">July 7, 2016 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Is there something more efficient about the Spigot build of Minecraft over the one distributed by Mojang, allowing the former to run better on a Raspberry Pi than the latter?</p>
</div>
<ol class="children">
<li id="comment-246444" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-07T15:53:31+00:00">July 7, 2016 at 3:53 pm</time></a> </div>
<div class="comment-content">
<p>Most people running a server want the option of customizing it, something that Spigot makes trivial. A vanilla server would probably work well on a Raspberry Pi, but you would not be able to benefit from the Spigot ecosystem.</p>
</div>
</li>
</ol>
</li>
<li id="comment-246464" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://denbert.net" class="url" rel="ugc external nofollow">Denbert</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-07T21:05:50+00:00">July 7, 2016 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>Great readings &#8211; I&rsquo;ve tried alot on the PI2 with no luck &#8211; I&rsquo;ll be ordering a PI3 now and come back with feedback.</p>
<p>/ Dennis</p>
</div>
</li>
<li id="comment-246617" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65caee98ca2a9478e09c7b7b3768744d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65caee98ca2a9478e09c7b7b3768744d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-09T16:05:09+00:00">July 9, 2016 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>Just wanted to say thank you so much! I&rsquo;m very new to linux, but not new to minecraft. Just bought a Raspberry Pi 3 and was super excited to set it up, but naturally without programming basics, I had no idea how. Thanks to you my server is now up and running. Thanks man!</p>
</div>
</li>
<li id="comment-246756" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58f4a479292c4f0436e23f8fb174c9e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58f4a479292c4f0436e23f8fb174c9e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://greg-kennedy.com" class="url" rel="ugc external nofollow">Greg Kennedy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-11T23:08:11+00:00">July 11, 2016 at 11:08 pm</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the reason for installing Netatalk? That is a package used for sharing your stuff with Apple computers &#8211; using the RPi as an Apple (AFP) file server, Appletalk print server, etc. It does not seem at all necessary for getting Minecraft-server working.</p>
</div>
<ol class="children">
<li id="comment-246810" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-12T12:59:04+00:00">July 12, 2016 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s correct but my instructions should work whether you have a Mac, Windows or Linux PC. If you have a Mac, <tt>netatalk</tt> simply makes the Raspberry Pi discoverable by Macs and iOS devices (iPhone). Even if you do not need it, it does no harm and it does not require any effort. It is free convenience.</p>
</div>
</li>
</ol>
</li>
<li id="comment-246866" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b6431d2d4e5077bbea6a9135bcf33b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b6431d2d4e5077bbea6a9135bcf33b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-13T08:32:33+00:00">July 13, 2016 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>Thank you so much for your post.</p>
<p>How to uninstall BuildTools.jar (I executed the command: java -jar BuildTools.jar in my raspberry pi 2 with KODI) . I would like to install it in a new raspberry pi 3 without any other application. </p>
<p>Thank you in advance.</p>
<p>Julio</p>
</div>
<ol class="children">
<li id="comment-246965" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-14T14:51:58+00:00">July 14, 2016 at 2:51 pm</time></a> </div>
<div class="comment-content">
<p><em>How to uninstall BuildTools.jar</em></p>
<p>It doesn&rsquo;t get installed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-246893" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/53d3c195a611e6d74aca491b73e3b559?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/53d3c195a611e6d74aca491b73e3b559?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://reeltrash.com" class="url" rel="ugc external nofollow">RT</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-13T18:25:49+00:00">July 13, 2016 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>This is great! I&rsquo;m ordering a Pi 3 today, and this will be the first thing I put on it.</p>
</div>
</li>
<li id="comment-246979" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b6431d2d4e5077bbea6a9135bcf33b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b6431d2d4e5077bbea6a9135bcf33b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-07-14T16:36:59+00:00">July 14, 2016 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps my question is better in this way: </p>
<p>How to remove the installation of server (&#8230;) by executting command: java -jar BuildTools.jar? Should I remove directories (apache-maven, BuildData, Bukkit, CraftBukkit, Spigot and work) which were created by BuildTools? Anything else?</p>
<p>Thank you in advance,</p>
<p>Julio</p>
</div>
</li>
<li id="comment-248549" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4456fd6cdfb7c9fc46712b4d397a20a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4456fd6cdfb7c9fc46712b4d397a20a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mac</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-02T20:52:47+00:00">August 2, 2016 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>Great post &#8211; thank you! When setting RAMTMP=yes, the tmpfs file already includes some other parameters (commented out). Is it worth uncommenting any of these and/or modifying them? I have a Pi 2. Thanks!</p>
<p># Size limits. Please see tmpfs(5) for details on how to configure<br/>
# tmpfs size limits.<br/>
#TMPFS_SIZE=20%VM<br/>
#RUN_SIZE=10%<br/>
#LOCK_SIZE=5242880 # 5MiB<br/>
#SHM_SIZE=<br/>
#TMP_SIZE=</p>
<p># Mount tmpfs on /tmp if there is less than the limit size (in kiB) on<br/>
# the root filesystem (overriding RAMTMP).<br/>
#TMP_OVERFLOW_LIMIT=1024</p>
</div>
<ol class="children">
<li id="comment-248554" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-02T23:25:38+00:00">August 2, 2016 at 11:25 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know whether these other parameters need adjusting.</p>
</div>
</li>
</ol>
</li>
<li id="comment-248691" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b09685d18646c6f6e8d5296a62c66258?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b09685d18646c6f6e8d5296a62c66258?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Asher Straubing</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-04T19:54:09+00:00">August 4, 2016 at 7:54 pm</time></a> </div>
<div class="comment-content">
<p>I Keep getting a Connection lost error, It reads : Internal Exception: Java.io.IOEexception: And existing connection was forcibly closed by the remote host. After it boots me off the sever crashes and i need to reboot the server manually and just will crash 10-20 minutes later do you have any idea whats going on?</p>
</div>
<ol class="children">
<li id="comment-248699" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-04T21:47:13+00:00">August 4, 2016 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>I recommend restarting from the start, with a fresh image. Please follow the instructions carefully, step by step. They work reliably, but, unfortunately, too many people skip ahead or take liberties.</p>
</div>
</li>
</ol>
</li>
<li id="comment-248779" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8599144dff3d1ab386605cd6723d5886?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8599144dff3d1ab386605cd6723d5886?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">max</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-05T17:39:24+00:00">August 5, 2016 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>Hello, </p>
<p>I&rsquo;ve followed everything but the server wont run with &ldquo;java -Xms512M -Xmx1008M -jar spigot-1.10.2.jar nogui&rdquo;. I need to add a sudo in front.</p>
<p>The problem is that when I edit the minecraft.sh file by doing:<br/>
&ldquo;sudo screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M spigot-1.10.2.jar nogui &amp;&amp; break&rdquo;<br/>
or<br/>
&ldquo;screen -S minecraft -d -m sudo java -jar -Xms512M -Xmx1008M spigot-1.10.2.jar nogui &amp;&amp; break&rdquo;<br/>
the server doesn&rsquo;t restart when it crashes&#8230; I&rsquo;ve ran out of ideas to try and fix this. Help would be much appreciated.<br/>
Thanks in advance!<br/>
Max</p>
</div>
<ol class="children">
<li id="comment-248784" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-05T18:16:53+00:00">August 5, 2016 at 6:16 pm</time></a> </div>
<div class="comment-content">
<p><em>I&rsquo;ve followed everything but the server wont run with â€œjava -Xms512M -Xmx1008M -jar spigot-1.10.2.jar noguiâ€. I need to add a sudo in front.</em></p>
<p>Please start from a fresh image, follow the instructions exactly as they appear without taking any liberty. In particular, do not run the server as root.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249401" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d4e0c06e3017853a944dca278a1bf1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d4e0c06e3017853a944dca278a1bf1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-11T18:39:33+00:00">August 11, 2016 at 6:39 pm</time></a> </div>
<div class="comment-content">
<p>How am I able to freely make the server available on the Internet? Do I JUST need to portforward? I&rsquo;m confused<br/>
Thanks</p>
</div>
<ol class="children">
<li id="comment-249402" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-11T19:00:42+00:00">August 11, 2016 at 7:00 pm</time></a> </div>
<div class="comment-content">
<p>Opening up a server at home to the Internet through your Internet service provider requires some expertise beyond what you&rsquo;ll find in this blog post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249712" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1daa87d970c80ba93a68f7f065cbed93?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1daa87d970c80ba93a68f7f065cbed93?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Squ1zZy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-14T19:55:18+00:00">August 14, 2016 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>Works like a charm. Thanks!</p>
</div>
</li>
<li id="comment-250485" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b977e3380f2d6cdf0f8884b574ea3d30?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b977e3380f2d6cdf0f8884b574ea3d30?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-23T03:19:42+00:00">August 23, 2016 at 3:19 am</time></a> </div>
<div class="comment-content">
<p>Very nice and useful~~</p>
<p>Thanks</p>
</div>
</li>
<li id="comment-250642" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b929f6b9ef38a16f7393b3a2d5c8df2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b929f6b9ef38a16f7393b3a2d5c8df2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sburggsx</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-25T03:45:57+00:00">August 25, 2016 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>For a while now I have needed a script to restart a process running under screen on reboot. While it may sound simple, your script was exactly what I needed. Thanks for that!</p>
</div>
</li>
<li id="comment-252916" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7267b7ffeb654d23eafc78c42d57555e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7267b7ffeb654d23eafc78c42d57555e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-20T17:26:44+00:00">September 20, 2016 at 5:26 pm</time></a> </div>
<div class="comment-content">
<p>Hi, I am using your tutorial and I havent gotten very far yet, right now i am trying to make the server headless using the windows 10 bash shell (I also tried putty) but when I type the command to connect and make the raspi headless, I get this message &ldquo;Connect to host rasberrypi port 22: is temporarily unavailable&rdquo; Yes I did enable ssh in raspi config steps. Help please?</p>
</div>
<ol class="children">
<li id="comment-252954" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-21T01:56:50+00:00">September 21, 2016 at 1:56 am</time></a> </div>
<div class="comment-content">
<p>You should be getting a message about being unable to connect to &ldquo;raspberrypi.local&rdquo; not &ldquo;raspberrypi&rdquo; because I never wrote to connect to &ldquo;raspberrypi&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-263843" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/35243fc18c23bd4fc22587b2639bc540?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/35243fc18c23bd4fc22587b2639bc540?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-27T03:13:53+00:00">December 27, 2016 at 3:13 am</time></a> </div>
<div class="comment-content">
<p>i am having a similar issue mine says &ldquo;unable to open connection to raspberrypi.local Host does not exist&rdquo; i also tried using the IP address for it as well with the same result.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-253311" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef3893ef5232c5ad7a79573bd9c49d6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef3893ef5232c5ad7a79573bd9c49d6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stadtpirat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-24T17:08:54+00:00">September 24, 2016 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
thanks for the great tutorial! An improvement for you setup:</p>
<p>java -jar -server -Xms512M -Xmx1008M spigot-1.9.jar nogui</p>
<p>Everything below 2G heap space triggers Java to choose the client JVM, which lacks some performace features made for servers.</p>
<p><a href="http://docs.oracle.com/javase/8/docs/technotes/guides/vm/performance-enhancements-7.html" rel="nofollow ugc">http://docs.oracle.com/javase/8/docs/technotes/guides/vm/performance-enhancements-7.html</a></p>
<p>Memory footprint gets a little bigger(430 MB), but cpu load is much lower.</p>
</div>
<ol class="children">
<li id="comment-253539" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-26T13:42:43+00:00">September 26, 2016 at 1:42 pm</time></a> </div>
<div class="comment-content">
<p>Do you have benchmarks showing that the server flag actually improves the performance?</p>
</div>
<ol class="children">
<li id="comment-254296" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef3893ef5232c5ad7a79573bd9c49d6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef3893ef5232c5ad7a79573bd9c49d6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stadtpirat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-02T13:28:35+00:00">October 2, 2016 at 1:28 pm</time></a> </div>
<div class="comment-content">
<p>I checked cpu load with htop, and know what the flag does from my time as a former java-developer.<br/>
is there any good practice to benchmark a minecraft server under identical circumstances, to get robust and significant results?</p>
</div>
<ol class="children">
<li id="comment-254391" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-03T14:30:28+00:00">October 3, 2016 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>The main problem we face with respect to running a stable Minecraft server on a Raspberry Pi is running out of resources, including memory. We want to minimize &ldquo;pauses&rdquo; caused by garbage collection and, ultimately, we want to reduce the risk that we will run out of memory entirely.</p>
<p>If you run the server for any length of time with actual users, what you get are people who complain about latency. </p>
<p>So we want a JVM optimized for low-latency. </p>
<p>In this context, my question is whether the server flag will improve latency in low-memory conditions?</p>
<p>No. I do not know how to benchmark it, but I am uneasy about recommending an extra flag without any supporting evidence.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-253373" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4dcf8698f2db5e4eba1a46ec2dea296a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4dcf8698f2db5e4eba1a46ec2dea296a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathieu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-25T04:59:58+00:00">September 25, 2016 at 4:59 am</time></a> </div>
<div class="comment-content">
<p>Very intetesting tutoriel, I found here info that I never seen. </p>
<p>Quick question about Neither world, does it work ? I don&rsquo;t see in your tutorial that you deactivate it. </p>
<p>Thanks !</p>
</div>
<ol class="children">
<li id="comment-253540" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-26T13:43:19+00:00">September 26, 2016 at 1:43 pm</time></a> </div>
<div class="comment-content">
<p>If we do not disable it, then I suppose it should work.</p>
</div>
</li>
</ol>
</li>
<li id="comment-253391" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://denbert.net" class="url" rel="ugc external nofollow">Denbert</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-25T10:28:19+00:00">September 25, 2016 at 10:28 am</time></a> </div>
<div class="comment-content">
<p>Great tutorial &#8211; All though I cant get the startup script working:</p>
<p>if ! screen -list | grep -q &ldquo;minecraft&rdquo;; then<br/>
cd /home/minecraft<br/>
while true; do<br/>
screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M spigot-1.10.2.jar nogui &amp;&amp; break<br/>
done<br/>
fi</p>
<p>Yes, I&rsquo;m running it as user minecraft, therefore the /home/minecraft</p>
<p>If I run this command in the terminal as user minecraft in home dir, it runs great:</p>
<p>screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M spigot-1.10.2.jar nogui</p>
<p>Any suggestion, to point me in the right direction?</p>
</div>
<ol class="children">
<li id="comment-253542" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-26T13:43:52+00:00">September 26, 2016 at 1:43 pm</time></a> </div>
<div class="comment-content">
<p>You have to explain what this means : &ldquo;I cant get the startup script working&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-254158" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://denbert.net" class="url" rel="ugc external nofollow">Denbert</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-01T09:24:11+00:00">October 1, 2016 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Well &#8211; the Minecraft server donÂ´t start with the startup script.</p>
<p>minecraft@pi:~$ ./minecraft.sh</p>
<p>No errors, it just donÂ´t start</p>
<p>The monecraft.sh file has permission 755</p>
<p>/ Dennis</p>
</div>
</li>
<li id="comment-254159" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c813bafc60a2ae359f09606fe781943?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://denbert.net" class="url" rel="ugc external nofollow">Denbert</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-01T09:24:39+00:00">October 1, 2016 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Well &#8211; the Minecraft server donÂ´t start with the startup script.</p>
<p>minecraft@pi:~$ ./minecraft.sh</p>
<p>No errors, it just donÂ´t start</p>
<p>The minecraft.sh file has permission 755</p>
</div>
<ol class="children">
<li id="comment-254390" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-03T14:19:08+00:00">October 3, 2016 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p><em>the Minecraft server don&rsquo;t start with the startup script</em></p>
<p>Do this and report the result:</p>
<pre>
minecraft@pi:~$ ./minecraft.sh
minecraft@pi:~$ screen -r minecraft
</pre>
</div>
<ol class="children">
<li id="comment-264462" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da0f3f0657ebecba3815da160af8ab27?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da0f3f0657ebecba3815da160af8ab27?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thias Light</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-02T19:36:22+00:00">January 2, 2017 at 7:36 pm</time></a> </div>
<div class="comment-content">
<p>same issue, however; when i run the &lsquo;./minecraft.sh&rsquo; I&rsquo;m given a syntax error: unexpected end of file</p>
<p>I used an ssh client to copy and paste the code directly, making only the necessary spigot version change. Still can&rsquo;t figure it out.</p>
<p>Code follows:<br/>
if ! screen -list | grep -q &ldquo;minecraft&rdquo;; then<br/>
cd /home/pi/minecraft<br/>
while true; do<br/>
screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M<br/>
spigot-1.11.2.jar nogui &amp;&amp; break<br/>
done<br/>
fi</p>
</div>
<ol class="children">
<li id="comment-264531" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-03T15:40:49+00:00">January 3, 2017 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>What you reproduce in your comment is not a copy-paste of the code in the blog post. There are six lines of code, not seven. Please check again.</p>
</div>
<ol class="children">
<li id="comment-273064" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2dcc14e87555c6ebce75a8eed0b66e97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2dcc14e87555c6ebce75a8eed0b66e97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jimmy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-24T20:11:56+00:00">February 24, 2017 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>Hey Just so you know Most people do this on there raspberry pi. What you posted MAY look like 6 lines to you but when i pasted it it took 7 lines Everything is fixed but Not everyone has the same resolution you do. Try using a 1260&#215;1023 monitor and then BOOM 7 lines GET YO FACTS STRAIGHT!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-253550" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/915adfd94f08e5190436547606bf11ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/915adfd94f08e5190436547606bf11ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">erikg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-26T14:28:38+00:00">September 26, 2016 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>greetings, from the netherlands. Im installing minecraft server for my kids, but do not know anything about the game 😉<br/>
Installed the full raspian version in pi3 and followed your instructions. The server starts up and runs. The minecraft server is found in the minecraft client (on LAN). but cannot connect because of authentication failure. Internet search suggest disabling online-mode. Then the client can connect.<br/>
Any idea what the issue with the authentication ? Is it a problem is the online-mode stays disabled ?</p>
</div>
<ol class="children">
<li id="comment-253552" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-26T14:40:43+00:00">September 26, 2016 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>If you are running the server on your home network without exposing it to the Internet, you should be fine.</p>
</div>
</li>
</ol>
</li>
<li id="comment-253569" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bd838796c5b7846d61224dad9b49a507?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bd838796c5b7846d61224dad9b49a507?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-26T17:43:41+00:00">September 26, 2016 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>I just wanted to thank you for this tutorial. It was just what I needed.</p>
</div>
</li>
<li id="comment-254487" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/272504bb9490001ccee2b59079f6df84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/272504bb9490001ccee2b59079f6df84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-04T08:11:46+00:00">October 4, 2016 at 8:11 am</time></a> </div>
<div class="comment-content">
<p>My kid and I followed the instructions, except the netatalk installation as this is only for Apple. And we did do the automated starting of the server at reboot. My kid uses a different user than pi, and he did the whole instructions with this user. We made the minecraft.sh script and it worked. But once we adapted the RAMTMP setting and rebooted, we could not run the script anymore. It says: &ldquo;could not find minecraft.sh&rdquo; while we are in the folder containing the script, and where the jar file is. If we just start the command itself for the server, it works fine. We did do the chmod action.</p>
</div>
<ol class="children">
<li id="comment-254502" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-04T13:20:16+00:00">October 4, 2016 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>My instructions assume that the user is &ldquo;pi&rdquo;. You can still make it work if you take liberties and change your user name, but you then need to adapt the instructions accordingly.</p>
<p>I recommend that you follow the instructions as-is.</p>
</div>
<ol class="children">
<li id="comment-254523" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/272504bb9490001ccee2b59079f6df84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/272504bb9490001ccee2b59079f6df84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-04T18:37:25+00:00">October 4, 2016 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p>Thought so. Just bought additional sd cards, so we can try again. Keep you posted. Just thought it was weird that it worked before the reboot.</p>
</div>
</li>
</ol>
</li>
<li id="comment-261844" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T15:19:30+00:00">December 7, 2016 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>Try this to start the script:<br/>
./minecraft.sh<br/>
This assumes you are in the /minecraft directory.<br/>
The ./ forces the shell to look in the current directory, which doesn&rsquo;t alway exist in you path.<br/>
Nelson</p>
</div>
</li>
</ol>
</li>
<li id="comment-254644" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e37230d6bea7d95441048802f0cc615f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e37230d6bea7d95441048802f0cc615f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eric</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T12:22:47+00:00">October 5, 2016 at 12:22 pm</time></a> </div>
<div class="comment-content">
<p>How do you go about adding mods? tried doing a google search but was not able to find anything that was a straight, cut and dry step by step detailed list of instructions.</p>
</div>
<ol class="children">
<li id="comment-254655" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T13:44:50+00:00">October 5, 2016 at 1:44 pm</time></a> </div>
<div class="comment-content">
<p>I have instructions regarding plugins (please check my instructions again if you missed it).</p>
</div>
</li>
</ol>
</li>
<li id="comment-254898" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/121d978358d1dae04212ffffa69cec44?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/121d978358d1dae04212ffffa69cec44?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ferry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-07T15:20:44+00:00">October 7, 2016 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>hello daniel i thank you very match for the minecraft server.<br/>
everything is working. even minecraft.sh</p>
<p>Ferry a son of Marc</p>
</div>
<ol class="children">
<li id="comment-254902" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-07T15:33:10+00:00">October 7, 2016 at 3:33 pm</time></a> </div>
<div class="comment-content">
<p>Great.</p>
</div>
</li>
</ol>
</li>
<li id="comment-255419" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5eac1a7a653132f1d8e0960c5f2cdd2c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5eac1a7a653132f1d8e0960c5f2cdd2c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-12T10:59:00+00:00">October 12, 2016 at 10:59 am</time></a> </div>
<div class="comment-content">
<p>Excellent tutorial.<br/>
Went exactly as planned.</p>
<p>This is probably the first ever tutorial that actually worked exactly as explained.<br/>
Well done and thank you.</p>
</div>
</li>
<li id="comment-256123" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d61981b422a49168b931e256c8876260?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d61981b422a49168b931e256c8876260?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">hans</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T18:19:35+00:00">October 17, 2016 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>how many people can play at the same time (playerslot) ?</p>
</div>
<ol class="children">
<li id="comment-256126" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-17T19:17:21+00:00">October 17, 2016 at 7:17 pm</time></a> </div>
<div class="comment-content">
<p>I have not stress tested the server with respect to the number of users. A few certainly. </p>
<p>I&rsquo;d be interested in any numbers people have&#8230;</p>
</div>
<ol class="children">
<li id="comment-280027" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8686a332c8a896e31f695b51605c3be1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8686a332c8a896e31f695b51605c3be1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M.Lionheart</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-19T14:22:17+00:00">May 19, 2017 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m running it using a Pi 3 and a 375gb WD Pi Drive and the following mods: Dynmap, Multiverse, Multiverse Portals, Multiverse Netherportals. We have two fairly large world files we connect using Multiverse.</p>
<p>I&rsquo;ve ran concurrently with 6 people (2 local, and 4 remote). As long as we have it set to pause the dynmap renders when people login, we can all play normally with some occasional block update lag. It works about as well as when I used to play mc on the same pc that the mc server was run on. Generating a new Nether portal has caused a crash about a third of the time.</p>
<p>My friends and I are starting to look into using this method using a 4-node pi cluster. If we have any success I&rsquo;ll let you know.</p>
</div>
<ol class="children">
<li id="comment-565154" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aefb1891156a2a6bc9ca573a01a402ee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aefb1891156a2a6bc9ca573a01a402ee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-05T21:05:11+00:00">January 5, 2021 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>This may be a stupid question, but how do you connect remotely? As I understand, the server name is &ldquo;raspberrypi.local.&rdquo; Do you have to do something extra to connect remotely, and these instructions are just for local connections?</p>
<p>Thanks</p>
</div>
<ol class="children">
<li id="comment-565157" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-05T22:00:44+00:00">January 5, 2021 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>If you mean that you want to make the pi available on the Internet, it is covered in the guide.</p>
</div>
<ol class="children">
<li id="comment-565182" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aefb1891156a2a6bc9ca573a01a402ee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aefb1891156a2a6bc9ca573a01a402ee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-06T03:21:12+00:00">January 6, 2021 at 3:21 am</time></a> </div>
<div class="comment-content">
<p>Thanks</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-261845" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T15:20:35+00:00">December 7, 2016 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve run with 4 grandkids at one time. Did crash on occasion.</p>
</div>
<ol class="children">
<li id="comment-261852" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T16:42:46+00:00">December 7, 2016 at 4:42 pm</time></a> </div>
<div class="comment-content">
<p>Yes, sadly, it does crash. I haven&rsquo;t found a way to make it perfectly robust.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-256518" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d51a5ff402becd69df43749af010c8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d51a5ff402becd69df43749af010c8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jakob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-21T16:39:23+00:00">October 21, 2016 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>So i have the problem ./minecraft.sh&gt; line 4&gt; screen&gt; sommand not found and also when i type screen in console it says command not found. any suggestions</p>
</div>
<ol class="children">
<li id="comment-256519" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-21T17:11:35+00:00">October 21, 2016 at 5:11 pm</time></a> </div>
<div class="comment-content">
<p>You did not follow all of the instructions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-256725" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3705afed14a012ff2b0e9361249ca090?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3705afed14a012ff2b0e9361249ca090?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">CT</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-24T08:23:23+00:00">October 24, 2016 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel&#8230; Works like a charm&#8230;<br/>
Now to find tutorials to make our own mods for the server. Since this is a server, I don&rsquo;t suppose we can easily create custom mobs for the game? The client will need to know how the mobs work and the custom textures too&#8230;</p>
</div>
<ol class="children">
<li id="comment-256747" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-24T13:41:15+00:00">October 24, 2016 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>I am not a Minecraft expert, but I actually assume that you can change game textures without having to change anything at the server level.</p>
</div>
</li>
</ol>
</li>
<li id="comment-256808" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-25T06:26:18+00:00">October 25, 2016 at 6:26 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the tutorial Daniel. It&rsquo;s working for me as well.</p>
<p>And i&rsquo;m still running in graphic mode. Also running an Apache webserver. And changed my hostname. The server runs well for me.</p>
<p>A small thing, as a Raspberry Pi and Linux beginner, i had it little difficult with:<br/>
Install a couple of extra packages: sudo apt-get install netatalk screen. Do not skip this important step as we need screen. (The netatalk package is only needed if you have a Mac. In such cases, the netatalk allows your Mac to interact with the Pi more easily on the network.)<br/>
I luckily find out, if you do not have a Mac, you still have to run: sudo apt-get install screen.</p>
<p>To make the server accessible from the internet. You have to forward 25565 in your router to your local Raspberry-Pi IP address.</p>
<p>It&rsquo;s easy if you know some of routers, but if not, it&rsquo;s difficult to do. Since every home router isn&rsquo;t the same and Port Forward settings could be in an different place or naming.</p>
<p>I later found this site: <a href="https://portforward.com/softwareguides/minecraft/portforward-minecraft.htm" rel="nofollow ugc">https://portforward.com/softwareguides/minecraft/portforward-minecraft.htm</a> (when searching for RealVNC ports).</p>
</div>
<ol class="children">
<li id="comment-256837" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-25T13:19:37+00:00">October 25, 2016 at 1:19 pm</time></a> </div>
<div class="comment-content">
<p><em>I luckily find out, if you do not have a Mac, you still have to run: sudo apt-get install screen.</em></p>
<p>My recommendation is to run <tt>sudo apt-get install netatalk screen</tt> as made clear by the following comment (Do not skip this important step as we need screen.). For some reason, people seem to object to having to install netatalk. I don&rsquo;t understand why. But if you do object, then sure, type <tt>sudo apt-get install screen</tt>.</p>
</div>
<ol class="children">
<li id="comment-256869" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-25T20:47:53+00:00">October 25, 2016 at 8:47 pm</time></a> </div>
<div class="comment-content">
<p>I did not know netatalk and screen are two different applications. Also not knowing you can install mutiple applications in one line.</p>
<p>For a complete beginner, i would write it as: sudo apt-get install screen. And a second line sudo apt-get install netatalk.</p>
<p>So i think that is way some people think it&rsquo;s everything or nothing. And maybe they miss installing screen, because they don&rsquo;t have a Mac.</p>
</div>
<ol class="children">
<li id="comment-256875" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-25T21:28:14+00:00">October 25, 2016 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>I tell people to type <tt>sudo apt-get install netatalk screen</tt>. I then tell not to skip this important step.</p>
<p>If one decides to skip the command&#8230; I am not exactly sure what else I can do.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-256854" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6769ca23ec63dd9dc8bcbc44e43ed568?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6769ca23ec63dd9dc8bcbc44e43ed568?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Spencer Davis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-25T17:35:29+00:00">October 25, 2016 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>Hello. I greatly appreciate this post. Which leads me to my next question&#8230; I haven&rsquo;t played since 1.3.2 (minecraft) and want to host a modded server for myself and some friends. I mention my experience with the older version because I don&rsquo;t know<br/>
1) how to mod a server<br/>
2) I&rsquo;ve modded older clients<br/>
3) is it a similar process?<br/>
Thanks in advance, as I can&rsquo;t seem to find anything on this elsewhere.</p>
</div>
<ol class="children">
<li id="comment-256857" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-25T18:14:06+00:00">October 25, 2016 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>I honestly wouldn&rsquo;t know. I don&rsquo;t play Minecraft, I just learned how to setup a server.</p>
</div>
</li>
</ol>
</li>
<li id="comment-257510" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d36cd0abf1b19f6379ce1d4fcf7c213?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d36cd0abf1b19f6379ce1d4fcf7c213?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">doug henley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-29T14:49:21+00:00">October 29, 2016 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m running a pi 3 with Raspien and get an error message the jar file doesn&rsquo;t exist when I search ls spigot*.jar</p>
<p>Can you assist?</p>
</div>
</li>
<li id="comment-258448" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7727b535908580201d472cdc4245d78?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7727b535908580201d472cdc4245d78?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.roartech.com.au" class="url" rel="ugc external nofollow">Roary8383</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-04T23:07:07+00:00">November 4, 2016 at 11:07 pm</time></a> </div>
<div class="comment-content">
<p>Excellent tutorial. Thankyou for your time and effort to produce it. This is my FIRST raspberry Pi experience and everything has worked well :-).</p>
</div>
</li>
<li id="comment-258554" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bab5dd816da2a72495ab6a8e61917203?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bab5dd816da2a72495ab6a8e61917203?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://forums.fourtitude.com/member.php?u=1655393-SaundraRuckman" class="url" rel="ugc external nofollow">Vaughn</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-05T20:43:20+00:00">November 5, 2016 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>The order type is simple to complete and clearly asks for all wanted data.</p>
</div>
</li>
<li id="comment-258922" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21ae10e327c49774b9c3f622be76250d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21ae10e327c49774b9c3f622be76250d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-09T13:36:14+00:00">November 9, 2016 at 1:36 pm</time></a> </div>
<div class="comment-content">
<p>Ho Daniel, I wanted to know if with this server you can also play with a Android client.<br/>
Now I have installed, in my tablet, the v0.16.1 version of the Minecraft Pocket Edition.<br/>
Thanks</p>
</div>
<ol class="children">
<li id="comment-258928" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-09T14:06:07+00:00">November 9, 2016 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>@Alex I do not know but I suspect not. Minecraft Pocket Edition appears to be a different piece of software.</p>
</div>
</li>
</ol>
</li>
<li id="comment-259137" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75132aceeda56022b0d0186f200e3c3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75132aceeda56022b0d0186f200e3c3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathijs Planting</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-11T02:51:14+00:00">November 11, 2016 at 2:51 am</time></a> </div>
<div class="comment-content">
<p>So, I compiled it on my Chromebook instead (which only took a few min.), and ran the Spigot jar on my Raspberry Pi. Everything seemed to work, except I was getting some SSL security warnings. I couldn&rsquo;t figure out how to solve it, so I tried to compile it on the Raspberry Pi itself, which indeed took forever&#8230; When it was finally done it didn&rsquo;t create any jar file&#8230; I have no clue how to fix these warnings, hopefully someone can help me out.</p>
</div>
<ol class="children">
<li id="comment-259224" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/75132aceeda56022b0d0186f200e3c3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/75132aceeda56022b0d0186f200e3c3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathijs Planting</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-11T20:10:36+00:00">November 11, 2016 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p>My bad, I was running the lite version&#8230; Downloaded the full version, and everything&rsquo;s working fine now!</p>
<p>Thanks a lot for your awesome guide!</p>
</div>
</li>
</ol>
</li>
<li id="comment-259590" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bfe3021a758311b553bff9e1de0167a7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bfe3021a758311b553bff9e1de0167a7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anders Forslund</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-15T17:41:30+00:00">November 15, 2016 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel<br/>
Thanks so very much for creating these instructions! I followed them and everything worked well the first try and my kids have been playing with the server for several months.<br/>
Now it seems that we need to upgrade the server to the latest spigot. Could you please give some advice/help with instructions for how to do that as well?<br/>
/Anders</p>
</div>
<ol class="children">
<li id="comment-259594" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-15T18:38:38+00:00">November 15, 2016 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p>There is no safe way to do an in-place Spigot update, as far as I know. I would recommend starting from scratch with a fresh Raspbian installation, on a new SD card.</p>
</div>
<ol class="children">
<li id="comment-260359" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1e84ccc20c4220dca3f6f523a5ebdfb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1e84ccc20c4220dca3f6f523a5ebdfb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Corey Dryja</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-19T14:04:19+00:00">November 19, 2016 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>Just posted instructions on how to update the Spigot file. You&rsquo;ll need to run the Buildtools command again, pointing the command to the new Spigot file. Just posted instructions at the bottom of the thread. </p>
<p>The commands have been tested and it works.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-259958" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-17T07:23:10+00:00">November 17, 2016 at 7:23 am</time></a> </div>
<div class="comment-content">
<p>Whaaa, can&rsquo;t play Minecraft anymore.<br/>
Outdated server! I&rsquo;m still on 1.10.2. Is the message i got.<br/>
Does Spigot automatically change when Minecraft also changes to a new version?</p>
<p>Already found this post: <a href="https://www.spigotmc.org/threads/bukkit-craftbukkit-spigot-1-11-released.193887/" rel="nofollow ugc">https://www.spigotmc.org/threads/bukkit-craftbukkit-spigot-1-11-released.193887/</a> (from today).</p>
<p>I will read the post later. Kids are waking up, so daddy time for me. But my biggest question. When i do start al over. How can i create a backup from my current World? It would be nice NOT to start over in Minecraft as well.</p>
<p>I will post my experiences.</p>
</div>
</li>
<li id="comment-260357" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1e84ccc20c4220dca3f6f523a5ebdfb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1e84ccc20c4220dca3f6f523a5ebdfb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Corey Dryja</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-19T14:00:31+00:00">November 19, 2016 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s the fix to update the outdated Spigot file</p>
<p>All commands to be run in:<br/>
/home/pi/minecraft</p>
<p>1) rm craftbukkit-1.10.2.jar<br/>
2) rm spigot-1.10.2.jar<br/>
3) java -jar BuildTools.jar &#8211;rev 1.11<br/>
4) java -jar -Xms512M -Xmx1008M spigot-1.11.jar nogui</p>
<p>Don&rsquo;t forget to update your startup scripts.</p>
<p>Enjoy!</p>
</div>
</li>
<li id="comment-260467" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-20T10:09:43+00:00">November 20, 2016 at 10:09 am</time></a> </div>
<div class="comment-content">
<p>And it all works again!!</p>
<p>Spigot updated their server to version 1.11. With version 1.10.2 i could not play Minecraft anymore. â€œOutdated server! I&rsquo;m still on 1.10.2.â€ Is the message i got.</p>
<p>What i did:</p>
<p>I made a backup (copy) of the \world map. But this was not necessary. </p>
<p>sudo apt-get update<br/>
sudo apt-get upgrade<br/>
(do not know if is necessary)</p>
<p>After this i started the tutorial from point 11:<br/>
wget <a href="https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar" rel="nofollow ugc">https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar</a><br/>
(also not sure if it is necessasy)</p>
<p>Point 12:</p>
<p>java -jar BuildTools.jar &#8211;rev 1.11<br/>
The â€œ&#8211;rev 1.11â€ is necessary, because else toy still would get a spigot-1.10.2.jar file.</p>
<p>Point 13:<br/>
The eula.txt still exists with eula=true, so nothing to do here.</p>
<p>After this point you can start the minecraft server.</p>
<p>Mention point 15 where you have to change the version number in.</p>
<p>I did not remove any files. I did not make an new Raspbian image. Just an very ugly update, which is not ugly at all.</p>
<p>Hope this is clear enough for you.</p>
</div>
</li>
<li id="comment-260493" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e548823ef2a3cf67beb6b98ec5637fd2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e548823ef2a3cf67beb6b98ec5637fd2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">carlos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-20T16:02:29+00:00">November 20, 2016 at 4:02 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel<br/>
Thanks so very much for creating these tutorial!<br/>
I followed them and everything of instalation worked well, but how can i connect to the server from android devices?<br/>
Thanks in advanced</p>
</div>
</li>
<li id="comment-260495" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3c997106ad82dc40510f06cc4306ce5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3c997106ad82dc40510f06cc4306ce5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jordan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-20T16:14:55+00:00">November 20, 2016 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>Hi, thanks for the guide, It was very usefull to get the base server up and running on the pi<br/>
The next challenge is to put some mods on. This proved to be more challenging than dropping them into the mods folder.<br/>
1) get forge installer 1.7.10. Why 1.7.10? There are more mods for 1.7.10 than of the other MineCraft builds. Create a new dir called something like minecraft1.7.10 and copy it to the server via SFTP.<br/>
2) Run: sudo java -jar forge-1.7.10-10.13.4.1558-1.7.10-installer.jar &#8211;installServer. This will download the corresponding 1.7.10 server and make a universal file<br/>
3) Run: java -jar -Xms512M -Xmx1500M forge-1.7.10-10.13.4.1558-1.7.10-universal.jar nogui/ to start the server the first time. Change the eula.txt file described above and run again. Your base server is now setup<br/>
4) Get a 1.7.10 mod like copious dogs and copy it into the /minecraft1.7.10/mods dir<br/>
5) stop and start the server. monitor the startup with screen -r minecraft. You can usually see some messages about mods being loaded. </p>
<p>Client: The client and the server need to be at the same levels of mods and forge. It makes it a pain to get others on the server, but the mods make it much more fun.<br/>
1) On the client you also need the install of forge 1.7.10 with the UI choosing the client.<br/>
2) Download the same copious dogs mod as above version 1.7.10<br/>
3) start minecraft, create a new profile. Choose the forge 1.7.10 version and then open the game directory.<br/>
4) Copy the mod downloaded in step 3 into mods.<br/>
5) Start with the newly created profile and connect the server as before.<br/>
6) Check the inventory to see if you dogs. No dogs then review the steps above. </p>
<p>After you get the mods you want don&rsquo;t change them willy-nilly. If you have any remote players then you will need to redistribute them again.</p>
</div>
</li>
<li id="comment-260684" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cfb1e5fee4ddcfa89d6b97dfdafe58c2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cfb1e5fee4ddcfa89d6b97dfdafe58c2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-22T20:53:16+00:00">November 22, 2016 at 8:53 pm</time></a> </div>
<div class="comment-content">
<p>Just wanted to say thank you for this guide. I was able to get a server rolled out for my daughter and her friends after the public server they were on had some very perverted teenagers on it harassing her. </p>
<p>For those who want to update, its very easy to do by going to the spigotmc site and running the command to update usually linked on the site. Example, to update to the SpigotMC 1.11 server, run the command &ldquo;sudo java -jar BuildTools.jar &#8211;rev 1.11&rdquo; and then get another cup of coffee while it downloads and compiles.</p>
</div>
</li>
<li id="comment-260971" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b29c839400727c48061951dd4b781c1c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b29c839400727c48061951dd4b781c1c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Richard J Foster</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-25T15:40:14+00:00">November 25, 2016 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>Many thanks for these instructions. One weirdness I encountered that may be of interest to others: For some reason the router assigned by our ISP uses .home instead of .local as the local domain suffix. This meant that &ldquo;raspberrypi.local&rdquo; resolved to an entirely different (and public!) ip address. Fortunately I spotted it before going any further, and was able to confirm the correct local address using ifconfig on the Pi itself, and that &ldquo;raspberrypi.home&rdquo; did indeed resolve to the correct address.</p>
</div>
</li>
<li id="comment-261252" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d8d5b9e786ccb0bde06e17109aa0115e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d8d5b9e786ccb0bde06e17109aa0115e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Iain Henderson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-28T21:54:50+00:00">November 28, 2016 at 9:54 pm</time></a> </div>
<div class="comment-content">
<p>Debian Jessie is Systemd based which give you a slightly simpler startup script (as in you can just plug in the pi and have it startup)<br/>
Create the following file /etc/systemd/system/SpigotMC.service with the following contents:<br/>
[Unit]<br/>
Description=Spigot MineCraft Server</p>
<p>[Service]<br/>
User=minecraft<br/>
Group=minecraft<br/>
ExecStart=/usr/bin/screen -S minecraft -D -m /usr/bin/java -server -jar -Xms512M -Xmx1008M spigot-1.10.2.jar nogui<br/>
WorkingDirectory=/home/pi<br/>
Restart=on-failure<br/>
RestartSec=5s</p>
<p>[Install]<br/>
WantedBy=multi-user.target</p>
<p>If you create a symbolic link from the latest Spigot to spigot.jar (i.e. ln -sfT spigot-1.10.2.jar spigot.jar), then you can change that in the service and upgrade by updating the symlink.</p>
<p>Also control-a, control-d will detach from a screen session.</p>
</div>
<ol class="children">
<li id="comment-261253" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d8d5b9e786ccb0bde06e17109aa0115e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d8d5b9e786ccb0bde06e17109aa0115e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Iain Henderson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-28T21:57:35+00:00">November 28, 2016 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>Almost forgot, you&rsquo;ll need to enable it by running<br/>
sudo systemctl enable SpigotMC</p>
</div>
<ol class="children">
<li id="comment-261255" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d8d5b9e786ccb0bde06e17109aa0115e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d8d5b9e786ccb0bde06e17109aa0115e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Iain Henderson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-28T22:14:03+00:00">November 28, 2016 at 10:14 pm</time></a> </div>
<div class="comment-content">
<p>Finally, change<br/>
Restart=on-failure<br/>
to<br/>
Restart=always<br/>
And the server will restart if it encounters any trouble</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-261254" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/477ebe4db27731fc961d52d874d82b62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/477ebe4db27731fc961d52d874d82b62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">si</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-11-28T22:08:59+00:00">November 28, 2016 at 10:08 pm</time></a> </div>
<div class="comment-content">
<p>if only the rest of the internet was this helpful.<br/>
best tutorial if seen. and worked first time.<br/>
thanks</p>
</div>
</li>
<li id="comment-261846" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T15:30:46+00:00">December 7, 2016 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for the clear and precise tutorial. I&rsquo;ll ask this to the people who are following this blog as I&rsquo;m like Daniel and just set up the server for kids and grandkids. I&rsquo;ve been running 1.9.2 and all was well. After upgrading to 1.11 I can&rsquo;t get the windows java client to connect. I&rsquo;ve looked everywhere and I don&rsquo;t see how to get a Minecraft client on windows 10 to connect to 1.11.<br/>
Anyone out here have an answer?</p>
<p>Apologies to Daniel if this is too off topic.<br/>
Nelson</p>
</div>
<ol class="children">
<li id="comment-261848" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d67fcd982de654126cec4d8fe1fda97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-07T15:44:35+00:00">December 7, 2016 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>Kick self in head:<br/>
I had to change the profile in the Windows client to accept the latest version. I had set it to 1.9.2 a long time ago.</p>
</div>
</li>
</ol>
</li>
<li id="comment-262081" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8658fc0170703374815e940434cbfe82?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8658fc0170703374815e940434cbfe82?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nico</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-10T21:53:14+00:00">December 10, 2016 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the manual, works like a charm</p>
</div>
</li>
<li id="comment-263315" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edba03932a950af6a06242ea8bd685b4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edba03932a950af6a06242ea8bd685b4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://N/A" class="url" rel="ugc external nofollow">M</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-21T05:13:48+00:00">December 21, 2016 at 5:13 am</time></a> </div>
<div class="comment-content">
<p>Hi, this may be a silly question:<br/>
How do I adjust this tutorial to play Minecraft 1.8 instead of the more recent 1.11?<br/>
Thanks!</p>
</div>
</li>
<li id="comment-263335" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e555154d35596a3543b47c7b77a584eb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e555154d35596a3543b47c7b77a584eb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cooth</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-21T13:54:10+00:00">December 21, 2016 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>Thanks also for the tutorial. had it working for a bit but must have changed something and make a mistake in one of the lines of code as when the raspberry pi restarts it constantly comes up with</p>
<p>/home/pi/minecraft/minecraft.sh: line 3: screen: command not found</p>
<p>Is there anyway to stop it automatically running so I can fix it?</p>
</div>
<ol class="children">
<li id="comment-278180" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2dcc14e87555c6ebce75a8eed0b66e97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2dcc14e87555c6ebce75a8eed0b66e97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://none" class="url" rel="ugc external nofollow">Jimmy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-17T15:29:48+00:00">April 17, 2017 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>&#8230; did you not do this command? &ldquo;sudo apt-get install netatalk screen&rdquo;? or this one? &ldquo;sudo apt-get install screen&rdquo;??? &lt;&#8212; is the problem. next time dont skip a step XD</p>
</div>
</li>
</ol>
</li>
<li id="comment-263842" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/35243fc18c23bd4fc22587b2639bc540?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/35243fc18c23bd4fc22587b2639bc540?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-27T03:08:40+00:00">December 27, 2016 at 3:08 am</time></a> </div>
<div class="comment-content">
<p>Hi I am trying to get my PC connected to the server by ssh but when i type the name it says that the host does not exist. Please help!</p>
</div>
<ol class="children">
<li id="comment-294929" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4f4071b8f11df7e52fbf0a24cabd9da7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4f4071b8f11df7e52fbf0a24cabd9da7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Seb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-14T10:11:51+00:00">January 14, 2018 at 10:11 am</time></a> </div>
<div class="comment-content">
<p>You need the IP address, if you did not by any chance set up DNS in your local network. 😉</p>
</div>
</li>
</ol>
</li>
<li id="comment-264312" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fff0d694131da583c20cdc748d740d42?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fff0d694131da583c20cdc748d740d42?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Logan Kuzyk</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-01T02:20:10+00:00">January 1, 2017 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, thanks for making this very comprehensive and helpful guide. </p>
<p>I got the server working when I manually started it from the command line but I just can&rsquo;t seem to get it working with the minecraft.sh file. It brings me back to the shell as the instructions said it should but when I type screen -r minecraft it says &ldquo;There is no screen to be resumed matching minecraft.&rdquo;</p>
<p>Any help would be appreciated.</p>
</div>
<ol class="children">
<li id="comment-264315" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fff0d694131da583c20cdc748d740d42?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fff0d694131da583c20cdc748d740d42?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Logan Kuzyk</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-01T02:35:01+00:00">January 1, 2017 at 2:35 am</time></a> </div>
<div class="comment-content">
<p>I re-wrote the minecraft.sh file and everything seems to be working fine, thanks anyway!</p>
</div>
<ol class="children">
<li id="comment-264463" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da0f3f0657ebecba3815da160af8ab27?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da0f3f0657ebecba3815da160af8ab27?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thias Light</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-02T19:47:28+00:00">January 2, 2017 at 7:47 pm</time></a> </div>
<div class="comment-content">
<p>Did you make any changes? I&rsquo;m getting a &ldquo;syntax error: unexpected end of file&rdquo;</p>
</div>
<ol class="children">
<li id="comment-264532" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-03T15:41:22+00:00">January 3, 2017 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>No. The code is the same and it is well tested.</p>
</div>
</li>
</ol>
</li>
<li id="comment-264482" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da0f3f0657ebecba3815da160af8ab27?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da0f3f0657ebecba3815da160af8ab27?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thias Light</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-03T02:09:17+00:00">January 3, 2017 at 2:09 am</time></a> </div>
<div class="comment-content">
<p>Did you change anything in the re-write?</p>
</div>
<ol class="children">
<li id="comment-264533" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-03T15:41:37+00:00">January 3, 2017 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>There is no &ldquo;re-write&rdquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-264730" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dfbb36ee40a571fe02b3f89272d339b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dfbb36ee40a571fe02b3f89272d339b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.raphaelcreton.com" class="url" rel="ugc external nofollow">RaphaÃ«l</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-05T12:44:16+00:00">January 5, 2017 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>Hello everyone,<br/>
I found surprisingly a way to update everything to the last version of Minecraft.<br/>
Now it would be absolutely great if someone could point me to a way to enable / apply on this Minecraft server, Python scriptsâ€¦</p>
</div>
</li>
<li id="comment-265525" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b260b60c27ec6bde51ce7bdd91b85e06?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b260b60c27ec6bde51ce7bdd91b85e06?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gregger</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-11T12:09:07+00:00">January 11, 2017 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>For everyone getting Errors:<br/>
The new Version 1.11.2. (Dec16/Jan17) seems to be broken. You will get Errors after the &ldquo;java -jar BuildTools.jar&rdquo; command (but first your Pi will work for hours &#8230;). There is nothing wrong with Daniels guide 🙂<br/>
I just keep on using the old version (i tried the update on a different sd-card) and ignore the &ldquo;please update your server&rdquo; message. So you can either use the old version or wait for an update.</p>
</div>
<ol class="children">
<li id="comment-265662" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9dfbb36ee40a571fe02b3f89272d339b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9dfbb36ee40a571fe02b3f89272d339b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.raphaelcreton.com" class="url" rel="ugc external nofollow">RaphaÃ«l</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-12T10:17:40+00:00">January 12, 2017 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>Hello Gregger,<br/>
just a quick note to let you know that the Minecraft Launcher 1.6.70 + Minecraft version 1.11.2 is working on the Raspberry Pi 3 I updated ( without understanding a thing ).</p>
</div>
</li>
<li id="comment-272045" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/108803af5c085e5f8b6dabc530e8b327?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/108803af5c085e5f8b6dabc530e8b327?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adriano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-17T20:23:45+00:00">February 17, 2017 at 8:23 pm</time></a> </div>
<div class="comment-content">
<p>So what do we do to get this working now?</p>
</div>
</li>
</ol>
</li>
<li id="comment-266143" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8571b3601626266a0686a18f5189eca7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8571b3601626266a0686a18f5189eca7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christian Jung</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-15T23:36:34+00:00">January 15, 2017 at 11:36 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel,</p>
<p>very thorough tutorial! Thank you very much. But since I had a hard time to get the server running after each reboot I thought I share my finding here (I am running Raspbian GNU/Linux 8 (jessie)). I finally got things going with a different approach. I start the server via cron job and not via a call from rc.local. </p>
<p>This done as follows:</p>
<p>type &ldquo;crontab -e&rdquo; in the terminal and in the editor you must add the following line:</p>
<p>@reboot /home/pi/minecraft/minecraft.sh</p>
<p>Be sure to have an empty line after this line if it is the last line in the script and save it. An output stating &ldquo;crontab: installing new crontab&rdquo; should appear. Finally you should remove the call of the minecraft.sh script from the rc.local file.</p>
<p>Do a reboot and enjoy 🙂</p>
</div>
<ol class="children">
<li id="comment-266245" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-16T14:33:57+00:00">January 16, 2017 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>The &ldquo;@reboot&rdquo; command in cron is finicky.</p>
<p>The best way to run Minecraft as a server would be to setup a service.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267337" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d390c06560def8f0ed2cc9c50bbdb751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d390c06560def8f0ed2cc9c50bbdb751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathaniel Deimler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-22T21:35:02+00:00">January 22, 2017 at 9:35 pm</time></a> </div>
<div class="comment-content">
<p>thanks for the tutorial. the server appears to be running but minecraft will not connect to it. the error message says failed to connect to server. unknown host name. I was wondering how to fix this. Thanks</p>
</div>
</li>
<li id="comment-269758" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25b1b3b1c256495965cdffedcef02132?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25b1b3b1c256495965cdffedcef02132?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">joshua</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-04T21:07:09+00:00">February 4, 2017 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>sudo apt-get install netatalk screen avahi-daemon. this doesnt work everything fails</p>
</div>
</li>
<li id="comment-269779" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25b1b3b1c256495965cdffedcef02132?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25b1b3b1c256495965cdffedcef02132?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">joshua</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-05T00:21:34+00:00">February 5, 2017 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Start the server again using the script: ./minecraft.sh. It will return you to the shell. To access the console of the server type screen -r minecraft, to return to the shell type ctrl-a d. At any point, you can now disconnect from the server. The server is still running. You do not need to remain connected to the Raspberry Pi.</p>
<p>this is the point where it stops working. once i put in ./minecraft.sh it spams me with errors.</p>
<p>i also have no idea what shell or console mean in this setting. </p>
<p> the server is also directly connected to my computer and shuts of once i exit out of the terminal. i would love some help if anyone could offer assistance.</p>
</div>
</li>
<li id="comment-271915" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Griffon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-16T18:50:15+00:00">February 16, 2017 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>So I&rsquo;m wondering if did something wrong. It&rsquo;s taking hours to stat the mincraft server on a pi3<br/>
endless<br/>
[18:46:40 INFO]: Preparing spawn area: 16%<br/>
[18:46:42 INFO]: Preparing spawn area: 16%<br/>
It dose this every time it starts&#8230;<br/>
Any thoughts on how long it should take or where the wheels came off?<br/>
I have one build difference, which is it&rsquo;s running on retropi build instead the main line (I will be getting another card to test a straight build).<br/>
Thanks</p>
</div>
<ol class="children">
<li id="comment-271922" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-16T20:59:09+00:00">February 16, 2017 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p><em>It&rsquo;s taking hours to stat the mincraft server on a pi3</em></p>
<p>I think that &ldquo;hours&rdquo; is a big long, but it should definitively take a long time to start the server initially. The instructions say: &ldquo;Start the server (&#8230;) It will take forever (&#8230;) Go drink more coffee.&rdquo;</p>
</div>
<ol class="children">
<li id="comment-272170" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Griffon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-19T04:57:50+00:00">February 19, 2017 at 4:57 am</time></a> </div>
<div class="comment-content">
<p>Yeah, I read that thanks&#8230;. but this was a crazy over night build time, also once up rubber banding while connected was unplayable nothing animated or moved right.</p>
<p>I did fresh build today on noobs and every thing seems to be better. Build times are are seconds not hours per percent&#8230; Whole intial load took maybe 5 minutes now.<br/>
I think something with the retropi build was messed up bad and either hogging the CPU or something with the java version.<br/>
Anyway pretty sure starting over on a new card (as suggested in the doc) was the right way to go.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-273192" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6cc9b9724e6a95c8156155c0419b1fe2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6cc9b9724e6a95c8156155c0419b1fe2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">donaldo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-26T08:19:37+00:00">February 26, 2017 at 8:19 am</time></a> </div>
<div class="comment-content">
<p>sigh, errors</p>
<p>Checked out: d4f98a3918e69673b2c0486b5651c5fe912b3c8d<br/>
Attempting to build Minecraft with details: VersionInfo(minecraftVersion=1.11.2, accessTransforms=bukkit-1.11.2.at, classMappings=bukkit-1.11.2-cl.csrg, memberMappings=bukkit-1.11.2-members.csrg, packageMappings=package.srg, minecraftHash=e576e5eb43cd176158917585200cb37d, decompileCommand=java -jar BuildData/bin/fernflower.jar -dgs=1 -hdc=0 -asc=1 -udv=0 {0} {1}, serverUrl=https://launcher.mojang.com/mc/game/1.11.2/server/f00c294a1576e03fddcac777c3cf4c7d404c4ba4/server.jar)<br/>
Found good Minecraft hash (e576e5eb43cd176158917585200cb37d)<br/>
Found good Minecraft hash (e576e5eb43cd176158917585200cb37d)<br/>
Final mapped jar: work/mapped.22de4839.jar does not exist, creating!<br/>
Exception in thread &ldquo;main&rdquo; java.lang.OutOfMemoryError: Java heap space<br/>
at org.objectweb.asm.tree.MethodNode.visitVarInsn(MethodNode.java:433)<br/>
at org.objectweb.asm.ClassReader.readCode(ClassReader.java:1343)<br/>
at org.objectweb.asm.ClassReader.readMethod(ClassReader.java:1017)<br/>
at org.objectweb.asm.ClassReader.accept(ClassReader.java:693)<br/>
at org.objectweb.asm.ClassReader.accept(ClassReader.java:506)<br/>
at net.md_5.ss.repo.JarRepo.getClass0(JarRepo.java:38)<br/>
at net.md_5.ss.repo.ClassRepo.getClass(ClassRepo.java:22)<br/>
at net.md_5.ss.repo.AggregateRepo.getClass0(AggregateRepo.java:30)<br/>
at net.md_5.ss.repo.ClassRepo.getClass(ClassRepo.java:22)<br/>
at net.md_5.ss.remapper.EnhancedRemapper.findMethodDeclarer(EnhancedRemapper.java:67)<br/>
at net.md_5.ss.remapper.EnhancedRemapper.mapMethodName(EnhancedRemapper.java:33)<br/>
at net.md_5.ss.remapper.MethodRemapper.visitMethodInsn(MethodRemapper.java:120)<br/>
at org.objectweb.asm.ClassReader.readCode(ClassReader.java:1429)<br/>
at org.objectweb.asm.ClassReader.readMethod(ClassReader.java:1017)<br/>
at org.objectweb.asm.ClassReader.accept(ClassReader.java:693)<br/>
at org.objectweb.asm.ClassReader.accept(ClassReader.java:506)<br/>
at net.md_5.ss.model.ClassInfo.remap(ClassInfo.java:120)<br/>
at net.md_5.ss.SpecialSource.map(SpecialSource.java:96)<br/>
at net.md_5.ss.SpecialSource.main(SpecialSource.java:44)<br/>
Exception in thread &ldquo;main&rdquo; java.lang.RuntimeException: Error running command, return status !=0: [java, -jar, BuildData/bin/SpecialSource-2.jar, map, -i, work/minecraft_server.1.11.2.jar, -m, BuildData/mappings/bukkit-1.11.2-cl.csrg, -o, work/mapped.22de4839.jar-cl]<br/>
at org.spigotmc.builder.Builder.runProcess(Builder.java:561)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:319)</p>
</div>
<ol class="children">
<li id="comment-273373" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-27T21:16:59+00:00">February 27, 2017 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>Can you type &ldquo;free&rdquo; and report on the result?</p>
</div>
</li>
</ol>
</li>
<li id="comment-273668" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca74fd8c4327e821f7a875173394fe36?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca74fd8c4327e821f7a875173394fe36?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jem</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T19:15:50+00:00">March 2, 2017 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>Set up a Pi3 with your instructions a few months ago and everything worked beautifully. Thank you for the detailed instructions! Did a new build recently with latest version of Raspbian and Minecraft 1.11.2. The server came together fine and we have been able to play Minecraft from our local network but I had to set up everything with monitor/keyboard attached. I was never able to access via SSH. SSH was enabled and a port scan showed port 22 is open. Using Putty it seemed to contact the Pi and I got a login prompt but when I entered password is came back with &ldquo;access denied&rdquo;. Any suggestions on how to get SSH access to work? Using monitor/keyboard is fine but isn&rsquo;t very convenient for maintaining the server. Thanks!</p>
</div>
<ol class="children">
<li id="comment-273676" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T20:43:44+00:00">March 2, 2017 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p><em>I got a login prompt but when I entered password is came back with â€œaccess deniedâ€. </em></p>
<p>What is your user name and password?</p>
</div>
</li>
</ol>
</li>
<li id="comment-274206" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43dc064727154c918aea4af8249c9fc5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43dc064727154c918aea4af8249c9fc5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander larsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-06T15:01:22+00:00">March 6, 2017 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>Hey Daniel </p>
<p>tried your guide last night on a raspberry3 and was delighted when i got the server up and running 😀 Great guide. </p>
<p>But i did have trouble connecting to the server&#8230; but after some debugging i found that the fault was on me.<br/>
I didÂ´t know that the server was for minecraft desktop only :-S</p>
<p>Tried to install a Minecraft PE server called pocketmine using a different guide, but still using elements of your guides (script, screen ,mem setup&#8230; )<br/>
I did succeed to get the server up and running, But there were no mobs and i think it was low performance i terms of graphics (lagging when i run fast and loading slowly) </p>
<p>Do you have any advice regarding PE servers ??</p>
</div>
<ol class="children">
<li id="comment-274209" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-06T15:33:11+00:00">March 6, 2017 at 3:33 pm</time></a> </div>
<div class="comment-content">
<p><em>Do you have any advice regarding PE servers ??</em></p>
<p>I do not have any experience with PE servers, sorry.</p>
</div>
<ol class="children">
<li id="comment-274316" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43dc064727154c918aea4af8249c9fc5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43dc064727154c918aea4af8249c9fc5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander larsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-07T07:42:54+00:00">March 7, 2017 at 7:42 am</time></a> </div>
<div class="comment-content">
<p>Its okay 🙂 </p>
<p>I took the easy way out.<br/>
Had a almost broken android (asus transformer TF701) were the screen was broken.<br/>
plugged it in and turned down the light on the screen. Started up a minecraftPE game and shared it.<br/>
NOT pretty but it worked for now.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-275132" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c4c56320cc738b6cb796d19e8de04d6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c4c56320cc738b6cb796d19e8de04d6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Artur</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-13T04:06:55+00:00">March 13, 2017 at 4:06 am</time></a> </div>
<div class="comment-content">
<p>Amazingly done, followed your guide and now I have a home server, thnaks a lot for the time you put into it!</p>
</div>
</li>
<li id="comment-275218" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b7e092d4f1cc5cec1b3fd6a56c496fef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b7e092d4f1cc5cec1b3fd6a56c496fef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-14T00:57:30+00:00">March 14, 2017 at 12:57 am</time></a> </div>
<div class="comment-content">
<p>Thank you so much for the help with this! </p>
<p>One question though: is it okay to drink tea in the steps where you said to drink coffee?</p>
</div>
<ol class="children">
<li id="comment-275224" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-14T01:37:53+00:00">March 14, 2017 at 1:37 am</time></a> </div>
<div class="comment-content">
<p><em>One question though: is it okay to drink tea in the steps where you said to drink coffee?</em></p>
<p>I make my coffee from green beans that I have to roast and then grind. This is necessary to make sure that I can be sufficiently patient. I don&rsquo;t know what the equivalent would be with tea.</p>
</div>
<ol class="children">
<li id="comment-275234" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b7e092d4f1cc5cec1b3fd6a56c496fef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b7e092d4f1cc5cec1b3fd6a56c496fef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-14T03:42:33+00:00">March 14, 2017 at 3:42 am</time></a> </div>
<div class="comment-content">
<p>yeah good point it&rsquo;s pretty quick to steep some tea&#8230;</p>
<p>I actually have a quick question or two:</p>
<p>1. I noticed that I need to be able to SSH into my Pi for the server to become available, but as soon as I&rsquo;m in I can disconnect it and it still works. Why is this?</p>
<p>2. A good 70% of my ssh attempts end up with this error:<br/>
&ldquo;ssh: Could not resolve hostname raspberrypi.local: nodename nor servname provided, or not known&rdquo;,<br/>
and sometimes this error:<br/>
&ldquo;ssh: connect to host raspberrypi.local port 22: Host is down&rdquo;<br/>
Is there any specific reason behind this? I&rsquo;m on University wifi (both Pi and MacBook Pro) and the connection seems solid (although I realize this would be much nicer and secure on a personal network). For example, when I&rsquo;m actually on the server or in the just in my Mac terminal with the ssh, connection is steady. But as soon as I exit it and start trying to ssh again, it becomes stubborn. One thought is it may have something to do with other Pis on my university&rsquo;s network or something like that. I&rsquo;m not sure though- just a networking noob here.</p>
</div>
<ol class="children">
<li id="comment-275338" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-14T22:45:32+00:00">March 14, 2017 at 10:45 pm</time></a> </div>
<div class="comment-content">
<p><em>I noticed that I need to be able to SSH into my Pi for the server to become available, but as soon as I&rsquo;m in I can disconnect it and it still works. Why is this?</em></p>
<p>Minecraft does not use ssh. We use ssh just to manage the server. Without ssh, you would need to connect to the Raspberry Pi physically to manage it (which means actually use a keyboard and a screen connected to it).</p>
<p><em>A good 70% of my ssh attempts end up with this error (&#8230;) I&rsquo;m on University wifi (both Pi and MacBook Pro) </em></p>
<p>I draw your attention to the following segment in my instructions:</p>
<blockquote><p>If you are going to use the Raspberry Pi, it is best to connect it directly to your router: wifi is slower, more troublesome and less scalable. I have had no end of trouble trying to run a Raspberry Pi server using wifi: I don&rsquo;t know whether it is possible.</p></blockquote>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-275781" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95399ad6042f348f20ff2df1713fe883?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95399ad6042f348f20ff2df1713fe883?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-18T19:46:14+00:00">March 18, 2017 at 7:46 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>I came across a Raspberry Pi 3 Model B on-the-cheap at MicroCenter. Grabbed it and scoured for a good Minecraft Server guide. Yours was the best I came across.</p>
<p>I currently have it up and running perfectly! No issues with the guide! Thank-you.</p>
<p>Even have a free No-Ip service established. The Pi is plugged into a Kill-o-Watt&#8230;I&rsquo;m curious how much power it will consume over time. So far it hangs around 1.7&#8211;&gt;1.9 watts. Big whoop!</p>
<p>Cheers 🙂</p>
</div>
</li>
<li id="comment-275788" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/20dc6ea83b136eac66600d164fd247a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/20dc6ea83b136eac66600d164fd247a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-18T22:09:56+00:00">March 18, 2017 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, thanks for these instructions. Worked like a dream and I learned lots too. Also managed to extend it to working with Mods which my boy was very pleased about. Thank you.</p>
</div>
</li>
<li id="comment-275925" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95399ad6042f348f20ff2df1713fe883?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95399ad6042f348f20ff2df1713fe883?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-20T11:15:47+00:00">March 20, 2017 at 11:15 am</time></a> </div>
<div class="comment-content">
<p>Daniel, </p>
<p>I wrote a quick cron job to do a nightly Raspbian reboot at 4AM. Seems to help free some lost RAM. </p>
<p>Realized I&rsquo;m not &ldquo;stop&rdquo;ing the server with that&#8230; So it&rsquo;s not doing a proper shutdown. How could I tie your scripts together with an idea like this to ensure it&rsquo;s always running, yet reboots nightly? </p>
<p>Thank-you!</p>
</div>
<ol class="children">
<li id="comment-275936" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-20T14:19:50+00:00">March 20, 2017 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p>I am not sure that rebooting periodically is generally a good idea. It is should be possible to let a Linux machine run for days, weeks, months&#8230; without problem. Certainly, I would not force a reboot as you may corrupt your data files. If you must reboot automatically, consider setting up minecraft as a service (e.g., <a href="https://github.com/Ahtenus/minecraft-init" rel="nofollow ugc">https://github.com/Ahtenus/minecraft-init</a>). Doing so is beyond the scope of my tutorial, however.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276369" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33efc463544a789a4c0fc99be9b64b7d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33efc463544a789a4c0fc99be9b64b7d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ced</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-25T16:51:52+00:00">March 25, 2017 at 4:51 pm</time></a> </div>
<div class="comment-content">
<p>Very precise tutorial ! Works fine with lastest version of Minecraft (1.11.2).<br/>
I have just a problem with hostname of the raspberry : i connect it with the IP adress.<br/>
It&rsquo;s not a big problem and not linked with Minecraft (SSH connection work&rsquo;s also uniquely with IP Adress).</p>
<p>Thank you again for your tuto !</p>
</div>
</li>
<li id="comment-276412" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ead7b42d2c13e9f9e0cdbb21516331c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ead7b42d2c13e9f9e0cdbb21516331c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Minimon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-26T14:00:46+00:00">March 26, 2017 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>Hey</p>
<p>Just created a server using your tutorial and made it available on the internet for my friends (by openning port 25565).<br/>
I had a question tho, is it possible to use a world we already used before? I was thinking about just copy pasting the world folder on the sd card but it looks like a bad practice.</p>
<p>And thanks a lot for the tutorial.</p>
</div>
<ol class="children">
<li id="comment-276482" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-27T15:22:11+00:00">March 27, 2017 at 3:22 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>I had a question tho, is it possible to use a world we already used before? I was thinking about just copy pasting the world folder on the sd card but it looks like a bad practice.</p></blockquote>
<p>I think that if you shut down the server before doing what you suggest, it should work fine.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276495" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a68d279a89dd5f5ed976da07d19dd24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a68d279a89dd5f5ed976da07d19dd24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eduardo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-27T20:39:56+00:00">March 27, 2017 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>Hello. Thanks for your job, its a awesome tutorial.</p>
<p>What do you suggest to do for restarting the server if it crash?<br/>
I mean, some script that runs periodically your initial script or something more fine-tuning?</p>
<p>thanks</p>
</div>
<ol class="children">
<li id="comment-276537" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a68d279a89dd5f5ed976da07d19dd24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a68d279a89dd5f5ed976da07d19dd24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eduardo MoÃ±ino Esteban</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-28T09:52:34+00:00">March 28, 2017 at 9:52 am</time></a> </div>
<div class="comment-content">
<p>Thanks for your quick answer.</p>
<p>Can you explain me why it would restart?</p>
<p>The script checks if there is a &ldquo;screen&rdquo; named minecraft, and if there isn&rsquo;t it launch minecraft in a new screen named minecraft and breaks the loop if it has launched ok.</p>
<p>After that, the script ends, it&rsquo;s not running any more. So if minecraft crashes or if the screen get deleted, it wouldn&rsquo;t relaunch because the script it&rsquo;s not running anymore.</p>
<p>Plus, if minecraft crashes, you still have the &ldquo;minecraft screen&rdquo; created, so even if the script is still running (don&rsquo;t know how), it wouldn&rsquo;t relaunch mincraft because it would find the screen named &ldquo;minecraft&rdquo;</p>
<p>Thanks in advance, I hope you can find few minutes to answer. </p>
<p>Nice day</p>
</div>
<ol class="children">
<li id="comment-276576" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-28T17:57:44+00:00">March 28, 2017 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>I think you mean: what happens if the java command starts the server successfully, but later the server crashes.</p>
<p>I have not put it to the test, but I think that the following should do:</p>
<pre>
until java ... ; do
    sleep 5
done
</pre>
<p>This should be called by screen, of course.</p>
<p><em>Plus, if minecraft crashes, you still have the â€œminecraft screenâ€ created, so even if the script is still running (don&rsquo;t know how), it wouldn&rsquo;t relaunch mincraft because it would find the screen named â€œminecraftâ€</em></p>
<p>I don&rsquo;t think it is true. If the Java command terminates somehow, the screen thread will terminate as well.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-277552" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0c40b09709844996550b1b764a66762e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0c40b09709844996550b1b764a66762e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Greg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-07T13:20:41+00:00">April 7, 2017 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, </p>
<p>Just bought my daughter an raspberry, does installing minecraft on rp3 give you additional tools/experiences different from Minecraft other traditional platforms? Or is it a similar experience but it&rsquo;s just cool that you created a new platform to play on?</p>
</div>
<ol class="children">
<li id="comment-277554" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-07T13:53:25+00:00">April 7, 2017 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>I think that I answer this question in the last paragraph of the post. It is not going to provide you with a more powerful Minecraft server, obviously. The benefits, if any, are elsewhere.</p>
<p>I just did it as a fun demonstration of what could be done.</p>
</div>
</li>
</ol>
</li>
<li id="comment-278091" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-16T11:15:05+00:00">April 16, 2017 at 11:15 am</time></a> </div>
<div class="comment-content">
<p>Great post Daniel, works a treat. Would be great to add an edit/update at the end of the article on how to update the server to the latest build.</p>
</div>
</li>
<li id="comment-278532" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d90068879ea81d59076cb4f34a29b17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d90068879ea81d59076cb4f34a29b17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Na</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-22T18:26:42+00:00">April 22, 2017 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>Great article, easy and everything worked out good. I do have question on maximum capacity of the player. I see currently it is set to 20 and my son asked if it can be higher. Have you seen the limit with setting you suggested above? I am using Pi 2.</p>
</div>
<ol class="children">
<li id="comment-278588" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-23T18:35:16+00:00">April 23, 2017 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>You should expect higher latency and less stability as the number of simultaneous players increase. I have not tested the server with anything close to 20 simultaneous players. I have run out of children.</p>
</div>
</li>
</ol>
</li>
<li id="comment-278617" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd15d35961a47fd0263626cdcd2d0b31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd15d35961a47fd0263626cdcd2d0b31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ron Levenberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-24T02:20:00+00:00">April 24, 2017 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>My son just asked me to set up a Minecraft server for him to use with my 7-year-old grandson. This well-written tutorial sounds like just the thing, especially since I just set up a home file server on a Raspberry Pi and I love the platform. Thanks for these instructions and also for your patience and sense of humor. I&rsquo;m just glad I&rsquo;ve been using Unix/Linux since 1978!</p>
</div>
</li>
<li id="comment-278836" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd15d35961a47fd0263626cdcd2d0b31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd15d35961a47fd0263626cdcd2d0b31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ron Levenberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-28T04:02:18+00:00">April 28, 2017 at 4:02 am</time></a> </div>
<div class="comment-content">
<p>I just received the Raspberry Pi 3 that I want to set up as a Minecraft server. I followed your instructions and everything worked fine. The server (spigot-1.11.2) is running fine.</p>
<p>I did have one minor hiccup: If I connect to my server, which is called &ldquo;mineserver&rdquo;, using PuTTY, the server is not found. If I connect to its IP address, PuTTY finds it. If I connect to mineserver.local, PuTTY finds it. OK, that&rsquo;s what your instructions said. However, I use PuTTY to connect to my first Raspberry Pi (my home file server) as &ldquo;raspberrypi&rdquo; and PuTTY finds it, but PuTTY does not find &ldquo;raspberrypi.local&rdquo;. I suspect this is due to the installation of avahi-daemon (per your instructions) on the Minecraft server but not on my home file server. Further detail is given at <a href="https://www.howtogeek.com/167190/how-and-why-to-assign-the-.local-domain-to-your-raspberry-pi/" rel="nofollow ugc">https://www.howtogeek.com/167190/how-and-why-to-assign-the-.local-domain-to-your-raspberry-pi/</a>.</p>
<p>Anyway, I&rsquo;m ready to bring the new Minecraft server to my son&rsquo;s house to try it out. It should nestle very nicely next to his router!</p>
<p>Thanks.</p>
</div>
</li>
<li id="comment-278898" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d058e1341557bb41416eed34ea7767e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d058e1341557bb41416eed34ea7767e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wiseaxe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-29T03:30:04+00:00">April 29, 2017 at 3:30 am</time></a> </div>
<div class="comment-content">
<p>Thanks so much- an excellent article! My 1.11.2 server is running great on my rasberrypi!</p>
</div>
</li>
<li id="comment-279240" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5c164620a6fd155bff8dc5bf1f3b1f0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5c164620a6fd155bff8dc5bf1f3b1f0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ross</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-04T16:00:51+00:00">May 4, 2017 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>I have followed all steps, when I type ./minecraft.sh I get a message saying line 1 and line 3 command not found, any clues?</p>
<p>Other than that, all works a dream!</p>
</div>
<ol class="children">
<li id="comment-279243" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-04T16:10:05+00:00">May 4, 2017 at 4:10 pm</time></a> </div>
<div class="comment-content">
<p>Please post the full error message.</p>
</div>
</li>
</ol>
</li>
<li id="comment-279657" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6553290a765c4cd497009ca14d4f78fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6553290a765c4cd497009ca14d4f78fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://seyboldtechnology.wix.com/seyboldtechnology" class="url" rel="ugc external nofollow">Tennison Seybold</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-13T00:11:30+00:00">May 13, 2017 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>Hey. I couldn&rsquo;t get PuTTy to connect to my raspberry pi (running Pixel in GUI mode). So I decided to do the rest on the TV my pi was plugged into without making it headless. I typed java -jar BuildTools.jar into the command line on the Pi and it was downloading working fine. I walked out of the room and I walked in 10 minutes later and the screen was just black. It had a signal and was on, but black. Im scared to do anything because the green light on the Pi 3 is still blinking so I think it is still downloading. Im not sure. What do I do? Please help.</p>
</div>
</li>
<li id="comment-279730" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fda74aedacbe7d2434c0c265222931e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fda74aedacbe7d2434c0c265222931e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M. Veen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-14T19:53:54+00:00">May 14, 2017 at 7:53 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for these great instructions! We followed every step carefully and the server now works very well on a Raspberry pi 3 with Spigot -1.11.2. As a final step we copied multiple worlds, settings-files and plug-ins etc. from our original laptop based craftbukkit server to the pi and it all seems to work perfectly well with the Spigot server. My son and his friends can now play on where they left off before the transfer to the pi. And they are very happy. Thanks again.!<br/>
BTW: We use a 32 Gb class 10 sd card.</p>
</div>
<ol class="children">
<li id="comment-285913" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fda74aedacbe7d2434c0c265222931e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fda74aedacbe7d2434c0c265222931e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M. Veen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-14T18:40:29+00:00">September 14, 2017 at 6:40 pm</time></a> </div>
<div class="comment-content">
<p>Update: soon after above post, the server started crashing. On bukkit.org we found a fix : change the Xms to -Xingcgc and reduce the Xmx value. We randomly tried -Xmx800M and It worked. Don&rsquo;t ask why. I&rsquo;m in no way a computerguy. Source: <a href="https://bukkit.org/threads/xms-and-xmx-setup.14601/" rel="nofollow ugc">https://bukkit.org/threads/xms-and-xmx-setup.14601/</a></p>
</div>
<ol class="children">
<li id="comment-285917" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-14T19:06:05+00:00">September 14, 2017 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>The incremental garbage collector (-Xingcgc) may or may not be a wise choice. It has been deprecated and will no longer be supported in future Java versions. I do not think it is expected to be useful.</p>
<p>The Xms flag should not harm you if all you are doing on the machine is to run the server.</p>
<p>Reducing the value passed to &ldquo;-Xmx&rdquo; may or may not improve the stability.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-279989" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d84b0d6a901c4169da6f4d1784bbb2e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d84b0d6a901c4169da6f4d1784bbb2e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">OrangePi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-18T15:47:59+00:00">May 18, 2017 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>Used this tutorial to make Minecraft Server on Orange Pi PC. As for now seems to work well for 2~4 players with view distance of 4.</p>
</div>
</li>
<li id="comment-280486" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0aa410b6105e62e550e8576cde8bf0eb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0aa410b6105e62e550e8576cde8bf0eb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Adam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-27T06:26:35+00:00">May 27, 2017 at 6:26 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>I&rsquo;ve successfully established a server on a local network but I&rsquo;m having a lot of difficulty trying to get the server to work online. I&rsquo;ve been pulling my hair out trying to wrap my head around port-forwarding, dynamic DNS, and creating a static IP address for the pi. Any chance you might expand on these topics in the blog post?</p>
<p>Additionally, if anyone has gotten their server to work online please let me know!</p>
<p>Thanks</p>
</div>
<ol class="children">
<li id="comment-280606" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-05-29T14:49:08+00:00">May 29, 2017 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p><em>I&rsquo;ve been pulling my hair out trying to wrap my head around port-forwarding, dynamic DNS, and creating a static IP address for the pi. Any chance you might expand on these topics in the blog post?</em></p>
<p>No. No chance. </p>
<p>Exposing a server on your home network to the Internet involves configuring securely your router/firewall as well as securing the Raspberry Pi to prevent remote exploits.</p>
</div>
</li>
</ol>
</li>
<li id="comment-280921" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/20a28fc0de7f5b2a3f9a867220cb8974?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/20a28fc0de7f5b2a3f9a867220cb8974?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-03T22:22:10+00:00">June 3, 2017 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>Not sure if this was addressed in an earlier comment, but do you have any tips on running the server with more RAM (or oppositely why I shouldn&rsquo;t/why the default is enough). From researching on google, I believe that I would have to just edit the minecraft.sh script and add a larger RAM value in the .jar execution, but I&rsquo;m not too sure. Any help would be greatly appreciated.</p>
</div>
<ol class="children">
<li id="comment-280930" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-04T02:39:56+00:00">June 4, 2017 at 2:39 am</time></a> </div>
<div class="comment-content">
<p><em>Not sure if this was addressed in an earlier comment, but do you have any tips on running the server with more RAM (or oppositely why I shouldn&rsquo;t/why the default is enough). </em></p>
<p>There is no Raspberry Pi with more than a gigabyte of RAM at this time.</p>
</div>
</li>
</ol>
</li>
<li id="comment-281327" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/94d95a4985acedb62667fdedd7ad4f14?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/94d95a4985acedb62667fdedd7ad4f14?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jerry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-12T22:25:56+00:00">June 12, 2017 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>This tut is amazing everything has worked until: </p>
<p>&ldquo;Java -jar -Xms512M &#8211; Xmx1008M spigot-1.11.2.jar nogui&rdquo;</p>
<p>Returns the error </p>
<p>&ldquo;Unable to access jarfile Xmx1008M</p>
</div>
<ol class="children">
<li id="comment-281343" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-13T00:28:37+00:00">June 13, 2017 at 12:28 am</time></a> </div>
<div class="comment-content">
<p>You typed <tt>Java -jar -Xms512M â€“ Xmx1008M spigot-1.11.2.jar nogui</tt> according to your comment. The tutorial specifies <tt>java -jar -Xms512M -Xmx1008M spigot-1.9.2.jar nogui</tt>. These are not the same strings.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282355" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb8608b199405f83b28d8525739be961?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb8608b199405f83b28d8525739be961?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Appi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-26T21:40:21+00:00">June 26, 2017 at 9:40 pm</time></a> </div>
<div class="comment-content">
<p>Hey Daniel,<br/>
thank you for this tutorial it helped me very much, but I need your help. Everything worked until I entered the command to start the server with screen.</p>
<p>So i wrote this command:<br/>
./minecraft.sh</p>
<p>and then this showed up:<br/>
-bash: ./minecraft.sh: Permission denied</p>
<p>hope you can help me, thanks in advance.</p>
<p>PS:<br/>
The command pwd works, now I am hacking into the NSA&rsquo;s database.</p>
</div>
<ol class="children">
<li id="comment-282375" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T02:15:12+00:00">June 27, 2017 at 2:15 am</time></a> </div>
<div class="comment-content">
<p>There is a whole bunch of commands to type before you got to <tt>./minecraft.sh</tt>. Please follow the tutorial step by step, don&rsquo;t skip anything.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282519" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Griffon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-29T18:16:12+00:00">June 29, 2017 at 6:16 pm</time></a> </div>
<div class="comment-content">
<p>Trying to update to 1.12, the kids tell me clients have stopped working but getting an error getting the new spigot. Tried a couple different ways.</p>
<p>pi@pi-mine:~/minecraft $ java -jar BuildTools.jar â€“rev 1.12<br/>
Loading BuildTools version: git-BuildTools-7f7e531-60 (#60)<br/>
BuildTools<br/>
<a href="/cdn-cgi/l/email-protection#cdb8a3aea2a3aba4aab8bfa8a98da3b8a1a1e3bebda4aaa2b9a0aee3a2bfaa"><span class="__cf_email__" data-cfemail="b6c3d8d5d9d8d0dfd1c3c4d3d2f6d8c3dada98c5c6dfd1d9c2dbd598d9c4d1">[email&#160;protected]</span></a><br/>
Exception in thread &ldquo;main&rdquo; org.eclipse.jgit.errors.RepositoryNotFoundException: repository not found: /home/pi/minecraft/BuildData<br/>
at org.eclipse.jgit.lib.BaseRepositoryBuilder.build(BaseRepositoryBuilder.java:582)<br/>
at org.eclipse.jgit.api.Git.open(Git.java:117)<br/>
at org.eclipse.jgit.api.Git.open(Git.java:99)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:223)</p>
<p>Directory seems ok and Bulddata is there.</p>
<p>pi@pi-mine:~/minecraft $ ls<br/>
apache-maven-3.2.5 commands.yml plugins walkerworld_the_end<br/>
banned-ips.json CraftBukkit server.properties whitelist.json<br/>
banned-players.json eula.txt Spigot work<br/>
BuildData help.yml spigot-1.11.2.jar world<br/>
BuildTools.jar logs spigot.yml world_nether<br/>
BuildTools.log.txt minecraft.sh usercache.json world_the_end<br/>
Bukkit ops.json walkerworld<br/>
bukkit.yml permissions.yml walkerworld_nether</p>
<p>Appreciate any suggestions, hate to scorch earth. Hopping I&rsquo;m just missing something simple.</p>
<p>Thanks!</p>
</div>
<ol class="children">
<li id="comment-282536" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/96919e854f49826baffcc599cd5dcd97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Griffon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-30T02:01:39+00:00">June 30, 2017 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>Looks like the part I was missing is you need rm -dRf your old Build directory. Guess I wrongly subconsciously thought it would over overwrite any old stuff.<br/>
I removed BuildData, CraftBukkit and Bukkit. Not sure if the other two needed removal or not, but seems to fetching and building now.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282587" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-30T21:53:01+00:00">June 30, 2017 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>Hey Daniel,<br/>
i&rsquo;m loving your tutorial but i have run in to a error and can&rsquo;t seem to fix it.<br/>
when i type screen-r minecraft it says :<br/>
There is no screen to be resumed matching minecraft.<br/>
i have redone all of your steps 2 times now starting again from<br/>
nano /minecraft.sh<br/>
i am in pi@raspberrypi:~/minecraft $<br/>
can u please help me ?<br/>
many thanks.</p>
</div>
<ol class="children">
<li id="comment-282588" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-30T21:58:57+00:00">June 30, 2017 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>Have you typed <tt>./minecraft.sh</tt> while in the bash shell?</p>
</div>
<ol class="children">
<li id="comment-282645" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-01T15:22:02+00:00">July 1, 2017 at 3:22 pm</time></a> </div>
<div class="comment-content">
<p>Hello daniel,<br/>
i was just typing my comment that i couldent get it working.<br/>
But then i saw that i diden&rsquo;t change 1.9 to 1.12<br/>
again<br/>
many thanks for your great tutorial<br/>
Joris</p>
</div>
</li>
<li id="comment-349417" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/174befbe3c73caae854bdb4123eb6ed2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/174befbe3c73caae854bdb4123eb6ed2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Loran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-15T20:07:13+00:00">September 15, 2018 at 8:07 pm</time></a> </div>
<div class="comment-content">
<p>Hey Daniel!</p>
<p>Thanks for this great tutorial. I have gotten to the same part, with the same problem.</p>
<p>I have quintuple checked my minecraft.sh file, and my jar file (spigot-1.12.2.jar) is named correctly.</p>
<p>When I start the server with <code>./minecraft.sh</code> it returns to the prompt as expected, without any errors. However, I can&rsquo;t connect to the server now. Not with raspberrypi.local, not with it&rsquo;s local IP address and also not with the global IP address of my router. It seems it doesn&rsquo;t run.</p>
<p>When I type <code>screen -r minecraft</code> it returns the same error as Joris is getting: <code>There is no screen to be resumed matching minecraft.</code></p>
<p>Could you tell me what&rsquo;s going wrong? I&rsquo;m really confident I did everything right.</p>
<p>Thanks so much in advance,</p>
<p>Loran</p>
</div>
<ol class="children">
<li id="comment-349434" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-15T22:49:40+00:00">September 15, 2018 at 10:49 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I am confident that I did everything right</p>
</blockquote>
<p>Ok, so you launched the server initially and it worked, you got the server working. Correct, right? Because this is not clear from your comment.</p>
<p>Note that these instructions definitively work if you follow them.</p>
</div>
<ol class="children">
<li id="comment-349437" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/174befbe3c73caae854bdb4123eb6ed2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/174befbe3c73caae854bdb4123eb6ed2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Loran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-15T22:54:31+00:00">September 15, 2018 at 10:54 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the response!</p>
<p>I found the mistake I made. I resumed setting things up right after <code>mkdir minecraft &amp;&amp; cd minecraft</code>, so I didn&rsquo;t realise I wasn&rsquo;t in <code>/home/pi/minecraft</code> when executing the <code>wget</code> command.</p>
<p>I was too quick to say I did everything right, but it was a sneaky mistake.</p>
<p>I&rsquo;m afraid I&rsquo;m going to have to wipe my SD clean and start over. Or do you know how to uninstall the spigot package without undoing all the previous settings?</p>
<p>Thank you,</p>
<p>Loran</p>
</div>
<ol class="children">
<li id="comment-349602" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-16T23:26:08+00:00">September 16, 2018 at 11:26 pm</time></a> </div>
<div class="comment-content">
<p>You can move files with the <tt>mv</tt> command.</p>
</div>
<ol class="children">
<li id="comment-349603" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/174befbe3c73caae854bdb4123eb6ed2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/174befbe3c73caae854bdb4123eb6ed2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Loran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-16T23:27:43+00:00">September 16, 2018 at 11:27 pm</time></a> </div>
<div class="comment-content">
<p>I realised that after I did it the hard way. It&rsquo;s up and running without problems now, though. 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-282929" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c0a4d9f0eb71a92695bff4735371450?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c0a4d9f0eb71a92695bff4735371450?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Casey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-06T23:20:07+00:00">July 6, 2017 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>I initially used your tutorial months ago but never put it in play. I wound up having to use it again to rebuild the idea from the ground up. Outstanding work! Thank you for taking the time to make it really easy to build the simple server.</p>
</div>
<ol class="children">
<li id="comment-574848" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-14T20:55:50+00:00">February 14, 2021 at 8:55 pm</time></a> </div>
<div class="comment-content">
<p>Yes, a Raspberry Pi 4 could definitively help, especially if you get the version with 4GB. The more memory, the better.</p>
<p>Note however that a Raspberry Pi 4 is not needed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-283594" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0beab8f6becb68b3a7c272eada66c967?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0beab8f6becb68b3a7c272eada66c967?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-23T20:44:29+00:00">July 23, 2017 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>Well hello there. 😉<br/>
After a long time experimenting with the Pi, I finally found a good tutorial for once. Everything worked really well, I didn&rsquo;t even encounter one problem. Thanks for this guide!<br/>
So, I wanted to ask if you could do/already did/can recommend a good tutorial on how to make the server avaible on the internet?<br/>
Thanks a lot!</p>
</div>
</li>
<li id="comment-284131" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6d75477f380ccb5a910a767a6c37823?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6d75477f380ccb5a910a767a6c37823?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ludvig</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-13T17:04:50+00:00">August 13, 2017 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m with Stefan, that would be great!</p>
</div>
</li>
<li id="comment-284921" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43e78a7717e5bed0b3153055619222ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43e78a7717e5bed0b3153055619222ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://none" class="url" rel="ugc external nofollow">Ludion</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-25T00:04:07+00:00">August 25, 2017 at 12:04 am</time></a> </div>
<div class="comment-content">
<p>Hi, I have a little problem.<br/>
When I try to do<br/>
&ldquo;-list&rdquo;<br/>
after I did<br/>
&ldquo;sudo apt-get install netatalk screen avahi-daemon&rdquo;<br/>
it replies with<br/>
&ldquo;bash: -list: command not found&rdquo;<br/>
and I tried reinstalling it&#8230; and it did the same thing! If you have any ideas, please reply.</p>
</div>
<ol class="children">
<li id="comment-284923" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-25T00:12:08+00:00">August 25, 2017 at 12:12 am</time></a> </div>
<div class="comment-content">
<p>The command is <tt>screen -list</tt>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-285245" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4f432af1aca91843d60ab6e4aea4621b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4f432af1aca91843d60ab6e4aea4621b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lucas Owen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-01T17:36:56+00:00">September 1, 2017 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>is there a way to set this up so i can play with friends from foreign countries? also how can i configure the server (such as creative mode) can I setup commands? such as /gamemode 1 or /kill</p>
</div>
<ol class="children">
<li id="comment-286604" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T10:04:28+00:00">September 22, 2017 at 10:04 am</time></a> </div>
<div class="comment-content">
<p>If you only want yourself or certain players to have commands, then just &ldquo;op&rdquo; the player.</p>
<p>From the server command line: op playername[enter]</p>
<p>That player will now be able to use commands. The server.properties file will let you control what level of commands they can use (game only or server control as well).</p>
<p>You can also set the game mode from the server.properties file, so if you want the world in creative, that&rsquo;s where you do it. The default, I believe, is survival on easy (changed mine to hard).</p>
</div>
</li>
</ol>
</li>
<li id="comment-286608" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-22T10:17:55+00:00">September 22, 2017 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>Oh, and Daniel, thanks for the well written guide.</p>
<p>I used Raspbian Stretch Lite, which works great.</p>
<p>For others wanting to use Lite, you&rsquo;ll need to install Git and Oracle Java. Both are in the repos, but the Java version is older, so I manually installed the latest (although I&rsquo;m sure the version in the repos would&rsquo;ve worked fine).</p>
<p>And if you want to build Spigot for a specific version of Minecraft, add the version after the build command with &#8211;rev {version #}. For example, I&rsquo;m still running 1.12.1, because Optifine is not available for the latest 1.12.2 version yet (and my computer is too slow to play without Optifine), so I built Spigot with this command.</p>
<p>java -jar BuildTools.jar &#8211;rev 1.12.1</p>
<p>I&rsquo;m really surprised how well this works. I may just retire the old laptop I&rsquo;ve been using as a server.</p>
</div>
</li>
<li id="comment-287277" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T13:18:48+00:00">September 27, 2017 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Hey,<br/>
great tutorial!<br/>
But when I run the command :<br/>
Sudo nano /etc/default/tmpfs<br/>
It just gives me a blank file.<br/>
I used WinSCP to check<br/>
but there is no tmpfs file.<br/>
I made sure I installed all packages.<br/>
can you please help me?<br/>
many thanks</p>
</div>
<ol class="children">
<li id="comment-287280" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-27T14:05:40+00:00">September 27, 2017 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p>Because you followed the guide step-by-step, you have the latest Raspbian, have you not? Just to confirm, can you type <tt>uname -a</tt> in a shell and report back on the result?</p>
</div>
<ol class="children">
<li id="comment-287525" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1aab7b1ead122b5019c550cd8a0dfeae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-29T16:05:49+00:00">September 29, 2017 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>I am pretty sure I have the newest version but anyways:</p>
<p>Linux raspberrypi 4.9.41-v7+ #1023 SMP Tue Aug 8 16:00:15 BST 2017 armv7l GNU/Linux</p>
<p>that is the output that I get</p>
</div>
<ol class="children">
<li id="comment-287531" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-29T17:46:05+00:00">September 29, 2017 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>Good. </p>
<p>Open the file <tt>/etc/fstab</tt> with a text editor such as <tt>nano</tt> as root (e.g., type <tt>sudo nano /etc/fstab</tt>). It should look something like this:</p>
<pre>
proc            /proc           proc    defaults          0       0
/dev/mmcblk0p6  /boot           vfat    defaults          0       2
/dev/mmcblk0p7  /               ext4    defaults,noatime  0       1
</pre>
<p>Append a new line: </p>
<pre>
tmpfs           /tmp            tmpfs   nodev,nosuid,size=1M 0    0
</pre>
<p>Then reboot. It should do the trick.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-287820" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0ee0d3fa8d7512a39d37e42344c9328?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-02T23:52:06+00:00">October 2, 2017 at 11:52 pm</time></a> </div>
<div class="comment-content">
<p>To edit the /etc/fstab file you need to enter:<br/>
sudo nano /etc/fstab</p>
<p>not</p>
<p>sudo nano /etc/default/tmpfs<br/>
as that will try to edit the wrong file.</p>
</div>
<ol class="children">
<li id="comment-287829" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-03T00:46:00+00:00">October 3, 2017 at 12:46 am</time></a> </div>
<div class="comment-content">
<p>Thank you. You are correct.</p>
</div>
</li>
</ol>
</li>
<li id="comment-288209" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4c492c66bb28581e732cab4ad371f7d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4c492c66bb28581e732cab4ad371f7d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oliver Mullen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-07T02:21:03+00:00">October 7, 2017 at 2:21 am</time></a> </div>
<div class="comment-content">
<p>When I type in</p>
<p>if ! screen -list | grep -q &ldquo;minecraft&rdquo;; then<br/>
cd /home/pi/minecraft<br/>
screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M spigot-1.9.jar nogui<br/>
fi</p>
<p>It says it is 5 lines. Is that OK?</p>
</div>
<ol class="children">
<li id="comment-288212" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-07T02:33:03+00:00">October 7, 2017 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>If you have correctly copied the script, you will have four (4) lines.</p>
</div>
</li>
</ol>
</li>
<li id="comment-288511" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bdd1b58f5d2183d8240d6876daaeed5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bdd1b58f5d2183d8240d6876daaeed5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RickG</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-09T07:56:00+00:00">October 9, 2017 at 7:56 am</time></a> </div>
<div class="comment-content">
<p>Daniel,<br/>
First of all, thanks for the great tutorial, it is very easy to follow.</p>
<p>Everything went well for my setup, except that I cannot connect to the server from either of my daughters&rsquo; Android tablets. They are running the full (paid) version of Minecraft and when I try to add/connect to the server, it asks for the server name, IP address and port. I used the set server name, I used the same IP address I used for Putty and used port 25565. After logging into xbox live (required by MS), the tablet does not find the local server (it does see the three partner Internet servers). You mention connecting to &ldquo;raspberrypi.local&rdquo;, but can you do that from the client? The only issue I see during the server load is &ldquo;Java HotSpot(TM) Client VM warning: You have loaded library /tmp/libnetty_transport_native_epoll8344076825937148986.so which might have disabled stack guard. The VM will try to fix the stack guard now. It&rsquo;s highly recommended that you fix the library with &lsquo;execstack -c &lsquo;, or link it with &lsquo;-z noexecstack'&rdquo;. Aside from that one warning, the server load appears to complete and is running, but I cannot find a way to connect to it. Stopping the server also works as you outlined. Anything else I have overlooked?</p>
</div>
<ol class="children">
<li id="comment-288536" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-09T12:47:17+00:00">October 9, 2017 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>These instructions are for the regular Minecraft, not the Pocket Edition which is entirely different software.</p>
</div>
<ol class="children">
<li id="comment-288537" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-09T12:50:07+00:00">October 9, 2017 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>It says so at the beginning of the tutorial:</p>
<blockquote><p>We are going to setup a Minecraft server for the regular (desktop) Minecraft. There are other Minecraft versions, such as the Pocket Edition, but they require different software.</p></blockquote>
</div>
</li>
<li id="comment-288554" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bdd1b58f5d2183d8240d6876daaeed5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bdd1b58f5d2183d8240d6876daaeed5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RickG</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-09T16:43:54+00:00">October 9, 2017 at 4:43 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the clarification, I did not realize the tablets were actually running PE. Guess I will need to install the full version on their desktops or use additional Raspberry PIs for clients.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-289335" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/231d4b484d09bdc82dea71f901ba9fa2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/231d4b484d09bdc82dea71f901ba9fa2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-21T08:22:23+00:00">October 21, 2017 at 8:22 am</time></a> </div>
<div class="comment-content">
<p>@ Rick G,<br/>
Minecraft PE, along with other versions based on the Bedrock Engine (like the Windows 10 version) are cross-platform compatible now, but they do require a different server.</p>
<p>Technically there are 2 &ldquo;Desktop&rdquo; versions now. The original Java version, which is no longer true Minecraft according to Mojang and Microsoft, and the Windows 10 version, which is one of the true Minecraft versions. All version not using the Bedrock Engine are now considered to be &ldquo;Editions&rdquo; (like Java Edition) while all versions based on the Bedrock Engine are now Minecraft (PE, Windows 10, XBox, Ninetendo Switch).</p>
<p>So &ldquo;Minecraft&rdquo; servers are now cross-platform compatible with all versions based on the Bedrock Engine, while the Java Edition server is only compatible with, you guessed it, Java Edition.</p>
<p>Clear as mud, right?</p>
<p>As far as I know, Mojang/Microsoft have not released any server software for the Bedrock Engine versions to the public, so you&rsquo;d have to use a Realm or other commercial server.</p>
<p>To use the server in this tutorial you&rsquo;ll have to use the Java Edition of the game, and while it is possible to run that on a Raspberry Pi, it is hard to set up and does not run very well. And for clarity, I&rsquo;m talking about the game software here, not the server. A Raspberry Pi3 can run a server quite well.</p>
<p>Running the Java Edition Minecraft game, however, is quite another story. For that you are better off running it on a more typical PC with a powerful CPU, lots of memory and a good graphics card/GPU.</p>
</div>
</li>
<li id="comment-289339" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/231d4b484d09bdc82dea71f901ba9fa2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/231d4b484d09bdc82dea71f901ba9fa2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-21T09:16:21+00:00">October 21, 2017 at 9:16 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve been playing around with an ASUS Tinker Board for a week or so, and while the hardware is great, the &ldquo;Linaro&rdquo; Debian TinkerOS is a steaming pile of poo. After spending quite a lot of time trying to get it to run as well as Raspbian does on my Pi3, I decided that the Tinker Board might be better used as a Minecraft Server.</p>
<p>After all, you don&rsquo;t need video or graphics acceleration, or sound, or any of the other things that are barely functional or just plain broken in TinkerOS. You just need to be able to boot up, connect to a network and install Java, which you can do on TinkerOS. So I installed the latest version of Oracle Java and once again used this tutorial to get the server up and running on the Tinker Board.</p>
<p>A quick initial comparison did not reveal any significant performance difference between my Pi3 server and Tinker Board server, but we did only have 2 people logged in. I imagine the difference would become apparent with more players online, since the Tinker Board is roughly twice as fast as a Pi3, with twice as much RAM (2GB) and true Gigabit Ethernet that&rsquo;s not sharing bandwidth with the USB ports.</p>
<p>Most of the tutorial works the same on the Tinker Board, adjusting for Raspberry Pi specific differences, like Raspbian vs TinkerOS (and the fact that TinkerOS is harder to configure).</p>
<p>You will have to install Java, git, screen, and even nano (or use something else for editing). I recommend you use the webupd8team PPA for Java, since it will update Java like other packages (also install dirmngr if you are going to use the PPA tutorial).</p>
<p>Building the Spigot sever is certainly faster, but it still takes quite a while. It also launches the server in about half the time. It&rsquo;s been pretty stable, so far.</p>
<p>Just thought I&rsquo;d share this with your readers.</p>
</div>
</li>
<li id="comment-292815" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.oomkoen.nl" class="url" rel="ugc external nofollow">koen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-06T21:05:42+00:00">December 6, 2017 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>After a year doing other stuff with my Pi, I installed Minecraft on a fresh installation with this manual. And it&rsquo;s working like a charm again.<br/>
I made a backup of my old world. Copied it to the new installation. (And started the server again.) It took awile for the game to logon, some error about old achievements, some new created instant. But the best, i am in my own world again.</p>
<p>Nice to be back. And woooh there is much changed in the game. 🙂</p>
</div>
</li>
<li id="comment-293088" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d68671114431d98b40daf06d6111e7a0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d68671114431d98b40daf06d6111e7a0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vortex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-09T18:42:53+00:00">December 9, 2017 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>Thank you very much ! Works well 😀</p>
</div>
</li>
<li id="comment-293883" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b63e74dd6e27f5d8156e6a543d4ed67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b63e74dd6e27f5d8156e6a543d4ed67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tony H.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-23T01:53:01+00:00">December 23, 2017 at 1:53 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>First I&rsquo;d like to thank you for writing such an in-depth guide on how to get this server running. I&rsquo;ve been searching the web for almost a year on how to do this and this guide has gotten me the farthest so far. I had used your guide earlier this year to set one up but when more than one person would join, the additional people wouldn&rsquo;t have any items in their inventory. So now that I&rsquo;ve gone through pretty much everything else on the web, I&rsquo;ve come back to your guide. I&rsquo;ve followed this step for step, verbatim, and can not seem to get this to work. I&rsquo;ve reformatted my SD card and started from scratch 5 times in the last three days. My problems lies with not being able to connect from my kids android devices. I don&rsquo;t see the server available and when I try to add it in the server tab it doesn&rsquo;t see it. Can I send you some logs in order to help my trouble shoot this? Thank you.</p>
</div>
<ol class="children">
<li id="comment-293884" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-23T01:59:22+00:00">December 23, 2017 at 1:59 am</time></a> </div>
<div class="comment-content">
<p><em>My problems lies with not being able to connect from my kids android devices. I don&rsquo;t see the server available and when I try to add it in the server tab it doesn&rsquo;t see it. Can I send you some logs in order to help my trouble shoot this?</em></p>
<p>I think your comment gives me enough information to troubleshoot this without further information. Let me quote the third paragraph of the guide: <strong>We are going to setup a Minecraft server for the regular (desktop) Minecraft. </strong> Android devices don&rsquo;t run what I call the regular (desktop) Minecraft.</p>
</div>
<ol class="children">
<li id="comment-293885" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-23T02:01:08+00:00">December 23, 2017 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>Here is the end of the third paragraph:</p>
<p><strong> To be clear: if you are running Minecraft on a smartphone, a console or a tablet, it is probably not compatible with the regular Minecraft.</strong></p>
<p>I&rsquo;m sorry, I don&rsquo;t know how to deal with these other Minecraft editions.</p>
</div>
<ol class="children">
<li id="comment-293906" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b63e74dd6e27f5d8156e6a543d4ed67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b63e74dd6e27f5d8156e6a543d4ed67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tony H.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-23T14:08:59+00:00">December 23, 2017 at 2:08 pm</time></a> </div>
<div class="comment-content">
<p>Thanks&#8230; guess I should have taken my time to read that!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-294470" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/608c8f2b041d42b4137ca1404f87f0f3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/608c8f2b041d42b4137ca1404f87f0f3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Troy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-04T10:57:14+00:00">January 4, 2018 at 10:57 am</time></a> </div>
<div class="comment-content">
<p>Thank you so much for this! I had a spare RPi3B laying around, and my daughter wanted to setup a server for her friends to play on. So, following your tutorial after installing Noobs(lite) and the Raspian (full) distro, worked a treat. Oh, you weren&rsquo;t kidding about getting a coffee, that took about 40 minutes!</p>
<p>We&rsquo;re up to spigot1.12.2 as of January 2018, and everything is still relevant.</p>
<p>Regarding the external connectivity.<br/>
1) I have a dynamic IP address assigned by my ISP<br/>
2) I have an Untangle home server, so I have it forwarding a random external port number to the raspberry PI&rsquo;s default minecraft receiving port. Doing this on any modern modem is pretty simple check out <a href="http://www.portforward.com" rel="nofollow ugc">http://www.portforward.com</a><br/>
3) The daughter turns the PI on, only when they want to play<br/>
4) The daughter types in &ldquo;Whats my IP&rdquo; in google, then tells her friends via steamchat.</p>
<p>Again, thank you for the great post.</p>
</div>
</li>
<li id="comment-295015" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2758f613cb2b4ccafad1ee126ad3777b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2758f613cb2b4ccafad1ee126ad3777b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/azfalot" class="url" rel="ugc external nofollow">Carlos Otero</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-16T09:02:50+00:00">January 16, 2018 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>I already have my server running on a raspberry pi 3 with the last distribution of raspbian, I only had problems accessing the hostname by default, so I&rsquo;m using the assigned ip.</p>
<p>I opened the ports of the router and I have the server online also through no-ip.com generate a free dns for my domain and with the dynmap plugin I have generated a vision of the map !!.</p>
<p>For those interested, they can access the server in the latest version available (1.12.2) and check for themselves how a minecraft server works in a raspberry pi 3 !!!</p>
<p>IP: shibuya.serveminecraft.net<br/>
Interactive Online Map: shibuya.serveminecraft.net:8123</p>
<p>Excellent work, thank you very much !.</p>
</div>
</li>
<li id="comment-297283" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f41ef1154c06cf3392d3bd0e7e3be42a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f41ef1154c06cf3392d3bd0e7e3be42a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dragan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-23T15:42:38+00:00">February 23, 2018 at 3:42 pm</time></a> </div>
<div class="comment-content">
<p>THX. Very much. My children are very happy with the Minecraft Server.</p>
<p>Good Work.</p>
</div>
</li>
<li id="comment-297454" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/491e334adff473bb264e3f8ace9ce384?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/491e334adff473bb264e3f8ace9ce384?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Torsten</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-25T21:56:53+00:00">February 25, 2018 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>Hi, do you have any proposal for a free Minecraft client?</p>
</div>
<ol class="children">
<li id="comment-297817" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e3d20d3f570b5d51f5cb1284c0590383?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e3d20d3f570b5d51f5cb1284c0590383?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TinyZombie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-04T22:44:18+00:00">March 4, 2018 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>The only version of Minecraft that is free is the Raspberry Pi version, which is a really stripped down version designed for educational use. It is not compatible with any other version or multiplayer, so it&rsquo;s probably not what you want.</p>
<p>For all other versions you&rsquo;ll have to pay for it. If you buy the Java Edition (for which this tutorial is written) you will also get the Windows 10 version for free.</p>
<p>Currently the Java Edition is $26.95, and that&rsquo;s the one you want to play the server in this tutorial.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299245" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9af420bb8585129eb79e94afa22c13ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9af420bb8585129eb79e94afa22c13ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raffi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-23T18:31:58+00:00">March 23, 2018 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>Nice tutorial very easy to go along and recreate, now i have a Raspberry Pi 3 running a Minecraft Server YAY 🙂<br/>
Some pitfalls to note:</p>
<p>running: &ldquo;java -jar BuildTools.jar&rdquo; did not work for me, the Spigot install stoped with a fatal error, my solution is running the BulidTool.jar with some extra Java arguments e.g. java -jar -Xms512M -BuildTools.jar.</p>
<p>Also i had some trouble withe the minecraft.sh file, i typed chmod -x, insted of chmod +x, maybe some kind note.</p>
<p>my 3rd mistake was that i did not set up the Pi for autologin, it seemt that i overred this part in the raspiconfig section. I sugesst some kind of checklist after this section so you can verify your Pi is setup correctly.</p>
<p>And at last a short question is there a way to check if the /tmp in memory is working ?</p>
</div>
<ol class="children">
<li id="comment-299246" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9af420bb8585129eb79e94afa22c13ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9af420bb8585129eb79e94afa22c13ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raffi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-23T18:33:41+00:00">March 23, 2018 at 6:33 pm</time></a> </div>
<div class="comment-content">
<p>some kind of note would be helpful</p>
</div>
</li>
</ol>
</li>
<li id="comment-299381" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1da7133f7273d143f5b65a5492f6c2f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1da7133f7273d143f5b65a5492f6c2f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-25T20:39:43+00:00">March 25, 2018 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>My 9 year old son and I walked through this guide today.</p>
<p>I wanted to show him how to setup a server properly. It worked and was very helpful.</p>
<p>Thank you for this wonderful guide.</p>
</div>
</li>
<li id="comment-304703" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa3c94033ee1b40553adbacede67cc8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa3c94033ee1b40553adbacede67cc8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-24T01:15:20+00:00">May 24, 2018 at 1:15 am</time></a> </div>
<div class="comment-content">
<p>Dr. Lemire,<br/>
I can open the server using &ldquo;java -jar -Xms512M -Xmx1008M spigot-1.9.jar nogui&rdquo;. When I give &ldquo;./minecraft.sh&rdquo; I get a &ldquo;no such file in directory&rdquo; error. Is there any significant difference between these two commands or do they both do the same thing? If there is a difference, do you have any ideas where I am going wrong? Thanks for the brilliant guide!</p>
</div>
<ol class="children">
<li id="comment-304823" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-24T19:02:33+00:00">May 24, 2018 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>You created the <tt>minecraft.sh</tt> file, as per my instructions, right?</p>
</div>
</li>
</ol>
</li>
<li id="comment-321513" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0ba767c91f6597b1013f628cafbb1150?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0ba767c91f6597b1013f628cafbb1150?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Harrison</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-25T21:33:56+00:00">July 25, 2018 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for these amazing instructions! I followed them and everything worked. I hit one problem but it turned out I didn&rsquo;t read your instructions correctly and once I made the correction everything was fine 😉 I had wanted to make a Minecraft server on my Raspberry Pi for a while and you made it a breeze setting everything up.</p>
</div>
</li>
<li id="comment-321740" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-26T02:15:51+00:00">July 26, 2018 at 2:15 am</time></a> </div>
<div class="comment-content">
<p>As I have an eight-year-old grandson who is fond of Minecraft, and a multiplying number of 3D printers with attached and mostly-idle Pi3s, I find your narrative of use.</p>
<p>Also find interest in your venture into offering instructions to a larger audience. 🙂</p>
</div>
</li>
<li id="comment-325708" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6e7142138dabc82a7f7775137c60795?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6e7142138dabc82a7f7775137c60795?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Spoigh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-30T20:57:59+00:00">July 30, 2018 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Brilliant. I had little hope when I tried this because its 2 years old and I never had good experience with 2 year old tutorials. It all worked like a charm, great stuff man. Thanks for posting this</p>
</div>
</li>
<li id="comment-333098" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/504375e0e4e2ec1b29f9b2506ea85c59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/504375e0e4e2ec1b29f9b2506ea85c59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zachary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-04T23:58:33+00:00">August 4, 2018 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p>Hey, I just built a Minecraft sever and I noticed that windows has a new update. Now I can&rsquo;t get into my server. Any suggestions??</p>
<p><code> Thank you!!!<br/>
</code></p>
</div>
</li>
<li id="comment-334156" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c30147538c293679f3c8d530ea8dd50?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c30147538c293679f3c8d530ea8dd50?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lisa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-06T20:42:19+00:00">August 6, 2018 at 8:42 pm</time></a> </div>
<div class="comment-content">
<p>I set up everything today, but when I try to connect to the server Minecraft shows me a failed message:</p>
<p><em>Java.net.connectException: Connection timed out: no further Information</em></p>
<p>I can&rsquo;t figure out where this is coming from&#8230;</p>
</div>
<ol class="children">
<li id="comment-337302" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/504375e0e4e2ec1b29f9b2506ea85c59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/504375e0e4e2ec1b29f9b2506ea85c59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zachary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-11T18:34:12+00:00">August 11, 2018 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p>I had the same problem! I think the only option is to redo the whole server.</p>
</div>
</li>
</ol>
</li>
<li id="comment-351364" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce03f9fb9024231e8dd8352987322f16?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce03f9fb9024231e8dd8352987322f16?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bo Mortensen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-22T15:01:02+00:00">September 22, 2018 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>Hi there</p>
<p>Thank you for this tutorial, its working good for me, except that I can not get it to starte the server on reboot.</p>
<p>My question is, however: Is it possible to get the server build latest version of spigot when running &ldquo;sudo java -jar BuildTools.jar&rdquo;, latest version is 1.13.1, but the version installed is 1.12.2.</p>
<p>Thanks in advance</p>
</div>
<ol class="children">
<li id="comment-353281" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T15:37:59+00:00">September 30, 2018 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>Same here. 🙁</p>
<p>Just installed Minecraft server. BuildTools.jar runs perfect building a 1.12.2 file.<br/>
But the Minecraft game is version 1.13.1.</p>
<p>Hoping Spigot is updating their files as soon as possible.</p>
</div>
<ol class="children">
<li id="comment-353283" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T15:47:53+00:00">September 30, 2018 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>Trying build a new jar file with the command:</p>
<p><code>java -jar BuildTools.jar --rev 1.13.1<br/>
</code></p>
<p>Going to drink some coffee. 🙂</p>
</div>
<ol class="children">
<li id="comment-353330" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-30T21:13:09+00:00">September 30, 2018 at 9:13 pm</time></a> </div>
<div class="comment-content">
<p>It did the trick.</p>
<p><code>java -jar BuildTools.jar --rev 1.13.1<br/>
</code></p>
<p>Is forcing to get a new spigot-1.13.1.jar file. This one can be run to finish this hole plan. I tested it and it works. Well not stable, but it could also be possible to the running Domoticz server.</p>
<p>It was also possible to restore my old november 2017 world backup. :))</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-357029" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad023deb33adb39345004933def0c1dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad023deb33adb39345004933def0c1dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom Wilson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-14T20:02:27+00:00">October 14, 2018 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>Hi,<br/>
I&rsquo;m a little stuck as when I run the command &ldquo;java -jar BuildTools.jar&rdquo; a spigot file is not being created meaning I can&rsquo;t continue with the tutorial. If you have any thoughts as to why I would really appreciate it!<br/>
Tom</p>
</div>
<ol class="children">
<li id="comment-359347" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-22T20:01:00+00:00">October 22, 2018 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>And my server is telling version 1.13.1 is outdated.</p>
<p>It has to do with a newer version, see: <a href="https://www.spigotmc.org/threads/bukkit-craftbukkit-spigot-bungeecord-1-13-2.344189/" rel="nofollow ugc">https://www.spigotmc.org/threads/bukkit-craftbukkit-spigot-bungeecord-1-13-2.344189/</a></p>
<p>Without required arguments i still get version 1.12.2.<br/>
With required arguments &#8211;rev 1.13.2 it was telling me, still file doesn&rsquo;t exist.</p>
<p>BUT, this last 15 minutes ago, it does exist. So i am creating a new jar file with: java -jar BuildTools.jar &#8211;rev 1.13.2</p>
</div>
</li>
</ol>
</li>
<li id="comment-366194" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3fbcc0949ab52269de87f0009477cd37?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3fbcc0949ab52269de87f0009477cd37?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jessie Westlake</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-20T00:56:21+00:00">November 20, 2018 at 12:56 am</time></a> </div>
<div class="comment-content">
<p>Can someone tell me what my screen should look like while I&rsquo;m waiting &ldquo;forever, coffee run, lunch, etc&rdquo;?</p>
<p>After typing <code>sudo java -jar BuildTools.jar --rev 1.12.2</code> git does its thing, minecraft is built and the server.jar is downloaded, finally my installation is sitting at</p>
<p><code>Final mapped jar: work/mapped.cf6b1333.jar does not exist, creating!<br/>
Picked up _JAVA_OPTIONS: -Djdk.net.URLClassPath.disableClassPathURLCheck=true<br/>
</code></p>
<p>I can&rsquo;t tell if it is froze, errored out, or doing what it&rsquo;s supposed to. I ctrl+C out of the install a few times, started fresh and did it again, and still the same result. I made sure there were no environment variables named _JAVA_OPTIONS for my user and using <code>sudo</code>. I tried different versions of minecraft and BuildTools, with the same result.</p>
<p>How do I know if the installation is actually ongoing?</p>
</div>
<ol class="children">
<li id="comment-366201" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-20T01:58:36+00:00">November 20, 2018 at 1:58 am</time></a> </div>
<div class="comment-content">
<p>So we are clear, the command you describe is not part of this tutorial.</p>
</div>
</li>
<li id="comment-366244" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79517da967a0b41e6aa33b0165c774db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Koen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-20T06:22:14+00:00">November 20, 2018 at 6:22 am</time></a> </div>
<div class="comment-content">
<p>Don&rsquo;t drink coffee for 5 minutes. It can take up to 45 minutes or maybe longer.</p>
</div>
</li>
<li id="comment-366973" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0600c1bbdac8e010c7dcce546999f0ea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0600c1bbdac8e010c7dcce546999f0ea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Greebo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-22T14:09:12+00:00">November 22, 2018 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>I made the same experience and after waiting patienty, I can tell you: it&rsquo;s not frozen.<br/>
Unfortunately the process is running into some errors later.</p>
<p><code>...<br/>
Tests run: 931, Failures: 0, Errors: 0, Skipped: 3<br/>
[INFO]<br/>
[INFO] --- maven-jar-plugin:2.4:jar (default-jar) @ bukkit ---<br/>
[INFO] Building jar: /home/pi/minecraft/Bukkit/target/bukkit-1.12.2-R0.1-SNAPSHOT.jar<br/>
[INFO]<br/>
[INFO] --- maven-shade-plugin:3.1.0:shade (default) @ bukkit ---<br/>
[WARNING] Error injecting:org.apache.maven.plugins.shade.mojo.ShadeMojo<br/>
java.lang.NoClassDefFoundError: org/codehaus/plexus/util/xml/XmlStreamWriter<br/>
at java.lang.Class.getDeclaredConstructors0(Native Method)<br/>
at java.lang.Class.privateGetDeclaredConstructors(Class.java:2671)<br/>
at java.lang.Class.getDeclaredConstructors(Class.java:2020)<br/>
...<br/>
</code></p>
<p>Last year the instructions from Daniel (thanks a lot!) worked quite well.<br/>
I don&rsquo;t know what happened in the meantime.<br/>
Maybe something in Raspian was changed, impacting these BuildTools or something in the BuildTools / CraftBukkit?!</p>
<p>If someone has a solution I would be pleased if it could be published here. Thank you!</p>
</div>
</li>
</ol>
</li>
<li id="comment-367069" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1c3f10167dadfa80ed713cc6b29b3449?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1c3f10167dadfa80ed713cc6b29b3449?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Guilherme Baracho</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-22T20:57:33+00:00">November 22, 2018 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>I did everything as said and it worked perfectly<br/>
but what I also wanted to do a modded server on the pi to<br/>
do you have any tutorial on that?</p>
</div>
<ol class="children">
<li id="comment-367076" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-22T21:31:35+00:00">November 22, 2018 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t have instructions on how to add &ldquo;mods&rdquo; but that is not difficult.</p>
</div>
</li>
</ol>
</li>
<li id="comment-372743" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba0f5f6210290957d2c09018f4521594?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba0f5f6210290957d2c09018f4521594?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-13T06:01:06+00:00">December 13, 2018 at 6:01 am</time></a> </div>
<div class="comment-content">
<p>When I ran the command, &ldquo;java -jar BuildTools.jar&rdquo; everything installs except that I see errors at the end of the command line dump.</p>
<p><code>Picked up _JAVA_OPTIONS: -Djdk.net.URLClassPath.disableClassPathURLCheck=true<br/>
Exception in thread "main" java.lang.OutOfMemoryError: Java heap space<br/>
at org.objectweb.asm.ByteVector.&lt;init&gt;(ByteVector.java:55)<br/>
at org.objectweb.asm.ClassWriter.toByteArray(ClassWriter.java:554)<br/>
at net.md_5.ss.model.ClassInfo.toByteArray(ClassInfo.java:120)<br/>
at net.md_5.ss.SpecialSource.map(SpecialSource.java:123)<br/>
at net.md_5.ss.SpecialSource.main(SpecialSource.java:46)<br/>
Exception in thread "main" java.lang.RuntimeException: Error running command, return status !=0: [/usr/lib/jvm/jdk-8-oracle-arm32-vfp-hflt/jre/bin/java, -jar, BuildData/bin/SpecialSource-2.jar, map, --only, ., --only, net/minecraft, --auto-synth, -i, work/minecraft_server.1.13.2.jar, -m, BuildData/mappings/bukkit-1.13.2-cl.csrg, -o, work/mapped.72545335.jar-cl]<br/>
at org.spigotmc.builder.Builder.runProcess0(Builder.java:704)<br/>
at org.spigotmc.builder.Builder.runProcess(Builder.java:649)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:393)<br/>
at org.spigotmc.builder.Bootstrap.main(Bootstrap.java:29)<br/>
</code></p>
<p>Then when I type ls, I see no .jar file with spigot in its name. Any recommendations?</p>
</div>
</li>
<li id="comment-374832" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec686664e4d0b3f9c4594ef4ab586a2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec686664e4d0b3f9c4594ef4ab586a2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Garrett</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-22T16:14:15+00:00">December 22, 2018 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>Thanks for your tutorial! It&rsquo;s been very helpful thus far. I&rsquo;m running into some issues running BuildTools.jar and I haven&rsquo;t been able to find anything online regarding this issue. My Pi 3 is unable to run this command because it only detects 237MB of memory. Running vcgencmd get_mem arm returns 998MB of memory, so I&rsquo;m not sure why this is occurring. Do you have any tips?</p>
</div>
<ol class="children">
<li id="comment-377026" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69c7e5e7b45571770842fad3761ef3e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69c7e5e7b45571770842fad3761ef3e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-30T00:03:00+00:00">December 30, 2018 at 12:03 am</time></a> </div>
<div class="comment-content">
<p>Having the same problem! I build a server following this guide step-by-step so I can confirm this guide works!<br/>
Did it on the same raspberry Pi as I&rsquo;m using now&#8230; maybe something with an update on the Pi itself?</p>
</div>
<ol class="children">
<li id="comment-380886" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a79808eb24ce7efdd7dfd5c41e9f1b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a79808eb24ce7efdd7dfd5c41e9f1b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Spremusik</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-10T19:42:33+00:00">January 10, 2019 at 7:42 pm</time></a> </div>
<div class="comment-content">
<p>Had the same problem on PI<br/>
I tried to build on windows and got the same error.<br/>
It was fixed by installing the 64 bit java 8, now the Buildtools works in windows.<br/>
Will try to install Java_8_64 bit on PI and post the results</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-384238" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8f84e11881c463f025ff102c92ba55e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8f84e11881c463f025ff102c92ba55e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-26T09:44:55+00:00">January 26, 2019 at 9:44 am</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>I had the same issue, but I fixed it by running the suggested command in the error to include a specified memory allocation:</p>
<p>pi@raspberrypi:~/minecraft $ java -Xmx224M -jar BuildTools.jar<br/>
BuildTools requires at least 512M of memory to run (1024M recommended), but has only detected 216M.<br/>
This can often occur if you are running a 32-bit system, or one with low RAM.<br/>
Please re-run BuildTools with manually specified memory, e.g: java -Xmx1024M -jar BuildTools.jar<br/>
pi@raspberrypi:~/minecraft $ java -Xmx512M -jar BuildTools.jar</p>
<p>Then it worked for me. Didn&rsquo;t have to install a different version of Java, although I did think about it.</p>
<p>-Chris</p>
</div>
</li>
<li id="comment-386450" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6c8812709a0ed36f1c5bf7d3519599ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6c8812709a0ed36f1c5bf7d3519599ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ty Wilson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-04T02:39:51+00:00">February 4, 2019 at 2:39 am</time></a> </div>
<div class="comment-content">
<p>Hey. I wanted to start up a server to play with some internet friends on Minecraft. I got to the part where I needed to start up the server and it said it couldn&rsquo;t access the jar file Also. How does one make this a public server? Thanks!</p>
</div>
</li>
<li id="comment-387659" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ca1cb16157815ce6f1af35659f1c9ea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ca1cb16157815ce6f1af35659f1c9ea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Artic</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-11T03:09:46+00:00">February 11, 2019 at 3:09 am</time></a> </div>
<div class="comment-content">
<p>Does this work with minecraft sp or just minecraft legacy?<br/>
Because I&rsquo;ve done everything correctly and the server runs, but I just lose connection when I try to join it.</p>
</div>
</li>
<li id="comment-405559" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ab4656f4d6de266f1cfb2b510aa9af6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ab4656f4d6de266f1cfb2b510aa9af6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Graham Merrick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-08T00:15:07+00:00">May 8, 2019 at 12:15 am</time></a> </div>
<div class="comment-content">
<p>Hi, Just an update for anyone pulling their hair out!, I have just yesterday setup a Pi craft server using many different varying methods posted on the web, I found this thread as the best commentary for the average Pi user. My setup consists of a Raspberry pi 3B+ Raspian Stretch OS latest update from 04-08-2019 (8th of April 2019). Spigot 1.13.2 server installed. I have installed the following:<br/>
&#8211; Screen (although helpful Spigot 1.13.2 fails to load in screen I am yet to go through the documentation for Screen to work out how to set it up correctly)<br/>
&#8211; I created a plain bash file as the following: (please note going from memory here! beware if copying below!!)<br/>
cd /home/pi/minecraft<br/>
java -Xms512M -Xmx992M -jar spigot-1.13.2.jar</p>
<p>gave the above .sh file executable permissions (sudo chmod +x)<br/>
created a line before the exit line at the bottom in /etc/rc.local to execute the server at reboot as ./[insertabovefilenamehere].sh.<br/>
(Please note if you are setting this up and want to /OP yourself, you need to have access to the console. In this case prior to rebooting the Pi after you have setup the above start the server by going to the /home/pi/minecraft directory (or wherever you put it) and start the .sh file that you have just created. This will give you access to the console (I cannot get console to work if the server boots on reboot!) I&rsquo;m sure that Screen may help with this but I have not managed to get it to run in screen mode yet.<br/>
Please note I have changed the above comment in the .sh file from -Xmx1008M to Xmx992M this allows the Pi some memory (16M) for overhead as suggested by many other forum users. Spigot runs freely and I have also had up to two players with no issues view distance is good at 10 with 2 players however I will try and load it up soon and see how it goes.</p>
</div>
</li>
<li id="comment-412203" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fc6241d6f1c883e5e9b1bc10c94424b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fc6241d6f1c883e5e9b1bc10c94424b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">denver dial</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-17T02:42:18+00:00">June 17, 2019 at 2:42 am</time></a> </div>
<div class="comment-content">
<p>thank you so much this tutorial was great. easy, simple amd straight forward.</p>
<p>i do however have a couple questions. the spigot file 1.9 that you used. that means your server runs minecratf 1.9 right?</p>
<p>mine is labled 1.13.2 and my server opened in 1.13.2 but i was hopping for a 1.14.2 server. is their a easy wa to update the server to a newer version of minecraft?</p>
</div>
</li>
<li id="comment-414653" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6603a7758ee0df7e326aee97bed68be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6603a7758ee0df7e326aee97bed68be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-01T04:35:01+00:00">July 1, 2019 at 4:35 am</time></a> </div>
<div class="comment-content">
<p>Hey! thanks for this tutorial but when I try to run java -jar BuildTools.jar it says that command java is not found. Any idea how to fix this?</p>
</div>
<ol class="children">
<li id="comment-414738" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-01T14:40:49+00:00">July 1, 2019 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>Quoting from the instructions (first step):</p>
<blockquote><p>You need to put the latest version of the Linux distribution for the Raspberry Pi, <a href="https://www.raspberrypi.org/downloads" rel="nofollow">Raspbian</a>, on the SD card. My instructions assume that you get the full version. For some reason, many people prefer the &ldquo;lite&rdquo; version, but then they can&rsquo;t follow my instructions. Please use the full version (the lite and the full versions are both free). </p></blockquote>
</div>
</li>
</ol>
</li>
<li id="comment-414962" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42e34d4dc770f7f8e59c8e293abab91f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42e34d4dc770f7f8e59c8e293abab91f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-02T15:10:02+00:00">July 2, 2019 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>This works fine on a Pi 4 with 4GB RAM as well.</p>
<p>I set up a server for my kid for Minecraft 1.12.2 on a Raspberry Pi 2. When I tried to make a new SD-card for the latest stable Spigot server (1.13.2) it complained about too little memory. But the Raspberry Pi 4 just came out, so I got one of those. I skipped the step which assigns the minimum amount of memory to the GPU, because I guessed that there will be enough CPU RAM anyway. Now it works.</p>
</div>
</li>
<li id="comment-417726" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ee3f83e7f35fd96e30bba112c0244daa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ee3f83e7f35fd96e30bba112c0244daa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jack Bailey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-14T13:16:33+00:00">July 14, 2019 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>How can I intergrate<br/>
a) Auto server restarting with a plugin<br/>
b) /restart functionality.</p>
<p>Using the pi3b</p>
</div>
</li>
<li id="comment-418892" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/82b6b2e33e96680bb62c353c163a9dce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/82b6b2e33e96680bb62c353c163a9dce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arjun</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-18T20:00:08+00:00">July 18, 2019 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>How can i set up port forwarding, I tried and it is giving me a error, i also need help setting up a dns</p>
</div>
</li>
<li id="comment-420274" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T02:08:10+00:00">July 27, 2019 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>Thanks for this tutorial. When I try to connect to the server from another laptop for the first time it gives me the &ldquo;failed to connect to the server&rdquo; io.netty.abstractchannel$annotatedconnectexpectation&rdquo;. I tried direct connect to the IP address that came up when I input screen -list and also tried the Add Server. Both returned this error. Laptop is connected via wi-fi and tried it with the Pi on ethernet and wi-fi on seperate occassions. How do I know if the Pi server is running? Your tutorial said to connect to raspberrypi.local&#8230;. do I type that in as the IP address? Where do I input that?</p>
</div>
<ol class="children">
<li id="comment-420275" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T02:12:19+00:00">July 27, 2019 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>When I disconnect from ethernet and switch to wi-fi, did I stop the server? Do I need to restart it somehow?</p>
</div>
<ol class="children">
<li id="comment-420276" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T02:16:13+00:00">July 27, 2019 at 2:16 am</time></a> </div>
<div class="comment-content">
<p>Sorry for allthe comments. How do I do this: &ldquo;Have a Minecraft player connect to raspberrypi.local&rdquo; ?</p>
</div>
<ol class="children">
<li id="comment-420277" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/27318b29b3f2da41cbbbc851637fd4b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-27T02:28:38+00:00">July 27, 2019 at 2:28 am</time></a> </div>
<div class="comment-content">
<p>Disregard! I must have stopped the server when I switched the pi to wifi. It&rsquo;s working now, but I did not connect to &ldquo;raspberrypi.local&rdquo;, instead I added the server by IP address</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-421577" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7433c8eaeefd8fe9fa74fe4e1cf030d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7433c8eaeefd8fe9fa74fe4e1cf030d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">netherwort</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-01T19:38:14+00:00">August 1, 2019 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>My server is running 1.13.2, and almost every time I try to connect I get a connection timed out message. After I try to connect a few times the server crashes, and for a few seconds before the screen terminates, there is a bit that says it failed because it could not find a file with the name &ldquo;./start&rdquo;.<br/>
The pi only has access to 2.1 or so amps, I don&rsquo;t know if that is relevant.</p>
</div>
</li>
<li id="comment-425110" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rubens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-24T20:26:38+00:00">August 24, 2019 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>I am setting up a sever on a Pi 4 with 4GB ram and i was wandering if -Xms and -Xmx was the ammount of ram dedicated to the server. If so can i just change it to -Xmx3800M or do i have to do it another way?</p>
<p>Thanks.</p>
</div>
<ol class="children">
<li id="comment-425119" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-24T21:43:18+00:00">August 24, 2019 at 9:43 pm</time></a> </div>
<div class="comment-content">
<p>Right. You might be able to increase the memory budget with these flags. Do not increase it too much otherwise Java may hog too much memory.</p>
</div>
<ol class="children">
<li id="comment-425914" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rubens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-01T17:20:38+00:00">September 1, 2019 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, could you prehaps give me a margin not to exede when it comes to dedicating memory. Furthermore I will only be running the server on the pi so does it still matter if it hogges all the memory.</p>
</div>
<ol class="children">
<li id="comment-425945" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-02T00:26:36+00:00">September 2, 2019 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>If the system runs out of memory and you have partitioned enough disk space, it will go to disk which could seriously hurt the performance. Failing that, the system may fail&#8230; Thankfully the Linux kernel and other services should be able to run well with a few hundred megabytes. I would expect that keeping 500 MB for the non-minecraft systems should be more than enough.</p>
</div>
<ol class="children">
<li id="comment-426104" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rubens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-03T13:52:52+00:00">September 3, 2019 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p>Thanks so much this has been so helpful!</p>
</div>
</li>
<li id="comment-426119" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rubens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-03T16:35:53+00:00">September 3, 2019 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>Um when i start the server with &ldquo;java -jar -Xms512M -Xmx2800M spigot-1.14.4.jar nogui&rdquo;<br/>
i get this error<br/>
&ldquo;java.lang.OutOfMemoryError: Metaspace<br/>
at java.lang.ClassLoader.defineClass1(Native Method) ~[?:?]<br/>
at java.lang.ClassLoader.defineClass(ClassLoader.java:1016) ~[?:?]<br/>
at java.security.SecureClassLoader.defineClass(SecureClassLoader.java:174) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.defineClass(BuiltinClassLoader.java:802) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.findClassOnClassPathOrNull(BuiltinClassLoader.java:700) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.loadClassOrNull(BuiltinClassLoader.java:623) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.loadClass(BuiltinClassLoader.java:581) ~[?:?]<br/>
at jdk.internal.loader.ClassLoaders$AppClassLoader.loadClass(ClassLoaders.java:178) ~[?:?]<br/>
at java.lang.ClassLoader.loadClass(ClassLoader.java:521) ~[?:?]<br/>
at java.lang.ClassLoader.defineClass1(Native Method) ~[?:?]<br/>
at java.lang.ClassLoader.defineClass(ClassLoader.java:1016) ~[?:?]<br/>
at java.security.SecureClassLoader.defineClass(SecureClassLoader.java:174) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.defineClass(BuiltinClassLoader.java:802) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.findClassOnClassPathOrNull(BuiltinClassLoader.java:700) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.loadClassOrNull(BuiltinClassLoader.java:623) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.loadClass(BuiltinClassLoader.java:581) ~[?:?]<br/>
at jdk.internal.loader.ClassLoaders$AppClassLoader.loadClass(ClassLoaders.java:178) ~[?:?]<br/>
at java.lang.ClassLoader.loadClass(ClassLoader.java:521) ~[?:?]<br/>
at java.lang.ClassLoader.defineClass1(Native Method) ~[?:?]<br/>
at java.lang.ClassLoader.defineClass(ClassLoader.java:1016) ~[?:?]<br/>
at java.security.SecureClassLoader.defineClass(SecureClassLoader.java:174) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.defineClass(BuiltinClassLoader.java:802) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.findClassOnClassPathOrNull(BuiltinClassLoader.java:700) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.loadClassOrNull(BuiltinClassLoader.java:623) ~[?:?]<br/>
at jdk.internal.loader.BuiltinClassLoader.loadClass(BuiltinClassLoader.java:581) ~[?:?]<br/>
at jdk.internal.loader.ClassLoaders$AppClassLoader.loadClass(ClassLoaders.java:178) ~[?:?]<br/>
at java.lang.ClassLoader.loadClass(ClassLoader.java:521) ~[?:?]<br/>
at net.minecraft.server.v1_14_R1.RegionFileCache.(RegionFileCache.java:14) ~[spigot-1.14.4.jar:git-Spigot-065a373-763e560]<br/>
at net.minecraft.server.v1_14_R1.IChunkLoader.(IChunkLoader.java:16) ~[spigot-1.14.4.jar:git-Spigot-065a373-763e560]<br/>
at net.minecraft.server.v1_14_R1.PlayerChunkMap.(PlayerChunkMap.java:102) ~[spigot-1.14.4.jar:git-Spigot-065a373-763e560]<br/>
at net.minecraft.server.v1_14_R1.ChunkProviderServer.(ChunkProviderServer.java:48) ~[spigot-1.14.4.jar:git-Spigot-065a373-763e560]<br/>
at net.minecraft.server.v1_14_R1.WorldServer.lambda$0(WorldServer.java:86) ~[spigot-1.14.4.jar:git-Spigot-065a373-763e560]&rdquo;</p>
<p>im using a pi 4 4gb</p>
</div>
<ol class="children">
<li id="comment-426125" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-03T18:40:42+00:00">September 3, 2019 at 6:40 pm</time></a> </div>
<div class="comment-content">
<p>Are you sure that you have access to the 4GB? The OS is 64-bit or 32-bit? Getting Java to use all of the available memory requires support at the kernel level. Typically, 32-bit systems do not give access to a single process to more than 2GB or 3GB.</p>
<p>Type</p>
<pre><code>uname -m
</code></pre>
<p>If you have a 64-bit system, you should see aarch64 or the equivalent. If you don&rsquo;t then you probably can&rsquo;t use 4GB.</p>
</div>
<ol class="children">
<li id="comment-429698" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/632e4912b8e28a7417b17752fd9fbd70?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rubens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T17:50:02+00:00">September 30, 2019 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>So I got aarch71 what does that mean?</p>
</div>
<ol class="children">
<li id="comment-587169" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-14T22:26:28+00:00">June 14, 2021 at 10:26 pm</time></a> </div>
<div class="comment-content">
<p>I do not know what &ldquo;aarch71&rdquo; means.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-428239" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3edbc051120235d7e4cefbbf1fdc0e52?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3edbc051120235d7e4cefbbf1fdc0e52?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Borja Sangaz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-21T16:55:26+00:00">September 21, 2019 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>Hello.<br/>
I have been following your tutorial, and everything was installed and started running, on a Raspberry 3b+ with RaspbianBuster (actual version) and Minecraft 1.14.4 (and the same version of the Spigot), almost without problems exept when trying to run <strong><em>java -jar BuidTools.jar</em></strong> where I get the following error:<br/>
&ldquo;<em>BuildTools requires at least 512M of memory to run (1024M recommended), but has only detected 224M. This can often occur if you ar running a 32-bit system, or one with low RAM. Please re-run BuildTools with manually specified memory, e.g: java -Xmx1024M -jar BuidTools.jar</em>&ldquo;.<br/>
After running it as <strong><em>java -Xmx1000M -jar BuidTools.jar</em></strong>, the rest goes very smoth, exacty as in the tutorial is described (of course, using always the version 1.14.4 instead of the 1.9).<br/>
The real problem comes when I start running the server and playing, as it kicks me out with a &ldquo;waiting timeout&rdquo; message (sometimes after 5min or less, sometimes after 20-30min), and it goes offline, not only the MinecraftServer, but also the Raspberry (cannot even log in with VNC), and it does not work at all until it gets manually restarted&#8230; but when I come again into the server to play, everything I had in the inventary is lost!! 🙁<br/>
Obviously, after a couple times having to restart manually the server and losing everything (and the time it needs to restart everything), it gets veeeery anoying 🙁<br/>
We are only two persons playing, and the RasPi (as well as both computers) is connected to the router with cable instead of WiFi, as it goes faster.<br/>
Do you have an idea how can this can be solved?? And/or why is it happening??<br/>
Thanks a lot and greetings.</p>
</div>
</li>
<li id="comment-435824" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ef360128fcb81e5e919f2d429b8b120?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ef360128fcb81e5e919f2d429b8b120?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://none" class="url" rel="ugc external nofollow">DJ Borowski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-29T23:18:31+00:00">October 29, 2019 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>Hey, I was trying to set the server up as a Raspberry Pi 4, with a Minecraft PE. I was unable to connect to the server using the configure server setting from within the PE. Also when I tried one of the Pocket Edition (Pokkit-Master) it wasn&rsquo;t supported by the type of Raspberry Pi OS. I need some help. Thanks!</p>
</div>
</li>
<li id="comment-451847" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c173a209089cbf32b284af15514cff19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c173a209089cbf32b284af15514cff19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Austin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-01T01:28:42+00:00">December 1, 2019 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I&rsquo;m considering buying the Raspberry Pi, either 3 or 4 to host a server as you&rsquo;ve said. I&rsquo;m pretty experienced with linux terminal so I may play around with stuff a bit, but I had a question before I start. You mentioned saving tmp files directly to memory instead of writing the files. Does this mean if the Pi loses power (simple power outage or anything) that the world would be lost? Also, I understand this is a low power system, but is there a simple setting change that would allow the server to be turned off when not in use? I&rsquo;ll likely only use it occasionally, so no need to have it running the other 99% of the time.</p>
<p>Thanks so much for the guide!</p>
</div>
<ol class="children">
<li id="comment-451927" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-01T05:29:53+00:00">December 1, 2019 at 5:29 am</time></a> </div>
<div class="comment-content">
<p>I do not know whether it is possible to put the raspberry to sleep.</p>
<p>If you want world persistance, then a raspberry pi with an SD card is not the right system.</p>
</div>
<ol class="children">
<li id="comment-452579" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c173a209089cbf32b284af15514cff19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c173a209089cbf32b284af15514cff19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Austin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-02T21:01:29+00:00">December 2, 2019 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>What is it that really prevents world persistence with this system? I&rsquo;ve never messed around with any kind of minecraft server so I don&rsquo;t really know how they work under the hood, but I understand typically a server can be restarted and everything remains through the restart. If I have to really dig into that part on my own I can, but what really sets a Pi on an SD card apart from any other desktop on an HDD or SSD?</p>
</div>
<ol class="children">
<li id="comment-452580" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-02T21:31:24+00:00">December 2, 2019 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p>I explain in my post why I recommend not writing the temporary files to the SD card:</p>
<blockquote><p>Spigot makes use of temporary files (located in tmp). This can cause performance issues and instabilities on a Raspberry Pi. It may even shorten the life of your SD card. It might be better to have temporary files reside in memory.</p></blockquote>
<p><em> I understand typically a server can be restarted and everything remains through the restart.</em></p>
<p>If properly shut down and properly restarted, yes. If your server crashes, then no. Hence the word &ldquo;instabilities&rdquo; in my post.</p>
<p>Some software is robust to system-wide crashes. Certainly, the software running your bank is probably robust to crashes. A Minecraft server is not engineered with this kind of care.</p>
<p><em>(&#8230;) what really sets an (&#8230;) SD card apart from an (&#8230;) HDD or SSD?</em></p>
<p>A Raspberry Pi with an SD card is not a reliable system. It will crash. In my experience, you can improve the reliability by sparing the SD card.</p>
</div>
<ol class="children">
<li id="comment-452583" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c173a209089cbf32b284af15514cff19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c173a209089cbf32b284af15514cff19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Austin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-02T21:41:53+00:00">December 2, 2019 at 9:41 pm</time></a> </div>
<div class="comment-content">
<p>What do you mean by &ldquo;sparing the SD card&rdquo;? Is the unreliability of the Pi-SD system just the card? If so, is it possible to run the Pi on a small HDD to essentially make it a tiny desktop? Just trying to understand a bit of how the system works.<br/>
As a follow up to the minecraft question, assuming the system works barring crashes, would it be possible to implement save states such that it can be recovered at least to a certain point after a crash?</p>
</div>
<ol class="children">
<li id="comment-452591" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-02T22:01:57+00:00">December 2, 2019 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p><em>What do you mean by “sparing the SD card”? Is the unreliability of the Pi-SD system just the card? If so, is it possible to run the Pi on a small HDD to essentially make it a tiny desktop? Just trying to understand a bit of how the system works.</em></p>
<p>I expect that the SD card is probably one of the core weaknesses of the system, reliability-wise. However, I have no experience running a Raspberry PI with anything but an SD card so it is hard to know for sure. I have a ROCKPro64 that has its own eMM module and it has a nearly perfect uptime. Much better than a Raspberry Pi. I expect that the SD card is the main difference.</p>
<p>If you want a more reliable machine, I would probably go with the ROCKPro64. <a href="https://lemire.me/blog/2019/05/14/setting-up-a-rockpro64-powerful-single-card-computer/">I have a post about how to set one up</a>.</p>
<p>This being said, if you really care about reliability, then you probably want a genuine server and not a single-card computer.</p>
<p><em>it be possible to implement save states</em></p>
<p>You will have to investigate this issue with the Spigot documentation. You can request a save or a shut down, but I am unaware of a standard way to generate a safe backup.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-471753" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85fd7fe19da8cfe0bc7d26d1717f12c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85fd7fe19da8cfe0bc7d26d1717f12c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://erm3nda.github.com" class="url" rel="ugc external nofollow">m3nda</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-17T10:14:29+00:00">December 17, 2019 at 10:14 am</time></a> </div>
<div class="comment-content">
<p>Thank you so much for this simple but powerfull guide.</p>
<p>I managed to launch a Minecraft server 1.4 into my mobile phone (a chinesse one i do have for such task, called F9006) using LinuxDeploy for easy chroot, installing Debian on it.</p>
<p>Sadly &#8230; Running 63687ms or 1273 ticks behind.</p>
<p>I&rsquo;ve ensured that all cores where ON forcibly using Kernel Auditor, but seems that is not enough or the ram is not sufficient.</p>
<p>Can&rsquo;t connect to the server because i don&rsquo;t have such game, but seems that 1273 ticks behing is not a good value.</p>
<p>About sdcard, yes, it&rsquo;s the weakest point of the RPi system. Even with a suddently power loss it could break. I suggest anyone using RPI seriously to attach a big ass 5V capacitor to their usb power wires &#8230;</p>
<p>Usually, people tend to use noatime on fstab, which tends to more chances to crash if you get a power supply interruption.</p>
<p>And, using the sdcard only for boot is also totally advised. It&rsquo;s cheap to use an reuse USB memories wich have better NAND controller.</p>
</div>
</li>
<li id="comment-478598" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43443a3c678f2069b4bbd46e12ee70c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43443a3c678f2069b4bbd46e12ee70c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Trentyn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-26T16:44:21+00:00">December 26, 2019 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>Hey, I followed everything to the T and it works -almost. it detaches itself to a screen but after it finishes loading on the screen, the screen terminates itself for what feels like no reason, and it definitely has me wondering whats wrong.</p>
</div>
</li>
<li id="comment-486397" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c969b086cb2c004598a2f4aff6d66556?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c969b086cb2c004598a2f4aff6d66556?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matej Manko?</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-18T20:16:50+00:00">January 18, 2020 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>the server works, but when I tried to connect to it, it display &ldquo;Failed to verify username!&rdquo;. Can someone help me?</p>
<p>I use a cracked launcher of Minecraft</p>
</div>
</li>
<li id="comment-487669" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ccc8c838f885056f5aecccf3b1d8efb7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ccc8c838f885056f5aecccf3b1d8efb7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-28T02:58:38+00:00">January 28, 2020 at 2:58 am</time></a> </div>
<div class="comment-content">
<p>I am having trouble figuring out how to work ssh. could you please help me?</p>
</div>
</li>
<li id="comment-497229" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b9498c480159f0c3ea2d6ec6f942e31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b9498c480159f0c3ea2d6ec6f942e31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">gc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-20T16:18:43+00:00">March 20, 2020 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>the reason people prefer the lite version is because it is headless out of the box. you aren&rsquo;t doing anything that requires a GUI, so the full version is just bloat.</p>
</div>
<ol class="children">
<li id="comment-497231" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-20T16:30:09+00:00">March 20, 2020 at 4:30 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>the reason people prefer the lite version is because it is headless out of the box. you aren’t doing anything that requires a GUI, so the full version is just bloat.</p>
</blockquote>
<p>A good fraction of people who can&rsquo;t make this work are trying to use the lite version and encountering quite bit of difficulties.</p>
<p>The lite version can be made to work, but it is requires more time and expertise.</p>
</div>
</li>
</ol>
</li>
<li id="comment-498264" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jamie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T00:50:49+00:00">March 28, 2020 at 12:50 am</time></a> </div>
<div class="comment-content">
<p>Thank you very much for this detailed instructions! but I must have goofed up somewhere and I can&rsquo;t find to retrace the steps to fix it. I installed the &ldquo;Download the build file for Spigot&rdquo; and it downloaded in seconds, but once I tried &ldquo;java. -jar BuildTools.jar&rdquo; it couldn&rsquo;t complete the command<br/>
&ldquo;pi@raspberrypi:~/minecraft $ java -jar BuildTools.jar<br/>
-bash: java: command not found&rdquo;</p>
</div>
<ol class="children">
<li id="comment-498267" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T00:59:25+00:00">March 28, 2020 at 12:59 am</time></a> </div>
<div class="comment-content">
<p>You have failed to install Java.</p>
</div>
<ol class="children">
<li id="comment-498291" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jamie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T05:27:43+00:00">March 28, 2020 at 5:27 am</time></a> </div>
<div class="comment-content">
<p>how do I go about to reinstall? or is that a step I have to figure out on my own?</p>
</div>
<ol class="children">
<li id="comment-498334" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T14:12:08+00:00">March 28, 2020 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>Try typing</p>
<p>sudo apt install default-jdk</p>
</div>
<ol class="children">
<li id="comment-498345" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jamie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T15:59:55+00:00">March 28, 2020 at 3:59 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m getting errors:<br/>
Error occurred during initialization of VM<br/>
Server VM is only supported on ARMv7+ VFP<br/>
E: /etc/ca-certificates/update.d/jks-keystore exited with code 1.<br/>
done.<br/>
Errors were encountered while processing:<br/>
ca-certificates-java<br/>
openjdk-9-jre-headless:armhf<br/>
openjdk-9-jdk-headless:armhf<br/>
openjdk-9-jdk:armhf<br/>
openjdk-9-jre:armhf<br/>
E: Sub-process /usr/bin/dpkg returned an error code (1)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-498461" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9533bc764c0e617afc3954733663ab17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jamie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-29T18:10:22+00:00">March 29, 2020 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>I restarted the entire process, wiped the SD card and reloaded imager,<br/>
here is my error at the first step<br/>
Errors were encountered while processing:<br/>
ca-certificates-java<br/>
E: Sub-process /usr/bin/dpkg returned an error code (1)</p>
</div>
</li>
<li id="comment-500945" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0f7940b5dc314fef1460c83b1cdd2b2f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0f7940b5dc314fef1460c83b1cdd2b2f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">N. S.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-12T19:23:43+00:00">April 12, 2020 at 7:23 pm</time></a> </div>
<div class="comment-content">
<p>This tutorial was very helpful. Thank you for the time you took writing clear and easy instructions!</p>
</div>
</li>
<li id="comment-504077" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28392bba50905c0d86466a312cef3765?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28392bba50905c0d86466a312cef3765?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-03T17:05:57+00:00">May 3, 2020 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p>Great instructions. I managed to get it going on my Raspberry 3 and the kids are loving it.</p>
<p>One question, however: At one point, you provide the following instructions to have the server start automatically upon reboot: &ldquo;enter su -l pi -c /home/pi/minecraft/minecraft.sh right before the exit command.&rdquo;</p>
<p>What exactly is the &ldquo;exit command&rdquo;. I realize this may be a stupid question, but if you could provide a response, it would be greatly appreciated!</p>
<p>Thanks!</p>
</div>
<ol class="children">
<li id="comment-504503" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-05T00:43:16+00:00">May 5, 2020 at 12:43 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>What exactly is the “exit command”. I realize this may be a stupid question, but if you could provide a response, it would be greatly appreciated!</p>
</blockquote>
<p>I think you are only selecting part of the instructions. The instructions in full are: &ldquo;We want the server to start automatically when the Raspberry Pi reboots, so type sudo nano /etc/rc.local and enter su -l pi -c /home/pi/minecraft/minecraft.sh right before the exit command.&rdquo;</p>
<p>Have you done &ldquo;sudo nano /etc/rc.local&rdquo;?</p>
</div>
</li>
</ol>
</li>
<li id="comment-518908" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c401a40c6d98c9ed6e579c60bcc66dea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c401a40c6d98c9ed6e579c60bcc66dea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-23T09:43:38+00:00">May 23, 2020 at 9:43 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
Amazing tutorial, thank you so much. However, my build is stuck after inserting this command: java -jar -Xms512M -Xmx1008M spigot-1.9.jar nogui<br/>
I changed the parameters slightly to java -jar -Xms512M -Xmx700M spigot-1.15.2.jar nogui and it is still stuck (after 36 hours) on: [17:04:35] [Server-Worker-2/INFO]: Preparing spawn area: 87%<br/>
[17:04:35] [Server-Worker-1/INFO]: Preparing spawn area: 90%<br/>
[17:04:36] [Server-Worker-3/INFO]: Preparing spawn area: 94%<br/>
[17:04:36] [Server thread/INFO]: Time elapsed: 10365 ms<br/>
[17:04:36] [Server thread/INFO]: Server permissions file permissions.yml is empty, ignoring it<br/>
[17:04:38] [Server thread/WARN]: Block entity invalid: minecraft:mob_spawner @ BlockPosition{x=-76, y=28, z=-220}<br/>
[17:04:38] [Server thread/WARN]: Block entity invalid: minecraft:chest @ BlockPosition{x=-76, y=28, z=-217}<br/>
[17:09:48] [Server thread/WARN]: Can&rsquo;t keep up! Is the server overloaded? Running 10589ms or 211 ticks behind<br/>
&gt;<br/>
&gt;<br/>
&gt;<br/>
[21:40:11] [Server thread/WARN]: Can&rsquo;t keep up! Is the server overloaded? Running 5645ms or 112 ticks behind<br/>
&gt;<br/>
Any help? Am I doing something wrong?</p>
</div>
<ol class="children">
<li id="comment-545707" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/151186fab17569ffd90a0b7a5b0442fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/151186fab17569ffd90a0b7a5b0442fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Someone</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-27T16:37:24+00:00">July 27, 2020 at 4:37 pm</time></a> </div>
<div class="comment-content">
<p>same problem. and I also have a screen issue. it says<br/>
pi@raspberrypi:~ $ screen -r minecraft<br/>
There is no screen to be resumed matching minecraft.</p>
</div>
</li>
<li id="comment-556850" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa7f8853a3ff5dc25db0eeb265bac3e2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa7f8853a3ff5dc25db0eeb265bac3e2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-02T02:06:08+00:00">November 2, 2020 at 2:06 am</time></a> </div>
<div class="comment-content">
<p>Same issue &#8230; any resolutions?</p>
</div>
<ol class="children">
<li id="comment-556851" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa7f8853a3ff5dc25db0eeb265bac3e2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa7f8853a3ff5dc25db0eeb265bac3e2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-02T02:07:50+00:00">November 2, 2020 at 2:07 am</time></a> </div>
<div class="comment-content">
<p>My issue is the same as</p>
<p>&ldquo;Can’t keep up! Is the server overloaded?&rdquo;</p>
<p>On raspberry pi 3B with 4 gb ram</p>
<p>Thanks in anticipation</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-525996" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d1c92ffb8cb75598e70f6ff062d462f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d1c92ffb8cb75598e70f6ff062d462f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Candace Duffy Jones</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T20:22:11+00:00">June 11, 2020 at 8:22 pm</time></a> </div>
<div class="comment-content">
<p>Hello, I have followed every step, without exception and only altered the spigot version used (spigot-1.15.2.jar) but I have one issue. When I use the command</p>
<p><code>screen -r minecraft<br/>
</code></p>
<p>I get the message</p>
<p><code>There is no screen to be resumed matching minecraft<br/>
</code></p>
<p>Everything else works fine. I am using Raspberry Pi 4 with the newest Raspbian desktop.</p>
</div>
<ol class="children">
<li id="comment-526002" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-11T21:41:14+00:00">June 11, 2020 at 9:41 pm</time></a> </div>
<div class="comment-content">
<p>The script that you are told to run has the following line&#8230;</p>
<pre><code>screen -S minecraft -d -m java -jar  ...
</code></pre>
<p>This creates a screen called minecraft. If you have not executed the script, then you will get the error that you describe.</p>
</div>
</li>
</ol>
</li>
<li id="comment-531714" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ccf4fca9d20944018c7fe2233048bff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ccf4fca9d20944018c7fe2233048bff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-24T21:03:42+00:00">June 24, 2020 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>How do you find the file after you type &ldquo;java -Xmx1024M -jar BuildTools.jar</p>
</div>
</li>
<li id="comment-531729" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ccf4fca9d20944018c7fe2233048bff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ccf4fca9d20944018c7fe2233048bff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-24T22:11:51+00:00">June 24, 2020 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t find the file that you called spigot-1.9.jar. How do you find it?</p>
</div>
</li>
<li id="comment-533723" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b9e20eadaec0517efc4c1dbc94a39cf2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b9e20eadaec0517efc4c1dbc94a39cf2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David B</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-06T16:59:33+00:00">July 6, 2020 at 4:59 pm</time></a> </div>
<div class="comment-content">
<p>Hello Daniel, Thank you very much for your &ldquo;perfect&rdquo; instructions 🙂<br/>
You may like to know I got MC v1.15.2 running on a Raspberry Pi 1b &#8211; yep 1b<br/>
I am now waiting for v1.16.1 to be released by the lovely Spigot people.<br/>
I was going to say that I would be interested in you confirming the upgrade process, however, I just saw your final comment on the subject 🙂 .<br/>
Anyway, I think it will be something like:<br/>
1. Get the new build file with &ldquo;wget <a href="https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar" rel="nofollow ugc">https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar</a>&rdquo;<br/>
2. Build the spigot-1.16.1.jar file with &ldquo;java -jar BuildTools.jar&rdquo;<br/>
3. Edit the minecraft.sh file to point to the new jar file just built.<br/>
4. I may also do a one-off startup and add &ldquo;&#8211;forceUpgrade &#8211;eraseCache&rdquo; before &ldquo;nogui&rdquo;</p>
</div>
<ol class="children">
<li id="comment-533787" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-06T22:40:10+00:00">July 6, 2020 at 10:40 pm</time></a> </div>
<div class="comment-content">
<p>@David</p>
<p>Thanks. I wrote that &ldquo;I tried long and hard to get a stable and fast server running on a first-generation Raspberry Pi, but it was not good.&rdquo; That&rsquo;s probably what you meant by &ldquo;my final comment on the subject&rdquo;.</p>
<p>It is great if you are running a stable Minecraft server on an early Raspberry Pi.</p>
</div>
<ol class="children">
<li id="comment-534653" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b9e20eadaec0517efc4c1dbc94a39cf2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b9e20eadaec0517efc4c1dbc94a39cf2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Blake</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-08T14:38:00+00:00">July 8, 2020 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>By “final comment on the subject”, I was referring to upgrading to a new MC version.</p>
<p>&ldquo;Extra: What if you have installed the Minecraft server, and now want to upgrade it? Sadly, there is no built-in support for in-place updates in Spigot as far as I know. When the software does not support updates, many things can go wrong if you try to force an update so I simply recommend against updates. &rdquo;</p>
</div>
<ol class="children">
<li id="comment-549815" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-21T13:00:06+00:00">August 21, 2020 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>Yes. You certainly can upgrade if you know what you are doing. However, please look at the comments I am getting. People have a hard time following instructions starting from a clean system.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-549799" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/db3e4d665ea1c5a4b940062dced61852?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/db3e4d665ea1c5a4b940062dced61852?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Johnnie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-21T09:19:57+00:00">August 21, 2020 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>Will people that are not on the same network be able to join?</p>
</div>
<ol class="children">
<li id="comment-549814" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-21T12:58:29+00:00">August 21, 2020 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>This is a networking issue addressed at the end of the post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-551976" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97f9ce7d9282001f9c39e01c139076c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97f9ce7d9282001f9c39e01c139076c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peterson Daughtry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-07T21:01:41+00:00">September 7, 2020 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, thanks for the post. It was very easy to follow. Now that I have started the server, I have not been able to connect/join the server from my computer. It does not even show up when I search for a server. How would you recommend troubleshooting?</p>
</div>
<ol class="children">
<li id="comment-551982" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-07T21:50:47+00:00">September 7, 2020 at 9:50 pm</time></a> </div>
<div class="comment-content">
<p>So you are logged into the server from your computer using ssh, and you can see the minecraft console&#8230; correct ?</p>
</div>
<ol class="children">
<li id="comment-552073" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97f9ce7d9282001f9c39e01c139076c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97f9ce7d9282001f9c39e01c139076c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peterson Daughtry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-08T16:22:09+00:00">September 8, 2020 at 4:22 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I have entered the following line in terminal:</p>
<p><code>java -jar -Xms512M -Xmx1008M spigot-1.16.2.jar nogui<br/>
</code></p>
<p>and the server starts. But when I log into minecraft, I can not see the server. I am pretty new to this type of thing and have a lot to learn. It is very possible I am missing something simple.</p>
</div>
<ol class="children">
<li id="comment-552076" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-08T16:54:52+00:00">September 8, 2020 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>If you are logging into the minecraft server using sssh from your PC, then your PC ought to see the minecraft server and a Java-based minecraft ought to discover the new minecraft server. You will have to give us more details.</p>
</div>
<ol class="children">
<li id="comment-552077" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97f9ce7d9282001f9c39e01c139076c8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97f9ce7d9282001f9c39e01c139076c8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peterson Daughtry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-08T17:28:10+00:00">September 8, 2020 at 5:28 pm</time></a> </div>
<div class="comment-content">
<p>So I was just able to join the server! Not exactly sure why I was unable to earlier, but thank you for your time and help.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-552349" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cedric Haspel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T17:43:42+00:00">September 11, 2020 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
I wanted to ask if you can help me. When I enter the command: sudo apt-get install netatalk screen avahi-daemon default-jdk in the first step, it writes E: Unable to locate package avahi-deamon.<br/>
What can I do? Please answer</p>
</div>
<ol class="children">
<li id="comment-552350" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T17:51:19+00:00">September 11, 2020 at 5:51 pm</time></a> </div>
<div class="comment-content">
<p>Which Linux distribution did you install on your Pi?</p>
</div>
<ol class="children">
<li id="comment-552354" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cedric Haspel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:37:44+00:00">September 11, 2020 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p>Raspberry Pi OS (32-Bit) Lite</p>
</div>
<ol class="children">
<li id="comment-552357" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cedric Haspel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:41:04+00:00">September 11, 2020 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>Raspberry pi os 32-bit</p>
</div>
</li>
<li id="comment-552358" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:41:10+00:00">September 11, 2020 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>So you are using the lite version.</p>
<p>Have you checked this passage at the beginning of the blog post?</p>
<blockquote>
<p>For some reason, many people prefer the “lite” version, but then they can’t follow my instructions. Please use the full version (the lite and the full versions are both free). You can make things work with the “lite” version and even save a few steps and some storage space, but if you go down the “lite” route, do not complain if my instructions do not work for you.</p>
</blockquote>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-552359" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/da5be4bc08ee3e0efde9750b7b6414c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cedric Haspel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:46:41+00:00">September 11, 2020 at 7:46 pm</time></a> </div>
<div class="comment-content">
<p>ok thx I am using the full version</p>
</div>
<ol class="children">
<li id="comment-552360" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:48:27+00:00">September 11, 2020 at 7:48 pm</time></a> </div>
<div class="comment-content">
<p>If you are using the full version, it should work (it has worked for hundreds of people).</p>
</div>
</li>
</ol>
</li>
<li id="comment-553346" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ae3903b5340e58133a8dec22f295be42?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ae3903b5340e58133a8dec22f295be42?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shareel C</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T09:34:28+00:00">September 24, 2020 at 9:34 am</time></a> </div>
<div class="comment-content">
<p>Hello, I have done this and want to know how to add texture packs and stuff to it, Thanks</p>
</div>
</li>
<li id="comment-553449" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T15:13:34+00:00">September 25, 2020 at 3:13 pm</time></a> </div>
<div class="comment-content">
<p>Just wanted to say &lsquo;Thanks&rsquo; &#8211; I&rsquo;ve used your guide a few times now and have just upgraded to a Raspberry PI 4B 8GB RAM and everything is up and running again.</p>
<p>A couple of questions (if you get time):</p>
<p>Although I can connect directly using the IP address, do you know why the server is never found via scan? It always shows &lsquo;Scanning for games on your local network&rsquo; but never finds anything.<br/>
My PI is dedicated to running my Minecraft server, are there any settings to adjust for a PI 4B 8gb? I noticed the warning &lsquo;Can&rsquo;t keep up &#8211; X blocks behind&rsquo; a few times when I first started the server.</p>
</div>
<ol class="children">
<li id="comment-553453" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T16:35:56+00:00">September 25, 2020 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>A Pi4 with 8 GB should be more than enough. Have you tried giving it more memory?</p>
</div>
<ol class="children">
<li id="comment-553468" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T21:16:22+00:00">September 25, 2020 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not actually sure how I&rsquo;d do this 🙂 The only time I&rsquo;ve used Linux is through this guide.</p>
<p>I&rsquo;m guessing this is changed using &ldquo;-Xms512M -Xmx1008M&rdquo; but I&rsquo;m not sure.</p>
</div>
<ol class="children">
<li id="comment-553471" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T21:58:09+00:00">September 25, 2020 at 9:58 pm</time></a> </div>
<div class="comment-content">
<p>If your Raspberry Pi has a lot of memory (e.g., 4 GB or 8 GB) then you can change the -Xmx1008M to something like -Xmx2048M. The number (e.g., 2048M) should not exceed the available RAM. Giving the server more memory may improve the performance.</p>
<p>Note that you should expect diminishing returns: 2GB is a lot of memory for a minecraft server. There is really no reason for it to use up much more unless you have expensive plugins.</p>
</div>
<ol class="children">
<li id="comment-553518" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-26T07:45:27+00:00">September 26, 2020 at 7:45 am</time></a> </div>
<div class="comment-content">
<p>Many thanks Daniel</p>
</div>
</li>
<li id="comment-587159" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a26c3cd1523c24332752c1eb8d2deb0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a26c3cd1523c24332752c1eb8d2deb0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vlad G.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-14T20:54:13+00:00">June 14, 2021 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>Very helpful guide Daniel. Although, I see that in a lot of comments you are suggesting you can use 4GB of memory but I&rsquo;ve been trying to do this using different solutions found online for the last hour and just can&rsquo;t get it to work. From what I&rsquo;ve read the problem is that the maximum allocation capacity from java for a single app is 2GB max, not 1MB extra&#8230; Could you please try it as well and see if it works for you. It shouldn&rsquo;t, normally&#8230;</p>
</div>
<ol class="children">
<li id="comment-587170" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-14T22:38:15+00:00">June 14, 2021 at 10:38 pm</time></a> </div>
<div class="comment-content">
<p>On a 32-bit system, the allowable range should be between 2GB to 3GB on a 32-bit Linux system. If you want to use 4GB or more, you need to be on a 64-bit system which you can grab from the raspberrypi site: <a href="http://downloads.raspberrypi.org/raspios_arm64/images/" rel="nofollow ugc">http://downloads.raspberrypi.org/raspios_arm64/images/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-553454" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T16:38:06+00:00">September 25, 2020 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>You should be able to refer to the server by its name followed by &ldquo;.local&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-553469" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c365922694dd86e0eac28be04a331bc0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T21:17:49+00:00">September 25, 2020 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>I have no problems adding the server manually. I was just wondering why it never appears in the list of &lsquo;local&rsquo; servers.</p>
</div>
<ol class="children">
<li id="comment-553472" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-25T22:01:21+00:00">September 25, 2020 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p>Then you may need to install a plugin&#8230;</p>
<p><a href="https://www.spigotmc.org/resources/lanbroadcaster.5320/" rel="nofollow ugc">https://www.spigotmc.org/resources/lanbroadcaster.5320/</a></p>
<p>There are many advanced features that you may want to setup, but my guide focuses on the basics. (It is already long enough.)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-555150" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6ad0d2f516ee6405a553b6bd31d434fb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6ad0d2f516ee6405a553b6bd31d434fb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-15T00:56:56+00:00">October 15, 2020 at 12:56 am</time></a> </div>
<div class="comment-content">
<p>Hey Mr. Lemire! So far, I have a server that can run, but I&rsquo;ve been having some trouble with the<br/>
if ! screen -list | grep -q &ldquo;minecraft&rdquo;; then<br/>
cd /home/pi/minecraft<br/>
screen -S minecraft -d -m java -jar -Xms512M -Xmx1008M spigot- 1.16.1.jar nogui<br/>
fi<br/>
Lines. I&rsquo;ve copied and pasted them, and changed the .jar file to the most recent release. When I continue following the instructions, and try and run ./minecraft.sh, I try the screen -r minecraft command, and the system sends me, &ldquo;There is no screen to be resumed matching minecraft.&rdquo; Any troubleshooting suggestions?</p>
</div>
<ol class="children">
<li id="comment-555155" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-15T01:44:15+00:00">October 15, 2020 at 1:44 am</time></a> </div>
<div class="comment-content">
<p><em>Any troubleshooting suggestions?</em></p>
<p>Does it help if I state that if it does not work then you are almost surely not following the instructions as they appear?</p>
<p>If you run a script with a <tt>screen -S minecraft ...</tt>, it will create a screen entry with the name <tt>minecraft</tt> which you can bring up with <tt>screen -r minecraft</tt>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-558723" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3aee0170152cea82d7a5c20e7f87c7c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3aee0170152cea82d7a5c20e7f87c7c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-19T11:00:12+00:00">November 19, 2020 at 11:00 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
Thank you for these instructions. I did follow it step by step but I ran into problems<br/>
It return the following error:<br/>
exception in thread &ldquo;main&rdquo; java.lang.RuntimeException: Error running command return status !=0<br/>
I use a raspberry pi2, java 1.8. SD is 32Gb.<br/>
Is pi2 here the problem?</p>
</div>
<ol class="children">
<li id="comment-558757" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-19T19:24:24+00:00">November 19, 2020 at 7:24 pm</time></a> </div>
<div class="comment-content">
<p>It is not really feasible to diagnose the problem from your report.</p>
<p>It should work on a pi2.</p>
</div>
<ol class="children">
<li id="comment-558840" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7a1734af63b58cff1bba6bca6a1962a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7a1734af63b58cff1bba6bca6a1962a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-20T10:09:11+00:00">November 20, 2020 at 10:09 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
Thank you for the reply . I put in the complete error message.<br/>
Wim<br/>
Final mapped jar: work/mapped.b94c4521.jar does not exist, creating (please wait)!<br/>
Picked up _JAVA_OPTIONS: -Djdk.net.URLClassPath.disableClassPathURLCheck=true -Xmx1024M<br/>
Exception in thread &ldquo;main&rdquo; java.lang.RuntimeException: Error running command, return status !=0: [/usr/lib/jvm/java-8-openjdk-armhf/jre/bin/java, -jar, BuildData/bin/SpecialSource-2.jar, map, &#8211;only, ., &#8211;only, net/minecraft, &#8211;auto-lvt, BASIC, &#8211;auto-member, SYNTHETIC, -e, BuildData/mappings/bukkit-1.16.3.exclude, -i, work/minecraft_server.1.16.3.jar, -m, BuildData/mappings/bukkit-1.16.3-cl.csrg, -o, work/mapped.b94c4521.jar-cl]<br/>
at org.spigotmc.builder.Builder.runProcess0(Builder.java:819)<br/>
at org.spigotmc.builder.Builder.runProcess(Builder.java:756)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:439)<br/>
at org.spigotmc.builder.Bootstrap.main(Bootstrap.java:34)</p>
</div>
</li>
<li id="comment-558857" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/866a4ce8ffbb8fd495495e2bdbb14356?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/866a4ce8ffbb8fd495495e2bdbb14356?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-20T12:53:44+00:00">November 20, 2020 at 12:53 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
Thank you for the replay . I have posted the complete error message . Maybe this tells you more. I don&rsquo;t see other error messages in the logfile.<br/>
Thanks in advance. Wim.<br/>
Checked out: 57bbdd8eb797a51960cf9a47f764b68f97d4f18c<br/>
Attempting to build Minecraft with details: VersionInfo(minecraftVersion=1.16.3, accessTransforms=bukkit-1.16.3.at, classMappings=bukkit-1.16.3-cl.csrg, memberMappings=bukkit-1.16.3-members.csrg, packageMappings=package.srg, minecraftHash=51f363d9fdf9caf953c1fec932e50593, classMapCommand=java -jar BuildData/bin/SpecialSource-2.jar map &#8211;only . &#8211;only net/minecraft &#8211;auto-lvt BASIC &#8211;auto-member SYNTHETIC -e BuildData/mappings/bukkit-1.16.3.exclude -i {0} -m {1} -o {2}, memberMapCommand=java -jar BuildData/bin/SpecialSource-2.jar map &#8211;only . &#8211;only net/minecraft &#8211;auto-member LOGGER &#8211;auto-member TOKENS -i {0} -m {1} -o {2}, finalMapCommand=java -jar BuildData/bin/SpecialSource.jar &#8211;only . &#8211;only net/minecraft -i {0} &#8211;access-transformer {1} -m {2} -o {3}, decompileCommand=java -jar BuildData/bin/fernflower.jar -dgs=1 -hdc=0 -asc=1 -udv=0 -rsy=1 -aoa=1 {0} {1}, serverUrl=https://launcher.mojang.com/v1/objects/f02f4473dbf152c23d7d484952121db0b36698cb/server.jar, toolsVersion=105)<br/>
Found good Minecraft hash (51f363d9fdf9caf953c1fec932e50593)<br/>
Final mapped jar: work/mapped.b94c4521.jar does not exist, creating (please wait)!<br/>
Picked up _JAVA_OPTIONS: -Djdk.net.URLClassPath.disableClassPathURLCheck=true -Xmx1024M<br/>
Exception in thread &ldquo;main&rdquo; java.lang.RuntimeException: Error running command, return status !=0: [/usr/lib/jvm/java-8-openjdk-armhf/jre/bin/java, -jar, BuildData/bin/SpecialSource-2.jar, map, &#8211;only, ., &#8211;only, net/minecraft, &#8211;auto-lvt, BASIC, &#8211;auto-member, SYNTHETIC, -e, BuildData/mappings/bukkit-1.16.3.exclude, -i, work/minecraft_server.1.16.3.jar, -m, BuildData/mappings/bukkit-1.16.3-cl.csrg, -o, work/mapped.b94c4521.jar-cl]<br/>
at org.spigotmc.builder.Builder.runProcess0(Builder.java:819)<br/>
at org.spigotmc.builder.Builder.runProcess(Builder.java:756)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:439)<br/>
at org.spigotmc.builder.Bootstrap.main(Bootstrap.java:34)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-573444" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f589f557dadc48cc5da7929b3acfd6ef?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f589f557dadc48cc5da7929b3acfd6ef?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Melody</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-07T23:43:26+00:00">February 7, 2021 at 11:43 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
I was able to follow the instructions completely until the part where you get someone to login to the server to check it and then type stop.<br/>
Are they logging in from where? My laptop with ssh? the Pi using the monitor and keyboard? or?<br/>
Anyway I continued along and had no error messages (until I got to the no screen part), but before I could recheck the ./minecraft.sh was correct, I ran into an issue that my pi will no longer let me in at all &#8211; whether directly or through ssh. I have no idea what went wrong or why. The last thing I did was change the /etc/fstab files to what you had, but I don&rsquo;t know if that has anything to do with my lockout.<br/>
The message I get on reboot is this:<br/>
Cannot open access to the console, the root account is locked.<br/>
See sulogin(8) man page for more details.<br/>
Press Enter to continue.</p>
<p>But I never get back to a prompt of any kind. 🙁</p>
</div>
<ol class="children">
<li id="comment-573456" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-08T00:26:28+00:00">February 8, 2021 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>The error you are getting probably indicates that you entered incorrect entries in /etc/fstab.</p>
</div>
</li>
<li id="comment-573458" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-08T00:34:28+00:00">February 8, 2021 at 12:34 am</time></a> </div>
<div class="comment-content">
<p><em>I was able to follow the instructions completely until the part where you get someone to login to the server to check it and then type stop.<br/>
Are they logging in from where? My laptop with ssh? the Pi using the monitor and keyboard? or?</em></p>
<p>My instructions are detailed. If you do not understand a specific instruction, please elaborate. Refer exactly to what I have written.</p>
</div>
</li>
</ol>
</li>
<li id="comment-574645" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9f65075545b010d23ced186bbccf545?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9f65075545b010d23ced186bbccf545?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gerald de la Pascua</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-13T17:44:25+00:00">February 13, 2021 at 5:44 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel thanks for this tutorial, I&rsquo;m trying to follow it, but when I try to build Buildtools.jar I get,<br/>
BuildTools requires at least 512M of memory to run (1024M recommended), but has only detected 235M.<br/>
This can often occur if you are running a 32-bit system, or one with low RAM.<br/>
Please re-run BuildTools with manually specified memory, e.g: java -Xmx1024M -jar BuildTools.jar<br/>
Like others I&rsquo;ve tried to do do the java -Xmx1024M -jar BuildTools.jar</p>
<p>and that seems to get most of it to work until I get to the applying CraftBukkit bit, here&rsquo;s the tail of my log, any ideas ?<br/>
I&rsquo;m running on a pi 3b+ clean install,</p>
<p>[INFO] Installing /home/pi/minecraft/work/mapped.2fb04798.jar to /home/pi/.m2/repository/org/spigotmc/minecraft-server/1.16.5-SNAPSHOT/minecraft-server-1.16.5-SNAPSHOT.jar<br/>
[INFO] &#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;<br/>
[INFO] BUILD SUCCESS<br/>
[INFO] &#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;<br/>
[INFO] Total time: 5.706 s<br/>
[INFO] Finished at: 2021-02-13T17:30:58Z<br/>
[INFO] &#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;<br/>
Applying CraftBukkit Patches<br/>
Patching with LootTableRegistry.patch<br/>
Exception in thread &ldquo;main&rdquo; java.io.FileNotFoundException: work/decompile-2fb04798/net/minecraft/server/LootTableRegistry.java (No such file or directory)<br/>
at java.base/java.io.FileInputStream.open0(Native Method)<br/>
at java.base/java.io.FileInputStream.open(FileInputStream.java:219)<br/>
at java.base/java.io.FileInputStream.(FileInputStream.java:157)<br/>
at com.google.common.io.Files$FileByteSource.openStream(Files.java:120)<br/>
at com.google.common.io.Files$FileByteSource.openStream(Files.java:110)<br/>
at com.google.common.io.ByteSource$AsCharSource.openStream(ByteSource.java:456)<br/>
at com.google.common.io.CharSource.readLines(CharSource.java:311)<br/>
at com.google.common.io.Files.readLines(Files.java:553)<br/>
at com.google.common.io.Files.readLines(Files.java:520)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:539)<br/>
at org.spigotmc.builder.Bootstrap.main(Bootstrap.java:34)</p>
</div>
<ol class="children">
<li id="comment-574648" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-13T18:26:08+00:00">February 13, 2021 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>If the build fails with some Java-related error, please report the issue with spigot.<br/>
See <a href="https://www.spigotmc.org/forums/spigot-help.40/" rel="nofollow ugc">https://www.spigotmc.org/forums/spigot-help.40/</a></p>
</div>
<ol class="children">
<li id="comment-575102" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9f65075545b010d23ced186bbccf545?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9f65075545b010d23ced186bbccf545?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gerald de la Pascua</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-16T08:49:55+00:00">February 16, 2021 at 8:49 am</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel, awesome support you provide, I read elsewhere that the java might not buid correctly on the pi, so I tried it on a pc, and it worked first time, so I copied the spigot file over and it&rsquo;s all up and running. Great little project, is there a way to create your own world/map&rsquo;s and select one at boot up / start time rather than have a randomly generated one ?</p>
<p>Thanks for the help with the project, the pi is a remarkable bit of kit, and as you say, it&rsquo;s just a bonus that it uses less power. I have a number of pi 3&rsquo;s around the house, one as a plex server, others as plex clients, and others that I use to do tasks such as this. It&rsquo;s incredible to have such a low cost, low power device, that can be used for so many little projects, even if it&rsquo;s just as a test to see what the little thing can do. I&rsquo;m planning to order a pi 400 to run Minecraft off, and because I&rsquo;ve been meaning to get a pi 4 for ages, but I&rsquo;ve been put off by having to get heat sinks, fans etc, and I read the 400 handles the heat passively really well and you get the keyboard thrown in. Anyway thanks again for your help, I&rsquo;ll be looking through your archives for other project ideas, thanks G</p>
</div>
<ol class="children">
<li id="comment-575129" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-16T13:55:27+00:00">February 16, 2021 at 1:55 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Great little project, is there a way to create your own world/map’s and select one at boot up / start time rather than have a randomly generated one ?</p>
</blockquote>
<p>I am not a Spigot expert per se. You may want to look at how other people have answered this question:</p>
<p><a href="https://www.planetminecraft.com/forums/help/javaedition/how-do-you-change-map-on-minecra-563017/" rel="nofollow ugc">https://www.planetminecraft.com/forums/help/javaedition/how-do-you-change-map-on-minecra-563017/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-574765" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9f65075545b010d23ced186bbccf545?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9f65075545b010d23ced186bbccf545?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gerald de la Pascua</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-14T15:32:24+00:00">February 14, 2021 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel, outstanding support !! Getting back to me on a Saturday ! No doubt lock down is helping, but thank you very much will pursue this, or might try on a pi 4, to see if it works ok on that,</p>
<p>thank you , G</p>
</div>
</li>
<li id="comment-581630" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af2f7e2223a616f36ac9094c2f8d39d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af2f7e2223a616f36ac9094c2f8d39d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Devin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-05T04:18:14+00:00">April 5, 2021 at 4:18 am</time></a> </div>
<div class="comment-content">
<p>Hey so after rebooting my pi the server will not start. It just says it wasn&rsquo;t able to access jarfile spigot-1.16.5.jar which yes is the name of mine. Why is this happening? Thanks in advanced</p>
</div>
<ol class="children">
<li id="comment-581654" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-05T12:36:43+00:00">April 5, 2021 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>The error is probably telling you that either the file does not exist (in the given location) or that you do not have access rights to the file. The steps that I provide are well tested&#8230; I suggest you start anew from a clean slate.</p>
</div>
<ol class="children">
<li id="comment-581682" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af2f7e2223a616f36ac9094c2f8d39d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af2f7e2223a616f36ac9094c2f8d39d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Devin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-05T18:03:14+00:00">April 5, 2021 at 6:03 pm</time></a> </div>
<div class="comment-content">
<p>After reinstalling the OS and starting fresh it&rsquo;s doing the same thing except now it error&rsquo;s when building and when I try to look for the jarfile it says it&rsquo;s unable to access it</p>
</div>
<ol class="children">
<li id="comment-581686" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-05T18:25:42+00:00">April 5, 2021 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>You are not providing enough information so that people are able to help you. Note that thousands of people have followed my instructions successfully. They definitively work.</p>
</div>
</li>
</ol>
</li>
<li id="comment-581690" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af2f7e2223a616f36ac9094c2f8d39d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af2f7e2223a616f36ac9094c2f8d39d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Devin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-05T19:15:36+00:00">April 5, 2021 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p>Every time I try to build it gives me the error: <code>INFO: Decompiling class net/minecraft/world/item/Items<br/>
Exception in thread "main" java.lang.RuntimeException: Error running command, return status !=0: [/usr/lib/jvm/java-11-openjdk-armhf/bin/java, -jar, BuildData/bin/fernflower.jar, -dgs=1, -hdc=0, -asc=1, -udv=0, -rsy=1, -aoa=1, work/decompile-d7866d9c/classes, work/decompile-d7866d9c]<br/>
at org.spigotmc.builder.Builder.runProcess0(Builder.java:835)<br/>
at org.spigotmc.builder.Builder.runProcess(Builder.java:772)<br/>
at org.spigotmc.builder.Builder.main(Builder.java:479)<br/>
at org.spigotmc.builder.Bootstrap.main(Bootstrap.java:27)</code> I&rsquo;ve tried everything and have followed your tutorial twice down to the letter and it&rsquo;s still giving me this error.</p>
</div>
<ol class="children">
<li id="comment-581693" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-05T19:40:24+00:00">April 5, 2021 at 7:40 pm</time></a> </div>
<div class="comment-content">
<p>You say that the file spigot-1.16.5.jar is not found. Can you start from there?</p>
<p>I don&rsquo;t understand how you can be missing the file spigot-1.16.5.jar, or be unable to access it and then get the error message you are reporting.</p>
</div>
<ol class="children">
<li id="comment-592585" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-30T00:49:51+00:00">July 30, 2021 at 12:49 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m having a similar problem with my installation as well:</p>
<p>pi@raspberrypi01:~/minecraft $ java -Xmx1024M -jar BuildTools.jar<br/>
Exception in thread &ldquo;main&rdquo; java.lang.UnsupportedClassVersionError: org/spigotmc/builder/Bootstrap : Unsupported major.minor version 52.0<br/>
at java.lang.ClassLoader.defineClass1(Native Method)<br/>
at java.lang.ClassLoader.defineClass(ClassLoader.java:808)<br/>
at java.security.SecureClassLoader.defineClass(SecureClassLoader.java:142)<br/>
at java.net.URLClassLoader.defineClass(URLClassLoader.java:443)<br/>
at java.net.URLClassLoader.access$100(URLClassLoader.java:65)<br/>
at java.net.URLClassLoader$1.run(URLClassLoader.java:355)<br/>
at java.net.URLClassLoader$1.run(URLClassLoader.java:349)<br/>
at java.security.AccessController.doPrivileged(Native Method)<br/>
at java.net.URLClassLoader.findClass(URLClassLoader.java:348)<br/>
at java.lang.ClassLoader.loadClass(ClassLoader.java:430)<br/>
at sun.misc.Launcher$AppClassLoader.loadClass(Launcher.java:326)<br/>
at java.lang.ClassLoader.loadClass(ClassLoader.java:363)</p>
<p>I&rsquo;m not sure if something didn&rsquo;t install correctly, but this occurs at the buildTool section (as seen by the command at the beginning) after using the command:</p>
<p>wget <a href="https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar" rel="nofollow ugc">https://hub.spigotmc.org/jenkins/job/BuildTools/lastSuccessfulBuild/artifact/target/BuildTools.jar</a></p>
<p>Is there an easy solution? I&rsquo;m running a pi3 with the newest raspian software available, should I use a different version?</p>
</div>
<ol class="children">
<li id="comment-592595" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-30T03:02:23+00:00">July 30, 2021 at 3:02 am</time></a> </div>
<div class="comment-content">
<p>As an update, I was able to get pass this error by using a version of the BuildTool from the 18 of Dec. 2019, but now I&rsquo;m running into issues with the Spigot:</p>
<p>pi@raspberrypi01:~/Minecraft $ ls -lrt<br/>
total 8020<br/>
-rw-r&#8211;r&#8211; 1 pi pi 3994539 Dec 18 2019 BuildTools.jar.1<br/>
-rw-r&#8211;r&#8211; 1 pi pi 4179101 Jul 2 23:30 BuildTools.jar<br/>
drwxr-xr-x 2 pi pi 4096 Jul 30 01:02 work<br/>
drwxr-xr-x 4 pi pi 4096 Jul 30 01:07 Bukkit<br/>
drwxr-xr-x 5 pi pi 4096 Jul 30 01:23 CraftBukkit<br/>
drwxr-xr-x 5 pi pi 4096 Jul 30 01:31 Spigot<br/>
drwxr-xr-x 5 pi pi 4096 Jul 30 01:44 BuildData<br/>
drwxr-xr-x 6 pi pi 4096 Jul 30 01:46 apache-maven-3.6.0<br/>
-rw-r&#8211;r&#8211; 1 pi pi 6636 Jul 30 01:46 BuildTools.log.txt<br/>
pi@raspberrypi01:~/Minecraft $ ls Spigot<em>.jar<br/>
ls: cannot access Spigot</em>.jar: No such file or directory<br/>
pi@raspberrypi01:~/Minecraft $ ls spigot<em>.jar<br/>
ls: cannot access spigot</em>.jar: No such file or directory<br/>
pi@raspberrypi01:~/Minecraft $</p>
<p>I&rsquo;ll add another update, maybe tomorrow, if I figure it out before someone else does, but until that point I will gladly get any help I can get. This is an awesome page!</p>
</div>
<ol class="children">
<li id="comment-592989" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T14:42:17+00:00">August 2, 2021 at 2:42 pm</time></a> </div>
<div class="comment-content">
<p>Please elaborate. Did it successfully build? What error messages did you get?</p>
</div>
<ol class="children">
<li id="comment-592991" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T14:47:46+00:00">August 2, 2021 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>It did successfully build with the older version, but as seen above it wouldn&rsquo;t do the ls spigot.jar command, as the spigot produced didn&rsquo;t have a version attached to the name and claimed the file didn&rsquo;t exist.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-592986" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T14:35:31+00:00">August 2, 2021 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>The error is telling you that your Java does not support Java 8.</p>
<p>You say that you are running a Raspberry Pi with the latest software. Can you elaborate? If you are lacking Java 8 support, then it is probably an old setup.</p>
</div>
<ol class="children">
<li id="comment-592988" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T14:40:55+00:00">August 2, 2021 at 2:40 pm</time></a> </div>
<div class="comment-content">
<p>Which Java version are you using?</p>
</div>
</li>
<li id="comment-592993" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d23de6b49152a01d2a3a449d530d526a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T15:01:50+00:00">August 2, 2021 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>I later figured out that the reason that it was having issues is that the latest update to minecraft, 1.17.1, now requires the use of java 16 to run, so I ended up using an old optiplex I had sitting around to run the server with linux mint installed and java 16 forcefully installed (as linux mint 20+ does not yet support java 16) the server worked. It should also be mentioned that I tried running it with java 8 before java 16 and ended up with the same errors as I did on the raspberry pi. As for the version running on my pi versus the optiplex: pi java version 1.8.0_40-internal and optiplex java version 16.0.2</p>
<p>I still have not figured out how to get java 16 installed on the pi, or use an older version work around, as there I run into issues with the spigot not building properly, or not being recognized as an existing file.</p>
<p>I&rsquo;ll continue trying to figure out what my issue is, if I do figure this out I&rsquo;ll reply to this post with what I have found, but until then I&rsquo;ll gladly get any and all help possible.</p>
</div>
<ol class="children">
<li id="comment-593001" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T15:46:20+00:00">August 2, 2021 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>What happens if you type</p>
<pre><code>java -Xmx1024M -jar BuildTools.jar  --rev 1.16.5
</code></pre>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-592987" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-02T14:39:53+00:00">August 2, 2021 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>You are not giving us enough information. If it gets a item/Items, then it did a lot of the work already. Please describe where it fails.</p>
<p>You say that you tried everything. Please expand. What did you try?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-584932" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad3b97e33707e03aa8c7579ef6da13ab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad3b97e33707e03aa8c7579ef6da13ab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dasyurid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-24T15:40:07+00:00">May 24, 2021 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>Minor correction but you can actually join java servers with the bedrock edition found on consoles and Android devices. I actually have a running server with java edition installed and can access it with my phone and Xbox as I have geysermc plugin installed on the server. This has been possible for a year at least that I am aware of and so far I have seen no issues other than with the command blocks as you can&rsquo;t enter certain commands from your bedrock client even with administration permissions as they do not exist in the game files on bedrock. For anyone interested just Google geysermc Minecraft crossplay for info also just put in bedrock crossplay for alternative plugins and you will see there are now a lot of possible ways to do it.</p>
</div>
</li>
<li id="comment-593547" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc52ebc65dcaefda68d4fb74be284c5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc52ebc65dcaefda68d4fb74be284c5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Clark</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-05T19:03:43+00:00">August 5, 2021 at 7:03 pm</time></a> </div>
<div class="comment-content">
<p>Whenever I run the &ldquo;java -Xmx1024 -jar BuildTools.jar &#8212; rev 1.17.1&rdquo; command it returns &ldquo;Error occurred during initialization of VM<br/>
Too small maximum heap&rdquo;</p>
<p>So&#8230; what did I do? Or rather, not do?</p>
</div>
<ol class="children">
<li id="comment-593576" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-05T23:56:57+00:00">August 5, 2021 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>This command you are providing is not in the guide. Please refer to our instructions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-603426" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fd4182e28068e4ba9feb901eb39378b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fd4182e28068e4ba9feb901eb39378b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">digitalpeer4185</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-25T23:37:19+00:00">October 25, 2021 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>hi we were wondering were to find the 64 bit version for raspberry pi OS please put a link for the one you used</p>
</div>
</li>
<li id="comment-621690" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9459c01e6d58b8962ad87aee0747c657?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9459c01e6d58b8962ad87aee0747c657?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ramon Juve Sancho</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-02-24T19:53:09+00:00">February 24, 2022 at 7:53 pm</time></a> </div>
<div class="comment-content">
<p>Hi from Barcelona and nice article, thanks for sharing&#8230;<br/>
I followed some points for my rasp-server for the kids&#8230;</p>
</div>
</li>
</ol>
