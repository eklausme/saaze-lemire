---
date: "2022-10-11 12:00:00"
title: "The number of comparisons needed to sort a shuffled array: qsort  versus std::sort"
index: false
---

[2 thoughts on &ldquo;The number of comparisons needed to sort a shuffled array: qsort versus std::sort&rdquo;](/lemire/blog/2022/10-11-the-number-of-comparisons-needed-to-sort-a-shuffled-array-qsort-versus-stdsort)

<ol class="comment-list">
<li id="comment-646405" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4610b92810b55bfee0be46cc2c11586?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jeffrey W. Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-11T21:26:21+00:00">October 11, 2022 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>For whatever it&rsquo;s worth, I get the same numbers you get from GCC 9 when using LLVM 15 and 14 on x86-64 Linux, with either GNU libstdc++ or LLVM libc++.</p>
</div>
</li>
<li id="comment-646408" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-12T00:07:54+00:00">October 12, 2022 at 12:07 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s very interesting. The example code uses pseudorandom doubles for input, so the input is in random order and duplicates are vanishingly unlikely.</p>
<p>The two obvious suspects are:</p>
<p>1) The <code>std::sort</code> template code is inline expanded with specialized compare and swap operations. In return for this optimization opportunity, the code might have to use a more concise algorithm than the out-of-line <code>qsort()</code>. In particular, median-of-medians pivot choosing code can be voluminous and might be omitted from a template implementation.</p>
<p>2) There is a semantic difference: <code>std::sort</code> takes a two-way &ldquo;&lt;&quot; predicate, while <code>qsort()</code> takes a three-way &ldquo;&rdquo; comparison operator. There might be some extra comparisons in <code>std::sort</code> to detect duplicate values, which can cause asymmetric pivot problems in quicksort.</p>
</div>
</li>
</ol>
