---
date: "2020-06-04 12:00:00"
title: "The Go compiler needs to be smarter"
index: false
---

[25 thoughts on &ldquo;The Go compiler needs to be smarter&rdquo;](/lemire/blog/2020/06-04-the-go-compiler-needs-to-be-smarter)

<ol class="comment-list">
<li id="comment-524183" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8cfd5ec0f88bf5b5f2eedda7d1a0746?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Seebs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T16:34:53+00:00">June 4, 2020 at 4:34 pm</time></a> </div>
<div class="comment-content">
<p>I spent some time messing with the compiler&rsquo;s code generation for OnesCount64, and because I am sometimes a flake, I accidentally generated a variant in which it had the conditional branch, but didn&rsquo;t have the actual popcount instruction.</p>
<p>My microbenchmark was of a loop that unions two 1024-item slices of uint64, and possibly popcounts them. Time on my laptop came out to:</p>
<p>450ns: union the slices, no popcount<br/>
520ns: union the slices, popcount instruction with no branch<br/>
600ns: union the slices, always-untaken branch, no popcount (oops)<br/>
810ns: go&rsquo;s normal code (branch plus popcount)</p>
<p>What&rsquo;s interesting to me is that the popcount instructions add 70ns to execution without the branch, but 210ns to execution with the branch for some reason. I don&rsquo;t know why, but the net result is that with those branches, the function goes from 450-&gt;810ns if I do the popcounts (probably too expensive and unacceptable, better to do the popcounts in a separate pass after multiple runs of this). But if it were 450-&gt;520, I&rsquo;d probably do the popcounts in every pass and drop all the additional complexity&#8230;</p>
</div>
</li>
<li id="comment-524234" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/18406b520d962ee06a4e547fbe928cc1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/18406b520d962ee06a4e547fbe928cc1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">martisch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T17:16:15+00:00">June 4, 2020 at 5:16 pm</time></a> </div>
<div class="comment-content">
<p>GC tip (to be gc1.15 soon) already seems to improve the situation:<br/>
<a href="https://godbolt.org/z/ijn8bP" rel="nofollow ugc">https://godbolt.org/z/ijn8bP</a></p>
<p>due to <a href="https://github.com/golang/go/commit/fff7509d472778cae5e652dbe2479929c666c24f" rel="nofollow ugc">https://github.com/golang/go/commit/fff7509d472778cae5e652dbe2479929c666c24f</a></p>
</div>
<ol class="children">
<li id="comment-524240" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T17:23:35+00:00">June 4, 2020 at 5:23 pm</time></a> </div>
<div class="comment-content">
<p>The generated assembly is better, since the value is loaded in a register once&#8230; but Go still checks the register value each and every time&#8230; it is depressing. I realize that these are hard problems, but most other optimizing compilers would do better.</p>
</div>
<ol class="children">
<li id="comment-524281" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3827cd42ceac14c8ab36267ddf63fad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3827cd42ceac14c8ab36267ddf63fad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">paul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T20:21:09+00:00">June 4, 2020 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>I gather you next steps will be a Part 2 blog posting outlining the details of your PR to address these complaints?</p>
</div>
<ol class="children">
<li id="comment-524289" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-04T21:00:34+00:00">June 4, 2020 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>These are difficult problems unlikely to be solved with a PR or two. You need a concerted effort.</p>
</div>
<ol class="children">
<li id="comment-524409" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T00:21:13+00:00">June 5, 2020 at 12:21 am</time></a> </div>
<div class="comment-content">
<p>Regarding the PR: Josh is a great hacker. But I am sure he would agree that we can and should do better. Yet he can&rsquo;t solve it all.</p>
</div>
<ol class="children">
<li id="comment-524643" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://commaok.xyz" class="url" rel="ugc external nofollow">Josh Bleecher Snyder</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T16:41:06+00:00">June 5, 2020 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>I agree. 🙂</p>
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
<li id="comment-524438" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T05:40:49+00:00">June 5, 2020 at 5:40 am</time></a> </div>
<div class="comment-content">
<p><a href="https://github.com/golang/go/issues/17566" rel="nofollow ugc">https://github.com/golang/go/issues/17566</a> is an active issue about improving the in-lining cost model that has been open for 4 years. It actually references a previous blog post of yours from 2017 <a href="https://lemire.me/blog/2017/09/05/go-does-not-inline-functions-when-it-should/" rel="ugc">https://lemire.me/blog/2017/09/05/go-does-not-inline-functions-when-it-should/</a> A brief summary of that issue is that one reason in-lining is poor is that it uses a crude heuristic applied to the AST rather than SSA form of the code when more information is available. There is also a lot of debate around the trade-off between increased code size and improved performance with in-lining.</p>
<p>For the popcount issue, even with the recognition that the feature detection for popcount is a runtime constant, it is still a hard problem to decide on the trade-off between code size and performance. For optimum performance you would want to transform code like.</p>
<p><code>for (hot loop):<br/>
if (Likely) hasPopCount:<br/>
usePopCountInst;<br/>
else (Unlikely):<br/>
useFallBack;<br/>
</code></p>
<p>to</p>
<p><code>if (Likely) hasPopCount:<br/>
for (hot loop):<br/>
usePopCountInst;<br/>
else (Unlikely):<br/>
for (hot loop):<br/>
useFallBack;<br/>
</code></p>
<p>That is, hoist the check out of the loop and duplicate the hot loop and maybe even move the unlikely hot loop into a cold seciton of code to avoid polluting the instruction cache. If you decide to go this path, now there is a decision for how high to hoist the feature check (only very small loops? all the way up to the whole function?), which affects the generated code size. I&rsquo;m not aware of other approaches for a single binary to efficiently support different instructions at run time, are you?</p>
<p>Also, the go implementation of Stream-VByte that you mention is actually a pure go implementation. I have a version that implements the SSE3 version from your paper at <a href="https://github.com/bmkessler/streamvbyte" rel="nofollow ugc">https://github.com/bmkessler/streamvbyte</a> Go does make it fairly easy to implement assembly optimizations. Although the function call overhead due to not being able to in-line functions written in assembly means you can&rsquo;t just use short snippets of assembly for good performance.</p>
</div>
<ol class="children">
<li id="comment-524637" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T16:03:30+00:00">June 5, 2020 at 4:03 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>even with the recognition that the feature detection for popcount is a runtime constant, it is still a hard problem to decide on the trade-off between code size and performance.</p>
</blockquote>
<p>You make good points.</p>
<p>Just so we are clear, I realize that these problems are hard.</p>
<blockquote>
<p>I’m not aware of other approaches for a single binary to efficiently support different instructions at run time, are you?</p>
</blockquote>
<p>In theory, you could use a fat binary approach where you have multiple versions of the code, compiled for multiple platforms, and then you select the right one at runtime. That is what simdjson does. As far as I can tell, it is never done automatically.</p>
<blockquote>
<p>Also, the go implementation of Stream-VByte that you mention is actually a pure go implementation. I have a version that implements the SSE3 version from your paper at <a href="https://github.com/bmkessler/streamvbyte" rel="nofollow ugc">https://github.com/bmkessler/streamvbyte</a></p>
</blockquote>
<p>I corrected the link.</p>
<blockquote>
<p>Go does make it fairly easy to implement assembly optimizations.</p>
</blockquote>
<p>Yes. With the caveat that you need to do it for sizeable functions.</p>
<p>That is precisely why I still think that Go is underrated. Despite all my criticism, I believe it got many things right.</p>
</div>
</li>
</ol>
</li>
<li id="comment-524468" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/34daf10846bfa587d8cb39ff301f0389?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/34daf10846bfa587d8cb39ff301f0389?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mangat Rai Modi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T08:53:16+00:00">June 5, 2020 at 8:53 am</time></a> </div>
<div class="comment-content">
<p>Following are some other frustration I have with go compiler</p>
<p>Verbose lambda syntax.<br/>
No tail recursion optimization<br/>
Non exhaustive switch. This one might be tricky with duck typing type system, but some low handing fruits can be picked. </p>
<p>I don&rsquo;t agree with Go&rsquo;s core belief of fast compile time. I believe adding a few seconds in the compile phase is worth it to make the language safer and less verbose</p>
</div>
</li>
<li id="comment-524469" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0414a40b1c585eec22cbff5cb8495fd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0414a40b1c585eec22cbff5cb8495fd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Henderson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T09:09:31+00:00">June 5, 2020 at 9:09 am</time></a> </div>
<div class="comment-content">
<p>A good program is explicit in what it intends to do. An important quality. A competent programmer knows which functions are pure and may choose to move those with constant arguments to an initialisation step or to pre-compute constants.</p>
</div>
</li>
<li id="comment-524474" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/733e76b06db1b99819e6d0c05f784e02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/733e76b06db1b99819e6d0c05f784e02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RAD</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T10:00:35+00:00">June 5, 2020 at 10:00 am</time></a> </div>
<div class="comment-content">
<p>Perhaps this is an unintentional design trade off. Go does not make a strong distinction between debug and release builds. Code optimizations belong in the release build and logically introduce some degree of overhead that slows compilation in the frequent debug builds.</p>
</div>
<ol class="children">
<li id="comment-524633" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T15:44:02+00:00">June 5, 2020 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>There is some truth in what you suggest, I am sure.</p>
</div>
<ol class="children">
<li id="comment-524770" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b75b73b4d43b73cea781c54df332f203?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b75b73b4d43b73cea781c54df332f203?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Wessels</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-05T23:26:15+00:00">June 5, 2020 at 11:26 pm</time></a> </div>
<div class="comment-content">
<p>With more and more CPUs with many cores coming onto the market (ARM/AWS Graviton2 with 64 cores, AMD EPYC with 48 cores), in an ideal world it would be both possible to keep the crucial-for-productivity short build times as well as devote more processing resources to smarter optimizations.</p>
<p>I&rsquo;d be happy to pay the price of a cup of coffee per day for this (versus running on a <code>large</code> or even <code>medium</code> instance since it doesn&rsquo;t matter much anyways for development).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-524968" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-06T14:11:37+00:00">June 6, 2020 at 2:11 pm</time></a> </div>
<div class="comment-content">
<p>Excellent blog post.</p>
<p>As a rule of thumb, I expect the Go software I write to be ~2/3 as fast as what I could write in C. I&rsquo;ve used cgo and assembly to do better, but neither is currently good enough for me to want to use them in personal projects; I&rsquo;m still more productive writing everything in C/C++ whenever it&rsquo;s worth the effort to do better than 2/3-speed. But this isn&rsquo;t due to some fundamental limitation of the language, it&rsquo;s almost entirely driven by compiler weaknesses like the ones you describe here.</p>
</div>
<ol class="children">
<li id="comment-525117" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7147c5a67e8bf852b4a511085a239e09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7147c5a67e8bf852b4a511085a239e09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ylluminate</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-07T00:37:11+00:00">June 7, 2020 at 12:37 am</time></a> </div>
<div class="comment-content">
<p>Keep your eye on V then (Go done right with the speed of C and safety of Rust, etc.):</p>
<p><a href="https://vlang.io/" rel="nofollow ugc">https://vlang.io/</a><br/>
<a href="https://github.com/vlang/v" rel="nofollow ugc">https://github.com/vlang/v</a><br/>
Discord is great: <a href="https://discord.gg/vlang" rel="nofollow ugc">https://discord.gg/vlang</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-525118" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7147c5a67e8bf852b4a511085a239e09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7147c5a67e8bf852b4a511085a239e09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ylluminate</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-07T00:40:09+00:00">June 7, 2020 at 12:40 am</time></a> </div>
<div class="comment-content">
<p>Found your article through a comment from the creator of V on Discord: <a href="https://discord.gg/vlang" rel="nofollow ugc">https://discord.gg/vlang</a> (see <a href="https://discordapp.com/channels/592103645835821068/648394572501876746/718352046595768361" rel="nofollow ugc">this specifically</a>)</p>
<p>Nice observations!</p>
</div>
</li>
<li id="comment-525367" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Cohen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-08T03:18:08+00:00">June 8, 2020 at 3:18 am</time></a> </div>
<div class="comment-content">
<p>A comment on reading comments:<br/>
When I click on &ldquo;Comments&rdquo; at the end of the email, I go to the start of the article instead of the comments. I then have to scroll through the already-read article to get to the comments.<br/>
A small thing, but I find it annoying.<br/>
Using Brave on OS X 10.13.6.</p>
</div>
</li>
<li id="comment-526164" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Twirrim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T20:28:08+00:00">June 14, 2020 at 8:28 pm</time></a> </div>
<div class="comment-content">
<p>What are the drawbacks to too aggressively in-lining code?</p>
<p>Binary size seems like the most obvious thing to me, but are there performance risks from it?</p>
</div>
<ol class="children">
<li id="comment-526168" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://commaok.xyz/" class="url" rel="ugc external nofollow">Josh Bleecher Snyder</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T21:20:09+00:00">June 14, 2020 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>The two big drawbacks are bigger binaries and slower compilation; the effects there are very noticeable. And surveys of gophers consistently show more concern about binary size and compilation speed than performance.</p>
<p>Binary size can actually improve due to increased and/or smarter inlining (although it often does not). Compilation speed never does. Disabling inlining speeds up compilation by 10%. The challenge is not just to increase inlining, which is easy, but to use our (implicit) inlining budget better, which is not easy.</p>
<p>In my experiments, performance degradation to increased inlining is rare but possible, at least on amd64. One extreme example occurs with helper functions in machine-generated code. The compiler itself uses many of these, and increasing inlining can cause these to blow up, causing noticeable performance regressions.</p>
</div>
<ol class="children">
<li id="comment-526171" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T21:47:10+00:00">June 14, 2020 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>Of course, a reasonable solution would be for the compiler to accept inlining hints.</p>
</div>
<ol class="children">
<li id="comment-526175" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://commaok.xyz/" class="url" rel="ugc external nofollow">Josh Bleecher Snyder</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T22:36:45+00:00">June 14, 2020 at 10:36 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a complicated topic. 🙂 See <a href="https://github.com/golang/go/issues/21536" rel="nofollow ugc">https://github.com/golang/go/issues/21536</a> for a flavor of the discussion around it.</p>
</div>
<ol class="children">
<li id="comment-526176" class="comment byuser comment-author-lemire bypostauthor even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T22:43:46+00:00">June 14, 2020 at 10:43 pm</time></a> </div>
<div class="comment-content">
<p>I was aware of this thread, and I had read your reply some time ago.</p>
</div>
<ol class="children">
<li id="comment-526178" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://commaok.xyz/" class="url" rel="ugc external nofollow">Josh Bleecher Snyder</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-14T22:59:59+00:00">June 14, 2020 at 10:59 pm</time></a> </div>
<div class="comment-content">
<p>Not that it matters, really&#8211;we&rsquo;re just two people chatting in the comments of a blog&#8211;but I&rsquo;m personally more open to annotations and hints now than I was when I first replied on that issue. The no-knobs philosophy is predicated on having the toolchain eventually be good enough that the knobs don&rsquo;t buy you much.</p>
<p>I&rsquo;ve come to believe that there are a few places where toolchain progress is extremely difficult due to trade-offs vs:</p>
<p>compiler performance (e.g. powerful BCE)<br/>
binary size (e.g. inlining)<br/>
usability (e.g. FGO/PGO)<br/>
available compiler programmer hours (lots of things)<br/>
difficult API design (e.g. vector instructions without assembly)<br/>
stability (e.g. if we change inlining heuristics and 90% of programs benefit and 30% regress we will spend an untold amount of time and energy dealing with those regressions)</p>
<p>In some such cases, I&rsquo;m increasingly open to providing a pressure release valve such as inlining annotations or unsafe.Unreachable (<a href="https://github.com/golang/go/issues/30582" rel="nofollow ugc">https://github.com/golang/go/issues/30582</a>). However, I am not the decision maker; not even close.</p>
<p>Knobs notwithstanding, I don&rsquo;t think the dream of better inlining in Go is dead, despite the widespread despair. If we move inlining later in the compiler, we will be in a position to do much better. And it will be easier to improve the heuristics. And it&rsquo;ll provide enough disruption that we can sneak in a bunch of other improvements under the same umbrella.</p>
<p>As long as I&rsquo;m writing a novel, I might mention that one source of despair is that to a first approximation no one is even working on inlining. I don&rsquo;t know why the Go team has not prioritized that; I have very little insight into their decisions. I can say that I am not because making meaningful progress requires more time more consistently than I can dedicate as a just-for-fun volunteer. I will note, though, that &ldquo;no one is working on it&rdquo; is only true until it is not. 🙂</p>
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
<li id="comment-526212" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.joseduarte.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-15T09:09:17+00:00">June 15, 2020 at 9:09 am</time></a> </div>
<div class="comment-content">
<p>This is exactly my complaint about Go. I posted about it two months ago: <a href="https://www.reddit.com/r/golang/comments/fp9mrk/how_much_performance_headroom_is_left_longer/" rel="nofollow ugc">https://www.reddit.com/r/golang/comments/fp9mrk/how_much_performance_headroom_is_left_longer/</a></p>
<p>They ruthlessly optimize for compile time, which values the programmer&rsquo;s time over the users&rsquo; time. Since there might be thousands or millions of users, and a program might run millions of times, this never made any sense to me.</p>
<p>I want to let applications compile over a weekend for maximum optimization if it&rsquo;s something that will run thousands or millions of times, or run for thousands of hours. It would be great to have an alternative compiler for Go, a true and modern optimizing compiler. I&rsquo;ve thought about the business prospects for one, a proprietary compiler and toolchain – seems like there&rsquo;s a market for one, and the Google compiler just isn&rsquo;t very good. It doesn&rsquo;t leverage modern CPUs, and it doesn&rsquo;t seem to support Whole Program Optimization / LTO, or Profile Guided Optimization. LTO is less relevant for Go than C/C++, but there are still some opportunities.</p>
</div>
</li>
</ol>
