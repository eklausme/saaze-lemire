---
date: "2005-02-17 12:00:00"
title: "Using Vim under Cygwin"
index: false
---

[12 thoughts on &ldquo;Using Vim under Cygwin&rdquo;](/lemire/blog/2005/02-17-using-vim-under-cygwin)

<ol class="comment-list">
<li id="comment-1274" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Zbigniew Lukasiak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-18T04:53:47+00:00">February 18, 2005 at 4:53 am</time></a> </div>
<div class="comment-content">
<p><br/>
<br/>
<br/>
<br/>
You can use the -m &lsquo;log_message&rsquo; option for the commit to enter the comments.</p>
</div>
</li>
<li id="comment-1275" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Zbigniew Lukasiak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-18T05:00:09+00:00">February 18, 2005 at 5:00 am</time></a> </div>
<div class="comment-content">
<p>-m message</p>
<p> Use message as log information, instead of invoking an editor.</p>
<p> Available with the following commands: add, commit and import.</p>
<p>From cvs man page.</p>
</div>
</li>
<li id="comment-1277" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-18T14:01:58+00:00">February 18, 2005 at 2:01 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Indeed a good alternative.</p>
<p>I knew about the &ldquo;-m&rdquo; command, but also, under windows, one can use Tortoise CVS, you then have a nice GUI to take care of all your CVS trouble. But I remain a command line freak. So I should get in the habit of using -m, it is probably faster in the long run anyhow.</p>
</div>
</li>
<li id="comment-2317" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bombay11.blogspot.com" class="url" rel="ugc external nofollow">Dr.M</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-04-16T00:52:53+00:00">April 16, 2005 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>cat ~/.bashrc</p>
<p>vi(){ # windows.<br/>
vifile=${@:-$vifile}; # use last file or argv<br/>
vifile=$(cygpath -m $@) # dos paths<br/>
c:/bin32/gvim $vifile &amp;<br/>
}</p>
<p>I too just started using cygwin and tortoise-cvs.</p>
</div>
</li>
<li id="comment-2996" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7fa9d7df654ba385dcdaa770ca5b3b10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7fa9d7df654ba385dcdaa770ca5b3b10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://hermitte.free.fr/cygwin/" class="url" rel="ugc external nofollow">Luc Hermitte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-09-29T19:00:44+00:00">September 29, 2005 at 7:00 pm</time></a> </div>
<div class="comment-content">
<p>Hello.</p>
<p>I do not really like to post such plain advertizes, but I think the script I&rsquo;m maintening, cyg-wrapper.sh, could solve both your problems. (If I understand how the blog works, just click on my name to access to the script).</p>
<p>Regarding Vim, look at the example given on the web page. Regarding cvs, declare -m as a binary-argument. BTW, Vim plugin, cvsmenu, is quite addictive &#8212; though I have used it only on Solaris.</p>
<p>NB: As cyg-wrapper is just a bash script, it may take some time when to many filenames need to be converted.</p>
<p>HTH.</p>
</div>
</li>
<li id="comment-49411" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ae6ea06f6e17cd2436bd1bfe25c95f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ae6ea06f6e17cd2436bd1bfe25c95f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TidyTim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-18T10:55:55+00:00">July 18, 2007 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>The script as given above will only edit one file. What if you want to edit several files? What if you want to edit several files and start all open in their own frame? If you add the &ldquo;-o&rdquo; switch cypath will take it as a option so it probably produce an error and it won&rsquo;t get passed to Vim.</p>
<p>Here&rsquo;s the original script:</p>
<p>&ldquo;/cygdrive/c/Program Files/Vim/vim63/vim.exe&rdquo; `cygpath -w $1`</p>
<p>Here&rsquo;s a more useful variation (assuming the Bash shell):</p>
<p>&ldquo;/cygdrive&#8230;/vim.exe&rdquo; $(cygpath -w &#8212; $*) &amp;</p>
<p>Cygpath ignores options after the &ldquo;&#8211;&ldquo;.</p>
</div>
</li>
<li id="comment-50599" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gregg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-02-03T01:29:31+00:00">February 3, 2009 at 1:29 am</time></a> </div>
<div class="comment-content">
<p>I experienced several issues using vim ( ex &#8211; pressing &ldquo;i&rdquo; didn&rsquo;t put it into INSERT mode ), i created a blank file ~/.vimrc and everything worked great.</p>
</div>
</li>
<li id="comment-50625" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lucas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-02-12T10:23:16+00:00">February 12, 2009 at 10:23 am</time></a> </div>
<div class="comment-content">
<p>Thanks Gregg! Worked just fine!</p>
</div>
</li>
<li id="comment-54662" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/93e655e2966807f522931344bb57f277?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/93e655e2966807f522931344bb57f277?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-19T23:33:55+00:00">August 19, 2011 at 11:33 pm</time></a> </div>
<div class="comment-content">
<p>Greg is right<br/>
touch.exe ~/.vimrc<br/>
and you don&rsquo;t need to install the other vim, cygwin vim suddenly starts working just fine!!</p>
</div>
</li>
<li id="comment-54713" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69b229c5e304362b20f45a0694a408bf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69b229c5e304362b20f45a0694a408bf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">martianpackets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-12T16:18:30+00:00">September 12, 2011 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>creating a blank .vimrc file in ~/ to make cygwin-installed vim or gvim behave correctly, is the most brilliant idea I&rsquo;ve seen so far in 2011.</p>
</div>
</li>
<li id="comment-54714" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69b229c5e304362b20f45a0694a408bf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69b229c5e304362b20f45a0694a408bf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">martianpackets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-12T16:23:44+00:00">September 12, 2011 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>so I took it to the next level. I went to my most-used linux shell, grabbed my .vimrc file, and scp&rsquo;d it into my cygwin ~/ folder. Now I am in business!</p>
</div>
</li>
<li id="comment-56186" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/248261b4c61f2e28458e7dfe4adec386?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/248261b4c61f2e28458e7dfe4adec386?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chandan Choudhury</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-09-29T14:13:28+00:00">September 29, 2012 at 2:13 pm</time></a> </div>
<div class="comment-content">
<p>I am not able to run gvim from cygwin. When I try to open a new file with :</p>
<p>gvim filename gvim opens and displays error as :</p>
<p>Error detected while processing command line<br/>
E492: Not editor command: C:\cygwin\home\chandan\l<br/>
Press enter or type command to continue<br/>
More problematic is that I can&rsquo;t open existing file in the path</p>
<p>&gt;which gvim shows /usr/bin/gvim</p>
<p>I have put alias gvim=/cygdrive/c/Program\Files\(x86\)/Vim/vim73/gvim.exe still</p>
<p>Thanks,</p>
<p>Chandan</p>
</div>
</li>
</ol>
