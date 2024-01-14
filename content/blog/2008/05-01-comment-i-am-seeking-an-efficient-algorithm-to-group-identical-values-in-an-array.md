---
date: "2008-05-01 12:00:00"
title: "Seeking an efficient algorithm to group identical values"
index: false
---

[14 thoughts on &ldquo;Seeking an efficient algorithm to group identical values&rdquo;](/lemire/blog/2008/05-01-i-am-seeking-an-efficient-algorithm-to-group-identical-values-in-an-array)

<ol class="comment-list">
<li id="comment-49885" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-01T23:50:26+00:00">May 1, 2008 at 11:50 pm</time></a> </div>
<div class="comment-content">
<p>How large is the array, and are you interested in the algorithm or a solution? Either Hadoop or Pig would knock this out easily for very large arrays, not particularly efficiently, but quite scalable-y. In Pig this is is a GROUP BY: <a href="http://wiki.apache.org/pig/PigLatin" rel="nofollow ugc">http://wiki.apache.org/pig/PigLatin</a></p>
<p>Your algorithm above is the same as counting the number of occurrences of each item: A:3, B:2, C:2 . Seems like that should be doable with a simple hash with fairly minimal memory requirements. If it&rsquo;s larger than fits in memory you can fairly easily use memcached to have a distributed hash. If it&rsquo;s larger than that you probably want Hadoop.</p>
<p>Btw, the roman numeral spam thing is getting old, how about something more exciting? A nice game of chess or a short essay on the fall of Rome? Here&rsquo;s one I&rsquo;ve heard works well: create a form field called &ldquo;email&rdquo; (name=&rdquo;email&rdquo;), with a label that reads &ldquo;leave this blank&rdquo;. Bots will fill it in with an email address, humans will leave it alone.</p>
</div>
</li>
<li id="comment-49886" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-01T23:51:36+00:00">May 1, 2008 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>On the spam thing: or just use Akismet, it&rsquo;s worked great for me.</p>
</div>
</li>
<li id="comment-49887" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9a1ce0b75918ac8c05ae1e83ebeab69?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9a1ce0b75918ac8c05ae1e83ebeab69?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://thenoisychannel.blogspot.com/" class="url" rel="ugc external nofollow">Daniel Tunkelang</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-01T23:58:00+00:00">May 1, 2008 at 11:58 pm</time></a> </div>
<div class="comment-content">
<p>Basically, you want uniq -c, with no concern for order. Do you need exact counts, or will approximate ones suffice? e.g., an approach like <a href="http://dl.acm.org/citation.cfm?id=1287369.1287400" rel="nofollow">[Manku and Motwani, 2002]</a>.</p>
</div>
</li>
<li id="comment-49888" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T00:49:36+00:00">May 2, 2008 at 12:49 am</time></a> </div>
<div class="comment-content">
<p>It looks like Multiset Discrimination, IIRC this might help: <a href="http://dl.acm.org/citation.cfm?id=99583.99605&amp;coll=GUIDE&amp;dl=ACM&amp;type=series&amp;idx=SERIES317&amp;part=series&amp;WantType=Proceedings&amp;title=POPL" rel="nofollow">Look ma, no hashing, and no arrays neither</a>.<br/>
May be also, from the same, <a href="https://citeseer.ist.psu.edu/myciteseer/login" rel="nofollow">Using Multiset Discrimination To Solve Language Processing Problems Without Hashing</a>.<br/>
I have a paper copy of the first article buried somewhere&#8230;<br/>
I hope the links won&rsquo;t make this caught in &ldquo;spam protection&rdquo; perhaps you should fix the config parameters 😉</p>
</div>
</li>
<li id="comment-49889" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T00:54:19+00:00">May 2, 2008 at 12:54 am</time></a> </div>
<div class="comment-content">
<p>Yes, I am overdue to update the captcha. But I am lazy and it works ok.</p>
<p>No, the hash table cannot fit in memory (otherwise, the problem is trivial).</p>
<p>Daniel: it needs to be exact.</p>
</div>
</li>
<li id="comment-49890" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">D. Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T02:20:22+00:00">May 2, 2008 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s an idea based on counting sort / radix sort. Suppose that the values are W bits long, and that your internal memory is composed of N blocks of B values. Let K ~ log_2 N.</p>
<p>Choose a hash function h(x) mapping the W bits of a data value to smaller K bit numbers. Scan the data values, counting how many times each value of h(x) occurs, and use these counts to allocate chunks of external memory to move the items to. Then scan the data values again, adding each value to a block of internal memory associated with its value of h(x); when one of these internal-memory blocks fills, send x to the corresponding chunk of external memory and start a new internal-memory block for the same value. Recurse (with a new hash function) within each chunk until you get down to chunks small enough to fit into internal memory at which point you can switch to hashing.</p>
<p>This will run into trouble if any single value has more copies than will fit into main memory, because as described above it will recurse forever. But a simple modification fixes that: when you scan and count values of h(x), also check whether the data are all the same as each other (a trivial algorithm: store the first data item and compare it to all successive ones) and if so stop recursing.</p>
</div>
</li>
<li id="comment-49891" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T10:50:55+00:00">May 2, 2008 at 10:50 am</time></a> </div>
<div class="comment-content">
<p>Well, just as D Eppstein I (or anyone else) can come up with various ideas for designing this specific algorithm since it doesn&rsquo;t seem to exist yet as such but are blog comments the proper media for this kind of brainstorming?<br/>
The closest thing I found is this: <a href="http://dblab.kaist.ac.kr/Publication/pdf/ACM90_TODS_v15n2.pdf" rel="nofollow">A Linear-Time Probabilistic Counting<br/>
Algorithm for Database Applications</a> [pdf], tweaking around may bring some clues.</p>
</div>
</li>
<li id="comment-49892" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T15:11:07+00:00">May 2, 2008 at 3:11 pm</time></a> </div>
<div class="comment-content">
<p>I think that David&rsquo;s algo is similar to my &ldquo;mix hashing and sorting&rdquo; approach. </p>
<p>Kevembuangga : I think it is cool that people try to design algorithms on a blog.</p>
</div>
</li>
<li id="comment-49894" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1dc1fdd9d8acd4c9118bd0fc85c1c208?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">D. Eppstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T19:52:50+00:00">May 2, 2008 at 7:52 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, I think it&rsquo;s pretty much the same idea as yours, changed only in that it does multiple levels of hashing instead of immediately switching to sorting, and with a little more detail in how you do the hashing part I/O-efficiently.</p>
<p>I think the analysis should work out to something like log_{M/B} K passes over the data, where M is internal memory size, B is I/O block size, and K is the number of distinct keys. Probably improvable to log_{M/B}(K/M) with a better check for having a small number of distinct keys and an appropriate tall-cache assumption. Which is not much better than the log_{M/B}(n/B) that you get for external-memory sorting (achieved by M/B-way mergesort), but it&rsquo;s interesting that you can do better at all â€” sorting is a bottleneck for a lot of external memory problems much more than it is for in-memory computation.</p>
<p>I don&rsquo;t see what&rsquo;s wrong with brainstorming on a blog, by the way. It&rsquo;s a little risky if one wants to hoard one&rsquo;s intellectual property in order to get proper academic credit for publishing first, but I don&rsquo;t especially care about that for this problem. As for the literature search, thanks for the pointer â€” my usual strategy is brainstorm first, figure out whether it was already known second, but I recognize that reasonable people may disagree on that prioritization.</p>
</div>
</li>
<li id="comment-49893" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.downes.ca" class="url" rel="ugc external nofollow">Stepgen Downes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T15:40:03+00:00">May 2, 2008 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not really an algorithms person, but&#8230;</p>
<p>I probably would have just built a hash table, but if I can&rsquo;t do that&#8230;</p>
<p>I would simply treat the array as a string, start with the first character P, and use a regular expression to count the number n of occurrences of that character P , and then delete those occurrences from the string. Then I&rsquo;d save $vals{P}=n;</p>
<p>Then I would move to the next character and do the same thing, repeating the cycle until the string is empty.</p>
<p>Then, for each character in %vals, I&rsquo;d print n instances.</p>
</div>
</li>
<li id="comment-49895" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-02T22:24:21+00:00">May 2, 2008 at 10:24 pm</time></a> </div>
<div class="comment-content">
<p>It seems there are plenty of good enough algorithms, so it&rsquo;s a question of whether we&rsquo;re looking for the optimal algorithm or a workable solution.</p>
<p>Memcached is easily distributable over several machines, and you can easily get 8G per box these days, so you can fit a lot in memory. If it&rsquo;s larger than that Hadoop is what you want.</p>
</div>
</li>
<li id="comment-49896" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-03T06:37:32+00:00">May 3, 2008 at 6:37 am</time></a> </div>
<div class="comment-content">
<p>It would be nice to have some more informations on the problem, approximate size of the key in bytes, total number of keys, acceptable RAM size.</p>
<p><b>Parand:</b> <i>It seems there are plenty of good enough algorithms</i></p>
<p>Mmmmm, no, there are plenty of <i>close enough</i> algorithms, AFAIK none matching the exact requirements of Daniel.</p>
<p><b>D. Eppstein:</b> <i>I don&rsquo;t see what&rsquo;s wrong with brainstorming on a blog, by the way. It&rsquo;s a little risky if one wants to hoard one&rsquo;s intellectual property in order to get proper academic credit for publishing first,</i></p>
<p>That&rsquo;s not what I meant. I am not an academic, furthermore I am <b>retired</b>, so what do I care? 🙂</p>
<p>It&rsquo;s that the volume of messages exchange may be a bit large for a comments thread and that the true &ldquo;sausage making&rdquo; process doesn&rsquo;t look pretty like in published papers or course lectures.<br/>
You have to spout out a <b>lot</b> of silly ideas to <i>possibly</i> (but not eventually&#8230;) put your finger on the real nugget.</p>
<p>To give you the flavor I will give it a try below.</p>
<p><b>D. Eppstein:</b> <i>As for the literature search, thanks for the pointer â€” my usual strategy is brainstorm first, figure out whether it was already known second, but I recognize that reasonable people may disagree on that prioritization.</i></p>
<p>Not really disagreeing, reinventing the wheel feels good because then, it&rsquo;s <b>your</b> wheel (even if very similar to previously known ones), however to have more chances to come up with a better wheel it&rsquo;s good to have a look at the existing ones.</p>
<p>Trying a first draft, something along the lines of <a href="http://www.personal.kent.edu/~rmuhamma/Algorithms/MyAlgorithms/Sorting/bucketSort.htm" rel="nofollow">bucket sort</a> could probably do, the trick being that most of the data should stay on disk rather than in RAM.<br/>
I will assume that it&rsquo;s acceptable to use an amount of disk workspace slightly larger than the total size of the keys (keysize x N).<br/>
Depending on the available RAM choose a chunk size of 2 or 3 bytes (such that each chunk value can be used as an index into a RAM array) and split the keys into column slices 2 or 3 bytes wide, copying each slice into a distinct file for further processing.<br/>
Unless the key is unusually long there should not be too many files.</p>
<p>On the first pass (which can be done along the splitting of keys) keep in the RAM array a count of the number of hits for the chunk values of slice 0 and an &ldquo;id&rdquo; for this stream of values (allocated whenever the first such value appear), this makes for a 2 ints entry per chunk value, i.e.2 x 2**16 or 2**24 ints.<br/>
Along with this write out for each key the id number of the stream it belongs to, allowing to retrieve that id later just from the rank of the key in the file.<br/>
BTW, since this is all what is required for pass 1 slice 0 need not be written to disk.<br/>
At the end of any pass if the count for a given stream id is 1 the key is unique and need no further consideration.</p>
<p>Succeeding passes over key slices 1 to N are a bit more complicated and each may even need to be iterated into sub-passes.<br/>
This is where memory constraints show up.<br/>
[ I will continue (later) into another comment since the HTML textfield begins to screw up weirdly, too much text likely&#8230;]</p>
</div>
</li>
<li id="comment-49897" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-03T12:36:14+00:00">May 3, 2008 at 12:36 pm</time></a> </div>
<div class="comment-content">
<p>Continued&#8230;</p>
<p>In the first pass there were only one stream as input: <b>all</b> yet undiscriminated keys.<br/>
In succeeding passes the keys from each stream must be delt with separately from other streams (qualified by their already assigned stream number).<br/>
That would mean as many count/id arrays as there are distinct streams, this is where memory constraints show up.<br/>
Do you really expect such a large number of distinct keys that you could not host an id/count pair + a few housekeeping bytes for each group in RAM?<br/>
If so even resorting to clever sparse tables won&rsquo;t do.(like <a href="ftp://reports.stanford.edu/pub/cstr/reports/cs/tr/78/683/CS-TR-78-683.pdf" rel="nofollow">Tarjan&rsquo;s</a> or <a href="http://dl.acm.org/citation.cfm?doid=828.1884" rel="nofollow">Fredman, KomlÃ³s, Szemerédi</a>).</p>
<p>Anyway, the base idea (from bucket sort) is that when processing the next key slice you read along the currently assigned key stream id from the id&rsquo;s file created in the previous pass to discriminate the key chunk counting/stamping by previous id (major).<br/>
This way all I/O is <b>sequential</b>, not random.<br/>
If there is really no way to stuff all the new id/count arrays in RAM things get really ugly.<br/>
You have to cram as many arrays as possible in RAM, then skip the processing of keys which don&rsquo;t belong to the stream ids (from previous pass) that you have in core, create the new stream ids file by random access (though still in increasing disk locations thus not the very worst case) and make as many &ldquo;sub-passes&rdquo; as to process all key chunks.<br/>
In the end the last stream id file will contain the id for each key as a plain integer and you still have to count the id occurrences for each class (this amount to having translated the arbitrary key sequence to a &ldquo;clean&rdquo; sequence of ids).<br/>
If even the counts array cannot fit in RAM 🙁 , in the last pass (slice N) you will have to output the counts in a separate file at the end of each sub-pass.</p>
<p>Further suggestions from the crowd?<br/>
(asking for the famous &ldquo;wisdom of crowds 😉 )</p>
</div>
</li>
<li id="comment-49904" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d10ca8d11301c2f4993ac2279ce4b930?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d10ca8d11301c2f4993ac2279ce4b930?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JPP</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-05-07T10:54:10+00:00">May 7, 2008 at 10:54 am</time></a> </div>
<div class="comment-content">
<p>It would be great if you could post a summary of the discussion and, even greater, a personal feedback 🙂</p>
</div>
</li>
</ol>
