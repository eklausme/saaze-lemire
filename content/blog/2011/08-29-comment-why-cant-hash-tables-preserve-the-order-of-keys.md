---
date: "2011-08-29 12:00:00"
title: "Why can&#8217;t hash tables preserve the order of keys?"
index: false
---

[17 thoughts on &ldquo;Why can&#8217;t hash tables preserve the order of keys?&rdquo;](/lemire/blog/2011/08-29-why-cant-hash-tables-preserve-the-order-of-keys)

<ol class="comment-list">
<li id="comment-54675" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T09:34:51+00:00">August 29, 2011 at 9:34 am</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>Good point. I think that hash tables are more common however.</p>
<p>@glenn</p>
<p>I think that Ruby uses some extra data structures (liked a linked list) to achieve order-preservation in its hash tables. So they are a bit more than a hash table&#8230; Good point though!</p>
<p>@Homer</p>
<p>From a practical point of view, I agree with you. However, exploiting the properties of your hash functions can be a very neat trick whenever it works.</p>
</div>
</li>
<li id="comment-54677" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eddf956306e6fb299f7291b4a2ccea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eddf956306e6fb299f7291b4a2ccea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Angelo Pesce</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T09:59:17+00:00">August 29, 2011 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>@Homer</p>
<p>But you should be excited about your work from time to time, otherwise, what is the point?</p>
<p>True. Most clever tricks are overrated. But they sometimes expand our mind.</p>
</div>
</li>
<li id="comment-54679" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c88fa3b836c824fce2491de7b41df6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c88fa3b836c824fce2491de7b41df6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wes Freeman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T11:52:37+00:00">August 29, 2011 at 11:52 am</time></a> </div>
<div class="comment-content">
<p>You can also sort your LinkedHashMap/Set (in Java) by the key. The sorting operation has high cost (as you basically have to rebuild it in the proper order), but the HashMap/Set would then already be presorted if you were to want to give a list of alphabetized results, for example. If you have much fewer inserts than you have ordered listings, it might be worth it.</p>
<p>I&rsquo;m still a little unsure that I see the practical value for this. This is for cases where Tree-based Maps are too slow, but you need ordered result lists?</p>
</div>
</li>
<li id="comment-54681" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eddf956306e6fb299f7291b4a2ccea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eddf956306e6fb299f7291b4a2ccea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Angelo Pesce</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T12:11:22+00:00">August 29, 2011 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>@Wes</p>
<p>Consider the following scenario. You have a massive key-value database. You sometimes, but rarely, need to access the keys sequentially.</p>
<p>So, you basically want a hash table, with the ability to scan the keys in order when you must. In the case of my example, you could scan all keys in 26 buckets, and get all the Smiths. Of course, you would need to filter these buckets for the Smiths (as other keys would be there as well). </p>
<p>Having to retrieve from disk only 26 buckets instead of, say, a thousand, could be a great boost.</p>
<p>My point being that you can use locality-preserving hash functions on your keys to make sure your &ldquo;similar keys&rdquo; end up clustered in a few buckets.</p>
<p>This is entirely general. If you use the key &ldquo;city&rdquo;, you could use a hash function that hash &ldquo;nearby cities&rdquo; to &ldquo;nearby buckets&rdquo;. It can be entirely reasonable.</p>
<p>Of course, whether custom hash functions are worth it&#8230; well, I guess you have to try it out.</p>
</div>
</li>
<li id="comment-54682" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c88fa3b836c824fce2491de7b41df6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c88fa3b836c824fce2491de7b41df6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wes Freeman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T12:27:51+00:00">August 29, 2011 at 12:27 pm</time></a> </div>
<div class="comment-content">
<p>@Glenn</p>
<p>From my cursory investigation, Ruby doesn&rsquo;t maintain key order, it maintains insert order, just like a LinkedHashMap in Java. From <a href="http://www.ruby-doc.org/core/classes/Hash.html" rel="nofollow ugc">http://www.ruby-doc.org/core/classes/Hash.html</a> :</p>
<p>&ldquo;Hashes enumerate their values in the order that the corresponding keys were inserted.&rdquo;</p>
</div>
</li>
<li id="comment-54683" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c88fa3b836c824fce2491de7b41df6b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c88fa3b836c824fce2491de7b41df6b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wes Freeman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T12:47:40+00:00">August 29, 2011 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>@Angelo<br/>
I see&#8211;optimizing for the lower use case without affecting [much] the higher use case. In massive key-value databases, limiting your buckets as in the name example, would probably have a negative impact on performance, depending on your collision resolution. I&rsquo;m tempted to try it out with some tests. </p>
<p>How about nested Hashes, where you have larger partial-key buckets first (like last name, first letter of first name), and then full-key buckets within?</p>
</div>
</li>
<li id="comment-54672" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T09:16:41+00:00">August 29, 2011 at 9:16 am</time></a> </div>
<div class="comment-content">
<p>Tries have comparable (and constant) retrieval times (sometimes even better than hashes). The are also locality preserving. Perhaps, even better are tries where lower-levels are grouped into buckets.</p>
</div>
</li>
<li id="comment-54673" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/800078ddbf84f5b7232e6fcb460ecceb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/800078ddbf84f5b7232e6fcb460ecceb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">glenn mcdonald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T09:16:47+00:00">August 29, 2011 at 9:16 am</time></a> </div>
<div class="comment-content">
<p>In Ruby 1.9+, hash tables DO preserve key order&#8230;</p>
</div>
</li>
<li id="comment-54674" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://theprogrammersparadox.blogspot.com/" class="url" rel="ugc external nofollow">Paul W. Homer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T09:25:44+00:00">August 29, 2011 at 9:25 am</time></a> </div>
<div class="comment-content">
<p>I think that relying on an ordering property like this in code would be intrinsically dangerous. The two big things you have to consider are collisions (and whether the hash handles them internally or externally) and resizing, which would change the distribution of the keys.</p>
<p>If you need both a hash and an ordering, I think it is far better to keep them as separate (but intertwining data-structures). That is, you insert a node into an ordered list and you hash it too (or create a hash index for the list). Otherwise I suspect that you are trying to use a hammer on a screw &#8230;</p>
<p>Paul.</p>
</div>
</li>
<li id="comment-54676" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://theprogrammersparadox.blogspot.com/" class="url" rel="ugc external nofollow">Paul W. Homer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T09:45:41+00:00">August 29, 2011 at 9:45 am</time></a> </div>
<div class="comment-content">
<p>When I was a younger programmer I came up with this really clever trick to solve a difficult programming problem. In my excitement I approached one of the older developers and energetically explained my cleverness.</p>
<p>He looked at me for a long quiet moment, then finally said &ldquo;Monkey&rsquo;s are clever&rdquo;.</p>
<p>The problem with clever tricks is that they tend to come back to haunt you when you least expect it.</p>
<p>Paul.</p>
</div>
</li>
<li id="comment-54678" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d92b64b0bbc0f2b7297924e76c4a4a84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://theprogrammersparadox.blogspot.com/" class="url" rel="ugc external nofollow">Paul W. Homer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T10:11:34+00:00">August 29, 2011 at 10:11 am</time></a> </div>
<div class="comment-content">
<p>Hi Angelo,</p>
<p>I don&rsquo;t think the other programmer was trying to tell me not to be excited, but rather that clever tricks tend to be rather nasty &ldquo;landmines&rdquo; placed haphazardly in the code. What we&rsquo;re looking for in a solution is to encapsulate the problem in a way that we can move onto to larger and more interesting problems. I think that&rsquo;s also the rational behind &ldquo;premature optimization is the root of all evil&rdquo; (you spend too much time on the small stuff, and make it too hard to reuse later).</p>
<p>I absolutely love programming, always have, and over the years I&rsquo;ve learned that it&rsquo;s important to solve the problems the right way, not just any way that is quick (or possibly clever). There is a subtle difference there, but one worth noting.</p>
<p>I took a combinatorics class long, long ago and the Prof used to always talk about &ldquo;the obvious first try&rdquo; in terms of algorithms. It&rsquo;s essentially the first thing that most people think of when they are presented with the problem. His lesson to us, was that we had to get beyond that to get to the really interesting and functional solutions. It&rsquo;s a lesson that always stuck with me. </p>
<p>Paul.</p>
</div>
</li>
<li id="comment-54680" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-29T11:56:26+00:00">August 29, 2011 at 11:56 am</time></a> </div>
<div class="comment-content">
<p>@Paul,<br/>
I think that a trick is not to use clever tricks unless you really-really need it. Sometimes, however, clever tricks are necessary.</p>
</div>
</li>
<li id="comment-54687" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eddf956306e6fb299f7291b4a2ccea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eddf956306e6fb299f7291b4a2ccea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Angelo Pesce</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-30T13:01:42+00:00">August 30, 2011 at 1:01 pm</time></a> </div>
<div class="comment-content">
<p>@Carr</p>
<p>Sorting in constant time is of course possible:</p>
<p><a href="https://en.wikipedia.org/wiki/Pigeonhole_sort" rel="nofollow ugc">http://en.wikipedia.org/wiki/Pigeonhole_sort</a></p>
</div>
</li>
<li id="comment-54686" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab3095db4c3fe94d799aedd6155a5eff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab3095db4c3fe94d799aedd6155a5eff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">F. Carr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-30T12:42:15+00:00">August 30, 2011 at 12:42 pm</time></a> </div>
<div class="comment-content">
<p>A monotone hash function from [1..N] to [1..N]? Cool, then it&rsquo;s trivial to sort N keys in O(N) time and space.</p>
<p>The locality-preserving hash functions aren&rsquo;t that good; they don&rsquo;t *perfectly* preserve the order of the keys. But I do wonder if one could use a locality-preserving hash to get a fast-on-average sorting function. For example, a single pass to (loc.-pres.) hash N keys into an array, followed by a quick pass of insertion-sort to clean up.</p>
</div>
</li>
<li id="comment-54688" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-30T13:27:33+00:00">August 30, 2011 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>Angelo,<br/>
This likely to be possible only if you have extra memory and/or knowledge about the distribution of data.</p>
</div>
</li>
<li id="comment-54689" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab3095db4c3fe94d799aedd6155a5eff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab3095db4c3fe94d799aedd6155a5eff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">F. Carr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-30T13:46:09+00:00">August 30, 2011 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>@Angelo: Yes, I&rsquo;m aware of that. The interesting thing is that locality-preserving hashes appear to ensure that the number of possible keys N will be the same order of magnitude as the number of actual keys n.</p>
</div>
</li>
<li id="comment-404620" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/353691d3d2cd7ebfeb6735f39ce58596?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/353691d3d2cd7ebfeb6735f39ce58596?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per Westermark</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-01T09:29:39+00:00">May 1, 2019 at 9:29 am</time></a> </div>
<div class="comment-content">
<p>Old article, but one thing to note.</p>
<p>In a hostile world, an order-preserving hash function can be quite dangerous. It&rsquo;s a very good attack vector when an attacker can control the input data and hence the bucket mapping and can then be used to create a very uneven hash structure with a potential DoS outcome.</p>
<p>In a robust world, many hash functions goes the other route and creates a random salt just so an attacker will not be able to predict the hash happing without significant runtime analysis of the performance.</p>
</div>
</li>
</ol>
