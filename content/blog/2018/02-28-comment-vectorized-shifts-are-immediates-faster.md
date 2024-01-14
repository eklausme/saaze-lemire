---
date: "2018-02-28 12:00:00"
title: "Vectorized shifts: are immediates faster?"
index: false
---

[One thought on &ldquo;Vectorized shifts: are immediates faster?&rdquo;](/lemire/blog/2018/02-28-vectorized-shifts-are-immediates-faster)

<ol class="comment-list">
<li id="comment-297645" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-02T01:24:21+00:00">March 2, 2018 at 1:24 am</time></a> </div>
<div class="comment-content">
<p>For some reason, Intel has preserved the older form of the instructions.</p>
<p>That&rsquo;s not really weird at all. Of course once Intel introduces an instruction they are pretty much bound to support it forever, lest they break binary compatibility for any code using it.</p>
<p>As far as I know, Intel has never removed published x86 or x86-64 instructions once introduced (the same isn&rsquo;t the same for AMD which due to market dynamics did backtrack on things like 3DNow! and the XOP instruction sets to align with the Intel extensions instead).</p>
<p>It should be worth noting there are actually three levels of &ldquo;variability&rdquo; in the shift instruction:</p>
<p>1) Compiled-in immediate (i.e,. the amount to shift is fixed at compile time and applies to all elements).<br/>
2) Runtime amount but the same for all elements.<br/>
3) Runtime amount and may be different for all elements.</p>
<p>Conceptually there is a fourth possibility &ldquo;Compile-time immediate, may be different per element&rdquo; but it has never been supported (indeed, the immediate would huge).</p>
<p>You compared (1) and (3) and indeed on Skylake they are documented to have identical performance. Oddly, the (2) variant is slower than either. It seems that on Skylake, the variant (2) is implement by one uop to broadcast the shift amount to every element in some temporary register and then uses the same uop as the fully-variable shift (3), slowing it down by the extra uop.</p>
<p>In earlier uarches like Haswell, the situation was different: (1) and (2) had the same performance as Skylake (i.e., 2 slower than 1), but the fully variable shifts (3) were considerably slower, taking 3 uops each. On that platform using the immediate-operand shifts can help a lot.</p>
</div>
</li>
</ol>
