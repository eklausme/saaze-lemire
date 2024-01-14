---
date: "2019-05-15 12:00:00"
title: "Bitset decoding on Apple&#8217;s A12"
index: false
---

[13 thoughts on &ldquo;Bitset decoding on Apple&#8217;s A12&rdquo;](/lemire/blog/2019/05-15-bitset-decoding-on-apples-a12)

<ol class="comment-list">
<li id="comment-406914" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-16T00:06:25+00:00">May 16, 2019 at 12:06 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
&ldquo;you have to reverse the bit order and use a “leading zero” instruction&rdquo;
</p></blockquote>
<p>Would it be possible to isolate the lowest set bit? <code>x &amp; (-x)</code><br/>
The lzcnt of a &ldquo;1-hot&rdquo; should be just as good as a tzcnt?<br/>
One could then xor/sub the isolated bit with the source word to clear the that bit.</p>
</div>
<ol class="children">
<li id="comment-406915" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-16T00:08:06+00:00">May 16, 2019 at 12:08 am</time></a> </div>
<div class="comment-content">
<p>True: you do not need to reverse the bits, you can skin this cat some other way, but it is harder to do it while saving instructions.</p>
</div>
</li>
<li id="comment-407255" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T17:31:14+00:00">May 17, 2019 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>Using tmp = (bits &#8211; tmp) &amp; (tmp &#8211; bits); bits = bits &#8211; tmp; for finding and clearing the next set bit should be faster (2 cycle latency) than the most obvious sequence.</p>
</div>
<ol class="children">
<li id="comment-582330" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-17T02:51:43+00:00">April 17, 2021 at 2:51 am</time></a> </div>
<div class="comment-content">
<p>This seems to generate three instructions&#8230;</p>
<pre><code> lowest = (bits - lowest)
     &amp; (lowest - bits);
</code></pre>
<p>So that&rsquo;s 3 in latency, no?</p>
<p>Update: as pointed out by Travis, this has a total of 2 cycle of latency due to parallelism&#8230; but if we have anything else in the loop that updates bits, then we get to three cycles.</p>
</div>
<ol class="children">
<li id="comment-582331" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-17T03:06:59+00:00">April 17, 2021 at 3:06 am</time></a> </div>
<div class="comment-content">
<p>The two subtractions are independent so can execute in parallel, so total latency 2.</p>
</div>
<ol class="children">
<li id="comment-582371" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-17T14:16:25+00:00">April 17, 2021 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>But it is followed by bits = bits &#8211; lowest (at least in how Wilco described it) and that depends on lowest.</p>
</div>
<ol class="children">
<li id="comment-582372" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-17T14:31:47+00:00">April 17, 2021 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p>I guess that the idea is that the compiler should be able to merge all of this, into 3 instructions in total?</p>
</div>
<ol class="children">
<li id="comment-582393" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://travisdowns.github.io" class="url" rel="ugc external nofollow">Travis Downs</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-17T21:57:23+00:00">April 17, 2021 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think Wilco is imagining any merging (although x86 BMI does have a <code>BLSI</code> which does the <code>x &amp; -x</code> in one instruction, latency 1 on Intel, but 2 on AMD).</p>
<p>Yes, the chain from <code>bits</code> as input, to <code>bits</code> as output is 3 cycles here (assuming no merging):</p>
<p><code>lowest = (bits - lowest) &amp; (lowest - bits);<br/>
bits = bits - lowest;<br/>
</code></p>
<p>However the unrolled code in question is something like:</p>
<p><code>lowest = (bits - lowest) &amp; (lowest - bits);<br/>
result[i] = tz(lowest);<br/>
bits2 = bits - lowest;<br/>
lowest = (bits2) &amp; (lowest - bits);<br/>
result[i+1] = tz(lowest);<br/>
bits = bits2 - lowest;<br/>
lowest = (bits) &amp; (lowest - bits2);<br/>
...<br/>
</code></p>
<p>The dependency chain is only 2 cycles for each result. Essentially the <code>bits = bits - lowest</code> is both the end of one result and the first part of the next.</p>
</div>
<ol class="children">
<li id="comment-582396" class="comment byuser comment-author-lemire bypostauthor even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-17T23:32:06+00:00">April 17, 2021 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>That works. I think you can code it like so&#8230;</p>
<pre><code>  lowest = 0
  for (...) {
      // we make a 'copy' of lowest, but it should not be compiled as a copy
      uint64_t tmp = lowest;
      // the next two line can execute at the same time
      lowest = (lowest - bits);
      bits = (bits - tmp);
      // then we finish updating 'lowest', in a second cycle
      lowest &amp;= bits;
      ... then use lowest to identify the bit location (with clz)
  }
</code></pre>
<p>It works but at least on my Apple M1, it is not particularly fast.</p>
</div>
<ol class="children">
<li id="comment-582397" class="comment odd alt depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-18T00:20:11+00:00">April 18, 2021 at 12:20 am</time></a> </div>
<div class="comment-content">
<p>Something like that. I am surprised it performs poorly. You may have to check the assembly to ensure the generated code is as you expect.</p>
</div>
<ol class="children">
<li id="comment-582406" class="comment byuser comment-author-lemire bypostauthor even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-18T01:29:47+00:00">April 18, 2021 at 1:29 am</time></a> </div>
<div class="comment-content">
<p>I did not write that it performed poorly.</p>
<p>I posted the numbers at <a href="https://github.com/simdjson/simdjson/pull/1546" rel="nofollow ugc">https://github.com/simdjson/simdjson/pull/1546</a></p>
<p>It seems to exactly match the &ldquo;rbit/clz for every bit&rdquo; routine in terms of performance.</p>
<p>I have an isolated benchmark with instrumentation at&#8230;<br/>
<a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/05/03" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/05/03</a></p>
<p>It is the same instruction count (roughly). But they all seem to max out at 4 instructions/cycle on the M1/clang 12.</p>
</div>
</article>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-407276" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T20:34:13+00:00">May 17, 2019 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>I think at this point it is generally accepted that A12 has higher IPC than Skylake on most scalar code. High end Skylake models may still have higher overall single threaded performance than any A12 because they run at a higher frequency than the fastest A12s.</p>
<p>Processor architects will tell you (even if you didn&rsquo;t ask) that you can&rsquo;t compare designs on the basis of IPC alone, because higher frequency designs may sacrifice IPC to get there, so you can&rsquo;t really talk about an &ldquo;A12 running at 5 GHz&rdquo; because such a thing may not be possible (it would require a different design).</p>
<blockquote><p>
To be certain, I would need to be able to measure the number of cycles elapsed directly in my code.
</p></blockquote>
<p>A typical approach is to calibrate based on a measurement with a known timing. I usually use a series of dependent adds or a series of stores. Dependent adds take 1 cycle each, so by timing a long string of those you can calculate CPU frequency. Stores are similar: running at one per cycle (in L1) on recent Intel CPUs, but I think the A12 can do 2 per cycle! In any case, adds are probably easier: you&rsquo;ll immediately see if you get a reasonable result or not. In my experience this technique done carefully gives you a very accurate calibration (i.e., far better than 1%) &#8211; able to even measure temperature related drift in clock timing!</p>
<p>An iPad is a better target than an iPhone since it suffers less thermal throttling. Maybe put it in the freezer first :).</p>
<blockquote><p>
Of course, I could get myself a top-notch Qualcomm or Samsung processor and install Linux on it, and I may end up doing just that.
</p></blockquote>
<p>I would also be an interesting exercise, but my impression is the A12 is way ahead of the pack here.</p>
</div>
<ol class="children">
<li id="comment-407280" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-17T21:29:32+00:00">May 17, 2019 at 9:29 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Processor architects will tell you (even if you didn’t ask) that you can’t compare designs on the basis of IPC alone, because higher frequency designs may sacrifice IPC to get there, so you can’t really talk about an “A12 running at 5 GHz” because such a thing may not be possible (it would require a different design).</p>
</blockquote>
<p>Well&#8230; I wasn&rsquo;t planning on building servers out of A12 chips&#8230; yet.</p>
<blockquote>
<p>A typical approach is to calibrate based on a measurement with a known timing.</p>
</blockquote>
<p>Yes. I&rsquo;ll do so in a later revision of this test.</p>
<blockquote>
<p>An iPad is a better target than an iPhone since it suffers less thermal throttling. Maybe put it in the freezer first :).</p>
</blockquote>
<p>I doubt that my benchmark is intensive enough to get in trouble with respect to heat to the point where using a freezer is warranted. It lasts a very short time (but long enough to trigger the big cores).</p>
</div>
</li>
</ol>
</li>
</ol>
