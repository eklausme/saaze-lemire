---
date: "2021-11-30 12:00:00"
title: "Can you safely parse a double when you need a float?"
index: false
---

[One thought on &ldquo;Can you safely parse a double when you need a float?&rdquo;](/lemire/blog/2021/11-30-can-you-safely-parse-a-double-and-then-cast-to-a-float)

<ol class="comment-list">
<li id="comment-610057" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65afcec90bf0285b8ec1827070de41a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65afcec90bf0285b8ec1827070de41a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Johannes Höhn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-06T12:25:56+00:00">December 6, 2021 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p>The conversion can be handy though if you want to output short strings in decimal format though.</p>
<p>For instance when writing an optimizer for SVG path strings you might want to change absolute positions into relative positions and vice versa.</p>
<p>You could be at the absolute position 0.1 and want to add the relative position 0.2. With doubles you will end up at 0.30000000000000004, as 0.1 and 0.2 cannot be exactly represented in binary floating point.</p>
<p>If you parse as double and do all calculations in double precision your error will be less than the precision of single precision. If you convert to single just before formatting, the formatting routine will look for the shortest decimal number within the precision of single precision.<br/>
You usually end up with the same result as with lossless decimal math.</p>
<p>It&rsquo;s important to remember that this trick relies on your binary floating point numbers just being storage for decimal floating point numbers with low precision.</p>
</div>
</li>
</ol>
