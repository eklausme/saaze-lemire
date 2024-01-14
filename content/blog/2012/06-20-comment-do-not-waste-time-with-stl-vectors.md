---
date: "2012-06-20 12:00:00"
title: "Do not waste time with STL vectors"
index: false
---

[46 thoughts on &ldquo;Do not waste time with STL vectors&rdquo;](/lemire/blog/2012/06-20-do-not-waste-time-with-stl-vectors)

<ol class="comment-list">
<li id="comment-55318" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b019611ef2fedb8e4ab89349c5c12c18?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b019611ef2fedb8e4ab89349c5c12c18?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.tableau.com/" class="url" rel="ugc external nofollow">Robert Morton</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-20T14:46:15+00:00">June 20, 2012 at 2:46 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
Thanks for this post, this is good timing for a project I&rsquo;m working on. If you intend to investigate this kind of topic in more depth, I&rsquo;d love to see some analysis of using vector&lt;vector&gt; for 2-d arrays of raw data. In particular I&rsquo;m trying to understand how this representation affects memory locality, and how I can optimally allocate and traverse column-major blocks of data retrieved from a 3rd-party. The goal is to produce typed data values from the raw bytes of each column. Since each column may have a very different data type, the memory access stride will change when finishing one column and moving to the next, so this already impacts the hardware prefetcher. Are things made worse by the fact that each column may be allocated in very different locations of memory? Last, I have a separate 2-d array of per-cell status indicators, so this compounds the locality challenge.</p>
<p>Thanks for maintaining this blog, I&rsquo;ve found it very useful.<br/>
-Robert</p>
</div>
</li>
<li id="comment-55319" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/571df3c3b8615b1cfc2e96171770ccc4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/571df3c3b8615b1cfc2e96171770ccc4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">mars</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-20T14:49:04+00:00">June 20, 2012 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>In your code, yhy is the following not safe?</p>
<p>int runtestnoalloc(size_t N, int * bigarray) {<br/>
for(unsigned int k = 0; k&lt;N; ++k)<br/>
bigarray[k] = k;// unsafe</p>
<p> int sum = 0;<br/>
for(unsigned int k = 0; k&lt;N; ++k)<br/>
sum += bigarray[k];</p>
<p> return sum;<br/>
}</p>
<p>The bigarray is never out of scope so shouldn&#039;t it be fine? Is it because bigarray[k] can overwrite something in the memory?</p>
</div>
</li>
<li id="comment-55320" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-20T14:57:53+00:00">June 20, 2012 at 2:57 pm</time></a> </div>
<div class="comment-content">
<p>@mars</p>
<p>It is perfectly safe in this instance, but playing with pointers can lead to segmentation faults. How do you know that whoever called this function has allocated enough memory?</p>
<p>Using STL containers is safer because you can check.</p>
</div>
</li>
<li id="comment-55321" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9401202ab73e624cc82800b0fff1489?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9401202ab73e624cc82800b0fff1489?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Konrad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-20T15:46:46+00:00">June 20, 2012 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>If you really need the raw speed during construction, there&rsquo;s another variant, which I&rsquo;ve just sent you via a pull request on GitHub.</p>
<p>The salient part is construction of the vector via a pair of iterators. But we don&rsquo;t actually construct the range of values in memory (that would just shift the initialisation problem elsewhere), we use a special iterator type â€œiotaâ€ which generates the values on the fly. Creating this iterator incurs a bit of boilerplate code but it&rsquo;s a general-purpose class that can easily be recycled.</p>
<p>This isÂ â€œgood C++â€ because it uses high-level algorithmic building blocks rather than manual memory management or UB hacks, and furthermore increases the abstraction of the initialisation code (making the loop obsolete).</p>
<p>Interestingly, this variant is *even faster* than the fastest other code (which is illegal C++ anyway and can&rsquo;t really be counted) when compiled with optimisation level 3, and it&rsquo;s on par with the other methods when compiled with O2.</p>
</div>
</li>
<li id="comment-55322" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">srean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-20T16:53:00+00:00">June 20, 2012 at 4:53 pm</time></a> </div>
<div class="comment-content">
<p>Was this for g++ ? I would have expected the call to push_back() to be inlined away.</p>
<p>May be the compiler needs to be strongly persuaded.</p>
</div>
<ol class="children">
<li id="comment-295516" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-24T02:43:38+00:00">January 24, 2018 at 2:43 am</time></a> </div>
<div class="comment-content">
<p>push_back will certainly be &ldquo;inlined&rdquo; with most optimization settings but not &ldquo;inlined away&rdquo; &#8211; the substance of the call, including the size check and fallback path will remain, which accounts for the slowness. </p>
<p>Vector is definitely not a zero cost abstraction, especially if you use it size-dynamically eg using push_back. It&rsquo;s just too hard for the compiler to optimize away the size checks, and this also inhibits vectorization and other optimizations (you can get even worse results than those reported here in real world cases).</p>
</div>
</li>
</ol>
</li>
<li id="comment-55323" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-20T17:45:51+00:00">June 20, 2012 at 5:45 pm</time></a> </div>
<div class="comment-content">
<p>@srean</p>
<p>I post the code so that you can run your own checks: </p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvector.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvector.cpp</a></p>
<p>There is a significant cost to using push_back.</p>
</div>
</li>
<li id="comment-55324" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">srean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-21T00:31:42+00:00">June 21, 2012 at 12:31 am</time></a> </div>
<div class="comment-content">
<p>Ah ! I missed the comment on the first line about g++ and opt flags, hence my question</p>
<p> I hear icc is very good at inlining away such overhead. However I dont have acess to it.</p>
</div>
</li>
<li id="comment-55325" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9401202ab73e624cc82800b0fff1489?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9401202ab73e624cc82800b0fff1489?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Konrad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-21T04:03:57+00:00">June 21, 2012 at 4:03 am</time></a> </div>
<div class="comment-content">
<p>@srean Even without looking at the assembly I&rsquo;m all but *certain* that the `push_back` call is inlined â€“Â this is a trivial optimisation for g++ and the standard library was *designed* with this optimisation in mind. The cost you see here is not the cost of the call, it&rsquo;s the cost of the bounds check (`push_back` needs to check whether the internal buffer needs to be resized, even if we reserved memory beforehand). Otherwise `push_back` and the `[]` method would be on par â€“ after all, the latter also implies a call. But it doesn&rsquo;t have the overhead of the bounds check so we can infer that the time difference between these two methods is entirely explained by said bounds check.</p>
<p>One word about the iterator method I posted above: I made an interesting mistake: the iterator should have been defined as a random access iterator. That way, the vector constructor of the libstdc++ implementation will pre-allocate an internal buffer of exactly the right size. My iterator implementation fails to provide this information. The mistake is interesting because g++ obviously pre-allocates the memory *anyway* â€“Â otherwise the runtime we observe would be impossible. This showcases how incredibly powerful the optimiser is â€“ it infers the missing information about the required buffer size itself.</p>
<p>In fact, correcting the mistake and implementing the iterator as a random access iterator doesn&rsquo;t change the performance â€“Â conclusive proof that the compiler does the optimisation discussed above.</p>
</div>
</li>
<li id="comment-55326" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">srean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-21T05:27:08+00:00">June 21, 2012 at 5:27 am</time></a> </div>
<div class="comment-content">
<p>@Konrad Oh! I had totally forgotten about bounds checking. Yes now it makes sense.</p>
</div>
</li>
<li id="comment-55327" class="comment byuser comment-author-lemire bypostauthor even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-21T10:51:31+00:00">June 21, 2012 at 10:51 am</time></a> </div>
<div class="comment-content">
<p>@srean</p>
<p>It is entirely possible that another compiler could optimize away the overhead of the push_back. Even so, if you really need speed, you can&rsquo;t just hope for the best. I recommend you use push_backs sparingly in performance sensitive code.</p>
<p>(I should stress that this is for vectors of integers. You might get vastly different results for vectors of objects.)</p>
</div>
</li>
<li id="comment-55328" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ffafaa329699027aaa43807092df3759?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">srean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-22T21:38:12+00:00">June 22, 2012 at 9:38 pm</time></a> </div>
<div class="comment-content">
<p>Sure. </p>
<p>In case I gave another impression, my point was never to argue against your recommendation, but to understand what exactly is the reason behind the slowdown and how can compilers mitigate it and if not why not. Konrad&rsquo;s comments was very illuminating in that respect.</p>
<p>I think even with vectors of objects, push_back will be slower than directly mutating the contents of a valid location in the vector.</p>
</div>
</li>
<li id="comment-55331" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-25T10:42:12+00:00">June 25, 2012 at 10:42 am</time></a> </div>
<div class="comment-content">
<p>meh, tbh this kind of data is almost useless for me because I rarely spend my time filling vectors. I spend time reading them, so comparison of 2dvector and hackish 2d vector that is implemented as 1d vector would be more interesting. </p>
<p>Also you should have mentioned std::move and how it makes STL faster in C++11.</p>
</div>
</li>
<li id="comment-55332" class="comment byuser comment-author-lemire bypostauthor odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-25T10:53:25+00:00">June 25, 2012 at 10:53 am</time></a> </div>
<div class="comment-content">
<p>@Ivan</p>
<p>You think that std::move would make things faster in this particular case?</p>
</div>
<ol class="children">
<li id="comment-576425" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ada702ca5328fce64118b4e3f8480e2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ada702ca5328fce64118b4e3f8480e2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://nexwebsites.com" class="url" rel="ugc external nofollow">Nexus Software</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-02-23T13:51:51+00:00">February 23, 2021 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>It looks like using std::move could be significantly faster</p>
</div>
</li>
</ol>
</li>
<li id="comment-55333" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-25T10:59:30+00:00">June 25, 2012 at 10:59 am</time></a> </div>
<div class="comment-content">
<p>Nope, I was talking about:<br/>
&ldquo;Another problem with the vector template is that whenever you copy a vector, you copy all the data it contains. Again, to avoid this problem, you must use the swap method.&rdquo;</p>
</div>
</li>
<li id="comment-55334" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6aea6e2f57f2a7b1cd6870375fbdc42f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ivan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-06-25T11:04:41+00:00">June 25, 2012 at 11:04 am</time></a> </div>
<div class="comment-content">
<p>ofc, it only work for temporaries if recall correctly. RVR are mystic to me tbh . 🙂</p>
</div>
</li>
<li id="comment-57533" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/db1993a00c1ce7c8e693affdd282b615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/db1993a00c1ce7c8e693affdd282b615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-10-15T23:06:02+00:00">October 15, 2012 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>Perhaps a typo: the phrase &ldquo;Suppose I want to create an array in C++ containing the numbers from 0 to N in increasing order&rdquo; should perhaps have &ldquo;N-1&rdquo;.</p>
</div>
</li>
<li id="comment-64060" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valrandir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-04T15:43:45+00:00">January 4, 2013 at 3:43 pm</time></a> </div>
<div class="comment-content">
<p>Consider using iterators to access the vector elements rather than using operator[], which needs to calculate the memory offset based on the position and the size of each element. It probably does it as such: return ptr[position], and the compiler then needs to calculate *((void*)ptr + sizeof(T) * position), which means a multiplication for every access. c++ Pointer arithmetic will do the sizeof multiplication implicitly.</p>
<p>Consider this alternative:</p>
<p>vector bigarray(N);<br/>
auto it = bigarray.begin();<br/>
auto end = bigarray.end();<br/>
for(; it &lt; end; ++it)<br/>
*it = k;<br/>
int sum = total(bigarray,N);<br/>
return sum;</p>
<p>This alternative should simply add sizeof(T) (in this case sizeof(int)) to the pointer. It means we only need one addition, instead of both an addition and a multiplication.</p>
<p>This should close the gap with using c++ new.</p>
</div>
</li>
<li id="comment-64067" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-04T17:05:22+00:00">January 4, 2013 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p>@Valrandir</p>
<p><em>which means a multiplication for every access</em></p>
<p>I agree that a compiler could implement this way, but modern compilers should know better. </p>
<p>For one thing, a multiplication by sizeof(T) is a multiplication by a power of 2, which the compiler can implement as a mere shift.</p>
<p>But even so, in this case the compiler almost certainly avoids even this overhead.</p>
<p>Feel free however to run benchmarks to verify your conjecture (follow the link to get the code).</p>
</div>
</li>
<li id="comment-64261" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8767bd5b599615b306d847e15920f7d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Valrandir</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-06T03:17:50+00:00">January 6, 2013 at 3:17 am</time></a> </div>
<div class="comment-content">
<p>I ran benchmarks using iterators and found no meaningful difference compared to using operator[]</p>
</div>
</li>
<li id="comment-68630" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-28T11:06:55+00:00">January 28, 2013 at 11:06 am</time></a> </div>
<div class="comment-content">
<p>Since you are using C++11x, you should look at emplace_back(). It should be significantly faster than push_back.</p>
</div>
</li>
<li id="comment-74701" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-07T21:57:15+00:00">March 7, 2013 at 9:57 pm</time></a> </div>
<div class="comment-content">
<p>@Jeff </p>
<p>I do not think that emplace_back is likely to be faster in this case. See <a href="http://stackoverflow.com/questions/13883299/c-vector-emplace-back-is-faster" rel="nofollow ugc">http://stackoverflow.com/questions/13883299/c-vector-emplace-back-is-faster</a></p>
</div>
</li>
<li id="comment-74748" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T10:23:47+00:00">March 8, 2013 at 10:23 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think the person who answered that SO question knows what he&rsquo;s talking about. The other SO article referenced there (<a href="http://stackoverflow.com/questions/4303513/push-back-vs-emplace-back" rel="nofollow ugc">http://stackoverflow.com/questions/4303513/push-back-vs-emplace-back</a>) does support my claim. And from <a href="http://en.cppreference.com/w/cpp/container/vector/emplace_back" rel="nofollow ugc">http://en.cppreference.com/w/cpp/container/vector/emplace_back</a>: &ldquo;Appends a new element to the end of the container. The element is constructed in-place, i.e. no copy or move operations are performed. The constructor of the element is called with exactly the same arguments that are supplied to the function.&rdquo;</p>
<p>If you&rsquo;re constructing in-place and you avoid a temporary variable, that should be faster as you avoid both a second memory allocation and a copy.</p>
</div>
</li>
<li id="comment-74753" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T11:38:44+00:00">March 8, 2013 at 11:38 am</time></a> </div>
<div class="comment-content">
<p>@Jeff</p>
<p>Well, it is not faster and even slightly slower according to my tests:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvectorcpp11.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvectorcpp11.cpp</a></p>
</div>
</li>
<li id="comment-74770" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T16:00:46+00:00">March 8, 2013 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;ve played with your benchmark code, and I can say: that&rsquo;s a result of the benchmark you&rsquo;re using.</p>
<p>emplace_back is meant to avoid having to run a copy constructor on an object&#8230;but you&rsquo;re using it in a benchmark that is adding a bunch of ints, which is a primitive, not an object. As a result, it&rsquo;s entirely possible that you&rsquo;re hitting code paths unnecessarily where emplace_back is requiring extra steps for a primitive as it normally requires a new object to be created to be created whereas the simple copy of the primitive is optimized away by the compiler.</p>
<p>I can make some small changes to your benchmark and have emplace_back come out ahead &#8212; like using uint_fast64_t instead of int and removing the reservation (which is not always feasible, as I&rsquo;m sure you&rsquo;re aware). Yes, I&rsquo;m aware that this is not the case you originally presented in your blog.</p>
<p>Moreover, even with a very simple actual object I can make emplace_back become neck and neck with push_back and pull ahead if you remove reservation:</p>
<p>class BenchmarkTester {<br/>
public:<br/>
BenchmarkTester()<br/>
: m_myVec(100)<br/>
, m_myBool(false)<br/>
, m_myPair(24.5, std::string(&ldquo;Happy days are here again&rdquo;))<br/>
{<br/>
}</p>
<p> private:<br/>
std::vector m_myVec;<br/>
bool m_myBool;<br/>
std::pair m_myPair;<br/>
};</p>
<p>With complex objects, emplace_back can start becoming very time-saving. Like all things, it&rsquo;s a matter of using it when appropriate.</p>
</div>
</li>
<li id="comment-74772" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T16:12:20+00:00">March 8, 2013 at 4:12 pm</time></a> </div>
<div class="comment-content">
<p>@Jeff</p>
<p>Please see <a href="https://lemire.me/blog/archives/2012/11/26/why-i-like-the-new-c/" rel="nofollow">Why I like the new C++</a> and specifically the &ldquo;move semantics&rdquo; section where I show evidence that push_back is already much faster for large objects in C++11.</p>
<p>I would really like to see a full benchmark that shows that emplace_back is <strong>even</strong>Â faster&#8230;</p>
<p>(Look at my GitHub files, I did check it and I see no benefit to emplace_back&#8230; even for large objects.)</p>
</div>
</li>
<li id="comment-74778" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T17:50:30+00:00">March 8, 2013 at 5:50 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know which GitHub files you&rsquo;re indicating and don&rsquo;t really have time to trawl through all of them finding other uses of emplace other than the one file you already pointed me to. But it wasn&rsquo;t difficult in that one file to make changes (mainly using the simple object that I posted above) that caused emplace_back to be faster than push_back, and I expect that trend to be even more pronounced with increased object complexity and/or size.</p>
<p>I didn&rsquo;t actually even create a copy constructor in my class above, and still got slightly faster execution than push_back. If you have copy constructors that actually go through various members of a class and copy all of the data (perhaps running an equality check first to avoid copying if the objects are equal, which itself might take a lot of time), then I would expect emplace_back to not just equal push_back but surge way ahead.</p>
<p>It&rsquo;s just clearly not optimized for pushing primitives into a vector, as they aren&rsquo;t proper objects to begin with.</p>
</div>
</li>
<li id="comment-74782" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T19:10:40+00:00">March 8, 2013 at 7:10 pm</time></a> </div>
<div class="comment-content">
<p>@Jeff </p>
<p>Ok, I was able to get a 10% gain with emplace_back under GCC 4.7 using a variation on your class and a 20% with int on a fast destkop.</p>
<p>Please see my new code there:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvectorcpp11.cpp" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2012/06/20/testvectorcpp11.cpp</a></p>
<p>20% is not a lot, but it is on a primitive&#8230; however, only on my desktop, not on my laptop&#8230; However, if I switch to clang 3.2, the difference is even more significant.</p>
<p>So my conclusion is that you are right that emplace_back is faster, though there might compiler/cpu issues to deal with.</p>
</div>
</li>
<li id="comment-74796" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d745e1ffc1a39edb20a39a0e722aa13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jeff Mitchell</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-08T22:17:06+00:00">March 8, 2013 at 10:17 pm</time></a> </div>
<div class="comment-content">
<p>Cool 🙂 Sounds more like what should happen. After all, if emplace_back was slower in the general case, there would hardly have been much impetus to put it in 🙂</p>
</div>
</li>
<li id="comment-76435" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f793a24e914f295ad5efe124755893d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f793a24e914f295ad5efe124755893d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sonal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-18T04:32:37+00:00">March 18, 2013 at 4:32 am</time></a> </div>
<div class="comment-content">
<p>Hello,</p>
<p>I am facing a similar issue with C++ hash_map.<br/>
I am reading one CSV input file and storing each column value (with column name) in a hash_map. These values are added dynamically and this hash_map is stored inside a &ldquo;Record&rdquo; object which is also allocated dynamically.<br/>
So effectively, i have lot of memory being allocated dynamically and if the input file is huge in size, it ends up using a lot of memory.<br/>
When the file is processed, i am calling &ldquo;clear()&rdquo; method on the hash_map and in addition deleting memory for these columns and the record object too. I have used appropriate destructors too.</p>
<p>But even after calling clear() and delete(), the memory is not released to the O.S. It shows the same amount of memory being used by my process with the &ldquo;top&rdquo; command before calling clear() or delete().<br/>
I tried using swap() trick to swap it with empty hash_map, but still it does not seem to release the memory.</p>
<p>Am I missing something here ? Please give suggestions.</p>
</div>
</li>
<li id="comment-209603" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f7efef9999b8a2f6440385e95d7a6272?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f7efef9999b8a2f6440385e95d7a6272?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jason</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-20T18:58:33+00:00">November 20, 2015 at 6:58 pm</time></a> </div>
<div class="comment-content">
<p>Hi, Daniel:<br/>
I guess you could change a vector&rsquo;s capacity using vector::shrink_to_fit(). <a href="http://en.cppreference.com/w/cpp/container/vector/shrink_to_fit" rel="nofollow ugc">http://en.cppreference.com/w/cpp/container/vector/shrink_to_fit</a></p>
</div>
<ol class="children">
<li id="comment-209604" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2015-11-20T19:13:40+00:00">November 20, 2015 at 7:13 pm</time></a> </div>
<div class="comment-content">
<p>Good point, yes, if you have C++11 support.</p>
</div>
</li>
</ol>
</li>
<li id="comment-222294" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2dde811c3bffd47474811fe9f8bda128?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2dde811c3bffd47474811fe9f8bda128?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://thisisashwanipandey.blogspot.com/" class="url" rel="ugc external nofollow">Ashwani Pandey</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-01-16T15:08:13+00:00">January 16, 2016 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>I started reading this post because of its uncommon title. Nice wordplay!! 😀</p>
</div>
</li>
<li id="comment-277951" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a45f8fcba45e6dace91a0700139fdff?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a45f8fcba45e6dace91a0700139fdff?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ashish</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-04-14T09:51:03+00:00">April 14, 2017 at 9:51 am</time></a> </div>
<div class="comment-content">
<p>Well!! nice article, but regarding the title. I think this is more of misguiding rather than word-play.</p>
</div>
</li>
<li id="comment-358840" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8210f5dd965c36960fae36b3fec16d29?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8210f5dd965c36960fae36b3fec16d29?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sudo</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-20T14:53:51+00:00">October 20, 2018 at 2:53 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
It is outside the specifications and could potentially be unsafe, but it saves you up to half a CPU cycle per integer.
</p></blockquote>
<p>I thought it was the best way to do it. We both agree on the point that it&rsquo;s faster. Could you explain how does constructing an empty vector and then reserving the max size it can go can turn out to be <em>&ldquo;unsafe&rdquo;</em>?</p>
</div>
<ol class="children">
<li id="comment-359060" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-21T14:19:41+00:00">October 21, 2018 at 2:19 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think the concept of &ldquo;unsafe&rdquo; works in that direction. That is, you have to show that it is safe as per the specifications. If you cannot show that, then it fair to call it unsafe because you just don&rsquo;t what the compiler and the standard library might do. It might work one day on your system and then fail horribly on some other system.</p>
</div>
</li>
<li id="comment-578332" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2354b38ff11b9e33cbb3dfa809a723a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2354b38ff11b9e33cbb3dfa809a723a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jwakely</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T13:27:01+00:00">March 5, 2021 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s not unsafe to reserve the space, obviously. It&rsquo;s undefined behaviour to write into the space that has been reserved but not yet made part of the valid range of the vector. If you do that the compiler is allowed to turn your program into a smouldering pile of ashes. Specifically, it might actually check with some compiler options (e.g. AddressSanitizer, or a &ldquo;checked iterators&rdquo; debugging mode) and abort at runtime.</p>
</div>
</li>
</ol>
</li>
<li id="comment-434715" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1c2d303072f86b6ee6ea7137daae6b16?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1c2d303072f86b6ee6ea7137daae6b16?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Gauss</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-10-27T19:50:54+00:00">October 27, 2019 at 7:50 pm</time></a> </div>
<div class="comment-content">
<p>Your sum is:<br/>
+ + + &#8230; + +<br/>
Reordering:<br/>
+ + + + + + &#8230;<br/>
Since:<br/>
+ = + = + = &#8230; ,<br/>
then your sum is:<br/>
/2 * (+) =</p>
<p>1 + 2 + 3 + &#8230; + (N-1) + N = N * (N+1) / 2</p>
</div>
</li>
<li id="comment-482291" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/70ff9a294fa0d6b740b22d3d72081498?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/70ff9a294fa0d6b740b22d3d72081498?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kurt Guntheroth</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-02T23:11:45+00:00">January 2, 2020 at 11:11 pm</time></a> </div>
<div class="comment-content">
<p>look at std::vector::emplace_back(), which constructs the element in place using template magic. Haven&rsquo;t timed it though.</p>
</div>
<ol class="children">
<li id="comment-482368" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-03T14:53:35+00:00">January 3, 2020 at 2:53 pm</time></a> </div>
<div class="comment-content">
<p>Please see the above comments. I don&rsquo;t think it can be faster.</p>
</div>
</li>
<li id="comment-578333" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c2354b38ff11b9e33cbb3dfa809a723a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c2354b38ff11b9e33cbb3dfa809a723a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jwakely</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-03-05T13:27:51+00:00">March 5, 2021 at 1:27 pm</time></a> </div>
<div class="comment-content">
<p>Emplacing an <code>int</code> isn&rsquo;t going to help anything at all.</p>
</div>
</li>
</ol>
</li>
<li id="comment-482676" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-01-05T21:32:48+00:00">January 5, 2020 at 9:32 pm</time></a> </div>
<div class="comment-content">
<p>I am a bit surprised that even modern versions of clang and gcc cannot optimize away the zeroing of the array implied in the <code>std::vector(size_t N)</code> constructor, since the zeroed elements are fully overwritten immediately after. They can recognize and eliminate such assignments in simpler cases, e.g., <code>assign_heap_fixed</code> in <a href="https://godbolt.org/z/q7q_Sv" rel="nofollow ugc">this example</a>. It seems like the problem is with array of dynamic size: it works for fixed-sized arrays (maybe only up to a limit). This may have to do with the compiler&rsquo;s ability to &ldquo;scalarize&rdquo; small fixed-size arrays: to treat them as if all their elements were independent variables and hence track dead stores, etc, for each one.</p>
</div>
</li>
<li id="comment-506498" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33708030459c661f3543334737cffffb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33708030459c661f3543334737cffffb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">András Sz?cs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-13T20:05:22+00:00">May 13, 2020 at 8:05 pm</time></a> </div>
<div class="comment-content">
<p>What about the best of both worlds?<br/>
Use <em>reserve()</em> and index based access:</p>
<p><code>vector&lt;int&gt; bigarray;<br/>
bigarray.reserve(N)<br/>
for(unsigned int k = 0; k&lt;N; ++k)<br/>
bigarray[k] = k;<br/>
int sum = total(bigarray,N);<br/>
return sum;<br/>
</code></p>
<p>For me it reached the speed of the C-style array (C++ new in your post).</p>
</div>
<ol class="children">
<li id="comment-506695" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-14T15:06:09+00:00">May 14, 2020 at 3:06 pm</time></a> </div>
<div class="comment-content">
<p>But that is not legal code, it leaves you with a broken vector instance and would be a fireable offense at most places. 🙂</p>
</div>
<ol class="children">
<li id="comment-506789" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33708030459c661f3543334737cffffb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33708030459c661f3543334737cffffb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">András Sz?cs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-05-14T18:26:00+00:00">May 14, 2020 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>Interesting! I found that &lsquo;solution&rsquo; after I forgot to change a line after some copy-pasting, after I was investigating things. That is when I came across this post. Prior to that mistake I never would have thought about accessing a vector in this fashion and now I wonder how broken this vector become.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
