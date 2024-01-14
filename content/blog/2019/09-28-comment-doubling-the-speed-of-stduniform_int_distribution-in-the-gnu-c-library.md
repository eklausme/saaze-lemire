---
date: "2019-09-28 12:00:00"
title: "Doubling the speed of std::uniform_int_distribution in the GNU C++ library (libstdc++)"
index: false
---

[49 thoughts on &ldquo;Doubling the speed of std::uniform_int_distribution in the GNU C++ library (libstdc++)&rdquo;](/lemire/blog/2019/09-28-doubling-the-speed-of-stduniform_int_distribution-in-the-gnu-c-library)

<ol class="comment-list">
<li id="comment-429600" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://github.com/KWillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T05:27:42+00:00">September 30, 2019 at 5:27 am</time></a> </div>
<div class="comment-content">
<p>Following my comments on earlier posts, I put together <a href="https://github.com/KWillets/range_generator" rel="nofollow">a repo with a few variations</a> on this method which might be interesting.</p>
<p>One observation after plugging in std::random_device is that random bits are expensive, and another direction might be to minimize how many we use. Shuffle, for instance, can keep track of the bit width of its index as it works its way down, and rejection within just that many bits may prove faster due to lower entropy consumption.</p>
<p>With pseudorandom generators of course it&rsquo;s different, so we almost need different algorithms for the different sources.</p>
</div>
<ol class="children">
<li id="comment-429629" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T08:23:35+00:00">September 30, 2019 at 8:23 am</time></a> </div>
<div class="comment-content">
<p>Wouldn&rsquo;t bit-optimal use of entropy effectively correspond with arithmetic decoding of a compressed bitstream? How hard that would be? I guess there would be a spectrum from fast and bit-expensive to slow and (almost?) bit-optimal solutions to such a problem.</p>
</div>
<ol class="children">
<li id="comment-429694" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/kwillets" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T17:02:40+00:00">September 30, 2019 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>AC did seem relevant, and it might be good to look through the different solutions. I have a feeling that left-to-right infinite-precision multiplication is already well known somewhere, but I haven&rsquo;t found a reference.</p>
</div>
<ol class="children">
<li id="comment-429697" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T17:18:17+00:00">September 30, 2019 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>If someone wants to work through this, I am available.</p>
<p>I think that there are papers on using as few random bits as possible, I read a few but I did not pay attention because that&rsquo;s not what interested me at the time.</p>
</div>
<ol class="children">
<li id="comment-430527" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T10:19:10+00:00">October 7, 2019 at 10:19 am</time></a> </div>
<div class="comment-content">
<p>I have a preliminary implementation which consumes &ldquo;optimal&rdquo; amount of whole bits per call. (It&rsquo;s not based on AC, though.) There are two variants: one that is easy to understand, and another that&rsquo;s a little hairier but branch predictor friendly and a bit faster, although it conceptually does lot of unnecessary work.</p>
<p>The branch predictor friendly version would seem to have overhead of about 9 ns per call for small non-power-of-two values on my couple year old 2.9 GHz laptop. I still have to clean up my code&#8230;</p>
</div>
</li>
<li id="comment-430581" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-07T17:56:50+00:00">October 7, 2019 at 5:56 pm</time></a> </div>
<div class="comment-content">
<p>I have experimented with some code that uses bits a bit more efficiently: a variant of &ldquo;bitmask with rejection&rdquo; algorithm (to which the &ldquo;mostly avoiding divisions&rdquo; algorithm transforms when variable number of bits are used, I believe), and a &ldquo;long multiplication&rdquo; algorithm. Of both there are naive and loop-unrolled versions (latter to please branch predictors).</p>
<p>I think the bitmask with rejection algorithm consumes log(4)log2(n) bits on average for large n, and the long multiplication algorithm does alway use less than log2(n)+2 on average for a specific value of n, the number of possible result values. Thus, the long multiplication algorithm uses the bit material more efficiently, although for almost all values of n it imposes a two-bit overhead over optimal fractional bit algorithms, and actually loses to the bitmask with rejection algorithm when n is little less than an integer power of two.</p>
<p>My oversimplified benchmark (including xorshift64s and bit management) spends around 4.5 ns per call on naive bitmask w/ rejection function, and 4.3 ns on unrolled variant (for n=24; these can vary significantly depending on value of n). In the case of long multiplication algorithm corresponding numbers on my 2.9 GHz &rsquo;16 laptop are 11.3 and 9.2 ns.</p>
<p>My code is hopefully readable enough: <a href="https://pastebin.com/5c8zMk6B" rel="nofollow ugc">https://pastebin.com/5c8zMk6B</a></p>
</div>
<ol class="children">
<li id="comment-431253" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T05:03:15+00:00">October 12, 2019 at 5:03 am</time></a> </div>
<div class="comment-content">
<p>I fixed my long multiplication routine, and interestingly enough the non-unrolled variant is now faster, although it&rsquo;s slower than than before. It now takes about 12.4 ns per call.</p>
<p>I think this doesn&rsquo;t really reflect performance of the long multiplication algorithm itself (which should be have run time independent of n on average, and shows with BOGUS_RANDOMNESS on my code to drop typical call time to &lt;4 ns), but rather management overhead of the random bits pool. It might be that the numbers would be much better if one would acquire randomness in larger batches than 64 bits at a time and shift it from the pool in a branchless manner.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-429803" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-01T19:06:08+00:00">October 1, 2019 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>This problem is awfully painful to think about without rational bignums if one wants to handle fractional bits (in the style of arithmetic coding), but if we choose to consume an whole (but possibly variable) number of input bits for every output value it becomes probably more tractable. (I leave the implementation as an exercise to the reader as it&rsquo;s quite late evening on my time zone.:)</p>
</div>
<ol class="children">
<li id="comment-429819" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T01:11:55+00:00">October 2, 2019 at 1:11 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Efficient&rdquo; AC is widespread in compression algorithms, and doesn&rsquo;t need any bignum stuff. You just don&rsquo;t get &ldquo;exact&rdquo; AC but rather just precision down to the number of bits you have (there are some tradeoffs e.g., with how often you flush).</p>
<p>So I don&rsquo;t see a problem to adapt those algorithms to the shuffle case: the analogy is more or less exact. However they all need one division per value, so I have my doubts.</p>
<p>That said, I think Daniel&rsquo;s technique works with any number of bits, right? So you don&rsquo;t need a different algorithm to be efficient down to the bit: AC would only get you sub-bit precision, and your generator would have to be <em>really</em> slow for that to pay off, I think.</p>
<p>We&rsquo;ll that&rsquo;s not strictly correct, since in the retry case Daniel&rsquo;s algorithm will use another set of bits: Daniel is there a formula for the number of bits used in expectation for a given range?</p>
</div>
<ol class="children">
<li id="comment-429829" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T03:35:57+00:00">October 2, 2019 at 3:35 am</time></a> </div>
<div class="comment-content">
<p>Okay, bad terminology (and I was also pretty tired).</p>
<p>One thing I fear on using efficient arithmetic coding methods is introducing some of the skew that these routines are intending to avoid. Practical AC doesn&rsquo;t need to care about that so much.</p>
<p>Reasoning about expectation of number of bits on the case of code above is an interesting question. I think it should be easier to reason at least about a case of and &ldquo;infinite-precision&rdquo; binary fixed point number presenting range between 0 and the number of alternatives (non-inclusive). What is the expected amount of bits of such a random number that determines the random integer without uncertainty? The best case would be log2(maxval), the worst would be infinity for almost all values of maxval, I think.</p>
<p>I wonder if such a routine could be turned into something akin to Bresenham&rsquo;s algorithm in practice. Relying on single bit input steps would probably make that ugly on the branch predictor, though&#8230;</p>
</div>
<ol class="children">
<li id="comment-429860" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T15:25:16+00:00">October 2, 2019 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>Really good point about the bias. Of course in compression you don&rsquo;t really care since it&rsquo;s just a microscopic difference in the compression ratio but for this type of thing it would be a big deal.</p>
</div>
<ol class="children">
<li id="comment-430017" class="comment odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-04T08:45:36+00:00">October 4, 2019 at 8:45 am</time></a> </div>
<div class="comment-content">
<p>I suspect working around bias turns into nasty bignum math very quickly. On the other hand, if you want to generate uniformly distributed numbers on the same, relatively small (&lt; square root of native register) range s, you can simply search uniform integers over range s^n (smaller than register range) using the routine I present on godbolt link below, and later chop them relatively efficiently to individual results using precomputed division/residual magic constants.</p>
<p>This drops expected number of entropy bits used for range 3 from 3 bits to 1.63 on 64-bit register implementation (optimal would be 1.58), for instance.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-429850" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T13:13:04+00:00">October 2, 2019 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>You approximately have a geometric distribution with p = 1 &#8211; s/2^L where s is your range. I think that the expected number of trials before you have a success is 1/p, so 2^L/(2^L-s)&#8230; You consume L bits per trial, so it is about 2^L/(2^L-s) * L bits consumed to generate a random number in [0,s).</p>
<p>You can solve for the optimal value of L. It is going to be higher than log2(s), evidently. My expectation is that the optimal L is not going to be very far from log2(s). But I am sure someone can derive a solid bound.</p>
<p>Sorry, I have not done the math yet.</p>
</div>
<ol class="children">
<li id="comment-429973" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T19:01:57+00:00">October 3, 2019 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>Some empirical averages (of million random runs each) on used bits I observed on my code for 1 to 64 values:</p>
<p>{0., 1., 2.99913, 2., 3.68596, 3.75048, 4.09385, 3., 4.56261, 4.56261, 4.7658, 4.62472, 5.00652, 5.03252, 5.21029, 4., 5.53107, 5.53158, 5.62542, 5.56342, 5.71718, 5.71846, 5.82045, 5.62477, 5.9298, 5.93728, 6.04736, 5.9685, 6.16978, 6.17932, 6.27255, 5., 6.51585, 6.51485, 6.56376, 6.53185, 6.60912, 6.60959, 6.65559, 6.56258, 6.70191, 6.70274, 6.75153, 6.71835, 6.79677, 6.79703, 6.84769, 6.62494, 6.90202, 6.90547, 6.95634, 6.92183, 7.0106, 7.01561, 7.07071, 6.96757, 7.12957, 7.13322, 7.18957, 7.14959, 7.25198, 7.2558, 7.30239, 6.}</p>
<p>The plot doesn&rsquo;t suggest it would be too obvious, but yes, it&rsquo;s like 2-based logarithm and some overhead&#8230;</p>
</div>
</li>
<li id="comment-429975" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T19:49:06+00:00">October 3, 2019 at 7:49 pm</time></a> </div>
<div class="comment-content">
<p>No wonder my plots seemed odd, I had a bug on my code. But when corrected, it&rsquo;d seem that average number of bits stays under log2(n + 1) + 2 bits for outputs of n alternatives.</p>
</div>
</li>
<li id="comment-429997" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-04T04:32:38+00:00">October 4, 2019 at 4:32 am</time></a> </div>
<div class="comment-content">
<p>Average number of bits required for s alternatives (with a bit of help from OEIS in the form of mystery sequence A104594) is, at least for my code which consumes whole bits:</p>
<p>x = ceil(log2(s)) + bitand(s, s-1)/2^(ceil(log2(s))-1)</p>
<p>And for s &gt;= 1: ceil(log2(s)) &lt;= x &lt; ceil(log2(s))+2</p>
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
<li id="comment-429676" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T13:20:48+00:00">September 30, 2019 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>The &ldquo;bits are expensive&rdquo; scenario is interesting. Note that the existing two-division approach does not use fewer bits&#8230; you know this, but a casual reader may not.</p>
<p>In the case where bits are infinitely expensive, I guess the solution is known.</p>
</div>
<ol class="children">
<li id="comment-429699" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/kwillets" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T17:57:48+00:00">September 30, 2019 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>The existing thing is suboptimal in just about every way.</p>
<p>With expensive bits, the rightward extension idea may be adaptable to consuming only a few at a time, eg an 8-bit random times a 32-bit range. It would trade more adds and multiplies (every 8 bits instead of every 32) for fewer random bits consumed.</p>
</div>
</li>
<li id="comment-429852" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T13:47:17+00:00">October 2, 2019 at 1:47 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s a rough idea: precompute magic constants which convert divisions into multiplications on initialization of std::uniform_int_distribution. Maintain reasonable amount of usable bits of entropy (like 64 bits or something), and rescale a full native type of entropy bits to output range (using magic multiplicative constants). This is the preliminary result. Now, multiply this again by another magic constant to get a fixed-point fraction corresponding to &ldquo;exact&rdquo; value of bits which would represent this value on the native type, and compute xor of this with original entropy bits. If this result is not zero, find the most significant bit set, and return that bit and less significant remaining bits to the entropy pool (these bits were not necessary in deciding the output value) and return the preliminary result as the random value.</p>
<p>If the result of xor is zero, continue by requesting more random bits and by performing long division algorithm (with above bit-checking) until the arbitrary-precision fraction and entropy bits diverge.</p>
<p>If my reasoning is correct, this routine shouldn&rsquo;t demand divisions beyond initialization, no excessively wide multiplications, and should result less than one bit of wasted entropy per generated random value.</p>
</div>
<ol class="children">
<li id="comment-429856" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T14:09:53+00:00">October 2, 2019 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>Are you assuming that the range does not change dynamically?</p>
</div>
<ol class="children">
<li id="comment-429857" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T14:22:07+00:00">October 2, 2019 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>Naively so, or at least that they don&rsquo;t change often. It is hard to reason how one could perform bit-efficient operations without that, it would eventually turn into implementing divisions in a way or another.</p>
<p>(Extracting one bit of division result shouldn&rsquo;t take more than something like 2-3 clock cycles, though, and every such bit would halve the likelihood of need to continue, but combining this with the approach of the blog post is a bit beyond me.)</p>
</div>
<ol class="children">
<li id="comment-429858" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T14:28:25+00:00">October 2, 2019 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>The benchmark described in my blog post is a Knuth shuffle, so it is a dynamic range.</p>
</div>
<ol class="children">
<li id="comment-429859" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-02T15:11:27+00:00">October 2, 2019 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>That definitely sabotages my approach. 🙂</p>
<p>Maybe there&rsquo;s a way to extend the multiplication method somehow, considering that need of extra bits should become increasingly unlikely, bit after bit.</p>
<p>Bit-by-bit division wouldn&rsquo;t be awfully hard to implement and it could run until the result would be known to be unbiased, but that would have a cost per <em>produced bit</em>. This might still be faster for many inputs than two hardware divisions (or similar overhead)!</p>
</div>
</li>
<li id="comment-429957" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T15:11:59+00:00">October 3, 2019 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s an alternative version. This is really pseudocode; I haven&rsquo;t even tried compiling it. I tested the concept with ranges of 3 and 5 with corresponding Wolfram Language code and 2 and 3 bit &ldquo;word size&rdquo;, and it seemed to give unbiased results. So, likelihood of the code having significant bugs is large. (Writing the supporting code was just bigger hassle than translating the idea.)</p>
<p><code>uint32_t get_uniform_rand(uint32_t range)<br/>
{<br/>
uint32_t shift = 32 - __builtin_ffs(range);<br/>
uint32_t add = range &lt;&lt; shift;<br/>
uint64_t mul;<br/>
uint32_t res;<br/>
uint32_t frac;</p>
<p> if (range == 0)<br/>
{<br/>
return 0;<br/>
}</p>
<p> frac = mul = (uint64_t)(get_random_bits(bits) &lt;&lt; shift) * range;<br/>
res = mul &gt;&gt; 32;</p>
<p> /* Can the fractional part still cause res to increment? */<br/>
while (frac &gt; -add)<br/>
{<br/>
uint32_t oldfrac = frac *= 2;</p>
<p> if (get_random_bit())<br/>
{<br/>
frac += add;<br/>
}</p>
<p> if (oldfrac &gt; frac)<br/>
{<br/>
/* Wraparound, that is, carry. */<br/>
return res + 1;<br/>
}<br/>
}</p>
<p> return res;<br/>
}<br/>
</code></p>
<p>The idea here is that first only limited amount of bits contributes to the multiplication, and then multiplication is performed one bit at a time until it&rsquo;s known that further bits don&rsquo;t contribute to the output value.</p>
<p>Biggest problem with modern processors on this is probably branch prediction of the while loop. This code might be faster if the loop would be somehow unrolled couple of times and the point where all necessary bits were seen would be reasoned afterwards.</p>
</div>
<ol class="children">
<li id="comment-429958" class="comment even depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T15:18:28+00:00">October 3, 2019 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>Ehm. &ldquo;bits&rdquo; above is __builtin_ffs(range).</p>
</div>
</li>
<li id="comment-429963" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T16:24:46+00:00">October 3, 2019 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>And __builtin_ffs -&gt; __builtin_clz. Jeez.</p>
<p>I think this code actually works: <a href="https://godbolt.org/z/pMDK_5" rel="nofollow ugc">https://godbolt.org/z/pMDK_5</a></p>
</div>
<ol class="children">
<li id="comment-429967" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T17:03:28+00:00">October 3, 2019 at 5:03 pm</time></a> </div>
<div class="comment-content">
<p>Now it works. Promise!</p>
<p><a href="https://godbolt.org/z/q96jQx" rel="nofollow ugc">https://godbolt.org/z/q96jQx</a></p>
</div>
<ol class="children">
<li id="comment-430001" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-04T05:15:58+00:00">October 4, 2019 at 5:15 am</time></a> </div>
<div class="comment-content">
<p>I think the bit-by-bit multiplication might be omitted (and full multiplication in the style of the blog post performed) for tracking the number of necessary bits of entropy, and this information could be extracted from the lower multiplication result world, but I have no proof for this, or clear hunch if this could be accomplished efficiently (without a division).</p>
<p>This still doesn&rsquo;t remove the need that sometimes more than one word of entropy is truly needed to get an unbiased result.</p>
</div>
</article>
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
</ol>
</li>
</ol>
</li>
<li id="comment-430326" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-06T13:10:20+00:00">October 6, 2019 at 1:10 pm</time></a> </div>
<div class="comment-content">
<p>The &ldquo;bits are expensive&rdquo; scenario: arithmetic coding could be used, or ANS coding (&ldquo;asymmetric numeral systems&rdquo;, see wikipedia). ANS might be faster. The problem is probably correcting bias (I think for both arithmetic and ANS coding). For ANS coding, the generation loop looks something like this (Java), so it only uses multiplication / shift / add:</p>
<p><code>private static final long TOP = 1L &lt;&lt; 24;<br/>
private static final int SHIFT = 12;<br/>
private static final int MASK = (1 &lt;&lt; SHIFT) - 1;</p>
<p> // read 64 bit from the compressed stream<br/>
long state = r.nextLong();<br/>
// for all output bytes<br/>
for (int i = 0; i &lt; size; i++) {<br/>
// read data from the state<br/>
int x = (int) state &amp; MASK;<br/>
// lookup the code<br/>
int c = freqToCode[x] &amp; 0xff;<br/>
// output<br/>
out[i] = (byte) c;<br/>
// update state depending on output and frequencies<br/>
state = (freq[c] * (state &gt;&gt; SHIFT)) + x - cumulativeFreq[c];<br/>
// if necessary, read from the compressed stream<br/>
while (state &lt; TOP) {<br/>
state = (state &lt;&lt; 32) | (r.nextInt() &amp; 0xffffffffL);<br/>
}<br/>
}<br/>
</code></p>
<p>I don&rsquo;t think tables are needed as frequencies should be equal for each entry in the alphabet. I implemented some ANS code in h2/src/test/org/h2/test/unit/TestAnsCompression.java (<a href="https://github.com/h2database/h2database" rel="nofollow ugc">https://github.com/h2database/h2database</a>).</p>
</div>
</li>
<li id="comment-652763" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/726f7c3769f32d3da4656ea906d02adb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/726f7c3769f32d3da4656ea906d02adb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-05T20:51:25+00:00">July 5, 2023 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>There are no casual readers here</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-429601" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3e63e9b7bf82275e9d05e82b5b11a6d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3e63e9b7bf82275e9d05e82b5b11a6d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://tomlankhorst.nl" class="url" rel="ugc external nofollow">Tom</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T05:29:56+00:00">September 30, 2019 at 5:29 am</time></a> </div>
<div class="comment-content">
<p>Great article. Since these are eventually arithmetic tricks, I hope that one day this will be the level of optimization that the compiler will give us.</p>
</div>
<ol class="children">
<li id="comment-429675" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-30T13:16:15+00:00">September 30, 2019 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>I am not sure that the compiler would be allowed to make this optimization since it changes the output.</p>
</div>
</li>
</ol>
</li>
<li id="comment-429955" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28b803d4d151311e98ba44fd22c1ea21?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28b803d4d151311e98ba44fd22c1ea21?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://none" class="url" rel="ugc external nofollow">David Taylor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-03T14:47:13+00:00">October 3, 2019 at 2:47 pm</time></a> </div>
<div class="comment-content">
<p>I was interested enough in this that I tried to understand it and make it work. Unfortunately, it didn&rsquo;t. I found the problem.</p>
<p>This code is very inefficient with memory, but it shows the problem and the fix.</p>
<p>The idea is NOT to feed it random numbers, but to feed every number in the input integer size and see how they get binned out. Each output integer should have the an equal number of inputs that resolve to it.</p>
<p><code> #include &lt;stdio.h&gt;<br/>
#include &lt;stdint.h&gt;<br/>
#include &lt;string.h&gt;</p>
<p> int16_t nearlyDivisionlessY(uint16_t x, uint16_t divisor, uint16_t fixed) {<br/>
uint32_t m;<br/>
uint16_t l, v;<br/>
m=(uint32_t)x*divisor;<br/>
l=(uint16_t)m;<br/>
if (l&lt;divisor) {<br/>
if (!fixed) {<br/>
v=-divisor % divisor; //PROBLEM: referenced paper AND proposed kernel patch say use this<br/>
} else {<br/>
v=(uint16_t)(-divisor) % divisor; //FIX<br/>
}<br/>
if (l&lt; v) {<br/>
return -1;<br/>
}<br/>
}<br/>
return m&gt;&gt;16;<br/>
}</p>
<p> #define MYMAX (UINT16_MAX+1)<br/>
uint16_t bins[MYMAX];<br/>
uint16_t bbins[MYMAX];</p>
<p> int main(int argc, char *argv[]) {<br/>
uint16_t i,divisor,fix;<br/>
uint16_t b,base;<br/>
for (fix=0; fix&lt;=1; ++fix)<br/>
for (divisor=6; divisor&lt;=6; ++divisor) {<br/>
if (!(divisor&amp;(divisor-1))) continue; //skip powers of 2<br/>
printf(" %u %s 0x10000 %% %u = %u\n",divisor, (fix?"fixed":"original"), divisor, (uint16_t)(0x10000UL % divisor));<br/>
memset(bins,0,sizeof(bins));<br/>
memset(bbins,0,sizeof(bbins));<br/>
i=0;<br/>
do {<br/>
b=nearlyDivisionlessY(i,divisor,fix);<br/>
if (0&lt;=b)<br/>
bins[b]++;<br/>
} while (++i);<br/>
i=0;<br/>
do {<br/>
bbins[bins[i]]++;<br/>
if (bins[i]) {<br/>
printf("%5u %5u\n", i, bins[i]);<br/>
}<br/>
} while (++i&lt;divisor);<br/>
i=0;<br/>
do {<br/>
if (bbins[i]) {<br/>
printf("%5u %5u\n", i, bbins[i]);<br/>
}<br/>
} while (++i);<br/>
}<br/>
return 0;<br/>
}<br/>
/* output:<br/>
6 original 0x10000 % 6 = 4<br/>
0 10923<br/>
1 10923<br/>
2 10922<br/>
3 10923<br/>
4 10923<br/>
5 10922<br/>
10922 2<br/>
10923 4<br/>
6 fixed 0x10000 % 6 = 4<br/>
0 10922<br/>
1 10922<br/>
2 10922<br/>
3 10922<br/>
4 10922<br/>
5 10922<br/>
10922 6<br/>
*/<br/>
</code></p>
</div>
</li>
<li id="comment-430923" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-09T13:35:48+00:00">October 9, 2019 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p>Another question on generating pseudorandom numbers on non-power-of-two interval: would it possible to implement PRNGs that emit uniformly distributed pseudorandom integers while evolving their state efficiently on conventional binary logic and performing fixed amount of work between outputs? Would there be a trivial method to construct such a PRNG for a specific interval size?</p>
<p>Listed unbiased transforms from power-of-two PRNGs fail on the &ldquo;fixed amount of work&rdquo; part, and evolving the state as trits instead of bits, for instance, is unlikely to be particularly efficient to implement on conventional CPUs.</p>
</div>
<ol class="children">
<li id="comment-430927" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-09T14:02:00+00:00">October 9, 2019 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>Well, I should have thought it through&#8230;</p>
<p>A simple uniform ternary toy PRNG (cycle length 243 == 3^5) might be, for instance:</p>
<p><code>#include &lt;stdint.h&gt;</p>
<p>uint8_t state;</p>
<p>uint8_t random3(void)<br/>
{<br/>
state = (7 * state + 154) % 243;<br/>
return state / 81;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-431329" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-12T20:29:42+00:00">October 12, 2019 at 8:29 pm</time></a> </div>
<div class="comment-content">
<p>If it&rsquo;s any consolation if you hadn&rsquo;t given me a minute to answer your question, I also would have though &ldquo;no you can&rsquo;t do it in guaranteed fixed time&rdquo;, by analogy with the superficially similar problem &ldquo;given a source of random bits, generate a random value between 1 and N, where N is not an integer power of 2&rdquo; (or several equivalent formulations).</p>
<p>At least for <em>that</em> problem (the one the post was about, I guess), I don&rsquo;t think you can do it with a guaranteed fixed number of bits? Of course the expected number of bits is finite, due to the magic of exponential series, but you still need an arbitrary number of bits at least for some cases, IIRC.</p>
<p>So I would have thought something similar here, but as you point out, obviously not.</p>
<p>It makes sense though: the operators +, %, * aren&rsquo;t inherently &ldquo;binary&rdquo; so it&rsquo;s not too weird I guess that they work fine for non-power-of-two: it&rsquo;s only when your underlying random source provides bits that the pow-2 becomes inherent. Or something handwavy like that.</p>
</div>
<ol class="children">
<li id="comment-431372" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-13T03:19:03+00:00">October 13, 2019 at 3:19 am</time></a> </div>
<div class="comment-content">
<p>I guess I agree (in equally handwavy ways) on pretty much all of this.</p>
<p>I think it&rsquo;s intuitive that for non-integer powers of two you can&rsquo;t guarantee an upper bound for number of bits that would produce a result when the input source is base-2, but the mean number of bits required, for any finite range is bounded. In an earlier comment I concluded that the long multiplication method should work with less than ceil(log2(n)) + 2 bits per call on average for any value (and at best log2(n) for integer powers of two, of course).</p>
</div>
<ol class="children">
<li id="comment-431663" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-15T12:50:48+00:00">October 15, 2019 at 12:50 pm</time></a> </div>
<div class="comment-content">
<p>I think the bit efficiency overhead (in practice, the rounding up of log2(n) and the + 2 part) could be largely eliminated for values of n much smaller than the word size: one could simply keep the seen random bits from the previous round, re-feed them to new calculation where n = n_new * n_previous, subtracting preceding value multiplied by n_previous from the result, and repeating this as long as n fits in the word size. This could provide bit efficiency approaching log2(n), about 3% (or 1/32) worse than optimal in the case of 64-bit words. The computational overhead in comparison with the naive implementation would be something like two multiplications and two additions per call.</p>
<p>(This would be effectively a computation which would incrementally compute the result for range n_1 * n_2 * &#8230; * n_x and peel off values for individual values of n at the same time.)</p>
<p>Thus one can get quite close to optimal bit efficiency wile maintaining unbiased results, without a need to resort to arbitrary precision arithmetic or divisions, at least when typical n is significantly smaller than the native word size &#8211; which should really be the common case for such a function.</p>
</div>
<ol class="children">
<li id="comment-554783" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-10T04:55:12+00:00">October 10, 2020 at 4:55 am</time></a> </div>
<div class="comment-content">
<p>This paper is also interesting:</p>
<p><a href="https://arxiv.org/pdf/1304.1916.pdf" rel="nofollow ugc">Optimal Discrete Uniform Generation from Coin Flips, and Applications</a></p>
<p>They work in a model where you consume randomness one bit at a time (your only source of randomness is a coin-flip), and the primary algorithm (FASTDICEROLLER) for generating values in a range is also division free.</p>
<p>Naively, it requires at least ~log(N) flips for a range of size N, but the initial ~log(N) flips could simply be done at all once by extracting that many bits (for these initial flips the <code>v &gt;= n</code> condition is always false so it just amounts to accumulating all the random bits in <code>c</code>).</p>
<p>Performance is not terrible, but I suspect depends heavily on the exact value of n. If it is just above a power of two, the first &ldquo;meaningful&rdquo; flip (that can be accepted or rejected, i.e., where <code>v &gt;= n</code>) will be rejected with probability a bit less than 50%, so you&rsquo;ll probably take a misprediction. For values just under a power of two, rejection chance is close to zero and it should be very fast.</p>
<p>I prefer Lemire&rsquo;s algorithm because in practice you&rsquo;d probably want to use a few more bits (but not 64!) to reduce the rejection chance and improve performance, and his provides the way to do that while remaining division free.</p>
</div>
<ol class="children">
<li id="comment-554791" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-10T06:08:29+00:00">October 10, 2020 at 6:08 am</time></a> </div>
<div class="comment-content">
<p>Interesting find!</p>
<p>On a quick glance the paper would seem to do pretty much those things I ranted on these comments a year ago. I believe the algorithm is effectively equivalent to what I investigated, although my interest was achieving reasonable real-world performance while maintaining optimal bit usage.</p>
<p>I did attempt some optimizations to tame branch predictor issues, but in the end they were not particularly effective &#8211; then again, if you are <em>really</em> limited by the speed of &ldquo;coin flips&rdquo; (a physical randomness source) and want to use those bits efficiently, maybe algorithmic speed is not of the highest importance. Decreasing bit efficiency dramatically reduces those speed penalties, anyway.</p>
<p>I believe my most recent work on this is here: <a href="https://pastebin.com/5c8zMk6B" rel="nofollow ugc">https://pastebin.com/5c8zMk6B</a> &#8211; but it doesn&rsquo;t involve remembering past requests in order to increase bit efficiency, which could be implemented relatively easily.</p>
</div>
<ol class="children">
<li id="comment-554846" class="comment even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-11T02:34:21+00:00">October 11, 2020 at 2:34 am</time></a> </div>
<div class="comment-content">
<p>Yeah, the FDR approach in the paper isn&rsquo;t exactly optimal either but they do provide a more complicated approach that is optimal, but I think the basic approach is close enough.</p>
<p>Your linked approach and the approach in the paper both share the interesting characteristic that I forgot to mention above that they don&rsquo;t even need a multiplication. For machines with expensive multiplications but cheap branch mispredictions (many microcontroller-ish things qualify) this might be a big benefit.</p>
</div>
<ol class="children">
<li id="comment-554862" class="comment odd alt depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-11T07:07:23+00:00">October 11, 2020 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>Yeah, multiplication is technically just a shortcut. Microcontrollers, particularly if the target range is particularly small, could do better without, although I guess cheap multiplication is available on most &ldquo;modern&rdquo; microcontrollers (then again, there&rsquo;s plenty of legacy like PICs etc.).</p>
</div>
</li>
<li id="comment-555308" class="comment even depth-9">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-17T04:23:38+00:00">October 17, 2020 at 4:23 am</time></a> </div>
<div class="comment-content">
<p>Actually, looking at this a bit more closely&#8230; my algorithm is not optimal on the usage of bits! Mean overhead for n=3 is only third of a bit and drops from there, but nonetheless! Interestingly enough algorithm of taking two random bits and repeating if value is 3 is the most efficient solution for this exact problem, expected bits at 8/3 (while mine is 3). I think this is a bit surprising since in one fourth of times two bits are completely discarded&#8230;</p>
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
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652764" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jake</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-05T21:05:17+00:00">July 5, 2023 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>I understand the academic interest in absolutely uniform distribution but I think that for all ***reasonable intents and purposes**** just doing <code>prng() % range</code> is good enough. prng being an instance of <code>mt19937_64</code> or some such.</p>
<p>****reasonable intents and purposes*** means the output range is much smaller than the prng range. And the number of trial is also small relatively to the full 64-bit range so you would not notice the lower part of the output range having a teeny-tiny higher chance of occurring.</p>
<p>So we can save ourselves the branch for chopping off the top of the input range.</p>
<p>Now for the division, or modulo, you can use libdivide, fastmod, or any any other similar impl.</p>
<p>Please tell me where I am wrong. Thanks!</p>
</div>
<ol class="children">
<li id="comment-652774" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-06T05:24:32+00:00">July 6, 2023 at 5:24 am</time></a> </div>
<div class="comment-content">
<p>You may not be concerned with biases and in your own use cases, that might be warranted. However, existing functions in standard libraries were bias-free. The proposed function, which has now been adopted in several standard libraries, replaced bias-free functions by a bias-free function while improving the performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652867" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8152df7df7970d054387e065b272b406?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8152df7df7970d054387e065b272b406?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shawn Silverman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-10T16:41:11+00:00">July 10, 2023 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>I recently implemented this algorithm, and it works great, except for when using it with <code>std::minstd_rand</code>. For that case, I get a uniform distribution over only half the requested range. For example, if I request a range of 10, this should result in numbers in the range 0-9, however, I&rsquo;m only seeing results in the range 0-4.</p>
<p><code>std::mt19937</code> works fine, as does using a hardware-based entropy generator, with the exact same &ldquo;Lemire algorithm&rdquo; code.</p>
<p>Is this algorithm known to have issues when used with LCG-type generators as a source (or maybe I&rsquo;m over-generalizing)?</p>
<p>Here&rsquo;s some test code that demonstrates the problem:<br/>
<a href="https://gist.github.com/ssilverman/216c0e3f31e0a644abb300561bb733c7" rel="nofollow ugc">https://gist.github.com/ssilverman/216c0e3f31e0a644abb300561bb733c7</a></p>
<p>I tested this using Xcode 14.3.1 (Apple clang version 14.0.3 (clang-1403.0.22.14.1)) and on a Teensy 4.0 (Teensyduino 1.58, GCC 11.3.1).</p>
</div>
<ol class="children">
<li id="comment-652868" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-10T16:52:41+00:00">July 10, 2023 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p><em>Is this algorithm known to have issues when used with LCG-type generators as a source (or maybe I’m over-generalizing)?</em></p>
<p>The assumption is that you have a generator that is uniform over the 32-bit or 64-bit range. You are using a generator that is not uniform over the range of values supported by <tt>uint32_t</tt>. By default, it will only generate values in the range <tt>[0,2^31-1)</tt>. So it is not appropriate.</p>
</div>
<ol class="children">
<li id="comment-652870" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8152df7df7970d054387e065b272b406?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8152df7df7970d054387e065b272b406?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shawn Silverman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-10T17:15:04+00:00">July 10, 2023 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p>That makes total sense. That was quite a thing to overlook on my part. 🙂</p>
<p>Now I have to figure out why the other algorithm in that code (<code>randomNonLemire()</code>), which I believe also has a 32-bit full range assumption, gives expected results over the whole requested range (0-9), even if the pseudo-random numbers have a 0-(2^31-1) range.</p>
</div>
<ol class="children">
<li id="comment-652880" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8152df7df7970d054387e065b272b406?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8152df7df7970d054387e065b272b406?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shawn Silverman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-10T21:47:11+00:00">July 10, 2023 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>For future readers: I settled on using <code>std::uniform_int_distribution</code> because it likely takes into account all the cases I didn&rsquo;t think of, such as whether the random source has &ldquo;full precision&rdquo;. I&rsquo;m fortunate to be using systems that have this class.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
