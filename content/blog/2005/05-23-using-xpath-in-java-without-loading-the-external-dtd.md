---
date: "2005-05-23 12:00:00"
title: "Using XPath in Java without loading the external DTD"
---



Java is a complicated mess. I just wasted 3 hours figuring out how to use XPath expressions in Java 1.5 without loading the external DTD. Thanks to the absence of any worthy documentation, I had to guess, and guess again, until I came up with this.

>DocumentBuilderFactory dbfact = DocumentBuilderFactory.newInstance();<br/>
dbfact.setAttribute(&ldquo;http: // apache.org / xml / features / nonvalidating / load-external-dtd&rdquo;,false);<br/>
DocumentBuilder builder = dbfact.newDocumentBuilder();<br/>
Document indexname_input = builder.parse(someinputstream);<br/>
XPathFactory fact = XPathFactory.newInstance();<br/>
XPath xpath = fact.newXPath();<br/>
String title = xpath.evaluate(&ldquo;string(//frontmatter/titlepage/title)&rdquo;, indexname_input);



