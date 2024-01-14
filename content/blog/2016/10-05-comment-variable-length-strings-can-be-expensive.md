---
date: "2016-10-05 12:00:00"
title: "Variable-length strings can be expensive"
index: false
---

[20 thoughts on &ldquo;Variable-length strings can be expensive&rdquo;](/lemire/blog/2016/10-05-variable-length-strings-can-be-expensive)

<ol class="comment-list">
<li id="comment-254667" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">David Tweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T16:46:47+00:00">October 5, 2016 at 4:46 pm</time></a> </div>
<div class="comment-content">
<p>Out of curiosity, which compiler &amp; version did you use for the C++? (The small string optimization in recent C++ makes them very close to fixed length strings for small strings, at the cost of a few more instructions to decide which version is being used.)</p>
</div>
<ol class="children">
<li id="comment-254682" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T17:44:56+00:00">October 5, 2016 at 5:44 pm</time></a> </div>
<div class="comment-content">
<p><em>Out of curiosity, which compiler &#038; version did you use for the C++?</em></p>
<pre>
$ g++ --version
g++ (Ubuntu 5.4.1-2ubuntu1~16.04) 5.4.1 20160904
</pre>
<p><em>The small string optimization in recent C++ makes them very close to fixed length strings for small strings (&#8230;) </em></p>
<p>My results are much the same under <tt>clang</tt>. With the Intel compiler, fixed-length strings are no longer any faster, but that&rsquo;s because they get to be as slow as the variable-length ones.</p>
<p>I don&rsquo;t have easy access to old compilers on this exact machine.</p>
</div>
<ol class="children">
<li id="comment-254693" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">davetweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T18:45:00+00:00">October 5, 2016 at 6:45 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve had a look at your code and I wouldn&rsquo;t be surprised if the biggest contribution to the speed difference is that the fixed length 8 padded-strings are allowing you to use a very optimized comparison function. (I don&rsquo;t have a profiler setup on my new machine yet.)<br/>
This is an interesting result and I agree fixed length strings are interesting, I&rsquo;m just interested in figuring out what precisely is happening on the machine.</p>
</div>
</li>
<li id="comment-254760" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-06T09:48:36+00:00">October 6, 2016 at 9:48 am</time></a> </div>
<div class="comment-content">
<p>Still not clear whether you benchmarked the C++11 std::string or C++98 std::string? <a href="http://developers.redhat.com/blog/2015/02/05/gcc5-and-the-c11-abi/" rel="nofollow ugc">http://developers.redhat.com/blog/2015/02/05/gcc5-and-the-c11-abi/</a></p>
<p>clang can use the GNU C++ standard library, so the next question is which C++ standard library did you benchmark with clang?</p>
</div>
<ol class="children">
<li id="comment-254787" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-06T14:27:55+00:00">October 6, 2016 at 2:27 pm</time></a> </div>
<div class="comment-content">
<p>The command line I used to compile my small program is in the first line of the source code:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/10/05/pointersort.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/10/05/pointersort.cpp</a></p>
<p>This is a fresh Ubuntu install (see previous comment for version number).</p>
<p>I encourage you to run your own experiments.</p>
</div>
<ol class="children">
<li id="comment-254803" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b7be2a1f07fa1d1cca90b2dc1bc2374?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b7be2a1f07fa1d1cca90b2dc1bc2374?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gaurav</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-06T18:03:18+00:00">October 6, 2016 at 6:03 pm</time></a> </div>
<div class="comment-content">
<p>Memory alignment could be playing a role over here.</p>
<p>A useful test might be to allocate memory for std::string using aligned_alloc (alignment = 8).</p>
</div>
<ol class="children">
<li id="comment-254807" class="comment byuser comment-author-lemire bypostauthor even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-06T18:59:54+00:00">October 6, 2016 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;d be interested in any number you have but I am skeptical regarding memory alignment in this case. I doubt memory access is the bottleneck.</p>
</div>
</li>
</ol>
</li>
<li id="comment-255281" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4c476469ffae422c3dd50720fbd7ef2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maxim Egorushkin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-11T11:25:12+00:00">October 11, 2016 at 11:25 am</time></a> </div>
<div class="comment-content">
<p>I do not have Ububtu, but I still would like to know which std::string was used in your benchmarks.</p>
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
<li id="comment-254669" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T17:00:19+00:00">October 5, 2016 at 5:00 pm</time></a> </div>
<div class="comment-content">
<p>I suspect that a real application spends very little overall time sorting strings, so optimizing that part will have little impact on the overall performance.</p>
<p>I recently profiled some data acquisition middleware, and discovered that it spent 93% of it&rsquo;s time waiting on the driver to deliver raw data. Optimizing the remaining 7% would be largely a waste of my time.</p>
<p>When looking closely at the driver &#8211; I further uncovered that I was operating at about 70% of the underlying transport mechanisms&rsquo; capacity &#8211; and improving this would require better firmware on the device side (reducing gaps between bytes and strings).</p>
<p>So &#8211; even though I was adding arrays of integer numbers together, and I could see ways to optimize these, it would make no appreciable difference overall.</p>
</div>
<ol class="children">
<li id="comment-254684" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T17:53:07+00:00">October 5, 2016 at 5:53 pm</time></a> </div>
<div class="comment-content">
<p>@Dominic </p>
<p>You&rsquo;ll get no argument from me.</p>
<p>Many systems have their performance bound set by IO, network&#8230; or other architectural constraints. That&rsquo;s why we build massive systems using JavaScript (which does not even support parallelism!).</p>
</div>
</li>
</ol>
</li>
<li id="comment-254672" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0aa73a17e1e2f79dbed2820d01cabb05?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0aa73a17e1e2f79dbed2820d01cabb05?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Abhimanyu Rawat</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T17:08:54+00:00">October 5, 2016 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>As you said it&rsquo;s application dependent, in MySQL where a fixed length is required the performance should be better. And going further in C padded where the string fits in word length only, there is some architecture dependency as well right, for tuning it to avoid pointers ?</p>
</div>
<ol class="children">
<li id="comment-254687" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T18:10:21+00:00">October 5, 2016 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p><em>in MySQL where a fixed length is required the performance should be better</em></p>
<p>I expect so but I&rsquo;d be interested in seeing numbers.</p>
</div>
</li>
</ol>
</li>
<li id="comment-254680" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T17:39:14+00:00">October 5, 2016 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>GCC strings are notoriously bad, because they are copy-on-write. They even used to have atomic operations involved in simple constructors, not to mention that GNU couldn&rsquo;t implement a bug-free string implementation for a multi-core environment for many years. Copy-on-read strings are probably better (unfortunately, STLPORT died).</p>
<p>That said, even with copy-on-read strings, accessing the string requires a dereference operation, which slows things down. Try a variant of the string, which keeps the counter followed by the data buffer. This one could be fast, IMHO.</p>
</div>
<ol class="children">
<li id="comment-254689" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">davetweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T18:22:18+00:00">October 5, 2016 at 6:22 pm</time></a> </div>
<div class="comment-content">
<p>I think that used to be the case prior to the changes for C++11. (Not that g++&rsquo;s stuff is brilliant, but it does use the SSO now.)</p>
</div>
<ol class="children">
<li id="comment-254698" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T19:20:18+00:00">October 5, 2016 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>Good to know, thank you! Is 1024 char a short string?</p>
</div>
<ol class="children">
<li id="comment-254700" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T19:30:35+00:00">October 5, 2016 at 7:30 pm</time></a> </div>
<div class="comment-content">
<p>To clarify: in the test, my strings are short (much less than 8 bytes), but I sort 1024 of them.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-254681" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://searchivarius.org/about" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T17:41:04+00:00">October 5, 2016 at 5:41 pm</time></a> </div>
<div class="comment-content">
<p>BTW, Java&rsquo;s string are immutable for a good reason. In a multi-threaded environment, it&rsquo;s often much cheaper to copy a small string than to block a gazillion of threads on trivial string operations.</p>
</div>
<ol class="children">
<li id="comment-254685" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T18:05:58+00:00">October 5, 2016 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s a good point.</p>
<p>Rust and Swift offer both mutable and immutable strings.</p>
</div>
</li>
</ol>
</li>
<li id="comment-254701" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T19:50:23+00:00">October 5, 2016 at 7:50 pm</time></a> </div>
<div class="comment-content">
<p>We&rsquo;ve unfortunately hit the point where most dictionary words will fit into a single machine word; the classic benchmark of sorting the dictionary turns out slower using classic algorithms than sorting it fixed-length. </p>
<p>Some current algorithms use the fixed-length method by caching 4-8 bytes in an int next to the string pointer. For instance here: <a href="http://rd.springer.com/chapter/10.1007%2F978-3-540-89097-3_3#page-1" rel="nofollow ugc">http://rd.springer.com/chapter/10.1007%2F978-3-540-89097-3_3#page-1</a> . It is indeed faster.</p>
</div>
</li>
<li id="comment-254719" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2c2b8044eca80b9a707c716c530d9f5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2c2b8044eca80b9a707c716c530d9f5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://uxcn.blogspot.com" class="url" rel="ugc external nofollow">Jason Schulz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-10-05T23:32:47+00:00">October 5, 2016 at 11:32 pm</time></a> </div>
<div class="comment-content">
<p>It seems like adding length to the type in certain cases, similar to std::array, ultimately gives the compiler/optimizer more information to optimize with.</p>
</div>
</li>
</ol>
