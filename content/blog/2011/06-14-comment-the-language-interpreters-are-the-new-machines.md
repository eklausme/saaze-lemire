---
date: "2011-06-14 12:00:00"
title: "The language interpreters are the new machines"
index: false
---

[32 thoughts on &ldquo;The language interpreters are the new machines&rdquo;](/lemire/blog/2011/06-14-the-language-interpreters-are-the-new-machines)

<ol class="comment-list">
<li id="comment-54487" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T15:48:00+00:00">June 14, 2011 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>@Jib</p>
<p>I suspect your experience is common. I also get into this sort of trouble in C++: the optimizer beats my hard work routinely.</p>
<p>My point is that this is even more true in Python or JavaScript.</p>
</div>
</li>
<li id="comment-54491" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T17:39:09+00:00">June 14, 2011 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>@Dan I have updated my blog post with a link to a C++ test which shows that a single pass through the data is, as expected, about twice as fast.</p>
</div>
</li>
<li id="comment-54495" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T19:13:06+00:00">June 14, 2011 at 7:13 pm</time></a> </div>
<div class="comment-content">
<p>@mr foo it</p>
<p>It is much better if you try to reproduce my results which you can do in seconds if you have a Mac or a Linux box. If not, you just need to install Python which takes minutes.</p>
</div>
</li>
<li id="comment-54496" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T19:14:00+00:00">June 14, 2011 at 7:14 pm</time></a> </div>
<div class="comment-content">
<p>@Will I need to learn Go.</p>
</div>
</li>
<li id="comment-54484" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/585a63f774e9883f613e2db7886e7762?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/585a63f774e9883f613e2db7886e7762?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jib</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T15:15:21+00:00">June 14, 2011 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>I actually ran into this over 15 years ago with C++ compilers. Optimizer&rsquo;s were relatively new and improving rapidly from version to version. My really cool, highly efficient roll you own algorithms often &lsquo;broke&rsquo; the optimizer in that the optimizer could not figure out what I were trying to do and could not help me. Over one 2 year process I found my code going from very fast compared to &lsquo;dumb&rsquo; implementations to slower than &lsquo;dumb&rsquo; implementations. </p>
<p>The key was that the optimizers were taking advantage of the full instruction set of what was then state of the art processors where as my algorithms assumed a much simpler architecture.</p>
<p>Damn you Knuth!</p>
</div>
</li>
<li id="comment-54500" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T20:34:58+00:00">June 14, 2011 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>@Rafael</p>
<p>Thanks but your function, according to my tests, is several times slower than array.index(max(array)). In fact, it is slower than any of the alternative, on my machine. Can you publish your numbers and your code?</p>
</div>
</li>
<li id="comment-54501" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T20:39:27+00:00">June 14, 2011 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>@Hoffman</p>
<p>I did not know about the array package: thanks! Unfortunately, I don&rsquo;t get any speed gain by using a Python array instead of a list.</p>
</div>
</li>
<li id="comment-54485" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6814a20041615f11dd577395b06092d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6814a20041615f11dd577395b06092d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://homepages.inf.ed.ac.uk/imurray2/" class="url" rel="ugc external nofollow">Iain</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T15:46:30+00:00">June 14, 2011 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>An aside not relevant to your main point: when using numpy, arrays have an argmax() method, which is much faster than any of these solutions. Actually I think numpy reinforces your point: I&rsquo;m often doing multiple passes over arrays when not strictly necessary because it vectorizes better in numpy or Matlab.</p>
</div>
</li>
<li id="comment-54488" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T16:07:44+00:00">June 14, 2011 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>@Jib, if a compiler can use SSE operations, then it can beat you. However, if you use SSE operations explicitly, you are likely to beat the compiler.</p>
<p>@Daniel, this is a rather common issue nowdays. Loops are often prohibitive in script languages, because a built-in function may be orders of magnitude faster.</p>
</div>
</li>
<li id="comment-54489" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T16:11:13+00:00">June 14, 2011 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>PS: However, this is not a new issue. Consider, e.g., a SQL with procedural extensions.</p>
</div>
</li>
<li id="comment-54490" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/097e0e435050244e030c01837d4ec6c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/097e0e435050244e030c01837d4ec6c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dublindan.posterous.com" class="url" rel="ugc external nofollow">Dan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T16:21:03+00:00">June 14, 2011 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>Two reasons why this could be the case:</p>
<p>If array.index() and max() are builtin functions, rather than interpreted, in a non-JIT language (like the Python 3 interpreter), then they will likely run much faster than the interpreted equivalent, even though the &ldquo;algorithm&rdquo; used for the others is more efficient. Presumably, this gap would close as the language interpreter gets faster or JITed.</p>
<p>Second is that even in lower level languages like C, this &ldquo;may&rdquo; be the case. If the array.index() and max() functions run in a way that is very predictable for CPU branch prediction and makes efficient use of the processor cache (cache is properly prefetched) and the alternative has lots of sporadic branches and/or accesses data in unpredictable ways (so that there is little or no prefetching), as I suspect is the case with list comprehension and traversal (compared to simply scanning an array whose elements are beside each other; lists are probably linked lists &#8211; a notoriously cache-unfriendly data structure), then the code which technically does more work would still be faster.</p>
<p>tl;dr: modern computers and languages are complex!</p>
</div>
</li>
<li id="comment-54492" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/51b23778e14052fc013179a6c07fcdab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/51b23778e14052fc013179a6c07fcdab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mr foo it</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T18:17:59+00:00">June 14, 2011 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>You only ran each pass once!? or even if you did it multiple times you only posted averages!?<br/>
In order for the data to be useful we also need you to post the individual samples so we can run it under statistical tests.</p>
</div>
</li>
<li id="comment-54493" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Will Fitzgerald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T18:31:57+00:00">June 14, 2011 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>func ArgMax(arr []int) (index int, max int) {<br/>
for i,n := range arr {<br/>
if i==0 || n &gt; max {<br/>
index = i<br/>
max = n<br/>
}<br/>
}<br/>
return<br/>
}</p>
<p>func main() {<br/>
array := []int{1,2,3,4,5,6,7,6,5,4,11113,2,1}<br/>
i,max := ArgMax(array)<br/>
println(i)<br/>
println(max)<br/>
}</p>
</div>
</li>
<li id="comment-54494" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/601818a9dc66a43de700bc866035be1a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/601818a9dc66a43de700bc866035be1a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cnicholson.net" class="url" rel="ugc external nofollow">Charles Nicholson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T19:09:33+00:00">June 14, 2011 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>Accumulating the maxarg as the array is populated and transformed gives you a O(1) query later. Of course it doesn&rsquo;t work if you remove items, but if maxarg is your bottleneck, that might be a valuable constraint to impose.</p>
<p>Alternately, if maxarg is truly your bottleneck and you do remove elements from the array, then consider spending more memory and maintaining a heap of indices to array elements, sorted by their array element value, for constant-time maxarg query at the cost of O(logn) add/remove.</p>
<p>Holistic algorithm enhancement like that can often trump all other solutions- the ideal number of times to scan the array is 0, right? 🙂</p>
<p>Put another way, if you&rsquo;re optimizing the wrong aspect of the problem, who cares which approach is faster?</p>
</div>
</li>
<li id="comment-54497" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d802490592b6510bce981a133250c021?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d802490592b6510bce981a133250c021?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Hoffman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T19:38:35+00:00">June 14, 2011 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>Python has some easy-to-use objects, but the overhead of dealing with them&#8211;dictionary accesses, function dispatch overhead, object creation&#8211;will often overwhelm any potential algorithmic advantages. To speed things up, usually you want to avoid these as much as possible. That&rsquo;s why the array.index(max(array)) solution works so well. I don&rsquo;t call my lists &ldquo;array,&rdquo; however because there is also an array type in Python (in the array module). If you make &ldquo;array&rdquo; an array.array instead of a list, this is even faster on my benchmark.</p>
<p>In the real world, NumPy is often the best way to eliminate this problem. If you convert array to a NumPy array and use its argmax() function, it is quite fast indeed.</p>
</div>
</li>
<li id="comment-54498" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://rafael.kontesti.me" class="url" rel="ugc external nofollow">Rafael</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T20:25:08+00:00">June 14, 2011 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>I think you left out the most obvious definition of it:</p>
<p>def maxarg(arr):<br/>
counter = 0<br/>
arg = 0<br/>
m = arr[0]<br/>
for x in arr:<br/>
if x &gt; m:<br/>
m = x<br/>
arg = counter<br/>
counter += 1<br/>
return arg</p>
<p>which run about as fast as array.index(max(array)) (on python 2.6, at least). Sometimes it&rsquo;s a bit slower, sometimes a bit faster. Which is indeed surprising, although understandable. It&rsquo;s the language overhead. Your solutions have a huge amount of overhead (some of they may even be running at O(2n)), that&rsquo;s why they are that much slower.</p>
<p>BTW, that code that runs on javascript, does it run in the client? If so, it&rsquo;s pretty obvious why it isn&rsquo;t the overhead. Otherwise, it seems to me like a silly choice and it really impress me if the javascript is not the bottleneck if they do anything other than read and write files (very low on processing) with it.</p>
</div>
</li>
<li id="comment-54499" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d802490592b6510bce981a133250c021?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d802490592b6510bce981a133250c021?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Hoffman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-14T20:33:23+00:00">June 14, 2011 at 8:33 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t get that result at all, Rafael. On Python 2.6.5, using the script at <a href="https://gist.github.com/1026313" rel="nofollow ugc">https://gist.github.com/1026313</a>:</p>
<p>The index/max version takes 1.62 s, but the maxarg() version takes 5.09 s.</p>
</div>
</li>
<li id="comment-54502" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Will Fitzgerald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T01:08:28+00:00">June 15, 2011 at 1:08 am</time></a> </div>
<div class="comment-content">
<p>Daniel, here&rsquo;s a better formatted sketch of ArgMax in Go &#8212; both a &lsquo;generic&rsquo; version and one specific for ints, that also returns the max value</p>
<p><a href="https://gist.github.com/8856a9ce3b18c7550db7" rel="nofollow ugc">https://gist.github.com/8856a9ce3b18c7550db7</a></p>
</div>
</li>
<li id="comment-54503" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/097e0e435050244e030c01837d4ec6c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/097e0e435050244e030c01837d4ec6c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://dublindan.posterous.com" class="url" rel="ugc external nofollow">Dan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T02:11:05+00:00">June 15, 2011 at 2:11 am</time></a> </div>
<div class="comment-content">
<p>@Daniel: Of course that code will be much faster &#8211; its not doing the same thing as what I suspect the Python version (even if Python were generating equally optimal code) is doing.</p>
<p>Your code is running once through an array (whose elements are beside each other), which can be easily prefetched. Your index(max()) version runs through the array twice, which means that the memory (since N elements won&rsquo;t all fit into the cache at once) must be loaded at least a second time. Of course the single traversal will be about twice as fast.</p>
<p>The Python version however is performing a list comprehension, which presumably (though I could be wrong) is doing more work than simply traversing the list (ie building a second list as it traverses the first) &#8211; much more work than your C++ implementation!</p>
<p>The real reason theres such a speed difference in Python is builtins vs not builtins though.</p>
</div>
</li>
<li id="comment-54504" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/212d653f4466d5eda233392dc1df54f5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/212d653f4466d5eda233392dc1df54f5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://unya.wordpress.com" class="url" rel="ugc external nofollow">PaweÅ‚ Lasek</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T02:50:31+00:00">June 15, 2011 at 2:50 am</time></a> </div>
<div class="comment-content">
<p>I think that the new, higher level languages still require good knowledge of how the machine works at lower level. The difference is that you should always know your language and runtime as well &#8211; something cheerfully omitted in CS courses and language-learning books.</p>
<p>Because of that I&rsquo;ve been suggesting to my professors to make assembly part of required courses. Not because we will use it to program, but because it opens a way to understand just what happens inside the runtime, instead of treating it like magic in hands of a new apprentice/novice.</p>
</div>
</li>
<li id="comment-54509" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T13:48:43+00:00">June 15, 2011 at 1:48 pm</time></a> </div>
<div class="comment-content">
<p>@Rafael</p>
<p>Thanks for posting your code and timings. I now realize I was wrong to compare a random shuffle (C++) with actual random bits (Python). Therefore, I have updated my blog post with a random shuffle like yours.</p>
<p>As you can see from my updated numbers, your function is still slower. However, if I revert back to Python 2.6, the gap is not so large. But it still faster (on average) to do array.index(max(array).</p>
</div>
</li>
<li id="comment-54510" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T13:51:19+00:00">June 15, 2011 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>I will come back to this topic. Yes, I think that comparing hash tables with linear scan is interesting.</p>
</div>
</li>
<li id="comment-54513" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43314a37c30454481331eb4e4c604657?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fpgacpu.ca/" class="url" rel="ugc external nofollow">Eric LaForest</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T16:50:20+00:00">June 15, 2011 at 4:50 pm</time></a> </div>
<div class="comment-content">
<p>@Dan: the cost of traversing an array depends on where it is in the memory hierarchy, which is not accounted for in typical algorithmic analysis. </p>
<p>For example, you could tile the search for max and its index by iterating over a segment of the array that fits in cache, finding the max and its index of that segment, replacing the old values if necessary.</p>
<p>This approach does go over the array twice, but only in cache. The array is gone over only once in main memory.</p>
<p>It would be very interesting to figure out at which point in the problem size does this optimization ceases to outweigh the O() behaviour of a theoretically better algorithm.</p>
</div>
</li>
<li id="comment-54506" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://rafael.kontesti.me" class="url" rel="ugc external nofollow">Rafael</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T13:01:30+00:00">June 15, 2011 at 1:01 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel here at work my times were a little different than at home. However, the difference was never as big as yours. Perhaps doing a shuffle and creating a string like you did makes the difference, I don&rsquo;t know. That wouldn&rsquo;t make much sense.</p>
<p>$ python &#8211;version<br/>
Python 2.6.5<br/>
$ python test.py<br/>
1.22238516808<br/>
3877433<br/>
1.50368499756<br/>
3877433<br/>
$ python test.py<br/>
1.1917090416<br/>
3333202<br/>
1.50043797493<br/>
3333202<br/>
$ python test.py<br/>
1.34272694588<br/>
5674904<br/>
1.49921607971<br/>
5674904<br/>
$ python test.py<br/>
1.08860707283<br/>
1109969<br/>
1.53280496597<br/>
1109969</p>
<p>Code is at: <a href="http://rafael.kontesti.me/test.py" rel="nofollow ugc">http://rafael.kontesti.me/test.py</a></p>
</div>
</li>
<li id="comment-54507" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://rafael.kontesti.me" class="url" rel="ugc external nofollow">Rafael</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T13:04:08+00:00">June 15, 2011 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>Actually, I forgot I had set .py extension to be executed in that directory. Please refer to it at <a href="http://rafael.kontesti.me/test.txt" rel="nofollow ugc">http://rafael.kontesti.me/test.txt</a></p>
</div>
</li>
<li id="comment-54508" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T13:17:12+00:00">June 15, 2011 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>@All, who started posting the code and compare times,</p>
<p>In my opinion, you miss the main point. In this or another case, your mileage may vary. However, a much simpler algorithm that seems to be inefficient may easily beat a more sophisticated once due to hardware and software specifics.</p>
<p>Examples are numerous! To be more conclusive, IMHO, Daniel should have posted an example of a hash vs unfolded search loop. In C++!!! It is very instructive to see that loops, especially unfolded ones, do beat hashes on small data sets. Same thing for binary searching.</p>
<p>High level script languages are often even worse with this respect. However, the general intuition is that built-in function often work faster than loops. Therefore, for mission-critical program pieces, one should measure performance to select the best variant.</p>
</div>
</li>
<li id="comment-54511" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T13:55:14+00:00">June 15, 2011 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel,<br/>
It is not just hash tables. A lot of fancy tree structures (R-trees, KD-trees, BTKs, even regular binary trees), perform best when elements close to leaves are stored in buckets and are sought sequentially.</p>
</div>
</li>
<li id="comment-54512" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b85e6b127c527c8dcebe18d1c985e48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Will Fitzgerald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-15T14:27:34+00:00">June 15, 2011 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>So, running Rafael&rsquo;s benchmark, but setting the last value to the max:</p>
<p>arr = range(10000000)<br/>
random.shuffle(arr)<br/>
arr[10000000-1]=10000000+1 </p>
<p>argmax consistently beats out index(max)</p>
<p>I also see it consistently winning on his benchmark. BUT NOT IF THE ARRAY IS UNSHUFFLED.</p>
<p>This implies it&rsquo;s not (just) the builtins, but other, perhaps CPU related, things going on. </p>
<p>One of the disadvantages here is *not* being able to peek at the assembly.</p>
</div>
</li>
<li id="comment-54515" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4cf9c49e0a2aefc479380fee85e90bf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4cf9c49e0a2aefc479380fee85e90bf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/matteodellamico" class="url" rel="ugc external nofollow">Matteo Dell'Amico</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-06-22T12:03:06+00:00">June 22, 2011 at 12:03 pm</time></a> </div>
<div class="comment-content">
<p>With pypy, which packs a JIT, your version is way faster than array.index(max(array)) (on my machine, by a factor 4).</p>
<p>It&rsquo;s quite well known by Python programmers that CPython has much faster &ldquo;implicit&rdquo; loops (e.g., max(l), l.index()) than &ldquo;explicit&rdquo; ones (for x in l), because implicit ones manage to avoid many of the interpreter overhead. All these things change, though, when you have a JIT.</p>
</div>
</li>
<li id="comment-54555" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47fe50daefc91f627ee92e297d5b0269?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47fe50daefc91f627ee92e297d5b0269?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://shapovalov.ro" class="url" rel="ugc external nofollow">Roman Shapovalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-07-08T02:28:00+00:00">July 8, 2011 at 2:28 am</time></a> </div>
<div class="comment-content">
<p>Nice point.<br/>
It&rsquo;d be interesting to compare what is faster &#8212; &ldquo;native&rdquo; C or C++ STL implementation like this:</p>
<p>std::max_element(vec.begin(), vec.end()) &#8211; vec.begin();</p>
</div>
</li>
<li id="comment-54556" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47fe50daefc91f627ee92e297d5b0269?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47fe50daefc91f627ee92e297d5b0269?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://shapovalov.ro" class="url" rel="ugc external nofollow">Roman Shapovalov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-07-08T02:30:52+00:00">July 8, 2011 at 2:30 am</time></a> </div>
<div class="comment-content">
<p>Also, how does it scale with changing array size?<br/>
PS. Your CAPTCHA is really annoying. 🙂</p>
</div>
</li>
<li id="comment-54848" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb1ed2776694a106875760157eb30cf7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb1ed2776694a106875760157eb30cf7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Randy A MacDonald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-08T22:31:30+00:00">January 8, 2012 at 10:31 pm</time></a> </div>
<div class="comment-content">
<p>This APL programmer suggests that using a higher level language brings one _closer_ to the idealized machine.</p>
</div>
</li>
</ol>
