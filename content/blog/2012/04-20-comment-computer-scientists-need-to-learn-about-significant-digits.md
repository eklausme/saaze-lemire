---
date: "2012-04-20 12:00:00"
title: "Computer scientists need to learn about significant digits"
index: false
---

[16 thoughts on &ldquo;Computer scientists need to learn about significant digits&rdquo;](/lemire/blog/2012/04-20-computer-scientists-need-to-learn-about-significant-digits)

<ol class="comment-list">
<li id="comment-55200" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bd1e18cd9f224267fe0b5553beda4cb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bd1e18cd9f224267fe0b5553beda4cb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nick Barnes</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T11:20:07+00:00">April 20, 2012 at 11:20 am</time></a> </div>
<div class="comment-content">
<p>Yes, but: much of computer science is not a natural science, or anything much like one; it&rsquo;s a branch of mathematics. How many significant digits does Ï€ have? If some algorithm, on some input, takes (say) 78234 tree-rebalancing operations, then that&rsquo;s the number it takes. Not plus or minus anything. There&rsquo;s no measurement error, there&rsquo;s no experimental error. Should Vassilevska Williams state that her matrix multiplication algorithm has an asymptotic cost of O(n^ two and a bit) ?</p>
<p>Where there are sources of error or variation, for instance in time and space measurements of running systems, particularly of multi-processing environments, particularly of systems connected to instruments or other external interfaces such as UI devices, then I quite agree, the error and variation should be quantified and numbers given to appropriate numbers of significant digits, and often compsci papers fail to do this well enough.</p>
<p>Having said that, the sources of variation may often be controllable, and with care the resulting precision may be greater than many physical scientists could normally achieve. I have personally worked on real running systems which have space measurements reproducible to six or more decimal places, and time measurements reproducible to five or more. If I have that many significant digits, should I state them? My habit was generally to give the full precision in tables but to truncate in running text, for rhetorical purposes.</p>
</div>
</li>
<li id="comment-55194" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ef46915ca77ac4200ee279e9e7274ce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ef46915ca77ac4200ee279e9e7274ce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">A. Non</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T09:35:20+00:00">April 20, 2012 at 9:35 am</time></a> </div>
<div class="comment-content">
<p>Providing additional precision can help convince the reader that you didn&rsquo;t just make the number up.</p>
</div>
</li>
<li id="comment-55196" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T09:44:10+00:00">April 20, 2012 at 9:44 am</time></a> </div>
<div class="comment-content">
<p>@A. Non</p>
<p>Because it is a lot harder to make up the number 304.03 than the number 300?</p>
</div>
</li>
<li id="comment-55197" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f42ed8d314f93a77988b0a7c1b8e1fc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f42ed8d314f93a77988b0a7c1b8e1fc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Federico</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T09:59:34+00:00">April 20, 2012 at 9:59 am</time></a> </div>
<div class="comment-content">
<p>Of course, it is 56.137% harder to make up.</p>
<p>Ok, now back to the serious things&#8230;</p>
<p>Going one step further, I would suggest replacing the numbers with charts whenever possible.</p>
</div>
</li>
<li id="comment-55199" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b9ebecd80a3bf4e94ce4848553dbc195?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b9ebecd80a3bf4e94ce4848553dbc195?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lylebot</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T10:50:26+00:00">April 20, 2012 at 10:50 am</time></a> </div>
<div class="comment-content">
<p>My students routinely turn in work with numbers reported to 15(!) significant digits. Drives me nuts.</p>
</div>
</li>
<li id="comment-55209" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b457c292ceb9b4b96c51c2ddf78e3d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b457c292ceb9b4b96c51c2ddf78e3d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.neilconway.org/" class="url" rel="ugc external nofollow">Neil Conway</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T16:18:56+00:00">April 20, 2012 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>Saying the program&rsquo;s runtime is 300 seconds rather than 304.03 seconds is only a slight improvement. Much better would be to say &ldquo;the mean of k runs was x seconds with variance y&rdquo;, for example.</p>
</div>
</li>
<li id="comment-55201" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7ad4e79a700a791c61ad388aea8e9888?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7ad4e79a700a791c61ad388aea8e9888?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T11:22:07+00:00">April 20, 2012 at 11:22 am</time></a> </div>
<div class="comment-content">
<p>How does this request to express experimental results using fewer digits, goes hand in hand with making papers longer?</p>
</div>
</li>
<li id="comment-55203" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T12:33:23+00:00">April 20, 2012 at 12:33 pm</time></a> </div>
<div class="comment-content">
<p>@Nick</p>
<p>There are good reasons sometimes to go beyond 2&nbsp;significant digits. But doing so without a good reason makes your article and your tables harder to parse.</p>
</div>
</li>
<li id="comment-55204" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/588160d188940251a537e6ca6ab0f298?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/588160d188940251a537e6ca6ab0f298?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://norvig.com" class="url" rel="ugc external nofollow">Peter Norvig</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T12:52:54+00:00">April 20, 2012 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>Sometimes when we say &ldquo;33.14 MB&rdquo; the purpose is not to answer &ldquo;is this significantly different from &ldquo;30 MB&rdquo; but rather (or also) is this identical to the other file over there. To test identity, all digits are significant.</p>
</div>
</li>
<li id="comment-55208" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T16:09:17+00:00">April 20, 2012 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p>33.14 might be significant because it can help determine whether a source of error was the result of overflow or other oddities. Also there is no error, it&rsquo;s not like chemistry where we don&rsquo;t know It&rsquo;s more like math where we objectively know. It would be like deriding mathematicians for not following the rules on significant digits.</p>
</div>
</li>
<li id="comment-55210" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-20T17:26:20+00:00">April 20, 2012 at 5:26 pm</time></a> </div>
<div class="comment-content">
<p>I totally agree&#8230;</p>
<p>Sometimes one can keep digits just out of lazyness, since they are the ouput of a program, copied and pasted in the paper.</p>
</div>
</li>
<li id="comment-55211" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wells</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-21T09:32:07+00:00">April 21, 2012 at 9:32 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think you know what you are talking about.</p>
<p>A significant digit is a digit that you actually measured. If you have in fact measured every byte of a file (And you should be able to.) Then you can report the size of the file to the nearest byte, regardless of if it is a kilobyte file, a megabyte file, a gigabyte file or a terabyte file.</p>
<p>Significant figures come into play when you have precision that your instruments cannot actually measure to. Say you are timing a process and your clock is accurate to the nearest second (Like with a UNIX timestamp or something). If this is true. giving a mean with any numbers after the decimal point is inaccurate.</p>
</div>
</li>
<li id="comment-55212" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ab327913c7fa079d8d940b603e277d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ab327913c7fa079d8d940b603e277d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. Pooh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-21T09:53:14+00:00">April 21, 2012 at 9:53 am</time></a> </div>
<div class="comment-content">
<p>I was taught about significant figures in Grade 10, circa mid-1970s. The rules are about 90% well defined and objective, and about 10% less well defined and subjective.</p>
<p>Context also matters. For example, if the project requires that a software module must execute start to finish in not more than 304.00 seconds, then 304.03 seconds is probably a fail. But ideally one would measure it to a precision at least six to ten times the margin. Most times excess significant figures is nonsense, not context.</p>
<p>&ldquo;100 km/h&rdquo; speed limit might actually be Â±10 km/h. Sign should read &ldquo;100.0 km/h&rdquo;. LOL.</p>
</div>
</li>
<li id="comment-55213" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-21T10:37:14+00:00">April 21, 2012 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>@Wells</p>
<p>The number of significant digits you report is bounded by what you actually measured, but scientists typically report fewer digits, for reasons such as the ones I report.</p>
</div>
</li>
<li id="comment-55214" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3a07404c7102b4e49f94b2605a12e143?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3a07404c7102b4e49f94b2605a12e143?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Billy Ethridge</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-21T16:39:23+00:00">April 21, 2012 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>Logically, using an in-significant digit as if it were significant is &ldquo;the fallacy of misplaced precision&rdquo;. </p>
<p>Context is everything. If I ask you how many miles per gallon you get with your new hybrid car and you say &ldquo;50.52841926 mpg&rdquo;, every digit after &ldquo;50.&rdquo; is likely to be insignificant. The insignificant digits are not meaningfully informative.</p>
</div>
</li>
<li id="comment-55215" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-04-22T01:35:53+00:00">April 22, 2012 at 1:35 am</time></a> </div>
<div class="comment-content">
<p>I made a long-term enemy by publically telling a CalTech PHD that he could not publish a measured performance number to eight significant digits (when two digits was dubious). Also the zero-intercept on the graph could not be at (0,0). First-year Physics students are meant to learn the basic stuff, but apparently not a CalTech PHD.</p>
</div>
</li>
</ol>
