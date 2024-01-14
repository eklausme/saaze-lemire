---
date: "2006-08-21 12:00:00"
title: "Efficient FIFO/Queue data structure in Python"
---



For the types of algorithms I implement these days, I need a fast FIFO-like data structure. Actually, I need a [double-ended queue](https://en.wikipedia.org/wiki/Deque). Python has a list type, but it is somewhat a misnomer because its performance characterics are those of a vector. Recently, I found mxQueue which is a separate (non-free) download. Unfortunately, mxQueue has a non-Pythonic interface and, to make matters worse, I found out that Python comes by default with a really nice Queue of its own, called deque: you can find it in the new collection module.
Thus, as a good scientist, I decided to test these 3 implementations. As it turns out, Queue.deque is a perfectly good FIFO data structure:

Python class             |time (s)                 |
-------------------------|-------------------------|
list (Python&rsquo;s default) |2.26                     |
Queue.deque              |0.42                     |
mx.Queue.mxQueue         |0.42                     |


Through other tests, I was able to verify that both Queue.deque and mx.Queue.mxQueue have constant time deletion from both the head and the tail, unlike Python&rsquo;s list.

<input type="button" class="button" value="show the code" onclick="javascript:document.getElementById('codezzz1').style.display=''" />

<code id="codezzz1" style="display:None"><br/>
from collections import deque<br/>
from time import time<br/>
from mx.Queue import *<br/>
def deleteFromHead(t):<br/>
for i in xrange(1000): t.append(1)<br/>
for i in xrange(1000000):<br/>
t.append(10)<br/>
del t[0]<br/>
def deleteFromHead2(t):<br/>
for i in xrange(1000): t.push(1)<br/>
for i in xrange(1000000):<br/>
t.push(10)<br/>
t.pop()<br/>
before=time()<br/>
t=Queue()<br/>
deleteFromHead2(t)<br/>
after=time()<br/>
print after-before<br/>
before=time()<br/>
t=deque()<br/>
deleteFromHead(t)<br/>
after=time()<br/>
print after-before<br/>
before=time()<br/>
t=[]<br/>
deleteFromHead(t)<br/>
after=time()<br/>
print after-before<br/>
<input type="button" class="button" value="hide the code" onclick="javascript:document.getElementById('codezzz1').style.display='None'" /><br/>
</code>

