---
date: "2014-04-23 12:00:00"
title: "Do you realize that you are using random hashing?"
index: false
---

[10 thoughts on &ldquo;Do you realize that you are using random hashing?&rdquo;](/lemire/blog/2014/04-23-do-you-realize-that-you-are-using-random-hashing)

<ol class="comment-list">
<li id="comment-119875" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Alexey Diomin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-24T04:19:46+00:00">April 24, 2014 at 4:19 am</time></a> </div>
<div class="comment-content">
<p>Hi</p>
<p>Main problem for hash it&rsquo;s collisions resolution. Random hash it&rsquo;s attempt exclude algorithmic attacks on hash table, because mostly collision resolution based on linked-list. But in java HashMap from jdk8 exist 2 different strategies: for buckets with low collisions use LinkedList, for buckets with high collisions use Balanced Tree. Strategies can switch in runtime based on statistics for buckets.</p>
<p><a href="http://openjdk.java.net/jeps/180" rel="nofollow ugc">http://openjdk.java.net/jeps/180</a></p>
<p>=) I think it&rsquo;s solved issue with security and in mostly attacks on hashtable.</p>
<p>What you think about this technique?</p>
</div>
</li>
<li id="comment-119979" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-24T10:35:50+00:00">April 24, 2014 at 10:35 am</time></a> </div>
<div class="comment-content">
<p>@Alexey</p>
<p>Yes, in Java, they have introduced specific strategies to alleviate problems resulting from collision attacks in the HashMap class. On the surface, it sounds reasonable and should help people who rely on HashMap. However, programmers use the hashCode method to create their own data structures and algorithms, and some use data structures from other libraries. By not adopting random hashing, Java puts such programmers at risk.</p>
</div>
</li>
<li id="comment-120273" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey Diomin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T04:21:36+00:00">April 25, 2014 at 4:21 am</time></a> </div>
<div class="comment-content">
<p>hi</p>
<p>But how handle correct matching for distributed cache if every jvm will be use custom hashCode. </p>
<p>Method hashCode can be override if you create own data structures (and it&rsquo;s necessary, because supertype return wrong value for your instance). For Object.hashCode you can change behavior over -XX:hashCode=n </p>
<p>Yes, you can&rsquo;t override hashCode for internal java classes from jdk, but it&rsquo;s really so important?</p>
</div>
</li>
<li id="comment-120331" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey Diomin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T08:39:19+00:00">April 25, 2014 at 8:39 am</time></a> </div>
<div class="comment-content">
<p>Clustering for memcache apply on client side, also on client side we find necessary shard by hash. Each Memcache server it&rsquo;s very simple key-value storage. Any changes for distribution apply in client code and &ldquo;yes&rdquo; we can change algo for hashing, but it&rsquo;s make some value unreachable, because we will ask incorrect server. Can you get me link for random hashing for Memcache?</p>
</div>
</li>
<li id="comment-120333" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey Diomin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T08:47:36+00:00">April 25, 2014 at 8:47 am</time></a> </div>
<div class="comment-content">
<p>Small example:</p>
<p>N &#8211; count of servers in cluster,<br/>
we try get data from server</p>
<p>serverId = hash(object) % N</p>
<p>but if we change hash function between runs or on different client then we can&rsquo;t get data back =\</p>
</div>
</li>
<li id="comment-120335" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T08:59:57+00:00">April 25, 2014 at 8:59 am</time></a> </div>
<div class="comment-content">
<p>@Alexey</p>
<p>Well, for distributed systems, you have other constraints. For example, you should use consistent hashing&#8230; so whatever Java or Python provides is not good enough in the first place.</p>
</div>
</li>
<li id="comment-120337" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey Diomin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T09:13:40+00:00">April 25, 2014 at 9:13 am</time></a> </div>
<div class="comment-content">
<p>Summary:<br/>
1) internal hash never used for distributed systems<br/>
2) algorithmic attacks on hash table not critical because we can auto-switch on tree for resolve collisions. (HashMap and ConcurrentHashMap implement this, 3th part implementation maybe yes, maybe not)<br/>
3) for custom object we always have custom implementation for hashCode, because vm don&rsquo;t know which field must be used for hash function<br/>
4) Object.hashCode we always can change on start vm</p>
<p>One place where random hash can be apply it&rsquo;s internal classes from jvm, but problem really so important as some people thinking?</p>
</div>
</li>
<li id="comment-120400" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T13:43:40+00:00">April 25, 2014 at 1:43 pm</time></a> </div>
<div class="comment-content">
<p>@Alexey</p>
<p>The important point is that, as a programmer, you need to know about random hashing as it is now widespread.</p>
</div>
</li>
<li id="comment-120440" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey Diomin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T16:30:30+00:00">April 25, 2014 at 4:30 pm</time></a> </div>
<div class="comment-content">
<p>I agreed with you, about every good programmer must know about random hashing (and I know about it), but I not agreed with necessary implement it in jvm.</p>
</div>
</li>
<li id="comment-120450" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-04-25T16:49:34+00:00">April 25, 2014 at 4:49 pm</time></a> </div>
<div class="comment-content">
<p>@Alexey</p>
<p>Sure, we can debate whether the core java classes should implement random hashing. I personally think that they should. There is no real downside for competent programmers and increased security as an upside.</p>
</div>
</li>
</ol>
