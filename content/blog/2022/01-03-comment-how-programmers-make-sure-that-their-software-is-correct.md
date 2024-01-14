---
date: "2022-01-03 12:00:00"
title: "How programmers make sure that their software is correct"
index: false
---

[17 thoughts on &ldquo;How programmers make sure that their software is correct&rdquo;](/lemire/blog/2022/01-03-how-programmers-make-sure-that-their-software-is-correct)

<ol class="comment-list">
<li id="comment-614813" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c9ea80a2d8d6561d9f364d4c26d7105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c9ea80a2d8d6561d9f364d4c26d7105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael P</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T01:01:01+00:00">January 4, 2022 at 1:01 am</time></a> </div>
<div class="comment-content">
<p>You mention at the start of this post two sides of software correctness: doing what the programmer expects, and doing what the user needs. In engineering theory, these are usually respectively called verification and validation. All the examples given are verification methods.</p>
<p>For complex systems, verification and validation are related, in that a composite item will often be verified by relying on requirements that were passed to its components &#8212; and whether those requirements are correct is a validation question. Often, the validation problem is harder than verification, because it typically involves interfaces with other systems and with humans, and the expectations of those systems or humans may be ambiguous or even contradictory. Another important part of validation is expertise in adjacent fields, such as legal requirements for privacy, health, safety or environmental considerations.</p>
<p>Highly assured products will also often need verification methods beyond those described in this blog post. One manager of mine often said that for complex systems, it is impossible to test all the bugs out. He meant that both the specification and implementation of the system need to be done in a thoughtful, organized manner in order to provide confidence that defects have been systematically avoided or eliminated. Choosing airplanes and avionics as an example, simply reading the guidance documents &#8212; such as ARP4754A, ARP4761 and RTCA/DO-178C &#8212; will not readily give an understanding of the level of rigor that is required.</p>
</div>
<ol class="children">
<li id="comment-614816" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T01:19:04+00:00">January 4, 2022 at 1:19 am</time></a> </div>
<div class="comment-content">
<p>Thank you. You are correct.</p>
</div>
</li>
</ol>
</li>
<li id="comment-614827" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Turney</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T03:06:03+00:00">January 4, 2022 at 3:06 am</time></a> </div>
<div class="comment-content">
<p>I use &ldquo;assert&rdquo; more and more in my code. It&rsquo;s not exactly testing in the usual sense, but it helps me discover and repair coding errors quickly. It catches mistakes that I might otherwise never discover. It also serves as a kind of documentation, stating what my expectations are for a given block of code. I&rsquo;ve never regretted adding more &ldquo;asserts&rdquo; in my code.</p>
</div>
</li>
<li id="comment-614879" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T11:47:02+00:00">January 4, 2022 at 11:47 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;It must meet the needs of the user.&rdquo;</p>
<p>LMAO, in theory YES but what the user &ldquo;want&rdquo; (as far as they can articulate it 🙂 ) is NOT what the user need.</p>
</div>
</li>
<li id="comment-614892" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3fa4e5b4a86b853332d5adc156711544?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3fa4e5b4a86b853332d5adc156711544?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">abstract_type</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T13:36:30+00:00">January 4, 2022 at 1:36 pm</time></a> </div>
<div class="comment-content">
<p>Tests are entirely useless for correctness guarantees; at best, tests are a description of how some happy path works. Correctness is provided by construction (of a type) and composition (of smaller programs), and the easiest way to enable this is by a sound static type system which acts as a lightweight proof (as opposed to actual theorem provers like Coq, Agda etc).</p>
</div>
<ol class="children">
<li id="comment-615146" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9738c788ba28a864feafd37100246a7b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9738c788ba28a864feafd37100246a7b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sushil Shrestha</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-05T14:27:33+00:00">January 5, 2022 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;a sound static type system&rdquo;&#8230; which lang is that ?</p>
</div>
<ol class="children">
<li id="comment-615373" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/adc5bb73a05ec9bbdaba9cf7ca7b2aa8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/adc5bb73a05ec9bbdaba9cf7ca7b2aa8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">vlad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-06T22:05:36+00:00">January 6, 2022 at 10:05 pm</time></a> </div>
<div class="comment-content">
<p>Some examples:<br/>
OCaml, F#, Scala (since version 3), Haskell, Rust.</p>
</div>
</li>
<li id="comment-615376" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b9b90852f81612797df2c5bd4c2a69f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b9b90852f81612797df2c5bd4c2a69f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-07T00:02:15+00:00">January 7, 2022 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>They mentioned Coq and Agda. I&rsquo;ll add Lean to that list of reasonable languages.</p>
</div>
</li>
</ol>
</li>
<li id="comment-615378" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b9b90852f81612797df2c5bd4c2a69f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b9b90852f81612797df2c5bd4c2a69f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-07T00:15:44+00:00">January 7, 2022 at 12:15 am</time></a> </div>
<div class="comment-content">
<p>To quote a thesis which itself quotes &lsquo;Dijkstra 1972. “Notes on structured programming”&rsquo;.</p>
<p>&gt; Testing can famously only prove the presence of bugs. [3]</p>
<p>&gt; To prove that the language implementation satisfies the criteria on all inputs, one must turn to formal verification—i.e., by specifying it unambiguously in a formal language and giving a derivation that proves that it holds.</p>
<p><a href="https://repository.tudelft.nl/islandora/object/uuid:f0312839-3444-41ee-9313-b07b21b59c11" rel="nofollow ugc">https://repository.tudelft.nl/islandora/object/uuid:f0312839-3444-41ee-9313-b07b21b59c11</a></p>
</div>
<ol class="children">
<li id="comment-616934" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilya</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-17T11:11:52+00:00">January 17, 2022 at 11:11 am</time></a> </div>
<div class="comment-content">
<p>While this was the case in Dijkstra&rsquo;s times, nowadays you often can test an algorithm on every possible input. This is called &ldquo;brute force testing&rdquo;. For example, you can test a math function on all float numbers. All of them.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-614909" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e6f1976725283da961db28265a45e2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e6f1976725283da961db28265a45e2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T14:26:34+00:00">January 4, 2022 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Excellent post, Daniel. You covered a lot of territory, and you covered it well.</p>
</div>
<ol class="children">
<li id="comment-614918" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-04T14:55:19+00:00">January 4, 2022 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>Thank you.</p>
</div>
</li>
<li id="comment-615890" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36c1faf7e8fd7b1eea4f3b0460387462?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36c1faf7e8fd7b1eea4f3b0460387462?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.matrox.com/" class="url" rel="ugc external nofollow">Steve</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-10T20:00:11+00:00">January 10, 2022 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>I agree, excellent post, the coverage of the subject is good and down-to-earth.<br/>
A common saying we use at work is &ldquo;If it is not tested, it does not work.&rdquo;</p>
</div>
</li>
</ol>
</li>
<li id="comment-615155" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/29336abc09283a33978f447ff5458f67?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/29336abc09283a33978f447ff5458f67?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cmcimaging.com" class="url" rel="ugc external nofollow">C.P. Williams</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-05T16:11:19+00:00">January 5, 2022 at 4:11 pm</time></a> </div>
<div class="comment-content">
<p>I find it interesting that many programmers do not use basic accounting or tracking to manage their work. My company specializes in digital document conversion and finding errors would be a real nightmare if we didn&rsquo;t have a method in place to track progress both forward and backward. This provides us a number of real benefits. Errors are VERY easy and quick to Identify, Processes are simple to audit back to failure and (I think best of all) you can repeat the entire process start to finish in the same manner the error was created to see if the changes in code were corrected. </p>
<p>Although I see many programmers create error reports, logs for install, debug and such I rarely see logs for processes work unless the end user wants them. It is very common in our company to create reports that link backwards and forwards to the processes and they are often stored in such a way they can be accessed and managed. </p>
<p>In the end George Carlin was right, you will never had a garage big enough to hold everything in the world you want and the same is true with logs and reports, but you can manage them. Even though they take up space and time they are valuable tracking and management tool. </p>
<p>While coding I am one of those people that does in line add debug processes etc. but in the end I find I remove them (or at least comment them out) until I create a version. I find that after the fact they are just clutter.</p>
</div>
</li>
<li id="comment-615352" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5277207dadc9ce68a228f38bf8d5f6a7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5277207dadc9ce68a228f38bf8d5f6a7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://chouza.com.ar" class="url" rel="ugc external nofollow">Mariano Chouza</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-06T19:44:22+00:00">January 6, 2022 at 7:44 pm</time></a> </div>
<div class="comment-content">
<p>Just a typo:</p>
<p>(40000+4000)%65535=14464</p>
<p>should be</p>
<p>(40000+40000)%65536=14464</p>
</div>
</li>
<li id="comment-615387" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-07T01:28:25+00:00">January 7, 2022 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>Very nice post. It&rsquo;s a pity formal verification is not more advanced. Asserts, pre-conditions and post-conditions and TDD are really valuable to engage in a dialogue with your code that can make hidden assumptions explicit. Many bugs arise from implicit assumptions, IMHO.</p>
</div>
</li>
<li id="comment-615735" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7df778af179908bfc55251aaeb1fd10d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7df778af179908bfc55251aaeb1fd10d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mitch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-01-09T14:42:28+00:00">January 9, 2022 at 2:42 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s &lsquo;quickly write&rsquo;, not &lsquo;write quickly&rsquo;.<br/>
🙂</p>
</div>
</li>
</ol>
