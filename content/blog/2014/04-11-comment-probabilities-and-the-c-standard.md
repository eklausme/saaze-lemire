---
date: "2014-04-11 12:00:00"
title: "Probabilities and the C++ standard"
index: false
---

[7 thoughts on &ldquo;Probabilities and the C++ standard&rdquo;](/lemire/blog/2014/04-11-probabilities-and-the-c-standard)

<ol class="comment-list">
<li id="comment-116649" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-11T16:55:51+00:00">April 11, 2014 at 4:55 pm</time></a> </div>
<div class="comment-content">
<p>Since the hash function isn&rsquo;t specified, it seems to me that an implementation that picks a new hash function each time the program runs would be standard compliant. One way to &ldquo;pick a new hash function on each run&rdquo; would be to have the hash function rely on a random number that is allowed to differ between runs. However, I don&rsquo;t know enough to say whether that actually would comply.</p>
<p>But, even assuming that the hash function isn&rsquo;t allowed to change between runs (i.e., it&rsquo;s &ldquo;set in stone&rdquo;), I don&rsquo;t think the standard prohibits a hash table from re-ordering elements in a bucket when they are accessed (move-to-front). Which would have the effect that iterating the hash table multiple times could return different orders even if there have been no insertions or deletions. But, again, I don&rsquo;t know enough of the standard to say so definitively.</p>
</div>
</li>
<li id="comment-116708" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb999eed8b210c8246f4b08643a2f314?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb999eed8b210c8246f4b08643a2f314?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://gfrh.net/" class="url" rel="ugc external nofollow">Geoff Hill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-11T21:59:21+00:00">April 11, 2014 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p>The C++11 standard you link already gives you the capability to specify a custom hash function.</p>
<p>Examine the template type parameters for the unordered_map class:</p>
<p>class Key,<br/>
class T,<br/>
class Hash = hash,<br/>
class Pred = std::equal_to,<br/>
class Allocator = std::allocator</p>
<p>The third type parameter is Hash, and you can supply a custom type (a functor) to instantiate it.</p>
<p>See this StackOverflow answer for a quick walkthrough for implementating custom hashing and key-equality functions:<br/>
<a href="http://stackoverflow.com/a/15809592/1301580" rel="nofollow ugc">http://stackoverflow.com/a/15809592/1301580</a></p>
</div>
</li>
<li id="comment-116653" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-11T17:54:24+00:00">April 11, 2014 at 5:54 pm</time></a> </div>
<div class="comment-content">
<p>@Max</p>
<p><em>have the hash function rely on a random number</em></p>
<p>They go out of the way to specify that &ldquo;h(k) shall depend only on the argument k&rdquo; so my interpretation is that it cannot depend on a random seed. (Update: Of course, what can they do to prevent you from doing exactly what you describe?)</p>
<p><em>I don&rsquo;t think the standard prohibits a hash table from re-ordering elements in a bucket when they are accessed </em></p>
<p>Yes, the unordered map can certainly do something like this but this would still mean that the same program, with the same inputs, would list the keys in the same order.</p>
<p>Once you have random hashing, running the same program with the same inputs twice would give you different results.</p>
<p>This might throw some people off.</p>
</div>
</li>
<li id="comment-116672" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-11T19:05:33+00:00">April 11, 2014 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>&gt; Once you have random hashing, running the same program with the same inputs twice would give you different results.</p>
<p>&gt; This might throw some people off.</p>
<p>There&rsquo;s no question about that. The Perl guys originally turned random hashing on everywhere, but that broke several modules that relied on deterministic ordering of a hash&rsquo;s contents, so they changed things to only use random hashing when they detected large numbers of collisions.</p>
<p>But it turned out that wasn&rsquo;t random enough, so they recently randomized it more ( <a href="http://blog.booking.com/hardening-perls-hash-function.html" rel="nofollow ugc">http://blog.booking.com/hardening-perls-hash-function.html</a> ). If there wasn&rsquo;t a valid security rationale, I doubt the changes would have stayed. As it is, they upset several programmers by breaking expectations.</p>
<p>I&rsquo;m not on the committee, but in my opinion, it would be a mistake to add any requirements on the hashing function other than &ldquo;it&rsquo;s idempotent (per program run)&rdquo; and &ldquo;it minimizes collisions.&rdquo;</p>
</div>
</li>
<li id="comment-116674" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-11T19:09:54+00:00">April 11, 2014 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, &ldquo;idempotent&rdquo; is the wrong term. I guess the best term is &ldquo;it&rsquo;s deterministic (per run of the program).&rdquo; But, usually, you have to say &ldquo;NOTE: the function *may* return different results for different runs of the program&rdquo; to really get the point across.</p>
</div>
</li>
<li id="comment-116711" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-11T22:18:29+00:00">April 11, 2014 at 10:18 pm</time></a> </div>
<div class="comment-content">
<p>@Geoff</p>
<p>Thanks. Yes, I was aware that, with some hard work, one could provide his own hash functions. And as I hint in my answer to Max, I believe that you can ignore the specification when building your own functions.</p>
</div>
</li>
<li id="comment-119178" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a27ba6db8463a315b82dcc436c6cd20?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a27ba6db8463a315b82dcc436c6cd20?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.booking.com" class="url" rel="ugc external nofollow">Yves Orton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-22T05:59:33+00:00">April 22, 2014 at 5:59 am</time></a> </div>
<div class="comment-content">
<p>In regard to &ldquo;that might throw some people off&rdquo;, I wanted to say that the Perl experience is that this is a *good* thing. It prevents a developer from relying on insertion order into the hash (many if not most hash implementations are sensitive to this). And it helps find edge case scenarios most developers would never thing to test.</p>
<p>Most devs think that making things random makes it harder to reproduce bugs. The perl experience is the opposite, the randomization effectively tries out every permutation of keys, and if the code is sensitive to this it very quickly becomes apparent. Run it enough times and the failure will eventually occur.</p>
</div>
</li>
</ol>
