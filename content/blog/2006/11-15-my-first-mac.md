---
date: "2006-11-15 12:00:00"
title: "My first Mac"
---



Today I finally received an Apple MacPro I ordered several months (!!!) ago. I thought I would quickly review my first impressions.

- The machine is sexy. There is no other word for it. My Linux box looks like a russian car (not insult intended toward the russian folks) in comparison.
- The machine is fast, but it takes forever to boot up. It takes longer to boot than a slow Linux box that has 12,000 boot-level services.
- Took me some time to find out where the console is, but once you have it, you can create a link on your desktop. The console is good, comparable to what you have under Linux. It looks like it uses bash by default. However, I do not seem to have color support in the shell. No hint anywhere how to turn it on. (Update. Will says to check [an article on macosxhints](http://www.macosxhints.com/article.php?story=20020408225741777) for the color support, but says he prefers [iTerm](http://iterm.sourceforge.net/).)
- The on-disk help is pretty good. Clearly, Apple cares about helping you find a solution to your problems. Unlike Microsoft who is happy to confuse you into depression. (And Linux, well&hellip; Linux has Google as documentation&hellip;)
- The machine comes with lots of preinstalled software. I don&rsquo;t know what any of it does so far, but it looks like Apple is not cheap software-wise.
- The keyboard French Canadian layout sucks. It differs from the established standard found in both Windows and Linux.
- I could not find the equivalent of the &ldquo;Home&rdquo; and &ldquo;End&rdquo; keys. I still don&rsquo;t know where they are. This means that it takes five minutes to select the content of a text box.
- Having the menu all the way to the top of the screen is really a drag when you have two screens. When my application is on the second screen and I need to go in its menu, I have to go back to the first screen, move up and click on the menu.
- It took two of us about 15 minutes to even find out if I had a DVD reader. Turns out I do, but it does not appear anywhere. I can open it by pressing one of the keys on the keyboard (the &ldquo;eject key&rdquo;).
- Setting up a ssh server was not too hard. It looks like I can manage my Mac from home just like a Linux box. So far so good. Though I don&rsquo;t have gcc up and running yet. My main problem is that the connection speed with my lab. is not great, but the sysadmin, Mihai, says it will get better.
- You can configure the mouse so that you have an actual right button. Very nice. You can even configure it as a 3-button mouse. Excellent! Those of you who don&rsquo;t know why you need 3 buttons clearly are missing on some great classical software such as xfig.
- Installing Firefox (first thing I did) created some kind of &ldquo;mounted disk&rdquo; that now resides on my desktop. When trying to put this useless icon in the garbage can, the machine complained that it could not unmount the disk. Which disk? I suppose that what I downloaded was some kind of disk image that MacOS mounts as a virtual disk. Fine. But how do I get rid of it now that Firefox is installed? There must be a trick to it.
- Security seems weak. It appears that I can install everything using my initial account. No root account? (Or maybe I have both a user and root account? I&rsquo;m confused.)
- The second thing I installed was [Fink](http://fink.sourceforge.net/). Fink is the MacOS equivalent of &ldquo;apt-get&rdquo; (debian) or &ldquo;portage&rdquo; (gentoo) or &ldquo;rpm&rdquo; (redhat/mandriva). Took me some doing to get it running, and it seems very useful, though, by default, very few packages are available. I tried moving to [CVS access](http://fink.sourceforge.net/doc/cvsaccess/index.php) which opens up many more packages, but it said, quite rudely, that I needed something called dev-tools. Alas, doing <kbd>sudo apt-get install dev-tools</kbd> fails with a comment to the effect that there is no such package. The command <kbd>sudo fink install dev-tools</kbd> is more informative as it tells you to go and register as a developer with Apple. __You are supposed to guess that dev-tools is &ldquo;Apple talk&rdquo; for a package called xcode.__ I did find it, sold my soul to Apple, and now I&rsquo;m downloading a huge image of what I hope is the dev-tools thing. This file is really gigantic (1GiB!). By the way, I do this remotely so I had to do <kbd>sudo apt-get links</kbd> to use the links browser (links is really a good browser). So far so good. <del>I just hope I&rsquo;ll be able to mount the disk image I&rsquo;m downloading through my ssh access.</del> The command <kbd>hdiutil attach</kbd> allows one to mount dmg files. It looks like <kbd>cd /Volumes/Xcode Tools; sudo installer -pkg XcodeTools.mpkg -target /</kbd> will install Xcode without any need for a GUI. Oh! And <kbd>fink install python cvs svn gnuplot gnuplot-py xfig kile tetex transfig anacron numeric wine pdftk imagemagick swig koffice kopete </kbd> looks like a decent way to start. I still don&rsquo;t know whether it will work, but there is a detailed page on building KDE on Mac.


References:

- [Great list of open source applications for MacOS](http://www.applematters.com/index.php/section/comments/open-source-software-for-the-macintosh/)
- Google software for MacOS


