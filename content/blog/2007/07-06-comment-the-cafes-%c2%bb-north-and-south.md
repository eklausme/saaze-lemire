---
date: "2007-07-06 12:00:00"
title: "The Cafes Â» North and South"
index: false
---

[6 thoughts on &ldquo;The Cafes Â» North and South&rdquo;](/lemire/blog/2007/07-06-the-cafes-%c2%bb-north-and-south)

<ol class="comment-list">
<li id="comment-49397" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d36df0b06ff9ee4c8e187ba971193b60?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d36df0b06ff9ee4c8e187ba971193b60?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-13T00:33:31+00:00">July 13, 2007 at 12:33 am</time></a> </div>
<div class="comment-content">
<p>REST works great for just about everything. WS-* can do certain jobs, especially where reliability or certain security needs exist, better than REST. You write &ldquo;Please be a WS-* advocate if you want, but you are applying nice ideas that will never work no matter what.&rdquo; I&rsquo;ve seen WS-* solutions work, so your statement is not correct. Why not let the customer specify his or her needs and let the programmers implement the best solution using REST or WS-*?</p>
</div>
</li>
<li id="comment-49398" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-13T09:37:15+00:00">July 13, 2007 at 9:37 am</time></a> </div>
<div class="comment-content">
<p>We&rsquo;ve all heard of people smoking and living to be a hundred. Should we conclude that smoking can sometimes work, and that we should let people decide?</p>
<p>No way. Smoking is bad for you, bad for the people around you, it is bad for your kids and so on.</p>
<p>Yes, you can make Web Services work, but this does not make it a viable solution. You know, people also design Web sites using C++. You have people who build GUI applications in Fortran. And so on.</p>
</div>
</li>
<li id="comment-49402" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-14T13:23:43+00:00">July 14, 2007 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>Thanks James for the reference. SOA does not solve the data interoperability problem, quite the contrary. It adds layers of complexity on top of it.</p>
</div>
</li>
<li id="comment-49401" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d36df0b06ff9ee4c8e187ba971193b60?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d36df0b06ff9ee4c8e187ba971193b60?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-14T13:16:58+00:00">July 14, 2007 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>Look at <a href="http://www.genome.jp/kegg/soap/" rel="nofollow ugc">http://www.genome.jp/kegg/soap/</a><br/>
for a description of one very well functioning web service used in the area of biology. There are many schools and institutes working on projects involving genes. There are a great many data models and data formats in use to describe genes in the various IT systems used by the schools and institutes working of gene research. Slowly, but surely, XML and ASN.1 are becoming the standard formats. Because the data schemas at various institutes are different, the only good way to exchange data between data bases is using SOA. WSDL is used as the base of interface programming and data schema definition of SOAP clients. Other than using Corba, I don&rsquo;t know how these gene researchers could efficiently exchange the huge amounts of information they exchange. How could you efficiently exchange these huge amounts of information between multiple schools and institutes with REST?</p>
</div>
</li>
<li id="comment-49412" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d36df0b06ff9ee4c8e187ba971193b60?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d36df0b06ff9ee4c8e187ba971193b60?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-20T01:35:36+00:00">July 20, 2007 at 1:35 am</time></a> </div>
<div class="comment-content">
<p>Daniel,</p>
<p>SOA does indeed add layers of complexity on top of data interoperability difficulties. On the other hand, being able to share data schema information in a standard format using WSDL can reduce the difficulties arising from data interoperability in some cases. Perhaps just because I have more experience with WS-* than with REST, I don&rsquo;t see how multiple nonhuman consumers can easily be presented the data they require in the format they require without using WSDL. WSDL reduces the effort required to program the clients and also allows for quick updates when things change and can also be helpful troubleshooting.</p>
</div>
</li>
<li id="comment-49413" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-07-20T10:05:23+00:00">July 20, 2007 at 10:05 am</time></a> </div>
<div class="comment-content">
<p><em> (&#8230;) I don&rsquo;t see how multiple nonhuman consumers can easily be presented the data they require in the format they require without using WSDL.</em></p>
<p>Well, let us see. Browsers are nonhuman consumers and they are presented the data they require in the format they require without using WSDL.</p>
<p>I wrote non-human Web Service clients for several Web Services (Google, Amazon, and so on) and the server presented them with the data in the format they required without WSDL. </p>
<p>Here is the process:</p>
<ul>
<li>The designers write the server application and some human-readable documentation.</li>
<li>The human programmer writes the software based on the documentation. REST is dead easy to debug: a GET query can be simulated in a browser in seconds.</li>
<li>That&rsquo;s it.</li>
</ul>
<p>What if different services you access produce different formats? Well, this ought to be documented. Then your client ought to know how to read these different formats (otherwise, WSDL won&rsquo;t help you) and to choose the right format based on the server specs (which are human readable, maybe posted on a web site?).</p>
<p>What if data formats change? Well, if they do, then you will know right away and can easily see what they problem is with a GET query. Then just update your client accordingly.</p>
<p>Oh, you want clients that will automatically reprogram themselves when remote APIs change, is that it? Well WSDL does not do this. Strong AI is needed if you want clients to reprogram themselves without help. And when this starts happening, we will have Battelstar Galactica all over again, and the Cylon will invade us and stuff. Bad, bad.</p>
</div>
</li>
</ol>
