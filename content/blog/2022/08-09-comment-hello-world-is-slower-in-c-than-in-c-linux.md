---
date: "2022-08-09 12:00:00"
title: "&#8220;Hello world&#8221; is slower in C++ than in C (Linux)"
index: false
---

[82 thoughts on &ldquo;&#8220;Hello world&#8221; is slower in C++ than in C (Linux)&rdquo;](/lemire/blog/2022/08-09-hello-world-is-slower-in-c-than-in-c-linux)

<ol class="comment-list">
<li id="comment-642441" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b6f84b044d71985a9f3812b66d226b2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b6f84b044d71985a9f3812b66d226b2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">zahir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T19:02:35+00:00">August 9, 2022 at 7:02 pm</time></a> </div>
<div class="comment-content">
<p>Also, using printf instead of std::cout does not seem to help C++.</p>
</div>
<ol class="children">
<li id="comment-642633" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fe350affd9113f805fd84d1ab46dc3af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fe350affd9113f805fd84d1ab46dc3af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Matti Laa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T10:22:55+00:00">August 11, 2022 at 10:22 am</time></a> </div>
<div class="comment-content">
<p>It does, if you remove #include header</p>
</div>
</li>
</ol>
</li>
<li id="comment-642443" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/72b09308205d0307392ee56808861fc6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/72b09308205d0307392ee56808861fc6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://aindien.com" class="url" rel="ugc external nofollow">Jason Moore</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T19:17:27+00:00">August 9, 2022 at 7:17 pm</time></a> </div>
<div class="comment-content">
<p>I am certainly not an expert in C++. However, if I remember correctly, std::endl is a lot slower than using \n. Of course, you may need to use std::endl. I wonder how the benchmark changes when using \n?</p>
</div>
</li>
<li id="comment-642448" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c092f97951bd950f147ecac588a10fd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c092f97951bd950f147ecac588a10fd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous Coward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T19:57:48+00:00">August 9, 2022 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>This isn&rsquo;t exactly news. The C++ specific printing facilities are known to be less efficient than plain old println(), and have been known to be slower decades.</p>
</div>
</li>
<li id="comment-642449" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/956a7ed419af521ff33cd7ae50b80b5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/956a7ed419af521ff33cd7ae50b80b5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonas Minnberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T20:11:58+00:00">August 9, 2022 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>Remove the std::endl and put the \n in the string like the C version, and it should go faster&#8230;</p>
</div>
<ol class="children">
<li id="comment-642496" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ad7a42a759d5d58b0ac3ab1844fe846?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ad7a42a759d5d58b0ac3ab1844fe846?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mariusz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T05:37:53+00:00">August 10, 2022 at 5:37 am</time></a> </div>
<div class="comment-content">
<p>Exactly.</p>
</div>
<ol class="children">
<li id="comment-642571" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6d1c46e2968a7674186b73b819dbca4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6d1c46e2968a7674186b73b819dbca4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alf Peder Steinbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T19:13:57+00:00">August 10, 2022 at 7:13 pm</time></a> </div>
<div class="comment-content">
<p>Well that&rsquo;s a false meme, associative thinking. `endl` just causes a call of `flush`. At some point before end of `main` the stream is flushed anyway, so, net win = one function call and check.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642592" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05f39f57bb773af68e0b44c44dab98d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05f39f57bb773af68e0b44c44dab98d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Schrodinbug</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T23:34:08+00:00">August 10, 2022 at 11:34 pm</time></a> </div>
<div class="comment-content">
<p>No&#8230;I think that&rsquo;s fake news&#8230; I&rsquo;ve heard a lot of people say that std::endl is a new line with a flush, but that either isn&rsquo;t exactly true or at least implementation defined.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642451" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9e40f4f0d69dde7a3bdc65b23ec8b8ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9e40f4f0d69dde7a3bdc65b23ec8b8ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Keubler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T20:39:22+00:00">August 9, 2022 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>I try to stick with C and use macros if needed to enhance the language. There is a thing for sticking with simplicity. C++ is to complicated and bloated. OOP is Ok but I much better perfer functional programming using just functions.</p>
</div>
<ol class="children">
<li id="comment-642517" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21c9d5c922da69bc976a5911d5ee9632?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21c9d5c922da69bc976a5911d5ee9632?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mirko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T09:36:49+00:00">August 10, 2022 at 9:36 am</time></a> </div>
<div class="comment-content">
<p>This code is a really bad comparison.</p>
<p>This gives the idea that C++ is bloated and slower (it is not, actually it is faster in real code than C).</p>
<p>And then you have people like this coding in the stone age justified with memes.</p>
</div>
</li>
<li id="comment-642519" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/721d0c4b7018e3b85c6069c23fd211f4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/721d0c4b7018e3b85c6069c23fd211f4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">gepronqx</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T09:41:06+00:00">August 10, 2022 at 9:41 am</time></a> </div>
<div class="comment-content">
<p>C is not functional at all. C is procedural.</p>
</div>
</li>
<li id="comment-642546" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.omnifarious.org/~hopper/" class="url" rel="ugc external nofollow">Eric Hopper</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T13:12:56+00:00">August 10, 2022 at 1:12 pm</time></a> </div>
<div class="comment-content">
<p>I can show you C++ programs that run rings around their C counterparts.</p>
</div>
<ol class="children">
<li id="comment-642568" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd11b47d0d45d436dfcefed42808e64c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd11b47d0d45d436dfcefed42808e64c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sachin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T18:52:08+00:00">August 10, 2022 at 6:52 pm</time></a> </div>
<div class="comment-content">
<p>Please will you mail me some samples at <a href="/cdn-cgi/l/email-protection#5122303239383f62636261213025383d11363c30383d7f323e3c"><span class="__cf_email__" data-cfemail="a1d2c0c2c9c8cf92939291d1c0d5c8cde1c6ccc0c8cd8fc2cecc">[email&#160;protected]</span></a></p>
</div>
</li>
</ol>
</li>
<li id="comment-642643" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/60f28a6fd4853ef59ddb2c1614d769eb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/60f28a6fd4853ef59ddb2c1614d769eb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francis Mossé</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T11:23:20+00:00">August 11, 2022 at 11:23 am</time></a> </div>
<div class="comment-content">
<p>When problems are large or complex, the OO C++ features simplify your code to a very large extent. </p>
<p>Functions are fine, but associating them with the proper data is cumbersome in C, simple and scalable in C++, based on Classes, their extensions or generalization, their relationships, and their instances. Abstraction is the reason why C++ was created, and it delivers that, hence the power and simplicity of its code. </p>
<p>Real “Functional Programming” isn’t supported by languages as basic as C. Consider exploring languages that are built for Functional Programming, they would give you more power in a world you already like.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642452" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69b656434a1666abaf1d807996ec5133?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69b656434a1666abaf1d807996ec5133?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex Chen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T20:43:12+00:00">August 9, 2022 at 8:43 pm</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t this, to some extent, testing the streaming IO part of the STL in C++, instead of the language itself? For what it&rsquo;s worth, std::cout and std::endl probably does more (like flushing the cache) than printf under the hood, which could potentially account for the 1ms increase in execution time.</p>
</div>
<ol class="children">
<li id="comment-642502" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a1190a0030d044d4149e0896bbbc40b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a1190a0030d044d4149e0896bbbc40b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T06:41:32+00:00">August 10, 2022 at 6:41 am</time></a> </div>
<div class="comment-content">
<p>It is a well established fact that C++ does not provide a zero overhead abstraction unfortunately.<br/>
Note that many features of C++ in fact do provide (+-) zero overhead abstractions.</p>
</div>
</li>
<li id="comment-642565" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a918e35d041780fca97287ad67789aa5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a918e35d041780fca97287ad67789aa5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Davide Cunial</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T18:06:31+00:00">August 10, 2022 at 6:06 pm</time></a> </div>
<div class="comment-content">
<p>I think a fair comparison would be to do like so:</p>
<p>int main() {<br/>
std::ios_base::sync_wyth_stdio(false);<br/>
std::cout &lt;&lt; &quot;hello world\n&quot;;<br/>
return EXIT_SUCCESS;<br/>
}</p>
<p>Can you try the benchmark with this C++ implementation?</p>
</div>
</li>
</ol>
</li>
<li id="comment-642453" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4098296320969c67454e9fe8c26f611e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4098296320969c67454e9fe8c26f611e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cassieesposito.com/" class="url" rel="ugc external nofollow">Cassie</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T20:46:24+00:00">August 9, 2022 at 8:46 pm</time></a> </div>
<div class="comment-content">
<p>I have a concern about your conclusion here &#8212; not that it&rsquo;s necessarily wrong, but that this test is incomplete. Specifically, this test does nothing to differentiate between execution time and function call time.</p>
<p>If we&rsquo;re looking at 1 ms overhead every time you print to console, I&rsquo;ll grant that&rsquo;s significant. But if we&rsquo;re looking at 1 ms per execution? I can&rsquo;t rightfully agree with your conclusion that this is significant. Yes, granted, we&rsquo;re talking about a 200% increase in the execution time for Hello World, but in 2022, I cannot think of a real-world situation where anyone would be executing hello-world equivalent software with such frequency that it creates a cpu bottleneck. Not even in the embedded space.</p>
<p>I haven&rsquo;t tested it yet (I might), but my guess is the performance difference you&rsquo;re seeing takes place in loading the module, and if you were to print to console 10,000 or 100,000 times per execution, you&rsquo;d still be looking at about a 1 ms difference per execution. I&rsquo;m basing this guess on the fact that we&rsquo;re seeing such a significant performance increase in the statically linked c++ version and the knowledge that in a Linux environment, there&rsquo;s some decent chance that stdio.h is preloaded in memory while iostream is not.</p>
<p>Obviously, my hunches are not data, and more testing is required before we draw any conclusions here.</p>
<p>The other question I have is whether you&rsquo;re running hyperfine with the -N flag. Without it, on processes this short, it&rsquo;s kicking the following warning at me:</p>
<p>Warning: Command took less than 5 ms to complete. Note that the results might be inaccurate because hyperfine can not calibrate the shell startup time much more precise than this limit. You can try to use the `-N`/`&#8211;shell=none` option to disable the shell completely.</p>
<p>Which seems potentially relevant.</p>
<p>I might be back later with followup results.</p>
</div>
</li>
<li id="comment-642454" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24f5da8a526ebfab52be2eb80a9445aa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24f5da8a526ebfab52be2eb80a9445aa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Pa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T21:09:59+00:00">August 9, 2022 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>Endl is slower than &ldquo;\n&rdquo;, you should try it again to see if it makes any difference.</p>
</div>
</li>
<li id="comment-642455" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb8d7c6bb95b1895397c2fd3e9b57a35?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb8d7c6bb95b1895397c2fd3e9b57a35?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Charles</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T21:20:49+00:00">August 9, 2022 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>Try removing stdlib in both programs. Return 0 instead. Also use \n in the cpp program instead of endl. Would be interested in seeing the results of that</p>
</div>
</li>
<li id="comment-642458" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/719f780dca67d4a61897f726793215a3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/719f780dca67d4a61897f726793215a3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jakob Kenda</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T21:32:38+00:00">August 9, 2022 at 9:32 pm</time></a> </div>
<div class="comment-content">
<p>There is a difference in your C++ code as opposed to C code, and that is the std::endl statement, which flushes stdout. There is no flushing in the C code. For the code to be equivalent, the C++ statement should be<br/>
std::cout &lt;&lt; &quot;hello world\n&quot;;</p>
</div>
</li>
<li id="comment-642460" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24ea4c3a3eb95dee6222215087f5884c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oliver Schonrock</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T21:46:05+00:00">August 9, 2022 at 9:46 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps differences in lib and not lib loading. </p>
<p><a href="https://twitter.com/oschonrock/status/1557092072540307456" rel="nofollow ugc">https://twitter.com/oschonrock/status/1557092072540307456</a></p>
</div>
</li>
<li id="comment-642461" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/969360eea86b816c195bce8627536e75?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/969360eea86b816c195bce8627536e75?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hebigami</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T22:01:24+00:00">August 9, 2022 at 10:01 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not a professional C or C++ dev but I still remember a few basics from the time I studied physics at my local university (we had C/C++ lectures).</p>
<p>Both endl and cout have side effects. You compare two pieces of code that don&rsquo;t do the same thing. You should not expect them to run equally fast. </p>
<p>There are ways to reduce the side effects like NOT using endl or using ios_base::sync_with_stdio(false).</p>
<p><a href="https://godbolt.org/" rel="nofollow ugc">https://godbolt.org/</a> helps a lot if you want to know more details.</p>
</div>
</li>
<li id="comment-642462" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4098296320969c67454e9fe8c26f611e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4098296320969c67454e9fe8c26f611e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://cassieesposito.com/" class="url" rel="ugc external nofollow">Cassie</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T22:09:25+00:00">August 9, 2022 at 10:09 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve done some followup testing. It appears that my concerns with the methodology wire unfounded, but I have since seen some other critique of your methodology that I have not explored.</p>
<p>You can see my changes to your code and references to the additional critique on my github (<a href="https://github.com/cassieesposito/Code-used-on-Daniel-Lemire-s-blog-2022-08-09" rel="nofollow ugc">https://github.com/cassieesposito/Code-used-on-Daniel-Lemire-s-blog-2022-08-09</a>)</p>
</div>
<ol class="children">
<li id="comment-642507" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/66d60cfa72707a5e60df1420b4fde83c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/66d60cfa72707a5e60df1420b4fde83c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T07:35:09+00:00">August 10, 2022 at 7:35 am</time></a> </div>
<div class="comment-content">
<p>In your updated C++ code (multi_hello.cpp), you should also replace std::endl with &ldquo;\n&rdquo; as previously suggested here. I suspect this may have a much larger impact on the results due to flushing after each print for 30000 iterations.<br/>
Interested in seeing updated results!</p>
</div>
</li>
</ol>
</li>
<li id="comment-642463" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b2dcf76f6bdf64a113317b6a707a391?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b2dcf76f6bdf64a113317b6a707a391?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mark Rohrbacher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T22:10:50+00:00">August 9, 2022 at 10:10 pm</time></a> </div>
<div class="comment-content">
<p>Hello Mr. Lemire,</p>
<p>IMHO, the comparison of those two snippets isn&rsquo;t very fair, as the C++ code does a bit more than the C code:</p>
<p>Streaming std::endl does not only stream a &lsquo;\n&rsquo;, it also flushes the stream (<a href="https://en.cppreference.com/w/cpp/io/manip/endl" rel="nofollow ugc">https://en.cppreference.com/w/cpp/io/manip/endl</a>).</p>
<p>To make the two programs more comparable, you should either replace the C++ streaming with<br/>
std::cout &lt;&lt; &quot;hello world\n&quot;;<br/>
or add a<br/>
fflush(stdout);<br/>
to the C program.</p>
<p>In my tests, both hellocppstatic and hellocppfullstatic were faster than helloc, with both of these changes, hellocpp was slower. However, as my machine wasn&#039;t completely idle, these results may be inaccurate.</p>
<p>But let&#039;s go a step ahead:<br/>
If you omit the printf / flush / cout streaming, just leaving the &quot;return EXIT_SUCCESS&quot; (and the includes), the C++ program will most probably be slower. This is because of the static initialization of std::ios_base (std::ios_base::Init::Init() gets called on program startup as soon as gets included).<br/>
It&rsquo;d be interesting to see the results after removing this include, as the object code of the hello.c and hello.cpp should be totally equal.</p>
<p>Best regards<br/>
&#8211; Mark</p>
</div>
<ol class="children">
<li id="comment-642630" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fe350affd9113f805fd84d1ab46dc3af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fe350affd9113f805fd84d1ab46dc3af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matti Laa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T10:07:27+00:00">August 11, 2022 at 10:07 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;This is because of the static initialization of std::ios_base (std::ios_base::Init::Init() gets called on program startup as soon as gets included)&rdquo; </p>
<p>This. Static initialization and destruction is made if iostream header is just included, and even not used. Using stdio.h instead of iostream and printf gives you exactly the same result of assembly between these two languages. Latest GCC release output:</p>
<p>.LC0:<br/>
.string &ldquo;Hello world&rdquo;<br/>
main:<br/>
sub rsp, 8<br/>
mov edi, OFFSET FLAT:.LC0<br/>
xor eax, eax<br/>
call printf<br/>
xor eax, eax<br/>
add rsp, 8<br/>
ret</p>
<p>But yeah, overall I think this is a good example that all the features in C++ over C are not here for free. You have to understand how using your libraries, your code (of course;) and sometimes even how compilers work, if optimizing CPU usage is your priority one.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642466" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T22:22:47+00:00">August 9, 2022 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>This is such a beautiful example of measuring something, and yet understanding almost nothing about what they mean, I shall be using this as an example for our new starters on the pitfalls of premature optimisation and the importance of meaningful test structures and data.</p>
</div>
</li>
<li id="comment-642468" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/11a718b8198bc24d089e262bbc86b4c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/11a718b8198bc24d089e262bbc86b4c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dave</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T22:27:27+00:00">August 9, 2022 at 10:27 pm</time></a> </div>
<div class="comment-content">
<p>This is based on biased info from decades ago.</p>
<p>99.99999% of C++ programs used for professional applications in this world do not use standard out (or err) to convey runtime status. </p>
<p>C++ apps are easier to develop than C, have more rich features, so I’m not sure what you are driving at. </p>
<p>Oh, C++ apps are oftentimes deployed in embedded (or server) environments…. where there is definitely no I/O to a terminal.</p>
<p>I suspect this article was written by a troll.</p>
</div>
<ol class="children">
<li id="comment-642482" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T02:01:20+00:00">August 10, 2022 at 2:01 am</time></a> </div>
<div class="comment-content">
<p>The blog post is specifically about &ldquo;hello world&rdquo;.</p>
<p>If you mean to refer to large programs, then I agree, but it happens often enough that we have to run small commands that only do a few microseconds of work.</p>
</div>
<ol class="children">
<li id="comment-642556" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T15:56:12+00:00">August 10, 2022 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re not measuring what you think you are.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642746" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38707949924f0438394712f261a2dc0f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38707949924f0438394712f261a2dc0f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Justin M. LaPre</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-12T12:37:39+00:00">August 12, 2022 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>Did you try passing -fno-exceptions and -fno-rtti? That may impact your numbers as well.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642469" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4383edc7cbd0b9f128abbfe354bbabc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4383edc7cbd0b9f128abbfe354bbabc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Evan Teran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T22:30:29+00:00">August 9, 2022 at 10:30 pm</time></a> </div>
<div class="comment-content">
<p>The C++ program is doing more work than the C program.</p>
<p>You should avoid using `std::endl unless you specifically intend to flush the buffers explicitly. There&rsquo;s nothing wrong with using a simple newline character.</p>
<p>But also, IO streams are known to be measurably slower than printf. Especially since it has hidden global constructors and destructors.</p>
<p>std::format is the new modern way to write formated strings.</p>
<p>So, it&rsquo;s not really that &ldquo;hello world is slower in C++&rdquo;, it&rsquo;s that The methods that you&rsquo;ve chosen to perform the task in C++ are by nature slower (But offer better type safety and internationalization capabilities).</p>
<p>For the simple task of printing&rdquo;hello world&rdquo;, honestly you should just use puts.</p>
</div>
<ol class="children">
<li id="comment-642698" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85b563454d9beae11cfa19669efb9fd0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85b563454d9beae11cfa19669efb9fd0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">cdevaw</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T22:25:29+00:00">August 11, 2022 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>GCC does remove printf() and inserts puts() <a href="https://gcc.godbolt.org/z/dcx4Tz4WK" rel="nofollow ugc">https://gcc.godbolt.org/z/dcx4Tz4WK</a></p>
<p>That is why it is so fast.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642472" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c3ee1f060c898776d5299058a28a5bd8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c3ee1f060c898776d5299058a28a5bd8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Halmaghi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T23:23:58+00:00">August 9, 2022 at 11:23 pm</time></a> </div>
<div class="comment-content">
<p>&lt;&lt; std::endl inserts a newline AND flushes the stout buffer, which I don&#039;t believe printf() does.<br/>
It would be interesting to see the comparison without &lt;&lt; std::endl, since flushing the buffer is a relatively costly operation, it should give you a better apples to apples comparison. I&#039;m no expert though.</p>
</div>
</li>
<li id="comment-642474" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8b1c4b84e21fbecec9611cfb3bf91d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8b1c4b84e21fbecec9611cfb3bf91d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hermas Mohamed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T00:19:19+00:00">August 10, 2022 at 12:19 am</time></a> </div>
<div class="comment-content">
<p>give it a try without std::endl<br/>
<a href="https://youtu.be/GMqQOEZYVJQ" rel="nofollow ugc">https://youtu.be/GMqQOEZYVJQ</a></p>
</div>
</li>
<li id="comment-642475" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6e6d40a4fd21135475bd83656c67ae33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6e6d40a4fd21135475bd83656c67ae33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">marc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T00:26:33+00:00">August 10, 2022 at 12:26 am</time></a> </div>
<div class="comment-content">
<p>This is not an accurate, endl also includes a flush, which is no longer necessary in c++, and adds unnecessary time. You could have just as easily used &ldquo;\n&rdquo; in the c++ version the same way you did in the c version.</p>
</div>
</li>
<li id="comment-642479" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fe85edf63a8fea7b56de5c2ef1bde43d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fe85edf63a8fea7b56de5c2ef1bde43d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">yueshan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T01:53:44+00:00">August 10, 2022 at 1:53 am</time></a> </div>
<div class="comment-content">
<p>cout do lots of things you should know</p>
</div>
</li>
<li id="comment-642480" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de191264706a25e06b8a448a283f31ac?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de191264706a25e06b8a448a283f31ac?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Bailey</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T01:55:13+00:00">August 10, 2022 at 1:55 am</time></a> </div>
<div class="comment-content">
<p>iostreams are not a minor bit of infrastructure.</p>
<p>If.you want to compare program startup time, use printf in the C++ version as well.</p>
<p>You should be able to look at the assembly output to make a good comparison. That&rsquo;s a better view of what&rsquo;s happening and why</p>
</div>
</li>
<li id="comment-642491" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/31a482f0b1fb4bec5b37fb3dce391613?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/31a482f0b1fb4bec5b37fb3dce391613?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Richard Cervinka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T04:42:06+00:00">August 10, 2022 at 4:42 am</time></a> </div>
<div class="comment-content">
<p>There is no difference between std::endl ant &lsquo;/n&rsquo; because std::cout is flushed at the end of the application.</p>
</div>
</li>
<li id="comment-642493" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b6f84b044d71985a9f3812b66d226b2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b6f84b044d71985a9f3812b66d226b2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zahir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T04:51:17+00:00">August 10, 2022 at 4:51 am</time></a> </div>
<div class="comment-content">
<p>IMHO it is all about linking with the libstdc++. In the first version of the code I did only replaced std::cout&#8230; line with printf line from the C version (without changing includes or linking directives) and the results for C++ did not change on my computer.</p>
<p>I ran a perf record/report on that version and unlike C, at least 30% time was being lost on locale functionality. My guess is not linking to libstdc++ removes underlying C++ locale functionality from printf.</p>
<p>Measurements were on my 10 year old machine. </p>
<p>I wonder what will change if we link with/to clang/libc++ though.</p>
</div>
</li>
<li id="comment-642495" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4e3a2aa40f5db0f0111395ed61d2f5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4e3a2aa40f5db0f0111395ed61d2f5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://dfa1.github.io/" class="url" rel="ugc external nofollow">Davide Angelocola</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T05:28:32+00:00">August 10, 2022 at 5:28 am</time></a> </div>
<div class="comment-content">
<p>Hello Lemire,</p>
<p>in C++, operations are synchronized to the standard C streams after each input/output. </p>
<p>According to cppreference (<a href="https://en.cppreference.com/w/cpp/io/ios_base/sync_with_stdio" rel="nofollow ugc">https://en.cppreference.com/w/cpp/io/ios_base/sync_with_stdio</a>), synch_with_stdio may reduce the penalty:</p>
<p><cite><br/>
If the synchronization is turned off, the C++ standard streams are allowed to buffer their I/O independently, which may be considerably faster in some cases.<br/>
</cite></p>
<p><code><br/>
std::ios::sync_with_stdio(false);<br/>
std::cout &lt;&lt; &quot;hello world&quot; &lt;&lt; std::endl;<br/>
</code></p>
</div>
</li>
<li id="comment-642503" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7484b466a474ebffc58e91bc5aa7e892?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7484b466a474ebffc58e91bc5aa7e892?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ofek Shilon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T06:49:41+00:00">August 10, 2022 at 6:49 am</time></a> </div>
<div class="comment-content">
<p>When used correctly (specifically, with ` `std::ios_base::sync_with_stdio(false);` , cout is in fact much faster than printf:<br/>
<a href="https://stackoverflow.com/questions/31524568/cout-speed-when-synchronization-is-off" rel="nofollow ugc">https://stackoverflow.com/questions/31524568/cout-speed-when-synchronization-is-off</a></p>
</div>
</li>
<li id="comment-642505" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fb33e2cc0da83c3afa7965f87053f8a9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fb33e2cc0da83c3afa7965f87053f8a9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John M</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T07:28:02+00:00">August 10, 2022 at 7:28 am</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m glad neither I, nor my children, attended the University of Quebec if this is how professors spend their time. You conclude that:</p>
<p>&ldquo;.. if these numbers are to be believed, there may a significant penalty due to textbook C++ code for tiny program executions, under Linux.&rdquo;</p>
<p>then, in a later comment response, state:</p>
<p>&ldquo;The blog post is specifically about “hello world”.&rdquo;</p>
<p>If it&rsquo;s the latter, then the former conclusion is invalid. You cannot infer that tiny programs under Linux will perform slower, using C++ rather than C, on the basis of a one line example where the method used is different. </p>
<p>There are multiple comments addressing the specifics of the differences, and reasons for them, but, if I were you, I&rsquo;d take this blog post down as it makes you look foolish.</p>
</div>
</li>
<li id="comment-642527" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5365fb4f754d7ccf3f15e0543e65a854?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5365fb4f754d7ccf3f15e0543e65a854?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Niclas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T11:11:39+00:00">August 10, 2022 at 11:11 am</time></a> </div>
<div class="comment-content">
<p>I have a lot of respect for your work, so this blog post is quite baffling &amp; sadning . -What exactly are you getting at or aiming for ?</p>
<p>”there may a significant penalty due to textbook C++ code for tiny program, under Linux.”</p>
<p>-BS, &amp; you’re comparing apples to oranges . readup what cout actually does. Is your printf thread safe? (you can turn of sync_with_io for the std streams if you want that monster to be faster). std::printf is also maybe worth mentioning</p>
</div>
</li>
<li id="comment-642532" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/21c9d5c922da69bc976a5911d5ee9632?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/21c9d5c922da69bc976a5911d5ee9632?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mirko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T11:56:19+00:00">August 10, 2022 at 11:56 am</time></a> </div>
<div class="comment-content">
<p>This code doesn&rsquo;t show C++ being slower than C.</p>
<p>Rather, this is &ldquo;iostream with stdio sync on printing two strings&rdquo; being slower than &ldquo;printf for the trivial case of a string&rdquo;. No news here.</p>
</div>
</li>
<li id="comment-642534" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7a679d515a46c059e11476f9b9aa6dc8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7a679d515a46c059e11476f9b9aa6dc8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Drue</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T12:29:14+00:00">August 10, 2022 at 12:29 pm</time></a> </div>
<div class="comment-content">
<p>Everyone else has already mentioned how flawed this is.</p>
<p>But a better test would be to compare two computationally intensive algorithms or generics, written properly in each language.</p>
</div>
</li>
<li id="comment-642537" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/874e2d2356c8ee77e34f05e959207163?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/874e2d2356c8ee77e34f05e959207163?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://profitview.net" class="url" rel="ugc external nofollow">Richard Hickling</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T12:34:37+00:00">August 10, 2022 at 12:34 pm</time></a> </div>
<div class="comment-content">
<p>These days you should use &ldquo;`std::fmt (<a href="https://en.cppreference.com/w/cpp/utility/format/format" rel="nofollow ugc">https://en.cppreference.com/w/cpp/utility/format/format</a>).<br/>
It&rsquo;s optimization and compile time logic should beat printf.</p>
</div>
</li>
<li id="comment-642538" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d91710108c384f7120147a4b4687f7cc?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d91710108c384f7120147a4b4687f7cc?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">wqw</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T12:37:08+00:00">August 10, 2022 at 12:37 pm</time></a> </div>
<div class="comment-content">
<p>Students using C++ streams in programming contests are hammered to prolog main with<br/>
[code]<br/>
ios_base::sync_with_stdio(false);<br/>
cin.tie(nullptr);<br/>
cout.tie(nullptr);<br/>
[/code]<br/>
. . . in order to achieve printf/scanf performance.</p>
<p><a href="https://stackoverflow.com/questions/31162367/significance-of-ios-basesync-with-stdiofalse-cin-tienull" rel="nofollow ugc">https://stackoverflow.com/questions/31162367/significance-of-ios-basesync-with-stdiofalse-cin-tienull</a></p>
</div>
<ol class="children">
<li id="comment-642552" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/969360eea86b816c195bce8627536e75?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/969360eea86b816c195bce8627536e75?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Hebigami</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T14:54:03+00:00">August 10, 2022 at 2:54 pm</time></a> </div>
<div class="comment-content">
<p>Thanks wqw! I was aware of sync_with_stdio but i&rsquo;ve never seen tie before. </p>
<p>It&rsquo;s always a pleasure to learn something I could use someday 🙂</p>
</div>
</li>
</ol>
</li>
<li id="comment-642544" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36354e58595e6c192ce599975e43a5e9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36354e58595e6c192ce599975e43a5e9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">tetsuoii</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T13:06:22+00:00">August 10, 2022 at 1:06 pm</time></a> </div>
<div class="comment-content">
<p>What you have discovered is just the tip of the craptastic bloatberg that is every other language not C.</p>
</div>
</li>
<li id="comment-642548" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df3cec10de19399e42487500bd85230c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df3cec10de19399e42487500bd85230c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jack Mazierski</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T13:41:07+00:00">August 10, 2022 at 1:41 pm</time></a> </div>
<div class="comment-content">
<p>If all you write is hello world then all you need is C.</p>
<p>Only that we are not in 1992. C is quite useless for user mode apps nowadays and no one creates console apps except Linux freaks that have nothing else to write.</p>
</div>
</li>
<li id="comment-642554" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bannister.us" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T15:24:56+00:00">August 10, 2022 at 3:24 pm</time></a> </div>
<div class="comment-content">
<p>This is a micro-benchmark that illustrates a simple point. I do not believe Daniel is going after any massive generalizations.</p>
<p>Oh. And all the comments about flushing the I/O buffer &#8230; a moment of thought <i>should</i> have told you the examples were equivalent. While it have been a couple decades since I dug into runtime libraries, pretty sure every runtime <b>must</b> flush buffers on program exit. </p>
<p>Put differently&#8230;<br/>
Did you see the output?<br/>
Then the runtime library flushed output buffers on exit.</p>
<p>Yes, loading dynamic libraries is more expensive. Often this does not matter, but sometimes it can be significant. There is or should be a savings in memory used (across multiple programs using the same libraries), and this can sometimes be significant. </p>
<p>The savings from shared dynamic libraries was <i>critical</i> in the Win16 era, and for some time after. In present many-gigabyte machines, rather less so. (In this century, have tended to use static libraries more often than dynamic.)</p>
<p>The C printf() and stdio library was honed decades ago on much leaner machines, and (as you might expect) is lean and efficient. If you dig back into the USENET archives, you can find a period (late-1980s / early 90s?) where there was a bit of a public competition to see who could come up with the leanest stdio library. That code ended up in compiler runtime libraries, and I strongly suspect survives to the present (and offers examples of hyper-optimization).</p>
<p>The C++ standard streams library arrived on fatter machines, and never received such attention (in part as you can use C stdio). </p>
<p>Daniel&rsquo;s experiment matches well with history.</p>
</div>
<ol class="children">
<li id="comment-642570" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T19:07:40+00:00">August 10, 2022 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;This is a micro-benchmark that illustrates a simple point. I do not believe Daniel is going after any massive generalizations.&rdquo;</p>
<p>With respect, the claim was made in the article that “.. if these numbers are to be believed, there may a significant penalty due to textbook C++ code for tiny program executions, under Linux.”<br/>
Disregarding the strict meaning of &lsquo;may&rsquo; &#8211; which would make the whole statement a semantic null &#8211; this is (IMO) quite a massive over generalization. It is a micro-benchmark, and a poorly considered and written at that, and there is effectively no meaningful generalization at all possible from it &#8211; as has been pointed out by many in these comments. That the author subsequently states that this was specifically about &ldquo;hello world&rdquo; is not properly reflected in the main text, even now.</p>
<p>It also seems to expose a deep lack of knowledge not only of the what the programs are doing, what the objects and functions are designed &#8211; and their benefits and deficits &#8211; but also of C++.<br/>
I&rsquo;ve seen renderers and whole micro-kernels constexpr&rsquo;d &#8211; which is harder to do in C &#8211; and could result in enormous performance benefits, but that&rsquo;s not the point, nor is it necessarily a reason to choose one language over the other. They were particular implementations, for particular purposes, and but do demonstrate aspects of a language that could be useful in many situations, but which should not be over generalized from. This is the most egregious issue for me, the apparent attempt to classify language suitability on a frankly meaningless code snippet which is hardly an example of any useful real-world program &#8211; this is something we try to stamp out from even the newest of starters, and from a professor of computer science seems quite ridiculous to me. YMMV obviously.</p>
</div>
<ol class="children">
<li id="comment-642586" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f0f6318c1339d1a842868376c6bf64d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f0f6318c1339d1a842868376c6bf64d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stephen Tran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T22:11:04+00:00">August 10, 2022 at 10:11 pm</time></a> </div>
<div class="comment-content">
<p>Can you do a test to show that for small programs similar to &ldquo;Hello World&rdquo; but not necessarily the same C++ runs as fast as C if not faster? This would settle the issue. Wouldn&rsquo;t it?</p>
</div>
<ol class="children">
<li id="comment-642624" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T07:52:51+00:00">August 11, 2022 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>At an extreme, you could try something like this<br/>
<a href="https://onecompiler.com/cpp/3wdmzd9js" rel="nofollow ugc">https://onecompiler.com/cpp/3wdmzd9js</a><br/>
(or trying Googling for &lsquo;constexptr fibonacci&rsquo;)<br/>
Re-working that as C should give an indication of what can be done, but &#8211; like the article &#8211; it&rsquo;s really missing the point, and I could probably equally well make a C++ version that is far worse **.</p>
<p>One of the main reasons that individual, micro-benchmarks like this aren&rsquo;t useful for answering questions like &ldquo;is language X faster than language Y ?&rdquo; is that the question is completely meaningless.</p>
<p>What we can do is ask, for my particular problem space *and* my typical data sets / operating conditions &#8211; what would a good choice of language and strategy be ? If, for example, you were designing an ultra-high speed / low latency peer-to-peer message passing system, you probably wouldn&rsquo;t choose Python. However if you wanted to implement a simple peer-to-peer client-server application then Python, with it&rsquo;s interpreted nature and rich library support, would make such a thing relatively trivial. It&rsquo;s exactly these sort of evaluations that should be driven into programmers, and first year computer science students in Quebec and elsewhere, from day one.</p>
<p>Using massively simplified, and atypical, noddy code fragments -especially when naively implemented &#8211; is not really helpful or instructive, and mainly serves to teach people bad coding practice and poor performance analysis techniques IMO.</p>
<p>** These are poor Fibonacci number generators, so don&rsquo;t use them in any performance sensitive regime, they just an example 🙂</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-643648" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4eb6909b96dda2ef93f91d58c47c219?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4eb6909b96dda2ef93f91d58c47c219?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">rhpvorderman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-21T05:00:54+00:00">August 21, 2022 at 5:00 am</time></a> </div>
<div class="comment-content">
<blockquote><p>The C printf() and stdio library was honed decades ago on much leaner machines, </p></blockquote>
<p>It is still being honed. Memchr for instance uses sse2 instructions on x86-64 machines. These instructions were available only long after both c and c++ gained widespread adoption. Memchr beats std::find<br/>
<a href="https://gms.tf/stdfind-and-memchr-optimizations.html" rel="nofollow ugc">https://gms.tf/stdfind-and-memchr-optimizations.html</a></p>
<p>Glibc is much more optimized than libstdc++ simply because it is much smaller,and therefore developers can devote more time to optimization.</p>
<p>The truth is that abstractions come at a cost of complexity and size which makes it harder to optimize. &ldquo;Zero-cost abstractions&rdquo; may be true in a few cases, but there will always be cases that are too hard or time-consuming to look into. It is a simple matter of tradeoffs.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642557" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/59e5095517d8bfac5d91f56b3c045008?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/59e5095517d8bfac5d91f56b3c045008?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Catron</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T16:06:33+00:00">August 10, 2022 at 4:06 pm</time></a> </div>
<div class="comment-content">
<p>You didn&rsquo;t provide what compiler you used. I assume it was gcc. In gcc &ldquo;printf&rdquo; is one of the built-in functions. This means there is no library involved at all (neither dynamic nor static). It&rsquo;s practically part of the language and the #include is just for syntax reasons.<br/>
I didn&rsquo;t read the internals but I assume that gcc doesn&rsquo;t call a classical printf at all put optimises it on the compiler level, e.g. do the formating at compile-time and use the &lsquo;write&rsquo; syscall directly.</p>
</div>
<ol class="children">
<li id="comment-642559" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T16:38:21+00:00">August 10, 2022 at 4:38 pm</time></a> </div>
<div class="comment-content">
<p>I use a straight Ubuntu 22 and the Makefile is provided (see links), so yes: gcc.</p>
<p>You make a good point regarding printf.</p>
</div>
</li>
</ol>
</li>
<li id="comment-642573" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.omnifarious.org/~hopper/" class="url" rel="ugc external nofollow">Eric Hopper</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T19:53:16+00:00">August 10, 2022 at 7:53 pm</time></a> </div>
<div class="comment-content">
<p>This program will run faster than any C program written using the standard qsort library function:</p>
<p>#include<br/>
#include<br/>
#include<br/>
#include </p>
<p>using namespace ::std;</p>
<p>constexpr int ipow(int base, int exp)<br/>
{<br/>
if (exp == 0) {<br/>
return 1;<br/>
} else if (exp &lt; 0) {<br/>
return 0;<br/>
} else if (exp % 2) {<br/>
return base * ipow(base, exp &#8211; 1);<br/>
} else {<br/>
return ipow(base * base, exp / 2);<br/>
}<br/>
}</p>
<p>int main()<br/>
{<br/>
vector foo(ipow(2,30));<br/>
random_device rd; //Will be used to obtain a seed for the random number engine<br/>
mt19937 gen(rd()); //Standard mersenne_twister_engine seeded with rd()<br/>
uniform_int_distribution dis;<br/>
generate(foo.begin(), foo.end(),<br/>
[&amp;gen, &amp;dis]() {<br/>
return dis(gen);<br/>
});<br/>
cerr &lt;&lt; &quot;Sorting.\n&quot;;<br/>
sort(foo.begin(), foo.end());<br/>
return is_sorted(foo.begin(), foo.end()) ? 0 : 1;<br/>
}</p>
</div>
<ol class="children">
<li id="comment-642579" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T20:21:50+00:00">August 10, 2022 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>It is true that C++ has many advantages over C as far as algorithmic implementation goes. </p>
<p>Your program allocates gigabytes of memory and sorts it. If you reduce the task to sorting 12 numbers, the answer might be different, and that&rsquo;s the motivation of my blog post.</p>
</div>
<ol class="children">
<li id="comment-642750" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.omnifarious.org/~hopper/" class="url" rel="ugc external nofollow">Eric Hopper</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-12T13:21:07+00:00">August 12, 2022 at 1:21 pm</time></a> </div>
<div class="comment-content">
<p>It isn&rsquo;t that the implementation of sort is better in C++, it&rsquo;s that you can&rsquo;t reasonably make a version of the qsort function in C that runs faster than sort in C++.</p>
<p>And this is because the sort function in C++ is a template, and the compiler essentially writes you a custom one for the data structure and comparison function you&rsquo;re using in which the comparison and swap functions are inlined into sort and then subjected to aggressive optimizations.</p>
<p>Making this happen in C would require macro magic of the highest order, and even then would probably be a huge pain to use correctly.</p>
<p>Your &ldquo;Hello world&rdquo; case reads like a general criticism of C++, when I strongly suspect that C++ is faster than C in most cases because of things like I just mentioned. So, it seems like a criticism that&rsquo;s narrowly tailored to make a point that I don&rsquo;t think is particularly accurate.</p>
</div>
<ol class="children">
<li id="comment-643255" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-16T15:00:18+00:00">August 16, 2022 at 3:00 pm</time></a> </div>
<div class="comment-content">
<p>Eric, you are interpreting my post to say something I do not say (C++ is slow).</p>
<p>I have written and co-written several high performance projects in C++. E.g., please see <a href="https://github.com/simdjson/simdjson" rel="nofollow ugc">https://github.com/simdjson/simdjson</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-642577" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/878965b9461366374c22895a5fad280f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/878965b9461366374c22895a5fad280f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sam Mason</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T20:09:00+00:00">August 10, 2022 at 8:09 pm</time></a> </div>
<div class="comment-content">
<p>After an extended play with this I would say that the library/flushing issues that most commenters aren&rsquo;t anything to worry about. All the significant difference in timings seem to be due to the dynamic linker.</p>
<p>C code that dynamically links to libc takes ~240µs, which goes down to ~150µs when statically linked. A fully dynamic C++ build takes ~800µs, while a fully static C++ build is only ~190µs. Across all of these, the different between printing one &ldquo;hello world&rdquo; vs 1000 is only ~20µs.</p>
<p>Getting good timings was the hardest thing here! Code/analysis are in:</p>
<p><a href="https://github.com/smason/lemire-hello" rel="nofollow ugc">https://github.com/smason/lemire-hello</a></p>
</div>
</li>
<li id="comment-642578" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b5b6713fee6a072f6fedd09d8b1c5d2b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.omnifarious.org/~hopper/" class="url" rel="ugc external nofollow">Eric Hopper</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T20:14:09+00:00">August 10, 2022 at 8:14 pm</time></a> </div>
<div class="comment-content">
<p>Sorry to post more than one comment. I would go back and edit my original if I could&#8230;.</p>
<p>The reason that C++ is taking longer here is that the runtime environment of C++ is more complex. Not a LOT more complex, but, it is more complex. C++ has global constructors and destructors that need to be executed on program startup and shutdown. Additionally, the compiler needs to track which global destructors need to be called because (in the case, for example, of local &lsquo;static&rsquo; variables in side functions) which ones need to be called can only be determined at runtime. This requires a global data structure that&rsquo;s initialized on program startup and scanned on program shutdown.</p>
<p>Additionally, there will be some overhead required to set up the exception handler of last resort.</p>
<p>I have a hello world written in C++ that will execute faster than C, but it requires passing lots of compiler options to turn off the compiler&rsquo;s setup of the C++ runtime environment. It would be possible to duplicate this program in C, but it would be challenging, especially with the quality of error handling it&rsquo;s possible to achieve using my library:</p>
<p>My library: <a href="https://osdn.net/projects/posixpp/scm/hg/posixpp" rel="nofollow ugc">https://osdn.net/projects/posixpp/scm/hg/posixpp</a><br/>
(Github mirror): <a href="https://osdn.net/projects/posixpp/scm/hg/posixpp" rel="nofollow ugc">https://osdn.net/projects/posixpp/scm/hg/posixpp</a></p>
<p>Link to hello world program written using my library: <a href="https://osdn.net/projects/posixpp/scm/hg/posixpp/blobs/tip/examples/helloworld.cpp" rel="nofollow ugc">https://osdn.net/projects/posixpp/scm/hg/posixpp/blobs/tip/examples/helloworld.cpp</a></p>
</div>
</li>
<li id="comment-642582" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e61cbb0a0ed1b25e18d72a736d3c2a80?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e61cbb0a0ed1b25e18d72a736d3c2a80?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T21:13:03+00:00">August 10, 2022 at 9:13 pm</time></a> </div>
<div class="comment-content">
<p>I guess my response would be &ldquo;duh&rdquo;. With C you have very little object code and a single call to the printf function in a statically loaded library. With C++ you have substantial startup overhead loading the iostream library and all the modules it depends on. Address allocation takes time and it&rsquo;s going to prepare for all the possible dynamic libraries you might load as well.</p>
</div>
</li>
<li id="comment-642585" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f620f4647fb816073c9152a284245e64?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f620f4647fb816073c9152a284245e64?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Menotyou</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T21:57:37+00:00">August 10, 2022 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>Comments are Better than the article IMO</p>
</div>
</li>
<li id="comment-642593" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05f39f57bb773af68e0b44c44dab98d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05f39f57bb773af68e0b44c44dab98d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Schrodinbug</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T23:46:41+00:00">August 10, 2022 at 11:46 pm</time></a> </div>
<div class="comment-content">
<p>Iostreams are known to have performance issues so this isn&rsquo;t earth shattering news. I&rsquo;m glad you mention std::format. libfmt which that evolved from has a function called fmt::print&#8230;I guarantee fmt::print(&ldquo;hello world\n&rdquo;); will not just be as fast as printf, but faster. Especially if there&rsquo;s a lot of formatting to be done. This is because it can do some of the formatting work at compile time. And it&rsquo;s typesafe, so no having to worry and remember the gazillion printf variations. It&rsquo;s freaking amazing. The print function didn&rsquo;t make it to c++20, but I believe it&rsquo;s being pushed for in c++23.</p>
</div>
</li>
<li id="comment-642594" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7852676dce462cc68d52439d885aa8b6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7852676dce462cc68d52439d885aa8b6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cal Gray</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-10T23:51:18+00:00">August 10, 2022 at 11:51 pm</time></a> </div>
<div class="comment-content">
<p>The title should be &ldquo;C++ streams are slower than printf&rdquo; which is a known fact as streams favor versatility over performance. Streams are significantly different to print functions since formatting is stored as state within the stream object and takes time to construct and destruct once for the program lifetime.</p>
</div>
</li>
<li id="comment-642596" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d92afb7e5ac5c00cfd5ce0640f7c808c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d92afb7e5ac5c00cfd5ce0640f7c808c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sl2</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T00:02:22+00:00">August 11, 2022 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>How about a test where you simply output the exact same code compiled in c and c++ &#8230;. this will account for the apple to orange comparison&#8230;</p>
<p>also store the time before and after in μSec or a GetTickCount() before and after the call&#8230;.. and output this data at the end&#8230;.. this will account for startup lib / runtime difference&#8230;.</p>
</div>
</li>
<li id="comment-642599" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/026bb91fab12066ce6897d2b75ab29bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/026bb91fab12066ce6897d2b75ab29bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Amin Yahyaabadi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T00:22:41+00:00">August 11, 2022 at 12:22 am</time></a> </div>
<div class="comment-content">
<p>Instead, I suggest you to use libfmt instead. It is safer and faster. Also, note that the newer C++ standard has replaced iostreams with better alternatives. If you are micro-optimizing, you should consider these details.</p>
</div>
</li>
<li id="comment-642617" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4b00ccdf77747db84781837fc597fa85?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4b00ccdf77747db84781837fc597fa85?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Roman Avtukhoff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T05:09:28+00:00">August 11, 2022 at 5:09 am</time></a> </div>
<div class="comment-content">
<p>Because used std::</p>
</div>
</li>
<li id="comment-642626" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/23477eaf17ae901ec72863a1dd2cf21c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/23477eaf17ae901ec72863a1dd2cf21c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marcos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T09:13:26+00:00">August 11, 2022 at 9:13 am</time></a> </div>
<div class="comment-content">
<p>It would be more accurate if you printed several thousand lines in a loop. The execution time of printing a single line could easily be confused with loading and startup time. Then, there is also the flushing. You want to make sure that you are flushing the same number of times.<br/>
Lastly, given the object oriented nature of C++, it would make sense to turn on optimisations.</p>
</div>
<ol class="children">
<li id="comment-642658" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T15:01:32+00:00">August 11, 2022 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>The programs are compiled with optimization (-O2).</p>
</div>
<ol class="children">
<li id="comment-642681" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T19:06:02+00:00">August 11, 2022 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>As long as you&rsquo;re not trying to measure the performance the languages can offer under GCC, that might be adequate. If you&rsquo;re wanting to try to replicate what typical release production code would do, then that&rsquo;s probably not (partially depending on the functionality being used).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-642628" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0366dbca1bd3a554f434928e955b89db?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0366dbca1bd3a554f434928e955b89db?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jimmy Ellison</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T09:24:20+00:00">August 11, 2022 at 9:24 am</time></a> </div>
<div class="comment-content">
<p>You could throw in some dirty inline assembly lines involving kernel syscall to improve performance.</p>
</div>
</li>
<li id="comment-642670" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f27ae22cb9c52f5fd0aa9a8e27fef48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f27ae22cb9c52f5fd0aa9a8e27fef48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raffaello Bertini</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T17:01:19+00:00">August 11, 2022 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>Doing a benchmark of such small time can be tricky, even only for various caches.</p>
<p>It is not a good test neither, as 1ms difference (in 1 run?) for doing no processing at all with data, has no significance nor a value to use language A rather than B.</p>
<p>No one in the world could be interested in investing to save 1ms for a program that is doing nothing. Because it resolves no problems (but actually it creates one 😂)</p>
<p>If you want a real comparison of some small routines (this one used for the test it isn&rsquo;t, but it could be used ) and if you can&rsquo;t profile them, the way to go is to look at the generated assembler code. </p>
<p>Than on that can be done an analysis, test, benchmark and writing some conclusion.</p>
<p>Beside focusing on a real problem, it could hp better do this kind of comparison c/c++</p>
</div>
</li>
<li id="comment-642671" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f27ae22cb9c52f5fd0aa9a8e27fef48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f27ae22cb9c52f5fd0aa9a8e27fef48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Raffaello Bertini</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-11T17:14:30+00:00">August 11, 2022 at 5:14 pm</time></a> </div>
<div class="comment-content">
<p>One small improvement on this test could be to take out the &ldquo;net weight&rdquo; computing the &ldquo;tare&rdquo;:</p>
<p>Run both programs with empty main</p>
<p>Then hello world and do the net time execution of the hello world.</p>
<p>Here the tricky part is the include statement should be present or not?</p>
<p>Beside the expectation should be that the 2 empty programs take the same time to run,<br/>
Otherwise it implies that hello world itself isn&rsquo;t faster or slower, but there is some bootstrap overhead.</p>
<p>Anyway.<br/>
I Enjoyed the post.<br/>
Thanks</p>
</div>
</li>
<li id="comment-642711" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7201beefbf9ca3f4a05040662bf7d961?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7201beefbf9ca3f4a05040662bf7d961?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonathan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-12T02:08:40+00:00">August 12, 2022 at 2:08 am</time></a> </div>
<div class="comment-content">
<p>Incorrect. This isn&rsquo;t valid performance analysis. In fact, using GCC 11.2 with -Ofast, std::cout is 1.1x faster. At -O3, they are the same.</p>
<p><a href="https://quick-bench.com/q/lGltfiZ439DZGuBm1yc_GEy2TYQ" rel="nofollow ugc">https://quick-bench.com/q/lGltfiZ439DZGuBm1yc_GEy2TYQ</a></p>
</div>
</li>
<li id="comment-642999" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40a99e4781defef73486cd362ebb5f49?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tim Parker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-14T09:35:10+00:00">August 14, 2022 at 9:35 am</time></a> </div>
<div class="comment-content">
<p>As the post as been significantly re-written, the emphasis of the slow-down altered, and a number of the criticisms folded into the text as original text, it might be nice to address more of that in replies/updates to the comments and/or acknowledged in the new article text as appropriate.<br/>
This has been done is a couple of cases, but not all &#8211; and this puts the revised text at odds with the historical comments. </p>
<p>The issue of relevance and suitability of the micro-benchmark as-is is not really dealt with either (e.g. if the absolute time was important you would profile, adjust, iterate &#8211; if it&rsquo;s not important, it&rsquo;s not important), but that&rsquo;s another matter.</p>
</div>
<ol class="children">
<li id="comment-643057" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-14T16:21:25+00:00">August 14, 2022 at 4:21 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Unfortunately people repeatedly proposed alternative explanations, without running benchmarks themselves nor accounting for the critical point that my post makes: the speed dramatically increased after statically linking. I have added a paragraph to acknowledge these additions as you suggested. I do thank the various readers for their proposals but I am not going to answer point-by-point dozens of closely related comments.</p>
<p>Regarding the relevance of the benchmark, I have explained and re-explained it at length. For long running processes, the issue has always been irrelevant, but if you have short running processes (executing in about a millisecond or less), then you may be spending most of your time loading the standard library. You may not care, of course… but it is useful to be aware. There are solutions such as static linking, but there are tradeoffs.</p>
</div>
</li>
</ol>
</li>
<li id="comment-643680" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-21T14:21:18+00:00">August 21, 2022 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>What this shows (and really all this shows) is that the C++ library is a lot bigger than the C library. If you are not using the capability it provides, it is costing you performance.</p>
<p>On the other hand, if you have significant work on a complex problem, you can have better performance because the library and the language provides facilities that would be difficult and expensive to write in C.</p>
</div>
</li>
</ol>
