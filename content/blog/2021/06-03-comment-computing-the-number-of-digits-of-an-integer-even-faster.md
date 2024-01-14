---
date: "2021-06-03 12:00:00"
title: "Computing the number of digits of an integer even faster"
index: false
---

[29 thoughts on &ldquo;Computing the number of digits of an integer even faster&rdquo;](/lemire/blog/2021/06-03-computing-the-number-of-digits-of-an-integer-even-faster)

<ol class="comment-list">
<li id="comment-585943" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-03T21:02:50+00:00">June 3, 2021 at 9:02 pm</time></a> </div>
<div class="comment-content">
<p>Let me give Josh Bleecher Snyder credit for the idea that int_log2 splits the input into ranges where log10 can only go up by 1 at most. Within each such interval the problem is reduced to comparing against a table-derived threshold and incrementing if greater.</p>
</div>
<ol class="children">
<li id="comment-586381" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-07T12:53:52+00:00">June 7, 2021 at 12:53 pm</time></a> </div>
<div class="comment-content">
<p>Just a quick idea: wouldn&rsquo;t zeroing three bottom bits of int_log2 result and indexing array (without the multiplier 8) also create a possibility of a smaller table? Sure this would increase latency by one clock cycle, but just in case the size of the table annoys somebody&#8230;</p>
</div>
<ol class="children">
<li id="comment-586382" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9104ef5e4f029338cf8df36de3ad23d4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">foobar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-07T13:09:47+00:00">June 7, 2021 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>Err, not quite. It would probably be meaningful to try out those ideas before writing a comment&#8230;</p>
</div>
<ol class="children">
<li id="comment-586384" class="comment odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-07T13:35:25+00:00">June 7, 2021 at 1:35 pm</time></a> </div>
<div class="comment-content">
<p>Relatedly, see this suggestion by Pete Cawley: <a href="https://mobile.twitter.com/i/timeline" rel="nofollow ugc">https://mobile.twitter.com/i/timeline</a></p>
</div>
<ol class="children">
<li id="comment-586413" class="comment byuser comment-author-lemire bypostauthor even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-07T20:01:00+00:00">June 7, 2021 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>The comment in question is &ldquo;As a tiny optimisation to make the tables three entries smaller: within <code>int_log2</code>, replace <code>|1</code> with <code>|8</code> &#8211; although then relying on C compiler to rewrite <code>table[int_log2(x)-3]</code> as <code>(table-3)[int_log2(x)]</code> and form <code>table-3</code> as a constant.&rdquo;</p>
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
<li id="comment-585989" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/134b8de0aceaba40d4b30757a3bffd48?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh Bleecher Snyder</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T01:37:12+00:00">June 4, 2021 at 1:37 am</time></a> </div>
<div class="comment-content">
<p>Very nice! Three cheers for collaboration. 🙂</p>
</div>
</li>
<li id="comment-586025" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T07:05:56+00:00">June 4, 2021 at 7:05 am</time></a> </div>
<div class="comment-content">
<p>I wonder if this very nice trick could be used for other problems, e.g. fast <a href="https://en.wikipedia.org/wiki/Methods_of_computing_square_roots" rel="nofollow ugc">square root</a>, specially the <a href="http://atoms.alife.co.uk/sqrt/SquareRoot.java" rel="nofollow ugc">integer square root</a>.</p>
</div>
</li>
<li id="comment-586062" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b02b01200454122a5144ca70f7767f38?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b02b01200454122a5144ca70f7767f38?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tushar Bali</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T11:02:35+00:00">June 4, 2021 at 11:02 am</time></a> </div>
<div class="comment-content">
<p>exciting stuff</p>
</div>
</li>
<li id="comment-586067" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T11:49:08+00:00">June 4, 2021 at 11:49 am</time></a> </div>
<div class="comment-content">
<p>I still prefer the first solution because it extends to 64 bits naturally. The second solution can be considered a variant of the first where:<br/>
* The high half of the 9*bits/32 approximation is replaced by a table lookup,<br/>
* The threshold table lookup is indexed by number of bits, not number of digits (making it larger by a factor of log2(10) = 3.32), and<br/>
* The threshold comparison is done in the (semantically equivalent) form of an add with carry to the low half of the table.</p>
<p>Bloating the table by a factor or 6.64 (for 32 bits, from 11<em>4 = 44 bytes to 32</em>8 = 256 bytes, or +3 cache lines) doesn&rsquo;t seem like a good use of L1 cache, especially as any digit-counting function is going to be part of some much larger output formatting code and not an inner loop by itself.</p>
<p>There&rsquo;s one more trick that hasn&rsquo;t shown up yet and might be useful. Given a safe underestimate such as<br/>
y = 9*int_log2(x) / 32;<br/>
then x &gt;&gt; y can be used to compute the number of digits without losing accuracy; the low digit_count(x) bits of x don&rsquo;t affect the result (because 10 is a multiple of 2).</p>
<p>This <em>might</em> enable people to fit the necessary low and high parts of each table entry into a single word.</p>
</div>
<ol class="children">
<li id="comment-586132" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/407f36f99630d52ea2465666be842715?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/407f36f99630d52ea2465666be842715?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jk-jeon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T21:53:02+00:00">June 4, 2021 at 9:53 pm</time></a> </div>
<div class="comment-content">
<p>Okay, I actually tried George Spelvin&rsquo;s idea and got this: <a href="https://godbolt.org/z/3h971c8K8" rel="nofollow ugc">https://godbolt.org/z/3h971c8K8</a>.<br/>
So difference between two implementations are that for the &ldquo;fused&rdquo; table lookup, we have</p>
<p><code>shrx eax, edi, eax<br/>
add eax, DWORD PTR table[0+rdx*4]<br/>
shr eax, 26<br/>
</code></p>
<p>and for the normal method explained in Prof. Lemire&rsquo;s previous blog post, we have</p>
<p><code>cmp DWORD PTR table[0+rdx*4], edi<br/>
adc eax, 1<br/>
</code></p>
<p>I believe the first one might be very slightly faster as <code>adc</code> instruction is usually a bit slower than <code>add</code>. (But really, there should be no real difference.) I tested through quick-bench.com and it seems that GCC slightly favors the first one and Clang slightly favors the second one, but I think this is unfair, since quick-bench.com does not let me to specify the architecture flag, thus it generates <code>shr eax, cl</code> instead of <code>shrx eax, edi, eax</code>, which I believe is usually a bit slower.</p>
</div>
</li>
<li id="comment-586204" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-05T14:34:53+00:00">June 5, 2021 at 2:34 pm</time></a> </div>
<div class="comment-content">
<p>I was able to get the table down to 32 bit entries by using lg2/4 as the shift &#8212; table[lg2]&lt;&lt;lg2/4 gives the original 64-bit entry.</p>
<p>The arithmetic after that still has to be wider than the argument, ie 64-bit would need uint_128t. I&rsquo;m trying to shift the argument right instead but I have a few edge cases.</p>
</div>
</li>
</ol>
</li>
<li id="comment-586111" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/407f36f99630d52ea2465666be842715?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/407f36f99630d52ea2465666be842715?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jk-jeon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T17:57:47+00:00">June 4, 2021 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>FYI, here is an application of the idea presented in this post into the 64-bit case: <a href="https://godbolt.org/z/e76eEKKj3" rel="nofollow ugc">https://godbolt.org/z/e76eEKKj3</a></p>
</div>
<ol class="children">
<li id="comment-586112" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-04T18:07:46+00:00">June 4, 2021 at 6:07 pm</time></a> </div>
<div class="comment-content">
<pre style="color:#000000;background:#ffffff;">#<span style="color:#004a43; ">include</span> <span style="color:#808030; ">&lt;</span>cassert<span style="color:#808030; ">></span>
#<span style="color:#004a43; ">include</span> <span style="color:#808030; ">&lt;</span>cstdint<span style="color:#808030; ">></span>
#<span style="color:#004a43; ">include</span> <span style="color:#808030; ">&lt;</span>cstddef<span style="color:#808030; ">></span>

