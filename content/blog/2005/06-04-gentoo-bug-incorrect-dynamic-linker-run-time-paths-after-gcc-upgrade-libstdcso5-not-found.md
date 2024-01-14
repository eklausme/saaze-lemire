---
date: "2005-06-04 12:00:00"
title: "Gentoo bug: incorrect dynamic linker run time paths after gcc upgrade (libstdc.so.5 not found)"
---



My gentoo machine got in a bad state today after a portage sync (portage non functional). Various suggestions found on posting boards didn&rsquo;t help.

[The following trick did it for me](https://bugs.gentoo.org/show_bug.cgi?id=40694):

>Here is what I did as I could not use emerge anymore to remerge gcc-config 1) Modify /etc/env.d/05gcc to reflect the changes in GCC version 2) Modify /etc/ld.so.conf to reflect the changes in GCC version 3) Run ldconfig (to make env-update work) 4) Run env-update



