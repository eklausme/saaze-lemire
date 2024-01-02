---
date: "2006-04-26 12:00:00"
title: "FIFO Data Structure in Python"
---



__This post is obselete, see this [more recent discussion](http://www.daniel-lemire.com/blog/archives/2006/08/21/efficient-fifoqueue-data-structure-in-python/).__

For some odd reason, Python doesn&rsquo;t come with a good FIFO data structure (as of 2.4). Here&rsquo;s one.

<code><br/>
class Fifo:<br/>
def __init__(self):<br/>
self.data = [[], []]<br/>
def append(self, value):<br/>
self.data[1].append(value)<br/>
def pop(self):<br/>
if not self.data[0]:<br/>
self.data.reverse()<br/>
self.data[0].reverse()<br/>
return self.data[0].pop()<br/>
def __len__(self):<br/>
return len(self.data[0])+len(self.data[1])<br/>
def tolist(self):<br/>
temp= self.data[0][:]<br/>
temp.reverse()<br/>
return temp+self.data[1]<br/>
</code>

