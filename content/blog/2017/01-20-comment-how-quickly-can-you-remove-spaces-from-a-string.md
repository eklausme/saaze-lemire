---
date: "2017-01-20 12:00:00"
title: "How quickly can you remove spaces from a string?"
index: false
---

[40 thoughts on &ldquo;How quickly can you remove spaces from a string?&rdquo;](/lemire/blog/2017/01-20-how-quickly-can-you-remove-spaces-from-a-string)

<ol class="comment-list">
<li id="comment-267017" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/620e460c7b7fb4a356745dbb1aaa168a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/620e460c7b7fb4a356745dbb1aaa168a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-20T21:17:32+00:00">January 20, 2017 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m interested in what the benchmark is for this</p>
<p>size_t despace(char * bytes, size_t howmany) {<br/>
char* src = bytes;<br/>
char* dest = bytes;</p>
<p>for(size_t i = 0; i &lt; howmany; i++) {<br/>
char c = *src++;</p>
<p> if (c == &#039;\r&#039; || c == &#039;\n&#039; || c == &#039; &#039;) {<br/>
continue;<br/>
}<br/>
*dest++ = c;<br/>
}<br/>
return dest &#8211; bytes;<br/>
}</p>
</div>
</li>
<li id="comment-267019" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42db3b38e7ec7d5daa0813add239f16c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nathan Kurz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-20T21:36:19+00:00">January 20, 2017 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>Nice demo, but why would it be foolish to expect it to be 16x faster? Have you already lost faith in the power of magic vector dust? Relative to memcpy, what do you think the fundamental limit should be here? </p>
<p>I may be doing something wrong, and I realize it isn&rsquo;t exactly the point of your illustration, but I get about a 2x speedup if I remove the &ldquo;if (mask16 == 0)&rdquo; conditional from your code to make it branchless. </p>
<p> nate@skylake:~/git/despacer$ despacebenchmark<br/>
sse4_despace(buffer, N): 0.818359 cycles / ops<br/>
sse4_despace_branchless(buffer, N): 0.400391 cycles / ops</p>
<p>As you&rsquo;d expect, the advantage of avoiding the branchless approach grows if you increase the probability of spaces (.94 vs .40 at 2%), and decreases as spaces become rarer (.47 vs .40 at .5%). </p>
<p>I wouldn&rsquo;t assume that loop unrolling would have a significant effect here, although I also wouldn&rsquo;t assume without looking that the compiler isn&rsquo;t already doing it. </p>
<p>It&rsquo;s possible that you could get a further small boost by doing a lookup for the length to advance rather than a popcount, but I&rsquo;m not sure what the tradeoff of latency vs instruction is going to be here.</p>
</div>
<ol class="children">
<li id="comment-267023" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-20T22:04:21+00:00">January 20, 2017 at 10:04 pm</time></a> </div>
<div class="comment-content">
<p><em>Nice demo, but why would it be foolish to expect it to be 16x faster?</em></p>
<p>I prefer to be pessimistic so that I am rarely disappointed.</p>
<p><em>It&rsquo;s possible that you could get a further small boost by doing a lookup for the length to advance rather than a popcount, but I&rsquo;m not sure what the tradeoff of latency vs instruction is going to be here.</em></p>
<p>Yes. Good idea.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267020" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1616dea3a81caff5b046725f2e721ccb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1616dea3a81caff5b046725f2e721ccb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas A. Fine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-20T21:43:43+00:00">January 20, 2017 at 9:43 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;It is going to be faster as long as most blocks of eight characters do not contain any white space.&rdquo;</p>
<p>This doesn&rsquo;t seem very true for most data sets.</p>
<p>Also, I wouldn&rsquo;t spend all that effort on bitwise checks and register copies, and instead focus on your basic algorithm. You are copying every byte twice. (Unless you are relying on optimization to magically fix that, but that sort of dodges the whole point of coding faster algorithms, in my opinion.) A better approach would be to scan for the beginning and end of blocks of text, and then move the whole block with an efficient overlap-safe move operation.<br/>
I did a simple comparison in perl, and scan and move was 20-25% faster than byte-at-a-time. There will certainly be language differences that may mean you get a different result in C, but these will mostly depend on hidden optimizations that shouldn&rsquo;t matter for the purpose of finding the fastest algorithm.</p>
</div>
<ol class="children">
<li id="comment-267022" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-20T22:00:43+00:00">January 20, 2017 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p><em>You are copying every byte twice.</em></p>
<p>I am not sure what you mean? In the simple scalar code, I read each byte once, and I write most of them back.</p>
<p><em>A better approach would be to scan for the beginning and end of blocks of text, and then move the whole block with an efficient overlap-safe move operation.</em></p>
<p>I did consider an implementation based on <tt>memmove</tt>, but you will need many <tt>memmove</tt> calls in general.</p>
<p><em>I did a simple comparison in perl, and scan and move was 20-25% faster than byte-at-a-time. There will certainly be language differences that may mean you get a different result in C, but these will mostly depend on hidden optimizations that shouldn&rsquo;t matter for the purpose of finding the fastest algorithm.</em></p>
<p>I&rsquo;d very much like to see your code.</p>
</div>
<ol class="children">
<li id="comment-267631" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1616dea3a81caff5b046725f2e721ccb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1616dea3a81caff5b046725f2e721ccb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas A. Fine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T19:45:02+00:00">January 23, 2017 at 7:45 pm</time></a> </div>
<div class="comment-content">
<p>When I say you are copying every byte twice, I mean this:<br/>
char c = bytes[i];<br/>
&#8230;<br/>
bytes[pos++] = c;<br/>
Explicitly the code is copying the byte somewhere else, and then copying it back. What is actually happening after optimization may well be a different story. </p>
<p>Here&rsquo;s the perl comparison:<br/>
&#8212;-<br/>
#!/usr/bin/perl</p>
<p>$text=join(&rdquo; &ldquo;,@ARGV);</p>
<p>$howmany=length($text);</p>
<p>print &ldquo;lemire: {&ldquo;, despace_lemire($text,$howmany), &ldquo;} &ldquo;;<br/>
$t=time;<br/>
for ($n=0; $n&lt;1000000; ++$n) {<br/>
despace_lemire($text,$howmany);<br/>
}<br/>
print time-$t, &quot;\n&quot;;</p>
<p>print &quot;mine: {&quot;, despace_mine($text,$howmany), &quot;} &quot;;<br/>
$t=time;<br/>
for ($n=0; $n&lt;1000000; ++$n) {<br/>
despace_mine($text,$howmany);<br/>
}<br/>
print time-$t, &quot;\n&quot;;</p>
<p>sub despace_lemire {<br/>
my $text=shift(@_);<br/>
my $howmany=shift(@_);<br/>
my $i;<br/>
my $c;<br/>
my $pos=0;<br/>
for ($i=0; $i&lt;$howmany; ++$i) {<br/>
$c=substr($text,$i,1);<br/>
next if ($c eq &quot; &quot;);<br/>
substr($text,$pos++,1)=$c;<br/>
}<br/>
#truncate to new length (perl doesn&#039;t copy nulls)<br/>
$text=substr($text,0,$pos);<br/>
return($text);<br/>
}</p>
<p>sub despace_mine {<br/>
my $text=shift(@_);<br/>
my $howmany=shift(@_);<br/>
my $i=0;<br/>
my $c;<br/>
my $from;<br/>
my $to;</p>
<p> #skip initial non-space section<br/>
$i=0;<br/>
while(substr($text,$i,1) ne &quot; &quot;) { ++$i; }</p>
<p> $to=$i;<br/>
#skip whitespace we found<br/>
while(substr($text,$i,1) eq &quot; &quot;) { ++$i; }</p>
<p> $from=$i;<br/>
while($i= $howmany); }</p>
<p> #copy<br/>
substr($text,$to,$i-$from) = substr($text,$from,$i-$from);<br/>
$to += $i-$from;</p>
<p> #skip whitespace<br/>
while(substr($text,$i,1) eq &rdquo; &ldquo;) { last if (++$i &gt;= $howmany); }</p>
<p> $from=$i;<br/>
}<br/>
#truncate to new length (perl doesn&rsquo;t copy nulls)<br/>
$text=substr($text,0,$to);<br/>
return($text);<br/>
}</p>
</div>
<ol class="children">
<li id="comment-267665" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T22:00:01+00:00">January 23, 2017 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p><em>When I say you are copying every byte twice, I mean this:<br/>
char c = bytes[i];<br/>
â€¦<br/>
bytes[pos++] = c;<br/>
Explicitly the code is copying the byte somewhere else, and then copying it back. What is actually happening after optimization may well be a different story.<br/>
</em></p>
<p>I would argue that in C, these are semantically equivalent&#8230;<br/>
<code><br/>
char c = bytes[i];<br/>
bytes[pos] = c;<br/>
</code><br/>
and<br/>
<code><br/>
bytes[pos] = bytes[i];<br/>
</code></p>
<p>Regarding how this gets compiled&#8230; on all processors that I am familiar with, they both get compiled to two &ldquo;move&rdquo; instructions. You first have to retrieve &ldquo;bytes[i]&rdquo; to a register, then you need to write it to memory. There might be processors that support moving memory from RAM to RAM without going through a register, but I am not familiar with them.</p>
<p>There are certainly instructions (on x64 processors) that work directly on memory, without loading the data into a register (the bit test instruction one such instruction). However, it is not necessarily faster and can even be much slower. I believe that in a lot of important cases, the compiler will get it right. </p>
<p>My understanding is that there is no such instruction on ARM processors, they always need to load the data in memory. So there is a load, an operation and then a store.</p>
<p>But let us focus on x64 processors&#8230; Is there any difference between how an x64 compiler will handle<br/>
<code><br/>
const uint64_t mask = 1111;<br/>
a[0] &#038;= mask;<br/>
</code><br/>
and<br/>
<code><br/>
a[0] &#038;= 1111;<br/>
</code><br/>
??? </p>
<p>Do you have any example where it produces different machine code?</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-267029" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26d00acced4ba73e8eea8894c2323f35?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26d00acced4ba73e8eea8894c2323f35?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darrell Wright</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-20T23:20:52+00:00">January 20, 2017 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if it would be faster look at 32bits at a time. At least in english, a bulk of the words are in the 3-5 letter length or under.</p>
</div>
</li>
<li id="comment-267031" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julien</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T00:11:28+00:00">January 21, 2017 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>It seems you are not considering alignment.</p>
<p>Try the following: allocate and memory align a buffer, memcpy the string into it and then do the SIMD job on the memory aligned string.</p>
<p>(Consider how the cache works, if you try move 64 bytes starting on on address 63, then it has to read not 64 bytes but 128 bytes, so be sure to align so that the starting address of the allocated buffer is evenly divisibly by 64 &#8211; do that by over-allocating and then move the pointer appropriately)</p>
</div>
<ol class="children">
<li id="comment-267036" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T02:18:55+00:00">January 21, 2017 at 2:18 am</time></a> </div>
<div class="comment-content">
<p>Please see Data alignment for speed: myth or reality? <a href="https://lemire.me/blog/2012/05/31/data-alignment-for-speed-myth-or-reality/" rel="ugc">http://lemire.me/blog/2012/05/31/data-alignment-for-speed-myth-or-reality/</a></p>
</div>
<ol class="children">
<li id="comment-267174" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julien</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T22:29:18+00:00">January 21, 2017 at 10:29 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, interesting! </p>
<p>Not quite the improvement I thought it would be. Yet it definitely did result in an improvement on my machine (Intel(R) Core(TM) i7-3540M CPU @ 3.00GHz)</p>
<p>align to: 3<br/>
sse42_despace_branchless_lookup(buffer, N): 1.058594 cycles / ops<br/>
align to: 7<br/>
sse42_despace_branchless_lookup(buffer, N): 1.001953 cycles / ops<br/>
align to: 63<br/>
sse42_despace_branchless_lookup(buffer, N): 0.990234 cycles / ops<br/>
align to: 2<br/>
sse42_despace_branchless_lookup(buffer, N): 0.963867 cycles / ops<br/>
align to: 8<br/>
sse42_despace_branchless_lookup(buffer, N): 0.896484 cycles / ops<br/>
align to: 16<br/>
sse42_despace_branchless_lookup(buffer, N): 0.565430 cycles / ops<br/>
align to: 32<br/>
sse42_despace_branchless_lookup(buffer, N): 0.568359 cycles / ops<br/>
align to: 64<br/>
sse42_despace_branchless_lookup(buffer, N): 0.539062 cycles / ops<br/>
align to: 128<br/>
sse42_despace_branchless_lookup(buffer, N): 0.565430 cycles / ops<br/>
align to: 256<br/>
sse42_despace_branchless_lookup(buffer, N): 0.539062 cycles / ops</p>
</div>
<ol class="children">
<li id="comment-267175" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julien</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T22:30:30+00:00">January 21, 2017 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>Let me clarify that. Aligning to 64 &#8211; you are completely right. Alignment being a &ldquo;myth&rdquo; &#8211; not so much, at least on my machine.</p>
</div>
<ol class="children">
<li id="comment-267196" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy O'Neal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-22T06:31:55+00:00">January 22, 2017 at 6:31 am</time></a> </div>
<div class="comment-content">
<p>Note that this answer will depend on the chip you use for testing. When I implemented a similar algorithm for UTF-8 to UTF-16 transformation, doing extra work to align things was moderately better on Haswell-E (Xeon E5-1650v3), but was no gain on Skylake-T (Core i7 6700T). In general, the newer chips seem to deal with unaligned access better than older ones.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267582" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T15:52:06+00:00">January 23, 2017 at 3:52 pm</time></a> </div>
<div class="comment-content">
<p>I modified my benchmark so that you can add an alignment offset&#8230;</p>
<p>Results on my Skylake server&#8230;</p>
<pre>
$ ./despacebenchmark
pointer alignment = 16 bytes
memcpy(tmpbuffer,buffer,N):  0.109375 cycles / ops
countspaces(buffer, N):  3.673828 cycles / ops
despace(buffer, N):  5.578125 cycles / ops
faster_despace(buffer, N):  1.740234 cycles / ops
despace64(buffer, N):  2.542969 cycles / ops
despace_to(buffer, N, tmpbuffer):  5.585938 cycles / ops
avx2_countspaces(buffer, N):  0.365234 cycles / ops
avx2_despace(buffer, N):  3.593750 cycles / ops
sse4_despace(buffer, N):  0.816406 cycles / ops
sse4_despace_branchless(buffer, N):  0.386719 cycles / ops
sse4_despace_trail(buffer, N):  1.539062 cycles / ops
sse42_despace_branchless(buffer, N):  0.603516 cycles / ops
sse42_despace_branchless_lookup(buffer, N):  0.675781 cycles / ops
sse42_despace_to(buffer, N,tmpbuffer):  1.707031 cycles / ops

$ ./despacebenchmark  1
alignment offset = 1
pointer alignment = 1 bytes
memcpy(tmpbuffer,buffer,N):  0.109375 cycles / ops
countspaces(buffer, N):  3.675781 cycles / ops
despace(buffer, N):  5.576172 cycles / ops
faster_despace(buffer, N):  1.693359 cycles / ops
despace64(buffer, N):  2.589844 cycles / ops
despace_to(buffer, N, tmpbuffer):  5.492188 cycles / ops
avx2_countspaces(buffer, N):  0.373047 cycles / ops
avx2_despace(buffer, N):  3.535156 cycles / ops
sse4_despace(buffer, N):  0.841797 cycles / ops
sse4_despace_branchless(buffer, N):  0.398438 cycles / ops
sse4_despace_trail(buffer, N):  1.599609 cycles / ops
sse42_despace_branchless(buffer, N):  0.605469 cycles / ops
sse42_despace_branchless_lookup(buffer, N):  0.679688 cycles / ops
sse42_despace_to(buffer, N,tmpbuffer):  1.718750 cycles / ops

$ ./despacebenchmark  4
alignment offset = 4
pointer alignment = 4 bytes
memcpy(tmpbuffer,buffer,N):  0.109375 cycles / ops
countspaces(buffer, N):  3.679688 cycles / ops
despace(buffer, N):  5.630859 cycles / ops
faster_despace(buffer, N):  1.685547 cycles / ops
despace64(buffer, N):  2.562500 cycles / ops
despace_to(buffer, N, tmpbuffer):  5.523438 cycles / ops
avx2_countspaces(buffer, N):  0.373047 cycles / ops
avx2_despace(buffer, N):  3.603516 cycles / ops
sse4_despace(buffer, N):  0.843750 cycles / ops
sse4_despace_branchless(buffer, N):  0.400391 cycles / ops
sse4_despace_trail(buffer, N):  1.552734 cycles / ops
sse42_despace_branchless(buffer, N):  0.603516 cycles / ops
sse42_despace_branchless_lookup(buffer, N):  0.681641 cycles / ops
sse42_despace_to(buffer, N,tmpbuffer):  1.681641 cycles / ops
</pre>
<p>Results on a much older Ivy Bridge (like yours):</p>
<pre>
$ ./despacebenchmark
pointer alignment = 16 bytes
memcpy(tmpbuffer,buffer,N):  0.339844 cycles / ops
countspaces(buffer, N):  14.519531 cycles / ops
despace(buffer, N):  12.612305 cycles / ops
faster_despace(buffer, N):  7.248047 cycles / ops
despace64(buffer, N):  10.275391 cycles / ops
despace_to(buffer, N, tmpbuffer):  11.271484 cycles / ops
sse4_despace(buffer, N):  2.039062 cycles / ops
sse4_despace_branchless(buffer, N):  1.081055 cycles / ops
sse4_despace_trail(buffer, N):  4.904297 cycles / ops
sse42_despace_branchless(buffer, N):  1.511719 cycles / ops
sse42_despace_branchless_lookup(buffer, N):  1.554688 cycles / ops
sse42_despace_to(buffer, N,tmpbuffer):  3.882812 cycles / ops

$ ./despacebenchmark 1
alignment offset = 1
pointer alignment = 1 bytes
memcpy(tmpbuffer,buffer,N):  0.339844 cycles / ops
countspaces(buffer, N):  13.337891 cycles / ops
despace(buffer, N):  12.699219 cycles / ops
faster_despace(buffer, N):  7.292969 cycles / ops
despace64(buffer, N):  10.285156 cycles / ops
despace_to(buffer, N, tmpbuffer):  11.269531 cycles / ops
sse4_despace(buffer, N):  2.214844 cycles / ops
sse4_despace_branchless(buffer, N):  1.749023 cycles / ops
sse4_despace_trail(buffer, N):  5.027344 cycles / ops
sse42_despace_branchless(buffer, N):  2.109375 cycles / ops
sse42_despace_branchless_lookup(buffer, N):  2.187500 cycles / ops
sse42_despace_to(buffer, N,tmpbuffer):  3.890625 cycles / ops

$ ./despacebenchmark 4
alignment offset = 4
pointer alignment = 4 bytes
memcpy(tmpbuffer,buffer,N):  0.339844 cycles / ops
countspaces(buffer, N):  14.507812 cycles / ops
despace(buffer, N):  12.699219 cycles / ops
faster_despace(buffer, N):  7.214844 cycles / ops
despace64(buffer, N):  10.214844 cycles / ops
despace_to(buffer, N, tmpbuffer):  11.289062 cycles / ops
sse4_despace(buffer, N):  2.162109 cycles / ops
sse4_despace_branchless(buffer, N):  1.757812 cycles / ops
sse4_despace_trail(buffer, N):  5.044922 cycles / ops
sse42_despace_branchless(buffer, N):  2.109375 cycles / ops
sse42_despace_branchless_lookup(buffer, N):  2.302734 cycles / ops
sse42_despace_to(buffer, N,tmpbuffer):  3.875000 cycles / ops
</pre>
<p>There are ways to trigger performance issues due to alignment on recent x64 processors, but you almost have to go out of your way to do it.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-267033" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/19bd38aaab3d54b9ef607ff8a197c571?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Julien</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T00:17:17+00:00">January 21, 2017 at 12:17 am</time></a> </div>
<div class="comment-content">
<p>It seems you are not memory aligning your buffers.</p>
<p>Memory align a temporary buffer that you memcpy the input string to. After that do the operation on the temporary buffer.</p>
<p>(Consider doing a 64 byte move starting on address 63. The CPU would have to read/write not 64 bytes but 2&#215;64 bytes &#8211; since the address was not aligned.).</p>
</div>
</li>
<li id="comment-267039" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cb625caef7e6c44ef90e4241d57720d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cb625caef7e6c44ef90e4241d57720d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T02:55:34+00:00">January 21, 2017 at 2:55 am</time></a> </div>
<div class="comment-content">
<p>Interesting.<br/>
I run a despace program on a GTX 1080 :<br/>
<a href="https://gist.github.com/antonmks/17e0c711d41fb07d1b6f3ada3f5f29ee" rel="nofollow ugc">https://gist.github.com/antonmks/17e0c711d41fb07d1b6f3ada3f5f29ee</a></p>
<p>Seems like the gpu can do around 0.25 cycles/byte which is better than SIMD code but not quite as good as memcpy.<br/>
The code also looks simpler than SIMD code.</p>
</div>
</li>
<li id="comment-267060" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7de465f222e6a9c7fe658e370d0bfe05?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7de465f222e6a9c7fe658e370d0bfe05?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paolo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T08:02:40+00:00">January 21, 2017 at 8:02 am</time></a> </div>
<div class="comment-content">
<p>In the naive implementation you copy even the bytes before the first space. They don&rsquo;t need to be copied because they&rsquo;re already there. Two loops could make it faster.</p>
</div>
<ol class="children">
<li id="comment-267656" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T21:36:25+00:00">January 23, 2017 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>@Paolo</p>
<p>Can you write a faster version?</p>
</div>
</li>
</ol>
</li>
<li id="comment-267112" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a68589ff15ebe10584313515a74fca3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a68589ff15ebe10584313515a74fca3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">exDM69</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T15:31:47+00:00">January 21, 2017 at 3:31 pm</time></a> </div>
<div class="comment-content">
<p>This is a completely memory bound problem and the &ldquo;fast&rdquo; version is not much faster (about 5%) when measured in wall clock time. Using rdtsc to measure CPU perf counters does not take waiting into account.</p>
<p>The biggest positive benefit of writing code like this (good CPU use in a memory bound problem) is giving the CPU an opportunity to do some hyperthreading while the current CPU thread is waiting for memory.</p>
<p>I wrote some more insights from my experiences in similar optimization tasks over at HN: <a href="https://news.ycombinator.com/item?id=13450245" rel="nofollow ugc">https://news.ycombinator.com/item?id=13450245</a></p>
<p>I added wall clock time measuring with clock_gettime <a href="http://pasteall.org/208511" rel="nofollow ugc">http://pasteall.org/208511</a></p>
<p>Here are the results:</p>
<p>memcpy(tmpbuffer,buffer,N): 0.125130 cycles / ops 1451124749 nsec (1.451125 sec)<br/>
countspaces(buffer, N): 3.710938 cycles / ops 1672809379 nsec (1.672809 sec)<br/>
despace(buffer, N): 6.603971 cycles / ops 1606222818 nsec (1.606223 sec)<br/>
faster_despace(buffer, N): 1.688668 cycles / ops 1547048647 nsec (1.547049 sec)<br/>
despace64(buffer, N): 3.590088 cycles / ops 1602308741 nsec (1.602309 sec)<br/>
despace_to(buffer, N, tmpbuffer): 6.306158 cycles / ops 1630737083 nsec (1.630737 sec)<br/>
avx2_countspaces(buffer, N): 0.191219 cycles / ops 1442104811 nsec (1.442105 sec)<br/>
avx2_despace(buffer, N): 5.754352 cycles / ops 1579367806 nsec (1.579368 sec)<br/>
sse4_despace(buffer, N): 0.984717 cycles / ops 1486145973 nsec (1.486146 sec)<br/>
sse4_despace_branchless(buffer, N): 0.339487 cycles / ops 1498728832 nsec (1.498729 sec)<br/>
sse4_despace_trail(buffer, N): 1.958952 cycles / ops 1479234359 nsec (1.479234 sec)<br/>
sse42_despace_branchless(buffer, N): 0.563217 cycles / ops 1534317675 nsec (1.534318 sec)<br/>
sse42_despace_branchless_lookup(buffer, N): 0.624996 cycles / ops 1563285415 nsec (1.563285 sec)<br/>
sse42_despace_to(buffer, N,tmpbuffer): 1.747602 cycles / ops 1525936772 nsec (1.525937 sec)</p>
</div>
<ol class="children">
<li id="comment-267586" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T16:01:15+00:00">January 23, 2017 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p><em>This is a completely memory bound problem and the â€œfastâ€ version is not much faster (about 5%) when measured in wall clock time. Using rdtsc to measure CPU perf counters does not take waiting into account.</em></p>
<p>On recent Intel processors, <tt>rdtsc</tt> measures the wall-clock time though maybe more accurately due to low overhead.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267118" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6d1c46e2968a7674186b73b819dbca4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6d1c46e2968a7674186b73b819dbca4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://alfps.wordpress.com" class="url" rel="ugc external nofollow">Alf P. Steinbach</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T16:22:16+00:00">January 21, 2017 at 4:22 pm</time></a> </div>
<div class="comment-content">
<p>Assuming this is using the built-in <code>^</code> operator, the condition <code>haszero(xor1) ^ haszero(xor2) ^ haszero(xor3))</code> is true if and only if an odd number of the function results are true.</p>
<p>Re the hard-to-explain zero checking expression, I think a reasonably short &amp; simple way to explain it is to note that for each byte it checks whether that byte was non-negative, and became negative (sign bit set) by the subtraction of 1.</p>
</div>
<ol class="children">
<li id="comment-267583" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T15:55:37+00:00">January 23, 2017 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p><em>Assuming this is using the built-in ^ operator, the condition haszero(xor1) ^ haszero(xor2) ^ haszero(xor3)) is true if and only if an odd number of the function results are true.</em></p>
<p>Thanks, I fixed that. It does not impact performance. In this case, my code passed sanity tests because of the statistics of my test.</p>
<p><em>Re the hard-to-explain zero checking expression, I think a reasonably short &#038; simple way to explain it is to note that for each byte it checks whether that byte was non-negative, and became negative (sign bit set) by the subtraction of 1.</em></p>
<p>This makes sense. I didn&rsquo;t want to bother with an explanation in the course of my blog post because *why* it works is not so important.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267125" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72af716fb5a42b473c0d9df9b16815d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72af716fb5a42b473c0d9df9b16815d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex N</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T17:20:50+00:00">January 21, 2017 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not at a proper computer atm. Can you try</p>
<p>1. Load 8bytes into xmm.<br/>
2. Compare for equality with spaces, etc.<br/>
3. Move the mask to a general purpose register.<br/>
4. Negate bits in that register.<br/>
5. Copy selected bits with PEXT (from bmi2 set) instruction.<br/>
6. Use POPCNT to advance a pointer.</p>
<p>Thanks,<br/>
Alex</p>
</div>
<ol class="children">
<li id="comment-267735" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T03:11:47+00:00">January 24, 2017 at 3:11 am</time></a> </div>
<div class="comment-content">
<p>Using PEXT is interesting. We have 16 bytes to deal with. PEXT only operates on 8 bytes. So we need two, with two pointer offsets. It might be fast, but it is not obviously faster than a SIMD-based approach, I think.</p>
</div>
<ol class="children">
<li id="comment-267840" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72af716fb5a42b473c0d9df9b16815d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72af716fb5a42b473c0d9df9b16815d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex N</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T11:48:20+00:00">January 24, 2017 at 11:48 am</time></a> </div>
<div class="comment-content">
<p>One advantage of PEXT approach is that it doesn&rsquo;t use a table.</p>
<p>Alex</p>
</div>
<ol class="children">
<li id="comment-267858" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T13:51:33+00:00">January 24, 2017 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>@Alex PEXT require: a mask, you either generate it on the fly or you look it up. I think you envision generating it on the fly&#8230; I&rsquo;d be interested in the approach you&rsquo;d take.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-267137" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T19:44:16+00:00">January 21, 2017 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>What is the performance of a simple sorting network<br/>
using SIMD?</p>
<p>Would it be better to define the problem as &ldquo;shift all the whitespace to side of the vector&rdquo;?</p>
</div>
<ol class="children">
<li id="comment-267569" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T14:57:07+00:00">January 23, 2017 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>I am not sure which algorithm you have in mind. Sorting networks can be implemented just fine using SIMD, but I am not sure it helps for this problem.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267158" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/916f1c4bb516679ba03109e07fdf2c0a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/916f1c4bb516679ba03109e07fdf2c0a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://stackoverflow.com/users/153285/potatoswatter" class="url" rel="ugc external nofollow">David Krauss "Potatoswatter"</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-21T20:51:45+00:00">January 21, 2017 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>There&rsquo;s an error in `_mm_loadu_si128(despace_mask16 + mask16)` which has been fixed in the repo. Please update the blog post; this threw me for a loop.</p>
<p>To define a proper `__m128i` array, use the `_mm_set_epi8` macro which expands to a suitable constant initializer.</p>
<p>Anyway, that table is huge, 256 KiB. It would probably be faster if split into two 256-entry tables, totaling 8 KiB which would fit into L1 cache.</p>
</div>
<ol class="children">
<li id="comment-267568" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T14:55:38+00:00">January 23, 2017 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p><em>There&rsquo;s an error in `_mm_loadu_si128(despace_mask16 + mask16)` which has been fixed in the repo. Please update the blog post; this threw me for a loop.</em></p>
<p>I don&rsquo;t think that there is an error, if there is, please point it out more precisely. In the blog post, I omit the cast which is present in the GitHub repository, but it is a technical detail that despace_mask16 is not of type __m128i * (that is, you can rewrite the code so that it is).</p>
<p><em>To define a proper `__m128i` array, use the `_mm_set_epi8` macro which expands to a suitable constant initializer.</em></p>
<p>In C, _mm_set_epi8 is not a compile-time constant so you cannot do &ldquo;__m128i array[] = {_mm_set1_epi8(0)};&rdquo;. You must be thinking of C++.</p>
<p><em>It would probably be faster if split into two 256-entry tables, totaling 8 KiB which would fit into L1 cache.</em></p>
<p>I think that the table is 1MB.</p>
</div>
</li>
<li id="comment-267734" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T03:07:19+00:00">January 24, 2017 at 3:07 am</time></a> </div>
<div class="comment-content">
<p><em>Anyway, that table is huge. It would probably be faster if split into two 256-entry tables, totaling 8 KiB which would fit into L1 cache.</em></p>
<p>Please see the GitHub repository, function sse4_despace_branchless_mask8. It is a tad slower. There is an extra load, an extra mask, an extra shift and and an extra XOR. All of these things appear to add up.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267197" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy O'Neal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-22T06:35:56+00:00">January 22, 2017 at 6:35 am</time></a> </div>
<div class="comment-content">
<p>What is / can you explain `despace_mask16`? I don&rsquo;t understand the bit twiddling hack going on here to give the right constant to the shuffle unit.</p>
</div>
<ol class="children">
<li id="comment-267575" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T15:08:01+00:00">January 23, 2017 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>@Billy</p>
<p><em>What is / can you explain `despace_mask16`?</em></p>
<p>We are using the _mm_shuffle_epi8 intrinsic to move the bytes around so that flagged characters are omitted. This intrinsic takes an input register &ldquo;a&rdquo; as well as a control mask &ldquo;b&rdquo; and it outputs a new vector<br/>
(a[b[0]], a[b[1]], a[b[2]], a[b[3]], &#8230;). Computing the mask &ldquo;b&rdquo; on the fly is hard given the locations of the characters, so we use a look-up table.</p>
<p>It is not pretty.</p>
</div>
<ol class="children">
<li id="comment-267711" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e41f852c5c471370a0d08ba8dc1c032?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy O'Neal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T01:18:19+00:00">January 24, 2017 at 1:18 am</time></a> </div>
<div class="comment-content">
<p>&gt;so we use a look-up table</p>
<p>Derp on my part &#8212; for some reason I read that initially as supplying that constant to _mm_shuffle_epi8 &#8212; I missed the load instruction. Lookup table makes sense, thanks!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-267246" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f28740cd72d1faa5b8f64376f0c6af9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f28740cd72d1faa5b8f64376f0c6af9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eric</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-22T14:07:54+00:00">January 22, 2017 at 2:07 pm</time></a> </div>
<div class="comment-content">
<p>Where did `despace_mask16` come from there? Surely that&rsquo;s not an intel builtin!</p>
</div>
<ol class="children">
<li id="comment-267565" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-23T14:43:03+00:00">January 23, 2017 at 2:43 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t give the full code within the blog post, you can find it on GitHub:</p>
<p><a href="https://github.com/lemire/despacer" rel="nofollow ugc">https://github.com/lemire/despacer</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-267731" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4fc8ad7a00862343c3896f6cf9d0fb87?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4fc8ad7a00862343c3896f6cf9d0fb87?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brad Daniels</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T02:43:30+00:00">January 24, 2017 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>It looks to me like the SIMD code won&rsquo;t copy the last few bytes if the size is not a multiple of 16. Am I missing something?</p>
</div>
<ol class="children">
<li id="comment-267733" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T03:04:38+00:00">January 24, 2017 at 3:04 am</time></a> </div>
<div class="comment-content">
<p>In my blog post, I provide only the gist of the code, please see the GitHub repo for actual working code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-267910" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cd542688e1cc772ba34c68880800e2d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cd542688e1cc772ba34c68880800e2d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://stegua.github.io/" class="url" rel="ugc external nofollow">Stefano Gualandi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-01-24T17:41:23+00:00">January 24, 2017 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, this is a pretty nice post. I used your examples to see the impact of mispredicted branches in Python (*): I somehow was surprised of their impact on this short piece of code. Thanks again!</p>
<p>(*) Here the link to my python notebook:<br/>
<a href="https://github.com/stegua/MyBlogEntries/blob/master/Remove%2Bblanks%2Bfrom%2Ba%2Bstring.ipynb" rel="nofollow ugc">https://github.com/stegua/MyBlogEntries/blob/master/Remove%2Bblanks%2Bfrom%2Ba%2Bstring.ipynb</a></p>
</div>
</li>
<li id="comment-283952" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69cd67be8a9d422ba1f57a4c376a9a66?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69cd67be8a9d422ba1f57a4c376a9a66?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-05T17:18:39+00:00">August 5, 2017 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>I am stating the obvious, but &ldquo;Leffmann&rdquo; approach is not doing the same thing as the original.</p>
<p>It depends on an unseen pre-processing stage that correctly fills an array with 1s and 0s. I expect that in practice it will in fact be slower when this stage is also accounted for.</p>
</div>
</li>
</ol>
