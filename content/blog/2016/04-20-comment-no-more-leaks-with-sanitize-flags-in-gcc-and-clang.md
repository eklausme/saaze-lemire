---
date: "2016-04-20 12:00:00"
title: "No more leaks with sanitize flags in gcc and clang"
index: false
---

[41 thoughts on &ldquo;No more leaks with sanitize flags in gcc and clang&rdquo;](/lemire/blog/2016/04-20-no-more-leaks-with-sanitize-flags-in-gcc-and-clang)

<ol class="comment-list">
<li id="comment-236489" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-20T18:07:18+00:00">April 20, 2016 at 6:07 pm</time></a> </div>
<div class="comment-content">
<p>Thanks &#8211; I was not aware of these flags. Now I need to check if my cross compiler supports them!</p>
</div>
<ol class="children">
<li id="comment-236490" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-20T18:11:53+00:00">April 20, 2016 at 6:11 pm</time></a> </div>
<div class="comment-content">
<p>The caveat is that they are only available on recent versions of the compilers but I stress that they are no longer &ldquo;experimental&rdquo; or &ldquo;bleeding edge&rdquo;. They work out-of-the-box without fiddling, without unnecessary bugs.</p>
<p>I don&rsquo;t know whether they work for all targets, but I suspect that they must.</p>
</div>
</li>
</ol>
</li>
<li id="comment-236492" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.bfilipek.com" class="url" rel="ugc external nofollow">fenbf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-20T18:40:39+00:00">April 20, 2016 at 6:40 pm</time></a> </div>
<div class="comment-content">
<p>Will this functionality find memory allocations in more complex scenarios? Like when you allocate mem at some point, pass it around the app and the forget about deleting?</p>
<p>BTW: Is there something similar for MSVC? You can use clang with VS 2015&#8230; so maybe that way you can take advantage of it somehow?</p>
</div>
<ol class="children">
<li id="comment-236494" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-20T19:07:07+00:00">April 20, 2016 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p><em>Will this functionality find memory allocations in more complex scenarios? Like when you allocate mem at some point, pass it around the app and the forget about deleting?</em></p>
<p>Of course. Though it will only tell you where the memory was allocated, not where it should have been freed.</p>
<p><em>BTW: Is there something similar for MSVC? You can use clang with VS 2015â€¦ so maybe that way you can take advantage of it somehow?</em></p>
<p>I don&rsquo;t think you can &ldquo;use clang with VS 2015&rdquo;. As far as I can tell, Microsoft only allows you to use the clang parser. These sanitizers have to do with the generated code, not merely the parser. So it is different.</p>
</div>
<ol class="children">
<li id="comment-236539" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.bfilipek.com" class="url" rel="ugc external nofollow">fenbf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-21T07:46:34+00:00">April 21, 2016 at 7:46 am</time></a> </div>
<div class="comment-content">
<p>aaa&#8230; right, so the sanitizers cannot be invoked from VS and thus you cannot use this feature.<br/>
I hope VS will create something similar soon&#8230;</p>
</div>
<ol class="children">
<li id="comment-388656" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6450add5c76df67820ec0ccc3707cdf5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6450add5c76df67820ec0ccc3707cdf5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">MitrikSicilian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-15T08:43:36+00:00">February 15, 2019 at 8:43 am</time></a> </div>
<div class="comment-content">
<p>Microsoft has Application Verifier which comes with any VS installation. AppVerifier can tell you about leaks a bit, but it was made for different purpose.<br/>
I think you can find more info here: <a href="https://stackoverflow.com/questions/10240067/how-to-use-microsoft-application-verifier" rel="nofollow ugc">https://stackoverflow.com/questions/10240067/how-to-use-microsoft-application-verifier</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-236512" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b949331268e34c977c048af4347c08be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b949331268e34c977c048af4347c08be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matt D.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-21T01:17:27+00:00">April 21, 2016 at 1:17 am</time></a> </div>
<div class="comment-content">
<p>Perhaps you can try Dr. Memory:<br/>
<a href="http://drmemory.org/" rel="nofollow ugc">http://drmemory.org/</a><br/>
<a href="https://github.com/DynamoRIO/drmemory" rel="nofollow ugc">https://github.com/DynamoRIO/drmemory</a></p>
<p>It&rsquo;s cross-platform, including support for Visual Studio on Windows: <a href="http://drmemory.org/docs/page_prep.html#sec_prep_windows" rel="nofollow ugc">http://drmemory.org/docs/page_prep.html#sec_prep_windows</a></p>
<p>In particular, it can also diagnose memory leaks:<br/>
<a href="http://drmemory.org/docs/page_leaks.html" rel="nofollow ugc">http://drmemory.org/docs/page_leaks.html</a></p>
</div>
<ol class="children">
<li id="comment-236540" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9d386c878599019da877e61fb9a9b15f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.bfilipek.com" class="url" rel="ugc external nofollow">fenbf</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-21T07:47:17+00:00">April 21, 2016 at 7:47 am</time></a> </div>
<div class="comment-content">
<p>thanks! I&rsquo;ve heard about this tool some time ago and it&rsquo;s definitely worth checking further.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-236691" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-22T16:31:09+00:00">April 22, 2016 at 4:31 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s a bad idea to run with these sanitizers outside of testing environments though, definitely not in production.</p>
<p>As far as I&rsquo;m aware there&rsquo;s been no effort to ensure the security of the sanitizer runtimes themselves, so even if they protect against memory bugs in application code, there are pretty huge security holes in the runtimes. See: <a href="http://seclists.org/oss-sec/2016/q1/363" rel="nofollow ugc">http://seclists.org/oss-sec/2016/q1/363</a></p>
<p>They&rsquo;re great for testing though (we run address-sanitizer builds as part of our regular testing).</p>
</div>
<ol class="children">
<li id="comment-236695" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-04-22T17:43:30+00:00">April 22, 2016 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p><em>It&rsquo;s a bad idea to run with these sanitizers outside of testing environments (&#8230;)</em></p>
<p>Though I was maybe not sufficiently clear in my blog post, I meant to refer to these sanitizers as superior alternatives (or complements) to other testing and debugging tools like <tt>valgrind</tt>. </p>
<p>However, since they can help produce better code, I think that they may end up generating more secure software.</p>
</div>
</li>
</ol>
</li>
<li id="comment-282361" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-26T22:47:25+00:00">June 26, 2017 at 10:47 pm</time></a> </div>
<div class="comment-content">
<p>hello Daniel, I would like to ask you a question. Do you know why the AddressSanitizer would be taking a whole different set of libraries.</p>
<p>For instance, I was trying to recreate strcmp, but what I realized is that compiling it normally it just gives me the difference, but with -fsanitize=address it gives me 1, 0, -1 outputs.</p>
<p>Thanks</p>
</div>
<ol class="children">
<li id="comment-282368" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T00:30:21+00:00">June 27, 2017 at 12:30 am</time></a> </div>
<div class="comment-content">
<p><em>Do you know why the AddressSanitizer would be taking a whole different set of libraries.</em></p>
<p>I very much doubt that it is what it is doing.</p>
<p><em>I was trying to recreate strcmp, but what I realized is that compiling it normally it just gives me the difference, but with -fsanitize=address it gives me 1, 0, -1 outputs.</em></p>
<p>Can you post your code?</p>
</div>
<ol class="children">
<li id="comment-282371" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T01:43:20+00:00">June 27, 2017 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>Here is my source in the left and the two different outputs in the right:<br/>
<a href="http://imgur.com/uU2SZyB" rel="nofollow ugc">http://imgur.com/uU2SZyB</a></p>
<p>You can clearly see that output of libc strcmp changes from difference to hardcoded outputs of 1, 0, -1 only when the -fsanitize=address is used.</p>
<p>Btw, this is my testfile:</p>
<p>#include<br/>
#include<br/>
#include &ldquo;libft.h&rdquo;<br/>
#include </p>
<p> int a, b, i, n;<br/>
char *ra, *rb;</p>
<p> i = 0;<br/>
n = 1000;<br/>
while (i &lt;= n)<br/>
{<br/>
if (i &lt; n)<br/>
{<br/>
ra = strdup(ft_itoa(arc4random()));<br/>
rb = strdup(ft_itoa(arc4random()));<br/>
}<br/>
else<br/>
{<br/>
ra = &quot;cba&quot;;<br/>
rb = &quot;cba&quot;;<br/>
}<br/>
a = ft_strcmp(ra, rb);<br/>
b = strcmp(ra, rb);<br/>
if (a != b)<br/>
printf(&quot;\033[1m\033[31m[ FAIL ]\x1b[0m: str1: [%s] \t| str2: [%s] \t| ft_strcmp: %d\t| strcmp: %d\n&quot;, ra, rb, a, b);<br/>
else<br/>
printf(&quot;\033[1m\033[32m[ OK ]\x1b[0m: str1: [%s] \t| str2: [%s] \t| ft_strcmp: %d\t| strcmp: %d\n&quot;, ra, rb, a, b);<br/>
i++;<br/>
}<br/>
}</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-282372" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T01:58:37+00:00">June 27, 2017 at 1:58 am</time></a> </div>
<div class="comment-content">
<p>For future readers, here a code sample to reproduce the issue: </p>
<pre style="color:#000000;background:#ffffff;"><span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">stdio.h</span><span style="color:#800000; ">></span>
<span style="color:#004a43; ">#</span><span style="color:#004a43; ">include </span><span style="color:#800000; ">&lt;</span><span style="color:#40015a; ">string.h</span><span style="color:#800000; ">></span>

<span style="color:#800000; font-weight:bold; ">int</span> <span style="color:#400000; ">main</span><span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
  <span style="color:#800000; font-weight:bold; ">const</span> <span style="color:#800000; font-weight:bold; ">char</span> <span style="color:#808030; ">*</span> ra <span style="color:#808030; ">=</span> <span style="color:#800000; ">"</span><span style="color:#0000e6; ">1375154539</span><span style="color:#800000; ">"</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">const</span> <span style="color:#800000; font-weight:bold; ">char</span> <span style="color:#808030; ">*</span> rb <span style="color:#808030; ">=</span> <span style="color:#800000; ">"</span><span style="color:#0000e6; ">-497308599</span><span style="color:#800000; ">"</span><span style="color:#800080; ">;</span>
  <span style="color:#603000; ">printf</span><span style="color:#808030; ">(</span><span style="color:#800000; ">"</span><span style="color:#007997; ">%d</span><span style="color:#0000e6; "> </span><span style="color:#0f69ff; ">\n</span><span style="color:#800000; ">"</span><span style="color:#808030; ">,</span> <span style="color:#603000; ">strcmp</span><span style="color:#808030; ">(</span>ra<span style="color:#808030; ">,</span> rb<span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>
</pre>
</div>
<ol class="children">
<li id="comment-282373" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T02:07:44+00:00">June 27, 2017 at 2:07 am</time></a> </div>
<div class="comment-content">
<p>Were you able to get a different output as well with the -fsanitize=address?<br/>
I am on OSX 10.11.6 btw</p>
<p>And this is the configuration of gcc/clang in this machine:<br/>
Configured with: &#8211;prefix=/Applications/Xcode.app/Contents/Developer/usr &#8211;with-gxx-include-dir=/Applications/Xcode.app/Contents/Developer/Platforms/MacOSX.platform/Developer/SDKs/MacOSX10.12.sdk/usr/include/c++/4.2.1<br/>
Apple LLVM version 8.0.0 (clang-800.0.38)<br/>
Target: x86_64-apple-darwin15.6.0<br/>
Thread model: posix<br/>
InstalledDir: /Applications/Xcode.app/Contents/Developer/Toolchains/XcodeDefault.xctoolchain/usr/bin</p>
</div>
<ol class="children">
<li id="comment-282374" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T02:12:29+00:00">June 27, 2017 at 2:12 am</time></a> </div>
<div class="comment-content">
<p>Yes. I am able to reproduce the issue and it can be explained by looking at the code of the sanitizer in LLVM: </p>
<p><a href="https://github.com/llvm-mirror/compiler-rt/blob/35f212efc287a7b582afcb41d86bdff7a29e7367/lib/sanitizer_common/sanitizer_common_interceptors.inc#L757" rel="nofollow ugc">https://github.com/llvm-mirror/compiler-rt/blob/35f212efc287a7b582afcb41d86bdff7a29e7367/lib/sanitizer_common/sanitizer_common_interceptors.inc#L757</a></p>
<p>As you can see in this code, the sanitizer has its own implementation of the memcmp function. It calls CharCmpX which you can find in the file above, and that returns -1, 0, 1. </p>
<p>There is a set of functions that are re-implemented with various safety checks in this manner.</p>
<p>So it is not loading a whole other library, it is simply the compiler handling these functions as special cases.</p>
<p>Note that if your code relied on getting specific values out of memcmp, then it was wrong as per the standard.</p>
</div>
<ol class="children">
<li id="comment-282391" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T09:31:57+00:00">June 27, 2017 at 9:31 am</time></a> </div>
<div class="comment-content">
<p>Thank you very much for this answer.<br/>
Everyone else I asked was handwaving it or not really caring about this by just saying that &ldquo;you should not use strcmp that way anyways, so why bother&rdquo;.</p>
<p>But now my next question is, what would they decide to intercept strcmp and the other functions, is it really a security risk to be doing s1 &#8211; s2?</p>
</div>
<ol class="children">
<li id="comment-282400" class="comment byuser comment-author-lemire bypostauthor odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T13:10:02+00:00">June 27, 2017 at 1:10 pm</time></a> </div>
<div class="comment-content">
<p><em>But now my next question is, what would they decide to intercept strcmp and the other functions, is it really a security risk to be doing s1 â€“ s2?</em></p>
<p>It is definitively wrong for your code to assume a specific implementation of <tt>strcmp</tt>.</p>
</div>
<ol class="children">
<li id="comment-282423" class="comment even depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T20:12:51+00:00">June 27, 2017 at 8:12 pm</time></a> </div>
<div class="comment-content">
<p>Yeah, I get that, so are you saying that that the reason that they intercept the strcmp by addresssanitizer is to check if someone is using the strcmp implementation improperly?</p>
<p>*Scratching my head*</p>
<p>I would like to know what is the rationale for the devs to add these intercepts:</p>
<p>#if SANITIZER_INTERCEPT_STRCMP<br/>
static inline int CharCmpX(unsigned char c1, unsigned char c2) {<br/>
return (c1 == c2) ? 0 : (c1 &lt; c2) ? -1 : 1;<br/>
}</p>
<p>I am interested in the decision making process and the reasons behind them, thanks!</p>
</div>
<ol class="children">
<li id="comment-282425" class="comment byuser comment-author-lemire bypostauthor odd alt depth-7 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T20:24:48+00:00">June 27, 2017 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>I guess you would want to see&#8230;</p>
<pre style="color:#000000;background:#ffffff;"><span style="color:#800000; font-weight:bold; ">int</span> CharCmpX<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">unsigned</span> <span style="color:#800000; font-weight:bold; ">char</span> c1<span style="color:#808030; ">,</span> <span style="color:#800000; font-weight:bold; ">unsigned</span> <span style="color:#800000; font-weight:bold; ">char</span> c2<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
  <span style="color:#800000; font-weight:bold; ">return</span> c2 <span style="color:#808030; ">-</span> c1<span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>
</pre>
<p>As far as I can tell, the result of this function is not well defined in C. The subtraction is fine, but the assignment to a signed integer is implementation dependent.</p>
</div>
<ol class="children">
<li id="comment-282427" class="comment even depth-8 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T21:39:29+00:00">June 27, 2017 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p>Btw my colleagues in school are telling me to just not use addresssanitizer and to use &ldquo;leaks&rdquo; or &ldquo;valgrind&rdquo; instead.</p>
<p>And that AddressSanitizer actually doesn&rsquo;t work in OSX.</p>
<p>Thank you a lot for your patience.<br/>
What would you be ur input on that?</p>
</div>
<ol class="children">
<li id="comment-282428" class="comment byuser comment-author-lemire bypostauthor odd alt depth-9 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-27T21:49:10+00:00">June 27, 2017 at 9:49 pm</time></a> </div>
<div class="comment-content">
<p>I comment on valgrind in my blog post and why I think that using the sanitizers in your compiler are better. And yes, the sanitizers work under macOS, they are officially supported by Apple (as of Xcode 7).</p>
</div>
<ol class="children">
<li id="comment-282938" class="comment even depth-10">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/810ab3222e45b34b137dd95c88cc875e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">asker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-07T05:13:24+00:00">July 7, 2017 at 5:13 am</time></a> </div>
<div class="comment-content">
<p>Yes, I just wanted to reconfirm, thank you very much.<br/>
If you have a bitcoin address, let me tip you!</p>
<p>I learned a lot!</p>
</div>
</article>
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
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-383483" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30a4c83e291c7a09149777179f1ef311?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30a4c83e291c7a09149777179f1ef311?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gheorghe Georgios</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-21T21:32:35+00:00">January 21, 2019 at 9:32 pm</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>I&rsquo;ve tried your C code on macOS Mojave, compiled with:</p>
<p><code>clang -std=c17 -Wall -pedantic -g -fsanitize=address fsanitize=undefined -fno-omit-frame-pointer test.c -o test<br/>
</code></p>
<p>At runtime there is no leak info printed. Same code works as expected on Linux. Any suggestion ?</p>
<p>Thanks</p>
</div>
<ol class="children">
<li id="comment-383484" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-21T21:44:15+00:00">January 21, 2019 at 9:44 pm</time></a> </div>
<div class="comment-content">
<p>On macOS, it will not detect leaks, but it can detect illegal memory accesses:</p>
<p><code> char * x = malloc(100);<br/>
x[1000] = 1;</code></p>
</div>
<ol class="children">
<li id="comment-383501" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/30a4c83e291c7a09149777179f1ef311?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/30a4c83e291c7a09149777179f1ef311?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gheorghe Georgios</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-21T22:51:23+00:00">January 21, 2019 at 10:51 pm</time></a> </div>
<div class="comment-content">
<p>Forgot to mention that in my previous comment I&rsquo;ve used a custom build of GCC 8.2. You are right about Apple&rsquo;s Clang, it doesn&rsquo;t detect memory leaks.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-383655" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T03:47:12+00:00">January 23, 2019 at 3:47 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not following the &ldquo;separate check breaks your workflow&rdquo; issue with Valgrind.</p>
<p>Both sanitizers and valgrind require you to modify the default process for building and running your executable: sanitizers by running a modified build command and valgring by modifying the run command.</p>
<p>In practice both when both are automated, there is little difference.</p>
<p>If running this &ldquo;manually&rdquo; it is not clear to me that one is much better than the other: one requires you to rebuild with the new flags and then run your normal command, the other requires you to run your normal command prefixed with valgrind. One could argue that valgrind is somehow more convenient since you can choose on each invocation whether to use it or not, and without rebuilding the binary (especially useful when you don&rsquo;t have the source for all the components). On other hand, some might like the always-on behavior of the santizers.</p>
<p>That said, I have absolutely nothing against the sanitizers, they are great! IMO their main benefits are not what you mention by rather:</p>
<p>They are much faster than Valgrind, in some cases making it feasible to leave them on in distributed binaries (although this is currently uncommon).<br/>
They catch a different set of issues, even where the domain overlaps with Valgrind: by having source-level access they can detect invalid accesses, e.g., in between structures allocated together and on the stack, that Valgrind can&rsquo;t.<br/>
There are many santizers that do things totally outside the scope of Valgrind such as undefined behavior.</p>
<p>On the other hand Valgrind works without source, doesn&rsquo;t require a rebuild and is compiler-independent.</p>
<p>Serious projects would do well to use both.</p>
</div>
<ol class="children">
<li id="comment-383705" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T14:09:04+00:00">January 23, 2019 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>I am not advocating against the use of valgrind. I use valgrind all the time (more later on that). I am arguing however that, for most people and most projects, sanitizers are the way of the future. And yes, it is in large part due to workflows.</p>
<p>Valgrind is an extra tool not typically bundled with your compiler. Having an extra dependency as part of your build system is not ideal. I know it is fashionable to build projects with long lists of dependencies, but I think it comes at a cost.</p>
<p>I can automate sanitizer flags as part of a cmake build trivially (I have do so in many projects). As far as I can tell, a tool like cmake does not come with support for valgrind. You will probably need to instruct your users to install valgrind if you depend on it. Note that you need to check the valgrind version because valgrind needs to interpret all instructions in your binary (an old valgrind won&rsquo;t do).</p>
<p>If you are using gcc and clang already, you have the sanitizers at your disposal, just one flag away. At least under Linux, the sanitizers will catch many more problems than valgrind.</p>
<p>The instrumented code will run faster. I did not point it out but I am glad you did: valgrind is unusable for some use cases. A sanitize test that would run in under a second could take a minute to run under valgrind thus, effectively, breaking your workflow.</p>
<p>It is even better with sanitizers because you can also easily instruct the compiler to only check some of the code with sanitizers (at least under clang). In a large project, this can make a massive difference.</p>
<p>Sanitizers have been getting fancier and more useful over time. It is now not just undefined instructions. There are more sanitizers that get added. You can also detect use them to debug data races. I really stand by my statement that serious projects should use sanitizers. I also make the prediction that they will keep on getting more useful with each new generation of compilers.</p>
<p>There are benefits to valgrind, of course. You point one out: it allows you to run a check on an unmodified binary. That&rsquo;s important because sanitizer flags, as far as I know, always create a modified binary. So you are not checking the binary that will actually run (assuming you run code without sanitizers), and that&rsquo;s a concern.</p>
<p>Also, sanitizers are still kind of new and sometimes flaky. So, for example, the sanitizers under macOS do not detect leaks (they do detect access violations however). Valgrind does detect leaks.</p>
<p>Implicit in my assessment is the predictions that the sanitizers will fix their problems and become easier to use. So far, this prediction has stood.</p>
<p>Valgrind will always remain useful but, in my view, not as a central components of the regular workflow of most projects, the way sanitizer flags should be.</p>
</div>
</li>
</ol>
</li>
<li id="comment-383716" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T16:01:45+00:00">January 23, 2019 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p>I think you are wrong that it is easier to add sanitizers to a typical workflow (unless you are talking about the scenario where you turn the sanitizers on always, i.e., <em>only</em> produce a sanitized binary). Of course it is easy to add sanitizers to CMake, because CMake is a <em>build system</em> and sanitizers are added at build time. All versions of CMake (even those that don&rsquo;t natively support sanitizers) perfectly supports Valgrind <em>at build time</em> because there is nothing you need to do to your build to support Valgrind.</p>
<p>Every type of continuous integration framework is going to support running the command as you want it, which includes prefixing valgrind. I have worked on many such systems and adding Valgrind would never be harder than adding the sanitizers! Adding the sanitizers is often harder because it requires a <em>different set of specially built-time instrumented binaries</em>. Imagine you are testing 100s or 1000s of changes a day: you&rsquo;ll have some type of sophisticated system for moving the build artifacts around to the places they need to get to, and suddenly multiplying the number of build artifacts by N (for the N types of sanitizers you want to run) is a big deal. Setting up Valgrind is trivial: it works just like any another test on the existing binaries.</p>
<p>Also, at least in the early days, and to some extent now, the &ldquo;dependency&rdquo; for sanitizers was much worse that Valgrind: you need specific compiler versions or even a different compiler (clang had it first and is still ahead of gcc)! Valgrind is an independent component that works with any compiler. Yes, it&rsquo;s a dependency &#8211; but most serious projects have dozens or 100s of them. Changing the compiler version is a far bigger, cross-cutting concern compared to adding a dependency.</p>
<p>Sanitizers are better because they cover many more issues, and do it faster (and this difference is fundamental because they work at the source level). They will probably &ldquo;win&rdquo; in the long run due to those advantages and because the amount of resources poured into clang is orders of magnitude more than a tool like Valgrind. I reach the opposite conclusion as you though: sanitizers can win <em>despite</em> being harder to integrate into existing workflows!</p>
<p>BTW: it&rsquo;s the same story for profilers: some profiles require you to generate a specially instrumented binary, and then run that to get your profiler. These are almost always harder to integrate than profilers that work &ldquo;as is&rdquo; on any existing binary (including those that do runtime re-instrumentation). I don&rsquo;t see any reason for sanitizers to be different.</p>
</div>
<ol class="children">
<li id="comment-383722" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T16:34:10+00:00">January 23, 2019 at 4:34 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>unless you are talking about the scenario where you turn the sanitizers on always, i.e., only produce a sanitized binary</p>
</blockquote>
<p>I suggest you develop your code using sanitizers.</p>
<p>My view is that sanitizers basically change the game entirely. They bring C/C++ to a level closer to Java, Rust and so forth. That is, they make it easier to produce C/C++ code that is safe and bug free. They can become tightly integrated in your programming.</p>
<p>So checking leaks is not a separate step. The check is right there, each time you run the program. Same with overflows and so forth.</p>
<p>Of course, it is possible to also release the code with sanitizers, and I bet that many teams do that, but I imagine that the release would do away with the sanitizer. Then, of course, you should probably run the release code with valgrind.</p>
<p>Other than that, yes, I agree that sanitizers are flaky, capricious. But it has been getting better.</p>
<p>Annoyingly, Microsoft does not seem to be interested in introducing the equivalent in its compilers.</p>
</div>
<ol class="children">
<li id="comment-383723" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T16:45:31+00:00">January 23, 2019 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>I see!</p>
<p>Yes, that is a reasonable approach for local development, and in this case I agree: it is totally transparent to your workflow since you just change a compiler flag and leave it like that. Sanitizers are fast enough that it&rsquo;s reasonable for most work. You&rsquo;ll catch bugs quickly this way.</p>
<p>Unfortunately last time I checked you couldn&rsquo;t really do this with all sanitizers since some were mutually exclusive, but you can still pick a reasonable default set. See <a href="https://stackoverflow.com/q/50364533/149138" rel="nofollow">this question</a> for example.</p>
</div>
<ol class="children">
<li id="comment-383725" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T17:02:04+00:00">January 23, 2019 at 5:02 pm</time></a> </div>
<div class="comment-content">
<p>Yes. Sanitizers are not as easy to use as they could be and my understanding is that they are just not available under Visual Studio. That&rsquo;s a shame.</p>
<p>I am not putting down valgrind in the least, but I think that sanitizers are underrated.</p>
</div>
<ol class="children">
<li id="comment-383729" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-23T17:08:23+00:00">January 23, 2019 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>I think they&rsquo;ve come a long way in popularity since 2016, at least. I certainly hear more about sanitizers that I do about Valgrind.</p>
<p>They are definitely a &ldquo;competitive advantage&rdquo; for compilers. I often use clang over gcc (which was always my default) because of its better sanitizers (and because originally only clang had them at all), and on Windows there is a big incentive to use clang-cl or whatever rather than MSVC cl.exe so you can get access to the sanitizers. The MSVC compilers are progressing fairly rapidly (at least compared to the past 15 years), so maybe they&rsquo;ll get this stuff soon.</p>
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
<li id="comment-407016" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8bcf43b9b61cdf1d4441739180b99ce6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8bcf43b9b61cdf1d4441739180b99ce6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ugur</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-16T14:21:02+00:00">May 16, 2019 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, could you please elaborate a bit why you think sanitizers are better than valgrind? Not that I disagree, but I&rsquo;d like to know your reasoning.</p>
</div>
<ol class="children">
<li id="comment-407030" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-05-16T15:28:26+00:00">May 16, 2019 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p>See my post <a href="https://lemire.me/blog/2019/05/16/building-better-software-with-better-tools-sanitizers-versus-valgrind/">Building better software with better tools: sanitizers versus valgrind</a>.</p>
</div>
</li>
</ol>
</li>
<li id="comment-415357" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fbec956321160497942d24513123eb9c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fbec956321160497942d24513123eb9c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Moritz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-07-04T13:58:42+00:00">July 4, 2019 at 1:58 pm</time></a> </div>
<div class="comment-content">
<p>Interestingly, especially regarding &ldquo;sanitizers versus valgrind&rdquo;:</p>
<p>Valgrind isn&rsquo;t available for armv5(tejl), because the architecture is missing some instruction. So I found that Debian ships libasan for arm-linux-gnueabi (which this armv5 is) &#8211; hurray! But now, your above case (malloc() without free()) does <strong>not</strong> trip on arm5, and neither on armv7(l) with gcc-5.4.0 or gcc-6.3.0, while it does on x86_64.</p>
<p>At the same time, libasan generally <strong>does</strong> work on armv5 (unlike valgrind), as introducing an out-of-bounds access (e.g. to array element <code>n</code> in array <code>i[n]</code>) to the source does trigger an error. So I wonder why it&rsquo;s partially working on arm. It depends on the class of address violation? I&rsquo;d really like to catch all possible errors. Well, better than nothing so far&#8230;</p>
</div>
</li>
<li id="comment-477314" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e9b71b5b0a9983e4b66bc173e0b82d17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e9b71b5b0a9983e4b66bc173e0b82d17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ray</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-12-23T16:40:38+00:00">December 23, 2019 at 4:40 pm</time></a> </div>
<div class="comment-content">
<p>For more complex (real world) examples you will want to add to the linker:</p>
<p>-fsanitize=address -static-libasan</p>
<p>to avoid ld.so linker errors:</p>
<p>==29640==ASan runtime does not come first in initial library list; you should either link runtime to your application or manually preload it with LD_PRELOAD.</p>
</div>
</li>
<li id="comment-533887" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/82b15e0902649860408424bc475b8aaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/82b15e0902649860408424bc475b8aaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jespada.com" class="url" rel="ugc external nofollow">Jordi Espada</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-07T07:33:17+00:00">July 7, 2020 at 7:33 am</time></a> </div>
<div class="comment-content">
<p>Great tool but AFAIK is not supported on windows through mingw 🙁</p>
</div>
<ol class="children">
<li id="comment-533994" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-07T12:11:41+00:00">July 7, 2020 at 12:11 pm</time></a> </div>
<div class="comment-content">
<p>I bet that it is supported as part as the Windows Subsystem for Linux.</p>
</div>
<ol class="children">
<li id="comment-534473" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/82b15e0902649860408424bc475b8aaa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/82b15e0902649860408424bc475b8aaa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jordi Espada</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-08T11:33:49+00:00">July 8, 2020 at 11:33 am</time></a> </div>
<div class="comment-content">
<p>Here says that leak sanitizer (lsan) is not supported for windows yet :-(, although address sanitizer is supported</p>
<p><a href="https://github.com/google/sanitizers/wiki/AddressSanitizerWindowsPort" rel="nofollow ugc">https://github.com/google/sanitizers/wiki/AddressSanitizerWindowsPort</a></p>
</div>
<ol class="children">
<li id="comment-534558" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-08T12:29:17+00:00">July 8, 2020 at 12:29 pm</time></a> </div>
<div class="comment-content">
<p>I think address sanitizer is the most important component. You do not want to be reading and writing to unallocated data regions in practice.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
