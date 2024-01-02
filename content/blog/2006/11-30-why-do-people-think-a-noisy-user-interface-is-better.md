---
date: "2006-11-30 12:00:00"
title: "Why do people think a noisy user interface is better"
---



This is very annoying. Each and every time I install a new machine, the command shell has the beep enabled so that, for every ten keys I press, there is an audible &ldquo;beep!&rdquo;

Ok, who thinks this is a good default? Why do I want my machine beeping each time I use autocompletion? How is that helping me? What is the case for such a feature? You are in a meeting, checking up on some data, and the machine keeps on beeping? Why is that good? Ever?

__I do not want software to make any noise unless I say so.__

Now, if at least it was easy to turn off! For future reference, here is the cryptic command to turn off the bell:

<kbd>xset b off</kbd>

(I think this only works if you work inside an X server.)

To make sure that your PC speaker remains silent, do this:

<kbd>rmmod pcspkr</kbd>

To make sure that your PC speaker remains silent forever, add the following line to /etc/modprobe.d/blacklist:

<kbd>blacklist pcspkr</kbd>

I also like to put the following in ~\\.inputrc:

<kbd>set bell-style off</kbd>

This seems to work with most shells.

