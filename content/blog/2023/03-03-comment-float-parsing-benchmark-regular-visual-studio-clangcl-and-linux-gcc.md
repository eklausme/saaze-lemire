---
date: "2023-03-03 12:00:00"
title: "Float-parsing benchmark: Regular Visual Studio, ClangCL and Linux GCC"
index: false
---

[4 thoughts on &ldquo;Float-parsing benchmark: Regular Visual Studio, ClangCL and Linux GCC&rdquo;](/lemire/blog/2023/03-03-float-parsing-benchmark-regular-visual-studio-clangcl-and-linux-gcc)

<ol class="comment-list">
<li id="comment-649675" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f2c27156b0eefb3182783dcd72699f1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f2c27156b0eefb3182783dcd72699f1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Joseph</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-06T14:26:42+00:00">March 6, 2023 at 2:26 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried Intel&rsquo;s compiler?</p>
</div>
<ol class="children">
<li id="comment-649679" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-06T19:55:35+00:00">March 6, 2023 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>I did not. Want to give it a try and report back?</p>
</div>
</li>
</ol>
</li>
<li id="comment-649685" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9f5e3d71ba3fb09ccd9bfa136367043b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9f5e3d71ba3fb09ccd9bfa136367043b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/juliosao" class="url" rel="ugc external nofollow">JulioSAO</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-07T09:56:05+00:00">March 7, 2023 at 9:56 am</time></a> </div>
<div class="comment-content">
<p>I think is not an issue with your metodology.<br/>
I work as system programmer and in my experience, linux beats windows in every CPU, Disk and Memory benchmark. Even virtualized under windows many test still outperforms windows en several test. The only area where windows wins is in graphics.</p>
<p>I dont have low level details about it but i suspect the cause is a combination of better optimization (ej, copy on write memory when fork a process), api exposed (system-v api vs win32) and complexity (linux boxes often run less process at idle state).</p>
<p>And graphics stack in linux is getting better year at year. Now you even can run windows games in linux and some of them, run faster. Even &ldquo;emulating&rdquo; using proton.</p>
<p>Regards.<br/>
Regards.</p>
</div>
<ol class="children">
<li id="comment-649747" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9496b8a218bf0f5a18ec61a29009c570?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9496b8a218bf0f5a18ec61a29009c570?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Aurélien RB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-11T21:18:12+00:00">March 11, 2023 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>The Linux version of his tests runs on a Windows kernel (WSL). Generally speaking I doubt the OS has a serious impact on such micro benchmark.<br/>
It&rsquo;s the compiler that is benckmarked here. And VC++ is known to not be the best in speed, both for backend code generation but also efficient STL implémentation.<br/>
<a href="https://developercommunity.visualstudio.com/t/vs2019-generates-inefficient-code-compared-to-clan/457819" rel="nofollow ugc">https://developercommunity.visualstudio.com/t/vs2019-generates-inefficient-code-compared-to-clan/457819</a><br/>
Something interesting to test would be clang on WSL because I wonder how much clang-cl differs from regular clang.</p>
</div>
</li>
</ol>
</li>
</ol>
