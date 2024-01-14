---
date: "2018-04-30 12:00:00"
title: "Is software prefetching (__builtin_prefetch) useful for performance?"
index: false
---

[43 thoughts on &ldquo;Is software prefetching (__builtin_prefetch) useful for performance?&rdquo;](/lemire/blog/2018/04-30-is-software-prefetching-__builtin_prefetch-useful-for-performance)

<ol class="comment-list">
<li id="comment-302140" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4469ca3ad89bbbabc4559acd5f96acf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4469ca3ad89bbbabc4559acd5f96acf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-04-30T23:12:50+00:00">April 30, 2018 at 11:12 pm</time></a> </div>
<div class="comment-content">
<p>There are some papers that claim prefetch improves mark-sweep GC pause times.</p>
</div>
<ol class="children">
<li id="comment-653081" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00e37f775b9a40d339b82c1079ea5dc2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00e37f775b9a40d339b82c1079ea5dc2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Axman6</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-19T06:08:58+00:00">July 19, 2023 at 6:08 am</time></a> </div>
<div class="comment-content">
<p>The OCaml and GHC Haskell compilers both use a small queue (4-8 addresses IIRC) for the next few objects they know they are going to traverse, and prefetch each object when placing the address in the queue. I believe this showed quite large performance improvements, as the memory access pattern isn&rsquo;t very predictable, but it is known that each address will need to be fetched.</p>
</div>
</li>
</ol>
</li>
<li id="comment-302230" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a95554d870d5ad046d1e6f5ebec2851?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a95554d870d5ad046d1e6f5ebec2851?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom Truscott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-01T13:15:29+00:00">May 1, 2018 at 1:15 pm</time></a> </div>
<div class="comment-content">
<p>IMO software prefetch made sense back when compilers were expected to make up for cpu deficiencies, but cpus are now such &ldquo;brainiacs&rdquo; that successful software prefetch is a way to spot cpu performance bugs.</p>
<p>But: Stockfish (one of the best chess programs) uses prefetch for one of its hash table lookups: <a href="https://github.com/official-stockfish/Stockfish/search?utf8=%E2%9C%93&#038;q=prefetch&#038;type=" rel="nofollow ugc">https://github.com/official-stockfish/Stockfish/search?utf8=%E2%9C%93&#038;q=prefetch&#038;type=</a></p>
</div>
<ol class="children">
<li id="comment-302313" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90752c0a2f0622cf61bd017feec300a0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90752c0a2f0622cf61bd017feec300a0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Schneider</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T06:51:59+00:00">May 2, 2018 at 6:51 am</time></a> </div>
<div class="comment-content">
<p>Stockfish is a good example. It even uses some extra code to pre-generate the hashkey of the next move (before it is made) to calculate the prefetch-address. After the prefetch, it does some more work on the current node, then makes the next move on it&rsquo;s internal board (updating/calculating the hashkey again) and only then accesses the hashtable with a low hash-miss-rate.<br/>
The prefetch can increase the overall speed of a chessprogram by 2-5% (and maybe only 1-2% without pre-calculated hashkey).</p>
</div>
</li>
<li id="comment-341824" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/375b7ed80c425dd49dc4662f28030bf9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/375b7ed80c425dd49dc4662f28030bf9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Craig B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-17T08:16:54+00:00">August 17, 2018 at 8:16 am</time></a> </div>
<div class="comment-content">
<p>This is just the &ldquo;sufficiently smart compiler&rdquo; argument, but applied to hardware instead of compilers&#8230;</p>
<p>Not being an all-seeing oracle isn&rsquo;t a &ldquo;bug&rdquo;. Despite lazy programmers&rsquo; desire to &ldquo;leave it to the hardware&rdquo;, manual optimization will always be a thing.</p>
</div>
</li>
</ol>
</li>
<li id="comment-302244" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ebbe5376a96ea3229037e2763ec3c25?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ebbe5376a96ea3229037e2763ec3c25?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-01T16:42:10+00:00">May 1, 2018 at 4:42 pm</time></a> </div>
<div class="comment-content">
<p>Interesting topic. prefetch is also available on MSVC as _mm_pause.<br/>
Anecdotally, I am often disappointed by the results, and it&rsquo;s worrisome that the required lookahead distance is so system-specific (perhaps can be auto-tuned).</p>
<p>That said, we&rsquo;ve seen a few speedups, e.g. 1.1x in a memory-bound checksum. It may also help to use regular loads (ensuring compiler doesn&rsquo;t optimize them out) instead of prefetches.</p>
<p>Generally agree with your recommendation to just optimize for the hardware prefetcher.</p>
</div>
</li>
<li id="comment-302293" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T02:32:56+00:00">May 2, 2018 at 2:32 am</time></a> </div>
<div class="comment-content">
<p>This is a topic that I would like to better understand, as this can influence how we try to optimise cache usage, as cache appears to be important for effective use of vector instructions.<br/>
Does L1 cache store data or memory pages (ie block of memory, say 64kb) ? A similar question for L2 and L3 cache. If cache stores active memory pages, then I think the discussion needs to address this, as a &ldquo;fetch&rdquo; would be for a memory page, while your loop example considers variables.<br/>
The other unknown is for multi-thread coding, how is data shared between processor caches, especially if this data is changing.<br/>
If cache stores &ldquo;blocks&rdquo; of memory, I think this should be more significant for pre-fetch than a counter loop.<br/>
I would very much appreciate if you can explain this relationship.</p>
</div>
<ol class="children">
<li id="comment-302294" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T02:39:48+00:00">May 2, 2018 at 2:39 am</time></a> </div>
<div class="comment-content">
<p>The cache works at the cache line granularity (64 bytes). Paging is a distinct issue.</p>
</div>
</li>
</ol>
</li>
<li id="comment-302295" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T02:41:11+00:00">May 2, 2018 at 2:41 am</time></a> </div>
<div class="comment-content">
<p>My apologies, as my previous post should have been clearer when referring to &ldquo;processor&rdquo;, &ldquo;core&rdquo; and &ldquo;thread&rdquo; and how L1, L2 &amp; L3 cache relate to these &#8230; A supplementary question !</p>
</div>
<ol class="children">
<li id="comment-302296" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T02:46:25+00:00">May 2, 2018 at 2:46 am</time></a> </div>
<div class="comment-content">
<p>On current Intel processors, I think L3 is always shared between the cores. L1 and L2 are on a per core basis. This will definitively be different in other types of processors.</p>
<p>A core can run 1 or more threads.</p>
<p>If you have many cores doing prefetches, they&rsquo;ll compete for cache space and for memory requests.</p>
</div>
</li>
</ol>
</li>
<li id="comment-302298" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/14d5cef9d2549ed933b1dd68bf8cabe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Campbell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T03:26:39+00:00">May 2, 2018 at 3:26 am</time></a> </div>
<div class="comment-content">
<p>I find this a very interesting topic.<br/>
My apologies if I am redirecting this post idea, but I don&rsquo;t think a prefetch instruction sufficiently explains the performance and especially, how to influence improvement.<br/>
Processor data storage is described as a hierarchy of data storage types:<br/>
â€¢ Memory<br/>
â€¢ L3 cache<br/>
â€¢ L2 cache<br/>
â€¢ L1 cache<br/>
â€¢ 32-bit registers<br/>
â€¢ 64-bit registers<br/>
â€¢ Vector registers, which can be 128-bit, 256-bit or 512-bit<br/>
All these have different group sizes.<br/>
Where does a prefetch instruction fit into this mix?<br/>
When optimising data availability to vector registers, I expect this must depend on how data is moved through memory and the 3 levels of cache, in both directions.<br/>
As I said initially, I don&rsquo;t understand how this works, but a better understanding might help when devising coding strategies to achieve improvement. I have achieved huge variations in performance of vector instructions, often without a clear understanding as to why.<br/>
I do think it is fortunate that we can&rsquo;t interfere directly in how this is done, as I&rsquo;m sure we would do a worse job.</p>
</div>
</li>
<li id="comment-302371" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/163cba45201bf40c81c7bd5defc0c2bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/163cba45201bf40c81c7bd5defc0c2bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://alexanius-blog.blogspot.ru/" class="url" rel="ugc external nofollow">Aleksey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T15:48:14+00:00">May 2, 2018 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>Hello, Daniel. I disagree with the points in this article so I made an example with regular loop that becomes faster with a prefetch. The answer is long so I made a <a href="http://alexanius-blog.blogspot.ru/2018/05/answer-to-is-software-prefetching.html" rel="nofollow">post</a> in my blog.</p>
</div>
<ol class="children">
<li id="comment-302407" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T21:33:51+00:00">May 2, 2018 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>Quoting from your article&#8230;</p>
<blockquote><p>The performance improvement is 1.36%. We can say this is not a very good result and we will be right. The main problem is that prefetch itself takes time for execution.</p></blockquote>
<p>I am not sure we disagree in the end?</p>
</div>
<ol class="children">
<li id="comment-302419" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/163cba45201bf40c81c7bd5defc0c2bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/163cba45201bf40c81c7bd5defc0c2bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://alexanius-blog.blogspot.ru/" class="url" rel="ugc external nofollow">Aleksey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T23:12:21+00:00">May 2, 2018 at 11:12 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
but you can get much better performance simply by doing the sums one by one. The resulting code will be simpler, easier to debug, more modular and faster.
</p></blockquote>
<p>I made an example where we can speedup summing one by one with prefetch. My first point is that prefetch should be a compilers&rsquo;s optimization, not by hand. And the other point that regular memory access is not good a example for prefetch. Later I will write about cases where it is really good and can not be improved by code refactoring.</p>
</div>
<ol class="children">
<li id="comment-302794" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-07T16:51:51+00:00">May 7, 2018 at 4:51 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
prefetch should be a compilers&rsquo;s optimization
</p></blockquote>
<p>But how would the compiler know (a) that the access pattern causes the auto prefech to be less effective, and (b) that the memory accessed is large enough to warrant the use of the prefech instruction? Not to mention (c) that batch access with prefetch is more effective&#8230; would you imagine the compiler reorganizing non-batched code into batched code?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-302379" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T17:39:04+00:00">May 2, 2018 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>As the person who came up with this simple example &#8212; and donated part of his Saturday morning &#8212; at the request of Daniel Lemire&#8230; I&rsquo;m surprised I didn&rsquo;t even receive a &lsquo;thanks&rsquo;.<br/>
Instead the &lsquo;algorithm&rsquo; is criticized &ldquo;prefetching improves the performance of the interleaved sums by 10%, but you can get much better performance simply by doing the sums one by one.&rdquo; But I don&rsquo;t think it&rsquo;s possible to get a good example with good algorithm in only a few dozen lines of code. What was requested: &ldquo;a short C program (say 30 lines of code) where __builtin_prefetch() helps&rdquo;. So this criticism seems somewhat unfair.<br/>
Also, in my tests [1] I noticed a performance gain of up to 40% with a batch size of 64&#8230; which is way bigger than the 10% improvement reported in the blog post.<br/>
The test code is designed to show the effects of randomly accessing non-cached RAM using different batch sizes. It maybe that accessing RAM with a smaller batch size is generally faster &#8212; as Daniel Lemire points out &#8212; however, IMO that&rsquo;s missing the point. The point is that although the test code shows a possible speed improvement between 10% and 40%, using prefetch allows the developer to execute other code while the prefetches are happening. And this can be A LOT of other code if it works on RAM which is already cached. Consider the fact that the same test code works nearly 14 times faster if operating on already cached RAM. That&rsquo;s a huge amount of instructions that could be operating while waiting for the prefetch instructions which operate <em>asynchronously</em> to other instructions. So the pattern is (a) prefetch in a batch, (b) do some task on purely cached RAM, and (c) finally use the prefetched RAM.<br/>
Here&rsquo;s the problem: You obviously will never run into an &lsquo;abc&rsquo; situation by optimizing as Daniel Lemire suggests: &ldquo;optimize it as much as you canâ€¦ and then, only then, show that adding __builtin_prefetch improves the performance&rdquo;. Instead you need to refactor the algorithm around prefetching to truly take advantage 🙂</p>
<p>[1] <a href="https://gist.github.com/simonhf/caaa33ccb87c0bf0775a863c0d6843c2" rel="nofollow ugc">https://gist.github.com/simonhf/caaa33ccb87c0bf0775a863c0d6843c2</a></p>
</div>
<ol class="children">
<li id="comment-302406" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-02T21:30:41+00:00">May 2, 2018 at 9:30 pm</time></a> </div>
<div class="comment-content">
<p><em>As the person who came up with this simple example â€” and donated part of his Saturday morning â€” at the request of Daniel Lemireâ€¦ I&rsquo;m surprised I didn&rsquo;t even receive a â€˜thanks&rsquo;.</em></p>
<p>I sent you an email privately just now. I should have emailed you privately to discuss my upcoming blog post, I did not. For that, I apologize. The source code I link to refers to your original gist, but my code is substantially different: I kept the main idea, but I simplified the code for the purpose of producing a simple example. I appreciate your work. I kept your name out of the blog post because I did not want to personify the argument and because I am doing a different benchmark. I should have asked you whether you wanted me to use your name.</p>
<p>I have appended a credit section to my blog post where I thank you for the code contribution.</p>
<p>I&rsquo;m sorry if I offended you. That was not my intention.</p>
<p><em>But I don&rsquo;t think it&rsquo;s possible to get a good example with good algorithm in only a few dozen lines of code.</em></p>
<p>It could be that software prefetching becomes very useful in complex code, even if it is not useful in simpler code.</p>
<p><em>Also, in my tests I noticed a performance gain of up to 40% with a batch size of 64â€¦ which is way bigger than the 10% improvement reported in the blog post.</em></p>
<p>My numbers are not very sensitive to the batch size beyond a certain point&#8230; 32, 64&#8230; it is all the same. I tried the pick the parameters so that the benefits of the prefetching are best. If you find better parameters, I&rsquo;ll be glad to update my blog post.</p>
<p>My code is different from your code, which is partly why I did not name you in the post. I am using a simplified version of your code.</p>
<p><em>Consider the fact that the same test code works nearly 14 times faster if operating on already cached RAM. That&rsquo;s a huge amount of instructions that could be operating while waiting for the prefetch instructions which operate asynchronously to other instructions. </em></p>
<p>It shows that we can be &ldquo;memory bound&rdquo;. However, my argument is not whether we should prefetch the data or not&#8230; you should obviously prefetch it&#8230; my argument has to do with whether you need software prefetching. I think you do not. My claim is that you can almost always rewrite your code without software prefetches in such a way that it will be at least as fast.</p>
<p>I&rsquo;m willing to admit that there might be cases where software prefetching is useful, but I think that they are uncommon.</p>
<p><em>So the pattern is (a) prefetch in a batch, (b) do some task on purely cached RAM, and (c) finally use the prefetched RAM. Here&rsquo;s the problem: You obviously will never run into an â€˜abc&rsquo; situation by optimizing as Daniel Lemire suggests: â€œoptimize it as much as you canâ€¦ and then, only then, show that adding __builtin_prefetch improves the performanceâ€. Instead you need to refactor the algorithm around prefetching to truly take advantage ðŸ™‚</em></p>
<p>Your approach might well be practically sound, but I submit to you that you take it as an axiom that you need the software prefetching. This can work well when programming&#8230; but I am trying to determine whether the software prefetching is needed at all.</p>
</div>
</li>
</ol>
</li>
<li id="comment-303097" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ae7f14808a68844d0590402c0f506877?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ae7f14808a68844d0590402c0f506877?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zhuhe Fang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-10T12:53:07+00:00">May 10, 2018 at 12:53 pm</time></a> </div>
<div class="comment-content">
<p>Hello, Daniel.<br/>
Is AVX512PF useful? It provides prefetching for random access in gather(). I wonder the improvement of AVX512PF, but I don&rsquo;t have a platform to test it.</p>
</div>
<ol class="children">
<li id="comment-303918" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-18T03:10:20+00:00">May 18, 2018 at 3:10 am</time></a> </div>
<div class="comment-content">
<p>Interesting. Do you know if Intel makes processors supporting AVX512PF at this point in time?</p>
</div>
<ol class="children">
<li id="comment-303971" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ae7f14808a68844d0590402c0f506877?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ae7f14808a68844d0590402c0f506877?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zhuhe Fang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-18T12:01:10+00:00">May 18, 2018 at 12:01 pm</time></a> </div>
<div class="comment-content">
<p>details from <a href="https://en.wikipedia.org/wiki/AVX-512" rel="nofollow ugc">https://en.wikipedia.org/wiki/AVX-512</a></p>
<p>Xeon Phi x200 (Knights Landing):[1][9] AVX-512 F, CD, ER, PF<br/>
Xeon Phi Knights Mill:[7] AVX-512 F, CD, ER, PF, 4FMAPS, 4VNNIW, VPOPCNTDQ<br/>
Skylake-SP, Skylake-X:[10][11][12] AVX-512 F, CD, VL, DQ, BW<br/>
Cannonlake:[7] AVX-512 F, CD, VL, DQ, BW, IFMA, VBMI<br/>
Ice Lake:[7] AVX-512 F, CD, VL, DQ, BW, IFMA, VBMI, VBMI2, VPOPCNTDQ, BITALG, VNNI, VPCLMULQDQ, GFNI, VAES</p>
</div>
<ol class="children">
<li id="comment-304695" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-23T23:39:13+00:00">May 23, 2018 at 11:39 pm</time></a> </div>
<div class="comment-content">
<p>So it is Xeon Phi-specific. I am less interested in Xeon Phi processors at this time, even though I own one such processor.</p>
</div>
<ol class="children">
<li id="comment-304696" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-23T23:39:45+00:00">May 23, 2018 at 11:39 pm</time></a> </div>
<div class="comment-content">
<p>If you have code you&rsquo;d like to be tested, I can run the tests for you.</p>
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
<li id="comment-303931" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/37b967a090e923bea78d7928152fa846?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/37b967a090e923bea78d7928152fa846?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Fernandez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-18T05:16:58+00:00">May 18, 2018 at 5:16 am</time></a> </div>
<div class="comment-content">
<p>FWIW I&rsquo;ve seen these kind of prefetching directives used to accelerate memcpy implementations on ARM. E.g. <a href="https://android.googlesource.com/platform/bionic/+/199f9d923804d74e021dd80e48ec75c0a96dba77/libc/arch-arm/bionic/memcpy.S#50" rel="nofollow ugc">https://android.googlesource.com/platform/bionic/+/199f9d923804d74e021dd80e48ec75c0a96dba77/libc/arch-arm/bionic/memcpy.S#50</a></p>
</div>
</li>
<li id="comment-349553" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4835c92056c804b5eafc2750054a2951?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4835c92056c804b5eafc2750054a2951?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.sanmayce.com/" class="url" rel="ugc external nofollow">Georgi 'Sanmayce'</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-16T16:41:13+00:00">September 16, 2018 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>Hi Prof. Lemire,<br/>
allow me to share one nifty etude showing that software prefetching actually boosts a REALWORLD matrix abracadabra, done by me.</p>
<p>Since I am fond of benchmarking I would love to see other runs on faster machines with at least 8 cores, my only testmachine &lsquo;Compressionette&rsquo; is with 2cores/4threads i5-7200u:<br/>
<a href="https://www.overclock.net/forum/21-benchmarking-software-discussion/1678401-mike-vs-mickey-plagiarism-128-threaded-benchmark.html#post27625690" rel="nofollow ugc">https://www.overclock.net/forum/21-benchmarking-software-discussion/1678401-mike-vs-mickey-plagiarism-128-threaded-benchmark.html#post27625690</a></p>
<p>My greediness tells me the &lsquo;Mike vs Mickey&rsquo; benchmark should go beyond 43GB/s (L3, not uncached RAM, dominates), easy, for dual channel sustems, for some reasons current record is 28.4 GB/s.</p>
<p>In short, without prefetching the performance is ~12 billions cells per second, with prefetching &#8211; clear 1 billion more. The main loop of one of the threads:</p>
<p><code> [/*<br/>
; mark_description "Intel(R) C++ Compiler XE for applications running on Intel(R) 64, Version 15.0.0.108 Build 20140726";<br/>
; mark_description "-O3 -arch:CORE-AVX2 -openmp -FAcs -DKamYMM -D_N_HIGH_PRIORITY";</p>
<p> .B1.118::<br/>
00a30 0f 18 89 ff 0f<br/>
00 00 prefetcht0 BYTE PTR \[4095+rcx\]<br/>
00a37 49 ff c3 inc r11<br/>
00a3a 41 0f 18 8c 30<br/>
00 10 00 00 prefetcht0 BYTE PTR \[4096+r8+rsi\]<br/>
00a43 c4 c1 1d 74 04<br/>
30 vpcmpeqb ymm0, ymm12, YMMWORD PTR \[r8+rsi\]<br/>
00a49 c5 fd db 49 ff vpand ymm1, ymm0, YMMWORD PTR \[-1+rcx\]<br/>
00a4e 48 83 c1 20 add rcx, 32<br/>
00a52 c5 dd f8 d0 vpsubb ymm2, ymm4, ymm0<br/>
00a56 c5 f5 fc da vpaddb ymm3, ymm1, ymm2<br/>
00a5a c4 81 7e 7f 1c<br/>
08 vmovdqu YMMWORD PTR \[r8+r9\], ymm3<br/>
00a60 49 83 c0 20 add r8, 32<br/>
00a64 c5 25 de db vpmaxub ymm11, ymm11, ymm3<br/>
00a68 4c 3b da cmp r11, rdx<br/>
00a6b 72 c3 jb .B1.118<br/>
*/][1]<br/>
</code></p>
<p>Hope, someone helps me in boosting the etude even farther, big numbers galdden my eyes.</p>
</div>
</li>
<li id="comment-349580" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5968e321a52a246fd2d35403369268a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5968e321a52a246fd2d35403369268a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.sanmayce.com/" class="url" rel="ugc external nofollow">Georgi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-16T20:51:08+00:00">September 16, 2018 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>Hi Prof. Lemire,<br/>
allow me to share one nifty etude showing that software prefetching actually boosts a REALWORLD matrix abracadabra, done by me.</p>
<p>Since I am fond of benchmarking I would love to see other runs on faster machines with at least 8 cores, my only testmachine &lsquo;Compressionette&rsquo; is with 2cores/4threads i5-7200u:<br/>
URL</p>
<p>My greediness tells me the &lsquo;Mike vs Mickey&rsquo; benchmark should go beyond 43GB/s (L3, not uncached RAM, dominates), easy, for dual channel sustems, for some reasons current record is 28.4 GB/s.</p>
<p>In short, without prefetching the performance is ~12 billions cells per second, with prefetching &#8211; clear 1 billion more. The main loop:</p>
<p><code> /*<br/>
; mark_description "Intel(R) C++ Compiler XE for applications running on Intel(R) 64, Version 15.0.0.108 Build 20140726";<br/>
; mark_description "-O3 -arch:CORE-AVX2 -openmp -FAcs -DKamYMM -D_N_HIGH_PRIORITY";</p>
<p> .B1.118::<br/>
00a30 0f 18 89 ff 0f<br/>
00 00 prefetcht0 BYTE PTR [4095+rcx]<br/>
00a37 49 ff c3 inc r11<br/>
00a3a 41 0f 18 8c 30<br/>
00 10 00 00 prefetcht0 BYTE PTR [4096+r8+rsi]<br/>
00a43 c4 c1 1d 74 04<br/>
30 vpcmpeqb ymm0, ymm12, YMMWORD PTR [r8+rsi]<br/>
00a49 c5 fd db 49 ff vpand ymm1, ymm0, YMMWORD PTR [-1+rcx]<br/>
00a4e 48 83 c1 20 add rcx, 32<br/>
00a52 c5 dd f8 d0 vpsubb ymm2, ymm4, ymm0<br/>
00a56 c5 f5 fc da vpaddb ymm3, ymm1, ymm2<br/>
00a5a c4 81 7e 7f 1c<br/>
08 vmovdqu YMMWORD PTR [r8+r9], ymm3<br/>
00a60 49 83 c0 20 add r8, 32<br/>
00a64 c5 25 de db vpmaxub ymm11, ymm11, ymm3<br/>
00a68 4c 3b da cmp r11, rdx<br/>
00a6b 72 c3 jb .B1.118<br/>
*/</p>
<p>One of the 8 threads:</p>
<p>__m256i Innerloop2YMM (uint64_t ChunkToTraverseL, uint64_t ChunkToTraverseR, uint8_t *Matrix_vectorPrev, uint8_t *Matrix_vectorCurr, uint8_t *workK, __m256i YMMclone)<br/>
{<br/>
__m256i YMMprev, YMMcurr;<br/>
__m256i YMMmax = _mm256_set1_epi8(0);<br/>
__m256i YMMzero = _mm256_set1_epi8(0);<br/>
__m256i YMMsub, YMMcmp, YMMand, YMMadd;<br/>
uint64_t j;</p>
<p> for(j=ChunkToTraverseL; j &lt; ChunkToTraverseR; j+=(32/1)){<br/>
#ifdef _N_ALIGNED<br/>
YMMprev = _mm256_load_si256((__m256i*)(Matrix_vectorPrev+(j-1)));<br/>
YMMcurr = _mm256_load_si256((__m256i*)&amp;workK[j]);<br/>
#else<br/>
YMMprev = _mm256_loadu_si256((__m256i*)(Matrix_vectorPrev+(j-1)));<br/>
YMMcurr = _mm256_loadu_si256((__m256i*)&amp;workK[j]);</p>
<p> _mm_prefetch((char*)(Matrix_vectorPrev+(j-1) + 64*64), _MM_HINT_T0);<br/>
_mm_prefetch((char*)(&amp;workK[j] + 64*64), _MM_HINT_T0);<br/>
#endif<br/>
YMMcmp = _mm256_cmpeq_epi8(YMMcurr, YMMclone);<br/>
YMMand = _mm256_and_si256(YMMprev, YMMcmp);<br/>
YMMsub = _mm256_sub_epi8(YMMzero, YMMcmp);<br/>
YMMadd = _mm256_add_epi8(YMMand, YMMsub);<br/>
_mm256_storeu_si256((__m256i*)(Matrix_vectorCurr+j), YMMadd);<br/>
YMMmax = _mm256_max_epu8(YMMmax, YMMadd);<br/>
}<br/>
return YMMmax;<br/>
}<br/>
</code></p>
<p>Hope, someone helps me in boosting the etude even farther, big numbers gladden my eyes.</p>
</div>
</li>
<li id="comment-401742" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">j</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T14:35:54+00:00">April 15, 2019 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>I work in a specific domain of computer science where prefetching is a basic tool: network traffic processing in routers that have requirement of Gigabits per second per core.</p>
<p>The problem with the network traffic processing is that the traffic comes from so many users, that it´s completely unpredictable, from compiler point of view, which data is going to be accessed. Basically, all data lookup is always cold.</p>
<p>For instance, a very basic operation is to lookup the 5-tuple of a packet. That will be always cold. If you are able to compute the 5-tuple and prefecth while you continue doing other work, then you will save one data cache miss. At Gbps, one data cache miss matters.</p>
<p>So at least in my field, it&rsquo;s very important to handle with care the data cache misses.</p>
</div>
<ol class="children">
<li id="comment-401747" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T15:17:46+00:00">April 15, 2019 at 3:17 pm</time></a> </div>
<div class="comment-content">
<p><em> it’s very important to handle with care the data cache misses</em></p>
<p>That&rsquo;s true in software generally. My point in this post is not that cache misses are irrelevant, but rather that if you write your code with care, you do not need explicit prefetching.</p>
</div>
<ol class="children">
<li id="comment-401749" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">j</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T15:22:14+00:00">April 15, 2019 at 3:22 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel.</p>
<p>I think I understood your point, but the thing is that the memory is cold in HasthTbl(IP.address) for sure. The compiler will not be able to prefecth it &#8211; how would it? The compiler is not smart enough to compute the 5tuple of a packet (IP addresses + ports + TCP/UDP) and do a flow lookup on its own. You need to do that prefetching manually. No amount of well-written code will avoid this case 🙁</p>
</div>
<ol class="children">
<li id="comment-401763" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T17:13:57+00:00">April 15, 2019 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>The prefetch is also not magic. You need to compute the hash, access the data and bring it to cache. In effect, you need to do exactly the same thing whether you use a prefetch or not. Of course, the prefetch won&rsquo;t populate a register, and it plays differently in the instruction pipeline, but it is not free. It has a cost of its own.</p>
</div>
<ol class="children">
<li id="comment-401810" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">j</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T21:28:10+00:00">April 15, 2019 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it has a cost. Unfortunately, I can&rsquo;t share the code, but I can promise you that a set of three smartly put prefetch increased a 5% the throughput that a CPU could handle, according to our tests.</p>
<p>I am sorry for not sharing the code 🙁</p>
</div>
<ol class="children">
<li id="comment-401811" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T21:29:07+00:00">April 15, 2019 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>I think 5% is credible.</p>
</div>
<ol class="children">
<li id="comment-401812" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">j</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T21:31:50+00:00">April 15, 2019 at 9:31 pm</time></a> </div>
<div class="comment-content">
<p>a 5% per CPU, with 32 CPUs, it&rsquo;s more than one extra CPU 😉</p>
</div>
<ol class="children">
<li id="comment-401813" class="comment byuser comment-author-lemire bypostauthor even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T21:39:02+00:00">April 15, 2019 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>Yes, but how confident are you that if I could get my hands on your code without explicit prefetch, I would be unable to optimize its memory accesses?</p>
<p>That is, are you certainly that your prefetch-free code is absolutely, without question, as fast as it can be?</p>
<p>Maybe you are, but people frequently underestimate how a little bit of code rewrite can go a long way.</p>
</div>
<ol class="children">
<li id="comment-401819" class="comment odd alt depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/470890ee924af7303365d21615085fac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">j</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T22:33:18+00:00">April 15, 2019 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>I am sure it&rsquo;s not the best code by any means. I am sure it can be improved, and we are continously working on it. The critical path of the application has been rewritten many times.</p>
<p>However, I am also confident that the cold accesses (hash table for tuple lookup, for instance), are unavoidable and only a prefetch can help there.</p>
</div>
<ol class="children">
<li id="comment-401821" class="comment byuser comment-author-lemire bypostauthor even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T23:03:13+00:00">April 15, 2019 at 11:03 pm</time></a> </div>
<div class="comment-content">
<p>It is clear why out-of-cache access is unavoidable, but what is your rationale for &ldquo;only a prefetch can help&rdquo;? I understand that you can&rsquo;t share the code, but can you elaborate, at a high level, on the algorithm involved. What do you do with the value found in the hash table?</p>
<p>I am not arguing that you are wrong. I am just trying to understand your point better.</p>
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
<li id="comment-401788" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T19:31:53+00:00">April 15, 2019 at 7:31 pm</time></a> </div>
<div class="comment-content">
<p>There are lots of reasons software prefetch has become far less useful than in the past, to the point of being practically unnecessary. Some of the key ones are:</p>
<p>Cache hierarchy has improved dramatically in the last decade. We now have 2x64KB L1 caches, 512KB L2 caches and 4MB L3 caches with very low latencies in mobile phones! So there is a lot more data in caches and we can access it very fast.<br/>
Deep out-of-order execution makes a lot of prefetching redundant since it is already fetching data for the next few iterations of a loop before even finishing the current one. Modern CPUs support a huge number of outstanding cachemisses, around 20-50.<br/>
Modern CPU prefetchers are good. <em>Really good. [1]</em> Like branch predictors they can recognize and store complex patterns and adapt dynamically which is impossible for humans to match (much in the same way out-of-order execution beats manual scheduling without contest).</p>
<p>[1] <a href="https://www.anandtech.com/show/14072/the-samsung-galaxy-s10plus-review/5" rel="nofollow ugc">https://www.anandtech.com/show/14072/the-samsung-galaxy-s10plus-review/5</a></p>
</div>
<ol class="children">
<li id="comment-401803" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T21:07:41+00:00">April 15, 2019 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>I love your smart comment, thanks!</p>
<p><em>Modern CPUs support a huge number of outstanding cachemisses, around 20-50.</em></p>
<p><a href="https://lemire.me/blog/2018/11/13/memory-level-parallelism-intel-skylake-versus-apple-a12-a12x/">Not on a per-core basis in all commodity processors</a> though certainly true for whole CPUs (all cores).</p>
</div>
<ol class="children">
<li id="comment-401815" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T22:11:19+00:00">April 15, 2019 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>Page 6 of that AnandTech article shows how modern Arm processors have a measurable MLP of 20 per core (note you get a mention!) That&rsquo;s not accounting for prefetching or adding L2, L3 and DRAM MLP.</p>
<p>Total per-core capacity for Cortex-A76 is 46 outstanding misses in L2, plus 94 in L3: <a href="https://www.anandtech.com/show/12785/arm-cortex-a76-cpu-unveiled-7nm-powerhouse/3" rel="nofollow ugc">https://www.anandtech.com/show/12785/arm-cortex-a76-cpu-unveiled-7nm-powerhouse/3</a></p>
</div>
<ol class="children">
<li id="comment-401823" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-15T23:05:41+00:00">April 15, 2019 at 11:05 pm</time></a> </div>
<div class="comment-content">
<p>Yes and 20 outstanding requests is pretty damn cool.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-472007" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan Nemerson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-18T20:45:54+00:00">December 18, 2019 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>I know I&rsquo;m (more than) a little late here, but I just spent some time with this while thinking about a portable implementation of <code>_mm_prefetch</code> for <a href="https://github.com/nemequ/simde/" rel="nofollow ugc">SIMDe</a>, so…</p>
<blockquote><p>
I do not know if other compilers, like that of Visual Studio, have this function.
</p></blockquote>
<p>ICC supports <code>__builtin_prefetch</code>. Many other compilers don&rsquo;t, but do have similar functionality.</p>
<p>VS doesn&rsquo;t make it easy by having one function, but on x86 there is <code>_mm_prefetch</code> from SSE. On ARM VS has a <code>__prefetch(const void*)</code>, and on ARM64 it also has a <code>__prefetch2(const void *, uint8_t prfop)</code>.</p>
<p>ARM C Language Extensions (ACLE) has <code>__pld</code> and, in 1.1+, <code>__pldx</code>. VS is the only ARM compiler I&rsquo;m aware of targeting ARM which doesn&rsquo;t support ACLE.</p>
<p>Oracle Developer Studio has <code>sun_prefetch_read_once</code>/<code>sun_prefetch_read_many</code>/<code>sun_prefetch_write_once</code>/<code>sun_prefetch_read_many</code>, which work on x86/x86_64 and SPARC.</p>
<p>IBM XL C/C++ has <code>__prefetch_by_load</code> and <code>__prefetch_by_stream</code>. Newer clang-based versions also probably support <code>__builtin_prefetch</code>, but I haven&rsquo;t verified that.</p>
<p>Cray has a <code>#pragma _CRI prefetch</code>.</p>
<p>PGI has a <code>#pragma mem prefetch</code>.</p>
<p>If anyone wants to play with them I put together <a href="https://github.com/nemequ/hedley/blob/experiments/experiments/prefetch.c" rel="nofollow ugc">a macro for Hedley</a> which should be useful.</p>
</div>
<ol class="children">
<li id="comment-472020" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-18T21:09:06+00:00">December 18, 2019 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for the outstanding comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-653083" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00e37f775b9a40d339b82c1079ea5dc2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00e37f775b9a40d339b82c1079ea5dc2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Axman6</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-19T06:33:06+00:00">July 19, 2023 at 6:33 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I know this post is quite old, but I had a question I haven&rsquo;t seen many answers for online: we always talk about prefetching data, but what about prefetching instructions?</p>
<p>Aarch64 has <a href="https://developer.arm.com/documentation/ddi0602/2023-06/Base-Instructions/PRFM--register---Prefetch-Memory--register--" rel="nofollow ugc">PRFM PLI*</a> which allows preloading of an address that is expected to be an instruction (or some number of them). The address being jumped to may not be predictable by the CPU, say when using a jump table, or for functional languages like Haskell where all (non-FFI) function calls are just jumps. This code often looks like:</p>
<p>calculate the address<br/>
load instructions into ABI defined registers<br/>
branch to the address<br/>
handle the returned value(s)</p>
<p>since in many cases the first step involves putting the address into a register, the instruction decoder doesn&rsquo;t have the information to see the target of a branch, it can&rsquo;t predict where the branch will go.</p>
<p>If however after the first step we issue a prefetch of the calculated address, then performed the loading of arguments into argument registers, we&rsquo;d get a head start on making sure the code we&rsquo;re about to jump to is sitting near the CPU essentially for free.</p>
<p>Have you looked into anything like this, or know of any resources on the topic? I was surprised to find so little online discussing it (even people saying its a bad idea). I guess I haven&rsquo;t found out where the optimisation obsessed hang out on the internet yet.</p>
<p>Love your work, please keep it up!</p>
</div>
</li>
<li id="comment-656164" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/53ab6482be2249a744f452c71da913f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/53ab6482be2249a744f452c71da913f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Changbin Du</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-16T07:07:47+00:00">November 16, 2023 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>Also, check these.</p>
<p><a href="https://lwn.net/Articles/444336/" rel="nofollow ugc">https://lwn.net/Articles/444336/</a> (The problem with prefetch)</p>
<p><a href="https://lwn.net/Articles/444344/" rel="nofollow ugc">https://lwn.net/Articles/444344/</a> (Software prefetching considered harmful)</p>
</div>
</li>
</ol>
