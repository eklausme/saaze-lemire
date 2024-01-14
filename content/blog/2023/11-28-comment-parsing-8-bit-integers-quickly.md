---
date: "2023-11-28 12:00:00"
title: "Parsing 8-bit integers quickly"
index: false
---

[67 thoughts on &ldquo;Parsing 8-bit integers quickly&rdquo;](/lemire/blog/2023/11-28-parsing-8-bit-integers-quickly)

<ol class="comment-list">
<li id="comment-656440" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://dbohdan.com/" class="url" rel="ugc external nofollow">D. Bohdan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-28T21:22:26+00:00">November 28, 2023 at 9:22 pm</time></a> </div>
<div class="comment-content">
<p>Neat! I have noticed a small mistake:</p>
<p><code>memcpy(&amp;digits.as_int, str, sizeof(digits));<br/>
</code></p>
<p>should be</p>
<p><code>memcpy(&amp;digits.as_str, str, sizeof(digits));<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-656593" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-03T18:27:13+00:00">December 3, 2023 at 6:27 pm</time></a> </div>
<div class="comment-content">
<p>I think you&rsquo;re right. Currently, the code doesn&rsquo;t use the <code>as_str</code> field at all. Why do even need the <code>digits</code> union? Am I missing something?</p>
</div>
</li>
<li id="comment-657723" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b261603a5c084079f7706fbce7cdfa62?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b261603a5c084079f7706fbce7cdfa62?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dnnfndmsjs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-30T18:46:49+00:00">December 30, 2023 at 6:46 pm</time></a> </div>
<div class="comment-content">
<p>Nope. The whole trick with enum here is UB. Compiler is allowed to optimize it the way it wants. The proper solution is <code>std::bit_cast</code>. And <code>memcpy</code> is a C function that is not a constexpr, while <code>std::bit_cast</code> while is, allowing to make the whole function a <code>constexpr</code>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656441" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://verisimilitudes.net" class="url" rel="ugc external nofollow">Verisimilitude</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-28T21:50:42+00:00">November 28, 2023 at 9:50 pm</time></a> </div>
<div class="comment-content">
<p>This line, at the very least, means the code only works for little endian machines, right:</p>
<p>digits.as_int &lt;&lt;= (4 &#8211; (len &amp; 0x3)) * 8;</p>
</div>
<ol class="children">
<li id="comment-656459" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T06:03:22+00:00">November 29, 2023 at 6:03 am</time></a> </div>
<div class="comment-content">
<p>For Big Endian, you just need to reverse the bytes, which is typically just one instruction.</p>
<p>Big endian systems are vanishingly rare.</p>
</div>
<ol class="children">
<li id="comment-656461" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://verisimilitudes.net" class="url" rel="ugc external nofollow">Verisimilitude</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T06:10:35+00:00">November 29, 2023 at 6:10 am</time></a> </div>
<div class="comment-content">
<p>Does the C language expression for such consistently map to just one instruction?</p>
<p>The rarity of big endian is no excuse to disregard it in a supposedly high-level language.</p>
</div>
<ol class="children">
<li id="comment-656477" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fbda1a493b9cb3728e5b5ebe14a22317?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fbda1a493b9cb3728e5b5ebe14a22317?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ShinyHappyREM</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T13:20:00+00:00">November 29, 2023 at 1:20 pm</time></a> </div>
<div class="comment-content">
<p>&#062; The rarity of big endian is no excuse to disregard it in a supposedly high-level language</p>
<p>Do you also consider systems that have less/more than 8 bits in a byte or machine word? What about systems that don&rsquo;t use two&rsquo;s complement?</p>
</div>
<ol class="children">
<li id="comment-656533" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://verisimilitudes.net" class="url" rel="ugc external nofollow">Verisimilitude</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-01T06:16:39+00:00">December 1, 2023 at 6:16 am</time></a> </div>
<div class="comment-content">
<p>Yes, I do, and it can be a massive pain.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656479" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T13:55:46+00:00">November 29, 2023 at 1:55 pm</time></a> </div>
<div class="comment-content">
<p>Please see the first rule on my terms of use: <a href="https://lemire.me/blog/terms-of-use/" rel="ugc">https://lemire.me/blog/terms-of-use/</a></p>
<p><em> I copied and paste code form your blog post and it does not compile, it contained a massive security hole, it contained a terrible bug or it crashed my computer. Can I blame you?</em><br/>
<em> No. Lemire’s rule: Blogging is literature, not engineering. Code taken from a blog post should not be expected to work, it is meant to illustrate an idea. Don’t build production systems by copying and pasting random code from the Internet. It will not end well.</em></p>
<p>I do build a lot of code that is meant to be deployed in production systems. The code used on my blog post is not meant for that. I do not run tests on mainframe platforms, for example.</p>
</div>
<ol class="children">
<li id="comment-656532" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5381d81033918d8b4f3566df276d5dfa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://verisimilitudes.net" class="url" rel="ugc external nofollow">Verisimilitude</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-01T06:15:29+00:00">December 1, 2023 at 6:15 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s fair enough. I wasn&rsquo;t trying to be a jerk.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-656482" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12875dcfc2b6c8f0915c15b89a81008f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12875dcfc2b6c8f0915c15b89a81008f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jean-Marc Bourguet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T14:20:49+00:00">November 29, 2023 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>Why would you reverse the string instead of changing 0x640a0100 by 0x010a6400 in big endian, or do I misunderstood the way that part works?</p>
<p>Instead of doing a left shift by a variable amount and a right shift by a constant amount, wouldn&rsquo;t it be profitable to do only a right shift by a variable amount?</p>
</div>
<ol class="children">
<li id="comment-656484" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T14:31:00+00:00">November 29, 2023 at 2:31 pm</time></a> </div>
<div class="comment-content">
<p><em>Why would you reverse the string instead of changing 0x640a0100 by 0x010a6400 in big endian, or do I misunderstood the way that part works?</em></p>
<p>It is almost surely not sufficient. Can you prove that it is?</p>
<p><em>Instead of doing a left shift by a variable amount and a right shift by a constant amount, wouldn’t it be profitable to do only a right shift by a variable amount?</em></p>
<p>Can you share your full code? I&rsquo;d be happy to benchmark it.</p>
</div>
<ol class="children">
<li id="comment-656492" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/12875dcfc2b6c8f0915c15b89a81008f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/12875dcfc2b6c8f0915c15b89a81008f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jean-Marc Bourguet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T18:04:53+00:00">November 29, 2023 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Now that I&rsquo;ve had time to look at it, the issue with simple multiplication for big endian is there will be unwanted carry. So it doesn&rsquo;t work.</p>
<p>Combining the two shifts is essentially the same idea as KWillets and suffers the same issue of validation.</p>
<p>On the other hand, if I&rsquo;m not confused again, you can use</p>
<p><code>uint32_t all_digits = ((digits.as_int | (0x06060606 + digits.as_int)) &amp; 0xF0F0F0F0) == 0;<br/>
</code></p>
<p>which is simpler but doesn&rsquo;t reduces the depth of the chain of dependent instructions, so I fear any gain will depend on the micro-architecture.</p>
<p>And you could use</p>
<p><code>*num = (uint8_t)((UINT32_C(0x640a01) * digits.as_int) &gt;&gt; 24);<br/>
</code></p>
<p>which probably doesn&rsquo;t change anything on 64-bit computers but need only 32 bits x 32 bits -&gt; 32 bits and thus could be useful on non-64-bit machines.</p>
</div>
<ol class="children">
<li id="comment-656497" class="comment byuser comment-author-lemire bypostauthor odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T22:39:27+00:00">November 29, 2023 at 10:39 pm</time></a> </div>
<div class="comment-content">
<p>Yep. I have applied your proposals, see the credit section of the blog post. I will also mention you in the code.</p>
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
<li id="comment-656442" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dbohdan.com/" class="url" rel="ugc external nofollow">D. Bohdan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-28T22:10:00+00:00">November 28, 2023 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p>Sorry, never mind what I wrote about a mistake. I need sleep.</p>
</div>
</li>
<li id="comment-656444" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a16a38cdfe8b2cbd38e8a56ab93238d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a16a38cdfe8b2cbd38e8a56ab93238d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">M</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-28T22:51:16+00:00">November 28, 2023 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t &ldquo;y &lt; 256&rdquo; comparison useless in return? Because value assigned to y is always and&rsquo;ed with 0xff.</p>
</div>
<ol class="children">
<li id="comment-656458" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T06:02:34+00:00">November 29, 2023 at 6:02 am</time></a> </div>
<div class="comment-content">
<p>Thanks. It was a small mistake.</p>
</div>
</li>
<li id="comment-656468" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dbohdan.com/" class="url" rel="ugc external nofollow">D. Bohdan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T09:09:06+00:00">November 29, 2023 at 9:09 am</time></a> </div>
<div class="comment-content">
<p>I wondered whether and how much removing the comparison would speed up parsing. It turns out, a fair bit. On my machine (x86_64, <code>g++ (Ubuntu 11.4.0-1ubuntu1~22.04) 11.4.0</code>) the benchmark goes from</p>
<p><code>parse_uint8_fastswar : 1.51 GB/s 589.6 Ma/s 1.70 ns/d<br/>
</code></p>
<p>to</p>
<p><code>parse_uint8_fastswar : 1.64 GB/s 638.6 Ma/s 1.57 ns/d<br/>
</code></p>
<p>So GCC didn&rsquo;t optimize it away.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656448" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T01:04:30+00:00">November 29, 2023 at 1:04 am</time></a> </div>
<div class="comment-content">
<p>If I&rsquo;ve got my arithmetic right (or left in this case) the lower 3 bytes of 640a01 * (the unshifted digits) will contain three quantities, in little-endian byte order:</p>
<p>the first digit times one<br/>
the first digit times ten plus the second digit<br/>
the first digit times 100 plus the second digit times 10 plus the third digit.</p>
<p>Pick which one to output from the length argument.</p>
<p>This technique also tolerates cruft on the end, so you can unconditionally load 3-4 bytes and still pull the correct value even if bytes to the left overflow (eg &ldquo;9&rdquo; maps to 9/90/900, but the 900 doesn&rsquo;t overflow into the part we want).</p>
</div>
<ol class="children">
<li id="comment-656453" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T02:42:42+00:00">November 29, 2023 at 2:42 am</time></a> </div>
<div class="comment-content">
<p>Sounds brilliant. If I can make it work, I will update with credit to you.</p>
</div>
<ol class="children">
<li id="comment-656457" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T06:02:17+00:00">November 29, 2023 at 6:02 am</time></a> </div>
<div class="comment-content">
<p>The idea works but I am not sure it could be faster.</p>
</div>
<ol class="children">
<li id="comment-656488" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T16:10:14+00:00">November 29, 2023 at 4:10 pm</time></a> </div>
<div class="comment-content">
<p>I see; there are a lot of validation cycles in there that I didn&rsquo;t consider.</p>
<p>One thought on validation is that a well-formed ASCII integer will have the intermediate lanes bounded by 9/99/256 up to the output lane (eg &ldquo;91&rdquo; will have the first two lanes bounded but 910 &gt; 256 in the third). A non-digit input should fail in one of the lanes (using 0/0/0 lower bound).</p>
</div>
</li>
<li id="comment-656489" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d6b5085f437efb513a85c38524d2c4ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dbohdan.com/" class="url" rel="ugc external nofollow">D. Bohdan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T16:38:58+00:00">November 29, 2023 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>It looks like parsing the way KWillets suggests then indexing the result is faster than <code>parse_uint8_swar</code> but slower than <code>parse_uint8_fastswar</code>.</p>
<p><code>int parse_uint8_fastswar_tweak(const char *str, size_t len, uint8_t *num) {<br/>
union {<br/>
uint8_t as_str[4];<br/>
uint32_t as_int;<br/>
} digits;</p>
<p> memcpy(&amp;digits.as_int, str, sizeof(digits));<br/>
digits.as_int ^= 0x30303030;<br/>
digits.as_int *= 0x00640a01;<br/>
*num = digits.as_str[(len &amp; 0x3) - 1];<br/>
return (digits.as_int &amp; 0xf0f0f0f0) == 0 &amp;&amp; len != 0 &amp;&amp; len &lt; 4;<br/>
}</p>
<p>---</p>
<p>volume 25680 bytes<br/>
parse_uint8_swar : 1.04 GB/s 404.3 Ma/s 2.47 ns/d<br/>
parse_uint8_fastswar : 1.51 GB/s 586.4 Ma/s 1.71 ns/d<br/>
parse_uint8_fastswar_tweak : 1.23 GB/s 478.7 Ma/s 2.09 ns/d<br/>
parse_uint8_fromchars : 0.48 GB/s 187.8 Ma/s 5.32 ns/d<br/>
parse_uint8_naive : 0.65 GB/s 252.8 Ma/s 3.96 ns/d<br/>
</code></p>
<p>If you replace indexing with a bit shift, you get performance comparable to <code>parse_uint8_fastswar</code> in a simpler function.</p>
<p><code>int parse_uint8_fastswar_tweak(const char *str, size_t len, uint8_t *num) {<br/>
uint32_t digits;</p>
<p> memcpy(&amp;digits, str, sizeof(digits));<br/>
digits ^= 0x30303030;<br/>
digits *= 0x00640a01;<br/>
*num = (uint8_t)(digits &gt;&gt; (8 * ((len &amp; 0x3) - 1)));<br/>
return (digits &amp; 0xf0f0f0f0) == 0 &amp;&amp; len != 0 &amp;&amp; len &lt; 4;<br/>
}</p>
<p>---</p>
<p>volume 25680 bytes<br/>
parse_uint8_swar : 1.04 GB/s 404.8 Ma/s 2.47 ns/d<br/>
parse_uint8_fastswar : 1.51 GB/s 589.6 Ma/s 1.70 ns/d<br/>
parse_uint8_fastswar_tweak : 1.50 GB/s 584.0 Ma/s 1.71 ns/d<br/>
parse_uint8_fromchars : 0.48 GB/s 186.8 Ma/s 5.35 ns/d<br/>
parse_uint8_naive : 0.64 GB/s 249.5 Ma/s 4.01 ns/d<br/>
</code></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-656455" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/460958ee52f7cebc05d7f5d9c160ba18?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/460958ee52f7cebc05d7f5d9c160ba18?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">walter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T05:19:40+00:00">November 29, 2023 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>Typo: &ldquo;but it was only about 40% than the naive approach&rdquo;</p>
</div>
<ol class="children">
<li id="comment-656456" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T06:01:59+00:00">November 29, 2023 at 6:01 am</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656464" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988205e9bc8866f6b4582c62909f40ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988205e9bc8866f6b4582c62909f40ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Luni</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T07:57:01+00:00">November 29, 2023 at 7:57 am</time></a> </div>
<div class="comment-content">
<p>Are you not allowed to use a lookup table?</p>
<p>if len==1, do the ASCII conversion<br/>
else if len == 2, append two digits into a 16-bit int, subtract 0x0300 to convert the first byte and lookup in a 2560 item sparsely filled table<br/>
else live with a very big table or do the ASCI conversion on the first byte, multiply by 100 and add the len == 2 conversion.</p>
</div>
<ol class="children">
<li id="comment-656480" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T13:57:22+00:00">November 29, 2023 at 1:57 pm</time></a> </div>
<div class="comment-content">
<p>Yes. We can use a lookup table, if only for fun. Do you have an implementation?</p>
</div>
</li>
</ol>
</li>
<li id="comment-656466" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5b398936012c5ab568223ef64750d802?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Samuel Lee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T08:24:28+00:00">November 29, 2023 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>Hmm, doesn&rsquo;t the SWAR method give the wrong return value given an input string like &ldquo;12&gt;&rdquo;? The validation of only having ASCII digits seems to be missing a validation of 0x3A-0x3F.</p>
<p>Also there is possibly room to be faster by shifting the result of the multiplication to the right by a variable amount (based on len), rather than shifting the masked input to the left by a variable amount; the computation of the shift amount is more likely to be able to be done in parallel with other work this way.<br/>
Also the shift amount can be computed with len directly, rather than (len &amp; 0x3), given that the validity of the result is indicated by the return value (i.e we don&rsquo;t care about the shift amount when len&gt;3).</p>
</div>
<ol class="children">
<li id="comment-656481" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T13:58:46+00:00">November 29, 2023 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>The current version should provide complete validation although you are correct that the initial code used in this blog post provided only partial validation.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656471" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05f672bffedf42ac84c809d5ff6d0e21?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05f672bffedf42ac84c809d5ff6d0e21?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jylam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T10:17:51+00:00">November 29, 2023 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>First, great work.</p>
<p>However the test on len!=0 should be at the very start, otherwise the left shift is (((4-0)*8)==32), which is undefined behavior</p>
</div>
<ol class="children">
<li id="comment-656485" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T14:46:21+00:00">November 29, 2023 at 2:46 pm</time></a> </div>
<div class="comment-content">
<p><em>However the test on len!=0 should be at the very start, otherwise the left shift is (((4-0)*8)==32), which is undefined behavior.</em></p>
<p>The C++14 and C17 standards make it defined behaviour. Here is the specification:</p>
<blockquote>
<p>The result of E1 &lt;&lt; E2 is E1 left-shifted E2 bit positions; vacated bits are filled with zeros. If E1 has an unsigned type, the value of the result is E1 x 2^E2, reduced modulo one more than the maximum value representable in the result type.</p>
</blockquote>
</div>
<ol class="children">
<li id="comment-656493" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05f672bffedf42ac84c809d5ff6d0e21?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05f672bffedf42ac84c809d5ff6d0e21?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jylam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T19:12:47+00:00">November 29, 2023 at 7:12 pm</time></a> </div>
<div class="comment-content">
<p>Yes, as you maybe saw on twitter, I was referring to C99 (this behaviour is the same in C89 IIRC). Anyway, better be safe, and in all cases it&rsquo;ll return early if len==0, so that&rsquo;s that.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-656499" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/337b35fa63cb7afb0f033dd3c189ab55?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/337b35fa63cb7afb0f033dd3c189ab55?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Greg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-29T23:46:47+00:00">November 29, 2023 at 11:46 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The from_chars results are disappointing all around. I am puzzled as to why the naive approach is so much faster than the standard library.
</p></blockquote>
<p>Indeed. Part of the reason is the &ldquo;naive&rdquo; function has a fixed upper bound on the number of loop iterations (the `r= len &amp; 0x3 clause). As a result (and I checked in compiler explorer), the compiler always unrolls the loop. std::from_chars allows an unbounded number of leading zeros, so it can&rsquo;t unconditionally unroll the loop (without having a suffix afterwards, I guess).</p>
<p>This doesn&rsquo;t explain all of the performance difference, but, as usual, often getting performance out of code is being very precise about what the actual requirements for the inputs and outputs are.</p>
</div>
</li>
<li id="comment-656504" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/00a25d326bd48185eb262e648f946681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcin Zukowski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-30T08:10:35+00:00">November 30, 2023 at 8:10 am</time></a> </div>
<div class="comment-content">
<p>Cool post, pure fun and a few neat tricks 🙂</p>
<p>Two comments:</p>
<p>If you want to make this routine &ldquo;safe&rdquo; (and hence the comparison really fair), it&rsquo;s enough to check if the input crosses a page boundary, and take a slow path if it is (or have a SWAR version reading from &ldquo;the other side&rdquo;). That should be very branch-predictor safe, so hopefully wouldn&rsquo;t slow things down much. Some hash functions use this approach.<br/>
The benchmarks give some advantage to SWAR considering you&rsquo;re using a uniform distribution in range 0..255, making the average string length 2.23. There might be use cases where the expected number of digits is smaller, and then SWAR might be less beneficial or even slower.</p>
<p>But I&rsquo;m nitpicking here 🙂</p>
</div>
<ol class="children">
<li id="comment-656514" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-30T13:35:27+00:00">November 30, 2023 at 1:35 pm</time></a> </div>
<div class="comment-content">
<ol>
<li>
<p>The first version of our fast JSON parser (simdjson) was page-boundary aware… but this gave us much trouble because people using sanitizers or valgrind would report bugs. I tried arguing back but it became tiresome. So the current version of simdjson use padded strings. It works well. I have a friend who writes string functions for a runtime library, but they get their code to be excluded from valgrind checks and sanitizers… so people don’t see anything… The use case for the function in this blog post is simdzone (parsing zone files for DNS systems) in which case the author knows that the input is padded.</p>
</li>
<li>
<p>The SWAR version is faster even in the case where we have a sequential input. So it has good chances of being faster in practice. Still people should benchmark on the data they care about!</p>
</li>
</ol>
</div>
<ol class="children">
<li id="comment-656522" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-30T18:10:34+00:00">November 30, 2023 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p>Is regular old SIMD on the menu? The byte range-checking would certainly be easier, and shuffling of quartets etc.</p>
</div>
<ol class="children">
<li id="comment-656523" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-30T18:39:19+00:00">November 30, 2023 at 6:39 pm</time></a> </div>
<div class="comment-content">
<p>I actually think SIMD might be more practical.</p>
<p>But one has to have a good SWAR implementation to compare with!!!</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-656534" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Dunphy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-01T06:29:53+00:00">December 1, 2023 at 6:29 am</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>Since reading up to 4 bytes from str is OK, here is another non-SWAR implementation that runs equally fast for the random and sequential cases:</p>
<p><code>int parse_uint8_naive_md(const char *str, size_t len, uint8_t *num) {<br/>
if (--len &gt; 2) return 0;<br/>
static const uint8_t sf[] = {0,0,1,10,100}; // scale factor<br/>
uint64_t d1, d2, d3, s1, s2, s3, n;<br/>
d1 = (uint64_t)str[0] - (uint64_t)'0';<br/>
d2 = (uint64_t)str[1] - (uint64_t)'0';<br/>
d3 = (uint64_t)str[2] - (uint64_t)'0';<br/>
s1 = (uint64_t)sf[len+2];<br/>
s2 = (uint64_t)sf[len+1];<br/>
s3 = (uint64_t)sf[len];<br/>
n = s1*d1 + s2*d2 + s3*d3;<br/>
*num = (uint8_t)n;<br/>
return n &lt; 256 &amp;&amp; d1&lt;10 &amp;&amp; d2&lt;10 &amp;&amp; d3&lt;10;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-656539" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-01T13:49:48+00:00">December 1, 2023 at 1:49 pm</time></a> </div>
<div class="comment-content">
<p>Interesting approach, but I think it does not work as is.</p>
<p>What if the input is a digit followed by random bytes, and the len is set to 1? Your return value depends on std[1] and str[2] which can be garbage.</p>
</div>
<ol class="children">
<li id="comment-656553" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Dunphy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-02T06:51:05+00:00">December 2, 2023 at 6:51 am</time></a> </div>
<div class="comment-content">
<p>Good catch! At the expense of a couple more checks, it should be fixed with:</p>
<p><code>return n &lt; 256 &amp;&amp; d1&lt;10 &amp;&amp; (s2==0 || d2&lt;10) &amp;&amp; (s3 == 0 || d3&lt;10);<br/>
</code></p>
<p>Meanwhile, for what it&rsquo;s worth, the performance (of all of the implementations here) appears to be sensitive to the mixture of inputs from the [0,255] range and the [256,999] range. It must be primarily due to the short circuiting of the various terms in the return value expressions. (The quick test is to change val to uint16_t and change %256 to %1000 in the benchmarker; otherwise the inputs are all &lt;256 and we don&rsquo;t need that validation&#8230;).</p>
<p>Presumably the performance will also depend on the mixture of invalid inputs as well (cases where len=0, len&gt;3, or non digit chars).</p>
</div>
<ol class="children">
<li id="comment-656558" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-02T20:00:16+00:00">December 2, 2023 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>The fast function from the blog post should compile to branchless, except for the length parameter, see the assembly in the blog post. If you use lengths that outside the allowed range ([1,3]) then the performance can vary&#8230; But otherwise, it should be flat. The function&rsquo;s performance is not data dependent. You can see in my table of results.</p>
<p>Make sure your build your code in release mode with full optimizations.</p>
</div>
<ol class="children">
<li id="comment-656561" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Dunphy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-02T20:45:11+00:00">December 2, 2023 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>I agree that the fastswar performance is flat between sequential and random. I am finding that using values in [0,999] is a bit faster (about +13%, the mixture is approx 25%/75% valid/invalid), and even faster for values in [256,999] (about +18%, which 100% invalid values). The fastswar return statement uses &amp; and not &amp;&amp; so indeed that does not short-circuit&#8230; so I&rsquo;m not sure what is the source of that extra performance for inputs &gt;255.</p>
</div>
<ol class="children">
<li id="comment-656568" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Dunphy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-03T00:31:32+00:00">December 3, 2023 at 12:31 am</time></a> </div>
<div class="comment-content">
<p>Scratch that; I was looking at the wrong metric (GB/s)</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-656636" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T21:36:16+00:00">December 4, 2023 at 9:36 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think that the following is sufficient because you don&rsquo;t know the state of s2 and s3, at least in how I interpret the benchmark.</p>
<blockquote>
<p>return n &lt; 256 &amp;&amp; d1&lt;10 &amp;&amp; (s2==0 || d2&lt;10) &amp;&amp; (s3 == 0 || d3&lt;10);</p>
</blockquote>
</div>
<ol class="children">
<li id="comment-656640" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ef211ae538a5474d0ffd73721711903?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael Dunphy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-05T00:52:26+00:00">December 5, 2023 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>If we get past the first line, len will be 0, 1 or 2 (decremented by 1 from the initial 1, 2 or 3). When len=0, s1,s2,s3=1,0,0, for len=1, s1,s2,s3=10,1,0 and for len=3, s1,s2,s3 = 100,10,1. So s1,s2,s3 are always assigned. If s2 is zero we don&rsquo;t care about the value of d2 (so the || short circuits), but if s2 is nonzero then we do need to check d2. Similar for s3 &amp; d3. It&rsquo;s a bit contorted in pursuit of avoiding branches.</p>
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
<li id="comment-656547" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/239ffc2c5c469a1fe9389bd5b42e6aec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/239ffc2c5c469a1fe9389bd5b42e6aec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jason M</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-02T01:44:36+00:00">December 2, 2023 at 1:44 am</time></a> </div>
<div class="comment-content">
<p>I got nerdsniped by this a bit. I think your approach is getting close to optimal, it&#039;s hard to beat a constant time operation that has a small constant. Nevertheless, my stab at trying to go faster involves creating a perfect hash table, with a very fast hash function (the key is the four byte string cast to a u32). Obviously it trades quite a bit of space for some speed. It could probably be compacted in space with a bit of tweaking. This isn&#039;t a complete solution as it does not do all the error checking and what not, but I believe this could be made to go a bit faster than the parse_uint8_fastswar, as it should have a smaller constant. To parse the ascii int, it must be padded with nuls up to the four bytes, and should be aligned properly so the casting works. Then the parse should just be something like so: `<br/>
lut[simple_hash((unsigned*)(str))];</p>
<p>Lut building code follows:</p>
<p>define SIZE 16384</p>
<p>uint8_t lut[SIZE] = {};</p>
<p>uint32_t simple_hash(uint32_t u32_value) {<br/>
const uint32_t shift = 32;<br/>
uint64_t hash_val = (uint64_t)u32_value * 1000000000000000000;<br/>
hash_val = (hash_val &gt;&gt; 32) % SIZE;<br/>
return (uint32_t)hash_val;<br/>
}</p>
<p>void build_lut() {<br/>
char strings[256*4];<br/>
memset(strings, 0, sizeof(strings));<br/>
char *iter = strings;<br/>
for (int i = 0; i &amp;lt; 256; ++i) {<br/>
sprintf(iter, &amp;quot;%d&amp;quot;, i);<br/>
iter += 4;<br/>
}<br/>
iter = strings;<br/>
for (int i = 0; i &amp;lt; 256; ++i) {<br/>
unsigned c = *(unsigned*) iter;<br/>
iter += 4;<br/>
unsigned idx = simple_hash(c) % SIZE;<br/>
lut[idx] = i;<br/>
}<br/>
}<br/>
</p>
</div>
<ol class="children">
<li id="comment-656554" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/239ffc2c5c469a1fe9389bd5b42e6aec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/239ffc2c5c469a1fe9389bd5b42e6aec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jason M</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-02T07:11:38+00:00">December 2, 2023 at 7:11 am</time></a> </div>
<div class="comment-content">
<p>The formatting got butchered a bit.</p>
<p>I have posted a cleaned up version here:</p>
<p><a href="https://blog.loadzero.com/blog/parse-int-nerdsnipe/" rel="nofollow ugc">https://blog.loadzero.com/blog/parse-int-nerdsnipe/</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-656590" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bruce A MacNaughton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-03T14:26:24+00:00">December 3, 2023 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Wonderful article &#8211; I really enjoy this kind of work. The only bad part is that I spent a bit of time implementing this in Rust and took some time to fully understand some of your &ldquo;magic&rdquo;.</p>
<p>One minor observation &#8211; I believe that <code>((digits.as_int | (0x06060606 + digits.as_int))</code> doesn&rsquo;t need the <code>digits.as_int |</code> component. My test suite passes fully without it.</p>
<p>My rust implementation (can&rsquo;t seem to get the formatting quite right):`</p>
<p><code>fn make_u8(s: &amp;str) -&gt; Option&lt;u8&gt; {<br/>
if s.is_empty() || s.len() &gt; 3 {<br/>
return None;<br/>
}<br/>
let bytes = s.as_bytes();</p>
<p>// using a union avoids branching on the length to initialize each byte<br/>
// of the u32 interpretation.<br/>
let mut working = unsafe {<br/>
#[repr(C)]<br/>
union U {<br/>
bytes: [u8; 4],<br/>
num: u32,<br/>
}<br/>
// could use uninit here to avoid initialization...<br/>
let mut u = U { num: 0 };<br/>
u.bytes[..s.len()].copy_from_slice(&amp;bytes[..s.len()]);<br/>
u.num<br/>
};</p>
<p>working ^= 0x30303030;</p>
<p>working &lt;&lt;= (4 - s.len()) * 8;</p>
<p>// Wrapping prevents panics on overflow.<br/>
let mult = Wrapping(0x640a01) * Wrapping(working);<br/>
// unwrap it now (could just use .0 but this is more explicit)<br/>
let Wrapping(mult) = mult;</p>
<p>let num = (mult &gt;&gt; 24) as u8;</p>
<p>let all_digits = (0x06060606 + working) &amp; 0xF0F0F0F0 == 0;<br/>
let swapped = u32::from_be_bytes(working.to_le_bytes());</p>
<p>if !all_digits || swapped &gt; 0x00020505 {<br/>
return None;<br/>
}</p>
<p>Some(num)<br/>
</code></p>
<p>}</p>
</div>
<ol class="children">
<li id="comment-656597" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-03T22:06:19+00:00">December 3, 2023 at 10:06 pm</time></a> </div>
<div class="comment-content">
<p>I think the <code>digits.as_int |</code> part is necessary to catch bad input that contains characters with byte values 0 to 9, e.g. <code>"12\003"</code>.</p>
</div>
<ol class="children">
<li id="comment-656598" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-03T22:13:55+00:00">December 3, 2023 at 10:13 pm</time></a> </div>
<div class="comment-content">
<p>Oh, I was wrong. These cases are caught by <code>0x06060606 + digits.as_int</code> as well.</p>
</div>
<ol class="children">
<li id="comment-656638" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T22:33:21+00:00">December 4, 2023 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>The <code>digits.as_int |</code> part is necessary to catch bad input that contains characters with byte values <code>0xCA</code> to <code>0xCF</code>. See <a href="https://github.com/jcsahnwaldt/parse_uint8_fastswar" rel="nofollow ugc">https://github.com/jcsahnwaldt/parse_uint8_fastswar</a></p>
</div>
<ol class="children">
<li id="comment-656694" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-06T18:58:23+00:00">December 6, 2023 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>@Bruce: Your tests pass without the <code>digits.as_int |</code> part because they don&rsquo;t actually test the byte values <code>0xCA</code> to <code>0xCF</code>, although they <em>seem</em> to test values up to <code>0xFF</code>.</p>
<p>The reason is that a Rust <code>str</code> contains UTF-8 bytes, not arbitrary bytes, and e.g. the value <code>0xFF</code> gets converted to the two bytes <code>0xC3</code> and <code>0xBF</code>.</p>
<p>I posted an issue: <a href="https://github.com/bmacnaughton/u8-swar/issues/1" rel="nofollow ugc">https://github.com/bmacnaughton/u8-swar/issues/1</a></p>
</div>
<ol class="children">
<li id="comment-656701" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bruce A MacNaughton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-07T01:40:02+00:00">December 7, 2023 at 1:40 am</time></a> </div>
<div class="comment-content">
<p>It fails at 0xCA</p>
</div>
</li>
</ol>
</li>
<li id="comment-656700" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bruce A MacNaughton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-07T01:38:21+00:00">December 7, 2023 at 1:38 am</time></a> </div>
<div class="comment-content">
<p>yes, you&rsquo;re right &#8211; thank you. I ignored Unicode characters (and their encoding). I will have some additional tests to verify that (and will add the OR&rsquo;d digits.as_int back in).</p>
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
<li id="comment-656591" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6f522ea097cebf1f5bae387efaddd84d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bruce A MacNaughton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-03T15:04:43+00:00">December 3, 2023 at 3:04 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know what happened to the formatting of my previous post, so here&rsquo;s a link to the code: <a href="https://github.com/bmacnaughton/u8-swar" rel="nofollow ugc">https://github.com/bmacnaughton/u8-swar</a>.</p>
</div>
</li>
<li id="comment-656627" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b13deba744c5599a43e06f52af13366?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b13deba744c5599a43e06f52af13366?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick Powell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T15:10:46+00:00">December 4, 2023 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>I had a go at a simple LUT-based approach, which seems to be faster in most situations I&rsquo;ve tested, with a few caveats: <a href="https://quick-bench.com/q/r0wfNuy0JI0ZWT893FoR0oJHpSc" rel="nofollow ugc">https://quick-bench.com/q/r0wfNuy0JI0ZWT893FoR0oJHpSc</a></p>
<p>There&rsquo;s no hash table here, I just reinterpreted the 3-byte string as the index into a 8MB array containing every possible result. Despite needing so much memory, only small parts of the array are actually accessed in practice (the ones containing valid values) so it doesn&rsquo;t waste much cache space</p>
<p>There are two versions &#8211; one where I&rsquo;ve transformed the input strings in advance to pad them with nulls, so they can be directly interpreted as an integer, and one that works with the original string data by masking out the unwanted bytes. The version that uses padded strings is almost always faster by a large margin, but it&rsquo;s kind of cheating so I put in the version with the mask as a more fair comparison</p>
<p>Some things I&rsquo;ve noticed:<br/>
* The results vary quite a lot depending on whether you use or discard the return code. If you comment out &lsquo;benchmark::DoNotOptimize(valid);&rsquo; from the benchmarks, the bit-twiddling functions get much faster<br/>
* Clang seems to be much better at optimising this than GCC<br/>
* The LUT-based approach seems to randomly vary in performance more than the others, which isn&rsquo;t surprising since it relies much more on data remaining in the cache, and could be affected by other processes on the machine</p>
</div>
<ol class="children">
<li id="comment-656629" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T15:32:19+00:00">December 4, 2023 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p><em>The results vary quite a lot depending on whether you use or discard the return code.</em></p>
<p>That&rsquo;s likely because your functions are inline-able. If you check my benchmark, you will notice that the functions are compiled separately. That&rsquo;s by design: I do not want inlining as it changes the problem.</p>
<p><em> Clang seems to be much better at optimising this than GCC</em></p>
<p>On my test machine, I get with GCC 12 :</p>
<pre>

parse_uint8_fastswar_bob                 :   1.14 GB/s  443.3 Ma/s   2.26 ns/d   3.20 GHz   7.21 c/d  33.01 i/d   2.80 c/b  12.83 i/b   4.58 i/c 
parse_uint8_fastswar                     :   1.04 GB/s  403.3 Ma/s   2.48 ns/d   3.20 GHz   7.92 c/d  36.01 i/d   3.08 c/b  13.99 i/b   4.54 i/
</pre>
<p>And with clang 16&#8230;</p>
<pre>
parse_uint8_fastswar_bob                 :   1.11 GB/s  430.2 Ma/s   2.32 ns/d   3.20 GHz   7.43 c/d  30.01 i/d   2.89 c/b  11.66 i/b   4.04 i/c 
parse_uint8_fastswar                     :   1.14 GB/s  444.3 Ma/s   2.25 ns/d   3.20 GHz   7.19 c/d  32.01 i/d   2.79 c/b  12.44 i/b   4.45 i/
</pre>
<p>So it is mixed bag but I don&rsquo;t see a large difference.</p>
</div>
<ol class="children">
<li id="comment-656630" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b13deba744c5599a43e06f52af13366?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b13deba744c5599a43e06f52af13366?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick Powell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T16:20:11+00:00">December 4, 2023 at 4:20 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
That’s likely because your functions are inline-able.
</p></blockquote>
<p>Ah, that explains it. Here&rsquo;s the same benchmark using &#095;&#095;attribute&#095;&#095;((noinline)): <a href="https://quick-bench.com/q/80Z_47-AYurJITIaCzYCntYjg9A" rel="nofollow ugc">https://quick-bench.com/q/80Z_47-AYurJITIaCzYCntYjg9A</a></p>
<p>Also, when I run the benchmarks on my machine (linux running in WSL on a Ryzen 5800X), I get this:</p>
<p><code>GCC 12:<br/>
parse_uint8_fastswar_bob : 1.55 GB/s 604.2 Ma/s 1.66 ns/d<br/>
parse_uint8_fastswar : 1.60 GB/s 625.0 Ma/s 1.60 ns/d<br/>
parse_uint8_swar : 1.43 GB/s 559.3 Ma/s 1.79 ns/d<br/>
parse_uint8_lut_padded : 1.71 GB/s 668.0 Ma/s 1.50 ns/d<br/>
parse_uint8_lut_masked : 1.86 GB/s 726.0 Ma/s 1.38 ns/d<br/>
parse_uint8_fromchars : 0.61 GB/s 237.8 Ma/s 4.21 ns/d<br/>
parse_uint8_naive : 0.91 GB/s 355.9 Ma/s 2.81 ns/d </p>
<p>Clang 15:<br/>
parse_uint8_fastswar_bob : 1.73 GB/s 673.2 Ma/s 1.49 ns/d<br/>
parse_uint8_fastswar : 1.70 GB/s 659.8 Ma/s 1.52 ns/d<br/>
parse_uint8_swar : 1.23 GB/s 478.4 Ma/s 2.09 ns/d<br/>
parse_uint8_lut_padded : 2.07 GB/s 802.9 Ma/s 1.25 ns/d<br/>
parse_uint8_lut_masked : 1.78 GB/s 691.3 Ma/s 1.45 ns/d<br/>
parse_uint8_fromchars : 0.72 GB/s 281.3 Ma/s 3.55 ns/d<br/>
parse_uint8_naive : 0.96 GB/s 372.6 Ma/s 2.68 ns/d<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-656635" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b13deba744c5599a43e06f52af13366?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b13deba744c5599a43e06f52af13366?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick Powell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T19:55:57+00:00">December 4, 2023 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>I also tried running the benchmark on my laptop (linux with an alder lake processor), and saw some enormous improvements over the SWAR approaches (with clang at least, I&rsquo;m still not sure why GCC does so badly on my machines). -march=native also makes quite a difference, especially for fastswar_bob:</p>
<p><code>GCC 12<br/>
parse_uint8_fastswar_bob : 1.94 GB/s 755.2 Ma/s 1.32 ns/d<br/>
parse_uint8_fastswar : 1.84 GB/s 713.9 Ma/s 1.40 ns/d<br/>
parse_uint8_lut_padded : 1.96 GB/s 761.1 Ma/s 1.31 ns/d<br/>
parse_uint8_lut_masked : 1.99 GB/s 773.1 Ma/s 1.29 ns/d </p>
<p>GCC 12 with -march=native:<br/>
parse_uint8_fastswar_bob : 1.90 GB/s 738.0 Ma/s 1.35 ns/d<br/>
parse_uint8_fastswar : 1.85 GB/s 720.3 Ma/s 1.39 ns/d<br/>
parse_uint8_lut_padded : 1.95 GB/s 757.7 Ma/s 1.32 ns/d<br/>
parse_uint8_lut_masked : 1.99 GB/s 773.7 Ma/s 1.29 ns/d </p>
<p>clang 15:<br/>
parse_uint8_fastswar_bob : 1.85 GB/s 719.6 Ma/s 1.39 ns/d<br/>
parse_uint8_fastswar : 2.19 GB/s 851.0 Ma/s 1.18 ns/d<br/>
parse_uint8_lut_padded : 4.02 GB/s 1560.5 Ma/s 0.64 ns/d<br/>
parse_uint8_lut_masked : 2.98 GB/s 1158.7 Ma/s 0.86 ns/d </p>
<p>clang 15 with -march=native:<br/>
parse_uint8_fastswar_bob : 2.36 GB/s 918.9 Ma/s 1.09 ns/d<br/>
parse_uint8_fastswar : 2.41 GB/s 937.0 Ma/s 1.07 ns/d<br/>
parse_uint8_lut_padded : 4.02 GB/s 1561.2 Ma/s 0.64 ns/d<br/>
parse_uint8_lut_masked : 3.30 GB/s 1281.0 Ma/s 0.78 ns/d<br/>
</code></p>
<p>Here&rsquo;s the fork I used: <a href="https://github.com/PowellNGL/Code-used-on-Daniel-Lemire-s-blog" rel="nofollow ugc">https://github.com/PowellNGL/Code-used-on-Daniel-Lemire-s-blog</a></p>
</div>
<ol class="children">
<li id="comment-656639" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-04T22:34:03+00:00">December 4, 2023 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>Added with credit and some small modifications. I can confirm that GCC is slower. It seems to use more instructions to get the job done when using a LUT (about 5 extra instructions).</p>
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
<li id="comment-656748" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-08T19:39:02+00:00">December 8, 2023 at 7:39 pm</time></a> </div>
<div class="comment-content">
<p>Here&rsquo;s another Rust version:</p>
<p><code>fn parse_uint8_fastswar(b: &amp;[u8]) -&gt; Option&lt;u8&gt; {<br/>
if b.len() == 0 || b.len() &gt; 3 { return None; }<br/>
let p = b.as_ptr() as *const u32;<br/>
let mut digits = unsafe { p.read_unaligned() };<br/>
digits ^= 0x30303030;<br/>
digits &lt;&lt;= (4 - b.len()) * 8;<br/>
let num = ((digits.wrapping_mul(0x640a01)) &gt;&gt; 24) as u8;<br/>
let all_digits = ((digits | (digits.wrapping_add(0x06060606))) &amp; 0xF0F0F0F0) == 0;<br/>
(all_digits &amp;&amp; digits.swap_bytes() &lt;= 0x020505).then_some(num)<br/>
}<br/>
</code></p>
<p>According to <a href="https://godbolt.org/z/Ts8xrqnc7" rel="nofollow ugc">https://godbolt.org/z/Ts8xrqnc7</a>, the resulting assembly code is very similar to the C version:</p>
<p><code>lea rax, [rsi - 4]<br/>
cmp rax, -3<br/>
jae .LBB3_2<br/>
xor eax, eax<br/>
ret<br/>
.LBB3_2:<br/>
mov eax, 808464432<br/>
xor eax, dword ptr [rdi]<br/>
neg sil<br/>
shl sil, 3<br/>
mov ecx, esi<br/>
shl eax, cl<br/>
imul edx, eax, 6556161<br/>
shr edx, 24<br/>
lea ecx, [rax + 101058054]<br/>
or ecx, eax<br/>
test ecx, -252645136<br/>
sete cl<br/>
bswap eax<br/>
cmp eax, 132358<br/>
setb al<br/>
and al, cl<br/>
ret<br/>
</code></p>
<p>I haven&rsquo;t run benchmarks yet. I hope this might be slightly faster than C because <code>Option&lt;u8&gt;</code> is returned in two registers, so there&rsquo;s no write through a pointer.</p>
</div>
<ol class="children">
<li id="comment-656749" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-08T19:41:26+00:00">December 8, 2023 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>See <a href="https://github.com/jcsahnwaldt/parse_uint8_fastswar" rel="nofollow ugc">https://github.com/jcsahnwaldt/parse_uint8_fastswar</a>. I&rsquo;ll add tests and benchmarks later.</p>
</div>
<ol class="children">
<li id="comment-656800" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8353c161a81f235f16a946af90e0d21a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Sahnwaldt</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-10T12:25:19+00:00">December 10, 2023 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p>The benchmark results are somewhat inconclusive. Depending on CPU (Intel Xeon, Apple M2, Amazon Graviton) and compiler (GCC, Clang):</p>
<p>Sometimes Rust is faster than C, sometimes slower<br/>
Sometimes a C function returning an option in two registers is faster than writing the result through a pointer, sometimes slower<br/>
Sometimes <code>fastswar</code> is faster than <code>fastswar_bob</code>, sometimes slower<br/>
Sometimes one of the <code>fastswar_*</code> versions is as fast as the <code>lut</code> version, but usually <code>lut</code> is the fastest </p>
<p>See the fork at <a href="https://github.com/jcsahnwaldt/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/11/28" rel="nofollow ugc">https://github.com/jcsahnwaldt/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/11/28</a> for details.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-657781" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/541195d19568227b26a06601284d2441?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/541195d19568227b26a06601284d2441?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">DoesNotMatter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2024-01-01T18:00:58+00:00">January 1, 2024 at 6:00 pm</time></a> </div>
<div class="comment-content">
<p>Here is the thing. Your code sucks!</p>
<p>It just causes UB and after that &#8211; your code is not C/C++. It is writen for SUPER specific case (little-endian architecture, specific compiler which ignores UB, caused by reading more numbers that is allowed, etc).</p>
<p>And, more than that, it is absoultely unreadable. I just have written the most stupid code I could imagine:</p>
<p><code>static int parse_uint8_switch_case(const char *str, size_t len, uint8_t *num) {<br/>
uint8_t hi, mid, lo;</p>
<p> #define as_u8(x) ((uint8_t)((x) - '0'))</p>
<p> switch(len) {<br/>
case 1:<br/>
*num = as_u8(str[0]);<br/>
return *num &lt; 10;<br/>
case 2:<br/>
hi = as_u8(str[0]);<br/>
lo = as_u8(str[1]);<br/>
*num = hi * 10 + lo;<br/>
return (hi &lt; 10) &amp;&amp; (lo &lt; 10);<br/>
case 3:<br/>
hi = as_u8(str[0]);<br/>
mid = as_u8(str[1]);<br/>
lo = as_u8(str[2]);<br/>
*num = hi * 100 + mid * 10 + lo;<br/>
return (hi &lt; 10) &amp;&amp; (mid &lt; 10) &amp;&amp; (lo &lt; 10);</p>
<p> default:<br/>
return 0;<br/>
}</p>
<p> #undef as_u8<br/>
}<br/>
</code></p>
<p>And then just <a href="https://quick-bench.com/q/MHqXbsyNeOh3wc02A0tf4Pj2zL0" rel="nofollow ugc">launched it here</a></p>
<p>The results on the screenshot</p>
<p>So. I cannot read your code, it causes UB and after all it just slow)</p>
</div>
<ol class="children">
<li id="comment-657790" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2024-01-01T20:56:41+00:00">January 1, 2024 at 8:56 pm</time></a> </div>
<div class="comment-content">
<p><em>Here is the thing. Your code sucks!</em></p>
<p>The blog post addresses your criticism, explicitly so:</p>
<ul>
<li><em>Suppose that you can always read 4 bytes, even if the string is shorter (i.e., there is a buffer).</em> </li>
<li><em>In production code where you do not know the target platform, you would want to reverse the bytes when the target is a big-endian system. Big endian systems are vanishingly rare: mostly just mainframes. Modern systems compile a byte reversal to a single fast instructions. For code on my blog post, I assume that you do not have a big-endian system which is 99.99% certain.</em> </li>
</ul>
<p>You claim that there is UB, but you don&rsquo;t explain why.</p>
<p>As for code readability, that&rsquo;s an important issue, of course. But then the blog post is specifically about optimizing for performance.</p>
<p>For your benchmark, you use sequential numbers. The blog posts explains that the approach being presented is only very beneficial when the inputs are unpredictable, it says so: <em>So the SWAR approach is twice as fast as the naive approach when the inputs are unpredictable.</em></p>
<p>If your input is predictable, then sure, a naive implementation works. That&rsquo;s already covered by the blog post.</p>
<p>On my MacBook (Apple M2, LLVM14):</p>
<pre>
volume 51473 bytes
parse_uint8_switch_case                  :   0.76 GB/s  295.6 Ma/s   3.38 ns/d 
parse_uint8_fastswar_bob                 :   1.81 GB/s  702.8 Ma/s   1.42 ns/d 
parse_uint8_fastswar                     :   1.51 GB/s  585.4 Ma/s   1.71 ns/d 
parse_uint8_lut                          :   1.81 GB/s  702.8 Ma/s   1.42 ns/d 
parse_uint8_swar                         :   1.67 GB/s  647.8 Ma/s   1.54 ns/d 
parse_uint8_fromchars                    :   0.39 GB/s  150.9 Ma/s   6.62 ns/d 
parse_uint8_naive                        :   0.76 GB/s  294.7 Ma/s   3.39 ns/d 
</pre>
<p>On GCC12 with an Intel Ice Lake processor.</p>
<pre>
parse_uint8_switch_case                  :   0.54 GB/s  211.6 Ma/s   4.73 ns/d   3.19 GHz  15.09 c/d  34.07 i/d   5.86 c/b  13.24 i/b   2.26 i/c 
parse_uint8_fastswar_bob                 :   1.14 GB/s  443.0 Ma/s   2.26 ns/d   3.20 GHz   7.21 c/d  33.01 i/d   2.80 c/b  12.83 i/b   4.58 i/c 
parse_uint8_fastswar                     :   1.04 GB/s  402.6 Ma/s   2.48 ns/d   3.20 GHz   7.94 c/d  36.01 i/d   3.08 c/b  13.99 i/b   4.54 i/c 
parse_uint8_lut                          :   1.17 GB/s  456.5 Ma/s   2.19 ns/d   3.20 GHz   7.00 c/d  32.01 i/d   2.72 c/b  12.44 i/b   4.57 i/c 
parse_uint8_swar                         :   0.87 GB/s  337.5 Ma/s   2.96 ns/d   3.20 GHz   9.47 c/d  43.01 i/d   3.68 c/b  16.71 i/b   4.54 i/c 
parse_uint8_fromchars                    :   0.37 GB/s  143.4 Ma/s   6.97 ns/d   3.19 GHz  22.27 c/d  57.89 i/d   8.65 c/b  22.50 i/b   2.60 i/c 
parse_uint8_naive                        :   0.54 GB/s  210.5 Ma/s   4.75 ns/d   3.19 GHz  15.17 c/d  44.95 i/d   5.90 c/b  17.46 i/b   2.96 i/c 
</pre>
<p>As you can see, your code is running at about half the speed as <tt>parse_uint8_fastswar_bob</tt> and <tt> parse_uint8_lut</tt>. In fact, it has the same performance as <tt>parse_uint8_naive</tt> in my tests.</p>
<p>As for the criticism that the code posted on my blog is not ready for production, please see <a href="https://lemire.me/blog/terms-of-use/" rel="ugc">my terms of use</a>. It is by design. The code presented in my blog posts is not meant to be copied and pasted into your projects.</p>
</div>
</li>
</ol>
</li>
<li id="comment-657860" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/645ad53c379872899ff7e3363236975d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/645ad53c379872899ff7e3363236975d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeroen Koekkoek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2024-01-02T20:50:38+00:00">January 2, 2024 at 8:50 pm</time></a> </div>
<div class="comment-content">
<p>We can go faster if we limit dependencies(?) The idea is to ignore trash bytes and not shift them off. Given correct input, this is considerably faster on my machine. Obviously, it lacks proper error checking, but I think it&rsquo;s an interesting enough approach to get input from others(?)</p>
<p><code>__attribute__((noinline))<br/>
static int parse_int8(const char *str, size_t len, uint8_t *num)<br/>
{<br/>
const uint32_t shr = ((len &lt;&lt; 3) - 8) &amp; 0x18;<br/>
uint32_t dgts;</p>
<p> memcpy(&amp;dgts, str, sizeof(dgts));<br/>
dgts &amp;= 0x000f0f0flu;<br/>
*num = (uint8_t)((0x640a01 * dgts) &gt;&gt; shr);</p>
<p> return 1;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-657861" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2024-01-02T21:13:08+00:00">January 2, 2024 at 9:13 pm</time></a> </div>
<div class="comment-content">
<p>It is about 25% faster than the fastest approach, when using random inputs.</p>
</div>
</li>
</ol>
</li>
</ol>
