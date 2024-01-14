---
date: "2019-10-26 12:00:00"
title: "How expensive is it to parse numbers from a string in C++?"
index: false
---

[8 thoughts on &ldquo;How expensive is it to parse numbers from a string in C++?&rdquo;](/lemire/blog/2019/10-26-how-expensive-is-it-to-parse-numbers-from-a-string-in-c)

<ol class="comment-list">
<li id="comment-433997" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-26T14:39:16+00:00">October 26, 2019 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>Can you also compute cycles/char?</p>
<p>As you can see, ints take about 3x as many cycles, but the throughput is 20x worse, likely because they also use many more chars.</p>
</div>
</li>
<li id="comment-434169" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-26T19:09:40+00:00">October 26, 2019 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>Yes, this can be a major bottleneck.</p>
<p>It’s not for every application (since it doesn’t guarantee the 16th decimal place is preserved), but I’ve found ScanadvDouble() in <a href="https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_string.cc" rel="nofollow ugc">https://github.com/chrchang/plink-ng/blob/master/2.0/plink2_string.cc</a> to be very useful.</p>
</div>
</li>
<li id="comment-434297" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4dcf3a2e6370ce27a91e584fac281c03?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4dcf3a2e6370ce27a91e584fac281c03?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan Marquardt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-27T01:23:16+00:00">October 27, 2019 at 1:23 am</time></a> </div>
<div class="comment-content">
<p>This talk of the CppCon 2019 mentions C++17 std::from_chars being much faster:</p>
<p><a href="https://youtu.be/4P_kbF0EbZM" rel="nofollow ugc">https://youtu.be/4P_kbF0EbZM</a></p>
<p>Indeed, cppreference has this sentence: „This is intended to allow the fastest possible implementation that is useful in common high-throughput contexts such as text-based interchange (JSON or XML).“</p>
<p>Maybe you‘d be interested in benchmarking this against your current implementation?</p>
</div>
</li>
<li id="comment-434471" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-27T07:22:19+00:00">October 27, 2019 at 7:22 am</time></a> </div>
<div class="comment-content">
<p>You may like watching <a href="https://youtu.be/4P_kbF0EbZM" rel="nofollow">Floating-Point charconv: Making Your Code 10x Faster With C++17&rsquo;s Final Boss</a></p>
</div>
</li>
<li id="comment-434970" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-28T07:26:58+00:00">October 28, 2019 at 7:26 am</time></a> </div>
<div class="comment-content">
<p>I wonder if there would be a measurable benefit from simply breaking the dependency chain on sum variable, that is using multiple variables instead of one. After all, results with integers would be the same.</p>
<p>There are certainly faster methods to parse integers than one that takes 18 cycles per byte, at least if you can vectorise! <a href="http://0x80.pl/articles/simd-parsing-int-sequences.html" rel="nofollow">Parsing series of integers with SIMD</a> (Wojciech Muła) finds out that 3-6 cycles per byte is entirely plausible to reach on smaller (shorter) integers.</p>
</div>
</li>
<li id="comment-435656" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e58bf4adf3a7edaf091d7ebab8ae10ac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e58bf4adf3a7edaf091d7ebab8ae10ac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Virgo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-29T15:08:50+00:00">October 29, 2019 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>But how about the standard library&rsquo;s <code>stoi</code> <code>atoi</code> thingies?</p>
<p>I use them in my <code>Value::deserialize()</code> method.</p>
</div>
</li>
<li id="comment-441672" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6aa191a764bd8a1dcbeca7326eb98bd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6aa191a764bd8a1dcbeca7326eb98bd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Nelless</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-11T08:32:38+00:00">November 11, 2019 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>Look at Boost Spirit. Spirit X3 has essentially optimal (scalar) parsing of numeric strings at -O2 and will actually check for things like over/under flow and narrowing.</p>
<p>Facebook&rsquo;s Andrei Alexandrescu also gave a talk on speeding this up further (it&rsquo;s probably implemented in Folly) by looking at the CPU pipeline and breaking dependencies.</p>
</div>
</li>
<li id="comment-441677" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6aa191a764bd8a1dcbeca7326eb98bd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6aa191a764bd8a1dcbeca7326eb98bd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Nelless</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-11T08:59:23+00:00">November 11, 2019 at 8:59 am</time></a> </div>
<div class="comment-content">
<p>Additionally, it&rsquo;s worth mentioning that there&rsquo;s always going to be a divide between functions that respect the users locale , and parse strings like &ldquo;3,786&rdquo; and ones that don&rsquo;t. Iostreams very much do handle this, which makes them inappropriate in general for parsing file formats where a grammar is known.</p>
</div>
</li>
</ol>
