---
date: "2017-02-28 12:00:00"
title: "How many floating-point numbers are in the interval [0,1]?"
index: false
---

[25 thoughts on &ldquo;How many floating-point numbers are in the interval [0,1]?&rdquo;](/lemire/blog/2017/02-28-how-many-floating-point-numbers-are-in-the-interval-01)

<ol class="comment-list">
<li id="comment-273486" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/621dd8a9696960eac2ecb815539f4f72?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/621dd8a9696960eac2ecb815539f4f72?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">fuz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-28T22:35:30+00:00">February 28, 2017 at 10:35 pm</time></a> </div>
<div class="comment-content">
<p>The POSIX drand48() function returns a floating point number in [0, 1) with 48 bits of entropy. This is typically done by taking the IEEE 754 double representation of 1.0, setting the first 48 bit of the mantissa to random 48 bits and then subtracting 1.0. This leads to a uniformly distributed floating point number in this range.</p>
<p>To your claim about the 1-to-257 bias: Note that the range of valid floating point numbers around 0 is much denser than the range around 0.5, so even in a perfectly uniform distribution, hitting exactly 0.0 is much less probable than hitting 0.5 as the number of numbers that round to 0.0 is much higher than the amount of numbers that round to 0.5.</p>
</div>
<ol class="children">
<li id="comment-273494" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T00:23:47+00:00">March 1, 2017 at 12:23 am</time></a> </div>
<div class="comment-content">
<p>If hitting exactly zero is much less probable than hitting exactly 0.5, then I would argue that you do not have a uniform distribution&#8230;</p>
</div>
<ol class="children">
<li id="comment-273509" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T03:05:33+00:00">March 1, 2017 at 3:05 am</time></a> </div>
<div class="comment-content">
<p>I believe the notion of a uniform distribution when applied to floating point numbers is a bit odd, which I think is what fuz is referring to. Since floating point numbers are denser around 0, if you generate a uniformly distributed real number and round that to the nearest representable floating point number, then by definition numbers around 0 will be more likely *if* your real number distribution was uniform and could generate an arbitrary real number (which dividing an integer by 2^24 can&rsquo;t do).</p>
<p>The alternative route is to generate a uniformly distributed representable floating point number &#8211; which seems to imply that the goal is to have each floating point number in [0,1] have the same probability &#8211; which results in a non-uniform distribution, of course, and can be achieved by generating approximately 30 bits of randomness and filling mantissa/exponent with them (or, to be more precise, a random number in 0..1,056,964,610).</p>
</div>
<ol class="children">
<li id="comment-273654" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6bcd2b91d1a4ddf61f25d3347b82f08?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6bcd2b91d1a4ddf61f25d3347b82f08?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J.S. Nelson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T17:34:33+00:00">March 2, 2017 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s an interesting distinction to make. In most applications I can imagine one would want the latter thing, where we&rsquo;re trying to uniformly pick out numbers in a finite set that happens to be the set of floating point numbers in [0,1], without regard to whether that distribution approximates a uniform distribution over the real range that contains them. E.g. if we&rsquo;re using these numbers for cryptographic purposes, any non-uniform probability in terms of which actual point numbers our process selects is going to result in an entropy loss and will generally weaken our process.</p>
<p>I&rsquo;m sure there are applications where you&rsquo;d really want the former thing (a distribution over the floating point numbers in [0,1] that approximates a uniform distribution over the reals in that range) but my brain is tuned to information theory and I can&rsquo;t think of one off the top of my head. I&rsquo;d be interested in hearing a simple example if anyone has one.</p>
</div>
</li>
</ol>
</li>
<li id="comment-273576" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/194ef8f807c34a9d7aab0e11a8674768?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/194ef8f807c34a9d7aab0e11a8674768?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T21:26:37+00:00">March 1, 2017 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>If choosing a value in [0-e, 0+e] is as likely as [0.5-e, 0.5+e] for reasonable values of e, you have a uniform distribution. Probability of hitting the exact values is affected by the fact that each &ldquo;exact value&rdquo; is an approximation for a different interval. With the real real numbers, the probability of hitting any exact value is exactly zero, so with floats the probability of hitting an exact value only reflects floats&rsquo; failure to be really reals.</p>
</div>
</li>
</ol>
</li>
<li id="comment-273564" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Severin Pappadeux</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T17:37:56+00:00">March 1, 2017 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>Any method which populate [1,2) and then subtract 1 to get U[0,1) will inevitable loose some random bits &#8211; there are twice as much floats in [0,1) as in [1,2)</p>
</div>
<ol class="children">
<li id="comment-273626" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T09:59:07+00:00">March 2, 2017 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s entirely false. Try</p>
<p> static inline double to_double(uint32_t x) {<br/>
const union { uint32_t i; float f; } u = { .i = UINT32_C(0x3F8) &lt;&lt; 20 | x };<br/>
return u.f &#8211; 1.0f;<br/>
}</p>
<p>int main() {<br/>
for(int i = 0; i &lt; 1 &lt;&lt; 23; i++) assert(to_double(i) * (1 &lt;&lt; 23) == i);<br/>
}</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-273557" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Severin Pappadeux</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T15:51:59+00:00">March 1, 2017 at 3:51 pm</time></a> </div>
<div class="comment-content">
<p>Did you read <a href="http://xoroshiro.di.unimi.it/random_real.c" rel="nofollow ugc">http://xoroshiro.di.unimi.it/random_real.c</a> ?</p>
</div>
<ol class="children">
<li id="comment-273558" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T16:00:19+00:00">March 1, 2017 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>No, but it looks like an interesting reference.</p>
</div>
<ol class="children">
<li id="comment-273620" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T09:22:49+00:00">March 2, 2017 at 9:22 am</time></a> </div>
<div class="comment-content">
<p>Actually, you did! It&rsquo;s the code linked by your reference <a href="http://mumble.net/~campbell/2014/04/28/uniform-random-float" rel="nofollow ugc">http://mumble.net/~campbell/2014/04/28/uniform-random-float</a> above&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-273570" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1115af3a8ed59c30680faf2ed9601d0c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1115af3a8ed59c30680faf2ed9601d0c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://thestone.zone" class="url" rel="ugc external nofollow">Josh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T18:15:21+00:00">March 1, 2017 at 6:15 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;meaning that for every integer in [0,2^24), there is one and only one integer in [0,1).&rdquo;</p>
<p>Should that read &ldquo;one and only one floating point number in [0,1)&rdquo; instead?</p>
</div>
</li>
<li id="comment-273584" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-01T23:40:16+00:00">March 1, 2017 at 11:40 pm</time></a> </div>
<div class="comment-content">
<p>I used nextafterf() to count the number of floats between 0.0 and 1.0. The following program takes only a couple seconds to report that there are 1,065,353,216 such values, which is slightly larger than 1,056,964,608. I don&rsquo;t know why there is a difference.</p>
<p>int main(void) {<br/>
float x = 0.0f;<br/>
int count = 0;</p>
<p> while (x &lt; 1.0) {<br/>
x = nextafterf(x, 1.0);<br/>
count += 1;<br/>
}</p>
<p> printf(&quot;count: %d\n&quot;, count);<br/>
return 0;<br/>
}</p>
</div>
<ol class="children">
<li id="comment-273698" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5b9c2f53b27c5520050b769e8adb919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5b9c2f53b27c5520050b769e8adb919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mapr.com" class="url" rel="ugc external nofollow">Ted Dunning</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T23:59:24+00:00">March 2, 2017 at 11:59 pm</time></a> </div>
<div class="comment-content">
<p>My guess is that the extra floating point numbers that you detected are denormalized representations which don&rsquo;t fit the patterns originally presupposed in the article.</p>
<p>Floating point representations are more complex than they appear.</p>
</div>
</li>
</ol>
</li>
<li id="comment-273600" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0bc09e1bd45610fc85274cd7bb002c56?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0bc09e1bd45610fc85274cd7bb002c56?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike A</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T03:07:45+00:00">March 2, 2017 at 3:07 am</time></a> </div>
<div class="comment-content">
<p>One reason the count could be wrong is that the post only counts &ldquo;normal numbers&rdquo;, but there are a extra values between the smallest positive non-zero normal value and zero &#8212; the so called &ldquo;denormal numbers&rdquo;. The correct calculation should have been $127 x 2^23$. ($126 x 2^23$ normals, 1 zero and $1 x 2^23 -1$ denormals). Which matches your calculation exactly.</p>
</div>
<ol class="children">
<li id="comment-273603" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-02T03:17:16+00:00">March 2, 2017 at 3:17 am</time></a> </div>
<div class="comment-content">
<p><em>The correct calculation should have been (&#8230;)</em></p>
<p>I excluded explicitly denormal numbers. It is debatable whether they should be included.</p>
<p>In any case, it does not change the count very much.</p>
</div>
</li>
</ol>
</li>
<li id="comment-284274" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f05228ce1821de5d4377c8c13636f3fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f05228ce1821de5d4377c8c13636f3fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anomaly UK</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-17T09:00:06+00:00">August 17, 2017 at 9:00 am</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the mean of all the floating-point numbers in [0,1] ? I would assume it&rsquo;s nowhere near 0.5</p>
</div>
<ol class="children">
<li id="comment-294196" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-30T02:49:37+00:00">December 30, 2017 at 2:49 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s correct. The mean is 0.0119 as you can verify with the following program&#8230;</p>
<pre style="color:#000000;background:#ffffff;"><span style="color:#800000; font-weight:bold; ">int</span> <span style="color:#400000; ">main</span><span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
  <span style="color:#800000; font-weight:bold; ">double</span> total <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#800080; ">;</span>
  <span style="color:#603000; ">size_t</span> count <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">float</span> val <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">for</span><span style="color:#808030; ">(</span>uint32_t x <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#800080; ">;</span> x <span style="color:#808030; ">&lt;</span> <span style="color:#008000; ">0xFFFFFFFF</span><span style="color:#800080; ">;</span> x<span style="color:#808030; ">+</span><span style="color:#808030; ">+</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    <span style="color:#603000; ">memcpy</span><span style="color:#808030; ">(</span><span style="color:#808030; ">&amp;</span>val<span style="color:#808030; ">,</span> <span style="color:#808030; ">&amp;</span>x<span style="color:#808030; ">,</span> <span style="color:#800000; font-weight:bold; ">sizeof</span><span style="color:#808030; ">(</span>x<span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">if</span><span style="color:#808030; ">(</span>isnormal<span style="color:#808030; ">(</span>val<span style="color:#808030; ">)</span> <span style="color:#808030; ">&amp;</span><span style="color:#808030; ">&amp;</span> <span style="color:#808030; ">(</span>val <span style="color:#808030; ">></span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">&amp;</span><span style="color:#808030; ">&amp;</span> <span style="color:#808030; ">(</span>val <span style="color:#808030; ">&lt;</span><span style="color:#808030; ">=</span> <span style="color:#008000; ">1.0</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
      total <span style="color:#808030; ">+</span><span style="color:#808030; ">=</span> val<span style="color:#800080; ">;</span>
      count <span style="color:#808030; ">+</span><span style="color:#808030; ">=</span><span style="color:#008c00; ">1</span><span style="color:#800080; ">;</span>
    <span style="color:#800080; ">}</span>
  <span style="color:#800080; ">}</span>
  <span style="color:#603000; ">printf</span><span style="color:#808030; ">(</span><span style="color:#800000; ">"</span><span style="color:#007997; ">%f</span><span style="color:#0000e6; "> %zu </span><span style="color:#0f69ff; ">\n</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span> total<span style="color:#808030; ">,</span> count<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>
</pre>
<p>It is very far from 0.5. Of course, you can find a uniform sample of the numbers in [0,1)&#8230; but there are many more floats near 0&#8230;</p>
</div>
</li>
</ol>
</li>
<li id="comment-304236" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.md2020.eu5.org" class="url" rel="ugc external nofollow">Sean O'Connor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-20T14:35:42+00:00">May 20, 2018 at 2:35 pm</time></a> </div>
<div class="comment-content">
<p>For a true uniform number (32 bit float) half the time the exponent should be 126, a quarter of the time 125, one eighth of the time 124 etc. You can force that. A lowest set bit or highest set bit on say a random 32 or 64 bit integer will give the right distribution to add/subtract from the exponent. Then just put random bits in the mantissa.<br/>
I guess the error is &ldquo;just putting random bits in the mantissa.&rdquo;<br/>
That would probably lead to bias. If you look at the methods in the code by Vigna ( a famous person, by the way) there are 2 ways given to get floats.<br/>
Anyway it depends on what you want random numbers for. For evolutionary algorithms it is better to make full use of all the precision available even at the cost of some slight bias. Also for rare event code a uniform random number quantized in 2^24 pieces would be useless. You would never get a number in the interval [1e-26,1e-27] for example . That is a major bias in that application.</p>
</div>
</li>
<li id="comment-304237" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8384efde6dc676fca7fcae9fb4730314?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.md2020.eu5.org" class="url" rel="ugc external nofollow">Sean O'Connor</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-05-20T14:38:57+00:00">May 20, 2018 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>I meant to mention about a different number format that has a less crazy density of low magnitude numbers:<br/>
<a href="https://en.wikipedia.org/wiki/Unum_%28number_format%29" rel="nofollow ugc">https://en.wikipedia.org/wiki/Unum_%28number_format%29</a></p>
</div>
</li>
<li id="comment-575917" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c416d84b38962be2641e83692235c617?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c416d84b38962be2641e83692235c617?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://none" class="url" rel="ugc external nofollow">Tamas Varhegyi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-21T04:06:36+00:00">February 21, 2021 at 4:06 am</time></a> </div>
<div class="comment-content">
<p>Actually there are an unlimited number of floating point numbers if we get away from the implementation dependent hardware straightjacket.<br/>
Just one example : take the sequence of 0.1, 0.01, &#8230;, 0.00001 and so on, Yes, that is an endless progression. Any questions ?</p>
</div>
</li>
<li id="comment-597508" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8c0e5b0754770c5e1f7419a0698ecff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8c0e5b0754770c5e1f7419a0698ecff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Guest</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-10T16:23:00+00:00">September 10, 2021 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>The approaches that use division (which is a very complex operation in itself) and convert random integers to floating point seem cumbersome to me. Is it possible to work something out from the bit representation?</p>
<p>For example, something like this. Draw a random bit, if it equals one, then the exponent is 2^-1 which corresponds to the interval [1/2 .. 1). Otherwise draw another bit, if it equals one the exponent is 2^-2 which corresponds to the interval [1/4 .. 1/2) and so on. This gives us uniformity. Once we have chosen the interval, just fill the mantissa with 23 random bits. Such a generator can certainly produce all possible floating point numbers. It&rsquo;s also easy to generate denormals this way, if necessary.</p>
<p>Will something like this work?</p>
</div>
<ol class="children">
<li id="comment-597511" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-10T17:08:43+00:00">September 10, 2021 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>A bit-by-bit approach is unlikely to be efficient in hardware.</p>
</div>
<ol class="children">
<li id="comment-597519" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8c0e5b0754770c5e1f7419a0698ecff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8c0e5b0754770c5e1f7419a0698ecff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Guest</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-09-10T18:58:37+00:00">September 10, 2021 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Hello! But it&rsquo;s bit-by-bit only in concept. In reality that&rsquo;d be very approximately something like:</p>
<p><code>e = ctz(random(2^126))<br/>
m = random(2^23)<br/>
</code></p>
<p>Where <code>e</code> is a bit representation of the exponent (so it should be in the [1, 126] interval, and <code>ctz</code> gives you an index of the least-significant non-zero bit.</p>
<p>In practice that would probably be 2-4 calls to the base random generator and CTZ/CLZ instructions. Surely the division is much more expensive than that! I&rsquo;m more worried about proving that this approach will give a &ldquo;good&rdquo; distribution.</p>
</div>
<ol class="children">
<li id="comment-654339" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b29538e6dc6cb2bf25813f35562e974b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-27T22:57:47+00:00">August 27, 2023 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>This is basically the same approach taken by the earlier linked <a href="http://xoroshiro.di.unimi.it/random_real.c" rel="nofollow ugc">http://xoroshiro.di.unimi.it/random_real.c</a> . It gives a complete treatment of how &amp; why this works.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-650844" class="pingback even thread-even depth-1">
<div class="comment-body">
Pingback: <a href="https://travelske.wordpress.com/2023/04/15/how-many-floating-point-numbers-are-in-the-interval-01-2017/" class="url" rel="ugc external nofollow">How many floating-point numbers are in the interval [0,1]? (2017)</a> </div>
</li>
</ol>
