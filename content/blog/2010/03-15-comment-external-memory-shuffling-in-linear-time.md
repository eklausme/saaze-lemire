---
date: "2010-03-15 12:00:00"
title: "External-memory shuffling in linear time?"
index: false
---

[21 thoughts on &ldquo;External-memory shuffling in linear time?&rdquo;](/lemire/blog/2010/03-15-external-memory-shuffling-in-linear-time)

<ol class="comment-list">
<li id="comment-52348" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T14:56:44+00:00">March 15, 2010 at 2:56 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>I&rsquo;d be fine with quasi-shuffling, as long as it has nice properties.</p>
<p>My practical motivation is this: I&rsquo;m annoyed that no standard Unix tool does random line shuffling over very large files.</p>
<p>My second motivation is that I&rsquo;m annoyed people consider the shuffling problem &ldquo;solved&rdquo; by assuming that you have fixed-length records.</p>
<p>And finally, I think you cannot just &ldquo;shuffle&rdquo; locally. Think about a sorted file. If you shuffle it only locally, it will still be &ldquo;almost sorted&rdquo; (no line starting with the letter &lsquo;z&rsquo; will appear in the first few lines).</p>
</div>
</li>
<li id="comment-52350" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T15:37:28+00:00">March 15, 2010 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>The algorithm I propose is close to a classical merge-sort algorithm. It fails to be linear (I think) because picking blocks at random, with uneven probabilities, is hard.</p>
<p>Maybe this can be fixed.</p>
</div>
<ol class="children">
<li id="comment-294544" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/56d6527b9d092b9d31be4e92e9102966?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/56d6527b9d092b9d31be4e92e9102966?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Hardin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-06T01:21:17+00:00">January 6, 2018 at 1:21 am</time></a> </div>
<div class="comment-content">
<p>(Sorry to reply to something ancient.)</p>
<p>Your proposed algorithm (&ldquo;A better solution?&rdquo;) looks linear to me (assuming we treat generating a random integer from a range as O(1)). I don&rsquo;t follow your point about uneven probabilities: You can assign each string uniformly to one of the temporary files. The result is still an unbiased shuffle. (Strictly speaking, there&rsquo;s an astronomically small chance that one of the temp files gets so big you can&rsquo;t shuffle it in memory. Start over or recurse if that happens; the algorithm is still unbiased and the expected extra cost from the possible reruns is very low.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-52353" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76d19f57f5d4c2d36f1f417c5ac5beae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76d19f57f5d4c2d36f1f417c5ac5beae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.serpentine.com/blog/" class="url" rel="ugc external nofollow">Bryan O'Sullivan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T17:16:18+00:00">March 15, 2010 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>Using a random-keyed sort to implement a shuffle is well known to give rise to biased distributions, so that method won&rsquo;t work without some heroic effort.</p>
<p>If you can identify a record boundary by scanning backwards (always true for normal Unix text files), it&rsquo;s simple to use Fisher-Yates shuffle with external storage and random access, in just the same way as you&rsquo;d implement binary search. I&rsquo;ve a suspicion that the time complexity isn&rsquo;t theoretically linear, though.</p>
</div>
<ol class="children">
<li id="comment-569545" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08aff750c4586c34375a0ebd987c1a7e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08aff750c4586c34375a0ebd987c1a7e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-24T17:07:33+00:00">January 24, 2021 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think assigning a fixed random key to each record (or using a good hash function) is biased. Only using a random, record independent result for the sort comparison function will create bias.</p>
</div>
</li>
</ol>
</li>
<li id="comment-52347" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T14:17:25+00:00">March 15, 2010 at 2:17 pm</time></a> </div>
<div class="comment-content">
<p>First question &#8211; what is the aim of this exercise?</p>
<p>You probably do not need a completely-random shuffle over the entire bulk of the file. This makes a large difference in the appropriate algorithms. What do you need to get meaningful results from your current exercise?</p>
</div>
</li>
<li id="comment-52349" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T15:30:13+00:00">March 15, 2010 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>Fair enough. Note that I was thinking more along the lines of classic sort-merge algorithm, except shuffling rather than sorting. Runtime could be effectively linear and equal to a read/write of all the file data, twice (with minimal seeks). Theoretically there would be a non-linear component, but with a very much smaller constant multiplier. </p>
<p>If local shuffling were sufficient, the runtime could be reduced to a single read/write of the input.</p>
<p>Yes, this is the pragmatist talking to the theoretician. 🙂</p>
<p>The reason for the lack of a generic optimal random file-shuffle is that the underlying reason for wanting a shuffle is not, um &#8230; random. The base requirement changes which algorithms are most suitable.</p>
</div>
</li>
<li id="comment-52351" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T15:52:19+00:00">March 15, 2010 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>Still not sure about your base need, but try this:</p>
<p>1. Create N files as output buckets.<br/>
2. For each line and use a hash to choose the output bucket.<br/>
3. For each line written to the final output, read one line from a random bucket.<br/>
4. Measure and adjust.</p>
<p>The hash could be a random number generator. Note you do not want:<br/>
* Too many buckets (OS limits on number of open files that can be efficiently handled).<br/>
* Too-small buckets (inefficient small I/O).<br/>
* Hashing that clusters with negative effect on your base purpose.</p>
<p>With careful use of buffering you can make this run at full disk read/write rates with minimal CPU usage.</p>
</div>
</li>
<li id="comment-52352" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T15:53:20+00:00">March 15, 2010 at 3:53 pm</time></a> </div>
<div class="comment-content">
<p>(Way do I always notice needed edits right AFTER posting??)</p>
</div>
</li>
<li id="comment-52354" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7008af99deaa7cb0fc37a8bb7d2e79cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7008af99deaa7cb0fc37a8bb7d2e79cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J.D. Park</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-15T18:02:29+00:00">March 15, 2010 at 6:02 pm</time></a> </div>
<div class="comment-content">
<p>It looks to me like it isn&rsquo;t possible. The survey paper &ldquo;External Memory Algorithms and Data Structures: Dealing with Massive Data&rdquo; by Jeffrey Scott Vitter says that permuting has the same IO complexity as sorting for non-trivial block sizes (its in section 5.5 if you are interested). That seems to imply that a true linear IO complexity external shuffle isn&rsquo;t possible even with fixed size records.</p>
</div>
</li>
<li id="comment-52364" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8f0adebf92b934c207e168cd26a7bab?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8f0adebf92b934c207e168cd26a7bab?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Craig Kelly</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-24T22:52:45+00:00">March 24, 2010 at 10:52 pm</time></a> </div>
<div class="comment-content">
<p>You could create an &ldquo;index file&rdquo; for variable-length records where each fixed-size record has 2 fields: offset and length. This fixed-length file could be shuffled and then used to re-read the original file.</p>
<p>While perhaps not as elegant as Preston L. Bannister&rsquo;s solution, it would be pretty simple to implement.</p>
</div>
</li>
<li id="comment-52365" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-03-25T06:34:18+00:00">March 25, 2010 at 6:34 am</time></a> </div>
<div class="comment-content">
<p>@Craig Yes, it would be simple to implement, but it *might* be quite a bit slower. Even with fixed-length records, the Fisher-Yates algorithm might just be fundamentally slow when used with external memory. Indeed, how do you leverage your fast internal memory? Bannister&rsquo;s algorithm is nice because a good part of the work is done in RAM. You don&rsquo;t write all over the disk, all the time.</p>
</div>
</li>
<li id="comment-230017" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb8f814aed905ab46adc1294b5a15ef0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb8f814aed905ab46adc1294b5a15ef0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick Downing</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-29T08:18:25+00:00">February 29, 2016 at 8:18 am</time></a> </div>
<div class="comment-content">
<p>If memory size is e.g. 100MB, I was thinking of reading 100MB at a time from the input, shuffling it and writing it out to a tempfile so that I have tempfile.1, tempfile.2, &#8230;, tempfile.n each 100MB in size.</p>
<p>Then I perform an n-way merge in such a way that if there are c1 items remaining in tempfile.1, c2 items remaining in tempfile.2 and so on up to cn, then the probability that an item is taken from the head of tempfile.i would be ci/(c1 + c2 + &#8230; + cn), is this correct?</p>
<p>The only real issue with this is I want my shuffling to be repeatable based on the seed given by the user in the beginning, so if I do it this way then the output will depend on both seed AND memory size. I could set some fixed and conservative memory size such as 100MB and always shuffle on that basis, but this might get inefficient for really big files, say 10GB since it&rsquo;d have to create 100 tempfiles.</p>
<p>Any ideas?</p>
</div>
<ol class="children">
<li id="comment-230065" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-02-29T15:37:01+00:00">February 29, 2016 at 3:37 pm</time></a> </div>
<div class="comment-content">
<p>Sadly, what you describe is maybe not a fair shuffle. You need to show that all N! possible permutations are equally likely. To do that, you can proceed a bit differently. Take each and every input value and move it to any one of n containers with equal probability. The catch here is that some of the containers might get quite a bit larger than others&#8230; you can&rsquo;t help that. Shuffle container&#8230; Then merge it all.</p>
</div>
<ol class="children">
<li id="comment-487402" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/453c82c144758d120d3ea8beb8405520?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/453c82c144758d120d3ea8beb8405520?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-24T17:16:37+00:00">January 24, 2020 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>Why wouldn&rsquo;t Nick&rsquo;s recipe be fair? It seems to me that at any given time, if there are n remaining items, the probability of picking any particular remaining item is 1/n.</p>
<p>Let&rsquo;s say a particular remaining item is in file i. The probability of picking the right file is ci / (c1 + c2 + … + cn), using weighted random selection. (Picking files with equal probabilities doesn&rsquo;t work.)</p>
<p>Then, if you picked the right file i, the probability that the item will be at the head of the file is 1/ci, because the file is shuffled.</p>
<p>Multiply those two together and you get 1/(c1 + c2 + … + cn) == 1/n.</p>
<p>Isn&rsquo;t the Fisher-Yates algorithm basically &ldquo;pick one of the remaining input items at random with equal probability (i.e., 1/n), remove from input, add to output, rinse and repeat&rdquo;? The above seems equivalent to me.</p>
<p>FWIW I did a little brute-force experiment, doing the above shuffle many times with small inputs such that the permutations can be fully sampled, and using buckets of different sizes to see if that introduces a bias, and I didn&rsquo;t see any. For example, with 6 elements and 720,000 shuffles, all 720 permutations are seen 1000 +/- 100 times, which seems reasonable enough (within about 3 std. devs), regardless of whether I start with two 3-item buckets, or a 1-item bucket and a 5-item bucket, or an empty bucket and a 6-item bucket.</p>
</div>
<ol class="children">
<li id="comment-487418" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-24T22:38:02+00:00">January 24, 2020 at 10:38 pm</time></a> </div>
<div class="comment-content">
<p>You might be correct.</p>
</div>
<ol class="children">
<li id="comment-487569" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-27T00:53:58+00:00">January 27, 2020 at 12:53 am</time></a> </div>
<div class="comment-content">
<p>An easy (lazy) way to prove something is biased is just to calculate directly tbr probability for 2 or 3 elements. This is only a sufficient condition for bias, of course, not a necessary one: but it seems to work well in practice.</p>
</div>
</li>
</ol>
</li>
<li id="comment-487612" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-27T14:13:59+00:00">January 27, 2020 at 2:13 pm</time></a> </div>
<div class="comment-content">
<p>Note that doing weighted sampling quickly can be tricky.</p>
<p>In the worst case, you need to do a scan through a list of possible outcomes, and if this list of possible outcomes is even a bit large, it is going to be a bummer.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-365890" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4e9e0c920b9b57df8648d8770e834d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4e9e0c920b9b57df8648d8770e834d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon Degenhardt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-18T22:25:38+00:00">November 18, 2018 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>I had this same need, but also for weighted shuffling. What I ended up doing was similar to the <code>sort --random-sort</code> unix pipeline strategy in your earlier <a href="https://lemire.me/blog/2008/02/13/external-memory-shuffles/">blog post</a>. However, it uses GNU sort&rsquo;s &ldquo;numeric&rdquo; sort option which is much faster, combined with a sampling tool I wrote, <a href="https://github.com/eBay/tsv-utils/blob/master/docs/ToolReference.md#tsv-sample-reference" rel="nofollow">tsv-sample</a>. Performance will vary quite considerably between hardware and data sets. However, on a data set I used for testing processing went from 4 hours 53 minutes for <code>sort --random-sort</code> to 14 minutes. There is a more details description here: <a href="https://github.com/eBay/tsv-utils/blob/master/docs/TipsAndTricks.md#shuffling-large-files" rel="nofollow">Shuffling large files</a>, in the <a href="https://github.com/eBay/tsv-utils" rel="nofollow">eBay TSV Utilities</a> GitHub repository.</p>
<p>It&rsquo;d be very interesting of course to implement the shuffling algorithm described in your blog post here. It should work nice for unweighted shuffling. I haven&rsquo;t come up with a good approach for the weighted version though.</p>
</div>
<ol class="children">
<li id="comment-365892" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-18T22:39:50+00:00">November 18, 2018 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>How do you define &ldquo;weighted shuffling&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-365904" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4e9e0c920b9b57df8648d8770e834d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4e9e0c920b9b57df8648d8770e834d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon Degenhardt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-11-18T23:16:35+00:00">November 18, 2018 at 11:16 pm</time></a> </div>
<div class="comment-content">
<p>I just mean weighted random sampling (without replacement), except creating a full sampling order. The more common use case is to produce a subsample in the weighted order. Weighted reservoir sampling usually works for this. The algorithm I used is based on approaches described by Pavlos Efraimidis and Paul Spirakis. See <a href="https://arxiv.org/abs/1012.0256" rel="nofollow">Weighted Random Sampling over Data Streams</a>. However, it can also be useful to be generate the weighted order for a full data set. Perhaps then it should be called something other than &ldquo;shuffling&rdquo;, don&rsquo;t know.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
