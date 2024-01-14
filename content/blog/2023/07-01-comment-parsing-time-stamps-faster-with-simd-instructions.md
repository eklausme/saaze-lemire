---
date: "2023-07-01 12:00:00"
title: "Parsing time stamps faster with SIMD instructions"
index: false
---

[17 thoughts on &ldquo;Parsing time stamps faster with SIMD instructions&rdquo;](/lemire/blog/2023/07-01-parsing-time-stamps-faster-with-simd-instructions)

<ol class="comment-list">
<li id="comment-652642" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T01:29:26+00:00">July 2, 2023 at 1:29 am</time></a> </div>
<div class="comment-content">
<p>The SSE code looks good. Possible tweaks (probably won&rsquo;t show any difference in benchmarks, but may have <em>theoretical</em> advantages):</p>
<p>replace <code>_mm_sub_epi8</code> with <code>_mm_xor_si128</code> &#8211; latter is commutative, so may give compiler more freedom with ordering (e.g. use load-op on the source if the 0x30 vector is already in a register). Some CPUs may have more ports for bitwise ops over arithmetic<br/>
<code>maddubs</code> has longish latency; the <code>_mm_subs_epu16</code> could actually be done before it if you use a BCD-like representation for <code>limit16</code> which might help ILP</p>
</div>
<ol class="children">
<li id="comment-652690" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-03T19:08:12+00:00">July 3, 2023 at 7:08 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>BCD-like representation for limit16</p>
</blockquote>
<p>There is an endianness mismatch for this to work out?</p>
</div>
<ol class="children">
<li id="comment-652692" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-03T19:20:19+00:00">July 3, 2023 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p>Flipping bytes might be worth the effort.</p>
</div>
</li>
<li id="comment-652696" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-03T23:06:14+00:00">July 3, 2023 at 11:06 pm</time></a> </div>
<div class="comment-content">
<p>Ah, oops, missed that. Likely not worth it then.</p>
</div>
<ol class="children">
<li id="comment-652718" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-04T14:14:16+00:00">July 4, 2023 at 2:14 pm</time></a> </div>
<div class="comment-content">
<p>I do flip the bytes and find it worthwhile.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652649" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a133ace1ffeca0180022c18331729372?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a133ace1ffeca0180022c18331729372?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Duck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T07:32:23+00:00">July 2, 2023 at 7:32 am</time></a> </div>
<div class="comment-content">
<p>I solved a very similar problem on Stackoverflow some time ago. Its speed was &lt; 1ns per time stamp.</p>
<p><a href="https://stackoverflow.com/questions/75680256/most-insanely-fast-way-to-convert-yymmdd-hhmmss-timestamp-to-uint64-t-number" rel="nofollow ugc">https://stackoverflow.com/questions/75680256/most-insanely-fast-way-to-convert-yymmdd-hhmmss-timestamp-to-uint64-t-number</a></p>
</div>
<ol class="children">
<li id="comment-652691" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-03T19:09:48+00:00">July 3, 2023 at 7:09 pm</time></a> </div>
<div class="comment-content">
<p>Indeed. It looks similar at a glance but your version does not compute the time in seconds since Epoch and does not validate.</p>
</div>
<ol class="children">
<li id="comment-652722" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-04T15:13:38+00:00">July 4, 2023 at 3:13 pm</time></a> </div>
<div class="comment-content">
<p>I doubt you can reach 1 ns per time stamp, at least using single threaded code processing one time stamp at a time.</p>
<p>1 ns is very short.</p>
</div>
<ol class="children">
<li id="comment-652804" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a133ace1ffeca0180022c18331729372?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a133ace1ffeca0180022c18331729372?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Duck</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-07T02:37:36+00:00">July 7, 2023 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>1ns is for the case where it&rsquo;s a hot-loop that does nothing but parsing timestamp, so everything is 100% in instruction cache and perfectly pipelined.</p>
<p>The stackoverflow link contains 2 fully runnable programs to benchmark this. Could you add your solution (using methods in this blog)? Then I&rsquo;ll benchmark and add it to the question.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652651" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07e1826fe16a4e71b0eedbfcb8d74c3e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07e1826fe16a4e71b0eedbfcb8d74c3e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Arthur Chance</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T13:35:53+00:00">July 2, 2023 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p><em>we cannot have more than 59 seconds and never 60 seconds</em></p>
<p>A slight nitpick: technically the seconds field can be &rsquo;60&rsquo; at 23:59 on the 30th of June or 31st of December if there&rsquo;s a positive leap second.</p>
</div>
<ol class="children">
<li id="comment-652661" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f4c567fa22e1d1949be12e161fcab5b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aqrit</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T21:01:15+00:00">July 2, 2023 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>According to my reading of the linked RFC 4034 draft:</p>
<p>A value of 60+ seconds is explicitly forbidden.</p>
<p>The field being serialized is a Unix Timestamp. Unix Time explicitly ignores leap seconds.<br/>
Converting Unix Time to UTC will never yield a leap second, as it can not be represented.</p>
</div>
<ol class="children">
<li id="comment-654359" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a6ab2d98ed63c0c09038bad632b5ae1c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a6ab2d98ed63c0c09038bad632b5ae1c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Malcolm Parsons</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-29T08:25:36+00:00">August 29, 2023 at 8:25 am</time></a> </div>
<div class="comment-content">
<p>strptime() handles leap seconds, but mktime() does not.<br/>
60 seconds should be accepted in the input, but treated as 59.</p>
</div>
<ol class="children">
<li id="comment-654364" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-29T13:53:10+00:00">August 29, 2023 at 1:53 pm</time></a> </div>
<div class="comment-content">
<p>Quoting from the RFC: <a href="https://www.rfc-editor.org/rfc/rfc4034" rel="nofollow ugc">https://www.rfc-editor.org/rfc/rfc4034</a></p>
<p>The Time field values MUST be represented either as an unsigned decimal integer indicating seconds since 1 January 1970 00:00:00 UTC, or in the form YYYYMMDDHHmmSS in UTC, where:</p>
<pre><code>  YYYY is the year (0001-9999, but see Section 3.1.5);
  MM is the month number (01-12);
  DD is the day of the month (01-31);
  HH is the hour, in 24 hour notation (00-23);
  mm is the minute (00-59); and
  SS is the second (00-59).
