---
date: "2021-03-04 12:00:00"
title: "How does your programming language handle &#8220;minus zero&#8221; (-0.0)?"
index: false
---

[22 thoughts on &ldquo;How does your programming language handle &#8220;minus zero&#8221; (-0.0)?&rdquo;](/lemire/blog/2021/03-04-how-does-your-programming-language-handle-minus-zero-0-0)

<ol class="comment-list">
<li id="comment-578205" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f8f706c3938feec43d1f111ad3c0a047?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f8f706c3938feec43d1f111ad3c0a047?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Bruce</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T00:02:22+00:00">March 5, 2021 at 12:02 am</time></a> </div>
<div class="comment-content">
<p>FWIW Rust also produces what you would expect:</p>
<p><code>fn main() {<br/>
let minus_zero = -0.0;<br/>
let plus_zero = 0.0;<br/>
let parsed = "-0.0".parse::&lt;f64&gt;().unwrap();<br/>
println!("{}", 1.0/minus_zero);<br/>
println!("{}", 1.0/plus_zero);<br/>
println!("{}", 1.0/parsed);<br/>
}<br/>
</code></p>
<p>Output:</p>
<p><code>-inf<br/>
inf<br/>
-inf<br/>
</code></p>
</div>
</li>
<li id="comment-578243" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T04:44:07+00:00">March 5, 2021 at 4:44 am</time></a> </div>
<div class="comment-content">
<p>Related: <a href="https://github.com/golang/go/issues/19675" rel="nofollow ugc">https://github.com/golang/go/issues/19675</a>.</p>
<p>Try instead</p>
<p>minus_zero := 0.0<br/>
minus_zero *= -1</p>
</div>
</li>
<li id="comment-578312" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6559873857eb1824652d27f71e9992c3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6559873857eb1824652d27f71e9992c3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kali</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T12:07:56+00:00">March 5, 2021 at 12:07 pm</time></a> </div>
<div class="comment-content">
<p>JavaScript:</p>
<p><code>const plusZero = 0;<br/>
const minusZero = -0;<br/>
const parsedMinus = parseInt("-0");<br/>
console.log({<br/>
minusZero: 1/minusZero, // -Infinity<br/>
plusZero: 1/plusZero, // Infinity<br/>
parsedMinus: 1/parsedMinus // -Infinity<br/>
});<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-578343" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/af265b184afec6dd4a627f4160b98fc1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/af265b184afec6dd4a627f4160b98fc1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">William</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T14:16:33+00:00">March 5, 2021 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>let parsedMinus = parseFloat(&ldquo;-0.0&rdquo;)<br/>
console.log(1/parsedMinus) // -Infinity</p>
</div>
</li>
</ol>
</li>
<li id="comment-578350" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skanthak.homepage.t-online.de/index.html" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T14:39:38+00:00">March 5, 2021 at 2:39 pm</time></a> </div>
<div class="comment-content">
<p>Depending on the compiler and the optimisation option used, your test program measures compile time or runtime behaviour &#8212; which can but differ.<br/>
For C and C++, you should but declare the doubles as volatile and feed a volatile char xxx[] = &ldquo;-0.0&rdquo;; to strtod()</p>
</div>
<ol class="children">
<li id="comment-578358" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T15:20:56+00:00">March 5, 2021 at 3:20 pm</time></a> </div>
<div class="comment-content">
<p>Are you aware of a compiler where the result of strtod would be computed at compile time?</p>
<p>Specifically, a compiler where the following function would become trivial&#8230;</p>
<pre><code>bool touch() {
    return strtod("-0.0", nullptr) == 0;
}
</code></pre>
<p>I&rsquo;d be very interested in knowing about such a system.</p>
</div>
<ol class="children">
<li id="comment-578477" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9fb56b5f9e8fbd89570fe54ed991d307?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Kanthak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-06T06:17:01+00:00">March 6, 2021 at 6:17 am</time></a> </div>
<div class="comment-content">
<p>Evaluation of the expression strtod(<em>constant</em>, NULL) during compile time is a legitimate optimisation any C/C++ compiler is allowed to perform. There are C/C++ compilers which evaluate for example signbit(<em>constant</em>), log(<em>constant</em>), strlen(<em>constant</em>) or strcmp(<em>constant</em>, <em>constant</em>) etc., so why shouldn&rsquo;t they not (be able to) evaluate strtod(<em>constant</em>, NULL) or strtol(<em>constant</em>, NULL, 0) too? The compiler already has the parser for the numbers, these library functions are part of the language and their semantics well-defined! Unless you can prove or safely assume that no compiler will ever optimize these expressions it&rsquo;s better to exercise defensive programming.</p>
</div>
<ol class="children">
<li id="comment-578542" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-06T16:17:04+00:00">March 6, 2021 at 4:17 pm</time></a> </div>
<div class="comment-content">
<p>I do not doubt that in all the examples provided in my blog post, an optimizing compiler is allowed to just memoize the output. Of course, it should ensure that the result is undistinguishable from what would happen if you were to run it without optimization. But I have never observe an optimizing compiler that would optimize away strtod and I&rsquo;d be very interested in knowing about such a scenario.</p>
<p>More to the point of your reply&#8230; Is your expectation that by marking the string as volatile, thus precluding some optimizations, we will get different results ?</p>
</div>
<ol class="children">
<li id="comment-578714" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skanthak.homepage.t-online.de/gcc.html" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-07T17:20:16+00:00">March 7, 2021 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>I still remember your blog post <a href="https://lemire.me/blog/2020/06/26/gcc-not-nearest/" rel="ugc">https://lemire.me/blog/2020/06/26/gcc-not-nearest/</a></p>
<p>The interpretation of floating point numbers during compile time may differ from run-time.<br/>
I just fed the following snippet to the (ancient) GCC on your EPYC system &ldquo;Rome&rdquo; and to LLVM 10.0:</p>
<p><code>int main()<br/>
{<br/>
double minus_0 = -0.0;<br/>
double plus_0 = +0.0;<br/>
return 1.0/minus_0 == 1.0/plus_0;<br/>
}<br/>
</code></p>
<p>gcc -O3 -o- -s demo.c</p>
<p><code>main:<br/>
movsd .LC0(%rip), %xmm0<br/>
xorl %eax, %eax<br/>
movl $0, %edx<br/>
movapd %xmm0, %xmm1<br/>
divsd .LC2(%rip), %xmm0<br/>
divsd .LC1(%rip), %xmm1<br/>
ucomisd %xmm0, %xmm1<br/>
setnp %al<br/>
cmovne %edx, %eax<br/>
ret<br/>
.align 8<br/>
</code></p>
<p>.LC0:<br/>
.long 0<br/>
.long 1072693248<br/>
.align 8<br/>
.LC1:<br/>
.long 0<br/>
.long -2147483648<br/>
.align 8<br/>
.LC2:<br/>
.long 0<br/>
.long 0<br/>
.ident &ldquo;GCC: (GNU) 8.3.1 20190311 (Red Hat 8.3.1-3)&rdquo;</p>
<p>clang -O3 -o- -s demo.c</p>
<p><code>main: # @main<br/>
xorl %eax, %eax<br/>
retq<br/>
.ident "AMD clang version 10.0.0 (CLANG: AOCC_2.2.0-Build#93 2020_06_25) (based on LLVM Mirror.Version.10.0.0)"<br/>
</code></p>
<p>You see the difference?</p>
</div>
</li>
<li id="comment-578719" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skanthak.homepage.t-online.de/llvm.html" class="url" rel="ugc external nofollow">Stefan Kanthak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-07T18:59:02+00:00">March 7, 2021 at 6:59 pm</time></a> </div>
<div class="comment-content">
<p>To answer both of your questions:<br/>
1. no, I don&rsquo;t know a compiler which optimises strtod(&ldquo;-0-0&rdquo;, 0) and evaluates it at compile time (but some which optimise strcmp(<em>constant</em>, <em>constant</em>) for example);<br/>
2. I expect that a volatile char zero[] = &ldquo;-0.0&rdquo;; strtod(zero, 0); should disable that optimisation &#8212; both GCC and clang but bail out with a warning &ldquo;passing &lsquo;volatile char *&rsquo; to parameter of type &lsquo;const char *&rsquo; discards qualifiers&rdquo;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-578621" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e995c87efda15ec425e73eb253c94786?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e995c87efda15ec425e73eb253c94786?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://accidental.cc" class="url" rel="ugc external nofollow">Jon Raphaelson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-07T03:46:22+00:00">March 7, 2021 at 3:46 am</time></a> </div>
<div class="comment-content">
<p>Zig has a &ldquo;comptime&rdquo; environment, wherein code is evaluated at compile time; <a href="https://ziglang.org/documentation/master/#comptime" rel="nofollow ugc">https://ziglang.org/documentation/master/#comptime</a></p>
</div>
<ol class="children">
<li id="comment-578997" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b3070ad3bb35d6e518f2dd2ba96c55c9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan Kanthak</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-08T23:48:03+00:00">March 8, 2021 at 11:48 pm</time></a> </div>
<div class="comment-content">
<p>AFAIK the D language/compiler sports a similar feature and allows to evaluate code during compilation.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-578357" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2a72387978c90deefe39de8094b02bae?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2a72387978c90deefe39de8094b02bae?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andreas Davour</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T15:10:05+00:00">March 5, 2021 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>fn main() {<br/>
let minus = -0.0;<br/>
let plus = 0.0;</p>
<p><code>println!("{}", 1.0/minus);<br/>
println!("{}", 1.0/plus);<br/>
</code></p>
<p>}</p>
<p>$ rustc minus.rs<br/>
$ ./minus<br/>
-inf<br/>
inf</p>
</div>
</li>
<li id="comment-578371" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2de5370ae7d40b03f4cfa3be812b724e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2de5370ae7d40b03f4cfa3be812b724e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arun</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T16:35:55+00:00">March 5, 2021 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>Same behaviour with D as well.</p>
<p><code>void main() {<br/>
import std.stdio, std.conv;<br/>
double minus_zero = -0.0;<br/>
double plus_zero = +0.0;<br/>
double parsed = to!double("-0.0");</p>
<p> writeln(1/minus_zero);<br/>
writeln(1/plus_zero);<br/>
writeln(1/parsed);<br/>
}</p>
<p>$ ldc2 a.d<br/>
$ ./a<br/>
-inf<br/>
inf<br/>
-inf<br/>
$<br/>
</code></p>
</div>
</li>
<li id="comment-578378" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T17:39:31+00:00">March 5, 2021 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>Related to <a href="https://github.com/golang/go/issues/30951" rel="nofollow ugc">https://github.com/golang/go/issues/30951</a> : I assume in most programming languages the equivalent of &ldquo;double x = -0&rdquo; is the same as &ldquo;double x = 0&rdquo;. Meaning: -0 is interpreted as an integer (and, so, 0, as there is no negative 0 integer), which is then converted to a double.</p>
</div>
<ol class="children">
<li id="comment-578419" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T22:22:49+00:00">March 5, 2021 at 10:22 pm</time></a> </div>
<div class="comment-content">
<p>Yes, but from what I can see, they will opt to at least warn you.</p>
</div>
</li>
</ol>
</li>
<li id="comment-578423" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/657785b06699b2cd27bd03ae30858105?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marshall Ward</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T22:50:18+00:00">March 5, 2021 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>Negative zeros are one of the issues that we have to handle in our bit reproducibility tests. When we are unable to justify a sign, we will do something like <code>x = x + 0.0</code> which converts -0.0 into +0.0. And I think that this is the correct behavior via IEEE754. But I also don&rsquo;t know if we can count on all platforms to do this.</p>
</div>
</li>
<li id="comment-578428" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b1fc58a9a6a2b7db314e50dea3862859?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b1fc58a9a6a2b7db314e50dea3862859?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ajdude</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T23:22:57+00:00">March 5, 2021 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>I just tried it in Ada.</p>
<p><code>with Ada.Float_Text_IO;<br/>
use Ada.Float_Text_IO;</p>
<p>procedure Main is<br/>
minus_zero : Float := -0.0;<br/>
plus_zero : Float := +0.0;<br/>
parsed : Float := Float'Value("-0.0");<br/>
begin<br/>
Put(1.0/minus_zero);<br/>
Put(1.0/plus_zero);<br/>
Put(1.0/parsed);<br/>
end Main;<br/>
</code></p>
<p>Gave me &ldquo;-Inf&rdquo;, &ldquo;+Inf&rdquo;, &ldquo;-Inf&rdquo;</p>
</div>
</li>
<li id="comment-578461" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f4cc9813216cb9bf862752f55bb4b071?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f4cc9813216cb9bf862752f55bb4b071?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">amos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-06T03:40:55+00:00">March 6, 2021 at 3:40 am</time></a> </div>
<div class="comment-content">
<p>Someone needs to send this to the team working on Apple’s iPhone Weather App</p>
</div>
</li>
<li id="comment-578510" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8d53ccd486e412217e5a2f94222bc940?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8d53ccd486e412217e5a2f94222bc940?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Serinx</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-06T11:22:09+00:00">March 6, 2021 at 11:22 am</time></a> </div>
<div class="comment-content">
<p>Zero in math is kind of dumb. 1/0 should equal 1. Zero is null or nill or no thing.</p>
</div>
</li>
<li id="comment-578553" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/50556260b230849a933a9826f125f737?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/50556260b230849a933a9826f125f737?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sitwon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-06T17:59:18+00:00">March 6, 2021 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>Isn&rsquo;t division by zero undefined? I would expect the result to be NaN, if not an error.</p>
</div>
<ol class="children">
<li id="comment-578554" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-06T18:10:32+00:00">March 6, 2021 at 6:10 pm</time></a> </div>
<div class="comment-content">
<p><em>Isn’t division by zero undefined? </em></p>
<p>It is in the sense that it is not part of the real numbers, but here we are defining an extended set which includes -infinity and +infinity.</p>
<p>Whether that&rsquo;s wise to do so is another story.</p>
</div>
</li>
</ol>
</li>
</ol>
