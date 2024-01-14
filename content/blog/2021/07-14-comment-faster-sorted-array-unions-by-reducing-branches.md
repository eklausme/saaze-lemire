---
date: "2021-07-14 12:00:00"
title: "Faster sorted array unions by reducing branches"
index: false
---

[21 thoughts on &ldquo;Faster sorted array unions by reducing branches&rdquo;](/lemire/blog/2021/07-14-faster-sorted-array-unions-by-reducing-branches)

<ol class="comment-list">
<li id="comment-590726" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6874da859bb0b7598340709b6361a77?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Maynard+Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-14T21:16:31+00:00">July 14, 2021 at 9:16 pm</time></a> </div>
<div class="comment-content">
<p>You can generate marginally better scalar ARM64 Clang code by switching the</p>
<p>pos2 = (v2 &lt;= v1) ? pos2 + 1 : pos2;</p>
<p>to</p>
<p>pos2 = (v1 &gt;= v2) ? pos2 + 1 : pos2;</p>
<p>which allows reuse of the initial cmp.<br/>
(Yes, it&rsquo;s dumb that clang doesn&rsquo;t catch this. Sigh&#8230;)</p>
<p>By my rough reckoning the M1&rsquo;s critical path through the code is the use of the three integer units that handle flags/branches, and the above modification removes one instruction that requires these units.<br/>
(The extent to which that rough calculation represents the true gating depends on just how much time is spent in that loop, allowing all the possible instruction unrolling overlap to occur.)</p>
<p>The clang codegen still sucks, however. You can remove the increment of pos, via the horrible but traditional</p>
<p>*output_buffer++<br/>
(Store the incoming value of output_buffer at the start, and subtract it away to get the return value. Compiler should do that!)</p>
<p>The other clang&rsquo;ism that looks suboptimal is it insists on dumb scheduling, splitting the cmp from the subsequent b.hs. No decent ARM64 core will care about the scheduling of one instruction between the cmp and the b.hs; but most will lose the opportunity to fuse the cmp and the b.hs into a single executable op.</p>
<p>Since this removes a second instruction from our critical path of &ldquo;instructions that use the flags/branch units&rdquo; it&rsquo;s probably worth forcing in assembly if this were production code. (Of course then you&rsquo;d go vector, I assume&#8230;)</p>
<p>[Also, just on style grounds, I think it&rsquo;s better to have</p>
<p>while ((pos1 &lt; size1) &amp;&amp; (pos2 &lt; size2)) {</p>
<p>ie replace the &amp; with an &amp;&amp; even though that doesn&rsquo;t affect code gen.]</p>
</div>
<ol class="children">
<li id="comment-590731" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-14T21:51:03+00:00">July 14, 2021 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
<p>Yes. Before using assembly, I would definitively use SIMD instructions.</p>
<p>I use&#8230;</p>
<pre><code>A &amp; B
</code></pre>
<p>to indicate that both A and B can be evaluated as opposed to</p>
<pre><code>A &amp;&amp; B
</code></pre>
<p>where I expect only A to be evaluated if it is false.</p>
</div>
</li>
</ol>
</li>
<li id="comment-590751" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6defe3705d9d50e64113d1522750185d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6defe3705d9d50e64113d1522750185d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Veedrac</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-15T01:48:25+00:00">July 15, 2021 at 1:48 am</time></a> </div>
<div class="comment-content">
<p>Sort the input arrays such that input1 will always be exhausted first. This removes a comparison from the loop and deletes one of the trailing loops.</p>
<p>Use <code>pos1 += v1 &lt;= v2; pos2 += v2 &lt;= v1;</code> to force branchless execution.</p>
</div>
</li>
<li id="comment-590791" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8914feeb1429ace7df53ba46a0c28918?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8914feeb1429ace7df53ba46a0c28918?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey M.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-15T10:17:48+00:00">July 15, 2021 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>I wonder if</p>
<p>pos1 = (v1 &lt;= v2) ? pos1 + 1 : pos1;</p>
<p>could be changed to</p>
<p>pos1 += !!(v1 &lt;= v2);</p>
<p>?</p>
</div>
<ol class="children">
<li id="comment-591636" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-21T14:31:00+00:00">July 21, 2021 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p>You don&rsquo;t need the &ldquo;!!&rdquo;; &lt;= already returns a boolean (exclusively 0 or 1) result.</p>
<p>I do like to wrap such conditional expressions in () just to be clear, i.e.<br/>
pos1 += (v1 &lt;= v2);</p>
<p>But, yes, such an expression makes clear to readers that I expect branch-free code. When the increment amount isn&rsquo;t 1, then it&rsquo;s more of a toss-up between:<br/>
pos += (condition) ? 42 : 0;<br/>
pos += -(condition) &amp; 42;<br/>
The former is more readable, but the latter is closer to what I hope most processors (other than ARM) will generate.</p>
</div>
</li>
</ol>
</li>
<li id="comment-590823" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sokolov Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-15T17:31:53+00:00">July 15, 2021 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>Storing comparison result in variable makes GCC to use conditional set/move: <a href="https://godbolt.org/z/zs3WzqjqP" rel="nofollow ugc">https://godbolt.org/z/zs3WzqjqP</a></p>
</div>
<ol class="children">
<li id="comment-590825" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sokolov Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-15T17:34:08+00:00">July 15, 2021 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>Well, looks like size_t variable and difference is better for GCC <a href="https://godbolt.org/z/4n4963sKj" rel="nofollow ugc">https://godbolt.org/z/4n4963sKj</a></p>
</div>
<ol class="children">
<li id="comment-590828" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-15T18:10:57+00:00">July 15, 2021 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>I have added a corrected version of your function to the benchmark on github.</p>
</div>
<ol class="children">
<li id="comment-590882" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sokolov Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-16T03:20:36+00:00">July 16, 2021 at 3:20 am</time></a> </div>
<div class="comment-content">
<p>There is a bug in both union2by2_branchless_variable and union2by2_branchless_ptr: <code>!(v1 &lt;= v2) != (v2 &lt;= v1)</code> , ie merge procedure drops one of two equal elements.</p>
</div>
</li>
<li id="comment-590883" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sokolov Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-16T03:22:14+00:00">July 16, 2021 at 3:22 am</time></a> </div>
<div class="comment-content">
<p>and union2by2_branchless too.</p>
</div>
</li>
<li id="comment-590885" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sokolov Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-16T03:29:58+00:00">July 16, 2021 at 3:29 am</time></a> </div>
<div class="comment-content">
<p>Ahh, I see: task were to union sorted sets ie arrays with all unique elements. I missed &ldquo;unique&rdquo; part of a task.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-590886" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9f49ac7798d3f89004aa24ce10b0f9bc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9f49ac7798d3f89004aa24ce10b0f9bc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wanghenshui.github.io" class="url" rel="ugc external nofollow">Ted</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-16T03:34:55+00:00">July 16, 2021 at 3:34 am</time></a> </div>
<div class="comment-content">
<p>in llvm , I bench it, <a href="https://quick-bench.com/q/tNdjEe-55p6zPjDGF-jBIgDYJAQ" rel="nofollow ugc">https://quick-bench.com/q/tNdjEe-55p6zPjDGF-jBIgDYJAQ</a><br/>
bm_union2by2_branchless_ptr version is not fast as bm_union2by2_branchless_variable and bm_union2by2, why? only because it&rsquo;s pointer?</p>
</div>
<ol class="children">
<li id="comment-590941" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-16T14:35:03+00:00">July 16, 2021 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>I do not know the answer in this particular instance, but it is not uncommon for code written directly in terms of pointers to be slower due to the overhead of doing arithmetic in address space. Compilers often do a better job when you use indexes. For speed, I recommend working with indexes by default unless you have a specific reason to prefer pointer arithmetic.</p>
<p>I included the pointer approach in my code because someone said it was faster.</p>
</div>
</li>
</ol>
</li>
<li id="comment-591038" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per Vognsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-17T07:16:53+00:00">July 17, 2021 at 7:16 am</time></a> </div>
<div class="comment-content">
<p>There are two relatively simple ways to extract more instruction-level parallelism from a branchless merge routine since it&rsquo;s so latency limited; I estimate the carried dependency latency as 6 cycles on Zen 3. The simplest is to merge from the front and back at the same time. The next level beyond that is to take the middle element (median) of the larger array and split the smaller array by it using one binary search. That splits the problem into two subproblems to which you can apply bidirectional merging. Splitting by the median like this is the idea behind parallel merge sort, but it also works well for extracting ILP.</p>
</div>
<ol class="children">
<li id="comment-591046" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per Vognsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-17T08:05:32+00:00">July 17, 2021 at 8:05 am</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s a simple benchmark I just whipped up. For large arrays with millions of random uint32 elements, on my Zen 3 laptop the unidirectional merge1 function runs in 7 cycles/elem and the bidirectional merge2 function runs in 3.5 cycles/elem. The binary search median splitting is the same idea but with 4 merge frontiers instead of 2 (you can add more frontiers but register pressure becomes an issue).</p>
<p><a href="https://gist.github.com/pervognsen/fa2a8cba0dc852094067348a57492ecb" rel="nofollow ugc">https://gist.github.com/pervognsen/fa2a8cba0dc852094067348a57492ecb</a></p>
</div>
<ol class="children">
<li id="comment-591048" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per Vognsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-17T08:32:22+00:00">July 17, 2021 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>And just as I say posted that code, I realized this doesn&rsquo;t apply directly to sorted set union/intersection/difference (at least not without intermediate buffers or a final compaction pass) since you don&rsquo;t know the cardinality of the final result ahead of time. (I wonder if that is an argument in favor of representing sorted sets as a list or tree of array chunks rather than forcing a flat array.)</p>
<p>If nothing else, hopefully these ideas for extracting more parallelism from branchless merging (as used merge in sort) will be helpful to people who haven&rsquo;t seen it before.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-591260" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-18T15:23:27+00:00">July 18, 2021 at 3:23 pm</time></a> </div>
<div class="comment-content">
<p>Some quick thoughts having only explored this a little bit:</p>
<p>1) I think Veedrac has a good suggestion above to remove a comparison from the main loop. Instead of checking to see if you have reached the end of either list on each iteration, if you &ldquo;peek&rdquo; at the end of each list at the beginning you only have to check the list that you know will end first. That is, add a wrapper function that compares the last element of each list, and swaps input1/2 and size1/2 before starting the merge. This removes a comparison per iteration.</p>
<p>2) While assigning the result of the comparison to a variable does convince GCC to use a fully branchless approach, it still produces longer code than Clang. The difference (as you and others have probably already realized) is that Clang realizes that only a single comparison is necessary if it uses &ldquo;sbb&rdquo; (subtract with borrow). Since a comparison is internally just a subtraction, this might not save much, but it does simplify the inner loop.</p>
<p>3) In union2by2_branchless_variable, the use of &ldquo;d&rdquo; and &ldquo;d2&rdquo; to store the comparison results seems like a parody of bad computer science naming conventions. Given how much you value code clarity, I&rsquo;m surprised by your use of such unhelpful variable names. Maybe &ldquo;use_v1&rdquo; and &ldquo;use_v2&rdquo;? I ended up with this: <a href="https://godbolt.org/z/53rhaoebc" rel="nofollow ugc">https://godbolt.org/z/53rhaoebc</a> (with a wrapper function needed to possibly reorder the inputs, and a tail needed to copy the remaining elements).</p>
</div>
<ol class="children">
<li id="comment-591277" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-18T18:20:15+00:00">July 18, 2021 at 6:20 pm</time></a> </div>
<div class="comment-content">
<p>Good points.</p>
<p>Note that the first optimization applies no matter how you compute the union.</p>
</div>
<ol class="children">
<li id="comment-591425" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-19T21:51:11+00:00">July 19, 2021 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>I have actually implemented it (see GitHub).</p>
<p>Sadly it is an optimization that will be made useless when bound checks are present (I expect).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-591286" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-07-18T20:02:26+00:00">July 18, 2021 at 8:02 pm</time></a> </div>
<div class="comment-content">
<p>The galloping mode of Timsort comes to my mind. It can reduce the number of comparisons. The problem might be slightly different however (union vs union all).</p>
</div>
</li>
<li id="comment-594138" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cc43ef934e4a5fb35afc4b64aeb74ee3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">alecco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-10T03:31:47+00:00">August 10, 2021 at 3:31 am</time></a> </div>
<div class="comment-content">
<p>There are vectorized merges, see “Efficient Implementation of Sorting on Multi-Core SIMD CPU Architecture” Intel (2010), 4.2.3 Merging Two Sorted Lists</p>
</div>
</li>
</ol>
