---
date: "2019-07-03 12:00:00"
title: "A fast 16-bit random number generator?"
index: false
---

[12 thoughts on &ldquo;A fast 16-bit random number generator?&rdquo;](/lemire/blog/2019/07-03-a-fast-16-bit-random-number-generator)

<ol class="comment-list">
<li id="comment-415155" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-03T14:00:07+00:00">July 3, 2019 at 2:00 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The hash16 function is not invertible… to make it invertible I would need to make the avalanche effect quite weak.
</p></blockquote>
<p>Maybe, but that does not matter as the period of that PRNG [an invertible one] would be maxed at 2^16. The fact that the avalanche effect is not [or less] distributed uniformly &lsquo;adds to the randomness&rsquo; in a way.</p>
</div>
<ol class="children">
<li id="comment-415159" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-03T14:22:55+00:00">July 3, 2019 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>The period is still 2^16.</p>
</div>
<ol class="children">
<li id="comment-415163" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-03T14:57:15+00:00">July 3, 2019 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>The great thing about a 16-bit PRNG (promoted by O&rsquo;Neill) is that one can do exhaustive search. I&rsquo;ll have a look at this statement, because I&rsquo;m not sure (tomorrow, it&rsquo;s getting dark here).</p>
</div>
<ol class="children">
<li id="comment-415166" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-03T15:02:52+00:00">July 3, 2019 at 3:02 pm</time></a> </div>
<div class="comment-content">
<p><em>one can do exhaustive search</em></p>
<p>Please see my code on GitHub. It is precisely what it does.</p>
</div>
<ol class="children">
<li id="comment-415169" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-03T15:16:46+00:00">July 3, 2019 at 3:16 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ll do that, tomorrow! It still seems like a contradiction.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-415293" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-04T05:49:28+00:00">July 4, 2019 at 5:49 am</time></a> </div>
<div class="comment-content">
<p>I see, nifty indeed.</p>
<p>The hash16 is invertible only for very specific key-pairs [ones one doesn&rsquo;t want].</p>
<p>What bugs me a bit in your post [the way it&rsquo;s written] is that you are calling the PRNG a hash function in a number of places. The PRNG consists of a state being updated on each call and then the state is mixed by a hash-function (similar to splitmix) and outputted. The good thing here is AFAICS that the hash function is Lehmer-style, contrary to splitmix.</p>
<p>It could be slightly more compact:</p>
<p>std::uint16_t wyhash16_x = 1u;</p>
<p>[[ nodiscard ]] inline std::uint16_t hash16 ( std::uint32_t hash, std::uint16_t const key ) noexcept {<br/>
hash *= key;<br/>
return ( hash &gt;&gt; 16 ) ^ hash;<br/>
}</p>
<p>[[ nodiscard ]] std::uint16_t wyhash16 ( ) noexcept {<br/>
wyhash16_x += 0xfc15;<br/>
return hash16 ( wyhash16_x, 0x2ab );<br/>
}</p>
<p>I&rsquo;m still a bit skeptic as to your implicit assumption that good avalanche mixer implies good PRNG. Going through the same exercise for a hash32 would make that testable.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-559258" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc6123cfa965222425065ef26477b171?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc6123cfa965222425065ef26477b171?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ellery Bann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-24T20:21:35+00:00">November 24, 2020 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>Dear Dr. Lemire,<br/>
Thank you for your nice PRNG algorithm. I am going to use it on a 6502-based computer. Doesn&rsquo;t the function <em>hash16</em> return a 16-bit result because of <strong>&amp; 0xFFFF</strong>? The function definition says uint32_t. Isn&rsquo;t the hash function also very expensive (on an 8-bit computer) using <strong>((hash &gt;&gt; 16) ^ hash) &amp; 0xFFFF</strong>? The ^ seems expensive. Also, do you think it would be better to change the seed (wyhash16_x) after every, let&rsquo;s say, 30,000 random number generated? I have a source for a somewhat random 24-bit number generator. Please let me know what you think!</p>
</div>
<ol class="children">
<li id="comment-559294" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-25T01:55:16+00:00">November 25, 2020 at 1:55 am</time></a> </div>
<div class="comment-content">
<p>The XOR is not expensive.</p>
<p>The period will indeed be limited.</p>
</div>
<ol class="children">
<li id="comment-559307" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc6123cfa965222425065ef26477b171?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc6123cfa965222425065ef26477b171?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ellery Bann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-25T03:46:51+00:00">November 25, 2020 at 3:46 am</time></a> </div>
<div class="comment-content">
<p>I stand corrected! It is XOR and I was confused with BASIC&rsquo;s exponent symbol&#8230;</p>
<p>How does Mult-XOR compare with XOR-Shift algorithms?</p>
<p>Also, the generation of ranged integers, I don&rsquo;t understand the line &ldquo;<strong>uint16_t t = -s % s;</strong>&ldquo;, doesn&rsquo;t that always result in <strong>zero</strong>? Or am I confusing again, e.g. that it&rsquo;s not quite <strong>t = -5 % 5</strong> which results in 0, but actually <strong>two&rsquo;s complement of 5</strong> MOD 5.</p>
<p>Thanks for your prompt reply!</p>
</div>
<ol class="children">
<li id="comment-559371" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-11-25T13:56:39+00:00">November 25, 2020 at 1:56 pm</time></a> </div>
<div class="comment-content">
<p>I have a whole blog post on this issue:</p>
<p><a href="https://lemire.me/blog/2020/10/28/what-the-heck-is-the-value-of-n-n-in-programming-languages/" rel="ugc">https://lemire.me/blog/2020/10/28/what-the-heck-is-the-value-of-n-n-in-programming-languages/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-605203" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7e1660d14d23ee3a98ac524f8062bcb8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7e1660d14d23ee3a98ac524f8062bcb8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James Houx</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-05T15:44:28+00:00">November 5, 2021 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>I was specifically looking for a 16-bit state generator, and found this! It&rsquo;s awesome! 65k period is more than plenty for my small needs. But I want to confirm one thing:<br/>
If I use two different seeds, I would get two completely different number sequences correct? I want to make sure different seeds won&rsquo;t produce the same sequence with different starting positions.</p>
<p>Thank you in advance!! Your work is inspiring!</p>
</div>
<ol class="children">
<li id="comment-605218" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-05T17:18:11+00:00">November 5, 2021 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>It is my expectation but you should always check.</p>
</div>
</li>
</ol>
</li>
</ol>
