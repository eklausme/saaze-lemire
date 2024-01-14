---
date: "2011-08-11 12:00:00"
title: "Fast computation of scalar products, and some lessons in optimization"
index: false
---

[10 thoughts on &ldquo;Fast computation of scalar products, and some lessons in optimization&rdquo;](/lemire/blog/2011/08-11-fast-computation-of-scalar-products-and-some-lessons-in-optimization)

<ol class="comment-list">
<li id="comment-54629" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/76b44c7bca8bbfde592937ad891d7140?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/76b44c7bca8bbfde592937ad891d7140?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alejandro Weinstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T09:42:39+00:00">August 11, 2011 at 9:42 am</time></a> </div>
<div class="comment-content">
<p>The usual advise I&rsquo;ve read is to use a linear algebra library, like LAPACK, for this type of operations. Do you know what type of &ldquo;trick&rdquo; LAPACK et. al use?</p>
</div>
</li>
<li id="comment-54630" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T09:57:41+00:00">August 11, 2011 at 9:57 am</time></a> </div>
<div class="comment-content">
<p>@Weinstein</p>
<p>I have no idea what LAPACK uses. For various reasons, I rarely use numerical libraries.</p>
</div>
</li>
<li id="comment-54632" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T10:05:42+00:00">August 11, 2011 at 10:05 am</time></a> </div>
<div class="comment-content">
<p>@John</p>
<p>Indeed. Sometimes, it is almost as if the computations themselves were free, but the bandwidth is very tight.</p>
</div>
</li>
<li id="comment-54636" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T11:30:11+00:00">August 11, 2011 at 11:30 am</time></a> </div>
<div class="comment-content">
<p>@cb</p>
<p><em>In any case, trying to count the clocks of arithmetic operations is not remotely the way to write fast code these days.</em></p>
<p>I agree. This was the main point of my post.</p>
<p><em>This is not really how most modern CPU&rsquo;s work.</em></p>
<p>We can play semantic games, but that is not much fun. Effectively, while one multiplication is being computed, another multiplication begins so that even though 3 cycles are required to complete an integer multiplication, you can execute two multiplications in 4 cycles. I call this parallelism.</p>
<p><em>On modern Intel chips multiplication simply takes only 1 clock, no parallelism required, multiplication is just fast.</em></p>
<p>The latency for multiplication on Intel processors is at least 3 cycles (for integers), and 1 cycle for additions. (Reference: <a href="http://www.intel.com/products/processor/manuals/" rel="nofollow ugc">http://www.intel.com/products/processor/manuals/</a>, check &ldquo;Intel 64 and IA-32 Architectures Optimization Reference Manual&rdquo;). Floating point multiplications are more expensive (at least 5 cycles). We could get technical and dig into SSE instructions and so on, but that wasn&rsquo;t my intent. The throughput is often 1 cycle, of course.</p>
</div>
</li>
<li id="comment-54631" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a7f4f9dcbbf1d46d660b0a6c98435751?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.johndcook.com/blog/" class="url" rel="ugc external nofollow">John</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T09:58:28+00:00">August 11, 2011 at 9:58 am</time></a> </div>
<div class="comment-content">
<p>Another factor is that in a number crunching application, most of the time is spent moving data around, not crunching numbers. Clever software rearranges calculations to do as much with data as it can while the data is in cache.</p>
</div>
</li>
<li id="comment-54633" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e33dbedde1a703bee20205de8c397199?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e33dbedde1a703bee20205de8c397199?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://drtomcrick.wordpress.com" class="url" rel="ugc external nofollow">Tom Crick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T10:08:16+00:00">August 11, 2011 at 10:08 am</time></a> </div>
<div class="comment-content">
<p>Once again we are reminded of Knuth:</p>
<p>&ldquo;We should forget about small efficiencies, say about 97% of the time: premature optimization is the root of all evil&rdquo;</p>
</div>
</li>
<li id="comment-54634" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c940f2dce578e9131f66827bef43eb2a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c940f2dce578e9131f66827bef43eb2a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">cb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T11:00:25+00:00">August 11, 2011 at 11:00 am</time></a> </div>
<div class="comment-content">
<p>&ldquo;It is fundamentally flawed because modern processors are superscalar. It may take 3 cycles to complete a multiplication, but while the multiplication is being computed, other operations can be started. The scalar product is highly parallelizable: while one multiplication is computed, other multiplications can be computed (in parallel).&rdquo;</p>
<p>This is not really how most modern CPU&rsquo;s work. They almost always only have one multiplier unit, because multipliers are somewhat large on the die.</p>
<p>On some chips multiplication has long latency (7-9 clocks) but still has throughput of 1 mul per clock because of pipelining.</p>
<p>Pipelining is in some ways similar to parallelism but is not quite the same thing.</p>
<p>On modern Intel chips multiplication simply takes only 1 clock, no parallelism required, multiplication is just fast. (division is another story &#8211; that&rsquo;s still slow)</p>
<p>In any case, trying to count the clocks of arithmetic operations is not remotely the way to write fast code these days. Writing fast code is something like :</p>
<p>1. use a better algorithm (use threads)<br/>
2. rearrange memory layout for better cache use<br/>
3. make data more compact<br/>
4. remove branches<br/>
5. remove data dependency chains<br/>
6. use SIMD<br/>
7. use CUDA or SPUs or what have you<br/>
8. remove divisions, float-to-ints very expensive ops like that</p>
<p>we just never worry about things like multiplies, they are a tiny fraction of a rounding error in overall speed.</p>
</div>
</li>
<li id="comment-54637" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a0dfee97295703f0a88f45b09cc21b9d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a0dfee97295703f0a88f45b09cc21b9d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Josh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T11:58:28+00:00">August 11, 2011 at 11:58 am</time></a> </div>
<div class="comment-content">
<p>I think a better justification for algorithms that focus on reducing multiplications (as so often show up in literature in algebraic complexity theory) is: what if your &ldquo;numbers&rdquo; aren&rsquo;t just single-precision ints? For example, what if the entries in your vector are polynomials? I believe (though I have not tested) that multiplying polynomials is significantly more time-consuming in practice than adding them. I believe this is also true for &ldquo;big ints&rdquo; (multi-precision integers, as used e.g. in cryptography), but again I have not tested this.</p>
<p>The point of your post is still well-taken, I just wanted to add that there may be other situations that arise where the multiplication-minimizing algorithm actually does perform better.</p>
</div>
</li>
<li id="comment-54638" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f11f029ed37378028bd610083c3ff336?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f11f029ed37378028bd610083c3ff336?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://fph.altervista.org" class="url" rel="ugc external nofollow">Federico Poloni</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-08-11T14:38:41+00:00">August 11, 2011 at 2:38 pm</time></a> </div>
<div class="comment-content">
<p>@Josh: yes, multiplying two big-ints is more expensive than adding them, exactly like polynomials. In fact, the two problems are pretty similar &#8211; bigints are &ldquo;more or less&rdquo; polynomials in the variable x=10&#8230;</p>
</div>
</li>
<li id="comment-552685" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/549416b3453edc8fc9fdaf7462ae88f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/549416b3453edc8fc9fdaf7462ae88f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobias Becker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-09-15T12:28:44+00:00">September 15, 2020 at 12:28 pm</time></a> </div>
<div class="comment-content">
<p>Is that the 1968 Winograd algorithm? By the way, your math symbols are totally broken, which makes following the formulas really hard.</p>
</div>
</li>
</ol>
