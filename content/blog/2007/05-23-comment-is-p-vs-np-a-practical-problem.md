---
date: "2007-05-23 12:00:00"
title: "Is P vs. NP a practical problem?"
index: false
---

[2 thoughts on &ldquo;Is P vs. NP a practical problem?&rdquo;](/lemire/blog/2007/05-23-is-p-vs-np-a-practical-problem)

<ol class="comment-list">
<li id="comment-49320" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f25186ce51e5b9a460ac6045df67747?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f25186ce51e5b9a460ac6045df67747?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-05-29T11:25:36+00:00">May 29, 2007 at 11:25 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>I think the issue is essentially relative scaling.</p>
<p>If you can solve an exponential problem, eg 2^n, with n bits, adding a single bit will double the required time, adding 10 bits will x1000, etc. So adding a few bits will make it intractable quite fast.</p>
<p>In linear time, adding a single bit will _add_ constant time. So if you could do it with n bit, you probably can do it with n+1 or n+10 bits.</p>
<p>So of course your example holds: there are some polynomial algorithms that won&rsquo;t run for high values of n. But as computing power and capacity increases, the situation is a lot more favourable with those. If you double you computing power, this will _double_ the size of problems you solve in linear time; you gain 19% with O(n^4), and 0.6% with O(n^120). In O(2^n) you will gain 1 bit&#8230;</p>
<p>Hope this makes sense.</p>
</div>
</li>
<li id="comment-49324" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Andre Vellino</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-06-01T14:18:53+00:00">June 1, 2007 at 2:18 pm</time></a> </div>
<div class="comment-content">
<p>Well, to use your analogy &#8211; do advances in General Relativity have any consequences for mining minerals on the moon? Maybe not &#8211; as far as we can tell right now. The point is &#8211; we don&rsquo;t actually know.</p>
<p>Suppose your N^4 algorithm could be parallelized and we harnessed 30,000 tera-flop computers to solve your problem, then your formerly impractical algorithm becomes feasible.</p>
<p>I think that&rsquo;s the point with knowing whether P=NP. It is true that there are some exp-time algorithms (e.g. Simplex for solving LP problems) which are nevertheless practical and some polynomial-time algorithms (e.g. Kamarkar&rsquo;s algorithm for the same LP problems) which are *impractical* because of the size of the constants in the exponent.</p>
<p>One valuable thing about knowing that LP is in the class P is that it at least offers the hope that there exists a feasible solution for large N, whereas knowing that it doesn&rsquo;t (and not knowing whether P=NP) sustains the hope that there is *no* feasible solution.</p>
</div>
</li>
</ol>
