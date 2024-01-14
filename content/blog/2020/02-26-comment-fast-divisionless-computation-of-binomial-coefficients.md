---
date: "2020-02-26 12:00:00"
title: "Fast divisionless computation of binomial coefficients"
index: false
---

[4 thoughts on &ldquo;Fast divisionless computation of binomial coefficients&rdquo;](/lemire/blog/2020/02-26-fast-divisionless-computation-of-binomial-coefficients)

<ol class="comment-list">
<li id="comment-493428" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/293aadf0d102ec9bda99ea8e13f2f01a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">George Spelvin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-02T05:44:01+00:00">March 2, 2020 at 5:44 am</time></a> </div>
<div class="comment-content">
<p>I know you know this, but to clarify for others: a division may require a multiply and two shifts (case 3 in the Granlund-Montgomery-Warren algorithm) or more (case 4). Computing binomial coefficients can use a single shift because it falls into the special case of a division which is <em>known a priori to be exact</em>.</p>
<p>Also, you can eke a tiny bit more range out of <code>fastbinomial(n,k)</code> if you do the multiplication by <code>f.inverse</code> before the shift.</p>
<p>The largest value which must be represented internally within <code>fastbinomial</code> is <code>fastbinomial(n,k) * k</code>; if that overflows 64 bits, the result will be inaccurate. However, the overflow does not matter for the multiplication by the inverse, only the shift, so only <code>fastbinomial(n,k) &lt;&lt; f.shift</code> needs to fit into 64 bits.</p>
</div>
<ol class="children">
<li id="comment-493553" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-02T20:43:25+00:00">March 2, 2020 at 8:43 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>Also, you can eke a tiny bit more range out of fastbinomial(n,k) if you do the multiplication by f.inverse before the shift.</p>
</blockquote>
<p>I do not understand this comment. Can you elaborate?</p>
</div>
</li>
<li id="comment-497437" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/aaa22c9078dd33f3eb98a5f69dc2820f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/aaa22c9078dd33f3eb98a5f69dc2820f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://ro-che.info/" class="url" rel="ugc external nofollow">Roman Cheplyaka</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-22T12:29:08+00:00">March 22, 2020 at 12:29 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Computing binomial coefficients can use a single shift because it falls into the special case of a division which is known a priori to be exact.
</p></blockquote>
<p>And if anyone is wondering why the division is exact (like I was), I wrote up an explanation here: <a href="https://ro-che.info/articles/2020-03-22-binomial-coefficients-integer-division" rel="nofollow ugc">https://ro-che.info/articles/2020-03-22-binomial-coefficients-integer-division</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-493920" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2e6f0d4936f7973387c887eed8b4d1aa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2e6f0d4936f7973387c887eed8b4d1aa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sujay Jayakar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-04T22:25:35+00:00">March 4, 2020 at 10:25 pm</time></a> </div>
<div class="comment-content">
<p>I was just working on a similar problem, and for my application I have <code>0 &lt;= n &lt;= 64</code> and <code>0 &lt;= k &lt;= 64</code>, and storing a lookup table is acceptable. Here&rsquo;s a trick I used for using symmetry to only store half of each row.</p>
<p>We start by precomputing all <code>binom(n, k)</code> via the recurrence <code>B(n, k) = B(n - 1, k - 1) + B(n - 1, k)</code> and <code>B(n, n) = 1</code> and concatenating the rows into a flat array. Then, computing <code>B(n, k)</code> involves looking up the start of the <code>n</code>th row and taking the <code>k</code>th element of that row. The <code>i</code>th row has length <code>i + 1</code>, so the <code>n</code>th row starts at <code>1 + 2 + ... + n</code>, which is <code>n * (n + 1) / 2</code>.</p>
<p><code>1<br/>
1 1<br/>
1 2 1<br/>
1 3 3 1<br/>
1 4 6 4 1<br/>
</code></p>
<p>But, we&rsquo;d like to store only the first half of each row, computing <code>B(n, k)</code> as <code>B(n, min(k, n - k))</code>.</p>
<p><code>1<br/>
1<br/>
1 2<br/>
1 3<br/>
1 4 6<br/>
</code></p>
<p>Now, the length of the <code>n</code>th row is <code>ceil((i + 1) / 2)</code>, and since <code>ceil((n + 1) / m) = floor(n / m) + 1</code>, we can compute this as <code>n // 2 + 1</code> using integer division. To compute the start of the <code>n</code>th row in our table, we want to compute <code>\sum_{i=0}^{n-1} {i // 2 + 1}</code> in closed form.</p>
<p><code>n: 0 1 2 3 4 5 ...<br/>
row_len: 1 1 2 2 3 3 ...<br/>
row_start: 0 1 2 4 6 9 ...<br/>
</code></p>
<p>If we have even <code>n = 2m</code>, then the sum of the previous <code>row_len</code>s is just <code>2 * (1 + 2 + ... m)</code>:</p>
<p><code>row_start(2m) = 2 * (1 + 2 + ... + m)<br/>
= 2 * m * (m + 1) / 2<br/>
= m * (m + 1)<br/>
</code></p>
<p>Then, if we have odd <code>n = 2m + 1</code>, we need to add in <code>row_len(2m)</code>.</p>
<p><code> row_start(2m + 1) = m * (m + 1) + row_len(2m)<br/>
= m * (m + 1) + (m + 1)<br/>
= (m + 1) * (m + 1)<br/>
</code></p>
<p>So we can now combine the two cases:</p>
<p><code> row_start(n) = (n // 2 + n % 2) * (n // 2 + 1)<br/>
</code></p>
<p>The resulting table is compact, and querying it is efficient.</p>
<p><code>fn binomial_coefficient(n: u8, k: u8) -&gt; u64 {<br/>
let (q, r) = (n as usize / 2, n as usize % 2);<br/>
let row_start = (q + r) * (q + 1);<br/>
let k = cmp::min(k, n - k) as usize;<br/>
COEFFICIENT_TABLE[row_start + k]<br/>
}<br/>
</code></p>
<p>My code is in this <a href="https://github.com/tov/succinct-rs/pull/10" rel="nofollow ugc">pull request</a>.</p>
</div>
</li>
</ol>
