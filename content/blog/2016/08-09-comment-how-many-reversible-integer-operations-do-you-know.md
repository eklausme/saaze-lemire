---
date: "2016-08-09 12:00:00"
title: "How many reversible integer operations do you know?"
index: false
---

[32 thoughts on &ldquo;How many reversible integer operations do you know?&rdquo;](/lemire/blog/2016/08-09-how-many-reversible-integer-operations-do-you-know)

<ol class="comment-list">
<li id="comment-249247" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T14:35:12+00:00">August 9, 2016 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>Is the x86-64 CRC instruction reversible on 32-bit unsigned integers?</p>
</div>
<ol class="children">
<li id="comment-249248" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T14:43:07+00:00">August 9, 2016 at 2:43 pm</time></a> </div>
<div class="comment-content">
<p>Good question. I suspect that it is equivalent to a 32-bit carryless multiplication with 0x1edc6f41, an invertible transformation. There is also a bit reversal (bit reflection), also invertible.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249251" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07ccced1b159992d0fb0eea4fb84fde2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07ccced1b159992d0fb0eea4fb84fde2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Snobby</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T15:10:16+00:00">August 9, 2016 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>aesenc</p>
</div>
<ol class="children">
<li id="comment-652221" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a65e681b007efd642284f49cc7f28af8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a65e681b007efd642284f49cc7f28af8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rich Geldreich</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-08T21:19:04+00:00">June 8, 2023 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>Exactly- it must be invertible, or you couldn&rsquo;t decrypt. It&rsquo;s also incredibly fast.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249263" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c89933210805ce89e2df1f56ac38e55?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c89933210805ce89e2df1f56ac38e55?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cecil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T16:00:24+00:00">August 9, 2016 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>Hrm. </p>
<p>How many of these operations are reversible for all integer inputs?</p>
<p>I&rsquo;d definitely not consider shifts reversible. I&rsquo;d probably not even consider addition/subtraction reversible as they aren&rsquo;t reversible for all inputs. They&rsquo;re &ldquo;sometimes reversible&rdquo; but not &ldquo;always reversible&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-249269" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T16:38:57+00:00">August 9, 2016 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>They are always invertible, for all integer inputs. There are programming-language issues that may interfere, such as undefined behaviors under overflow for signed integers, but they are technical issues.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249271" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/61b37304c7ed74039a1489c855cee69f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/61b37304c7ed74039a1489c855cee69f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonathan Graehl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T17:02:05+00:00">August 9, 2016 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>Encryption is reversible, although often an IV or other padding are added. Do you think most encryption methods, or at least those that don&rsquo;t require any more bits for the encrypted output, can be implemented using only the &lsquo;primitives&rsquo; you listed?</p>
</div>
<ol class="children">
<li id="comment-249281" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T20:17:52+00:00">August 9, 2016 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p>I would be very interested in knowing whether some encryption techniques use primitives we did not include.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249274" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Tweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T17:54:18+00:00">August 9, 2016 at 5:54 pm</time></a> </div>
<div class="comment-content">
<p>I guess you&rsquo;re looking for operations which (maybe holding some arguments fixed) take an intX_t to an intX_t (not a larger type)?</p>
</div>
<ol class="children">
<li id="comment-249282" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T20:20:08+00:00">August 9, 2016 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>Right. If you are allowed to generate larger types, then it is a bit too easy.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249289" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-09T23:21:47+00:00">August 9, 2016 at 11:21 pm</time></a> </div>
<div class="comment-content">
<p>Taking the int to be a vector over Z_2, multiplication by a square non-singular matrix over Z_2.</p>
</div>
</li>
<li id="comment-249320" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-10T11:08:00+00:00">August 10, 2016 at 11:08 am</time></a> </div>
<div class="comment-content">
<p>How many?<br/>
Zero, I don&rsquo;t give a sh*t&#8230;</p>
</div>
</li>
<li id="comment-249362" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-11T06:31:32+00:00">August 11, 2016 at 6:31 am</time></a> </div>
<div class="comment-content">
<p>A function mapping from {1, &#8230;, 2^n} to {1, &#8230;, 2^n} is reversible if and only if it is a one-to-one mapping. Any such mapping f(x) can be represented by the sequence (f(1), â€¦, f(2^n)). There are (2^n)! such one-to-one sequences. That is, the reversible functions are simply permutations (shufflings) of the numbers from 1 to 2^n. For example, if n = 2, there are (2^2)! = 4! = 24 reversible functions. </p>
<p>How many reversible operations do we know? For 32 bit integers, we know (2^32)! reversible operations. </p>
<p>I guess what you really want to know is, how many of these reversible operations are easy to define? I suppose circuit complexity might be the natural way to define &ldquo;easy&rdquo; reversible functions (<a href="https://en.wikipedia.org/wiki/Circuit_complexity" rel="nofollow ugc">https://en.wikipedia.org/wiki/Circuit_complexity</a>). If you specify a precise measure of circuit complexity and set a threshold on circuit complexity, there would be an exact answer to the question of how many of the (2^32)! reversible functions have a complexity below the given threshold. However, calculating the exact answer is likely to be very time consuming.</p>
<p>This seems like a rather easy question. Did I miss something? All of these (2^32)! functions could be defined with NOR.</p>
</div>
<ol class="children">
<li id="comment-249382" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-11T13:02:23+00:00">August 11, 2016 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>As you point out, there are 2^64 ! permutations on 64-bit words, and that&rsquo;s about 2^64^{2^64} permutations. To identify one of them, I need about 2^{70} bits. We are talking about exabytes. So it is not practical to address reversible functions as an element of the set of all permutations.</p>
<p>I submit to you that this set might as well be infinite.</p>
<p>In practical software, we see a tiny fraction of all these reversible functions. The question is which ones do we commonly see?</p>
</div>
</li>
</ol>
</li>
<li id="comment-249475" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T02:55:27+00:00">August 12, 2016 at 2:55 am</time></a> </div>
<div class="comment-content">
<p>What motivates this question? Why is this interesting? Are you trying to reduce energy consumption below the von Neumann-Landauer limit?</p>
<p><a href="https://en.wikipedia.org/wiki/Reversible_computing" rel="nofollow ugc">https://en.wikipedia.org/wiki/Reversible_computing</a></p>
</div>
<ol class="children">
<li id="comment-249523" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T13:16:40+00:00">August 12, 2016 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>If I asked a programmer to write a reversible function over machine words&#8230; I&rsquo;d get examples from the above blog post&#8230; plus, maybe, some minor variations. There are only so many ways to write reversible functions in software today. This comes from the fact that we work with a fairly limited set of operations.</p>
<p>Some of them are not immediately obvious. For example, XORing an odd number of rotations is invertible&#8230; but not an even number.</p>
<p>Why would anyone care about this? Well&#8230; these are used all over&#8230; to generate random numbers, to hash numbers and so forth.</p>
</div>
</li>
</ol>
</li>
<li id="comment-249500" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aabb1d1d68a2d1b8229fb94b44850950?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aabb1d1d68a2d1b8229fb94b44850950?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">toa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T06:11:33+00:00">August 12, 2016 at 6:11 am</time></a> </div>
<div class="comment-content">
<p>Bitwise not ~</p>
</div>
<ol class="children">
<li id="comment-249527" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">harold</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T13:41:54+00:00">August 12, 2016 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s just an instance of XOR with a constant</p>
</div>
</li>
</ol>
</li>
<li id="comment-249503" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c194a3e73c25a5e21766ce020b57a5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c194a3e73c25a5e21766ce020b57a5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mr Pedant</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T07:06:27+00:00">August 12, 2016 at 7:06 am</time></a> </div>
<div class="comment-content">
<p>Rotate needs a tweak: (x &gt;&gt;&gt; (32-b)) | ( x &lt;&lt; b)</p>
</div>
<ol class="children">
<li id="comment-249524" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T13:21:34+00:00">August 12, 2016 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>Mr Pedant: Care to explain? </p>
<p>If you are working with ints in Java, then <tt>(x >>> (32-b)) | ( x << b)</tt> is strictly equivalent to <tt>(x >>> (-b)) | ( x << b)</tt>. For longs, you have that <tt>(x >>> (64-b)) | ( x << b)</tt> is strictly equivalent to <tt>(x >>> (-b)) | ( x << b)</tt>. So, the better form is <tt>(x >>> (-b)) | ( x << b)</tt> because it works the same no matter which words you are using.</p>
<p>In C, it is a different matter because it has undefined behaviors. Java does not.</p>
</div>
<ol class="children">
<li id="comment-249562" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c194a3e73c25a5e21766ce020b57a5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c194a3e73c25a5e21766ce020b57a5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mr Pedant</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T22:03:07+00:00">August 12, 2016 at 10:03 pm</time></a> </div>
<div class="comment-content">
<p>Oops, my mistake, you are correct.<br/>
TIL In Java, the &gt;&gt;&gt; operator masks the shift amount by 31.</p>
</div>
<ol class="children">
<li id="comment-249564" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T22:27:36+00:00">August 12, 2016 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>It virtually masks the shift, yes. In reality, at least on an Intel processor, there is no shift needed since the machine instruction only uses the least significant bits during a shift. </p>
<p>It is not just Java. Go, JavaScript&#8230; also work the same way.</p>
</div>
<ol class="children">
<li id="comment-249601" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c194a3e73c25a5e21766ce020b57a5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c194a3e73c25a5e21766ce020b57a5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mr Pedant</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-13T11:45:36+00:00">August 13, 2016 at 11:45 am</time></a> </div>
<div class="comment-content">
<p>Oh sure, I&rsquo;m familiar with the x86 assembly opcodes SAR and SHR. It&rsquo;s just surprising to see that limitation of a particular CPU reflected in a high level language.</p>
<p>My assumption was that in a high level language ((x &gt;&gt;&gt; a) &gt;&gt;&gt; b) === (x &gt;&gt;&gt; (a+b))</p>
<p>And indeed, in python that is the case:<br/>
python -c &ldquo;print (2**65537)&gt;&gt;65536&rdquo; # == 2</p>
<p>&lsquo;Go&rsquo; seems to work the same<br/>
fmt.Println(7 &gt;&gt; 65536) // == 0<br/>
Source: <a href="https://golang.org/ref/spec" rel="nofollow ugc">https://golang.org/ref/spec</a> <a href="https://golang.org" rel="nofollow ugc">https://golang.org</a></p>
<p>Java/Javascript OTOH? My mistake&#8230; TIL.</p>
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
<li id="comment-249534" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/182d0ce855c8324a596648c04643e8f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">harold</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-12T15:37:59+00:00">August 12, 2016 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>Here are a couple of odd ones, based on TBM. x + c * (x &amp; -x) with an even c, which is invertible because it doesn&rsquo;t change what x&amp;-x is so the same amount can be subtracted again. Of course the addition can be replaced with XOR. Here&rsquo;s &ldquo;proof&rdquo; (not really, but I believe the bot) for c=2, <a href="http://haroldbot.nl/?q=let+c+%3D+2%2C+y+%3D+x+%2B+c+*+%28x+%26+-x%29+in+y+-+c+*+%28y+%26+-y%29" rel="nofollow ugc">http://haroldbot.nl/?q=let+c+%3D+2%2C+y+%3D+x+%2B+c+*+%28x+%26+-x%29+in+y+-+c+*+%28y+%26+-y%29</a> (dev version can handle unbound c)</p>
<p>x + c * ((x ^ (x + 1)) + 1) seems to work for any c (if I believe the bot), for a similar reason.</p>
<p>I can&rsquo;t think of a use for them, but I found them interesting because they don&rsquo;t just add a constant, but something that can be recovered.</p>
</div>
</li>
<li id="comment-250781" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/62aaaf6dfc5c0fd3c037fa9fb106c677?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc Reynolds</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-08-26T12:08:52+00:00">August 26, 2016 at 12:08 pm</time></a> </div>
<div class="comment-content">
<p>Seems worth explicitly noting that the inverse of multiply by odd K is the product by its modulo inverse. </p>
<p>I wonder if there is there any accessible coverage of bijections as properties of F_2 matrices.</p>
</div>
</li>
<li id="comment-264246" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b1c230af87044cc435069d076ce51f7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jim Apple</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-31T03:21:28+00:00">December 31, 2016 at 3:21 am</time></a> </div>
<div class="comment-content">
<p>Feistel permutations, as used in &ldquo;Backyard Cuckoo Hashing: Constant Worst-Case Operations with a Succinct Representation&rdquo;: <a href="https://arxiv.org/abs/0912.5424" rel="nofollow ugc">https://arxiv.org/abs/0912.5424</a></p>
</div>
</li>
<li id="comment-288699" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efe792134855f2c7878862f838b7db2e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efe792134855f2c7878862f838b7db2e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T12:37:40+00:00">October 12, 2017 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>What is the inverse of x+ (x&lt;&lt;a)?</p>
</div>
<ol class="children">
<li id="comment-288706" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T14:33:08+00:00">October 12, 2017 at 2:33 pm</time></a> </div>
<div class="comment-content">
<p>We have that <tt>x + (x << a)</tt> is <tt>(1 + (1<<a)) x< tt>. That is, we have a multiplication by an odd integer. Multiplication by an odd integer is an invertible operation modulo a power of two. Please see this follow-up post for details: <a href="https://lemire.me/blog/2017/09/18/computing-the-inverse-of-odd-integers/" rel="ugc">https://lemire.me/blog/2017/09/18/computing-the-inverse-of-odd-integers/</a></p>
</div>
<ol class="children">
<li id="comment-288711" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/efe792134855f2c7878862f838b7db2e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/efe792134855f2c7878862f838b7db2e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T16:37:03+00:00">October 12, 2017 at 4:37 pm</time></a> </div>
<div class="comment-content">
<p>Thank You</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-585428" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e4cc2e74750690b2ce9f971b50f5450?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e4cc2e74750690b2ce9f971b50f5450?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/tommyettinger" class="url" rel="ugc external nofollow">Tommy Ettinger</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T08:18:28+00:00">May 29, 2021 at 8:18 am</time></a> </div>
<div class="comment-content">
<p>As presented, the signed-shift-based rotation isn&rsquo;t reversible, but a similar one is, and I&rsquo;m guessing there was just a transcription error.<br/>
<code>(x &gt;&gt; b) | (x &lt;&lt; (-b))</code> produces <code>-1</code> whenever <code>b == -1</code> (or 63 for Java <code>long</code>, 31 for Java <code>int</code>) and <code>x</code> is any negative number. But, <code>(x &lt;&lt; b) ^ (x &gt;&gt; (-b))</code> is reversible (using XOR instead of OR, and also using the structure of a left rotation, so let&rsquo;s call this a signed-left-rotation). If you take the result <code>r</code> of an earlier signed-left-rotation and you know the rotation amount <code>b</code>, then <code>long n = (r &gt;&gt;&gt; b) | (r &lt;&lt; b); n ^= ((n &gt;&gt; -1) &gt;&gt;&gt; b);</code> will have <code>n == x</code> for, as far as I can tell, any <code>x</code>. This starts to reverse the signed-left-rotation using a typical right-rotation, then if that is a negative number, it flips the lowest <code>b</code> bits, which completes the reversal. If I&rsquo;m wrong on any of this, please let me know! There could easily be a cleaner way to do this but I don&rsquo;t know what it would be.</p>
</div>
</li>
<li id="comment-585431" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e4cc2e74750690b2ce9f971b50f5450?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e4cc2e74750690b2ce9f971b50f5450?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/tommyettinger" class="url" rel="ugc external nofollow">Tommy Ettinger</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T09:01:16+00:00">May 29, 2021 at 9:01 am</time></a> </div>
<div class="comment-content">
<p>Oops, reversal code should be <code>long n = (r &gt;&gt;&gt; b) | (r &lt;&lt; -b); n ^= ((n &gt;&gt; -1) &gt;&gt;&gt; b);</code> . There&rsquo;s my own transcription error; I had used <code>Long.rotateRight(r, b)</code> in my test code.</p>
</div>
</li>
<li id="comment-585474" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e4cc2e74750690b2ce9f971b50f5450?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e4cc2e74750690b2ce9f971b50f5450?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/tommyettinger" class="url" rel="ugc external nofollow">Tommy Ettinger</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-29T21:14:53+00:00">May 29, 2021 at 9:14 pm</time></a> </div>
<div class="comment-content">
<p>I should also mention that, like xor-shift, a xor-based rotation can&rsquo;t use a rotation amount of 0 (after modulo by the number of bits in type). One way around this is to special-case rotations by 0, and their reversals (Java code): <code>long signedLeftRotate(long x, int b) { return (x &lt;&lt; b) ^ (x &gt;&gt; (-b)) | (x &amp; (~((-(b &amp; 63)) &gt;&gt; -1))); }</code> and <code>long reverseSignedLeftRotate(long x, int b) { long n = (x &gt;&gt;&gt; b) | (x &lt;&lt; (-b)); return n ^ (((n &gt;&gt; -1) &gt;&gt;&gt; b) &amp; ((-(b &amp; 63)) &gt;&gt; -1)); }</code><br/>
These return <code>x</code> if <code>b</code> is 0, but they&rsquo;re a substantial amount of extra operations to avoid a possible branch.</p>
</div>
</li>
</ol>
