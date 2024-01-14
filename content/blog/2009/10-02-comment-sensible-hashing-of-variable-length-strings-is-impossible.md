---
date: "2009-10-02 12:00:00"
title: "Sensible hashing of variable-length strings is impossible"
index: false
---

[15 thoughts on &ldquo;Sensible hashing of variable-length strings is impossible&rdquo;](/lemire/blog/2009/10-02-sensible-hashing-of-variable-length-strings-is-impossible)

<ol class="comment-list">
<li id="comment-51623" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/487879a9babd1d8d901bd97d31c3d4ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/487879a9babd1d8d901bd97d31c3d4ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Yuriy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-02T16:54:24+00:00">October 2, 2009 at 4:54 pm</time></a> </div>
<div class="comment-content">
<p>Suppose A = {0, 2, 4, 6, &#8230;}<br/>
and A&rsquo; = {1, 3, 5, 7, &#8230;}<br/>
Their intersection is empty so the h and h&rsquo; that produced A and A&rsquo;, respectively, do not collide on any values.</p>
</div>
</li>
<li id="comment-51624" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-02T17:03:24+00:00">October 2, 2009 at 5:03 pm</time></a> </div>
<div class="comment-content">
<p>@Yuriy I am not saying that any two infinite sets have a non-empty intersection.</p>
<p>I am saying that if you distribute an infinite number of elements into a finite number of buckets, one of the buckets will contain infinitely many elements.</p>
<p>I construct A&rsquo; from A, so A&rsquo; is a subset of A.</p>
</div>
</li>
<li id="comment-51625" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/487879a9babd1d8d901bd97d31c3d4ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/487879a9babd1d8d901bd97d31c3d4ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yuriy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-02T17:26:51+00:00">October 2, 2009 at 5:26 pm</time></a> </div>
<div class="comment-content">
<p>Yes, one bucket, for h, will contain infinitely many elements. Then one different bucket, for h&rsquo;, will contain infinitely many elements. And so on. You have |H| infinite-sized buckets. </p>
<p>But when you say that an infinite number of keys collide over all H functions, you are saying that the intersection of the buckets is infinite. </p>
<p>(Or is the statement you are trying to prove &ldquo;There is always an infinite number of keys that are certain to collide over each h in H&rdquo;, as opposed to &ldquo;over all H&rdquo;?</p>
</div>
</li>
<li id="comment-51626" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-02T17:34:37+00:00">October 2, 2009 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p>Let us restart from the beginning. With one (predetermined) hash function h, you can find one hash value y such that infinitely many strings are mapped to y. </p>
<p>Ok. Now, consider all these strings and only these strings (discard any string that does not satisfy h(s)=y). Then use a *different* hash function f&rsquo; and repeat. Once more there will be a hash value y&rsquo; such that infinitely many strings will map to y&rsquo; (and they also map to y using h).</p>
<p>So far we have infinitely many strings s such that h(s)=y and h(s&rsquo;)=y&rsquo;.</p>
<p>Just keep going, H times. Each time your set will grow smaller, but it will remain infinite. Because you only have H hash functions in total, you&rsquo;ll end up with a set of strings such that they all map to y using the hash function h, they all map to y&rsquo; using hash function h&rsquo;, they all map to y&rdquo; using hash function h&rdquo; and so on.</p>
<p>So far so good?</p>
<p>The trick, of course, is that I assume you have a finite number of hash functions, while having infinitely many strings. That&rsquo;s the secret sauce.</p>
</div>
</li>
<li id="comment-51627" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T01:08:06+00:00">October 3, 2009 at 1:08 am</time></a> </div>
<div class="comment-content">
<p>Clearly, we have very different definitions of the word &ldquo;sensible&rdquo;. Especially in combination with the &ldquo;infinite&rdquo; anything. </p>
<p>Given the odd usage of &ldquo;sensible&rdquo;, I suppose you could use the function:</p>
<p>h(s) = s </p>
<p>Otherwise you are going to have to clarify.</p>
</div>
</li>
<li id="comment-51632" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T07:52:24+00:00">October 3, 2009 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>@Preston</p>
<p>The hash function h(s)=s would not be acceptable because it does not hash to the set of integers {1,2,â€¦,b}..</p>
</div>
</li>
<li id="comment-51633" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T09:57:06+00:00">October 3, 2009 at 9:57 am</time></a> </div>
<div class="comment-content">
<p><i>the set A={s:h(s)=y} is infinite, that is, you have infinitely many strings colliding</i></p>
<p>Curious hypothesis about the keys.<br/>
Infinitely many <i>distinct</i> keys entails an <b>infinite</b> key size average.<br/>
Not terribly realistic&#8230;</p>
</div>
</li>
<li id="comment-51630" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5795ffb9fc761d4c03373d7280ef04f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5795ffb9fc761d4c03373d7280ef04f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mark.reid.name/" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T06:48:51+00:00">October 3, 2009 at 6:48 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not quite sure why you have several comments arguing against your relatively straightforward proof. It&rsquo;s really not much more than a kind of pigeonhole principle for infinite sets. </p>
<p>It is also reminiscent of part of the proof of the Heine-Borel theorem (closed and bounded implies compact) that &ldquo;chases&rdquo; the infinite part of a partition.</p>
</div>
</li>
<li id="comment-51631" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/401a03ddfea9690af543101521b3745f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/401a03ddfea9690af543101521b3745f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.algorithm.co.il/blogs/" class="url" rel="ugc external nofollow">lorg</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T07:33:44+00:00">October 3, 2009 at 7:33 am</time></a> </div>
<div class="comment-content">
<p>If put into different words:<br/>
You showed that there is an infinite number of keys, that for each hash function, will hash to the same value under that hash function.<br/>
That is, there exists a set A of keys, such that<br/>
for each h in H and for each x1, x2 in A, h(x1) = h(x2).</p>
<p>Yuriy:<br/>
This still works, because he didn&rsquo;t force them to hash to *the same value*.<br/>
So your h and h&rsquo; do not collide. Instead, they have a same infinite set of colliding keys.</p>
<p>Daniel:<br/>
I&rsquo;m not sure that this makes hashing of infinite number of keys impractical. I will have to give it some more thought.<br/>
Thanks for the interesting blog post.</p>
</div>
</li>
<li id="comment-51634" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T14:26:12+00:00">October 3, 2009 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel</p>
<p>So far as I could tell, you did not specify that the set of hashed-to integers was finite. 🙂</p>
<p>Sometimes address-based hashing (if &ldquo;hashing&rdquo; is the right word) is the right solution.</p>
<p>Please define &ldquo;sensible&rdquo;, in this context.</p>
</div>
</li>
<li id="comment-51635" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5162a0619d4a15d7627662093bf42f1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5162a0619d4a15d7627662093bf42f1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://julianhyde.blogspot.com" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T14:45:11+00:00">October 3, 2009 at 2:45 pm</time></a> </div>
<div class="comment-content">
<p>I agree with Preston. It all depends on your definition of the word &lsquo;sensible&rsquo;.</p>
<p>There is a math theorem that between any two irrational numbers there are infinitely many rational numbers. It&rsquo;s true, but it&rsquo;s not, shall we say, a helpful fact, because there are loads more irrational numbers in the gap than rational numbers. This result is a similar to your theorem: true but misleading.</p>
<p>It&rsquo;s always possible to be unlucky with your choice of hash function. But it&rsquo;s fairly easy to choose a hash function where you are very, very unlikely to be unlucky. And for this pragmatist, that is good enough.</p>
<p>I say &lsquo;fairly easy&rsquo;. It took Sun three major versions of Java to do it. In JDK 1.0 and 1.1 which sampled every n&rsquo;th character and XORed and this, naturally, had issues.</p>
<p>In JDK 1.2, String.hashCode() used to quit at about the 64th character, presumably to keep the cost of maintaining sets and maps of long strings in check. But I was using the hash map to keep unique names of members in mondrian. Many of these strings had a common prefix, and they would all end up in the same hash bucket. Performance was abyssmal.</p>
<p>The problem was fixed in later versions of the JDK. (I may be wrong about the precise JDK versions. This is from memory.) At the time I seriously considered using a Trie [ <a href="https://en.wikipedia.org/wiki/Trie" rel="nofollow ugc">http://en.wikipedia.org/wiki/Trie</a> ] , but a web search didn&rsquo;t turn up any robust Java implementations. It always struck me as strange that this simple and elegant data structure seems to find so few applications in the real world.</p>
</div>
</li>
<li id="comment-51636" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-03T20:43:21+00:00">October 3, 2009 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>I promise a follow-up blog post where I&rsquo;ll try to answer all these valid points.</p>
</div>
</li>
<li id="comment-51637" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/15e1863aa7f8d91fddc20b9e799bcbcc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rasmus Pagh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-05T03:34:30+00:00">October 5, 2009 at 3:34 am</time></a> </div>
<div class="comment-content">
<p>One point that has not been made clear, I think, is that there are classes of hash functions for which the length of keys needed to generate high-probability collisions is exponential in the number of bits needed to specify the hash function. Thus, you can rest assure if your strings are not too long, even if they are drawn from an infinite set.</p>
</div>
</li>
<li id="comment-51643" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-05T11:41:53+00:00">October 5, 2009 at 11:41 am</time></a> </div>
<div class="comment-content">
<p>As an aside: played a bit with a Trie implementation in Java over the weekend. After Julian&rsquo;s comment, wondered how performance of a &ldquo;fast&rdquo; Trie might compare to a stock hash table, and this serves as an excuse to play with Tries. </p>
<p>Also &#8211; in the context of the prior discussion &#8211; Tries can be viewed as a form of hashing without collisions. </p>
<p>My result was not encouraging:<br/>
<a href="http://bannister.us/weblog/2009/10/05/example-general-purpose-trie-in-java/" rel="nofollow ugc">http://bannister.us/weblog/2009/10/05/example-general-purpose-trie-in-java/</a></p>
</div>
</li>
<li id="comment-51651" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/63a0d31d9179df3034b35ae718b371a3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/63a0d31d9179df3034b35ae718b371a3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://julianhyde.blogspot.com" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-10-05T19:08:50+00:00">October 5, 2009 at 7:08 pm</time></a> </div>
<div class="comment-content">
<p>Preston,</p>
<p>Interesting. Thanks for doing the experiments. I would have thought that trie insert performance would suck (because of the effort of clearing an array of 16 or 256 pointers), but you found that access performance sucks too.</p>
<p>The case I had in mind was for long strings &#8212; recall that my original problem was with strings longer than 64 chars, and JDK 1.2 stopped hashing at the 64th character &#8212; so it&rsquo;s possible that tries have their place if strings are very long, say 1k each.</p>
<p>But you&rsquo;ve shown that tries are a long way behind hash tables. I think it&rsquo;s down to poor use of the CPU cache. Resolving a string in a hash table should be only a couple of memory accesses, whereas a trie access might read 3 or 4 or 5 nodes. The memory wait time overwhelms the extra CPU cost of computing a hash code, while the string being scanned is all within the same block of CPU cache.</p>
<p>Looks like tries just aren&rsquo;t cut out for modern architectures.</p>
<p>Julian</p>
</div>
</li>
</ol>
