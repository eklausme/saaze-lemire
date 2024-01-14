---
date: "2005-10-12 12:00:00"
title: "Logitech USB Desktop Microphone under Linux"
---



I got my new Logitech USB Desktop Microphone working under Linux. Should have been very easy, but I hit a small nail.

Plug the device in and type &ldquo;lsusb&rdquo;, you should see:

<code>Bus 001 Device 004: ID 0556:0001 Asahi Kasei Microsystems Co., Ltd AK5370 I/F A/D Converter</code>

Ah! The device is called AK5370.

Do &ldquo;dmesg&rdquo;&lsquo; you should see two lines like those:

<code>usb 1-3: new full speed USB device using ohci_hcd and address 4<br/>
</code>

<code>usbcore: registered new driver snd-usb-audio<br/>
</code><br/>
If you don&rsquo;t see the second line, you have a problem. In my case, I didn&rsquo;t have the usbaudio driver so I only got the first line. I had to go compile usbaudio. To do so, I did &ldquo;uname -a&rdquo;, it gave me &ldquo;Linux romeo 2.6.10-gentoo-r6&rdquo;. I went under /usr/srclinux-2.6.10-gentoo-r6 and typed
<code>genkernel --no-clean --menuconfig all<br/>
</code>

Next, after the menu opened up, I went under driver/audio and chose usb audio drivers (and loadable modules). Exiting genkernel launched the compilation of the module and all I had to do was to unplug/replug my microphone. You should check that /dev/dsp1 appears.

All I had to do after this was to launch mhwaveedit and choose &ldquo;hw:1,0&rdquo; as my recording device, so that I would not record out of my sound card, but rather from my microphone. Setting the sampling rate to 44100 Hz seemed to be necessary.

To enable the microphone under KDE, you have to launch kmix and choose the appropriate device, if you don&rsquo;t see the device, quit kmix (through the file menu) and restart it. This being said, I don&rsquo;t see why you need the microphone under KDE. However, make sure you turn the gain all the way to the maximum for optimal sound quality.

VoilÃ ! Isn&rsquo;t Linux friendly?

For recording tips, see this page by Bob Cunningham.

__Update__: sometime you might have to force the drive to load up doing &ldquo;modprobe snd-usb-audio&rdquo;. In theory, modprobe shouldn&rsquo;t be necessary as devices should be automatically recognized, but it happens to me sometimes that I need to help my kernel a bit. (Bugs?)

