---
date: "2005-10-28 12:00:00"
title: "Comments are back! But you need to pass a reverse Turing test!"
---



I&rsquo;ve installed [Boriel&rsquo;s Capcha! Plugin](http://www.boriel.com/?page_id=17) in my copy of wordpress. &ldquo;Captcha&rdquo; is the acronym for <em>completely automated public Turing test to tell computers and humans apart</em> (see [wikipedia entry](https://en.wikipedia.org/wiki/Captcha)). It worked well so far, but I had two issues during the installation:

- The &ldquo;TMP Folder&rdquo; where images are stored must be inside a &ldquo;www&rdquo; directory otherwise, a broken link will appear instead of the image. The plugin assumes that your web site is served from the directory /something/www/&hellip; This was not my case, but I was able to fix the problem using a symbolic link (command ln).
- The &ldquo;TrueType Folder&rdquo; option must end with a slash &ldquo;/&rdquo; otherwise you will be told that fonts cannot be found.


Why use Boriel&rsquo;s plugin? I tried two others, Secureimage and Bot Check. At least Secureimage had the issue that the captcha images would not contain any text. After some investigation, it turns out that the problem is that it uses the <a href="http://www.imagemagick.org/" title="one of the best open source library of all times">ImageMagick library</a> assuming FreeType support: my server has ImageMagick but without FreeType support so it cannot do text annotations.

If you want to see whether this is a problem for you try to annotate an image using either the convert or mogrify command line utilities. You can recognize the problem by trying the following test:

<code>$ mogrify someimage.jpg -draw<br/>
'text 0,0 tata' someimage.jpg</code>

<code>mogrify: FreeTypeLibraryIsNotAvailable<br/>
(/usr/local/share/ghostscript/fonts/n0190<br/>
03l.pfb).</code>

Anyhow, I sure hope that crazy spamming is over!

