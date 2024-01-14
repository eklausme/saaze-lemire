---
date: "2022-12-06 12:00:00"
title: "Fast midpoint between two integers without overflow"
index: false
---

[18 thoughts on &ldquo;Fast midpoint between two integers without overflow&rdquo;](/lemire/blog/2022/12-06-fast-midpoint-between-two-integers-without-overflow)

<ol class="comment-list">
<li id="comment-648272" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">moonchild</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-07T06:44:35+00:00">December 7, 2022 at 6:44 am</time></a> </div>
<div class="comment-content">
<p><code>((x^y)&gt;&gt;1) + (x&amp;y)</code> is 4 operations. Whereas <code>x + (y-x)&gt;&gt;1</code> is only 3 operations (and has the same span). Am I missing something?</p>
</div>
<ol class="children">
<li id="comment-648273" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8364132def52383c5e4e1b21bf7f371?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">moonchild</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-07T06:46:01+00:00">December 7, 2022 at 6:46 am</time></a> </div>
<div class="comment-content">
<p>nevermind, the given algorithms are commutative</p>
</div>
</li>
<li id="comment-648292" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/233f3b97e272cf101e2a357b95b98c5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/233f3b97e272cf101e2a357b95b98c5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Q</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-07T13:23:58+00:00">December 7, 2022 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>`y-x` can overflow when operating on signed integers, which is UB is C/C++.</p>
</div>
</li>
</ol>
</li>
<li id="comment-648288" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.cppstories.com/" class="url" rel="ugc external nofollow">BartekF</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-07T11:46:58+00:00">December 7, 2022 at 11:46 am</time></a> </div>
<div class="comment-content">
<p>you can also compare it with a C++20&rsquo;s addition: std::midpoint from </p>
</div>
<ol class="children">
<li id="comment-648300" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b03d059a843e13354bb9a57ffc85fb02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b03d059a843e13354bb9a57ffc85fb02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Champok Das</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-07T15:55:04+00:00">December 7, 2022 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>Just linking to the various implementations of std::midpoint in various compilers</p>
<p>GCC &#8211; <a href="https://gcc.gnu.org/git/?p=gcc.git;a=blob;f=libstdc%2B%2B-v3/include/std/numeric;h=0f1f26cd0c456f9bd1eb2fd6b2e7fd686a8a50e6;hb=refs/heads/trunk#l206" rel="nofollow ugc">https://gcc.gnu.org/git/?p=gcc.git;a=blob;f=libstdc%2B%2B-v3/include/std/numeric;h=0f1f26cd0c456f9bd1eb2fd6b2e7fd686a8a50e6;hb=refs/heads/trunk#l206</a></p>
<p>LLVM Clang &#8211; <a href="https://github.com/llvm/llvm-project/blob/main/libcxx/include/__numeric/midpoint.h" rel="nofollow ugc">https://github.com/llvm/llvm-project/blob/main/libcxx/include/__numeric/midpoint.h</a></p>
<p>MSVC STD &#8211; <a href="https://github.com/microsoft/STL/blob/main/stl/inc/numeric#L651" rel="nofollow ugc">https://github.com/microsoft/STL/blob/main/stl/inc/numeric#L651</a></p>
</div>
<ol class="children">
<li id="comment-648338" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0dcee6e0746589b790e09c095bb2a8ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0dcee6e0746589b790e09c095bb2a8ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lockal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-08T10:16:38+00:00">December 8, 2022 at 10:16 am</time></a> </div>
<div class="comment-content">
<p>It is kind of sad that not a single compiler implemented an optimal template specialization for std::midpoint.</p>
</div>
<ol class="children">
<li id="comment-648339" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0dcee6e0746589b790e09c095bb2a8ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0dcee6e0746589b790e09c095bb2a8ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lockal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-08T10:28:51+00:00">December 8, 2022 at 10:28 am</time></a> </div>
<div class="comment-content">
<p>Update: after reading cppreference now I see why: unlike optimized versions, std::midpoint provides very specific requirements for rounding, which are not supported by optimized versions.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648301" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/08f13918a3d83df1b4327dc1fea587eb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/08f13918a3d83df1b4327dc1fea587eb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Peter Boos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-07T16:04:49+00:00">December 7, 2022 at 4:04 pm</time></a> </div>
<div class="comment-content">
<p>(int)(x + y)*.5</p>
</div>
</li>
<li id="comment-648351" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Kanthak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-09T06:44:03+00:00">December 9, 2022 at 6:44 am</time></a> </div>
<div class="comment-content">
<p>EVERY properly written optimising compiler SHOULD emit code like</p>
<blockquote><p>
ADD RDI, RSI<br/>
RCR RDI, 1<br/>
MOV RAX, RDI
</p></blockquote>
<p>for this function.<br/>
If the target processor lacks the equivalent of the RCR (Rotate through carry right) instruction, but has a ROR (Rotate right) instruction, it can emit</p>
<blockquote><p>
ADD RDI, RSI<br/>
ADC RDI, 0<br/>
ROR RDI, 1<br/>
MOV RAX, RDI
</p></blockquote>
<p>instead.</p>
</div>
<ol class="children">
<li id="comment-648360" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-09T16:38:34+00:00">December 9, 2022 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>RCR is an appealing solution but, on some processors, it is significantly more expensive than a simple shift.</p>
</div>
<ol class="children">
<li id="comment-648373" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Kanthak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-10T13:05:56+00:00">December 10, 2022 at 1:05 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s the other reason why I mentioned to substitute it by ADC/ROR<br/>
ALSO: RCR is (if available) ALWAYS less expensive than the &ldquo;pure&rdquo; C formula/expression.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-648403" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/73207dd14a585241bef55ae9fe47b517?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/73207dd14a585241bef55ae9fe47b517?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sergei Sitnikov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-12T11:46:08+00:00">December 12, 2022 at 11:46 am</time></a> </div>
<div class="comment-content">
<p>I think the example with 1 and 9223372036854775807 doesn&rsquo;t demonstrate the problem: the problem is negative numbers, otherwise one can always do (uint) (x + y) &gt;&gt; 1.</p>
</div>
<ol class="children">
<li id="comment-648404" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-12T14:21:04+00:00">December 12, 2022 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>If you only have positive integers, and you are using a two&rsquo;s complement signed type, then I agree that you can always work around overflows with relative ease. I did not make this assumption.</p>
</div>
</li>
<li id="comment-648551" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4c8f262313e1333054fc3fd010be1af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4c8f262313e1333054fc3fd010be1af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-23T10:43:45+00:00">December 23, 2022 at 10:43 am</time></a> </div>
<div class="comment-content">
<p>Actually, it still contains a possible overflow. You need to cast before the addition.</p>
</div>
<ol class="children">
<li id="comment-648558" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/73207dd14a585241bef55ae9fe47b517?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/73207dd14a585241bef55ae9fe47b517?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sergei Sitnikov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-23T17:46:21+00:00">December 23, 2022 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>It doesn&rsquo;t matter, actually. The addition works exactly the same for signed and unsigned types in two’s complement representation. The cast is needed to perform the unsigned bit shift which doesn&rsquo;t preserve the sign (unlike the signed shift). In some sense the signed addition of non-negative values overflows to the sign bit, then we interpret the result as unsigned and do the unsigned division by 2.</p>
</div>
<ol class="children">
<li id="comment-648560" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-23T19:56:24+00:00">December 23, 2022 at 7:56 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s still an overflow though.</p>
<pre>
$ swift repl                                                  130
Welcome to Apple Swift version 5.7.2 (swiftlang-5.7.2.135.5 clang-1400.0.29.51).
Type :help for assistance.
  1> 9223372036854775807+1
