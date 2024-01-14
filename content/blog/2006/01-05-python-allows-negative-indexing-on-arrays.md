---
date: "2006-01-05 12:00:00"
title: "Python allows negative indexing on arrays!"
---



Python supports indexes on arrays, and they work reasonably:

<code>>>> [0,1,2][0]<br/>
0<br/>
>>> [0,1,2][1]<br/>
1<br/>
>>> [0,1,2][2]<br/>
2</code>

Now, it gets strange when you use negative indexes&hellip;

<code>>>> [0,1,2][-1]<br/>
2<br/>
>>> [0,1,2][-2]<br/>
1</code>

As it turns out, the same is true if you create an array in Python Numeric or Scipy: you can actually use negative indexes. Behold:

<code>>>> from scipy import *<br/>
>>> zeros(2)[-1]<br/>
0<br/>
>>> array([0,1,2])[-1]<br/>
2<br/>
</code>

As it turns out, a[-x] is mapped to a[x%len(a)] or something like it. I cannot tell whether this is a bug or was meant to be that way. Any other language supports negative indexing? Why would you want this &ldquo;feature&rdquo;?

__Update:__ Thanks to all my readers, I&rsquo;m now aware that this is a [standard and well documented feature of Python](https://www.python.org/ftp/python/doc/quick-ref.1.3.html#LexEnt), special thanks to [Toby](http://dblp.uni-trier.de/pers/hd/d/Donaldson:Toby.html) and [Will](http://www.entish.org). Thanks to didier for pointing out that Perl supports them too.
