---
date: "2017-08-22 12:00:00"
title: "&#8220;Cracking&#8221; random number generators (xoroshiro128+)"
index: false
---

[25 thoughts on &ldquo;&#8220;Cracking&#8221; random number generators (xoroshiro128+)&rdquo;](/lemire/blog/2017/08-22-cracking-random-number-generators-xoroshiro128)

<ol class="comment-list">
<li id="comment-284771" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b8ddcf18f01bfd9bda7bd1e5fbd6edd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Severin Pappadeux</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T15:02:28+00:00">August 22, 2017 at 3:02 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve looked once at xoroshiro128+ and couldn&rsquo;t believe what I saw. Why on they decided to sum and return result before shuffling? What was the rationale for such horrible decision?</p>
<p>If I would make xoroshiro128+, code would be </p>
<p>uint64_t next(void) {<br/>
const uint64_t s0 = s[0];<br/>
uint64_t s1 = s[1];</p>
<p> s1 ^= s0;<br/>
s[0] = rotl(s0, 55) ^ s1 ^ (s1 &lt;&lt; 14); // a, b<br/>
s[1] = rotl(s1, 36); // c<br/>
return s[0] + s[1];<br/>
}</p>
</div>
<ol class="children">
<li id="comment-284772" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Daniel Lemire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T15:03:52+00:00">August 22, 2017 at 3:03 pm</time></a> </div>
<div class="comment-content">
<p>Can you elaborate?</p>
</div>
</li>
<li id="comment-284773" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vigna Sebastiano</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T15:18:41+00:00">August 22, 2017 at 3:18 pm</time></a> </div>
<div class="comment-content">
<p>LOL that&rsquo;s exactly the same generator, with the output shifted by one position. ðŸ˜‚</p>
</div>
</li>
<li id="comment-284777" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/febfadf82d5a05ee4ef92f72039d9cb8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/febfadf82d5a05ee4ef92f72039d9cb8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">toulis9999</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T15:44:58+00:00">August 22, 2017 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>What you suggest is actually what happens in the xorshift128+ algorithm. Essentially that is the only difference of the two algorithms.<br/>
If you read their website they say that the change makes the algorithm performance better due to CPU pipelining instructions.<br/>
Essentially the shift instructions will happen out of order and the calling code will get the result faster</p>
</div>
</li>
</ol>
</li>
<li id="comment-284775" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T15:24:59+00:00">August 22, 2017 at 3:24 pm</time></a> </div>
<div class="comment-content">
<p>I really cannot understand all this fuss. For 20 years people have been proud of &ldquo;maximal equidistribution&rdquo;, a nice property that tells you that the generator produces all possible distinct k-tuples it can actually generate, given its state space. The Mersenne Twister, the WELL family, have all been designed with this goal. Which of course implies that after any k outputs you can predict the generator. Now this property has renamed by this lady &ldquo;crackable generators&rdquo;. </p>
<p>Whatever.</p>
</div>
<ol class="children">
<li id="comment-284785" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T18:50:47+00:00">August 22, 2017 at 6:50 pm</time></a> </div>
<div class="comment-content">
<p>If you mean that &ldquo;I (Daniel Lemire) make a fuss&rdquo;, then I have to disagree with you. If you mean that O&rsquo;Neill is making a fuss, then please be specific.</p>
<p>Here is what I wrote:</p>
<blockquote><p>
I should point out that the same is true of most random number generators in widespread use today. Cryptographic random number generators should probably be used if you want to open a casino.
</p></blockquote>
<p>I trust that you are in agreement with this statement?</p>
<p>You write: &ldquo;the generator produces all possible distinct k-tuples it can actually generate, given its state space (&#8230;) Which of course implies that after any k outputs you can predict the generator.&rdquo; </p>
<p>I am trying to parse this statement and I am having difficulties. What is the value of <em>k</em> in this instance (xoroshiro128+)?</p>
</div>
<ol class="children">
<li id="comment-284793" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T20:36:13+00:00">August 22, 2017 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>Hey, Daniel, I said &ldquo;this lady&rdquo;. Clearly I&rsquo;m not referring to you!</p>
<p>I completely agree with your statement. But your title is &ldquo;Cracking random number generators (xoroshiro128+)&rdquo;, not &ldquo;Cracking the Mersenne Twister&rdquo;. And &ldquo;cracking&rdquo; the Mersenne Twister is even easier. So I think that the way you are presenting the material is very misleading. But, hey, it&rsquo;s your blog.</p>
<p>Do you agree with me that renaming &ldquo;equidistributed&rdquo; (20 years of history) with &ldquo;crackable&rdquo; is a bit of a stretch?</p>
<p>xoroshiro128+ is not maximally equidistributed in its maximal dimension: it emits all values the same number of times, but not all pairs of values (it is 1-equidistributed, but not 2-equidistributed). For instance, the Mersenne Twister is: it&rsquo;s actually stated in the title of the paper:</p>
<p>&ldquo;Mersenne Twister: A 623-dimensionally equidistributed uniform pseudorandom number generator.&rdquo;</p>
<p>So after 623 inputs you can predict, and it&rsquo;s impossible to do it before due to state space size (every 622-tuple is followed by all possible values).</p>
<p>I&rsquo;m not a big fan of equidistribution: I argued in my paper on TOMS that&rsquo;s vastly overestimated as a feature of a PRNG. I got through *four* rounds of refereeing in two years to get my ideas through. But they were discussed with expert in the fields before being published, as it should happen.</p>
</div>
<ol class="children">
<li id="comment-284795" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T20:51:48+00:00">August 22, 2017 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p><em>I completely agree with your statement. But your title is â€œCracking random number generators (xoroshiro128+)â€, not â€œCracking the Mersenne Twisterâ€. And â€œcrackingâ€ the Mersenne Twister is even easier. So I think that the way you are presenting the material is very misleading. But, hey, it&rsquo;s your blog.</em></p>
<p>It is less interesting to crack SplitMix or the Mersenne Twister because it is obvious how if you have some working knowledge of computer arithmetic. (And see James Roper&rsquo;s post about <a href="https://jazzy.id.au/2010/09/22/cracking_random_number_generators_part_3.html" rel="nofollow">cracking the Mersenne Twister</a>.)</p>
<p><em>Do you agree with me that renaming â€œequidistributedâ€ (20 years of history) with â€œcrackableâ€ is a bit of a stretch?</em></p>
<p>I&rsquo;m sorry if you are offended by the terminology, that was not my intention. </p>
<p>So you are saying that â€œequidistributedâ€ is synonymous with being computationally easy to invert?</p>
</div>
<ol class="children">
<li id="comment-284809" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T23:34:43+00:00">August 22, 2017 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>No, but maximally equidistributed in the output dimension implies predictability, and all examples I&rsquo;ve seen so far for generators with large state space involve some kind of equidistribution.</p>
<p>I think it&rsquo;s very dangerous to make people believe that there are &ldquo;easily predictable&rdquo;, &ldquo;less easy to predict&rdquo; and &ldquo;secure&rdquo; generators. There are secure and non-secure generators, period. The difficulty of predicting a generator, given that it can predicted feasibly, is irrelevant. You want secure? Use Fortuna, or something like that. Making people believe that a *slight less predictable* generator (like PCG) will solve their security problems will meet harsh comments from people working on security.</p>
</div>
<ol class="children">
<li id="comment-284816" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T00:52:10+00:00">August 23, 2017 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>It feels to me like there is no significant disagreement between us that I can see.</p>
<p>I take it that you might feel that using the term &ldquo;cracking&rdquo; might be pejorative. But xoroshiro128+ is not secure (by your own admission, surely), so it is reasonable to talk about &ldquo;cracking it&rdquo;.</p>
<p>You object that the same can be said of many other functions, but my posts says so, explicitly. Let me recopy my statement once more:</p>
<blockquote><p>I should point out that the same is true of most random number generators in widespread use today. Cryptographic random number generators should probably be used if you want to open a casino.</p></blockquote>
<p>You would prefer, it seems that I give as a title to my post &ldquo;xoroshiro128+ is maximally equidistributed&rdquo;. But I don&rsquo;t think it is correct. That&rsquo;s not what I illustrate. And I think you agree.</p>
<p>You write: &ldquo;You want secure? Use Fortuna, or something like that.&rdquo; Again, please go back to what I wrote: &ldquo;Cryptographic random number generators should probably be used if you want to open a casino.&rdquo;</p>
<p>We are saying the same thing!</p>
</div>
<ol class="children">
<li id="comment-284831" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T07:43:36+00:00">August 23, 2017 at 7:43 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m just saying you are &ldquo;cracking&rdquo; non-secure generators as much as you can crack a figue (as opposed to a walnut). I wouldn&rsquo;t use that word in a referred scientific paper. But then again, it&rsquo;s your blog!</p>
</div>
<ol class="children">
<li id="comment-284840" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T12:05:09+00:00">August 23, 2017 at 12:05 pm</time></a> </div>
<div class="comment-content">
<p>L&rsquo;Ecuyer uses the word &ldquo;cracking&rdquo; in some of his peer-reviewed papers in a similar (non-cryptographic) context.</p>
<p>In any care, we are arguing the choice of a term which feels like unsubstantive to me as far as disagreements go.</p>
</div>
<ol class="children">
<li id="comment-284845" class="comment even depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T13:45:58+00:00">August 23, 2017 at 1:45 pm</time></a> </div>
<div class="comment-content">
<p>Can you point me at the papers please? I can&rsquo;t find anything like that by keyword search&#8230;</p>
</div>
<ol class="children">
<li id="comment-284848" class="comment byuser comment-author-lemire bypostauthor odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T14:32:04+00:00">August 23, 2017 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>See e.g.,</p>
<p>P. L&rsquo;Ecuyer, <a href="http://www-labs.iro.umontreal.ca/~lecuyer/myftp/papers/handstat2.pdf" rel="nofollow">Random Number Generation</a>, Handbook of Computational Statistics, J. E. Gentle, W. Haerdle, and Y. Mori, eds., Second Edition, Springer-Verlag, 2012, 35-71.</p>
<p>Relevant quote:</p>
<blockquote><p>
Generators Based on a Deterministic Recurrence (&#8230;) RNGs with short periods or bad structures are usually easy to crack
</p></blockquote>
<p>You find other instances by other authors such as</p>
<p>J. Reeds, Cracking a random number generator, cryptologia, 1977</p>
<p>He goes on to explain how to &ldquo;crack&rdquo; simple generators (that have not been claimed to be cryptographically strong).</p>
<p>James Roper has a whole <a href="https://jazzy.id.au/2010/09/20/cracking_random_number_generators_part_1.html" rel="nofollow">Cracking Random Number Generators</a> series. He shows how to crack the <a href="https://jazzy.id.au/2010/09/22/cracking_random_number_generators_part_3.html" rel="nofollow">Mersenne Twister</a> among other things.</p>
<p>I believe that it is a very reasonable term. You could, in fact, define a non-cryptographically secured generator as being easily cracked.</p>
<p>Note that people will definitively use such non-cryptographically strong generators for applications where a cryptographically strong generator is needed, precisely because they do not understand that they can get cracked.</p>
<p>What I illustrated in this blog post is not entirely trivial. Many engineers could very reasonably expect it to be difficult to infer the seed from the outputs of xoroshiro128+.</p>
<p>We need to educate people, and if the term &ldquo;cracking&rdquo; sounds a bit scary, then I say &ldquo;good!&rdquo;.</p>
<p>I submit to you that cryptographers will approve of my message. What they would criticize, if this would go through formal peer review&#8230; is the triviality of it all&#8230; They would say &ldquo;oh! but of course it is easy to crack&#8230;&rdquo;</p>
<p>They would point me to Reeds (1977) and say &ldquo;we were cracking simple generators decades ago&rdquo;.</p>
</div>
</article>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-605526" class="comment even depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/813e60cbc6e0c1a5fd16dae6c7b922bc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/813e60cbc6e0c1a5fd16dae6c7b922bc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mads Andersson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-07T09:34:53+00:00">November 7, 2021 at 9:34 am</time></a> </div>
<div class="comment-content">
<p>Could a cryptographic rng be “cracked” with the help of a quantum computer? What would the code look like if you were trying to find the unhashed variable that’s Sha-256 encrypted? A normal computer wouldn’t solve it for hundreds of years. Just wondering what the code would look like.</p>
</div>
<ol class="children">
<li id="comment-605561" class="comment byuser comment-author-lemire bypostauthor odd alt depth-8">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-07T17:14:20+00:00">November 7, 2021 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>I am unaware that quantum computing can crack sha-256. Do you have a reference?</p>
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
</ol>
</li>
</ol>
</li>
<li id="comment-284778" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T16:17:28+00:00">August 22, 2017 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>BTW, can you substantiate your claim</p>
<p>XorShift128+ is a weak random number generator with faulty statistical properties.</p>
<p>There&rsquo;s a published paper with BigCrush results. So I expect you have in mind another paper.</p>
</div>
<ol class="children">
<li id="comment-284781" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T17:11:23+00:00">August 22, 2017 at 5:11 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for your comment. I have rephrased to &ldquo;XorShift128+ is a relatively weak random number generator. Blackman and Vigna recommend upgrading to the stronger xoroshiro128+.&rdquo; You wrote: &ldquo;This generator has been replaced by xoroshiro128plus, which (&#8230;) has better statistical properties.&rdquo; Moreover, in my tests, it fails big crush, e.g., <a href="https://github.com/lemire/testingRNG/blob/master/testu01/results/testxorshift128plus-b-r.log" rel="nofollow">MatrixRank</a>. It also fails <a href="https://github.com/lemire/testingRNG/blob/master/practrand/results/testxorshift128plus.log" rel="nofollow">Pratical Random</a>. <a href="â€ªhttps://lemire.me/blog/2017/08/22/testing-non-cryptographic-random-number-generators-my-results/â€¬" rel="nofollow">I have another blog post on this</a>.</p>
</div>
<ol class="children">
<li id="comment-284794" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dd400ef33efea0f2dbfeee519737bf58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T20:39:32+00:00">August 22, 2017 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d like then to see the code, because it doesn&rsquo;t fail my BigCrush tests at 100 starting points, and TestU01 results are very replicable.</p>
<p>Yes, I know that some far-range test of PractRand failâ€”that&rsquo;s why suggest xoroshiro128+, which doesn&rsquo;t. The level of concern about those specific tests for me is very lowâ€”lower than, say, not generating all 64-bit values or failing more interesting tests.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-284800" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b736113aa1557b9a110b5123d81d5f6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Lemire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T21:24:02+00:00">August 22, 2017 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p><em>The level of concern about those specific tests for me is very low</em></p>
<p>Sure. That&rsquo;s very reasonable.</p>
</div>
</li>
<li id="comment-284805" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/721f64fe2ed2c73ef16d61e15552c532?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/721f64fe2ed2c73ef16d61e15552c532?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.thedetectorist.co.uk" class="url" rel="ugc external nofollow">The detectorist</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-22T22:07:16+00:00">August 22, 2017 at 10:07 pm</time></a> </div>
<div class="comment-content">
<p>Great work Daniel, just by looking at the comments your findings made quite a mess. Debates are interesting and I think that there should be stronger algorithms when it comes to randomness.</p>
</div>
</li>
<li id="comment-284856" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46e8b36770b50dd53aac4a1304ed3535?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sebastiano Vigna</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T15:08:34+00:00">August 23, 2017 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>Dear Daniel,<br/>
Do you think I&rsquo;m stupid? Or I can&rsquo;t read? The complete quote from the paper is</p>
<p>&ldquo;are usually easy to crack by standard statistical tests&rdquo;</p>
<p>Of course, &ldquo;crack&rdquo; here has nothing to do with what you mean. L&rsquo;Ecuyer has decades of experience and would never use words so carelessly.</p>
<p>The other quotation is another nice trick, but short lived: it is a famous paper, and the actual title is</p>
<p>&ldquo;Cracking&rdquo; a random number generator.</p>
<p>Notice the quotes. The author know what&rsquo;s taking about.</p>
<p>This is not a scientific discussion, and I&rsquo;m out of it. You can of course delete this comment (as you disabled replies in the other thread).</p>
</div>
<ol class="children">
<li id="comment-284858" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-23T15:19:16+00:00">August 23, 2017 at 3:19 pm</time></a> </div>
<div class="comment-content">
<p><em>Of course, â€œcrackâ€ here has nothing to do with what you mean. L&rsquo;Ecuyer has decades of experience and would never use words so carelessly.</em></p>
<p>Ok, so if I find that a generator fails at a statistical test, I can say that I cracked it and you will find the term acceptable?</p>
<p>I personally prefer my own use of the word &ldquo;crack&rdquo;.</p>
<p><em>Notice the quotes. The author know what&rsquo;s taking about.</em></p>
<p>It is true that he uses quotes whereas I did not except in my first use the term, but Reeds (who is famous, of course) uses the term with exactly the same meaning as I do here. I&rsquo;ll revise my blog post so that there are quotes around the word &ldquo;crack&rdquo; on every single use of the term. This will put me on par with Reeds.</p>
<p><em>This is not a scientific discussion, and I&rsquo;m out of it.</em></p>
<p>I&rsquo;m sorry if you are offended. That was not my intention.</p>
<p><em> You can of course delete this comment (as you disabled replies in the other thread).</em></p>
<p>I did no such thing as disabling replies in any thread regarding this post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-520448" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2447dd415e3dfaa54ff641cc4266db96?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2447dd415e3dfaa54ff641cc4266db96?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.kasinohai.com/kolikkopelit" class="url" rel="ugc external nofollow">Kasino Hai</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-28T09:24:47+00:00">May 28, 2020 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>my first dev work was for a startup online gambling site. and yes, this was one thing they highlighted &#8211; we didn&rsquo;t rely on XorShift128+ for same reason you covered.</p>
</div>
</li>
<li id="comment-539461" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a8b732e222048c57d67da74338ad1f0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a8b732e222048c57d67da74338ad1f0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://suominettikasinot24.com" class="url" rel="ugc external nofollow">kasinot ilman rekisteröitymistä</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-20T12:44:41+00:00">July 20, 2020 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>Big thanks for code on the Github.</p>
</div>
</li>
</ol>
