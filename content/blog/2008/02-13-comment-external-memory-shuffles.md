---
date: "2008-02-13 12:00:00"
title: "External-Memory Shuffles?"
index: false
---

[5 thoughts on &ldquo;External-Memory Shuffles?&rdquo;](/lemire/blog/2008/02-13-external-memory-shuffles)

<ol class="comment-list">
<li id="comment-49731" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-13T14:28:59+00:00">February 13, 2008 at 2:28 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Suresh. To implement a &ldquo;Knuth shuffle&rdquo;, don&rsquo;t you need random access to the items to swap them? For my problem, I specify a &ldquo;variable-length-record flat file&rdquo;. If I am allowed to turn it into a fixed-length-record flat file with random access to the lines, I might as well throw the data in a DBMS. Hence, there is the idea of shuffling the numbers from 1 to n, which can be done in O(n) time using the Knuth shuffle [which languages like Java or Python conveniently provide], prepend them to the lines, and then sorting the lines&#8230;</p>
<p>Or are you thinking about some other algorithm? Here is my reference:<br/>
<a href="https://en.wikipedia.org/wiki/Knuth_shuffle" rel="nofollow ugc">http://en.wikipedia.org/wiki/Knuth_shuffle</a></p>
<p>Or maybe you mean that I can scale up the shuffling of the numbers from 1 to n to values of n much greater than 100,000,000? Well, maybe I was being a pessimist&#8230;</p>
</div>
</li>
<li id="comment-49730" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Suresh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-13T13:46:59+00:00">February 13, 2008 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the problem with a shuffle ? using the standard Knuth trick, you can generate a shuffle as easily as choosing random numbers.</p>
</div>
</li>
<li id="comment-49732" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6537c0a681d22d4a3f7bf4ce7d209a0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Suresh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-13T14:50:12+00:00">February 13, 2008 at 2:50 pm</time></a> </div>
<div class="comment-content">
<p>True, but you&rsquo;re only shuffling the range [1..n], not the actual numbers, no ? I&rsquo;m guessing that it won&rsquo;t scale beyond what you can fit in memory though.</p>
</div>
</li>
<li id="comment-49734" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-13T20:00:28+00:00">February 13, 2008 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>Thanks David.</p>
<p>I edited my post to remove the CRC64 idea since I believe that &ldquo;sort &#8211;random-sort&rdquo; does exactly this, though they don&rsquo;t specify their hashing family.</p>
</div>
</li>
<li id="comment-49733" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/750c7048160ad762711e0c0971ad9adb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/750c7048160ad762711e0c0971ad9adb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-02-13T18:41:35+00:00">February 13, 2008 at 6:41 pm</time></a> </div>
<div class="comment-content">
<p>I like the CRC64 solution, although, why not go even crazier and use a SHA algorithm? The disadvantage of these approaches is that you need one pass to generate the random number (prepending it to the line) and another pass to sort the lines.<br/>
Unf. my sha1sum command doesn&rsquo;t seem to accept input from the command line, making it difficult to answer with a nice one liner.</p>
</div>
</li>
</ol>
