---
date: "2023-01-12 12:00:00"
title: "Care is needed to use C++ std::optional with non-trivial objects"
index: false
---

[16 thoughts on &ldquo;Care is needed to use C++ std::optional with non-trivial objects&rdquo;](/lemire/blog/2023/01-12-care-is-needed-to-use-c-stdoptional-with-non-trivial-objects)

<ol class="comment-list">
<li id="comment-648914" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-13T13:17:16+00:00">January 13, 2023 at 1:17 pm</time></a> </div>
<div class="comment-content">
<p>Most of this seems quite expected, just like what you get with std::tuple or any other abstraction embedding one or several values of type T.</p>
<p>The value_or() issue is avoided by making default construction cheap, which is a good idea in general anyway, and easily achievable for purely &ldquo;data&rdquo; classes (but may not be possible if embedding something like a mutex).</p>
</div>
</li>
<li id="comment-648918" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/076d776a9884a9d3c6a71a5bbc12530a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/076d776a9884a9d3c6a71a5bbc12530a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Malachi</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-13T20:45:20+00:00">January 13, 2023 at 8:45 pm</time></a> </div>
<div class="comment-content">
<p>I agree with your sentiment.</p>
<p>Rule of thumb (for me) is pointer types are nullable and therefore inherently &lsquo;optional&rsquo; &#8211; thus the need for something that specifically isn&rsquo;t a pointer type.</p>
<p>I actually forgot this today, so your blurb is quite timely for me.</p>
</div>
</li>
<li id="comment-648919" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-13T20:55:11+00:00">January 13, 2023 at 8:55 pm</time></a> </div>
<div class="comment-content">
<p>The std::optional template is exactly as efficient or inefficient as any other value type. It works well with objects implementing move-only semantics.</p>
</div>
<ol class="children">
<li id="comment-648940" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T18:09:26+00:00">January 14, 2023 at 6:09 pm</time></a> </div>
<div class="comment-content">
<p><em> It works well with objects implementing move-only semantics.</em></p>
<p>Here is a code sample with such a class:</p>
<pre style="color:#000000;background:#ffffff;">#include <span style="color:#808030; ">&lt;</span>optional<span style="color:#808030; ">></span>

