---
date: "2012-02-17 12:00:00"
title: "Bitmaps are surprisingly efficient"
index: false
---

[12 thoughts on &ldquo;Bitmaps are surprisingly efficient&rdquo;](/lemire/blog/2012/02-17-bitmaps-are-surprisingly-efficient)

<ol class="comment-list">
<li id="comment-54981" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/937655a75eb3f0fd943151f4e5ab5167?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/937655a75eb3f0fd943151f4e5ab5167?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://iproc.ru" class="url" rel="ugc external nofollow">Anton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-18T01:43:39+00:00">February 18, 2012 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>May be, instead of branching, the following formula will be more efficient:</p>
<p>newVal = oldVal * (1-maskBit) + updatedVal*maskBit</p>
<p>?</p>
</div>
</li>
<li id="comment-54982" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65e38bd07eafdb9f6e65129a05a21bf7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65e38bd07eafdb9f6e65129a05a21bf7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Luc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-18T05:15:15+00:00">February 18, 2012 at 5:15 am</time></a> </div>
<div class="comment-content">
<p>Actually, it&rsquo;s not bitmap that are fast. It&rsquo;s the algorithm: it seems it&rsquo;s faster to update while copying instead of doing it afterwards, random accessing again the (big) data. Locality of reference does matter.</p>
<p>If exceptionpos is sorted, i believe it would be even faster to compare to *pos. You would then save all these bit operations for a simple integer comparison. This way, bitmap is just another implementation for looking up inside the copy loop if the value is to be changed.</p>
</div>
</li>
<li id="comment-54985" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-20T08:55:25+00:00">February 20, 2012 at 8:55 am</time></a> </div>
<div class="comment-content">
<p>@Anton</p>
<p>This is clever, but it won&rsquo;t quite work in the context I have described because we want to increment the pointer to the updated value if and only if we use it. </p>
<p>What you describe would work if we had two same-length vectors. (And yes, it could be slightly faster to replace branching by multiplications. Branching is really bad on many processors.)</p>
</div>
</li>
<li id="comment-54986" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-20T09:28:10+00:00">February 20, 2012 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>@Luc</p>
<p>I do invite you to provide a faster alternative. I find it difficult to beat the bitmap over the whole range of patching densities. There is always some overhead.</p>
</div>
</li>
<li id="comment-55000" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76e1000042dc56f4b172f1e558676f61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76e1000042dc56f4b172f1e558676f61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zokier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-23T09:50:56+00:00">February 23, 2012 at 9:50 am</time></a> </div>
<div class="comment-content">
<p>Have you considered std::vector instead of raw bitmap?</p>
</div>
</li>
<li id="comment-55001" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-23T09:59:48+00:00">February 23, 2012 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>@zokier</p>
<p>You mean std::vector? The underlying implementation is probably close to what I offer here.</p>
</div>
</li>
<li id="comment-55005" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15fecd2883a354131966387d5a8ddce4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15fecd2883a354131966387d5a8ddce4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Trenkmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-26T17:36:57+00:00">February 26, 2012 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel.</p>
<p>Interesting problem. I tried hard to beat the bitmap solution, but finally I had to surrender.</p>
<p>However, I found some errors in your original code: (<em>Note by D. Lemire: these errors were corrected and my benchmark updated</em>)<br/>
1. In line 163, where you set the bits of your bitmap, the AND operation is not correct, it has to be an OR operation. Thus in your bitmapcopy functions there is no update operation at all.<br/>
2. Also in both bitmapcopy functions there is an off-by-one error with the index i.</p>
<p>I corrected the errors, made my own copy versions, and ran some performance tests. You find the updated version of the code under <a href="http://pastebin.com/qQy88c8V" rel="nofollow ugc">http://pastebin.com/qQy88c8V</a><br/>
(Please click the RAW button at the top to see the unwrapped result tables at the end of the listing. The columns contain pairs of milliseconds and number of update operations)</p>
<p>Furthermore, I think the overall coding style is not the best and very error-prone. In C++ one should prefer iterators over raw pointers. I personally decided to use operator[] for accessing the vectors, because your problem setup uses index values. I tested a lot and I found no performance differences in using pointers, iterators or operator[]. Indeed, for the compiler all these operations are equivalent.<br/>
A second issue are the underscored qualifiers __attribute__ and __restrict__ in your code. These are compiler extension and shall be ommitted. The compiler knows best how to optimize. See also N3242 Â§17.2(2) of the C++ ISO standard.</p>
<p>OK, let&rsquo;s come to my implementations:</p>
<p>memcopy: Nothing to say here. Copying a chunk of memory without any modifications is faster than copying element-wise using a loop.</p>
<p>updatingcopy: The simplest solution for the given problem with just clean syntax. It outperforms the patchedcopy versions and do not use raw pointer arithmetics.</p>
<p>updatingcopy2: Here I tried to group an index value together with its update value in a pair to take advantage of locality. However, the effect is negligible.</p>
<p>updatingcopy3: Here I tried to avoid branching and made the iteration over the vector with the (index, update value)-pairs an outer loop. I suppose this is the same approach as in patchedcopy2, except that my version is human-readable.</p>
<p>Conclusion: The bitmapcopy versions are not to beat for high densities only. At the other hand the resulting code is more error-prone and hard to read. I showed that just clean and simple code gives comparable performance results, at least for low densities. When trying to optimize do not hack your compiler, especially for C++ use its type system as much as possible and avoid ugly C-style casts. What helps is locality of data to minimize cache misses. Bitmaps are an good example for this, definition of variables as close as possible to their usage is another one. Finally, maintainability of code really matters.</p>
<p>Have fun!</p>
</div>
</li>
<li id="comment-55008" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-27T14:28:47+00:00">February 27, 2012 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>@Martin</p>
<p>Thanks Martin! I really appreciate the bug report and I fixed my code. </p>
<p>Note that memcpy is *not* more efficient that loop copy using my compiler and my CPU.</p>
<p>You are using an older GCC (4.4). Have you tried it with a recent GCC (4.6.2)? In my tests, this makes a huge difference. </p>
<p>You are also using an inferior processor. My i7 has probably better pipelining than your Core 2.</p>
<p>Anyhow, here are my results with your code:</p>
<p><code><br/>
g++-4 -Ofast -o bitmaptrenkmann bitmaptrenkmann.cpp<br/>
density(%) memcopy loopcopy bitmapcopy bitmapcopy8bits patchedcopy patchedcopy2 updatingcopy updatingcopy2 updatingcopy3<br/>
100 25 25 43 0 26 0 65 32000000 59 32000000 49 32000000 42 32000000 48 32000000<br/>
16.6667 25 25 50 0 25 0 47 5333334 50 5333334 45 5333334 37 5333334 39 5333334<br/>
9.09091 29 30 48 0 26 0 43 2909091 40 2909091 38 2909091 31 2909091 30 2909091<br/>
6.25 25 25 47 0 26 0 41 2000000 40 2000000 40 2000000 31 2000000 30 2000000<br/>
4.7619 25 24 46 0 26 0 39 1523810 40 1523810 39 1523810 29 1523810 29 1523810<br/>
3.84615 26 25 44 0 27 0 39 1230770 37 1230770 38 1230770 28 1230770 28 1230770<br/>
3.22581 27 25 47 0 25 0 37 1032259 40 1032259 36 1032259 29 1032259 28 1032259<br/>
2.77778 26 25 43 0 26 0 36 888889 42 888889 40 888889 28 888889 34 888889<br/>
2.43902 27 25 46 0 25 0 35 780488 44 780488 42 780488 32 780488 34 780488<br/>
2.17391 25 24 46 0 26 0 34 695653 44 695653 40 695653 32 695653 33 695653<br/>
</code></p>
<p>Summary: Basically, using your code I get the same performance and thus the same conclusion. I agree that using STL is nicer and better (I&rsquo;m a big fan of STL) than using pointer arithmetic, especially when you get the same performance!</p>
</div>
</li>
<li id="comment-55009" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-27T17:55:56+00:00">February 27, 2012 at 5:55 pm</time></a> </div>
<div class="comment-content">
<p>Haaaah, cool!</p>
<p>We are actually using (sparse)-bitmaps in our search engine for boolean queries. They work pretty well.</p>
</div>
</li>
<li id="comment-55010" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-02-27T18:20:44+00:00">February 27, 2012 at 6:20 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>Doing the same type of micro-benchmarks with sparse bitmaps could be interesting.</p>
</div>
</li>
<li id="comment-55161" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7937f987515280d07289e7ca042a1cd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7937f987515280d07289e7ca042a1cd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-07T06:50:55+00:00">April 7, 2012 at 6:50 am</time></a> </div>
<div class="comment-content">
<p>are you sure you have a macbook air with an i7? did apple give you a not-yet-to-the-public-released mba? 😉</p>
</div>
</li>
<li id="comment-55164" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-07T16:33:19+00:00">April 7, 2012 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>@Thomas</p>
<p>Absolutely. MacBook Airs come with a core i5 or core i7 intel processor:</p>
<p><a href="http://store.apple.com/ca/configure/MC966LL/A" rel="nofollow ugc">http://store.apple.com/ca/configure/MC966LL/A</a></p>
<p>In fact, it is not possible (at least in Canada) to buy them with anything less than a core i5 processor.</p>
</div>
</li>
</ol>
