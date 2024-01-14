---
date: "2017-08-31 12:00:00"
title: "Parsing comma-separated integers in Java"
index: false
---

[2 thoughts on &ldquo;Parsing comma-separated integers in Java&rdquo;](/lemire/blog/2017/08-31-parsing-comma-separated-integers-in-java)

<ol class="comment-list">
<li id="comment-291371" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccba2630e88064d385e4bb65d2891a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccba2630e88064d385e4bb65d2891a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://sh1ftchg.com" class="url" rel="ugc external nofollow">Jay</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-13T20:26:22+00:00">November 13, 2017 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>Your manual implementation doesn&rsquo;t even work. The results don&rsquo;t correlate with the actual values; partially because of some false assumptions. I could go on but it was actually easier to write a working implementation with ~4x the throughput.</p>
<p>m.l.m.p.ParseInt.manualSplit thrpt 5 12624.529 ï¿½ 445.839 ops/s<br/>
m.l.m.p.ParseInt.monolithicSplit thrpt 5 41031.703 ï¿½ 5054.782 ops/s</p>
<p> @Benchmark<br/>
public int[] monolithicSplit(BenchmarkState s) {<br/>
final String text = s.myarray;<br/>
final int length = text.length();<br/>
final int limit = (length / 2) + 1;<br/>
int[] array = new int[limit];<br/>
int pos = 0, tmp = 0;<br/>
boolean neg = false;<br/>
for (int i = 0; i &lt; length; i++) {<br/>
char c = text.charAt(i);<br/>
if (c == &#039;,&#039;) {<br/>
array[pos++] = neg ? 0 &#8211; tmp : tmp;<br/>
tmp = 0;<br/>
neg = false;<br/>
} else if (c == &#039;-&#039;) {<br/>
neg = true;<br/>
} else {<br/>
tmp = (tmp &lt;&lt; 3) + (tmp &lt;&lt; 1) + (c &amp; 0xF);<br/>
}<br/>
}<br/>
array[pos++] = neg ? 0 &#8211; tmp : tmp;<br/>
int[] result = new int[pos];<br/>
System.arraycopy(array, 0, result, 0, pos);<br/>
return result;<br/>
}</p>
</div>
<ol class="children">
<li id="comment-291374" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-11-13T22:03:21+00:00">November 13, 2017 at 10:03 pm</time></a> </div>
<div class="comment-content">
<p>Your approach is indeed better than my manual hack and I have updated the code accordingly. Note that this was indicated in my post.</p>
</div>
</li>
</ol>
</li>
</ol>