<span style="color:#800000; font-weight:bold; ">struct</span> A <span style="color:#800080; ">{</span>
    A<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">=</span> <span style="color:#800000; font-weight:bold; ">default</span><span style="color:#800080; ">;</span>
    A<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">const</span> A&amp;<span style="color:#808030; ">)</span> <span style="color:#808030; ">=</span> delete<span style="color:#800080; ">;</span>
    A<span style="color:#808030; ">(</span>A&amp;&amp;<span style="color:#808030; ">)</span> <span style="color:#808030; ">=</span> <span style="color:#800000; font-weight:bold; ">default</span><span style="color:#800080; ">;</span>

<span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>


A f<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    A a<span style="color:#800080; ">;</span>
    std<span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>optional<span style="color:#808030; ">&lt;</span>A<span style="color:#808030; ">></span> z<span style="color:#808030; ">(</span>std<span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>move<span style="color:#808030; ">(</span>a<span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    <span style="color:#800000; font-weight:bold; ">return</span> std<span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>move<span style="color:#808030; ">(</span>z<span style="color:#808030; ">.</span>value<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span>
</pre>
<p></p>
</div>
</li>
</ol>
</li>
<li id="comment-648924" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/61860f0168a4e2007eca1d1f2c6e5bee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/61860f0168a4e2007eca1d1f2c6e5bee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">B K</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T01:48:35+00:00">January 14, 2023 at 1:48 am</time></a> </div>
<div class="comment-content">
<p>smart pointers can efficiently accommodate the optional pattern for everything other than primitives and rvalues.</p>
<p>This creates an issue when templating code because neither style is optimal in all cases.</p>
</div>
</li>
<li id="comment-648925" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2cbb1c74f5d815976295e88fda312ef2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2cbb1c74f5d815976295e88fda312ef2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.north-winds.org/" class="url" rel="ugc external nofollow">Loren M. Lang</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T02:03:50+00:00">January 14, 2023 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>Minor nitpick, I think you meant to pass z to f(). Otherwise, good stuff!</p>
</div>
</li>
<li id="comment-648928" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/66f68fd866ee1a19f8763ee5ef1e2621?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/66f68fd866ee1a19f8763ee5ef1e2621?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T07:53:12+00:00">January 14, 2023 at 7:53 am</time></a> </div>
<div class="comment-content">
<p>The 5th case will not make a copy in most use cases (e.g., A a = g(); is guranteed to *not* make a copy). And other comments are right too — there&rsquo;s nothing special about std::optional. You will get the similar behaviour with just std::string or any other value type.</p>
</div>
</li>
<li id="comment-648929" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/abcb63fe3e11c635fa873ba16ba65658?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/abcb63fe3e11c635fa873ba16ba65658?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthäus Brandl</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T09:39:20+00:00">January 14, 2023 at 9:39 am</time></a> </div>
<div class="comment-content">
<p>Several times I have already wished for an emplacing value_or(), i.e., one that accepts ctor arguments and constructs the alternative iff the optional is empty.</p>
<p>Of course one can write that oneself as a free function, but it would be nice to have it in the std::lib.</p>
</div>
</li>
<li id="comment-648936" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e0991d2a842711aabbb19f87bb041565?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e0991d2a842711aabbb19f87bb041565?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bruce Visscher</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T15:25:44+00:00">January 14, 2023 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think this has much to do with optional but more to do with pass by value vs reference. I think most of the superfluous copies could have been avoided but passing const T&amp; vs T.</p>
</div>
</li>
<li id="comment-648937" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/acb455886e7beeb02c28ebd038ef4788?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/acb455886e7beeb02c28ebd038ef4788?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">uh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T16:24:14+00:00">January 14, 2023 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>is there anything specific to optional here&#8230; you&rsquo;d have the same behavior with any type</p>
</div>
</li>
<li id="comment-648938" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/09983a4656dbeadeb67452e2cbe0cba0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/09983a4656dbeadeb67452e2cbe0cba0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T16:30:06+00:00">January 14, 2023 at 4:30 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the code and thoughts.</p>
<p>The line<br/>
return f(a);<br/>
probably should pass &lsquo;z&rsquo; instead of &lsquo;a&rsquo;.</p>
</div>
</li>
<li id="comment-648939" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f16aae08e8bd4259c580e589884c9a35?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f16aae08e8bd4259c580e589884c9a35?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kristof</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-14T17:18:22+00:00">January 14, 2023 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m going to assume that the last example should include <code>f(z)</code></p>
<p>In Rust it is actually really clear what happens. It&rsquo;s a move. No copies involved:</p>
<p>fn f(z: Option&lt;A&gt;) -&amp;gt; A {<br/>
// the use of the lambda avoids constructing the default unless z is None<br/>
return z.unwrap_or_else(|| A::default());<br/>
}</p>
<p>fn g() -&amp;gt; A {<br/>
let a = A::new(&ldquo;message&rdquo;.into());</p>
<p> // move a<br/>
let z = Some(a);</p>
<p> // move z<br/>
return f(z);<br/>
}</p>
<p>fn main() {<br/>
let _ = g();<br/>
}</p>
<p>// no copy / clone<br/>
struct A {<br/>
&#xa0;&#xa0;&#xa0;&#xa0;c: String,<br/>
}</p>
<p>impl Default for A {<br/>
fn default() -&amp;gt; A {<br/>
return A {<br/>
&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;c: &ldquo;default&rdquo;.into()<br/>
};<br/>
}<br/>
}</p>
<p>impl A {<br/>
fn new(s: String) -&amp;gt; A {<br/>
A {<br/>
&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;&#xa0;c: s<br/>
}<br/>
}<br/>
}</p>
<p></p>
</div>
</li>
<li id="comment-648964" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ace5de8c10a087499c08247011719681?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ace5de8c10a087499c08247011719681?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jonny Grant</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-16T15:49:45+00:00">January 16, 2023 at 3:49 pm</time></a> </div>
<div class="comment-content">
<p>Useful article. Would be interesting to see the assembly output if you put on godbolt, with optimization. Then can see how many copies are really made.</p>
</div>
</li>
<li id="comment-650091" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4bf627541889797f751f22958ce43bc5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4bf627541889797f751f22958ce43bc5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://naijaspider.com" class="url" rel="ugc external nofollow">Brian</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-05T12:43:14+00:00">April 5, 2023 at 12:43 pm</time></a> </div>
<div class="comment-content">
<p>Scary how the potentials of Artificial Intelligence can shape our lives</p>
</div>
</li>
<li id="comment-651797" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d8b0bcb8e36ccdbf55632d7d1c388fe4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d8b0bcb8e36ccdbf55632d7d1c388fe4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lookup.ng" class="url" rel="ugc external nofollow">Nelson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-22T20:27:33+00:00">May 22, 2023 at 8:27 pm</time></a> </div>
<div class="comment-content">
<p>The way the function returns the value is actually very clever f(z).</p>
</div>
</li>
<li id="comment-653315" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e024562a686dd08933fe1843c228f07c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e024562a686dd08933fe1843c228f07c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://rozmusic.com/" class="url" rel="ugc external nofollow">rozmusic</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-29T15:40:11+00:00">July 29, 2023 at 3:40 pm</time></a> </div>
<div class="comment-content">
<p>nice job thank you</p>
</div>
</li>
</ol>
