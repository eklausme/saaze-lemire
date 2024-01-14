---
date: "2006-04-26 12:00:00"
title: "FIFO Data Structure in Python"
index: false
---

[3 thoughts on &ldquo;FIFO Data Structure in Python&rdquo;](/lemire/blog/2006/04-26-fifo-data-structure-in-python)

<ol class="comment-list">
<li id="comment-4159" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-30T19:49:48+00:00">April 30, 2006 at 7:49 pm</time></a> </div>
<div class="comment-content">
<p>Because the expected popping time of your solution is linear with respect to the size of the list. Specifically, doing &ldquo;del self.items[0]&rdquo; can be tremendously expensive since Python needs to copy the entire array to a new location in memory. Doing so thousands of times is highly inefficient.</p>
</div>
</li>
<li id="comment-4155" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/853722ea8f289dc242ced3e623bbb63f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/853722ea8f289dc242ced3e623bbb63f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.oshineye.com" class="url" rel="ugc external nofollow">ade</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-04-30T17:16:55+00:00">April 30, 2006 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>Why not try something simpler like this:</p>
<p>class Fifo:<br/>
def __init__(self):<br/>
self.items = []</p>
<p> def append(self, item):<br/>
self.items.append(item)</p>
<p> def pop(self):<br/>
item = self.items[0]<br/>
del self.items[0]<br/>
return item</p>
<p> def __len__(self):<br/>
return len(self.items)</p>
<p> def tolist(self):<br/>
#defensive copy<br/>
return self.items[:]</p>
<p>import unittest<br/>
class FifoTest(unittest.TestCase):<br/>
def testItemsArePoppedInSameOrderTheyWereRemoved(self):<br/>
fifo = Fifo()<br/>
fifo.append(&lsquo;a&rsquo;)<br/>
fifo.append(&lsquo;b&rsquo;)<br/>
fifo.append(&lsquo;c&rsquo;)<br/>
self.assertEquals(&lsquo;a&rsquo;, fifo.pop())<br/>
self.assertEquals(&lsquo;b&rsquo;, fifo.pop())<br/>
self.assertEquals(&lsquo;c&rsquo;, fifo.pop())</p>
<p> def testFifoLengthChangesAsItemsAreRemoved(self):<br/>
fifo = Fifo()<br/>
fifo.append(&lsquo;a&rsquo;)<br/>
fifo.append(&lsquo;b&rsquo;)<br/>
fifo.append(&lsquo;c&rsquo;)<br/>
self.assertEquals(3, len(fifo))<br/>
fifo.pop()<br/>
self.assertEquals(2, len(fifo))<br/>
fifo.pop()<br/>
self.assertEquals(1, len(fifo))<br/>
fifo.pop()<br/>
self.assertEquals(0, len(fifo))</p>
<p> def testFifoCanBeConvertedToList(self):<br/>
fifo = Fifo()<br/>
fifo.append(&lsquo;a&rsquo;)<br/>
fifo.append(&lsquo;b&rsquo;)<br/>
fifo.append(&lsquo;c&rsquo;)<br/>
self.assertEquals([&lsquo;a&rsquo;,&rsquo;b&rsquo;,&rsquo;c&rsquo;], fifo.tolist())<br/>
if __name__ == &lsquo;__main__&rsquo;:<br/>
suite = unittest.TestSuite()<br/>
suite.addTest(unittest.makeSuite(FifoTest))<br/>
unittest.TextTestRunner(verbosity=3).run(suite)</p>
</div>
</li>
<li id="comment-4174" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/853722ea8f289dc242ced3e623bbb63f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/853722ea8f289dc242ced3e623bbb63f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.oshineye.com" class="url" rel="ugc external nofollow">ade</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-01T05:27:25+00:00">May 1, 2006 at 5:27 am</time></a> </div>
<div class="comment-content">
<p>Thanks I hadn&rsquo;t realised that. Come to think of it the list class has a pop method I could have used.</p>
<p>Anyway if you&rsquo;re interested in a highly-performant Fifo class then take a look at the bottom of this Python Cookbook entry: <a href="http://aspn.activestate.com/ASPN/Cookbook/Python/Recipe/68436" rel="nofollow ugc">http://aspn.activestate.com/ASPN/Cookbook/Python/Recipe/68436</a></p>
</div>
</li>
</ol>
