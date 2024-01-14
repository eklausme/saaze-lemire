---
date: "2022-11-22 12:00:00"
title: "What is the size of a byte[] array in Java?"
index: false
---

[2 thoughts on &ldquo;What is the size of a byte[] array in Java?&rdquo;](/lemire/blog/2022/11-22-what-is-the-size-of-a-byte-array-in-java)

<ol class="comment-list">
<li id="comment-647715" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-11-23T06:36:25+00:00">November 23, 2022 at 6:36 am</time></a> </div>
<div class="comment-content">
<p>Well known. And now give the VM 33GB RAM!</p>
<p>You might put in some explanations, too.</p>
<p>4 bytes for memory management<br/>
4 bytes object hash code? I don&rsquo;t recall<br/>
4 bytes class pointer for object type (8 if &gt;32 GB Mem limit)<br/>
4 bytes length (signed, hence maximum array size ~ 2^31</p>
<p>So 16-20 bytes overhead, then rounded up to multiples of 8 for memory alignment and the compressed pointer trick. (Regular objects: 12-16, as they don&rsquo;t have an array length, the object size is known via the class pointer)</p>
<p>Default settings &#8212; it might be possible to tune to compressedOOPS to use 32 bit pointers up to 64GB RAM at the cost of increasing the alignment to 16 bytes. Not sure if you could go to a 16GB limit and 4 byte size padding &#8211; there might be other places where 8 bytes memory alignment is desirable (you might know this better than me, which CPUs want this kind of alignment). 8 bytes seems to be the best trade-off.</p>
</div>
</li>
<li id="comment-648402" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1a530f970a984d913686829dcbf9a74?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-12T08:58:51+00:00">December 12, 2022 at 8:58 am</time></a> </div>
<div class="comment-content">
<p>What are the overheads in C and C++?</p>
<p>I&rsquo;d assume that even C alloc needs to keep track of memory allocations, so there *will* be some overhead associated. I have no idea about the current glibc. I know that optimized allocators exist (last but not least in the templates), that memory alignment is common, and I&rsquo;ve once debugged a poor memory allocator for a MMUless ARM SoC that simply stored the length before and after each allocated chunk (and a &ldquo;free&rdquo; bit, i.e. 8 bytes overhead on 32 bit) &#8211; which was of course incredibly prone to corruption by out of bounds writes&#8230;<br/>
I&rsquo;d assume that for C++ with OOP there will also be some type information involved. So I&rsquo;d expect on 64 bit systems overheads of &gt;=16 Bytes for arrays in OOP are common across languages, too.</p>
</div>
</li>
</ol>
