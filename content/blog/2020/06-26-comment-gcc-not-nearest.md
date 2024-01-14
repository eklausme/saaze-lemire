---
date: "2020-06-26 12:00:00"
title: "GNU GCC on x86 does not round floating-point divisions to the nearest value"
index: false
---

[60 thoughts on &ldquo;GNU GCC on x86 does not round floating-point divisions to the nearest value&rdquo;](/lemire/blog/2020/06-26-gcc-not-nearest)

<ol class="comment-list">
<li id="comment-532128" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T03:20:40+00:00">June 27, 2020 at 3:20 am</time></a> </div>
<div class="comment-content">
<p>I think you should be more specific and state that the issue is with the x87 floating point unit. The x87 has one internal precision that defaults to 80-bits, though this can be set to 32 or 64 bits using the FLDCW instruction to load the control word for the floating point unit. For most cases, people want and expect the internal precision to equal the operand precision (FLT_EVAL_METHOD=0), which is what SSE instructions do. Note that explicitly requesting SSE does actually work in gcc as long as the processor supports SSE. See here in godbolt <a href="https://godbolt.org/z/Xqi_S7" rel="nofollow ugc">https://godbolt.org/z/Xqi_S7</a></p>
<p>For your docker test, you are using the i386/ubuntu image and so you need to explicitly tell gcc that you have a machine with sse instructions, e.g. -march=pentium4, which gives the desired behavior:</p>
<p><code>compiling round with -mfpmath=sse -march=pentium4<br/>
x/y = 0.501782303180000055<br/>
expected x/y (round to even) = 0.501782303180000055<br/>
Expected assumes FLT_EVAL_METHOD = 1<br/>
Equal<br/>
Equal<br/>
FE_DOWNWARD : 0.501782303179999944<br/>
FE_TONEAREST : 0.501782303180000055<br/>
FE_TOWARDZERO: 0.501782303179999944<br/>
FE_UPWARD : 0.501782303180000056<br/>
FLT_EVAL_METHOD = 0<br/>
</code></p>
<p>The real question is why is gcc emitting any x87 instructions (except for long double) on architectures that support sse. I would expect -march=pentium4 to use sse by default, but sse has to be specifically requested.</p>
</div>
<ol class="children">
<li id="comment-532206" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T14:31:59+00:00">June 27, 2020 at 2:31 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I think you should be more specific and state that the issue is with the x87 floating point unit. The x87 has one internal precision that defaults to 80-bits, though this can be set to 32 or 64 bits using the FLDCW instruction to load the control word for the floating point unit. For most cases, people want and expect the internal precision to equal the operand precision (FLT_EVAL_METHOD=0), which is what SSE instructions do.</p>
</blockquote>
<p>Did you get the part where if you add the flag &lsquo;-O2&rsquo; then FLT_EVAL_METHOD remains unchanged, but the rounding becomes correct (meaning that it rounds to the nearest 64-bit float)?</p>
<blockquote>
<p>For most cases, people want and expect the internal precision to equal the operand precision (FLT_EVAL_METHOD=0), which is what SSE instructions do.</p>
</blockquote>
<p>If the x87 unit can do it, why isn&rsquo;t it the default since we agree that it is what most people want?</p>
</div>
<ol class="children">
<li id="comment-532216" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/706bfc4a6f4da473b87e55776dfdf547?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Brian Kessler</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T16:18:52+00:00">June 27, 2020 at 4:18 pm</time></a> </div>
<div class="comment-content">
<p>Looking at godbolt, gcc -O2 appears to compute the division at compile time using the precision of the operands. I don’t see any division instructions issued at all, so the FLT_EVAL_METHOD is not relevant in this case since the x87 is not actually performing the calculations. Compile time and run time floating point calculations not matching is a whole other can of worms 🙂</p>
<p>As mentioned above, x87 unit can perform the calculations only at a single given precision by altering the precision in the control word. It could emulate FLT_EVAL_METHOD=0, but the precision would have to be updated when switching between any calculations using float, double or long double. I imagine this might not be the default behavior because of the performance overhead of loading and restoring precision in the control word for different precisions. For code that mostly or solely is using doubles, the compiler could avoid adjusting the precision most of the time at the cost of tracking the precision state throughout the code. It would be interesting to see if any compiler has a mode where it adjusts the x87 precision automatically to emulate FLT_EVAL_MODE=0</p>
</div>
<ol class="children">
<li id="comment-532219" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T16:38:03+00:00">June 27, 2020 at 4:38 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I don’t see any division instructions issued at all, so the FLT_EVAL_METHOD is not relevant in this case since the x87 is not actually performing the calculations. Compile time and run time floating point calculations not matching is a whole other can of worms</p>
</blockquote>
<p>This is insanity.</p>
</div>
<ol class="children">
<li id="comment-532282" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/64d556319838da5924df2ac88e1a4f31?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/64d556319838da5924df2ac88e1a4f31?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jules Blok</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T00:17:30+00:00">June 28, 2020 at 12:17 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
This is insanity
</p></blockquote>
<p>This is C++</p>
</div>
</li>
</ol>
</li>
<li id="comment-532547" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aae76e26ba4f7a59abd6a905d452a27d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aae76e26ba4f7a59abd6a905d452a27d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Shash</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T13:33:27+00:00">June 29, 2020 at 1:33 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Looking at godbolt, gcc -O2 appears to compute the division at compile time using the precision of the operands. I don’t see any division instructions issued at all, so the FLT_EVAL_METHOD is not relevant in this case since the x87 is not actually performing the calculations.
</p></blockquote>
<p>That&rsquo;s easy fixed &#8211; just move the division to a function so that gcc can&rsquo;t optimize it away: <a href="https://godbolt.org/z/4Tfcup" rel="nofollow ugc">https://godbolt.org/z/4Tfcup</a></p>
<p>Interestingly, this gives us</p>
<p><code>x/y = 0.501782303179999944<br/>
</code></p>
</div>
</li>
</ol>
</li>
<li id="comment-532225" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ea664ea75a08f85f66d8265b186b9b45?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ea664ea75a08f85f66d8265b186b9b45?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">That Singh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T18:26:55+00:00">June 27, 2020 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not a bug, at least not as you have related it. If the calculation gets performed at compile time (as you have said), then you have to deal with the fact that the compiler has different knowledge than the run time&#8230; And the more you tell it to optimize, the more you cause work to be done in the compiler environment.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-532184" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69abe49f3a15dd1c4e3bb11d5d703dd1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69abe49f3a15dd1c4e3bb11d5d703dd1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simon Lindholm</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T09:02:05+00:00">June 27, 2020 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Even with SSE enabled you still don&rsquo;t necessarily get complete IEEE 754 compliance, since GCC by default emits fused multiply-add instructions whenever it can:</p>
<p><code>#include &lt;stdio.h&gt;</p>
<p>double a = 0.1, b = 10.0, c = -1;<br/>
int main() {<br/>
double ab = a * b;<br/>
printf("%.5e\n", ab + c);<br/>
}<br/>
</code></p>
<p>This prints 5.55112e-17 with GCC -O2 -march=native (or -mfma), and 0.00000e+00 with GCC -O2. (Can be turned off with -ffp-contract=off.)</p>
</div>
</li>
<li id="comment-532204" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77354b5719b3d8479482aa6b2beafd90?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77354b5719b3d8479482aa6b2beafd90?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A.J. S.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T13:34:35+00:00">June 27, 2020 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>If God did exist, really? I stopped reading right after that, get your stuff together or don&rsquo;t write at all.</p>
</div>
<ol class="children">
<li id="comment-532278" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb8b45a6ce28fa90302d9b41cc2e29e5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb8b45a6ce28fa90302d9b41cc2e29e5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">For Real</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T00:01:54+00:00">June 28, 2020 at 12:01 am</time></a> </div>
<div class="comment-content">
<p>Oh, relax.</p>
</div>
</li>
<li id="comment-532288" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c53d81245d85989dd6aa2018a2278fd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c53d81245d85989dd6aa2018a2278fd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Zbiciak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T01:13:01+00:00">June 28, 2020 at 1:13 am</time></a> </div>
<div class="comment-content">
<p>You must be a blast at parties.</p>
</div>
</li>
<li id="comment-532355" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df85f991f9b7fe5c606b10acfc398905?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df85f991f9b7fe5c606b10acfc398905?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Penner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T09:15:56+00:00">June 28, 2020 at 9:15 am</time></a> </div>
<div class="comment-content">
<p>Is this an attempt to dismiss the original post based on word choice as opposed to content? If you stop reading at your first offensive content you will not read much on the web 🙂</p>
</div>
</li>
<li id="comment-532381" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f3c845bcc23dd8816bac6eb252fc0918?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f3c845bcc23dd8816bac6eb252fc0918?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J. B.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T11:21:30+00:00">June 28, 2020 at 11:21 am</time></a> </div>
<div class="comment-content">
<p>Someone holds (presumably) different religious beliefs to you and that means they should stop writing and &ldquo;get it together&rdquo; (what does that even mean in this context &#8211; it makes no sense)? Never mind the fact that it&rsquo;s totally irrelevant, I&rsquo;m more interested in why you are apparently so special that you get to be judge of who can write. (Not really though &#8211; you&rsquo;re a joke and so is your god.)</p>
</div>
</li>
<li id="comment-532392" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/df7c5e0926a7f4b42e4d78cc5f4fe2af?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/df7c5e0926a7f4b42e4d78cc5f4fe2af?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chops</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T12:28:01+00:00">June 28, 2020 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p>Possibly you&rsquo;re not neuro-typical and the real meaning of these words is lost on you. If you think a statement about the existence of god was made here, then you&rsquo;ve completely misunderstood.</p>
</div>
</li>
<li id="comment-532428" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab7764b9d5964865bc741f481ec1bbd7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab7764b9d5964865bc741f481ec1bbd7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">The Dude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T17:06:37+00:00">June 28, 2020 at 5:06 pm</time></a> </div>
<div class="comment-content">
<p>There was a god, once. But he’s dead now.</p>
</div>
</li>
<li id="comment-532436" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aa0975b4ffbfdacee62264695665b0f5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aa0975b4ffbfdacee62264695665b0f5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mark Gomersbach</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T18:23:19+00:00">June 28, 2020 at 6:23 pm</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s so wrong about that sentence to discard the rest of the content and respond with a weak attempt at insult?</p>
<p>Anyway, I enjoyed reading this as everybody who first learns about this, starts losing hairs.</p>
</div>
</li>
<li id="comment-532582" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f102ad037831ee891491207ec78e444?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f102ad037831ee891491207ec78e444?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eddy Current</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T22:16:09+00:00">June 29, 2020 at 10:16 pm</time></a> </div>
<div class="comment-content">
<p>GOD is REAL, unless declared INTEGER</p>
<p>That leaves the question: REAL<em>4 or REAL</em>8?<br/>
Since neither 4 nor 8 equals 3 we can safely deny the existence of the so called trinity.</p>
</div>
</li>
</ol>
</li>
<li id="comment-532220" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e79004a85f6b06ad87473b3863c4158?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e79004a85f6b06ad87473b3863c4158?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">john mullee</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T17:12:55+00:00">June 27, 2020 at 5:12 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://docs.python.org/3/tutorial/floatingpoint.html" rel="nofollow ugc">https://docs.python.org/3/tutorial/floatingpoint.html</a></p>
<p>&ldquo;Python keeps the number of digits manageable by displaying a rounded value instead</p>
<blockquote>
<blockquote><p>
&gt;</p>
<blockquote><p>
1 / 10<br/>
0.1<br/>
Just remember, even though the printed result looks like the exact value of 1/10, the actual stored value is the nearest representable binary fraction.
</p></blockquote>
</blockquote>
</blockquote>
</div>
</li>
<li id="comment-532239" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c53d81245d85989dd6aa2018a2278fd5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c53d81245d85989dd6aa2018a2278fd5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Joe Zbiciak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T21:06:29+00:00">June 27, 2020 at 9:06 pm</time></a> </div>
<div class="comment-content">
<p>It gets weirder than that. I get different results if I compile for 32-bit vs. 64-bit:</p>
<p><code>$ gcc-7.1.0 -m64 r.c<br/>
$ ./a.out<br/>
0.501782303180000055<br/>
$ gcc-7.1.0 -m32 r.c<br/>
$ ./a.out<br/>
0.501782303179999944<br/>
$ gcc-9.2.0 -m64 r.c<br/>
$ ./a.out<br/>
0.501782303180000055<br/>
$ gcc-9.2.0 -m32 r.c<br/>
$ ./a.out<br/>
0.501782303179999944<br/>
</code></p>
<p>The 32-bit SysV ABI is actually pretty terrible with regards to floating point rounding consistency.</p>
<p>Here&rsquo;s another great example of just how messed up it is:</p>
<p><code>#include &lt;stdio.h&gt;</p>
<p>float fp_test(void) {<br/>
volatile float a = (float)(1ull &lt;&lt; 60);<br/>
volatile float b = (float)(1 &lt;&lt; 0);<br/>
return a + b;<br/>
}</p>
<p>int main() {<br/>
volatile float c = (float)(1ull &lt;&lt; 60);<br/>
printf("%g\n", fp_test() - c);<br/>
return 0;<br/>
}<br/>
</code></p>
<p>If you compile this for the 32-bit and 64-bit ABIs, you&rsquo;ll get different results:</p>
<p><code>$ gcc-9.2.0 -m32 -fno-inline abi.c -o abi-32<br/>
$ gcc-9.2.0 -m64 -fno-inline abi.c -o abi-64<br/>
$ ./abi-32<br/>
1<br/>
$ ./abi-64<br/>
0<br/>
</code></p>
<p>That anomaly arises from the fact that the i386 SysV ABI has floating point values returned on the stack, and they retain more precision than if they were rounded to the requested size. (Page 38: <a href="http://www.sco.com/developers/devspecs/abi386-4.pdf" rel="nofollow ugc">i386 SysV ABI</a>)</p>
<p>And there&rsquo;s this additional caveat in the i386 SysV ABI: </p>
<p>Looking around, it seems GCC does implement a flag, <code>-frounding-math</code>, that should disable the assumption of the same rounding mode everywhere. <em>But&#8230;</em> Just go read the associated PR: <a href="https://gcc.gnu.org/bugzilla/show_bug.cgi?id=34678" rel="nofollow ugc">https://gcc.gnu.org/bugzilla/show_bug.cgi?id=34678</a></p>
<p>It looks like the closest thing I&rsquo;ve found to an official position is at the bottom of the page here: <a href="https://gcc.gnu.org/wiki/FloatingPointMath" rel="nofollow ugc">https://gcc.gnu.org/wiki/FloatingPointMath</a></p>
<p>The tl;dr, as I see it? &ldquo;On i386 and M68K, we throw are hands in the air and do the fast thing, not the pedantically bitwise accurate thing, as that&rsquo;s what we think most folks actually want.&rdquo;</p>
<blockquote><p>
Note on x86 and m68080 floating-point math<br/>
For legacy x86 processors without SSE2 support, and for m68080 processors, GCC is only able to fully comply with IEEE 754 semantics for the IEEE double extended (<code>long double</code>) type. Operations on IEEE double precision and IEEE single precision values are performed using double extended precision. In order to have these operations rounded correctly, GCC would have to save the FPU control and status words, enable rounding to 24 or 53 mantissa bits and then restore the FPU state. This would be far too expensive.</p>
<p> The extra intermediate precision and range may cause flags not be set or traps not be raised. Also, for double precision, double rounding may affect the final results. Whether or not intermediate results are rounded to double precision or extended precision depends on optimizations being able to keep values in floating-point registers. The option <code>-ffloat-store</code> prevents GCC from storing floating-point results in registers. While this avoids the indeterministic behavior just described (at great cost), it does not prevent accuracy loss due to double rounding.</p>
<p> On more modern x86 processors that support SSE2, specifying the compiler options <code>-mfpmath=sse -msse2</code> ensures all <code>float</code> and <code>double</code> operations are performed in SSE registers and correctly rounded. These options do not affect the ABI and should therefore be used whenever possible for predictable numerical results. For x86 targets that may not support SSE2, and for m68080 processors, use long double where exact rounding is required and explicitly convert to <code>float</code> or <code>double</code> when necessary. Using <code>long double</code> prevents loss of 80-bit accuracy when values must be spilled to memory. See x87note for further details.</p>
<p> For more information on mixing x87 and SSE math, see Math_Optimization_Flags.
</p></blockquote>
</div>
</li>
<li id="comment-532265" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85be1bd86aa9bad77e7c77e7ce594255?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85be1bd86aa9bad77e7c77e7ce594255?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://scalability.org" class="url" rel="ugc external nofollow">Joe Landman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T23:13:03+00:00">June 27, 2020 at 11:13 pm</time></a> </div>
<div class="comment-content">
<p>Hmmm. I copied this to a file t.c, and complied -O3 on a an old Core i7-2670QM CPU, running linux mint 19.3</p>
<p><code>joe@lightning:~$ gcc -O3 t.c<br/>
joe@lightning:~$ ./a.out<br/>
x/y = 0.501782303180000055<br/>
</code></p>
<p>This is gcc 7.5.0-3ubuntu~18.04. Could you describe your environment in greater detail?</p>
</div>
<ol class="children">
<li id="comment-532420" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T15:44:39+00:00">June 28, 2020 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>I specify the docker image. I cannot be more precise than that. Have you tried running the script and generating the docker container?</p>
</div>
<ol class="children">
<li id="comment-532551" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85be1bd86aa9bad77e7c77e7ce594255?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85be1bd86aa9bad77e7c77e7ce594255?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://scalability.org" class="url" rel="ugc external nofollow">Joe Landman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T14:55:38+00:00">June 29, 2020 at 2:55 pm</time></a> </div>
<div class="comment-content">
<p>Ok, I missed that you were doing this with a 32 bit target. Mine is a 64 bit platform. SSE and above will behave more sanely.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-532268" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ddc37cfe81a5610e8084dab64c05dd6a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ddc37cfe81a5610e8084dab64c05dd6a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Warren Henning</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-27T23:20:49+00:00">June 27, 2020 at 11:20 pm</time></a> </div>
<div class="comment-content">
<p>Is it considered acceptable if the program output changes based on optimization levels? Changing -O0 to -O3 in that Godbolt link changed the program output for me: <a href="https://godbolt.org/z/rDTmn8" rel="nofollow ugc">https://godbolt.org/z/rDTmn8</a> . I love computers!</p>
</div>
</li>
<li id="comment-532283" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathias Gaunard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T00:31:22+00:00">June 28, 2020 at 12:31 am</time></a> </div>
<div class="comment-content">
<p>The compiler is allowed to perform any operation with higher precision than requested.</p>
<p>There is apparently an interesting edge case in that your operation, when done with infinite precision, then rounded to 80-bit Intel, then rounded again to standard binary64, does not yield the same result than if done with infinite precision then directly rounded to standard binary64.</p>
</div>
<ol class="children">
<li id="comment-593718" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e78fc6a764c9cd45f5da442d4a2d9503?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e78fc6a764c9cd45f5da442d4a2d9503?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Al</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-08-07T08:06:54+00:00">August 7, 2021 at 8:06 am</time></a> </div>
<div class="comment-content">
<p>Classic double rounding</p>
</div>
</li>
</ol>
</li>
<li id="comment-532321" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24fad9ae5bb328e16d3c63e6cb1b501f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24fad9ae5bb328e16d3c63e6cb1b501f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Heikki Kultala</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T05:21:53+00:00">June 28, 2020 at 5:21 am</time></a> </div>
<div class="comment-content">
<p>SSE does not support 64-bit double precision floating point numbers. It only supports 32-bit floating point numbers, so x87 is still used for double calculations.</p>
<p>Only SSE2 supports doubles.</p>
<p>Instead of -msse, use -msse2</p>
</div>
</li>
<li id="comment-532351" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Moschops</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T08:36:17+00:00">June 28, 2020 at 8:36 am</time></a> </div>
<div class="comment-content">
<p>Is it a bug? I don&rsquo;t know enough about the IEEE floating point specification, but is there a requirement to round to the nearest value rather than either of the two bounding values? Or if the requirement isn&rsquo;t in that, where is it? What specifies that one of the two bounding values should be chosen over the other?</p>
</div>
<ol class="children">
<li id="comment-532433" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38a2274db3b64c309aed98275d99a009?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mathias Gaunard</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T17:54:02+00:00">June 28, 2020 at 5:54 pm</time></a> </div>
<div class="comment-content">
<p>It is not a bug, see my comment.<br/>
It is allowed for the compiler to use arbitrarily more precision than requested. Sometimes (in some pretty specific conditions), that leads to an error of one bit in the mantissa.</p>
</div>
</li>
</ol>
</li>
<li id="comment-532367" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3cdf053c3f971b59632cba7db204696b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3cdf053c3f971b59632cba7db204696b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Silviu</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T10:26:50+00:00">June 28, 2020 at 10:26 am</time></a> </div>
<div class="comment-content">
<p>I think it matters how you compiled the GCC compiler itself, since those computations are done at compile time(i.e. the compiler(which is an executable compiled woth some other flags) does thrm for you).<br/>
Never bothered to check, just thought it might be relevant.</p>
</div>
</li>
<li id="comment-532395" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8f9cd2b9145560803a7135a1a2dc9cf9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8f9cd2b9145560803a7135a1a2dc9cf9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael K.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T13:02:06+00:00">June 28, 2020 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
I wonder what the existence of God has to do with floating point properties or some compiler implementations.<br/>
Though my faith is not always as big as I wish, I do believe in God. There are people who do not believe in God. I respect this. But I think it is arrogant to deny God, because men think, we have the total understanding of the world and the universe.<br/>
I have a deep sympathy fro the ancient scholars, who addressed themselfes to theological questions. (Have you heard about Gottfried Wilhelm Leibniz, Joseph Fourier, Blaise Pascal or Michael Faraday?)<br/>
Regards,<br/>
michaeL</p>
</div>
<ol class="children">
<li id="comment-532430" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e49ab37de99f97ff270632bcbaee49d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e49ab37de99f97ff270632bcbaee49d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vladimir Baus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T17:19:34+00:00">June 28, 2020 at 5:19 pm</time></a> </div>
<div class="comment-content">
<p>I cannot say for sure, but I&rsquo;m pretty confident he meant no insult. To me it looks more like a saying, perhaps a bit clumsily translated from French?</p>
<p>Back to the topic, I find it quite fascinating that there are so many interpretations to the standard, depending on how one reads it, of course. As a former member of a custom C compiler for an in-house DSP processor, I have to say my memory is quite a bit fade on the topic. Shame on me, though&#8230;</p>
</div>
<ol class="children">
<li id="comment-532431" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T17:30:06+00:00">June 28, 2020 at 5:30 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>To me it looks more like a saying, perhaps a bit clumsily translated from French?</p>
</blockquote>
<p>I do not think that it is a saying. It is a reference to the fact that we do not live in a universe where things work out nicely. There are ugly bits.</p>
</div>
<ol class="children">
<li id="comment-532446" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cde4b20bd2c1978e1632318bf6a0fe48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cde4b20bd2c1978e1632318bf6a0fe48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Saheed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T20:05:36+00:00">June 28, 2020 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>Great sir, you just discovered one ugly bit (bug) in a system created by thousands of intelligent people. Permit me to point out that the very existence of God is reinforced by man&rsquo;s continuos discovered of so many ugly bits we sneak into the perfect system He created, either deliberately or by mistake. Yet the system still works, even when for the most part we don&rsquo;t know why.</p>
<p>While I totally disagree with the reaction of the first person that pointed this out. The fact remains that the literary construct:</p>
<blockquote><p>
If God did exist, the variable ratio would be 0.50178230318 and the story would end there. Unfortunately, there is no floating-point number that is exactly 0.50178230318.
</p></blockquote>
<p>is offensive to people of faith. The logical conclusion of those two statements denies the existence of God. It is totally uncalled for in the context of the subject at hand. Judging by the target audience of the subject, it should be no surprise that those statements are interpreted as such.</p>
<p>Your reply implies that it is a deliberate construct. I say it is just wrong and clearly inconsiderate.</p>
</div>
<ol class="children">
<li id="comment-532561" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Moschops</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T17:04:22+00:00">June 29, 2020 at 5:04 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;I say it is just wrong and clearly inconsiderate.&rdquo;</p>
<p>Well it&rsquo;s not. It&rsquo;s a not uncommon English turn of phrase; completely forgivable for a non-native English speaker to not know it, and native English speakers who&rsquo;ve missed it simply aren&rsquo;t reading enough.</p>
</div>
</li>
</ol>
</li>
<li id="comment-532560" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d2859a9c8b49548871130fdb74eee4d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Moschops</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T17:03:02+00:00">June 29, 2020 at 5:03 pm</time></a> </div>
<div class="comment-content">
<p>Exactly so. That&rsquo;s the meaning as commonly understood. It is no comment at all about religion, or the existence of god, or anything like that. It&rsquo;s akin to saying &ldquo;in a just world&rdquo;, or &ldquo;in a sensible universe&rdquo;. This obsession with the literal seems to be more common amongst programmers; joyfully throwing out the pleasures of communication and language.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-532767" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d883d475a4bf09369875019ae7ad886?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d883d475a4bf09369875019ae7ad886?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">José Luis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-01T10:13:37+00:00">July 1, 2020 at 10:13 am</time></a> </div>
<div class="comment-content">
<p>Worst: I had heard of Newton.</p>
</div>
</li>
<li id="comment-532768" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d883d475a4bf09369875019ae7ad886?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d883d475a4bf09369875019ae7ad886?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">José Luis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-01T10:32:25+00:00">July 1, 2020 at 10:32 am</time></a> </div>
<div class="comment-content">
<p>Michel, don&rsquo;t be so sensitive (or I may use the childish lenguage? ) about a common expresion (out of your house or church), we are talking on other dimension (a well known dimension in which gods are irrelevant as Laplace said to Napoléon Bonaparte).</p>
</div>
</li>
</ol>
</li>
<li id="comment-532462" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marshall Ward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T21:37:20+00:00">June 28, 2020 at 9:37 pm</time></a> </div>
<div class="comment-content">
<p>For what it&rsquo;s worth, this is what I get from GCC 10.1 with libc 2.31:</p>
<p><code>x/y = 0.501782303180000055<br/>
</code></p>
<p>My machine is an AMD Ryzen 5 2600. Not yet sure how to compare the assembly output or various architecture compiler flags.</p>
<p>Our group has recently had to grapple with various floating point answer in changes in libm from libc 2.22 to 2.27, so it does seem some attention is being paid to these issues.</p>
</div>
<ol class="children">
<li id="comment-532463" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marshall Ward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T21:49:47+00:00">June 28, 2020 at 9:49 pm</time></a> </div>
<div class="comment-content">
<p>Just tested this on several GCC versions (6.1, 7.3, 8.1, 8.2, 9.1) on a Sandy Bridge Xeon, and also get the &ldquo;correct&rdquo; answer as above.</p>
<p>I am unfortunately not very versed in Docker, but FP repro is very important to our work and I&rsquo;d like to understand this more, so I&rsquo;ll try to try and familiarize with it.</p>
</div>
</li>
<li id="comment-532464" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marshall Ward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-28T21:57:07+00:00">June 28, 2020 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>Using <code>-m32</code> appears to give me the &ldquo;wrong&rdquo; answer:</p>
<p><code>$ ~/test/float$ gcc -m32 div.c<br/>
$ ~/test/float$ ./a.out<br/>
x/y = 0.501782303179999944<br/>
</code></p>
<p>(I also now see Joe Zbiciak has observed the same&#8230;)</p>
</div>
</li>
</ol>
</li>
<li id="comment-532552" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/02228e920929e124bf7736a5e3cdff24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/02228e920929e124bf7736a5e3cdff24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tony Reix</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T15:07:39+00:00">June 29, 2020 at 3:07 pm</time></a> </div>
<div class="comment-content">
<p><strong>With GCC v9 on Fedora32/x86_64 : OK :</strong></p>
<p>gcc /tmp/C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>gcc -O2 /tmp/C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>gcc &#8211;version</p>
<p>gcc (GCC) 9.3.1 20200408 (Red Hat 9.3.1-2)</p>
<p><strong>With GCC v8.4 on AIX : OK :</strong></p>
<p>gcc C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>gcc -maix64 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>gcc -O2 -maix64 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>gcc -O2 -maix32 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>gcc &#8211;version</p>
<p>gcc (GCC) 8.4.0</p>
<p>g++ -O2 -maix32 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++ -O2 -maix64 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p><strong>Same with GCC v9.3 :</strong></p>
<p>g++ -O2 -maix32 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++ -O2 -maix64 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++-9 -O2 -maix64 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++-9 -O0 -maix64 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++-9 -O0 -maix32 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++-9 -O2 -maix32 C.c -o C ; ./C</p>
<p>x/y = 0.501782303180000055</p>
<p>g++-9 &#8211;version</p>
<p>g++-9 (GCC) 9.3.0</p>
<p><strong>You should use Pari/gp !</strong></p>
<p>0.1+(0.2+0.3)</p>
<p>%1 = 0.60000000000000000000000000000000000000</p>
<p>(0.1+0.2)+0.3</p>
<p>%2 = 0.60000000000000000000000000000000000000</p>
<p>50178230318.0 / 100000000000.0</p>
<p>%1 = 0.50178230318000000000000000000000000000</p>
<p>Ha ha ha !!</p>
</div>
</li>
<li id="comment-532555" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bcb14eda54fd57b63f784f08628c15f2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bcb14eda54fd57b63f784f08628c15f2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marc-Olivier Killijian</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T15:25:46+00:00">June 29, 2020 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, just to let you know that gcc 8.3.0 on Mac (target x86_64-apple-darwin18) works correctly and gives &ldquo;x/y = 0.501782303180000055&rdquo;.</p>
</div>
</li>
<li id="comment-532567" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bd3a4af368439803aa37d318f9941a9f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bd3a4af368439803aa37d318f9941a9f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">A. Banker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-29T18:32:38+00:00">June 29, 2020 at 6:32 pm</time></a> </div>
<div class="comment-content">
<p>The compiler chose to do banker&rsquo;s rounding.<br/>
You think the right answer is this:</p>
<p>1100001010111011110101000011101111000010101110111101010000111011</p>
<p>but it is bounded below by this:</p>
<p>1100001010111011110101000011101011000010101110111101010000111010</p>
<p>Round to even will round to the lower value if it ends in 0.</p>
</div>
</li>
<li id="comment-532603" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-06-30T03:45:28+00:00">June 30, 2020 at 3:45 am</time></a> </div>
<div class="comment-content">
<p>Did you try compiling with -mpc64? From the man page,</p>
<p>-mpc32<br/>
-mpc64<br/>
-mpc80<br/>
Set 80387 floating-point precision to 32, 64 or 80 bits. When -mpc32 is specified, the significands of<br/>
results of floating-point operations are rounded to 24 bits (single precision); -mpc64 rounds the<br/>
significands of results of floating-point operations to 53 bits (double precision) and <strong>-mpc80 rounds the<br/>
significands of results of floating-point operations to 64 bits (extended double precision), which is the<br/>
default</strong>. When this option is used, floating-point operations in higher precisions are not available to<br/>
the programmer without setting the FPU control word explicitly.</p>
<p><code> Setting the rounding of floating-point operations to less than the default 80 bits can speed some programs<br/>
by 2% or more. Note that some mathematical libraries assume that extended-precision (80-bit) floating-<br/>
point operations are enabled by default; routines in such libraries could suffer significant loss of<br/>
accuracy, typically through so-called "catastrophic cancellation", when this option is used to set the<br/>
precision to less than extended precision.<br/>
</code></p>
</div>
</li>
<li id="comment-532802" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-01T15:59:16+00:00">July 1, 2020 at 3:59 pm</time></a> </div>
<div class="comment-content">
<p>Go to godbolt.org with the godbolt code provided in this article, and add the compilation switch -mpc64. Problem gone. It looks like the solution is (advertised) in the manual.</p>
</div>
<ol class="children">
<li id="comment-532830" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-01T19:06:02+00:00">July 1, 2020 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>@zero</p>
<blockquote>
<p>Problem gone. It looks like the solution is (advertised) in the manual.</p>
</blockquote>
<p>Are you sure?</p>
<p>I am not so sure. Yes. It will solve the 64-bit case, but does it ensures that the 32-bit floats do not suffer from the same double rounding problem? If the values are rounded to 53-bit mantissa and then rounded again to a smaller mantissa, the same problem could happen again.</p>
<p>As far as I can tell, there is only way correct way to solve the problem and it is to round once from the infinite precision computation to the desired computation, without any intermediate.</p>
<p>And then there is the warning about catastrophic failing of some libraries if you invoke this 64-bit flag. Does it include the standard mathematics library? It might, right?</p>
<p>As far as I can tell, the only proper fix is the SSE approach. But it is not enabled by default.</p>
</div>
</li>
</ol>
</li>
<li id="comment-532888" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-02T01:50:47+00:00">July 2, 2020 at 1:50 am</time></a> </div>
<div class="comment-content">
<p>Hi, did you find an example where operations with variables of type &lsquo;float&rsquo; suffer from rounding due to performing the operation with data type &lsquo;double&rsquo; before being rounded down to type &lsquo;float&rsquo; again?</p>
<p>One could also look at why -mpcXX is there. Looking at the relevant Intel manuals, one will find notes about the precision control bits. At first glance, it looks like GCC might be simply parroting what the hardware is doing (this is also the argument why the GCC bug you referenced was marked as invalid &#8212; and note the same bug&rsquo;s comments suggest -mpc64 and setting the default path to SSE rather than then x87, as per the GCC documentation). Did you look at the actual Intel manuals on this?</p>
<p>By the way, is the difference noted here within one ulp of the most precise result? Is that within the expected error for the operation in question? Is there an actual bug here? Of course, when exact values are required in compiled binaries, one could always specify the actual floating point value in binary (e.g. with a union).</p>
<p>Regarding the other libraries that might be affected, one would have to read the relevant documentation to see if the libraries one wants to use are compiled (binary libraries) or can be compiled (from sources) to a level of precision that is compatible with one&rsquo;s intent. This is just good practice.</p>
<p>Finally, I am not celebrating this level of complexity&#8230;</p>
</div>
</li>
<li id="comment-532892" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-02T02:17:23+00:00">July 2, 2020 at 2:17 am</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Hi, did you find an example where operations with variables of type ‘float’ suffer from rounding due to performing the operation with data type ‘double’ before being rounded down to type ‘float’ again?</p>
</blockquote>
<p>Well, the compiler is providing us no guarantee, right? How lucky do you feel?</p>
<p>I could investigate, but I have already ruled out this mode of GCC as unacceptable.</p>
<blockquote>
<p>One could also look at why -mpcXX is there. Looking at the relevant Intel manuals, one will find notes about the precision control bits. At first glance, it looks like GCC might be simply parroting what the hardware is doing (this is also the argument why the GCC bug you referenced was marked as invalid — and note the same bug’s comments suggest -mpc64 and setting the default path to SSE rather than then x87, as per the GCC documentation). Did you look at the actual Intel manuals on this?</p>
</blockquote>
<p>I don&rsquo;t think Intel can be blamed.</p>
<p>For example, evidently the compiler is itself, at compile-time, evaluating the expression with full precision. The net result is that if you do &ldquo;double x = value1; double y = value2; if(x/y = value1/value2) ..&rdquo;, the expression will evaluate to false under some optimization levels but not others.</p>
<p>The fact that the expressions evaluate to different values at compile-time than at runtime has nothing to do with Intel.</p>
<blockquote>
<p>By the way, is the difference noted here within one ulp of the most precise result? Is that within the expected error for the operation in question? Is there an actual bug here? Of course, when exact values are required in compiled binaries, one could always specify the actual floating point value in binary (e.g. with a union).</p>
</blockquote>
<p>At compile-time, the evaluation is exact. It is only at runtime that it differs.</p>
<blockquote>
<p>Regarding the other libraries that might be affected, one would have to read the relevant documentation to see if the libraries one wants to use are compiled (binary libraries) or can be compiled (from sources) to a level of precision that is compatible with one’s intent. This is just good practice.</p>
</blockquote>
<p>The GNU math library publishes its ULP constraints, and you have (often) at most 1 ULP as a promise. Unfortunately, I found that this was optimistic: it does not apply when x87 is active&#8230; it can go much higher than stated in the documentation. Now, what happens when you set the rounding to 64, from what we can tell, is likely to be worse.</p>
<p>I have not investigated the matter more, and I do not plan to. It is not a viable platform as far as I am concerned. Not in 2020.</p>
</div>
<ol class="children">
<li id="comment-533185" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-03T17:24:10+00:00">July 3, 2020 at 5:24 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I don’t think Intel can be blamed.
</p></blockquote>
<p>It is an x87 problem, you will not get this on other ISAs. There are other ISAs that also support 80-bit long double, but they have instructions that produce float or double results (for example 68k has fsmul, fdmul).</p>
<blockquote><p>
For example, evidently the compiler is itself, at compile-time,<br/>
evaluating the expression with full precision. The net result is that<br/>
if you do “double x = value1; double y = value2; if(x/y =<br/>
value1/value2) ..”, the expression will evaluate to false under some<br/>
optimization levels but not others.
</p></blockquote>
<p>That can only happen on x87. Floating point expressions will give the same results at compile-time and at run-time by default.</p>
<blockquote><p>
The fact that the expressions evaluate to different values at<br/>
compile-time than at runtime has nothing to do with Intel.
</p></blockquote>
<p>A user can explicitly switch on aggressive FP optimizations, change the rounding mode or use flush-to-zero. This will change the result at runtime, and that is expected. However on x87 results are different even if you don&rsquo;t do any of this. And given all the bug reports, that is not obvious nor expected!</p>
</div>
</li>
</ol>
</li>
<li id="comment-532893" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1da84bfd356090d256d763d91c3e3f0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">zero</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-02T02:25:21+00:00">July 2, 2020 at 2:25 am</time></a> </div>
<div class="comment-content">
<p>(note SSE is enabled by default for 64 bits &#8212; enabling this default for 32 bits now would break conceivably every program that relied on default settings&#8230; not worth that chaos, especially when you can control the behavior with a switch)</p>
</div>
</li>
<li id="comment-533065" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-02T20:34:35+00:00">July 2, 2020 at 8:34 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s worth updating the title &#8211; this is a x86-specific issue. Other ISAs like Arm, Power, MIPS etc do not have this issue &#8211; they fully support IEEE and give consistent answers.</p>
<p>It&rsquo;s well-known among floating point experts that the x87 floating point unit has many serious IEEE conformance issues. Let&rsquo;s ignore the transcendental functions which are not only very slow but also incredibly inaccurate.</p>
<p>Even when switched to the pc32/pc64 modes it is not possible to calculate floating point values correctly. This is because x87 always uses 15 exponent bits (it is still using the 80-bit format internally), so you still get double rounding results. Even more strangely, the value may change when a register is stored to memory &#8211; only then the extra exponent range is reduced to the correct IEEE value!</p>
<p>So if you use a value just computed in a register you may get a different result if it was stored to memory. A compiler may spill variables at any time. You can use the same variable several times from a register but if at some point it is stored/spilled, its value may suddenly change&#8230;</p>
<p>So an expression like (x &gt; y &amp;&amp; x &gt; y) can evaluate to false even if the first x &gt; y is true! Unbelievable, right?</p>
<p>To avoid this you need to use -ffloat-store to force register values to memory so that the extra rounding happens immediately and the value is now consistent. This option slows down x87 floating point code significantly. So you get to choose between fast and inconsistent, or consistently incorrectly rounded and slow&#8230;</p>
<p>In conclusion: if you care about floating point at all, do not ever use x87.</p>
</div>
<ol class="children">
<li id="comment-533073" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-02T20:45:40+00:00">July 2, 2020 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for this informative post Wilco.</p>
</div>
<ol class="children">
<li id="comment-533171" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-03T13:09:36+00:00">July 3, 2020 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re welcome. I learned much of this the hard way&#8230; I had the pleasure of debugging an instruction set simulator which used native floating point instructions to simulate IEEE floating point hardware. It worked fine for the developers (IIRC they used SPARC workstations), but it failed when we ran our IEEE testsuite on Windows. The developers were adamant the simulator was correct since our failing testcases passed on their system.</p>
<p>After some time we convinced them to switch to a software floating point library on x86 since otherwise we couldn&rsquo;t ever trust the simulator to correctly emulate IEEE floating point (you can&rsquo;t test all inputs to be sure). For similar reasons modern compilers use software floating point to evaluate floating point constants.</p>
</div>
<ol class="children">
<li id="comment-533203" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-03T21:27:39+00:00">July 3, 2020 at 9:27 pm</time></a> </div>
<div class="comment-content">
<p>@Wilco</p>
<p>You don&rsquo;t get the same problems by default with LLVM clang on x86. That&rsquo;s what I mean by &ldquo;Intel cannot be blamed&rdquo;.</p>
<p>Can we blame Intel for producing a bad x87 design? Sure. But we are talking about something done in the 1980s&#8230; by people who probably retired a long time ago.</p>
<p>I would rather blame the people today who insists that we must keep on defaulting on x87 because otherwise&#8230; too many things might break.</p>
<p>I don&rsquo;t understand this attitude. When old things are bad, it is you duty to leave them behind and move on.</p>
<p>Compilers should say &ldquo;we no longer support x87, it is shit&rdquo; and be done with it. If people want to keep supporting it, let them add crazy flags to their command lines.</p>
</div>
<ol class="children">
<li id="comment-533271" class="comment even depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-04T12:01:12+00:00">July 4, 2020 at 12:01 pm</time></a> </div>
<div class="comment-content">
<p>Yes I completely agree that the -fpmath default for 32-bit x86 should have been changed years ago in GCC. LLVM uses a different default, but unlike GCC it has no need to be &ldquo;bug compatible&rdquo; with many applications&#8230;</p>
<p>In general GCC maintainers tend to be very conservative. Change is being seen as risky, breaking software or creating unnecessary extra work. I managed to make various improvements to GCC defaults in the last few years, so there <em>is</em> progress, but unfortunately it is slow.</p>
<p>It would be useful to create requests to change the -fpmath default &#8211; if there is enough demand, maybe it will finally happen. Note the x86 backend maintainers (which include Intel employees of course) would have the final say.</p>
</div>
<ol class="children">
<li id="comment-533537" class="comment odd alt depth-6 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/de19d98e75f80bd635602e3926b115ec?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Wilco</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-05T11:24:53+00:00">July 5, 2020 at 11:24 am</time></a> </div>
<div class="comment-content">
<p>Btw you only need -mfpmath=sse, no need for a -msse2 or a -march flag, even for GCC5: <a href="https://godbolt.org/z/T26rRk" rel="nofollow ugc">https://godbolt.org/z/T26rRk</a></p>
</div>
<ol class="children">
<li id="comment-533559" class="comment byuser comment-author-lemire bypostauthor even depth-7">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-07-05T17:18:01+00:00">July 5, 2020 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>@Wilco Please run my docker script.</p>
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
</li>
<li id="comment-602103" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cadd3b79b540cd9f93ef00bdc3980da?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cadd3b79b540cd9f93ef00bdc3980da?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jamie</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-14T01:43:57+00:00">October 14, 2021 at 1:43 am</time></a> </div>
<div class="comment-content">
<p>You can solve this properly with GCC&rsquo;s fpu_control.h as described at:</p>
<p><a href="http://christian-seiler.de/projekte/fpmath/" rel="nofollow ugc">http://christian-seiler.de/projekte/fpmath/</a></p>
<p> #include </p>
<p> fpu_control_t fpu_oldcw, fpu_cw;<br/>
_FPU_GETCW(fpu_oldcw); // store old cw<br/>
fpu_cw = (fpu_oldcw &amp; ~_FPU_EXTENDED &amp; ~_FPU_DOUBLE &amp; ~_FPU_SINGLE) | precision;<br/>
_FPU_SETCW(fpu_cw);<br/>
// calculations here<br/>
_FPU_SETCW(fpu_oldcw); // restore old cw</p>
<p>Precision may be one of:</p>
<p>_FPU_SINGLE<br/>
Single precision<br/>
_FPU_DOUBLE<br/>
Double precision<br/>
_FPU_EXTENDED<br/>
Double-extended precision</p>
</div>
<ol class="children">
<li id="comment-602106" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-10-14T01:54:59+00:00">October 14, 2021 at 1:54 am</time></a> </div>
<div class="comment-content">
<p>Looks like a great comment.</p>
</div>
</li>
</ol>
</li>
<li id="comment-611076" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/47169d4d5e4285868c9e1457dc2a738e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/47169d4d5e4285868c9e1457dc2a738e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/LydiaMarieWilliamson" class="url" rel="ugc external nofollow">Lydia Marie Williamson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-12-13T05:19:48+00:00">December 13, 2021 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>The ALGLIB library ran into similar issues with floating point rouding, early on, and took the easy (but awkward) way out: by defining functions for each of the comparison operators. In my version (over on GitHub under AlgLib_cpp), I removed the functions and put the operators back in, and then made a note of the problem, and its resolution in the manual (Manual.htm, sections 3.1 and 5.5) &#8211; the problem being specific to the Intel FPU and to later processors that include it.</p>
<p>It required setting the FPU up to round to IEEE double floating point (fldcw 0x27f or _FPU_SETCW(0x27f) under GCC using the macro _FPU_SETCW from . It appeared that it was fixed later in GCC, though I don&rsquo;t know which version the repair took place in.</p>
<p>So, in relation to to the issue you brought up, there is some history behind this issue showing that there&rsquo;s been trail and error trying to get the rounding issues resolved.</p>
</div>
</li>
</ol>
