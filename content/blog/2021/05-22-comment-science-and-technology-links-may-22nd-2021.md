---
date: "2021-05-22 12:00:00"
title: "Science and Technology links (May 22nd 2021)"
index: false
---

[4 thoughts on &ldquo;Science and Technology links (May 22nd 2021)&rdquo;](/lemire/blog/2021/05-22-science-and-technology-links-may-22nd-2021)

<ol class="comment-list">
<li id="comment-584861" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-24T00:14:51+00:00">May 24, 2021 at 12:14 am</time></a> </div>
<div class="comment-content">
<p>Re: claim 1: Actually, <a href="https://en.wikipedia.org/wiki/Dennard_scaling" rel="nofollow ugc">Dennard scaling</a> stopped working circa 2006 and reducing feature sizes no longer reduces power consumption. We are now well into the era of power-constrained (rather than transistor-constrained) silicon design.</p>
<p>It had a good 30-year run (1970s to 2000s), but it&rsquo;s very much stopped now.</p>
<p>The main problem is subthreshold leakage. Smaller transistors have thinner gate regions (smaller gate regions switch faster, a major benefit!), and quantum tunneling depends exponentially on the barrier thickness, even in a nominally impassible &ldquo;off&rdquo; transistor.</p>
<p>Modern ICs try to strike a balance between switching current and leakage current, but it&rsquo;s not easy.</p>
<p>(The <em>other</em> problem is tolerances. As feature sizes shrink, manufacturing variation becomes proportionally larger, making everything more difficult.)</p>
</div>
<ol class="children">
<li id="comment-584937" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-24T16:49:21+00:00">May 24, 2021 at 4:49 pm</time></a> </div>
<div class="comment-content">
<p>I do not think I invoked Dennard scaling. High resolution processes have usually translated into more speed and reduced power usage. If you want to argue against that statement, you have to argue that from process to process, a vendor such as TSMC has not, usually, reduced the power usage (for a given processing speed).</p>
</div>
<ol class="children">
<li id="comment-585126" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-26T06:53:17+00:00">May 26, 2021 at 6:53 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
If you want to argue against that statement, you have to argue that from process to process, a vendor such as TSMC has not, usually, reduced the power usage (for a given processing speed).
</p></blockquote>
<p>And that is exactly my claim. This is documented all over the place, e.g. <a href="https://www.realworldtech.com/intel-10nm-qwfet/" rel="nofollow ugc">What’s Next for Moore’s Law? For Intel, III+V = 10nm QWFETs</a><br/>
or <a href="https://semiengineering.com/power-challenges-at-10nm-and-below/" rel="nofollow ugc">Power Challenges At 10nm And Below</a>. (See also the link in the former to the coverage of the IEDM 2005 conference where the imminent demise of Dennard scaling was discussed in detail.)</p>
<p>More specifically, the statement &ldquo;Finer resolutions usually translate into lower energy usage and lower heat production.&rdquo; implies a causal connection, which hasn&rsquo;t been true for a long time.</p>
<p>Rather, contemporary process engineers have to find a <em>separate</em> way to reduce power consumption lest their super-small transistors be rendered useless.</p>
<p>The most obvious one in recent years has been FinFETs. And yes, FinFETs are normally sold in a bundle with geometries below a certain size in the same way that caches are included with processors above a certain clock speed, because it would be pointless otherwise.</p>
<p>But that&rsquo;s not because of the finer resolution; it&rsquo;s more &ldquo;in spite of&rdquo;.</p>
<p>As a crude software analogy, we all know perfectly well that the correlation between MHz and performance has been broken for some time.</p>
<p>In the same way, smaller transistors haven&rsquo;t caused lower power for quite a few years.</p>
<p>As the articles linked above describe, these days power dissipation per active transistor has plateaued, and designers wishing to use more transistors have to find ways to keep the addition &ldquo;dark&rdquo;, i.e. non-switching. It&rsquo;s straightforward to clock-gate unused cache banks, but other logic is trickier.</p>
</div>
<ol class="children">
<li id="comment-586703" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-10T21:51:26+00:00">June 10, 2021 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>&gt; As a crude software analogy, we all know perfectly well that the correlation between MHz and performance has been broken for some time.</p>
<p>I would still write that higher clock frequencies usually translate into higher performance.</p>
<p>&gt; And that is exactly my claim.</p>
<p>Let us be precise. Your claim is &quot;from process to process, a vendor such as TSMC has not, usually, reduced the power usage&quot;? Are you sure you want to stand by that claim?</p>
<p>You keep citing Dennard scaling but it is not a term that I seem to have ever used on this blog. At least, a keyword search does not find anything: <a href="https://lemire.me/blog/?s=Dennard" rel="ugc">https://lemire.me/blog/?s=Dennard</a></p>
<p>I have used it in comments at least once, however. In 2018, I wrote&#8230; &quot;An idea like Dennard scaling runs its course. Then something else comes along.&quot; <a href="https://lemire.me/blog/2018/07/21/science-and-technology-links-july-21st-2018/" rel="ugc">https://lemire.me/blog/2018/07/21/science-and-technology-links-july-21st-2018/</a></p>
<p>I searched for what I might have written in Dennard scaling over the years using Google. I submit to you that it is not a term that I tend to use. Note that I have been blogging weekly for almost 20 years. I write a lot.</p>
<p>&gt; But that’s not because of the finer resolution; it’s more “in spite of”.</p>
<p>The adoption of finer resolution processors usually translate into better energy efficiency (normalized by computational power). It is simply a long-running trend.</p>
<p>My post does not claim a causal link and it certainly does not invoke Dennard scaling (back in 2018 I alluded to the fact that it had run its course in a comment to another blog post). The phrase is <em>finer resolutions usually translate into lower energy usage and lower heat production</em>. That&#039;s not the wording I would have used if I meant to imply a causal relationship.</p>
<p>To disprove my statement, you have to plot power efficiency over time, process by process, and show that it is not improving. But, of course, it is improving.</p>
<p>Moore&#039;s law was not based on a &quot;causal relationship&quot; and yet it held for 30+ years.</p>
<p>I would say that Americans tend to be overweight. There is no causality between the fact that one is American and being overweight, but there is an association. Simply put, if you ask me who weight more, and I am only told that A is Japanese and B is American, I will vote B any day. But there are underweight Americans and obese Japaneses.</p>
<p>So it goes with processors&#8230; finer and finer processes tend to bring about power efficiency gains.</p>
<p>Maybe you thought that I was invoking Dennard scaling&#8230; but the evidence is strong that I have been aware for quite some time that it is not a factor.</p>
<p>We can reasonably discuss whether my implication will hold. Do you want to place a bet regarding the power efficiency of the next TSMC process? I bet that it will be at least 10% more power efficient.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
