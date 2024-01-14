---
date: "2012-01-17 12:00:00"
title: "Use random hashing if you care about security?"
index: false
---

[17 thoughts on &ldquo;Use random hashing if you care about security?&rdquo;](/lemire/blog/2012/01-17-use-random-hashing-if-you-care-about-security)

<ol class="comment-list">
<li id="comment-54880" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa7c1350d93036592f58f165318044db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa7c1350d93036592f58f165318044db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://billmill.org/" class="url" rel="ugc external nofollow">Bill Mill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-17T20:37:47+00:00">January 17, 2012 at 8:37 pm</time></a> </div>
<div class="comment-content">
<p>&gt; Why aren&rsquo;t programming languages adopting random hashing?</p>
<p>There are many reasons to use deterministic hashing besides making a language easier to debug. </p>
<p>I recommend reading this extensive comment in the python source tree about its choice of hash function: <a href="https://hg.python.org/cpython/file/12de1ad1cee8/Objects/dictobject.c#l34" rel="nofollow ugc">http://hg.python.org/cpython/file/12de1ad1cee8/Objects/dictobject.c#l34</a></p>
<p>Basically, in a hash-based language like python, speed is absolutely critical, and so a simple deterministic function beats a random one. They also choose a hash function with good memory performance in common cases.</p>
<p>ISTM that a better solution than &ldquo;use randomized hashing&rdquo;, which has many downsides for *everyone* is, if you&rsquo;re accepting possible malicious input, you should check it before hashing.</p>
<p>It&rsquo;s more work for the implementor of the program, but it doesn&rsquo;t penalize absolutely everyone else. (Think of the poor scientist whose numpy program would slow down because Django wanted randomized hashing 🙂</p>
<p>Also, it&rsquo;s notable that the implementers of the algorithm implicitly mention that it&rsquo;s vulerable to an attack of this sort: &ldquo;it&rsquo;s extremely unlikely hash codes will follow a 5*j+1 recurrence by accident&rdquo;</p>
</div>
</li>
<li id="comment-54874" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4238181bdae02fa1b840f114117b5de3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4238181bdae02fa1b840f114117b5de3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-17T16:37:57+00:00">January 17, 2012 at 4:37 pm</time></a> </div>
<div class="comment-content">
<p>Great bit of information. Thanks for summarizing!</p>
<p>It seems to me that this should be handled at the application level, rather than at language design. Security isn&rsquo;t really a concern for many users of the language (such as those in the research community who mostly use Java for building prototypes).<br/>
For a commercial application, programmers would also need to do a lot more in order to be truly resistant to all types of DOS attacks. So overriding the default hash function doesn&rsquo;t seem like alot to ask for.</p>
</div>
</li>
<li id="comment-54875" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-17T16:45:18+00:00">January 17, 2012 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>@Marie</p>
<p>I agree that it is one of countless issues to watch out for.</p>
<p>As it was successfully implemented in Ruby, a mainstream language, it is unclear why it cannot be implemented in other languages like Java.</p>
<p>As far as I can tell, it would be fairly difficult for a user to override String.hashCode since the String class is final. You would need to create your own String class or your own collection framework. You can also modify the strings themselves, for example by prepending a seed, but you pay again a price. Most likely, software using Java will use other workarounds than random hashing.</p>
</div>
</li>
<li id="comment-54882" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-17T22:57:47+00:00">January 17, 2012 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>@Bill</p>
<p>An interesting link, thanks! I think it makes plenty of sense not to sacrifice too much performance for security. </p>
<p>I wonder however how much of a price Ruby is paying, if any, for its random hash function.=</p>
</div>
</li>
<li id="comment-54883" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f11f029ed37378028bd610083c3ff336?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f11f029ed37378028bd610083c3ff336?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fph.altervista.org" class="url" rel="ugc external nofollow">Federico</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T03:32:44+00:00">January 18, 2012 at 3:32 am</time></a> </div>
<div class="comment-content">
<p>Is there a performance price at all? If I am reading it correctly, a &ldquo;random hash function&rdquo; would only replace that 31 with a new random value chosen every time the *application* is started. So for a large application the overhead would be negligible.</p>
</div>
</li>
<li id="comment-54884" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3affbef9d74c99fa0f31aee400ba97c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3affbef9d74c99fa0f31aee400ba97c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T05:48:56+00:00">January 18, 2012 at 5:48 am</time></a> </div>
<div class="comment-content">
<p>Of course, having 4 strings colliding will not disrupt hash tables. But because the hash function is iterated, we can multiply the number of collisions. Indeed, any two same-length sequences of these four colliding strings will also collide. This means that you can construct 16 strings of length 6 all colliding. You can keep going to 64 strings of length 9.</p>
<p>Daniel,</p>
<p>I&rsquo;m sorry but I did not grasp this part. Can you please explain it more?</p>
</div>
</li>
<li id="comment-54885" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba27f89768c0aec50c898b1fe9b4b780?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba27f89768c0aec50c898b1fe9b4b780?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike G.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T07:58:03+00:00">January 18, 2012 at 7:58 am</time></a> </div>
<div class="comment-content">
<p>&lt;&gt;</p>
<p>Well, and perl &#8211; perl&rsquo;s hashes don&rsquo;t randomly permute by default, but they do if a given hash chain gets too long. See &ldquo;perldoc perlsec&rdquo; for any perl newer than 5.8.1 &#8211; all hashes were randomized in 5.8.1, but for compatibility in 5.8.2 that was changed so that only hashes which are &ldquo;behaving badly&rdquo; get randomized.</p>
</div>
</li>
<li id="comment-54886" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba27f89768c0aec50c898b1fe9b4b780?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba27f89768c0aec50c898b1fe9b4b780?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike G.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T07:58:54+00:00">January 18, 2012 at 7:58 am</time></a> </div>
<div class="comment-content">
<p>(Whoops, I was trying to quote your &ldquo;Alas, the only programming language to adopt random hashing was Ruby.&rdquo; line, but it looks like it got swallowed at the top of comment 7)</p>
</div>
</li>
<li id="comment-54887" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T08:35:50+00:00">January 18, 2012 at 8:35 am</time></a> </div>
<div class="comment-content">
<p>@Amey I&rsquo;ll edit my post to give an example.</p>
</div>
</li>
<li id="comment-54888" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T08:47:45+00:00">January 18, 2012 at 8:47 am</time></a> </div>
<div class="comment-content">
<p>@Mike Thanks. I updated the post and I give you credit for the observation.</p>
</div>
</li>
<li id="comment-54889" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3affbef9d74c99fa0f31aee400ba97c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3affbef9d74c99fa0f31aee400ba97c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-18T15:03:47+00:00">January 18, 2012 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>Thanks a lot Daniel. Appreciate it.</p>
</div>
</li>
<li id="comment-54890" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kwtrnka.wordpress.com/" class="url" rel="ugc external nofollow">Keith Trnka</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-19T10:15:03+00:00">January 19, 2012 at 10:15 am</time></a> </div>
<div class="comment-content">
<p>The hash involving 31 is the Knuth hash right? Or is that 33? In any case it&rsquo;s not a top-performance hash anyway so that&rsquo;s probably something to fix first.</p>
<p>@Federico picking values other than 31 or 33 will have performance impact on the hashtable because those hash functions produce greatly more collisions.</p>
<p>What I&rsquo;d rather see is two HashMap classes so that ordinary people can still have high performance when necessary. For security reasons, I&rsquo;d say that HashMap should be randomized and DetHashMap could be a faster deterministic version.</p>
</div>
</li>
<li id="comment-54892" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kwtrnka.wordpress.com/" class="url" rel="ugc external nofollow">Keith Trnka</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-19T17:31:06+00:00">January 19, 2012 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>After looking, I must&rsquo;ve confused Knuth with Kerrigan and Ritchie &#8211; that&rsquo;s who I&rsquo;ve seen attributed with 31 and Bernstein with 33.</p>
<p>I believe the note I saw about 31 and 33 being much better was in Sedgewick&rsquo;s book but I&rsquo;ll have to check when I get home. Here&rsquo;s one article that&rsquo;s picky about using 33, but no data that I see:<br/>
<a href="http://eternallyconfuzzled.com/tuts/algorithms/jsw_tut_hashing.aspx" rel="nofollow ugc">http://eternallyconfuzzled.com/tuts/algorithms/jsw_tut_hashing.aspx</a></p>
<p>I seem to recall reading that 33 and 31 were partly important because they were primes greater than the number of lowercase English characters, which is a common evaluation for hashes. There&rsquo;s some inkling of that in the following link and it also suggests that you don&rsquo;t want to use those hashes with numeric data.<br/>
<a href="https://www.strchr.com/hash_functions" rel="nofollow ugc">http://www.strchr.com/hash_functions</a></p>
<p>Part of my issue with multiplicative hashes is that short keys tend to clump up. But in language processing, that can accidentally lead to many collisions in looking common words like &ldquo;a&rdquo;, &ldquo;the&rdquo;, etc and then kill performance.</p>
</div>
</li>
<li id="comment-54891" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-19T16:56:22+00:00">January 19, 2012 at 4:56 pm</time></a> </div>
<div class="comment-content">
<p>@Keith</p>
<p><em>The hash involving 31 is the Knuth hash right?</em></p>
<p>This type of hash function is used in the Karp-Rabin algorithm, though maybe not with value 31. Could be that Knuth should get credit for it, I don&rsquo;t know.</p>
<p><em>icking values other than 31 or 33 will have performance impact on the hashtable because those hash functions produce greatly more collisions.</em></p>
<p>Do you have reference supporting this statement? GCC uses 5.</p>
</div>
</li>
<li id="comment-54893" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kwtrnka.wordpress.com/" class="url" rel="ugc external nofollow">Keith Trnka</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-20T10:19:48+00:00">January 20, 2012 at 10:19 am</time></a> </div>
<div class="comment-content">
<p>I looked around but couldn&rsquo;t find where I&rsquo;d seen that 31 or 33 were special for multiplicative hash. I still think I read that somewhere but can&rsquo;t find it. It could&rsquo;ve been something in one of my students&rsquo; projects, but I don&rsquo;t have those around anymore.</p>
<p>If I get some free time, I&rsquo;ll run a test. In the meantime, I&rsquo;ll weaken my statement and say that the constant should be a prime and there may be collision ramifications for some of those primes compared to others and it&rsquo;d be good to check before blindly using any arbitrary prime. Also, I&rsquo;m assuming that we&rsquo;re only talking about power-of-2 table sizes for what it&rsquo;s worth.</p>
</div>
</li>
<li id="comment-54895" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-21T11:43:42+00:00">January 21, 2012 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>@Keith</p>
<p>You probably meant &ldquo;odd&rdquo; and not &ldquo;prime&rdquo;.</p>
</div>
</li>
<li id="comment-54896" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keith Trnka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-22T10:35:47+00:00">January 22, 2012 at 10:35 am</time></a> </div>
<div class="comment-content">
<p>whoops, that was an editing goof on my part &#8211; when I wrote the first part (saying that we want primes) I was assuming an API-like hashtable where we might not have control over the size. Then I wrote that I was assuming power-of-two sizes.</p>
</div>
</li>
</ol>
