---
date: "2008-05-26 12:00:00"
title: "If your ssh connection times out when you ask for the content of a directory&#8230;"
---



I have had no end of trouble connecting by ssh to my main Mac Pro. Whenever I would type &ldquo;ls -1&rdquo; in a directory containing many files, the connection would time out. This problem came and went away periodically. Owen pointed me to a [sane explanation](https://marc.info/?l=openssh-unix-dev&amp;m=102413585608801) which has to do with evil firewalls. It looks like I solved my problems (for now) by typing &ldquo;sudo ifconfig en0 mtu 576&rdquo; in a server shell. It has nothing to do with ssh or Apple or MacOS.

