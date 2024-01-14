---
date: "2017-03-13 12:00:00"
title: "Stable Priority Queues?"
index: false
---

[8 thoughts on &ldquo;Stable Priority Queues?&rdquo;](/lemire/blog/2017/03-13-stable-priority-queues)

<ol class="comment-list">
<li id="comment-275196" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-13T20:07:23+00:00">March 13, 2017 at 8:07 pm</time></a> </div>
<div class="comment-content">
<p>There are some options discussed here: <a href="http://cstheory.stackexchange.com/questions/593/is-there-a-stable-heap" rel="nofollow ugc">http://cstheory.stackexchange.com/questions/593/is-there-a-stable-heap</a> .</p>
</div>
<ol class="children">
<li id="comment-275197" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-13T20:08:49+00:00">March 13, 2017 at 8:08 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I already link to this reference in my blog post. Do you think any of them is attractive as far as implementation goes?</p>
</div>
<ol class="children">
<li id="comment-275204" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-13T21:05:35+00:00">March 13, 2017 at 9:05 pm</time></a> </div>
<div class="comment-content">
<p>Apologies for not noticing that &#8212; I made a mental bookmark to look through these later, but I haven&rsquo;t looked in depth. So far Eppstein&rsquo;s idea seems fairly costly, but the Fagerberg modification of Bentley-Saxe looks interesting.</p>
</div>
<ol class="children">
<li id="comment-275213" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-13T22:59:34+00:00">March 13, 2017 at 10:59 pm</time></a> </div>
<div class="comment-content">
<p>Now that I&rsquo;ve looked at Fagerburg, it doesn&rsquo;t make sense &#8212; the binary representation of n does not match the bucket structure if one of the buckets has had all of its members deleted.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-275866" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4201fc61d415deab3e60d8fff081904?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4201fc61d415deab3e60d8fff081904?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-19T13:55:42+00:00">March 19, 2017 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t looked at the links, so this might be redundant, but wouldn&rsquo;t it work to have a priority queue of FIFO queues? All of the items in a particular FIFO queue would all have the same score. Of course there are lots of ways to implement a FIFO queue; pick your favorite.</p>
</div>
<ol class="children">
<li id="comment-275952" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-20T19:56:50+00:00">March 20, 2017 at 7:56 pm</time></a> </div>
<div class="comment-content">
<p>Do you have an implementation (anything would do: Python, Perl, Ruby, JavaScript)?</p>
</div>
<ol class="children">
<li id="comment-276099" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4201fc61d415deab3e60d8fff081904?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4201fc61d415deab3e60d8fff081904?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cs.coloradocollege.edu/~bylvisaker/" class="url" rel="ugc external nofollow">Ben</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-22T02:36:02+00:00">March 22, 2017 at 2:36 am</time></a> </div>
<div class="comment-content">
<p>Sorry, the idea I posted doesn&rsquo;t work at all. When inserting a value that&rsquo;s equal to a value already in the priority queue, there&rsquo;s no guarantee that you&rsquo;d stumble across the existing value.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-275964" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-03-20T21:26:38+00:00">March 20, 2017 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>One minor insight is that this looks a lot more like sorting than heapifying. For instance inserting the same value n times means that the entries either have to be sorted internally on insert (in some fully ordered structure like a BST), or they have to keep timestamp counters as you describe, so that they can be ordered on output. </p>
<p>A hybrid strategy is to sort them partially by timestamp on insert (into separate subqueues for each time range, say) and store the remaining lower-order time bits with each entry. The subqueues can then be managed in a queue-of-queues. There are some possible benefits in that only the newest subqueue accepts inserts, although I can see some costs too :(.</p>
</div>
</li>
</ol>
