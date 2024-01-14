---
date: "2008-12-19 12:00:00"
title: "Parsing CSV files is CPU bound: a C++ test case (Update 2)"
index: false
---

[7 thoughts on &ldquo;Parsing CSV files is CPU bound: a C++ test case (Update 2)&rdquo;](/lemire/blog/2008/12-19-parsing-csv-files-is-cpu-bound-a-c-test-case-update-2)

<ol class="comment-list">
<li id="comment-50364" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://kwillets.typepad.com/kwillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-20T02:08:33+00:00">December 20, 2008 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>There are a couple of things that might speed things up. One is to avoid conventional I/O and mmap the file. Then you need a small DFA to parse the CSV format in memory. </p>
<p>Eventually you should get an inner loop that looks something like:</p>
<p>while( state = dfa[state].edges[*p++] )<br/>
;</p>
<p>(State 0 would be the end/error state.)</p>
<p>There are a few tricks to doing this, like padding the end of the mmap with sentinel characters to drive the DFA into the end state and end the loop. Or you can add a counter to bounds-check; the cpu may be able to ILP the extra instructions. </p>
<p>I once did something similar, with a trie as the DFA, and it was quite fast. There are two main factors, IMHO, which are important: low instruction count, and low branch count. If your inner loop is constantly checking if it&rsquo;s at the end of the input buffer, and checking other loop counters or termination conditions, the CPU&rsquo;s branch prediction will degrade severely. </p>
<p>You can also get into SSE instructions, and there are a few things with cache management that would probably be relevant.</p>
</div>
</li>
<li id="comment-50366" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-21T20:44:19+00:00">December 21, 2008 at 8:44 pm</time></a> </div>
<div class="comment-content">
<p>To back up my earlier assertion, I wrote and tested a simple CSV-parser. The results exactly match my assertion: an efficient CSV parser is very much I/O-bound (not CPU-bound).</p>
<p>The results and reference to the sources are at:<br/>
<a href="http://bannister.us/weblog/2008/12/21/performance-parsing-csv-data/" rel="nofollow ugc">http://bannister.us/weblog/2008/12/21/performance-parsing-csv-data/</a></p>
</div>
</li>
<li id="comment-50367" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-21T20:54:40+00:00">December 21, 2008 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets<br/>
Er, did you benchmark using memory-mapped files? Last time I did, the results I got (on both Linux and Windows) was SLOWER than simple sequential file access.</p>
<p>This makes sense.</p>
<p>Memory-mapped file access is optimized for random access. Sequential file access is optimized for sequential access. Operating systems do sneaky things under the covers to optimize sequential I/O (a VERY common case).</p>
<p>(Not the first time I&rsquo;ve run across this myth! Clearly not enough folks write benchmarks and collect measurements.)</p>
</div>
</li>
<li id="comment-50368" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-22T14:30:21+00:00">December 22, 2008 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister</p>
<p>Thank you. Maybe I will test out memory-mapped file later. For fun.</p>
<p>I think that more open discussions about these issues is important.</p>
<p>By &ldquo;open&rdquo; I mean &ldquo;with open code&rdquo;.</p>
</div>
</li>
<li id="comment-50425" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://kwillets.typepad.com/kwillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-27T20:30:35+00:00">December 27, 2008 at 8:30 pm</time></a> </div>
<div class="comment-content">
<p>Yes, the memory-mapped version was benchmarked against regular i/o and was faster at the time, 6-7 years ago. I don&rsquo;t know why either.</p>
</div>
</li>
<li id="comment-55115" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21fff55acda82926249968a2cfd08a28?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21fff55acda82926249968a2cfd08a28?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.partow.net" class="url" rel="ugc external nofollow">Arash Partow</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-25T17:56:45+00:00">March 25, 2012 at 5:56 pm</time></a> </div>
<div class="comment-content">
<p>Your code is indeed grossly inefficient. Furthermore, use of memory mapped files can actually reduce most of the I/O bound issues as processing of such files is typically a sequential task if done properly/correctly.</p>
<p>To see how it should be done correctly feel free to check out the following article: </p>
<p><a href="http://www.codeproject.com/Articles/23198/C-String-Toolkit-StrTk-Tokenizer" rel="nofollow ugc">http://www.codeproject.com/Articles/23198/C-String-Toolkit-StrTk-Tokenizer</a></p>
</div>
</li>
<li id="comment-55116" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-03-25T18:17:18+00:00">March 25, 2012 at 6:17 pm</time></a> </div>
<div class="comment-content">
<p>@Arash</p>
<p>Thanks for the link to your article.</p>
</div>
</li>
</ol>
