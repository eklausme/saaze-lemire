---
date: "2017-03-31 12:00:00"
title: "Compressed bitset libraries in C and C++"
index: false
---

[9 thoughts on &ldquo;Compressed bitset libraries in C and C++&rdquo;](/lemire/blog/2017/03-31-compressed-bitset-libraries-in-c-and-c)

<ol class="comment-list">
<li id="comment-276919" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7c817f972df58e0bbda28335dc05f641?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7c817f972df58e0bbda28335dc05f641?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Rob</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-01T00:55:02+00:00">April 1, 2017 at 12:55 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p> Nice post! I&rsquo;ve peeked around a few of these myself before in a search for a good dynamically-sized bitset for C++. Do you have any thoughts on if it might make sense to add rank and select operations to any of these representations? Usually, when I&rsquo;m using a compressed (or even uncompressed) bit-vector, rank, select and access are the 3 operations I&rsquo;m most in need of.</p>
</div>
<ol class="children">
<li id="comment-277060" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-02T14:29:35+00:00">April 2, 2017 at 2:29 pm</time></a> </div>
<div class="comment-content">
<p>CRoaring supports rank and select in both the C and C++ interfaces (and in Java and Go), <a href="https://github.com/RoaringBitmap/CRoaring/blob/master/include/roaring/roaring.h" rel="nofollow ugc">https://github.com/RoaringBitmap/CRoaring/blob/master/include/roaring/roaring.h</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-276946" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fce38b7ce8e69d16fe8a26382a5d4a5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fce38b7ce8e69d16fe8a26382a5d4a5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex Chen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-01T05:49:28+00:00">April 1, 2017 at 5:49 am</time></a> </div>
<div class="comment-content">
<p>How would you compare the bitset library in stl bundled in standard c++ with the libraries you listed. Is there any use case where it is clearly advantageous to use third party bitset libraries as opposed to the standard library? Thanks!</p>
</div>
<ol class="children">
<li id="comment-277059" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-02T14:25:09+00:00">April 2, 2017 at 2:25 pm</time></a> </div>
<div class="comment-content">
<p>I present a comparison with STL data structures in this recent talk reproduced on YouTube: <a href="https://youtu.be/ubykHUyNi_0" rel="nofollow ugc">https://youtu.be/ubykHUyNi_0</a></p>
<p>I have also covered the topic in various ways on my blog over the years&#8230; <a href="https://lemire.me/blog/2012/11/13/fast-sets-of-integers/" rel="ugc">http://lemire.me/blog/2012/11/13/fast-sets-of-integers/</a><br/>
<a href="https://lemire.me/blog/2017/01/27/how-expensive-are-the-union-and-intersection-of-two-unordered_set-in-c/" rel="ugc">http://lemire.me/blog/2017/01/27/how-expensive-are-the-union-and-intersection-of-two-unordered_set-in-c/</a></p>
<p>And I&rsquo;ll write more.</p>
</div>
</li>
</ol>
</li>
<li id="comment-276949" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3688cfea4f4cfc95cf31028a629a834?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Benoit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-01T06:15:28+00:00">April 1, 2017 at 6:15 am</time></a> </div>
<div class="comment-content">
<p>Hello and thank you for the links.<br/>
Are those libraries suitable for building a Bloom filter?<br/>
I understand they are overkill, but do their storage and read access performances make the a good choice?</p>
</div>
</li>
<li id="comment-276961" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6bb4665a24a42c2596e293eadebcc432?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6bb4665a24a42c2596e293eadebcc432?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arthur Silva</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-01T10:55:32+00:00">April 1, 2017 at 10:55 am</time></a> </div>
<div class="comment-content">
<p>None of these libraries expose functions to shift (as in bit shift) bits around, I guess these operations don&rsquo;t play well with compression. Are there any compressed bitset algorithms that could potentially support these operations with reasonable efficiency?</p>
</div>
<ol class="children">
<li id="comment-277058" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-02T14:20:33+00:00">April 2, 2017 at 2:20 pm</time></a> </div>
<div class="comment-content">
<p>The javaewah has a shift function, see <a href="http://www.javadoc.io/doc/com.googlecode.javaewah/JavaEWAH/1.1.6" rel="nofollow ugc">http://www.javadoc.io/doc/com.googlecode.javaewah/JavaEWAH/1.1.6</a></p>
<p>It has not been implemented in the C/C++ libraries simply because there has been no interest shown for the feature.</p>
<p>Of course, a shift operation in generally linear time&#8230; so shifting bitsets arbitrarily and frequently is maybe unwise.</p>
</div>
</li>
</ol>
</li>
<li id="comment-277039" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3eeb7653c4df9b0f1332b9b0ec201ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Max Lybbert</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-02T09:04:39+00:00">April 2, 2017 at 9:04 am</time></a> </div>
<div class="comment-content">
<p>There is also FastBit ( <a href="https://sdm.lbl.gov/fastbit/" rel="nofollow ugc">https://sdm.lbl.gov/fastbit/</a> ).</p>
</div>
</li>
<li id="comment-283103" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0f8522f06a235c9ba009b0e1ed30c66c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0f8522f06a235c9ba009b0e1ed30c66c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lily</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-11T09:21:37+00:00">July 11, 2017 at 9:21 am</time></a> </div>
<div class="comment-content">
<p><em>Are those libraries reasonable for building a Bloom channel? </em></p>
<p>Probably not.</p>
</div>
</li>
</ol>
