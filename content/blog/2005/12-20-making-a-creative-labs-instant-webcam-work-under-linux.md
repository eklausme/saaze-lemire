---
date: "2005-12-20 12:00:00"
title: "Making a Creative Labs Instant Webcam work under Linux"
---



Just bought a cheap Creative Labs Instant webcam. These things are supported by the [spca5xx](http://mxhaard.free.fr/spca5xx.html) driver. To install the driver under gentoo, do:

<code>emerge spca5xx</code>

To see if your device is detected after connecting it up, do:

<code>lsusb</code>

You should see a line similar to this one:

<code>Bus 002 Device 006: ID 041e:4034 Creative Technology, Ltd</code>

A useful tool if you use the spca5xx driver is spcaview. In any case, initially, after plugging the webcam in, all I got was a dark screen. I believe that&rsquo;s because the device needs to be <em>initialized</em>. I cannot be sure exactly how I activated it, except that I plugged and unplugged it while running various software. Yes, it is a bit fuzzy. Sorry.

Now, it works beautifully.

__Update:__ You might need to plug the device after the driver has been loaded. Try typing &ldquo;rmmod spca5xx&rdquo; and if that works, remove your device, load the driver (modprobe spca5xx) and plug the device back in. If you want to check if it works without any fancy software, do &ldquo;more /dev/video0&rdquo;, there should be no error message and you ought to read some characters (maybe blanks).

__Annoying bug:__ It isn&rsquo;t clear why, but gnomemeeting has the voice button disabled despite the fact that my voice hardware is correctly configured. It could be that the spca5xx driver is messing up gnomemeeting or that gnomemeeting is buggy and sometimes erronously disables the audio.

__Update on annoying bug:__ Gnomemeeting works just fine, but for audio input to work, you have to open a connection to another user. Great software.

