---
date: "2014-02-03 12:00:00"
title: "Compression is never worth slowing down your code?"
index: false
---

[16 thoughts on &ldquo;Compression is never worth slowing down your code?&rdquo;](/lemire/blog/2014/02-03-compression-is-never-worth-slowing-down-your-code)

<ol class="comment-list">
<li id="comment-111015" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/25999b45c3bd15412dbf85ca281cde8f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter Boothe</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-03T23:37:44+00:00">February 3, 2014 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>You assumed a fixed amount of CPU available per meg of storage.</p>
</div>
</li>
<li id="comment-111016" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b11abb86d0b417d689b9a9c614cba54c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b11abb86d0b417d689b9a9c614cba54c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://techblug.wordpress.com" class="url" rel="ugc external nofollow">Julien Le Dem</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T00:00:15+00:00">February 4, 2014 at 12:00 am</time></a> </div>
<div class="comment-content">
<p>Double the throughput is on the compressed data, not the raw data.<br/>
So it&rsquo;s 1h * 1B / 1B *2 = 2h on one server</p>
</div>
</li>
<li id="comment-111018" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3a4651447c3ffc65b7a04611a4355a33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3a4651447c3ffc65b7a04611a4355a33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">eduarrrd</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T00:21:45+00:00">February 4, 2014 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Multiple approaches &#8230;</p>
<p>&ldquo;All processing&rdquo; doesn&rsquo;t make much sense. I may take some time for (de)compression, but there is no reason for decompressed data to be processed slower.</p>
<p>You&rsquo;re assuming that all the data is already available to the servers. You would probably see significant gains because of reduced transfer times.</p>
<p>As an aside, hypothetically, you could invent something like homomorphic case-conversion. That should make things pretty fast :-).</p>
</div>
</li>
<li id="comment-111019" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/99e5f5a22af6e87830d7c84779f14b47?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Keith Trnka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T00:27:42+00:00">February 4, 2014 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t imagine the situation you describe; as time goes on, storage capacity grows but the amount of data grows as well. It seems like you&rsquo;re asking if there&rsquo;s any reason to compress if you have practically infinite resources?</p>
</div>
</li>
<li id="comment-111020" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/18a9d62dca0ae85db21bec4e53e2f717?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/18a9d62dca0ae85db21bec4e53e2f717?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://recursiveunfolding.blogspot.co.at/" class="url" rel="ugc external nofollow">Peter</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T00:31:21+00:00">February 4, 2014 at 12:31 am</time></a> </div>
<div class="comment-content">
<p>The available and needed storage are independent from the available CPU processing power (at least in the first order and in your example).</p>
<p>Example: if you buy a harddisk of twice the size, you still don&rsquo;t have a faster CPU and your data will not be processed faster. </p>
<p>Apart from that I suppose that most of the NSA algorithms are based on map/reduce (Hadoop like) and therefore very suitable to be split up to as many cores as one likes. This again favors many computers, since the overhead of distributing the data to the servers and recollecting the computation results is low.</p>
</div>
</li>
<li id="comment-111025" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T07:40:28+00:00">February 4, 2014 at 7:40 am</time></a> </div>
<div class="comment-content">
<p>@Peter it is rather a fixed amount of CPU per bit of information processed, isn&rsquo;t it?</p>
</div>
</li>
<li id="comment-111026" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T07:44:47+00:00">February 4, 2014 at 7:44 am</time></a> </div>
<div class="comment-content">
<p>Your story isn&rsquo;t &ldquo;wrong&rdquo;, but it&rsquo;s not particularly representative of a real world situation. The main issue is that you are presuming the the [typo intentional for future testing] server farm already exists and must be used in its current form, and that the costs of keeping it running are constant per hour.</p>
<p>Assume instead that you were provisioning such a system, and that because of the new algorithm, instead of putting $1000 of RAM into each machine you only had to put in $1 worth. If the cost of the RAM is more than half of the machine cost, you could use the savings to buy more than 2x the number of servers and come out ahead. </p>
<p>Also, RAM is power hungry and generates heat. If you have machines very little RAM, they cost less to run, and your data center can support more of them. If each server running the new algorithm uses 1/10th the power and generates 1/10th the heat, you can afford to run more than twice as many.</p>
<p>I think that more usually you want to figure out what total level of performance you want to provide, and then decide most effective way to deploy your resources to do this. If RAM is free but floorspace is expensive or some per CPU cost dominates, the new algorithm isn&rsquo;t much use to you.</p>
<p>It would be no better than an algorithm &ldquo;saves on instructions&rdquo; by running only half as many but takes twice as long to do so. But if buying and powering RAM is your major operating expense, the equation changes, and the new algorithm might allow you to achieve a lower total cost of operations while still meeting your target level of performance.</p>
</div>
</li>
<li id="comment-111029" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ac947118dbe06a4455ccb19a15b0d4d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ac947118dbe06a4455ccb19a15b0d4d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Milind Changire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T09:00:42+00:00">February 4, 2014 at 9:00 am</time></a> </div>
<div class="comment-content">
<p>The place where you went wrong is replaced the speed-up of processing power with halving of throughput, which is contradictory.</p>
<p>If the compressed data were to be maintained respectively at the 1 billion servers, then it would take half the time i.e. 0.5 hours, for each server.</p>
<p>I wonder, then why would NSA reject the proposal!</p>
</div>
</li>
<li id="comment-111030" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T09:24:03+00:00">February 4, 2014 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>@Nathan, the example here, I believe is intentionally extreme. Imagine the case when your compression reduces the size by 10%.</p>
<p>Regarding the greedy memory: wouldn&rsquo;t the memory in 2BS machines (in this examples) will be using twice as much energy? as compared to 1BS machines that operate on uncompressed data? I assume that it is not easy to run a computer that provides electricity to only 1 billionth of its memory cells.</p>
<p>Though it is certainly not impossible, especially if we are in the future 🙂</p>
</div>
</li>
<li id="comment-111031" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T10:19:32+00:00">February 4, 2014 at 10:19 am</time></a> </div>
<div class="comment-content">
<p>Just compress it in 1,000,000,000-bit blocks and use a lookup table.</p>
</div>
</li>
<li id="comment-111032" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T10:20:56+00:00">February 4, 2014 at 10:20 am</time></a> </div>
<div class="comment-content">
<p>@Milind I believe this is true only if you process uncompressed data. Compressed data is process twice as long.</p>
</div>
</li>
<li id="comment-111036" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c47d7a71160b9ec79d34316139ff3cdb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T11:04:18+00:00">February 4, 2014 at 11:04 am</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t tell if my suggestion to change the font so the cases are swapped was lost in the electronic ether or moderated, but I&rsquo;ll restate it in non-joke form. Don&rsquo;t spin up 2 billion machines for this problem. Don&rsquo;t modify your massive compressed data stores. Changing individual records, fine. But if you decide you want different casing, or different format for decimals, or to replace coded words with ***, just do that on the fly. Then you&rsquo;re already paying the decompression cost, already paying the memory footprint, and are looking at an extra 50 ns of computation during display.</p>
<p>Even without compression, the next president is going to ask for the data lower-cased actually. Now you&rsquo;re rerunning that algorithm across 1 billion servers again. Versus commenting out the line that swaps the casing when the document goes out. </p>
<p>Where you went wrong in this story was in entertaining the idea that recasing all your data was a sane way of meeting the random whims of bosses 😉</p>
</div>
</li>
<li id="comment-111048" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2b635657dfbb5f9792ee1a9311a69ee0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2b635657dfbb5f9792ee1a9311a69ee0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justin Dossey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T15:15:29+00:00">February 4, 2014 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>When evaluating storage compression, you also have to take into account the amount of time it will take to read the data from media into memory. Reading a billionth as much data from disk will take a billionth as long, and so in the real world, that constant factor could easily dominate the entire calculation. If you&rsquo;re talking about slowing every data access by a factor of two (which implies that actual processing time is zero), your conclusion is correct.</p>
</div>
</li>
<li id="comment-111053" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc40eb0aff49fb0aeef0b781db35e29d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T17:37:39+00:00">February 4, 2014 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>@Leo #9: Yes, if you already have the memory installed and are paying the cost of running it, there is no downside to using it. If &ldquo;use it or lose it&rdquo; applies, the compression scheme does not help. But the &lsquo;paradox&rsquo; is false if you are able to optimize the system in advance and physically put less RAM in each box. </p>
<p>Yes, Daniel&rsquo;s example is extreme, but I was offering a general principle: if a different algorithm allows a reallocation of resources that results in a lower total cost of operation, it&rsquo;s a win. Changing the tradeoff between compression and throughput to be more realistic adjusts the final answer, but not the principle.</p>
</div>
</li>
<li id="comment-111056" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T18:15:54+00:00">February 4, 2014 at 6:15 pm</time></a> </div>
<div class="comment-content">
<p>Good point that the actual cost may not necessarily scale linearly with the #of nodes used. There is no arguing that this example considers the actual cost. </p>
<p>Here, though, having extra billion greedy CPUs, fans and power adapters will likely outweigh savings on memory. And in many cases, you do have this &ldquo;lose it or use it&rdquo; approach, because you cannot get an optimal configuration for each task.</p>
</div>
</li>
<li id="comment-111062" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2014-02-04T21:19:42+00:00">February 4, 2014 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>PS: no arguing that this example DOESN&rsquo;T consider an actual cost.</p>
</div>
</li>
</ol>
