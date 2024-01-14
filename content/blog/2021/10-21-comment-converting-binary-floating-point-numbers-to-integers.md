---
date: "2021-10-21 12:00:00"
title: "Converting binary floating-point numbers to integers"
index: false
---

[15 thoughts on &ldquo;Converting binary floating-point numbers to integers&rdquo;](/lemire/blog/2021/10-21-converting-binary-floating-point-numbers-to-integers)

<ol class="comment-list">
<li id="comment-602841" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/35921adc4b1c0d7839fe8350e2429a68?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/35921adc4b1c0d7839fe8350e2429a68?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://blog.reverberate.org/" class="url" rel="ugc external nofollow">Josh Haberman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-21T01:16:34+00:00">October 21, 2021 at 1:16 am</time></a> </div>
<div class="comment-content">
<p>I think the first example is undefined behavior in the case that the double is not representable in the target integer type: <a href="https://godbolt.org/z/54aq4r5oj" rel="nofollow ugc">https://godbolt.org/z/54aq4r5oj</a></p>
</div>
</li>
<li id="comment-602871" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90cdaa9a60c212bd3cf7d68fe1d05f15?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90cdaa9a60c212bd3cf7d68fe1d05f15?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Nicolas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-21T07:37:33+00:00">October 21, 2021 at 7:37 am</time></a> </div>
<div class="comment-content">
<p>Very interesting post.<br/>
Don&rsquo;t you need to shift bits left by 1 before testing equality to zero (to account for +0 and -0) ?</p>
</div>
<ol class="children">
<li id="comment-602930" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-21T18:13:37+00:00">October 21, 2021 at 6:13 pm</time></a> </div>
<div class="comment-content">
<p>See my other reply: it is debatable whether -0 can be represented as an uint64 value.</p>
<p>(Your comment was not lost, it just needed approval.)</p>
</div>
</li>
</ol>
</li>
<li id="comment-602889" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/667e5eedf16c3702f47a37131931c9ff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/667e5eedf16c3702f47a37131931c9ff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Urgau</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-21T09:15:09+00:00">October 21, 2021 at 9:15 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve executed your code on one of my armhf machine and the results are surprising.</p>
<p>$ time ./isint.g++<br/>
499999999500000000<br/>
39.8756<br/>
499999999500000000<br/>
96.3353</p>
<p>real 4m32,431s<br/>
user 4m32,237s<br/>
sys 0m0,196s</p>
<p>$ time ./isint.clang++<br/>
499999999500000000<br/>
28.1106<br/>
499999999500000000<br/>
98.3311</p>
<p>real 4m12,893s<br/>
user 4m12,060s<br/>
sys 0m0,508s</p>
<p>Your code is way faster on my armhf machine.<br/>
Note that g++ (Debian 8.3.0-6) 8.3.0 and clang version 7.0.1-8+deb10u2 were not the most recent version.</p>
</div>
</li>
<li id="comment-602921" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90cdaa9a60c212bd3cf7d68fe1d05f15?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90cdaa9a60c212bd3cf7d68fe1d05f15?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nicolas B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-21T15:39:13+00:00">October 21, 2021 at 3:39 pm</time></a> </div>
<div class="comment-content">
<p>Very interesting post.<br/>
Shouldn&rsquo;t bits be left shifted by one bit before testing zero with (bits == 0) to account for +0 and -0 cases ?</p>
<p>(my comment may have been lost the first time)</p>
</div>
<ol class="children">
<li id="comment-602929" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-21T18:12:32+00:00">October 21, 2021 at 6:12 pm</time></a> </div>
<div class="comment-content">
<p>It is debatable whether -0 can be represented as an uint64 value.</p>
</div>
</li>
</ol>
</li>
<li id="comment-602956" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4a339607155cef3d53b1c8505a215cf8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Todd Lehman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-22T01:58:42+00:00">October 22, 2021 at 1:58 am</time></a> </div>
<div class="comment-content">
<p>As a special case, I wonder how fast it would be for a custom shortcut routine to convert a known-integer value stored in a 32- or 64-bit floating-point variable into a uint64_t value?</p>
<p>What I mean is: If you happen to know that a floating-point value is an integer (which can certainly happen sometimes), can the conversion be performed measurably faster?</p>
</div>
<ol class="children">
<li id="comment-603019" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-22T17:07:27+00:00">October 22, 2021 at 5:07 pm</time></a> </div>
<div class="comment-content">
<p>It is an interesting question.</p>
</div>
</li>
</ol>
</li>
<li id="comment-602990" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9fee6ecae8cb1a321fab1e09099ed90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9fee6ecae8cb1a321fab1e09099ed90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jorge</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-22T09:28:51+00:00">October 22, 2021 at 9:28 am</time></a> </div>
<div class="comment-content">
<p>If I remember correctly, there were some instruction extensions in Arm to support this kind of operations directly, with the aim to accelerate conditional code in Javascript, where all numbers have type double.<br/>
See &ldquo;Improved Javascript data type conversion&rdquo;: <a href="https://community.arm.com/arm-community-blogs/b/architectures-and-processors-blog/posts/armv8-a-architecture-2016-additions" rel="nofollow ugc">https://community.arm.com/arm-community-blogs/b/architectures-and-processors-blog/posts/armv8-a-architecture-2016-additions</a></p>
</div>
<ol class="children">
<li id="comment-603025" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-22T17:25:09+00:00">October 22, 2021 at 5:25 pm</time></a> </div>
<div class="comment-content">
<p>Ah. So it would work much the same as my simple approach but a flag is set when the conversion is not exact. Interesting.</p>
</div>
</li>
</ol>
</li>
<li id="comment-603122" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/60c6a2c58798177e086a523baa93606e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/60c6a2c58798177e086a523baa93606e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lars Bonnichsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-23T11:51:28+00:00">October 23, 2021 at 11:51 am</time></a> </div>
<div class="comment-content">
<p>If the number fits into the mantissa, then the integer conversion can be done with 1 float and 1 integer addition, which should be faster</p>
<p><a href="https://paperzz.com/doc/8232041/fast-rounding-of-floating-point-numbers-in-c-c--" rel="nofollow ugc">https://paperzz.com/doc/8232041/fast-rounding-of-floating-point-numbers-in-c-c&#8211;</a></p>
</div>
</li>
<li id="comment-603360" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/be9f3bba2d636e705656d932690ef977?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/be9f3bba2d636e705656d932690ef977?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitry Akimov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-25T10:23:33+00:00">October 25, 2021 at 10:23 am</time></a> </div>
<div class="comment-content">
<p>Hello Daniel. In the modern C++ the legal way and optimal way for binary conversion between unrelated types is to use std::memcpy or std::bit_cast.</p>
</div>
<ol class="children">
<li id="comment-603364" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-25T11:40:11+00:00">October 25, 2021 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>I am aware but a union is also legal, is it not?</p>
</div>
<ol class="children">
<li id="comment-603411" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/90cdaa9a60c212bd3cf7d68fe1d05f15?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/90cdaa9a60c212bd3cf7d68fe1d05f15?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nicolas B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-25T20:33:06+00:00">October 25, 2021 at 8:33 pm</time></a> </div>
<div class="comment-content">
<p>I thought unions were only legal if you write and read from the same field (not possible to write a field an interpret the data another way by reading another one). But I may be mixing C/C++ standards</p>
</div>
<ol class="children">
<li id="comment-603416" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-25T21:08:09+00:00">October 25, 2021 at 9:08 pm</time></a> </div>
<div class="comment-content">
<p>It seems that you are correct:<br/>
&ldquo;It&rsquo;s undefined behavior to read from the member of the union that wasn&rsquo;t most recently written. Many compilers implement, as a non-standard language extension, the ability to read inactive members of a union.&rdquo;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
