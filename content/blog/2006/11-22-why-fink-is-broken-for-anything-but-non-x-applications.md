---
date: "2006-11-22 12:00:00"
title: "Why Fink is broken for anything but non-X applications"
---



> __Update__. Since I wrote what follows, I&rsquo;ve [managed](http://www.daniel-lemire.com/blog/archives/2006/11/30/getting-kde-running-and-running-well-under-mac-os-x-is-easy/) to find ways to install X11 and KDE and all my favorite software with minimal pain. So Fink is not broken, but it could be friendlier. Same holds for Apple&rsquo;s X11. In fact, Fink is an incredibly powerful tool when combined with something like KDE. It extends Mac OS X in incredible ways.


[Fink](http://fink.sourceforge.net/) is a tool to install most common Unix applications (gnuplot, Xfig, you name it!) on MacOS. It has a nice and simple command line interface which I love.

 My friend Scott Flinn seems to maintain that [Fink](http://fink.sourceforge.net/) is a good solution, even if you want to run X applications (such as XFig, but he went so far as to include KDE appllications!!! Daring!!!).

Ok. One wasted afternoon and one wasted evening later, I beg to differ with Scott.

(Disclaimer: I think that MacOS X is about 10 times better than Windows XP. I&rsquo;m very happy I bought Apple gear. But when things are poorly layed out, poorly organized, someone has to say it. Even when volunteers do the work.)

Let&rsquo;s review some of the claims people make:

- __Fink supports X11__. This is true, but you end up with a primitive X server, without any sensible integration with the OS. I can have the same deal with [cygwin/X](http://x.cygwin.com/) for Windows, and who uses that? I read somewhere that MacOS was a Unix platform. If it can&rsquo;t do better than Windows at emulating a real Unix box, well, I will not be impressed.
- __Apple supports X11__. This is true, but not by default, and you need to be clever.

First of all, do not confuse &ldquo;MacOS X Server&rdquo; (which is expensive payware to run MacOS version 10 as a server OS) with &ldquo;support for X11&rdquo;. I don&rsquo;t even want to think about what will happen down the line when Apple comes out with &ldquo;MacOS XII&rdquo; (Mac OS 12) and offers &ldquo;Mac OS XII Server&rdquo;. If your font is slightly bad, you might be lost at this point. __Short story: Apple sells a Server OS which has nothing to do with an X server.__

Second of all, Apple has a nice and convenient [download page for its X11 server](http://www.apple.com/downloads/macosx/apple/x11formacosx.html). Except that it says: <em style="background:#ccc;">Note 10.4 customers can install X11 by using the Tiger DVD installer disk.</em> What this means, in Apple talk, is that if you have 10.4, you need your Tiger DVD. It won&rsquo;t tell you this even as you try to install the freshly downloaded package on your machine: it will tell you that you already have &ldquo;more recent software installed&rdquo; (which wrongly suggested to me that X11 was already installed!). Yes, I know, they don&rsquo;t say &ldquo;must install&rdquo;, they say &ldquo;can install from DVD&rdquo;, but apparently, for Apple, if you can do at thing, you must do a thing. Did you lose your DVDs? Too bad. Ok, turns out that in my case, I still have them. I put the &ldquo;Tiger&rdquo; DVD in (which, interestingly, is not called &ldquo;Tiger&rdquo; at all, but &ldquo;Mac OS 10.4&rdquo;). Then a window pops up with a few icons, mostly a README, and two reinstallation option. I try to reinstall the bundled application, reboot. No luck. Ok, now I go for the full reinstall of the whole OS. Still no luck. __At this point, I reinstalled my OS and rebooted twice.__ Now, wait&hellip; Oh! When you put the DVD in, in the window that opens, if you scroll all the way to the bottom, you see &ldquo;optional installs&rdquo;. Ah! I run this! Ah! X11. Ah! Cool. Looks like I installed it, but there is no instruction, nothing. The installer just quits without telling me anything. Now, where is that X11 thing? It has to be on my machine now! In Finder, under Applications, maybe? No. Nowhere to be found. Hmmm&hellip; Did it install the thing? Why won&rsquo;t it leave a trace? Searching for X11.app in Finder gives me nothing. I search for &ldquo;X11&rdquo;. Ok, now, beside a bunch of files derived from Fink, I have something called X11 as an application. Where and how I&rsquo;m supposed to find it usually is beyond me. (__Later on, the X11 application appeared under &ldquo;Applications / Utilities&rdquo;, but how was I supposed to guess this?__) I launch X11 and it looks good. I get some kind of shell. I can&rsquo;t test it yet, but it looks hopeful. __At this point, my afternoon is completed and I must go home.__
- __Fink supports Apple&rsquo;s X11__. This would be the best of both worlds. Fink provides the applications, and Apple provides an X server with a nice integration to the OS. Unfortunately, this is painful and can be a lenghty process.

Here is what fink tells me when I want to install an X application:

> 
You have an existing X11 installation in /usr/X11R6 and/or /etc/X11.<br/>
This package refuses to overwrite these. Remove them, then tell Fink to<br/>
install xfree86 again. (The package won&rsquo;t be recompiled.) If you want<br/>
to keep your X11 installation, please see the FAQ entry at<br/>
[http://fink.sourceforge.net/ faq/ usage-packages.php#apple-x11-wants-xfree86](http://fink.sourceforge.net/faq/usage-packages.php#apple-x11-wants-xfree86)<br/>
for more information on how to configure your system.



The link basically says this:

> 
If you have a current version of fink (>=0.18.3-1), typically what you need to do is reinstall the X11User package, since the installer application occasionally misses installing a file. You may need to do this multiple times.



Right there, I have to stop. What is X11User? I&rsquo;ll save you the trouble and about 3 hours wasted. X11User is the very thing I installed from the &ldquo;Tiger&rdquo; DVD. Turns out that you can do the install from a shell, so let&rsquo;s do it again, and again, and again. (They say to do it __multiple times__. They say that the application sometimes does not install all files? What a piece of software engineering!!! Way to go Apple!)<br/>
<code style="font-size:8pt">cd "/Volumes/Mac OS X Install Disc 1/System/Installation/Packages"<br/>
sudo installer -pkg X11User.pkg -target /<br/>
</code>


Ok. I did it about ten times to be sure. Every time the installer tells me &ldquo;The upgrade was successful&rdquo;. Now, I&rsquo;ll save you the trouble, but later on, we learn that we better have something called X11SDK. It is not clear that I need this, but let&rsquo;s be safe. (Earlier, I reported, on my blog, that &ldquo;X code&rdquo;, which is &ldquo;Apple talk&rdquo; for &ldquo;dev-tools&rdquo; was installed.)

<code style="font-size:8pt">cd "/Volumes/Mac OS X Install Disc 1/Xcode Tools/Packages"<br/>
sudo installer -pkg X11SDK.pkg -target /<br/>
</code>

Ok, so far so good. I repeat this about ten times, just to be sure given the, apparently well known, randomized behavior in Apple&rsquo;s installers. Now, I&rsquo;m told that &ldquo;fink list -i system-xfree86&rdquo; should output some pseudo-packages. It outputs nothing except &ldquo;Information about 4816 packages read in 1 seconds.&rdquo; Given that I have two processors in this machine, I&rsquo;m not impressed that it takes 1 second to parse 4816 packages, but I presume that Fink is not written in assembly. Fine. 

Not all is lost! Fink tells me that if nothing works, I can try to &ldquo;flush out my X11 installation and remove any old placeholders and partially/fully installed X11-related packages&rdquo;. Oh! Ok. The command line is long and it remove my precious X11 application (this is scary! what else does it remove?), plus it tries to update Fink using what appears to be a very slow pipe (I have selected the rsync update method after the CVS method just hung there for over two hours doing nothing). What gets to me here is that clearly, Fink is in error, why do I need to remove Apple&rsquo;s X11 to fix Fink? Can we say &ldquo;bad engineering&rdquo;?

Ok, now I try to rebuild from the ground up:

<code style="font-size:8pt">cd "/Volumes/Mac OS X Install Disc 1/System/Installation/Packages"<br/>
sudo installer -pkg X11User.pkg -target /<br/>
sudo installer -pkg X11User.pkg -target /<br/>
sudo installer -pkg X11User.pkg -target /<br/>
sudo installer -pkg X11User.pkg -target /<br/>
sudo installer -pkg X11User.pkg -target /<br/>
sudo installer -pkg X11User.pkg -target /<br/>
(repeat many times)<br/>
cd "/Volumes/Mac OS X Install Disc 1/Xcode Tools/Packages"<br/>
sudo installer -pkg X11SDK.pkg -target /<br/>
(repeat many times)<br/>
</code>

Now, I run the damned command &ldquo;fink list -i system-xfree86&rdquo; and get&hellip;

<code style="font-size:8pt"><br/>
i system-xfree86 2:4.4-2 [placeholder for user installed x11]<br/>
i system-xfree86-dev 2:4.4-2 [placeholder for user installed x11 development tools]<br/>
i system-xfree86-s... 2:4.4-2 [placeholder for user installed x11 shared libraries]<br/>
</code>

I&rsquo;m hoping this is good. __Short story: Fink is trying too hard to be smart and ends up making you work like a madman.__
- Now, let&rsquo;s try to install a few things:<br/>
<code style="font-size:8pt"><br/>
fink install gnuplot<br/>
fink install xfig<br/>
fink install kile<br/>
</code>

The first two work, but the last one won&rsquo;t install. for the following reason:

<code style="font-size:8pt"><br/>
dpkg: dependency problems prevent configuration of autoconf2.5:<br/>
autoconf2.5 depends on autoconf (= 2.60-4); however:<br/>
Package autoconf is not installed.<br/>
/sw/bin/dpkg: error processing autoconf2.5 (--install):<br/>
dependency problems - leaving unconfigured<br/>
Errors were encountered while processing:<br/>
/sw/fink/dists/unstable/main/binary-darwin-i386/devel/autoconf_2.60-4_darwin-i386.deb<br/>
</code>

Ok, but so, maybe I have gnuplot working, right? Let&rsquo;s see&hellip;

<code style="font-size:8pt"><br/>
> gnuplot<br/>
dyld: Library not loaded: /usr/X11R6/lib/libfontconfig.1.dylib<br/>
Referenced from: /sw/bin/gnuplotx<br/>
Reason: Incompatible library version: gnuplotx requires version 1.0.4 or later, but libfontconfig.1.dylib provides version 1.0.0<br/>
/sw/bin/gnuplot: line 6: 24936 Trace/BPT trap /sw/bin/gnuplotx "$@"<br/>
</code>

Hmmm&hellip; that can&rsquo;t be good. For completeness, here&rsquo;s the content of my proud /sw/etc/fink.conf file.

<code style="font-size:8pt"><br/>
Basepath: /sw<br/>
RootMethod: sudo<br/>
Trees: local/main stable/main stable/crypto unstable/main unstable/crypto<br/>
Distribution: 10.4<br/>
ConfFileCompatVersion: 1<br/>
Mirror-apache: http://www.apache.org/dist<br/>
Mirror-apt: http://bindist.finkmirrors.net/bindist<br/>
Mirror-cpan: ftp://ftp.cpan.org/pub/CPAN<br/>
Mirror-ctan: ftp://tug.ctan.org/tex-archive<br/>
Mirror-debian: ftp://ftp.debian.org/debian<br/>
Mirror-gimp: ftp://ftp.gimp.org/pub/gimp<br/>
Mirror-gnome: ftp://ftp.gnome.org/pub/GNOME<br/>
Mirror-gnu: ftp://ftp.gnu.org/gnu<br/>
Mirror-kde: ftp://ftp.kde.org/pub/kde<br/>
Mirror-master: http://distfiles.master.finkmirrors.net/<br/>
Mirror-rsync: rsync://master.us.finkmirrors.net/finkinfo/<br/>
Mirror-sourceforge: http://west.dl.sourceforge.net/sourceforge/<br/>
MirrorContinent: nam<br/>
MirrorCountry: nam-us<br/>
MirrorOrder: MasterFirst<br/>
ProxyPassiveFTP: true<br/>
UseBinaryDist: true<br/>
Verbose: 1<br/>
SelfUpdateMethod: rsync<br/>
</code>

Maybe my problem is that I now use a binary distribution? I don&rsquo;t know where the &ldquo;UseBinaryDist: true&rdquo; came from as I remember setting up fink to use a source distribution and seeing packages compile (must be the reinstallation that was required of me earlier that wiped my setting). Ok. I&rsquo;ve changed the setting to false, but uninstalling and reinstalling packages does not seem to recompile them.

So, maybe now I should wipe out all of fink and start again from scratch? Will this even work? Maybe I should try &ldquo;fink cleanup&rdquo;? Will it help?

Fink should learn from portage which also has binary packages. By default, portage always rebuilds packages. This should be the sane behavior. Maybe &ldquo;fink rebuild gnuplot&rdquo; will do what I want? Here&rsquo;s what I get&hellip;

<code style="font-size:8pt"><br/>
New package: dists/unstable/main/binary-darwin-i386/text/ghostscript_8.54-3_darwin-i386.deb<br/>
Failed: phase compiling: readline-4.3-1028 failed<br/>
(...)<br/>
Note that many fink package maintainers do not (yet) have access to OS X on<br/>
Intel hardware, so you may have better luck on the mailing lists.<br/>
</code>

What??? You mean the guys who maintain this have no idea if it even builds and no incentive to find out? Gosh! Maybe this explains why none of this works.
<p style="color:red">Hours go by&hellip;

Ok, I tried rebuilding various packages in various orders and things eventually build. I&rsquo;ve got no idea what will end up working tomorrow though. And it is very scary the way the dependencies are not automated. (Gnuplot now works though, but it did work before this whole mess.) Next, I&rsquo;m trying this before going to be late: &ldquo;fink rebuild kile gimp gnumeric kopete swig&rdquo;.

<p style="background:#ddd;border: thin dotted black; margin: 1em;padding:1em;"> __Unrelated but important nonetheless__: My oldest son is 3 years old from now on. No, he can&rsquo;t help me yet with my computer problems, but he can find the TV remote from time to time which is pretty useful.

