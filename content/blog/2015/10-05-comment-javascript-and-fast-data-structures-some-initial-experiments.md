---
date: "2015-10-05 12:00:00"
title: "JavaScript and fast data structures: some initial experiments"
index: false
---

[12 thoughts on &ldquo;JavaScript and fast data structures: some initial experiments&rdquo;](/lemire/blog/2015/10-05-javascript-and-fast-data-structures-some-initial-experiments)

<ol class="comment-list">
<li id="comment-194624" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://news.kynosarges.org" class="url" rel="ugc external nofollow">Chris Nahr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-06T02:40:01+00:00">October 6, 2015 at 2:40 am</time></a> </div>
<div class="comment-content">
<p>Regarding the benchmarks: Java is slower because you&rsquo;re putting integers into a generic container. Java must box every single one of those integers with an object wrapper to put them into the container, then unbox them again when reading their values.</p>
<p>There is still no optimization for this, at least until value types are properly supported in Java 10. For decent speed you must use non-generic containers with hard-coded numerical types, see e.g. <a href="http://java-performance.info/hashmap-overview-jdk-fastutil-goldman-sachs-hppc-koloboke-trove-january-2015/" rel="nofollow ugc">http://java-performance.info/hashmap-overview-jdk-fastutil-goldman-sachs-hppc-koloboke-trove-january-2015/</a></p>
<p>JavaScript engines are smarter about integers: they use &ldquo;tagged values&rdquo; for object instances that directly represent 31-bit integer values if a flag bit is zero. See here for V8: <a href="http://thibaultlaurens.github.io/javascript/2013/04/29/how-the-v8-engine-works/" rel="nofollow ugc">http://thibaultlaurens.github.io/javascript/2013/04/29/how-the-v8-engine-works/</a></p>
<p>Try rerunning your benchmarks with strings (always objects) or with large integers or non-integers, those should force boxing in Chrome.</p>
</div>
</li>
<li id="comment-194637" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-06T09:13:25+00:00">October 6, 2015 at 9:13 am</time></a> </div>
<div class="comment-content">
<p>Could this be optimized for JavaScript running in html5 browsers by using canvas objects to manipulate the bitsets?</p>
</div>
</li>
<li id="comment-194638" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-06T09:28:36+00:00">October 6, 2015 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>@Chris </p>
<p>The important point is what you just wrote: &ldquo;JavaScript engines are smart&rdquo;. 😉</p>
</div>
</li>
<li id="comment-194639" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-06T09:29:56+00:00">October 6, 2015 at 9:29 am</time></a> </div>
<div class="comment-content">
<p>@Simon</p>
<p>I am not exactly sure how canvas objects could be used to manipulate bitsets. So my answer is: I do not know.</p>
</div>
</li>
<li id="comment-194670" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f698ce7180dbf5e3d13bd1e2a9a0695?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f698ce7180dbf5e3d13bd1e2a9a0695?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://Devcrapshoot.com" class="url" rel="ugc external nofollow">Addam</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-06T22:24:48+00:00">October 6, 2015 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>After looking at your JavaScript loop, try rewriting it like this and see how much your performance increases:</p>
<p>answer.words = new Unit32Array(answer.count);<br/>
var k = 0<br/>
, nCount = answer.count<br/>
;</p>
<p>for (; k &lt; nCount; k++) {<br/>
answer.words[k] = t[k] | o[k];<br/>
}</p>
</div>
</li>
<li id="comment-194673" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d9aba79be37c3e972c9d572ee7dc66b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d9aba79be37c3e972c9d572ee7dc66b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://franciskim.co" class="url" rel="ugc external nofollow">Francis Kim</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-07T00:22:03+00:00">October 7, 2015 at 12:22 am</time></a> </div>
<div class="comment-content">
<p>Thank you for the great work! I&rsquo;ve just starred it.</p>
</div>
</li>
<li id="comment-194687" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b751676001ff4a52b48504f2ed1ab043?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b751676001ff4a52b48504f2ed1ab043?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://patricklam.ca" class="url" rel="ugc external nofollow">plam</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-07T06:56:18+00:00">October 7, 2015 at 6:56 am</time></a> </div>
<div class="comment-content">
<p>JavaScript doesn&rsquo;t quite differentiate between ints and floats; that has to be inferred by the runtime system. However, it looks like JavaScript does not support 64-bit integers; anything above 2^53-1 is going to be represented by a float.</p>
<p><a href="https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Number/MAX_SAFE_INTEGER" rel="nofollow ugc">https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/Number/MAX_SAFE_INTEGER</a></p>
<p>v8 has 32-bit ints.</p>
</div>
</li>
<li id="comment-194692" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f933d9a29c415d761a0e77cfc5f7b84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-07T08:43:25+00:00">October 7, 2015 at 8:43 am</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>I was thinking that an entire bitset could be stored in a canvas. Then two canvases can be composited together to show for example the logical AND of all the bits. Then the bits read our if the canvas.</p>
</div>
</li>
<li id="comment-194693" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-07T08:58:26+00:00">October 7, 2015 at 8:58 am</time></a> </div>
<div class="comment-content">
<p>@Simon</p>
<p>How fast can you query and set individual bits in a canvas?</p>
</div>
</li>
<li id="comment-194704" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-10-07T12:34:01+00:00">October 7, 2015 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>@Addam </p>
<p>As I wrote in my post, the bulk of the running time is spent executing the object allocation :</p>
<p>answer.words = new Unit32Array(answer.count);</p>
<p>I can remove all the computations that follow, and the speed won&rsquo;t increase by more than 50%.</p>
<p>So what I need is some way to optimize the Unit32Array.</p>
<p>I can get rid of it and replace it by a simple Array, and the speed improves in this case, but it degrades in other ways. Also, I suspect that Unit32Array uses less space than Array. (Probably half as much.)</p>
</div>
</li>
<li id="comment-243435" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://joseduarte.com" class="url" rel="ugc external nofollow">JosÃ© Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-07T21:22:34+00:00">June 7, 2016 at 9:22 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, why the conflation of JavaScript with V8? I&rsquo;d be curious to see the results in other JavaScript engines, especially Microsoft&rsquo;s Chakra and Firefox. Chakra is the fastest JS engine according to benchmarks spanning the last year or so (Edge being the browser, though Chakra in IE11 won benchmarks when it was new).</p>
<p>Firefox and Edge are especially intriguing because of their full support for asm.js, the fast subset of JavaScript that is emitted by Emscripten. It would be fascinating if asm.js made a big difference for these workloads. It offers a richer set of types, including explicit integers, though not 64-bit. Only Firefox and Edge support asm.js and perform AOT compilation for it, though V8 is supposed to benefit from asm.js code to some extent.</p>
</div>
<ol class="children">
<li id="comment-243436" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-07T21:41:34+00:00">June 7, 2016 at 9:41 pm</time></a> </div>
<div class="comment-content">
<p>> why the conflation of JavaScript with V8? </p>
<p>I have convenient scripts that run benchmarks automatically through node on my linux boxes. V8 happens to be the engine under Node. It is very convenient to be able to run perfectly reproducible benchmarks, and this is made a lot easier with a carefully configured server box (not a laptop!).</p>
<p>I invite contributed benchmarks based on other engines.</p>
<p>> Firefox and Edge are especially intriguing because of their full support for asm.js, the fast subset of JavaScript that is emitted by Emscripten. It would be fascinating if asm.js made a big difference for these workloads. It offers a richer set of types, including explicit integers, though not 64-bit. </p>
<p>I have played with ams.js but not tested it thoroughly. I have not yet seen anything interesting. To be clear, I am impressed by Emscripten, but not by what I have seen with ams.js so far.</p>
<p>I am inviting benchmarks.</p>
</div>
</li>
</ol>
</li>
</ol>
