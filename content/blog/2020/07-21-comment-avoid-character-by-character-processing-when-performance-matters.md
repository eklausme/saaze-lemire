---
date: "2020-07-21 12:00:00"
title: "Avoid character-by-character processing when performance matters"
index: false
---

[20 thoughts on &ldquo;Avoid character-by-character processing when performance matters&rdquo;](/lemire/blog/2020/07-21-avoid-character-by-character-processing-when-performance-matters)

<ol class="comment-list">
<li id="comment-542128" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d5a9eea420f1299a02e249ae7629096?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d5a9eea420f1299a02e249ae7629096?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marcin Buchwald</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-23T11:12:35+00:00">July 23, 2020 at 11:12 am</time></a> </div>
<div class="comment-content">
<p>Can eliminate the second loop. Check if i &gt; 0 and if so, slice last 8 bytes and or-them to the result</p>
</div>
<ol class="children">
<li id="comment-542299" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-23T12:41:15+00:00">July 23, 2020 at 12:41 pm</time></a> </div>
<div class="comment-content">
<p>Care to share your code for the &ldquo;slice last 8 bytes&rdquo; part?</p>
</div>
<ol class="children">
<li id="comment-544845" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/738f2596f67163d53976ab6cfb4fc41b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/738f2596f67163d53976ab6cfb4fc41b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Guillaume Matte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T03:03:37+00:00">July 25, 2020 at 3:03 am</time></a> </div>
<div class="comment-content">
<p>For the left-over string (smaller than 8 characters but greater than 0) still do a memcpy of into a zeroed 64 bits unsigned integer just use v.size() as the length parameter. Your check against the 64-bits mask should still be right as the memcpy won&rsquo;t touch the zeroed bits of the payload that are outside of the length.</p>
</div>
<ol class="children">
<li id="comment-544999" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T18:24:13+00:00">July 25, 2020 at 6:24 pm</time></a> </div>
<div class="comment-content">
<p>A variable length <code>memcpy</code> isn&rsquo;t much better than this short loop and internally may use a loop or some sort of indirect branch dispatching to a copy routine specialized for the length.</p>
<p>I think a better approach, if you expect the total input length to usually be at least 8, is to do a final length 8 memcpy, but aligned to the end of the string. If the length of the string wasn&rsquo;t a multiple of 8, this checks some characters &ldquo;twice&rdquo; but this check is very fast in any case.</p>
<p>With this change you can also change the primary loop condition to <code>i + 8 &lt; v.size()</code> since the final 1 to 8 bytes can be handled by this last check, and you&rsquo;d rather do it unconditionally (at least for the <code>v.size() &gt;= case</code>) to avoid an extra branch misprediction.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-544421" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b20296b82fa8089e41a281435b8dcb26?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b20296b82fa8089e41a281435b8dcb26?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stuart Dootson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-24T11:57:11+00:00">July 24, 2020 at 11:57 am</time></a> </div>
<div class="comment-content">
<p>Something like this, I&rsquo;d presume&#8230;</p>
<p><code>if (v.size() &gt; 8) {<br/>
memcpy(&amp;payload, v.data() + v.size() - 8, 8);<br/>
running |= payload;<br/>
}<br/>
</code></p>
<p>But then you&rsquo;re still left with cases where <code>v.size() &lt; 8</code>, where you&rsquo;d need the second loop anyway&#8230;</p>
</div>
<ol class="children">
<li id="comment-544510" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a8c938c5a834e683a45a40db9b8d6663?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a8c938c5a834e683a45a40db9b8d6663?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick Everitt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-24T13:35:57+00:00">July 24, 2020 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p>I wonder if it would be an improvement to switch on the number of remaining characters rather than use a second loop (assuming that string length is evenly distributed).</p>
</div>
<ol class="children">
<li id="comment-545000" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T18:28:24+00:00">July 25, 2020 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>The way Stuart suggests I think is almost strictly better than the loop or the switch: both involve an unpredictable branch for unpredictable sizes. Between the two, the switch is probably somewhat faster at the cost of larger code size.</p>
<p>Stuart&rsquo;s approach only involves an unpredictable branch in the case the size varies between less than 8 and greater than 8 unpredictably, which seems much rarer and as a binary predicate would be somewhat predictable in almost any non-contrived case. If you really want to get rid of this final source of unpredictability, you can use a masked load.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-544851" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba4eaf494e65fbe6abc25233bb76b1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba4eaf494e65fbe6abc25233bb76b1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dr. Guy Gordon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T03:37:39+00:00">July 25, 2020 at 3:37 am</time></a> </div>
<div class="comment-content">
<p>After each check for ASCII, double the number of reads before the next check.</p>
</div>
</li>
<li id="comment-544873" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa028cdc19589078e49959d1f9b9b7b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa028cdc19589078e49959d1f9b9b7b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T05:45:38+00:00">July 25, 2020 at 5:45 am</time></a> </div>
<div class="comment-content">
<p>This is a fun exercise, but does this ever occur in real life? I can&rsquo;t say I&rsquo;ve ever needed to test a large block of arbitrary bytes to determine if they were ASCII.</p>
</div>
<ol class="children">
<li id="comment-544978" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T15:51:59+00:00">July 25, 2020 at 3:51 pm</time></a> </div>
<div class="comment-content">
<p>This blog post was motivated by an actual programming problem that someone encountered, while trying to optimize some code.</p>
</div>
</li>
<li id="comment-545030" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9814828bd8d94a47c12461f364baaa82?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9814828bd8d94a47c12461f364baaa82?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://robiii.me" class="url" rel="ugc external nofollow">RobIII</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T22:30:21+00:00">July 25, 2020 at 10:30 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I can’t say I’ve ever needed to test a large block of arbitrary bytes to determine if they were ASCII.
</p></blockquote>
<p>I have. I do / did on <a href="http://forum.geonames.org/gforum/posts/list/9902.page" rel="nofollow ugc">a regular basis</a>. You could consider it a &lsquo;large block of arbitrary bytes&rsquo; but also lots and lots of small block (strings) of arbitrary bytes. They promise some field <em>should</em> be ASCII (it&rsquo;s actually called &ldquo;AsciiName&rdquo;) for old(er) systems that don&rsquo;t support anything else but ASCII but non-ASCII values keep returning in their exports. Up to this day. Exactly why I based my <a href="https://github.com/RobThree/Ascii-Benchmark" rel="nofollow ugc">.Net Benchmarks</a> based on this post on that exact data.</p>
</div>
<ol class="children">
<li id="comment-545764" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07f2a57fc1bf6585bc68ec07d954e1d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07f2a57fc1bf6585bc68ec07d954e1d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-27T23:14:39+00:00">July 27, 2020 at 11:14 pm</time></a> </div>
<div class="comment-content">
<p>It sounds like the real problem you&rsquo;re facing is that you&rsquo;re trying to maintain a &lsquo;database&rsquo; which has no schema enforcement (giant binary file) and no access control (unknown users can edit it at any time).</p>
<p>Given those circumstances, writing a program to parse hundreds of megabytes to check for the high-bit being set can never be a complete or reliable solution. (No matter how fast you can check it, there will always be a race condition, as you note.) Wouldn&rsquo;t a better solution be to create an interface to this data which enforced the desired schema during edits? You only need to check the diffs.</p>
<p>No other system I use &#8212; and certainly none which cares about performance or security &#8212; uses the approach of letting anyone make arbitrary edits to raw data at any time, and then trying to verify the entire database after the fact. I don&rsquo;t run a script every night to make sure all my JPEGs are still JPEGs, and an unknown user didn&rsquo;t log in and put bogus data in them. The closest I can think of is Wikipedia, and even they don&rsquo;t analyze hundreds of megabytes on every edit.</p>
<p>I&rsquo;d say: &ldquo;Avoid doing O(n) work unnecessarily when performance matters&rdquo;. You can justify all sorts of craziness if you begin by using the wrong data structure. Unfixable legacy system designs are one possible use of this, true, but I wouldn&rsquo;t say they&rsquo;re common.</p>
</div>
<ol class="children">
<li id="comment-546935" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9814828bd8d94a47c12461f364baaa82?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9814828bd8d94a47c12461f364baaa82?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://robiii.me" class="url" rel="ugc external nofollow">RobIII</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-30T23:52:06+00:00">July 30, 2020 at 11:52 pm</time></a> </div>
<div class="comment-content">
<p>Except that I have no control over the data (3rd party data). And I have told them on several occasions that their &ldquo;ASCII&rdquo; input/validation is broken. But there&rsquo;s nothing <em>I</em> can do to fix it. All you can do is download dumps.</p>
<p>And ofcourse you can create (or download) diffs and ofcourse you can do all kinds of smart optimisations. That&rsquo;s all besides the point. If you have to, for -whatever- occasion, do this then it&rsquo;s nice to know what works. Hell, even if it&rsquo;s just for fun. Because we can. Just because it&rsquo;s beyond <em>your</em> imagination doesn&rsquo;t mean it&rsquo;s not real.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-545490" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3c64b5749f633eca95809fbb17495c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3c64b5749f633eca95809fbb17495c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Dimov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-26T22:23:39+00:00">July 26, 2020 at 10:23 pm</time></a> </div>
<div class="comment-content">
<p>Yes, it does. If you want to validate UTF-8, and your strings are almost always ASCII, it&rsquo;s much faster to check for ASCII first and skip validation if so.</p>
</div>
</li>
</ol>
</li>
<li id="comment-544900" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/17fea7fd2e2cf71a3233244fd15a206a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/17fea7fd2e2cf71a3233244fd15a206a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mike Brown</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T10:53:02+00:00">July 25, 2020 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>Yes, treating the last 8 and overlaying a few bytes is quicker in my tests. Here is a version that also handles the &lt; 8 bytes case.</p>
<p><code>inline bool is_ascii_branchless2(const std::string_view v) {<br/>
uint64_t less_than_8 = 0;<br/>
uint64_t* payload = &amp;less_than_8;<br/>
uint8_t r = (v.size() &amp; 7);<br/>
size_t d = (v.size() &gt;&gt; 3);</p>
<p> if (v.size() &lt;= 8) { // Equal to 8 to skip checking the block twice.<br/>
memcpy(&amp;less_than_8, v.data(), r);<br/>
} else {<br/>
payload = (uint64_t*)( v.data() );<br/>
}<br/>
uint64_t running = 0; </p>
<p> for(; d; payload++, d--) {<br/>
running |= *payload;<br/>
}</p>
<p> uint8_t* remaining = (uint8_t*)payload;<br/>
remaining += r;<br/>
running |= *(uint64_t*)remaining;</p>
<p> return ((running &amp; 0x8080808080808080) == 0);<br/>
}<br/>
</code></p>
</div>
</li>
<li id="comment-544937" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9814828bd8d94a47c12461f364baaa82?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9814828bd8d94a47c12461f364baaa82?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://robiii.me" class="url" rel="ugc external nofollow">RobIII</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-25T14:16:15+00:00">July 25, 2020 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>I have created <a href="https://github.com/RobThree/Ascii-Benchmark" rel="nofollow ugc">a .Net version</a> to be able to compare/benchmark the methods in a .Net variant.</p>
</div>
</li>
<li id="comment-545393" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aee782dae6b534f89b2a06e1bf002da0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aee782dae6b534f89b2a06e1bf002da0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sven Kautlenbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-26T19:29:04+00:00">July 26, 2020 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>That line where character data is memcpy-ed</p>
<p><code>memcpy(&amp;payload, v.data() + i, 8);<br/>
</code></p>
<p>&lsquo;payload&rsquo; variable might have whatever data that comes after the buffer if the memcpy transfers 8 bytes every time. In your test examples you used an input of 1000000 chars which %8 == 0.</p>
</div>
<ol class="children">
<li id="comment-545759" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07f2a57fc1bf6585bc68ec07d954e1d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07f2a57fc1bf6585bc68ec07d954e1d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-27T22:43:00+00:00">July 27, 2020 at 10:43 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s why it&rsquo;s inside a loop with condition &ldquo;i + 8 &lt;= v.size()&rdquo;, to protect from ever over-reading the buffer.</p>
</div>
<ol class="children">
<li id="comment-546335" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aee782dae6b534f89b2a06e1bf002da0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aee782dae6b534f89b2a06e1bf002da0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sven Kautlenbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-29T08:08:52+00:00">July 29, 2020 at 8:08 am</time></a> </div>
<div class="comment-content">
<p>Yep, my bad, I was thinking 2 things at once &#8211; over-reading and under-reading thats why I misunderstood it at first, thanks.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-549330" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38504ff52422b72b239a7b05ef0ccaae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38504ff52422b72b239a7b05ef0ccaae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kristian Meyer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-18T01:51:20+00:00">August 18, 2020 at 1:51 am</time></a> </div>
<div class="comment-content">
<p>Thanks for this post, I enjoy the examples of optimisations on this blog.</p>
<p>If you try a mix of non-ascii strings, the branchless approach still performs well when a high percentage of strings are ascii. I found the crossover between the branchless and nearly branchless approaches to be at about 83% ascii strings for this benchmark.</p>
<p>To test that, I replaced the following on line 107:</p>
<p><code>buffer[i] = (rand() % 128);<br/>
</code></p>
<p>With the following to get a mix of nonascii characters created within the strings:</p>
<p><code>if (rand() % 160 == 0)<br/>
buffer[i] = (rand() % 256);<br/>
else<br/>
buffer[i] = (rand() % 128);<br/>
</code></p>
<p>I get the following output on an i7-3770 with gcc 9.3.0:</p>
<p><code>Creating 1000000 strings<br/>
branchy:1.56017 GB/s<br/>
827420<br/>
branchless:3.32739 GB/s<br/>
827420<br/>
nearly branchless:3.32863 GB/s<br/>
827420<br/>
</code></p>
</div>
</li>
</ol>
