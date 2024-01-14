---
date: "2013-08-16 12:00:00"
title: "Picking N distinct numbers at random: how to do it fast?"
index: false
---

[15 thoughts on &ldquo;Picking N distinct numbers at random: how to do it fast?&rdquo;](/lemire/blog/2013/08-16-picking-n-distinct-numbers-at-random-how-to-do-it-fast)

<ol class="comment-list">
<li id="comment-91758" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-24T13:53:47+00:00">August 24, 2013 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>I wonder how this compares?</p>
<p>(1) fill an array with 0 to Max random floating point numbers</p>
<p>(2) apply an index sort to the array (sort the array and return an index of elements in ascending order)</p>
<p>(3) output the first N values in the index</p>
</div>
</li>
<li id="comment-91761" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-24T17:52:04+00:00">August 24, 2013 at 5:52 pm</time></a> </div>
<div class="comment-content">
<p>In Perl Data Language, this algorithm takes two lines:</p>
<p>$result = qsorti(random($max));<br/>
p $result(0:($n-1));</p>
</div>
</li>
<li id="comment-91799" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T06:32:53+00:00">August 26, 2013 at 6:32 am</time></a> </div>
<div class="comment-content">
<p>@Peter Turney</p>
<p>I don&rsquo;t think your numbers are going to be distinct. In theory, it is possible that your approach would pick just one distinct value (repeated many times).</p>
<p>Update: I misread Peter&rsquo;s description.</p>
</div>
</li>
<li id="comment-91800" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T06:37:34+00:00">August 26, 2013 at 6:37 am</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re wrong. I&rsquo;ve been using exactly this code for years.</p>
</div>
</li>
<li id="comment-91801" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T06:49:24+00:00">August 26, 2013 at 6:49 am</time></a> </div>
<div class="comment-content">
<p>@Peter Turney</p>
<p>I misread your algorithm. Sorry.</p>
<p>Still, there is a probability (very small indeed) that all your floating point numbers are going to identical. In this sense, your algorithm is probabilistic&#8230; with good probability, it will solve the problem.</p>
<p>I&rsquo;ll add it to my benchmark later. Thanks.</p>
</div>
</li>
<li id="comment-91802" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T06:50:24+00:00">August 26, 2013 at 6:50 am</time></a> </div>
<div class="comment-content">
<p>An example might help:</p>
<p>pdl&gt; $ran=random(4)</p>
<p>pdl&gt; p $ran</p>
<p>[0.9474 0.8675 0.7389 0.4402]</p>
<p>pdl&gt; $sort=qsorti($ran)</p>
<p>pdl&gt; p $sort</p>
<p>[3 2 1 0]</p>
<p>(p = print; floats are truncated for display purposes; sort from smallest to largest; qsorti = quick sort and return index)</p>
<p>When you&rsquo;re using a high-level language (Perl Data Language, Matlab, etc.), you learn to avoid explicit loops by calling built-in functions that implicitly loop over vectors and matrices. In a high-level language, an algorithm without explicit loops is almost always much faster than an algorithm with explicit loops.</p>
</div>
</li>
<li id="comment-91804" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T06:53:14+00:00">August 26, 2013 at 6:53 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;Still, there is a probability (very small indeed) that all your floating point numbers are going to identical. In this sense, your algorithm is probabilisticâ€¦ with good probability, it will solve the problem.&rdquo;</p>
<p>If all the floating point numbers are identical and the sort preserves the original order when there is a tie, then the output will be [0 1 2 3 &#8230;]. It is not a problem if this output happens from time to time. It is a valid output, as long as it doesn&rsquo;t happen too often.</p>
</div>
<ol class="children">
<li id="comment-361191" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c447605516310a5f3fae578740376a7c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c447605516310a5f3fae578740376a7c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mandeep</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-31T05:48:46+00:00">October 31, 2018 at 5:48 am</time></a> </div>
<div class="comment-content">
<p>Quick sort isn&rsquo;t stable, so the relative ordering of elements might change (I&rsquo;m assuming qsort.. of perl is using quick sort). OTOH if its using merge sort, then you&rsquo;re right, the order will be preserved.</p>
</div>
</li>
</ol>
</li>
<li id="comment-91805" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T07:15:19+00:00">August 26, 2013 at 7:15 am</time></a> </div>
<div class="comment-content">
<p>@Peter Turney</p>
<p>That&rsquo;s right, but even a tie between two floating point numbers, if ties are always resolved in the same deterministic manner, will introduce a bias.</p>
<p>I assume that Perl will use 64-bit floating point numbers&#8230; in such a case, your algorithm to generate distinct 32-bit integers has a negligible bias. </p>
<p>(I should note that even my algorithms have biases in practice. They are only free of biases if I assume that I have a perfect random number generators.)</p>
<p>Of course, the interesting question is speed. The way you describe your algorithm, it runs in time O(Max), so that we might expect that when N is much smaller than Max, then your algorithm is slow compared to the hash set approach. My instinct is that even when N is close to Max, your algorithm is slower than the bitmap approach. Of course, I&rsquo;ll need to verify this more seriously.</p>
</div>
</li>
<li id="comment-91806" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T07:37:38+00:00">August 26, 2013 at 7:37 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;The way you describe your algorithm, it runs in time O(Max)&rdquo;</p>
<p>Actually O(Max log(Max)) due to sorting. But if you implement all the algorithms in a high-level language, I&rsquo;m guessing mine will run the fastest, due to the lack of explicit loops. For me, the time and effort I save by writing programs in a high-level language is more important than the speed I can get from the computer by working in a lower-level language (in most cases, with some rare exceptions).</p>
</div>
</li>
<li id="comment-91807" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com/" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T07:48:54+00:00">August 26, 2013 at 7:48 am</time></a> </div>
<div class="comment-content">
<p>Also, what if you don&rsquo;t want the final list in sorted order? What if the task is to shuffle the numbers in the list [0,Max]? (This is a typical task for my work.) Then your N/2 select/drop inversion trick is not applicable.</p>
</div>
</li>
<li id="comment-91812" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-08-26T10:25:57+00:00">August 26, 2013 at 10:25 am</time></a> </div>
<div class="comment-content">
<p>@Peter Turney</p>
<p>As for focusing on the performance one gets using Perl&#8230; see my post &ldquo;The language interpreters are the new machines&rdquo;: <a href="https://lemire.me/blog/archives/2011/06/14/the-language-interpreters-are-the-new-machines/" rel="ugc">http://lemire.me/blog/archives/2011/06/14/the-language-interpreters-are-the-new-machines/</a></p>
<p>Much of the traditional computer science is focused on designing algorithms from basic operations (and this is what I do here with C++ and Java), but this is increasingly less relevant.</p>
<p>But not everything is black and white. For some problems, it is definitively worth it to get a 10x speed-up. Google&rsquo;s backend could not be written in pure Perl. 😉</p>
<p>Back to the problem at hand&#8230;</p>
<p>If you want to shuffle a list, then a Fisherâ€“Yates shuffle is probably best. Such shuffling is part of Java, C++(STL) and Python. I don&rsquo;t know about Perl but I have read online that you can find a shuffle function in List::Util. So I would argue that in many instances, you shouldn&rsquo;t code a list shuffling algorithm by hand.</p>
</div>
</li>
<li id="comment-245799" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9522425587344b887bcb7c65d236f3a3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9522425587344b887bcb7c65d236f3a3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.demofox.org" class="url" rel="ugc external nofollow">Demofox</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-06-30T13:44:57+00:00">June 30, 2016 at 1:44 pm</time></a> </div>
<div class="comment-content">
<p>You should check out format preserving encryption.</p>
<p>The basic idea is this: hashing has collisions, but encryption does not, so you can encrypt an int as you increment it to get distinct random numbers. A (solvable) challenge is finding an encryption algorithm that tightly fits the range of numbers you are generating.</p>
<p><a href="http://blog.demofox.org/2013/07/06/fast-lightweight-random-shuffle-functionality-fixed/" rel="nofollow ugc">http://blog.demofox.org/2013/07/06/fast-lightweight-random-shuffle-functionality-fixed/</a></p>
</div>
</li>
<li id="comment-408626" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/874bcba40024d48919097b29a25e852d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/874bcba40024d48919097b29a25e852d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zv.github.io" class="url" rel="ugc external nofollow">zv</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-24T07:13:34+00:00">May 24, 2019 at 7:13 am</time></a> </div>
<div class="comment-content">
<p>A trick I picked up awhile ago was using block ciphers to generate N distinct random numbers.</p>
<p>For example, here&rsquo;s an example of an (unbalanced) Feistel network which does just this:</p>
<p><code>uint16_t feistel(uint16_t counter, unsigned period)<br/>
{<br/>
uint16_t d = sqrt(period);<br/>
uint16_t s = period - d*d;<br/>
uint16_t q = counter / d;<br/>
uint16_t r = counter % s;</p>
<p> for (int i = 0; i &lt; 3; i++)<br/>
{<br/>
uint16_t nr = r;<br/>
uint16_t F = (i * r + q);<br/>
r = F % d;<br/>
q = nr;<br/>
}</p>
<p> return q*d + r;<br/>
}</p>
<p>int main() {<br/>
for(int i = 1; i &lt;= 16; i++) {<br/>
printf("%d %d\n", i, feistel(i, 15));<br/>
}<br/>
}<br/>
</code></p>
<p>You can achieve a perfect permutation for any N (<code>period</code> here) by adjusting how <code>nr</code> ae</p>
</div>
<ol class="children">
<li id="comment-409882" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/221c34e76f43eb000312f7f5038eb619?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/221c34e76f43eb000312f7f5038eb619?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gé Weijers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-31T23:42:20+00:00">May 31, 2019 at 11:42 pm</time></a> </div>
<div class="comment-content">
<p>These methods are producing permutations, but it&rsquo;s a vanishingly small set of the possible ones.</p>
<p>A 100 element set has 100! possible permutations, and your algorithm can select no more than 65536 of them.</p>
</div>
</li>
</ol>
</li>
</ol>
