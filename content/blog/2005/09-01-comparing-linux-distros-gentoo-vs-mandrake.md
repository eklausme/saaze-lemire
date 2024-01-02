---
date: "2005-09-01 12:00:00"
title: "Comparing Linux distros: gentoo vs. Mandrake"
---



Want help choosing your Linux distribution? I use both gentoo and Mandrake&hellip; Let&rsquo;s see if gentoo is right for you.

About [gentoo](https://www.gentoo.org/)&hellip;

Short story: great for a machine you really care about and plan to keep a long time. Bad for a machine you rarely use and just want to work now.

Pros:

- Installation might be manual, but it is very well documented&hellip; See [http://www.gentoo.org/&hellip;/handbook-x86.xml](https://wiki.gentoo.org/wiki/Handbook:X86). Comparatively, Mandrake doesn&rsquo;t need documentation for the installation, since the installation takes half an hour and is automated.
- Community support is excellent. Bugs get fixed quickly. Gentoo.org bugzilla is beautiful and works well. See [http://bugs.gentoo.org/](https://bugs.gentoo.org/). Comparatively, Mandrake has nothing like bugzilla, but rather &ldquo;paid support&rdquo;.
- They support far more packages than RedHat or Mandrake (see http://www.gentoo-portage.com/). No more &ldquo;hunt down this RPM&rdquo; crap. This morning, I wanted spamassassin&hellip; I did &ldquo;emerge spamassassin&rdquo;&hellip; it went through, downloaded the necessary packages and installed everything. One command and the stuff is installed. Comparatively, Mandrake doesn&rsquo;t have RPMs for everything and when it doesn&rsquo;t it is really a pain. Even if Mandrake has the RPMs, finding them can be hard.
- [main argument in favor of gentooo] I don&rsquo;t see the day when my gentoo install will be outdated. I started out with kernel 2.4, I&rsquo;m now using kernel 2.6&hellip; and if there is a kernel 2.8, I&rsquo;ll move to it. No problem. You do &ldquo;emerge sync; emerge -uD world&rdquo; and your machine is<br/>
synced with the latest packages. You can do this nightly though I don&rsquo;t recommend it. Comparatively, my fresh Mandrake install is already outdated and short of reinstalling the whole thing, I have no way to upgrade it.


Cons:

- It takes longer to install, because you have no wizard. You do have a CD that gives you a nice shell, but from there, it is manual labor. Allocate a day to have something ready for actual work. Mandrake installs in half an hour.
- Setting up stuff is all done through command line utilities, except for what KDE or Gnome provide. You basically cannot stay away from hacking /etc files. Comparatively, with Mandrake, you have GUI tools for everything.
- You compile everything from source, so installing software takes longer. On rare occasions, something can fail to compile and you have to check up the bug reports.
- The portage system is great, but there is a small learning curve. You have learn about package masking, portage keywords and so on. There is a tool called &ldquo;epm&rdquo; which allows you to mimick the &ldquo;rpm&rdquo; command under gentoo, but it is not the good old rpm. Comparatively,<br/>
Mandrake uses RPMs which I knew well.
- The portage system (&ldquo;emerge&rdquo; command) is relatively slow. There can be a 5 seconds delay before the emerge plan gets computed. Comparatively, installing a rpm is very quick.
- I find that some programs like OpenOffice are snappier under Mandrake. Probably has to do with compile options. You could tweak gentoo to get the same results, but I don&rsquo;t have time for this.


