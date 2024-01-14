---
date: "2018-08-15 12:00:00"
title: "Fast strongly universal 64-bit hashing everywhere!"
index: false
---

[10 thoughts on &ldquo;Fast strongly universal 64-bit hashing everywhere!&rdquo;](/lemire/blog/2018/08-15-fast-strongly-universal-64-bit-hashing-everywhere)

<ol class="comment-list">
<li id="comment-340527" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a22f40f9a5203888afe5b8bdaf0f229a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a22f40f9a5203888afe5b8bdaf0f229a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">icsa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-15T18:11:17+00:00">August 15, 2018 at 6:11 pm</time></a> </div>
<div class="comment-content">
<p>Is there a bug in lines 35-40 of HashFast.java?</p>
<p><code>static long hash64(long x) {<br/>
int low = (int)x;<br/>
int high = (int)(x &gt;&gt;&gt; 32);<br/>
return ((a1 * low + b1 * high + c1) &gt;&gt;&gt; 32)<br/>
| ((a2 * low + b2 * high + c2) &amp; 0xFFFFFFFFL);<br/>
}<br/>
</code></p>
<p>Should 0xFFFFFFFFL be 0xFFFFFFFF00000000L ?</p>
</div>
<ol class="children">
<li id="comment-340855" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-15T23:44:41+00:00">August 15, 2018 at 11:44 pm</time></a> </div>
<div class="comment-content">
<p>Indeed. Fixed. Thank you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-340591" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dac2165273cc37a2ddb3eaf800c4a556?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dac2165273cc37a2ddb3eaf800c4a556?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/greenrobot/essentials/blob/master/java-essentials/src/main/java/org/greenrobot/essentials/hash/Murmur3F.java" class="url" rel="ugc external nofollow">Markus</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-15T19:05:04+00:00">August 15, 2018 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>Reminds me of doing a faster than Guava&rsquo;s Murmur a while back: <a href="https://github.com/greenrobot/essentials/blob/master/java-essentials/src/main/java/org/greenrobot/essentials/hash/Murmur3F.java" rel="nofollow ugc">https://github.com/greenrobot/essentials/blob/master/java-essentials/src/main/java/org/greenrobot/essentials/hash/Murmur3F.java</a></p>
<p>Benchmarks: <a href="http://greenrobot.org/essentials/features/performant-hash-functions-for-java/comparison-of-hash-functions/" rel="nofollow ugc">http://greenrobot.org/essentials/features/performant-hash-functions-for-java/comparison-of-hash-functions/</a></p>
</div>
</li>
<li id="comment-341456" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter McNeeley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T20:50:20+00:00">August 16, 2018 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>64 bit Hash collision<br/>
x = 0xe105df2c79eef65cL;<br/>
x&rsquo; = 0x31d1b0f8ede6981fL;</p>
<p>h(x) = h(x&rsquo;) == -9096877159865265073</p>
<p><a href="https://www.jdoodle.com/online-java-compiler#&#038;togetherjs=l7ofLoRRu2" rel="nofollow ugc">https://www.jdoodle.com/online-java-compiler#&#038;togetherjs=l7ofLoRRu2</a></p>
</div>
<ol class="children">
<li id="comment-341475" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T21:20:36+00:00">August 16, 2018 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>Peter: Strongly universal means that if the constants (a,b,c&#8230;) are generated randomly, and I give you x and h(x), and x&rsquo; is distinct from x, then you know nothing about h(x&rsquo;). In some sense, it ensures that there is a possible collision in that if you knew that h(x) and h(x&rsquo;) could not collide, then it would not be strongly universal.</p>
</div>
<ol class="children">
<li id="comment-341546" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter McNeeley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-16T23:34:29+00:00">August 16, 2018 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for your response.<br/>
&rdquo; if you knew that h(x) and h(x&rsquo;) could not collide&rdquo;<br/>
This is what I did notice. for x&rsquo; = x + dx where dx is a small integer there are ZERO (32 bit) collisions whereas murmur and random produce ~same number collisions.<br/>
Code:<br/>
<a href="https://www.jdoodle.com/online-java-compiler#&#038;togetherjs=01tRdC7ssr" rel="nofollow ugc">https://www.jdoodle.com/online-java-compiler#&#038;togetherjs=01tRdC7ssr</a></p>
</div>
<ol class="children">
<li id="comment-341607" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter McNeeley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-17T01:07:18+00:00">August 17, 2018 at 1:07 am</time></a> </div>
<div class="comment-content">
<p>The default values for a1,b1,c1,a2,b2,c2 produce the effect mentioned. Other specific for a1,b1,c1,a2,b2,c2 produce order of magnitude more collisions for nearby values than would be expected from random.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-341604" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-17T01:04:59+00:00">August 17, 2018 at 1:04 am</time></a> </div>
<div class="comment-content">
<p>Most languages offer a multiply of two N-bit values into an N-bit result, but actual hardware often offers the full 2N-bit result for no little extra cost (for example, on x86, getting the 128-bit product of two 64-bit multiplies has the same latency and throughput as the variants that only give a 64-bit result, although they do cost an extra uop).</p>
<p>Given that, could you calculate your 64-bit strongly universal hash more directly, using only two multiplications if you had access to the full 128-bit result of a 64 * 64 multiplication?</p>
<p>If I understand it correctly, you are using the multiply-shift scheme to calculate an N-bit hash of an N-bit input x using: (a*x + b) &gt;&gt; N, where a and b are 2N-bit values and x is N-bit.</p>
<p>So given N = 64, on most hardware we can do a 64 * 64 -&gt; 128 bit multiplication, but for the a * x part we actually need 128 * 64 -&gt; 128, which could be implemented with two 64 * 64 -&gt; 128 multiplies and a 64-bit add. Then you have two more adds for the + b part, although in principle it seems like adding the bottom half of b is mostly pointless because it only very weakly affects the actual result since the bottom bits are all thrown away [1]. The shift &gt;&gt; 64 is a no-op, since we&rsquo;re splitting the 128-bit result into two 64-bit registers, so we just directly use the top half.</p>
<p>So you end up with half the number of multiplies and fewer additions as well.</p>
<p>The trick, of course, is convincing the language of your choice to generate sensible code under the covers that actually uses the hardware capabilities! From C or C++ this is somewhat easier due to the presence of 128-bit types for most compilers. I&rsquo;m not sure about Java though.</p>
<p>[1] Of course, you&rsquo;d have to walk through the strong universality proof to see if dropping the low-bit addition breaks the guarantee in theory. Perhaps it ends up being strongly 1.0000001-universal or something.</p>
</div>
<ol class="children">
<li id="comment-342202" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-17T19:31:39+00:00">August 17, 2018 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>I guess this kind of shows that there is a parallel between the explicit decomposition approach described in Daniels post and multi-precision arithmetic.</p>
<p>I.e., one way to extend the multiply-shift scheme to larger words is decompose it explicitly into smaller hashes and concatenate the hashes together to get your word-sized hash, another another way is to just perform the multiply-shift formula once with the full word size and rely on multi-precision arithmetic to calculate the answer when the needed arithmetic exceeds the machine&rsquo;s word size.</p>
<p>The end up scaling in about the same way: both are quadratic in the word size (at least as I understand Daniel&rsquo;s approach) and in fact ultimately produce similar operations.</p>
<p>The explicit decomposition approach has the advantage that you can perhaps rely on some knowledge of the required result to eliminate or combine operations. For example, Daniel&rsquo;s approach only uses 4 multiplications while a naive 64<em>128-&gt;128 multiplication would need 8 (I think). Essentially the decomposition was able to work around the lack of a way to get the high-half of a 64</em>64-bit multiplication in Java.</p>
<p>The multi-precision arithmetic approach has the advantage of being able to lean on existing multi-precision libraries[1], which may end up being faster (i.e., if they know how to get a 64*64-&gt;128-bit result, you cut the multiplications down to 2 as in my suggestion above), and being obviously correct without proof since they use the original multiply-shift-add formula directly.</p>
<p>[1] Of course if you actually use some big heavy multi-precision library maybe that&rsquo;s also a downside.</p>
</div>
</li>
</ol>
</li>
<li id="comment-343592" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/295204f3745c05f98ba821b001662cc4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/295204f3745c05f98ba821b001662cc4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philip Reames</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-20T21:28:56+00:00">August 20, 2018 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for an interesting article as always.</p>
<p>This is the type of result which could be very influenced by your choice of compiler and VM. For the heck of it, I went and ran your tests on Azul Zing. Overall, the big picture results are roughly the same, but the percentage difference between the hash32 and murmur scores was a bit bigger (80% on Zing vs 65% on Zulu).</p>
<p><code>(a random recent zulu8 snapshot - e.g. openjdk)</p>
<p>Benchmark Mode Cnt Score Error Units<br/>
HashFast.fast2_32 avgt 10 235.174 Â± 0.125 us/op<br/>
HashFast.fast64 avgt 10 205.715 Â± 0.651 us/op<br/>
HashFast.murmur avgt 10 143.495 Â± 0.044 us/op<br/>
HashFast.murmur_32 avgt 10 181.772 Â± 0.441 us/op</p>
<p>(a random recent Zing8 snapshot)</p>
<p>Benchmark Mode Cnt Score Error Units<br/>
HashFast.fast2_32 avgt 10 134.482 Â± 0.026 us/op<br/>
HashFast.fast64 avgt 10 122.611 Â± 0.832 us/op<br/>
HashFast.murmur avgt 10 74.235 Â± 0.017 us/op<br/>
HashFast.murmur_32 avgt 10 87.856 Â± 0.024 us/op<br/>
</code></p>
<p>Results were collected on a skylake-client box I had sitting around. I tested on two other architectures (an ancient AMD, and haswell) and got roughly the same picture (though the absolute scores differed of course).</p>
<p>Disclaimer: I work for Azul on our compilers, so I&rsquo;m obviously biased.</p>
</div>
</li>
</ol>
