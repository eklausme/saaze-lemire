---
date: "2017-09-18 12:00:00"
title: "Computing the inverse of odd integers"
index: false
---

[8 thoughts on &ldquo;Computing the inverse of odd integers&rdquo;](/lemire/blog/2017/09-18-computing-the-inverse-of-odd-integers)

<ol class="comment-list">
<li id="comment-286368" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6d076eb5be7f09dd4256e70d903615c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6d076eb5be7f09dd4256e70d903615c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sam Kramer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T17:24:51+00:00">September 19, 2017 at 5:24 pm</time></a> </div>
<div class="comment-content">
<p>Interesting article!<br/>
Those using C++14 or newer can use the constexpr specifier to evaluate the functions at compile time:</p>
<p>constexpr uint64_t f64(uint64_t x, uint64_t y) {<br/>
return y * ( 2 &#8211; y * x );<br/>
}</p>
<p>constexpr uint64_t findInverse64(uint64_t x) {<br/>
uint64_t y = x;<br/>
y = f64(x,y);<br/>
y = f64(x,y);<br/>
y = f64(x,y);<br/>
y = f64(x,y);<br/>
y = f64(x,y);<br/>
return y;<br/>
}</p>
</div>
<ol class="children">
<li id="comment-286369" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T17:34:44+00:00">September 19, 2017 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>Great!</p>
<p>Does this work with C++11?</p>
</div>
<ol class="children">
<li id="comment-286372" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6d076eb5be7f09dd4256e70d903615c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6d076eb5be7f09dd4256e70d903615c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam Kramer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-19T18:56:21+00:00">September 19, 2017 at 6:56 pm</time></a> </div>
<div class="comment-content">
<p>C++11 Solution:</p>
<p>constexpr uint64_t rec_f64(uint64_t x, uint64_t y, int n) {<br/>
return (n &gt; 0) ? rec_f64(x, f64(x, y), n-1) : f64(x, y);<br/>
}</p>
<p>constexpr uint64_t findInverse64(uint64_t x) {<br/>
return rec_f64(x, x, 5);<br/>
}</p>
<p>See the following blog post to learn why this is necessary:<br/>
<a href="http://fendrich.se/blog/2012/11/22/compile-time-loops-in-c-plus-plus-11-with-trampolines-and-exponential-recursion/" rel="nofollow ugc">http://fendrich.se/blog/2012/11/22/compile-time-loops-in-c-plus-plus-11-with-trampolines-and-exponential-recursion/</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-287078" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-09-25T22:18:54+00:00">September 25, 2017 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>In terms of applications, this came up for me recently when looking at an algorithm for exact division (remainder known to be zero). </p>
<p>You can actually do a little better and get 5 correct starting bits with y = (3 * x) ^ 2 and in that case you also only need 4 iterations for the 64 bit inverse.</p>
<p>That&rsquo;s according to &ldquo;personal communication from Montgomery&rdquo; from this paper: <a href="https://arxiv.org/pdf/1303.0328.pdf" rel="nofollow ugc">https://arxiv.org/pdf/1303.0328.pdf</a></p>
</div>
</li>
<li id="comment-306727" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert Chan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-03T21:51:04+00:00">June 3, 2018 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>For older machine, this may be faster to calculate 64-bits inverse:</p>
<p><code>static uint32_t inverse32(uint32_t a)<br/>
{<br/>
uint32_t x = (3*a) ^ 2;<br/>
x *= 2 - a * x;<br/>
x *= 2 - a * x;<br/>
x *= 2 - a * x;<br/>
return x;<br/>
}</p>
<p>static uint64_t inverse64(uint64_t a) // (a x) mod 2^64 = 1<br/>
{<br/>
uint32_t terms, a0 = a; // a = a1&lt;&lt;32 | a0<br/>
uint32_t x0 = inverse32(a0); // a0 x0 = 1<br/>
terms = (uint32_t) (a &gt;&gt; 32) * x0; // term a1 x0<br/>
terms += ((uint64_t) a0 * x0) &gt;&gt; 32; // term a0 x0 / 2^32<br/>
uint32_t x1 = x0 * -terms; // a0 x1 + terms = 0<br/>
return (uint64_t) x1 &lt;&lt; 32 | x0; // x = a^-1 mod 2^64<br/>
}<br/>
</code></p>
</div>
</li>
<li id="comment-306788" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/58c1a3b7009d2666847289f4cd3d4dd9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Albert Chan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-04T03:27:09+00:00">June 4, 2018 at 3:27 am</time></a> </div>
<div class="comment-content">
<p>Found an old post with formula that trebled bits accuracy per step.<br/>
For inverse32(), only 2 steps are needed.</p>
<p><a href="https://groups.google.com/forum/#!msg/sci.crypt/UI-UMbUnYGk/hX2-wQVyE3oJ" rel="nofollow ugc">https://groups.google.com/forum/#!msg/sci.crypt/UI-UMbUnYGk/hX2-wQVyE3oJ</a></p>
<p><code>uint32_t inverse32(uint32_t a)<br/>
{<br/>
uint32_t t, x = (3*a) ^ 2;<br/>
t = a * x - 1;<br/>
x *= t * t - t + 1;<br/>
t = a * x - 1;<br/>
x *= t * t - t + 1;<br/>
return x;<br/>
}<br/>
</code></p>
</div>
</li>
<li id="comment-319853" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/057e97d8309b78007e41cf4b195da876?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/057e97d8309b78007e41cf4b195da876?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">LCR</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-20T16:31:25+00:00">July 20, 2018 at 4:31 pm</time></a> </div>
<div class="comment-content">
<p>I might be late to the party, but here&rsquo;s a solution to remove some more cycles by hacking an 8bit approximation with a small table (especially efficient if you have the <a href="https://www.felixcloutier.com/x86/BEXTR.html" rel="nofollow">bextr</a> instruction).</p>
<p><code>uint64_t inverse64(uint64_t a) {<br/>
uint8_t t[] = {<br/>
2, 174, 210, 190, 66, 174, 210, 254,<br/>
2, 46, 82, 190, 66, 46, 82, 254,<br/>
};<br/>
uint64_t x;<br/>
x = t[(a&gt;&gt;1)&amp;15] - a; // 8bit precision<br/>
x *= 2 - a * x; // 16<br/>
x *= 2 - a * x; // 32<br/>
x *= 2 - a * x; // 64<br/>
return x;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-319913" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-20T18:42:38+00:00">July 20, 2018 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p><em>Here&rsquo;s a solution to remove some more cycles by hacking an 8bit approximation with a small table</em></p>
<p>It is interesting, but I doubt that it will be much faster.</p>
</div>
</li>
</ol>
</li>
</ol>
