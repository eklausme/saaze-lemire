---
date: "2005-12-19 12:00:00"
title: "Getting an old 3COM HomeConnect webcam to work under Linux"
---



I have an old an dusty 3Com HomeConnect webcam. Until a few minutes ago, I thought it was dead. Not so! I plugged it in the USB port, and did

<code>lsusb</code>

and voilÃ :

<code>Bus 001 Device 019: ID 04c1:009d U.S. Robotics (3Com) HomeConnect WebCam [vicam]</code>

Ah! so Linux recognizes it and suggests the vicam driver, ok, there you go:

<code>modprobe vicam</code>

As a basis for comparison, I tried to connect the same thing to Windows XP and no luck. The only drivers available are 16 bits drivers and they won&rsquo;t install.

In gnomemeeting, I now see an fuzzy image. After taking apart the lens of webcam and cleaning it up, the image is considerably better, but still very ugly.

I guess I have to buy a new webcam! This user-commented list seems like a good start to choose a new device for a Linux user, but the [list of webcams supported by the SPCA5xx driver is impressive](http://mxhaard.free.fr/spca5xx.html). It is still satisfying to know I&rsquo;m buying new hardware because it is worn out, not because my OS won&rsquo;t support it. BTW gnomemeeting is really great software.

