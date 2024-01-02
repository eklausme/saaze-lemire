---
date: "2005-12-10 12:00:00"
title: "Using a USB Palm Pilot with udev"
---



Up until recently, udev, was a mystery to me, but I&rsquo;m starting to learn. Udev is a service you probably want running with recent kernels. What it does is to create a node in the /dev directory whenever a new device is recognized. So, if you plug your m500 Palm Pilot and press the sync button, hotplug will recognize the device and udev should create the node in /dev for you with whatever naming convention you prefer. 

First, before we name it, we want to figure out how the device looks to Linux, to do so press the sync button and do<br/>
<code> lsusb -v | more </code>

You should see something like this (but more verbose):

<code>Bus 001 Device 014: ID 0830:0001 Palm, Inc.<br/>
Device Descriptor:<br/>
idVendor 0x0830 Palm, Inc.<br/>
idProduct 0x0001<br/>
iManufacturer 1 Palm, Inc.<br/>
iSerial 5 00TPP123A4KG<br/>
</code>

What is interesting is the serial number. This is a unique identifier for the device we can use to tell udev what to do with this device in particular. Not all USB devices have a serial number, but they have plenty of information to help you identify them. So we will add a new rule to tell udev what to do with this particular device, assuming you a vim-lover, do this:

<code>cd /etc/udev/rules.d<br/>
vim 10-udev.rules</code>

and enter the following line:

<code>SYSFS{serial}="00TPP123A4KG",NAME="m500",<br/>
OWNER="lemire",GROUP="tty",MODE="0660"</code>

This tells udev to create a node called m500 in /dev whenever this serial number is encountered. For extra points, I specify the ownership and permissions on the device. The device will appear as &ldquo;/dev/m500&rdquo;. You might have to type &ldquo;udevstart&rdquo; for the new rule to take effect, though I&rsquo;m unclear about this. Anyhow, press the sync button and check that /dev/m500 is created. 

Because /dev/m500 is created only when I press on the sync button and not before, software such as jpilot has a hard time because it doesn&rsquo;t want to wait on a non-existing device. To fix this problem, we simply create a symbolic link:

<code>ln /dev/m500 /dev/pilot</code>

And voilÃ ! Launch jpilot and you should be all set.

This whole approach is generally applicable to usb devices. Suppose you have a device such as /dev/sound/dsp1 and you want to know how to select it using udev rules, type the following:

<code>udevinfo -n /dev/sound/dsp1 -q path | xargs udevinfo -a -p</code>

This will give you interesting ways to select your device using an udev rule:

<code> SYSFS{manufacturer}=="AKM "<br/>
SYSFS{product}=="AK5370 "</code>

By the way, if you are using gentoo, the directory /sys automatically lists all the devices on your machine. It isn&rsquo;t friendly, but it is good to know.

