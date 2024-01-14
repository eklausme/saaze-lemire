---
date: "2022-08-20 12:00:00"
title: "Catching sanitizer errors programmatically"
index: false
---

[3 thoughts on &ldquo;Catching sanitizer errors programmatically&rdquo;](/lemire/blog/2022/08-20-catching-sanitizer-errors-programmatically)

<ol class="comment-list">
<li id="comment-643655" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-21T06:43:42+00:00">August 21, 2022 at 6:43 am</time></a> </div>
<div class="comment-content">
<p>Using backtrace() would be a more realistic example.</p>
</div>
<ol class="children">
<li id="comment-643669" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-21T10:34:17+00:00">August 21, 2022 at 10:34 am</time></a> </div>
<div class="comment-content">
<p>If you are interested in the location of the error in your program, you could use <a href="https://www.gnu.org/software/libc/manual/html_node/Backtraces.html" rel="nofollow ugc">backtrace functions</a>, indeed.</p>
<p>My example illustrates a simple case where we want a description of the state of the program when an error happens. In my example, we know where the error happens a priori.</p>
</div>
</li>
</ol>
</li>
<li id="comment-644101" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a18dd983c8b29e4a491cbc2ac3b1284?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a18dd983c8b29e4a491cbc2ac3b1284?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M*USA-+ov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-26T17:58:56+00:00">August 26, 2022 at 5:58 pm</time></a> </div>
<div class="comment-content">
<p>Please be patient. I&rsquo;m trying to express an idea from the hip and want to have fun and be innovative. I spent a lot of time on this topic so please don&rsquo;t avoid me. Be more Austin than Boston. Maybe try coding this:</p>
<p>Each piece of information can be represented for computational purposes with a single glyph or character. Take numbers for example, if I said, &ldquo;Let P = 2 and NP = 11. The only difference would be the number of steps (time) and memory required to display one NP at a time in two cases.&rdquo; But there&rsquo;s no reason infinite numbers can&rsquo;t each have a single processing unique. However, computation would require a fairly machine-readable library only. But having each number have a 1 or 0 representation and then a single representation only on the input makes more sense. The only step missing was the ingenuity of the programmer in separating P and NP. Suppose for example P is prime and NP is never prime including non-prime integers: P = NP false. So P = NP is true. But what is a prime number? If I had two teachers and four apples I could give each teacher two apples. If I had two apples I could give each teacher a piece. It seems more logical to us to specify as long as there is an equal division into two or more parts to call the number COMPOSITE. This makes the input composite and the output primitive. So how can we provide proof that this is possible. Well, consider the output of prime 11 as NP as a proof that NP is prime. The proof is very tedious but we are still talking about a computer that can quickly confirm that the proof is correct. We can even say in imagination, use the number of primes that we can invert and invert on the right side to explain the figure equal to the difference between 2 and 11.<br/>
The proof that the machine emits divides the number into left and right correct answers and identifies prime 10s and a solution to the subsum problem that returns only a subset that includes zero when the number is prime.</p>
<p>The formula is prime time 2 + next prime, then prime + next prime as a product, minus the prime equals the prime that starts with 11&#8230; for example<br/>
3&#215;2=6, 6+5=11, 3+5=8*2=16, 16-5=11 left prime 2 right prime 11<br/>
Finite operator -5 so<br/>
5&#215;2=10, 10+3=13, 5+3=8, 8*2=16-3=13 left prime 5 right prime 13<br/>
Final operator -3 continues<br/>
7&#215;2=14, 14+3=17, 7+3=10, 10*2=20, 20-3=17 left 7 right 7 or 17<br/>
operator -3<br/>
reaching a peak…. +3, +3, +5 for -11 and +11&#8230; equal to zero is 6 inverted occurrences and the right side above the character then becomes a nine.</p>
</div>
</li>
</ol>
