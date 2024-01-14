---
date: "2021-10-26 12:00:00"
title: "In C++, is empty() faster than comparing the size with zero?"
index: false
---

[18 thoughts on &ldquo;In C++, is empty() faster than comparing the size with zero?&rdquo;](/lemire/blog/2021/10-26-in-c-is-empty-faster-than-comparing-the-size-with-zero)

<ol class="comment-list">
<li id="comment-603585" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cf72c93cbd5d849965f2f6af5f22ed26?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cf72c93cbd5d849965f2f6af5f22ed26?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">nyanpasu64</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-26T22:49:42+00:00">October 26, 2021 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>Still disappointed C++ and Rust containers don&rsquo;t have a non_empty() method, and the Rust discussion fizzled out.</p>
</div>
<ol class="children">
<li id="comment-603662" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/64c8d04db904e1a06ad2173e3bfd323c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/64c8d04db904e1a06ad2173e3bfd323c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dmitry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T05:27:21+00:00">October 27, 2021 at 5:27 am</time></a> </div>
<div class="comment-content">
<p>Have you considered writing `not array.empty()`?</p>
</div>
</li>
</ol>
</li>
<li id="comment-603673" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/711667ee33ac2f80927a125dc054691d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/711667ee33ac2f80927a125dc054691d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T08:54:41+00:00">October 27, 2021 at 8:54 am</time></a> </div>
<div class="comment-content">
<p>The is_empty function in this blog post has an obvious mistake 🙂</p>
</div>
</li>
<li id="comment-603675" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T09:28:32+00:00">October 27, 2021 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>&gt; the compiler figures out that as soon as you enter the loop once with count_nodes, then size is going to be greater than zero, so there is no need to keep looping.</p>
<p>It could result in an endless loop, is it allowed to optimize that away? Also, it could wrap (to 0 for unsigned, or negative for signed). With 32 bit integers, it would be quite easy; with 64 bit, not sure how long it would take / memory size needed. Anyway, to me it looks like an incorrect optimization.</p>
<p>The other case, with a limit on 1000, on the other hand, can be optimized away.</p>
</div>
<ol class="children">
<li id="comment-603676" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T09:58:09+00:00">October 27, 2021 at 9:58 am</time></a> </div>
<div class="comment-content">
<p>Ah I see, integer overflow causes undefined behaviour. And for endless loops: GCC assumes that a loop with an exit will eventually exit (option -ffinite-loops)</p>
</div>
<ol class="children">
<li id="comment-603797" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/88e3b960b7dff0f96ade1c143fcc3594?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/88e3b960b7dff0f96ade1c143fcc3594?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">DimeCadmium</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-28T20:29:36+00:00">October 28, 2021 at 8:29 pm</time></a> </div>
<div class="comment-content">
<p>-ffinite-loops (or conversely -O2 -fno-finite-loops) does not affect the assembly output of the optimizable example in this article.</p>
</div>
</li>
</ol>
</li>
<li id="comment-603689" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T13:18:52+00:00">October 27, 2021 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>In C++, an infinite loop without side effects is Undefined Behavior, so the compiler is allowed to optimize it away.</p>
</div>
</li>
</ol>
</li>
<li id="comment-603684" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b3a5c1fc1e8d3cf913b695d7422e2cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b3a5c1fc1e8d3cf913b695d7422e2cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">pjhades</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T13:09:32+00:00">October 27, 2021 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>Maybe a typo? In the end of paragraph 2:<br/>
&gt; to find out the number of containers<br/>
should probably be<br/>
&gt; to find out the number of elements</p>
</div>
<ol class="children">
<li id="comment-603690" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T13:23:53+00:00">October 27, 2021 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>Yes. Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-603687" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/608b3a58b647320ca14211845cc63263?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/608b3a58b647320ca14211845cc63263?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dennis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T13:17:10+00:00">October 27, 2021 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>Better?</p>
<p>bool is_empty(const node* p) {<br/>
return p ;<br/>
}</p>
</div>
<ol class="children">
<li id="comment-603688" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/608b3a58b647320ca14211845cc63263?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/608b3a58b647320ca14211845cc63263?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dennis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T13:17:56+00:00">October 27, 2021 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>Er. return !p</p>
</div>
</li>
</ol>
</li>
<li id="comment-603699" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ccafddaf49c4a6fb03d1f063132c2b2d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ccafddaf49c4a6fb03d1f063132c2b2d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mark</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T16:29:19+00:00">October 27, 2021 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure what the point of this article is. The author explicitly states &ldquo;the people implementing the containers can never scan the content to find out the number of elements.&rdquo;</p>
<p>Then continues on to test against exactly what he described as against the rules. Its not hard to keep track of the size of a container via a class member variable. There is literally no need to scan the items. The empty() probably just returns the size as a bool. This entire discussion and article is pointless.</p>
</div>
<ol class="children">
<li id="comment-603701" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T16:38:15+00:00">October 27, 2021 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p><em>The author explicitly states “the people implementing the containers can never scan the content to find out the number of elements.”</em></p>
<p>For STL containers.</p>
<p>Here is the conclusion:</p>
<blockquote><p>The lesson is that it is probably wise to get in the habit of calling directly empty() if you care about performance. Though it may not help much with modern STL data structures, in other code it could be different.</p></blockquote>
<p>The assumption is that you will not just use STL containers in all of the code you are relying upon. Of course, if you are quite sure to only use recent STL containers, then you may consider the blog post pointless, but what makes you so sure?</p>
</div>
</li>
</ol>
</li>
<li id="comment-603706" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a945279299b56db136a588306e7ba3e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a945279299b56db136a588306e7ba3e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-27T18:35:45+00:00">October 27, 2021 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>thanks for bringing the awareness to us</p>
</div>
</li>
<li id="comment-603795" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1bf5de7bd59f3e18a4d0688d892fa441?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1bf5de7bd59f3e18a4d0688d892fa441?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Walt N</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-28T20:16:49+00:00">October 28, 2021 at 8:16 pm</time></a> </div>
<div class="comment-content">
<p>I have spent a bit too much time in Python, but I wish the STL containers had an implicit conversion to bool. That would be even less code than calling empty().</p>
</div>
</li>
<li id="comment-603802" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a5185cf4865551e962311924c598c90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a5185cf4865551e962311924c598c90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josué Andrade Gomes</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-28T22:14:03+00:00">October 28, 2021 at 10:14 pm</time></a> </div>
<div class="comment-content">
<p>I still prefer clarity and readability. I use empty() to show the intent to, well, check emptiness.</p>
</div>
</li>
<li id="comment-603870" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cd945b69e51c5287420ec0367a66453f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cd945b69e51c5287420ec0367a66453f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-29T08:59:12+00:00">October 29, 2021 at 8:59 am</time></a> </div>
<div class="comment-content">
<p>FYI: <a href="https://godbolt.org/z/bh3PMe8nG" rel="nofollow ugc">https://godbolt.org/z/bh3PMe8nG</a></p>
<p>Seems like &ldquo;&lt;=&quot; allows more optimizations than a simple &quot;!=&quot;</p>
</div>
<ol class="children">
<li id="comment-603939" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a8f1f03245fb8eb790f989193efd2086?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a8f1f03245fb8eb790f989193efd2086?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maarten Bosmans</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-30T08:06:14+00:00">October 30, 2021 at 8:06 am</time></a> </div>
<div class="comment-content">
<p>With that implementation, the count_nodes function returns 0 for an empty list and 1000 for a non-empty list. That is not what was meant for the overflow-preventing case.</p>
</div>
</li>
</ol>
</li>
</ol>
