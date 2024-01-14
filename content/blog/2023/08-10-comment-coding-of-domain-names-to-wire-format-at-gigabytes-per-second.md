---
date: "2023-08-10 12:00:00"
title: "Coding of domain names to wire format at gigabytes per second"
index: false
---

[8 thoughts on &ldquo;Coding of domain names to wire format at gigabytes per second&rdquo;](/lemire/blog/2023/08-10-coding-of-domain-names-to-wire-format-at-gigabytes-per-second)

<ol class="comment-list">
<li id="comment-653814" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-10T18:21:39+00:00">August 10, 2023 at 6:21 pm</time></a> </div>
<div class="comment-content">
<p>Back when we were trying to validate UTF-8, I wracked my brain on how to get correct jump distances like this.</p>
<p>The trick is to exponentiate a permutation of the following form:</p>
<p>P[i] = i if position i has a dot</p>
<p>P[i] = i+1 if not</p>
<p>In SIMD terms that&rsquo;s a constant vector plus the comparison mask:</p>
<p>P=<br/>
<code>1 2 3 4 5 6 7 8</code> + <code>-1 0 -1 0 0 0 0 -1</code><br/>
= <code>0 2 2 4 5 6 7 7</code></p>
<p>P^2 = <code>0 2 2 5 6 7 7 7 7</code></p>
<p>P^4 = <code>0 2 2 7 7 7 7 7</code></p>
<p>P has a fixed point at each dot, and the other locations fill from the right. The limit is an eigenvector under P.</p>
</div>
<ol class="children">
<li id="comment-653832" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-10T19:59:09+00:00">August 10, 2023 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>Damn it. Let me try.</p>
</div>
<ol class="children">
<li id="comment-653840" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-10T21:04:41+00:00">August 10, 2023 at 9:04 pm</time></a> </div>
<div class="comment-content">
<p>Ok. I think it is applicable, but it requires more work than I expected. I will need to come back to it.</p>
</div>
</li>
</ol>
</li>
<li id="comment-654023" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c6c5e08ed042ab5db692956c8c768c2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c6c5e08ed042ab5db692956c8c768c2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Noah goldstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-13T02:17:26+00:00">August 13, 2023 at 2:17 am</time></a> </div>
<div class="comment-content">
<p>What operation is it for P^2 / P^4. Seems to be neither power nor xor.</p>
</div>
<ol class="children">
<li id="comment-654083" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-14T18:03:01+00:00">August 14, 2023 at 6:03 pm</time></a> </div>
<div class="comment-content">
<p>P^2 means pshufb(P,P); sorry for the rough notation. That&rsquo;s the shuffle mask equivalent to applying P twice (shuffle masks are composable, subject to certain constraints such as out-of-range entries being replaced by 0).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-654343" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/645ad53c379872899ff7e3363236975d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/645ad53c379872899ff7e3363236975d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeroen Koekkoek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-28T07:15:48+00:00">August 28, 2023 at 7:15 am</time></a> </div>
<div class="comment-content">
<p>Only a minor remark, but the wire format for domain names is slightly different. Given lemire.me, the name contains three labels, one of length 6 (lemire), one of length 2 (me) and the root label. The correct wire format is 6lemire2me0 (in URLs the trailing dot is often implicit).</p>
<p>Additional background info: A resolver starts looking up information by first querying the <code>.</code> (root server), which responds with the name server for <code>.me</code>, which responds with the location for <code>lemire.me.</code>.</p>
</div>
<ol class="children">
<li id="comment-654347" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-28T13:02:18+00:00">August 28, 2023 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. The blog post does not describe the final zero. However, the code does produce a trailing zero. In the case where the input is lemire.me, you get the following (see unit tests):</p>
<pre><code>input:
6c 65 6d 69 72 65 2e 6d 65 
name_to_dnswire_simd output:
06 6c 65 6d 69 72 65 02 6d 65 00 
name_to_dnswire output:
06 6c 65 6d 69 72 65 02 6d 65 00 
name_to_dnswire_scalar_labels output:
06 6c 65 6d 69 72 65 02 6d 65 00 
name_to_dnswire_avx output:
06 6c 65 6d 69 72 65 02 6d 65 00 
name_to_dnswire_idx_avx output:
06 6c 65 6d 69 72 65 02 6d 65 00
</code></pre>
</div>
<ol class="children">
<li id="comment-654355" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7ea5ff8c2bd81e8906d62b27bbb22280?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7ea5ff8c2bd81e8906d62b27bbb22280?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Isaac Kabel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-29T02:57:41+00:00">August 29, 2023 at 2:57 am</time></a> </div>
<div class="comment-content">
<p>The non-simd function works in the test because it has a final <code>*counter = 0;</code> whereas the simplified code in the article excludes it and is wrong as a result.</p>
<p>I sympathize with excluding the label length validation and <code>is_name_char</code> implementation, both clearly for brevity&rsquo;s sake, but the null terminator is a matter of correctness.</p>
<p>I (and presumably Jeroen too) would have found your introduction easier to understand since I think of the DNS name wire format the other way (dots are separators between labels, there&rsquo;s a trailing empty label, labels are serialized with a length prefix byte). From your description, I figured you&rsquo;d have to add the null terminator after the loop, so when I didn&rsquo;t see it in your code, I mentally desk checked it to make sure I wasn&rsquo;t misunderstanding.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
