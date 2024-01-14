---
date: "2023-10-23 12:00:00"
title: "Appending to an std::string character-by-character: how does the capacity grow?"
index: false
---

[10 thoughts on &ldquo;Appending to an std::string character-by-character: how does the capacity grow?&rdquo;](/lemire/blog/2023/10-23-appending-to-an-stdstring-character-by-character-how-does-the-capacity-grow)

<ol class="comment-list">
<li id="comment-655676" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e7221266fe4d47a2d8988a12953557be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e7221266fe4d47a2d8988a12953557be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://tastycode.dev" class="url" rel="ugc external nofollow">Oleksandr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-23T17:47:00+00:00">October 23, 2023 at 5:47 pm</time></a> </div>
<div class="comment-content">
<p>In MSVC, the capacity growths as 1.5x (unlike 2x in GCC or LLVM). This is a feature of the C++ Standard Library, not a compiler itself. Just curious if such an exponential growth policy is part of the standard or just a widely-accepted convention.</p>
<p>You can read more in my article on the memory layout of std::string: <a href="https://tastycode.dev/blog/tasty-cpp-memory-layout-of-std-string" rel="nofollow ugc">https://tastycode.dev/blog/tasty-cpp-memory-layout-of-std-string</a></p>
</div>
<ol class="children">
<li id="comment-655687" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Arseny Kapoulkine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-24T03:37:31+00:00">October 24, 2023 at 3:37 am</time></a> </div>
<div class="comment-content">
<p>I believe the standard doesn&rsquo;t guarantee any particular behavior; methods of string generally don&rsquo;t seem to specify complexity, even for push_back: <a href="https://cplusplus.com/reference/string/string/push_back/" rel="nofollow ugc">https://cplusplus.com/reference/string/string/push_back/</a> (&ldquo;generally amortized constant&rdquo; suggests exponential growth but &ldquo;generally&rdquo; also says it&rsquo;s not mandatory :D)</p>
<p>FWIW conventional wisdom also says 1.5x is better than 2x because 2x growth allows no opportunity to reuse memory during reallocation, whereas 1.5x allows the peak memory consumption to be lower as subsequent reallocations can take the space of earlier smaller sizes under the right set of circumstances.</p>
</div>
<ol class="children">
<li id="comment-655692" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1eb0edba17d1d2900c1d6e145f809669?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1eb0edba17d1d2900c1d6e145f809669?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-24T05:39:03+00:00">October 24, 2023 at 5:39 am</time></a> </div>
<div class="comment-content">
<p>I seem to remember reading somewhere once that any exponential growth less than the golden ratio (1.6180339…) has good reallocation properties. Does that sound right?</p>
</div>
<ol class="children">
<li id="comment-655708" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-25T02:33:01+00:00">October 25, 2023 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>Yeah I believe that&rsquo;s correct. In practice 1.5x is great because not only does it avoid the risk of small over-allocation due to allocator padding going right over the limit implied by the golden ratio, but it also makes the size adjustments cheap to compute (which is a little relevant for small reallocations with a fast allocator).</p>
<p>Maybe a final note is that one thing that most/all standard STL implementations get &ldquo;wrong&rdquo; is that they use the naive exponential formula that results in a very slow start: eg with 1.5x you get 1 =&gt; 2 =&gt; 3 =&gt; 4 =&gt; 6 =&gt; 9 =&gt; 13. This is not a big problem for strings as all implementations now use a short string optimization so the capacity starts from 16-24 and grows from there, but for std::vector (or maybe strings in languages that aren&rsquo;t C++ and don&rsquo;t use short string optimization like Rust?) you&rsquo;ll probably want to change the curve in the beginning to be more aggressive, for example start with a small number of elements to fill a cacheline or so, or use 2x growth factor until 100-odd elements and then switch to 1.5x. This problem also goes away if the user code carefully reserves the container space, which would be a little helpful in the benchmark in this article as well.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655723" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-25T10:31:39+00:00">October 25, 2023 at 10:31 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
FWIW conventional wisdom also says 1.5x is better than 2x because 2x growth allows no opportunity to reuse memory during reallocation
</p></blockquote>
<p>Isn&rsquo;t that only true for very specific reallocation circumstances like the used allocator model, whether the reallocation can avoid the content move (then a higher factor is slightly better needing less reallocs) or if the allocator allows partial reusage of still held segments during realloc-moves? The latter is kinda mandatory to get to the &ldquo;Golden Ratio&rdquo; rule, without it you&rsquo;ll always run short on older coalesced segments.</p>
<p>Maybe the fact that some compilers stick with 2 here indicates, that the std allocators are not that well prepared to benefit from that.</p>
</div>
<ol class="children">
<li id="comment-655763" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-26T20:25:05+00:00">October 26, 2023 at 8:25 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
allocator allows partial reusage of still held segments during realloc-moves
</p></blockquote>
<p>Note that C++ STL never uses realloc &#8211; all reallocations by all containers are using the new..delete interface, so they explicitly allocate a new segment, explicitly copy data into it and then free the old one. (which is unfortunate in certain circumstances of course)</p>
<blockquote><p>
The latter is kinda mandatory to get to the “Golden Ratio” rule, without it you’ll always run short on older coalesced segments.
</p></blockquote>
<p>I don&rsquo;t think that&rsquo;s true. With a naive first-fit allocation model and an allocator that immediately coalesces blocks with neighbors on free, with 1.5X growth you get the requests of progressively larger size but the sum of freed blocks grows faster than the new request, so pretty quickly a new request starts to fit into the gap in the beginning. With 1.7X growth this no longer happens, so you always have less memory in front of your current block than your next block is, so the blocks only ever move forward in memory.</p>
<p>Here&rsquo;s a simple Python program that simulates this:</p>
<p><code># container implementation details: we assume that the growth is exponential<br/>
# and that short string buffer handles strings of smaller size<br/>
ratio = 1.5<br/>
block = 16</p>
<p># allocator implementation details: we assume that we're using first fit allocator<br/>
# that magically stores block metadata externally and has no alignment restrictions<br/>
# for simplicity we just keep track of a single live allocation<br/>
allocoffset = 0<br/>
allocsize = 0</p>
<p>for i in range(20):<br/>
block = int(block * ratio)<br/>
if allocoffset &gt;= block:<br/>
print(f"round {i}: allocated range [{allocoffset}..{allocoffset+allocsize}), allocating {block} from the beginning")<br/>
allocoffset = 0<br/>
allocsize = block<br/>
else:<br/>
print(f"round {i}: allocated range [{allocoffset}..{allocoffset+allocsize}), allocating {block} by advancing range")<br/>
allocoffset += allocsize<br/>
allocsize = block<br/>
</code></p>
<p>If you run it with ratio 1.7 you&rsquo;ll see that the new allocation can never fit into the space left by freeing the previous allocations, whereas with ratios smaller than golden ratio such as 1.6 and 1.5 we periodically are able to fit the allocation into the beginning &#8211; this reduces peak memory consumption in a series of allocations. Of course the practical implications will depend on the details of allocator behavior and may not match the simple model.</p>
</div>
<ol class="children">
<li id="comment-655764" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-26T20:25:55+00:00">October 26, 2023 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>The same source posted in Gist to preserve indentation: <a href="https://gist.github.com/zeux/44dd37660e426d4c28a8f004a25c1605" rel="nofollow ugc">https://gist.github.com/zeux/44dd37660e426d4c28a8f004a25c1605</a></p>
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
<li id="comment-655810" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ac00d0ea3d55ec96355aef17217daa41?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ac00d0ea3d55ec96355aef17217daa41?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://wbk.one" class="url" rel="ugc external nofollow">Woongbin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-29T00:41:44+00:00">October 29, 2023 at 12:41 am</time></a> </div>
<div class="comment-content">
<p>I think something interesting to cover would be what the worst case looks like in those cases as well (is it nanoseconds, microseconds, or more?). In some applications like video games, I can imagine having a bad worst case performance could be problematic.</p>
</div>
</li>
<li id="comment-656330" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-25T09:03:10+00:00">November 25, 2023 at 9:03 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s interesting to read this because I independently arrived at a &ldquo;50%&rdquo; technique in my own buffer module here:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/buf.c#L33" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/buf.c#L33</a></p>
<p>Only difference is that I double the size up to a point, and thereafter increase it by 50%.</p>
<p>I suppose I could use 50% every time, but I preferred going from 64 bytes to 128 bytes on the first growth, instead of 96 bytes. So I kept the doubling up to a point, which I set at 2^20 bytes.</p>
</div>
</li>
<li id="comment-656990" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-15T23:20:43+00:00">December 15, 2023 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>What would often be optimal, and is not usually done, would be to allocate (a^n &#8211; b), for some base (a) maybe 1.5, (n) increasing incrementally, and (b) a property of the allocator related to the size of the header the allocator reserves for housekeeping.</p>
</div>
</li>
</ol>
