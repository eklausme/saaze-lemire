---
date: "2021-11-18 12:00:00"
title: "Converting integers to fix-digit representations quickly"
index: false
---

[11 thoughts on &ldquo;Converting integers to fix-digit representations quickly&rdquo;](/lemire/blog/2021/11-18-converting-integers-to-fix-digit-representations-quickly)

<ol class="comment-list">
<li id="comment-607558" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/561315a6f1b13db5ca5a96c1406e076d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/561315a6f1b13db5ca5a96c1406e076d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-18T20:11:23+00:00">November 18, 2021 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>uint64_t bottombottom = top % 10000;<br/>
it&rsquo;s supposed to be<br/>
uint64_t bottombottom = bottom % 10000;</p>
</div>
<ol class="children">
<li id="comment-607559" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-18T20:19:23+00:00">November 18, 2021 at 8:19 pm</time></a> </div>
<div class="comment-content">
<p>Fixed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-607669" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-19T18:32:06+00:00">November 19, 2021 at 6:32 pm</time></a> </div>
<div class="comment-content">
<p>Another nifty technique which allows 64-bit conversion without 64-bit arithmetic is Douglas W. Jones&rsquo; technique described at <a href="http://homepage.divms.uiowa.edu/~jones/bcd/decimal.html" rel="nofollow ugc">http://homepage.divms.uiowa.edu/~jones/bcd/decimal.html</a> and implemented in e.g. <a href="https://elixir.bootlin.com/linux/latest/source/lib/vsprintf.c#L325" rel="nofollow ugc">https://elixir.bootlin.com/linux/latest/source/lib/vsprintf.c#L325</a>.</p>
<p>The Linux code also implements division-by-constant using multiplication manually. While most compilers these days know how to optimize divide by constant to a multiply and shift, they usually can&rsquo;t infer the limited ranges of the inputs which allows smaller multipliers and no fixups.</p>
</div>
</li>
<li id="comment-607686" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-19T21:33:51+00:00">November 19, 2021 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>16-bit numbers need only one multiply per digit?<br/>
<code><br/>
void lulz_atoi(char* str, uint16_t val) {<br/>
uint64_t lo = val;<br/>
uint64_t hi;</p>
<p> __uint128_t x = (__uint128_t)lo * ((0xFFFFFFFFFFFFFFFFULL / 10000) + 1);<br/>
hi = x &gt;&gt; 64;<br/>
lo = (uint64_t)x; </p>
<p> str[0] = hi + 0x30;<br/>
for (int i = 1; i &gt; 64;<br/>
lo = (uint64_t)x;</p>
<p> str[i] = hi + 0x30;<br/>
}<br/>
str[5] = 0;<br/>
}<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-607687" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-19T21:39:03+00:00">November 19, 2021 at 9:39 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://gist.github.com/aqrit/2997713a00ad043b4bac42e342294259" rel="nofollow ugc">https://gist.github.com/aqrit/2997713a00ad043b4bac42e342294259</a></p>
</div>
<ol class="children">
<li id="comment-607896" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-21T15:32:38+00:00">November 21, 2021 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Updated gist to 64-bits. I&rsquo;ve not checked the generated assembly. Not benchmarked against the other implementations because a uint64_t should have 20 decimal digits&#8230;</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-608271" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/51ebb537b8188a3c58430a126c0e5f44?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/51ebb537b8188a3c58430a126c0e5f44?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lance Richardson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-23T21:59:50+00:00">November 23, 2021 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p>ICX AVX2 numbers look pretty nice, although &ldquo;-march=native&rdquo; was needed to get all three SIMD versions.</p>
<p># make<br/>
c++ -O3 -march=native -Wall -Wextra -std=c++17 -o convert convert.cpp<br/>
# ./convert<br/>
khuong 7.15067<br/>
backlinear 30.8381<br/>
linear 21.6466<br/>
tree 14.2078<br/>
treetst 10.0964<br/>
treest 6.32523<br/>
treebt 2.30575<br/>
sse2 4.81692<br/>
sse2(2) 4.70681<br/>
avx2 2.00375</p>
<p>khuong 7.15235<br/>
backlinear 30.8286<br/>
linear 21.6496<br/>
tree 14.2603<br/>
treetst 10.0969<br/>
treest 6.32516<br/>
treebt 2.30584<br/>
sse2 4.81617<br/>
sse2(2) 4.70639<br/>
avx2 2.00354</p>
<p>khuong 7.15085<br/>
backlinear 30.8319<br/>
linear 21.6403<br/>
tree 14.2665<br/>
treetst 10.0935<br/>
treest 6.32525<br/>
treebt 2.30579<br/>
sse2 4.81627<br/>
sse2(2) 4.70653<br/>
avx2 2.00359</p>
</div>
</li>
<li id="comment-608274" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/51ebb537b8188a3c58430a126c0e5f44?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/51ebb537b8188a3c58430a126c0e5f44?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Lance Richardson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-23T22:08:28+00:00">November 23, 2021 at 10:08 pm</time></a> </div>
<div class="comment-content">
<p>ICX AVX2 numbers look pretty nice, although “-march=native” was needed to get all three SIMD versions.</p>
<p># make<br/>
c++ -O3 -march=native -Wall -Wextra -std=c++17 -o convert convert.cpp<br/>
# ./convert<br/>
khuong 7.15067<br/>
backlinear 30.8381<br/>
linear 21.6466<br/>
tree 14.2078<br/>
treetst 10.0964<br/>
treest 6.32523<br/>
treebt 2.30575<br/>
sse2 4.81692<br/>
sse2(2) 4.70681<br/>
avx2 2.00375</p>
<p>khuong 7.15235<br/>
backlinear 30.8286<br/>
linear 21.6496<br/>
tree 14.2603<br/>
treetst 10.0969<br/>
treest 6.32516<br/>
treebt 2.30584<br/>
sse2 4.81617<br/>
sse2(2) 4.70639<br/>
avx2 2.00354</p>
<p>khuong 7.15085<br/>
backlinear 30.8319<br/>
linear 21.6403<br/>
tree 14.2665<br/>
treetst 10.0935<br/>
treest 6.32525<br/>
treebt 2.30579<br/>
sse2 4.81627<br/>
sse2(2) 4.70653<br/>
avx2 2.00359</p>
</div>
</li>
<li id="comment-608512" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2626223241e8734c22cfbc22c2d12d61?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2626223241e8734c22cfbc22c2d12d61?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ankit Dixit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-11-25T07:16:16+00:00">November 25, 2021 at 7:16 am</time></a> </div>
<div class="comment-content">
<p>Can we run this type of coding syntax on an online compiler like this <a href="https://www.interviewbit.com/online-java-compiler/" rel="nofollow ugc">https://www.interviewbit.com/online-java-compiler/</a></p>
</div>
</li>
<li id="comment-640527" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-23T15:45:07+00:00">July 23, 2022 at 3:45 pm</time></a> </div>
<div class="comment-content">
<p>Are approaches that only work for streams of many integers of interest? I&rsquo;m calculating a base-10 checksum of all 10 digits of a u32 in &lt;1ns per u32 with AVX2. This includes an intermediate step in which the length of the encoded string (without leading zeros) is calculated, but of course it does not include outputting the string.</p>
<p>The layout of the digits within the vectors is pretty bad for conversion-to-string purposes: the digits for a single integer are spread out between 2 adjacent bytes of 5 different vectors. It seems like it would be not so expensive to fix the layout to be friendlier for outputting, especially if the task was just to output u32 of at most 8 digits or u64 of at most 16 digits. I don&#039;t know a clever way to output u64 of 20 digits though, I would just have to add another scalar modmul at the beginning to split the u64 into groups of (4,8,8) digit.</p>
</div>
<ol class="children">
<li id="comment-640530" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/275d6ccbf6ac0d40942ed813e1aa38c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">sasuke420</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-07-23T16:16:17+00:00">July 23, 2022 at 4:16 pm</time></a> </div>
<div class="comment-content">
<p>To compute the length, if you imagine you have the groups of 4 digits in 4 vectors, you can take max(andnot(digits == 0, digitcount))+1 to get the length where digitcount is a constant:<br/>
[3,2,1,0]<br/>
[7,6,5,4]<br/>
[11,10,9,8]<br/>
[15,14,13,12]<br/>
and max() is actually a sequence of 3 max, shuffle, max, shuffle, max. After that you can use arithmetic to calculate the proper shuffle to move the digits into the front of the vector so you can output a single formatted integer. You end up with a bunch of data dependencies but no branches. The data dependencies will surely rain on your parade though.</p>
</div>
</li>
</ol>
</li>
</ol>