constexpr <span style="color:#800000; font-weight:bold; ">int</span> floor_log10_pow2<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">int</span> e<span style="color:#808030; ">)</span> noexcept <span style="color:#808030; ">{</span>
    return <span style="color:#808030; ">(</span>e <span style="color:#808030; ">*</span> <span style="color:#008c00; ">1262611</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">></span><span style="color:#808030; ">></span> <span style="color:#008c00; ">22</span><span style="color:#696969; ">;</span>
<span style="color:#808030; ">}</span>

constexpr <span style="color:#800000; font-weight:bold; ">int</span> ceil_log10_pow2<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">int</span> e<span style="color:#808030; ">)</span> noexcept <span style="color:#808030; ">{</span>
    return e <span style="color:#808030; ">=</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span> <span style="color:#808030; ">?</span> <span style="color:#008c00; ">0</span> <span style="color:#808030; ">:</span> floor_log10_pow2<span style="color:#808030; ">(</span>e<span style="color:#808030; ">)</span> <span style="color:#808030; ">+</span> <span style="color:#008c00; ">1</span><span style="color:#696969; ">;</span>
<span style="color:#808030; ">}</span>

<span style="color:#004a43; ">struct</span> digit_count_table_holder_t <span style="color:#808030; ">{</span>
<span style="color:#e34adc; ">  std:</span><span style="color:#808030; ">:</span>uint64_t entry<span style="color:#808030; ">[</span><span style="color:#008c00; ">64</span><span style="color:#808030; ">]</span><span style="color:#696969; ">;</span>
<span style="color:#808030; ">}</span><span style="color:#696969; ">;</span>

