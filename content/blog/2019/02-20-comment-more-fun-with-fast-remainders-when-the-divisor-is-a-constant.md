---
date: "2019-02-20 12:00:00"
title: "More fun with fast remainders when the divisor is a constant"
index: false
---

[12 thoughts on &ldquo;More fun with fast remainders when the divisor is a constant&rdquo;](/lemire/blog/2019/02-20-more-fun-with-fast-remainders-when-the-divisor-is-a-constant)

<ol class="comment-list">
<li id="comment-390384" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Theo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-21T10:35:58+00:00">February 21, 2019 at 10:35 am</time></a> </div>
<div class="comment-content">
<p>Interesting!</p>
<p>Btw., GCC 8.1 seems to generate:</p>
<p><code>compilermod32(unsigned int):<br/>
mov eax, edi<br/>
mov edx, -1171354717<br/>
mul edx<br/>
mov eax, edx<br/>
shr eax, 4<br/>
imul eax, eax, 22<br/>
sub edi, eax<br/>
mov eax, edi<br/>
ret</code></p>
<p>whereas GCC trunk generates one less instruction:</p>
<p><code>compilermod32(unsigned int):<br/>
mov eax, edi<br/>
mov edx, 3123612579<br/>
imul rax, rdx<br/>
shr rax, 36<br/>
imul eax, eax, 22<br/>
sub edi, eax<br/>
mov eax, edi<br/>
ret</code></p>
<p>PS: And please, I certainly don&rsquo;t mean to tell you what to do, but since last time you mentioned you have Cannon Lake nearby and I don&rsquo;t, I think it would be interesting to compare this on it, too.</p>
<p>PPS: One another common case which would benefit from fast remainders is modular multiplication, i.e. <code>a*b%c</code> (all 64-bit unsigned ints, <code>c</code> is &ldquo;runtime&rdquo; constant) and the way to currently approach it is to use Montgomery multiplication. Just saying&#8230;</p>
</div>
<ol class="children">
<li id="comment-390441" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-21T17:35:40+00:00">February 21, 2019 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>Yes further investigations are warranted.</p>
<p>On Cannonlake the results are similar (broadly speaking) but the division instruction is much faster.</p>
</div>
<ol class="children">
<li id="comment-390453" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc794dd927f95ce0701cdc141bcd843f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Theo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-21T18:19:53+00:00">February 21, 2019 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>Thanks! Do you happen to have any numbers?</p>
</div>
</li>
</ol>
</li>
<li id="comment-390587" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-22T08:54:15+00:00">February 22, 2019 at 8:54 am</time></a> </div>
<div class="comment-content">
<p>Just noting that up to four simple register-register moves per clock cycle can be &ldquo;free&rdquo; on Core microarchitectures in the sense they don&rsquo;t use an execution unit. I&rsquo;m not certain how much difference these variants make in practice&#8230;</p>
</div>
<ol class="children">
<li id="comment-390765" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-23T01:04:04+00:00">February 23, 2019 at 1:04 am</time></a> </div>
<div class="comment-content">
<p>Although it doesn&rsquo;t use an execution unit, it still uses one of the 4 renamer &ldquo;slots&rdquo; which are what bottlenecks all recent Intel chips to at most 4 fused-domain ops per cycle. Since recent CPUs are rich in execution units, it is not uncommon that this limit is a bottleneck rather than EUs. Eliminated moves also take up a slot in the ROB, but not in the scheduler.</p>
<p>So I really hesitate to call them free. Very unscientifically I would say that they are something like half the cost of the cheapest real instructions (things like basic integer math).</p>
</div>
<ol class="children">
<li id="comment-390876" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-23T08:48:48+00:00">February 23, 2019 at 8:48 am</time></a> </div>
<div class="comment-content">
<p>Good to know that, I haven&rsquo;t thought of renamer slots can be such a bottleneck.</p>
<p>BTW, the better GCC generated compilermod32 is still pretty bad code. It could be trivially rewritten as:</p>
<p><code>compilermod32(unsigned int):<br/>
mov rax, 3123612579<br/>
imul rax, rdi<br/>
shr rax, 36<br/>
imul eax, eax, -22<br/>
add eax, edi<br/>
ret<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-390882" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-23T09:29:50+00:00">February 23, 2019 at 9:29 am</time></a> </div>
<div class="comment-content">
<p>Argh, I forgot that plain 32-bit move on amd64 zeroes upper bits of the 64-bit register. Thus the first move can&rsquo;t be eliminated this way while maintaining correct semantics. The second, though, can.</p>
</div>
</li>
<li id="comment-390991" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-23T19:38:02+00:00">February 23, 2019 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>Yeah this limit of 4 is pretty fundamental and why people still say that Intel chips are 4-wide (since all the other parts of the pipeline are wider these days: 8-wide retirement, 8 EUs, 6 uops from uop cache, or 5 from legacy decoder, etc).</p>
<p>It&rsquo;s even baked into Intel&rsquo;s top-down analysis stuff, which is based on the idea of 4 slots per cycle, and assigning each slot to &ldquo;effectively used&rdquo; (they call &ldquo;retiring&rdquo;) or empty for some reason in a large tree of possible reasons. I.e., if you solve every possible bottleneck in a top-down analysis, you&rsquo;ll end up at 4 IPC (4 FUPC, fused-uops-per-cycle, but grant me a bit of looseness in the terminology here).</p>
<p>Even nops count against this limit, even though they too do not execute.</p>
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
<li id="comment-481679" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-29T16:04:44+00:00">December 29, 2019 at 4:04 pm</time></a> </div>
<div class="comment-content">
<p>I believe the original code can do uint64_t mod uint32_t, without any changes, except for fastmod_u32&rsquo;s signature:)</p>
</div>
<ol class="children">
<li id="comment-553366" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7fc46ca0969fcdbb033671e3646b729?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yakov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-24T14:49:41+00:00">September 24, 2020 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>Wrong of course. I thought that because uint128_t can hold the result of uint64_t x uint64_t, but what matters here is the precision.<br/>
The most I could get out of testing was you can do a reliable uintA % uintB as long as A + B &lt;= 64. E.g., uint48 % uint16, or uint52 % uint12.<br/>
(In uint52 I mean a uint64 with top 12 bits being 0)</p>
</div>
</li>
</ol>
</li>
<li id="comment-610485" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6295052614d024cc63b8150a81e0e07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6295052614d024cc63b8150a81e0e07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mcortese</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-09T06:25:11+00:00">December 9, 2021 at 6:25 am</time></a> </div>
<div class="comment-content">
<p>Wrong. The function called directmod64() returns the quotient, not the reminder.</p>
</div>
<ol class="children">
<li id="comment-610552" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-09T13:10:25+00:00">December 9, 2021 at 1:10 pm</time></a> </div>
<div class="comment-content">
<p>It does return the remainder.</p>
</div>
</li>
</ol>
</li>
</ol>
