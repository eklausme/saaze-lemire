---
date: "2023-07-05 12:00:00"
title: "Having fun with string literal suffixes in C++"
index: false
---

[7 thoughts on &ldquo;Having fun with string literal suffixes in C++&rdquo;](/lemire/blog/2023/07-05-having-fun-with-string-literal-suffixes-in-c)

<ol class="comment-list">
<li id="comment-652771" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c066b90a3a0ed64b55dc849a7259c8a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c066b90a3a0ed64b55dc849a7259c8a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">TatLim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-06T02:41:20+00:00">July 6, 2023 at 2:41 am</time></a> </div>
<div class="comment-content">
<p>The very first sentence contains a typo ‘used-defined’ which should be changed to ‘user-defined’. The second paragraph contains another typo ‘so you can write R”(\d+)” ‘ which should be changed to ‘so you can write R”(\d+)” ‘</p>
</div>
<ol class="children">
<li id="comment-652777" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-06T06:09:34+00:00">July 6, 2023 at 6:09 am</time></a> </div>
<div class="comment-content">
<p>Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652827" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3ada405ce890b6f8204094deb12d8a8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3ada405ce890b6f8204094deb12d8a8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pavel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-08T14:30:28+00:00">July 8, 2023 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Daniel! Do you know of any practical applications for operator&rdquo;&rdquo;? Operator overloading has become frowned upon for its obscurity, but this one has the potential to carry meaningful names.</p>
</div>
<ol class="children">
<li id="comment-652830" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-08T18:39:47+00:00">July 8, 2023 at 6:39 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Operator overloading has become frowned upon</p>
</blockquote>
<p>I think that&rsquo;s different from standard operator overloading. You have to specify a suffix, so you can&rsquo;t use it by accident.</p>
<blockquote>
<p>Do you know of any practical applications for operator””?</p>
</blockquote>
<p>We use it in the simdjson library.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652936" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2aad5adb8af1525125efc90bf2272c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2aad5adb8af1525125efc90bf2272c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-13T03:31:29+00:00">July 13, 2023 at 3:31 am</time></a> </div>
<div class="comment-content">
<p>Off topic, but what’s your opinion of adding operator overloading to C, in a way that the user would name the function that implements that operator, and therefore doesn’t require name mangling?</p>
<p>It’s an idea I’ve been kicking around.</p>
</div>
<ol class="children">
<li id="comment-652937" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-13T03:37:43+00:00">July 13, 2023 at 3:37 am</time></a> </div>
<div class="comment-content">
<p>Operator overloading in C or in C++?</p>
</div>
<ol class="children">
<li id="comment-652939" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2aad5adb8af1525125efc90bf2272c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2aad5adb8af1525125efc90bf2272c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-13T04:29:48+00:00">July 13, 2023 at 4:29 am</time></a> </div>
<div class="comment-content">
<p>In regular, old fashioned C.</p>
<p>I’m thinking something like: _Operator = UTF8String_Init;</p>
<p>Where UTF8String_Init is a previously declared function.</p>
<p>Implementation details could still be hidden, the _Operator declaration could be in a header too, and no name mangling necessary since the function has already been named by the programmer.</p>
<p>No need for a class to contain it either, since the types could be desuced from the parameters of the named function e.g: UTF8String UTF8String_Init(char8_t *Characters);</p>
<p>And for strings, I don’t see why there couldn’t be multiple variants for the same operator.</p>
<p>Like:</p>
<p>UTF8String UTF8String_InitFromChars(char8_t *Chars);</p>
<p>UTF8String UTF8String_InitFromChar(char8_t Char);</p>
<p>_Overload = UTF8String_InitFromChar;</p>
<p>_Overload = UTF8String_InitFromChars;</p>
<p>Basically, soft function overloading, but with better names.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
