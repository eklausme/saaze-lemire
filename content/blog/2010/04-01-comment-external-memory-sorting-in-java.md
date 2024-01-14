---
date: "2010-04-01 12:00:00"
title: "External-Memory Sorting in Java"
index: false
---

[11 thoughts on &ldquo;External-Memory Sorting in Java&rdquo;](/lemire/blog/2010/04-01-external-memory-sorting-in-java)

<ol class="comment-list">
<li id="comment-52394" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c2b6fd2a636101588bc9479414aca73?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c2b6fd2a636101588bc9479414aca73?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.cs.cmu.edu/~jelsas/" class="url" rel="ugc external nofollow">Jon Elsas</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-01T11:59:34+00:00">April 1, 2010 at 11:59 am</time></a> </div>
<div class="comment-content">
<p>Changed instances of Vector to ArrayList. Vector is synchronized, which is unnecessary in this context.</p>
<p><a href="http://pastebin.com/zNKCYL5H" rel="nofollow ugc">http://pastebin.com/zNKCYL5H</a></p>
<p>(I also agree &#8212; nice simple use of PriorityQueue. Might have to steal this idiom 🙂 )</p>
</div>
</li>
<li id="comment-52389" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Thierry Faure</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-01T10:39:07+00:00">April 1, 2010 at 10:39 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t look deeply in your implementation</p>
<p>There an open source (LGPL) implementation<br/>
referenced in this thread<br/>
<a href="http://forums.sun.com/thread.jspa?threadID=5310310" rel="nofollow ugc">http://forums.sun.com/thread.jspa?threadID=5310310</a> in colaboration with yahoo<br/>
Witch seem to have &ldquo;good&rdquo; performance</p>
<p>My 2 cents<br/>
Thierry</p>
</div>
</li>
<li id="comment-52390" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-01T10:39:56+00:00">April 1, 2010 at 10:39 am</time></a> </div>
<div class="comment-content">
<p>Why not put it on Google Code right away? They have a nice code review tool that works better than pastebin to comment code or ask a question on a specific line.</p>
</div>
</li>
<li id="comment-52392" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-01T11:14:58+00:00">April 1, 2010 at 11:14 am</time></a> </div>
<div class="comment-content">
<p>I like your approach! Great use of PriorityQueue and the Comparable interface on your BinaryFileBuffer. Short and simple.</p>
<p>I made a couple of changes on pastebin to get rid of a potential infinite loop. But beside that, it looks good to me. (Although I think 8 spaces is way too much for tabs. I go with 2. 😉 )</p>
</div>
</li>
<li id="comment-52393" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-01T11:39:24+00:00">April 1, 2010 at 11:39 am</time></a> </div>
<div class="comment-content">
<p>Forgot the link:<br/>
<a href="http://pastebin.com/yriK3tKf" rel="nofollow ugc">http://pastebin.com/yriK3tKf</a></p>
</div>
</li>
<li id="comment-52396" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/09de2a313111666756920b5db976036c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/09de2a313111666756920b5db976036c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francois Laflamme</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-02T06:18:52+00:00">April 2, 2010 at 6:18 am</time></a> </div>
<div class="comment-content">
<p>My command of Java is quite poor, but that&rsquo;s beside the point: I did not originally understand the algorithm. If I have a list of, say, 100 numbers, split that list into 10 lists of 10 numbers each, sort each of them individually and then merge the result, I will still need to sort the new 100-number list. However, there are advantages to doing things that way &#8211; which are explained here: <a href="https://en.wikipedia.org/wiki/Mergesort" rel="nofollow ugc">http://en.wikipedia.org/wiki/Mergesort</a></p>
<p>&ldquo;1- A small list will take fewer steps to sort than a large list.<br/>
2- Fewer steps are required to construct a sorted list from two sorted lists than two unsorted lists. For example, you only have to traverse each list once if they&rsquo;re already sorted [&#8230;].&rdquo; </p>
<p>This old pony learnt a new trick today&#8230;</p>
</div>
</li>
<li id="comment-52397" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Philippe Beaudoin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-02T10:52:52+00:00">April 2, 2010 at 10:52 am</time></a> </div>
<div class="comment-content">
<p>I think the key is that you don&rsquo;t have to load the smaller files entirely: just read the first number in each of the 10 files and you&rsquo;ll know the smallest (remaining) entry. Pop the smallest entry out out of the file where you found it and send it directly to the output file. As a result, you never had to keep the 100 numbers in memory.</p>
</div>
</li>
<li id="comment-52399" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d46affa26bb4e732f1b1b119cb817a11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d46affa26bb4e732f1b1b119cb817a11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.christangrant.com" class="url" rel="ugc external nofollow">Christan Grant</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-03T15:56:28+00:00">April 3, 2010 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p>I think you can make the BinaryFileBuffer class simpler by removing the &lsquo;buf&rsquo; list and instead increasing the size of the buffer internal to the BufferedReader.</p>
<p>The performance was about the same in my tests.</p>
<p>Here is the change: <a href="http://pastebin.com/ene9CB8i" rel="nofollow ugc">http://pastebin.com/ene9CB8i</a></p>
</div>
</li>
<li id="comment-52400" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-03T23:34:34+00:00">April 3, 2010 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>I propose <a href="https://gist.github.com/c87c3a3c92889a773d15" rel="nofollow ugc">https://gist.github.com/c87c3a3c92889a773d15</a> to make BinaryFileBuffer more cohesive</p>
</div>
</li>
<li id="comment-52401" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-04T20:38:12+00:00">April 4, 2010 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>Reading through the code I think found one unneeded conditional:<br/>
while(line != null) {</p>
<p>When I created a big file to test, I ran out of memory. Increasing the<br/>
heap size, java -Xmx128m or more, it only ever created one temp file.<br/>
I believe that&rsquo;s because you check free memory rather than what has<br/>
been used so far:<br/>
while((Runtime.getRuntime().freeMemory() &gt; 2097152)<br/>
&amp;&amp;( (line = fbr.readLine()) != null) ){ // as long as you have 2MB<br/>
tmplist.add(line);</p>
<p>If more than one file was created, I do not know the behaviour if this<br/>
would overwrite:<br/>
File newtmpfile = File.createTempFile(&ldquo;sortInBatch&rdquo;, &ldquo;flatfile&rdquo;);</p>
<p>As it is, for a large file, the Java version is faster, however<br/>
sometimes the result is not what I get on the command-line with sort<br/>
(I get a smaller file!). I haven&rsquo;t been able to properly isolate the bug. It<br/>
only happens with fairly large files though.</p>
<p>$ time java -Xmx512m ExternalSort to_sort10.txt to_sort10.txt.java.out</p>
<p>real 0m24.436s<br/>
user 0m24.937s<br/>
sys 0m1.669s</p>
<p>$ time sort to_sort10.txt &gt; to_sort10.txt.sort.out</p>
<p>real 2m41.615s<br/>
user 2m35.640s<br/>
sys 0m1.876s</p>
<p>-rw-r&#8211;r&#8211; 1 danielharan danielharan 54288300 4 Apr 00:55 to_sort10.txt<br/>
-rw-r&#8211;r&#8211; 1 danielharan danielharan 39720054 4 Apr 01:21<br/>
to_sort10.txt.java.out #EEEK<br/>
-rw-r&#8211;r&#8211; 1 danielharan danielharan 54288300 4 Apr 01:26<br/>
to_sort10.txt.sort.out</p>
</div>
</li>
<li id="comment-52403" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0d6b052f4e55072d8767ff1acf9bf923?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0d6b052f4e55072d8767ff1acf9bf923?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://theyougen.blogspot.com/" class="url" rel="ugc external nofollow">Thomas Jung</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-04-06T07:33:26+00:00">April 6, 2010 at 7:33 am</time></a> </div>
<div class="comment-content">
<p>I suppose there are some issues with your code:<br/>
&#8211; The check of remaining memory (Runtime.getRuntime().freeMemory() &gt; 2097152) is not valid. The Vector will douple its size if it ran out of space. This may allocate more than 2Mb.<br/>
&#8211; All files to merge are kept open. The OS could run out of file handles if there are to many files to merge.<br/>
&#8211; The files to merge are not closed savely. If an exception is thrown they may be still opened.</p>
<p>Alternative approaches merge files in multiple runs until there are no files to merge left. This is probably only needed here if too many files have to be merged at once.</p>
</div>
</li>
</ol>
