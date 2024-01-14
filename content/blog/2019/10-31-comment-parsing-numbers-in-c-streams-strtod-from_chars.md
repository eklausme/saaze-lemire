---
date: "2019-10-31 12:00:00"
title: "Parsing numbers in C++: streams, strtod, from_chars"
index: false
---

[7 thoughts on &ldquo;Parsing numbers in C++: streams, strtod, from_chars&rdquo;](/lemire/blog/2019/10-31-parsing-numbers-in-c-streams-strtod-from_chars)

<ol class="comment-list">
<li id="comment-437487" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-01T13:58:37+00:00">November 1, 2019 at 1:58 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Unfortunately my compiler does not support the from_chars function when parsing floating-point numbers.
</p></blockquote>
<p>Don&rsquo;t post this article then, or upgrade, we&rsquo;re gcc-10 if I understand things correctly.</p>
<p>Iff I would believe STL (lead STL dev), on Windows (the VC-STL, not some surrogate) this function (from_chars) beats anything.</p>
</div>
<ol class="children">
<li id="comment-437490" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-01T14:17:00+00:00">November 1, 2019 at 2:17 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Don’t post this article then, or upgrade, we’re gcc-10 if I understand things correctly.</p>
</blockquote>
<p>As of November 2019, looking at the source code in the GNU GCC repo, I do not see support for floats in from_chars.</p>
<p>Are you saying that it available in GNU GCC 10? When was that released?</p>
</div>
<ol class="children">
<li id="comment-437492" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0e1ea3874530809f31d47b3930a261dd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://example.com" class="url" rel="ugc external nofollow">degski</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-01T14:23:40+00:00">November 1, 2019 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>The world does not start and end with GNU GCC [and living on the edge 😉 is more fun].</p>
</div>
<ol class="children">
<li id="comment-437493" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-01T14:33:52+00:00">November 1, 2019 at 2:33 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>The world does not start and end with GNU GCC</p>
</blockquote>
<p>It does not look like it is available with LLVM at this time.</p>
<p>If someone can help me port my code to Visual Studio, while preserving the performance counters, I will gladly run the tests.</p>
</div>
<ol class="children">
<li id="comment-437536" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2fb1d0febf487a1d0b6ece2ff02affaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Chang</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-01T18:07:59+00:00">November 1, 2019 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>You can also try the abseil implementation of from_chars (<a href="https://github.com/abseil/abseil-cpp/blob/master/absl/strings/charconv.h" rel="nofollow ugc">https://github.com/abseil/abseil-cpp/blob/master/absl/strings/charconv.h</a> )</p>
</div>
<ol class="children">
<li id="comment-449028" class="comment odd alt depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oliver Schönrock</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-23T15:46:43+00:00">November 23, 2019 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>Good one! Have been looking for a solution to the apparently non-trivial problem of FAST float parsing. Clang and GCC not making any moves to support this part of C++17&#8230; 🙁</p>
<p>Building abseil::string now!</p>
</div>
</li>
<li id="comment-449037" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oliver Schönrock</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-23T16:28:09+00:00">November 23, 2019 at 4:28 pm</time></a> </div>
<div class="comment-content">
<p>bad news&#8230;</p>
<p>i haven&rsquo;t done very scientific testing, but it looks like absl::from_chars is dead slow for doubles</p>
<p>I could do a</p>
<p>std::string(const char* start_ptr, const char* end_ptr) field; // AND</p>
<p>stod(field);</p>
<p>and still be twice as fast as char_conv, which can do that in one step.</p>
<p>(I am iterating through a 190MB mmap&rsquo;ed file of floats).</p>
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
</ol>
</li>
</ol>
