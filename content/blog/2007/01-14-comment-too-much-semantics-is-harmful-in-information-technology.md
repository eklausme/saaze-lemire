---
date: "2007-01-14 12:00:00"
title: "Too Much Semantics is Harmful in Information Technology"
index: false
---

[7 thoughts on &ldquo;Too Much Semantics is Harmful in Information Technology&rdquo;](/lemire/blog/2007/01-14-too-much-semantics-is-harmful-in-information-technology)

<ol class="comment-list">
<li id="comment-49099" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-01-14T17:29:55+00:00">January 14, 2007 at 5:29 pm</time></a> </div>
<div class="comment-content">
<p>I do not think I&rsquo;m confused. I mean exactly what you seem to imply I mean. SOA web services expect you to describe the semantics of any interaction. REST, on the other hand, does not. Even if you only had two possible interactions with a SOA web service, they would still be more complex than the REST equivalent.</p>
<p>I would argue that what you call &ldquo;application semantics&rdquo; is independent of the technology being used and, therefore, a constant we can dismiss. (If it can&rsquo;t be factored away, as you say, then it is always there&#8230; so it is a constant.)</p>
<p>Let us take your example of a gene or protein. Should the web service need to know the taxonomy or ontology of genes or proteins? I think not. Does it need to know that these two unique identifiers refer to the same thing? I think not. I think information should be provided strictly on a &ldquo;need-to-know&rdquo; basis. The minute you start tying things together, you introduce coupling, and therefore complexity. Your software starts making assumptions, you increase (without cause) the level of abstraction, and things break.</p>
<p>One should always aim for the simplest possible solution&#8230; and providing lots of semantics is not a simple feat.</p>
</div>
</li>
<li id="comment-49098" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6af945494dac892fb05b471e1fb5e80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6af945494dac892fb05b471e1fb5e80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://neilernst.net" class="url" rel="ugc external nofollow">Neil</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-01-14T15:16:38+00:00">January 14, 2007 at 3:16 pm</time></a> </div>
<div class="comment-content">
<p>Aren&rsquo;t you confusing service semantics and application semantics? REST reduces the possible ways to interact with a remote application/service to 4 (really 2, most of the time). This is clearly less complex. However, the application semantics don&rsquo;t seem any simpler to me. The developer has to understand what the result is of GETting a resource at a particular URI. They need to understand the interface or API being used. This seems potentially very complex &#8212; am I getting a gene or protein, is the name based on terminology A or B, what is the precision of the expression level, etc. This kind of complexity can&rsquo;t be factored away.</p>
</div>
</li>
<li id="comment-49108" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6af945494dac892fb05b471e1fb5e80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6af945494dac892fb05b471e1fb5e80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://neilernst.net" class="url" rel="ugc external nofollow">neil</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-01-15T22:49:17+00:00">January 15, 2007 at 10:49 pm</time></a> </div>
<div class="comment-content">
<p>I think we&rsquo;re in agreement. I just wanted to point out that of the hard things that need to be done in interacting with a service, the nuts-and-bolts of the interaction are the simple parts. It&rsquo;s the application logic that is complex. But a lot of the debate seems to ignore that aspect.</p>
</div>
</li>
<li id="comment-49160" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/894859b5ffc50f558b08c40352509d6a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/894859b5ffc50f558b08c40352509d6a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stephan Hagemann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-02-05T08:15:36+00:00">February 5, 2007 at 8:15 am</time></a> </div>
<div class="comment-content">
<p>I feel that one can track the origin of the semantic complexity with SOAs to their explicitness and &#8211; as you discussed &#8211; interaction formalization. However, (informal) semantics are present in REST architectures as well. Here a programmer has to figure out more meaning prior to implementing &#8211; otherwise his code will not work. As the semantics are not explicitly handled any more once the programs run there are few points of failure, as you state.</p>
</div>
</li>
<li id="comment-49225" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/176209bf92167d7bc9cde28a6939c064?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/176209bf92167d7bc9cde28a6939c064?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nirmit Desai</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-04-06T19:52:32+00:00">April 6, 2007 at 7:52 pm</time></a> </div>
<div class="comment-content">
<p>I think SOA is a much broader paradigm than you seem to imply. In my understanding REST is just another way to interact with web services. REST is an alternative to SOAP, and not SOA. SOA would include in addition to the interaction protocols, service description, service publishing, service discovery, service matching, service selection, and service engagement.</p>
</div>
</li>
<li id="comment-49226" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-04-06T20:10:58+00:00">April 6, 2007 at 8:10 pm</time></a> </div>
<div class="comment-content">
<p>Nirmit: Yes, there is a whole lot of stuff (for lack of a better word) in the SOA stack. But I do precisely mean that people are sidestepping all of it in favor of something several orders of magnitude Web-friendlier.</p>
<p>I predicted in 2002 that SOA would go nowhere. We are in 2007 and it has gone nowhere so far. And people keep claiming that it will make it, finally, maybe next year, but it won&rsquo;t.</p>
<p>Oh! Microsoft has web services. Java has web services. But these things do not interoperate. There are nothing else but proprietary remote function calls as we have had them for years and years.</p>
<p>We have not come forward one iota.</p>
</div>
</li>
<li id="comment-49326" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275ef00e7a0b3579b8a7d66483bf3c02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275ef00e7a0b3579b8a7d66483bf3c02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shopautodotca Seocontest</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-06-05T18:45:10+00:00">June 5, 2007 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>Hi, all excess are harmful even in technology. The best motto is to keep it short and simple. As you pointed out, the simplier, the better.</p>
</div>
</li>
</ol>
