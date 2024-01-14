---
date: "2017-09-26 12:00:00"
title: "Benchmarking algorithms to visit all values in an array in random order"
index: false
---

[5 thoughts on &ldquo;Benchmarking algorithms to visit all values in an array in random order&rdquo;](/lemire/blog/2017/09-26-benchmarking-algorithms-to-visit-all-values-in-an-array-in-random-order)

<ol class="comment-list">
<li id="comment-288704" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Sean O'Connor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-10-12T14:05:26+00:00">October 12, 2017 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://en.wikipedia.org/wiki/Low-discrepancy_sequence#Additive_recurrence" rel="nofollow ugc">https://en.wikipedia.org/wiki/Low-discrepancy_sequence#Additive_recurrence</a></p>
</div>
</li>
<li id="comment-293561" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78d54d299a4887638d7edc0a025464bc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78d54d299a4887638d7edc0a025464bc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Max</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-15T14:08:05+00:00">December 15, 2017 at 2:08 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;and we set prime to be an adequately chosen random number that is coprime with n and not too small.&rdquo;<br/>
Fun fact: So how to count down?<br/>
Choose start value to be 0 and the coprime to be n-1.</p>
</div>
</li>
<li id="comment-562023" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">CamelCoder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T11:33:39+00:00">December 14, 2020 at 11:33 am</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t it possible to create an LCG with the modulo of n?<br/>
That would only cost one more multiplication and have the same time complexity that the additive method, whiles having way higher quality randomness. The initialization times are worse, though that should be benchmarked separately, as one can reuse the a constant and only compute new values for c to visit if the array length stays the same.</p>
<p>I wanted to try this my self, but your code seems to be not quite right:</p>
<p><code>static uint32_t productOfAllPrimeDivisors(uint32_t val) {<br/>
uint32_t pot = 2;<br/>
uint32_t answer = 1;<br/>
while ((uint64_t)pot &lt;= val / 2) {<br/>
if (IsPrime(pot)) { // but pot is never modified<br/>
answer *= pot;<br/>
while ((val % pot) == 0) {<br/>
val /= pot;<br/>
}<br/>
}<br/>
}<br/>
return answer;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-562070" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-14T21:07:45+00:00">December 14, 2020 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p><em>Isn’t it possible to create an LCG with the modulo of n?</em></p>
<p>Yes but I expect you will find that it is slower.</p>
</div>
</li>
</ol>
</li>
<li id="comment-565479" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3bae5aad082e5673aebbaf4e6fb3473e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3bae5aad082e5673aebbaf4e6fb3473e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon Labrecque</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-07T04:43:14+00:00">January 7, 2021 at 4:43 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s awesome. Thanks!</p>
</div>
</li>
</ol>
