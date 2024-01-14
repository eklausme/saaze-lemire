---
date: "2018-06-15 12:00:00"
title: "Emojis, Java and Strings"
index: false
---

[26 thoughts on &ldquo;Emojis, Java and Strings&rdquo;](/lemire/blog/2018/06-15-emojis-java-and-strings)

<ol class="comment-list">
<li id="comment-308598" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5868ea3b1961c1906c10fe373213211b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5868ea3b1961c1906c10fe373213211b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Krythic</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-15T23:37:54+00:00">June 15, 2018 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;I imagine this could be more computationally expensive&rdquo; &#8230; clearly you have no idea what you&rsquo;re talking about, and it astounds me that you felt the need to even write this out, being how erroneous it is. What&rsquo;s to stop you from simply doing length / 2? Are you autistic or something? This is not ok, and quite frankly, you should be extremely embarrassed right now. If you actually knew programming you would never feel the need to write this.</p>
</div>
<ol class="children">
<li id="comment-308601" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T00:33:33+00:00">June 16, 2018 at 12:33 am</time></a> </div>
<div class="comment-content">
<p><em> What&rsquo;s to stop you from simply doing length / 2? </em></p>
<p>Given an arbitrary UTF-16 string, and its length in bytes, I cannot know how many unicode characters there are without examining the content of the bytes. So no, dividing by two is not good enough. It will work in this case, but not in general.</p>
</div>
<ol class="children">
<li id="comment-308799" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a20b6c052e6178c98b8026c28fb75cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a20b6c052e6178c98b8026c28fb75cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vitaly Kravchenko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-17T20:55:37+00:00">June 17, 2018 at 8:55 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, I don&rsquo;t know why you bothered posting his comment, let alone replying to it. Asking if someone is autistic, telling one how one should feel, saying one doesn&rsquo;t know how to program. Wow! Even if there was factual merit to what he said, I wouldn&rsquo;t expect this to pass moderation 🙂</p>
</div>
<ol class="children">
<li id="comment-308824" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T05:26:56+00:00">June 18, 2018 at 5:26 am</time></a> </div>
<div class="comment-content">
<p>Yes, the comment was abusive. But I figured that the reasoning mistake being made was interesting.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-308643" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/424f0c775835e50f18fb28baf126d26a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/424f0c775835e50f18fb28baf126d26a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aankhen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T12:17:28+00:00">June 16, 2018 at 12:17 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Are you autistic or something?
</p></blockquote>
<p>I don&rsquo;t think that word means what you think it means. Good attempt at unprompted flaming, though. I tip my hat to Daniel for a classy response to a blatant troll.</p>
</div>
</li>
</ol>
</li>
<li id="comment-308664" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d2f99c8592292312dfc9cb163d1d3c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d2f99c8592292312dfc9cb163d1d3c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ibridge.be" class="url" rel="ugc external nofollow">Matt Casters</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T15:40:49+00:00">June 16, 2018 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>Be careful, just because it is called UTF-16 or 32 does not mean 2 or 4 bytes are used per codepoint. In fact even UTF-8 can go up to 6 bytes.<br/>
The compatibility mess was not created by Java though, it just tries to be as compatible as possible in a changing Unicode world where charAt() worked fine until the world changed.</p>
</div>
<ol class="children">
<li id="comment-308666" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T15:50:03+00:00">June 16, 2018 at 3:50 pm</time></a> </div>
<div class="comment-content">
<p>Can you elaborate? Which code points require 6 bytes in utf-8?</p>
</div>
<ol class="children">
<li id="comment-308675" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T17:37:00+00:00">June 16, 2018 at 5:37 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s apparently a reference to FSS-UTF, pre-RFC 3629: <a href="https://en.wikipedia.org/wiki/UTF-8#History" rel="nofollow ugc">https://en.wikipedia.org/wiki/UTF-8#History</a></p>
</div>
<ol class="children">
<li id="comment-308687" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d2f99c8592292312dfc9cb163d1d3c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d2f99c8592292312dfc9cb163d1d3c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.ibridge.be" class="url" rel="ugc external nofollow">Matt Casters</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T19:05:26+00:00">June 16, 2018 at 7:05 pm</time></a> </div>
<div class="comment-content">
<p>Below is a detailed description I read ages ago when I was trying to figure out why Java was so slow reading Strings compared to simple ASCII reading. It was when lazy conversion was implement in Kettle and parallel CSV reading because you can burn a tremendous amount of CPU cycles properly reading files from all over the world, let alone doing accurate date-time conversions, floating point number reading and so on. It put me on the wrong foot since all my IT life I was told that reading files is IO bound. In the world if ultra fast parallel disk subsystems and huge caches I can assure you all this is no longer the case. Please note the link is 15 years old, from before the emoji era, but perhaps in another 15 years Unicode will have faced other challenges.</p>
<p>httpss://www.joelonsoftware.com/2003/10/08/the-absolute-minimum-every-software-developer-absolutely-positively-must-know-about-unicode-and-character-sets-no-excuses/</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-308691" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/be9f3bba2d636e705656d932690ef977?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/be9f3bba2d636e705656d932690ef977?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Akimov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-16T19:37:32+00:00">June 16, 2018 at 7:37 pm</time></a> </div>
<div class="comment-content">
<p>I totally second that the current state of programming is disastrous. Too bad not too many programmers seem to realize that or express an intent to do something about that.</p>
<p>I think about all these string problems like that: strings are not random access, period. The fact that strings have been represented as arrays with characters as elements is yet another artifact of the programmer nerds&rsquo; ignorance, one of the series of &ldquo;misconceptions programmers have about X.&rdquo; With that, the humanity should have started with inventing efficient abstractions to deal with non-random access strings instead of the ugliness we see in Java and elsewhere.</p>
<p>UTF-32 on its own may be considered a hack, in my opinion, as it is an incredibly wasteful representation: it consumes 4x the memory normally needed for an English string, which is kind of ridiculous. I would say, even UTF-16 is already not good with its 2x redundancy. Given that UTF-16 is both inefficient, and not random-access, it seems like a redundant solution in the presence of UTF-8.</p>
</div>
</li>
<li id="comment-308878" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T16:29:52+00:00">June 18, 2018 at 4:29 pm</time></a> </div>
<div class="comment-content">
<p>But are there any good use-cases for random-access to code-points? It seems like it&rsquo;ll actually just encourage bugs, since it&rsquo;ll kind-of sort-of work on some things, but then break when you throw a string with combining characters at it.</p>
<p>It seems reasonable, perhaps even code, for a language to not provide random access to code points.</p>
<p>(Tangentially, a great thing about emojis is it flushed out a lot of apps that had shitty unicode support and forced them to fix it.)</p>
</div>
<ol class="children">
<li id="comment-308881" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T16:48:39+00:00">June 18, 2018 at 4:48 pm</time></a> </div>
<div class="comment-content">
<p>Computing substrings is a common problem&#8230; it is part of most standard APIs&#8230; No?</p>
</div>
</li>
</ol>
</li>
<li id="comment-308885" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T17:13:55+00:00">June 18, 2018 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>But don&rsquo;t the substring algos work fine operating byte-by-byte on utf8?</p>
<p>As an example, Go strings are (by convention) utf8, and provide no random access to code-points. It&rsquo;s AFAIK not something people complain about, and in fact, Go&rsquo;s support for unicode is generally considered pretty good. (But maybe it&rsquo;s just because people are too busy complaining about other things, like missing generics!) 🙂</p>
</div>
<ol class="children">
<li id="comment-308906" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T18:26:22+00:00">June 18, 2018 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>oops, this was supposed to be in reply to daniel&rsquo;s post beginning &ldquo;Computing substrings&#8230;&rdquo;</p>
</div>
</li>
<li id="comment-308915" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T19:09:41+00:00">June 18, 2018 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure I understand what you are saying.</p>
<p>Let us compare&#8230;</p>
<p>In Python, if I want to prune the first two characters, I do&#8230;</p>
<pre><code>&gt;&gt;&gt; x= "ðŸ˜‚ðŸ˜ðŸŽ‰ðŸ‘"
&gt;&gt;&gt; x[2:]
'ðŸŽ‰ðŸ‘'
</code></pre>
<p>In Swift, I do&#8230;</p>
<pre><code>  var x = "ðŸ˜‚ðŸ˜ðŸŽ‰ðŸ‘"
  var suf = String(x.suffix(2))
