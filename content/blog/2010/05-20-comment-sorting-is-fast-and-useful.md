---
date: "2010-05-20 12:00:00"
title: "Sorting is fast and useful"
index: false
---

[9 thoughts on &ldquo;Sorting is fast and useful&rdquo;](/lemire/blog/2010/05-20-sorting-is-fast-and-useful)

<ol class="comment-list">
<li id="comment-52530" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1e53c7194ba83237e11e53454b6bd8d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1e53c7194ba83237e11e53454b6bd8d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.cs.berkeley.edu/~dlwh/" class="url" rel="ugc external nofollow">David Hall</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-20T21:49:26+00:00">May 20, 2010 at 9:49 pm</time></a> </div>
<div class="comment-content">
<p>Unfortunately, I think you&rsquo;re mostly measuring the cost of boxing the raw int to Integers with regard to HashSets. If you use fastutil&rsquo;s IntOpenHashSet, which is completely unboxed. Array&rsquo;s performance (and HashSet and TreeSet&rsquo;s) is blown away, consistently by a factor of 4 or more. See the last column of the data here:<br/>
<a href="https://gist.github.com/408391" rel="nofollow ugc">http://gist.github.com/408391</a></p>
<p>Sorted Arrays are great, but O(1) lookup is hard to beat.</p>
</div>
</li>
<li id="comment-52531" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-20T22:33:30+00:00">May 20, 2010 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>@David Thanks for this great benchmark. I was well aware of the cost of boxing in Java, hence I was careful to document precisely how I ran my benchmark. </p>
<p>By your numbers, you beat the sorted array by a factor of 3.6 with over a million elements. That&rsquo;s considerable, but remember that the hash table doesn&rsquo;t give you access to the elements in sorted order, so it is not as useful in practice. And, of course, your gains are less with smaller sets.</p>
</div>
</li>
<li id="comment-52532" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-21T00:10:56+00:00">May 21, 2010 at 12:10 am</time></a> </div>
<div class="comment-content">
<p>Google&rsquo;s BigTable (on AppEngine) also maintains sorted indices which are used for queries. For example, say you wanted to do the following query:</p>
<p>company=&rdquo;x&rdquo; and date&gt;y and date&lt;z</p>
<p>Then BigTable would maintain an index sorted first by company and then by date. Finding rows that satisfy the query is then just requires a binary search in that index.</p>
<p>This has a number of limitation (i.e. you can only have inequality filters on one fields) but in practice it works really well.</p>
</div>
</li>
<li id="comment-52529" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5162a0619d4a15d7627662093bf42f1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5162a0619d4a15d7627662093bf42f1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://julianhyde.blogspot.com" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-20T21:34:40+00:00">May 20, 2010 at 9:34 pm</time></a> </div>
<div class="comment-content">
<p>And moreover, the sorted array has good locality of reference, so it will tend to perform better as the speed of cache memory relative to regular RAM increases.</p>
</div>
</li>
<li id="comment-52535" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-24T14:02:46+00:00">May 24, 2010 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>Thanks for this great comment. </p>
<p>Counterpoints:</p>
<p>(1) Not many non-trivial operations scale as well as sorting. If sorting is too expensive for you, what else are you going to do with the data?</p>
<p>(2) I&rsquo;m pretty sure that sorting is much less expensive than building a B-tree.</p>
<p>(3) I used Java because it makes it easy for people to reproduce my benchmark.</p>
</div>
</li>
<li id="comment-52537" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-24T18:44:16+00:00">May 24, 2010 at 6:44 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p><em>On the flip side, I tend to find binary search a shade inelegant. </em></p>
<p>In this case, you know that the distribution of keys is uniform, so you could definitively do better than a binary search.</p>
</div>
</li>
<li id="comment-52534" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-24T13:45:12+00:00">May 24, 2010 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>This time around, it seems we swapped hats.</p>
<p>Sorting is undoubtedly useful, but often not &ldquo;fast&rdquo;. We care about performance when the size of data is large, the number of repetitions is large &#8211; or both. Sorting over very large data is expensive. Even with small data, frequent sorts can be horribly expensive. Your curve does not add in the cost of sorts &#8211; which is all you can do without knowing more about the specific problem. </p>
<p>Guess I am really bothered by your use of a Java benchmark, a small measured difference, and final mention of a specific sort of database. These are all quite different animals.</p>
<p>I&rsquo;d be happier if you started with the mention of a problem space. If your premise is:</p>
<p>Data small enough to fit easily in memory.<br/>
Very large number of reads, very small number of writes.<br/>
Frequent(?) need for sort-order access.<br/>
Somewhat(?) general purpose usage.</p>
<p>In the specific case of a column-oriented database &#8211; by choosing the right compression method &#8211; you might effectively be able to do lookups without decompressing the data. Could be a big win. (Didn&rsquo;t you write something about this prior?)</p>
<p>Within the above frame, the comparison makes some sense. Outside the frame &#8230; not so much.</p>
</div>
</li>
<li id="comment-52536" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-05-24T16:01:19+00:00">May 24, 2010 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p>Guess I was unclear. </p>
<p>As you started with use of sorting, a Java benchmark and a small percentage difference, I was distracted by all the (many!) ways that combination could go wrong.</p>
<p>On re-reading, I suspect the final bit is a more a clue to what you had in mind. For some very specific sorts of problems, in particular when sorted access is at least an occasional need, using binary search over sorted data can be very reasonable. To this, I agree.</p>
<p>1) Over most of the problems I have worked on, anything like general purpose sorting is relatively rare. Lots of use of custom algorithms to suit access patterns (and presuming we distinguish ordered structures from general purpose sorting). Not a general result by any means. </p>
<p>2) Exclusive of update, I suspect you are right. Including update, I suspect you are more often wrong. (Lots of possible variants here that could push the result in either direction.)</p>
<p>3) Using Java as you meant is entirely suitable. I was distracted by the order of presentation. </p>
<p>A 10% difference over small data in simple Java code could come out very different. Reading lead to an explosion of questions. (Client or server JVM? JIT code differs across CPUs? Data fits or spills from innermost CPU cache? Time dominated by Java&rsquo;s wrapped array and integer access?) None of which is where you wanted to lead, I suspect.</p>
<p>On the flip side, I tend to find binary search a shade inelegant. Something a bit silly about comparing a billion numbers, and starting each with &ldquo;is this number 43?&rdquo;. If the problem allows use of some sort of address-based hash for at least part of the lookup, this can be a big win. </p>
<p>I&rsquo;ve touched this before.<br/>
<a href="http://bannister.us/weblog/2006/06/15/breakage-or-misapplication/" rel="nofollow ugc">http://bannister.us/weblog/2006/06/15/breakage-or-misapplication/</a><br/>
<a href="http://bannister.us/weblog/2005/01/18/a-diversion-into-hash-tables-and-binary-searches/" rel="nofollow ugc">http://bannister.us/weblog/2005/01/18/a-diversion-into-hash-tables-and-binary-searches/</a></p>
</div>
</li>
<li id="comment-362944" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a5467e05bc911ad4e2c978bc2fcc8e7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a5467e05bc911ad4e2c978bc2fcc8e7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ffconsultancy.com" class="url" rel="ugc external nofollow">Jon Harrop</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-07T22:10:38+00:00">November 7, 2018 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p>Java&rsquo;s hash tables are notoriously slow: <a href="https://fsharpnews.blogspot.com/2010/05/java-vs-f.html" rel="nofollow ugc">http://fsharpnews.blogspot.com/2010/05/java-vs-f.html</a></p>
</div>
</li>
</ol>
