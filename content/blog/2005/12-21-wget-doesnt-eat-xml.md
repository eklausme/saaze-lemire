---
date: "2005-12-21 12:00:00"
title: "Wget doesn´t eat XML"
---



I wanted to retrieve a local copy of my online [XML course](http://www.teluq.ca/inf6450/). I instructed the technical staff to serve the XHTML files as application/xml. I believe this was to work around the limitations of Internet Explorer. In any case, I stumbled upon a wget bug! Wget won&rsquo;t process XHTML with the mime-type application/xml as an XHTML file, and hence, it won&rsquo;t follow the links inside it.

A deeper limitation is that wget doesn&rsquo;t know XML. This means that it will not follow stylesheets. Wget also doesn&rsquo;t know about javascript.

This meant I had to write my own scripts to recover the course. First, a bash script:

<code>wget -m -r -l inf -v -p http://www.teluq.uquebec.ca/inf6450/index-fr.htm<br/>
find -path "*.htm" | xargs ./extracturls.py | xargs wget -m -r -l inf -v -p<br/>
find -path "*.html" | xargs ./extracturls.py | xargs wget -m -r -l inf -v -p<br/>
find -path "*.xhtml" | xargs ./extracturls.py | xargs wget -m -r -l inf -v -p<br/>
find -path "*.xml" | xargs ./extracturls.py | xargs wget -m -r -l inf -v -p<br/>
find -path "*.xml" | xargs ./extracturls.py | xargs wget -m -r -l inf -v -p<br/>
</code>

You see that the last line is repeated twice. Don&rsquo;t do this type of scripting at home. Bad design!

Next I need a python script to extract the URLs I need (Perl or Ruby would also do):

<code>#!/bin/env python<br/>
import re,sys<br/>
for filename in sys.argv[1:]:<br/>
file=open(filename)<br/>
#print "from ", file<br/>
for line in file:<br/>
# better hope that we don't have repeated spaces!<br/>
for m in re.findall( "(?< =<a\\shref=["'])(?!http)(?!javascrip)[^"']*(?=["'])", line) +\\ re.findall( "(?<="<img\\ssrc=[&quot;'])(?!http)(?!javascrip)[^&quot;']*(?=[&quot;'])&quot;," line) +\\ re.findall("(?<="<quiz">).*(?=)",line)+\\<br/>
re.findall("(?< =openwindow\\(').*?(?=')",line)+\\
re.findall("(?< =stylesheet href=["']).*?(?=["'])",line):
print "http://"+re.search("www.*/",filename).group()+m
</code>

This is a pretty awful hack, but it works!

Here is a project for the tech savvy among you: extend wget so that it can parse XML!</code>

