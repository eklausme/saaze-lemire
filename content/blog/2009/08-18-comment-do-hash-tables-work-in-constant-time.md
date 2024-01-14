---
date: "2009-08-18 12:00:00"
title: "Do hash tables work in constant time?"
index: false
---

[17 thoughts on &ldquo;Do hash tables work in constant time?&rdquo;](/lemire/blog/2009/08-18-do-hash-tables-work-in-constant-time)

<ol class="comment-list">
<li id="comment-51346" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T13:07:22+00:00">August 18, 2009 at 1:07 pm</time></a> </div>
<div class="comment-content">
<p><i> Thus accessing an entry in a hash table of size n takes time O((log n)^(1+epsilon)), not O(n^(1+epsilon)).</i></p>
<p>Duh! Thanks. (I don&rsquo;t think anyone would be using hash tables, had I been right&#8230;) (:shame:)</p>
</div>
</li>
<li id="comment-51348" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.hugedomains.com/domain_profile.cfm?d=codingadventures&#038;e=com" class="url" rel="ugc external nofollow">Rachel Blum</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T13:17:10+00:00">August 18, 2009 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re playing semantic games. If you look at algorithms, modulus computation is always considered O(1). And it is in most commercial CPUs. The time for a multiplication is indepedent of the size of the number, assuming we stay in the natural word size. The complexity you mention has simply been moved from time-complexity to gate-complexity.</p>
<p>And even if we stipulate hashing were O(log n) &#8211; where do you make the jump to O(n log n)?</p>
</div>
</li>
<li id="comment-51351" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T13:37:32+00:00">August 18, 2009 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p>@Rachel</p>
<p>Thank you for your comments. Yes, I like to play games, but please give me some credit. </p>
<p>Yes, we always assume that multiplications take constant time because we assume that we take in 64-bit integers and produce 64-bit integers using 64-bit processors. </p>
<p>But is it true?</p>
<p>No, it is not if you use vectorization. With vectorization, you can multiply four pairs of 16-bit numbers in the time it takes to multiply one pair of 64-bit numbers. And yes, people use vectorization, right now, in commercial products.</p>
<p>Further reading:</p>
<p><a href="https://en.wikipedia.org/wiki/Vectorization_(computer_science)" rel="nofollow ugc">http://en.wikipedia.org/wiki/Vectorization_(computer_science)</a></p>
</div>
</li>
<li id="comment-51353" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T13:47:29+00:00">August 18, 2009 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>@Sammy</p>
<p>When using larger hash tables, you have to compute larger hash values. This takes more time.</p>
<p>Try it out. Right now. Implement a hash table with 2^256 keys and one with 2^16 keys. You&rsquo;ll see that multiplying 256-bit integers takes longer. Thus, your 2^256-element hash table will be slower.</p>
<p>True. Nobody right now has databases with 2^256 elements. But with vectorization, you can do 4 multiplications in 16-bit in the time it takes to do one 64-bit multiplication.</p>
<p>So, right now, in real systems, I claim that larger hash tables could be slower, even if I discard the memory access time.</p>
<p>True. Few people are using vectorization *right now*. But some important people are using it for important database applications.</p>
</div>
</li>
<li id="comment-51369" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.hugedomains.com/domain_profile.cfm?d=codingadventures&#038;e=com" class="url" rel="ugc external nofollow">Rachel Blum</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T15:21:37+00:00">August 18, 2009 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>That is *still* constant time&#8230; 4*O(1)=O(1)</p>
<p>(I&rsquo;m well aware of vectorization &#8211; given that I work on games, it&rsquo;s inevitable 😉</p>
<p>Only if your key size were unlimited it would be an issue. (Because then time required for hash computation would indeed change w/ the size of your key)</p>
<p>And yes, larger hash tables are slower &#8211; but their time complexity is the same. (Don&rsquo;t you love complexity arithemtic? 😉</p>
</div>
</li>
<li id="comment-51374" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T15:46:23+00:00">August 18, 2009 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>@Rachel</p>
<p><i>And yes, larger hash tables are slower â€“ but their time complexity is the same. (Don&rsquo;t you love complexity arithemtic?)</i></p>
<p>When a 2^m-key hash table runs 2 times slower than a 2^2m-key hash table, then you have O(log n) complexity by definition. And that&rsquo;s precisely what happens when running multiple hash table queries simultaneously with vectorization.</p>
</div>
</li>
<li id="comment-51377" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.hugedomains.com/domain_profile.cfm?d=codingadventures&#038;e=com" class="url" rel="ugc external nofollow">Rachel Blum</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T16:30:58+00:00">August 18, 2009 at 4:30 pm</time></a> </div>
<div class="comment-content">
<p>As I said &#8211; it *is* a true statement when you consider variable key size.</p>
<p>But for most hash table implementations, the key size is fixed. Hence there is a constant upper bound for modulus, hence O(1)</p>
<p>That shouldn&rsquo;t change for vectorization, either, as long as the key size has a fixed upper bound.</p>
<p>What am I missing?</p>
</div>
</li>
<li id="comment-51380" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T16:52:03+00:00">August 18, 2009 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>@Rachel </p>
<p><i> But for most hash table implementations, the key size is fixed. Hence there is a constant upper bound for modulus, hence O(1)</p>
<p> That shouldn&rsquo;t change for vectorization, either, as long as the key size has a fixed upper bound.</p>
<p> What am I missing?</i></p>
<p>If you fix the maximal number of keys, then all data structures run in constant time. Even a linear scan through an array will never use more than a fixed number of operations.</p>
<p>That&rsquo;s not very exciting.</p>
</div>
</li>
<li id="comment-51382" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T17:07:55+00:00">August 18, 2009 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>@Preston </p>
<p>Regarding Pearson hashing, I specifically pointed out that multiplication was not required (see Disclaimer 1). As for Pearson being quite good&#8230; I agree, and more about this another day. Watch this blog for follow-ups. (Man! Do I wish I knew more people who knew about Pearson hashing!)</p>
<p>As for using Vectorization, the idea I had was to implement several hash tables that are queried simultaneously; or a single hash table that is queried in small batches. Why not? People are implementing and selling database engines designed around vectorization. Am I going to try doing building these vectorized hash tables today? Probably not.</p>
<p>I was just trying to get people to think about their assumptions this morning and it degenerated&#8230;</p>
</div>
</li>
<li id="comment-51345" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77c4a4f9ac59e5bb3d1733aa73e53a73?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77c4a4f9ac59e5bb3d1733aa73e53a73?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.daemonology.net/blog/" class="url" rel="ugc external nofollow">Colin Percival</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T12:48:14+00:00">August 18, 2009 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>You lost a logarithm: &ldquo;Multiplications of numbers in [0,m) can almost be done in time O(m log m)&rdquo; should read &ldquo;Multiplications of numbers in [0, 2^m) can almost be done in time O(m log m)&rdquo;.</p>
<p>Thus accessing an entry in a hash table of size n takes time O((log n)^(1+epsilon)), not O(n^(1+epsilon)).</p>
<p>There&rsquo;s a more fundamental for hash tables not being constant-time, however: Random-access memory isn&rsquo;t constant-time. You&rsquo;ve got at least log n gate delays; and once you start dealing with large amounts of storage, you&rsquo;ve got a speed-of-light cost of O(n^(1/2)) or O(n^(1/3)), depending on whether your circuits are two- or three- dimensional.</p>
</div>
</li>
<li id="comment-51384" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/894ea233d9ec21f884b29096ea7849a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.hugedomains.com/domain_profile.cfm?d=codingadventures&#038;e=com" class="url" rel="ugc external nofollow">Rachel Blum</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T18:25:24+00:00">August 18, 2009 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel &#8211; even w/ an upper bound on the number of elements, an array scan still depends on how full the array is, though.</p>
<p>A hashtable still is independent of the number of entries, for a fixed *key* size. The number of elements can be variable.</p>
<p>That&rsquo;s not saying keysize is not important, just that a hashtable w/ a fixed keysize is O(1) w/ respect to number of entries, and an array scan is O(n)</p>
<p>So I guess my quibble is that for a given key size, hash tables should be O(log k) &#8211; k being the maximum number of keys &#8211; , not O(log n).</p>
</div>
</li>
<li id="comment-51352" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0cf2fe362e3d5aadd654865b7d265da8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0cf2fe362e3d5aadd654865b7d265da8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.codeodor.com" class="url" rel="ugc external nofollow">Sammy Larbi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T13:37:32+00:00">August 18, 2009 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p>When doing complexity analysis you are supposed to be comparing apples with apples: how fast does the time or space complexity grow /with respect to the size of the input n/. </p>
<p>You are taking n as the size of the hash table at the beginning, then using n as the size of one element in another part, and Colin is (I&rsquo;m guessing facetiously) taking n as the number of logic gates in a stick of RAM.</p>
<p>Neither of these variables change as n changes, so it doesn&rsquo;t make sense to include them in analysis. Even if you do include them, they are still constants, and choosing M and x (following <a href="https://en.wikipedia.org/wiki/Big_O_notation" rel="nofollow ugc">http://en.wikipedia.org/wiki/Big_O_notation</a>) appropriately would show you the correct result.</p>
</div>
</li>
<li id="comment-51388" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T18:46:00+00:00">August 18, 2009 at 6:46 pm</time></a> </div>
<div class="comment-content">
<p>@Rachel I am happy with O(log k). But what if you are using strings as keys?</p>
</div>
</li>
<li id="comment-51379" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T16:44:10+00:00">August 18, 2009 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps I am not tracking your argument, but as far as I can tell, 32 and 64-bit integer multiply instructions take a fixed number of clocks on recent x86 CPUs (the fixed time multiply hardware went into either the 386 or 486, if memory serves). Presuming you are interested in hash tables that fit in memory, integer multiply instructions are sufficient.</p>
<p>Not sure how you would use vectorization with hashing, at least not in the usual cases.</p>
<p>Then again, for my purpose, simple Pearson hashing (not using multiply or divide) has always won out when measured over actual problem sizes.</p>
</div>
</li>
<li id="comment-51383" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">D. Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-08-18T18:05:50+00:00">August 18, 2009 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>Yes, multiplication isn&rsquo;t really constant time and memory access isn&rsquo;t really constant time, but if you&rsquo;re going to assess a penalty to those operations when you use them in hashing then you need to assess them consistently throughout whatever other algorithms you&rsquo;re using.</p>
<p>Or, you could use the uniform cost model, pretend the penalty is one, and get basically the same comparison between any two algorithms (that don&rsquo;t have drastically different memory hierarchy behavior) without all the pain.</p>
<p>Where this falls down, of course, is that the memory hierarchy behavior of hashing is bad. So if you compare it to something that&rsquo;s designed to have good lcality of reference, the uniform cost model may not be the right thing to yse.</p>
</div>
</li>
<li id="comment-54376" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-05-01T13:13:28+00:00">May 1, 2011 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>@sleepnova</p>
<p>You are correct. My blog post was over-engineered.</p>
</div>
</li>
<li id="comment-54375" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e54e3b9a091809f6e2ea65dce62d471e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e54e3b9a091809f6e2ea65dce62d471e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://sleepnova.blogspot.com/" class="url" rel="ugc external nofollow">sleepnova</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-05-01T13:06:22+00:00">May 1, 2011 at 1:06 pm</time></a> </div>
<div class="comment-content">
<p>@Rachel</p>
<p>Don&rsquo;t you think number of keys is relevant to number of entries?</p>
<p>@Daniel</p>
<p>You even don&rsquo;t have to discuss the time complexity of integer multiplication in modern CPUs. You only need to show the lower bound of the cost to generate the hash value. For ex. you have n data entries and an ideal hash function which generate hash value between 1~n without a single collision. You need a data field to contain this value in bits(Size &gt;= log n). So the cost to process this size of data is obviously O(log n). At least you have to read through it!</p>
</div>
</li>
</ol>
