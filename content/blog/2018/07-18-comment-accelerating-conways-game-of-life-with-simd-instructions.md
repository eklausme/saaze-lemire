---
date: "2018-07-18 12:00:00"
title: "Accelerating Conway&#8217;s Game of Life with SIMD instructions"
index: false
---

[6 thoughts on &ldquo;Accelerating Conway&#8217;s Game of Life with SIMD instructions&rdquo;](/lemire/blog/2018/07-18-accelerating-conways-game-of-life-with-simd-instructions)

<ol class="comment-list">
<li id="comment-319092" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c8def6878fe910596c0c13112ab4b996?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Peter McNeeley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-19T01:19:04+00:00">July 19, 2018 at 1:19 am</time></a> </div>
<div class="comment-content">
<p>I wonder how lookup tables and block compression would perform in comparison to AVX. (compression as all states are probably not equally likely)</p>
</div>
</li>
<li id="comment-319229" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-19T10:48:23+00:00">July 19, 2018 at 10:48 am</time></a> </div>
<div class="comment-content">
<p>I wonder how complicated the logic of computing new cell liveness value would be using binary logic &#8211; essentially reading cell and its neighborhood in nine (interleaved) AVX registers compromising of 2304 cell values and computing 256 cell liveness updates per step using essentially circuit logic of ANDs, ORs, XORs and such.</p>
</div>
<ol class="children">
<li id="comment-319267" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-19T12:44:26+00:00">July 19, 2018 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>Unsurprisingly somebody has had a look at this already, and apparently 35 logic gates are enough for the task:</p>
<p><a href="https://www.moria.us/old/3/programs/life/" rel="nofollow">https://www.moria.us/old/3/programs/life/</a></p>
<p>Considering consecutive cells have four shared neighbors, this could be reduced to maybe 30 ANDs/ORs per round of 256 cells. (Further reductions are possible, but not really practical on circuit level.) Modern CPUs can do three such operations per clock cycle, and if register pressure doesn&rsquo;t turn out to be a problem and overhead related to edges of vectors could be handled, this ineffective-sounding approach might be almost tenfold times faster than vectorized variant in the blog post!</p>
<p>But this is a back-of-an-envelope estimate without any code written for the task.</p>
</div>
</li>
</ol>
</li>
<li id="comment-319321" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptual.com" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-07-19T16:33:39+00:00">July 19, 2018 at 4:33 pm</time></a> </div>
<div class="comment-content">
<p>Golly uses a hashlife algorithm. I&rsquo;ve been using it lately and finding it very useful. It can be astoundingly fast for some patterns.</p>
<p><a href="https://en.wikipedia.org/wiki/Golly_(program)" rel="nofollow ugc">https://en.wikipedia.org/wiki/Golly_(program)</a><br/>
<a href="http://golly.sourceforge.net/" rel="nofollow ugc">http://golly.sourceforge.net/</a><br/>
<a href="http://conwaylife.com/w/index.php?title=Golly" rel="nofollow ugc">http://conwaylife.com/w/index.php?title=Golly</a></p>
</div>
</li>
<li id="comment-553031" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02d257cd405544564222bbdf504ef4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://branchfree.org" class="url" rel="ugc external nofollow">Geoff Langdale</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-19T23:10:25+00:00">September 19, 2020 at 11:10 pm</time></a> </div>
<div class="comment-content">
<p>I would guess that representing each row as bits in a SIMD register would yield good results, especially because we can (with a little adjustment) reuse the 3&#215;1 sum 3 times (for the row above, below and the row itself).</p>
</div>
<ol class="children">
<li id="comment-652800" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90915a6a770901357b8ed37e46fc6498?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90915a6a770901357b8ed37e46fc6498?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www-personal.umich.edu/~cuiqy/" class="url" rel="ugc external nofollow">Charly C</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-06T20:01:30+00:00">July 6, 2023 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>I did just that in this gist: <a href="https://gist.github.com/CharCoding/52fb584fab2d3632fe2225880890463e" rel="nofollow ugc">https://gist.github.com/CharCoding/52fb584fab2d3632fe2225880890463e</a><br/>
It&rsquo;s a 256&#215;256 board that wraps around, and the board is printed as braille pixels.</p>
</div>
</li>
</ol>
</li>
</ol>
