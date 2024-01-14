---
date: "2008-07-10 12:00:00"
title: "A small graph-theory puzzle"
index: false
---

[6 thoughts on &ldquo;A small graph-theory puzzle&rdquo;](/lemire/blog/2008/07-10-a-small-graph-theory-puzzle)

<ol class="comment-list">
<li id="comment-50011" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.geomblog.org/" class="url" rel="ugc external nofollow">Suresh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-10T13:48:36+00:00">July 10, 2008 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>So the graph is directed ? In that case, is the &ldquo;distance&rdquo; between a pair defined to be the shorter of uv and vu ? or is the diameter merely the max over u,v of d(uv) ?</p>
</div>
</li>
<li id="comment-50012" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">D. Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-10T13:59:15+00:00">July 10, 2008 at 1:59 pm</time></a> </div>
<div class="comment-content">
<p>In the undirected case, see <a href="https://en.wikipedia.org/wiki/Moore_graph" rel="nofollow">Moore graphs</a> for a lower bound on diameter that is achievable for some cases. The fact that we don&rsquo;t know whether one of the possible cases of a Moore graph exists (the case with diameter 2, degree 57, and 3250 nodes) leads me to believe that there is no known efficient algorithm for constructing diameter-minimal graphs more generally.</p>
</div>
</li>
<li id="comment-50014" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-10T16:52:41+00:00">July 10, 2008 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>Suresh: I&rsquo;d say &ldquo;max over u,v of d(uv)&rdquo;. But if it is easier to solve with an alternate definition of the diameter, I&rsquo;d live with it.</p>
</div>
</li>
<li id="comment-50018" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-12T18:28:48+00:00">July 12, 2008 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>Do I understand this correctly or am I being missing something ?</p>
<p>Seems to me to be that for a diameter of i<br/>
the max. number of nodes is<br/>
(m+n)(m+n-1)^i</p>
<p>So for a given number of vertices v<br/>
the number of nodes remaining at any stage is</p>
<p>v &#8211; (m+n)(m+n-1)^i</p>
<p>for a diameter of i<br/>
find the biggest i add 1 depending on the result pending.</p>
</div>
</li>
<li id="comment-50024" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/91ce30388d6d552b697eb67659a371ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/91ce30388d6d552b697eb67659a371ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://web.mit.edu/price/" class="url" rel="ugc external nofollow">Greg Price</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-19T17:12:12+00:00">July 19, 2008 at 5:12 pm</time></a> </div>
<div class="comment-content">
<p>If you want the exactly minimum diameter, then that sounds like a hard combinatorial problem.</p>
<p>But you can get within a constant factor (in degree and diameter) with expander graphs, specifically Ramanujan graphs. A lower bound on the diameter is log(n)/log(d), and Ramanujan graphs have diameter less than 2 log(n)/log(d/4) = O(log(n)/log(d)).</p>
<p>The defining feature of Ramanujan graphs is that they have spectral expansion lambda </p>
</div>
</li>
<li id="comment-50025" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/91ce30388d6d552b697eb67659a371ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/91ce30388d6d552b697eb67659a371ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://web.mit.edu/price/" class="url" rel="ugc external nofollow">Greg Price</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-07-19T17:15:52+00:00">July 19, 2008 at 5:15 pm</time></a> </div>
<div class="comment-content">
<p>[Your comment form eats &lt; signs. Is it taking raw HTML? It&rsquo;d be nice to know, to avoid formatting mishaps.]</p>
<p>If you want the exactly minimum diameter, then that sounds like a hard combinatorial problem.</p>
<p>But you can get within a constant factor (in degree and diameter) with expander graphs, specifically Ramanujan graphs. A lower bound on the diameter is log(n)/log(d), and Ramanujan graphs have diameter less than 2 log(n)/log(d/4) = O(log(n)/log(d)).</p>
<p>The defining feature of Ramanujan graphs is that they have spectral expansion lambda &lt; 2 srqt(d-1)/d. By considering a random walk starting from one vertex it&rsquo;s not hard to show this implies a diameter at most log(n)/log(1/lambda) &lt; 2 log(n)/log(d/4).</p>
<p>The <a href="https://en.wikipedia.org/wiki/Ramanujan_graph" rel="nofollow">Wikipedia article</a> has references.</p>
<p>This is all in the undirected case, so it applies also when the in- and out-degrees are equal. Since the total in-degree equals the total out-degree, I expect it doesn&rsquo;t help to allow higher in- than out-degrees or vice versa, but I don&rsquo;t know.</p>
<p>There&rsquo;s a large body of work on expanders in general, and it&rsquo;s possible someone has addressed diameter specifically and closed the constant-factor gap left by the spectral approach through Ramanujan graphs.</p>
</div>
</li>
</ol>
