---
date: "2006-11-15 12:00:00"
title: "My first Mac"
index: false
---

[3 thoughts on &ldquo;My first Mac&rdquo;](/lemire/blog/2006/11-15-my-first-mac)

<ol class="comment-list">
<li id="comment-48317" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a92c5b4df6ec1769a72b00dae3fd2192?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.seanmcgrath.me/" class="url" rel="ugc external nofollow">Sean McGrath</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-15T22:34:25+00:00">November 15, 2006 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>Congrats! To answer the Home/End key question&#8230;&#8230;.the best solution I have found is to press the Apple Key + Left Arrow for Home, and Apple Key + Right Arrow for End.</p>
<p>Your default account should be the &ldquo;root&rdquo; account or administrator which Mac OS X calls it. When installing things on the system level you will be asked for an administrator password before installing.</p>
<p>As for installing Firefox, like most apps that come in a Disk Image (.dmg) file, once the disk image is mounted you drag the firefox icon in the disk to your applications folder, which copies it and installs it. You can then eject the mounted disk image. My guess is you couldn&rsquo;t unmount it because you were running Firefox from within the disk image.</p>
<p>Check out my Mac Related post on my blog, you may find some useful links. <a href="http://blog.seanmcg.com/?cat=7&#038;submit=GO" rel="nofollow ugc">http://blog.seanmcg.com/?cat=7&#038;submit=GO</a></p>
<p>I suggest you download and try out Quicksilver (my most used mac app, fully customizable and hackable too ;)) and VoodooPad (a desktop wiki)).</p>
</div>
</li>
<li id="comment-48423" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5af7c2db5bd4dd11741098e1b5f274c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5af7c2db5bd4dd11741098e1b5f274c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://siliconisland.wordpress.com/" class="url" rel="ugc external nofollow">Fred</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-16T09:57:00+00:00">November 16, 2006 at 9:57 am</time></a> </div>
<div class="comment-content">
<p>Why did it take &ldquo;months&rdquo; to deliver your Macbook Pro?</p>
<p>I just ordered one last week and it&rsquo;s been shipped today&#8230; Hopefully it will arrive on Monday.</p>
</div>
</li>
<li id="comment-48905" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Scott Flinn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-11-22T14:19:26+00:00">November 22, 2006 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re very brave! 🙂</p>
<p>Let&rsquo;s see now. I can offer a few random suggestions here.</p>
<p>By &lsquo;console&rsquo;, I presume you mean the Terminal app. (If not, you may want to look &#8212; it&rsquo;s in /Applications/Utilities). It has a few handy features, but I generally prefer to use X clients like plain old xterm, or maybe rxvt. They both have colour support. Setting up the official Apple X11.app is pretty much essential for someone coming from the Linux world. You can set up X through Fink too, but the Apple version has some nice integration features, expecially copy/paste between the X and OSX clipboards.</p>
<p>Regarding keyboard layout, I have no experience with anything other than standard US English layouts. As a random thought, what happens if you plug in a non-Apple keyboard that has a layout you like?</p>
<p>I forget what the start and end keys are (I do see Sean&rsquo;s comment, but I think there is an alternative). On my PowerBook (which has a different keyboard) you can use Fctn-PageUp and Fctn-PageDown for this purpose. But I don&rsquo;t remember whether a standard Apple keyboard even has a Fctn key.</p>
<p>You may also be interested to know that many text boxes support simple emacs keybindings for navigation. There is a strange dichotomy in the Mac world now: apps can be written against one of two different APIs. The Carbon API is very similar to older MacOS offerings, and made porting pre-OSX apps simpler. But Cocoa is a much more powerful API, inherited almost intact from NextStep. Cocoa apps (which can use the Carbon API) get a lot of support for free. Carbon apps can use the Cocoa features, but it requires specific code to be included and not all apps do it. So it can be hard to tell which framework the app was written for. Most new things, including many of Apple&rsquo;s own apps, are Cocoa.</p>
<p>I went off on that tangent because it affects where you find emacs key bindings. Every piece of text in a Cocoa application (editable or otherwise) is drawn by the Text class that supports everything from simple labels up to a full RTF editor with tabs and rulers and spell check and whatnot. That means that all text entry fields in Cocoa apps support things like spell check, emacs key bindings, etc. Try it in Safari or something (spell checking is a big feature of Firefox 2, not to mention Vista &#8212; Cocoa apps, and before them NextStep, have been doing it since 1988).</p>
<p>Congratulations on finding the Eject key to reveal the hidden drive. 🙂 You may also want to know specifically what the drive can do. You can look under the Apple menu (left side of menu bar) to get info about the computer. Somewhere in there (I don&rsquo;t have my Mac in front of me &#8212; it&rsquo;s something like the &ldquo;More Info &#8230;&rdquo; button on the &ldquo;About this Mac&rdquo; dialog) there is a button that launches the system profiler utility (which you will find in /Applications/Utilities). It will give you specifics about DVD drives, including precisely which types it supports. The info is quite detailed, including things like power levels on USB buses and such.</p>
<p>Also note that, unlike XP, there is a lot of built-in support for CD and DVD burning. You don&rsquo;t have to go off looking for third party utilities. I won&rsquo;t go into the details unless you ask &#8212; it&rsquo;s probably a good test for that online documentation.</p>
<p>Did you set up your own copy of the SSH server? It comes preconfigured. You can turn it on and off through the system preferences. I think it&rsquo;s off by default. Two advantages of using the Apple approved version are (1) it adds/deletes the appropriate firewall rules as you toggle the checkbox to turn it on and off &#8212; one-click convenience, and (2) Apple will track the security patches for you.</p>
<p>I think the relevant settings are in the Sharing section of the System Preferences. A handy new feature of System Preferences is the Spotlight integration. If you&rsquo;re looking for something, type a keyword or two (e.g., &ldquo;ssh&rdquo;) into the search field at the top right of the preferences window and a spotlight will highlight the relevant configuration sections. Cute.</p>
<p>I think Sean covered DMG images pretty well. The &lsquo;eject&rsquo; option is in the context menu when you right click on the mounted disk icon. You may also want to investigate the Disk Utility app. It allows you to build DMG images, which have some nice properties if you need to archive things (and is one of the apps that lets you burn disks). In particular, the HFS+ filesystem has some properties that aren&rsquo;t easily captured in other filesystems. You can get the most authentic archive by building a DMG and burning it as a single file to a disk. It will then automount as a read-only filesystem on Macs (and be completely useless on non-Macs, AFAIK).</p>
<p>Regarding root privileges, I&rsquo;ll add a bit to what Sean (correctly) mentioned. Darwin uses sudo under the covers &#8212; and it&rsquo;s available on the command line as well. An administrator account on OSX is not the same thing as on XP. It&rsquo;s really the equivalent of being in the wheel group, or the sudoers file &#8212; it means you have permission to assume root privileges, but you don&rsquo;t automatically run with them. As Sean noted, apps will prompt you for your password whenever they need root privileges. Non-admin accounts won&rsquo;t have access to those capabilities. It&rsquo;s actually a very nice setup from a security point of view because it makes a secure configuration relatively painless.</p>
<p>Yes, getting the dev tools installed is a pain. But it&rsquo;s really essential if you want to use a lot of stuff from Fink. Building from source is the best way to ensure compatible builds of everything. The nice part about Fink is that, like the FreeBSD package system (and unlike pretty much all Linux distros), there is a single, unified package archive whose maintainers strive for internal consistency. You never have to hunt down package dependencies, or worry about version forks and things.</p>
<p>I&rsquo;ll throw in one more thing, even though you didn&rsquo;t ask. Things like user groups, printers, the hosts file, mail aliases, etc. are handled in FreeBSD (and hence Darwin) with the traditional text files in /etc. You will find these files in OSX, but you should also notice the comment in them that says they aren&rsquo;t actually used. OSX inherits the old NextStep NetInfo system, which was a great improvement on Sun&rsquo;s yellow pages in its day (though experienced AD admins may sniff a bit). You can use NetInfoManager (also in /Applications/Utilities) to adjust these things. There is also a command line interface to netinfo (see niload and nidump) that knows how to translate between the file formats and the NetInfo representation. So for example, you can dump the group definitions to a file, edit the file, then re-load it. That&rsquo;s generally how I do things, rather than fighting with the less familiar GUI app. Don&rsquo;t forget sudo when you niload.</p>
<p>On the other hand, the open source components like Apache and Samba that are intergrated into OSX DO use the standard configuration files, which are generally in subdirectories below /etc.</p>
<p>Don&rsquo;t despair. The learning curve should only seem steep for a few days.</p>
</div>
</li>
</ol>
