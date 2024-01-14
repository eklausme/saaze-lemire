---
date: "2007-11-28 12:00:00"
title: "Is PageRank just good marketing?"
index: false
---

[7 thoughts on &ldquo;Is PageRank just good marketing?&rdquo;](/lemire/blog/2007/11-28-is-pagerank-just-good-marketing)

<ol class="comment-list">
<li id="comment-49593" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9476b786bc2559cdb82ffab8e2979551?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9476b786bc2559cdb82ffab8e2979551?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://sergionunes.com/" class="url" rel="ugc external nofollow">SÃ©rgio Nunes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-11-28T12:11:19+00:00">November 28, 2007 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>Hi again,</p>
<p>Sorry for lack of details about me. My name is Sérgio Nunes and I&rsquo;m a PhD student in the field of WebIR.</p>
<p>Also sorry for the lack of a proper reference on my statement. This is a recent experimental work by Marc Najork that delves into this issue:</p>
<p>&ldquo;HITS on the Web: How does it Compare?&rdquo;<br/>
<a href="http://research.microsoft.com/research/pubs/view.aspx?0rc=p&#038;type=Publication&#038;id=1734" rel="nofollow ugc">http://research.microsoft.com/research/pubs/view.aspx?0rc=p&#038;type=Publication&#038;id=1734</a></p>
</div>
</li>
<li id="comment-49594" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Fernando Diaz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-11-28T12:31:01+00:00">November 28, 2007 at 12:31 pm</time></a> </div>
<div class="comment-content">
<p>IR folks long-suspected PageRank to be a red herring but was not confirmed until the last few years. The reference I like to use comes from MSR and was published at WWW06,</p>
<p>M. Richardson, A. Prakash, and E. Brill, &ldquo;<a>Beyond pagerank: machine learning for static ranking</a>,â€ in WWW &rsquo;06: Proceedings of the 15th international conference on World Wide Web, (New York, NY, USA), pp. 707â€“715, ACM Press, 2006.</p>
<p>The authors demonstrate that structure-independent features, combined with page&rsquo;s popularity significantly outperformed PageRank. Informal conversations with engine architects and SEO folks confirms this. </p>
<p>It&rsquo;s helpful to interpret these results in the context of a random walk on the web graph. PageRank is the stationary distribution of a random walker on the web graph. In situations where you have no knowledge about page visitation , this is a reasonable surrogate. However, in the presence of real user data (gathered through a toolbar or OS), the random walk model seems less attractive than models which incorporate visitation data.</p>
<p>That said, it also seems likely that actual effectiveness of search engines has more to do with using massive amounts of click data to train classic IR features and query triage schemes.</p>
</div>
</li>
<li id="comment-49595" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7361130199533952178a6d87e9b29faa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7361130199533952178a6d87e9b29faa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-11-28T16:27:42+00:00">November 28, 2007 at 4:27 pm</time></a> </div>
<div class="comment-content">
<p>Interesting post. I used Google Scholar to find all citations of &ldquo;Predicting fame and fortune: Pagerank or indegree&rdquo;. Google found 16 citations:</p>
<p><a href="https://scholar.google.com/scholar?hl=en&#038;lr=&#038;cites=5736996577557537352" rel="nofollow ugc">http://scholar.google.com/scholar?hl=en&#038;lr=&#038;cites=5736996577557537352</a></p>
<p>I skimmed some of the citations, and two seemed particularly relevant: (1) Hits on the web: how does it compare? (2) Beyond PageRank: Machine Learning for Static Ranking. I was about to post this comment, when I saw that two previous comments gave exactly the same two references. Now I&rsquo;m posting this comment anyway, to say that Google PageRank may be bogus, but Google Scholar seems to work just fine. 🙂</p>
</div>
</li>
<li id="comment-49600" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d512677f7d4b4f03dc7f5b28ee48cd6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d512677f7d4b4f03dc7f5b28ee48cd6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.behind-the-enemy-lines.com/" class="url" rel="ugc external nofollow">Panos Ipeirotis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-01T22:44:24+00:00">December 1, 2007 at 10:44 pm</time></a> </div>
<div class="comment-content">
<p>Just to offer some anecdotal (and unconfirmed) piece of information: it is claimed that the original Pagerank was not exactly the one described in the WWW97 paper. </p>
<p>In the plain vanilla implementation, the underlying model of Pagerank corresponds to a &ldquo;random surfer&rdquo; that follows hyperlinks and with probability 0.85 gets bored and jumps to a random page. I have heard that in the actual implementation, the random surfer jumps only to pages in the &ldquo;edu&rdquo; domain. (This idea is similar to the TrustRank algorithm.)</p>
<p>Of course, since 1996 many things have changed and today there are so many other factors that are taken into consideration during ranking that it is almost certain that PageRank is mainly a marketing tool.</p>
</div>
</li>
<li id="comment-49601" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed3ebabdece90cf2d6252bdc08eec58b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed3ebabdece90cf2d6252bdc08eec58b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.veronis.fr/" class="url" rel="ugc external nofollow">Jean VÃ©ronis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-02T14:49:28+00:00">December 2, 2007 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>I agree that PageRank has become mainly a marketing tool. However, there is a flaw in Upstill&rsquo;s work. He doesn&rsquo;t compare in-degree with PageRank but with the score given in Google&rsquo;s Toolbar, called &ldquo;PageRank&rdquo;. Nobody knows what this score is exactly. In particular, nothing proves that it is the real &ldquo;pure&rdquo; PageRank as described in the original PageRank paper. I suspect that it is (a downgraded version of) the score that Google uses for ranking, which is a mixture of many factors, in which PageRank plays some (unknown) role.</p>
</div>
</li>
<li id="comment-49602" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-02T19:02:31+00:00">December 2, 2007 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>Interesting observation, Jean, but the paper by Najork et al. (HITS on the Web: How does it Compare?) support the claim that PageRank is not even as accurate as in-degree.</p>
</div>
</li>
<li id="comment-49606" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed3ebabdece90cf2d6252bdc08eec58b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed3ebabdece90cf2d6252bdc08eec58b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.veronis.fr/" class="url" rel="ugc external nofollow">Jean VÃ©ronis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-12-03T03:35:51+00:00">December 3, 2007 at 3:35 am</time></a> </div>
<div class="comment-content">
<p>True. My comment was not in defence of PageRank. The simple fact that Google need to supplement it with several dozens of other criteria shows that it is not ideal 😉 In a way, Upstill said something right with a disputable methodology.</p>
</div>
</li>
</ol>
