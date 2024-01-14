---
date: "2008-01-25 12:00:00"
title: "What is an effective social network?"
index: false
---

[6 thoughts on &ldquo;What is an effective social network?&rdquo;](/lemire/blog/2008/01-25-what-is-an-effective-social-network)

<ol class="comment-list">
<li id="comment-49702" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-25T10:14:58+00:00">January 25, 2008 at 10:14 am</time></a> </div>
<div class="comment-content">
<p>This is a very interesting question. A good answer could have big social benefits.</p>
<p>In machine learning, a common meta-learning algorithm is to combine multiple learning algorithms by voting. It is well known that this meta-learning algorithm works best with a pool of diverse base learning algorithms. A natural measure of diversity among learning algorithms is conditional information:</p>
<p><a href="https://en.wikipedia.org/wiki/Conditional_information" rel="nofollow ugc">http://en.wikipedia.org/wiki/Conditional_information</a></p>
<p>This suggest that perhaps each vote in, say, Digg should be weighted by its conditional information. You would need to keep a history of each voter&rsquo;s voting pattern to calculate this.</p>
<p>You may get some other useful ideas by searching through the machine learning literature on voting as a meta-learning strategy.</p>
</div>
</li>
<li id="comment-49703" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-25T11:15:36+00:00">January 25, 2008 at 11:15 am</time></a> </div>
<div class="comment-content">
<p>Clever comment Peter!</p>
</div>
</li>
<li id="comment-49705" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d85d14bde9896007ed3b6b2d9731c14d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d85d14bde9896007ed3b6b2d9731c14d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-25T14:09:07+00:00">January 25, 2008 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>The idea of choosing a diverse subset comes up frequently in the experimental design literature, as a way to cover the parameter space well enough given the number of experiments that can actually be done. Most of the techniques presume some sort of existing distance measure, but that&rsquo;s likely in a social network environment.</p>
</div>
</li>
<li id="comment-49706" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6a5e003af3a3b09ba7c6618404aa223?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6a5e003af3a3b09ba7c6618404aa223?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-26T03:00:48+00:00">January 26, 2008 at 3:00 am</time></a> </div>
<div class="comment-content">
<p><i>Most of the techniques presume some sort of existing distance measure&#8230;</i></p>
<p>We use a lot of informal &ldquo;closeness&rdquo; criteria in all our thinking, intuitive or not, but it could be that this is a blind alley because the &ldquo;obvious&rdquo; nearest neighbour metrics doesn&rsquo;t scale at high dimensionality.</p>
<p>So, if metrics become useless how the heck are we going to handle similarities and analogies, hey Peter (wink!), this ruins the whole spatial level of abstraction&#8230;</p>
</div>
</li>
<li id="comment-49713" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-29T20:57:01+00:00">January 29, 2008 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>Interesting idea Daniel. I think it might apply to citation-based recommenders too, although I don&rsquo;t know how to adapt Conditional Information as a way of measuring &ldquo;paper diversity&rdquo;.</p>
</div>
</li>
<li id="comment-49714" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e2e3a01bf33747391457d97e0df832b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andre Vellino</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-29T20:58:23+00:00">January 29, 2008 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;anonymous&rdquo; in that last comment was me.</p>
</div>
</li>
</ol>
