---
date: "2023-10-19 12:00:00"
title: "For processing strings, streams in C++ can be slow"
index: false
---

[15 thoughts on &ldquo;For processing strings, streams in C++ can be slow&rdquo;](/lemire/blog/2023/10-19-for-processing-strings-streams-in-c-can-be-slow)

<ol class="comment-list">
<li id="comment-655537" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ad4ee71956de6520a70d92a93b0ad145?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-19T08:13:19+00:00">October 19, 2023 at 8:13 am</time></a> </div>
<div class="comment-content">
<p>TBH I&rsquo;m not sure if C++ streams are good at anything 🙂 They&rsquo;re the default choice when you don&rsquo;t care strongly about performance or ergonomics, but that&rsquo;s all.</p>
<p>It&rsquo;s also possible that old std::string implementations weren&rsquo;t good at mutation and appending.</p>
</div>
<ol class="children">
<li id="comment-655541" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4cb98fffa5dce9e7883eceb4314d1d6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4cb98fffa5dce9e7883eceb4314d1d6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Anton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-19T10:34:48+00:00">October 19, 2023 at 10:34 am</time></a> </div>
<div class="comment-content">
<p>+1</p>
</div>
</li>
</ol>
</li>
<li id="comment-655544" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f390164fd569ae1a107e706b5724198?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f390164fd569ae1a107e706b5724198?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mamam</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-19T13:02:54+00:00">October 19, 2023 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Is there any particular root cause for C++ streams to underperform so badly?</p>
</div>
<ol class="children">
<li id="comment-656709" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6594974f5c35271105c5023d1c184f07?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilya Popov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-07T11:35:26+00:00">December 7, 2023 at 11:35 am</time></a> </div>
<div class="comment-content">
<p>Some of the reasins are:</p>
<p>Streams are specified as an inheritance hierarchy with virtual methods, so stream operations incur virtual calls.<br/>
Streams are locale-aware and access locale on every operation, which is a mutex-protected global.<br/>
stringstreams make a copy of the underlying string (ability to move the string has been added in one of the latest standards)<br/>
For <code>cin</code> , <code>cout</code>, and <code>cerr</code>, (not the topic of this post) there is also sycronization with the libc functions (can be switched off using <code>sync_with_stdio(false)</code> and <code>tie(nullptr)</code>)</p>
</div>
</li>
</ol>
</li>
<li id="comment-655551" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f02ac8b94da5b900410ac2f5e57388d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f02ac8b94da5b900410ac2f5e57388d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tamas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-19T16:09:36+00:00">October 19, 2023 at 4:09 pm</time></a> </div>
<div class="comment-content">
<p>I played it a little bit with them. My stream_escape2 faster I just add a memory preallocation. I did measurement on desktop machine Windows vs2022 compiler.</p>
<p><code>loaded 6207 URLs<br/>
volume 725997 bytes<br/>
find_string_escape : 1.94 GB/s 16.6 Ma/s 60.34 ns/d<br/>
string_escape : 0.21 GB/s 1.8 Ma/s 566.31 ns/d<br/>
stream_escape : 0.05 GB/s 0.4 Ma/s 2461.41 ns/d<br/>
stream_escape2 : 0.69 GB/s 5.9 Ma/s 168.68 ns/d<br/>
find_string_escape2 : 1.97 GB/s 16.9 Ma/s 59.32 ns/d<br/>
</code></p>
<p>Code is here:</p>
<p><code>std::string stream_escape2(const std::string_view file_path) {<br/>
std::string escaped_file_path;<br/>
escaped_file_path.reserve(file_path.length() * 2);</p>
<p> for (char c : file_path) {<br/>
if (c == '%') {<br/>
escaped_file_path += "25";<br/>
}<br/>
else {<br/>
escaped_file_path.push_back(c);<br/>
}<br/>
}</p>
<p> return escaped_file_path;<br/>
}<br/>
</code></p>
<p>Similar did some change in find_string_escape function and after remove unnecessary string copying performance improved:</p>
<p><code>std::string find_string_escape2(std::string_view str) {<br/>
std::string escaped_file_path;<br/>
size_t pos = 0;<br/>
size_t start = 0;</p>
<p> while ((pos = str.find('%', start)) != std::string_view::npos) {<br/>
escaped_file_path += str.substr(start, pos - start);<br/>
escaped_file_path += "25";<br/>
start = pos + 1;<br/>
}</p>
<p> escaped_file_path += str.substr(start);<br/>
return escaped_file_path;<br/>
}<br/>
</code></p>
<p>I tested on your adb92cefbd3fbd97a4055734681dee20a1936f26 commit.</p>
</div>
</li>
<li id="comment-655569" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/49cf55c07ca038a1df143b8383d09ada?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/49cf55c07ca038a1df143b8383d09ada?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Karim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T02:48:02+00:00">October 20, 2023 at 2:48 am</time></a> </div>
<div class="comment-content">
<p>Dear sir<br/>
Thank you for your C++ new ideas. May I have a copy of this sources.<br/>
Best regards<br/>
Ak. Fathi</p>
</div>
<ol class="children">
<li id="comment-655571" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T04:01:59+00:00">October 20, 2023 at 4:01 am</time></a> </div>
<div class="comment-content">
<p>Please follow the links. I publish all the code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655579" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/243c6e8b80f76a68a2054ec1e954dc56?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/243c6e8b80f76a68a2054ec1e954dc56?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James Burbidge</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T12:15:05+00:00">October 20, 2023 at 12:15 pm</time></a> </div>
<div class="comment-content">
<p>Aside from the question of reserving memory, noted above, you are somewhat missing the point about streams. Streams are a general-purpose formatting mechanism, not a narrow string appending mechanism. Of course an exercise involving simple string concatenation will perform somewhat better using string::append() or operator +=(), as the extra overhead of the stream will have some cost. (Not to mention that going character-by-character will always generate a pessimal outcome.)</p>
<p>For a fairer comparison, which uses streams for the formatting purposes they were intended for, instead of always replacing % with %25, use an integral counter and replace % with &ldquo;%&rdquo; and the counter value appended. For your non-stream version you will probably want to use sprintf; for the stream version the insertion operator will suffice.</p>
</div>
<ol class="children">
<li id="comment-655584" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T14:25:11+00:00">October 20, 2023 at 2:25 pm</time></a> </div>
<div class="comment-content">
<p><em>For your non-stream version you will probably want to use sprintf; for the stream version the insertion operator will suffice.</em></p>
<p>Why would I use <tt>sprintf</tt>?</p>
<p>If I am unconcerned with performance, I would simply do:</p>
<pre>str += std::to_string(counter);
</pre>
<p>If I care about performance, I would probably use <tt>std::to_chars</tt> to get a boost (at the expense of some complexity).</p>
<p>Streams would be last on my list because they would assuredly be slower and not any more convenient.</p>
</div>
<ol class="children">
<li id="comment-655585" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/243c6e8b80f76a68a2054ec1e954dc56?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/243c6e8b80f76a68a2054ec1e954dc56?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">James Burbidge</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T15:29:30+00:00">October 20, 2023 at 3:29 pm</time></a> </div>
<div class="comment-content">
<p>I was thinking more generically. Granted that as of C++17 to_chars is more efficient for floating point and integral conversions (though underneath it may not be much more efficient than sprintf if much formatting is involved). Some of us are stuck in older environments.</p>
<p>Nor would I use even to_chars in a fully up-to-date environment: I&rsquo;d use the C++20 formatting library, which was introduced precisely to address the weaknesses in streams, in this case using std::format_to_n().</p>
<p>Streams are meant to replace the C style formatting functions (as is the new formatting library), not to replace strcat, and strcpy, which is effectively what you are doing. The sstream version was itself an afterthought, replacing the old strstream library, and was certainly not introduced as an aid to efficiency. It <em>is</em> a huge benefit if you have functions you want to unit test which normally use fstreams for writing to disk and you want to test with a generic iostream interface.</p>
<p>In production, outside of a tight inner loop, I wouldn&rsquo;t use <em>any</em> of this. I&rsquo;d use boost&rsquo;s replace_all_copy in their string algorithms library as being far more expressive (and probably more efficient) than a hand-rolled loop for your original example.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655772" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8ec3ea6aaae369e588a0b2ee220a3a12?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8ec3ea6aaae369e588a0b2ee220a3a12?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vimal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-27T02:01:36+00:00">October 27, 2023 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>ostringstream has a <code>write</code> method which is pretty fast. Needs to be protected by <code>std::ostringstream::sentry</code></p>
</div>
</li>
</ol>
</li>
<li id="comment-655728" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e8dfea32f5fdc2e143c586b0015ba503?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e8dfea32f5fdc2e143c586b0015ba503?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cly</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-25T17:59:13+00:00">October 25, 2023 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>I find the conclusion a bit misleading.<br/>
The main difference isn&rsquo;t string vs string_view vs stream; it&rsquo;s early exit or not.<br/>
The huge majority of your test strings do not contain any &lsquo;%&rsquo;; if you write some &ldquo;find_stream&rdquo; just prepending</p>
<p><code>if (file_path.find('%') == std::string::npos)<br/>
return std::string(file_path);<br/>
</code></p>
<p>I agree streams are pretty bad, but this is not the culprit here.</p>
<p>FWIW, here&rsquo;s my take at the exercise</p>
<p><code>std::string memchr_escape(const std::string_view file_path) {<br/>
const char *found = (const char *)memchr(file_path.begin(), '%', file_path.size());<br/>
if (found == nullptr)<br/>
return std::string(file_path);</p>
<p> size_t n_percent = (size_t)std::count(file_path.begin(), file_path.end(), '%');<br/>
size_t escaped_size = file_path.size() + 2 * n_percent;</p>
<p> auto copy_and_replace = [&amp;](char *escaped, size_t sz) {<br/>
const char *start = file_path.begin();<br/>
const auto end = file_path.end();<br/>
do {<br/>
size_t len = 1 + (size_t)std::distance(start, found);<br/>
memcpy(escaped, start, len);<br/>
memcpy(escaped + len, "25", 2);<br/>
escaped += len + 2;<br/>
start += len;<br/>
found = (const char *)memchr(start, '%', (size_t)std::distance(start, end));<br/>
} while(found != nullptr);<br/>
memcpy(escaped, start, (size_t)std::distance(start, end));<br/>
return sz;<br/>
};</p>
<p>#if __cpp_lib_string_resize_and_overwrite<br/>
std::string escaped_file_path;<br/>
escaped_file_path.resize_and_overwrite(escaped_size, copy_and_replace);<br/>
#else<br/>
std::string escaped_file_path(escaped_size, '\0');<br/>
copy_and_replace(escaped_file_path.data(), escaped_size);<br/>
#endif</p>
<p> return std::string(escaped_file_path);<br/>
}<br/>
</code></p>
<p>less maintainable I admit, but noticeably faster if you use top100.txt for the benchmark.</p>
</div>
</li>
<li id="comment-656118" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a0bdc5909014f3967c7522fb4a1947d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a0bdc5909014f3967c7522fb4a1947d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymoose</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-13T22:57:40+00:00">November 13, 2023 at 10:57 pm</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t help but think that perhaps part of the difference is that you&rsquo;re comparing <code>find_string_escape()</code> to <code>stream_escape()</code>, rather than to a comparable <code>find_stream_escape()</code>; your string version has a significantly more efficient algorithm than your stream version, so it&rsquo;s only natural that there&rsquo;ll be a significant performance difference. (Notably, you provided no version of <code>stream_escape()</code> which short-circuits on empty input, which is a major difference in and of itself.)</p>
<p>If you want a more even test, perhaps a <code>find_stream_escape()</code> would be useful? Even a relatively unoptimised version using <code>std::getline()</code> produces a noticeable difference; my quick testing puts it at roughly a 33% improvement. Which is admittedly still worse than raw strings, and by a pretty wide margin at that, but it does at least put the two on variants of the same algorithm, and thus at similar Big O complexities.</p>
<p><code>std::string find_stream_escape(std::string_view file_path) {<br/>
// Short-circuit for empty strings.<br/>
if (file_path.empty()) { return std::string(file_path); }</p>
<p> // ---</p>
<p> std::istringstream path_finder((std::string(file_path)));<br/>
std::ostringstream retter;</p>
<p> // Loop over string.<br/>
std::string temp;<br/>
while (std::getline(path_finder, temp, '%')) {<br/>
retter &lt;&lt; temp;</p>
<p> // Check last character.<br/>
if (path_finder.unget().get() == '%') { retter &lt;&lt; "%25"; }<br/>
}</p>
<p> return retter.str();<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-656120" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-11-13T23:20:35+00:00">November 13, 2023 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p><em>similar Big O complexities</em></p>
<p>All of these algorithms have linear complexity.</p>
</div>
</li>
</ol>
</li>
<li id="comment-656991" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-12-15T23:23:23+00:00">December 15, 2023 at 11:23 pm</time></a> </div>
<div class="comment-content">
<p>Streams are not slow. But constructing a new stream for each time you want to process a string is slow. Re-use an existing stream object, and you will find it much faster.</p>
</div>
</li>
</ol>
