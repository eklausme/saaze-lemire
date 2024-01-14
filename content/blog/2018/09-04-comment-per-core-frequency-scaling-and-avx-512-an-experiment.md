---
date: "2018-09-04 12:00:00"
title: "Per-core frequency scaling and AVX-512: an experiment"
index: false
---

[2 thoughts on &ldquo;Per-core frequency scaling and AVX-512: an experiment&rdquo;](/lemire/blog/2018/09-04-per-core-frequency-scaling-and-avx-512-an-experiment)

<ol class="comment-list">
<li id="comment-347022" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-04T23:56:18+00:00">September 4, 2018 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I think this is one of the improvements in Skylake-X &#8211; only the cores actually running the concerned instructions are affected: each cores can keep running at the license implied by their code, rather than the whole socket being affected.</p>
<p>On earlier chips with &ldquo;AVX turbo&rdquo; stuff (i.e., instruction-based downclocking) even one core running heavy stuff would affect the entire socket, if I remember correctly.</p>
</div>
</li>
<li id="comment-347125" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-05T09:55:24+00:00">September 5, 2018 at 9:55 am</time></a> </div>
<div class="comment-content">
<p>find /sys/ -name cpuinfo_cur_freq | xargs grep .</p>
</div>
</li>
</ol>