constexpr digit_count_table_holder_t generate_digit_count_table<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">{</span>
    digit_count_table_holder_t <span style="color:#004a43; ">table</span><span style="color:#808030; ">{</span> <span style="color:#808030; ">{</span><span style="color:#808030; ">}</span> <span style="color:#808030; ">}</span><span style="color:#696969; ">;</span>
    constexpr <span style="color:#800000; font-weight:bold; ">std</span><span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>uint64_t pow1<span style="color:#008c00; ">0</span><span style="color:#808030; ">[</span><span style="color:#808030; ">]</span> <span style="color:#808030; ">=</span> <span style="color:#808030; ">{</span>
        1ull<span style="color:#808030; ">,</span>
        10ull<span style="color:#808030; ">,</span>
        100ull<span style="color:#808030; ">,</span>
        1000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">10</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">100</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1000</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">10</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">100</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1000</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">10</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">100</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1000</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span>'0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">10</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">100</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span><span style="color:#0000e6; ">'0000'</span>0000ull<span style="color:#808030; ">,</span>
        <span style="color:#008c00; ">1000</span><span style="color:#0000e6; ">'0000'</span><span style="color:#008c00; ">0000</span><span style="color:#0000e6; ">'0000'</span>0000ull
    <span style="color:#808030; ">}</span><span style="color:#696969; ">;</span>

    <span style="color:#004a43; ">for</span> <span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">int</span> i <span style="color:#808030; ">=</span> <span style="color:#008c00; ">0</span><span style="color:#696969; ">; i &lt; 64; ++i) {</span>
        auto <span style="color:#004a43; ">const</span> ub <span style="color:#808030; ">=</span> <span style="color:#800000; font-weight:bold; ">std</span><span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>uint64_t<span style="color:#808030; ">(</span>ceil_log10_pow2<span style="color:#808030; ">(</span>i<span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#696969; ">;</span>
        assert<span style="color:#808030; ">(</span>ub <span style="color:#808030; ">&lt;</span><span style="color:#808030; ">=</span> <span style="color:#008c00; ">19</span><span style="color:#808030; ">)</span><span style="color:#696969; ">;</span>
        <span style="color:#004a43; ">table</span>.entry<span style="color:#808030; ">[</span>i<span style="color:#808030; ">]</span> <span style="color:#808030; ">=</span> <span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>ub <span style="color:#808030; ">+</span> <span style="color:#008c00; ">1</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">&lt;</span><span style="color:#808030; ">&lt;</span> <span style="color:#008c00; ">52</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">-</span> <span style="color:#808030; ">(</span>pow1<span style="color:#008c00; ">0</span><span style="color:#808030; ">[</span>ub<span style="color:#808030; ">]</span> <span style="color:#808030; ">></span><span style="color:#808030; ">></span> <span style="color:#808030; ">(</span>i <span style="color:#808030; ">/</span> <span style="color:#008c00; ">4</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#696969; ">;</span>
    <span style="color:#808030; ">}</span>

    return <span style="color:#004a43; ">table</span><span style="color:#696969; ">;</span>
<span style="color:#808030; ">}</span>

