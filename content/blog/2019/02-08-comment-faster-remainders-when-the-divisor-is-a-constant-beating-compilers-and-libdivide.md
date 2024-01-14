---
date: "2019-02-08 12:00:00"
title: "Faster remainders when the divisor is a constant: beating compilers and libdivide"
index: false
---

[49 thoughts on &ldquo;Faster remainders when the divisor is a constant: beating compilers and libdivide&rdquo;](/lemire/blog/2019/02-08-faster-remainders-when-the-divisor-is-a-constant-beating-compilers-and-libdivide)

<ol class="comment-list">
<li id="comment-387147" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e240f1a5bb197450dfb8934dd55d9e3a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e240f1a5bb197450dfb8934dd55d9e3a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-08T18:57:28+00:00">February 8, 2019 at 6:57 pm</time></a> </div>
<div class="comment-content">
<p>Your first paragraph states &ldquo;multiplications which are themselves slower than divisions&rdquo;, but surely you meant the opposite.</p>
</div>
<ol class="children">
<li id="comment-387153" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-08T19:29:48+00:00">February 8, 2019 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>Yes. Thank you, I fixed that.</p>
</div>
</li>
</ol>
</li>
<li id="comment-387150" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c5d744640b5a0d326bf75e5579487324?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dendibakh.github.io" class="url" rel="ugc external nofollow">Denis Bakhvalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-08T19:19:03+00:00">February 8, 2019 at 7:19 pm</time></a> </div>
<div class="comment-content">
<p>Looks like it&rsquo;s worth to try to implement in the compilers.</p>
</div>
<ol class="children">
<li id="comment-387278" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa8c1ec221d3aa4ad3208acc2734f5a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa8c1ec221d3aa4ad3208acc2734f5a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://encinc.com" class="url" rel="ugc external nofollow">Brian m</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T05:20:03+00:00">February 9, 2019 at 5:20 am</time></a> </div>
<div class="comment-content">
<p>I ageee. This sounds like a great patch which would be integrated into llvm and/or gcc, rather than a library that would need to be included in. Its great to test to the approach, but realistically most people writing code will not use your library only because they dont know it exists&#8230;. It would be better if just a normal part of the compile process (in the compiler itself)</p>
</div>
</li>
</ol>
</li>
<li id="comment-387209" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T00:10:46+00:00">February 9, 2019 at 12:10 am</time></a> </div>
<div class="comment-content">
<p>Can javascript do the same function? Thanks</p>
</div>
<ol class="children">
<li id="comment-387217" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T00:56:50+00:00">February 9, 2019 at 12:56 am</time></a> </div>
<div class="comment-content">
<p>This is applicable to JavaScript. Integer arithmetic in JavaScript is tricky so you would need to focus on a specific problem.</p>
<p>Evidently, this trick could be implemented in the JavaScript compiler.</p>
</div>
<ol class="children">
<li id="comment-387219" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T01:13:06+00:00">February 9, 2019 at 1:13 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, you mean pure javascript code can do that?<br/>
Can you explain more , Thanks</p>
</div>
</li>
<li id="comment-387232" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5918ca9d2fb7ee42ec22da9ec3d3413?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T01:44:07+00:00">February 9, 2019 at 1:44 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,i have try below javascript code,but get the wrong result ,can you explain why,Thanks.</p>
<p>function fmod(divisor,num){<br/>
let c=(0xFFFFFFFFFFFFFFFF)/divisor+1;<br/>
let lowbits=c<em>num;<br/>
return ((lowbits</em>divisor)&gt;&gt;64)<br/>
}</p>
<p>console.log(fmod(5/18))</p>
</div>
<ol class="children">
<li id="comment-387238" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12f04591b0a10a20ec1a29675b297fbb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12f04591b0a10a20ec1a29675b297fbb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Damian Gray</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T02:09:34+00:00">February 9, 2019 at 2:09 am</time></a> </div>
<div class="comment-content">
<p>All numbers in JS are floats under the hood so the raw bits are not going to act the same as ints. That&rsquo;s probably why the function isn&rsquo;t working as is in pure JS.</p>
</div>
</li>
<li id="comment-387243" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cac08b2f6afa099919ed7da0c0a1268a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cac08b2f6afa099919ed7da0c0a1268a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sol</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T02:36:39+00:00">February 9, 2019 at 2:36 am</time></a> </div>
<div class="comment-content">
<p>Numbers in JavaScript are stored as doubles, and thus cannot exactly represent an integer over 53 bits. Additionally, the bitwise operators all convert the operands to 32-bit signed integers before performing the operation. You are doubly unable to do 64-bit shifts in JavaScript.</p>
</div>
</li>
<li id="comment-387254" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/93e40bc2380737e83b0450deb22810c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/93e40bc2380737e83b0450deb22810c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T03:28:14+00:00">February 9, 2019 at 3:28 am</time></a> </div>
<div class="comment-content">
<p>The most likely answer is that JavaScript does not use 64 bit integer numbers. It uses 64 bit floating point numbers which happen to look like integers for most development purposes.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-387228" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Severin Pappadeux</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T01:40:10+00:00">February 9, 2019 at 1:40 am</time></a> </div>
<div class="comment-content">
<p>Looks like <a href="https://math.stackexchange.com/questions/1251327/is-there-a-fast-divisibility-check-for-a-fixed-divisor" rel="nofollow ugc">https://math.stackexchange.com/questions/1251327/is-there-a-fast-divisibility-check-for-a-fixed-divisor</a></p>
</div>
<ol class="children">
<li id="comment-387355" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T14:30:07+00:00">February 9, 2019 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>It is a similar idea regarding the divisibility test but it does not look the same to me. Our divisibility test has a specific form (<code>n * M &lt; M</code>). Also the answer seems to differentiate between odd and even integers, we do not. Please see our manuscript for the mathematical derivations&#8230; <a href="https://arxiv.org/abs/1902.01961" rel="nofollow ugc">https://arxiv.org/abs/1902.01961</a></p>
</div>
<ol class="children">
<li id="comment-658368" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e8731166b7388b0ec93f7f2c26ca4929?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e8731166b7388b0ec93f7f2c26ca4929?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://matrixcalc.org" class="url" rel="ugc external nofollow">Viktor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2024-01-08T18:14:06+00:00">January 8, 2024 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>but you test requires 64 bit type when working with 32 bit integers, while the method from the link uses only 32 bit types</p>
</div>
<ol class="children">
<li id="comment-658371" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2024-01-08T20:20:38+00:00">January 8, 2024 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>&#8230; which makes it even more likely that it is different. The comment was &quot;Looks like &#8230;&quot;.</p>
<p>It is not the same.</p>
<p>Again, please refer to the published manuscript for details.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-387234" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd21a2d8685d1d5531c95d72573a0865?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd21a2d8685d1d5531c95d72573a0865?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steve</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T02:01:12+00:00">February 9, 2019 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>Great article and paper! Small typo: &ldquo;This approach was known Jacobsohn in 1973&rdquo; should be &ldquo;This approach was known TO Jacobsohn in 1973&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-387339" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T12:40:37+00:00">February 9, 2019 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>I fixed the typo, thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-387328" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/455da12ee7a27b3fbac08e0374ba445e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Monakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T11:00:55+00:00">February 9, 2019 at 11:00 am</time></a> </div>
<div class="comment-content">
<p>Coincidentally, in September 2018 a slightly extended version of divisibility check shown in Hacker&rsquo;s Delight was implemented in GCC (so it doesn&rsquo;t appear in gcc-8, but will be available in gcc-9). Some discussion can be found in <a href="http://gcc.gnu.org/PR82853" rel="nofollow">GCC PR 82853</a>, and you can see the optimization in action <a href="https://godbolt.org/z/9giP2W" rel="nofollow">on Compiler Explorer</a>.</p>
</div>
</li>
<li id="comment-387342" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T12:59:13+00:00">February 9, 2019 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>All well and good, iff one doesn&rsquo;t need the quotient [unless I missed something].</p>
</div>
</li>
<li id="comment-387358" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Theo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T14:36:37+00:00">February 9, 2019 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>Please, have you also tried it with 64-bits &ldquo;n&rdquo;, as it would need 192-bits intermediate computation (if I understood correctly)? Can yo perhaps share some timings as well, in addition to the 32-bits case?</p>
<p>PS: Intel&rsquo;s Cannon Lake is supposed to have 10-18 cycles latency for integer division, could make for interesting comparison!</p>
</div>
<ol class="children">
<li id="comment-387366" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T15:15:51+00:00">February 9, 2019 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p><em>Please, have you also tried it with 64-bits â€œnâ€, as it would need 192-bits intermediate computation (if I understood correctly)? Can yo perhaps share some timings as well, in addition to the 32-bits case?</em></p>
<p>You do not need 192-bit intermediate computations, 128-bit is enough. However, the engineering gets more complicated if you are to deal with overflows properly. We are inviting people to pursue the research. We do not claim to have written the last word on this. If you are interested in pursuing the research and want to chat, do get in touch with us.</p>
<p><em>Intel&rsquo;s Cannon Lake is supposed to have 10-18 cycles latency for integer division, could make for interesting comparison!</em></p>
<p>I have a CannonLake processor right here, and here are the results of the fizzbuzz benchmark:</p>
<pre>
$ ./fizzbuzz
count35(N, &#038;count3, &#038;count5)                :  3.690 cycles per input word (best)  3.698 cycles per input word (avg)
1666666700 1000000000
fastcount35(N, &#038;count3, &#038;count5)            :  2.082 cycles per input word (best)  2.085 cycles per input word (avg)
1666666700 1000000000
</pre>
<p>(This is GCC 8.1.)</p>
<p>Of course, these fizzbuzz tests do not use the division instruction. The division instruction would be slower. However, it would be less terrible than on skylake processors.</p>
</div>
<ol class="children">
<li id="comment-387891" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/199eec8d9b30cce8e502829bcc322a04?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/199eec8d9b30cce8e502829bcc322a04?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/dnbaker" class="url" rel="ugc external nofollow">Daniel Baker</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-12T14:33:53+00:00">February 12, 2019 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve added support for 64-bit unsigned modulo in a fork here (<a href="https://github.com/dnbaker/fastmod/tree/fastmod64" rel="nofollow ugc">https://github.com/dnbaker/fastmod/tree/fastmod64</a>). You&rsquo;re right that 192- (or 256-) bit integers aren&rsquo;t needed; all you need to do is make sure you handle overflows correctly.</p>
<p>I&rsquo;m not saying that this is optimal code, but it does appear to pass the expanded unit tests.</p>
<p>Of course, division and support for signed integers would be desirable as well, but for my purposes, a fast 64-bit mod is all I need.</p>
</div>
<ol class="children">
<li id="comment-387892" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-12T14:35:31+00:00">February 12, 2019 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>Interesting. I will have to have a look at it.</p>
</div>
</li>
<li id="comment-421334" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-31T21:25:16+00:00">July 31, 2019 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>Daniel Baker: Thanks for adapting this!</p>
<p>By the way, your function to compute M:</p>
<p><code>FASTMOD_API __uint128_t computeM_u64(uint64_t d) {<br/>
__uint128_t M = UINT64_C(0xFFFFFFFFFFFFFFFF);<br/>
M &lt;&lt;= 64;<br/>
M |= UINT64_C(0xFFFFFFFFFFFFFFFF);<br/>
M /= d;<br/>
M += 1;<br/>
return M;<br/>
}<br/>
</code></p>
<p>could, I believe, simply be written like this instead:</p>
<p><code>FASTMOD_API __uint128_t computeM_u64(uint64_t d) {<br/>
return (((__uint128_t)0 - 1) / d) + 1;<br/>
}<br/>
</code></p>
<p>or equivalently:</p>
<p><code>FASTMOD_API __uint128_t computeM_u64(uint64_t d) {<br/>
return (-(__uint128_t)1 / d) + 1;<br/>
}<br/>
</code></p>
<p>or even:</p>
<p><code>FASTMOD_API __uint128_t computeM_u64(uint64_t d) {<br/>
return (~(__uint128_t)0 / d) + 1;<br/>
}<br/>
</code></p>
<p>That is to say, it&rsquo;s not necessary to construct and composite the two 64-bit portions in the case of all 1-bits.</p>
</div>
<ol class="children">
<li id="comment-421345" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-31T22:00:49+00:00">July 31, 2019 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>I did not write these functions (not in the current form). I think that the contributor who rewrote them meant to make them more transparent.</p>
<p>Your point is well taken, however.</p>
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
<li id="comment-387368" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Theo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T15:21:54+00:00">February 9, 2019 at 3:21 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for the reply!</p>
</div>
</li>
<li id="comment-387903" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-12T17:31:26+00:00">February 12, 2019 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s lookd like this could be quite useful in the cases that applies! For example <a href="https://github.com/ridiculousfish/libdivide/issues/9" rel="nofollow">this libdivide issue</a> could be finally updated (looks like someone got to it since I first ran across it).</p>
<p>They paper could be clearer though that it only applies (for real ALU sizes) to an N/2-bit division on an N-bit machine. Usually you want an N-bit division on an N-bit machine, and that&rsquo;s what the competing approaches offer.</p>
<p>This means that on a (typical) 32-bit machine only 16-divisors are supported, and on 64-bit only 32-bit divisors are supported. On machines like most x86 where 32-bit and 64-bit multiplications have the same cost, this can still be useful when you are dealing with narrower-than-machine-word things as your <code>uint32_t</code> benchmarks show.</p>
<p>This need for double-width multiplications isn&rsquo;t just indidental: the main speedup is by avoiding the rounding corrections which are required in the quotient approaches: by doubling the width of the operations you avoid the need for rounding.</p>
</div>
</li>
<li id="comment-387910" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-12T18:41:28+00:00">February 12, 2019 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the good words.</p>
<p>The mathematics can be presented as an extension of GM&rsquo;s approach, and it is just as general. A commenter on this blog post has reported an application of the mathematical result to 64-bit unsigned division on 64-bit processors.</p>
<p>An additional insight is that you can avoid the extra work related to avoiding overflows by just using wider registers.</p>
<p>I have more ideas regarding other applications of the mathematical results (that have nothing to do with 32-bit/64-bit registers)&#8230; but I don&rsquo;t have time right now to pursue it so it will have to wait.</p>
</div>
<ol class="children">
<li id="comment-389497" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-18T18:07:26+00:00">February 18, 2019 at 6:07 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The mathematics can be presented as an extension of GM&rsquo;s approach, and<br/>
it is just as general.
</p></blockquote>
<p>The basic mathematics is general, yes â€” I think everyone agrees that the remainder can be calculated as <code>frac(n / d) * d</code> and in the abstract that&rsquo;s just as general as <code>n - trunc(n / d) * d</code>.</p>
<p>However, the earlier work (and this one) primarily focus on the <em>efficient</em> implementation of these methods on real hardware. That&rsquo;s the interesting part, if I&rsquo;m not mistaken?</p>
<p>In that domain, the general target is to implement W-bit division on W-bit machines, and a large amount of the complexity in analysis and much of the runtime cost comes as a result of the difficulty of doing that.</p>
<p>So if you are going to implement only W-bit operations assuming that your machine can do 2W-bit arithmetic, I would certainly consider that less general &#8211; and comparing W-bit approaches against 2W-bit approaches doesn&rsquo;t shed much light on the performance of the underlying techniques since it mixes the two effects together. In fact, I claim that the majority of the improvement in the assembly you show is due to the use of the wider operations and more precise reciprocal, rather than the more &ldquo;direct&rdquo; calculation method.</p>
<blockquote><p>
A commenter on this blog post has reported an application of the<br/>
mathematical result to 64-bit unsigned division on 64-bit processors.
</p></blockquote>
<p>I didn&rsquo;t look at it, but if it were true &#8211; and it was as efficient as the narrow-input case you illustrate &#8211; then my point is basically moot (although it of course still applies to the paper itself, which doesn&rsquo;t mention this).</p>
</div>
<ol class="children">
<li id="comment-389761" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-19T20:12:07+00:00">February 19, 2019 at 8:12 pm</time></a> </div>
<div class="comment-content">
<p><em>That&rsquo;s the interesting part, if I&rsquo;m not mistaken?</em></p>
<p>I cannot dictate what is important or interesting to you. But maybe you agree that more than one thing can be interesting at once.</p>
<p>As far as we know, nobody worked out the mathematics for the direct computation of the remainder. Authors simply ignored the issue. Completing the mathematical framework was important, I think. A direct application of this &ldquo;new math&rdquo; is the divisibility test which I think is really nice.</p>
<p><em>In fact, I claim that the majority of the improvement in the assembly you show is due to the use of the wider operations and more precise reciprocal, rather than the more â€œdirectâ€ calculation method.</em></p>
<p>It might be. It is certainly worth exploring. We published our benchmarking code (see link above) and we include in these benchmarks an approach that computes the remainder with a fast &ldquo;wide&rdquo; division to get the quotient first. It was often faster than other alternatives, but also generally slower than the direct approach. That does not contradict your &ldquo;majority&rdquo; claim&#8230; but few people are interested in the second-best approach when the best approach is no more expensive. Because it was unexciting, it is not reported in the published paper even if it appears in our logs and public code.</p>
</div>
<ol class="children">
<li id="comment-390764" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-23T00:59:36+00:00">February 23, 2019 at 12:59 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
I cannot dictate what is important or interesting to you. But maybe<br/>
you agree that more than one thing can be interesting at once.</p>
<p> As far as we know, nobody worked out the mathematics for the direct<br/>
computation of the remainder. Authors simply ignored the issue.<br/>
Completing the mathematical framework was important, I think.
</p></blockquote>
<p>Yes, I did not mean to imply that the mathematics weren&rsquo;t important. What I mean is that at a high level what makes this whole thing interesting (to me, to you, to almost everyone, I think) in the first place is that it is potentially more efficient than any existing approach. Once that is established, then the math becomes very important indeed to establish the correctness and to understand the limits.</p>
<blockquote><p>
A direct<br/>
application of this â€œnew mathâ€ is the divisibility test which I think<br/>
is really nice.
</p></blockquote>
<p>It is a good point. I haven&rsquo;t considered the divisibility test aspect of this or evaluated competing approaches.</p>
<blockquote><p>
but few people are interested in the second-best approach when the best approach is no more expensive.
</p></blockquote>
<p>That seems strange to me, I would expect the second best approach (i.e., the best <em>existing</em> approach) to be the most important baseline so you can report an improvement over the best existing approach.</p>
<p>Or do you mean that this second-best approach is also new? Assuming it&rsquo;s just a 32-bit division using a 64-bit reciprocal, I don&rsquo;t think that is right: it is well-known that using a large enough reciprocal removes all rounding errors and hence speeds things up &#8211; IIRC the needed number of bits is W + log(d) just like the new direct remainder calculation. Almost every treatment of the topic explains that if you have an X-bit reciprocal, the result is exact, and then go on to handle the harder case where W &lt; X and so you need extra steps to get the exact result, because people do really want W-bit math on W-bit machines.</p>
<p>Yeah, compilers (and libdivide?) don&rsquo;t seem to take advantage of this special case, but that&rsquo;s not news: there are a lot of &ldquo;narrow word&rdquo; tricks they don&rsquo;t implement (and some they do, they seem to have been added over time as special cases).</p>
<p>So for me, the observation with the biggest impact is that compilers and libdivide should special case 32-bit division on 64-bit platforms (where 64-bit multiplication is as fast as 32-bit at least, and the handling of 64-bit constants isn&rsquo;t too onerous) by using a finer-precision reciprocal approximation that produces an exact result. This applies to division as well, not just remainder, so it has wide applicability. The most extensive empirical justification I know of for this improvement is hidden in a paper talking about &ldquo;faster remainders via direct computation&rdquo; though!</p>
<p>Compilers and libdivide should of course also consider using this new faster remainder algo when only remainder is needed and the inputs are narrower than the word size (that said, I think you can extend your algorithm to work generally for W-bit divisions on W-bit hardware, using the same types of rounding tricks as division uses &#8211; that would certainly give a boost to likelihood of integration, I think). They should also use the divisibility check (although again I didn&rsquo;t really evaluate this part).</p>
</div>
<ol class="children">
<li id="comment-391460" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-25T15:13:40+00:00">February 25, 2019 at 3:13 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The most extensive empirical justification I know of for this<br/>
improvement is hidden in a paper talking about â€œfaster remainders via<br/>
direct computationâ€ though!</p>
</blockquote>
<p>That&rsquo;s fair criticism.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-389820" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-20T01:03:45+00:00">February 20, 2019 at 1:03 am</time></a> </div>
<div class="comment-content">
<p>I have written a follow-up blog post: <a href="https://lemire.me/blog/2019/02/20/more-fun-with-fast-remainders-when-the-divisor-is-a-constant/">More fun with fast remainders when the divisor is a constant</a> where I try to elaborate a bit more on the issues.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-389258" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58fc5d1125e10d2f67da9841c14d6b51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58fc5d1125e10d2f67da9841c14d6b51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Johannes</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-17T10:35:10+00:00">February 17, 2019 at 10:35 am</time></a> </div>
<div class="comment-content">
<p>This is really great! Do you happen to know of similar research for &ldquo;mathematical modulo&rdquo;? That is, where the modulo function is always a unsigned integer, so instead of</p>
<p><code>(âˆ’ð‘›) mod ð‘‘ = âˆ’(ð‘› mod ð‘‘)<br/>
</code></p>
<p>we have</p>
<p><code>(âˆ’ð‘›) mod ð‘‘ = d âˆ’ (ð‘› mod ð‘‘)<br/>
</code></p>
<p>I&rsquo;m also curious if there are any newer results on floating point remainder (for my application specifically, a floating point numerator and integer divisor).</p>
</div>
<ol class="children">
<li id="comment-389808" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-20T00:00:30+00:00">February 20, 2019 at 12:00 am</time></a> </div>
<div class="comment-content">
<p>We have not looked at the &quot;mathematical modulo&quot;, but it is probably not too difficult.</p>
<p>Floating point remainders are probably another story entirely.</p>
</div>
</li>
</ol>
</li>
<li id="comment-389928" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58fc5d1125e10d2f67da9841c14d6b51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58fc5d1125e10d2f67da9841c14d6b51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Johannes</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-20T09:02:24+00:00">February 20, 2019 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Great. If I ever get time, I&rsquo;ll take a look at that with your paper as inspiration. Current implementations seem very slow, either using branching or two modulo operations.</p>
</div>
</li>
<li id="comment-404887" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-02T23:03:55+00:00">May 2, 2019 at 11:03 pm</time></a> </div>
<div class="comment-content">
<p>For comparison with the Granlund and Montgomery divisibility check, I just put in a couple of changes to implement that check in the Go compiler following the treatment in Hacker&rsquo;s Delight section 10-17.</p>
<p>The general method can compute unsigned divisibility by one multiplication and a compare for odd divisors and an additional rotate for even divisors. That matches your method when the divisor is odd, but obviously has the extra rotate instruction when the divisor is even. It also has the benefit of using register-sized operations so can work for 64-bit divisibility checks on 64-bit platforms as well. For signed divisibility, the method is similar but requires an additional add.</p>
<p>Unsigned divisibility checks: <a href="https://github.com/golang/go/commit/a28a9427688846f971017924bcf6e8cb623ffba4" rel="nofollow ugc">https://github.com/golang/go/commit/a28a9427688846f971017924bcf6e8cb623ffba4</a></p>
<p>Signed divisibility checks: <a href="https://github.com/golang/go/commit/4d9dd3580624df413d65d83e467fcd6ad4a0168b" rel="nofollow ugc">https://github.com/golang/go/commit/4d9dd3580624df413d65d83e467fcd6ad4a0168b</a></p>
</div>
</li>
<li id="comment-406441" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-13T18:58:05+00:00">May 13, 2019 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>As a follow-up to the Granlund-Montgomery-Warren divisibility check, it looks like recently released gcc9.1 now includes the Hacker’s Delight section 10-17 version of the check at -O2 and will vectorize it at -O3.</p>
<p>Would be interesting to re-run the benchmark above on gcc9.1. Also, looking at the generated code for gcc8.1 it looks like the big advantage of the LKK method is that gcc is able to combine both the 3 and 5 checks into a single multiplication and the compiler can&rsquo;t vectorize either version because count3 and count5 are stored on every loop iteration rather than only at the end of the loop:</p>
<p><a href="https://godbolt.org/z/DivJrk" rel="nofollow ugc">https://godbolt.org/z/DivJrk</a></p>
<p>vs.</p>
<p><a href="https://godbolt.org/z/nb6hMg" rel="nofollow ugc">https://godbolt.org/z/nb6hMg</a></p>
<p>It also looks like LLVM has an open change from Aug 2, 2018 to include the Granlund-Montgomery-Warren divisibility check optimization:</p>
<p><a href="https://reviews.llvm.org/D50222" rel="nofollow ugc">https://reviews.llvm.org/D50222</a></p>
</div>
</li>
<li id="comment-430472" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f42518062c3409008802c0f5f89ebeb3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f42518062c3409008802c0f5f89ebeb3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bas.telkomuniversity.ac.id" class="url" rel="ugc external nofollow">RATRI GALUH</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T03:45:11+00:00">October 7, 2019 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>What is function of formula n/d = n * (2N/d) / (2N) ?</p>
</div>
</li>
<li id="comment-519276" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/27c0cf4c8093fce4b2733ae87c9ead32?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/27c0cf4c8093fce4b2733ae87c9ead32?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul Mattione</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-24T01:28:30+00:00">May 24, 2020 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>This work is great, thank you. I have a question about fastdiv_s32. It looks like it&rsquo;s not supported for MSC_VER because there&rsquo;s no intrinsic for uint64_t * int64_t, right?</p>
<p>However, can&rsquo;t we do the math with the unsigned version and fix the sign at the end? We can first cast the numerator to int64_t before computing its absolute value, so that abs(INT_MIN) doesn&rsquo;t overflow.</p>
<p>Or is there something I&rsquo;m missing?</p>
</div>
<ol class="children">
<li id="comment-519527" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-24T15:01:23+00:00">May 24, 2020 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>Could you take this discussion to the code repo., maybe issue a PR?</p>
</div>
</li>
</ol>
</li>
<li id="comment-524244" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/680f7ef3023d7a1ce85e4eaaa714f0d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/680f7ef3023d7a1ce85e4eaaa714f0d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tomasz Grysztar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T17:39:21+00:00">June 4, 2020 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>In 2017 I have informally published (on my assembly-programming forum) a mathematical proof of a similar family of methods for division and/or computation of remainder: <a href="https://board.flatassembler.net/topic.php?p=199784#199784" rel="nofollow ugc">https://board.flatassembler.net/topic.php?p=199784#199784</a></p>
<p>I wrote there that it is possible to &ldquo;get the remainder R by taking high bits of LD&rdquo;, which is analogous to the &ldquo;fastmod&rdquo; method shown here (what was &ldquo;LD&rdquo; in my notation is &ldquo;lowbits * d&rdquo; here).<br/>
I was not aware that this might be considered novel, otherwise I would pursue the research futher. I still might, as I believe there is still more to be discovered in the area.</p>
<p>Later I also derived a similar divisibility test through a short and simple reasoning based on 2-adic reciprocals: <a href="https://board.flatassembler.net/topic.php?p=211618#211618" rel="nofollow ugc">https://board.flatassembler.net/topic.php?p=211618#211618</a></p>
<p>It differs from the one presented as &ldquo;is_divisible&rdquo; here, since it uses other set of constants, but works on the same principle of just a single multiplication and then comparison.</p>
</div>
<ol class="children">
<li id="comment-524254" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/680f7ef3023d7a1ce85e4eaaa714f0d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/680f7ef3023d7a1ce85e4eaaa714f0d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tomasz Grysztar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T18:22:11+00:00">June 4, 2020 at 6:22 pm</time></a> </div>
<div class="comment-content">
<p>Correction: my divisibility test seems to be the same as described by Granlund and Montgomery, which is mentioned and improved on here. Only my derivation was a bit different (the language of 2-adic numbers makes it a little simpler).</p>
</div>
</li>
</ol>
</li>
<li id="comment-579502" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d70bec81388062ef3b3cfba0cfa695cf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d70bec81388062ef3b3cfba0cfa695cf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/mdempsky" class="url" rel="ugc external nofollow">Matthew Dempsky</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-12T20:58:14+00:00">March 12, 2021 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for the post and paper. I thought you might be interested to know I just submitted a change to Go&rsquo;s garbage collector to make use of the tighter precision bounds from your paper. In the benchmarks I&rsquo;ve run so far, it improved Go program performance by about 1.5%.</p>
<p>The commit is <a href="https://github.com/golang/go/commit/4662029" rel="nofollow ugc">https://github.com/golang/go/commit/4662029</a>. You can see the old and new runtime code in mbitmap.go. We were already replacing division with multiplication, but also used 2 variable shifts to avoid overflow. We also had several branches to try to avoid the multiplication. But it turns out that a single, unconditional 32-bit multiplication works for our needs and is considerably faster.</p>
</div>
<ol class="children">
<li id="comment-579505" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-12T21:36:41+00:00">March 12, 2021 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>I am pleased, thanks for getting in touch. If you&rsquo;d like to elaborate a bit, I&rsquo;d love to publish a guest post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-583491" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b107548987981709812bbfc87911e94f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b107548987981709812bbfc87911e94f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-07T03:24:55+00:00">May 7, 2021 at 3:24 am</time></a> </div>
<div class="comment-content">
<p>I am wondering how this is different from Barrett reduction?</p>
</div>
<ol class="children">
<li id="comment-583831" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-11T22:26:58+00:00">May 11, 2021 at 10:26 pm</time></a> </div>
<div class="comment-content">
<p>The Barrett reduction relies on a branch.</p>
</div>
<ol class="children">
<li id="comment-583832" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-11T22:28:16+00:00">May 11, 2021 at 10:28 pm</time></a> </div>
<div class="comment-content">
<p>And it works by effectively &lsquo;estimating&rsquo; the quotient.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-647996" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/49d9c2ef057dd890855325dd95a9a22f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/49d9c2ef057dd890855325dd95a9a22f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A. Faz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-28T09:31:52+00:00">November 28, 2022 at 9:31 am</time></a> </div>
<div class="comment-content">
<p>When you suggest F=2*N, this is similar to use Barrett reduction, which is the common case in cryptography for reducing double-sized operands.</p>
</div>
</li>
</ol>
