---
date: "2005-02-03 12:00:00"
title: "Why I have the best and most beautiful wife in the world!"
---



Today was my birthday. I&rsquo;m old, or at least, getting older.

Why is my wife so great? Well, she is beautiful, a great mom and very smart. Also, she gave me a MP3 player today: that&rsquo;s right, I got a nice Benq Joybee 110. I&rsquo;m very happy.

Back to the serious stuff. When you get such a device, you got to make it work with Linux. So I plug the device&hellip; and it immediately shows up when I type &ldquo;dmesg&rdquo;&hellip; something like this appears&hellip;
```C

USB Mass Storage device found at 3
usb 1-3: USB disconnect, address 3
ohci_hcd 0000:00:02.2: wakeup
usb 1-3: new full speed USB device using address 4
scsi2 : SCSI emulation for USB Mass Storage devices
  Vendor: BenQ      Model: Joybee 110        Rev: 1.00
  Type:   Direct-Access                      ANSI SCSI revision: 02
SCSI device sda: 506368 512-byte hdwr sectors (259 MB)
sda: assuming Write Enabled
sda: assuming drive cache: write through
 /dev/scsi/host2/bus0/target0/lun0: p1
Attached scsi removable disk sda at scsi2, channel 0, id 0, lun 0
Attached scsi generic sg0 at scsi2, channel 0, id 0, lun 0,  type 0
```


In case this doesn&rsquo;t work out and you are using [gentoo](https://www.gentoo.org/), then make sure you have hotplug installed, if not, do it now:
```C

emerge hotplug
rc-update add hotplug default
```


And while you are at it, install coldplug too so that USB devices are recognized during boot, not just when they are inserted:
```C

emerge coldplug
rc-update add hotplug boot
```


Ok, back to the output of dmesg, it seems the device is at &rdquo; /dev/scsi/host2/bus0/target0/lun0&#8243;, how do I mount this?
```C

 > ls /dev/scsi/host2/bus0/target0/lun0
disc  generic  part1
```


Aah! Ok&hellip; so maybe I should try mounting &ldquo;/dev/scsi/host2/bus0/target0/lun0/disc&rdquo;. Let&rsquo;s see if I can get some info about it&hellip;
```C

> fdisk /dev/scsi/host2/bus0/target0/lun0/disc
Commande (m pour l'aide): p
Disque /dev/scsi/host2/bus0/target0/lun0/disc: 259 Mo, 259260416 octets
16 tÃªtes, 32 secteurs/piste, 989 cylindres
Unités = cylindres de 512 * 512 = 262144 octets
                           Périphérique Amorce    Début         Fin      Blocs    Id  SystÃ¨me
/dev/scsi/host2/bus0/target0/lun0/part1   *           1         989      253152+   6  FAT16
```


Ok, so, it is now telling that &ldquo;/dev/scsi/host2/bus0/target0/lun0/part1&rdquo; is a FAT16 (Microsoft-style) disk. I suspect that I could actually reformat the disk to anything I want at this point. Fine, I go into /etc/fstab, and I add the following line:
```C

/dev/scsi/host2/bus0/target0/lun0/part1 /mnt/joybee vfat defaults,noauto,users,sync 0 0
```


(See update below, using /dev/scsi/host2/bus0/target0/lun0/part1 is a bad idea!)

It seems to me the &ldquo;sync&rdquo; option is important: don&rsquo;t delay writes in case the device is unplugged by accident. Then, after creating the directory &ldquo;/mnt/joybee&rdquo;, I mount it like so&hellip;
```C

mount /mnt/joybee
```


Next, the following python script can be used to copy the content of a m3u file to the device:
```C

import shutil,re
f = open('indiscover.m3u') #only contains file paths
# optionnally, I could clear /mnt/joybee/mp3
for file in f:
  file = file.rstrip()
  print file
  shutil.copy(file,'/mnt/joybee/mp3')
```


Of course, the script could be a lot smarter, but I&rsquo;ve got a wife to kiss. And voilÃ ! Who said anything about Linux being hard to use?

Am I done? Not really, my kernel has no support for either supermount or automount, so I&rsquo;ll need to fix this (back in a few hours). The problem right now is that I need to type &ldquo;mount /mnt/joybee&rdquo; when I plug the device and &ldquo;umount /mnt/joybee&rdquo; before I unplug it. I bit annoying.

In order to automount, make sure you compile your kernel with support for automount (with genkernel, go under File Systems>Kernel Automounter). You also need to install autofs:
```C

emerge autofs
rc-update add autofs default
```


Then add the following line to file /etc/autofs/auto.master (not /etc/auto.master!!!):
```C

/misc /etc/autofs/auto.misc --timeout 1
```


and add the following line to /etc/autofs/auto.misc (not /etc/auto.misc!!!):
```C

joybee -users,sync,fstype=vfat,rw :/dev/scsi/host0/bus0/target0/lun0/part1
```


That&rsquo;s pretty much it, then you should be able to cd to /misc/joybee and see your files.

In practice though, I&rsquo;m not sure it is so great to have automount. Maybe I can simply modify my script above so it mounts and umounts as it needs since I&rsquo;m unlike to &ldquo;cd&rdquo; to my player very often. Indeed, there are problems with automount, at least on my machine. If I try to reload autofs because I&rsquo;ve changed the configuration, it goes dead and it can&rsquo;t recover (short of rebooting which I never do). I&rsquo;ve read somewhere that I must make sure nothing is automounted before I play with autofs. Seems somewhat a weak design. They claim that if nothing is automounted, you can safely stop the deamon: seems to fail here. However, from the man page, it seems that reloading the deamon should be rarely needed. __Anyhow, seems like submount would be a better alternative?__

__Update:__ Using hard coded paths like /dev/scsi/host2/bus0/target0/lun0/part1 is bad since they will change from time to time. On my machine, it can become /dev/scsi/host3/bus0/target0/lun0/part1 and so on. I believe that if you have &ldquo;udev&rdquo; installed (do &ldquo;emerge udev&rdquo;), then it gets mapped to /dev/sda1 &ldquo;always&rdquo; according to some magically rules I haven&rsquo;t checked. So, use &ldquo;/dev/sda1&rdquo; throughout above for better results.

__Update 2:__ On recent kernels with udev, you simply do &ldquo;mount /dev/sda1 /mnt/usb&rdquo; and you are in business. The following line should appear in all /etc/fstab files these days.<br/>
<code>/dev/sda1 /mnt/usb auto noauto,user,umask=111 0 0</code><br/>
Also, it seems like software called hal is able to automount your devices in the /media directory.

