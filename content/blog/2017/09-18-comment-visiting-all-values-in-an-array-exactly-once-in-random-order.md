---
date: "2017-09-18 12:00:00"
title: "Visiting all values in an array exactly once in &#8220;random order&#8221;"
index: false
---

[36 thoughts on &ldquo;Visiting all values in an array exactly once in &#8220;random order&#8221;&rdquo;](/lemire/blog/2017/09-18-visiting-all-values-in-an-array-exactly-once-in-random-order)

<ol class="comment-list">
<li id="comment-286266" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50d8ea4c173c295e8faa6aeb5bf910b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50d8ea4c173c295e8faa6aeb5bf910b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://fph.altervista.org/index.html" class="url" rel="ugc external nofollow">Federico</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T19:32:30+00:00">September 18, 2017 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p>For a &ldquo;more random&rdquo; solution, why not using exponentiation? x \mapsto x^h is injective modulo every prime p for which gcd(p-1, h) = 1. For a small enough h, for instance h = 3, it is reasonably fast to compute.</p>
</div>
<ol class="children">
<li id="comment-286283" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T20:35:19+00:00">September 18, 2017 at 8:35 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t want to assume that the size of the interval is a prime. You can, of course, patch things up, but I also want the code to be simple and easy to predict.</p>
</div>
</li>
</ol>
</li>
<li id="comment-286270" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50d8ea4c173c295e8faa6aeb5bf910b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50d8ea4c173c295e8faa6aeb5bf910b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fph.altervista.org/index.html" class="url" rel="ugc external nofollow">Federico</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T19:43:58+00:00">September 18, 2017 at 7:43 pm</time></a> </div>
<div class="comment-content">
<p>Another neat trick in the same direction is the following: for each r&gt;2, the map k -&gt; (5^k mod 2^r) runs exactly once through all numbers whose binary expansion ends in 01 before looping. So you can visit all values in an array of size 2^(r-2) with the function ((5^k mod 2^r) &#8211; 1) / 4. It should be reasonably fast, because it&rsquo;s just a multiplication by 5 and a few shifts.</p>
</div>
<ol class="children">
<li id="comment-286284" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T20:35:45+00:00">September 18, 2017 at 8:35 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t want to assume that the interval is a power of two.</p>
</div>
<ol class="children">
<li id="comment-286337" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T09:11:42+00:00">September 19, 2017 at 9:11 am</time></a> </div>
<div class="comment-content">
<p>If you have range of &lsquo;n&rsquo; with a configurable power-of-two permutation then you can generate on ceil(log_2(n)) and reject elements &gt;= n. So worst case rejection is ~1/2 or ~2 elements per draw on average. If I&rsquo;m doing the math right then average rejection rate (assuming &lsquo;n&rsquo; is uniform) is ~.18. Of course only worth considering if you need to speed up the sampling of elements.</p>
</div>
<ol class="children">
<li id="comment-286351" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T13:24:30+00:00">September 19, 2017 at 1:24 pm</time></a> </div>
<div class="comment-content">
<p>Yes, you are right&#8230; with the possible upside that you can get well known statistical properties&#8230; but with the downsides that&#8230;</p>
<p>1) you cannot easily randomly access the indexes&#8230; e.g, in my implementation, I can ask what was the kth index,</p>
<p>2) in your proposal, the running time of accessing the next integer is O(n), not constant time&#8230;</p>
<p>3) my implementation is branchless&#8230; so no branch misprediction&#8230;</p>
<p>If performance is a priority, I think that my approach is going to be much faster in realistic scenarios, albeit, we need to benchmark it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-286273" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50d8ea4c173c295e8faa6aeb5bf910b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50d8ea4c173c295e8faa6aeb5bf910b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fph.altervista.org/index.html" class="url" rel="ugc external nofollow">Federico</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T19:48:29+00:00">September 18, 2017 at 7:48 pm</time></a> </div>
<div class="comment-content">
<p>Also, in your code, why don&rsquo;t you update your index with answer = (old_answer + prime) % maxrange, instead of doing the multiplication? Or do you need to have non-sequential access to your array as well? If so, then my tricks with the multiplicative order don&rsquo;t work. 🙂</p>
</div>
<ol class="children">
<li id="comment-286285" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T20:37:10+00:00">September 18, 2017 at 8:37 pm</time></a> </div>
<div class="comment-content">
<p>Yes, thanks. You don&rsquo;t need the multiplication, you are right. But it is probably the least of your concerns here. The modulo reduction is probably want you want to optimize away first.</p>
<p>I did point out in my post that this code can be further optimized.</p>
</div>
</li>
</ol>
</li>
<li id="comment-286282" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5162a0619d4a15d7627662093bf42f1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5162a0619d4a15d7627662093bf42f1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/julianhyde" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T20:32:29+00:00">September 18, 2017 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>Even though it has limitations, I&rsquo;m very fond of the shuffle algorithm that appears in Knuth. It is essentially selection sort using a random comparison: for each i, choose a random element at position i or higher, emit it, swap it with the element at position i.</p>
<p>For this problem, the shuffled array is not the goal, but is merely a by-product; we need to move elements out of the way so that we do not consider them more than once.</p>
<p>So, we can implement the algorithm with no extra storage, and better randomness than your algorithm, if: (a) we allow the array to be permuted while the algorithm is running, (b) we have a random number generator that can run backwards, (c) 2x running time is acceptable. The idea is to reverse the permutation at the end of the algorithm, running the random number generator backwards to put each element back into its original position.</p>
<p>Of course, this is a significant extra cost over your algorithm. But acceptable, I think, for applications that require good randomness.</p>
<p>I don&rsquo;t know whether there exist &ldquo;good&rdquo; random number generators that are reversible, but I assume that there are, since a random number generator that loses information is not a very good random number generator.</p>
</div>
<ol class="children">
<li id="comment-286288" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T20:44:11+00:00">September 18, 2017 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>Good point.</p>
<p>This suggests a follow-up blog post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-286296" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45d943aad84c108d190cda20933ae418?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45d943aad84c108d190cda20933ae418?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vadim Kantorov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T22:35:01+00:00">September 18, 2017 at 10:35 pm</time></a> </div>
<div class="comment-content">
<p>Also a few weeks ago a post on the same problem appeared: <a href="http://fabiensanglard.net/fizzlefade/index.php" rel="nofollow ugc">http://fabiensanglard.net/fizzlefade/index.php</a> mentioning Linear Feedback Shift Registers</p>
</div>
<ol class="children">
<li id="comment-286301" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-18T23:42:11+00:00">September 18, 2017 at 11:42 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I have not read in detail the post you offer, but I suspect it is a different problem.</p>
</div>
</li>
</ol>
</li>
<li id="comment-286320" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon Hardy-Francis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T04:13:29+00:00">September 19, 2017 at 4:13 am</time></a> </div>
<div class="comment-content">
<p>Some years ago I was experimenting with one of the murmur hash algorithms and discovered that commenting out part of the algorithm resulted in randomly visiting each array element once if the array is a power of two large. I&rsquo;ve used it a couple of times over the years. Very handy.</p>
</div>
<ol class="children">
<li id="comment-286352" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T13:27:46+00:00">September 19, 2017 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>The bit mixing function executed at the end of murmur hash is invertible so it is definitively the case that it will visit all values exactly once.</p>
</div>
<ol class="children">
<li id="comment-286470" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">llogiq</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-20T22:57:38+00:00">September 20, 2017 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>This is actually not the case. The mixing function is:</p>
<p>int mixing(int h, int len) {<br/>
h ^= len;<br/>
h ^= h &gt;&gt; 16;<br/>
h *= 0x85ebca6b;<br/>
h ^= h &gt;&gt; 13;<br/>
h *= 0xc2b2ae35;<br/>
h ^= h &gt;&gt; 16;<br/>
return h % len;<br/>
}</p>
<p>This will *not* generate all values exactly once, as a simple experiment with 16 values shows: 12 8 7 4 1 5 6 12 15 10 13 8 0 10 13 11</p>
</div>
<ol class="children">
<li id="comment-286743" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-23T20:13:57+00:00">September 23, 2017 at 8:13 pm</time></a> </div>
<div class="comment-content">
<p>If you remove the xor len and mod len then the remaining part is a bijection (or invertible/permutation) function. To make it a sequence of all integers you need to feed it the output of some full-period sequence. Just 0,1,2&#8230;. will result in pretty respectable results.</p>
</div>
<ol class="children">
<li id="comment-286745" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-23T20:23:52+00:00">September 23, 2017 at 8:23 pm</time></a> </div>
<div class="comment-content">
<p>Yes. Marc is correct. What I refer to as â€œthe bit mixing functionâ€ is equivalent to function you use (at least for 32-bit integers), without the â€œlenâ€ parameter. You will find it in widespread use.</p>
<p>There are other possibilities, see section 7 of this paper : <a href="https://arxiv.org/pdf/1609.09840.pdf" rel="nofollow ugc">https://arxiv.org/pdf/1609.09840.pdf</a></p>
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
<li id="comment-286353" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sagar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T13:37:24+00:00">September 19, 2017 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p>A Feistel Network? <a href="http://antirez.com/news/113" rel="nofollow ugc">http://antirez.com/news/113</a></p>
</div>
<ol class="children">
<li id="comment-286354" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T13:39:37+00:00">September 19, 2017 at 1:39 pm</time></a> </div>
<div class="comment-content">
<p>Again, as other proposals above, it assumes that the size of the interval is a power of two.</p>
</div>
<ol class="children">
<li id="comment-286357" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sagar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T14:22:18+00:00">September 19, 2017 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t looked into it, but the author of that blog says it is possible to generalize the Feistel network to any radix (see the comment by antirez in the link).</p>
</div>
<ol class="children">
<li id="comment-286360" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T14:58:57+00:00">September 19, 2017 at 2:58 pm</time></a> </div>
<div class="comment-content">
<p><em>the author of that blog says it is possible to generalize the Feistel network to any radix</em></p>
<p>Well, we do know one way to do it, it has been described in the comments here, and it involves branching and O(n) complexity for the &ldquo;next&rdquo; calls.</p>
<p>It is possible that he has something more clever in mind&#8230; but if it is described in the blog post in question, then I missed it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-286542" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-21T17:00:47+00:00">September 21, 2017 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>If c = (x &#8211; ax)%m then x maps to itself. However I believe sufficient conditions are given in theorem A here: <a href="http://www.math.cornell.edu/~mec/Winter2009/Luo/Linear%20Congruential%20Generator/linear%20congruential%20gen1.html" rel="nofollow ugc">http://www.math.cornell.edu/~mec/Winter2009/Luo/Linear%20Congruential%20Generator/linear%20congruential%20gen1.html</a> , or you can stay with c=0 or a=0 (the other coefficient being relatively prime).</p>
</div>
<ol class="children">
<li id="comment-286551" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-21T19:19:33+00:00">September 21, 2017 at 7:19 pm</time></a> </div>
<div class="comment-content">
<p><em>If c = (x â€“ ax)%m then x maps to itself.</em></p>
<p>My proposed technique <strong>is not a recurrence formula</strong>. So while what you write is correct (albeit I think I use &lsquo;b&rsquo; and not &lsquo;c&rsquo;), it does not matter.</p>
</div>
<ol class="children">
<li id="comment-286569" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kendall Willets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-21T21:56:51+00:00">September 21, 2017 at 9:56 pm</time></a> </div>
<div class="comment-content">
<p>You are correct, I misremembered it as iterating x = bx+c. Iteration may be another way to do it then.</p>
</div>
</li>
<li id="comment-286744" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-23T20:21:52+00:00">September 23, 2017 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>Well it&rsquo;s additive recurrence&#8230;just in closed-form for the &lsquo;i&rsquo;th element. &gt;;)</p>
</div>
</li>
</ol>
</li>
<li id="comment-287101" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T01:01:20+00:00">September 26, 2017 at 1:01 am</time></a> </div>
<div class="comment-content">
<p>I have added a benchmark against LCG: <a href="https://lemire.me/blog/2017/09/26/benchmarking-algorithms-to-visit-all-values-in-an-array-in-random-order/" rel="ugc">https://lemire.me/blog/2017/09/26/benchmarking-algorithms-to-visit-all-values-in-an-array-in-random-order/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-286871" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4630cec4ad945c1a08ae651ac328c21?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4630cec4ad945c1a08ae651ac328c21?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-25T01:27:05+00:00">September 25, 2017 at 1:27 am</time></a> </div>
<div class="comment-content">
<p>Any solution that works for all powers of two trivially works for any size. Choose the smallest power of two greater than or equal to the size you want. If the algorithm gives an index too big just skip that one and go on to the next &ldquo;random&rdquo; index. This could possibly be faster than a solution that natively handles arbitrary sizes, because modulo instruction is quite slow on most hardware.</p>
</div>
<ol class="children">
<li id="comment-287086" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-25T23:59:59+00:00">September 25, 2017 at 11:59 pm</time></a> </div>
<div class="comment-content">
<p>As pointed out earlier, you do not need the modulo instruction.</p>
</div>
<ol class="children">
<li id="comment-287100" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-26T01:00:49+00:00">September 26, 2017 at 1:00 am</time></a> </div>
<div class="comment-content">
<p>I have added benchmarks in a separate post: <a href="https://lemire.me/blog/2017/09/26/benchmarking-algorithms-to-visit-all-values-in-an-array-in-random-order/" rel="ugc">https://lemire.me/blog/2017/09/26/benchmarking-algorithms-to-visit-all-values-in-an-array-in-random-order/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-287789" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4ae2ec6a2071a468c34352d321fcc6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4ae2ec6a2071a468c34352d321fcc6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Devin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-02T15:43:15+00:00">October 2, 2017 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p>You can also use an RNG to choose a permutation-index [0, n!). Each index represents a specific ordering of all of the elements. For example, 0 might represent the (original) order 0, 1, &#8230;, n &#8211; 2, n &#8211; 1; 1 might represent the order 0, 1, &#8230;, n &#8211; 1, n &#8211; 2; n!-1 might represent the order n &#8211; 1, n &#8211; 2, &#8230;, 1, 0; etc.</p>
<p>The interesting part is defining a specific algorithm that satisfies the above properties in an efficient way. It&rsquo;s similar to algorithms that generate all possible permutations&#8230; but in this case, we want to jump to a specific one. I&rsquo;ve coded something like this up before.</p>
<p>One such algorithm could be related to an efficient solution to Project Euler: <a href="https://projecteuler.net/index.php?section=problems&#038;id=024" rel="nofollow ugc">https://projecteuler.net/index.php?section=problems&#038;id=024</a>. <a href="https://r.prevos.net/euler-problem-24/" rel="nofollow ugc">https://r.prevos.net/euler-problem-24/</a></p>
</div>
<ol class="children">
<li id="comment-287808" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-02T20:43:13+00:00">October 2, 2017 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>I think you refer to Lehmer codes.</p>
<p>Did you post your code?</p>
</div>
<ol class="children">
<li id="comment-287845" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4ae2ec6a2071a468c34352d321fcc6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4ae2ec6a2071a468c34352d321fcc6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Devin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-03T04:42:47+00:00">October 3, 2017 at 4:42 am</time></a> </div>
<div class="comment-content">
<p>Ah, I think Lehmer code is on point. Although I&rsquo;m not sure I knew that it was called that. I don&rsquo;t have the specific code I wrote&#8230; think that was about 10 years ago. I&rsquo;ve whipped something up though that is roughly equivalent (although not specifically Lehmer) <a href="https://gist.github.com/devinrsmith/0320756f5fc9b38fbd23c464dd516de9" rel="nofollow ugc">https://gist.github.com/devinrsmith/0320756f5fc9b38fbd23c464dd516de9</a></p>
<p>This is very similar in spirit the solution that Julian Hyde proposed.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-299004" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/378fb11d6bb0b0d9c4ca2600432db8b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/378fb11d6bb0b0d9c4ca2600432db8b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Petr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-19T21:06:05+00:00">March 19, 2018 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
I tried you C implementation of shuffle() / shuffleReallyFast()<br/>
from here :<br/>
<a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/09/25" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/09/25</a></p>
<p>and result of shuffling of array initialized with items<br/>
0, 1, 2, 3, .. 99<br/>
is this:<br/>
20, 71, 22, 73, 24, 75, 26, 77, 28, 79, ..</p>
<p>Is this expected behaviour ? Output is just two interleaved growing<br/>
sequences with stride of 2 (result of shuffleLCG() looks reasonably random).</p>
<p>Thanks !</p>
</div>
<ol class="children">
<li id="comment-299006" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-19T21:18:29+00:00">March 19, 2018 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>The C code is not randomized, see the remark in the first line of <tt>visit.c</tt>:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/09/25/visit.c#L1" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/09/25/visit.c#L1</a></p>
<p>I only wrote the C code to benchmark speed.</p>
<p>In any case, as I make clear in my blog post, this fast approach is crude and will not fool anyone who is looking for true randomness.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299007" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/378fb11d6bb0b0d9c4ca2600432db8b7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/378fb11d6bb0b0d9c4ca2600432db8b7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Petr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-19T21:20:27+00:00">March 19, 2018 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>Thanks a lot for explanation Daniel !</p>
</div>
</li>
<li id="comment-449094" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/31d942b4cf7b0169a39d6a96a9ef6c97?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/31d942b4cf7b0169a39d6a96a9ef6c97?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Duke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-23T20:51:30+00:00">November 23, 2019 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>Great stuff! This really helped me a lot. I was looking for a randomizing algorithm that functions as a &ldquo;Stateless Deck Shuffler for Very Casual Use&rdquo; that:</p>
<p>Must return each unique value within a set exactly once<br/>
Must return the<br/>
values in a pseudorandom order based on a seed<br/>
Must allow access the values in an arbitrary<br/>
order without generating or storing prior or available values first<br/>
Does not need a hair of cryptographic security</p>
<p>My particular use case is to randomize the order of minor award items given to a player in a game. The player is not likely to notice or care that the items are metered out by a weak randomization algorithm as long as the randomization is good enough to give a thin illusion of randomization.</p>
<p>Using your article as a base, I was able to add some more &ldquo;randomness&rdquo; to my implementation by using a transposition and shifting function multiple times on the index before using it. The number of transpositions/shifts used can be tailored based on desired &ldquo;randomness&rdquo; and calculation time available.</p>
<p>The transposition function I used was a simple de-interleave with the second half of the values reversed. This function could also be tailored to needs.</p>
<p>It does takes a bit of finesse and a strong eye for patterns to tease out artifacts that can result from bad choices for the shift parameters.</p>
<p><code> const int Prime = 53;<br/>
const int Range = 100;<br/>
static int Rando(int index, int seed)<br/>
{<br/>
var transformedIndex = Transpose(index, Range);<br/>
transformedIndex = Transpose(Shift(transformedIndex, 39, Range), Range);<br/>
transformedIndex = Transpose(Shift(transformedIndex, 7, Range), Range);<br/>
transformedIndex = Transpose(Shift(transformedIndex, 68, Range), Range);<br/>
transformedIndex = Transpose(Shift(transformedIndex, 27, Range), Range);</p>
<p> return ((transformedIndex * Prime + seed) % Range);<br/>
}</p>
<p> static int Transpose(int i, int range)<br/>
{<br/>
var odd = (i &amp; 1) == 1;<br/>
var i2 = i &gt;&gt; 1;<br/>
if(odd)<br/>
{<br/>
i2 = range - i2 - 1;<br/>
}<br/>
return i2;<br/>
}</p>
<p> static int Shift(int i, int shift, int range)<br/>
{<br/>
return (i + shift) % range;<br/>
}<br/>
</code></p>
</div>
</li>
</ol>
