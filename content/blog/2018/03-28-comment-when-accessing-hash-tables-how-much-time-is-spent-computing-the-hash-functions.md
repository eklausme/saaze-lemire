---
date: "2018-03-28 12:00:00"
title: "When accessing hash tables, how much time is spent computing the hash functions?"
index: false
---

[8 thoughts on &ldquo;When accessing hash tables, how much time is spent computing the hash functions?&rdquo;](/lemire/blog/2018/03-28-when-accessing-hash-tables-how-much-time-is-spent-computing-the-hash-functions)

<ol class="comment-list">
<li id="comment-299536" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-28T18:20:15+00:00">March 28, 2018 at 6:20 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Java uses a really simple hash functionâ€¦ Moreover, the hash value of each Integer object is the integer value itself.
</p></blockquote>
<p>Are you sure about that? It seems pretty weak, and it doesn&rsquo;t match what I&rsquo;ve read elsewhere, though that information may be obsolete. My understanding is that hashCode will return the integer itself, but HashMap does <a href="https://www.connect2java.com/tutorials/collections/how-hashmap-works-internally-in-java/" rel="nofollow">some additional work</a> to reduce unintentional collisionsâ€¦</p>
<p>That said, the Java hash function I&rsquo;m thinking of is quite fast; significantly faster than anything else on <a href="http://www.burtleburtle.net/bob/hash/integer.html" rel="nofollow ugc">http://www.burtleburtle.net/bob/hash/integer.html</a> (I did some benchmarks on the algorithms on that page recently using <a href="https://github.com/travisdowns/uarch-bench" rel="nofollow">uarch-bench</a>; it&rsquo;s pretty trivial, but I&rsquo;d be happy to post it if you&rsquo;re interested).</p>
</div>
<ol class="children">
<li id="comment-299537" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-28T18:23:44+00:00">March 28, 2018 at 6:23 pm</time></a> </div>
<div class="comment-content">
<p>You are correct, HashMap does additional work on top of the value returned by <tt>hashCode</tt>, but this only makes my point stronger.</p>
</div>
</li>
</ol>
</li>
<li id="comment-299546" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72eaa53a0adc08ce94e09257c5bd9a60?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72eaa53a0adc08ce94e09257c5bd9a60?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">eugene</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-28T21:37:14+00:00">March 28, 2018 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>Feels good to read this&#8230; That is the main reason for hot structures that we have in our code we keep a list of hash caches, usually small. But for the most common data it makes a big impact. Now I can safely put this link as a commemt to thatso that people would stop looking weird at me 🙂</p>
</div>
</li>
<li id="comment-299549" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-28T22:51:15+00:00">March 28, 2018 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>Rerun the benchmark with an object with just three ints so you measure more of the hash function, and less the memory layout.</p>
<p>Also, note that e.g. the string class because of this effect caches its own hash code, to avoid recomputation cost. This, also benchmark four interested, one for caching the hash code, to get a clearer view.</p>
</div>
</li>
<li id="comment-299551" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-28T23:17:04+00:00">March 28, 2018 at 11:17 pm</time></a> </div>
<div class="comment-content">
<p>In my benchmark, my targets are going to be in L1 with high probability: I have only 100 lists and they are created right before I run the test function. So memory access should not be a problem.</p>
<p>I would have used arrays for a simpler example but you can&rsquo;t use arrays as keys in Java.</p>
<p>Indeed, String hashes are cached (computed at most once) in Java. It is a common recommendation to cache hash values.</p>
<p>I do include an example of hash-value caching in the companion code to this blog post. The blog post does not describe it because it is a secondary point.</p>
</div>
</li>
<li id="comment-299582" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-29T16:53:56+00:00">March 29, 2018 at 4:53 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps this is an aside, but &#8230; a fixed size array of <em>three</em> integers? Is this a fixed aspect of your problem? (Does the dimension of three ever vary?) Would this be more efficient as a tuple?</p>
<p><code>public class Tuple {<br/>
int a, b, c;<br/>
};<br/>
</code></p>
<p>Not tested, but guessing the compiler would emit more efficient code in this case.</p>
</div>
<ol class="children">
<li id="comment-299586" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb8fb8ec240b032402940d1592fdf87e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb8fb8ec240b032402940d1592fdf87e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antonio Badia</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-29T18:48:04+00:00">March 29, 2018 at 6:48 pm</time></a> </div>
<div class="comment-content">
<p>I think it&rsquo;d be interesting to see what happens if data does not fit into cache (which seems more realistic anyways): using (say) a large varchar (anything from 256 bytes to 1K) instead of 3 integers. My guess is that this would change the result tremendously, since hashing is notorious for destroying locality of reference anyways. Maybe when I have some free time&#8230;</p>
</div>
</li>
<li id="comment-299594" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-03-29T22:08:19+00:00">March 29, 2018 at 10:08 pm</time></a> </div>
<div class="comment-content">
<p>See <a href="https://lemire.me/blog/2018/03/29/should-you-cache-hash-values-even-for-trivial-classes/">Should you cache hash values even for trivial classes?</a></p>
</div>
</li>
</ol>
</li>
</ol>
