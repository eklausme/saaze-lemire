---
date: "2013-12-26 12:00:00"
title: "Fastest way to compute the greatest common divisor"
index: false
---

[34 thoughts on &ldquo;Fastest way to compute the greatest common divisor&rdquo;](/lemire/blog/2013/12-26-fastest-way-to-compute-the-greatest-common-divisor)

<ol class="comment-list">
<li id="comment-103747" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3d9050d6870dcfaf7f207cd5ca2b50b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3d9050d6870dcfaf7f207cd5ca2b50b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://hbfs.wordpress.com/" class="url" rel="ugc external nofollow">Steven Pigeon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-26T18:53:03+00:00">December 26, 2013 at 6:53 pm</time></a> </div>
<div class="comment-content">
<p>What I don&rsquo;t get is that you have a speedup only on numbers of the form m—2^k and n—2^j, and the speed-up is proportional to min(j,k). How do you explain doubling the speed if asymptotically few pairs of numbers are of that form?</p>
</div>
</li>
<li id="comment-103739" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">lecteur habituel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-26T17:45:45+00:00">December 26, 2013 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>euclyd, not euler.</p>
<p>Thanks for the post!</p>
</div>
<ol class="children">
<li id="comment-372670" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3130af0997f57e069afc040c8463859e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3130af0997f57e069afc040c8463859e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maths Brane</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-12T21:18:42+00:00">December 12, 2018 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>Yea, I heart Euler, but this is Euclid, all day.</p>
</div>
</li>
</ol>
</li>
<li id="comment-103743" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-26T18:21:17+00:00">December 26, 2013 at 6:21 pm</time></a> </div>
<div class="comment-content">
<p>Another excellent example of shaving off constants!</p>
</div>
</li>
<li id="comment-103813" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3d9050d6870dcfaf7f207cd5ca2b50b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3d9050d6870dcfaf7f207cd5ca2b50b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://hbfs.wordpress.com/" class="url" rel="ugc external nofollow">Steven Pigeon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T09:27:49+00:00">December 27, 2013 at 9:27 am</time></a> </div>
<div class="comment-content">
<p>They&rsquo;re not quadratic, they&rsquo;re O(lg min(a,b)).</p>
<p>see:</p>
<p><a href="https://en.wikipedia.org/wiki/Euclidean_algorithm#Algorithmic_efficiency" rel="nofollow ugc">http://en.wikipedia.org/wiki/Euclidean_algorithm#Algorithmic_efficiency</a></p>
</div>
</li>
<li id="comment-103839" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/459e618cf38006bdc543e535c854f163?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/459e618cf38006bdc543e535c854f163?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.facebook.com/md2perpe?_rdr" class="url" rel="ugc external nofollow">Per Persson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T12:39:30+00:00">December 27, 2013 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;And someone ought to update the corresponding Wikipedia page.&rdquo;</p>
<p>Why don&rsquo;t you do it yourself?</p>
</div>
</li>
<li id="comment-103846" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/459e618cf38006bdc543e535c854f163?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/459e618cf38006bdc543e535c854f163?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.facebook.com/md2perpe?_rdr" class="url" rel="ugc external nofollow">Per Persson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T13:32:05+00:00">December 27, 2013 at 1:32 pm</time></a> </div>
<div class="comment-content">
<p>By the way, the numbers you used for testing are relatively small. More complicated algorithms are often slower for small numbers and don&rsquo;t show their efficiency until the numbers are bigger. Without using anything bigger than uint32 you could test numbers of size ~1&rsquo;000&rsquo;000&rsquo;000.</p>
</div>
</li>
<li id="comment-103808" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T09:07:52+00:00">December 27, 2013 at 9:07 am</time></a> </div>
<div class="comment-content">
<p>If you care about asymptotics, then both of these are quadratic. For a subquadratic algorithm, you need something like a half-gcd based algorithm.</p>
</div>
</li>
<li id="comment-103814" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T09:51:03+00:00">December 27, 2013 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>@Pigeon</p>
<p>It is not necessary for the numbers to be divisible by two for them to benefit from the binary GCD.</p>
<p>Take 3 and 5. After the first pass in the loop you get 3 and 2. The 2 gets back to 1 due to the ctz shift. </p>
<p>The nice thing with the binary GCD is that it does not use any expensive operation (ctz is quite cheap on recent Intel processors) whereas the basic GCD relies on integer division.</p>
</div>
</li>
<li id="comment-103816" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T10:04:03+00:00">December 27, 2013 at 10:04 am</time></a> </div>
<div class="comment-content">
<p>They are quadratic when considering operations with integers that are larger than an unsigned int/long. </p>
<p>For example, see: <a href="https://gmplib.org/manual/Greatest-Common-Divisor-Algorithms.html" rel="nofollow ugc">https://gmplib.org/manual/Greatest-Common-Divisor-Algorithms.html</a> and <a href="https://gmplib.org/manual/Binary-GCD.html" rel="nofollow ugc">https://gmplib.org/manual/Binary-GCD.html</a></p>
</div>
</li>
<li id="comment-103823" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8bdba15f7c964f8c02fba3b8f6707608?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8bdba15f7c964f8c02fba3b8f6707608?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+RalphCorderoy/about" class="url" rel="ugc external nofollow">Ralph Corderoy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T10:53:47+00:00">December 27, 2013 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, I can trim another 12% off your gcd() above by removing the two redundant shifts by &ldquo;shift&rdquo; of &ldquo;u&rdquo; and &ldquo;v&rdquo; that occur before the loop.</p>
</div>
</li>
<li id="comment-103826" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T11:10:09+00:00">December 27, 2013 at 11:10 am</time></a> </div>
<div class="comment-content">
<p>@Ralph</p>
<p>Well done. I have updated my blog post and credited you for the gains.</p>
</div>
</li>
<li id="comment-103841" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T12:46:11+00:00">December 27, 2013 at 12:46 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if you could save a cmpl by reusing the u &gt; v comparison for the loop break as well. That is:</p>
<p> if( u == v)<br/>
break;<br/>
else if (u &gt; v)<br/>
&#8230;</p>
<p>This will shorten the last iteration and probably speed up the speculative execution.</p>
</div>
</li>
<li id="comment-103845" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T13:29:43+00:00">December 27, 2013 at 1:29 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>With clang, your version is faster. With GCC, the version in the blog post is faster. The difference is within 10%.</p>
<p>If I played with compiler flags, there might be other differences as well.</p>
<p>In any case, your version is on github if you want to benchmark it.</p>
</div>
</li>
<li id="comment-103848" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-27T13:46:14+00:00">December 27, 2013 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>@Persson </p>
<p>I have added a test in my code with large numbers but it makes no difference. Of course, these are word-size integers&#8230; results would differ with big integers.</p>
</div>
</li>
<li id="comment-103916" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8bdba15f7c964f8c02fba3b8f6707608?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8bdba15f7c964f8c02fba3b8f6707608?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://plus.google.com/+RalphCorderoy/about" class="url" rel="ugc external nofollow">Ralph Corderoy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-28T05:57:48+00:00">December 28, 2013 at 5:57 am</time></a> </div>
<div class="comment-content">
<p>Hi again Daniel, I can save a further 7.5% on my earlier suggestion by altering the loop to</p>
<p> do {<br/>
unsigned m;<br/>
v &gt;&gt;= __builtin_ctz(v);<br/>
m = (v ^ u) &amp; -(v &lt; u);<br/>
u ^= m;<br/>
v ^= m;<br/>
v -= u;<br/>
} while (v);</p>
</div>
</li>
<li id="comment-103935" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3d9050d6870dcfaf7f207cd5ca2b50b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3d9050d6870dcfaf7f207cd5ca2b50b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://hbfs.wordpress.com/" class="url" rel="ugc external nofollow">Steven Pigeon</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-28T12:37:54+00:00">December 28, 2013 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>I have re-run tests with a version using the built-ins. The speed-ups are there indeed: 40% on larger numbers.</p>
<p><a href="http://hbfs.wordpress.com/2013/12/10/the-speed-of-gcd/" rel="nofollow ugc">http://hbfs.wordpress.com/2013/12/10/the-speed-of-gcd/</a></p>
<p>(and @Mike I think the state of the art for fast division is O(n^log_2(3)), which is still more than linear, but subquadratic.)</p>
</div>
</li>
<li id="comment-103930" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-28T11:38:56+00:00">December 28, 2013 at 11:38 am</time></a> </div>
<div class="comment-content">
<p>For my tweak the assembler output from gcc has the comparison, then a branch to the top of the loop, then the same comparison :(. The second comparison isn&rsquo;t reachable by any other path either. </p>
<p>Maybe some syntactic shuffling would trigger the optimization; I may give it a few tries later.</p>
</div>
</li>
<li id="comment-103964" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-28T20:22:52+00:00">December 28, 2013 at 8:22 pm</time></a> </div>
<div class="comment-content">
<p>This is faster on my version of gcc:</p>
<p>{<br/>
int shift, uz, vz;<br/>
uz = __builtin_ctz(u);<br/>
if ( u == 0) return v;</p>
<p> vz = __builtin_ctz(v);<br/>
if ( v == 0) return u;</p>
<p> shift = uz &gt; vz ? vz : uz;</p>
<p> u &gt;&gt;= uz;</p>
<p> do {<br/>
v &gt;&gt;= vz;</p>
<p> if (u &gt; v) {</p>
<p> unsigned int t = v;<br/>
v = u;<br/>
u = t;<br/>
} </p>
<p> v = v &#8211; u;<br/>
vz = __builtin_ctz(v);<br/>
} while( v != 0 );</p>
<p> return u &lt;&lt; shift;<br/>
}</p>
<p>Results:</p>
<p>gcd between numbers in [1 and 2000]<br/>
26.4901 17.6991 32.7869 25.974 24.3902 31.746 36.6972</p>
<p>I was actually trying to get it to utilize the fact that ctz sets the == 0 flag when its argument is 0, so a following test against 0 should not need an extra instruction. However the compiler didn&#039;t notice. Instead it set up some interesting instruction interleaving so that the v != 0 test is actually u == v before the subtraction; I believe this is to enable ILP.</p>
<p>Also, using an inline xchg instruction for the swap doubles the speed:</p>
<p>gcd between numbers in [1 and 2000]<br/>
26.1438 16.3934 33.6134 25.974 25.4777 30.5344 72.7273<br/>
gcd between numbers in [1000000001 and 1000002000]<br/>
26.1438 16 33.8983 25.974 25.3165 29.6296 72.7273</p>
</div>
</li>
<li id="comment-104025" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-29T13:09:16+00:00">December 29, 2013 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>Thanks. I have added your code to the benchmark.</p>
<p>Do you have the code for the version with the xchg instruction?</p>
</div>
</li>
<li id="comment-104026" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-29T13:09:45+00:00">December 29, 2013 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>@Ralph</p>
<p>I added your version to the benchmark.</p>
</div>
</li>
<li id="comment-104028" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-29T13:23:48+00:00">December 29, 2013 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s the asm for the swap; I just replaced the part inside the brackets with xswap(u,v):</p>
<p>#define xswap(a,b) __asm__ (\<br/>
&ldquo;xchg %0, %1\n&rdquo;\<br/>
: : &ldquo;r&rdquo;(a), &ldquo;r&rdquo; (b));</p>
<p>Unfortunately I don&rsquo;t understand if this is correctly defined (I copied it from some poorly-documented examples), but the assembler output looks good.</p>
</div>
</li>
<li id="comment-104030" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-29T14:46:12+00:00">December 29, 2013 at 2:46 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets </p>
<p>I have checked into github a version with your inline assembly (slightly tweaked to be more standard). It is not faster. </p>
<p>When I ran your code &ldquo;as is&rdquo; I got failed tests.</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2013/12/26/gcd.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2013/12/26/gcd.cpp</a></p>
</div>
</li>
<li id="comment-104092" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T12:54:19+00:00">December 30, 2013 at 12:54 pm</time></a> </div>
<div class="comment-content">
<p>Looking at Steven&rsquo;s asm listings, I realized that my compiler was significantly behind, so I downloaded 3G of Apple &ldquo;updates&rdquo; last night. These results are now from clang-500.2.79.</p>
<p>I started playing around with various ways of getting abs(v-u) (especially when unsigned) and also realized that bsfl(x) == bsfl(-x), so this works for the inner loop on gcdwikipedia5fast:</p>
<p>do {<br/>
v &gt;&gt;= vz;<br/>
unsigned int diff =v;<br/>
diff -= u;<br/>
vz = __builtin_ctz(diff);<br/>
if( diff == 0 ) break;<br/>
if ( v &lt; u ) {<br/>
u = v;<br/>
v = 0 &#8211; diff;<br/>
} else<br/>
v = diff;</p>
<p> } while( 1 );</p>
<p>If diff is signed 32-bit it&#039;s slightly faster, abs(diff) can be used, and the v &lt; u test can be switched to diff &lt; 0 for a slight gain. But it becomes a 31-bit algorithm. I haven&#039;t tried signed 64-bit yet.</p>
<p>Using bsfl(diff) instead of v seems to speed it up significantly; it&#039;s probably ILP again since it doesn&#039;t have to wait for v to finalize.</p>
</div>
</li>
<li id="comment-104093" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T13:02:04+00:00">December 30, 2013 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Hold on, I just tried signed 64-bit and got a huge boost:</p>
<p>do {<br/>
v &gt;&gt;= vz;<br/>
long long int diff = v ;<br/>
diff -= u;<br/>
vz = __builtin_ctz(diff);<br/>
if( diff == 0 ) break;<br/>
if ( diff &lt; 0 )<br/>
u = v;<br/>
v = abs(diff);</p>
<p> } while( 1 );</p>
</div>
</li>
<li id="comment-104094" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T13:26:34+00:00">December 30, 2013 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p>I added these two alternatives to the benchmark.</p>
<p>I find that results vary a lot depending on the compiler and processor. It is hard to identify a clear winner&#8230; except that they are all faster than the Euclidean algorithm with remainder.</p>
</div>
</li>
<li id="comment-104097" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-12-30T14:37:02+00:00">December 30, 2013 at 2:37 pm</time></a> </div>
<div class="comment-content">
<p>I checked the new revision and the 64-bit version (7) should use abs() and a few other edits. </p>
<p>Should I be submitting edits to github?</p>
</div>
</li>
<li id="comment-264193" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/452997c7d925c0d9e22b130aa86826c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/452997c7d925c0d9e22b130aa86826c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Taeseung Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-12-30T15:19:14+00:00">December 30, 2016 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the post!</p>
</div>
</li>
<li id="comment-404331" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a0dd4fdfe005cfca8bfcefd2adc086a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a0dd4fdfe005cfca8bfcefd2adc086a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/detailyang" class="url" rel="ugc external nofollow">detailyang</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-04-29T13:54:38+00:00">April 29, 2019 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s cool and it&rsquo; faster 3x than mod in my golang implement</p>
</div>
</li>
<li id="comment-562172" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T14:15:55+00:00">December 15, 2020 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s possible to slightly improve Ralph Corderoy&rsquo;s branch-free code above (Dec. 28 comment) by using a difference delta rather than an xor delta.</p>
<p>If you don&rsquo;t mind limiting the input range to INT_MAX, the sign of (int)(v-u) can be used to control the swap:</p>
<p><code>v -= u;<br/>
mask = (int)v &gt;&gt; 31;<br/>
u += v &amp; mask; /* u + (v - u) = v */<br/>
v = (v + mask) ^ mask; /* Conditional negate ~(v - 1) = -v */<br/>
</code></p>
<p>If you want to accept inputs up to UINT_MAX, it&rsquo;s still possible to combine the subtract and mask formation with a bit of asm magic (x86 AT&amp;T syntax) to get access to the carry flag:</p>
<p><code>asm("sub %2,%1; sbb %0,%0" : "=r" (mask), "+r" (v) : "g" (u));<br/>
</code></p>
<p>Depending on the CPU, it may be worth spending an instruction to clear the mask to avoid a false dependency on its previous value. Add<br/>
, &ldquo;0&rdquo; (0)<br/>
to the end of the list of input parameters. (For those not familiar with GCC asm syntax, the 0 in quotes means that this input operand should be in the same register as output operand 0, the mask. The 0 in parens is the operand value. GCC will generate an <code>xorl</code> instruction to zero the mask.)</p>
</div>
<ol class="children">
<li id="comment-562177" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-12-15T15:06:28+00:00">December 15, 2020 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>Your proposal was added to the benchmark. Here are the numbers on my laptop:</p>
<pre><code>❯ ./gcd
gcd between numbers in [1 and 2000]
Running tests... Ok!
We proceed to report timings (smaller values are better).
basicgcd                    54.0541
gcdwikipedia2               23.5294
gcdwikipedia2fast           66.6667
gcd_recursive               54.0541
gcd_iterative_mod           53.3333
gcdFranke                   68.9655
gcdwikipedia3fast           66.6667
gcdwikipedia4fast           54.0541
gcdwikipedia5fast           66.6667
gcdwikipedia2fastswap       64.5161
gcdwikipedia7fast           86.9565
gcdwikipedia7fast32         85.1064
gcdwikipedia8Spelvin        58.8235

