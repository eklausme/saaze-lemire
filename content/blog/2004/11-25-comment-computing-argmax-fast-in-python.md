---
date: "2004-11-25 12:00:00"
title: "Computing argmax fast in Python"
index: false
---

[12 thoughts on &ldquo;Computing argmax fast in Python&rdquo;](/lemire/blog/2004/11-25-computing-argmax-fast-in-python)

<ol class="comment-list">
<li id="comment-1219" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-13T09:16:10+00:00">February 13, 2005 at 9:16 am</time></a> </div>
<div class="comment-content">
<p>You can try this:</p>
<p>def positionMax(sequence, excludedIndexesSet=None):<br/>
if not badindexes:<br/>
return max( izip(sequence, xrange(len(sequence)) ) )[1]<br/>
else:<br/>
badindexes = set(badindexes)<br/>
return max( (e,i) for i,e in enumerate(sequence) if i not in badindexes )[1]</p>
</div>
</li>
<li id="comment-49710" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d34b1d6d4def4b515dec693de59f251?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d34b1d6d4def4b515dec693de59f251?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">SwiftCoder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-29T09:20:38+00:00">January 29, 2008 at 9:20 am</time></a> </div>
<div class="comment-content">
<p>You should also try a functional idiom &#8211; typically better and faster:</p>
<p>array = [1.0, 2.0, 3.0, 1.0]</p>
<p>m = reduce(max, array)</p>
</div>
</li>
<li id="comment-49905" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d74f120e9bdd221b18cf6493f19dc4e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d74f120e9bdd221b18cf6493f19dc4e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Protector one</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-07T15:31:05+00:00">May 7, 2008 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m sorry SwiftCoder, but I believe that is a max. It is equivalent to:</p>
<p> m = max(array)</p>
<p>My (arg)max:</p>
<p> lambda array: max([array[i],i] for i in range(len(array)))[1]</p>
<p>Cheers!</p>
</div>
</li>
<li id="comment-50350" class="pingback odd alt thread-odd thread-alt depth-1">
<div class="comment-body">
Pingback: <a href="https://lemire.me/blog/2008/12/17/fast-argmax-in-python/" class="url" rel="ugc">Fast argmax in Python</a> </div>
</li>
<li id="comment-50349" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d26e6e12e978bfc6c9957b9a84d22be5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d26e6e12e978bfc6c9957b9a84d22be5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">kralin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-17T06:27:24+00:00">December 17, 2008 at 6:27 am</time></a> </div>
<div class="comment-content">
<p>array.index(max(array))</p>
<p>is it too simple?</p>
</div>
</li>
<li id="comment-50354" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abb6edfcac04bfa1b4a0b160b5879efa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abb6edfcac04bfa1b4a0b160b5879efa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-18T08:48:34+00:00">December 18, 2008 at 8:48 am</time></a> </div>
<div class="comment-content">
<p>import numpy</p>
<p>array = numpy.array ( [1,2,4,3,5,1 ] )</p>
<p>numpy.argmax( array )</p>
<p># should return 4</p>
</div>
</li>
<li id="comment-54174" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mapio</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-01-29T11:41:33+00:00">January 29, 2011 at 11:41 am</time></a> </div>
<div class="comment-content">
<p>In case of duplicate values you solution returns the last position, while the array.index(max(array)) solution returns the first which, beside the simplicity of the solution, seems to be the more natural answer.</p>
</div>
</li>
<li id="comment-54357" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-04-27T10:59:01+00:00">April 27, 2011 at 10:59 am</time></a> </div>
<div class="comment-content">
<p>How about</p>
<p>max(xrange(len(array)), key=array.__getitem__)</p>
</div>
<ol class="children">
<li id="comment-579052" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e36c43b7ffd018e0703cacc100b4b49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e36c43b7ffd018e0703cacc100b4b49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://strams.info" class="url" rel="ugc external nofollow">Dang minh tan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-09T06:05:15+00:00">March 9, 2021 at 6:05 am</time></a> </div>
<div class="comment-content">
<p>great, much faster!</p>
</div>
</li>
</ol>
</li>
<li id="comment-55219" class="pingback odd alt thread-even depth-1">
<div class="comment-body">
Pingback: argmax in Python | Tastalian&#039;s Blog </div>
</li>
<li id="comment-66209" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0198533a52179fc7827352287a943d41?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0198533a52179fc7827352287a943d41?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kasia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-18T14:29:13+00:00">January 18, 2013 at 2:29 pm</time></a> </div>
<div class="comment-content">
<p>numpy.ndarray object has no attributes index and maxarg. What should I do?</p>
</div>
</li>
<li id="comment-406623" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcbc0bdfa1e869b1e6fa75cb9d3feb8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcbc0bdfa1e869b1e6fa75cb9d3feb8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-14T17:18:34+00:00">May 14, 2019 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>argmax=max([(i[0], array[i[0]]) \<br/>
for i in enumerate(array)], key=lambda t:t[1])[0]</p>
</div>
</li>
</ol>
