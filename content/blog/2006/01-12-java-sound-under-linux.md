---
date: "2006-01-12 12:00:00"
title: "Java Sound under Linux"
---



I&rsquo;m having fun with Java Sound under Linux, though my troubles are probably not Linux specific. My setup is that I have a sound card plus a USB microphone. Both are correctly configured and I have the two devices appear as /dev/dsp and /dev/dsp1. Using kamix, I initially made sure that the alsa mixer was configured properly so that you can only record on /dev/dsp1 and only ouput on /dev/dsp. However, I recently changed it so that /dev/dsp can also serve as a recording device (the gain is non-zero). Tools like rawrec work just fine, though, in order to record with the default alsa recording tool, I need to specify my recording device:

<code>/usr/bin/arecord -t wav test.wav -D hw:1 -f S16_LE</code>

Tools like mhwaveedit also work fine, as long as I specify a quantization of 16 bits and hw:1 as the device. Don&rsquo;t ask me what hw stands for! I just know that hw:1 points to the second audio device whereas hw:0 probably points to the first one. These people have done a bit too much C programming: please count starting at 1 people! Not everyone knows that the first device ought to be labelled 0.

Anyhow. As it turns out, recent versions of Java (Java 1.4 and up) have decent support for audio builtin. If you want it to work with applets, you need to create a file called .java.policy in your user directory. The following content is probably highly insecure and dangerous, but it will get you going:

<code>grant{<br/>
permission java.io.FilePermission "< <ALL FILES>>", "read,write";<br/>
permission javax.sound.sampled.AudioPermission "record";<br/>
permission javax.sound.sampled.AudioPermission "play";<br/>
permission java.util.PropertyPermission "*", "read";<br/>
};<br/>
</code>

Notice that after you change this file, you should restart your browser to make absolutely sure the changes are registered!

If you are using Firefox, you can type &ldquo;about:plugins&rdquo; in the URL bar to see which Java your machine uses. You can also check the file &ldquo;~/.mozilla/firefox/pluginreg.dat&rdquo;. To test your setup, here&rsquo;s a nice applet:

[Java Sound Applet](http://web.physik.rwth-aachen.de/admin/err-404.html)

Or, if you are more ambitious, you can try the [webhuddle](https://webhuddle.com/) applet though it is more complex to get it started.

Unfortunately, I can&rsquo;t record using these applets after fiddling a bit, tt tells me &ldquo;Line matching interface TargetDataLine supporting format &hellip;, not supported&rdquo; (great English!).

I still wanted to make sure I could, indeed, record under Java and that the problem was indeed in the applets! For such purposes, you can download some cool software at the [Java Sound FAQ](http://www.jsresources.org/faq_general.html). For example, with my current setup, I&rsquo;m able to record audio using a Java command line tool:

<code>java AudioRecorder -f S16_LE -c 1 -r 8000 -t wav -M "default [plughw:1,0]" file.wav</code>

It took me some doing to figure out what my USB Microsoft was called (which is &ldquo;default [plughw:1,0]&rdquo;). Here&rsquo;s what the tool told me my my devices were:

<code>>java AudioRecorder -l<br/>
Available Mixers:<br/>
V8237 [plughw:0,0]<br/>
V8237 [plughw:0,1]<br/>
default [plughw:1,0]<br/>
Java Sound Audio Engine<br/>
Port V8237 [hw:0]<br/>
Port default [hw:1]</code>

I knew V8237 refers to my builtin sound card so my USB microphone had to be called &ldquo;default&rdquo;. I&rsquo;m hoping smart software would choose the device whose name start with &ldquo;default&rdquo; as the most sensible default&hellip;? But even if it selects some other input device, shouldn&rsquo;t it at least record noise?

