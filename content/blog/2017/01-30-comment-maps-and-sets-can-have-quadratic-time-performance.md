---
date: "2017-01-30 12:00:00"
title: "Maps and sets can have quadratic-time performance"
index: false
---

[9 thoughts on &ldquo;Maps and sets can have quadratic-time performance&rdquo;](/lemire/blog/2017/01-30-maps-and-sets-can-have-quadratic-time-performance)

<ol class="comment-list">
<li id="comment-269077" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/889daaf0e6372e5aa9a7f75dfc44f037?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/889daaf0e6372e5aa9a7f75dfc44f037?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Tim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T20:30:12+00:00">January 30, 2017 at 8:30 pm</time></a> </div>
<div class="comment-content">
<p>In CoreFoundation, there were a tiny number of all-singing-all-dancing collections which tried to intuit what you were using them for, and pick the correct data structure internally: <a href="http://ridiculousfish.com/blog/posts/array.html" rel="nofollow ugc">http://ridiculousfish.com/blog/posts/array.html</a></p>
<p>Swift isn&rsquo;t like this. Swift has a much larger number of collections, and it&rsquo;s up to the programmer to pick the right one for the job.</p>
<p>In Swift, if you want a set of contiguous ints, the right data structure is IndexSet. It&rsquo;s super-fast at this test: way less than 1ns/el for all operations, and a build/copy ratio of pretty close to 1 (between 0.4 and 1.5, on my workstation).</p>
<p>The next question is: why is Set especially slow for this case? Why does it run into linear probing issues at all? Ints in Swift return different hashValues so it&rsquo;s not obvious why they would collide at all.</p>
<p>A Set created with no initial value or minimumCapacity will be as small as possible. (The source isn&rsquo;t available, but one place I found says 1 bucket, and another says 0.) It&rsquo;s hitting collisions all the time because it&rsquo;s creating a tiny hash table, then as you add more elements it needs to copy that to a bigger hash table, and so on, ad infinitum. When you add a million items, one at a time, it doesn&rsquo;t know until the last one that you intended to add a million items all along.</p>
<p>Sure enough, if I change the Set() inits to Set(minimumCapacity: 2*size), the code runs drastically faster, and the copy/build ratio is under 1.0 in all cases.</p>
<p>No hash table implementation can grow indefinitely with no performance hit. Either it needs to start out big (and waste memory, if you only needed a few elements), or it needs to copy itself as it grows (and waste time, if you know you need a lot). You can solve this by telling it to start out big.</p>
<p>You&rsquo;re seeing quadratic time not because of linear probing, but because of bucket copying.</p>
</div>
<ol class="children">
<li id="comment-269098" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-30T21:24:19+00:00">January 30, 2017 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>I used an Int data type just to keep things simple, but the problem is general.</p>
<p><em> Ints in Swift return different hashValues so it&rsquo;s not obvious why they would collide at all.</em></p>
<p>It does not matter that they are integers except for the fact that it is a lot easier to benchmark (since at the core, it is much faster).</p>
<p>Modify my code, it will take you seconds&#8230; just cast the Ints to Strings. The ratio blows up just the same.</p>
<p><em>A Set created with no initial value or minimumCapacity will be as small as possible. (&#8230;) You&rsquo;re seeing quadratic time not because of linear probing, but because of bucket copying. </em></p>
<p>I agree that if you set the capacity high enough, the problem will go away. It is one of several ways to you can solve this problem.</p>
<p>But in my code, I build two sets starting from an empty set. It is the same problem. The only difference in the second case is the order in which I build it.</p>
</div>
<ol class="children">
<li id="comment-269144" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/889daaf0e6372e5aa9a7f75dfc44f037?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/889daaf0e6372e5aa9a7f75dfc44f037?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-31T06:00:04+00:00">January 31, 2017 at 6:00 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;But in my code, I build two sets starting from an empty set. It is the same problem. The only difference in the second case is the order in which I build it.&rdquo;</p>
<p>Then why, according to your theory, would linear probing affect one, but not the other? Shouldn&rsquo;t inserting values in either order be just as susceptible to the linear probing penalty? What&rsquo;s special about the second ordering that makes it slow? Inserting them backwards is still fast, and so is inserting odds-then-evens.</p>
<p>The &ldquo;1000&rdquo; is a red herring. It doesn&rsquo;t affect performance at all. Even the cost of iterating over the first Set is negligible. As you say, this is purely about the order in which items are inserted into a Set.</p>
<p>&ldquo;just cast the Ints to Strings. The ratio blows up just the same&rdquo;</p>
<p>I assume you mean &ldquo;init&rdquo;, not &ldquo;cast&rdquo; (which would throw an exception and abort the process), and no, the ratios don&rsquo;t blow up in the same way for me. The first few are 5.17, 7.09, 7.07, 24.59, 18.41. It&rsquo;s generally going up, but it&rsquo;s not quadratic, or even monotonic. Sometimes when the data size doubles, it goes the same speed.</p>
<p>For that matter, the Int version doesn&rsquo;t show quadratic behavior, either. Why is the n=4M case consistently so much faster than the n=2M case? Why is the n=32M case almost exactly the same speed as the n=16M case? This doesn&rsquo;t look like any quadratic algorithm I&rsquo;ve ever seen. I graphed the powers-of-two from n=1M to n=64M and they appear to level off.</p>
<p>I&rsquo;m seeing a lot of interesting hypotheses, but no smoking gun yet. You extrapolated from 2 data points to &ldquo;quadratic&rdquo;, and &ldquo;linear probing is the culprit&rdquo;. But when I ran the same test, incrementing |size| by 10% each time, rather than 100%, I got this:</p>
<p><a href="https://imgur.com/a/AmA3r" rel="nofollow ugc">https://imgur.com/a/AmA3r</a></p>
<p>There&rsquo;s clearly a lot more going on than just &ldquo;quadratic complexity&rdquo;, or that you might guess from looking at 2 points. Half the time, the &ldquo;rebuild&rdquo; is slower, but half the time it&rsquo;s the same speed (or slightly faster). When n=14.4M, for example, the rebuild rate is over 1000 times *faster* than when n=8.95M, despite having over 60% more data.</p>
<p>It&rsquo;s true that order of insertion matters, but I don&rsquo;t think there&rsquo;s enough information yet to pinpoint the cause of this. This is a fascinating puzzle you&rsquo;ve stumbled on!</p>
</div>
<ol class="children">
<li id="comment-269146" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-31T06:23:45+00:00">January 31, 2017 at 6:23 am</time></a> </div>
<div class="comment-content">
<p><em>Then why, according to your theory, would linear probing affect one, but not the other?</em></p>
<p>Because in the second case, we get an adversarial insertion order.</p>
<p><em> Shouldn&rsquo;t inserting values in either order be just as susceptible to the linear probing penalty?</em></p>
<p>I did not refer to a linear probing penalty. Linear probing is fast and efficient, except when it fails.</p>
<p><em> What&rsquo;s special about the second ordering that makes it slow?</em></p>
<p>It is special because it is aware of the hash values.</p>
<p><em>The â€œ1000â€ is a red herring.</em></p>
<p>It is not necessary to get this effect, you are right, but without this step, I was sure to get a comment to the effect that it is trivial to copy a set quickly without a for-loop.</p>
<p><em>I assume you mean â€œinitâ€, not â€œcastâ€ (which would throw an exception and abort the process)</em></p>
<p>I used the term &ldquo;cast&rdquo; as short for &ldquo;type casting&rdquo;:</p>
<blockquote><p>In computer science, type conversion, type casting, and type coercion are different ways of changing an entity of one data type into another. An example would be the conversion of an integer value into a floating point value or its textual representation as a string, and vice versa. <a href="https://en.wikipedia.org/wiki/Type_conversion" rel="nofollow ugc">https://en.wikipedia.org/wiki/Type_conversion</a>
</p></blockquote>
<p>You must be thinking of something else.</p>
<p><em> The first few are 5.17, 7.09, 7.07, 24.59, 18.41. It&rsquo;s generally going up, but it&rsquo;s not quadratic, or even monotonic.</em></p>
<p>I did not get to the notion of quadratic complexity by looking at the numbers. It is very hard to establish the computational complexity of a problem by looking at the actual speed.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-269154" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-31T07:38:25+00:00">January 31, 2017 at 7:38 am</time></a> </div>
<div class="comment-content">
<p>The number of times people rediscover this issue with linear probing never fails to amaze me.</p>
<p>First in Delphi (the article is only available in Russian, but Google Translate works okay): <a href="https://habrahabr.ru/post/282902/" rel="nofollow ugc">https://habrahabr.ru/post/282902/</a><br/>
Then in Rust: <a href="https://accidentallyquadratic.tumblr.com/post/153545455987/rust-hash-iteration-reinsertion" rel="nofollow ugc">http://accidentallyquadratic.tumblr.com/post/153545455987/rust-hash-iteration-reinsertion</a><br/>
Now in Swift.</p>
</div>
<ol class="children">
<li id="comment-269239" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-31T15:52:15+00:00">January 31, 2017 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the excellent comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-269285" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/562d5315600be7859bae7240b06a3530?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Viktor SzathmÃ¡ry</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-31T21:37:08+00:00">January 31, 2017 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>Java 8&rsquo;s HashMap also added an improvement where, above a certain size, the colliding entries form a balanced tree instead of a linked list (see <a href="http://openjdk.java.net/jeps/180" rel="nofollow ugc">http://openjdk.java.net/jeps/180</a>), improving the worst case scenario to O(log n).</p>
</div>
</li>
<li id="comment-269298" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d4f1941fafe3b3c6efa572e65cb1ec9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d4f1941fafe3b3c6efa572e65cb1ec9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arjun Menon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-01T00:38:57+00:00">February 1, 2017 at 12:38 am</time></a> </div>
<div class="comment-content">
<p>This has to do with cache locality. Normally Build and Reinsertion should _not_ have different performance characteristics. In both cases, you are inserting elements. In Build you start with the empty set. In Reinsertion you start with a set with a few elements. Theoretically, if you assume that iterating/reading a set is fast, there would be no difference, since they are doing the same thing (&ldquo;insert&rdquo;).</p>
<p>The performance difference arises because reading from another set before each insertion, results in more cache misses. With such large data sets, the cache is being completed utilized, and reading from another region in memory before each write means more stuff be cached. Thus, more cache misses. That&rsquo;s what going on here.</p>
</div>
<ol class="children">
<li id="comment-269376" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-02-01T14:24:58+00:00">February 1, 2017 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p><em>In Build you start with the empty set. In Reinsertion you start with a set with a few elements. </em></p>
<p>As pointed out in other comments, this is not actually relevant. I started the second phase with an element to avoid comments to the effect that I am copying the set in a stupid manner.</p>
<p>You can start with empty sets in both instances, it won&rsquo;t change the result.</p>
<p><em>Theoretically, if you assume that iterating/reading a set is fast, there would be no difference, since they are doing the same thing (â€œinsertâ€).</em></p>
<p>There is no theoretical result to says that insertion order is irrelevant.</p>
<p><em>The performance difference arises because reading from another set before each insertion, results in more cache misses. With such large data sets, the cache is being completed utilized, and reading from another region in memory before each write means more stuff be cached. Thus, more cache misses. That&rsquo;s what going on here.</em></p>
<p>If you look at the actual benchmarking code, on GitHub, you will see that both read their data from arrays. The only difference is the insertion order.</p>
</div>
</li>
</ol>
</li>
</ol>
