---
date: "2008-12-08 12:00:00"
title: "Parsing text files is CPU bound"
index: false
---

[9 thoughts on &ldquo;Parsing text files is CPU bound&rdquo;](/lemire/blog/2008/12-08-parsing-text-files-is-cpu-bound)

<ol class="comment-list">
<li id="comment-50338" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-08T18:21:05+00:00">December 8, 2008 at 6:21 pm</time></a> </div>
<div class="comment-content">
<p>@KWillets</p>
<p><i> Compression isn&rsquo;t just for I/O bandwidth. </i></p>
<p>I agree.</p>
<p><i> Getting optimally-sized operands is also a benefit, although I haven&rsquo;t seen it researched much.</i></p>
<p>Compression can be used to diminish the number of CPU cycles used. Definitively.</p>
<p><i> If you change the question from &ldquo;what is the minimum number of bits needed to store this data&rdquo; to &ldquo;what is the minimum number of bits needed to construct the output&rdquo;, eg a join or intersection, etc., it becomes more interesting.</i></p>
<p>The minimum size of the output is used a lower bound on the complexity of the problem in algorithmic design. So, it can be used to show that you have an optimal algorithm.</p>
</div>
</li>
<li id="comment-50340" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-08T22:15:28+00:00">December 8, 2008 at 10:15 pm</time></a> </div>
<div class="comment-content">
<p>@Bannister </p>
<p><i>How big was your input file?</i></p>
<p>Several GiBs. I work with large files.</p>
<p><i> You should be running any benchmark more than once to get consistent times. The input file must be bigger than memory so that it is not cached in memory by the operating system.</i></p>
<p>This is a &ldquo;top -o cpu&rdquo; command on another process while the program is running.</p>
<p>My observations are not meant to be scientific, but I can tell you that optimizing my CSV parsing code helped quite a bit speed it up. Had the process been &ldquo;very I/O bound&rdquo;, optimizing the code would not have mattered. My code is somewhere on google code (it is open source).</p>
<p><i> Unless you have an insanely fast disk subsystem (not something you find in usual desktops), reading anything as simple as CSV files should be very I/O-bound, and not CPU-bound.</i></p>
<p>It should. Shouldn&rsquo;t it?</p>
<p>I made a blog post out of it because I find all of this puzzling. I&rsquo;d be glad to see someone do a follow-up analysis. Maybe someone could prove me wrong? I&rsquo;d like that.</p>
</div>
</li>
<li id="comment-50337" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://kwillets.typepad.com/kwillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-08T17:16:53+00:00">December 8, 2008 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>Compression isn&rsquo;t just for I/O bandwidth. Getting optimally-sized operands is also a benefit, although I haven&rsquo;t seen it researched much. </p>
<p>If you change the question from &ldquo;what is the minimum number of bits needed to store this data&rdquo; to &ldquo;what is the minimum number of bits needed to construct the output&rdquo;, eg a join or intersection, etc., it becomes more interesting.</p>
</div>
</li>
<li id="comment-50339" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-08T21:21:36+00:00">December 8, 2008 at 9:21 pm</time></a> </div>
<div class="comment-content">
<p>How big was your input file?</p>
<p>You should be running any benchmark more than once to get consistent times. The input file must be bigger than memory so that it is not cached in memory by the operating system. </p>
<p>Unless you have an insanely fast disk subsystem (not something you find in usual desktops), reading anything as simple as CSV files should be very I/O-bound, and not CPU-bound.</p>
</div>
</li>
<li id="comment-50343" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21c056bb0ef73d4f7d6b3118f642edfe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21c056bb0ef73d4f7d6b3118f642edfe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.agiledelta.com" class="url" rel="ugc external nofollow">John Schneider</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-09T13:18:56+00:00">December 9, 2008 at 1:18 pm</time></a> </div>
<div class="comment-content">
<p>Actually, the binary XML people stress both compactness and processing efficiency. Some of the binary XML use cases are CPU bound because they have fast networks that are not congested. Others are I/O bound because they have slow, wireless, or congested networks.</p>
<p>The EXI evaluation document you referenced is an early draft that does not yet include processing efficiency measurements. The next draft will include these measurements. In the mean time, see <a href="http://www.w3.org/TR/exi-measurements/" rel="nofollow">http://www.w3.org/TR/exi-measurements/</a> for a complete collection of binary XML compactness and processing efficiency measurements, including some taken over high-speed and wireless networks. </p>
<p>Also, see <a href="http://www.agiledelta.com/efx_perffeatures.html" rel="nofollow">http://www.agiledelta.com/efx_perffeatures.html</a> for compactness and processing speed measurements from a commercial EXI implementation.</p>
<p> All the best,</p>
<p> John</p>
</div>
</li>
<li id="comment-50344" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://kwillets.typepad.com/kwillets/" class="url" rel="ugc external nofollow">KWillets</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-10T15:31:04+00:00">December 10, 2008 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t find the code.</p>
</div>
</li>
<li id="comment-50346" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c77895219d69cffc5a5ad3b34e60cdb7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c77895219d69cffc5a5ad3b34e60cdb7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ibridge.be" class="url" rel="ugc external nofollow">Matt</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-10T16:48:22+00:00">December 10, 2008 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p><i>Unless you have an insanely fast disk subsystem (not something you find in usual desktops), reading anything as simple as CSV files should be very I/O-bound, and not CPU-bound.</i></p>
<p>Please refrain from using words such as &ldquo;insanely&rdquo; 🙂 Let&rsquo;s put a number on it shall we. Suppose we would have one of these new SSD drives doing 200MB/s.<br/>
On a 2GHz CPU you would have 10 cycles to process a single byte of data. That is not very much considering the fact that with those 10 cycles you need to handle String encoding (UTF-8, etc, etc), Integer, Number, Date and Boolean encoding.</p>
<p>Looking at these numbers you see WHY reading CSV files is nearly always CPU-bound for high end storage sub-systems.</p>
</div>
</li>
<li id="comment-50347" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-12T15:10:33+00:00">December 12, 2008 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>Matt, you will find I am very intentional in my use of language. 🙂</p>
<p>What is the definition of sanity? Sanity is defined relative to what most people do most of the time. (Which might seem a bit odd &#8211; but that is another discussion.) </p>
<p>When coming up with a solution, you have to make &ldquo;sane&rdquo; assumptions about the design space. You cannot assume unlikely resources (at least not usually). You have to assume what most of target hardware will have, most of the time.</p>
<p>If we are interested in the performance of parsing large files, that would be because we *have* large files. Most likely we have a series of very large files, generated as a part of some repeating process. (Otherwise the problem becomes uninteresting.)</p>
<p>Combine the above two considerations, with the cost of SSD storage, and you have an awkward fit. Also, after poking around a bit on the web, it looks as though the *sustained* read rates for SSD is currently around 40-100MB/s. (We are not interested in burst rates.)</p>
<p>Yes, there have always been high-end (and expensive!) storage systems that deliver much higher than average performance. If you are designing a solution for a general population of machines, then it would be insane to assume performance present in only a very small minority.</p>
<p>So the use of &ldquo;insanely fast&rdquo; can carry exactly the right freight when talking about a design. 🙂</p>
</div>
</li>
<li id="comment-50353" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1929e825d23809b2171daa95ed49395b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1929e825d23809b2171daa95ed49395b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Steven</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-12-18T04:54:50+00:00">December 18, 2008 at 4:54 am</time></a> </div>
<div class="comment-content">
<p>If I had to wager a guess, I&rsquo;d say that all the memory management for storing the results are to blame &#8211; malloc()/free() are notoriously slow, so calling them the hundreds of millions of times a multi-gigabyte file requires is very likely the problem. Try using a static structure for output, or else just discard the output entirely (still computing it of course), and see what happens.</p>
</div>
</li>
</ol>
