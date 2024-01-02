---
date: "2005-12-07 12:00:00"
title: "Linux 64 bits: lessons learned"
---



I recently destroyed my 2 years old AMD Athlon PC while trying to beef up its RAM. The guys who sold it to me put down 1 GB of RAM on paper, but (shame) it took me 2 years to find out that there was, actually, on 256 MB of RAM in the machine.

So, I went out and bought a new machine. An AMD Athlon 64 machine. I bought it from [Microbytes in Longueuil near Montreal](http://www.microbytes.com/). The first surprise was that the machine was actually nearly silent, at least compared with my previous beast I had to tweak and tweak until it was, approximatively silent. Another surprise was that the case included a speakers so no need for external speakers in order to get some level of sound. The video card is a cheap ASUS card, but it has a nice NVIDIA 6200 chipset, so it is good enough for fast 3D. I also bought a 160 GB hard drive. I paid CAN$900 for the whole thing, including a few goodies like CD-RW, 1 GB of RAM and so on. That&rsquo;s about US$700. Amazingly cheap. I opened the box and the internal layout is really nice.

When I came home, I decided to install Gentoo Linux on it. And, why not, to build the machine as a 64 bits machine from the ground up. There were few bad surprises. Basically, Linux 64 bits is like Linux 32 bits. Some notable exceptions are:

- There is a simple rule to follow: 32 bits binaries don&rsquo;t mix with 64 bits binaries. You can run both 64 bits and 32 bits applications on a 64 bits kernel, but you need both 32 bits and 64 bits libraries. This is not unlike what happened when we went from 16 bits to 32 bits.
- To compile Firefox from source is useless. Get a prebuilt 32 bits version. You have to manually install a 32 bits Java JVM (like Sun&rsquo;s JRE) so you can get applet support. The 64 bits SDK is still required if you do non trivial Java programming though.
- You need to run the 32 bits version of OpenOffice: there is no 64 bits port yet. The 32 bits NVIDIA OpenGL driver prevented OpenOffice 2.0 from starting. I had to remove them. I was getting very obscur error messages, something about ld.so detecting inconsistencies: &ldquo;Inconsistency detected by ld.so: ../sysdeps/generic/dl-tls.c: 75: _dl_next_tls_modid: Assertion `result < = _rtld_local._dl_tls_max_dtv_idx' failed!". (Specifically, I had to remove the directory "/usr/lib32/opengl/nvidia/lib".)


I was reminded of how annoying X11 config files are. To get the recent Microsoft mice to work, you need the following magic in /etc/X11/xorg.conf:<br/>
<code>Option "Protocol" "IMPS/2"<br/>
Option "Device" "/dev/input/mice"<br/>
Option "ZAxisMapping" "4 5"</code><br/>
I don&rsquo;t know about you, but while &ldquo;IMPS/2&rdquo; might stand for &ldquo;IntelliMouse PS/2&rdquo;, I have no idea why I need some ZAxisMapping. Yes, I know ZAxisMapping stands for Mouse Wheel, but could it be less cryptic?

