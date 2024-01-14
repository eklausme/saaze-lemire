---
date: "2020-07-17 12:00:00"
title: "The cost of runtime dispatch"
index: false
---

[11 thoughts on &ldquo;The cost of runtime dispatch&rdquo;](/lemire/blog/2020/07-17-the-cost-of-runtime-dispatch)

<ol class="comment-list">
<li id="comment-538459" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6110fb5254b500f6784a8fef35fa4260?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Evan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T02:17:01+00:00">July 17, 2020 at 2:17 am</time></a> </div>
<div class="comment-content">
<p>FWIW, on ARM you generally can&rsquo;t use the equivalent of the Intel CPUID instruction in unprivileged code. On Linux you&rsquo;re supposed to use <code>getauxval(AT_HWCAP)</code> and/or <code>getauxval(AT_HWCAP2)</code> (depending on which feature(s) you want to check for), which is obviously going to be a lot slower. I have no idea what you&rsquo;re supposed to do on Windows.</p>
<p>I have <a href="https://github.com/nemequ/portable-snippets/tree/master/cpu" rel="nofollow ugc">some code in portable-snippets</a> for both x86 and ARM (on Linux); it&rsquo;s not my best work, but it is functional. If you want something a bit beefier Google&rsquo;s <a href="https://github.com/google/cpu_features/" rel="nofollow ugc">cpu_features</a> library is probably your best bet right now, but integrating it is a bit of a pain unless you are already using CMake (and it&rsquo;s a bit of a pain if you are already using CMake because, well, you&rsquo;re using CMake ;)).</p>
<p>If you don&rsquo;t have to worry about supporting multiple compilers, there are lots of interesting options out there. GCC has <a href="https://gcc.gnu.org/onlinedocs/gcc/Common-Function-Attributes.html#index-target_005fclones-function-attribute" rel="nofollow ugc">the <code>target_clones</code> attribute</a>. clang has a <a href="https://clang.llvm.org/docs/AttributeReference.html#cpu-dispatch" rel="nofollow ugc"><code>cpu_dispatch</code></a> (I think ICC does too, but I&rsquo;m not certain). Unfortunately stuff like that doesn&rsquo;t work if you&rsquo;re using preprocessor directives to switch between different implementations, and AFAIK MSVC doesn&rsquo;t have anything similar.</p>
<p>I think the much more interesting, and important, question is where in the code to do the runtime dispatching. Doing it at too low of a level means you&rsquo;re performing a lot of extra checks and hurting the compiler&rsquo;s ability to optimize. Doing it at too high a level means you end up with a lot of bloat. In my experience, if the cost of the check is a concern you should probably move it up a bit.</p>
<p>For example, one question I get about <a href="https://github.com/simd-everywhere/simde/" rel="nofollow ugc">SIMDe</a> pretty often is whether it does dynamic dispatch. It would be very convenient, but it would also be absolutely devastating for performance. I&rsquo;d be interested to hear about your experience with where to put the dynamic dispatch code in simdjson and why.</p>
</div>
<ol class="children">
<li id="comment-538716" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T13:17:50+00:00">July 17, 2020 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>I think that simdjson has a different design issue with respect to runtime dispatching than SIMDe because we can easily hide away the runtime dispatching without effort. Our user-facing API has few entry points.</p>
</div>
</li>
</ol>
</li>
<li id="comment-538578" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa1e806f97322661e06279d2f35e7ab8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa1e806f97322661e06279d2f35e7ab8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stelian Ionescu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T05:55:00+00:00">July 17, 2020 at 5:55 am</time></a> </div>
<div class="comment-content">
<p>GCC has support for <a href="https://gcc.gnu.org/wiki/FunctionMultiVersioning" rel="nofollow ugc">function multiversioning</a>, which allows the runtime linker to select the best function and avoids all the calls to CPUID.</p>
</div>
<ol class="children">
<li id="comment-538715" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T13:13:45+00:00">July 17, 2020 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>It is unlikely to avoid &ldquo;all calls to the CPUID&rdquo;. Or do you mean that it removes them from your own code?</p>
</div>
<ol class="children">
<li id="comment-538736" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fa1e806f97322661e06279d2f35e7ab8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fa1e806f97322661e06279d2f35e7ab8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stelian Ionescu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T19:59:52+00:00">July 17, 2020 at 7:59 pm</time></a> </div>
<div class="comment-content">
<p>Yes, I was referring to the CPUID calls required by runtime dispatch. If the load-time CPU dispatch afforded by the toolchain does the job, it seems like a more maintainable solution.</p>
</div>
<ol class="children">
<li id="comment-538744" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T21:09:16+00:00">July 17, 2020 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>I agree!!! But I don&rsquo;t think you take it far enough.</p>
<p>Support should be <em>in the programming language</em> itself.</p>
</div>
<ol class="children">
<li id="comment-642430" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a725014f091bcd9e8ff16e9f2a0d7e20?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a725014f091bcd9e8ff16e9f2a0d7e20?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Brüns</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T15:16:28+00:00">August 9, 2022 at 3:16 pm</time></a> </div>
<div class="comment-content">
<p>C++ is specified for an abstract virtual machine.</p>
<p>CPU architectures are an implementation detail of the compiler.</p>
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
<li id="comment-538713" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5520cca65026c04478a2282b13880e33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5520cca65026c04478a2282b13880e33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dmitrii Vedenko</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-17T12:58:03+00:00">July 17, 2020 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>CPUID is a serializing instruction, which makes benchmarking it rather useless and informative. I.e. it will wait until all previous instructions are fully completed, which can be a major performance issue on the modern out-of-order CPUs.</p>
</div>
</li>
<li id="comment-539127" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeux.io" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-19T07:49:26+00:00">July 19, 2020 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>When using C++11 or higher, it&rsquo;s sufficient to do something like</p>
<p>static unsigned int cpuid = getcpuid()</p>
<p>Doing this inside any function (as well as in global scope, although that can be prone to issues with static ctor order) is guaranteed to be thread-safe, so there&rsquo;s no need to roll your own atomic-based construct for this.</p>
</div>
<ol class="children">
<li id="comment-539155" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-19T17:35:42+00:00">July 19, 2020 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p>Certainly, there is no need to synchronize getcpuid itself, but whatever work you do following getcpuid also needs to be made thread-safe.</p>
</div>
<ol class="children">
<li id="comment-642431" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a725014f091bcd9e8ff16e9f2a0d7e20?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a725014f091bcd9e8ff16e9f2a0d7e20?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Brüns</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-08-09T15:25:26+00:00">August 9, 2022 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>You can put the whole initialization code into a lambda, and use it to initialize a static variable once. That *is* thread safe in C++11.</p>
<p>&ldquo;`<code><br/>
const implementation *detect_best_supported() noexcept {<br/>
const static implementation* best = []() {<br/>
uint32_t supported_instruction_sets = detect_supported_architectures();<br/>
for (const implementation *impl : available_implementation_pointers) {<br/>
uint32_t required_instruction_sets = impl-&gt;required_instruction_sets();<br/>
if ((supported_instruction_sets &amp; required_instruction_sets) ==<br/>
required_instruction_sets) {<br/>
return impl;<br/>
}<br/>
}<br/>
return &amp;legacy_singleton;<br/>
}<br/>
return best;<br/>
}<br/>
`</code><code></code></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
