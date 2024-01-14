---
date: "2021-01-29 12:00:00"
title: "Number Parsing at a Gigabyte per Second"
index: false
---

[15 thoughts on &ldquo;Number Parsing at a Gigabyte per Second&rdquo;](/lemire/blog/2021/01-29-number-parsing-at-a-gigabyte-per-second)

<ol class="comment-list">
<li id="comment-571520" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1f902f47839c2e3adc6ef0f58444137?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1f902f47839c2e3adc6ef0f58444137?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Idiot</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-30T08:25:44+00:00">January 30, 2021 at 8:25 am</time></a> </div>
<div class="comment-content">
<p><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/MAX_SAFE_INTEGER" rel="nofollow ugc">https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/MAX_SAFE_INTEGER</a></p>
<p>JavaScript is not 64-bit</p>
</div>
<ol class="children">
<li id="comment-580683" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:31:01+00:00">March 24, 2021 at 11:31 pm</time></a> </div>
<div class="comment-content">
<p>@Idiot</p>
<p>My statement is&#8230;</p>
<blockquote>
<p>JavaScript represents all its numbers, by default, with a 64-bit binary floating-point number type.</p>
</blockquote>
<p>The link you offer supports this statement because it says that we can represent integers exactly up to 2^53, which is what happens under the IEEE binary64 type.</p>
</div>
<ol class="children">
<li id="comment-580684" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T23:32:44+00:00">March 24, 2021 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>@Idiot</p>
<p>The link you offer does confirm my statement, please check.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-571610" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/feadc2cb8784972a136ae3affaa07cea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/feadc2cb8784972a136ae3affaa07cea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ryhl.io/" class="url" rel="ugc external nofollow">Alice Ryhl</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-30T09:45:28+00:00">January 30, 2021 at 9:45 am</time></a> </div>
<div class="comment-content">
<p>Is there any work on replacing the functions for this in the language&rsquo;s respective standard libraries? The Rust implementation seems like it would be a good fit for the Rust standard library, with it having no dependencies and <code>no_std</code> support.</p>
</div>
<ol class="children">
<li id="comment-580664" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T21:39:42+00:00">March 24, 2021 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p><em>Is there any work on replacing the functions for this in the language’s respective standard libraries? </em></p>
<p>It is part of Go as of the latest version.</p>
</div>
</li>
</ol>
</li>
<li id="comment-571616" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f292ab7887c2e8698d013b40e1718e8b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f292ab7887c2e8698d013b40e1718e8b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Suminda Sirinath Salpitikorala Dharmasena</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-30T10:25:17+00:00">January 30, 2021 at 10:25 am</time></a> </div>
<div class="comment-content">
<p>I would like to help out on the Java port but I my requirement is that I can go round trip without having different cache table for float/double to string and string to float/double.</p>
<p>At the moment I am trying to port a DragonBox version (<a href="https://github.com/jk-jeon/dragonbox/" rel="nofollow ugc">https://github.com/jk-jeon/dragonbox/</a>, <a href="https://github.com/jk-jeon/fp/" rel="nofollow ugc">https://github.com/jk-jeon/fp/</a>, <a href="https://github.com/abolz/Drachennest/" rel="nofollow ugc">https://github.com/abolz/Drachennest/</a>) but I am interested in this if it can outperform DragonBox and can go round trip (float/double to string, string to float/double).</p>
</div>
<ol class="children">
<li id="comment-580665" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-24T21:40:46+00:00">March 24, 2021 at 9:40 pm</time></a> </div>
<div class="comment-content">
<p>We provide exact parsing with round-to-even so &ldquo;round trip&rdquo; is not a concern. I have not worked on serialization.</p>
</div>
</li>
</ol>
</li>
<li id="comment-571665" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd55bf483eadf8e81377407a923df5b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Frank Astier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-30T17:17:17+00:00">January 30, 2021 at 5:17 pm</time></a> </div>
<div class="comment-content">
<p>But, when I have to store e.g. a big matrix of floating point numbers, I would do a copy of that contiguous chunk of memory to disk, and vice-versa, possibly throwing in mmap &#8211; precisely to avoid parsing from text?</p>
</div>
<ol class="children">
<li id="comment-571672" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-01-30T18:12:38+00:00">January 30, 2021 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>Right. If you serialize your numbers in binary form, you obviously have no parsing difficulty. In the paper, I also allude to another possibility: you can use hexadecimal floating-point numbers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-572768" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/80f4683be1dcb3417711d4fa52c4e3e6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/80f4683be1dcb3417711d4fa52c4e3e6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://devbret.com/" class="url" rel="ugc external nofollow">Bret Bernhoft</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-05T02:34:22+00:00">February 5, 2021 at 2:34 am</time></a> </div>
<div class="comment-content">
<p>What do you feel accounts for the great differences in bandwidth used by each approach? It would be interesting to test these same computations on multiple different CPUs.</p>
</div>
<ol class="children">
<li id="comment-572869" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-05T13:58:17+00:00">February 5, 2021 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>The paper does cover different CPUs.</p>
</div>
</li>
</ol>
</li>
<li id="comment-636637" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3832d1a47249613c3ad9269443a1b62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://reddit.com/r/fpio" class="url" rel="ugc external nofollow">Piotr Grochowski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-17T12:47:37+00:00">June 17, 2022 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>I made my own floating point input/output method (<a href="https://reddit.com/r/fpio" rel="nofollow ugc">https://reddit.com/r/fpio</a>) How does the performance of r/fpio compare to your benchmark?</p>
</div>
</li>
<li id="comment-652381" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3fc3dd9c29b85b94e274981afb33e197?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3fc3dd9c29b85b94e274981afb33e197?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">My name when spreading silly questions</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-17T09:17:09+00:00">June 17, 2023 at 9:17 am</time></a> </div>
<div class="comment-content">
<p>hello, nice work, but I&rsquo;m unsure about one point:<br/>
the video title reads &lsquo;w/Perfect Accuracy&rsquo;, but in the end you state:<br/>
&lsquo;can do exact computation 99,99% of the time&rsquo;, doe&rsquo;s that mean:<br/>
&lsquo;in 0.01% of time ( cases ) you see an error and can fall back to other algorithm&rsquo;, or<br/>
&lsquo;in 0.01% of cases you get a slightly wrong result, learn to live with it&rsquo;?</p>
</div>
<ol class="children">
<li id="comment-652386" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-17T14:24:08+00:00">June 17, 2023 at 2:24 pm</time></a> </div>
<div class="comment-content">
<p>It is the former: we fallback if needed.</p>
</div>
<ol class="children">
<li id="comment-652388" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3fc3dd9c29b85b94e274981afb33e197?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3fc3dd9c29b85b94e274981afb33e197?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">My name when spreading silly questions</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-17T17:31:03+00:00">June 17, 2023 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>🙂 thank you,</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
