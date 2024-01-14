---
date: "2019-12-19 12:00:00"
title: "Xor Filters: Faster and Smaller Than Bloom Filters"
index: false
---

[45 thoughts on &ldquo;Xor Filters: Faster and Smaller Than Bloom Filters&rdquo;](/lemire/blog/2019/12-19-xor-filters-faster-and-smaller-than-bloom-filters)

<ol class="comment-list">
<li id="comment-472474" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58750f2179edbd650b471280aa66fee5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58750f2179edbd650b471280aa66fee5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://maxdemarzi.com" class="url" rel="ugc external nofollow">Max De Marzi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T00:05:26+00:00">December 20, 2019 at 12:05 am</time></a> </div>
<div class="comment-content">
<p>You had me all way until immutable. I used a cuckoo filter to speed up checking for existing relationships a while back on <a href="https://maxdemarzi.com/2017/07/13/using-a-cuckoo-filter-for-unique-relationships/" rel="nofollow ugc">https://maxdemarzi.com/2017/07/13/using-a-cuckoo-filter-for-unique-relationships/</a></p>
</div>
<ol class="children">
<li id="comment-472528" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T00:36:20+00:00">December 20, 2019 at 12:36 am</time></a> </div>
<div class="comment-content">
<p>Deletions and additions may fail in a Cuckoo filter. Deletions may fail in general and additions will fail probabilistically if you get close to the capacity (say greater than 94%). If you are using it in a dynamic setting, you need a fallback (possibly a reconstruction) and you need tests. This can be abstracted away, but it requires some engineering. And, of course, if the data structure is dynamic, you need concurrency, possibly via locking. That cannot be safely omitted.</p>
</div>
<ol class="children">
<li id="comment-472786" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bdfa99e9ab32391b1ab41fa7c474540?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bdfa99e9ab32391b1ab41fa7c474540?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Andersen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T03:39:07+00:00">December 20, 2019 at 3:39 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m confused Deletions work if you know the item is in the set. It&rsquo;s not safe to delete without that surety, of course.</p>
<p>(Not in response to thread): Cool stuff! Be quite wished there was a practical implementation of Bloomier filters when designing our setsep data structures. It would be fun to see if xor filters could be extended to that setting.</p>
</div>
<ol class="children">
<li id="comment-474426" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://h2database.com" class="url" rel="ugc external nofollow">Thomas Müller Graf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T21:47:02+00:00">December 20, 2019 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>Sure, xor filter could be used for this: as in the Bloomier filter, you need a second (external) array which is mutable. Then, 2 bits of each xor filter table entry are used to compute the index within that second array (as in the BDZ MPHF). It would be good to better understand the exact use case&#8230;</p>
<p>The xor filter currently only stores fingerprints. But other data can be stored as well. In the &ldquo;known password database&rdquo; use case, you could reserve one bit per entry to say if it&rsquo;s a very common password or not.</p>
</div>
</li>
</ol>
</li>
<li id="comment-473143" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T07:06:52+00:00">December 20, 2019 at 7:06 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Deletions may fail in general
</p></blockquote>
<p>Which way?<br/>
Cuckoo filter even could contain dublicate (small amount of).<br/>
Therefore, if you delete element that certainly were in a cuckoo filter, then deletion will not fail.</p>
</div>
</li>
<li id="comment-473713" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8701b2f3116d0fd140455dc04572de3b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8701b2f3116d0fd140455dc04572de3b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Damien Carol</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T14:02:26+00:00">December 20, 2019 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>It is not a pb for data structure of file format like ORC (<a href="https://orc.apache.org/" rel="nofollow ugc">https://orc.apache.org/</a> ) which are generated and can&rsquo;t be modified.</p>
</div>
</li>
<li id="comment-477315" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-23T16:52:26+00:00">December 23, 2019 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>@David and @Yura</p>
<p>If you know what has been added and what has been removed from the set, then you can delete from the cuckoo filter. But the cuckoo filter does not give you this information. You have to keep track of it. In effect, you must have access, somehow, to the true content of the set. And, of course, if you delete content, you don&rsquo;t recover the memory until you rebuild the filter.</p>
</div>
<ol class="children">
<li id="comment-477316" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-23T16:55:26+00:00">December 23, 2019 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>Note that it is an issue with <em>all</em> probabilistic filters. Deletions somehow requires you to keep track of what is in the set, but the filter cannot do that. You need to have this information some other way.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-473275" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d9cf7d9fe6ecfe317dce44b5cc5b710b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d9cf7d9fe6ecfe317dce44b5cc5b710b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maciej Bilas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T09:02:18+00:00">December 20, 2019 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Immutability is fine, however the Go implementation forces the consumer to have <code>len(keys) * 8</code> bytes memory available to create the filter.</p>
<p><code>func Populate(keys []uint64) *Xor8<br/>
</code></p>
<p>Something like:</p>
<p><code>func FromIterator(next func() uint64, size int) *Xor8<br/>
</code></p>
<p>might make sense as well.</p>
</div>
<ol class="children">
<li id="comment-473670" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T13:22:13+00:00">December 20, 2019 at 1:22 pm</time></a> </div>
<div class="comment-content">
<p>@Maciej</p>
<p>If you cannot afford 8 bytes per entry, then you are not going to be able to build the filter&#8230;</p>
<p>(Update: once constructed, the filter will use very little memory. It is only during construction that you need several bytes per entry.)</p>
</div>
<ol class="children">
<li id="comment-473738" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07f292a44e931f9021a7f2924c4d3a0c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07f292a44e931f9021a7f2924c4d3a0c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ryan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T14:18:25+00:00">December 20, 2019 at 2:18 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Though this hash table approach might be practical, you could end up using 4 bytes per value. Maybe this is too much?
</p></blockquote>
<p>If this is true, how is 8 per entry better?</p>
</div>
<ol class="children">
<li id="comment-473742" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T14:24:02+00:00">December 20, 2019 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p>A filter (once constructed) use about 8 bits per entry, not 8 bytes.</p>
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
<li id="comment-472938" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/679025744d16bd0b7218d7af37b32c16?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/679025744d16bd0b7218d7af37b32c16?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justin Chu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T05:22:17+00:00">December 20, 2019 at 5:22 am</time></a> </div>
<div class="comment-content">
<p>How big is the memory overhead during filter construction. I couldn&rsquo;t get a good idea of it with my limited skim of the paper.</p>
</div>
<ol class="children">
<li id="comment-473675" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T13:23:15+00:00">December 20, 2019 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>The memory overhead during construction is implementation dependent. It takes several bytes per entry. Maybe as high as 64 bytes per entry.</p>
</div>
</li>
</ol>
</li>
<li id="comment-473580" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T12:27:37+00:00">December 20, 2019 at 12:27 pm</time></a> </div>
<div class="comment-content">
<p>Whoa, quite interesting algorithm.</p>
</div>
<ol class="children">
<li id="comment-473658" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T13:21:13+00:00">December 20, 2019 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>Couple of questions: what are FPP for &ldquo;two segment&rdquo; filter instead of &ldquo;three segment&rdquo;? I suppose, it will take more time to build though, because successful run of &ldquo;algorithm 3&rdquo; is less possible. code will be simplier if it follow alhorithm, ie without explicit queue segmentation. Is it runs significantly faster with queue segmentation? Thank you for attention.</p>
</div>
<ol class="children">
<li id="comment-473683" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T13:25:57+00:00">December 20, 2019 at 1:25 pm</time></a> </div>
<div class="comment-content">
<p>The FPP is significantly worse if you use only two segments. I don&rsquo;t know the formula (though it is easy to find) but it is not practical.</p>
<p>There are many strategies that one can use to build the filter, and yes, there is a lot of room for optimization.</p>
</div>
<ol class="children">
<li id="comment-473753" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T14:32:42+00:00">December 20, 2019 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>I could suggest &ldquo;two segment &#8211; quad place&rdquo; scheme:</p>
<p><code>side := hash&amp;1<br/>
h1 := reduce(hash&gt;&gt;1, blocklength)<br/>
h2 := h1 + 1 + side<br/>
if h2 &gt; blocklength { h2-=blocklength }<br/>
h3 := reduce(hash&gt;&gt;33, blocklength)<br/>
h4 := h3 + (2 - side)<br/>
if h4 &gt; blocklentgh {h4-=blocklength}<br/>
h3 += blocklength<br/>
h4 += blocklength<br/>
</code></p>
<p>When I&rsquo;ve played with Cuckoo hashes such 2&#215;2 construction gave quite comparable result with 3&#215;1 (in terms of &ldquo;average achievable load factor&rdquo;), and most of time it takes only two memory fetches (in terms of cache lines).</p>
<p>And since here will be for places, FPP should be higher. (But fingerprint should be tacken from other bits to be independent from h1 and h3).</p>
</div>
<ol class="children">
<li id="comment-474356" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T21:09:39+00:00">December 20, 2019 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>Nope. I&rsquo;ve achieved only 1.35 oversize, that quite larger than 1.23 🙁</p>
<p>Other interesting thing: FPP is close to 0.37-0.4 for any Xor8: either 2 points, or 3 points, or 4 points. Looks like it is always 1/2^k = 1/256 . Oops, yeah it should be not less than it&#8230; shame on me.</p>
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
<li id="comment-473760" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3136128128d5e480d95bea51bb32d89b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3136128128d5e480d95bea51bb32d89b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Allen Downey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T14:38:20+00:00">December 20, 2019 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>Very nice!</p>
<p>One small typo: &ldquo;fall positive&rdquo;</p>
</div>
</li>
<li id="comment-473899" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/87f694cbc37ac401c24659e80af640cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/87f694cbc37ac401c24659e80af640cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Laurent Querel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T16:59:41+00:00">December 20, 2019 at 4:59 pm</time></a> </div>
<div class="comment-content">
<p>How XOR filters compare with Golomb-coded sets in term of memory usage and query speed?</p>
</div>
</li>
<li id="comment-473922" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-20T17:28:07+00:00">December 20, 2019 at 5:28 pm</time></a> </div>
<div class="comment-content">
<p>Please see Table 3 in the paper. Xor filters are much faster. The memory usage is not better with GCS.</p>
</div>
</li>
<li id="comment-475578" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/365175c40356861c03385615db1adfdd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/365175c40356861c03385615db1adfdd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Rehwinkel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-21T05:19:56+00:00">December 21, 2019 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>Very nice algorithm &#8211; so short and it makes the inspired parts easy to find. Very cool how it starts by finding at least one item that doesn&rsquo;t have an unencumbered set cell, and then peels that item out, hopefully unencumbering cells in other sets, until with a little luck, they can all be pulled out. And then they are finalized in reverse order because that guarantees they each have an unencumbered hash location that can take on any values of xor necessary when its their turn to store a fingerprint.</p>
<p>I haven&rsquo;t run a lot of simulations yet but I was surprised that each random set I tried was solved with the very first seed that was tried. The code is there to keep trying with more seeds but I wonder what it would take for that to be necessary. If there were a need to try many seeds &#8211; the algorithm could easily be modified to make the lengths slightly longer each time too. For that matter, for a list that was going to be preserved for a very long time, there could be a derivation that tries with successively shorter sets.</p>
<p>Maybe a comment in the code around the splitmix64 function that it has a period of 2^64 which is good since you don&rsquo;t want the hash to create duplicates &#8211; which the algorithm doesn&rsquo;t detect and doesn&rsquo;t solve.</p>
<p>Timings are very nice too. Just a few cycles for running Contains, regardless of the number of keys. And tens of cycles per key when building until the number of keys got to 10M at which point it was still just about 150ns per key. I could see rebuilding the filter very often when the cost is so low.</p>
<p>Thanks for providing a golang version. Made the algorithm very easy to follow.</p>
<p>It&rsquo;s also interesting that doubling the size of the fingerprint from a byte to a half word doesn&rsquo;t increase the number of items the set would hold &#8211; it just reduces the chance of a false positive from 1 in 256 to 1 in 64K.</p>
</div>
</li>
<li id="comment-475990" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0f81056c3f079d2a5e1bb08283238d4d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0f81056c3f079d2a5e1bb08283238d4d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jurniss</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-21T08:30:28+00:00">December 21, 2019 at 8:30 am</time></a> </div>
<div class="comment-content">
<p>In the third paragraph, the following sentence seems incomplete:</p>
<blockquote><p>
For example, what if you had a tiny data structure that could reliably tell you that either your password is not in the list of compromised password for sure?
</p></blockquote>
<p>It looks like you meant an &ldquo;either-or&rdquo; statement but only covered the case where none of the hash function bits are set. I guess it should be something like: &ldquo;&#8230; either <strong>your password might be in the list, or</strong> your password is not in the list&#8230;&rdquo;</p>
</div>
</li>
<li id="comment-476643" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">prataprc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-21T18:14:18+00:00">December 21, 2019 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>The golang version is quite concise and easy to port to rust-lang.<br/>
I am using croaring bitmap for my indexing library, which already<br/>
works well.</p>
<p>A quick comparison between xorfilter and croaring, on a MacBookPro,<br/>
gives 2-3 times CPU-performance improvement over croaring.</p>
<p>Ref: <a href="https://github.com/bnclabs/xorfilter" rel="nofollow ugc">https://github.com/bnclabs/xorfilter</a></p>
</div>
<ol class="children">
<li id="comment-478443" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/675168dc913798c0e8940f58649a18b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/675168dc913798c0e8940f58649a18b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://lelele.io" class="url" rel="ugc external nofollow">Polochon_street</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-26T14:12:48+00:00">December 26, 2019 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>Also did a rust port from the go version, and tried to do a bit more idiomatic &#8211; but you beat me to it 😀 <a href="https://github.com/Polochon-street/rustxorfilter" rel="nofollow ugc">https://github.com/Polochon-street/rustxorfilter</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-476766" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1d38d2c253bff15a500a6f7894d9c5e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1d38d2c253bff15a500a6f7894d9c5e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eelis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-21T23:18:17+00:00">December 21, 2019 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>In the paper, the membership test algorithm defined in section 3.1 evaluates h_0(x) given an x from U, but in the previous section, h_0 was defined as a function on S, which is only a subset of U. What am I overlooking? 🙂</p>
</div>
<ol class="children">
<li id="comment-477317" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-23T16:56:33+00:00">December 23, 2019 at 4:56 pm</time></a> </div>
<div class="comment-content">
<p>Good catch.</p>
</div>
</li>
</ol>
</li>
<li id="comment-477574" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/419b54e4b0c805f8ed671451ea536e19?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yura</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-26T02:02:26+00:00">December 26, 2019 at 2:02 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve found variant of Xor8+ algo that puts first two lookups in a single cache line. BitsPerValue is almost same as with original Xor8+ variant. (But for non-plus variant is larger since it requires 1.28x fingerprints vs 1.23x fingerprints)</p>
<p>Idea: put first two points into same cache line in a single segment, and third point in a second segment with rank9.</p>
<p>I&rsquo;ve tried &ldquo;2 equal segments&rdquo; and &ldquo;first segment is twice larger&rdquo; and &ldquo;equal segments&rdquo; looks to give lesser BitsPerValue.</p>
<p>Changes are demonstrated in Go variang (without actual Rank9 construction, just with statistic calculation): <a href="https://github.com/FastFilter/xorfilter/pull/11/commits/c7b541fe86297e75073e0d193173feb7a2dd5180" rel="nofollow ugc">https://github.com/FastFilter/xorfilter/pull/11/commits/c7b541fe86297e75073e0d193173feb7a2dd5180</a><br/>
<a href="https://github.com/FastFilter/xorfilter/pull/11" rel="nofollow ugc">https://github.com/FastFilter/xorfilter/pull/11</a></p>
<p>Also <a href="https://github.com/FastFilter/xorfilter/pull/10" rel="nofollow ugc">https://github.com/FastFilter/xorfilter/pull/10</a> fixes Go implementation to be closer to intended Xor8+ implementation.</p>
</div>
</li>
<li id="comment-485921" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">prataprc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-16T15:35:52+00:00">January 16, 2020 at 3:35 pm</time></a> </div>
<div class="comment-content">
<p>The rust implementation has a failure in release mode due the following assertion.</p>
<p><code>let fpp = matches * 100.0 / (falsesize as f64);<br/>
println!("false positive rate {}%", fpp);<br/>
assert!(fpp &lt; 0.40, "fpp({}) &gt;= 0.40", fpp);<br/>
</code></p>
<p>Below is the output.</p>
<p><code>---- tests::test_basic2 stdout ----<br/>
seed 5965087604022038976<br/>
bits per entry 9.864 bits<br/>
false positive rate 0.4027%<br/>
thread 'tests::test_basic2' panicked at 'fpp(0.4027) &gt;= 0.40', src\lib.rs:454:9<br/>
note: run with `RUST_BACKTRACE=1` environment variable to display a backtrace.<br/>
</code></p>
<p>Should I relax the &ldquo;false-positive-rate&rdquo; to <code>&lt; 0.50</code> ?</p>
<p>Ref: <a href="https://github.com/bnclabs/xorfilter/pull/7" rel="nofollow ugc">https://github.com/bnclabs/xorfilter/pull/7</a></p>
<p>Thanks,</p>
</div>
<ol class="children">
<li id="comment-485923" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-16T16:11:38+00:00">January 16, 2020 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried increasing the size of the test? I suspect that you might have a poor estimation of the false-positive rate.</p>
</div>
<ol class="children">
<li id="comment-486128" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">prataprc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-17T03:32:42+00:00">January 17, 2020 at 3:32 am</time></a> </div>
<div class="comment-content">
<p>Increased the test size and false-positive rate consistently stays below 0.40 %. Thanks,</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-487003" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">prataprc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T08:27:25+00:00">January 21, 2020 at 8:27 am</time></a> </div>
<div class="comment-content">
<p>Tried to document the sizing requirement for rust implementation of xorfilter <a href="https://github.com/bnclabs/xorfilter/issues/9" rel="nofollow ugc">here</a>. I hope it is correct. In which case, to index 1Billion keys we may need as high as 50GB of memory footprint ? Any suggestion on how to handle DGM (Disk-Greater-than-Memory) scenarios ?</p>
</div>
<ol class="children">
<li id="comment-487056" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T13:03:27+00:00">January 21, 2020 at 1:03 pm</time></a> </div>
<div class="comment-content">
<p>I think you are computing an upper bound on the memory usage, not a lower bound.</p>
</div>
<ol class="children">
<li id="comment-487059" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/864d6c4c60620d59b95f571a1b4f9faf?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">prataprc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T13:50:52+00:00">January 21, 2020 at 1:50 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I want to cover the worst case scenario that can lead to OOM or memory crunch. Even without the working array, the footprint for finger_print array alone can go beyong 9GB when we try to index 1 billion items.</p>
<p>Using mmap for xor-filter&rsquo;s memory requirement is one idea. Want to know better alternatives.</p>
</div>
<ol class="children">
<li id="comment-487081" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-21T16:20:29+00:00">January 21, 2020 at 4:20 pm</time></a> </div>
<div class="comment-content">
<p>I will take the discussion over to your issue.</p>
<p>But I think it is important to establish the context. Just storing 1 billion integers in a hash table in C++ or Java can easily use 32 GB or more.</p>
<p>Once you start having a billion of anything in memory, gigabytes of memory are required.</p>
<p>But I take you point.</p>
</div>
<ol class="children">
<li id="comment-487131" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7da1d9156c4a96a67b28e5419cfc62f8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7da1d9156c4a96a67b28e5419cfc62f8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ole-Hjalmar Kristensen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-22T00:21:25+00:00">January 22, 2020 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>This is actually where a standard Bloom filter is very good, since you need no extra storage for construction, and you can construct it incrementally. My main use is for tracking which hashes are definitely NOT already in content-addressable storage. With a fixed filter size, the ratio of false positives goes up as you insert hashes, but it&rsquo;s not critical in an application like this. A gigabyte of bloom filter storage goes a very long way.</p>
<p>That said, it looks like the Xor filter would be great for smaller data sets.</p>
</div>
<ol class="children">
<li id="comment-487213" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jackrabbit.apache.org/oak/docs/index.html" class="url" rel="ugc external nofollow">Thomas Müller Graf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-22T14:42:08+00:00">January 22, 2020 at 2:42 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if, for your use case, do you also need to remove entries at some point (e.g. garbage collection)? For Apache Jackrabbit Oak we use content-addressable storage as well, with garbage collection. We currently don&rsquo;t use an approximate data structure.</p>
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
</ol>
</li>
<li id="comment-572042" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04167fa4e64f978c45723c93a84912aa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04167fa4e64f978c45723c93a84912aa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-01T14:25:16+00:00">February 1, 2021 at 2:25 pm</time></a> </div>
<div class="comment-content">
<p>I just read through the paper and was a bit confused by the Assigning Step. Is B supposed to be initialized with zeros or random values at that point? In the Construction Step, it seems to still be uninitialized when assign() is called with it.</p>
</div>
<ol class="children">
<li id="comment-572059" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-01T16:24:32+00:00">February 1, 2021 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>I have not checked the paper recently, but it actually does not matter. You can start with a table that has garbage in it since all that matters is that XOR be the value you desire and each time you just change one slot. The construction does not need to be deterministic. You have a lot of freedom.</p>
</div>
</li>
</ol>
</li>
<li id="comment-576278" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2da0c729d4b5785549011814b1dcb303?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2da0c729d4b5785549011814b1dcb303?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Harris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-22T20:04:22+00:00">February 22, 2021 at 8:04 pm</time></a> </div>
<div class="comment-content">
<p>(Having read the paper)</p>
<p>I&rsquo;m curious, what is the reason for h_0, h_1 and h_2 mapping to non-overlapping intervals of |B|?</p>
<p>Is it simply to make sure h_0(x), h_1(x), h_2(x), have three distinct values? Or is there some property of the random graph that it wouldn&rsquo;t have if each hash function had the full range of |B| but otherwise avoided duplicates?</p>
<p>(Probably I can find the answer if I follow the Botelho cite).</p>
</div>
<ol class="children">
<li id="comment-576285" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-22T20:59:27+00:00">February 22, 2021 at 8:59 pm</time></a> </div>
<div class="comment-content">
<p>There is obviously the problem that you are going to get a very small number of collisions if you don&rsquo;t restrict the hash values, but I do not think that it is the primary concern. My expectation is that you are going to get a higher failure probability without the constraints.</p>
</div>
<ol class="children">
<li id="comment-576293" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2da0c729d4b5785549011814b1dcb303?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2da0c729d4b5785549011814b1dcb303?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Harris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-22T22:24:04+00:00">February 22, 2021 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>I was thinking of a collision-free hash scheme. E.g. with h_0&#8242;(x) in 0..|B-3|, h_1&#8242;(x) in 0..|B-2| and h_2&#8242;(x) in 0..|B-1|. h_1&#8242;(x) and h_0&#8242;(x)+h_1&#8242;(x) mod |B-1| would be two distinct values in 0..|B-2|. Similarly, adding h_2&#8242;(x) to those, mod |B|, gives a hashed triple with no duplicates.</p>
<p>Having now skimmed the Botelho paper, I think their proof depends on the graph being 3-partite. It&rsquo;s not clear to me, yet, whether the same property (whatever it is that makes the failure probability small) would hold without it being 3-partite, but still collision-free.</p>
<p>And if that were true, I wonder if it would lead to a reduction of the 1.23 factor.</p>
</div>
<ol class="children">
<li id="comment-576296" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-22T22:27:23+00:00">February 22, 2021 at 10:27 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>And if that were true, I wonder if it would lead to a reduction of the<br/>
1.23 factor.</p>
</blockquote>
<p>I expect that the answer is negative. You will need a higher (worse) ratio.</p>
<p>But it is not hard to test it out!</p>
</div>
<ol class="children">
<li id="comment-577148" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2da0c729d4b5785549011814b1dcb303?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2da0c729d4b5785549011814b1dcb303?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob Harris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-27T18:25:42+00:00">February 27, 2021 at 6:25 pm</time></a> </div>
<div class="comment-content">
<p>Some initial experiments suggest a collision-free triplet hash may be a very very slight improvement over the tripartite hash.</p>
<p>It seems to reduce the number of average number of attempts needed to find a suitable graph. But the reduction (if it really exists) is so slight as to not be worth the effort, maybe 1%. And this doesn&rsquo;t extrapolate to a similar reduction in the capacity expansion factor.</p>
<p>Specifically, I ran five experiments, each with 10K trials on 1K keys. In 4 of the 5 the triplet hash reduced avg attempts (e.g. from 1.116 to 1.105). In the fifth experiment it increased avg by about 0.1%.</p>
<p>Obviously that&rsquo;s not a thorough experiment. For one thing, the reduction is so small that it could be within the variance for 10K trials. Still, getting a &ldquo;win&rdquo; on 4 of 5 attempts seems promising.</p>
<p>I then tried to see if it would allow reduction of that 1.23. But I quickly discovered (as you probably already know) how sensitive the process is to changes in that factor. Reducing that will obviously raise the avg number of attempts. My hope was that changing that to, say, 1.22 might make the new hash scheme comparable to the tripartite hash with 1.23. But that small change raises the avg attempts by about 10% (for both hash schemes). At that point I inferred that I might only get a reduction to something like 1.229 at best, and I gave up.</p>
<p>P.S. my earlier description of the collision-free triplet hash was wrong in some details, but probably demonstrates the concept.</p>
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
</ol>
