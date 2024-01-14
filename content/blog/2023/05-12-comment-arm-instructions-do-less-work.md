---
date: "2023-05-12 12:00:00"
title: "ARM instructions do &#8220;less work&#8221;?"
index: false
---

[5 thoughts on &ldquo;ARM instructions do &#8220;less work&#8221;?&rdquo;](/lemire/blog/2023/05-12-arm-instructions-do-less-work)

<ol class="comment-list">
<li id="comment-651616" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99f6aeec9715bb034bba93ba2a7eb360?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99f6aeec9715bb034bba93ba2a7eb360?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nicolas Capens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-12T23:03:32+00:00">May 12, 2023 at 11:03 pm</time></a> </div>
<div class="comment-content">
<p>That looks like the difference between micro-ops and macro-ops. x86 instructions can include a load or store, which are broken up and scheduled separately.</p>
</div>
</li>
<li id="comment-651632" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/194e5f1d3b8256ab1b66188a3221caa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/194e5f1d3b8256ab1b66188a3221caa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jonathan Kang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-13T18:27:08+00:00">May 13, 2023 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>The key is that the x86 instructions that are most commonly used by compilers are relatively simple instructions and those are the instructions x86 vendors optimize their designs for.</p>
<p>The rare instructions that aren’t used very often are handled by firmware or microcode anyway.</p>
<p>So in the end, real x86 programs are pretty RISC anyway.</p>
</div>
</li>
<li id="comment-651633" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-13T18:38:53+00:00">May 13, 2023 at 6:38 pm</time></a> </div>
<div class="comment-content">
<p>There are some cases where availability of barrel shifter logic integrated to other instructions on ARM can really shine on microbenchmarks (talking of highly optimised inner loops consisting of dozen instructions or less); at the same time, lack of some specific instructions such as parallel bits extract and deposit can provide a significant benefit on x86. I wonder how things are on vectored instruction sets.</p>
</div>
<ol class="children">
<li id="comment-651634" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-13T18:41:01+00:00">May 13, 2023 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>Eh, availability of such instructions on x86, of course &#8211; and lack of them on ARM (at least Apple for now).</p>
</div>
</li>
</ol>
</li>
<li id="comment-651638" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b188d046267bb5cddbc457580551297d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b188d046267bb5cddbc457580551297d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-13T22:54:46+00:00">May 13, 2023 at 10:54 pm</time></a> </div>
<div class="comment-content">
<p>“ because ARM instructions are less powerful and do less work than x64 (Intel/AMD) instructions so that we have performance parity.”</p>
<p>Anyone who thinks this has not looked at ARM ISA in much detail and thinks aarch64 is classic RISC. It is not. If CISC is a state of being not RISC, then aarch64 is cisc. It has common instructions like load pair with autoincrement (updates 3GPRs. Such instructions are rare even in x86), alu operatons with shifts etc. There are some instructions in neon that have to be (sanely) implemented as a long sequence of ops.</p>
<p>There may be a case for this sort of argument against RISC-V, which sometimes needs 3instructions to do what one aarch64/x86 instruction does, like load with base+ scaled index+ displacement. Maybe it is an issue there.</p>
</div>
</li>
</ol>
