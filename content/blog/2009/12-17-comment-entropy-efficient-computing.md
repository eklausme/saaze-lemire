---
date: "2009-12-17 12:00:00"
title: "Entropy-efficient Computing"
index: false
---

[27 thoughts on &ldquo;Entropy-efficient Computing&rdquo;](/lemire/blog/2009/12-17-entropy-efficient-computing)

<ol class="comment-list">
<li id="comment-52018" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T10:36:08+00:00">December 17, 2009 at 10:36 am</time></a> </div>
<div class="comment-content">
<p>@Mikhalev I think it is entirely possible to address this problem from first principles, independently of specific hardware. Please see the two references I have added to my post and in particular Frank 2002.</p>
<p>More recently, there seems to be claims that quantum computation is reversible, thus does not produce any entropy (heat).</p>
</div>
</li>
<li id="comment-52019" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T10:40:00+00:00">December 17, 2009 at 10:40 am</time></a> </div>
<div class="comment-content">
<p>@JN Shannon&rsquo;s entropy is related to Boltzman&rsquo;s entropy. If you lower the entropy of an array in memory, then some other entropy must increase, thus heat must be generated.</p>
<p>If you raise the entropy of some array, then I expect there is no need (in principle) for much heat dissipation.</p>
</div>
</li>
<li id="comment-52021" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T11:17:03+00:00">December 17, 2009 at 11:17 am</time></a> </div>
<div class="comment-content">
<p>@Leifer</p>
<p>Given a fixed-memory computer, I don&rsquo;t see how computation can be reversible. Any reference to this demonstration by Charlie Bennett? </p>
<p>As for the sorted array versus the shuffled array, I am working from a probabilistic model. Suppose the orderings of an array were picked at random. What is the probability that it will be sorted?</p>
</div>
</li>
<li id="comment-52022" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e5cbb32cf54a237e409a3608fc2f88d1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e5cbb32cf54a237e409a3608fc2f88d1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://michaelnielsen.org/blog/" class="url" rel="ugc external nofollow">Michael Nielsen</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T12:25:43+00:00">December 17, 2009 at 12:25 pm</time></a> </div>
<div class="comment-content">
<p>C. H. Bennett, &ldquo;Logical reversibility of computation&rdquo;, IBM J. Res. Dev., vol 17, pp 525-532 (1973).</p>
<p>It&rsquo;s a classic. The trade-off between memory and reversibility has subsequently been studied at some length; I&rsquo;ve only skimmed that literature, though, and don&rsquo;t know the best references.</p>
<p>Lecerf also proved results about reversibility 10 years or so before Bennett. The paper is in French, though, which means I&rsquo;ve never read it. I wish a translation were available.</p>
</div>
</li>
<li id="comment-52023" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T13:02:25+00:00">December 17, 2009 at 1:02 pm</time></a> </div>
<div class="comment-content">
<p>@Nielsen</p>
<p>Thanks for the reference.</p>
<p>Fair enough. Reversible computations can buy high entropic efficiency. However, we don&rsquo;t work with such machines. My hard drive generates heat when I write to it.</p>
<p>So, my question still stand.</p>
</div>
</li>
<li id="comment-52025" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T13:44:13+00:00">December 17, 2009 at 1:44 pm</time></a> </div>
<div class="comment-content">
<p><i>shuffling an array takes time O(n2) whereas sorting it takes time O(n log n)</i></p>
<p>Depends&#8230;<br/>
For a <b>given</b> key size sorting an array is only <i>O(n)</i>, the <a href="https://en.wikipedia.org/wiki/Bucket_sort" rel="nofollow">bucket sort</a>!<br/>
This seemingly counterintuitive fact is because the sorting time is actually proportional to the total <i>keys volume</i> (key size x number of keys).<br/>
Usually the keys are way more larger than the minimum needed value <i>2**n bits</i> so both statements are &ldquo;true&rdquo; sorting is <i>O(n</i> log <i>n)</i> in the worst case and <i>O(n)</i> in most practical cases. 🙂</p>
</div>
</li>
<li id="comment-52026" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T13:54:56+00:00">December 17, 2009 at 1:54 pm</time></a> </div>
<div class="comment-content">
<p>@Kevembuangga True. Presumably, you can also shuffle an array quite fast if there are few distinct values.</p>
</div>
</li>
<li id="comment-52027" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T14:05:56+00:00">December 17, 2009 at 2:05 pm</time></a> </div>
<div class="comment-content">
<p>Oops! I made it <i>upside down</i> the minimum key size is <i>log2(n) bits</i> not 2**n.<br/>
BTW, a bucket sort analysis is <a href="http://www.personal.kent.edu/~rmuhamma/Algorithms/MyAlgorithms/Sorting/bucketSort.htm" rel="nofollow">here</a>.</p>
</div>
</li>
<li id="comment-52028" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.google.com/reader/about/" class="url" rel="ugc external nofollow">Philippe Beaudoin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T14:22:17+00:00">December 17, 2009 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>rst I wanted to mention reversible computing&#8230; But then it stroke me as something we, computer scientists, do very often: refer back to theoretical results.</p>
<p>While these are great to get a strong insight on a problem, limiting our vision to theoretical results can sometime stop us from investigating problems on which we can make progress and have significant impact on the world. Last year I listened to a talk by UBC&rsquo;s Kevin Leyton-Brown on empirical algorithms. To quote from his webpage: &ldquo;Despite the fact that algorithms are human artifacts, I believe that their theoretical analysis should be supplemented using the same approaches that are used to study natural phenomena.&rdquo; (<a href="http://people.cs.ubc.ca/~kevinlb/research.html" rel="nofollow ugc">http://people.cs.ubc.ca/~kevinlb/research.html</a>)</p>
<p>I encourage you to read the rest. He makes the point that very complex algorithms have been devised to solve computationally hard problems. For these algorithms, empirical experiments can often give us a better insight into which variations are better, in practice, for the kind of problems we&rsquo;re facing.</p>
<p>The computers we use &#8212; together with their array of peripherals &#8212; are also complex and ever-changing beasts. A principled and empirical study of their energy efficiency under different algorithms and different design decisions strikes me as an interesting research project. Is quicksort significantly less energy efficient than mergesort? Is there a way to design software as to minimize energy consuption? Are there &ldquo;best practices&rdquo; we can put in place so that both execution time and energy efficiency can be taken into account in a design decision? After all, the goal is to minimize money&#8230; And money is not just about time anymore.</p>
</div>
</li>
<li id="comment-52029" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5dd2c5b46b528a1db0482f280670a84b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.google.com/reader/about/" class="url" rel="ugc external nofollow">Philippe Beaudoin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T14:23:22+00:00">December 17, 2009 at 2:23 pm</time></a> </div>
<div class="comment-content">
<p>Missing from the beginning of my comment:</p>
<p>At first [&#8230;]</p>
</div>
</li>
<li id="comment-52030" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T14:49:34+00:00">December 17, 2009 at 2:49 pm</time></a> </div>
<div class="comment-content">
<p>Thank you Philippe.</p>
</div>
</li>
<li id="comment-52031" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d7bcda27533da25e5e0183de67b2206?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d7bcda27533da25e5e0183de67b2206?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Seb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T15:08:22+00:00">December 17, 2009 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>Such awesome folks in this comment thread! I envy you Daniel. Just sayin&rsquo;.</p>
</div>
</li>
<li id="comment-52016" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c37c50011af6c1e723d1c2252a1f9484?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c37c50011af6c1e723d1c2252a1f9484?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.sci-blog.com" class="url" rel="ugc external nofollow">Alex Mikhalev</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T10:20:23+00:00">December 17, 2009 at 10:20 am</time></a> </div>
<div class="comment-content">
<p>There are several measures of the entropy, mostly known in CS is Shennon&rsquo;s entropy. I have attempted to apply this kind entropy analysis to algorithms, but have not progress too far &#8211; basically it is possible to calculate entropy of the function output using histograms and dictionaries as in image processing. But how will you choose between 110 functions for same problem?<br/>
I am not sure you would like to calculate Boltzman&rsquo;s entropy for the algorithm as algorithms can be implemented not on common hardware and thus thermodynamics entropy will be different.<br/>
But if I am going to minimize Boltzman&rsquo;s entropy I would start from vectorisation and minimization of O number, then moving into hardware level optimization such as SSE2 instruction and so on.</p>
</div>
</li>
<li id="comment-52017" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77c9e732921aac0466d328b60c41c0e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77c9e732921aac0466d328b60c41c0e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JN</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T10:35:26+00:00">December 17, 2009 at 10:35 am</time></a> </div>
<div class="comment-content">
<p>Daniel, </p>
<p>I&rsquo;m not sure I follow your reasoning on shuffling without entropy cost. I assume that &ldquo;entropy cost&rdquo; would be defined as the generation of thermodynamic entropy, as that is the result of converting usable energy to unusable. </p>
<p>We must make a distinction between thermodynamic entropy and information entropy in this case. I would assume that any process carried by a computer that involves the conversion of electrical power to heat will generate entropy. Even if shuffling would be performed without energy use, the information entropy of the shuffled array is higher than the original. </p>
<p>JN</p>
</div>
</li>
<li id="comment-52020" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0a40f01ab314056477ef1b320cbe211?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0a40f01ab314056477ef1b320cbe211?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mattleifer.info" class="url" rel="ugc external nofollow">Matt Leifer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T11:08:43+00:00">December 17, 2009 at 11:08 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t understand the distinction between shuffling and sorting. Didn&rsquo;t Charlie Bennett show that any computation can be effected reversibly in principle? If this is correct, then the theoretical limit on entropy production for any computation is zero. </p>
<p>Regarding quantum computation, it is no more inherently reversible or irreversible than classical computation. Early on in QC research there were claims that QC *had* to be reversible due to the unitarity of the dynamics, unlike classical computing, which could be done either reversibly or irreversibly. However, this ignored the possibility of using measurements within the computation. There are both reversible and irreversible models of quantum computation, just as there are in the classical case. For example, the cluster state model is definitely irreversible, whereas the circuit model is reversible. The claims you are referring to are probably being made in the context of the quantum circuit model, since this is the most common model that is used. However, in this case, it should be absolutely no surprise that it is reversible because it is a simple generalization of the *classical* reversible circuit model.</p>
</div>
</li>
<li id="comment-52024" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d0a40f01ab314056477ef1b320cbe211?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d0a40f01ab314056477ef1b320cbe211?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mattleifer.info" class="url" rel="ugc external nofollow">Matt Leifer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-17T13:09:46+00:00">December 17, 2009 at 1:09 pm</time></a> </div>
<div class="comment-content">
<p>OK, that makes sense now. I didn&rsquo;t get the fixed memory bit before. </p>
<p>Does anyone know to what extent fixed memory quantum computing has been studied? I mean, I know of a few results about memory and time tradeoffs for particular algorithms, but they all assume that memory scales with input size. Can we do any quantum computation with constant memory? Given that it impacts reversibility, it seems like you might need to use some clever tricks to get it to work.</p>
</div>
</li>
<li id="comment-52037" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T07:59:02+00:00">December 18, 2009 at 7:59 am</time></a> </div>
<div class="comment-content">
<p>@Kujala </p>
<p>(1) Suppose an algorithm runs faster, but keeps writing to disk large data structures, should you prefer it to an algorithm that avoids writing to disk as much as possible, but runs slower? (For example, the second algorithm might be using compression.)</p>
<p>(2) If you can use 4 CPUs to cut the running time in half, is that a good deal entropy-wise?</p>
</div>
</li>
<li id="comment-52035" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/474a07d229cb068d7d7d0475a221fd33?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/474a07d229cb068d7d7d0475a221fd33?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J Kujala</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T03:07:50+00:00">December 18, 2009 at 3:07 am</time></a> </div>
<div class="comment-content">
<p>If we want to minimize heat generation, then just do as little work as possible. So it goes reduces to time complexity in theory? </p>
<p>In practise those crude tricks of improving hardware are likely to be best. Also, teaching programmers to use tricks such as doing work in bursts so that hardware is not on all the time.</p>
</div>
</li>
<li id="comment-52036" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c37c50011af6c1e723d1c2252a1f9484?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c37c50011af6c1e723d1c2252a1f9484?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.sci-blog.com" class="url" rel="ugc external nofollow">Alex Mikhalev</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T05:03:09+00:00">December 18, 2009 at 5:03 am</time></a> </div>
<div class="comment-content">
<p>Daniel thank you very much for this discussion. The connection between Boltzman entropy and Shannon entropy is fairly interesting and important for me personally and is interesting scientific project. I will check references and will try to made it practical, as I need the new scientific ways to choose between several algorithms for one problem.</p>
</div>
</li>
<li id="comment-52039" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T11:22:04+00:00">December 18, 2009 at 11:22 am</time></a> </div>
<div class="comment-content">
<p>@Itman</p>
<p>That&rsquo;s true. Shuffling an array can be done in linear time. I fixed my post (after 2000 people saw my mistake&#8230; there is a lesson somewhere&#8230;)</p>
<p>No sure what I was thinking about&#8230;</p>
</div>
</li>
<li id="comment-52041" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T11:48:44+00:00">December 18, 2009 at 11:48 am</time></a> </div>
<div class="comment-content">
<p>@Itman Because the shuffled array has less or as much entropy as the initial array (Boltzman&rsquo;s entropy ). It does not take work to shuffle the molecules of a gas, for example. It takes work to organize these molecules into a crystal though.</p>
</div>
</li>
<li id="comment-52043" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T13:40:26+00:00">December 18, 2009 at 1:40 pm</time></a> </div>
<div class="comment-content">
<p>@Cyril</p>
<p>Given that I cannot get away by saying that sorting is in O(n log n), I would say that you are right to have faith in this blog. There is intense peer review!</p>
<p>I think that the Safari bug went away with the more recent versions of the browser.</p>
</div>
</li>
<li id="comment-52038" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T11:17:37+00:00">December 18, 2009 at 11:17 am</time></a> </div>
<div class="comment-content">
<p>Daniel,<br/>
If I understand it correctly, a random shuffling takes only n swaps and n calls to rand() function. How can it be O(n^2)?</p>
</div>
</li>
<li id="comment-52040" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Itman</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T11:36:50+00:00">December 18, 2009 at 11:36 am</time></a> </div>
<div class="comment-content">
<p>@Daniel. No worries. We all make mistakes.<br/>
PS: I also wonder why would you expect energy-less shuffling?</p>
</div>
</li>
<li id="comment-52042" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e21ae50ae7cd39b695ada61872bbe696?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e21ae50ae7cd39b695ada61872bbe696?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cyril</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-18T12:39:06+00:00">December 18, 2009 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>To add a bit of pedantry to this otherwise interesting post, the lower bound on sorting is n.log(n) if you only use comparisons to sort.</p>
<p>Daniel, I have such faith in your knowledge and command of efficient algorithms that when I saw you claimed shuffling an array was O(n^2) I immediately assumed you meant a 2-dimensional, n x n array&#8230;</p>
<p>PS: the spam protection bug on Safari is annoying.</p>
</div>
</li>
<li id="comment-52050" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e4c751a3466e0319a972f62c4af12f0e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e4c751a3466e0319a972f62c4af12f0e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://beza1e1.tuxen.de" class="url" rel="ugc external nofollow">beza1e1</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2009-12-21T17:57:12+00:00">December 21, 2009 at 5:57 pm</time></a> </div>
<div class="comment-content">
<p>You note that parallel programming can be used to do the same amount of work in the same time with less energy for embarrassingly parallel tasks. Maybe this isn&rsquo;t restricted to embarrassingly parallel stuff like serving web pages though. Maybe parallelism can be used to reduce energy consumption.</p>
</div>
</li>
<li id="comment-54738" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bfe77265615f9401f87ae0985007063d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bfe77265615f9401f87ae0985007063d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">melvin gldstein</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2011-09-29T12:59:50+00:00">September 29, 2011 at 12:59 pm</time></a> </div>
<div class="comment-content">
<p>Entropy is one of Physics Foibles. Murphys Law is the layman&rsquo;s Entropy.</p>
</div>
</li>
</ol>
