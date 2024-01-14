---
date: "2018-08-20 12:00:00"
title: "Performance of ranged accesses into arrays: modulo, multiply-shift and masks"
index: false
---

[5 thoughts on &ldquo;Performance of ranged accesses into arrays: modulo, multiply-shift and masks&rdquo;](/lemire/blog/2018/08-20-performance-of-ranged-accesses-into-arrays-modulo-multiply-shift-and-masks)

<ol class="comment-list">
<li id="comment-343512" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://boytsov.info" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-20T17:15:35+00:00">August 20, 2018 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p>It seems like your modulo-approximation trick is very useful. I am certainly gonna switch to using it at some point. Should make all the hash-tricking much faster.</p>
</div>
</li>
<li id="comment-343844" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-22T09:44:41+00:00">August 22, 2018 at 9:44 am</time></a> </div>
<div class="comment-content">
<p>Unless my memory is flawed, I think gather instructions are not particularly microarchitecturally efficient on current Core CPUs. (Intel has hinted that this might improve in the future, but under current architectural assumptions it would be very hard to fetch data from more than two cache lines in a cycle nonetheless.) Anyway, this should be offset by vectorisation of other operations (and resulting reduced amount of instructions, allowing lots of iterations to be reordered), if there is a sufficient amount of them&#8230;</p>
</div>
<ol class="children">
<li id="comment-343982" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T03:54:27+00:00">August 23, 2018 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>Gather is <em>reasonably</em> efficient on Skylake (and not terrible on Broadwell). It is definitely still limited by the 2 loads per cycle, but it is comparable to scalar loads now without much cost for getting all the elements into the vector register. So if you actually wanted the loaded values in a vector register, it is &ldquo;ideal&rdquo;.</p>
<p>There isn&rsquo;t any optimziation of overlapping or duplicate values or anything though, so if many of your indices are the same, you don&rsquo;t get any speedup.</p>
</div>
<ol class="children">
<li id="comment-343990" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T05:17:01+00:00">August 23, 2018 at 5:17 am</time></a> </div>
<div class="comment-content">
<p>Interestingly, looking at Agner Fog&rsquo;s instruction tables, Skylake client would seem to have (at least latency/uop-wise) roughly as efficient gather instructions as one might expect from a good implementation on that microarchitecture. At the same time Skylake X doesn&rsquo;t perform that well, and earlier architectures do also significantly worse than Skylake client. Anyway, on Skylake Intel has fulfilled their promise! (Then again&#8230; on AMD Ryzen, gather instructions are pretty awful.)</p>
<p>Reducing amount of cache accesses, especially for the hash table use case doesn&rsquo;t seem like a particularly attractive proposition. Custom logic would be pretty heavy and benefit would materialise mostly on couple-kilobyte hash tables&#8230;</p>
</div>
<ol class="children">
<li id="comment-344274" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T23:53:45+00:00">August 24, 2018 at 11:53 pm</time></a> </div>
<div class="comment-content">
<p>It got <em>worse</em> on Skylake-X? That&rsquo;s weird&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
