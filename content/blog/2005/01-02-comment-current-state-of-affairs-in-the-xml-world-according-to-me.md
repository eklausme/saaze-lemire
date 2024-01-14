---
date: "2005-01-02 12:00:00"
title: "Current state of affairs in the XML world (according to me)"
index: false
---

[2 thoughts on &ldquo;Current state of affairs in the XML world (according to me)&rdquo;](/lemire/blog/2005/01-02-current-state-of-affairs-in-the-xml-world-according-to-me)

<ol class="comment-list">
<li id="comment-2302" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-04-10T08:31:56+00:00">April 10, 2005 at 8:31 am</time></a> </div>
<div class="comment-content">
<p>Difficult to tell what your problem is&#8230; you tried to post XML, but, of course, the &lt; and &gt; tags disappear.</p>
<p>I suspect you&rsquo;ve got a namespace issue: the xpath expression /html/head/title doesn&rsquo;t work if html, head and title are in a namespace.</p>
<p>You need to define a namepspace and modify your xpath expression accordingly. It is a pain, but that&rsquo;s the name of the game.</p>
</div>
</li>
<li id="comment-2301" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36f1328987966c9838009c60141a0470?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36f1328987966c9838009c60141a0470?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dick Adams</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-04-10T07:49:52+00:00">April 10, 2005 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>Glad to hear some honest commnets on the state of XML. I&rsquo;ve been having a devil of a time trying to use Java 5.0&rsquo;s new XPath functionality with XHTML. For example, javax.xml.xpath handles the following sample XML document just fine:</p>
<p> Virtual Library </p>
<p> Moved to <a href="http://vlib.org/" rel="nofollow">vlib.org</a>. </p>
<p>However, when you add the extra data to make it an XHTML document, like this (taken from <a href="http://www.w3.org/TR/xhtml11/conformance.html" rel="nofollow ugc">http://www.w3.org/TR/xhtml11/conformance.html</a>), you can no longer get even the title from the document:</p>
<p> Virtual Library </p>
<p> Moved to <a href="http://vlib.org/" rel="nofollow">vlib.org</a>. </p>
<p>It doesn&rsquo;t throw an exception, it just reurns null objects or empty strings. Here&rsquo;s the code I ran against both documents:</p>
<p> XPathFactory factory=XPathFactory.newInstance();<br/>
XPath xPath = factory.newXPath();<br/>
File xmlDocument = new File(&ldquo;c:\tmp\test.htm&rdquo;);<br/>
InputSource inputSource = new InputSource(new FileInputStream(xmlDocument));<br/>
XPathExpression expression = xPath.compile(&ldquo;/html/head/title&rdquo;);<br/>
String title = expression.evaluate(inputSource);<br/>
System.out.println(title);</p>
<p>Have you encountered this problem with XHTML?</p>
</div>
</li>
</ol>
