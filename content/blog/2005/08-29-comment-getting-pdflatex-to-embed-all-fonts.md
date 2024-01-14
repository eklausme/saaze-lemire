---
date: "2005-08-29 12:00:00"
title: "Getting pdflatex to embed all fonts"
index: false
---

[9 thoughts on &ldquo;Getting pdflatex to embed all fonts&rdquo;](/lemire/blog/2005/08-29-getting-pdflatex-to-embed-all-fonts)

<ol class="comment-list">
<li id="comment-2447" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/673f1b9729b3cbeb731f76d3bf9692b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/673f1b9729b3cbeb731f76d3bf9692b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yuhong YAN</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-08-29T20:45:25+00:00">August 29, 2005 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>You are really smart. On Windows it is similar as what you described here.</p>
</div>
</article>
</li>
<li id="comment-3484" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e962780de7b636bafd5b1c70019a2870?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e962780de7b636bafd5b1c70019a2870?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-12-18T11:50:20+00:00">December 18, 2005 at 11:50 am</time></a> </div>
<div class="comment-content">
<p>Thank you for this summary, it was very helpful as I was preparing a submission to a journal that wanted fonts embedded in the PDF. A few months later, tetex was updated and I noticed that it broke. Rerunning updmap as root was sufficient to fix the problem, the configuration files were untouched.</p>
</div>
</article>
</li>
<li id="comment-3546" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/66b1a6ca41de280e0de0d0ff0e41653c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/66b1a6ca41de280e0de0d0ff0e41653c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antonio Frisoli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-12-30T09:52:58+00:00">December 30, 2005 at 9:52 am</time></a> </div>
<div class="comment-content">
<p>Daniel, thank you very much for your clear summary, that works very well also under windows.<br/>
I would suggest to all authors that are used to work with latex to follow this procedure, rather than generating a ps file and then converting it to pdf.</p>
</div>
</article>
</li>
<li id="comment-3747" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JÃ¼rgen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-03-24T16:07:21+00:00">March 24, 2006 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>thanks a lot for that! I was looking for an easy way to achieve embedding fonts. Yours worked without any problems! </p>
<p>PS: For creating PS-Documents with all fonts embedded, one can use the parameter -Pdownload35 for dvips.</p>
</div>
</article>
</li>
<li id="comment-15892" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8cb9bf7c99556579c1540da02f3ffbb0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8cb9bf7c99556579c1540da02f3ffbb0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Faruque</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-16T06:26:01+00:00">July 16, 2006 at 6:26 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>It&rsquo;s nice to solve a hard problem by a few linux commands. Yes, my problem of font embedding (+ subsetting) is solved in this way. But I had problems with colored image. So, I opened it in GIMP and saved it as grayscale. Then I got right behavior from pdflatex.</p>
</div>
</article>
</li>
<li id="comment-16941" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Virgil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-28T15:37:49+00:00">July 28, 2006 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>Hi: Thanks for putting me on the right track.<br/>
In my Ubuntu Linux v 6.06 &#8212; Dapper (and LIKELY on debian Sarge also) the file updmap.cfg is automatically generated. It asks the user NOT to modify it, and look at the files in the directory /etc/texmf/updmap.d/ instead.<br/>
In that directory, the relevant file is: 00updmap.cfg<br/>
One can edit this file and set the option :<br/>
dvipsDownloadBase35 true<br/>
The other relevant options seem to have been set to &ldquo;embed all&rdquo; during installation:<br/>
pdftexDownloadBase14 true<br/>
dvipdfmDownloadBase14 true<br/>
The file contains plenty of comments explaining the various options. There are ways to overrule the file setting in specific cases.<br/>
AFTER MODIFYING THIS FILE one should run: update-updmap</p>
<p>I did the above with root (or sudo) privilege.</p>
<p>HtH.<br/>
Virgil</p>
</div>
</article>
</li>
<li id="comment-22603" class="pingback even thread-even depth-1">
<div class="comment-body">
Pingback: <a href="https://lemire.me/blog/2006/08/18/embedding-fonts-for-ieee/" class="url" rel="ugc">Embedding fonts for IEEE</a> </div>
</li>
<li id="comment-49175" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zepu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-09T13:01:30+00:00">February 9, 2007 at 1:01 pm</time></a> </div>
<div class="comment-content">
<p>Hi Jurgen,</p>
<p>Regarding the -Pdownload35 option of dvips, the manual also says the option -Ppdf makes dvips try to &ldquo;include Type 1 outline fonts&rdquo;. I don&rsquo;t know the relation between these two options.</p>
</div>
</article>
</li>
<li id="comment-49234" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c30f035d0d825ad4455e8e62889114c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c30f035d0d825ad4455e8e62889114c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian de Alwis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-04-10T12:48:05+00:00">April 10, 2007 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>Unfortunately this doesn&rsquo;t cause fonts in embedded images to be themselves embedded. For example, PDFs generated from Gnuplot use Helvetica by default. But <a HREF="http://www.cvpr.org/crc.html" rel="nofollow">the camera-ready prep</a> document from a conference named CPVR provides a Ghostscript processing command that does the trick:</p>
<p>gs -sDEVICE=pdfwrite -q -dBATCH -dNOPAUSE -dSAFER<br/>
-dPDFX<br/>
-dPDFSETTINGS=/prepress<br/>
-dAutoFilterColorImages=false -dColorImageFilter=/FlateEncode<br/>
-dAutoFilterGrayImages=false -dGrayImageFilter=/FlateEncode<br/>
-sOutputFile=ieee.pdf<br/>
-c &lsquo;&gt; setdistillerparams&rsquo;<br/>
-f cvpr06.pdf<br/>
-c quit</p>
</div>
</article>
</li>
</ol>
<p class="no-comments">Comments are closed.</p>
</div>
<nav class="navigation post-navigation" aria-label="Posts">
<h2 class="screen-reader-text">Post navigation</h2>
<div class="nav-links"><div class="nav-previous"><a href="https://lemire.me/blog/2005/08/29/am-i-too-critical-of-the-phd-track/" rel="prev"><span class="meta-nav" aria-hidden="true">Previous</span> <span class="screen-reader-text">Previous post:</span> <span class="post-title">Am I too critical of the Ph.D. track?</span></a></div><div class="nav-next"><a href="https://lemire.me/blog/2005/08/29/heres-why-we-are-soon-going-to-be-flooded-by-data/" rel="next"><span class="meta-nav" aria-hidden="true">Next</span> <span class="screen-reader-text">Next post:</span> <span class="post-title">Here&rsquo;s why we are soon going to be flooded by data</span></a></div></div>
</nav>
</main>
</div>
</div>
<footer id="colophon" class="site-footer">
<div class="site-info">
<a class="privacy-policy-link" href="https://lemire.me/blog/terms-of-use/" rel="privacy-policy">Terms of use</a><span role="separator" aria-hidden="true"></span> <a href="https://wordpress.org/" class="imprint">
Proudly powered by WordPress </a>
</div>
</div>
<script id="wp_power_stats-js-extra">
var PowerStatsParams = {"ajaxurl":"https:\/\/lemire.me\/blog\/wp-admin\/admin-ajax.php","ci":"YTo0OntzOjEyOiJjb250ZW50X3R5cGUiO3M6NDoicG9zdCI7czo4OiJjYXRlZ29yeSI7czoyOiI4NCI7czoxMDoiY29udGVudF9pZCI7aTo0MjY7czo2OiJhdXRob3IiO3M6NjoibGVtaXJlIjt9.724df8b1fc696b7a017c1668be2c2807"};
</script>
<script src="https://lemire.me/blog/wp-content/plugins/wp-power-stats/wp-power-stats.js" id="wp_power_stats-js"></script>
<script src="https://lemire.me/blog/wp-content/plugins/custom-css-js-php/assets/js/wcjp-frontend.js?ver=6.4.1" id="wcjp-frontend.js-js"></script>
<script src="https://lemire.me/blog/wp-content/themes/twentyfifteen/js/skip-link-focus-fix.js?ver=20141028" id="twentyfifteen-skip-link-focus-fix-js"></script>
<script id="twentyfifteen-script-js-extra">
var screenReaderText = {"expand":"<span class=\"screen-reader-text\">expand child menu<\/span>","collapse":"<span class=\"screen-reader-text\">collapse child menu<\/span>"};
</script>
<script src="https://lemire.me/blog/wp-content/themes/twentyfifteen/js/functions.js?ver=20221101" id="twentyfifteen-script-js"></script>
</body>
</html>
