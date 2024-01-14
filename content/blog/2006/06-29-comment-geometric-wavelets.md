---
date: "2006-06-29 12:00:00"
title: "Geometric Wavelets"
index: false
---

[3 thoughts on &ldquo;Geometric Wavelets&rdquo;](/lemire/blog/2006/06-29-geometric-wavelets)

<ol class="comment-list">
<li id="comment-12114" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-06-30T14:17:09+00:00">June 30, 2006 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>This sounds interesting. Am I understanding this right: by splitting the region (say image) along straight lines, it&rsquo;s possible to find wavelets that encode the sub-regions with high fidelity. This technique can be successively applied to the resulting regions till you get a good enough encoding.</p>
<p>Sounds a little like simple mixture-of-experts setups with neural nets; a simple linear classification on top of more complex systems allows them specialize and produce better results.</p>
<p>I also saw some paper on face compression that used a technique of breaking up the image into rectangular regions and apply more sophisticated techniques to the sub regions. I think a similar thing is done with some forms of SVMs.</p>
<p>Seems like a general technique &#8211; break up the problem along simple linear lines, solve the sub-problems.</p>
</div>
</li>
<li id="comment-12120" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-06-30T14:37:11+00:00">June 30, 2006 at 2:37 pm</time></a> </div>
<div class="comment-content">
<p>Yes, though &ldquo;possible to find wavelets&rdquo; should read &ldquo;possible to find polynomials&rdquo;. The idea is to divide the image into smaller and small regions and to apply polynomial fitting over each subregion. The compression kicks in when you discard some of these small regions because fitting a polynomial over a subregion doesn&rsquo;t improve the (local) accuracy much.</p>
<p>Yes, it is a very general paradigm, one I work a lot with these days since I do time series segmentation.</p>
</div>
</li>
<li id="comment-17900" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efaf010470cba564b1106cdefdd3af03?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efaf010470cba564b1106cdefdd3af03?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saravanan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-08-01T23:27:59+00:00">August 1, 2006 at 11:27 pm</time></a> </div>
<div class="comment-content">
<p>Wavelets are very powerful and gives better result than other approximations. Wavelets will be the future, the processors very powerful, so we dont need to worry about the number of cycles, memory is also not a big issue nowadays.</p>
</div>
</li>
</ol>
