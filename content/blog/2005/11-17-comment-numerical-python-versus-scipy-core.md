---
date: "2005-11-17 12:00:00"
title: "Numerical Python versus SciPy core"
index: false
---

[2 thoughts on &ldquo;Numerical Python versus SciPy core&rdquo;](/lemire/blog/2005/11-17-numerical-python-versus-scipy-core)

<ol class="comment-list">
<li id="comment-3306" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a66ae78ea89fe7a47c95c0a8105ec6a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a66ae78ea89fe7a47c95c0a8105ec6a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Tristram Brelstaff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-19T04:21:07+00:00">November 19, 2005 at 4:21 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d feel tempted to create an intermediate module LinearAlgebra.py just containing the single line &ldquo;import scipy.linalg.*&rdquo;. I agree that such naming issues can be very annoying. It is very 1960&rsquo;s FORTRAN to abbreviate names to six characters.</p>
</div>
</li>
<li id="comment-3547" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Travis Oliphant</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-12-31T02:50:57+00:00">December 31, 2005 at 2:50 am</time></a> </div>
<div class="comment-content">
<p>The inline docstrings are *not* missing. Everything from Numeric is there along with new docstrings for new functionality. Please don&rsquo;t spread misinformation. </p>
<p>You may disagree with the name changes. If you do, chime in on the mailing lists and let your voice be heard. We are very responsive to users. </p>
<p>If there is enough demand for it, it would be extremely easy to create compatibility modules. </p>
<p>The reality is nobody is maintaing Numeric anymore. While it is still useful, it is dying. It will not keep up with newer versions of Python. The great thing about open source is you can still use it if you want, but your peers are moving to something else.</p>
</div>
</li>
</ol>
