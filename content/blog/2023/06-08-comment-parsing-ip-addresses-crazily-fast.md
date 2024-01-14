---
date: "2023-06-08 12:00:00"
title: "Parsing IP addresses crazily fast"
index: false
---

[12 thoughts on &ldquo;Parsing IP addresses crazily fast&rdquo;](/lemire/blog/2023/06-08-parsing-ip-addresses-crazily-fast)

<ol class="comment-list">
<li id="comment-652229" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/05f4683b7c000ac5794034ba1c768fe1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/05f4683b7c000ac5794034ba1c768fe1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">wieschade</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T07:07:49+00:00">June 9, 2023 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>Worth to mention. There are several IPv4 notations.</p>
<p>For example:</p>
<p>$ ping 0300.0250.1.0376<br/>
PING 0300.0250.1.0376 (192.168.1.254) 56(84) bytes of data.<br/>
&#8230;</p>
<p>That&rsquo;s the reason why inet_pton checks &ldquo;IPv4 field has octet with leading zero&rdquo; condition.</p>
</div>
<ol class="children">
<li id="comment-652239" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T13:34:37+00:00">June 9, 2023 at 1:34 pm</time></a> </div>
<div class="comment-content">
<p>I am benchmarking against the standard function inet_pton which does not support these variations.</p>
<p>Our <a href="https://www.ada-url.com" rel="nofollow ugc">URL parsing library</a> supports all of these variations, and IPv6 as well.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652230" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a339f3a59b9df9c09eb8d06c744279d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a339f3a59b9df9c09eb8d06c744279d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ralph Corderoy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T07:34:44+00:00">June 9, 2023 at 7:34 am</time></a> </div>
<div class="comment-content">
<p>Just to point out that inet_pton() differs from inet_addr() in that the latter accepts more formats. inet_ntop(3p) spells that out. This is why one can <code>ping 127.1</code>, <code>ping 0x8080808</code>, or <code>ping 2130706433</code>. Callers of sse_inet_aton() need to be certain their inputs are compatible, especially if taking IP addresses from external users.</p>
</div>
<ol class="children">
<li id="comment-652237" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T13:31:44+00:00">June 9, 2023 at 1:31 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://www.man7.org/linux/man-pages/man3/inet_pton.3.html" rel="nofollow ugc">The documentation of inet_pton</a> is as follows:</p>
<blockquote>
<p>src points to a character string containing an IPv4 network address in<br/>
dotted-decimal format, &ldquo;ddd.ddd.ddd.ddd&rdquo;, where ddd is a decimal<br/>
number of up to three digits in the range 0 to 255.</p>
</blockquote>
<p>I tested on both macOS and Linux, and inet_pton cannot parse 0x8080808. You can verify yourself by running this program:</p>
<pre><code>#include &lt;stdio.h&gt;
#include &lt;arpa/inet.h&gt;

int main(int argc, char **arg) {
  char buf[4];
  printf("%d\n", inet_pton(AF_INET, "127.0.1.1", buf));
  printf("%d\n", inet_pton(AF_INET, "127.1", buf));
  printf("%d\n", inet_pton(AF_INET, "0x8080808", buf));
  printf("%d\n", inet_pton(AF_INET, "2130706433", buf));
}
</code></pre>
<p>If you run this program, you get 1 (success), 0 (failure), 0 (failure), and 0 (failure). Meaning that only &ldquo;127.0.1.1&rdquo; is recognized as a valid address.</p>
</div>
<ol class="children">
<li id="comment-652240" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a339f3a59b9df9c09eb8d06c744279d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a339f3a59b9df9c09eb8d06c744279d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ralph Corderoy</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T13:51:38+00:00">June 9, 2023 at 1:51 pm</time></a> </div>
<div class="comment-content">
<p>Hi Daniel, you have misread my comment: I never claimed inet_pton() can parse 0x8080808. I&rsquo;m pointing out it can&rsquo;t.</p>
</div>
<ol class="children">
<li id="comment-652242" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T14:21:34+00:00">June 9, 2023 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>I was actually not arguing &ldquo;against you&rdquo;. I was just clarifying what the function does, for the benefit of the readers.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652231" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/85b78eafacb4669d21778e08abdb8483?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/85b78eafacb4669d21778e08abdb8483?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://sig-io.nl" class="url" rel="ugc external nofollow">Sig-I/O</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T08:43:30+00:00">June 9, 2023 at 8:43 am</time></a> </div>
<div class="comment-content">
<p>IP addresses can also be IPv6&#8230;. or in IPv6 notation while being IPv4&#8230; So be wary of this 😉<br/>
::ffff:12.34.56.78</p>
</div>
<ol class="children">
<li id="comment-652238" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-09T13:33:18+00:00">June 9, 2023 at 1:33 pm</time></a> </div>
<div class="comment-content">
<p>Yes, my code does not support IPv6 or uncommon IPv4 formats. It is equivalent to &ldquo;inet_pton(AF_INET,&#8230;)&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652266" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-10T15:32:23+00:00">June 10, 2023 at 3:32 pm</time></a> </div>
<div class="comment-content">
<p>Has this been tested exhaustively?</p>
<p>If the perfect hash function hashes an invalid string to one of the valid entries…<br/>
then the shuffle would discard bytes without them ever being validated?</p>
</div>
<ol class="children">
<li id="comment-652267" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-10T15:46:55+00:00">June 10, 2023 at 3:46 pm</time></a> </div>
<div class="comment-content">
<p>We have checks in place to verify that the string length is as expected.</p>
</div>
</li>
<li id="comment-652268" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-10T15:47:40+00:00">June 10, 2023 at 3:47 pm</time></a> </div>
<div class="comment-content">
<p>Of course, bugs are always possible.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652304" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc7fef81e067520ad977f6962bb13593?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc7fef81e067520ad977f6962bb13593?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alex Porter</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-06-12T07:41:32+00:00">June 12, 2023 at 7:41 am</time></a> </div>
<div class="comment-content">
<p>I think there are some opportunities for optimizing the performance of what you have already.</p>
<p>For string loading, the string length isn&rsquo;t strictly necessary as long as it&rsquo;s a null terminated string by comparing to 0 doing _mm_movemask_epi8 and then leading zero count.</p>
<p>I&rsquo;m sure your hashing algorithm could be improved to include the string length, since there are only so many options, given a dotmask.</p>
<p>Lines 189 &#8211; 196 can be simplified by just checking no value is greater than 9, since any other value that has &lsquo;0&rsquo; subtracted from it will be greater than 9 by either wrapping around or by having an ascii code greater than &lsquo;9&rsquo;.</p>
<p>Lines 175 through 182 and 198 through 209 can be simplified by re-arranging the weights to be in most-significant to least-significant order and leaving a gap for each octet like such: (100, 10, 0, 1). This obviates the restriction on leading zero digits. After this, use _mm256_maddubs_epi16 as before, but replace everything after with _mm256_hadd_epi16 and _mm_shuffle_epi8 to move the proper bytes to the least significant i32 for use with _mm_cvtsi128_si32.</p>
<p>I&rsquo;m certainly no CS professor, so I could be way off on some of these things, but I wanted to take a crack at learning about SIMD and seeing if I could identify and areas for improvement.</p>
<p>Thanks!</p>
</div>
</li>
</ol>
