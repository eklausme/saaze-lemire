---
date: "2018-09-02 12:00:00"
title: "Science and Technology links (September 1st, 2018)"
index: false
---

[6 thoughts on &ldquo;Science and Technology links (September 1st, 2018)&rdquo;](/lemire/blog/2018/09-02-science-and-technology-links-september-1st-2018)

<ol class="comment-list">
<li id="comment-346638" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba2a08b759abcdc56239940167cfc170?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba2a08b759abcdc56239940167cfc170?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jorm</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-03T07:26:15+00:00">September 3, 2018 at 7:26 am</time></a> </div>
<div class="comment-content">
<p>Regarding the C++ point, what are your thoughts on Rust?</p>
</div>
</li>
<li id="comment-346670" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fec4d17c256fede1112dc19c35748f90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fec4d17c256fede1112dc19c35748f90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-03T12:51:58+00:00">September 3, 2018 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>The Torvalds comment you quote is from 2007. Do any of the developments in C++ since then change the picture? For better or for worse?</p>
</div>
<ol class="children">
<li id="comment-346735" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-03T23:40:35+00:00">September 3, 2018 at 11:40 pm</time></a> </div>
<div class="comment-content">
<p>In my opinion C++ is much improved with the addition of C++11, C++14, and C++17. After a long period of stagnation and endless standard revisions leading up to C++11, many important things have finally been added and a predictable three-year pace seems to have been adopted. Things that aren&rsquo;t ready (c.f., concepts) just get moved out of the revision, rather than delaying it.</p>
<p>The new features make it possible to write in a portable way things that weren&rsquo;t possible before, often without sacrificing performance, and allow people to stay within the sphere of operations that are provably (or at least probably) safe more of the time (i.e., reducing raw pointer, usage, etc).</p>
<p>That is said, all of these revisions came with an considerable increase in complexity. New concepts and syntax were added. I was what I would consider an expert C++ programmer prior to C+11, but had not used the language for a while, and fairly recently came back: I was happy with the new additions, but the learning curve was steep, even for someone who was already familiar with the fundamentals. Maybe, it is even <em>harder</em> for someone who was familiar with old C++, since in principle the way to reduce the incredible complexity of C++ is to only learn the &ldquo;new stuff&rdquo; or &ldquo;the good stuff&rdquo; &#8211; the idiomatic ways of doing things using the best available features today, rather than trying to learn everything the language has to offer, much of which is there mostly for backwards compatibility.</p>
<p>So if your view is that the primary problem with C++ is the complexity, then revisions since 2007 have made that problem worse. People using C++ today, however, are probably doing it because there were few alternatives with much traction as a &ldquo;more powerful C&rdquo; &#8211; they have already accepted this complexity and probably welcome the improvements. Adding more complexity won&rsquo;t suddenly tip the balance in favor of another language, since the basic tradeoffs that C++ offers are still the same.</p>
<p>I see Rust as very promising, and I suspect it is the leading candidate to finally supplant C++ in its primary niche of &ldquo;zero abstraction cost compiled, non-GC language&rdquo;. It takes the next step towards safety in many respects: as C++ improved on C by allowing the use of constructs that were safe <em>as long as you used them and followed the rules</em>, Rust effectively <em>requires</em> you to use them, and enforces it at compile time (and is built around it: offers more tools when interacting with the proof-checking part of the compiler). This will lead to safer software.</p>
</div>
</li>
</ol>
</li>
<li id="comment-346708" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-03T18:24:34+00:00">September 3, 2018 at 6:24 pm</time></a> </div>
<div class="comment-content">
<p>My current preferred approach is to restrict my use of C++ to stuff that has a straightforward (if less performant) C99 fallback that goes in the #else branch of an #ifdef __cplusplus (or #if __cplusplus &gt; 201103L, etc.) block. This is kind of artificial, since the C99-compiled builds are never used outside of automated testing, but I&rsquo;ve found it to be a good way to balance access to genuine advantages of C++ over C with staying focused on problem-complexity instead of language-complexity. I feel that the things I still miss out on are more than compensated for by the number of irrelevant decisions I no longer have to make and the classes of locally-invisible side-effects I no longer have to worry about.</p>
</div>
</li>
<li id="comment-346718" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/73330df4da854cabad017046a922a29f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/73330df4da854cabad017046a922a29f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stephen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-03T19:17:31+00:00">September 3, 2018 at 7:17 pm</time></a> </div>
<div class="comment-content">
<p>On the Intel / AMD market share figures, this is retail CPU purchases for a retailer in Germany.</p>
</div>
</li>
<li id="comment-347156" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c21bf054043c0b3d01e4d744fa382773?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c21bf054043c0b3d01e4d744fa382773?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Victor</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-09-05T13:48:10+00:00">September 5, 2018 at 1:48 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
My impression is that many people, being overweight, try to exercise<br/>
moreâ€¦ without necessarily losing weight.<br/>
I would say that the key word is &ldquo;try to&rdquo;. Overweight people tend to try a lot of diets, exercises and sports. The problem is, in my opinion, the lack of consistency. I was fat myself for most part of my life and in my family and environment I met a lot of overweight people. The problem was that everyone was looking for easy or simple methods for losing weight.
</p></blockquote>
<p>Then I realized the problem was that I, and others, were doing all those things for a short period of time. And not enjoying the process or the exercise we were engaging in. So, after a small success (losing a few kg), we started failing. One day I didn&rsquo;t do the exercises, but I though that &ldquo;I am on track already, so it&rsquo;s ok&rdquo;. Then it was a second, third time&#8230; And before I realized, I was not exercising and going back to the habits that made me fat again.</p>
<p>And I see the same pattern in almost anyone who is overweight and is struggling with it for a long time without improvement. I guess it&rsquo;s because is difficult to build the routine and to feel the need of doing sport. Because otherwise no matter how many things you try, if you don&rsquo;t do it regularly.</p>
</div>
</li>
</ol>
