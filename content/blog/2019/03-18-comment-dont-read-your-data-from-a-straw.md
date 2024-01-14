---
date: "2019-03-18 12:00:00"
title: "Don&#8217;t read your data from a straw"
index: false
---

[3 thoughts on &ldquo;Don&#8217;t read your data from a straw&rdquo;](/lemire/blog/2019/03-18-dont-read-your-data-from-a-straw)

<ol class="comment-list">
<li id="comment-395801" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T06:47:33+00:00">March 19, 2019 at 6:47 am</time></a> </div>
<div class="comment-content">
<p>One of the things that can hurt Java here is the classic big endian vs. little endian problem&#8230;<br/>
In a lot of cases, Java is prepared to swap endianess to be compatible across different CPU architectures. Something where in C you usually have to manually insert htonl and ntohl calls etc. &#8211; is all your code endianess safe?</p>
</div>
<ol class="children">
<li id="comment-395944" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-19T19:50:57+00:00">March 19, 2019 at 7:50 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for raising this point.</p>
<p>In the case above, we do Java-vs-Java comparisons so endianness is not an issue.</p>
<p>In both Java and C/C++, you sometimes need to flip the bytes around. In C/C++, you have to check whether you have a big endian or little endian system, whereas with Java, it is always big endian. Yet, in my own experience, I have been able to safely assume that all systems I care about are little endian. So I have designed binary formats that are explicitly little endian.</p>
<p>This being said, the computational burden of reversing byte order is tiny.</p>
</div>
</li>
</ol>
</li>
<li id="comment-396959" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bafdfdb4a8ff3e836171de1f7030233?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roman Leventov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-03-23T23:08:02+00:00">March 23, 2019 at 11:08 pm</time></a> </div>
<div class="comment-content">
<p>ByteBuffer has very unfortunate API. Pretty much all systems/high-performance projects in Java (Netty, Aeron, Chronicle, etc) reimplement it on their own.</p>
<p>We&rsquo;ve built Memory project (<a href="https://github.com/DataSketches/memory" rel="nofollow">link</a>) specifically to back up data structure implementations in Java. It is used in DataSketches (<a href="https://github.com/DataSketches/sketches-core" rel="nofollow">link</a>).</p>
</div>
</li>
</ol>
