---
date: "2006-05-10 12:00:00"
title: "Flattening lists in Python"
---



Can anyone do better than this ugly hack?

<code>def flatten(x):<br/>
flat = True<br/>
ans = []<br/>
for i in x:<br/>
if ( i.__class__ is list):<br/>
ans = flatten(i)<br/>
else:<br/>
ans.append(i)<br/>
return ans</code>

__Update__. I like this solution proposed by one of the commenters (sweavo):

<code>def flatten(l):<br/>
if isinstance(l,list):<br/>
return sum(map(flatten,l))<br/>
else:<br/>
return l</code>

Can anyone do better?

See also my posts [YouTube scalability](/lemire/blog/2007/07/16/youtube-scalability/), [Yield returns are not esoteric anymore](/lemire/blog/2007/05/29/yield-returns-are-not-esoteric-anymore/), [Efficient FIFO/Queue data structure in Python](http://www.daniel-lemire.com/blog/archives/2006/08/21/efficient-fifoqueue-data-structure-in-python/) and [Autocompletion in the Python console](/lemire/blog/2006/06/01/autocompletion-in-the-python-console/).

