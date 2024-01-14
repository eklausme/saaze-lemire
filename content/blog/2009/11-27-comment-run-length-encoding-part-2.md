---
date: "2009-11-27 12:00:00"
title: "Run-length encoding (part 2)"
index: false
---

[7 thoughts on &ldquo;Run-length encoding (part 2)&rdquo;](/lemire/blog/2009/11-27-run-length-encoding-part-2)

<ol class="comment-list">
<li id="comment-51932" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-30T10:15:00+00:00">November 30, 2009 at 10:15 am</time></a> </div>
<div class="comment-content">
<p>Thank you for the interesting post.<br/>
I would note, however, that not all universal codes are born equal. Specifically, byte-aligned codes and word-aligned codes are at least twice as fast as bit-oriented codes such as Elias delta/gamma or Golomb codes.<br/>
They are used in search engines and allow very fast decompression. In many cases it takes the same time as to read the data from disk sequentially.<br/>
See, e.g. &ldquo;Index Compression using Fixed Binary Codewords. Vo Ngoc Anh, Alistair Moffat&rdquo;<br/>
PS: I also gonna read &ldquo;How to Barter Bits for Chronons&rdquo;. Seems to be very interesting. Thanks!</p>
</div>
</li>
<li id="comment-51934" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-11-30T16:35:13+00:00">November 30, 2009 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>@Itman Thank you for the great reference. I liked the Fixed Binary Codewords paper very much.</p>
</div>
</li>
<li id="comment-51976" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77ab94bee30d4bbc521c2fbb9bd574f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77ab94bee30d4bbc521c2fbb9bd574f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.xtremecompression.com" class="url" rel="ugc external nofollow">Glenn Davis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-10T12:13:14+00:00">December 10, 2009 at 12:13 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m compelled to take issue with your last sentence&#8230;</p>
<p>&ldquo;Unfortunately, the current breed of microprocessors are not kind to variable-length representations so the added compression is at the expense decoding speed.&rdquo;</p>
<p>My recent experience has tought me that compression and speed are no longer related that way, and largely for that reason. Today&rsquo;s hierarchies of caches work in concert with out-of-order execution and other features to provide new avenues for the designer to exploit. These modern architectural features can be made to reward, with execution speed, high density in data. It is up to the designer to get the density, as well as the logic, that lets the hardware deliver the speed. To me, that&rsquo;s the new reality.</p>
<p>I say that with some conviction having just finished optimizing a fast decompressor for structured data. It uses canonical Huffman codes for the data, and a compressed variation of J. Brian Connell&rsquo;s classic structures for decoding. During software optimization, time and time again, I was able to get further speed improvements by increasing the compression not only of the data, but also of the decoding data structures and their pointers. It was the variable-length coding, as much as any other design factor, that got me the information density I needed from the data to get the speed I needed from the system. In the end, that happened, I believe, primarily because the use of variable-length codes reduced the demand on a relatively slow path component, the system bus.</p>
<p>Software optimization is not what it was years ago, and for me at least, neither are the relationships between compression and speed. But that won&rsquo;t be everyone&rsquo;s experience, so I would like to hear others&rsquo; opinions.</p>
</div>
</li>
<li id="comment-51977" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-10T12:22:27+00:00">December 10, 2009 at 12:22 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel<br/>
I have read the references on Chronos and Bits. It looks like one should use terms variable-bit and variable-byte methods very cautiously. It is also interesting that Huffman coding can be sped up considerably by using special lookup tables.<br/>
@Glenn,<br/>
My experience and a variety of experimental evaluations (just check the reference given by the author), say that in many cases more sophisticated compression methods introduce speed penalty. In particular, variable-bit methods are usually slower (but not always), that variable-byte methods.<br/>
The difference, however, is subtle. In many cases, obviously, better compression rates allows to avoid expensive cache misses and even more expensive disk reads. In those case, better compression is obviously a priority.</p>
</div>
</li>
<li id="comment-51978" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77ab94bee30d4bbc521c2fbb9bd574f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77ab94bee30d4bbc521c2fbb9bd574f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.xtremecompression.com" class="url" rel="ugc external nofollow">Glenn Davis</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-10T12:41:33+00:00">December 10, 2009 at 12:41 pm</time></a> </div>
<div class="comment-content">
<p>I agree. It could go either way; so much depends on the specifics. But the stangest thing is that so often I find myself increasing compression in order to increase speed, and winning!</p>
<p>BTW, there is an old paper (and a good one) by Debra Lelewer and Dan Hirschberg (CACM 4/90) that explores a lot of the Huffman code decoding issues.</p>
</div>
</li>
<li id="comment-51979" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-10T12:46:09+00:00">December 10, 2009 at 12:46 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;Efficient Decoding of Prefix Codes&rdquo;?<br/>
Looks like it is worth reading, thanks.</p>
</div>
</li>
<li id="comment-51983" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-11T02:26:35+00:00">December 11, 2009 at 2:26 am</time></a> </div>
<div class="comment-content">
<p><b>@Glenn Davis</b></p>
<p><i>It was the variable-length coding, as much as any other design factor, that got me the information density I needed</i></p>
<p>When confronted with a &ldquo;problem&rdquo; sometimes the best approach isn&rsquo;t to solve it but to <i>avoid</i> it.<br/>
Like, why using counters to spot peculiar points within an address range when you can use flags (bits), interleaved in data or <b>not</b> (sparse bit maps). 🙂</p>
</div>
</li>
</ol>
