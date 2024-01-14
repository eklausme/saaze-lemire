---
date: "2019-09-05 12:00:00"
title: "Passing integers by reference can be expensive&#8230;"
index: false
---

[9 thoughts on &ldquo;Passing integers by reference can be expensive&#8230;&rdquo;](/lemire/blog/2019/09-05-passing-integers-by-reference-can-be-expensive)

<ol class="comment-list">
<li id="comment-426312" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T21:32:22+00:00">September 5, 2019 at 9:32 pm</time></a> </div>
<div class="comment-content">
<p>This effect is due to possible aliasing. The compiler can&rsquo;t be sure the array and the passed in value don&rsquo;t overlap (i.e., that the referenced value isn&rsquo;t one of the array elements). In the case of aliasing, the semantics of the two loops are not the same, since the value i will be modified by the assignment (once) in addition to the increment (maybe it&rsquo;s even UB due to double-modifcation w/o sequence point). So the compiler emits this conservative code which reloads the value each time. In addition to slower code due to the in-memory increment, optimizations like vectorization are inhibited.</p>
</div>
<ol class="children">
<li id="comment-426320" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T22:07:57+00:00">September 5, 2019 at 10:07 pm</time></a> </div>
<div class="comment-content">
<p>Possible fixes:</p>
<p>1) Copy <code>i</code> into a local before the loop. This way the compiler knows aliasing isn&rsquo;t possible since <code>i</code> is an unescaped local. You&rsquo;ll have to copy <code>i</code> back at the end to maintain the semantics of incrementing <code>k</code> times.</p>
<p>2) Put the __restrict qualifier on either<code>i</code> or <code>x</code>, or both. Roughly speaking, this tells the compiler the values don&rsquo;t overlap. It isn&rsquo;t standard in C++, but is relatively widely supported, perhaps because it <em>is</em> standard in C.</p>
<p>3) Use different types. If the type pointed to by<code>x</code> is different than the type of <code>i</code>, most compilers use type based aliasing analysis (TBAA) to prove aliasing doesn&rsquo;t occur.</p>
<p>The compiler could also save you, e.g., by checking whether aliasing occurs <em>at runtime</em>, eg checking whether the address of <code>i</code> falls in the range <code>x</code> &#8211; <code>x + k</code>. I&rsquo;m fact, both clang and gcc do this for slightly simpler cases, where <code>i</code> is not incremented: if the runtime check passes, the fast loop is used, otherwise it falls back to the conservative one.</p>
</div>
<ol class="children">
<li id="comment-426323" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-05T22:30:17+00:00">September 5, 2019 at 10:30 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Use different types.</p>
</blockquote>
<p>In my opinion, this is trickier than it sounds. Naively, I would think that &lsquo;counter&rsquo; in the example below is of a type distinct from &lsquo;uint64_t&rsquo;&#8230; but I see the same bad optimization effect, possibly because the standard does not allow the compiler to forbid aliasing of this sort. And this says nothing about real C++ code where it is not always immediately obvious what the actual type is (due to the tendency of C++ programmers to abstract away types).</p>
<pre><code>struct counter {
    uint64_t val;
    uint32_t garbage;    
};

void incrementj(counter &amp; i, uint64_t * x){
    for(int k = 0; k &lt; 1000000; k++) {
       x[k] += i.val++;
    }
}
</code></pre>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-426369" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-06T06:11:24+00:00">September 6, 2019 at 6:11 am</time></a> </div>
<div class="comment-content">
<p>Does using a local copy of <code>i</code>, and copying the final value back to the reference make a difference? So <code>uint64_t j = i; for (; j &lt; size; j++) ... i = j;</code>?</p>
</div>
<ol class="children">
<li id="comment-426396" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-06T13:00:22+00:00">September 6, 2019 at 1:00 pm</time></a> </div>
<div class="comment-content">
<p>Right: creating a local copy helps the compiler.</p>
</div>
</li>
</ol>
</li>
<li id="comment-426389" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba330e4a4bcef42c1c8251dc8688caad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba330e4a4bcef42c1c8251dc8688caad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-06T12:11:51+00:00">September 6, 2019 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>You mention that Swift is likely affected by this, but it&rsquo;s not. Swift enforces at a language level that inout parameters don&rsquo;t alias. Usually at compile time, but with runtime precondition checks when it can&rsquo;t prove it statically.</p>
<p>Swift code currently has other overhead that makes this function bigger than it&rsquo;s C equivalent but those are separate issues. Largely due to the fact that an array in Swift is not just a pointer to data, but is in fact a copy-on-write ref-counted type that knows its own size and capacity and can change its size to fit its elements.</p>
</div>
<ol class="children">
<li id="comment-426395" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-06T12:45:35+00:00">September 6, 2019 at 12:45 pm</time></a> </div>
<div class="comment-content">
<p>I make no claim regarding aliasing. I make a claim regarding performance.</p>
<p>My claim is that this is going to be slower&#8230;</p>
<pre><code>func fx(_ allints: inout [Int],  _ j : inout Int) {
      for k in allints.indices {
        allints[k] = j
        j &amp;+= 1
      }
 }
</code></pre>
<p>than the following&#8230;</p>
<pre><code> func f(_ allints: inout [Int],  _ i : inout Int) {
      var j = i
      for k in allints.indices {
        allints[k] = j
        j &amp;+= 1
      }
      i = j
 }
</code></pre>
<p>Now, admittedly, there is no fundamental reason for it when the array is large. Even in C++, the compiler could add a check for overlap at the start (knowing that the loop is quite long) and optimize it away. My point in this post is that current compilers (at least some popular ones) will let you down.</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/09/05/swift" rel="nofollow">I took a few seconds to write a Swift version of the benchmark</a>&#8230;</p>
<pre><code>$ swift -O reference.swift
ref 1.892044 ns
hard 0.554002 ns
</code></pre>
<p>Basically, Swift exhibits exactly the same performance characteristics as C++ with GNU GCC 8. In fact, if you convert the nanoseconds into CPU cycles, you get very nearly the same performance down to a fraction of a cycle.</p>
<p>I do not doubt that Swift &ldquo;doesn&rsquo;t alias&rdquo;, as you explain&#8230; but it does not follow that the two functions have the same performance once compiled (with optimizations).</p>
</div>
<ol class="children">
<li id="comment-426476" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba330e4a4bcef42c1c8251dc8688caad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba330e4a4bcef42c1c8251dc8688caad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-07T14:26:19+00:00">September 7, 2019 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s quite bizarre, as inout variables are defined to be semantically <em>exactly</em> the same as copying the value to a local variable and copying the new value back to the original variable at the end of the function definition, so according to the rules of the language these functions should generate the exact same code.</p>
<p>Do you mind if I include your benchmark in a bug report on the Swift compiler?</p>
</div>
<ol class="children">
<li id="comment-426477" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-07T14:36:16+00:00">September 7, 2019 at 2:36 pm</time></a> </div>
<div class="comment-content">
<p>Please do. Feel free to refer to my blog post as well. 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
