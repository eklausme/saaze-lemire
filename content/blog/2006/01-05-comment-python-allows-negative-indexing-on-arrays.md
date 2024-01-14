---
date: "2006-01-05 12:00:00"
title: "Python allows negative indexing on arrays!"
index: false
---

[6 thoughts on &ldquo;Python allows negative indexing on arrays!&rdquo;](/lemire/blog/2006/01-05-python-allows-negative-indexing-on-arrays)

<ol class="comment-list">
<li id="comment-3564" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T00:07:39+00:00">January 6, 2006 at 12:07 am</time></a> </div>
<div class="comment-content">
<p>(Clever anonymous poster above was in BC when he posted this message. At least from the IP to location tool I used.)</p>
</div>
</li>
<li id="comment-3566" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8909b685c00f95f7fbe91b7437c507e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8909b685c00f95f7fbe91b7437c507e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">didier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T00:18:37+00:00">January 6, 2006 at 12:18 am</time></a> </div>
<div class="comment-content">
<p>Perl uses negative indexing too.</p>
</div>
</li>
<li id="comment-3568" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4ca8c952684b57b119b256895ea4c9b9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4ca8c952684b57b119b256895ea4c9b9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dblp.uni-trier.de/pers/hd/d/Donaldson:Toby.html" class="url" rel="ugc external nofollow">Toby</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T03:28:27+00:00">January 6, 2006 at 3:28 am</time></a> </div>
<div class="comment-content">
<p>An empty list raises an index exception if you try to access any location. And, yes, if there is only 1 element, then lst[0] and lst[-1] refer to the same value.</p>
<p>Basically, Python&rsquo;s sequence indexing gives each element two indices: a negative one and a non-negative one, i.e. i and i &#8211; n (where n is the length of the list).</p>
<p>Most of the time I (and I think most other Python programmers) use the regular C-like index notation, and every once in a while use the negative index notation, mostly for accessing the last element or two of a sequence And even then, it&rsquo;s usually a literal index, i.e. lst[-1] or lst[[-2], and almost never with variables, e.g.:</p>
<p>&gt;&gt;&gt; lst = [6, 5, 3, 2]<br/>
&gt;&gt;&gt; for i in range(len(lst)): # print lst in reverse<br/>
&#8230; print lst[-i &#8211; 1]<br/>
&#8230;<br/>
2<br/>
3<br/>
5<br/>
6</p>
</div>
</li>
<li id="comment-3563" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-05T23:47:36+00:00">January 5, 2006 at 11:47 pm</time></a> </div>
<div class="comment-content">
<p>Negative indexing makes it easy to access the end of a list, e.g. you can write lst[-1] instead of lst[len(lst) &#8211; 1].</p>
<p>It can also be used with slicing, e.g. filename[-3:] gives you the extension of the file name.</p>
</div>
</li>
<li id="comment-3567" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0090eedbf9ec8f1082552d4dce52cc8a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0090eedbf9ec8f1082552d4dce52cc8a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.martinbreton.com" class="url" rel="ugc external nofollow">brem</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T00:44:59+00:00">January 6, 2006 at 12:44 am</time></a> </div>
<div class="comment-content">
<p>What happens when the array is empty?</p>
<p>and if there is only 1 element, does [0] and [-1] points to the same element?</p>
</div>
</li>
<li id="comment-3571" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0090eedbf9ec8f1082552d4dce52cc8a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0090eedbf9ec8f1082552d4dce52cc8a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.martinbreton.com" class="url" rel="ugc external nofollow">brem</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T13:12:50+00:00">January 6, 2006 at 1:12 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the precisions. 🙂</p>
</div>
</li>
</ol>
