---
date: "2023-04-20 12:00:00"
title: "Defining interfaces in C++: concepts versus inheritance"
index: false
---

[16 thoughts on &ldquo;Defining interfaces in C++: concepts versus inheritance&rdquo;](/lemire/blog/2023/04-20-defining-interfaces-in-c-concepts-versus-inheritance)

<ol class="comment-list">
<li id="comment-651137" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">David Leimbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T20:25:54+00:00">April 20, 2023 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>Should the inheritance not be public? C++ defaults to private inheritance.</p>
</div>
<ol class="children">
<li id="comment-651140" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T20:38:57+00:00">April 20, 2023 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>Why would that be a concern?</p>
</div>
<ol class="children">
<li id="comment-651142" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Leimbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T20:44:04+00:00">April 20, 2023 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>Private inheritance means you don’t get the base class interface as your own in the derived class. It is not an “is a” relation. It’s more of a “has a” relation.</p>
</div>
<ol class="children">
<li id="comment-651144" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Leimbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T21:10:38+00:00">April 20, 2023 at 9:10 pm</time></a> </div>
<div class="comment-content">
<p>Ah but you had a strict! My mistake!</p>
</div>
<ol class="children">
<li id="comment-651145" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d3e549438f4a7bce78731ab26214d08?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Leimbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T21:11:01+00:00">April 20, 2023 at 9:11 pm</time></a> </div>
<div class="comment-content">
<p>“Struct”</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651146" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f358c44d3c7047f8dee2f8768d29456?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f358c44d3c7047f8dee2f8768d29456?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Will</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T21:12:46+00:00">April 20, 2023 at 9:12 pm</time></a> </div>
<div class="comment-content">
<p>In the example, <code>iterable_array</code> is defined as a <code>struct</code>, which defaults to public inheritance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651138" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T20:31:50+00:00">April 20, 2023 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>Moreso: when things are decided at runtime, bugs are not detected without a test that tickles them. With things decided at compile time, you often get to have the compiler refuse to compile the bugs.</p>
<p>It is a daily occurrence for modern C++ code, as with Rust code, to run correctly on the first try. Memory usage errors become difficult to make when your program has no visible pointers. Concurrency errors become difficult to make when you have no visible threads or thread synchronization.</p>
</div>
<ol class="children">
<li id="comment-651190" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bf34a2a6c18849fcf02678adb2ea9b9c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bf34a2a6c18849fcf02678adb2ea9b9c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">cppdev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-21T11:50:59+00:00">April 21, 2023 at 11:50 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Memory usage errors become difficult to make when your program has no visible pointers.
</p></blockquote>
<p>Which would kind of take us back to Pascal 🙂</p>
</div>
</li>
</ol>
</li>
<li id="comment-651154" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/617a07e44340ae75c9182092a4d1ed90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/617a07e44340ae75c9182092a4d1ed90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T23:58:00+00:00">April 20, 2023 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s nice seeing someone discovering Alex Stepanov ideas of from 90s.</p>
</div>
<ol class="children">
<li id="comment-651651" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3c36bd0e795f36448fc617528b5d9dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3c36bd0e795f36448fc617528b5d9dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Helmut Zeisel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-15T06:39:36+00:00">May 15, 2023 at 6:39 am</time></a> </div>
<div class="comment-content">
<p>Can you please explain that in more detail?</p>
</div>
</li>
</ol>
</li>
<li id="comment-651196" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c70075157c416c2baa2e7df29bcf7d81?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c70075157c416c2baa2e7df29bcf7d81?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Tsitelov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-21T14:25:16+00:00">April 21, 2023 at 2:25 pm</time></a> </div>
<div class="comment-content">
<p>If I mark the <code>count_inheritance</code> function as <code>inline</code> and pass to it an <code>iter_base</code> instance with a compile-time deducible type, will a modern optimizing compiler do the same (or similar) optimizations as for the concept-based approach?</p>
</div>
<ol class="children">
<li id="comment-651198" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-21T14:52:09+00:00">April 21, 2023 at 2:52 pm</time></a> </div>
<div class="comment-content">
<p>In theory, I suppose it could, but I have not observed this behaviour in the scenario outlined in the blog post.</p>
</div>
</li>
<li id="comment-651289" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-24T15:27:20+00:00">April 24, 2023 at 3:27 pm</time></a> </div>
<div class="comment-content">
<p>Sadly even with <code>inline</code> the compilers cannot inline the virtual method calls. Actually, it is even worse (at least with GCC): adding inheritance spoils the <code>constexpr</code> , now the compiler needs to make virtual function calls even in the context of templates.</p>
<p>I had to add <code>final</code> to <code>iterable_arry</code> to recover optimizations.</p>
<p>See the assembly for <code>concept_count</code> and <code>inheritance_count</code> functions with and without <code>final</code>:</p>
<p><a href="https://godbolt.org/z/6o1v7hEME" rel="nofollow ugc">https://godbolt.org/z/6o1v7hEME</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-651288" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marius</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-24T15:11:28+00:00">April 24, 2023 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p><em>taking a concept instance as a parameter </em></p>
<p>No, no, no. The function template <code>count</code> takes a template type <code>T</code> parameter which satisfies the concept <code>is_iterable</code>. Concept is a set of constraints over types. One cannot really pass a concept as an argument &#8212; that&rsquo;s just too much meta.</p>
</div>
</li>
<li id="comment-651625" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/79ba31e0d7f0aa81346b371cda35a401?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/79ba31e0d7f0aa81346b371cda35a401?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ratus.app" class="url" rel="ugc external nofollow">Andrew Haining</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-13T13:13:22+00:00">May 13, 2023 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>You see this sentiment echoed a lot and while in practice, it is mostly true, it&rsquo;s not because virtualisation is inherently evil, it&rsquo;s that optimisers are not very good at devirtualisation. In this example, it&rsquo;s trivial to devirtualise iterable_array with lto or wpo and if it&rsquo;s marked final it&rsquo;ll even work across a dynamic boundary.</p>
<p>Saying that concepts are still simpler and more expressive, easier to use and harder to misuse and in practice generate better code.</p>
</div>
</li>
<li id="comment-652846" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f6767750c0a1d8cfa5304d2832b3a85?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f6767750c0a1d8cfa5304d2832b3a85?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pavel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-09T10:49:56+00:00">July 9, 2023 at 10:49 am</time></a> </div>
<div class="comment-content">
<p>That passage about &ldquo;Given an optimizing compiler&#8230;&rdquo; leaves me puzzled. Why would compiler developers go as far as teaching it to reason about programers code to this extent? Optimizing &ldquo;count(a)&rdquo; to just returning the size of vector is not a kind of optimization I would like to get under the hood. Because it brings a side effect that can lead to errors in the program. Inner &ldquo;index&rdquo; value wouldn&rsquo;t be changed, while it should.</p>
</div>
</li>
</ol>
