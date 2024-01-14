---
date: "2023-11-07 12:00:00"
title: "Generating arrays at compile-time in C++ with lambdas"
index: false
---

[3 thoughts on &ldquo;Generating arrays at compile-time in C++ with lambdas&rdquo;](/lemire/blog/2023/11-07-generating-arrays-at-compile-time-in-c-with-lambdas)

<ol class="comment-list">
<li id="comment-656040" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cb008c9f490e3faed32ef45d18090124?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cb008c9f490e3faed32ef45d18090124?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://chandlerc.blog/" class="url" rel="ugc external nofollow">Chandler Carruth</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-08T08:36:42+00:00">November 8, 2023 at 8:36 am</time></a> </div>
<div class="comment-content">
<p>Nice, looks like one of the patterns we&rsquo;ve ended up developing and using all over in the Carbon toolchain!<br/>
<a href="https://github.com/carbon-language/carbon-lang/blob/trunk/toolchain/lex/tokenized_buffer.cpp#L85-L95" rel="nofollow ugc">https://github.com/carbon-language/carbon-lang/blob/trunk/toolchain/lex/tokenized_buffer.cpp#L85-L95</a></p>
<p>If you&rsquo;re looking at any of the Carbon toolchain, always happy to chat / answer questions / etc on our Discord (or via email). Cheers!</p>
</div>
</li>
<li id="comment-656078" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b53e3475ab7164b049dd404ab0a89a0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-10T18:51:07+00:00">November 10, 2023 at 6:51 pm</time></a> </div>
<div class="comment-content">
<p>This is really cool!<br/>
It doesn&rsquo;t sound like memoization to me, though. I think this is just an ordinary lookup vocabulary an immutable table (albeit an optimized one in the case of a bit-test instruction). Memoization is about caching values as they are discovered and requires the use of a mutable table to cache the newly discovered values over time.</p>
</div>
<ol class="children">
<li id="comment-656989" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-15T23:14:44+00:00">December 15, 2023 at 11:14 pm</time></a> </div>
<div class="comment-content">
<p>Right, this is more akin to what they used to call &ldquo;dynamic programming&rdquo;.</p>
</div>
</li>
</ol>
</li>
</ol>