</code></pre>
<p>In Go, you do&#8230;</p>
<pre><code>var x = "ðŸ˜‚ðŸ˜ðŸŽ‰ðŸ‘"
var suf = string([]rune(x)[2:])
</code></pre>
<p>So I can see why people don&rsquo;t complain too much about Go.</p>
</div>
<ol class="children">
<li id="comment-308944" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T21:12:19+00:00">June 18, 2018 at 9:12 pm</time></a> </div>
<div class="comment-content">
<p>Well, the Go code is doing something a bit different, it&rsquo;s converting the string into a []rune (aka []int32) and then slicing that. If you&rsquo;re willing to convert from string into some sort of vector type, then you&rsquo;re always going to have direct indexability, of course.</p>
<p>But my bigger point is AFAIK is is never a good idea to index strings by code-point anyway. Your example, for example, happens to work on the input you&rsquo;ve given, but breaks on other input.</p>
<p>E.g., the string &ldquo;mÌ€hðŸ˜‚ðŸ˜&rdquo; will not print what you expect.</p>
<p><a href="https://play.golang.org/p/iWjxjpBa-_g" rel="nofollow ugc">https://play.golang.org/p/iWjxjpBa-_g</a></p>
<p>So I think it&rsquo;s probably better not to have code-point indexing built-into in strings, as a gentle nudge towards useing more sophisticated algorithms when needing to do actual &ldquo;character&rdquo; (i.e. grapheme) level manipulations.</p>
</div>
<ol class="children">
<li id="comment-308951" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T21:37:44+00:00">June 18, 2018 at 9:37 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>So I think it&rsquo;s probably better not to have code-point indexing built-into in strings, as a gentle nudge towards useing more sophisticated algorithms when needing to do actual â€œcharacterâ€ (i.e. grapheme) level manipulations.</p>
</blockquote>
<p>Should the language include or omit these &ldquo;more sophisticated algorithms&rdquo;?</p>
<p>I mean&#8230; do you expect Joe programmer to figure this out on his own&#8230; Or do you think that the language should tell Joe about how to do it properly? Or should Joe never have to do string manipulations?</p>
<p>I would argue that Java provides no help here. It explicitly allows you to query for the character at index j and gives you a &ldquo;character&rdquo; which can very well be garbage. How useful is that?</p>
<p>Code points would be better. Still, I agree that code point indexing is probably not great (even though it is better that whatever Java offers) but&#8230; if you want better, why not go with user-perceived characters?</p>
<p>Swift gives you this&#8230;</p>
<pre><code>  1&gt; var x = "mÌ€hðŸ˜‚ðŸ˜"
x: String = "mÌ€hðŸ˜‚ðŸ˜"
  2&gt; x.count
