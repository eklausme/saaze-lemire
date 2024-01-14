---
date: "2019-06-06 12:00:00"
title: "Nearly Divisionless Random Integer Generation On Various Systems"
index: false
---

[38 thoughts on &ldquo;Nearly Divisionless Random Integer Generation On Various Systems&rdquo;](/lemire/blog/2019/06-06-nearly-divisionless-random-integer-generation-on-various-systems)

<ol class="comment-list">
<li id="comment-410701" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://emergent.unpythonic.net" class="url" rel="ugc external nofollow">Jeff Epler</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T00:28:35+00:00">June 7, 2019 at 12:28 am</time></a> </div>
<div class="comment-content">
<p>It looks like you may have incorrectly transcribed a value for the ARM table &ldquo;Floating point approach (biased)&rdquo;.</p>
</div>
<ol class="children">
<li id="comment-410717" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T02:15:25+00:00">June 7, 2019 at 2:15 am</time></a> </div>
<div class="comment-content">
<p>Correct. Thanks for pointing it out.</p>
</div>
</li>
</ol>
</li>
<li id="comment-410808" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec9bea1608b280eb7f9b741ef4ca4c17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec9bea1608b280eb7f9b741ef4ca4c17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T13:02:38+00:00">June 7, 2019 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I don&rsquo;t understand,<br/>
uint64_t t = -s % s;</p>
<p>I interpret that as the remainder when -s is divided by s.</p>
<p>Tnx.</p>
</div>
<ol class="children">
<li id="comment-410888" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T22:25:14+00:00">June 7, 2019 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>Think: (2^64-s) mod s</p>
</div>
<ol class="children">
<li id="comment-410930" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">degski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T04:54:50+00:00">June 8, 2019 at 4:54 am</time></a> </div>
<div class="comment-content">
<p>For -s % s to compile in VC one has to write (0-s) % s.</p>
</div>
<ol class="children">
<li id="comment-411022" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T14:12:15+00:00">June 8, 2019 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>The code sample I have provided in my blog post is unlikely to compile under Visual Studio for other reasons as well.</p>
</div>
<ol class="children">
<li id="comment-420465" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skanthak,homepage.t-online.de/nomsvcrt.html" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-28T01:29:30+00:00">July 28, 2019 at 1:29 am</time></a> </div>
<div class="comment-content">
<p>This compiles with MSVC:</p>
<p><code>uint64_t nearlydivisionless ( uint64_t s ) {<br/>
uint64_t x = random64 () ;<br/>
uint64_t m;<br/>
uint64_t l = _umul128(x, s, &amp;m);<br/>
if (l &lt; s) {<br/>
for (uint64_t t = (0ULL - s) % s; l &lt; t; l = _umul128(x, s, &amp;m))<br/>
x = random64 ();<br/>
}<br/>
return m;<br/>
}<br/>
</code></p>
<p>The _umul128() intrinsic is available for AMD64 only; it can but trivially implemented for I386: see <a href="https://skanthak,homepage.t-online.de/nomsvcrt.html" rel="nofollow">https://skanthak,homepage.t-online.de/nomsvcrt.html</a></p>
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
<li id="comment-410874" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T21:23:31+00:00">June 7, 2019 at 9:23 pm</time></a> </div>
<div class="comment-content">
<p>I have a question on the array-shuffling algorithm. Your approach seems to be</p>
<p>for (int i = len &#8211; 1; i &gt; 0; i&#8211;)<br/>
swap(a+i, a+random_range(i));</p>
<p>A more naïve approach would be</p>
<p>for (int i = len &#8211; 1; i &gt;= 0; i&#8211;)<br/>
swap(a+i, a+random_range(len));</p>
<p>Is there a reason why the second algorithm shouldn&rsquo;t be used? Or is it simply slower because (for large arrays) it spills from L1 to L2 or L3 or RAM more often than the first?</p>
</div>
<ol class="children">
<li id="comment-410878" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T21:35:45+00:00">June 7, 2019 at 9:35 pm</time></a> </div>
<div class="comment-content">
<p>@Jörn</p>
<p>Do you have a proof that your proposed algorithm is correct? That is, assuming that random_range is a perfect generator, you generate all permutations with equal probability?</p>
<p>The algorithm I use is from Knuth&rsquo;s. It is correct. There might be other, faster algorithms, but to be considered, they must be known to be correct.</p>
</div>
</li>
<li id="comment-410890" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-07T22:55:10+00:00">June 7, 2019 at 10:55 pm</time></a> </div>
<div class="comment-content">
<p>The method is biased, although it is not entirely obvious.</p>
<p>If you work though the math by hand for the case of 3 elements, you&rsquo;ll see that element 0 is less more likely to end up in position 1 than it is to end up in position 2. You can work out the path by hand, maybe by drawing a tree of all possible 27 combinations of swaps: you&rsquo;ll find that 8 outcomes lead to element 0 in position 2, while 10 outcomes place it position 3.</p>
<p>Or just <a href="https://gist.github.com/travisdowns/2c1ac774d6a700728b4bc7d18297d935" rel="nofollow">simulate</a> it.</p>
</div>
<ol class="children">
<li id="comment-410900" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T00:21:23+00:00">June 8, 2019 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Thank you Travis.</p>
</div>
<ol class="children">
<li id="comment-410919" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T03:08:42+00:00">June 8, 2019 at 3:08 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s actually interesting to look at the pattern for arrays of say 10 elements:</p>
<p><code>naive:<br/>
0 1 2 3 4 5 6 7 8 9<br/>
a[0] 10.0 10.1 9.9 10.0 9.9 10.0 10.0 10.0 10.0 10.1<br/>
a[1] 12.8 9.4 9.3 9.5 9.6 9.7 9.8 9.8 9.9 10.1<br/>
a[2] 12.0 12.4 8.9 9.2 9.3 9.3 9.5 9.8 9.8 9.9<br/>
a[3] 11.2 11.5 12.1 8.8 8.9 9.2 9.4 9.5 9.7 9.8<br/>
a[4] 10.5 10.9 11.4 11.9 8.6 8.8 9.1 9.3 9.7 9.9<br/>
a[5] 9.8 10.3 10.8 11.3 11.7 8.6 8.9 9.1 9.6 10.0<br/>
a[6] 9.0 9.7 10.1 10.5 11.3 12.0 8.6 9.2 9.6 10.0<br/>
a[7] 8.6 9.2 9.7 10.1 10.8 11.3 12.0 9.0 9.4 9.9<br/>
a[8] 8.2 8.5 9.0 9.7 10.1 10.8 11.7 12.3 9.6 10.1<br/>
a[9] 7.8 8.1 8.8 9.1 9.7 10.4 11.2 11.9 12.7 10.2<br/>
</code></p>
<p>Notice the diagonal stripe of higher probabilities running from the top left the bottom right. It can be discribed as &ldquo;position N is are much more likely to end up with the value that started in a position &lt; N than &gt;= N&rdquo;. So for example, a[1] is much more likely to get the value that started in a[0] than any other value.</p>
<p>The intuition is this. Consider the second to last step in the loop, where are swapping a[1] with a randomly selected element. Since a[1] swaps with any element with equal probability, after this step a[1] has 0.1 probability of having any specific value, and in particular it has 0 with with p=0.1.</p>
<p>Now, we do the last swap for a[0]. At this point a[0] has not necessarily been swapped, unless it was selected randomly in an earlier step. You can show that this means it will still have zero ~38% of the time (limit of (1-1/n)^n as n-&gt;inf). Now you swap that value with another position. Position a[1] will be selected with p=0.1. So the final probability that a[1] ends up 0 is the 0.1 it was zero after the second to last step (and didn&rsquo;t get swapped in the last step), plus the chance it was selected in the last step: 0.1×0.9+.38×.1 = 0.128 (12.8 has shown in % in the table).</p>
<p>Once that is clear the rest of the table makes sense: each position has a higher probability than uniform of ending up with values in earlier positions, and then the opposite must be true for later values for everything to add up.</p>
<p>This bias doens&rsquo;t go away as you increase the size of the array (I had originally thought it would). In fact, it gets more extreme if you compare the most biased elements, i.e., for larger arrays some outcomes have a 2x higher probability than others.</p>
</div>
<ol class="children">
<li id="comment-410920" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T03:09:25+00:00">June 8, 2019 at 3:09 am</time></a> </div>
<div class="comment-content">
<p>Code blocks don&rsquo;t preserve spacing, and don&rsquo;t look the same as the preview 🙁</p>
</div>
</li>
<li id="comment-410921" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T03:11:42+00:00">June 8, 2019 at 3:11 am</time></a> </div>
<div class="comment-content">
<p>Another try with leading zeros to keep format:</p>
<p><code>naive:<br/>
0 1 2 3 4 5 6 7 8 9<br/>
a[0] 10.0 10.0 10.0 10.0 10.1 10.0 10.0 09.9 10.0 10.0<br/>
a[1] 12.8 09.4 09.4 09.5 09.6 09.6 09.8 09.9 09.9 10.0<br/>
a[2] 12.0 12.4 09.0 09.1 09.2 09.4 09.5 09.7 09.8 10.0<br/>
a[3] 11.2 11.6 12.1 08.7 08.9 09.1 09.2 09.5 09.7 10.0<br/>
a[4] 10.4 10.9 11.3 11.9 08.6 08.8 09.1 09.3 09.7 10.0<br/>
a[5] 09.8 10.2 10.7 11.2 11.8 08.6 08.9 09.2 09.5 10.0<br/>
a[6] 09.2 09.6 10.1 10.6 11.2 11.8 08.7 09.1 09.5 10.0<br/>
a[7] 08.7 09.1 09.6 10.1 10.7 11.4 12.1 09.0 09.5 10.0<br/>
a[8] 08.1 08.6 09.1 09.6 10.2 10.9 11.6 12.4 09.5 10.0<br/>
a[9] 07.7 08.2 08.7 09.2 09.7 10.5 11.1 12.0 12.8 10.0<br/>
</code></p>
</div>
</li>
<li id="comment-411049" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72e7f08e482f8d7d3b2ef42710ffe47d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jörn Engel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T17:59:29+00:00">June 8, 2019 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>Very nice. Thank you!</p>
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
<li id="comment-410953" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a655faa071b8fc21f8b2f77a1c7fa807?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a655faa071b8fc21f8b2f77a1c7fa807?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">onkobu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T07:21:04+00:00">June 8, 2019 at 7:21 am</time></a> </div>
<div class="comment-content">
<p>Wouldn&rsquo;t it be sufficient, to drop the first 4 lines (incl. if) and setting l = 0 as start condition with a foot-controlled do-while? (first calculation block looks the same like the while-body).</p>
</div>
<ol class="children">
<li id="comment-411017" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T14:00:04+00:00">June 8, 2019 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>Can you point to actual code?</p>
</div>
</li>
</ol>
</li>
<li id="comment-411086" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b53b9429f21606ec14a7ce44cce5dff9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b53b9429f21606ec14a7ce44cce5dff9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">svpv</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-08T22:12:08+00:00">June 8, 2019 at 10:12 pm</time></a> </div>
<div class="comment-content">
<p>So in <code>nearlydivisionless</code>, is <em>l &gt;= s</em> the necessary and sufficient condition to produce an unbiased value? Why do you even switch to another algorithm then, which requires division, if you can simply try again without division? I.e. would the following work?</p>
<p><code>uint64_t ratherdivisionless(uint64_t s)<br/>
{<br/>
while (1) {<br/>
uint64_t x = random64();<br/>
__uint128_t m = (__uint128_t) x * (__uint128_t) s;<br/>
uint64_t l = (uint64_t) m;<br/>
if (l &gt;= s)<br/>
return m &gt;&gt; 64;<br/>
}<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-411212" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-09T16:16:08+00:00">June 9, 2019 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>There are many possible algorithms. If you follow the link to Melissa&rsquo;s post, you&rsquo;ll find several. You may find an unbiased algorithm that is faster. That&rsquo;s entirely possible. But I submit to you that you need to provide a proof of correctness and benchmarks to demonstrate that it is faster.</p>
</div>
<ol class="children">
<li id="comment-411232" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-09T19:58:12+00:00">June 9, 2019 at 7:58 pm</time></a> </div>
<div class="comment-content">
<p>I think you can prove that svpv&rsquo;s point is a good and general one, without getting your hands dirty (i.e., testing it).</p>
<p>If you have a &ldquo;rejection sampling&rdquo; method (because that&rsquo;s what this is), which uses a fast method taking F time that succeeds with probability p, and on failure falls back to a slow method that takes S time, isn&rsquo;t the fastest fall back method just to do the same fast sampling method? If it isn&rsquo;t, it contradicts the idea that the rejection sampling method was faster in the first place (you should just use the &ldquo;slow&rdquo; fallback in that case, since it&rsquo;s actually faster). Probably you can show it formally just by expanding the infinite sequence F<em>p + S</em>(1-p) substituing the whole thing again for S.</p>
<p>The difference is microscopic in this case for most interesting <code>s</code> since the first attempt succeeds with overwhelming probability except for very large <code>s</code>, however it has the advantage being simpler in implementation, smaller in code size and of not needing to justify the bias-free nature of two different methods.</p>
<p>As a practical matter, however, you need the special fallback case because the l &lt; s approach fast path will blow up as s approaches 2^64. Few people are going to pass that, but you don&rsquo;t want to take a billion years or whatever when they do. It&rsquo;s kind of too bad though, if you could just use 65 bits instead of 64 for that check, you wouldn&rsquo;t need the fallback case.</p>
</div>
<ol class="children">
<li id="comment-411349" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T04:16:15+00:00">June 11, 2019 at 4:16 am</time></a> </div>
<div class="comment-content">
<p>This comment is wrong: it should be ignored.</p>
</div>
<ol class="children">
<li id="comment-411395" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T13:54:07+00:00">June 11, 2019 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>I can delete this comment</p>
<p><a href="https://lemire.me/blog/2019/06/06/nearly-divisionless-random-integer-generation-on-various-systems/#comment-411232" rel="ugc">https://lemire.me/blog/2019/06/06/nearly-divisionless-random-integer-generation-on-various-systems/#comment-411232</a></p>
<p>if you&rsquo;d like.</p>
</div>
<ol class="children">
<li id="comment-411397" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T14:04:43+00:00">June 11, 2019 at 2:04 pm</time></a> </div>
<div class="comment-content">
<p>Nah, maybe there is a useful tidbit in there.</p>
<p>Actually I stand by the overall point, but I misread the code so it definitely doesn&rsquo;t apply here.</p>
</div>
<ol class="children">
<li id="comment-411410" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T17:14:01+00:00">June 11, 2019 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>The problem of large s is quite valid. At a certain point a basic rejection method becomes cheaper, because you&rsquo;re doing the % on a large proportion of values.</p>
<p>The divisionlessness is unfortunately a function of how many excess random bits we use.</p>
</div>
<ol class="children">
<li id="comment-411413" class="comment even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T17:37:00+00:00">June 11, 2019 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>You could do a check for s greater than some threshold and use a simple technique.</p>
<p>A check right at the start would work but would be in the fast path. Is it possible to defer the check until after the first (l &lt; s) check? That would move it out of the fast path and make it promising.</p>
<p>I think for practical reasons small s dominate, especially with 64-bit values, but yeah it would be nice to elegantly handle the large s case too.</p>
</div>
<ol class="children">
<li id="comment-411424" class="comment odd alt depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T19:01:36+00:00">June 11, 2019 at 7:01 pm</time></a> </div>
<div class="comment-content">
<p>One way might be to add bits to the whole calculation when we hit l &lt; s. Basically divide the bottom bucket into 2^b buckets (using b more random bits), reevaluate the product and l, and hope for l &gt;= s in the wider calculation.</p>
<p>I don&rsquo;t think this biases it; it just reevaluates at a higher resolution.</p>
</div>
<ol class="children">
<li id="comment-411426" class="comment even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T19:21:27+00:00">June 11, 2019 at 7:21 pm</time></a> </div>
<div class="comment-content">
<p>Yeah I mean for say 32-bit s on a 64-bit machine that approach is even easy to do up front, use say a 40-bit l instead of 32-bit and you don&rsquo;t have to worry about big s any more.</p>
<p>With 64-bit muls and the result split across two registers it&rsquo;s not easy though.</p>
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
</ol>
</li>
<li id="comment-411317" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T20:04:12+00:00">June 10, 2019 at 8:04 pm</time></a> </div>
<div class="comment-content">
<p>No, it needs to check t.</p>
<p>The range for any given output j contains either floor(2^64/s) or ceil(2^64/s) multiples of s. The check on l &lt; s merely finds if l is the first multiple in the range; the check on t figures out if there&rsquo;s room for one more value at the end.</p>
</div>
<ol class="children">
<li id="comment-411326" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T22:29:57+00:00">June 10, 2019 at 10:29 pm</time></a> </div>
<div class="comment-content">
<p>Why do you need to check t? You can simply throw out any values that values fall into the range [s, t] without checking if it was possible to extract an unbiased value from it.</p>
<p>In fact, that&rsquo;s exactly what Daniel&rsquo;s code does on the first iteration: it only checks against s. Passing check is sufficient, although not necessary.</p>
</div>
<ol class="children">
<li id="comment-411329" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-10T23:38:45+00:00">June 10, 2019 at 11:38 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t understand your wording, so I may misunderstand, but I see a bias remaining if the l &lt; s rejection is the only one applied.</p>
<p>The goal is to get an equal number of accepted values within each interval, where we only use every s-th value, and the offset of the first value can vary.</p>
<p>Given an interval [0, L) we get the most values if the offset is 0:</p>
<p>0, s, 2<em>s, &#8230; k</em>s &lt; L == k*s + t</p>
<p>We get one fewer value by starting at t:</p>
<p>t, s+t, &#8230; (k-1)<em>s+t &lt; L == k</em>s+t</p>
<p>So in the former case (or at any offset &lt; t) we have to reject one value, but not if t &lt;= l &lt; s.</p>
<p>In other words, if we chop off the first s positions we still have a varying number of values to the right.</p>
</div>
<ol class="children">
<li id="comment-411344" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-11T03:29:47+00:00">June 11, 2019 at 3:29 am</time></a> </div>
<div class="comment-content">
<p>You are right, I hadn&rsquo;t actually considered the math and misunderstood what what was going on.</p>
<p>I thought the rejection condition was <code>l &lt; s</code> and then everything after that was just a different algorithm for generating another value (which is why I was confused why a different algorithm would be used), but as you point out the true rejection criteria for both the initial and retry loops is <code>l &lt; t</code>.</p>
<p>The <code>l &lt; s</code> is just a fast path to see if we even need to bother computing <code>t</code>. After we compute <code>t</code> the second <code>l &lt; t</code> check is applied and the value may not be rejected after all.</p>
<p>Once you&rsquo;ve computed <code>t</code> you might as well stay in the inner loop with the <code>l &lt; t</code> condition, since there is no advantage anymore of the two tier check (indeed, it would be slower). So that answers the original query of svpv:</p>
<blockquote><p>
So in nearlydivisionless, is l &gt;= s the necessary and sufficient condition to produce an unbiased value?
</p></blockquote>
<p>No, it is not sufficient. The check <code>l &gt;= t</code> is the sufficient condition (strictly speaking it is not <em>necessary</em> for most s, since you could also choose some reduced interval and reject more values, but that would be dumb).</p>
<p>Thanks for setting me straight.</p>
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
<li id="comment-412365" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-18T16:19:30+00:00">June 18, 2019 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>Someone (not me) should submit a fix to std::uniform_int_distribution. At least in libstd++ it looks like a total dog in this respect, doing at least <em>two</em> divisions per random value generated:</p>
<p><code>if (__urngrange &gt; __urange)<br/>
{<br/>
// downscaling<br/>
const __uctype __uerange = __urange + 1; // __urange can be zero<br/>
const __uctype __scaling = __urngrange / __uerange;<br/>
const __uctype __past = __uerange * __scaling;<br/>
do<br/>
__ret = __uctype(__urng()) - __urngmin;<br/>
while (__ret &gt;= __past);<br/>
__ret /= __scaling;<br/>
}<br/>
</code></p>
<p>So something like 100+ cycles for generating a random int one many modern machines?</p>
</div>
<ol class="children">
<li id="comment-412414" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-06-19T00:05:29+00:00">June 19, 2019 at 12:05 am</time></a> </div>
<div class="comment-content">
<p>&#8230; and by &ldquo;fix&rdquo; I mean use this multiplicative technique.</p>
</div>
</li>
</ol>
</li>
<li id="comment-422269" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-05T22:44:51+00:00">August 5, 2019 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>Following some of my other comments on this thread, I put together a version of this that falls through to a multiply instead of a division if the initial check fails. It took me a bit of fumbling with basic arithmetic, but I eventually realized that extending to a 64-bit fraction only requires starting with the 32-bit version and a similar cascade through a couple of cheap-to-check conditions.</p>
<p>See the RangeGeneratorExtended here:<br/>
<a href="https://gist.github.com/KWillets/b6f76894c115e41339bcb8d34bf9ea49" rel="nofollow ugc">https://gist.github.com/KWillets/b6f76894c115e41339bcb8d34bf9ea49</a></p>
</div>
</li>
<li id="comment-427395" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-16T11:26:10+00:00">September 16, 2019 at 11:26 am</time></a> </div>
<div class="comment-content">
<p>Since Java does not have an 128 bit integer type:</p>
<p>Is it safe to &ldquo;downgrade&rdquo; this to output 32 bit random integers by using 64 bit where you used 128 bit, and 32 bit where you used 64 bit?</p>
</div>
<ol class="children">
<li id="comment-427397" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-16T11:43:39+00:00">September 16, 2019 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>Is there any difference to <a href="https://lemire.me/blog/2016/06/30/fast-random-shuffling/" rel="ugc">https://lemire.me/blog/2016/06/30/fast-random-shuffling/</a> besides now being published?</p>
</div>
<ol class="children">
<li id="comment-427399" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-16T12:09:30+00:00">September 16, 2019 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>The blog post you comment upon is entitled &ldquo;Nearly Divisionless Random Integer Generation On Various Systems&rdquo;. The post you refer to only benchmarked on one system (processor).</p>
</div>
</li>
</ol>
</li>
<li id="comment-427400" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-16T12:10:12+00:00">September 16, 2019 at 12:10 pm</time></a> </div>
<div class="comment-content">
<p>It is safe for 32-bit integers, yes.</p>
</div>
</li>
</ol>
</li>
</ol>
