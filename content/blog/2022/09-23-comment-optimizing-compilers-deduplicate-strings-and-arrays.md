---
date: "2022-09-23 12:00:00"
title: "Optimizing compilers deduplicate strings and arrays"
index: false
---

[14 thoughts on &ldquo;Optimizing compilers deduplicate strings and arrays&rdquo;](/lemire/blog/2022/09-23-optimizing-compilers-deduplicate-strings-and-arrays)

<ol class="comment-list">
<li id="comment-646043" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/61b37304c7ed74039a1489c855cee69f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/61b37304c7ed74039a1489c855cee69f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jonathan Graehl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-24T02:05:42+00:00">September 24, 2022 at 2:05 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s suffixes of C-strings that can be shared, not prefixes (recall their length is not encoded except implicitly by the 0 byte terminator).</p>
</div>
<ol class="children">
<li id="comment-646053" class="comment byuser comment-author-andrew odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-24T07:06:38+00:00">September 24, 2022 at 7:06 am</time></a> </div>
<div class="comment-content">
<p>The &ldquo;dear friend&rdquo; / &ldquo;dear friend\0f&rdquo; example uses a prefix that could be shared.</p>
</div>
<ol class="children">
<li id="comment-646079" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7ef5c84e1e00d2960b4f37c202d716c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7ef5c84e1e00d2960b4f37c202d716c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-25T14:07:43+00:00">September 25, 2022 at 2:07 pm</time></a> </div>
<div class="comment-content">
<p>It wouldn&rsquo;t be possible. The way suffix string optimization works is by having the block and placing pointers in the middle. Because null termination defines where the string is, you can&rsquo;t just cut off the end for one of them; however, you can cut off the beginning by placing the pointer of the substring in the middle.</p>
</div>
<ol class="children">
<li id="comment-646145" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Wozniczka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-28T21:28:18+00:00">September 28, 2022 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>In his example, the second string contains an explicit null character, so I think it COULD be shared with the first one?</p>
<p>Of course, it&rsquo;s probably rare enough that this comes up with string constants that compiler authors didn&rsquo;t bother to add the optimization</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-646065" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marius Miku?ionis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-24T21:47:35+00:00">September 24, 2022 at 9:47 pm</time></a> </div>
<div class="comment-content">
<p>I guess most of optimizations are due to deep inlining, but there is indeed lot of compression: very complex assembly in place of trivial lookup.<br/>
Very interesting cat-and-mouse games the compiler plays: when it comes to storage it makes very reasonable (conservative) assumptions, but when it comes to code generation, it just inlines as much as possible, to the point that most of computation is treated as &ldquo;constexpr&rdquo;.<br/>
Here are my experiments:<br/>
<a href="https://godbolt.org/z/bPqG9f14M" rel="nofollow ugc">https://godbolt.org/z/bPqG9f14M</a></p>
</div>
</li>
<li id="comment-646092" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89528a6bdc5f0e9af429605351151203?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89528a6bdc5f0e9af429605351151203?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pete Bannister</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-25T20:19:03+00:00">September 25, 2022 at 8:19 pm</time></a> </div>
<div class="comment-content">
<p>If you can discard the null termination rule though semantic analysis (e.g if the use of the strings is equivalent to c++&rsquo;s.std::span) then you ought to be able to optimize it &#8211; providing the value is not passed to any functions that expect null termination. Have you seen her Sutter&rsquo;s recent cpp2 talk? In a cpp2-pure context, that sort of optimization ought to become more possible I think</p>
</div>
<ol class="children">
<li id="comment-646105" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marius Mikucionis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-26T10:25:08+00:00">September 26, 2022 at 10:25 am</time></a> </div>
<div class="comment-content">
<p>I have seen suggestions to use std::stri g_view instead, which work like span, so that could be opportunity for compiler.</p>
</div>
</li>
</ol>
</li>
<li id="comment-646112" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d53862a970868a5df7a0a979b7c3f522?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d53862a970868a5df7a0a979b7c3f522?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-26T21:09:17+00:00">September 26, 2022 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>Great</p>
</div>
</li>
<li id="comment-646137" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb999eed8b210c8246f4b08643a2f314?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb999eed8b210c8246f4b08643a2f314?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Geoff Hill</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-27T22:33:30+00:00">September 27, 2022 at 10:33 pm</time></a> </div>
<div class="comment-content">
<p>This happens not just within compilation units—but across them too!—given a sufficiently smart linker. Read about the SHF_MERGE flag in ELF object files for more info.</p>
</div>
</li>
<li id="comment-646146" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ace5de8c10a087499c08247011719681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ace5de8c10a087499c08247011719681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonny</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-28T22:02:07+00:00">September 28, 2022 at 10:02 pm</time></a> </div>
<div class="comment-content">
<p>Interesting article, however maybe a mistake?</p>
<p>Comparing pointers.. only compares pointers, not the strings of bytes they may point to. For that you&rsquo;d need strcmp()</p>
<p>Your article writes: </p>
<p>&ldquo;The same trick fails with extended strings:<br/>
return str1 == str2&rdquo;</p>
</div>
<ol class="children">
<li id="comment-646148" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-28T23:01:16+00:00">September 28, 2022 at 11:01 pm</time></a> </div>
<div class="comment-content">
<p>It is not a mistake.</p>
</div>
</li>
<li id="comment-646163" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec8543447c3161a6bf01ca186767cda8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marius Mikucionis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-30T07:26:14+00:00">September 30, 2022 at 7:26 am</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s the whole point of the article: the compiler sometimes reuses the same piece of memory and therefore we compare pointers to detect that.</p>
</div>
</li>
</ol>
</li>
<li id="comment-646152" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c20381ee8508b1344dd4c1aaa1cc5aa8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c20381ee8508b1344dd4c1aaa1cc5aa8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Volker Simonis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-09-29T08:11:54+00:00">September 29, 2022 at 8:11 am</time></a> </div>
<div class="comment-content">
<p>Java has a feature called &ldquo;String deduplication&rdquo; (see <a href="https://openjdk.org/jeps/192" rel="nofollow ugc">https://openjdk.org/jeps/192</a>). It is not done by the compiler but by the GC and therefore GC specific. It doesn&rsquo;t recognize common substrings but it works for dynamically allocated strings.</p>
</div>
</li>
<li id="comment-646188" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70d415480fb58013869b5d79310657eb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70d415480fb58013869b5d79310657eb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sawyer Bergeron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-01T20:00:48+00:00">October 1, 2022 at 8:00 pm</time></a> </div>
<div class="comment-content">
<p>Can&rsquo;t share the prefix for C strings since they implicitly have (and require) a null terminator, so the first string is not actually a prefix of the second in terms of what it can store in the data section of the bin.</p>
<p>You could potentially have that optimization in languages where length is stored out of line (cpp/rust) but to try to break up and print common prefixes of strings with diverging postfixes without having print basically be an intrinsic with a *lot* of magic is hard (as well as significantly less performant, or bigger if you monomorphise which takes away the space savings)</p>
</div>
</li>
</ol>
