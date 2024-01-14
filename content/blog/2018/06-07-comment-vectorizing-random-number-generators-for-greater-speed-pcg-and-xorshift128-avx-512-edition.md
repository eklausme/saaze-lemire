---
date: "2018-06-07 12:00:00"
title: "Vectorizing random number generators for greater speed: PCG and xorshift128+ (AVX-512 edition)"
index: false
---

[8 thoughts on &ldquo;Vectorizing random number generators for greater speed: PCG and xorshift128+ (AVX-512 edition)&rdquo;](/lemire/blog/2018/06-07-vectorizing-random-number-generators-for-greater-speed-pcg-and-xorshift128-avx-512-edition)

<ol class="comment-list">
<li id="comment-307319" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c3c60c04ebf3c327f495e18f4cad645?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c3c60c04ebf3c327f495e18f4cad645?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jack Mott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-07T18:25:30+00:00">June 7, 2018 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>If you do not have an AVX-512 cpu, you can still experiment with these on some of the cloud providers, which offer AVX-512 vms.</p>
</div>
<ol class="children">
<li id="comment-320320" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-22T05:22:52+00:00">July 22, 2018 at 5:22 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
In these tests, I simply write out the random number to a small array in cache. I only measure raw throughput. To get these good results, I â€œcheatâ€ a bit by interleaving several generators in the vectorized versions. Indeed, without this interleave trick, I find that the processor is almost running idle due to data dependencies.
</p></blockquote>
<p>Isn&rsquo;t the cheating in the &ldquo;I simply write out the random number to a small array in cache&rdquo;, chances of that happening consistently in the real world are small, unless you&rsquo;re randomizing your hard-disk.</p>
</div>
<ol class="children">
<li id="comment-320417" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-22T19:15:21+00:00">July 22, 2018 at 7:15 pm</time></a> </div>
<div class="comment-content">
<p><em>Isn&rsquo;t the cheating in the â€œI simply write out the random number to a small array in cacheâ€, chances of that happening consistently in the real world are small, unless you&rsquo;re randomizing your hard-disk.</em></p>
<p>Cheating as opposed to what? How else do you propose to measure how quickly one can generate random numbers?</p>
</div>
<ol class="children">
<li id="comment-320510" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-23T04:16:12+00:00">July 23, 2018 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>As opposed to comparing the performance of prng&rsquo;s in a situation that is more likely to reflect real-world-usage of any prng.</p>
<p>Modern processors will make the operation you&rsquo;re measuring really fast due to deep pipe-lines and out-of-order execution. In normal code branch mis-prediction will trash the instruction cache often.</p>
<p>So it really comes down to what one wants to measure, only then one might be able to answer the question of how to do that.</p>
</div>
<ol class="children">
<li id="comment-320625" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-23T13:27:54+00:00">July 23, 2018 at 1:27 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>In normal code branch mis-prediction will trash the instruction cache often.</p>
</blockquote>
<p>The point you seem to be making is that random number generation might not be the bottleneck. Something else, like the branchy nature of my code, might be the limiting factor. That&rsquo;s absolutely correct.</p>
</div>
<ol class="children">
<li id="comment-320656" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-23T14:28:53+00:00">July 23, 2018 at 2:28 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Something else, like the branchy nature of my code, might be the limiting factor.
</p></blockquote>
<p>I&rsquo;m saying that in a &ldquo;normal&rdquo; program (not specifically testing through-put of a prng), other (surrounding) code will trash your instruction cache (and probably your data cache as well), and therefor in a real world situation the tested prng will not do so well as advertised. How less well it will do depends on the prng and the actual implementation of it.</p>
<p>What I&rsquo;m saying is that you are not testing that, or in other words, it&rsquo;s not a very useful measure.</p>
</div>
<ol class="children">
<li id="comment-320688" class="comment byuser comment-author-lemire bypostauthor even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-23T16:00:10+00:00">July 23, 2018 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>My answer as a blog post: <a href="https://lemire.me/blog/2018/07/23/are-vectorized-random-number-generators-actually-useful/">Are vectorized random number generators actually useful?</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-320664" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-23T14:41:39+00:00">July 23, 2018 at 2:41 pm</time></a> </div>
<div class="comment-content">
<p>Sorry for the split response, but there&rsquo;s more I think.</p>
<p>The efficiency of the intrinsics depends fully on that the values remain in registers throughout. Iff they don&rsquo;t, intrinsics are very expensive as the whole lot (512 bytes, way bigger than your data cache) need to be written to memory and back. Again, surrounding code might force those values out of registers, which won&rsquo;t happen in your test method..</p>
<p>I am not criticizing your implementation(s). I&rsquo;m just putting question marks along-side your measuring method.</p>
<p>To be honest I don&rsquo;t have a good response either. M. E. O&rsquo;Neill is going to publish a blog-post on this particular issue (she told me it&rsquo;s in the making), so I&rsquo;m looking forward to that.</p>
</div>
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