</code></pre>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-652652" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/18a30ce6d84de6ce5c11ce006d10f616?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/18a30ce6d84de6ce5c11ce006d10f616?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Davidmh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T13:57:22+00:00">July 2, 2023 at 1:57 pm</time></a> </div>
<div class="comment-content">
<p>As Arthur indicates, you are ignoring all the leap seconds, which explains at least some of the reasons why the library version is slower.<br/>
Not enough to get to 10 times more instructions, but still not a fair comparison.</p>
</div>
<ol class="children">
<li id="comment-652721" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-04T15:10:47+00:00">July 4, 2023 at 3:10 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think that impacts the performance, but as pointed out by @aqrit, Unix time ignores leap seconds by its specification.</p>
</div>
</li>
</ol>
</li>
<li id="comment-652655" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fc8788305c841ed66555e63084f8dd57?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fc8788305c841ed66555e63084f8dd57?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bronevichok.ru/" class="url" rel="ugc external nofollow">Sergey Bronnikov</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T16:30:07+00:00">July 2, 2023 at 4:30 pm</time></a> </div>
<div class="comment-content">
<p>SQL standard allows 62 seconds (0-61) in a minute, see <a href="https://twitter.com/noop_noob/status/1166982640118845442" rel="nofollow ugc">https://twitter.com/noop_noob/status/1166982640118845442</a></p>
</div>
</li>
<li id="comment-652660" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0b6cf4c6d6371b1b47c07d3a90de61d9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0b6cf4c6d6371b1b47c07d3a90de61d9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-07-02T19:56:28+00:00">July 2, 2023 at 7:56 pm</time></a> </div>
<div class="comment-content">
<p>Just wanted to say hello and I&rsquo;d wish I understood half of the code shared</p>
</div>
</li>
</ol>
