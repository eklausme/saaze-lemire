---
date: "2021-02-22 12:00:00"
title: "Parsing floating-point numbers really fast in C#"
index: false
---

[4 thoughts on &ldquo;Parsing floating-point numbers really fast in C#&rdquo;](/lemire/blog/2021/02-22-parsing-floating-point-numbers-really-fast-in-c)

<ol class="comment-list">
<li id="comment-577276" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/52a7e0168b945855f23900c0a8da7787?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/52a7e0168b945855f23900c0a8da7787?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">soywiz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-28T15:14:07+00:00">February 28, 2021 at 3:14 pm</time></a> </div>
<div class="comment-content">
<p>Hey Daniel, as always, really nice work!<br/>
Since C# is OpenSource, and your approach accurate, have you considered making a PR into C# runtime so everyone can benefit from that?</p>
<p><a href="https://github.com/dotnet/runtime/blob/308ae6ad833089199b8afbf30a7b402f35190fc8/src/libraries/System.Private.CoreLib/src/System/Double.cs#L284" rel="nofollow ugc">https://github.com/dotnet/runtime/blob/308ae6ad833089199b8afbf30a7b402f35190fc8/src/libraries/System.Private.CoreLib/src/System/Double.cs#L284</a></p>
</div>
<ol class="children">
<li id="comment-577393" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-01T16:26:46+00:00">March 1, 2021 at 4:26 pm</time></a> </div>
<div class="comment-content">
<p>An issue has been opened. Meanwhile, we are working hard to make the library as usable as possible.</p>
</div>
</li>
</ol>
</li>
<li id="comment-581956" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/46a12c8cf24f9d7f8ad7a1ef3ee5a010?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Duarte</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-10T01:02:48+00:00">April 10, 2021 at 1:02 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, a couple of questions. I was just about to ask what data format you were using for some of the integer libraries when I realized that a lot of these are parsing text files.</p>
<p>So when you say &ldquo;parsing&rdquo; floats or integers, should I understand that this means parsing a text representation of these values? Is that implied in the term &ldquo;parse&rdquo;, such that we wouldn&rsquo;t say we were parsing if the data was binary?</p>
<p>And then with these floats, I noticed the data files have a lot of content before the floats themselves. In many of the files, there are lots of leading zeros before each number (more than eight). What are those about? And then some files have a bunch of hex before each number, like this file:</p>
<p><a href="https://github.com/CarlVerret/csFastFloat/blob/master/TestcsFastFloat/data_files/tencent-rapidjson.txt" rel="nofollow ugc">https://github.com/CarlVerret/csFastFloat/blob/master/TestcsFastFloat/data_files/tencent-rapidjson.txt</a></p>
<p>What is that hex data? Are those supposed to be floats also? It seems like the floats come at the end of each row, after a lot of hex. An easier example is this one:</p>
<p><strong>58A8 43150000 4062A00000000000 149</strong></p>
<p>The float is 149, and the two longer strings in the middle are different hex representations of 149 as a float. But I don&rsquo;t know what 58A8 is. Is csFastFloat doing anything with those hex strings? Which representation is actually parsing?</p>
</div>
<ol class="children">
<li id="comment-581964" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-10T01:46:51+00:00">April 10, 2021 at 1:46 am</time></a> </div>
<div class="comment-content">
<p>We parse strings representing numbers in decimal form.</p>
<p>These files you are looking at are test files for internal use, and not part of the library. We use them for testing.</p>
</div>
</li>
</ol>
</li>
</ol>
