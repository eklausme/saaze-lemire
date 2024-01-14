---
date: "2018-08-22 12:00:00"
title: "Avoid lexicographical comparisons when testing for string equality?"
index: false
---

[37 thoughts on &ldquo;Avoid lexicographical comparisons when testing for string equality?&rdquo;](/lemire/blog/2018/08-22-avoid-lexicographical-comparisons-when-testing-for-string-equality)

<ol class="comment-list">
<li id="comment-343953" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/112969ea64530a13f8405c85fddc0ff4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/112969ea64530a13f8405c85fddc0ff4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">firefox</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-22T22:17:04+00:00">August 22, 2018 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>Shouldn&rsquo;t ww1 and ww2 be uint32_t?</p>
</div>
<ol class="children">
<li id="comment-344232" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T18:50:34+00:00">August 24, 2018 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it was a typographical error.</p>
</div>
</li>
</ol>
</li>
<li id="comment-343956" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6f9b601ff765129fe8a092bb4be73d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6f9b601ff765129fe8a092bb4be73d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">simplicio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-22T22:41:36+00:00">August 22, 2018 at 10:41 pm</time></a> </div>
<div class="comment-content">
<p>Interesting. I&rsquo;d think a naive copy of memcmp would take two operations per word, testing each for (a .lt b) and than if that failed, (a .eq. b), which would make it twice as slow as your memeq in the worst case of identical strings. And indeed, your version appears to be twice as fast.</p>
<p>But a better memcmp would be to walk down the string and just test test each word for equality, and than only test (a .lt. b) when the equality test failed. In that case, you&rsquo;d think both would be more or less as fast, as memcmp would only have one more operation then memeq. So I&rsquo;m kind of surprised by this result.</p>
</div>
<ol class="children">
<li id="comment-344236" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T19:10:57+00:00">August 24, 2018 at 7:10 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>you&rsquo;d think both would be more or less as fast</p>
</blockquote>
<p>That is true for some definition of &ldquo;more or less&rdquo;.</p>
</div>
</li>
<li id="comment-344270" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T23:05:22+00:00">August 24, 2018 at 11:05 pm</time></a> </div>
<div class="comment-content">
<p>You are right &#8230; &ldquo;in the long run&rdquo;. Certainly most memcmp implementations will sequentially check one large word from each input and when they differ do &ldquo;a bit more&rdquo; to return the lexicographic result. They do not do the naive thing of comparing &lt; and &gt; for each pair.</p>
<p>It&rsquo;s not necessarily just &ldquo;one more operation&rdquo; though, especially on little-endian machines: if you know that the two inputs differ for some eight byte word, how do you return the right 3-way result? The easy way is to subtract, but this gives the right answer only on big-endian. On little endian you can swap the byte order and then subtract, but 64-bit bswap is not super fast even on recent Intel.</p>
<p>There are perhaps other tricks possible, but current compilers prefer bswap.</p>
<p>Vectorization of memcmp is another challenge: if you compare a 256-bit &ldquo;word&rdquo; and find it unequal, you can&rsquo;t subtract them since there are no 256-bit wide subtractions. So again it&rsquo;s more complex. Asymptotically they are the same though.</p>
<p>Finally, memeq gives you another advantage: you could check the bytes in any order you want. One could imagine an adaptive or application-specific memeq that knows strings usually differ at the start or the end so checks them in an order that takes advantage of that. memcmp can&rsquo;t.</p>
<p>That said, the tests here show these effects: the memcmp slowdown shown in the numbers above is more or less entirely because gcc decided to call into libc memcpy which is much slower.</p>
</div>
<ol class="children">
<li id="comment-344445" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-25T17:55:35+00:00">August 25, 2018 at 5:55 pm</time></a> </div>
<div class="comment-content">
<p>Finding the distinguishing bit in little-endian int&rsquo;s is about 3 instructions:</p>
<p><code>z = x^y<br/>
bool x_is_greater = x &amp; (z ^ z - 1)<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-344480" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T03:15:16+00:00">August 26, 2018 at 3:15 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think it works.</p>
<p>z ^ (z &#8211; 1) sets all bits up to the lowest set bit, so the whole thing returns &ldquo;does x have any bits set from bit 0 through the lowest bit that differs with y&rdquo;? which is clearly wrong. As an example, x = 1, y = 2:</p>
<p>z = 3<br/>
z ^ (z-1) = 1<br/>
x &amp; (z ^ (z-1)) = 1</p>
<p>So you get the wrong answer (x is not greater in the only byte x and y differ).</p>
<p>Maybe you wanted something like (z &amp; -z) which <em>isolates</em> the lowest set bit, then you can do your &amp; to see which of x or y had the differing bit set. It still doesn&rsquo;t work: you want to look at the top bit in the differing byte.</p>
<p>That&rsquo;s the problem with all the bit-tricks: there are two totally different directions you need to look: first you need to scan from the LSB(yte) to the MSB to find the lowest differing byte, but then you need to scan in the opposite direction within that byte from MSB(bit) to LSB(it) to find the distinguishing bit.</p>
<p>Since most bit tricks don&rsquo;t do anything special wrt bytes, this is hard, and why bswap is used. You can probably still do it, maybe along the line of the strlen bithack that finds a zero byte, but I don&rsquo;t think it will be 3 instructions.</p>
<p>It&rsquo;s a shame bswap is 2 uops for 64-bit values on Intel, otherwise the bswap approach would be just 3 uops (2 bswap, subtract). On Zen, it&rsquo;s one op and you can do 4 per cycle! Even better on Zen you can do MOVBE from memory in a single op, versus 3 on Intel.</p>
</div>
<ol class="children">
<li id="comment-344505" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T05:55:52+00:00">August 26, 2018 at 5:55 am</time></a> </div>
<div class="comment-content">
<p>With significance reversed, 1 &gt; 2.</p>
</div>
<ol class="children">
<li id="comment-344507" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T06:09:44+00:00">August 26, 2018 at 6:09 am</time></a> </div>
<div class="comment-content">
<p>I see &#8211; bytewise, significance is the same.</p>
</div>
<ol class="children">
<li id="comment-344623" class="comment odd alt depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T16:05:53+00:00">August 26, 2018 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>Yes that&rsquo;s the problem. Note that even ignoring that issue, the original code didn&rsquo;t return a meaningful result: it returns true for aost any two values. It returns true for 1,3 and it also returns true for 3,1!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-344630" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T16:36:07+00:00">August 26, 2018 at 4:36 pm</time></a> </div>
<div class="comment-content">
<p>Yup, I didn&rsquo;t see a better alternative to bswap when I looked into this a few months ago, either. Just make sure to only bswap after you&rsquo;ve found the unequal words; the standard library implementation I saw made the mistake of bswapping before the equality check.</p>
</div>
<ol class="children">
<li id="comment-344631" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T16:44:10+00:00">August 26, 2018 at 4:44 pm</time></a> </div>
<div class="comment-content">
<p>Yeah I saw that too. On modern Intel it&rsquo;s definitely better to do the bswap in the finishing up code, but one could argue that on AMD Zen you could do two MOVBE every iteration for free in place of regular mov, since it is only only uop so about the same cost as a plain load &ldquo;in principle&rdquo; (I haven&rsquo;t tested it). Hopefully Intel will up their BSWAP game in the future.</p>
<p>A big limitation of bswap is that it doesn&rsquo;t obviously place nice with vectorised comparison loops, since the differing word is greater than 64-bits. Some movmaskb and trailing zero count can give you the different byte and you can load it alone and you can do the subtraction. Reasonable throughput but bad latency. I guess you could do the comparison in the vector domain, too.</p>
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
<li id="comment-343964" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-22T23:55:51+00:00">August 22, 2018 at 11:55 pm</time></a> </div>
<div class="comment-content">
<p>Coincidentally I corresponded with Derrick on another possible optimization at the beginning of the year which ran into similar issues with memcmp.</p>
<p>I tried doing git index search with Manber and Myers&rsquo;s String Binary Search algorithm, but it turned out that whatever byte comparisons we saved by skipping the longest common prefix were eaten up by using bytewise comparison, since we couldn&rsquo;t use memcmp to get LCP.</p>
<p>My recollection is that memcmp is heavily tuned, with versions for each length if known at compile time.</p>
</div>
</li>
<li id="comment-343977" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T03:39:37+00:00">August 23, 2018 at 3:39 am</time></a> </div>
<div class="comment-content">
<p>The poor performance of memcmp here has more or less nothing to do with &ldquo;lexicographic comparison&rdquo; and almost everything to do with the fact that memcmp doens&rsquo;t get inline so (a) has to do a function call through the PLT and then has to (b) implement a totally generic algorithm without the benefit of knowing that the string has a fixed length.</p>
<p>That&rsquo;s apples and oranges!</p>
<p>Lexicographic comparison does have some cost, but it is quite small and, importantly is a fixed cost per call: the guts of a typical memcmp does an search for non-equal bytes and then subtracts the non-equal bytes to get the required ternary result. An equality-only memcmp is nearly exactly the same.</p>
</div>
<ol class="children">
<li id="comment-343992" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T05:46:58+00:00">August 23, 2018 at 5:46 am</time></a> </div>
<div class="comment-content">
<p>Also in this case, a fast path optimization of comparing first word of the hash values (?) and going to slow path only if they match would skip a lot of potential generic logic inside memcmp.</p>
</div>
</li>
<li id="comment-344005" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T07:52:21+00:00">August 23, 2018 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>I think reasonably up-to-date glibc source for amd64 generic memcmp can be found at <a href="https://sourceware.org/git/?p=glibc.git;a=blob;f=sysdeps/x86_64/memcmp.S;h=d5c072c7f4972e53b86086b1c916fcef862efa34;hb=07253fcf7b03535b26c81ee216d284ed7f1e250b" rel="nofollow">Sourceware repo</a>. By looking at that code it is pretty obvious that generic memcmp is pretty slow for many inputs. For instance deciding that buffers shorter than 32 bytes differ on the first byte take 19 assembler instructions to execute, and more than 32 bytes requires more even on the best case! Good statically generated fast path (which compilers at godbolt.org don&rsquo;t really seem to generate that eagerly) would be a well-behaving three-instruction sequence&#8230;</p>
</div>
<ol class="children">
<li id="comment-344050" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T14:45:04+00:00">August 23, 2018 at 2:45 pm</time></a> </div>
<div class="comment-content">
<p>The trick is to ask for memcmp(..,20) == 0 &#8212; it will generate wordwise compares inline instead of looking for the distinguishing prefix.</p>
<p>Unfortunately I don&rsquo;t know how this relates to the code you linked &#8212; does that hidden builtin macro help with the inlining, or is there some other code generation going on (in gcc)?</p>
</div>
<ol class="children">
<li id="comment-344051" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T15:01:49+00:00">August 23, 2018 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>At least on gcc, this doesn&rsquo;t seem to be true. All the gcc versions from about 4.6 onwards I checked on x86 seem to <em>always</em> generate an actual call to memcmp (and before 4.6 they did inline code but did a bad job of it, even with static lengths and when comparing to zero &#8211; they always used rep cmp type stuff rather than just a few explicit loads).</p>
<p>Perhaps this is as a consequence of <a href="https://gcc.gnu.org/bugzilla/show_bug.cgi?id=43052" rel="nofollow">this bug</a> where someone claims &ldquo;library memcmp is really fast, just always call the function&rdquo; where this is plainly not true for small fixed lengths. I&rsquo;m kind of surprised gcc fails badly here: it does much better on inlining fixed length memcpy for example (and Daniel&rsquo;s code relies on that by doing several 8-byte memcpy that just get transformed into single 64-bit loads by the compiler).</p>
<p>clang does better: if I compile the benchmark with clang 5.0, the results reverse: I get that memcmp is faster than memeq20. Note that this test is a bit specific in that the compared strings are randomly generated, so 99.6%+ of the time they will differ at the first byte, so it is really testing the fast path how the first byte or word or whatever is handled.</p>
<p>The clang generated code isn&rsquo;t all that great either, but it gets some things right: if you compare against 0, it removes both the special final logic to calculate the ternary result, and also bswap calls in the loop relating to the ternary result (but the bswap calls arguably shouldn&rsquo;t have been in the loop in the first place).</p>
</div>
<ol class="children">
<li id="comment-344055" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T15:14:48+00:00">August 23, 2018 at 3:14 pm</time></a> </div>
<div class="comment-content">
<p>Two nicely aligned fixed-size buffers in a struct and a fixed comparison length of 64 bytes resulted rather interesting code: it started for gcc with two 64-bit reads from both buffers, XORing corresponding pairs and testing those results with OR. Well, that&rsquo;s correct and reasonably efficient start (unless you use AVX, which clang would use if architecture is specified correctly), but in the case of hashes that usually differ, just comparing leading words &#8211; or probably even bytes, to avoid misalignment penalties &#8211; would have been faster.</p>
<p>So, for specific use cases, hand-written comparison routine beats those reasonably good compiler-generated variants. It&rsquo;s hard to tell to the compiler that bits on buffers are random and different 99% of the time, but 1% of the time probably all of them match between them! (If this would be the opposite, it would probably be beneficial to write a XOR-OR chain without any conditional branches, at least for reasonably short inputs.)</p>
</div>
<ol class="children">
<li id="comment-344057" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T15:23:50+00:00">August 23, 2018 at 3:23 pm</time></a> </div>
<div class="comment-content">
<p>Is the code you wrote for memcmp or bcmp though? That is, does it return a 3-way or 2-way (boolean) result? How did you do the 3-way part if three way?</p>
<p>I agree that in this test the first word will almost always differ (always if its 64-bits) so the key is make the fastest possible code for that case. For clang, this means that comparing 24 bytes is actually faster than 16, since doing the &ldquo;odd&rdquo; word before vectorizing happens to line up with the fast path you&rsquo;d want. See <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/issues/21#issuecomment-415456602" rel="nofollow">my comment here</a>.</p>
</div>
<ol class="children">
<li id="comment-344059" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T15:36:09+00:00">August 23, 2018 at 3:36 pm</time></a> </div>
<div class="comment-content">
<p>This is a bit artificial, but nonetheless, it seems to show different approaches (and failures) by different compilers: <a href="https://godbolt.org/z/kdQf7n" rel="nofollow">godbolt.org code</a>.</p>
</div>
<ol class="children">
<li id="comment-344064" class="comment odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T16:34:15+00:00">August 23, 2018 at 4:34 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s really interesting. It seems like I was (somewhat) incorrectly slandering gcc&rsquo;s ability to inline constant length memcmp() as your example shows.</p>
<p>Luckily struct isn&rsquo;t necessary: it works for plain pointers too. The key seems to be that the result has to be used non-lexicographically: if the calling code differentiates between the &lt; 0 and &gt; 0 cases, it will call memcmp. So this reinforces the idea of this blog post in a way: but partly due to a quirk of gcc: it also implies that the original code that saw the slowdown probably would have been fine on a more recent version of gcc.</p>
<p>clang behaves <a href="https://godbolt.org/z/sxSqik" rel="nofollow">somewhat differently</a> &#8211; it can either either style, but with quite different code: it vectorizes the boolean versions, and uses scalar code with movbe for when the full ternary result is used. The clang code seems suboptimal: it could just use plain moves and do the bswap in the tail part, and it should just subtract the differing words rather than the conditional stuff it is doing.</p>
</div>
<ol class="children">
<li id="comment-344065" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T16:35:57+00:00">August 23, 2018 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>Note that this is exactly what KWillets said originally, so my objection was out of line. It does work when you compare memcmp against zero, at least for most recent gcc versions (seems like the inlining started around 7.0 or 7.1).</p>
</div>
<ol class="children">
<li id="comment-344067" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T16:45:37+00:00">August 23, 2018 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>I should credit this stackoverflow: <a href="https://stackoverflow.com/questions/45052282/why-is-memcmpa-b-4-only-sometimes-optimized-to-a-uint32-comparison" rel="nofollow ugc">https://stackoverflow.com/questions/45052282/why-is-memcmpa-b-4-only-sometimes-optimized-to-a-uint32-comparison</a> (I thought I posted a more coherent comment last night with this and the above points, but apparently not).</p>
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
<li id="comment-344066" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T16:39:30+00:00">August 23, 2018 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, I wrote a bunch of memequal_k() template specializations to get around some of the fixed-length small cases clang wasn&rsquo;t handling so well, along with a replacement memequal() function; you can see my code at <a href="https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_base.h#L2332" rel="nofollow ugc">https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_base.h#L2332</a> and <a href="https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_base.cc#L1701" rel="nofollow ugc">https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_base.cc#L1701</a> .</p>
</div>
</li>
</ol>
</li>
<li id="comment-344053" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T15:03:20+00:00">August 23, 2018 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>To clarify, the code that foobar linked is an assembly code (.S) file that is used to generate the library version of the memcmp call. It isn&rsquo;t used by the compiler as a &ldquo;builtin&rdquo; or anything to inline memcmp.</p>
</div>
<ol class="children">
<li id="comment-344070" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T17:19:27+00:00">August 23, 2018 at 5:19 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve chased it down in gcc to __builtin_memcmp_eq, which is ironically best described in a golang issue: <a href="https://github.com/golang/go/issues/21618" rel="nofollow ugc">https://github.com/golang/go/issues/21618</a> .</p>
<p>It&rsquo;s a tight fit to the situation we see here: constant length, with equality or inequality to 0 instead of the ternary result.</p>
</div>
<ol class="children">
<li id="comment-344073" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T18:17:19+00:00">August 23, 2018 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>So the way gcc (and maybe clang) handles this is specifically by recognizing memcmp and checking whether a only a 2-way result is needed and then essentially replacing it with a memcmp_eq call.</p>
<p>So it&rsquo;s hardcoded with knowledge of the semantics of memcmp. This raises the interesting question of if you wrote a function like memcmp, whether the generic optimizer could do this same optimization &#8211; this is a harder problem since it has to recognize that the output of your memcmp function is compared to zero and eliminate code that differentiates between &lt; 0 and &gt; 0.</p>
<p><a href="https://godbolt.org/z/JYV2ax" rel="nofollow">Here is a test.</a></p>
<p>There are three variants of memcmp{0,1,2} which vary only in the return statement when a difference is found.</p>
<p>memcmp0 is the normal way you&rsquo;d write it: simply bswaps the mismatched words, and subtracts them.</p>
<p>memcmp1 is the same, but it adds a __builtin_unreachable &ldquo;assertion&rdquo; that ret is non-zero (we know this is true, since if a != b, bswap(a) != bswap(b), but maybe the compiler needs help).</p>
<p>memcmp2 returns <code>(bswap(a) - bswap(b)) | 1</code> which doesn&rsquo;t change the sign of the answer, but is another way to help compiler know the answer is non-zero.</p>
<p>Then we call each of these functions in my_bcmp{0,1,2} which returns a bool rather than int, and see what happens.</p>
<p>The score was gcc 2, clang 1, MSVC 0 (it is hopeless here: it doesn&rsquo;t even inline bswap). Nobody could optimize the memcmp0 case: they all left the bswap calls in and compared the result. gcc was able to optimize either of the other two cases, and clang only memcmp2 <code>| 1</code>. When the optimization worked, it could generate exactly or almost exactly the same code as the explicit bcmp code. Cool.</p>
<p>Note that the <code>| 1</code> version isn&rsquo;t free: when you actually use the 3-way result, you get a useless extra or instruction in the result path.</p>
</div>
<ol class="children">
<li id="comment-344074" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T18:26:31+00:00">August 23, 2018 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>The optimization that allows is called &ldquo;range analysis&rdquo; or something like that: where the compiler keeps track of what it knows about a variable, such as what bits are set, where it is definitely zero or non-zero, or the possible range of values.</p>
<p>It&rsquo;s the bswap here that &ldquo;breaks&rdquo; range analysis from working in the plain memcmp0 case: the compiler knows that <code>left != right</code>, and it knows that implies <code>left - right != 0</code>, but it doesn&rsquo;t know that it equally implies <code>bswap(left) - bswap(right) != 0</code>. If you take out the bswap, both gcc and clang are able to optimize my_bcmp0.</p>
<p>Evidently neither compiler has a</p>
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
<li id="comment-344243" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T20:13:22+00:00">August 24, 2018 at 8:13 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>An equality-only memcmp is nearly exactly the same.</p>
</blockquote>
<p>I think that my tests, and yours, show that there is a difference, at least as far as some compilers and data distributions are concerned. An equality comparison is an easier problem (for the compiler, for the programmer, for the hardware).</p>
<p>The difference might be small, for some definition of small which goes down to zero in some cases. But a small difference multiplied by enough cases ends up making a difference.</p>
<p>To prove me wrong, someone simply has to propose a piece of lexicographical comparison C code that consistently beats an optimized equality comparison, across a wide range of compilers and data distribution. If someone has that, then I will gladly retract my blog post.</p>
</div>
<ol class="children">
<li id="comment-344486" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-26T03:58:58+00:00">August 26, 2018 at 3:58 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
I think that my tests, &#8230; show that there is a difference, at least<br/>
as far as some compilers and data distributions are concerned.
</p></blockquote>
<p>Not at all. They show that gcc is deciding to call library memcmp through the PLT boundary and that a totally generic library call that doesn&rsquo;t know the fixed length length of the comparison does terribly against an inlined function written for a hardcoded length.</p>
<p>If you flip the situation around, and write an inlined lexicographic compare and call a library generic memeq function (bcmp could do) the results will approximate reverse themselves.</p>
<p>Yes, lexicographic comparison is somewhat more difficult than plain equality comparison, but this test doesn&rsquo;t show that at all except by coincidence.</p>
<blockquote><p>
To prove me wrong, someone simply has to propose a piece of<br/>
lexicographical comparison C code that consistently beats an optimized<br/>
equality comparison, across a wide range of compilers and data<br/>
distribution. If someone has that, then I will gladly retract my blog<br/>
post.
</p></blockquote>
<p>This is also wrong.</p>
<p>No one that I can see is claiming that lexicographic comparison is <em>faster</em> than plain equality comparison (outside of implementation quality), and it is fairly obvious that if you had a super fast lexicographic comparison you can turn it a super fast equality comparison for with approximately zero work, so lexicographic comparison is never really going to be faster.</p>
<p>Your claim here is that equality search is faster than lexicographic search when only equality is needed. The negation of that is that equality search is slower or <strong>equal to</strong> lexicographic search. We can toss out the slower part, but all someone has to do to prove you wrong is hit the bar for &ldquo;equals&rdquo;.</p>
<p>You might not get to exactly equals, and the data distribution really matters here, but it will be close and much closer than your misleading test suggests.</p>
<p>There is also the little issue of the interface between the 3-way result and the ultimate use as a 2-way result: clearly if you needed a 3-way result in the first place, there is no comparison: you need to use a 3-way function like memcmp. The motivating example, however, only needed a 2-way result and that was expressed in the source as <code>!memcmp()</code> so that information is available to the compiler, and indeed better compilers than the one git was using at the time can use this info to produce better code.</p>
<p>Your test stores all the results into an array and actually uses the 3-wayness of the result so that will never happen in this case, but it isn&rsquo;t clear if that a more likely scenario than <code>memcmp() == 0</code> type scenarios.</p>
<p>IMO when an error is pointed out in the test methodology, you should correct it rather than demanding that someone else write the code that perhaps you should have written in the first place!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-343991" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T05:44:43+00:00">August 23, 2018 at 5:44 am</time></a> </div>
<div class="comment-content">
<p>This <a href="https://stackoverflow.com/questions/45052282/why-is-memcmpa-b-4-only-sometimes-optimized-to-a-uint32-comparison" rel="nofollow">stackoverflow</a> shows memcmp is inlined to word comparisons for the expression memcmp() == 0. For length 20 it does two 8-byte and one 4-byte xor: <a href="https://godbolt.org/z/GuqNxJ" rel="nofollow ugc">https://godbolt.org/z/GuqNxJ</a> .</p>
</div>
</li>
<li id="comment-344039" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bf3338d46ae2e3a507dc10314cd74a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bf3338d46ae2e3a507dc10314cd74a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Santos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T12:40:16+00:00">August 23, 2018 at 12:40 pm</time></a> </div>
<div class="comment-content">
<p>Why does your memeq20 function copy the data and do the comparison on the copies? You aren&rsquo;t modifying the data, so why not just compare it in place?</p>
<p>â€¦<br/>
uint64_t * w1 = (uint64_t <em>)s1;<br/>
uint64_t * w2 = (uint64_t *)s2;<br/>
bool answer1 = (w1[0] == w2[0]);<br/>
bool answer2 = (w1[1] == w2[1]);<br/>
uint32_t * ww1 = (uint32_t *)(s1 + sizeof(uint64_t) * 2);<br/>
uint32_t * ww2 = (uint32_t *)(s2 + sizeof(uint64_t) * 2);<br/>
bool answer3 = (</em>ww1 == *ww2);<br/>
â€¦</p>
<p>Or something like that.</p>
</div>
<ol class="children">
<li id="comment-344231" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T18:44:14+00:00">August 24, 2018 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>The code you are proposing is probably relying on undefined behaviours. It is unsafe.</p>
</div>
</li>
</ol>
</li>
<li id="comment-344047" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d541b0d2e3837f334c847d634621490?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d541b0d2e3837f334c847d634621490?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michel Lemay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T14:21:50+00:00">August 23, 2018 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>I was wondering why you were using memcpy instead of a simple pointer arithmetic. With pointer arithmetic, you can get the benefit simpler code and the possibility to get a small speedup if checking previous answer.</p>
</div>
<ol class="children">
<li id="comment-344054" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-23T15:07:48+00:00">August 23, 2018 at 3:07 pm</time></a> </div>
<div class="comment-content">
<p>To make the code legal C. Although it works in practice, it is not legal to access an array of one type (char *) with a pointer to another type (uint64_t *), except in special circumstances.</p>
<p>Yes, this is fine in assembly, but C is not assembly (although in practice current compilers often generates the assembly you expect &#8211; but who knows about tomorrow!).</p>
<p>It doesn&rsquo;t cause a problem here beacuse the memcpy is transformed back into a plain load by <a href="https://godbolt.org/z/8qpAT2" rel="nofollow">most compilers</a>.</p>
</div>
</li>
<li id="comment-344230" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-08-24T18:43:42+00:00">August 24, 2018 at 6:43 pm</time></a> </div>
<div class="comment-content">
<p>Your compiler optimizes away the memcpy. Without it, you risk undefined behaviours.</p>
</div>
</li>
</ol>
</li>
</ol>
