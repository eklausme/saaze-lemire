---
date: "2005-08-23 12:00:00"
title: "Now you can prepare your math slides using MathML!!!"
index: false
---

[5 thoughts on &ldquo;Now you can prepare your math slides using MathML!!!&rdquo;](/lemire/blog/2005/08-23-now-you-can-prepare-your-math-slides-using-mathml)

<ol class="comment-list">
<li id="comment-16508" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-24T12:18:07+00:00">July 24, 2006 at 12:18 pm</time></a> </div>
<div class="comment-content">
<p>&gt; while math formulas in presentations are nice, mathml support is limited</p>
<p>I&rsquo;m not sure what you mean by &ldquo;mathml support is limited&rdquo;. Mathml is supported in Firefox and IE (with plug-in) and presumably in other browsers.</p>
<p>&gt; mathml rendering in firefox is rather ugly. </p>
<p>Could you make this a bit more precise? Naturally, the quality of the display will depend on the quality of the fonts, but other than that, it looks alright here.</p>
<p>&gt; an alternative solution that is portable across all browsers is to include small pngs </p>
<p>This is where we were at in the nineties. It lacks technical elegance. </p>
<p>There are many problems with this solution. Some of them are:</p>
<p>&#8211; it requires more preprocessing (slows down your work) to generate the images<br/>
&#8211; it divides up the file into numerous small images (increases latency)<br/>
&#8211; the font size and color is fixed<br/>
&#8211; printing bitmaps is a bad idea<br/>
&#8211; it is hard to index texts with bitmaps all over the place (think &ldquo;Google&rdquo;)</p>
<p>I&rsquo;m not saying it is not workable. I use it currently for a course I&rsquo;m preparing using the SPIP content-management system. It works quite well and I&rsquo;m pleased. All the image generation is handled for me and auto-updated.</p>
<p>However it remains a hack.</p>
<p>(&#8230;). check out <a href="http://people.ee.ethz.ch/~pcattin/SIP/2-Fundamentals.html" rel="nofollow ugc">http://people.ee.ethz.ch/~pcattin/SIP/2-Fundamentals.html</a> to see how it is looking&#8230;</p>
<p>It looks good, except that all equations are displayed as black rectangles (under Firefox/Linux).</p>
</div>
</li>
<li id="comment-16513" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-24T12:48:52+00:00">July 24, 2006 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>&gt; you are too fast!</p>
<p>I&rsquo;m on Internet time? Or maybe I&rsquo;m filling out a funding application<br/>
and I&rsquo;m bored. Take your pick. 😉</p>
<p>(I guess *very* bored when filling out funding applications. I just<br/>
prefer doing the damn research rather than telling people what I plan<br/>
to do once I&rsquo;m done telling them what I plan to do.)</p>
<p>I took a look at your web page, btw. We have some common interests.<br/>
Any chance you might setup a blog?</p>
<p>&gt; &gt; I&rsquo;m not sure what you mean by &ldquo;mathml support is limited&rdquo;.<br/>
&gt; yes, but authoring tools are not that wide-spread, (&#8230;)</p>
<p>Good point. I thought you meant client-side.</p>
<p>MathML suffers from a rather unfriendly design making it difficult ot<br/>
write MathML by hand. Even &ldquo;ax+b=1&rdquo; takes forever in MathML!!!</p>
<p>&gt; it looks alright, but comparing mathml rendering with latex rendering i<br/>
&gt; think that latex rendering is far superior.</p>
<p>Which is why I generate PDF files for my presentations. Not that I<br/>
have the nicest framework in the world, but PPower4 is alright. To a<br/>
point.</p>
<p>Some years ago, I was ahead of the game, but now, I&rsquo;m starting to see<br/>
many people with nicer PDF slides. Heck! Your HTML slides are nicer<br/>
than my PDF slides, it seems.</p>
<p>In short, I&rsquo;m looking for other options.</p>
<p>&gt; are you sure that google has a problem with many embedded images?</p>
<p>As a matter of principle, replacing equations by images makes the<br/>
whole thing harder to (automatically) parse and to index. Maybe it<br/>
doesn&rsquo;t make a difference with Google, but I&rsquo;m trying to make a point<br/>
that it is less elegant.</p>
<p>Now, there is a counter-argument to this you could have used: the<br/>
&ldquo;alt&rdquo; tag, used properly, can help. SPIP does that.</p>
</div>
</li>
<li id="comment-16502" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65c73d5a7ec4c2341aab221b1a6ab602?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65c73d5a7ec4c2341aab221b1a6ab602?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dret.net/netdret/" class="url" rel="ugc external nofollow">Erik Wilde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-07-24T11:43:31+00:00">July 24, 2006 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>hi there.</p>
<p>while math formulas in presentations are nice, mathml support is limited and mathml rendering in firefox is rather ugly. an alternative solution that is portable across all browsers is to include small pngs with rendered formulas. firefox&rsquo;s ridiculously lousy image scaling makes this also not look to good, but in browsers with decent anti-aliasing (like opera), the results look very good.</p>
<p>the tool i am talking about is formulatex (<a href="http://dret.net/projects/xslidy/formulatex/" rel="nofollow ugc">http://dret.net/projects/xslidy/formulatex/</a>), it is an extension of xslidy (<a href="http://dret.net/projects/xslidy/" rel="nofollow ugc">http://dret.net/projects/xslidy/</a>) and uses latex and some other platform-neutral tools to produce portable and good-looking presentations with formulas. check out <a href="http://people.ee.ethz.ch/~pcattin/SIP/2-Fundamentals.html" rel="nofollow ugc">http://people.ee.ethz.ch/~pcattin/SIP/2-Fundamentals.html</a> to see how it is looking&#8230;</p>
<p>cheers,</p>
<p>dret.</p>
</div>
</li>
<li id="comment-49192" class="pingback odd alt thread-odd thread-alt depth-1">
<div class="comment-body">
Pingback: Tips on being a successful PhD student! </div>
</li>
<li id="comment-50303" class="pingback even thread-even depth-1">
<div class="comment-body">
Pingback: <a href="https://mhthanh.wordpress.com/2008/11/25/daniel-lemires-blog/" class="url" rel="ugc external nofollow">Daniel Lemire&rsquo;s blog &laquo; bá»™ Ä‘á»™i</a> </div>
</li>
</ol>
