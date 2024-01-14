---
date: "2020-09-10 12:00:00"
title: "Parsing floats in C++: benchmarking strtod vs. from_chars"
index: false
---

[27 thoughts on &ldquo;Parsing floats in C++: benchmarking strtod vs. from_chars&rdquo;](/lemire/blog/2020/09-10-parsing-floats-in-c-benchmarking-strtod-vs-from_chars)

<ol class="comment-list">
<li id="comment-552226" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8c04e8d64df709d32505addd42d69140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://unpythonic.net" class="url" rel="ugc external nofollow">Jeff Epler</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:17:27+00:00">September 10, 2020 at 8:17 pm</time></a> </div>
<div class="comment-content">
<p>20% doesn&rsquo;t seem like a lot considering how the marketing copy for the new C++17 number conversion routines claimed that &ldquo;[if] your serialization code is bottlenecked by floating-point printing, this will accelerate your code by roughly 3x to 30x (yes, times, not percent).&rdquo; <a href="https://isocpp.org/blog/2020/08/cppcon-2019-floating-point-charconv-making-your-code-10x-faster-with-cpp17s" rel="nofollow ugc">https://isocpp.org/blog/2020/08/cppcon-2019-floating-point-charconv-making-your-code-10x-faster-with-cpp17s</a></p>
<p>Also not obvious at first blush is why the standard (at least as quoted by cppreference) doesn&rsquo;t guarantee interoperability when both sides use IEEE754 floating point: &ldquo;The guarantee that std::from_chars can recover every floating-point value formatted by to_chars exactly is only provided if both functions are from the same implementation.&rdquo; Why did they leave this wiggle room (vs stating something about a requirement about the std::numeric_limits&lt;&gt; of the types on the two platforms)? How could Linux and Windows, or Windows-on-x86 and Windows-on-x86_64 FAIL to round trip yet each individually conform to the standard? <a href="https://en.cppreference.com/w/cpp/utility/to_chars" rel="nofollow ugc">https://en.cppreference.com/w/cpp/utility/to_chars</a></p>
</div>
<ol class="children">
<li id="comment-552228" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:31:18+00:00">September 10, 2020 at 8:31 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Also not obvious at first blush is why the standard (at least as<br/>
quoted by cppreference) doesn’t guarantee interoperability when both<br/>
sides use IEEE754 floating point</p>
</blockquote>
<p>I take it that it is a pessimistic view.</p>
</div>
</li>
<li id="comment-552291" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdd630f72eef3790bfb4ef38d08c7f85?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdd630f72eef3790bfb4ef38d08c7f85?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Konrad Rudolph</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T09:21:34+00:00">September 11, 2020 at 9:21 am</time></a> </div>
<div class="comment-content">
<p>Printing ≠ parsing!</p>
<p>Printing became an order of magnitude faster because itʼs using brand new algorithms to print floating point numbers.</p>
<p>Parsing “only” omits locale handling, so thereʼs a limit to how much faster it could get.</p>
</div>
</li>
</ol>
</li>
<li id="comment-552227" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan Bobev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:28:04+00:00">September 10, 2020 at 8:28 pm</time></a> </div>
<div class="comment-content">
<p>20% performance boost? To be correct this is a little above 14%, not 20%. And yes it is a meaningful increase, but let be correct.</p>
</div>
<ol class="children">
<li id="comment-552229" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan Bobev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:32:30+00:00">September 10, 2020 at 8:32 pm</time></a> </div>
<div class="comment-content">
<p>O, I&rsquo;m a complete idiot. It is 16.6%. 😀</p>
</div>
<ol class="children">
<li id="comment-552231" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:36:54+00:00">September 10, 2020 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think you are an idiot.</p>
</div>
</li>
<li id="comment-552233" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4b27fdf36dd3ffbfe94bcb718d14a51?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan Bobev</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:57:35+00:00">September 10, 2020 at 8:57 pm</time></a> </div>
<div class="comment-content">
<p>I firstly just calculated the decrease from the upper value to the lower one, not the increase from the lower to the upper.</p>
</div>
</li>
</ol>
</li>
<li id="comment-552230" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T20:35:57+00:00">September 10, 2020 at 8:35 pm</time></a> </div>
<div class="comment-content">
<p>Take into account that both values (1.40 and 1.20) were rounded to two significant digits, and add the fact that the measure has some incertitude to begin with (~3%)&#8230; So I need to round the ratio to one significant digit. Hence 20% is fair.</p>
<p>140 / 120 &#8211; 1 = 0.17</p>
</div>
</li>
</ol>
</li>
<li id="comment-552242" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c940f2dce578e9131f66827bef43eb2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c940f2dce578e9131f66827bef43eb2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Charles Bloom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T22:36:24+00:00">September 10, 2020 at 10:36 pm</time></a> </div>
<div class="comment-content">
<p>It would be interesting to see the speed vs. the classic good open source strtod from &ldquo;dtoa.c&rdquo; ; historically the MSVC CRT strtod has been about 10X slower than &ldquo;dtoa.c&rdquo; so I&rsquo;d be more pleased if they fixed their 10X slowdown. (the MUSL CRT strtod was 100X slower)</p>
</div>
<ol class="children">
<li id="comment-552243" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T22:38:41+00:00">September 10, 2020 at 10:38 pm</time></a> </div>
<div class="comment-content">
<p>I think you mean &ldquo;atof&rdquo;. I think atof is legacy at this point.</p>
</div>
<ol class="children">
<li id="comment-552262" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c940f2dce578e9131f66827bef43eb2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c940f2dce578e9131f66827bef43eb2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Charles Bloom</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T03:02:54+00:00">September 11, 2020 at 3:02 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t undestand where I could have meant &ldquo;atof&rdquo; ?</p>
<p>dtoa.c (.c indicates a source code file) is the classic gold standard for a good strtod that is both accurate and fast. It can be updated with modern instructions (64 bit registers and clz) to be even faster.</p>
<p><a href="http://www.ampl.com/netlib/fp/dtoa.c" rel="nofollow ugc">http://www.ampl.com/netlib/fp/dtoa.c</a></p>
<p>Rough order of magnitude, 140 MB/s looks about 10X too slow for strtod.</p>
<p>On most doubles, strtod only has to do *= 10, += digit, so it should be only a few cycles per digit, not hundreds of cycles per digit. Doubles that require more work than that are very rare.</p>
<p>dtoa.c averages around 2 cycles per byte so these times look very slow indeed.</p>
</div>
<ol class="children">
<li id="comment-552731" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-16T04:12:31+00:00">September 16, 2020 at 4:12 am</time></a> </div>
<div class="comment-content">
<p>I added the netlib strtod that Charles linked and ran it unmodified (except for changing the name), and it provides a modest speedup:</p>
<p><code># parsing random integers in the range [0,1)<br/>
volume = 2.09808 MB<br/>
strtod : 125.83 MB/s (+/- 1.4 %)<br/>
netlib : 174.48 MB/s (+/- 4.1 %)<br/>
</code></p>
<p>This works out to about 15 cycles per byte on my machine, considerably more than the 2 Charles it suggests it should achieve.</p>
<p>Looking at the main loop it seems like it is not going to get to 2 cycles (there is at least one or two mispredicts every time a 0 appears), but 15 does seem like too much. The compiler does a poor job in various places too.</p>
</div>
<ol class="children">
<li id="comment-552790" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-16T22:17:15+00:00">September 16, 2020 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>Thank you Travis.</p>
</div>
<ol class="children">
<li id="comment-552802" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-17T03:36:53+00:00">September 17, 2020 at 3:36 am</time></a> </div>
<div class="comment-content">
<p>If you are interested in it I can send a PR.</p>
</div>
</li>
</ol>
</li>
<li id="comment-555699" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abdc56636d8d76cfb91fe792460c9699?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Per Vognsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T06:56:08+00:00">October 21, 2020 at 6:56 am</time></a> </div>
<div class="comment-content">
<p>Hi everyone,</p>
<p>The &ldquo;random&rdquo; part of the benchmark is why this is so far off from Charles&rsquo;s 10x guess. (Travis: I assume you didn&rsquo;t mean &ldquo;random <em>integers</em> in [0, 1)&rdquo; since there aren&rsquo;t a lot of those to go around.)</p>
<p>The standard fast path (which is in David Gay&rsquo;s code) for correctly rounded decimal to double conversion is when you have 15 significant decimal digits (or 16 significant digits &lt;= 2^53). Then you have an exactly represented integer (from the parsed decimal digits) divided by an exactly represented power of ten. That is a single IEEE-754 operation and hence correctly rounded. (You can also support &lsquo;e&rsquo; on the fast path with a branch to either divide or multiply by a power of ten as long as the net power of ten is exactly representable.)</p>
<p>If you&rsquo;re parsing hand-written double literals in a programming language parser or calculator program then you&rsquo;re almost never going to need more than 15 digits and hence the fast path will be hit almost all the time. On the other hand, there aren&rsquo;t really enough hand-written double literals in a typical source file for the performance to be a bottleneck.</p>
<p>Where performance really matters is when you&rsquo;re trying to round-trip large arrays of doubles, and they will often have noise in the less significant digits (from accumulated round-off unrelated to any serialization issues) which can push you off the fast path most of the time.</p>
<p>A relevant factor for hitting the fast path is whether the doubles you&rsquo;re reading were printed with the minimum number of required digits. In Daniel&rsquo;s data generator in the benchmark, his code appears to be the printing the minimum (at most 17 digits for doubles). But if we assume a uniform distribution on [0, 1) and a fast path that only works with 15 digits, I think that means only 1% of cases will hit the fast path.</p>
</div>
<ol class="children">
<li id="comment-555736" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T16:14:10+00:00">October 21, 2020 at 4:14 pm</time></a> </div>
<div class="comment-content">
<p>From what I can tell most of the time is spent simply parsing the characters into an integer, not any slow path associated with more than 15 digits.</p>
<p>That is, the loop that does:</p>
<p><code>result *= 10 + *str - '0'</code></p>
<p>It does a bit more than that because it handles zeros specially (I suppose to avoid overflow in the case of many trailing zeros).</p>
<p>This parsing would need to happen regardless of 15 or 17 digits, so I&rsquo;m not seeing the slow path unless it&rsquo;s related to the trailing zero handling I mentioned.</p>
<p>I did make some tweaks to the netlib algo and got a good speedup to around 600 MB/s, but still pretty far away from Charles&rsquo; estimate.</p>
</div>
<ol class="children">
<li id="comment-555737" class="comment even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-10-21T16:15:18+00:00">October 21, 2020 at 4:15 pm</time></a> </div>
<div class="comment-content">
<p>Sorry it should be <code>result = result * 10 + *str - '0'</code>.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-552244" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-10T22:39:37+00:00">September 10, 2020 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>Furthermore, I don&rsquo;t expect that is even theoretically possible to go 100x faster than the number I have reported here.</p>
</div>
</li>
</ol>
</li>
<li id="comment-552265" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72df8ef5abcb93a86a3da20450a9bc2d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72df8ef5abcb93a86a3da20450a9bc2d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hasan Alayli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T03:37:23+00:00">September 11, 2020 at 3:37 am</time></a> </div>
<div class="comment-content">
<p>You might be interested in benchmarking fmt lib as they&rsquo;ve done great work in speeding up double conversions.</p>
<p><a href="https://github.com/fmtlib/fmt#speed-tests" rel="nofollow ugc">https://github.com/fmtlib/fmt#speed-tests</a></p>
</div>
<ol class="children">
<li id="comment-552316" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T12:41:25+00:00">September 11, 2020 at 12:41 pm</time></a> </div>
<div class="comment-content">
<p>As far as I can tell, fmtlib prints out floats. It is not the problem considered here. Thanks for the link.</p>
</div>
<ol class="children">
<li id="comment-552369" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72df8ef5abcb93a86a3da20450a9bc2d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72df8ef5abcb93a86a3da20450a9bc2d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hasan Alayli</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T23:08:05+00:00">September 11, 2020 at 11:08 pm</time></a> </div>
<div class="comment-content">
<p>Oops, my mind wandered in the other direction as I was reading the article.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-552321" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ecfedbd5939b3c499404a41be0eb6dd4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ecfedbd5939b3c499404a41be0eb6dd4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rudi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T13:33:24+00:00">September 11, 2020 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>Not that I think that it will increase the performance significantly, but the handling of &lsquo;string_end&rsquo; is not correct. It doesn&rsquo;t have to be initialized and the check for nullptr is not necessary. When strtod() succeeds, string_end will point to the terminating zero of string. So the error check should read: if ( *string_end != &lsquo;\0 ) { failed(); }</p>
</div>
<ol class="children">
<li id="comment-552322" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T13:43:11+00:00">September 11, 2020 at 1:43 pm</time></a> </div>
<div class="comment-content">
<p>You are correct but as you point out, this does not affect performance for our purposes.</p>
</div>
</li>
</ol>
</li>
<li id="comment-552353" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21fff55acda82926249968a2cfd08a28?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21fff55acda82926249968a2cfd08a28?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.partow.net/" class="url" rel="ugc external nofollow">Arash Partow</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:11:11+00:00">September 11, 2020 at 7:11 pm</time></a> </div>
<div class="comment-content">
<p>Another flawed benchmark.</p>
<p>Why is the benchmark including the cost of the static c_locale?<br/>
Why not time based on a batch rather than on individual parses?<br/>
Does the benchmark actually test and or include all possible ways a float can be represented? eg: <a href="https://github.com/ArashPartow/strtk/blob/master/strtk_tokenizer_cmp.cpp#L568" rel="nofollow ugc">https://github.com/ArashPartow/strtk/blob/master/strtk_tokenizer_cmp.cpp#L568</a></p>
</div>
<ol class="children">
<li id="comment-552356" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-11T19:39:27+00:00">September 11, 2020 at 7:39 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Why is the benchmark including the cost of the static c_locale?</p>
</blockquote>
<p>I am not sure what you mean by cost. Both strtod_l and strtod depend on a locale. In this case, I specify the default locale.</p>
<p>As explained in the post strtod is locale-sensitive and we want a local insensitive version for comparison purposes.</p>
<blockquote>
<p>Why not time based on a batch rather than on individual parses?</p>
</blockquote>
<p>Because I am interested in throughput, as indicated by the fact that I express my results in MB/s. I am not interested in latency in this case.</p>
<blockquote>
<p>Does the benchmark actually test and or include all possible ways a float can be represented?</p>
</blockquote>
<p>It does not. Have you checked the code?</p>
<p>The exact performance number will depend on how the values were serialized with the number of digits being the most important factor. However, if you want full roundtrip, you need 17 digits in general for this problem. I have fixed the number of digits to a flat 17 throughout.</p>
<p>In practice, if you are parsing a lot of floats, chances are good that they are following the same format.</p>
<blockquote>
<p>Another flawed benchmark.</p>
</blockquote>
<p>Can you point at a better from_chars to strtod benchmark?</p>
<p>You offer a link to your own library, but it does not seem to include such a benchmark?</p>
</div>
</li>
</ol>
</li>
<li id="comment-552727" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-16T03:01:07+00:00">September 16, 2020 at 3:01 am</time></a> </div>
<div class="comment-content">
<p>I tested <code>from_chars</code> in gcc 11 snapshot (<code>g++ (GCC) 11.0.0 20200913 (experimental)</code>) and current it is actually considerably <em>slower</em> than <code>strtod</code>.</p>
<p>Of course, it might speed up before release.</p>
<p><code># parsing random integers in the range [0,1)<br/>
volume = 2.09808 MB<br/>
strtod : 126.03 MB/s (+/- 2.5 %)<br/>
from_chars : 82.09 MB/s (+/- 2.5 %)<br/>
</code></p>
<p>It is not a given that <code>from_chars</code> will be faster than <code>strtod</code> either: the former has a &ldquo;round trip&rdquo; requirement that the latter doesn&rsquo;t.</p>
</div>
</li>
<li id="comment-553292" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yakov Bachmutsky</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-23T20:56:00+00:00">September 23, 2020 at 8:56 pm</time></a> </div>
<div class="comment-content">
<p>You may want to have a look at <a href="https://github.com/yb303/swar" rel="nofollow ugc">https://github.com/yb303/swar</a>.<br/>
It&rsquo;s only a header really.<br/>
I wrote it a few years back when I was bored between jobs and now cleaned up and uploaded.<br/>
It provides a few variants of atoi / itoa, without using SSE.<br/>
SEE may make it a bit faster for strings longer than 8 (ints greater than 99999999)</p>
</div>
</li>
</ol>