gcd between numbers in [1000000001 and 1000002000]
Running tests... Ok!
We proceed to report timings (smaller values are better).
basicgcd                    54.0541
gcdwikipedia2               23.6686
gcdwikipedia2fast           66.6667
gcd_recursive               53.3333
gcd_iterative_mod           54.0541
gcdFranke                   68.9655
gcdwikipedia3fast           65.5738
gcdwikipedia4fast           54.7945
gcdwikipedia5fast           66.6667
gcdwikipedia2fastswap       64.5161
gcdwikipedia7fast           86.9565
gcdwikipedia7fast32         83.3333
gcdwikipedia8Spelvin        58.8235
</code></pre>
</div>
<ol class="children">
<li id="comment-623018" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7d4ffb0988bc6358f35c212cb95610c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7d4ffb0988bc6358f35c212cb95610c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/saucecontrol" class="url" rel="ugc external nofollow">Clinton Ingram</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-12T22:13:50+00:00">March 12, 2022 at 10:13 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve just noticed your benchmarks don&rsquo;t change the number range between runs &#8212; the offset is used only in the tests. With the benchmarks corrected, the mod approach shows faster on the larger value range. </p>
<p>Also noting the label on the results is misleading. The benchmark appears to be calculating ops per ms, not the timings directly, so larger is better.</p>
<p>Results on my TGL-H laptop after corrections:</p>
<p><code><br/>
gcd between numbers in [1 and 2000]<br/>
Running tests... Ok!<br/>
Kops/ms (larger values are better).<br/>
basicgcd 50<br/>
gcdwikipedia2 20.3046<br/>
gcdwikipedia2fast 44.4444<br/>
gcd_recursive 50<br/>
gcd_iterative_mod 48.1928<br/>
gcdFranke 46.5116<br/>
gcdwikipedia3fast 45.4545<br/>
gcdwikipedia4fast 61.5385<br/>
gcdwikipedia5fast 44.9438<br/>
gcdwikipedia2fastswap 43.0108<br/>
gcdwikipedia7fast 48.1928<br/>
gcdwikipedia7fast32 76.9231<br/>
gcdwikipedia8Spelvin 64.5161</p>
<p>gcd between numbers in [1000000001 and 1000002000]<br/>
Running tests... Ok!<br/>
Kops/ms (larger values are better).<br/>
basicgcd 37.7358<br/>
gcdwikipedia2 7.15564<br/>
gcdwikipedia2fast 16.4609<br/>
gcd_recursive 37.037<br/>
gcd_iterative_mod 37.7358<br/>
gcdFranke 16.5289<br/>
gcdwikipedia3fast 16.3934<br/>
gcdwikipedia4fast 22.3464<br/>
gcdwikipedia5fast 16.4609<br/>
gcdwikipedia2fastswap 16.3265<br/>
gcdwikipedia7fast 18.3486<br/>
gcdwikipedia7fast32 31.746<br/>
gcdwikipedia8Spelvin 23.3918<br/>
</code></p>
<p>I&rsquo;ve submitted a PR with the fixes</p>
</div>
<ol class="children">
<li id="comment-624466" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-03-25T01:32:13+00:00">March 25, 2022 at 1:32 am</time></a> </div>
<div class="comment-content">
<p>Thanks. Here are my results after merging your fix.</p>
<pre>
❯ ./gcd
gcd between numbers in [1 and 2000]
Running tests... Ok! 
We proceed to report kops/ms (larger values are better).
basicgcd                    40.404
gcdwikipedia2               20.1005
gcdwikipedia2fast           54.7945
gcd_recursive               42.5532
gcd_iterative_mod           42.5532
gcdFranke                   38.0952
gcdwikipedia3fast           53.3333
gcdwikipedia4fast           42.1053
gcdwikipedia5fast           53.3333
gcdwikipedia2fastswap       55.5556
gcdwikipedia7fast           67.7966
gcdwikipedia7fast32         51.2821
gcdwikipedia8Spelvin        46.5116
gcd_mod_faster              43.956

gcd between numbers in [1000000001 and 1000002000]
Running tests... Ok! 
We proceed to report kops/ms (larger values are better).
basicgcd                    30.5344
gcdwikipedia2               7.28597
gcdwikipedia2fast           19.802
gcd_recursive               30.0752
gcd_iterative_mod           30.303
gcdFranke                   14.0351
gcdwikipedia3fast           18.4332
gcdwikipedia4fast           14.2857
gcdwikipedia5fast           18.5185
gcdwikipedia2fastswap       18.7793
gcdwikipedia7fast           23.9521
gcdwikipedia7fast32         18.5185
gcdwikipedia8Spelvin        46.5116
gcd_mod_faster              32.5203
</pre>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-646893" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6605bda08dabe212daf4119a1307dbb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6605bda08dabe212daf4119a1307dbb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hakuna Matata</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-23T12:26:59+00:00">October 23, 2022 at 12:26 pm</time></a> </div>
<div class="comment-content">
<p>Tested on random unsigned ints from full 32-bit range. `gcdwikipedia4fast()` is the fastest. Not every algorithm survived the test, btw.</p>
</div>
</li>
</ol>