expression failed to parse:
error: repl.swift:1:20: error: arithmetic operation '9223372036854775807 + 1' (on type 'Int') results in an overflow
9223372036854775807+1
~~~~~~~~~~~~~~~~~~~^~
</pre>
<p>You may say that the overflow, if it is not trapped, may be ignored, and you will be right because modern C/C++ and most other systems rely on two&rsquo;s complement. However, it is still, by definition, an overflow.</p>
</div>
<ol class="children">
<li id="comment-648561" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/73207dd14a585241bef55ae9fe47b517?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/73207dd14a585241bef55ae9fe47b517?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sergei Sitnikov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-23T21:06:45+00:00">December 23, 2022 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>You are right guys. Today I learned that <em>signed</em> integer overflow behavior is undefined in C(++). Sorry for inconvenience.</p>
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
<li id="comment-648445" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/92cd7c9aeed1e353dfae35d384a891ae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/92cd7c9aeed1e353dfae35d384a891ae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Norbert Juffa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-12-15T20:36:51+00:00">December 15, 2022 at 8:36 pm</time></a> </div>
<div class="comment-content">
<p>For historical context: The first publicly stated instance of the second formula that I am aware of appeared in a post by Peter L. Montgomery in newsgroup comp.arch on 2000/02/11; see<br/>
<a href="https://groups.google.com/d/msg/comp.arch/gXFuGZtZKag/_5yrz2zDbe4J" rel="nofollow ugc">https://groups.google.com/d/msg/comp.arch/gXFuGZtZKag/_5yrz2zDbe4J</a>:</p>
<p>&rdquo;<br/>
If XOR is available, then this can be used to average<br/>
two unsigned variables A and B when the sum might overflow:</p>
<p>(A+B)/2 = (A AND B) + (A XOR B)/2<br/>
&ldquo;</p>
</div>
</li>
</ol>
