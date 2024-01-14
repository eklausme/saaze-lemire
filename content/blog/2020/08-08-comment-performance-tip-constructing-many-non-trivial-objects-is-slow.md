---
date: "2020-08-08 12:00:00"
title: "Performance tip: constructing many non-trivial objects is slow"
index: false
---

[8 thoughts on &ldquo;Performance tip: constructing many non-trivial objects is slow&rdquo;](/lemire/blog/2020/08-08-performance-tip-constructing-many-non-trivial-objects-is-slow)

<ol class="comment-list">
<li id="comment-548306" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://twitter.com/srchvrs" class="url" rel="ugc external nofollow">Leonid Boytsov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-08T20:54:13+00:00">August 8, 2020 at 8:54 pm</time></a> </div>
<div class="comment-content">
<p>Great reminder. I have also gotten a lot of speed up in parsing data strings by avoiding the use of streams. A bit of a downside is that string_view is C++17. Three years down the road do you think C++17 is already widely adopted?</p>
</div>
<ol class="children">
<li id="comment-548308" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8af88bac916c9bf3f45831c114d30b0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jouni</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-08T21:45:26+00:00">August 8, 2020 at 9:45 pm</time></a> </div>
<div class="comment-content">
<p>Wide adoption can mean many things. In bioinformatics, I&rsquo;ve found it useful to consider the default compilers installed in the field. If server lifespan is 5 years, it can take 5-6 years for a new C++ standard to be widely supported. C++14 reached that point recently, while C++17 is still some years away.</p>
</div>
</li>
<li id="comment-548414" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-09T17:40:15+00:00">August 9, 2020 at 5:40 pm</time></a> </div>
<div class="comment-content">
<p>My experience is that C++17 is widely available at this point, but rolling your own string_view-like class is not hard.</p>
</div>
</li>
</ol>
</li>
<li id="comment-548363" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c421a11614b577d5bffc96e397dd8621?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c421a11614b577d5bffc96e397dd8621?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-09T08:32:35+00:00">August 9, 2020 at 8:32 am</time></a> </div>
<div class="comment-content">
<p>This article states something obvious and basically lacks a point. just seems a cheap sneer at &lsquo;high level&rsquo; languages. No one writes performance sensitive code in python or JavaScript.</p>
</div>
<ol class="children">
<li id="comment-548413" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-09T17:39:03+00:00">August 9, 2020 at 5:39 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>This article states something obvious</p>
</blockquote>
<p>I am sure it was obvious to you, but what makes you believe that it is obvious to everyone?</p>
<blockquote>
<p>and basically lacks a point.</p>
</blockquote>
<p>I disagree. I think that this blog post makes a clear point.</p>
<blockquote>
<p>just seems a cheap sneer at ‘high level’ languages.</p>
</blockquote>
<p>It is not. I make my point using C++. If I wanted to make Python look bad, I would have used another approach.</p>
<blockquote>
<p>No one writes performance sensitive code in python or JavaScript.</p>
</blockquote>
<p>I disagree. Python and R are the dominant languages in data science. It is entirely possible to have high-performance data processing in Python and R. Of course, the heavy lifting won&rsquo;t be done in pure Python or in pure R.</p>
</div>
</li>
<li id="comment-548418" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85e55113f81c9b1c8abc744b64eabd3d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85e55113f81c9b1c8abc744b64eabd3d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eugene Epshteyn</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-09T18:14:09+00:00">August 9, 2020 at 6:14 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
No one writes performance sensitive code in python or JavaScript.
</p></blockquote>
<p>Many people seem to. Intel even has a distribution of Python optimized for Intel hardware: <a href="https://software.intel.com/content/www/us/en/develop/tools/distribution-for-python.html" rel="nofollow ugc">https://software.intel.com/content/www/us/en/develop/tools/distribution-for-python.html</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-548457" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bannister.us" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-08-10T01:26:17+00:00">August 10, 2020 at 1:26 am</time></a> </div>
<div class="comment-content">
<p>You can recycle heap-allocated objects to good effect. Many programs have a cyclic workload, so reusing the allocations from the first cycle can save a lot. And &#8230; never been fond of C++ strings. An approach I first adopted in the mid-1990s:<br/>
<a href="https://bannister.us/weblog/2005/building-a-better-string-class" rel="nofollow ugc">https://bannister.us/weblog/2005/building-a-better-string-class</a></p>
</div>
</li>
<li id="comment-636744" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed80657751d6a7dedbb5d73f054000a5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed80657751d6a7dedbb5d73f054000a5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-06-19T12:38:58+00:00">June 19, 2022 at 12:38 pm</time></a> </div>
<div class="comment-content">
<p>People just need to understand that memory allocations are costly, so if you want fast code, you want to minimize the number of &ldquo;mallocs&rdquo;.</p>
<p>Each std::string object is creating such an alloc, that&rsquo;s why if you create thousands, it gets very slow. std::string_view doesn&rsquo;t allocate memory, so that&rsquo;s why it&rsquo;s faster to use it if you can.</p>
<p>Same thing when you want to grow an std::string, like: += &ldquo;x&rdquo; multiple times. It will cause a few memory reallocations, so that&rsquo;s why if you know the size that you&rsquo;ll end up with, it&rsquo;s much faster to reserve the memory beforehand, and then do the concatenations, because you&rsquo;re allocating the memory only once instead of many times.</p>
</div>
</li>
</ol>
