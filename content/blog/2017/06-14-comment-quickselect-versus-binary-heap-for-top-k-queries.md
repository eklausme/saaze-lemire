---
date: "2017-06-14 12:00:00"
title: "QuickSelect versus binary heap for top-k queries"
index: false
---

[2 thoughts on &ldquo;QuickSelect versus binary heap for top-k queries&rdquo;](/lemire/blog/2017/06-14-quickselect-versus-binary-heap-for-top-k-queries)

<ol class="comment-list">
<li id="comment-281501" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-15T20:04:43+00:00">June 15, 2017 at 8:04 pm</time></a> </div>
<div class="comment-content">
<p>A lot hinges on the fact that the k-th value at most intermediate stages is a pretty good pivot for partitioning. </p>
<p>I just tripled the speed of the FastPriorityQueue version by doing this:</p>
<pre style="color:#000000;background:#ffffff;"><span style="color:#800000; font-weight:bold; ">for</span> <span style="color:#808030; ">(</span>i <span style="color:#808030; ">=</span> <span style="color:#008c00; ">128</span> <span style="color:#800080; ">;</span> i <span style="color:#808030; ">&lt;</span> <span style="color:#008c00; ">128</span> <span style="color:#808030; ">*</span> blocks <span style="color:#800080; ">;</span> i<span style="color:#808030; ">++</span><span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
  <span style="color:#800000; font-weight:bold; ">var</span> x <span style="color:#808030; ">=</span> rand<span style="color:#808030; ">(</span>i<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800000; font-weight:bold; ">if</span> <span style="color:#808030; ">(</span> x <span style="color:#808030; ">></span> b<span style="color:#808030; ">.</span>peek<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">)</span> <span style="color:#800080; ">{</span>
    b<span style="color:#808030; ">.</span>add<span style="color:#808030; ">(</span>x<span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
    b<span style="color:#808030; ">.</span>poll<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#800080; ">;</span>
  <span style="color:#800080; ">}</span>
<span style="color:#800080; ">}</span>
</pre>
</div>
<ol class="children">
<li id="comment-281557" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-06-16T13:23:31+00:00">June 16, 2017 at 1:23 pm</time></a> </div>
<div class="comment-content">
<p>I have taken the liberty of making your code look pretty.</p>
</div>
</li>
</ol>
</li>
</ol>
