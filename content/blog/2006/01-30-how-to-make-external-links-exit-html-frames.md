---
date: "2006-01-30 12:00:00"
title: "How to make external links exit HTML frames?"
---



Generally, avoiding copy and paste is a great idea whether you are designing a web page or sending people on the moon.

A common problem with the badly constructed web sites relying on HTML frames is that external links are loaded within the frame which poses serious usability issues. A better solution is not to use frames, but sometimes, you are stuck with them. I had an argument recently with some people who insisted they had to add a &ldquo;target=&rsquo;_top'&rdquo; attribute to all external links, in all pages.

Using the DOM API and JavaScript, you can easily add the correct target attribute to all external links without any copy and paste if you follow the convention that external links begin with &ldquo;http&rdquo;. Simply add the following within the &ldquo;head&rdquo; element of your web page:

<code><br/>
&lt;script type="text/javascript"><br/>
function externalLinks() {<br/>
var anchors = document.getElementsByTagName("a");<br/>
for(var i=0; i&lt;anchors.length; i++) {<br/>
var anchor = anchors[i];<br/>
var myurl = anchor.getAttribute("href");<br/>
if( ! myurl) continue;<br/>
if(myurl.indexOf("http") == 0) {<br/>
anchor.setAttribute("target","_top");<br/>
}<br/>
}<br/>
}<br/>
window.onload = externalLinks;<br/>
&lt;/script><br/>
</code>

Of course, this relies on JavaScript being enabled, you might have cross-browser issues, and it adds an overhead to the processing of the page.

