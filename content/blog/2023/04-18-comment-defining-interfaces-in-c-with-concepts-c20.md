---
date: "2023-04-18 12:00:00"
title: "Defining interfaces in C++ with &#8216;concepts&#8217; (C++20)"
index: false
---

[18 thoughts on &ldquo;Defining interfaces in C++ with &#8216;concepts&#8217; (C++20)&rdquo;](/lemire/blog/2023/04-18-defining-interfaces-in-c-with-concepts-c20)

<ol class="comment-list">
<li id="comment-651044" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e214f5c143b40458c473bef6ee05823e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Martin Cohen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T13:26:50+00:00">April 19, 2023 at 1:26 pm</time></a> </div>
<div class="comment-content">
<p>There are a couple of weird grammatical errors in this post, including the very first sentence. Makes me wonder how it was written.</p>
</div>
<ol class="children">
<li id="comment-651052" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T16:05:57+00:00">April 19, 2023 at 4:05 pm</time></a> </div>
<div class="comment-content">
<p>I am sorry Martin for the poor grammar.</p>
</div>
<ol class="children">
<li id="comment-651073" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5f69f9560b84b64a0119c0b89b2a45f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5f69f9560b84b64a0119c0b89b2a45f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Someone</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T21:29:44+00:00">April 19, 2023 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>At least, we know it wasn&rsquo;t chatGPT 😏</p>
</div>
<ol class="children">
<li id="comment-651083" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T00:51:04+00:00">April 20, 2023 at 12:51 am</time></a> </div>
<div class="comment-content">
<p>All my future blog post will be written by ChatGPT. I promise.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651301" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4d8319da54968ab6d01272f0b8ed09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4d8319da54968ab6d01272f0b8ed09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lucio Zanette</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-25T10:27:54+00:00">April 25, 2023 at 10:27 am</time></a> </div>
<div class="comment-content">
<p>For those who perhaps use English as a second line, the article is very well written. I&rsquo;m a brazilian and could read without any problems. The goal is to be able to communicate.<br/>
<em>And between us, I still haven&rsquo;t found the error in the very first line.</em></p>
</div>
</li>
</ol>
</li>
<li id="comment-651046" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc137a2e4e62cf76ff901d3637b32367?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc137a2e4e62cf76ff901d3637b32367?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Shin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T14:06:53+00:00">April 19, 2023 at 2:06 pm</time></a> </div>
<div class="comment-content">
<p>C++ concepts fill a need in the language, and I am happy they have finally arrived. However, in my opinion, the execution was not great. I would have preferred something that minimizes the syntax-delta between a concept definition and a class that implements that concept. Java&rsquo;s interface is superior by this measure.</p>
<p>To illustrate, suppose I want to express a concept for a class that has a const foo() method that accepts a non-const int reference as a parameter. How do I do this? It would be great if I could simply do:</p>
<p><code>// hypothetical concepts syntax<br/>
concept MyConcept {<br/>
void foo(int&amp;) const;<br/>
};<br/>
</code></p>
<p>Instead the simplest way that I am aware of to express this concept looks like this:</p>
<p><code>template&lt;typename T&gt;<br/>
concept MyConceptRefOrNonRef = requires(const T t) {<br/>
t.foo(int{});<br/>
};</p>
<p>template&lt;typename T&gt;<br/>
concept MyConceptRefOnly = requires(const T t, int i) {<br/>
t.foo(i);<br/>
};</p>
<p>template &lt;typename T&gt;<br/>
concept MyConcept = MyConceptRefOnly&lt;T&gt; &amp;&amp; !MyConceptRefOrNonRef&lt;T&gt;;<br/>
</code></p>
<p>Hardly intuitive!</p>
<p>This shows how cumbersome it is to write your own concepts to specify exactly what you want. Furthermore, as you point out in your last paragraph, the purpose of concepts is to serve as documentation. The fact that so many lines are needed to express such a simple constraint indicates that the syntax is not well optimized for its purpose.</p>
</div>
<ol class="children">
<li id="comment-651050" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T15:45:01+00:00">April 19, 2023 at 3:45 pm</time></a> </div>
<div class="comment-content">
<p>The following looks reasonable to me:</p>
<pre>
<span style="color:#800000; font-weight:bold; ">template</span><span style="color:#800080; ">&lt;</span><span style="color:#800000; font-weight:bold; ">typename</span> T<span style="color:#800080; ">></span>
concept eatable <span style="color:#808030; ">=</span> requires<span style="color:#808030; ">(</span>T v<span style="color:#808030; ">,</span> <span style="color:#800000; font-weight:bold; ">int</span> i<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span> 
    <span style="color:#800080; ">{</span>  v<span style="color:#808030; ">.</span>eat<span style="color:#808030; ">(</span>i<span style="color:#808030; ">)</span> <span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span> <span style="color:#808030; ">&amp;</span><span style="color:#808030; ">&amp;</span> <span style="color:#808030; ">!</span>requires<span style="color:#808030; ">(</span>T v<span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    <span style="color:#800080; ">{</span>  v<span style="color:#808030; ">.</span>eat<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">int</span><span style="color:#800080; ">{</span><span style="color:#800080; ">}</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>
<span style="color:#800080; ">}</span><span style="color:#800080; ">;</span>

</pre>
</div>
<ol class="children">
<li id="comment-651062" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc137a2e4e62cf76ff901d3637b32367?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc137a2e4e62cf76ff901d3637b32367?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Shin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T18:51:46+00:00">April 19, 2023 at 6:51 pm</time></a> </div>
<div class="comment-content">
<p>That is more concise, but it is essentially the same as my solution. Mine tries to provide more clarity my naming the two sub-concepts according to their purpose, but without that sub-naming, simplifies to yours.</p>
<p>If you add more similarly-constrained parameters to the method, or add more similarly-constrained methods to the class, the concept definition becomes quite unwieldy, compared to the equivalent Java interface definition.</p>
</div>
<ol class="children">
<li id="comment-651063" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T19:07:10+00:00">April 19, 2023 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>If you want to stipulate exactly the signature in C++, you can use (multiple) inheritance. Note that there is no canonical way to solve your problem in Java&#8230; e.g., for a class that has a const foo() method that accepts a non-const int reference as a parameter.</p>
</div>
<ol class="children">
<li id="comment-651071" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc137a2e4e62cf76ff901d3637b32367?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc137a2e4e62cf76ff901d3637b32367?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Shin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T20:58:55+00:00">April 19, 2023 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>Yes, inheritance (along with a static_assert with std::derived_from or similar) does provide a way to statically declare requirements of a template class parameter. This does have some shortcomings, like if you want to declare static methods or impose requirements on inner classes. Besides such shortcomings, I dislike this usage of inheritance, as it gives the false impression to the reader of the code that there is dynamic dispatch going on.</p>
<p>To give a motivating real-world example where I expect concepts to come into play: suppose I want to write my own version of std::vector, which similarly takes an Alloc class template parameter. I want to declare a concept for this Alloc class to match std::vector&rsquo;s. As I&rsquo;m writing my code, I want my IDE to show me all member variables/functions that are guaranteed to exist for this Alloc class. I also want my compiler to complain to me if I make any illegal assumptions about this class, even if they happen to be valid for the particular class instantiation that I happen to be using. Theoretically, concepts should be the right tool for this job. Practically, it&rsquo;s so difficult to express the requirements of the Alloc template class parameter in the language of C++20 concepts, that to my knowledge nobody has done it. Multiple inheritance won&rsquo;t help express requirements like Alloc::rebind.</p>
<p>I agree that the Java-interface analogy only goes so far. To be more correct, I should invoke some of the C++0x concepts proposals &#8211; there were approaches here that were closer to what I wish for, which I believe would have made defining the Alloc concept more feasible.</p>
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
<li id="comment-651060" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-19T18:42:07+00:00">April 19, 2023 at 6:42 pm</time></a> </div>
<div class="comment-content">
<p>Concepts are rather more powerful than suggested.</p>
<p>E.g., you can overload on concept matching, so you might have different template implementations according to what facilities the types offer.</p>
<p>You can also use a &ldquo;requires&rdquo; clause as a predicate to try out if an expression is defined, avoiding dreaded &ldquo;template metaprogramming&rdquo;.</p>
</div>
</li>
<li id="comment-651098" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c38999ade29a05b0750a21bf2ec4f33d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c38999ade29a05b0750a21bf2ec4f33d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Creswell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T06:48:04+00:00">April 20, 2023 at 6:48 am</time></a> </div>
<div class="comment-content">
<p>Why not just inherit from a superclass with pure virtual functions? What are the limitations of inheritance that concepts solve?</p>
</div>
<ol class="children">
<li id="comment-651135" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T20:21:45+00:00">April 20, 2023 at 8:21 pm</time></a> </div>
<div class="comment-content">
<p>Virtual functions are a runtime-choice phenomenon. Template work all happens at compile time. Functions in templates and lambdas get merged together inline and optimized for the particular call site, eliminating abstraction overhead. Templates that match differently can involve completely different types and interfaces: see std::visit applied to std::variant.</p>
<p>A good program uses inheritance sparingly, and virtual functions moreso. There are certainly places for them, but they arise rarely. (It was deeply silly for Java to make them the default.) In particular, virtual functions are inherently an implementation detail, so a class with public virtual functions is one that is not doing much, if any, abstraction work. It is OK to use them just as mechanism, as a sort of structured function pointer, so not providing abstraction is no sin if the purpose is clear.</p>
<p>But the heavy lifting should happen at compile time, in templates where types are all known and bugs are exposed before testing starts.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651120" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/112372fd2861832a8b4aecfe67f464a0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/112372fd2861832a8b4aecfe67f464a0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Bianca Jones</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T15:48:51+00:00">April 20, 2023 at 3:48 pm</time></a> </div>
<div class="comment-content">
<p>As more and more complexity is added to C++, me and my team (writing code in industry) find ourselves moving back toward code that resembles plain old C.</p>
<p>We can&rsquo;t afford to spend minutes, hours, or even days wrangling all of these new C++ features, assuming we even find the time to properly learn them in the first place.</p>
<p>While we don&rsquo;t like giving up classes, objects, RAII, exceptions, and the other benefits that the core of C++ can bring, at least C is something that everybody on the team can understand to a suitable level.</p>
<p>And, no, we will never begin using Rust. Rust makes complex C++ look appealing.</p>
</div>
<ol class="children">
<li id="comment-651124" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T16:52:55+00:00">April 20, 2023 at 4:52 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Bianca. I should stress that I like C. When I write about new C++ features, it is not as a way to pressure people into using them. There is nothing wrong with using very basic C++, or just C.</p>
</div>
</li>
<li id="comment-651136" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/335f4863ad3e7c521d63e242ab2886e0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nathan Myers</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-20T20:24:54+00:00">April 20, 2023 at 8:24 pm</time></a> </div>
<div class="comment-content">
<p>If your needs are limited, C is often good enough. Likewise Python, or JS.</p>
<p>Nobody criticizes you for using a shovel except where a backhoe would have been the smarter choice.</p>
</div>
</li>
<li id="comment-651328" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b4dc151858ab82b3848def78e48b7c58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b4dc151858ab82b3848def78e48b7c58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Simion J</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-26T07:39:32+00:00">April 26, 2023 at 7:39 am</time></a> </div>
<div class="comment-content">
<p>You talking about C11 or C99 as base for your team? And what about compiler choices? 🙂<br/>
Thanks</p>
</div>
</li>
</ol>
</li>
<li id="comment-651302" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c4d8319da54968ab6d01272f0b8ed09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c4d8319da54968ab6d01272f0b8ed09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lucio Zanette</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-04-25T10:30:39+00:00">April 25, 2023 at 10:30 am</time></a> </div>
<div class="comment-content">
<p>Second language*<br/>
The grammar checker got me!</p>
</div>
</li>
</ol>