$R0: Int = 4
 3&gt; var suf = String(x.suffix(3))
suf: String = "hðŸ˜‚ðŸ˜"
 4&gt; var suf = String(x.suffix(4))
suf: String = "mÌ€hðŸ˜‚ðŸ˜"
</code></pre>
<p>What, if anything, do you not like about Swift?</p>
<p>I think Swift is way ahead of the curve on this one.</p>
</div>
<ol class="children">
<li id="comment-308953" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T21:53:33+00:00">June 18, 2018 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>Hey, that&rsquo;s cool! I&rsquo;m not a swift user, but looking up the docs, Swift is doing the correct thing, giving you &ldquo;extended grapheme clusters&rdquo;. Great!</p>
<p>It&rsquo;s just the middle-ground of giving you code-points which I&rsquo;m not a fan of &#8212; it leads you toward bugs that are hard to notice.</p>
<p>(I also still like Go approach of, &ldquo;a string is a sequence of utf8 bytes; use a unicode library if you want fancy manipulations&rdquo;. Maybe the Swift approach will turn out to be even nicer, though hard to say w/o experience using it.)</p>
</div>
<ol class="children">
<li id="comment-308956" class="comment byuser comment-author-lemire bypostauthor even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T22:19:01+00:00">June 18, 2018 at 10:19 pm</time></a> </div>
<div class="comment-content">
<p>Rust is a lot of fun&#8230; This does not do what I expected&#8230;</p>
<pre><code>let v = String::from("mÌ€hðŸ˜‚ðŸ˜");
let s = v.get(0..3).expect("");
println!("{}",s);
</code></pre>
</div>
<ol class="children">
<li id="comment-308964" class="comment odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T22:50:46+00:00">June 18, 2018 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>I feel like such a philistine, since I don&rsquo;t know Rust either, but that is not a surprising result to me!</p>
<p>Go will give you the same.</p>
<p><a href="https://play.golang.org/p/jimB5h8WwWn" rel="nofollow ugc">https://play.golang.org/p/jimB5h8WwWn</a></p>
<p>The reason is the first two code-points are</p>
<p><code>006D LATIN SMALL LETTER M<br/>
0300 COMBINING GRAVE ACCENT<br/>
</code></p>
<p>(Those two code-points combine together to give you the single grapheme &ldquo;mÌ€&rdquo;.)</p>
<p>Encoded into utf8, they become 3 bytes (109, 204, 128). So if you are treating the string as a sequence of utf8 bytes, slicing the first 3 elements would give you that.</p>
<p>So it looks like Rust, like Go, takes this approach. And if you you care about fancier manipulations, you need to use a library (e.g., <a href="https://crates.io/crates/unicode-segmentation" rel="nofollow ugc">https://crates.io/crates/unicode-segmentation</a>).</p>
<p>As a fun aside, that string breaks a couple playgrounds:</p>
<p><a href="https://play.rust-lang.org/?gist=9958c46c59eff8d655c818e55580d202&#038;version=undefined&#038;mode=undefined" rel="nofollow ugc">https://play.rust-lang.org/?gist=9958c46c59eff8d655c818e55580d202&#038;version=undefined&#038;mode=undefined</a></p>
<p><a href="https://trinket.io/python/8a0742b45e" rel="nofollow ugc">https://trinket.io/python/8a0742b45e</a></p>
<p>Try editing text after the &ldquo;mÌ€&rdquo;; the cursor don&rsquo;t match correctly. You also can&rsquo;t select the string in the Rust playground.</p>
<p>The Go playground works correctly, but probably just because it uses a simple text-entry box w/o syntax highlighting or other niceities. (But would you rather have simple-but-correct or fancy-but-buggy software?)</p>
<p>Finally, I managed to hang emacs by asking it to describe-char &ldquo;mÌ€&rdquo;.</p>
<p>Unicode support is still janky in a lot of places!</p>
</div>
<ol class="children">
<li id="comment-308970" class="comment byuser comment-author-lemire bypostauthor even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T23:24:45+00:00">June 18, 2018 at 11:24 pm</time></a> </div>
<div class="comment-content">
<p>I have no problem understanding the result, but it is not what I expected it to do.</p>
</div>
<ol class="children">
<li id="comment-308974" class="comment odd alt depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-19T00:01:36+00:00">June 19, 2018 at 12:01 am</time></a> </div>
<div class="comment-content">
<p>Sorry, I was not trying to imply you didn&rsquo;t understand the result, just provide some explanation/context/motivation for the result.</p>
<p>I think what you&rsquo;re saying is, &ldquo;I expect a string to look like a sequence of graphemes&rdquo;.</p>
<p>Whereas Go and Rust say, &ldquo;a string is sequence of utf8 bytes&rdquo;. So in that sense, it&rsquo;s not what you expect.</p>
<p>I think the Go and Rust approach is still reasonable, since they&rsquo;re likely to lead to correct software. (Vs, say, Python, which is&rdquo;almost right&rdquo; in the default case, making it easier to make subtly-broken software.)</p>
<p>(Come to think, perhaps a better test-case to give you would&rsquo;ve been &ldquo;ðŸ‘·â€â™€ï¸ðŸ‘©â€âš•ï¸ðŸŽ‰ðŸ‘&rdquo;.)</p>
<p>The Swift approach seems reasonable too, and maybe even better since it does the right thing by default, though at the cost that you&rsquo;ve got a lot of unicode complexity in your core string class, and it&rsquo;s non-obvious (at least to me) what your internal string represenation is going to be, or what the perf cost of various operations is going to be. (E.g., is something like &ldquo;.count&rdquo; on a swift string constant time, or does it have to run through the whole string calculating the graphemes?)</p>
</div>
<ol class="children">
<li id="comment-309003" class="comment byuser comment-author-lemire bypostauthor even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-19T04:04:05+00:00">June 19, 2018 at 4:04 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I think the Go and Rust approach is still reasonable, since they&rsquo;re likely to lead to correct software.</p>
</blockquote>
<p>In what sense?</p>
<p>You are still left to do things like normalization on your own. This makes it quite hard to do correct string searchers in Go, say.</p>
<p>Try this:</p>
<p>package main</p>
<pre><code>import (
  "fmt"
   "strings"
)

func main() {
  var x = "Pok\u00E9mon"
  var y = "Poke\u0301mon"
  fmt.Println("are ", x, " and ", y , " equal/equivalent?") 
  fmt.Println(x == y)
  fmt.Println(strings.Compare(x,y))
}
</code></pre>
<p>Sure, you can remember to use a unicode library as you say and never rely on the standard API to do string processing, but Go does not help you. If you don&rsquo;t know about normalization, and try to write a search function in Go, you will get it flat wrong, I bet.</p>
</div>
</article>
</li>
<li id="comment-309078" class="comment odd alt depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/04a129d97ae4c0790086e9272cb6c4d7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Erin Keenan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-19T16:21:57+00:00">June 19, 2018 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>(I think I hit the nesting depth limit for replies; this is a reply to Daniel&rsquo;s sibling comment at 4:04.)</p>
<p>That is a fair point, but I would not view the situation as dimly as you do.</p>
<p>I would say software like that has sharp-edges, rather than being incorrect. If I, as a user, normalize my input before handing it off to the software, it will function correctly. This is how emacs works, for example. It is an annoyance occasionally, but not in my mind a &ldquo;bug&rdquo; per se.</p>
<p>Compare this situation to the two code playgrounds I posted above.</p>
<p>Once you include a multi-code-point grapheme in your input, they stop working correctly, full stop. The character insert offset is shown incorrectly, and text selection using the mouse is glitchy. There is nothing you can do as a user to avoid this.</p>
<p>So that&rsquo;s the style of bug that&rsquo;s encouraged by the &ldquo;almost correct&rdquo; perspective of a string as a sequence of code-points.</p>
<p>I take your point, though, that Swift&rsquo;s perspective of a string as a sequence of graphemes may be the superior approach, avoiding both types of undesirable behavior.</p>
<p>(Though I guess at some perf &amp; complexity price.)</p>
<p>So going back to your original post, in my view, Python 3&rsquo;s behavior is bad, Go and Rust are ok, and Swift is (maybe) the best.</p>
</div>
</article>
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
</ol>
</li>
</ol>
</li>
<li id="comment-308918" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3c1e64d8b39166902c30417d14231cb7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3c1e64d8b39166902c30417d14231cb7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bart Wiegmans</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-06-18T19:23:52+00:00">June 18, 2018 at 7:23 pm</time></a> </div>
<div class="comment-content">
<p>Interesting blog post.</p>
<p>I wanted to point out that MoarVM (the Perl6 VM) uses a string representation called &lsquo;normalized form grapheme&rsquo; that allows efficient random access on unicode grapheme strings. <a href="https://github.com/MoarVM/MoarVM/blob/master/docs/strings.asciidoc" rel="nofollow">Link to documentation</a>.</p>
<p>The essence of that trick is to combine all combinators into a grapheme and map that to a synthetic codepoint (I believe a negative number), which is then &lsquo;unmapped&rsquo; when encoded to an external format (e.g.., UTF-8).</p>
<p>This is obviously not perfect as it incurs extra cost at IO, although that is true of any system that uses anything other than UTF-8 internally. So I think it is a nice solution (until unicode runs out of 31 bit space, that is).</p>
</div>
</li>
<li id="comment-427498" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/be67736b073db180f85893c4dee89a34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/be67736b073db180f85893c4dee89a34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">soft</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-17T13:03:33+00:00">September 17, 2019 at 1:03 pm</time></a> </div>
<div class="comment-content">
<p>Hi,</p>
<p>I want to show color emoji (😄) by using javafx. I am not able to show color emoji but I am able to show black and white emoji.<br/>
so please suggest me is it possible to show color emoji in javafx. i am using Segoe UI Emoji font.<br/>
Thanks</p>
</div>
</li>
</ol>
