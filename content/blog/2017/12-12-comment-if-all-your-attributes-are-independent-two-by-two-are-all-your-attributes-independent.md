---
date: "2017-12-12 12:00:00"
title: "If all your attributes are independent two-by-two&#8230; are all your attributes independent?"
index: false
---

[16 thoughts on &ldquo;If all your attributes are independent two-by-two&#8230; are all your attributes independent?&rdquo;](/lemire/blog/2017/12-12-if-all-your-attributes-are-independent-two-by-two-are-all-your-attributes-independent)

<ol class="comment-list">
<li id="comment-293389" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/475ffffd21c66427fbcd4761bd917274?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/475ffffd21c66427fbcd4761bd917274?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T23:19:16+00:00">December 12, 2017 at 11:19 pm</time></a> </div>
<div class="comment-content">
<p>Hi, if z = x + y, surely there are correlations between (x, z) and (y, z)? Perhaps there needs to be a nonlinear relationship &#8211; e.g. an XOR of binary random variables would have this property in this situation</p>
</div>
<ol class="children">
<li id="comment-293391" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T23:41:56+00:00">December 12, 2017 at 11:41 pm</time></a> </div>
<div class="comment-content">
<p><em>Hi, if z = x + y, surely there are correlations between (x, z) and (y, z)?</em></p>
<p>Is there?</p>
<p>Given full knowledge of <em>x</em>, what can you say about <em>z</em>? By my assumptions, all you can say is that <em>z</em> is <em>x</em> plus some random unknow value&#8230; so you cannot know what <em>z</em> is given <em>x</em>.</p>
</div>
<ol class="children">
<li id="comment-293393" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7f9969d3b17c6fd9d604ad2c09a06d58?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7f9969d3b17c6fd9d604ad2c09a06d58?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://thume.ca/" class="url" rel="ugc external nofollow">Tristan Hume</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-12T23:56:56+00:00">December 12, 2017 at 11:56 pm</time></a> </div>
<div class="comment-content">
<p>If you have a data set with a bunch of values of xyz, and you measure the correlation between (x,z) and (y,z) with linear regression you&rsquo;ll find that both have positive correlation. The correlation will be noisy, but in general higher values of x will likely have higher values of z. Thus in a statistical sense (x,z) and (y,z) aren&rsquo;t independent.</p>
</div>
<ol class="children">
<li id="comment-293396" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-13T01:18:08+00:00">December 13, 2017 at 1:18 am</time></a> </div>
<div class="comment-content">
<p><em>Thus in a statistical sense (x,z) and (y,z) aren&rsquo;t independent.</em></p>
<p>They are in this example:</p>
<p><a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/12/12/Test.java" rel="nofollow ugc">https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/12/12/Test.java</a></p>
<p>The point of my blog post is that pairwise relations do not capture all relations.</p>
</div>
<ol class="children">
<li id="comment-293423" class="comment even depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89e850f604368d148203365062089615?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thomas van Dijk</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-13T09:34:23+00:00">December 13, 2017 at 9:34 am</time></a> </div>
<div class="comment-content">
<p>This experimental results seems to occur because you are adding two uniformly-random full-range integers, and the addition overflows. This &ldquo;destroys&rdquo; the correlation. Replace both calls of r.nextInt() with r.nextInt(100), and I get a correlation of about 0.7 on the second test. I didn&rsquo;t do the math, but I can imagine that &ldquo;your&rdquo; x, y and z are indeed all independent.</p>
<p>Your actual point is, of course, still completely valid: pairwise independence does not imply mutual independence. Thanks for the public service announcement 🙂</p>
</div>
</li>
<li id="comment-293517" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-14T21:33:29+00:00">December 14, 2017 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>p(z=a,x=b) = p(y=a-b,x=b) = p(y=a-b)*p(x=b)<br/>
now for independence to hold, p(z=a)=p(x+y=a) must be always equal to p(y=a-b) for arbitrary a and b. Why would this generally be the case?</p>
</div>
</li>
</ol>
</li>
<li id="comment-293429" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://richardstartin.uk" class="url" rel="ugc external nofollow">Richard Startin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-13T12:51:53+00:00">December 13, 2017 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>It depends on the variances of random variables x and y. If x has a variance much larger than that of y, you may see a strong correlation between x and z but none between y and z. If x and y both have small variances, you would be correct.</p>
</div>
</li>
</ol>
</li>
<li id="comment-375751" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/68320ac077e39c5af26f3ed2ea86d1a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/68320ac077e39c5af26f3ed2ea86d1a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilari Vallivaara</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-25T11:59:59+00:00">December 25, 2018 at 11:59 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
Given full knowledge of x, what can you say about z? By my assumptions, all you can say is that z is x plus some random unknow valueâ€¦ so you cannot know what z is given x.
</p></blockquote>
<p>You can say things about the distribution of z. More exactly, you can tell that the distribution depends on x. And this is what is required for the random variables to be dependent &#8211; not that you know what z is given x.</p>
<p>There is a possibility that I have missed something profound here, but I genuinely do not think this example was meant to be based on integer overflow.</p>
</div>
<ol class="children">
<li id="comment-376262" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-27T15:30:08+00:00">December 27, 2018 at 3:30 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>You can say things about the distribution of z. More exactly, you can tell that the distribution depends on x. And this is what is required for the random variables to be dependent â€“ not that you know what z is given x.</p></blockquote>
<p>Your current income z is my income x plus some unknown real number y. So z = x + y. Do I understand correctly that by your standard, it is fair to say that your income depends on my income?</p>
</div>
<ol class="children">
<li id="comment-376278" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/68320ac077e39c5af26f3ed2ea86d1a1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/68320ac077e39c5af26f3ed2ea86d1a1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ilari Vallivaara</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-12-27T16:15:42+00:00">December 27, 2018 at 4:15 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Your current income z is my income x plus some unknown real number y. So z = x + y. Do I understand correctly that by your standard, it is fair to say that your income depends on my income?
</p></blockquote>
<p>Yes, if we are talking about dependence of random variables as response to claims like &ldquo;then there is no correlation between (y, z) or (x, z) even though x + y = z.&rdquo; Because there most certainly is a correlation, and the random variables are not independent.</p>
<p>Let&rsquo;s say your income x is either 10k or 100k a year (p = 0.5 for both). Let&rsquo;s say my income is z = x + y, where y ~ N(0, 10^2) (small random variation). Even though I can not exactly tell what my income is, given your income, I still can say that it strongly depends on it. Do you think it&rsquo;s not fair or accurate to say that?</p>
<p>It&rsquo;s still not clear to me if you chose your Java example on purpose and computed correlation over overflowing values, or what was the main point of it. With sensible distributions for x and y &#8211; like the suggested r.nextInt(100) &#8211; it is easy to verify that if z = x + y, then there is dependence (correlation) between (x, z) (and (y, z)).</p>
<p>Or maybe I&rsquo;m totally lost, and the overflowing Java example was just some trick instead of a simple example trying to demonstrate non-correlation. Is correlation even defined for overflowing or wrapping values? Or are we trying to formulate an even distribution over all (mathematical) integers or reals? I thought this was not the case, as the earlier post talked about values in sensible ranges (age, income, etc.).</p>
<p>Could you elaborate on the purpose of your example and what it is supposed to demonstrate?</p>
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
<li id="comment-293398" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9af6a27d24902db144fec92b35f2ca54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9af6a27d24902db144fec92b35f2ca54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/julianhyde" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-13T01:28:24+00:00">December 13, 2017 at 1:28 am</time></a> </div>
<div class="comment-content">
<p>Thanks for this work, Daniel. It disproves one of the key assumptions I made in Calcite&rsquo;s data profiler <a href="https://issues.apache.org/jira/browse/CALCITE-1616" rel="nofollow ugc">https://issues.apache.org/jira/browse/CALCITE-1616</a>. Now I need to find an alternative approach.</p>
<p>For this work, my definition of &ldquo;independence&rdquo; is as follows. x and y are independent if the number of distinct values of (x, y) is as you would expect given the number of distinct values of (x) and (y) individually in a particular sample.</p>
<p>Example 1. In the Customers table, zipcode is dependent on id. There are 1,000,000 records in the table, 1,000,000 distinct values of id, 41,665 distinct values of zipcode, and 1,000,000 distinct values of (id, zipcode) combined. id is in fact a key, so it is unsurprising that zipcode is dependent upon it.</p>
<p>Example 2. In the Customers table, zipcode is almost dependent on state. Among the 1,000,000 records, there are 50 states, 41,665 zipcodes, and 41,811 combinations of (state, zipcode). In other words, a few zipcodes cross state boundaries, but not many.</p>
<p>Of course, you can&rsquo;t prove that there is a functional dependency by looking at a sample of the data; someone could come along in a minute and add a record that breaks the dependency. But for some applications (e.g. query optimization) it is useful to be able to find groups of columns that are approximately functionally dependent.</p>
<p>Your example reminds me of exotic normal forms. If (x, y), (y, z) and (x, z) are unique, then we have a textbook example of a relation that is in 4th normal form but not 5th normal form. See <a href="https://en.wikipedia.org/wiki/Fifth_normal_form" rel="nofollow ugc">https://en.wikipedia.org/wiki/Fifth_normal_form</a>. Conventional wisdom is that tables that are in 4NF but not in 5NF are rare in the real world, but I&rsquo;m not sure the same can be said if (x, y), (y, z) and (x, z) are not necessarily keys.</p>
</div>
<ol class="children">
<li id="comment-293431" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b165010996033bc6602ed18ab6a883b0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://richardstartin.uk" class="url" rel="ugc external nofollow">Richard Startin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-13T13:16:52+00:00">December 13, 2017 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>You could build a 2D matrix consisting of the counts of each distinct tuple. Then, for each x, you can compute P(Y=y|X=x) by dividing the count at (x,y) by the sum of the column, if this number is close to 1, you have a functional dependency of Y on X. If P(X=x|Y=y), computed by dividing by the sum of the row, is close to zero, you know the dependency is not mutual. For instance the probability that the state is NY given the zip is 10001 is 1, whereas the probability that the zip is 10001 given that the state is NY is approximately zero.</p>
</div>
<ol class="children">
<li id="comment-293515" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9af6a27d24902db144fec92b35f2ca54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9af6a27d24902db144fec92b35f2ca54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/julianhyde" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-14T21:26:25+00:00">December 14, 2017 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p>Richard, Rather than storing a count at each (x, y) I am storing a boolean &#8211; whether any records exist that have that (state, zipcode) combination &#8211; and then doing an approximate sum of the booleans. Thus the whole matrix is summarized by a single integer. Clearly your approach has more information, but my challenge is to make do with less information, because I want to cover all possible matrices.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-293420" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-13T07:52:56+00:00">December 13, 2017 at 7:52 am</time></a> </div>
<div class="comment-content">
<p>Don&rsquo;t know much about statistics but I guess this is related:<br/>
<a href="https://arxiv.org/abs/1609.01233" rel="nofollow">Multivariate Dependence Beyond Shannon Information</a></p>
</div>
</li>
<li id="comment-293516" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9af6a27d24902db144fec92b35f2ca54?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9af6a27d24902db144fec92b35f2ca54?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/julianhyde" class="url" rel="ugc external nofollow">Julian Hyde</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-12-14T21:28:04+00:00">December 14, 2017 at 9:28 pm</time></a> </div>
<div class="comment-content">
<p>jld, I don&rsquo;t know much statistics either but the paper you cite seems to be exactly on target. I will read and digest &#8211; thanks!</p>
</div>
</li>
<li id="comment-354353" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6fff5350c6615902c2176ce665453029?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Maynard Handley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-05T06:03:20+00:00">October 5, 2018 at 6:03 am</time></a> </div>
<div class="comment-content">
<p>This is well known to mathematicians: pairwise independence of random variables does not imply mutual independence.</p>
<p><a href="https://en.wikipedia.org/wiki/Pairwise_independence" rel="nofollow ugc">https://en.wikipedia.org/wiki/Pairwise_independence</a></p>
<p>A richer version of this comes in thinking about stochastic processes, which are defined by ALL the joint distributions functions at all collections of times (so two distinct times, three distinct times, etc). If there is no information beyond the two point distributions, you have a very common case (essentially Markov), but that&rsquo;s not the ONLY possible situation.</p>
</div>
</li>
</ol>
