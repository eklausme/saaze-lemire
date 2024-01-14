---
date: "2008-05-06 12:00:00"
title: "Graph diameter versus maximum node degree"
index: false
---

[6 thoughts on &ldquo;Graph diameter versus maximum node degree&rdquo;](/lemire/blog/2008/05-06-graph-diameter-versus-maximum-node-degree)

<ol class="comment-list">
<li id="comment-49901" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">D. Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-06T10:33:48+00:00">May 6, 2008 at 10:33 am</time></a> </div>
<div class="comment-content">
<p>You might find <a href="https://en.wikipedia.org/wiki/Moore_graph" rel="nofollow ugc">http://en.wikipedia.org/wiki/Moore_graph</a> relevant &#8212; it gives an upper bound for n in terms of degree and diameter (equivalently a lower bound for diameter in terms of degree and n) due to Hoffman and Singleton (1960), that is unfortunately tight only in a small number of cases.</p>
</div>
</li>
<li id="comment-49902" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.geomblog.org/" class="url" rel="ugc external nofollow">Suresh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-06T12:21:41+00:00">May 6, 2008 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p>do you want specific numbers or asymptotics ? it&rsquo;s fairly clear that if the max degree is any constant, the diameter can&rsquo;t be less than log n, just by an expansion argument.</p>
</div>
</li>
<li id="comment-49903" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-06T12:37:43+00:00">May 6, 2008 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>Suresh: I was hoping for a precise result.</p>
</div>
</li>
<li id="comment-49999" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-07T07:20:03+00:00">July 7, 2008 at 7:20 am</time></a> </div>
<div class="comment-content">
<p>Don: that is a bound, not an exact result.</p>
</div>
</li>
<li id="comment-49998" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2318ca8f7d83b3ad09c180f078aa050c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2318ca8f7d83b3ad09c180f078aa050c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dyessick.com" class="url" rel="ugc external nofollow">Don</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-07T03:12:03+00:00">July 7, 2008 at 3:12 am</time></a> </div>
<div class="comment-content">
<p>suresh did give a precise result</p>
<p>let v be number of nodes<br/>
let b be max degree<br/>
we want min diameter d so<br/>
b^d &gt;= v<br/>
gives us that<br/>
d = log(v,b)</p>
</div>
</li>
<li id="comment-50003" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2318ca8f7d83b3ad09c180f078aa050c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2318ca8f7d83b3ad09c180f078aa050c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dyessick.com" class="url" rel="ugc external nofollow">Don</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-08T01:35:40+00:00">July 8, 2008 at 1:35 am</time></a> </div>
<div class="comment-content">
<p>Exact result depends on whether n is a nice number relative to m. If it is, and the following is an integer:<br/>
2 * ( log[base m] ( (n / 2 -1 ) / m ) + 1 )<br/>
you have your exact result. </p>
<p>idea &#8211; spread the points on a ball and no two points can be more than 1/2 ball away. The diameter is 1/2 the ball. The integer stuff is like trying to cover a ball with different polygons. Triangles, pentigons and hexigons work perfectly. Other polygons will leave weird gaps. Still we can mash our ball to force it to fit since the points do not have to be perfectly symetrical.</p>
<p>We can cover 1/2 the ball with a tree and the other half with an identical tree. Hence the 2 log (n/2). The point we pick as root is special since it can have an extra child. This gives the 2 log ((n/2-1)/m)+1. </p>
<p>Some care must be taken to join the two halves but they can be connected in such a way that any point is indistinguishable from root when the ball is turned (the even distribution). </p>
<p>If the formula comes out to not be an integer my belief is the result is to add one and round but I cannot fully justify this claim. </p>
<p>Under .5 and the extra points can be distributed on 1/2 of the ball adding at most one to the diameter. And .5 or more suggest points must be distributed on both halves of the ball potentially adding 2 to the diameter.</p>
<p>Anyway the problem interest me because I am currently seeking other applications of the diameter. I think it can be used for genome sequencing during the contig scaffolding phase but I am finding other applications and no literature beyond use as a metric.</p>
</div>
</li>
</ol>
