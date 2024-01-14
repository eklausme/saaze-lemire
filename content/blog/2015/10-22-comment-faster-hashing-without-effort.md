---
date: "2015-10-22 12:00:00"
title: "Faster hashing without effort"
index: false
---

[11 thoughts on &ldquo;Faster hashing without effort&rdquo;](/lemire/blog/2015/10-22-faster-hashing-without-effort)

<ol class="comment-list">
<li id="comment-199386" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-23T00:16:40+00:00">October 23, 2015 at 12:16 am</time></a> </div>
<div class="comment-content">
<p>Looks like an excellent candidate for vectorization.</p>
</div>
</li>
<li id="comment-199440" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2c2b8044eca80b9a707c716c530d9f5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2c2b8044eca80b9a707c716c530d9f5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://plus.google.com/u/0/107454831271192954986/" class="url" rel="ugc external nofollow">Jason Schulz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-23T08:02:04+00:00">October 23, 2015 at 8:02 am</time></a> </div>
<div class="comment-content">
<p>The complexity of a hash function isn&rsquo;t always O(1), and sometimes the hash function has a larger complexity than the actual hash operations.</p>
<p>It&rsquo;s weird that the security of a hash almost directly corresponds to the number of data dependencies.</p>
</div>
</li>
<li id="comment-199499" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-23T15:08:11+00:00">October 23, 2015 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>@Leonid</p>
<p>Indeed, hashing can be vectorized, see our recent paper: <a href="http://arxiv.org/abs/1503.03465" rel="nofollow ugc">http://arxiv.org/abs/1503.03465</a> For long strings, you can nearly hash 8 bytes per CPU cycle!</p>
</div>
<ol class="children">
<li id="comment-200473" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.jandrewrogers.com/" class="url" rel="ugc external nofollow">J. Andrew Rogers</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-26T22:34:46+00:00">October 26, 2015 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, you might want to check out the MetroHash algorithm family. The fastest variants can do &gt;8 bytes/cycle on long strings without vectorization (slow variants are no worse than 5 bytes/cycle) and are among the fastest functions for short keys as well. More importantly, the randomness is extremely robust, similar to SHA-1. </p>
<p>While vectorized variants of MetroHash are on my TODO list, a subtle design element of the MetroHash functions is that they are engineered to saturate multiple ALU ports on modern super-scalar architectures, which gives vector-like performance without vectorization. Main repository is here:</p>
<p><a href="https://github.com/jandrewrogers/MetroHash" rel="nofollow ugc">https://github.com/jandrewrogers/MetroHash</a></p>
<p>The algorithm is surprisingly simple, a minimal sequence of multiplications and rotates, but the anomalously strong statistical properties are the product of extensive computer analysis.</p>
</div>
<ol class="children">
<li id="comment-200501" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T00:08:47+00:00">October 27, 2015 at 12:08 am</time></a> </div>
<div class="comment-content">
<p>Do you have some documentation beside the source code? E.g., regarding the statistical properties?</p>
</div>
<ol class="children">
<li id="comment-200633" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08273d5f7fe210be4bfcdd60b9b3fe09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jandrewrogers.com/" class="url" rel="ugc external nofollow">J. Andrew Rogers</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-27T06:55:19+00:00">October 27, 2015 at 6:55 am</time></a> </div>
<div class="comment-content">
<p>I do have quite a bit of data on these functions, I will see if I can dig some up. They have been subjected to much more than the standard SMHasher diagnostics and analysis.</p>
<p>The backstory is that I designed software that in theory could learn how to design and optimize hash functions within some simple constraints. An enormous amount of compute time later, the software was churning out hundreds of algorithms that were far better than the existing art. More interesting to me, a small subset of the functions appear at least as robustly random across a very wide range of tests as cryptographic functions, which I can&rsquo;t quite explain yet.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-199530" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-23T21:08:11+00:00">October 23, 2015 at 9:08 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel, very nice. You could have mentioned this in the post. 🙂</p>
</div>
<ol class="children">
<li id="comment-199535" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-23T22:08:06+00:00">October 23, 2015 at 10:08 pm</time></a> </div>
<div class="comment-content">
<p>You are right. I might write a more involved blog post later on fast &ldquo;advanced&rdquo; techniques to compute hash functions.</p>
</div>
</li>
</ol>
</li>
<li id="comment-200137" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Viktor Szathmary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-26T07:07:48+00:00">October 26, 2015 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>Can you get a speedup for byte[] or ByteBuffer hashing with a similar technique? (My first attempt was not fruitful)</p>
</div>
<ol class="children">
<li id="comment-200144" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Viktor Szathmary</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-26T07:15:37+00:00">October 26, 2015 at 7:15 am</time></a> </div>
<div class="comment-content">
<p>Correction: for a byte[] the speedup is there, but for ByteBuffer it&rsquo;s not (unless you get the backing byte[] of course), probably due some overhead of calling buf.get(i).</p>
</div>
<ol class="children">
<li id="comment-200283" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-26T13:34:39+00:00">October 26, 2015 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>Unfortunately, a ByteBuffer is an expensive abstraction in Java. Arrays have been optimized in Java to the point where they have basically the same speed as in C++, most of the time. Not so with ByteBuffer.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
