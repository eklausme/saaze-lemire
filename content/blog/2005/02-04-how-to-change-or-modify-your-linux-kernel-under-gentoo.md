---
date: "2005-02-04 12:00:00"
title: "How to change or modify your Linux kernel under gentoo"
---



Here&rsquo;s a quick guide to upgrading or modifying your kernel under [gentoo](https://www.gentoo.org/). I assume you have genkernel installed (do &ldquo;emerge genkernel&rdquo;).

First of all, if you only want to add or remove elements to your kernel, or change options, you can do this as root:
```C

genkernel --no-clean --menuconfig all
```


Do your changes and reboot.

If you want to change kernel, then look under /usr/src. Suppose the source code of your new kernel is in /usr/src/newkernel, then do
```C

genkernel --menuconfig --kerneldir=/usr/src/newkernel all
```


Configure your new kernel the way you like it. Then do
```C

rm /usr/src/linux
ln -s /usr/src/newkernel /usr/src/linux
```


If you have nvidia (binary) drivers, do
```C

emerge nvidia-glx nvidia-kernel
```


Finally, possibly after mounting /boot (&ldquo;mount /boot&rdquo;) edit /boot/grub/grub.conf, basically just changing the name of the kernel throughout. Reboot and you have a new kernel compiled to __your__ needs for __your__ machine.

If you think this is __hard__, think again! When was the last time you changed your Windows kernel? Adding stuff to the Windows kernel is relatively (too) easy, but so is it easy with gentoo (single command followed by a reboot) whereas actually changing your Windows kernel is not so easy and is typically only done when you upgrade all of Windows: a task better left to experts.

