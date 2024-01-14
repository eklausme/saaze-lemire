---
date: "2017-09-08 12:00:00"
title: "The Xorshift128+ random number generator fails BigCrush"
index: false
---

[12 thoughts on &ldquo;The Xorshift128+ random number generator fails BigCrush&rdquo;](/lemire/blog/2017/09-08-the-xorshift128-random-number-generator-fails-bigcrush)

<ol class="comment-list">
<li id="comment-285603" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://richardstartin.com" class="url" rel="ugc external nofollow">Richard Startin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-09T14:21:25+00:00">September 9, 2017 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>Why is so much salience given to the lower bits? This would ignore very obvious patterns in the middle bits. Would patterns in the middle bits matter? Are there tests based on arbitrary byte-wise permutations, or even just turning a number &ldquo;inside out&rdquo; by reversing the higher 32 bits and lower 32 bits?</p>
</div>
</li>
<li id="comment-285611" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e6f329950dbf4672dc56d02976af1539?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e6f329950dbf4672dc56d02976af1539?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Robert Dibley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-09T19:27:55+00:00">September 9, 2017 at 7:27 pm</time></a> </div>
<div class="comment-content">
<p>A number of the very early random number generators had obvious patterns in the low bits while appearing to be random in the upper bits &#8211; several of them would repeat the same last 3 or 4 bits over and over for ever.<br/>
More recent algorithms tend to remove that problem, so it&rsquo;s perhaps not as significant now, but its wise to check everything just in case a problem has been reintroduced.<br/>
For an example of bad random numbers, see if you can find details of the PlayStation 2 hardware random number generator, which generated floating point random numbers in the vector units. This was found to suffer from a very strong pattern, so much so that if you were to take several thousand values, and assign them in groups of three to points in space, you would end up with a series of rotated grid-like layers in space, which could hardly be less random if it tried. Try the same with your current favourite random number generator and see what you get!</p>
</div>
</li>
<li id="comment-287992" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c9957fd89d9d8404d0003302b2d9523f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c9957fd89d9d8404d0003302b2d9523f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jack M</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-04T13:38:29+00:00">October 4, 2017 at 1:38 pm</time></a> </div>
<div class="comment-content">
<p>The code snippet that you tested for xorshift128+ appears to be taken from this paper here <a href="http://vigna.di.unimi.it/ftp/papers/xorshiftplus.pdf" rel="nofollow ugc">http://vigna.di.unimi.it/ftp/papers/xorshiftplus.pdf</a> .</p>
<p>While the figure annotation implies that this is the exact implementation used, the surrounding paper implies that it only passed BigCrush using different choices for a, b, and c than the ones in that code snippet.</p>
<p>Could you reproduce these results with a=23, b=17, c=26? These are the constants listed as the &ldquo;best&rdquo; in that paper, as well as the constants used by the V8 runtime (<a href="https://v8project.blogspot.se/2015/12/theres-mathrandom-and-then-theres.html" rel="nofollow ugc">https://v8project.blogspot.se/2015/12/theres-mathrandom-and-then-theres.html</a>) and the constants used in the wikipedia example (<a href="https://en.wikipedia.org/wiki/Xorshift#xorshift.2B" rel="nofollow ugc">https://en.wikipedia.org/wiki/Xorshift#xorshift.2B</a>).</p>
</div>
<ol class="children">
<li id="comment-288002" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-04T15:09:23+00:00">October 4, 2017 at 3:09 pm</time></a> </div>
<div class="comment-content">
<p><em>The code snippet that you tested for xorshift128+ appears to be taken from this paper here (&#8230;) </em></p>
<p>I copied and pasted it from the author&rsquo;s web site: <a href="http://xoroshiro.di.unimi.it/xorshift128plus.c" rel="nofollow">http://xoroshiro.di.unimi.it/xorshift128plus.c</a>. But it is also identical to Figure 1 in the peer-reviewed paper with the label <em>The xorshift128+ generator used in the tests</em>.</p>
<p><em>While the figure annotation implies that this is the exact implementation used, the surrounding paper implies that it only passed BigCrush using different choices for a, b, and c than the ones in that code snippet.</em></p>
<p>Vigna specifically recommends the triple (23, 18, 5) that I have tested, and he recommends against the triples you suggest (a=23, b=17, c=26) which appears first in Table 1:</p>
<blockquote><p>Table 4 compares the BigCrush scores of the generators we discussed. For xorshift128+ we used the triple 23, 18, 5 (Figure 1). (&#8230;) Our choice of triples is based not only on the BigCrush scores and on polynomial weight, but also on an additional datum: the result of POP (â€œp-value of p-valuesâ€) tests. (&#8230;) The triples we suggest for xorshift+ do not fail any POP test (&#8230;) but, for example, the first triple listed in Table 1 fails four POP tests.</p></blockquote>
<p>(<a href="http://vigna.di.unimi.it/ftp/papers/xorshiftplus.pdf" rel="nofollow">This is a direct quote from the paper</a>.)</p>
<p><em>Could you reproduce these results with a=23, b=17, c=26? </em></p>
<p>Tests are running. Big Crush takes many hours, but I already have the results from PractRand:</p>
<pre>
testv8xorshift128plus-H.log:  BCFN(2+1,13-0,T)                  R= +28.7  p =  6.9e-15    FAIL !
testv8xorshift128plus.log:  [Low4/64]BRank(12):768(1)         R= +1272  p~=  5.4e-384   FAIL !!!!!!!
</pre>
<p>So we have a failure. You should expect a Big Crush failure (since statistical tests tend to be redundant).</p>
</div>
<ol class="children">
<li id="comment-288166" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-06T19:32:27+00:00">October 6, 2017 at 7:32 pm</time></a> </div>
<div class="comment-content">
<p>So, yes, the failure is confirmed:</p>
<pre>
Summary for v8xorshift128plus lsb 32-bits (bit reverse) (4 crushes):
- #68: MatrixRank, L=1000, r=0: FAIL!! -- p-values too unlikely (eps, eps, eps, eps) -- ALL CRUSHES FAIL!!
- #71: MatrixRank, L=5000: FAIL!! -- p-values too unlikely (eps, eps, eps, eps) -- ALL CRUSHES FAIL!!
- #80: LinearComp, r = 0: FAIL!! -- p-values too unlikely (1 - eps1, 1 - eps1, 1 - eps1, 1 - eps1) -- ALL CRUSHES FAIL!!
</pre>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-297383" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a060a615eb78afa6202343c14aecfa2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a060a615eb78afa6202343c14aecfa2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dave Bobker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-02-25T04:00:30+00:00">February 25, 2018 at 4:00 am</time></a> </div>
<div class="comment-content">
<p>Can simple modifications not improve the output. What occurs to me is:<br/>
1) Load the intial state with 2 64 bit seeds, not 1<br/>
2) Load the initial state with 4 64 bit seeds to give 2 states and alternate output between the two<br/>
3) &ldquo;Shuffle&rdquo; output a la Numerical Recipes say with a table of length 256 or 512.</p>
<p>Have any of these been tried? All of them would add negligible time to execution.</p>
</div>
</li>
<li id="comment-297841" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa04e2a3d2f8c4741c00f3cf5633bf9d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa04e2a3d2f8c4741c00f3cf5633bf9d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">DIVVSÂ·IVLIVS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-05T10:58:37+00:00">March 5, 2018 at 10:58 am</time></a> </div>
<div class="comment-content">
<p>As far as I know, xorshift128+ was superseded by xoroshiro128+ (XOR/rotate/shift/rotate), with significant improvement in speed (well below a nanosecond per integer) and a significant improvement in statistical quality, as detected by the long-range tests of PractRand.</p>
</div>
</li>
<li id="comment-298840" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert Chan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-17T01:15:54+00:00">March 17, 2018 at 1:15 am</time></a> </div>
<div class="comment-content">
<p>I tried both xorshift128+ and xoroshiro128+, but they are about the same speed. For my old Pentium 3, xorshift128+<br/>
comes out slightly ahead in speed.</p>
</div>
</li>
<li id="comment-302578" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/67d86f9efa27f44b9fb61e0848f8856f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/67d86f9efa27f44b9fb61e0848f8856f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">TonyB_</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-04T14:58:49+00:00">May 4, 2018 at 2:58 pm</time></a> </div>
<div class="comment-content">
<p>A new paper out today by David Blackman &amp; Sebastiano Vigna discusses xoroshiro, a new generator called xoshiro and better scramblers, in particular **. For details please see <a href="http://xoshiro.di.unimi.it/" rel="nofollow ugc">http://xoshiro.di.unimi.it/</a></p>
<p>xorshift+ and xorshift* have been very much superseded.</p>
</div>
</li>
<li id="comment-428406" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c6bd307264b05de3a3a898fe5300778?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c6bd307264b05de3a3a898fe5300778?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lorenzo Lodi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-22T08:11:35+00:00">September 22, 2019 at 8:11 am</time></a> </div>
<div class="comment-content">
<p>You might be interested to know that very recently the Japanese authors of the Mersenne Twister have found that a simple &lsquo;zooming in&rsquo; on xoroshift128+ reveals non-random distributions, and have given passed a damning judgement on this generator:<br/>
Hiroshi Haramoto, Makoto Matsumoto, <em>Again, random numbers fall mainly in the planes: xorshift128+ generators</em><br/>
<a href="https://arxiv.org/abs/1908.10020" rel="nofollow ugc">https://arxiv.org/abs/1908.10020</a></p>
<p>Hiroshi Haramoto, Makoto Matsumoto, Mutsuo Saito, <em>Pseudo random number generators: attention for a newly proposed generator</em><br/>
<a href="https://arxiv.org/abs/1907.03251" rel="nofollow ugc">https://arxiv.org/abs/1907.03251</a></p>
<p>They also stress that one should not rely too much on testing suites such as TestU01, PractRand etc. because they are primarily made to reveal faults in already existing PNG. It is too easy to take a &lsquo;bad&rsquo; generator which fails TestU01, tweak it a bit and make it pass it, but in so doing deviations from randomness are probably just moves somewhere else where the test suite is not looking. This is, I think what they are saying.</p>
<p>Personally I really see little reason for not using a strong cryptographically secure RNG, such as AES in counter mode (with hardware support), ChaCha8, perhaps ISAAC etc. I think they are fast and slim enough for practically all applications and they have been scrutinised much, much more thoroughly than any &lsquo;ordinary&rsquo; RNG, whose randomness is only skin-deep.</p>
</div>
<ol class="children">
<li id="comment-428467" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-22T18:15:46+00:00">September 22, 2019 at 6:15 pm</time></a> </div>
<div class="comment-content">
<p>Don’t miss our paper&#8230;</p>
<p>Daniel Lemire, Melissa E. O’Neill<br/>
Xorshift1024*, Xorshift1024+, Xorshift128+ and Xoroshiro128+ Fail Statistical Tests for Linearity<br/>
Computational and Applied Mathematics 350, 2019<br/>
<a href="https://arxiv.org/abs/1810.05313" rel="nofollow ugc">https://arxiv.org/abs/1810.05313</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-449601" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f24a32885690831e4368f1caae11eac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f24a32885690831e4368f1caae11eac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joshua Scholar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-25T06:14:54+00:00">November 25, 2019 at 6:14 am</time></a> </div>
<div class="comment-content">
<p>This makes me feel a little proud. I just came up with a lagged Fibonacci generator (with carry) for tiny little 8 bit processors, it&rsquo;s initialized with a kind of xshift, and it passes bigcrunch both regular and bit reversed (it generates one byte at a time, so collect 4 to make a unit for bigcrunch to test).</p>
</div>
</li>
</ol>
