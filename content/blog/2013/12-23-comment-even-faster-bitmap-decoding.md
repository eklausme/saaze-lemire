---
date: "2013-12-23 12:00:00"
title: "Even faster bitmap decoding"
index: false
---

[13 thoughts on &ldquo;Even faster bitmap decoding&rdquo;](/lemire/blog/2013/12-23-even-faster-bitmap-decoding)

<ol class="comment-list">
<li id="comment-103479" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-23T13:04:12+00:00">December 23, 2013 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>For the lab, why not just use a table for the rightmost 8 bits or so? Something like</p>
<p>while(val) {<br/>
lsb = table[val&amp;255];<br/>
if( lsb &lt; 9 ) {<br/>
output lsb-1;<br/>
val &gt;&gt;= lsb;<br/>
} else val &gt;&gt;= 8;<br/>
}</p>
<p>Basically the table is 1+the position of the 1 in the byte, 9 for the 0x00 edge case (maybe some other test would work better for that). You only waste a loop 1/256th of the time.</p>
</div>
</li>
<li id="comment-103482" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-23T14:00:08+00:00">December 23, 2013 at 2:00 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>I understand that you are trying to improve the identification of the least significant bit. This is equivalent to improving the implementation of Java&rsquo;s Long.numberOfTrailingZeros. I think if you can do this, you could become semi-famous.</p>
<p>I am suspicious about your memoization approach because a table made of 256 integers is quite large. Accessing such a table is likely slow compared to basic integer operations.</p>
</div>
</li>
<li id="comment-103489" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-23T15:41:10+00:00">December 23, 2013 at 3:41 pm</time></a> </div>
<div class="comment-content">
<p>Most library implementations stay away from table-based approaches for obvious reasons: the tables are large, and the first call will stall while the cache lines are read in. However if you&rsquo;ve determined that this function is going to be called heavily then some judicious use of tables or enumerative switch statements is called for. </p>
<p>The actual table size is tiny since the values are 0-7 or so (on second thought I would handle 0x00 in code and not as an extra table value). A 16-way table would fit into 32 bits.</p>
<p>Another (long known) method I&rsquo;ve used in C is simply to convert to float and mask/shift the exponent to get the high bit. I&rsquo;m not sure how far you&rsquo;re willing to go with this (SSE?), but hacky solutions are many.</p>
</div>
</li>
<li id="comment-103493" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-23T16:19:02+00:00">December 23, 2013 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>Can you spell out your approach again for me? I just don&rsquo;t understand what you have in mind. Note that we work with 64-bit words. I suppose you can take your 64-bit words and iterate over them as 8 x 8-bit words but I fear this will introduce quite a bit of expensive branching.</p>
<p>If you have a look at my code (see <a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2013/12/23" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2013/12/23</a>), you will find a table-based approach that was reported to be faster than the bitCount approach but, at least on my core i7, it is slower. It is a tiny table and the only catch is a 64-bit multiplication. Even so, it is slower than calling bitCount.</p>
<p>The smarter our processors get, the less memoization is useful. You are often better off computing cheap things from scratch rather than look them up&#8230; at least as long as there is no expensive branching involved.</p>
</div>
</li>
<li id="comment-103505" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-23T19:07:18+00:00">December 23, 2013 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>This is the 4-bit-suffix version in C. The basic idea is to lookup the rightmost 4 bits in a table for the location of the least significant bit, then shift past it and iterate. At lower densities it will definitely suffer.</p>
<p>Also, forgot crucial variable in my earlier sketch :(.</p>
<p>void bits( int v, int *out, int *nout) {</p>
<p> // lowest-order 1 positions: 16-values, 2 bits each<br/>
int lsbs = (0&lt;&lt;0) + (0&lt;&lt;2) + (1&lt;&lt;4) + (0&lt;&lt;6) + (2&lt;&lt;8) + (0&lt;&lt;10) + (1&lt;&lt;12) + (0&lt;&lt;14)<br/>
+ (3&lt;&lt;16) + (0&lt;&lt;18) + (1&lt;&lt;20) + (0&lt;&lt;22) + (2&lt;&lt;24) + (0&lt;&lt;26) + (1&lt;&lt;28) + (0&lt;&lt;30)<br/>
;</p>
<p> int shift = 0;</p>
<p> while(v) {<br/>
int mask = v &amp; 15;<br/>
int lsb;<br/>
if( mask ) {<br/>
lsb = (lsbs&gt;&gt;( mask&lt;&lt;1 )) &amp; 3;<br/>
out[*nout] = shift + lsb;<br/>
*nout += 1;<br/>
}<br/>
else<br/>
lsb = 3;</p>
<p> v &gt;&gt;= (lsb + 1);<br/>
shift += (lsb + 1);<br/>
}</p>
<p>}</p>
</div>
</li>
<li id="comment-103765" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-26T22:42:22+00:00">December 26, 2013 at 10:42 pm</time></a> </div>
<div class="comment-content">
<p>I totally agree with Daniel. In fact, reading even from L1 takes a couple of CPU cycles. At the same time, you can probably execute a couple of bit-counting intrinsics in a single CPU cycle.</p>
<p>It posted another well-known memoization approach online. And its performance is even more pathetic. It is up to 8 times slower than a naive approach in C++.</p>
<p>BTW, with -march=native flag (again on core i7) the naive approach apparently outperforms everything else by a good margin (up to 30%):</p>
<p><a href="https://github.com/searchivarius/BlogCode/tree/master/2013/12/StupidMemoryBitscan" rel="nofollow ugc">https://github.com/searchivarius/BlogCode/tree/master/2013/12/StupidMemoryBitscan</a></p>
</div>
</li>
<li id="comment-103821" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T10:30:52+00:00">December 27, 2013 at 10:30 am</time></a> </div>
<div class="comment-content">
<p>PS: Sorry, it wasn&rsquo;t naive, it was bitcan1, looked at the wrong column in the output.</p>
</div>
</li>
<li id="comment-103829" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T11:21:01+00:00">December 27, 2013 at 11:21 am</time></a> </div>
<div class="comment-content">
<p>I agree that the intrinsic is definitely faster; it&rsquo;s just that the last time I dealt with this I don&rsquo;t think there were any consistent instructions to do this. So mine is just a suggestion for bare-bones processors these days.</p>
</div>
</li>
<li id="comment-103832" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T11:30:30+00:00">December 27, 2013 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>I think that instructions such as x86&rsquo;s BSR have been around for a long time (as far back as the Intel 386). Still, it is likely that if you go that far back, BSR was probably slow and the lack of smart superscalar execution and branch prediction might have made memoization worth it.</p>
</div>
</li>
<li id="comment-104103" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T16:23:13+00:00">December 30, 2013 at 4:23 pm</time></a> </div>
<div class="comment-content">
<p>What jvm version did you use for your benchmark? I&rsquo;m seeing that numberOfTrailingZeros is consistently faster than bitCount on java 6u33 which is surprising to me since bitCount is branchless.</p>
</div>
</li>
<li id="comment-104107" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T16:40:46+00:00">December 30, 2013 at 4:40 pm</time></a> </div>
<div class="comment-content">
<p>@Plaisance</p>
<p>The benchmarks were with Java 7 on a recent Intel core i7 processor.</p>
<p>Here is my exact output:</p>
<pre style="overflow-y: scroll">
1 15.721772394850259 130.7076604166934 108.14306849412094 142.57966656658982 47.07466682521651 109.05387639509533
1 15.719865221400806 130.75023263556812 108.23983388274465 142.48395929541155 47.055448709307086 109.01093059260431
2 27.581771325981062 203.46921947232224 144.26321503767772 196.22725379809336 54.640605791918645 174.86125467743133
2 27.580898096812284 203.41295240307974 144.517990570322 196.2934226766008 54.61655047032696 174.79773330962325
4 46.18731765151476 278.1934945975009 178.2828904319236 210.16702578352476 62.038651431607924 264.8420813395451
4 46.18743343030088 278.1961657021847 178.40839167364427 210.06200874486856 62.01685890854171 265.122615285776
8 69.45215572862662 369.4220746581799 199.97836654758095 276.3127587215588 76.64864861923547 343.31817552020885
8 69.47323783413718 369.0569650016884 199.97733460115012 276.35278123012506 76.73822955437699 343.1901170217992
16 91.62453922232 455.65586979005445 212.64403795214915 341.16565104787577 98.03713889055986 408.3932414941178
16 91.6183671298949 455.4029909131834 212.6857679140175 340.7542524764352 98.00478438937044 408.22104217767463
</pre>
</div>
</li>
<li id="comment-104108" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/530ee6794861e89d935ced6a18bb87a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Plaisance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T16:52:41+00:00">December 30, 2013 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, problem was that I wrote my own benchmark and was only testing the lowest bit in each long, after fixing to test all the bits i&rsquo;m getting consistent results on both java 6 and java 7 that agree with yours.</p>
</div>
</li>
<li id="comment-297600" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a5ed87a7ed787ce293e77fcbff6a75ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a5ed87a7ed787ce293e77fcbff6a75ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Claus Larsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-01T12:29:10+00:00">March 1, 2018 at 12:29 pm</time></a> </div>
<div class="comment-content">
<p>I realize that this post is a few years old, but I stumbled upon it in my quest for a faster nextSetBit(int fromIndex) on the Java BitSet.</p>
<p>Actually, my quest was for a faster way to do:</p>
<p><code>for (int i = bs.nextSetBit(0); i &gt;= 0; i = bs.nextSetBit(i + 1)) {<br/>
</code></p>
<p>And I wanted to share my new way of doing this, which on a dense set is about 4-5 times faster than the for loop above and on sets with about 50% density about 3 times faster. Results may vary, I have only done some simple testing.</p>
<p><code> interface BitSetCallback {<br/>
void nextSetBit(int i);<br/>
}<br/>
public void nextSetBitCallBack(BitSetCallback cb) {<br/>
long[] words = this.words;<br/>
int wordsInUse = words.length;<br/>
int u = 0;<br/>
int indexCounter = 0;<br/>
while (u &lt; wordsInUse) {<br/>
long word = words[u];<br/>
while (word != 0) {<br/>
long idx = word &amp; 1;<br/>
while (idx == 0) {<br/>
word &gt;&gt;&gt;= 1;<br/>
++indexCounter;<br/>
idx = word &amp; 1;<br/>
}<br/>
cb.nextSetBit(indexCounter);<br/>
word &gt;&gt;&gt;= 1;<br/>
++indexCounter;<br/>
}<br/>
++u;<br/>
}<br/>
}<br/>
</code></p>
</div>
</li>
</ol>