constexpr inline auto digit_count_table <span style="color:#808030; ">=</span> generate_digit_count_table<span style="color:#808030; ">(</span><span style="color:#808030; ">)</span><span style="color:#696969; ">;</span>

<span style="color:#800000; font-weight:bold; ">int</span> floor_log2<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">std</span><span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>uint64_t n<span style="color:#808030; ">)</span> noexcept <span style="color:#808030; ">{</span>
    return <span style="color:#008c00; ">63</span> <span style="color:#808030; ">^</span> __builtin_clzll<span style="color:#808030; ">(</span>n<span style="color:#808030; ">)</span><span style="color:#696969; ">;</span>
<span style="color:#808030; ">}</span>

<span style="color:#800000; font-weight:bold; ">int</span> count_digit<span style="color:#808030; ">(</span><span style="color:#800000; font-weight:bold; ">std</span><span style="color:#808030; ">:</span><span style="color:#808030; ">:</span>uint64_t n<span style="color:#808030; ">)</span> noexcept <span style="color:#808030; ">{</span>
    return <span style="color:#800000; font-weight:bold; ">int</span><span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>digit_count_table.entry<span style="color:#808030; ">[</span>floor_log2<span style="color:#808030; ">(</span>n<span style="color:#808030; ">)</span><span style="color:#808030; ">]</span> <span style="color:#808030; ">+</span> <span style="color:#808030; ">(</span>n <span style="color:#808030; ">></span><span style="color:#808030; ">></span> <span style="color:#808030; ">(</span>floor_log2<span style="color:#808030; ">(</span>n<span style="color:#808030; ">)</span> <span style="color:#808030; ">/</span> <span style="color:#008c00; ">4</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">></span><span style="color:#808030; ">></span> <span style="color:#008c00; ">52</span><span style="color:#808030; ">)</span><span style="color:#696969; ">;</span>
<span style="color:#808030; ">}</span>
</pre>
<p></p>
</div>
</li>
</ol>
</li>
<li id="comment-586159" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-05T06:22:35+00:00">June 5, 2021 at 6:22 am</time></a> </div>
<div class="comment-content">
<p>Just a crazy idea&#8230; As far as I understand, <a href="https://en.wikipedia.org/wiki/Intel_BCD_opcode#In_x87" rel="nofollow ugc">Intel CPUs have (limited) BCD support</a>. I guess using it just to calculate the number of decimal digits is not all that fast (would need to be tested). But would &ldquo;itoa&rdquo; be faster that way?</p>
</div>
<ol class="children">
<li id="comment-586187" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-05T11:38:43+00:00">June 5, 2021 at 11:38 am</time></a> </div>
<div class="comment-content">
<p>I just tested this approach, and on my machine it is terribly slow. But it works 🙂</p>
<p><code>int slow_digit_count(uint32_t x) {<br/>
double d = x;<br/>
uint64_t y = 0;<br/>
asm("fbstp %0" : "=m" (y) : "t" (d) : "st");<br/>
return (67 - __builtin_clzll(y | 1)) &gt;&gt; 2;<br/>
}<br/>
</code></p>
<p>I doubt that such a &ldquo;itoa&rdquo; method would be fast.</p>
</div>
<ol class="children">
<li id="comment-586225" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas Müller Graf</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-05T19:35:01+00:00">June 5, 2021 at 7:35 pm</time></a> </div>
<div class="comment-content">
<p>Just FYI, I implemented a simple version of this &ldquo;use BCD opcode&rdquo; idea in the <a href="https://github.com/miloyip/itoa-benchmark" rel="nofollow ugc">itoa-benchmark</a>, and this seems to be about 10 times slower than the fastest implementation of itoa. It probably is one of the shortest (in number of CPU instructions), but the slowest.</p>
<p><code>t_inline void uint32toa_bcd(uint64_t x, char* out) {<br/>
double d = x;<br/>
asm("fbstp %0" : "=m" (out[0]) : "t" (d) : "st");<br/>
uint64_t y;<br/>
memcpy(&amp;y, out, sizeof(y));<br/>
int len = (67 - __builtin_clzll(y | 1)) &gt;&gt; 2;<br/>
out[len] = 0;<br/>
while (len &gt; 0) {<br/>
out[--len] = '0' + (y &amp; 0xf);<br/>
y &gt;&gt;= 4;<br/>
}<br/>
}<br/>
</code></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-586338" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-06T22:41:13+00:00">June 6, 2021 at 10:41 pm</time></a> </div>
<div class="comment-content">
<p>Another fun way to get approximate log10 is to put the increments in a bitmap (1 means log10 goes up in that range), and use CLZ and a shift to discard the bits above lg2. The popcount of the masked-off bits is the approximate log10 similar to 9/32*lg2.</p>
<p>I don&rsquo;t think this is faster than multiply and shift; the only possible time difference is multiply vs. popcount.</p>
</div>
</li>
<li id="comment-586472" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ef8df2187ebb0e7d66510151c17696c0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ef8df2187ebb0e7d66510151c17696c0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-08T16:40:04+00:00">June 8, 2021 at 4:40 pm</time></a> </div>
<div class="comment-content">
<p>I would observe that the definition of the lookup table is missing a &ldquo;const&rdquo; qualifier.<br/>
I would also want to look at where the table is placed in memory by the loader: if it&rsquo;s in a DATA section, it is necessarily going to live in a separate Read-Only page, and &ldquo;table[idx]&rdquo; is a memory reference that might go through a page fault.</p>
<p>Since for 32 bits the table has only a few entries, changing the lookup table to a switch statement might in fact be faster (if only because the search in the table would in fact only reference memory that is already in I-cache). This would need to be benchmarked, obviously.</p>
</div>
<ol class="children">
<li id="comment-586475" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-08T17:38:49+00:00">June 8, 2021 at 5:38 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>I would also want to look at where the table is placed in memory by<br/>
the loader: if it’s in a DATA section, it is necessarily going to live<br/>
in a separate Read-Only page, and “table[idx]” is a memory reference<br/>
that might go through a page fault.</p>
</blockquote>
<p>Do you know of an optimizing C compiler that would build the code in such a manner? That would seem incredibly wasteful.</p>
<blockquote>
<p>Since for 32 bits the table has only a few entries, changing the<br/>
lookup table to a switch statement might in fact be faster (if only<br/>
because the search in the table would in fact only reference memory<br/>
that is already in I-cache).</p>
</blockquote>
<p>I expect most optimizing compilers to turn a 32-entry switch/case into a table lookup. There might be exceptions, evidently, but my experience has been that there compilers are not shy about using tables to implement switch/case code.</p>
</div>
</li>
</ol>
</li>
<li id="comment-586490" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-08T22:58:31+00:00">June 8, 2021 at 10:58 pm</time></a> </div>
<div class="comment-content">
<p>I found that a naive approach (without a lookup table) actually beats all of the more advanced ones presented here, see <a href="https://godbolt.org/z/5W4xfqjGj" rel="nofollow ugc">https://godbolt.org/z/5W4xfqjGj</a>:</p>
<p><code>static inline int<br/>
bh_ilog10_32_naive(uint32_t x)<br/>
{<br/>
return (x &lt; 10 ? 1 :<br/>
(x &lt; 100 ? 2 :<br/>
(x &lt; 1000 ? 3 :<br/>
(x &lt; 10000 ? 4 :<br/>
(x &lt; 100000 ? 5 :<br/>
(x &lt; 1000000 ? 6 :<br/>
(x &lt; 10000000 ? 7 :<br/>
(x &lt; 100000000 ? 8 :<br/>
(x &lt; 1000000000 ? 9 :<br/>
10)))))))));<br/>
}<br/>
</code></p>
<p>Result from local runs:</p>
<p><code>bh_ilog10_32_naive: 1.000000e+00 +/- 1e-05<br/>
bh_ilog10_32d: 1.452496e+00 +/- 5e-06<br/>
bh_ilog10_32b: 1.691123e+00 +/- 1e-05<br/>
bh_ilog10_32c: 2.195664e+00 +/- 3e-05<br/>
bh_ilog10_32a: 2.212707e+00 +/- 3e-05<br/>
</code></p>
<p>I&rsquo;m guessing that this is due to accessing memory being expensive. Maybe I&rsquo;ve done something wrong with the benchmark, please correct me if something is wrong.</p>
</div>
<ol class="children">
<li id="comment-586492" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-08T23:10:03+00:00">June 8, 2021 at 11:10 pm</time></a> </div>
<div class="comment-content">
<p>Actually, I&rsquo;ve put the relevant benchmark into a quick-bench version, that should be easier to understand than my benchmarking library:</p>
<p><a href="https://www.quick-bench.com/q/QZh-vs3H77D7hDvJL8Vn3FJNPj4" rel="nofollow ugc">https://www.quick-bench.com/q/QZh-vs3H77D7hDvJL8Vn3FJNPj4</a></p>
<p>This still has the same result.</p>
</div>
<ol class="children">
<li id="comment-586493" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6504fad0830c1dd03086ee35097cea11?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">camel-cdr</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-08T23:37:21+00:00">June 8, 2021 at 11:37 pm</time></a> </div>
<div class="comment-content">
<p>Ok, I think I get it now.<br/>
I generate high entropy random numbers and thus numbers are likely very large, which means that the branch predictor can be quite accurate.<br/>
If I change the random number generation to</p>
<p><code>1 &lt;&lt; (bench_hash64(i)&amp;63);<br/>
</code></p>
<p>the naive approach is now much slower.</p>
<p>I assume that the usual use case doesn&rsquo;t call the function repeatedly, so the branch predictor will have a harder time, although this should probably be benchmarked with a real world use case.</p>
</div>
<ol class="children">
<li id="comment-586494" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-08T23:45:33+00:00">June 8, 2021 at 11:45 pm</time></a> </div>
<div class="comment-content">
<p>There are definitively cases where the number of digits is predictable and in such cases, a branchy approach will be faster. Your scenario is one of those.</p>
</div>
</li>
<li id="comment-654307" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/92bfa2eb48d43eb81a8609279498c735?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/92bfa2eb48d43eb81a8609279498c735?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">CB</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-25T20:48:38+00:00">August 25, 2023 at 8:48 pm</time></a> </div>
<div class="comment-content">
<p>A classic case of benchmarking your benchmark. The majority of &ldquo;benchmarks&rdquo; I see online fall into that category.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-586698" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-10T20:51:16+00:00">June 10, 2021 at 8:51 pm</time></a> </div>
<div class="comment-content">
<p>I have this idea but can&rsquo;t figure it out yet, i am trying to halve the table or completely removing it, will be possible because by shifting the index of highest bit to the right by 2 (division by 4) we end up with value less than 16, the problem is we have is the repeated values (0,4,9,14.), if there is a mathematical trick to remove (differentiate) these repeated values, we can either minimize the table into 15-16 items or remove the table completely by building a value from our new index and then compare, if a cheap trick can be found then it will be table-less and branchless algorithm, <em>a cheap trick like shift the index by one then subtract again</em></p>
<blockquote><p>
<code> 1 : 1 0 0<br/>
10 : 2 3 0<br/>
100 : 3 6 1<br/>
1000 : 4 9 2<br/>
10000 : 5 13 3<br/>
100000 : 6 16 4<br/>
1000000 : 7 19 4<br/>
10000000 : 8 23 5<br/>
100000000 : 9 26 6<br/>
1000000000 : 10 29 7<br/>
10000000000 : 11 33 8<br/>
100000000000 : 12 36 9<br/>
1000000000000 : 13 39 9<br/>
10000000000000 : 14 43 10<br/>
100000000000000 : 15 46 11<br/>
1000000000000000 : 16 49 12<br/>
10000000000000000 : 17 53 13<br/>
100000000000000000 : 18 56 14<br/>
100000<br/>
</code>
</p></blockquote>
</div>
</li>
<li id="comment-586748" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/95a20051ae9a0bd56b2feb2d6a3763f8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-11T08:51:53+00:00">June 11, 2021 at 8:51 am</time></a> </div>
<div class="comment-content">
<p>Found a cheap one but with multiplication, the last column is<br/>
Log2(x) * 37 &gt;&gt; 7<br/>
and here the result</p>
<p><code> 1 : 1 0 0 0<br/>
10 : 2 3 1 0<br/>
100 : 3 6 3 1<br/>
1000 : 4 9 4 2<br/>
10000 : 5 13 6 3<br/>
100000 : 6 16 8 4<br/>
1000000 : 7 19 9 5<br/>
10000000 : 8 23 11 6<br/>
100000000 : 9 26 13 7<br/>
1000000000 : 10 29 14 8<br/>
10000000000 : 11 33 16 9<br/>
100000000000 : 12 36 18 10<br/>
1000000000000 : 13 39 19 11<br/>
10000000000000 : 14 43 21 12<br/>
100000000000000 : 15 46 23 13<br/>
1000000000000000 : 16 49 24 14<br/>
10000000000000000 : 17 53 26 15<br/>
100000000000000000 : 18 56 28 16<br/>
1000000000000000000 : 19 59 29 17<br/>
9 : 1 3 0 0<br/>
99 : 2 6 1 1<br/>
999 : 3 9 2 2<br/>
9999 : 4 13 3 3<br/>
99999 : 5 16 4 4<br/>
999999 : 6 19 4 5<br/>
9999999 : 7 23 5 6<br/>
99999999 : 8 26 6 7<br/>
999999999 : 9 29 7 8<br/>
9999999999 : 10 33 8 9<br/>
99999999999 : 11 36 9 10<br/>
999999999999 : 12 39 9 11<br/>
9999999999999 : 13 43 10 12<br/>
99999999999999 : 14 46 11 13<br/>
999999999999999 : 15 49 12 14<br/>
9999999999999999 : 16 53 13 15<br/>
99999999999999999 : 17 56 14 16<br/>
999999999999999999 : 18 59 14 17<br/>
</code></p>
<p>Now the table can be only 18 entry, the multiplication above i think can be replaced with better approach, but it is not my main target, the target is to remove the table now by either of :<br/>
1) Can we calculate 10^n (for 100&#8230; or 999&#8230;) with few cycles, will it be worth removing memory access.<br/>
2) The fact of the decimal 10 is 4 bits means 10^n always is far by 3 or 4 bits from 10^(n+1) and 10^(n-1), means we have 2 bits to maneuverer between where x is equal or bigger 2^(Log10(x)) yet is is smaller then 2^(Log10(x)+1), this is coming from x/10 &lt; x/8, so by changing a the simple compare against value to compare against a rank of neighbors, can guess the length the rank of x.<br/>
3) Because we don&rsquo;t need full proven mathematical theory to for any n all what we need is magical numbers just like the mult by 37, so we need these 18 values to be calculated or approximated to fix one single profile of usage, looking at the bits of these values (10,100&#8230; and 9,99,999&#8230;) we see a nice pattern where all bits after than the highest one is bigger than previous value except for one single case the one between 15-16 in 99xx.. table or 16-17 in 10xx.. ,now trying to apply the logic like the above case (2), the following is true for all except that one case x-2^(Log2(x)) &gt; 10^(Log10(x)-1), is there a way to use this ?</p>
</div>
</li>
<li id="comment-587106" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/plokhotnyuk" class="url" rel="ugc external nofollow">Andriy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-14T10:47:45+00:00">June 14, 2021 at 10:47 am</time></a> </div>
<div class="comment-content">
<p>I was able to simplify int_log2 function to just counting of leading zero bits by revering the table and adding an additional table value for 0:<br/>
<a href="https://github.com/plokhotnyuk/jsoniter-scala/pull/749/files#diff-4e32fbdaa814b6b0b8e22a1b1440bb2928e50a6e1482e0d56c08d606812b625bR1982" rel="nofollow ugc">https://github.com/plokhotnyuk/jsoniter-scala/pull/749/files#diff-4e32fbdaa814b6b0b8e22a1b1440bb2928e50a6e1482e0d56c08d606812b625bR1982</a></p>
</div>
<ol class="children">
<li id="comment-587119" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-14T12:51:33+00:00">June 14, 2021 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the link.</p>
</div>
<ol class="children">
<li id="comment-587249" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/310888ddd541f84065eb6fa2a820d09d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/plokhotnyuk" class="url" rel="ugc external nofollow">Andriy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-06-15T12:21:15+00:00">June 15, 2021 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p><a href="https://github.com/plokhotnyuk/jsoniter-scala/pull/749/files#diff-4e32fbdaa814b6b0b8e22a1b1440bb2928e50a6e1482e0d56c08d606812b625bR2112-R2128" rel="nofollow ugc">Here</a> is a table with length == 65 that used to calculate digit count for up to 58-bit numbers using the following function:</p>
<p>def f(x: Long): Int = (offsets(java.lang.Long.numberOfLeadingZeros(x)) + x &gt;&gt; 58).toInt</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
