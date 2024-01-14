---
date: "2010-11-17 12:00:00"
title: "You probably misunderstand XML"
index: false
---

[26 thoughts on &ldquo;You probably misunderstand XML&rdquo;](/lemire/blog/2010/11-17-you-probably-misunderstand-xml)

<ol class="comment-list">
<li id="comment-53881" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/742841c66e8905a2ace9798e4358fab9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/742841c66e8905a2ace9798e4358fab9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alan Dipert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-17T22:13:24+00:00">November 17, 2010 at 10:13 pm</time></a> </div>
<div class="comment-content">
<p>Hi, enjoyed the post! </p>
<p>Considering the immediate utility of JSON and YAML, I think it may be most helpful for your students to focus on exactly why DocBook, Atom, and OpenDocument are *not* JSON.</p>
<p>They needed to be standards in order to be of any use, and the only way to standardize something is with a formal, implementation-agnostic definition. I think the reason they are XML has little or nothing to do with the data they represent, or whether or not that data could be considered &ldquo;semi-structured.&rdquo; </p>
<p>It just happens that XML has the most complete and accepted tooling around schemas and validation. My opinion, anyway. Your post inspired me to write a longer, semi-rant over here: <a href="http://alan.dipert.org/post/1606016275/an-xml-rant" rel="nofollow ugc">http://alan.dipert.org/post/1606016275/an-xml-rant</a></p>
</div>
</li>
<li id="comment-53884" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa7c1350d93036592f58f165318044db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa7c1350d93036592f58f165318044db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://billmill.org/" class="url" rel="ugc external nofollow">Bill Mill</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T00:31:21+00:00">November 18, 2010 at 12:31 am</time></a> </div>
<div class="comment-content">
<p>Why couldn&rsquo;t you easily replace XML with JSON in the case of Atom? It seems to me that it would be quite easy to do so.</p>
</div>
</li>
<li id="comment-53880" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ecb5b4801bc4b316431b30da9cd6ee53?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ecb5b4801bc4b316431b30da9cd6ee53?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://yoavrubin.blogspot.com" class="url" rel="ugc external nofollow">Yoav</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-17T21:04:16+00:00">November 17, 2010 at 9:04 pm</time></a> </div>
<div class="comment-content">
<p>As far as I see it, json is the format that is preferred by a browser frontend, and xml / flat file is the solution to everything else.</p>
</div>
</li>
<li id="comment-53882" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b171f37440c4c0a96ba3d29735310de5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b171f37440c4c0a96ba3d29735310de5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.dtic.upf.edu/~ocelma/" class="url" rel="ugc external nofollow">Oscar</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-17T22:57:19+00:00">November 17, 2010 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>Hi, </p>
<p>just wondering what you think about XML Databases ( <a href="https://en.wikipedia.org/wiki/XML_database" rel="nofollow ugc">http://en.wikipedia.org/wiki/XML_database</a>), or if you even taught them in this course?</p>
<p>I did some work with XML:DB a few years back (mainly eXist, XIndice and Berkeley DB), and I really enjoyed it.<br/>
It was great to just dump some (even close to million) XML documents, and do some XQuery queries on top of that.<br/>
At least, it was much much easier than dealing with the weird XML layers on top of Oracle or IBM&rsquo;s DB2.<br/>
And not only this, but the even-more-strange SQL queries to retrieve those XML chunks.<br/>
IMHO, XQuery was(is?) a great language to deal with XML data.</p>
<p>I also did some webapps where the backend was just a simple XML:DB (eXist), and it was quite fast.</p>
<p>Ok&#8230; I guess that&rsquo;s all for now!</p>
<p>Cheers, Oscar</p>
</div>
</li>
<li id="comment-53883" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b8ee3358285f0154948f0195b9934b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b8ee3358285f0154948f0195b9934b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brandon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T00:11:17+00:00">November 18, 2010 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>I agree that there are legacy XML formats that are not too horrible, and plenty of existing tools structured around XML that work. But if you were designing a new system, can you give an example of one where you would choose XML over JSON, and why?</p>
</div>
</li>
<li id="comment-53885" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f01c56bb1f952ea101e77a799f9f9335?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f01c56bb1f952ea101e77a799f9f9335?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eamon.nerbonne.org/" class="url" rel="ugc external nofollow">Eamon Nerbonne</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T04:27:10+00:00">November 18, 2010 at 4:27 am</time></a> </div>
<div class="comment-content">
<p>JSON/XML are extremely similar. They&rsquo;re both tree structures permitting untyped ordered nodes. </p>
<p>There are two (to me) significant differences between JSON/XML:<br/>
&#8211; tooling: XML has far better support in almost all environments, but (ironically) not necessarily on the web. That includes highly tuned parsers, syntax highlighting in editors, availability of query languages, query API&rsquo;s, serialization support etc. JSON is catching up here &#8211; but slowly, and I don&rsquo;t expect it will ever close the gap. XPATH, XQUERY, XSLT are all extremely powerful and rather useful.<br/>
&#8211; wordiness: JSON is shorter, which is of course better. But the difference is small, particularly when compressed. The big json savings come from the lack of element names on array elements &#8211; but those make inspection easier and are a natural means of schema extensibility without any planning necessary. By constrast, it&rsquo;s not so automatic to make an extensible json format, nor will it be quite as inspectible (though the difference is often nil). </p>
<p>So if you&rsquo;re on the web client side, exchanging small mostly untyped bits of information, compressed JSON works well. Browsers transparently decompress and json parsing can be trivial. To put it in perspective, if size is a key issue, enabling compression is a larger factor than xml vs. json. Elsewhere, tooling almost certainly matters more than details of encoding on the wire. And if in fact you do need to inspect the encoded data, element names are nice to have. But most relevantly, it just doesn&rsquo;t matter much; and standardization is simplicity: using two almost identical formats is just making your life harder.</p>
<p>For a similar reason, I&rsquo;d say the suggestion to use &ldquo;flat files&rdquo; or whatever is generally unwise. Except in the most trivial of cases, json or xml have little enough overhead to make reinventing the wheel simple more effort than it&rsquo;s worth.</p>
<p>On the topic of messed up bits of XML: wtf is up with namespaces? What a bloated, unhandy mess. Fortunately mostly avoidable. And such a shame that XSLT2 never caught on on the web &#8211; that would be neat bit of tech in a browser.</p>
</div>
</li>
<li id="comment-53886" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T10:09:49+00:00">November 18, 2010 at 10:09 am</time></a> </div>
<div class="comment-content">
<p>@Oscar</p>
<p>I did link at the bottom of my post to an older post on XML databases. I think they are just not getting much traction at all.</p>
<p>@Brandon and @Mill</p>
<p>For &ldquo;new&rdquo; applications that do not fit well in the established XML applications I have listed in my post, I would be tempted to consider JSON or flat files.</p>
<p>JSON was designed for small loads of structured data. It is poor match as a document format.</p>
<p>@Nerbonne</p>
<p>There are excellent tools to work with flat files. Flat files are fast (parsing is minimal). They are also simple and human readable (more so sometimes than JSON/XML).</p>
<p>I agree that namespaces are difficult. However, they are useful to support things like microformats.</p>
<p>XSLT2 is difficult to implement efficiently in a browser. It is a very rich language. I must point out that XQuery has also received little support in the browsers. In fact, browser developers seem to have given up on XML technology beyond what they already have.</p>
</div>
</li>
<li id="comment-53888" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T11:11:20+00:00">November 18, 2010 at 11:11 am</time></a> </div>
<div class="comment-content">
<p>@Brandon</p>
<p><em>You say that JSON is a poor match as a document format. Why?</em></p>
<p>See Sean McGrath&rsquo;s post on mixed content for a related explanation:</p>
<p><a href="https://seanmcgrath.blogspot.com/2007/01/mixed-content-trying-to-understand-json.html" rel="nofollow ugc">http://seanmcgrath.blogspot.com/2007/01/mixed-content-trying-to-understand-json.html</a></p>
</div>
</li>
<li id="comment-53890" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/575869bc1cf09af66d0b7c2ba9fe149a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/575869bc1cf09af66d0b7c2ba9fe149a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://homepages.cwi.nl/~arjen/" class="url" rel="ugc external nofollow">Arjen P. de Vries</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T11:31:04+00:00">November 18, 2010 at 11:31 am</time></a> </div>
<div class="comment-content">
<p>One aspect that is underrepresented in this discussion, and also in our basic computer science education, is that of data independence. </p>
<p>In this XML vs. JSON discussion, most of the arguments are really mixing up the physical and logical level &#8211; one can also represent XML in a highly compressed format; even though many of today&rsquo;s implementations of XML technologies may not properly do this. And one can also represent semi-structured data using JSON, even though then manipulating it may prove a big challenge.</p>
<p>On a practical issue, I think a standard JSON 2 XML converter would help us use JSON data in our XML query languages without effort, and it should not be difficult to do this.</p>
</div>
</li>
<li id="comment-53894" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T13:11:43+00:00">November 18, 2010 at 1:11 pm</time></a> </div>
<div class="comment-content">
<p>@Brandon</p>
<p><em>I&rsquo;m still struggling, though, with a use case for XML in a modern (non-legacy-driven) data-exchange situation</em></p>
<p>Firstly, you have to determine whether you are dealing with structured, semi-structured or unstructured data. If, and only if, you are dealing with semi-structured data, then XML is a candidate. If you are dealing with simple, mostly structured data, and you are on the Web, then JSON is probably best.</p>
<p> XML is not, and has never been, a generic data format.</p>
<p>One annoying application of XML is for configuration files&#8230; because often, all that was required is a simple key/value list.</p>
</div>
</li>
<li id="comment-53887" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b8ee3358285f0154948f0195b9934b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b8ee3358285f0154948f0195b9934b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brandon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T10:40:25+00:00">November 18, 2010 at 10:40 am</time></a> </div>
<div class="comment-content">
<p>@Daniel, I understand that switching working formats and tools from XML to JSON might be a waste of time, so for established systems and XML standards, XML will remain in use. You say that JSON is a poor match as a document format. Why? What is it that XML does that JSON cannot do (or that XML does more elegantly)? I can&rsquo;t think of a time when I would use XML, other than to take advantage of legacy tools or formats.</p>
</div>
</li>
<li id="comment-53897" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/897ca8f3cdbe4a0c68be53a8a08c51e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/897ca8f3cdbe4a0c68be53a8a08c51e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.anty.info/" class="url" rel="ugc external nofollow">anty</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T15:50:25+00:00">November 18, 2010 at 3:50 pm</time></a> </div>
<div class="comment-content">
<p>At our university in Austria we got a course called &ldquo;semi-structured data&rdquo;. It&rsquo;s made mandatory for most students therfor there is no problem with a lack of students attending 🙂</p>
</div>
</li>
<li id="comment-53889" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f01c56bb1f952ea101e77a799f9f9335?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f01c56bb1f952ea101e77a799f9f9335?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://eamon.nerbonne.org/" class="url" rel="ugc external nofollow">Eamon Nerbonne</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T11:18:56+00:00">November 18, 2010 at 11:18 am</time></a> </div>
<div class="comment-content">
<p>Flat files can be fine if all you want is a plain sequence of characters, or perhaps a sequence of lines &#8211; or just maybe if you have a comma separated file.</p>
<p>What I see a little too often is feature-creep; what started as a flat file now has some structured stuff up front- &ldquo;headers&rdquo; if you will, and some structure in each line &#8211; at which point, why not just use an existing format, and one that&rsquo;s trivially usable by come what may.</p>
</div>
</li>
<li id="comment-53891" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b7b8cabfbe79baa74e6cc4136a89dc9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b7b8cabfbe79baa74e6cc4136a89dc9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.ssims.co.uk" class="url" rel="ugc external nofollow">Stewart Sims</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T11:35:47+00:00">November 18, 2010 at 11:35 am</time></a> </div>
<div class="comment-content">
<p>Most students here in the UK aren&rsquo;t even taught about the concept of web services, let alone the difference between the SOAP/XML approach and the RESTful / JSON approach.</p>
<p>In fact I personally think XML is very valuable in web services &#8211; for business applications where you&rsquo;re passing large amounts of structured data. In this arena XML can be highly effective. The problem is very few students or academics ever see such web service systems in action. And many home brew developers don&rsquo;t have the patience or desire to learn about SOAP/XML because that&rsquo;s &lsquo;enterprise&rsquo; stuff and its all a bit scary.</p>
<p>I think what it boils down to is that the real problem (and this is a major problem in software I will continue to bang on about at every oppoturnity) is that:</p>
<p>The majority of developers are way behind the minority who are developing systems using modern technologies like web services and SOA. And I would be willing to bet most students are even further behind them in terms of useful knowledge of the landscape of cutting edge business software.</p>
<p>Before you can even begin to talk about the appropriate approach to something like web services, you have to get them to understand what they are and they&rsquo;re important.</p>
</div>
</li>
<li id="comment-53892" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0eb561e9642b2cd246018831d0889275?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0eb561e9642b2cd246018831d0889275?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Troy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T11:40:57+00:00">November 18, 2010 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>I think a lot of us developers that started using json merely did it to get around the cross-domain issues of fetching xml client-side. If it wasn&rsquo;t for that, I wouldn&rsquo;t have actively looked for another solution (JSON).</p>
<p><a href="http://tech.rawsignal.com" rel="nofollow ugc">http://tech.rawsignal.com</a></p>
</div>
</li>
<li id="comment-53893" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b8ee3358285f0154948f0195b9934b5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b8ee3358285f0154948f0195b9934b5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brandon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T11:54:24+00:00">November 18, 2010 at 11:54 am</time></a> </div>
<div class="comment-content">
<p>@Daniel, great link, and I get that. XML (HTML) is great for text formatting markup, and the mixed content problem with text markup would be very difficult to solve in XML-free JSON. If I needed to send HTML-formatted text from server to client, I certainly wouldn&rsquo;t try to translate it into JSON. I&rsquo;m still struggling, though, with a use case for XML in a modern (non-legacy-driven) data-exchange situation. Is there an example you can give me (other than presentation markup) where XML would be a better choice than JSON? Thanks for your responses &#8212; I still think I misunderstand XML 🙂</p>
</div>
</li>
<li id="comment-53895" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ecb5b4801bc4b316431b30da9cd6ee53?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ecb5b4801bc4b316431b30da9cd6ee53?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://yoavrubin.blogspot.com" class="url" rel="ugc external nofollow">Yoav</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T13:11:59+00:00">November 18, 2010 at 1:11 pm</time></a> </div>
<div class="comment-content">
<p>Both JSON and XML are formats. It is possible to perform 1:1 mapping from one to another, as both of them have different ways to describe the same data.<br/>
Data formats are needed to send data from place A to place B, and therefore the only thing that matters is how the format is supported in A and B. If browsers provides would build an XML engine that would be faster then the JSON engine, then there would be no need to use JSON. If the tools / standard support for JSON would be better then they support XML, then there would be no need to use XML.It&rsquo;s all in the tool + standards support. Readability and network payload are to be handled by tools. What matters is the data, formats are just the paper that carries the text.</p>
</div>
</li>
<li id="comment-53896" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/49913fbfb533af06a07f313f14a49a49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/49913fbfb533af06a07f313f14a49a49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chuck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-18T13:18:36+00:00">November 18, 2010 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for a great article that calls out what I&rsquo;ve said for years, i.e., the structure of the data should be thoroughly understood before picking an encoding method. As you note, there are some things that XML works well for and others that it simply doesn&rsquo;t. Unfortunately, XML was taken to be the silver bullet for all data formats (as typically happens with new things) and applied in ways that it should really never have been.</p>
</div>
</li>
<li id="comment-53898" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4da9b689a88631c71e39084e3592e93b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4da9b689a88631c71e39084e3592e93b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KoW</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-21T01:05:20+00:00">November 21, 2010 at 1:05 am</time></a> </div>
<div class="comment-content">
<p>Hmm, maybe I am completely wrong, but isn&rsquo;t the main difference between XML and json/yaml the fact that XML has the possibility to validate vs. a schema? Which itself is described in the same format &#8230;</p>
<p>Oh, and next time I would suggest to go for &ldquo;semi-structured data&rdquo; in the course title. It is about time that students learn about those 80 &#8211; 90% of enterprise data. Imho there is no such thing as completely unstructured data in enterprises, but that is another discusssion &#8230;.</p>
</div>
</li>
<li id="comment-53899" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/395e064cb5832654734c1a2934f56a44?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/395e064cb5832654734c1a2934f56a44?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcelle Kratochvil</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-21T17:18:50+00:00">November 21, 2010 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>When it comes true unstructured data, which covers multimedia and any file format, neither XML nor JSON are efficient for handling them.<br/>
Its not that one is better than the other, its using the right one for the right job, knowing their limitations.<br/>
A private paper I recently wrote, addresses and highlights this (available on request &#8211; email <a href="/cdn-cgi/l/email-protection#4825293a2b2d24242d0838212b3c212726662b2725"><span class="__cf_email__" data-cfemail="3b565a49585e57575e7b4b52584f52545515585456">[email&#160;protected]</span></a>) and covers the mentality of the relationist.</p>
</div>
</li>
<li id="comment-53900" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-21T19:40:52+00:00">November 21, 2010 at 7:40 pm</time></a> </div>
<div class="comment-content">
<p>@KoW</p>
<p>I use the expression &ldquo;unstructured data&rdquo; as a technical term in this blog post.(One could argue that only random noise has no structure.)</p>
</div>
</li>
<li id="comment-53901" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-22T12:09:18+00:00">November 22, 2010 at 12:09 pm</time></a> </div>
<div class="comment-content">
<p>XML is can be a really good format for configuration. Using key/value pair, more validation has to be done by the programmer and the user can&rsquo;t benefits from Editor assistance (completion, validation&#8230;).</p>
<p>XML/JSON provide lot of flexibility for managing tree like data but this flexibility comes with a big cost in performance and size. The main thing </p>
<p>if your data doesn&rsquo;t express easily as a tree (image, pictures, sound&#8230;)then avoid XML/JSON.</p>
<p>You want your messages to be small and processing to be fast ? stay away from XML or JSON.</p>
<p>You want a portable format with minimal cost for the design of the format and the tooling ? Then theses format can help you a lot.</p>
</div>
</li>
<li id="comment-53915" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/49913fbfb533af06a07f313f14a49a49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/49913fbfb533af06a07f313f14a49a49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chuck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-24T14:25:10+00:00">November 24, 2010 at 2:25 pm</time></a> </div>
<div class="comment-content">
<p>Actually, I disagree about using XML for configs. The validation has to be performed at some point by a developer whether it involves validating key-value pairs in code or creating a DTD or schema to do the validation. If the assumption is that the tool will be generating / managing the config then the the difference only be the time it takes for the tool to validate, regardless of the file format. The fallacy of XML in many of these cases is that it makes the file unreadable by a human, which may be moot if a human is not expected to hand edit it.</p>
</div>
</li>
<li id="comment-53952" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T15:32:19+00:00">November 30, 2010 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>@Ken</p>
<p>Thanks Ken. You might be right.</p>
</div>
</li>
<li id="comment-53951" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/97d540da0aee796ba07e9420099552b4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/97d540da0aee796ba07e9420099552b4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ken</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-11-30T15:17:53+00:00">November 30, 2010 at 3:17 pm</time></a> </div>
<div class="comment-content">
<p>As a recent CS graduate, I think your marketing sense is exactly backwards from mine. &ldquo;Information retrieval and filtering&rdquo; sounds like the world&rsquo;s most boring course. Who&rsquo;d want to sit through that?</p>
<p>&ldquo;Unstructured&rdquo; or &ldquo;semi-structured data&rdquo; sounds somewhat interesting: it&rsquo;s something no other CS course at my university has even tried to address.</p>
<p>I would never worry about not understanding the title. The most fun and interesting (and even, dare I say it, useful) courses were the ones whose titles I didn&rsquo;t understand. In some cases it had words I&rsquo;d never even heard before!</p>
</div>
</li>
<li id="comment-54373" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e91bcb5b5ee1cf998fdf27dace1991c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e91bcb5b5ee1cf998fdf27dace1991c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">P. G. Palmer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-05-01T11:05:05+00:00">May 1, 2011 at 11:05 am</time></a> </div>
<div class="comment-content">
<p>IMO JSON has not at all replaced SOAP-XML in web services. Not all platforms support JSON out of the box, and it does not provide service contracts. SOAP is not meant for human readability but for intra-software readability, and it works well for that and is in widespread use. RPC technology has a complex history, its own dirty politics, and a simplistic essay like this does not do justice to the decision to choose JSON over SOAP. SOAP is a protocol, provides a *standardized* way of allowing the endpoint to return error messages to the calling application, and is in widespread use for good reasons, which apparently you do not yet understand.</p>
</div>
</li>
</ol>
