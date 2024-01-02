---
date: "2007-02-07 12:00:00"
title: "Saner rules for udev"
---



My favorite Linux brain teaser, udev, has changed its rule language somewhat. 

Previously, I had the following rule:

<code><br/>
BUS="usb",<br/>
SYSFS{product}="Palm Handheld",<br/>
KERNEL="ttyUSB[13579]",<br/>
OWNER="lemire",<br/>
GROUP="tty",<br/>
MODE="0660",<br/>
SYMLINK="m500"<br/>
</code>

Now, you need to have

<code><br/>
BUS=="usb",<br/>
SYSFS{product}=="Palm Handheld",<br/>
KERNEL=="ttyUSB[13579]",<br/>
OWNER="lemire",<br/>
GROUP="tty",<br/>
MODE="0660",<br/>
SYMLINK="m500"<br/>
</code>

This makes perfect sense, except that there was no error message to explain the required change. So an hour later, I learned way more than I needed about a crazy piece of software.

In general, another lesson learned is that __rule languages are hard and generally unfriendly__. Yes, I would throw CSS into the fold.

