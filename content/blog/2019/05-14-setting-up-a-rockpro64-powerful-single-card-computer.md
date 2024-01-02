---
date: "2019-05-14 12:00:00"
title: "Setting up a ROCKPro64 (powerful single-card computer)"
---



A few months ago, I ordered [ROCKPro64](https://store.pine64.org/?product=rockpro64-4gb-single-board-computer). If you are familiar with the Raspberry Pi, then it is a bit of the same&hellip; an inexpensive computer that comes in the form of a single card. The ROCKPro64 differs from the Raspberry Pi in that it is much closer in power to a normal PC. You make a decent laptop out of it. It has enough memory to do useful work and a decent 6-core processor  (dual ARM Cortex A72 and quad ARM Cortex A53). I bought the following components:

<a href="https://lemire.me/blog/wp-content/uploads/2019/05/IMG_0278.jpeg"><img decoding="async" class="alignnone size-medium wp-image-17472" src="https://lemire.me/blog/wp-content/uploads/2019/05/IMG_0278-300x225.jpeg" alt width="45%" style="float: right;margin:2em;" srcset="https://lemire.me/blog/wp-content/uploads/2019/05/IMG_0278-300x225.jpeg 300w, https://lemire.me/blog/wp-content/uploads/2019/05/IMG_0278-768x576.jpeg 768w, https://lemire.me/blog/wp-content/uploads/2019/05/IMG_0278-1024x768.jpeg 1024w" sizes="(max-width: 300px) 100vw, 300px" /></a>

- <span class="il">ROCKPro64</span> 4GB Single Board Computer ($80)
- <span class="il">ROCKPro64 aluminium casing ($15) </span>
- 64GB eMMC module ($35)
- USB adapter for the eMMC Module ($5)
- <span class="il">ROCKPro64 power supply ($13)</span>


I also had an ethernet cable at home. I connected the ethernet cable to my iMac, which is connected to the Internet via Wifi, and I configured macOS to enable Internet sharing via the (previously unused) ethernet port. You can probably connect the <span class="il">ROCKPro64 to the Internet by wifi, but I always prefer the reliability of ethernet cables. So I connected the ROCKPro64 to the Internet via this ethernet  cable. I did not plug anything else into it.</span>

I wanted to install Linux on the ROCKPro64. At first, I went to Ubuntu, grabbed a release there, but it was a bad idea. It does not work. I finally figured out that you have to download Linux releases tailored to the hardware. So I got the [latest version of Debian for the ROCKPro64](https://github.com/ayufan-rock64/linux-build/releases) for GitHub. I prefer Ubuntu, but debian is good too. Maybe importantly, I used a release that was specific to the ROCKPro64 (with rockpro64 in the name).

You then need to get the operating system on the eMMC module. The eMMC module is a bit like an SD card, but you can&rsquo;t plug it into you computer. However, you can plug it in the USB adapter you just bought. I did so.

In theory, you could run the ROCKPro64 out of an SD card. I do not like to work with SD cards: they are slow and unreliable. I am hoping to get better performance and durability out of the eMMC module.

I downloaded a piece of software called &ldquo;[etcher](https://www.balena.io/etcher/)&ldquo;. After launching it, it asked which image I wanted to use, I selected the Linux image file I had downloaded (exact name: stretch-minimal-rockpro64-0.7.9-1067-arm64.img.xz). Then it asked for the destination drive, so I plug in my USB adapter. I ignored macOS warnings about the content being unreadable and I just hit the &ldquo;flash&rdquo; button in etcher. I waited about five minutes.

When etcher told me everything was fine, removed the eMMC module and put it on the ROCKPro64 (there is a dedicated area on the board). I then plugin my power cord to the ROCKPro64. The network adapter lights turned on and after a short time a white LED light near the reset button came on.

I went on my iMac and in a terminal window, I typed &ldquo;arp -a&rdquo;. There was the following line among others:

> ? (192.168.2.2) at 5a:59:0:de:6b:4e on bridge100 ifscope [bridge]


The password and identifiers are rock64, so I used ssh to connect to board:

> $ ssh <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="6a180509015c5e2a5b5358445b5c5244584458">[email&#160;protected]</a><br/>
<a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="681a070b035e5c2859515a46595e50465a465a">[email&#160;protected]</a>&rsquo;s password:<br/>
_ __ _ _<br/>
_ __ ___ ___| | ___ __ _ __ ___ / /_ | || |<br/>
| &lsquo;__/ _ \ / __| |/ / &lsquo;_ \| &lsquo;__/ _ \| &lsquo;_ \| || |_<br/>
| | | (_) | (__| &lt;| |_) | | | (_) | (_) |__ _|<br/>
|_| \___/ \___|_|\_\ .__/|_| \___/ \___/ |_|<br/>
|_|<br/>
Linux rockpro64 4.4.132-1075-rockchip-ayufan-ga83beded8524 #1 SMP Thu Jul 26 08:22:22 UTC 2018 aarch64

The programs included with the Debian GNU/Linux system are free software;<br/>
the exact distribution terms for each program are described in the<br/>
individual files in /usr/share/doc/*/copyright.

Debian GNU/Linux comes with ABSOLUTELY NO WARRANTY, to the extent<br/>
permitted by applicable law.<br/>
rock64@rockpro64:~$


After playing with the machine a bit, I wanted to shut it down. I think you want to type &ldquo;systemctl poweroff&rdquo;.

Notice how I am not connecting a mouse, a monitor or a keyboard to it. For what I want to do with it, I do not need any of that.

I find it inconvenient to remember the IP address of the machine. To be able to log in as &ldquo;ssh <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="196b767a722f2d596b767a72696b762f2d3775767a7875">[email&#160;protected]</a>&rdquo;, just type the following:

<code>sudo apt-get update<br/>
sudo apt-get install avahi-daemon avahi-dnsconfd avahi-discover avahi-utils libnss-mdns<br/>
sudo service avahi-daemon start</code><br/>
Throw in the &lsquo;ssh-copy-id&rsquo; command and you can log in without typing a password.

The modern way to run software on Linux is to use containers (e.g., docker). You can almost follow l[ine-by-line instructions](https://docs.docker.com/install/linux/docker-ce/debian/) found online with the caveat that whenever they write &ldquo;amd64&rdquo;, your need to substitute &ldquo;arm64&rdquo;. Also I find it handy to add myself to the &lsquo;docker&rsquo; group to avoid having to run docker as root:

<code>sudo usermod -a -G docker myusername</code>

