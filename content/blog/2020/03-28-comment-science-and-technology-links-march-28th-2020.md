---
date: "2020-03-28 12:00:00"
title: "Science and Technology links (March 28th 2020)"
index: false
---

[5 thoughts on &ldquo;Science and Technology links (March 28th 2020)&rdquo;](/lemire/blog/2020/03-28-science-and-technology-links-march-28th-2020)

<ol class="comment-list">
<li id="comment-498374" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebfca553b3b7014cbf923542eb3c33bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebfca553b3b7014cbf923542eb3c33bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">J.L.Seagull</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-28T21:24:15+00:00">March 28, 2020 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>The US actually has 600,000 fewer beds today than it did in the 1970s. Here&rsquo;s a small discussion about some causes.</p>
<p><a href="https://twitter.com/ronmknox/status/1243173149954510849" rel="nofollow ugc">https://twitter.com/ronmknox/status/1243173149954510849</a></p>
</div>
</li>
<li id="comment-498390" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/434f10a650dac564db4cd18e78717ff6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/434f10a650dac564db4cd18e78717ff6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Tomas Singliar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-29T01:10:41+00:00">March 29, 2020 at 1:10 am</time></a> </div>
<div class="comment-content">
<p>I will believe deep learning algos performance when they demonstrate true generalization. Train them on one dataset and test on another with the same label and same semantics. See if the algorithm does as well on images from a different CT machine, for example.</p>
</div>
</li>
<li id="comment-498678" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/86a6c2b2bd1c4c3cf86fd9bbcc1e84f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/86a6c2b2bd1c4c3cf86fd9bbcc1e84f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ziv Caspi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-31T12:10:58+00:00">March 31, 2020 at 12:10 pm</time></a> </div>
<div class="comment-content">
<p>Re 8: Windows is not limited by 64 processors for over 10 years. You might be interested in watching the following link, in which the person who made the patch discusses how this was done: <a href="https://channel9.msdn.com/Shows/Going+Deep/Arun-Kishan-Farewell-to-the-Windows-Kernel-Dispatcher-Lock" rel="nofollow ugc">https://channel9.msdn.com/Shows/Going+Deep/Arun-Kishan-Farewell-to-the-Windows-Kernel-Dispatcher-Lock</a></p>
<p>(The grouping of processors to groups of 64 was mainly done for API &amp; app compatibility reasons &#8212; apps that &ldquo;declare&rdquo; themselves as capable of handling more certainly can get there.)</p>
</div>
</li>
<li id="comment-500410" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-08T03:15:04+00:00">April 8, 2020 at 3:15 am</time></a> </div>
<div class="comment-content">
<p>The news about thumb drives is doubly wrong.</p>
<p>The author is correct that, by convention, a charged floating MOSFET gate represents a binary 0, while a discharged one represents a binary 1.</p>
<p>However, flash memory is erased to the all-ones state. This is because discharging gates can only be done in large blocks (in the oldest UV EEPROMs, it required an external ionizing radiation source), but charging the gate can be done to selected bits.</p>
<p>So unused flash memory is kept in the discharged-gate state in order to be able to accept newly written data as quickly as possible.</p>
<p>The second error is that all of that does not affect the total number of electrons in the flash memory at all. The flash chip has zero net charge; any extra electrons in the floating gates are screened by missing electrons in the surrounding conductive structures, particularly the MOSFET channel. (Those missing electrons are the &ldquo;field effect&rdquo; in &ldquo;field effect transistor&rdquo; which are detected as part of the read process.)</p>
<p>So the mass of an individual electron is simply irrelevant; there is no net change to the number of electrons in the flash chip.</p>
<p>Now, <em>is</em> there any mass difference? Yes, but from a totally different source.</p>
<p>The separation of charges created by charging the floating gates stores potential energy. The electrons in the floating gates want to bind with the holes in the channel, but are prevented by the gate insulation. If you know the gate capacitance and the voltage, you can compute this as E = CV^2/2.</p>
<p>That potential energy (the reduction in the binding energy of the chip) turns out to have mass, by E = mc^2. (Lower-case c is the speed of light; upper-case is capacitance.)</p>
<p>So take the total number of bits on the flash memory (include all overhead and ECC bits, generally at least 16 extra per 512 bytes, but not spare sectors), assume half (N/2) are programmed, and work the numbers. m = NCV^2/2c^2.</p>
<p>(Most modern thumb drives use 4 or 8 voltage levels per bit to store 2 or 3 bits per transistor, so you have to sum over all the possible voltage levels.)</p>
</div>
<ol class="children">
<li id="comment-500457" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-04-08T12:58:02+00:00">April 8, 2020 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a fantastic comment.</p>
<p>Note that in the link I wrote &ldquo;might have&rdquo; and I am happy that I did. I should have thought right away that the total number of electrons in the disk could not change, since I have never heard of disks as being charged (globally).</p>
</div>
</li>
</ol>
</li>
</ol>
