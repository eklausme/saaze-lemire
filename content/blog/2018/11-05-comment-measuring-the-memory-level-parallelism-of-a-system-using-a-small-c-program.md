---
date: "2018-11-05 12:00:00"
title: "Measuring the memory-level parallelism of a system using a small C++ program?"
index: false
---

[56 thoughts on &ldquo;Measuring the memory-level parallelism of a system using a small C++ program?&rdquo;](/lemire/blog/2018/11-05-measuring-the-memory-level-parallelism-of-a-system-using-a-small-c-program)

<ol class="comment-list">
<li id="comment-362540" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4d15a817efd25b5fe05594853f95ef10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4d15a817efd25b5fe05594853f95ef10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.ucd.ie/research/people/mechanicalmaterialseng/assocPMrofessoraluncarr/" class="url" rel="ugc external nofollow">Alun J. Carr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-05T23:06:58+00:00">November 5, 2018 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>With Ye Olde Core i7-3667U (Ivy Bridge) in my mid-2012 MacBook Air, I get a value of 7, for what it&rsquo;s worth.</p>
</div>
</li>
<li id="comment-362587" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://www.antoniomallia.it" class="url" rel="ugc external nofollow">Antonio Mallia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T03:58:46+00:00">November 6, 2018 at 3:58 am</time></a> </div>
<div class="comment-content">
<p>Very interesting.<br/>
I have seen this beening exploited by cuckoo hashing where two indipendent locations are accessed in parallel through speculative execution. Now the questions is, if modern CPUs are able to access up to 10 locations at the same time, why are we using only two locations for cuckoo hashing? It might makes sense to revisit a bit&#8230; ðŸ˜€</p>
</div>
<ol class="children">
<li id="comment-362942" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-07T22:09:50+00:00">November 7, 2018 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>Despite chips supporting some MLP, it&rsquo;s not free in any sense to check 10 locations (especially when they are not contiguous) rather than 2. You only need two locations to get the &ldquo;power of choice&rdquo; effect that dramatically reduces the collision rate, making this type of hashing feasible in the first place.</p>
<p>Also, there is a temptation to analyze everything in isolation, eg the effect of a single hash lookup. Maybe you find that in a latency-sense for a single lookup, using a large number of parallel lookups is fastest since you fully exploit the available MLP. Then as soon as you put that implementation into some real code that does a bunch of back-to-back lookups, you find that it&rsquo;s slower &#8211; because the &ldquo;unused&rdquo; MLP in a single lookup was actually being used effectively across different lookups. Ultimately there might not be a single best approach: one approach might be fastest when used in a place where adjacent operations can also exploit MLP, while a other might be faster when that&rsquo;s not the case (sometimes this division corresponds to the throughput vs latency distinction but not always).</p>
</div>
<ol class="children">
<li id="comment-362956" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-07T22:54:46+00:00">November 7, 2018 at 10:54 pm</time></a> </div>
<div class="comment-content">
<p>Going from 2 accesses to 3 accesses, though not &ldquo;free&rdquo;, is maybe far more practical than it appears.</p>
</div>
<ol class="children">
<li id="comment-362970" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T00:04:32+00:00">November 8, 2018 at 12:04 am</time></a> </div>
<div class="comment-content">
<p>Yes, free, but in the context of this specific test using independent chains which is designed to measure MLP. If anything is going to show the third access being free, it is this type of code.</p>
<p>Increasing the number of probed locations in a hashing algorithm is another thing entirely. These is a bunch of work beyond the access, and the accesses aren&rsquo;t part of long independent chains, but start from a common point and converge after a single access. So it is unlikely to be free, although how much it actually costs depends on a lot of factors, including the surrounding code.</p>
</div>
<ol class="children">
<li id="comment-362974" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T00:17:50+00:00">November 8, 2018 at 12:17 am</time></a> </div>
<div class="comment-content">
<p>So we are clear, I did not write that it would be free. I wrote that an additional memory access is maybe less expensive than you might think if you do not take parallelism into account.</p>
</div>
<ol class="children">
<li id="comment-362988" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T01:22:44+00:00">November 8, 2018 at 1:22 am</time></a> </div>
<div class="comment-content">
<p>Ooops, I misread it: I didn&rsquo;t see the &ldquo;not&rdquo; in front of free.</p>
<p>So I still think though that just adding additional probes to cuckoo hashing is probably not very useful in general.</p>
<p>My feeling about hashing is that the optimal approach would take advantage of SIMD to do many comparisons at once, and make the common found and not found approaches constant time and predictable (i.e., not unpredictable branches when you find the element even if it is not in its &ldquo;nominal&rdquo; slot). So something like a bucketized hash.</p>
<p>Then you can still layer on a clever reprobing strategy like cuckoo or some variant, but mostly as a fall-back case when you have a lot of collisions.</p>
</div>
<ol class="children">
<li id="comment-362992" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T01:41:39+00:00">November 8, 2018 at 1:41 am</time></a> </div>
<div class="comment-content">
<p><em>My feeling about hashing is that the optimal approach would take advantage of SIMD to do many comparisons at once, and make the common found and not found approaches constant time and predictable. So something like a bucketized hash.</em></p>
<p>I would definitively prefer SIMD on a single cache line, than two cache misses. I am certainly not arguing for <em>more</em> cache misses.</p>
</div>
</li>
<li id="comment-363360" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-09T15:01:15+00:00">November 9, 2018 at 3:01 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
So I still think though that just adding additional probes to cuckoo<br/>
hashing is probably not very useful in general.
</p></blockquote>
<p>Huh, I&rsquo;m with Antonio here, and think that cuckoo hashes are the perfect example of how MLP can be exploited for big performance gains. Use SIMD to generate parallel hashes, use MLP to gather the lookups, and then use SIMD again to check the results. Win, win, win! I&rsquo;m surprised that you and Daniel don&rsquo;t see the advantage.</p>
<p>You are obviously correct that adding additional probes is not completely free and that multiple probes does not speed up access. But you seem to be missing the big advantages of having more places to put things, which are reduced memory size (better fill ratios) and reduced work on insertions. If you can get (almost) equal access times for read-only work, you get big wins everywhere else.</p>
<p>I think the theory is really solid on this. A good search term is &ldquo;d-ary cuckoo hash&rdquo;, where &ldquo;d&rdquo; is the number of parallel slots. The original paper on it is Fotakis, Pagh, Sanders, and Spirakis 2005: <a href="http://www.cs.princeton.edu/courses/archive/fall09/cos521/Handouts/spaceefficient.pdf" rel="nofollow ugc">http://www.cs.princeton.edu/courses/archive/fall09/cos521/Handouts/spaceefficient.pdf</a></p>
<p>Their conclusion is that going from d=2 to d=4 is a big gain: &ldquo;We also provide experimental evidence which indicates that d-ary Cuckoo Hashing is even better in practice than our theoretical performance guarantees. For example, at d=4, we can achieve 97% space utilization and at 90% space utilization, insertion requires only about 20 memory probes on the average, i.e., only about a factor two more than for d=âˆž.&rdquo;</p>
<p>Viewed alternatively, part of the reason that cuckoo hashing works so well is that even with d=2, we are able (if designed correctly) to take advantage of parallel memory accesses. But going even a little farther (from 2 to 4 or 8) costs us very little for read speeds, while giving lots of benefit for writes. Nicely, the theoretical sweet spot matches well with the current limits for MLP.</p>
</div>
<ol class="children">
<li id="comment-363367" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-09T16:01:55+00:00">November 9, 2018 at 4:01 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Huh, I&rsquo;m with Antonio here, and think that cuckoo hashes are the<br/>
perfect example of how MLP can be exploited for big performance gains.<br/>
Use SIMD to generate parallel hashes, use MLP to gather the lookups,<br/>
and then use SIMD again to check the results. Win, win, win! I&rsquo;m<br/>
surprised that you and Daniel don&rsquo;t see the advantage.</p>
<p> You are obviously correct that adding additional probes is not<br/>
completely free and that multiple probes does not speed up access. But<br/>
you seem to be missing the big advantages of having more places to put<br/>
things, which are reduced memory size (better fill ratios) and reduced<br/>
work on insertions. If you can get (almost) equal access times for<br/>
read-only work, you get big wins everywhere else.
</p></blockquote>
<p>First, when considering hash tables, I should note that I biased towards evaluating lookups: so I&rsquo;m pretty much evaluating how fast the lookups are as the key criteria. That might not be right for every use: if you have insert and delete heavy hash tables, you&rsquo;ll obviously care about the performance of those operations.</p>
<p>Maybe I got that way because in many simple hash tables, &ldquo;lookup&rdquo; and &ldquo;insert&rdquo; are pretty much the same thing: to insert you just do a lookup and if you don&rsquo;t find the element you are already at the insertion point, so the performance is very similar. That is not necessarily the case for cuckoo, where inserts can have very asymmetric compared to lookups (especially if you are pushing the load factor).</p>
<p>So in that view, exploiting MLP to created a d-ary Cuckoo is far from a &ldquo;perfect&rdquo; example, because it possibly provides no speedup at at all for hash lookups. The effect is only very indirect: you might get some speedup due to a higher load factor, but since even 2-ary cuckoo hashes support a fairly high load factor this benefit is limited, and will mostly occur only at certain thresholds where the 2-ary cuckoo slips into the next cache level, but the 3-ary or d-ary cuckoo fits in the higher level cache. It is not at all clear to me that benefit can overcome, on average, the penalty of more accesses.</p>
<p>I&rsquo;ll admit to having a wrong idea of how high load factors get in 2-ary cuckoo hash tables though: I thought they approached 80% to 90% before rehashing, but a skim (and the paper you linked) seems to indicate it would be below 50%, so there is <em>some</em> room for better space usage.</p>
<p>To me, the &ldquo;perfect&rdquo; example of MLP gets approximately a factor of N improvement by doing N memory accesses in parallel, and examples like that exist (many like linear search work like that without the author consciously being aware of MLP though). So I&rsquo;m not even saying that a 3-ary cuckoo wouldn&rsquo;t be a win in some cases, but that is very far from an obvious example of how we can exploit MLP for a big win (to me).</p>
<blockquote><p>
The original paper on it is Fotakis, Pagh, Sanders, and Spirakis 2005
</p></blockquote>
<p>I had read it before, I think, but only skimmed it again now. The main point seems to be that you can get might higher load factors, approaching 100% with d-ary caches, right? They seem to be primarily evaluating it on that basis, not on performance.</p>
<blockquote><p>
and at 90% space utilization, insertion requires only about 20 memory probes on the average
</p></blockquote>
<p>This sort of contradicts the notion that d-ary caches are making insertion fast, doesn&rsquo;t it? If you are doing <em>twenty</em> probes on average to insert your element, you are not going to have fast inserts, even if you try to exploit MLP. You should look for less than 2 probes on average.</p>
<p>I&rsquo;m not saying the paper is wrong: I&rsquo;m saying it is targeting something different (optimal space usage) that what most people want from a hash table.</p>
<blockquote><p>
But going even a little farther (from 2 to 4 or 8) costs us very little for read speeds, while giving lots of benefit for writes.
</p></blockquote>
<p>Did you try it? I&rsquo;m not convinced about either part. For one thing, inserts also need to do all the work of a lookup, so if you make lookups slower by doing more probes, you also also make that part of inserts slower. The &ldquo;cuckoo&rdquo; part of inserts, where you push elements around until you find an empty space, might be faster, but is this really a large part of the insert cost for a properly sized table?</p>
<p>Also, the paper you linked makes it clear that if you want to use the d-ary nature to crank up the load factor, you are doing to be probing <em>a lot</em> of locations on insert.</p>
<blockquote><p>
Viewed alternatively, part of the reason that cuckoo hashing works so well is that even with d=2, we are able (if designed correctly) to take advantage of parallel memory accesses.
</p></blockquote>
<p>Yes, although this is common to many fast hashing techniques as well. For example, people keep rediscovering that chaining is slow, compared to various open-addressing schemes &#8211; and that the slowness is worse than one would expected if you just considered the number of probes &#8211; and this is in part because chaining has zero MLP, but most (all?) open-addressing schemes naturally get approximately unlimited MLP.</p>
<p>I have a couple more things to say, but man this is already getting long &#8230; it&rsquo;s a weakness of mine. Overwhelm the other party with a wall of text :).</p>
</div>
<ol class="children">
<li id="comment-363372" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-09T17:15:48+00:00">November 9, 2018 at 5:15 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
To me, the â€œperfectâ€ example of MLP gets approximately a factor of N<br/>
improvement by doing N memory accesses in parallel
</p></blockquote>
<p>Sure, this is great when you you can get it. But I&rsquo;d call it a &ldquo;perfect example&rdquo; if it describes a situation where a better algorithm that naively looks much more expensive (N * x) turns out to come at an affordable price (1.1 * x).</p>
<blockquote><p>
The â€œcuckooâ€ part of inserts, where you push elements around until you<br/>
find an empty space, might be faster, but is this really a large part<br/>
of the insert cost for a properly sized table?
</p></blockquote>
<p>Yes, while it depends on what you mean by &ldquo;properly sized&rdquo;, I think this turns out to be a dominant cost. At anything approaching &ldquo;full&rdquo;, the costs of insertion are going to be dominated by the length of the eviction chains. And while it&rsquo;s good to have all your lookups be 1 cycle faster, this might be unaffordable if it means that 1 insert of a million requires a full rehash requiring a few seconds to finish.</p>
<p>Arguing against myself (saying that 2-ary is sufficient), it&rsquo;s possible that there are better ways to achieve resilience while still keeping high memory density. One is to have a &ldquo;stash&rdquo; table that can also be used as a last resort for anything that can&rsquo;t otherwise fit. Another is to use larger buckets per hash that take advantage of cacheline sized transfers. This 2006 Microsoft paper by Erlingsson, Manasse and McSherry that larger buckets is better than more hashes: <a href="https://www.ru.is/faculty/ulfar/CuckooHash.pdf" rel="nofollow ugc">https://www.ru.is/faculty/ulfar/CuckooHash.pdf</a></p>
<blockquote><p>
If you are doing twenty probes on average to insert your element, you<br/>
are not going to have fast inserts, even if you try to exploit MLP.<br/>
You should look for less than 2 probes on average.
</p></blockquote>
<p>I think the goal of &ldquo;fast inserts&rdquo; is really to make the worst cases very rare, and not quite as expensive. At a 1000:1 read to write ratio, 20 probes with low variance might be a fine solution, especially if it gives you the ability to &ldquo;upgrade in place&rdquo; rather than requiring a &ldquo;stop the world&rdquo; rehash event.</p>
<blockquote><p>
I have a couple more things to say, but man this is already getting<br/>
long â€¦ it&rsquo;s a weakness of mine. Overwhelm the other party with a wall<br/>
of text :).
</p></blockquote>
<p>Keep them coming &#8212; I like your walls of text, especially when I&rsquo;m searching for something a year later and I find you&rsquo;ve already given a complete answer.</p>
</div>
<ol class="children">
<li id="comment-363378" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-09T18:10:14+00:00">November 9, 2018 at 6:10 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Sure, this is great when you you can get it. But I&rsquo;d call it a â€œperfect exampleâ€ if it describes a situation where a better algorithm that naively looks much more expensive (N * x) turns out to come at an affordable price (1.1 * x).
</p></blockquote>
<p>Yes, that&rsquo;s a perfect example of MLP causing a surprising result, but it may not be an example of MLP making a good algorithm faster or where a better than expected implementation was available due to MLP which I what I thought we after.</p>
<p>As an example, I could take any algorithm an add some redundant accesses that don&rsquo;t really do anything, and it might not be as slow as you might think due to MLP (in the extreme, it might be the same speed as the original algorithm). So that would be a perfect example of MLP making something faster <em>than expected</em> but not actually any better because the new accesses are useless.</p>
<p>It&rsquo;s not just a vapid example: it&rsquo;s more or less how I saw the cuckoo suggestion: of course you can probe more locations, but why? It doesn&rsquo;t obviously speed up probing (and I think it will slow it down). It may speed up inserts, and it may speed up probing indirectly due to better caching, but I would definitely classify that as a subtle argument versus a perfect example.</p>
<blockquote><p>
Yes, while it depends on what you mean by â€œproperly sizedâ€, I think this turns out to be a dominant cost. At anything approaching â€œfullâ€, the costs of insertion are going to be dominated by the length of the eviction chains. And while it&rsquo;s good to have all your lookups be 1 cycle faster, this might be unaffordable if it means that 1 insert of a million requires a full rehash requiring a few seconds to finish.
</p></blockquote>
<p>I admit to not knowing what is the dominant cost for inserts. My &ldquo;properly sized&rdquo; I mean that we assume the user isn&rsquo;t stupid and so sets his rehash threshold appropriately for his workload. For example, if he cares about inserts mostly, then probably he will do the rehashing more often to keep the chains lower (both for 2-ary and other arities).</p>
<p>So given that, I that properly sized 2-ary and N-ary will both have reasonable insert behavior, and about the same number of rehashes, but that the 2-ary table will just be bigger because it can sustain a lower load factor. Sustain is really the wrong word: what I mean is that a properly sized table will have a lower load factor for 2-ary (indeed, support for higher load factors is the primary advantage of higher arities).</p>
<blockquote><p>
I think the goal of â€œfast insertsâ€ is really to make the worst cases very rare, and not quite as expensive. At a 1000:1 read to write ratio, 20 probes with low variance might be a fine solution, &#8230;
</p></blockquote>
<p>Well if you have a 1000:1 read to write ratio, then you really don&rsquo;t want to add probes to your read case! I&rsquo;d argue there you just optimize for reads.</p>
<blockquote><p>
that larger buckets is better than more hashes
</p></blockquote>
<p>Yes, that&rsquo;s basically what I meant by &ldquo;bucketized&rdquo; hash above, although I don&rsquo;t know what the best way to handle overflow is. Probably it depends on the use case: if you don&rsquo;t need to support deletes (or are fine with slow deletes), for example, many strategies become simpler or more efficient.</p>
<blockquote><p>
&#8230; especially if it gives you the ability to â€œupgrade in placeâ€ rather than requiring a â€œstop the worldâ€ rehash event.
</p></blockquote>
<p>As above, I think this is the wrong way to look at it. Rehashes are going to occur in 2-ary and 3-ary tables. It doesn&rsquo;t qualitatively change the basic tradeoffs and worst-case edges for cuckoo. If you compare a 2-ary table that needs to rehash all the time and destroying your SLAs due to stop-the-world events vs a 3-ary one that never does that, then you are &ldquo;doing it wrong&rdquo; somehow with the 2-ary case.</p>
<blockquote><p>
Keep them coming
</p></blockquote>
<p>OK, I&rsquo;ll add one per reply so things don&rsquo;t get out of hand with a giant branching conversation :).</p>
<p>Here&rsquo;s one that is not too convincing but it is worth mentioning.</p>
<p>I thought (I could be wrong) the original post sort of suggested the extension to a 3-ary (or more generally N-ary) search was &ldquo;obvious&rdquo;, i.e., in the same way that binary search is extended to 3-ary search and beyond.</p>
<p>It&rsquo;s not so simple though! 2-ary is special in cuckoo because it means that the insertion search is linear: there is only one (other) place to put each element so your path is set, and you can detect cycles and so on (except for the first choice, where you can kick out either element)</p>
<p>3-ary is already much more complicated: when you are evicting an element, you have 2 possible alternate places to put it. So it&rsquo;s a tree search, and detecting cycles is more complicated, etc.</p>
<p>So to be really concrete about everything, we should specify how the 3-ary cuckoo is actually implemented, because those choices matter. The paper you linked, for example, suggests a random walk and then just stop after some threshold number of nodes have been visited &#8211; but that will certainly have an additional cost versus the simple search for the 2-ary case.</p>
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
<li id="comment-363002" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.antoniomallia.it" class="url" rel="ugc external nofollow">Antonio Mallia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T02:40:47+00:00">November 8, 2018 at 2:40 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
it&rsquo;s not free in any sense to check 10 locations (especially when they are not contiguous)
</p></blockquote>
<p>If they run in parallel (since independent), latency-wise doesn&rsquo;t it mean that checking 10 locations is the same of checking one?</p>
</div>
<ol class="children">
<li id="comment-363005" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T02:58:13+00:00">November 8, 2018 at 2:58 am</time></a> </div>
<div class="comment-content">
<p>No, no and no.</p>
<p>No in the first sense, from an MLP point of view, because even if the hardware offers support for &ldquo;10 concurrent requests&rdquo;, 10 requests almost certainly still takes longer than 1 requests. Not 10x longer, but maybe 2x or 1.5x or whatever longer. Not all parts of the path to memory are perfectly parallel (for example a DIMM is only servicing one request at once, so at least at that point the requests will have to wait in line).</p>
<p>Also there is variance in the time to service requests to DRAM, so the time to service 10 requests, even if perfectly parallel, will in general be longer than to service one request, because the slowest of 10 requests will be slower 9 times out of 10 than the slowest of 1 request. Just like if you mail out 10 letters in &ldquo;parallel&rdquo; the time until all letters arrive will be longer than if you just mailed out 1, even if the average time per letter was the same, due to variance.</p>
<p>No in the second sense because the time to do a lookup in a hash table isn&rsquo;t <em>just</em> the memory access. It&rsquo;s a bunch of other work too, like calculating the hashes, checking the results of the probes, and combining the results of the probes into an answer. In some cases (cache resident lookups), the memory access may be a relatively minor part of the total cost.</p>
<p>No in the third sense because the &ldquo;wasted&rdquo; MLP you want to take advantage of (i.e., the 8 wasted slots out of the 10 available), often isn&rsquo;t wasted at all: code before or after your lookup might have been using it (including other hash lookups). So doing 10 lookups is only free in an MLP sense (and ignoring the issues raised above) if you can guarantee that there are no other accesses that would have overlapped with those implied by the lookup.</p>
<p>What it does mean, however, is that if you find that latency is memory is 100 ns, then adding 8 additional lookups probably won&rsquo;t cost anywhere near 8 * 100 = 800 ns, but much less.</p>
<p>You may be misunderstanding the advantages of Cuckoo hash though: one reason it is fast is that the Cuckoo strategy means you don&rsquo;t have to probe many locations to find an item. If you want to probe a lot of locations for some reason, much simpler old-school probe functions will let you do just that.</p>
</div>
<ol class="children">
<li id="comment-363011" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.antoniomallia.it" class="url" rel="ugc external nofollow">Antonio Mallia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T03:33:57+00:00">November 8, 2018 at 3:33 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
No in the first sense, from an MLP point of view, because even if the hardware offers support for &ldquo;10 concurrent requests&rdquo;, 10 requests almost certainly still takes longer than 1 requests. Not 10x longer, but maybe 2x or 1.5x or whatever longer. Not all parts of the path to memory are perfectly parallel (for example a DIMM is only servicing one request at once, so at least at that point the requests will have to wait in line).
</p></blockquote>
<p>Is this coming from an assumption or an actual measurement?</p>
<blockquote><p>
No in the second sense because the time to do a lookup in a hash table isn&rsquo;t just the memory access. It&rsquo;s a bunch of other work too, like calculating the hashes, checking the results of the probes, and combining the results of the probes into an answer. In some cases (cache resident lookups), the memory access may be a relatively minor part of the total cost.
</p></blockquote>
<p>My question is just relative to memory access at this point. BTW memory access is never relatively minor of the total cost from my experience.</p>
<blockquote><p>
No in the third sense because the &ldquo;wasted&rdquo; MLP you want to take advantage of (i.e., the 8 wasted slots out of the 10 available), often isn&rsquo;t wasted at all: code before or after your lookup might have been using it (including other hash lookups). So doing 10 lookups is only free in an MLP sense (and ignoring the issues raised above) if you can guarantee that there are no other accesses that would have overlapped with those implied by the lookup.
</p></blockquote>
<p>I am only interested from a serial execution prospective right now if thats what you are talking about. Anyway here we are talking about MLP per core &#8211; &ldquo;each core has an upper limit on the number of outstanding memory requests&rdquo;.</p>
<blockquote><p>
You may be misunderstanding the advantages of Cuckoo hash though.
</p></blockquote>
<p>I do not think I am.</p>
<blockquote><p>
one reason it is fast is that the Cuckoo strategy means you don&rsquo;t have to probe many locations to find an item
</p></blockquote>
<p>&ldquo;in separate chaining, following the linked list of items in each slot requires the CPU to wait to read each node in order to discover the next pointer, whereas in cuckoo hashing, the addresses of both cells that a key maps to are computable before doing any memory accesses, so the CPU may speculatively fetch both addresses. We definitely hope processor vendors don&rsquo;t take away our speculative execution!&rdquo;</p>
<p><a href="https://dawn.cs.stanford.edu/2018/01/11/index-baselines/" rel="nofollow ugc">https://dawn.cs.stanford.edu/2018/01/11/index-baselines/</a></p>
</div>
<ol class="children">
<li id="comment-363012" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.antoniomallia.it" class="url" rel="ugc external nofollow">Antonio Mallia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T03:35:33+00:00">November 8, 2018 at 3:35 am</time></a> </div>
<div class="comment-content">
<p>I quoted the wrong sentence of the blog post.</p>
<p>&ldquo;This difference surprised us, because the separate chaining table should be making fewer memory acceses per key than the cuckoo table on average, but one reason it can happen on modern hardware is indirect accesses&rdquo;</p>
<p><a href="https://dawn.cs.stanford.edu/2018/01/11/index-baselines/" rel="nofollow ugc">https://dawn.cs.stanford.edu/2018/01/11/index-baselines/</a></p>
</div>
</li>
<li id="comment-363020" class="comment even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T04:14:14+00:00">November 8, 2018 at 4:14 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Is this coming from an assumption or an actual measurement?
</p></blockquote>
<p>Both. It&rsquo;s just the way the hardware works, so that&rsquo;s the &ldquo;assumption&rdquo; part &#8211; but it&rsquo;s easy to measure and I have measured it many times. You can measure it with Daniel&rsquo;s program that he links above: it outputs the runtime for the test and you can see that despite having &ldquo;hardware&rdquo; parallelism of 10 (in particular, that there are 10 line fill buffers on modern chips), you never get to 10x the performance, and as you approach 10 parallel accesses, the performance increase is substantially less than the maximum.</p>
<p>Here&rsquo;s a <a href="https://lemire.me/blog/2018/07/31/getting-4-bytes-or-a-full-cache-line-same-speed-or-not">tangentially related post</a> that upends the a similar idea that accesses to the same cache line are essentially free once you&rsquo;ve brought the line in from memory. Even though that code is missing on <em>every</em> cache line, so would appear to be completely memory bound, the supposed &ldquo;free&rdquo; addition of the other elements ends up costing a lot despite the typical model of how this works indicating that they should cost essentially nothing.</p>
<blockquote><p>
My question is just relative to memory access at this point. BTW memory access is never relatively minor of the total cost from my experience.
</p></blockquote>
<p>I don&rsquo;t think such a question can be answered directly, since you can&rsquo;t just isolate memory access from the rest of the work &#8211; but yes, in general yeah the more time your program spends waiting on long latency misses, but not <em>many</em> such misses at one time, the more opportunity there is to &ldquo;slip&rdquo; additional misses into that window.</p>
<p>Usually you try to do this by rearranging your existing misses so more of them can happen in parallel, increasing MLP in a &ldquo;useful&rdquo; way, not by adding extra misses that weren&rsquo;t needed in the first place to &ldquo;use up&rdquo; the &ldquo;unused MLP&rdquo;. That is, high MLP is a means to higher performance, not and end into itself.</p>
<blockquote><p>
I am only interested from a serial execution prospective right now if thats what you are talking about. Anyway here we are talking about MLP per core â€“ â€œeach core has an upper limit on the number of outstanding memory requestsâ€.
</p></blockquote>
<p>I am only talking about a single core. If I talk about &ldquo;serial&rdquo; or &ldquo;parallel&rdquo; I am only taking about within a single core, and those words refer to the inherent serial or parallel nature of the algorithm (e.g., ILP and MLP).</p>
<p>For example, looking up 100 given keys in a hash is a &ldquo;parallel&rdquo; type of work (at least with respect to the hash map). Even though you write serial code to look up the keys one by one, the CPU will probably be able to do some the accesses in parallel, since there is no dependence from the result of one lookup to the input of the next. In this kind of scenario, trying to squeeze out a lot of MLP in a single lookup may not be productive, because you would have used much or all of that MLP anyways because the CPU will overlap the accesses for different lookups.</p>
<p>A serial example is a bit more contrived (in this case), but would be something like starting with one key, looking it up, then using the result of the lookup the calculate a second key value, and so on, for 100 lookups. Here the CPU cannot overlap the accesses in separate lookups so any MLP you get has to come from accesses within a single lookup.</p>
<blockquote><p>
â€œin separate chaining, following the linked list of items in each slot requires the CPU to wait to read each node in order to discover the next pointer, whereas in cuckoo hashing, the addresses of both cells that a key maps to are computable before doing any memory accesses, so the CPU may speculatively fetch both addresses. We definitely hope processor vendors don&rsquo;t take away our speculative execution!
</p></blockquote>
<p>Yes, I know. Chaining involves pointer chasing and is slow. Looking up all buckets in parallel is (often) good and fast hashes will do it, it&rsquo;s not something unique to Cuckoo hashing.</p>
<p>I&rsquo;m still not following your suggestion though: you don&rsquo;t want to start adding more lookups &ldquo;just because&rdquo; there is some unused MLP, unless it can speed things up, because they are not free. Cuckoo hashing is fast in part because an item appears in exactly one of two locations, and these locations can be checked in parallel. Changing that to three locations doesn&rsquo;t obviously speed that up, and in fact would slow it down in general. I guess what it would let you do is increase the load factor slightly by delaying the rehash. That&rsquo;s probably a minor effect &#8211; will it be able to pay off enough on average to overcome to cost of the third access? Maybe.</p>
<p>There are plenty of cases though where additional parallel lookups are just an obvious big win. Any time you can change your accesses from serial to parallel (as above), you can get a giant leap, even if it looks like you are doing a lot more work. For example, in any kind of depth-first graph search algorithm, you want to try to mix in a bit of BFS by maintaining a &ldquo;horizon&rdquo; of active nodes that you expand in a round-robin fashion, rather than the default, clean approach of DFS. It complicates things, makes you execute more total instructions, and possibly more total loads, but ends up faster because you get more MLP.</p>
</div>
</li>
<li id="comment-363021" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T04:21:14+00:00">November 8, 2018 at 4:21 am</time></a> </div>
<div class="comment-content">
<p>you are not taking into account what is happening after the hash table lookup. by filling all of the available slots you are preventing the processor from executing further ahead in your program and finding more useful things to load. take for example doing these hash table lookups in a loop. if you have 10 load slots and do 10 loads per hash table lookup, you will wait for all 10 loads to return before starting the next iteration of the loop. if you only do 2 loads per hash table lookup, your processor may be able to continue executing instructions out of order into the next iteration of the loop, and you may be able to have the loads for 5 iterations of the loop executing simultaneously, which would be close to 5x faster.</p>
<p>of course this requires the next hash table lookup to not depend on the result of the current hash table lookup. this is why the chained approach is so slow, pointer based data structures are a very poor match for modern processors since the address of the next load is dependent on the result of the current load.</p>
</div>
<ol class="children">
<li id="comment-363025" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.antoniomallia.it" class="url" rel="ugc external nofollow">Antonio Mallia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T04:41:13+00:00">November 8, 2018 at 4:41 am</time></a> </div>
<div class="comment-content">
<p>Absolutely true, but you are missing the advantages of having 10 possible slots instead of 2 only.<br/>
Now, when inserting a key, I need to have 10 collisions instead of 2 before performing a cascading relocation which can end up in O(n) asymptotic complexity. Probabilistically speaking now it is quite rare to happenâ€¦</p>
<p>Now, don&rsquo;t get me wrong, I am not saying one solution is better than the other. The blanket is just too short, so it is all about finding the right trade of for your data.</p>
</div>
<ol class="children">
<li id="comment-363026" class="comment odd alt depth-10 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antonio Mallia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T04:42:01+00:00">November 8, 2018 at 4:42 am</time></a> </div>
<div class="comment-content">
<p>Sorry for the multiple replies. The website had a 500 internal server error while I was sending my answer.</p>
</div>
</article>
</li>
<li id="comment-363126" class="comment byuser comment-author-lemire bypostauthor even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T14:08:39+00:00">November 8, 2018 at 2:08 pm</time></a> </div>
<div class="comment-content">
<p>I am aware of the numerous 500 errors. As far as I can tell, they have to do with my server being overloaded. I have issued a technical request to my service provider and I will find a solution with them.</p>
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
<li id="comment-362630" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benoit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T08:37:43+00:00">November 6, 2018 at 8:37 am</time></a> </div>
<div class="comment-content">
<p>This is awesome! There is so little info or optimization tools for memory access (other than from you I feel). Thank you!</p>
<p>I ran your code on two iOS devices (Release build, outside of debugger). Here are the results:</p>
<p>A9X (iPad Pro 12.9&#8243; 1st gen): 5</p>
<p>A11 (iPhone X): 3, maybe 4</p>
<p>Here is the last run on the iPhone X:</p>
<p><code>1 1.130405<br/>
2 0.600105<br/>
3 0.560135<br/>
4 0.540118<br/>
5 0.550119<br/>
6 0.500108<br/>
7 0.520111<br/>
8 0.430093<br/>
9 0.460116<br/>
10 0.450103<br/>
11 0.340088<br/>
12 0.320091<br/>
13 0.310085<br/>
14 0.300080<br/>
</code></p>
</div>
</li>
<li id="comment-362690" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T15:21:58+00:00">November 6, 2018 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>It sure looks like the latest iPhone has plenty of memory-level parallelism.</p>
</div>
<ol class="children">
<li id="comment-362691" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benoit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T15:27:06+00:00">November 6, 2018 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>Why? Do you think there is something wrong with the iPhone X run? Or that the 2018 iPhone are much better than the X?</p>
</div>
<ol class="children">
<li id="comment-362695" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T16:02:45+00:00">November 6, 2018 at 4:02 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, by latest I meant &ldquo;iPhone X&rdquo;. It is clearly not the latest on the market though it is the latest in your tests.</p>
<p>My benchmark goes up to 14 and stops there because I did not expect anything much to happen after 14. Clearly, the numbers you have suggest that it would be worth going beyond 14 lanes.</p>
<p>In this sense that A11 processor defeats my benchmark.</p>
<p>Something happens around 4 or 5 lanes that make a lane increase &ldquo;bad&rdquo;, but if you keep going, then more parallelism shows up.</p>
<p>My benchmark is crude, so you should not believe what it says, you need to take a look at the numbers for yourself.</p>
</div>
<ol class="children">
<li id="comment-362700" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benoit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T16:33:20+00:00">November 6, 2018 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Yes, the story seems more complicated on Apple processors. Below are the numbers up to 29 lanes. It looks suspicious at 15 on the iPad, but it&rsquo;s not a fluke: all runs are virtually the same.</p>
<p><code>iPad Pro 1G iPhone X</p>
<p>1 1.59747 1 1.140326<br/>
2 0.845847 2 0.620127<br/>
3 0.714404 3 0.560123<br/>
4 0.609029 4 0.550142<br/>
5 0.490035 5 0.550118<br/>
6 0.493946 6 0.500108<br/>
7 0.508048 7 0.520111<br/>
8 0.469345 8 0.430103<br/>
9 0.434727 9 0.460096<br/>
10 0.43067 10 0.440094<br/>
11 0.419054 11 0.340067<br/>
12 0.498453 12 0.320072<br/>
13 0.614335 13 0.310072<br/>
14 0.581587 14 0.300075<br/>
15 0.101332 15 0.300057<br/>
16 0.104928 16 0.280063<br/>
17 0.103828 17 0.270066<br/>
18 0.104522 18 0.240057<br/>
19 0.106745 19 0.200047<br/>
20 0.104215 20 0.120028<br/>
21 0.100903 21 0.080018<br/>
22 0.100042 22 0.080017<br/>
23 0.099389 23 0.080018<br/>
24 0.105125 24 0.080018<br/>
25 0.106232 25 0.080018<br/>
26 0.104692 26 0.080016<br/>
27 0.100769 27 0.080016<br/>
28 0.103166 28 0.080018<br/>
29 0.100798 29 0.080014<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-362702" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T16:46:39+00:00">November 6, 2018 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>What happens at 15 looks more like a limitation of my benchmark than a genuine measure.</p>
</div>
<ol class="children">
<li id="comment-362831" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benoit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-07T07:36:08+00:00">November 7, 2018 at 7:36 am</time></a> </div>
<div class="comment-content">
<p>I reran on the iPad pro after adding a *15 factor to your <code>howmanyhits</code> formula. Same curve scaled by 15, same drop at 15 lanes. And there is no dumb cut-and-paste mistake in the code I added (in case you are, rightly, wondering ;-). Anyway, it occurs at 22 on the iPhone X&#8230;</p>
</div>
<ol class="children">
<li id="comment-362930" class="comment byuser comment-author-lemire bypostauthor even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-07T20:16:04+00:00">November 7, 2018 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p><em>I reran on the iPad pro after adding a x15 factor to your howmanyhits formula.</em></p>
<p>I doubt that it would change anything.</p>
<p><em>And there is no dumb cut-and-paste mistake in the code I added</em></p>
<p>I am not assuming that the mistake is yours.</p>
<p>How do you run these tests on iOS? It has been some time since I ran shell programs on iOS. The last I did I did, I was using a rooted iPad (first generation), with a ssh server&#8230;</p>
<p>Presumably, you could wrap the code inside some &ldquo;App&rdquo; and upload that to the device, but it seems like a lot of work.</p>
</div>
<ol class="children">
<li id="comment-363058" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benoit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T08:00:21+00:00">November 8, 2018 at 8:00 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
I am not assuming that the mistake is yours.
</p></blockquote>
<p>You are too kind. That would have been my first thought 😉</p>
</div>
</li>
</ol>
</li>
<li id="comment-362980" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">harold</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T00:49:18+00:00">November 8, 2018 at 12:49 am</time></a> </div>
<div class="comment-content">
<p>Does it still happen if you add a volatile sink <a href="https://gist.github.com/IJzerbaard/fc64f56bea7fde57c49c721b54d54a74#file-testingmlp-cpp-L31" rel="nofollow">like this</a>? I had some trouble without that using MSVC, getting some suspiciously low timings for some but not all lane counts. Perhaps something like that is happening here too, but only starting at some high lane count?</p>
</div>
<ol class="children">
<li id="comment-362986" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T01:17:06+00:00">November 8, 2018 at 1:17 am</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s weird is that the effect happens on the iPad but not the iPhone. If it were a result of a compile quirk (which is entirely possible), you&rsquo;d think it would be the same on both.</p>
<p>That is at least the usual case with AOT compilation, but I guess Apple has this thing now where you upload IR to the app store and then it is &ldquo;specialized&rdquo; for each device, so potentially that could be making difference decisions for the iPad vs the iPhone? Although again I guess the app store is probably not really involved here since this would have just been loaded on directly in &ldquo;developer mode&rdquo; or whatever that&rsquo;s called.</p>
<p>Another thing that could cause it is &ldquo;small&rdquo; vs &ldquo;big cores&rdquo; &#8211; as I recall the A12 is a heterogeneous CPU with a mix of higher-speed latency oriented cores, and lower power cores for less demanding or &ldquo;throughput&rdquo; oriented tasks. Maybe the cutover is when the process transitions from one core type to another?</p>
</div>
<ol class="children">
<li id="comment-362987" class="comment byuser comment-author-lemire bypostauthor even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T01:21:14+00:00">November 8, 2018 at 1:21 am</time></a> </div>
<div class="comment-content">
<p><em>Maybe the cutover is when the process transitions from one core type to another?</em></p>
<p>Why would this happen systematically at the same number of lanes? Not saying that it is impossible&#8230; just that if it happens, it is a bit magical.</p>
<p>I am hoping to be able to reproducing BenoÃ®t&rsquo;s results.</p>
</div>
<ol class="children">
<li id="comment-362990" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T01:28:58+00:00">November 8, 2018 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know how it works exactly, but it wouldn&rsquo;t be entirely surprising to me that the basic idea is that a process is profiled and after some period of time running a certain way is moved over to another core. If that time period is the same, I would expect it to move over at about the same time each time (and there is some room for error since we report the min time out of a few runs, so the don&rsquo;t necessary expect to see one &ldquo;half way&rdquo; run at one point).</p>
<p>I don&rsquo;t think it is necessarily the cause here, but certainly this heterogeneous core thing causes bimodal benchmark results in other cases.</p>
<p>One easy check would be to increase/decrease the number of measurements per lane count and see if the transition point moves.</p>
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
<li id="comment-362696" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T16:14:34+00:00">November 6, 2018 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>I ran a similar test in 2012 and found that the answer was 5 with hyper threading on and 10 with it off on ivy bridge. Did you have hyper threading turned on or off for your experiment?</p>
</div>
<ol class="children">
<li id="comment-362701" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T16:44:00+00:00">November 6, 2018 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>I always try to disable hyperthreading. It would be interesting to document the effect of hyperthreading on current processors.</p>
</div>
</li>
<li id="comment-362939" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-07T21:37:41+00:00">November 7, 2018 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>When you say &ldquo;5 with hyper threading on&rdquo; do you mean in a test that ran two threads on the same core, you saw a value of 5 for <em>each thread</em>, for a total of 10? That&rsquo;s the result I would expect.</p>
<p>If you mean something else, like you merely turned HT on, but then run a single-threaded test and see a value of only 5, then it is both surprising and interesting.</p>
</div>
<ol class="children">
<li id="comment-431131" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-11T18:27:42+00:00">October 11, 2019 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>responding almost a year late, but what i found was that merely by turning HT on a single threaded test showed a value of 5. this was on either ivy bridge or sandy bridge, so it may be different on modern hardware.</p>
</div>
<ol class="children">
<li id="comment-431330" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T20:36:03+00:00">October 12, 2019 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t that&rsquo;s true if you run the test with HT on <em>but nothing else running on the sibling core</em>. That is, all resources should be available to a single thread running on a core, when only a single thread is actually running, even if HT is enabled (the only exception being PMU counters, which <em>do</em> depend on whether HT in on in the BIOS).</p>
<p>In particular for LFBs (fill buffers: the things that limit the per-core parallelism), I believe they are shared competitively when two threads are running: either core can use approximately as many as they need, but of course the limit is still 10. So one thread should be able to use all 10.</p>
<p>Perhaps what happened is that something else ended up running at the same time, on the same core, as your test? Was it very reproducible?</p>
</div>
<ol class="children">
<li id="comment-431334" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T20:58:36+00:00">October 12, 2019 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>It was highly reproducible. I never saw a result indicating the existance of more than 5 load fill buffers in a single threaded test with hyper threading on. I also tested pulling all the dimms except one to see if that had any effect and from what I remember the impact was minimal. I don&rsquo;t remember how many ranks were on the dimm but I can&rsquo;t check now since that computer went into the trash a long time ago.</p>
</div>
<ol class="children">
<li id="comment-431337" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T21:18:39+00:00">October 12, 2019 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>That is pretty interesting. Maybe those older uarches really did have boot-time-fixed partitioned LFBs.</p>
<p>Daniel, do you have any machine older than HSW? Such machines are still available in the cloud, although probably not for that much longer.</p>
</div>
<ol class="children">
<li id="comment-431340" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T21:42:07+00:00">October 12, 2019 at 9:42 pm</time></a> </div>
<div class="comment-content">
<p>Travis: yes, I have older boxes still working and accessible but often the software is also old. Get in touch by email.</p>
</div>
</li>
</ol>
</li>
<li id="comment-431338" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T21:23:12+00:00">October 12, 2019 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s interesting, perhaps these resources were boot-time partitioned on older uarches.</p>
<p>Daniel do you have any Intel box older than HSW?</p>
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
<li id="comment-362740" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d541b0d2e3837f334c847d634621490?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d541b0d2e3837f334c847d634621490?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T20:52:57+00:00">November 6, 2018 at 8:52 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m wondering.. could some of the inconsistencies seen above be related to the processor pipeline depth? It&rsquo;s been a while since I studied that but, from what I recall, memory load were issued in earlier stages. So it looks like you fill the pipeline with load instructions and hit a wall when you have more lanes than space in the pipeline. Does that still makes sense?</p>
</div>
<ol class="children">
<li id="comment-362765" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-06T23:22:10+00:00">November 6, 2018 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>I think you are correct&#8230; but it does not explain the ios numbers where things just speed up insanely beyond 14 lanes (my own code stops at 14 lanes).</p>
</div>
</li>
</ol>
</li>
<li id="comment-363024" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24cffb11e0ffc0ab5785c52db3b89ce2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.antoniomallia.it" class="url" rel="ugc external nofollow">Antonio Mallia</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-08T04:39:43+00:00">November 8, 2018 at 4:39 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
you are not taking into account what is happening after the hash table lookup. by filling all of the available slots you are preventing the processor from executing further ahead in your program and finding more useful things to load. take for example doing these hash table lookups in a loop. if you have 10 load slots and do 10 loads per hash table lookup, you will wait for all 10 loads to return before starting the next iteration of the loop. if you only do 2 loads per hash table lookup, your processor may be able to continue executing instructions out of order into the next iteration of the loop, and you may be able to have the loads for 5 iterations of the loop executing simultaneously, which would be close to 5x faster.
</p></blockquote>
<p>Absolutely true, but you are missing the advantages of having 10 possible slots instead of 2 only.<br/>
Now, when inserting a key, I need to have 10 collisions instead of 2 before performing a cascading relocation which can end up in O(n) asymptotic complexity. Probabilistically speaking now it is quite rare to happen&#8230;</p>
<p>Now, don&rsquo;t get me wrong, I am not saying one solution is better than the other. The blanket is just too short, so it is all about finding the right trade of for your data.</p>
</div>
</li>
<li id="comment-364777" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luiceur</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T14:15:23+00:00">November 14, 2018 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>I am amazed! You did this in 15min!</p>
</div>
<ol class="children">
<li id="comment-364783" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T15:32:10+00:00">November 14, 2018 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>The initial code was indeed written in maybe 15 minutes. I think it is fair to say that anyone who knows C well enough could have done so just as fast or faster.</p>
</div>
<ol class="children">
<li id="comment-364786" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15f5e601bc93561627decddd6e2e7020?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luiceur</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T15:43:37+00:00">November 14, 2018 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p>Why C++ instead of C? if I may ask</p>
</div>
<ol class="children">
<li id="comment-364789" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T15:47:35+00:00">November 14, 2018 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>There is no particular reason in this instance. It would not be much effort to convert the code to pure C. But there would also not be a lot of benefit to it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-364844" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d90362c092774baa13522df95d62dad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d90362c092774baa13522df95d62dad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-14T20:54:33+00:00">November 14, 2018 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>Your MLP measurement code is likely limited by how big the scheduler window is, not by how many misses the hardware can track.</p>
<p>For each load miss, your code (next address computation) has 7~8 dependent op piled behind it, which likely takes up space in the scheduling window.</p>
<p>Once we have 7~8 misses, we have filled up the scheduler window and machine will not be able to observe the memory access from next lane, even when the address for that lane is ready.</p>
</div>
</li>
<li id="comment-365430" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-17T01:34:42+00:00">November 17, 2018 at 1:34 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s why we introduced the &ldquo;naked&rdquo; version of the test, which uses N parallel pointer chases that generally has zero additional ops per load. For example, the loop for the <code>naked_access_8</code> function for 8 parallel chains looks like:</p>
<p><code>ff0: add rdx,0x1<br/>
ff4: mov rcx,QWORD PTR [rdi+rcx*8]<br/>
ff8: mov r8,QWORD PTR [rdi+r8*8]<br/>
ffc: cmp rsi,rdx<br/>
fff: mov r9,QWORD PTR [rdi+r9*8]<br/>
1003: mov r10,QWORD PTR [rdi+r10*8]<br/>
1007: mov r11,QWORD PTR [rdi+r11*8]<br/>
100b: mov rax,QWORD PTR [rdi+rax*8]<br/>
100f: mov rbp,QWORD PTR [rdi+rbp*8]<br/>
1013: mov rbx,QWORD PTR [rdi+rbx*8]<br/>
1017: jne ff0 &lt;naked_access_8(unsigned long*, unsigned long)+0x40&gt;<br/>
</code></p>
<p>It&rsquo;s just the 8 load instructions, plus an increment, compare and jump (in principle, the compiler could have removed the <code>cmp</code> by counting down to zero, but my version of gcc isn&rsquo;t smart enough).</p>
<p>The later results Daniel have reported, such as <a href="https://lemire.me/blog/2018/11/13/memory-level-parallelism-intel-skylake-versus-apple-a12-a12x/">in this post</a> are all using this version of the test, as far as I know. I&rsquo;m not sure if the results the post we are commenting are using the &ldquo;naked&rdquo; or original hash-based test, but we&rsquo;ve done both and they are more or less consistent for those platforms. I think Daniel could confirm where the numbers in the table above come from.</p>
<p>The pointer chasing test has the downside that it starts to produce ugly code once you run out of registers.</p>
</div>
</li>
<li id="comment-367553" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/420086dad5ba89df4492894d557e0cad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/420086dad5ba89df4492894d557e0cad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Heechul Yun</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-24T11:27:05+00:00">November 24, 2018 at 11:27 am</time></a> </div>
<div class="comment-content">
<p>Intel core&rsquo;s MLP is 10 (in Nehalem/Haswell and likely in newer architectures as well) and ARM&rsquo;s MLP is 6 (at least in Cortex-A15/A17). Please check <a href="http://ittc.ku.edu/~heechul/papers/taming-rtas2016-camera.pdf" rel="nofollow">this paper</a> (Appendix A; Figure 11) and <a href="https://github.com/CSL-KU/IsolBench/blob/master/bench/latency-mlp.cpp" rel="nofollow">the code</a>.</p>
</div>
<ol class="children">
<li id="comment-367672" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-24T20:30:22+00:00">November 24, 2018 at 8:30 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the paper, and especially for making your code available. The test you used to determine MLP is the same one in spirit to the one that we are using now, and we get similar results [1]. Interestingly, on Skylake, performance increases until an MLP factor of 12, rather than 10 &#8211; although the total increase in performance is still around 10x, so it is not clear to me if there are 10, 11 or 12 MSHRs on Skylake. An uncached (NT) write test indicates there are 12 write-combining buffers on Skylake, versus 10 on Haswell, and under the assumption that WC buffers and MSHRs are using the same underlying hardware it points towards 12 MSHRs on Skylake.</p>
<p>One thing I learned from the paper that is surprising to me was the idea that MSHR exhaustion blocks further access to the cache, <em>including hits</em>:</p>
<blockquote><p>
Moreover, if there are no remaining MSHRs, further accesses to<br/>
the cacheâ€”both hits and missesâ€”are blocked until free MSHRs become<br/>
available [2], because whether a cache access is hit or miss<br/>
is not known at the time of the access [33]. In other words, cache<br/>
hit requests can be delayed if all MSHRs are used up.
</p></blockquote>
<p>It is not entirely obvious to me why this should be the case, especially for the L1 MSHRs &#8211; why could they not service a hit even if all MSHRs are full? I checked the references [2] and [33], and both resources mention this behavior but not why this is the case. Do you have any idea?</p>
<p>One reason could be that each level of the cache wants to &ldquo;hand off&rdquo; the request to the next level, but if there are no MSHRs available at the next level there is essentially nowhere to store the request if it misses, so it is easier just to block all incoming requests if there are no MSHRs. I&rsquo;m not sure that applies to the L1 though: since you already have a replay mechanism at the scheduler level which will retry rejected requests.</p>
<p>[1] One difference is that Daniel&rsquo;s code uses generated functions for each MLP level tested, with local variables for each pointer chasing chain like:</p>
<p><code>idx1 = array[idx1];<br/>
idx2 = array[idx2];<br/>
...<br/>
</code></p>
<p>Rather than using array elements like idx[1], idx[2], and a fall-thru switch that covers all cases. This avoids any extra memory reads or write under very the basic assumption that the compiler enregisters local variables. Using array elements could also be optimized out, but it requires a much more sophisticated compiler that can scalarize the array accesses through complex control slow like the switch statement.</p>
</div>
<ol class="children">
<li id="comment-367884" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/420086dad5ba89df4492894d557e0cad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/420086dad5ba89df4492894d557e0cad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ittc.ku.edu/~heechul/" class="url" rel="ugc external nofollow">Heechul Yun</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-25T14:28:53+00:00">November 25, 2018 at 2:28 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
It is not entirely obvious to me why this should be the case,<br/>
especially for the L1 MSHRs â€“ why could they not service a hit even if<br/>
all MSHRs are full? I checked the references [2] and [33], and both<br/>
resources mention this behavior but not why this is the case. Do you<br/>
have any idea?
</p></blockquote>
<p>My understanding is that probing the cache&#8212;determining whether an access is a cache hit or miss&#8212;takes time (i.e., generally cannot be done in a single cycle, especially for L2/L3).<br/>
You may also find this additional <a href="http://www.archive.ece.cmu.edu/~ece447/s15/lib/exe/fetch.php?media=lab7.pdf" rel="nofollow">lab material</a> (page 2) from Prof.Onur Mutlu at CMU (now at ETH) interesting.</p>
</div>
<ol class="children">
<li id="comment-368717" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-28T00:27:37+00:00">November 28, 2018 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>Thanks. The lab material just repeats the idea that the cache cannot be accessed at all if its MSHRs are full &#8211; it doesn&rsquo;t give any reasoning. It is also not clear if in this case it is just a simplification or actually intends to model real hardware (see the preceding item, for example, which is clearly just a simplification).</p>
<p>It isn&rsquo;t clear to me what the significance of &ldquo;taking time&rdquo; means. Certainly the process of probing the cache takes time, as seen by the core itself. Let&rsquo;s assume it takes more than one cycle. Why does that mean that hits cannot be satisfied while the MSHRs are full?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
