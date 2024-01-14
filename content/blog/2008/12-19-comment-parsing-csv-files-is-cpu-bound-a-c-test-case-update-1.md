---
date: "2008-12-19 12:00:00"
title: "Parsing CSV files is CPU bound: a C++ test case (Update 1)"
index: false
---

[6 thoughts on &ldquo;Parsing CSV files is CPU bound: a C++ test case (Update 1)&rdquo;](/lemire/blog/2008/12-19-parsing-csv-files-is-cpu-bound-a-c-test-case-update-1)

<ol class="comment-list">
<li id="comment-50360" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-19T22:59:23+00:00">December 19, 2008 at 10:59 pm</time></a> </div>
<div class="comment-content">
<p><i>You&rsquo;re still doing two heap allocations (one for string object, one for actually char buffer) </i></p>
<p>No. I do not. Here is the code:</p>
<p><code><br/>
c.resize(fieldlength);<br/>
c.assign(str,lastPos, fieldlength);<br/>
</code></p>
<p><i>Also vector resizing is slow (O(n)).</i></p>
<p>No, absolutely not. Vector resize is amortized O(1).</p>
<p><i>Let me throw around a few numbers: lzop compression is 150MB/s</i></p>
<p>I think not. More like 40 MB/s.</p>
<p><code>$ time lzop -p ./netflix.csv </p>
<p>real 0m50.057s<br/>
user 0m22.245s<br/>
sys 0m4.338s<br/>
</code></p>
<p><i>Try harder.</i></p>
<p>Care to provide actual code? Or provide a patch for my code?</p>
</div>
</li>
<li id="comment-50359" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">vicaya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-19T19:06:08+00:00">December 19, 2008 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>But &ldquo;despite these changes&rdquo; is only one minor change to reduce one string alloc/copy per field. You&rsquo;re still doing two heap allocations (one for string object, one for actually char buffer) and one copy *per field*, which is a far cry from the amortized 1 alloc + copy *per file* goal. Every heap allocation involves a mutex lock/unlock, which is expensive even without contention. Also vector resizing is slow (O(n) and need to reconstruct all string elements. So depending on number of strings in the vector you doing 2 heap allocations and a copy for every element multiple times during a run.</p>
<p>2GB file in 26.55s is 75MB/s, which is about right for top speed of sequential read on a single modern hard-drive not doing anything else (otherwise it&rsquo;ll slow down dramatically.) 2GB in 96s, which is about 21MB/s, is very slow for parsing. Let me throw around a few numbers: lzop compression is 150MB/s, decompression can exceed 500MB on a 2.6Ghz C2D processor (see benchmarks on <a href="http://www.quicklz.com/" rel="nofollow ugc">http://www.quicklz.com/</a>).</p>
<p>I&rsquo;ve written an indexer (including html parsing, word-breaking and constructing small in memory inverted index (the in memory indices indeed needs to small enough to fit in to the L2 cache otherwise speed drops down dramatically) that has a throughput near 100MB/s.</p>
<p>Try harder.</p>
</div>
</li>
<li id="comment-50362" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-20T00:34:21+00:00">December 20, 2008 at 12:34 am</time></a> </div>
<div class="comment-content">
<p><i>try to compress something completely fit into memory multiple times and make sure it doesn&rsquo;t write to disk (pipe to /dev/null)</i></p>
<p>I gained two seconds:</p>
<p><code><br/>
$ time lzop -c ./netflix.csv > /dev/null</p>
<p>real 0m47.757s<br/>
user 0m22.230s<br/>
sys 0m2.577s<br/>
</code></p>
<p><i> vector resize is definitely not amortized O(1) more like O(log n) (because every time it resizes, if the storage is not enough, the storage is doubled) (What I meant by O(n) is that when the storage is not enough the resize operation is O(n): you need to allocate new storage and copy construct all the elements on new storage and delete the old storage. You have to do that O(log n) times.)<br/>
</i></p>
<p>What is large is the number of rows. Not the field size. But let us say that n is the size of a field. Ok, but n is no larger than 16. So, ok, log n = 4. Four (4) is a fixed number. I have millions of rows. If you amortize 4 over millions of row it no longer matters. </p>
<p><i>Change your vector to deque should make your program a lot faster even w/o custom allocator, which is required for the next speed up.</i></p>
<p>I do not see why this would be true. The vector contains 4 strings. It is hard to beat a simple vector when you are storing only 4 strings.</p>
<p><i>Make sure you compile your code with -O3 if you&rsquo;re using g++</i></p>
<p>-O3 makes things slower.</p>
</div>
</li>
<li id="comment-50361" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vicaya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-20T00:06:42+00:00">December 20, 2008 at 12:06 am</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the size of the physical RAM on your box? your lzop number is certainly bound by your I/O speed. Try to compress something completely fit into memory multiple times and make sure it doesn&rsquo;t write to disk (pipe to /dev/null)</p>
<p>vector resize is definitely not amortized O(1) more like O(log n) (because every time it resizes, if the storage is not enough, the storage is doubled) (What I meant by O(n) is that when the storage is not enough the resize operation is O(n): you need to allocate new storage and copy construct all the elements on new storage and delete the old storage. You have to do that O(log n) times.)</p>
<p>Change your vector to deque should make your program a lot faster even w/o custom allocator, which is required for the next speed up.</p>
<p>Make sure you compile your code with -O3 if you&rsquo;re using g++</p>
</div>
</li>
<li id="comment-50363" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/715a901acf9741ff522d91f17694df3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vicaya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-20T01:31:36+00:00">December 20, 2008 at 1:31 am</time></a> </div>
<div class="comment-content">
<p>Sorry, I misread your code. I thought you put all the fields in the vector instead of just doing a simple split 🙂 Your code should be a lot faster than 20MB/s on modern hardware.</p>
<p>Can you post your platform specs? uname -a, gcc -v? CPU?</p>
<p>Your numbers just don&rsquo;t jive with my experience. Your own code runs faster with -O3 on a 2 year old Macbook Pro:</p>
<p>$ ./po2 largeuni.csv<br/>
without parsing: 0.107499<br/>
with parsing: 0.256668</p>
<p>$ ./po3 largeuni.csv<br/>
without parsing: 0.103201<br/>
with parsing: 0.245105</p>
<p>If you want to get to the bottom of it can generate a small set of CSV data (say 10MB, enough for testing parsing speed) that everyone can verify, I&rsquo;ll take stab on the code.</p>
</div>
</li>
<li id="comment-50365" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-20T12:23:39+00:00">December 20, 2008 at 12:23 pm</time></a> </div>
<div class="comment-content">
<p><i>Can you post your platform specs? uname -a, gcc -v? CPU?</i></p>
<p>I use a standard Mac Pro desktop. The specs are described in this recent paper:</p>
<p>* Owen Kaser, Daniel Lemire, Kamel Aouiche, Histogram-Aware Sorting for Enhanced Word-Aligned Compression in Bitmap Indexes, DOLAP 2008, 2008.<br/>
<a href="http://arxiv.org/abs/0808.2083" rel="nofollow ugc">http://arxiv.org/abs/0808.2083</a></p>
<p><i>If you want to get to the bottom of it can generate a small set of CSV data (say 10MB, enough for testing parsing speed) that everyone can verify, I&rsquo;ll take stab on the code.</i></p>
<p>Just generate any large CSV file. If you use something &ldquo;typical&rdquo; (small fields, about 4 of them, and lots of rows), it should not matter which file you use exactly.</p>
</div>
</li>
</ol>
