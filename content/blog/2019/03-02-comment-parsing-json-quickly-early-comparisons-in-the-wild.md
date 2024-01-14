---
date: "2019-03-02 12:00:00"
title: "Parsing JSON quickly: early comparisons in the wild"
index: false
---

[12 thoughts on &ldquo;Parsing JSON quickly: early comparisons in the wild&rdquo;](/lemire/blog/2019/03-02-parsing-json-quickly-early-comparisons-in-the-wild)

<ol class="comment-list">
<li id="comment-392424" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T02:48:56+00:00">March 2, 2019 at 2:48 am</time></a> </div>
<div class="comment-content">
<p>Some of the python guys are already exposing interesting possibilities of &lsquo;partial&rsquo; or lazy materialization of the JSON into the language. What they are doing at <em>this</em> stage is just suppressing the sometimes expensive construction of things in the language (we are still parsing everything under the hood). But it might later be a nice hook to explore lazy materialization in more detail.</p>
<p>Small files are still a work in progress. I don&rsquo;t want to break performance properties there, but I&rsquo;m a bit skeptical that a workload that&rsquo;s over in a microsecond or so is even properly measured by our infrastructure. That&rsquo;s a good one for a HELP WANTED tag.</p>
</div>
</li>
<li id="comment-392493" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9aa954b07c28dd907249bfa7ab30e6e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9aa954b07c28dd907249bfa7ab30e6e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/btbytes" class="url" rel="ugc external nofollow">Pradeep Gowda</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T14:23:37+00:00">March 2, 2019 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>along with the libraries in various languages, one popular json tool is jq (<a href="https://github.com/stedolan/jq" rel="nofollow ugc">https://github.com/stedolan/jq</a>).</p>
<p>jq is part of many data processing pipelines, and a boost to jq&rsquo;s processing speeds via simdjson would be a great thing to see.</p>
</div>
<ol class="children">
<li id="comment-392498" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T14:37:23+00:00">March 2, 2019 at 2:37 pm</time></a> </div>
<div class="comment-content">
<p>I agree, this seems worthwhile. Anyone wants to look at it?</p>
</div>
</li>
</ol>
</li>
<li id="comment-392494" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T14:27:15+00:00">March 2, 2019 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>I wonder how it would perform if the 256 bit instructions were emulated by four (or more) non-simd 64 bit instructions.</p>
<p>While not optimal, performance may be good compared to bytewise implementions. It still processes more bytes in parallel and has low data dependencies.</p>
</div>
<ol class="children">
<li id="comment-392496" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T14:33:14+00:00">March 2, 2019 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>I agree that it is an interesting question.</p>
</div>
<ol class="children">
<li id="comment-392497" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T14:33:58+00:00">March 2, 2019 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>In the paper, we provide a &ldquo;model&rdquo; (using linear regregression) and from this model it should be possible to reason about such things.</p>
</div>
</li>
</ol>
</li>
<li id="comment-392515" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T19:11:47+00:00">March 2, 2019 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>Note that the width is only part of the story. Some SIMD instructions are just very slow to emulate with scalar instructions because there is no scalar instruction equivalent. Consider for example PSHUFB, which effectively acts as 32 parallel lookups in a 16-entry table, and no doubt features heavily in simdjson (I could be wrong, but let&rsquo;s be realistic: we&rsquo;re talking about Geoff &ldquo;middle name PSHUFB&rdquo; Langdale and Daniel &ldquo;always looking for a new place to apply PSHUFB&rdquo; Lemire here).</p>
<p>Using 64-bit instructions, <em>assuming a 64-bit PSHUFB existed</em>, you can only process (look up) 8 bytes at a time, which is the 4x reduction due to width, but also now your lookup table is only 8 entries, so if you actually needed 16-entry tables, you may have to do two lookups and a bunch of merging or something like that. So this is a case where a width reduction has a quadratic rather than linear effect (it&rsquo;s 4 * 2 not 4 * 4 because of the in-lane behavior of PSHUFB in AVX2 but that&rsquo;s not fundamental).</p>
<p>Even that scenario is only a fantasy though! There is of course no 64-bit scalar PSHUFB instruction: those kind of shuffle instructions generally only exist in the SIMD extensions in the first place. So how are you going to emulate PSHUFB with basic scalar operations you&rsquo;d find in any ISA. It&rsquo;s going to be really slow (unless there is some trick I&rsquo;m missing).</p>
<p>This is why SIMD algorithms often look very different to their scalar counterparts: it&rsquo;s not just width that&rsquo;s the difference &#8211; but rather whole operations are not available on both sides of the fence.</p>
<p>This difference flows both ways too! There are scalar techniques that don&rsquo;t scale to SIMD, such as many things involving loads (e.g., larger lookup tables) or loops with divergent control flow per iteration. There are also scalar operations not even available in SIMD on x86 like the carry-less multiply thing, 64&#215;64-&gt;128 multiplication, pdep and pext and various other bit-bashing ops (although future AVX-512 extensions should add some of these).</p>
</div>
</li>
</ol>
</li>
<li id="comment-392516" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-02T19:18:39+00:00">March 2, 2019 at 7:18 pm</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the most efficient general purpose PSHUFB emulation with scalar instructions is actually an interesting question by itself&#8230;</p>
<p>The baseline could be something like writing out the input bytes to memory, and then iterating over each 4-bit control in the shuffle mask using it to look up the corresponding byte in the output and storing it, (storing either byte-by-byte or in 64-bit chunks with some shift + OR to build the elements to store).</p>
<p>So for 32-byte PSHUFB you are looking at 32 loads plus a bunch of other stuff, probably around 100 instructions at a minimum for this approach!</p>
</div>
<ol class="children">
<li id="comment-393887" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-10T08:30:56+00:00">March 10, 2019 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>It would be amusing to try to emulate PSHUFB with a shift and a conditional move. I think the load solution would be faster, though. You could merge 2 4-bit values together and look up a 256-way table, so only 16 loads. Also you might need to emulate the high-bit behavior.</p>
<p>This is, however, silly. To substitute the use of PSHUFB in simdjson one would just look up 8-bit values in an 8-bit table with scalar code. This would be way faster than faking up SWAR replacements for SIMD.</p>
<p>The SWAR approach to searching for <em>particular</em> bytes is reasonable &#8211; some silliness with carry, add and multiply and off you go. This was still worth doing in Hyperscan. There might be some arguably clever SWAR&rsquo;isms for some of the other bits and pieces in simdjson, but I can&rsquo;t imagine why you would want to do this.</p>
<p>All that being said a scalar stage 1 would almost certainly perform best if built from scratch. I make a similar argument with ARM NEON.</p>
</div>
</li>
</ol>
</li>
<li id="comment-394215" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-11T21:13:15+00:00">March 11, 2019 at 9:13 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
This is, however, silly. To substitute the use of PSHUFB in simdjson<br/>
one would just look up 8-bit values in an 8-bit table with scalar<br/>
code. This would be way faster than faking up SWAR replacements for<br/>
SIMD.
</p></blockquote>
<p>Agreed, although it still supports my original point: which is that it can be misleading to look at say 256-bit wide SIMD and then suppose a 4x drop in efficiency when moving to 64-bit scalar instructions, because some SIMD patterns suffer a much larger drop: in the case of single-byte lookups as you suggest, it&rsquo;s roughly a 32x gap.</p>
<p>So yeah, you&rsquo;d not want to emulate PSHUFB directly in a scalar version of simdjson, but it did make me curious what the scalar emulation <em>would be</em> which is interesting in various scenarios like source-compatible emulation of SIMD intrinsics on platforms that don&rsquo;t support them, <a href="https://github.com/nemequ/simde" rel="nofollow">like this</a>.</p>
</div>
</li>
<li id="comment-423932" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Twirrim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-15T09:39:54+00:00">August 15, 2019 at 9:39 am</time></a> </div>
<div class="comment-content">
<p>I bought an cheap laptop to use while traveling, which comes with a low performance AMD A6-9225 CPU, and thought I&rsquo;d give simdjson a shot, in part because I was curious about SSE performance.</p>
<p><code>simdjson : 4.027 cycles per input byte (best) 4.156 cycles per input byte (avg) 0.644 GB/s (error margin: 0.020 GB/s)<br/>
rapid : 9.478 cycles per input byte (best) 9.828 cycles per input byte (avg) 0.274 GB/s (error margin: 0.010 GB/s)<br/>
sasjon : 9.025 cycles per input byte (best) 11.105 cycles per input byte (avg) 0.288 GB/s (error margin: 0.054 GB/s)<br/>
simdjson (just parse) : 4.006 cycles per input byte (best) 4.103 cycles per input byte (avg) 0.648 GB/s (error margin: 0.015 GB/s)<br/>
rapid (just parse) : 8.303 cycles per input byte (best) 10.494 cycles per input byte (avg) 0.312 GB/s (error margin: 0.065 GB/s)<br/>
sasjon (just parse) : 7.871 cycles per input byte (best) 10.036 cycles per input byte (avg) 0.330 GB/s (error margin: 0.071 GB/s)<br/>
simdjson (just dom) : 0.620 cycles per input byte (best) 0.726 cycles per input byte (avg) 4.175 GB/s (error margin: 0.609 GB/s)<br/>
rapid (just dom) : 1.138 cycles per input byte (best) 1.510 cycles per input byte (avg) 2.278 GB/s (error margin: 0.562 GB/s)<br/>
sasjon (just dom) : 0.610 cycles per input byte (best) 0.809 cycles per input byte (avg) 4.249 GB/s (error margin: 1.044 GB/s)<br/>
</code></p>
<p>Not bad at all, even on this slow chip it&rsquo;s pushing 0.6GB/s, and seeing more than a 2x performance increase over the next fastest.</p>
</div>
<ol class="children">
<li id="comment-424063" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-15T23:34:54+00:00">August 15, 2019 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for trying it out.</p>
</div>
</li>
</ol>
</li>
</ol>
