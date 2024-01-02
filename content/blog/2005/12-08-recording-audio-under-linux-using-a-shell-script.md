---
date: "2005-12-08 12:00:00"
title: "Recording audio under Linux using a shell script"
---



This morning, I wrote a small script to record audio using my USB microphone. I need the audio to be recorded using one channel only and to be compressed as a MP3 file. Here&rsquo;s the script:

<code>echo "Recording now. Press Ctrl-c to cancel"<br/>
rawrec -c 1 -d /dev/dsp1 temp.raw<br/>
lame -x -m m temp.raw $1<br/>
rm -f temp.raw<br/>
</code>

This is pretty close to what most GUI applications will do, but it has the benefit that I can taylor it the exact way I want. If I want the files to be automatically moved to a special directory, I can do it easily. If I want the files to be uploaded to my blog automatically, I can do it.

Oh! Did I mention that this script is bug-free? As long as lame and rawrec are bug-free, and they mostly are, I work with perfect software.

Yes, I love scripting. It is friendlier.

