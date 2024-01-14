---
date: "2018-12-21 12:00:00"
title: "Fast Bounded Random Numbers on GPUs"
index: false
---

[3 thoughts on &ldquo;Fast Bounded Random Numbers on GPUs&rdquo;](/lemire/blog/2018/12-21-fast-bounded-random-numbers-on-gpus)

<ol class="comment-list">
<li id="comment-374554" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-21T17:50:32+00:00">December 21, 2018 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>Very interesting stuff, Daniel. Do I get it correctly that you use your previously posted trick to avoid modulo operation?<br/>
I am not a CUDA expert, but it seems totally crazy that loops and conditionals are faster than a modulo operation on GPU. GPU must stop the cores that don&rsquo;t follow a branch (and execute them later). Conditionals should have a much higher penalty compared to poor modulo operation.Is the modulo operation so slow on GPU or I miss something?</p>
<p>The same argument also partially true for CPUs: a single branch misprediction is like 10-15 instructions, the same number as a modulo operation.</p>
</div>
</li>
<li id="comment-374557" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-21T17:58:57+00:00">December 21, 2018 at 5:58 pm</time></a> </div>
<div class="comment-content">
<p><em>Do I get it correctly that you use your previously posted trick to avoid modulo operation?</em></p>
<p>Yes.</p>
<p><em>I am not a CUDA expert, but it seems totally crazy that loops and conditionals are faster than a modulo operation on GPU. GPU must stop the cores that don&rsquo;t follow a branch (and execute them later). Conditionals should have a much higher penalty compared to poor modulo operation.Is the modulo operation so slow on GPU or I miss something?</em></p>
<p>It is not possible to have unbiased numbers, as far as I can tell, without branching, so the code here compares three strategies involving branching. All should involve just about the same amount of branching.</p>
<p>You can skip the branching at the expense of some (small) bias, but it was not tested here.</p>
</div>
</li>
<li id="comment-374887" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas MÃ¼ller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-22T20:20:55+00:00">December 22, 2018 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if a different API could speed things up, for example bulk generation.</p>
<p>If the order of numbers doesn&rsquo;t matter (is it always important?), you could split the job, for example instead of generating 1 million numbers 0..99, generate numbers in blocks: 0..63, 64..95, and 96..99. How many of each block are needed would need to be somewhat random (Poisson distribution I think); calculating that would require O(log n).</p>
<p>Once I had to generate random numbers that need to be unique, and somewhat sorted. Sure, you can make them unique by sorting, but that&rsquo;s slow. I found a faster algorithm, see this <a href="https://stats.stackexchange.com/questions/289300/random-number-generator-that-returns-unique-64-bit-numbers-in-sorted-order" rel="nofollow">discussion</a>.</p>
</div>
</li>
</ol>
