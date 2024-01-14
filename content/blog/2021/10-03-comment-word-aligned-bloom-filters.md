---
date: "0000-00-00 12:00:00"
title: "Word-aligned Bloom filters – Daniel Lemire's blog"
index: false
---

[			30 thoughts on “Word-aligned Bloom filters”]()


		
		<ol class="comment-list">
					<li id="comment-600374" class="comment even thread-even depth-1 parent">
			<article id="div-comment-600374" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/45a168cb9eb8454d66c78f18e29d9342?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/45a168cb9eb8454d66c78f18e29d9342?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/45a168cb9eb8454d66c78f18e29d9342?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/45a168cb9eb8454d66c78f18e29d9342?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://brandon.si" class="url" rel="ugc external nofollow">jberryman</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600374"><time datetime="2021-10-03T18:06:51+00:00">October 3, 2021 at 6:06 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Different approaches are studied in<br>
“Fast Bloom Filters and Their Generalization” by Y Qiao, et al. (the one you e described here is referred to as “bloom-1” in the paper) </p>
<p>Fwiw I’ve implemented bloom-1 as well here<br>
<a href="https://hackage.haskell.org/package/unagi-bloomfilter" rel="nofollow ugc">https://hackage.haskell.org/package/unagi-bloomfilter</a></p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600374" data-postid="19476" data-belowelement="div-comment-600374" data-respondelement="respond" data-replyto="Reply to jberryman" aria-label="Reply to jberryman" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to jberryman","commentParent":"600374"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600375" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
			<article id="div-comment-600375" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600375"><time datetime="2021-10-03T18:18:31+00:00">October 3, 2021 at 6:18 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Here is what I think is the full reference:</p>
<p>Qiao, Yan, Tao Li, and Shigang Chen. “Fast Bloom filters and their generalization.” IEEE Transactions on Parallel and Distributed Systems 25.1 (2013): 93-103.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600375" data-postid="19476" data-belowelement="div-comment-600375" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"600375"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600376" class="comment byuser comment-author-lemire bypostauthor even depth-3">
			<article id="div-comment-600376" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600376"><time datetime="2021-10-03T18:21:43+00:00">October 3, 2021 at 6:21 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>I appreciate very much the references, both to the paper and to the software. Please note that, as was clear in the post, I did not claim that this was original. If you’d like to elaborate further on your experience, please do so.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600376" data-postid="19476" data-belowelement="div-comment-600376" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"600376"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
</ol>
</li>
		<li id="comment-600395" class="comment odd alt thread-odd thread-alt depth-1 parent">
			<article id="div-comment-600395" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/ae5dd5bd9c916b48dfae680f8335e704?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/ae5dd5bd9c916b48dfae680f8335e704?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/ae5dd5bd9c916b48dfae680f8335e704?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/ae5dd5bd9c916b48dfae680f8335e704?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="https://cs.cmu.edu/~worichte" class="url" rel="ugc external nofollow">Wolfgang Richter</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600395"><time datetime="2021-10-03T21:14:42+00:00">October 3, 2021 at 9:14 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>To keep your false positive rate at 1%, aren’t you limited in the number of members of the population you can map to each 64-bit word?  As in, one shouldn’t map more than 100 members into each 64-bit word?  Something like that?</p>
<p>Would be nice to clarify the scalability per word here.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600395" data-postid="19476" data-belowelement="div-comment-600395" data-respondelement="respond" data-replyto="Reply to Wolfgang Richter" aria-label="Reply to Wolfgang Richter" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Wolfgang Richter","commentParent":"600395"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600397" class="comment byuser comment-author-lemire bypostauthor even depth-2">
			<article id="div-comment-600397" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600397"><time datetime="2021-10-03T21:35:11+00:00">October 3, 2021 at 9:35 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>The size of the backing array must grow. In my case, I am allocating 12 bits per entry, so if you have 100 entries, you need 1200 bits or about 19 64-bit words. The more distinct entries you have, the more memory you need to allocate.</p>
<p>It works this way with conventional Bloom filters. You need an array that is large enough if you are going to accommodate your input size.</p>
<p>So the scalability is simple. It is linear. 12 bits per entry. You give me the number of entries, I give you the number of words you need. It is rather easy, something like 12 * number bits. It is no different from Bloom filters.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600397" data-postid="19476" data-belowelement="div-comment-600397" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"600397"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
		<li id="comment-600399" class="comment odd alt thread-even depth-1 parent">
			<article id="div-comment-600399" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tobin Baker</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600399"><time datetime="2021-10-03T22:28:20+00:00">October 3, 2021 at 10:28 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>My intuition would be that such small partitions would lead to unacceptable variance. Do you have any analytical results on variance or tail bounds for the FPP?</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600399" data-postid="19476" data-belowelement="div-comment-600399" data-respondelement="respond" data-replyto="Reply to Tobin Baker" aria-label="Reply to Tobin Baker" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tobin Baker","commentParent":"600399"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600401" class="comment even depth-2 parent">
			<article id="div-comment-600401" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">KWillets</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600401"><time datetime="2021-10-03T22:34:19+00:00">October 3, 2021 at 10:34 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>There’s an estimate here:  <a href="https://www.cs.amherst.edu/~ccmcgeoch/cs34/papers/cacheefficientbloomfilters-jea.pdf" rel="nofollow ugc">https://www.cs.amherst.edu/~ccmcgeoch/cs34/papers/cacheefficientbloomfilters-jea.pdf</a></p>
<p>Basically they take the lots of little Bloom filters and factor in the variance in populations between the buckets.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600401" data-postid="19476" data-belowelement="div-comment-600401" data-respondelement="respond" data-replyto="Reply to KWillets" aria-label="Reply to KWillets" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to KWillets","commentParent":"600401"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600404" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
			<article id="div-comment-600404" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600404"><time datetime="2021-10-03T22:43:57+00:00">October 3, 2021 at 10:43 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Thanks Kendall.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600404" data-postid="19476" data-belowelement="div-comment-600404" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"600404"}}),comment.focus'>Reply</a></div>			</article>
		</li>
		<li id="comment-600410" class="comment even depth-3">
			<article id="div-comment-600410" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tobin Baker</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600410"><time datetime="2021-10-03T22:52:23+00:00">October 3, 2021 at 10:52 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Thanks for the reference. Indeed, section 3 of this paper anticipates all the ideas in this blog post, I think (in particular, 3.1, which describes picking a random k-subset from the B bits of a block, using a lookup table with a single hash function as input). But they don’t seem to have numbers for block sizes other than 512 (64-byte cache line) in the paper. It should be straightforward to compute bounds on FPP for B=64 from equations 3) and 4) in the paper, though.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600410" data-postid="19476" data-belowelement="div-comment-600410" data-respondelement="respond" data-replyto="Reply to Tobin Baker" aria-label="Reply to Tobin Baker" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tobin Baker","commentParent":"600410"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
</ol>
</li>
		<li id="comment-600405" class="comment odd alt thread-odd thread-alt depth-1 parent">
			<article id="div-comment-600405" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">KWillets</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600405"><time datetime="2021-10-03T22:45:13+00:00">October 3, 2021 at 10:45 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>One thought I had here was to not word-align them and use overlapping buckets, either at byte or even bit granularity. Loads and cache lines would be unaligned of course, but still few in number.</p>
<p>It would create more buckets but possibly even out the variations between them.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600405" data-postid="19476" data-belowelement="div-comment-600405" data-respondelement="respond" data-replyto="Reply to KWillets" aria-label="Reply to KWillets" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to KWillets","commentParent":"600405"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600407" class="comment byuser comment-author-lemire bypostauthor even depth-2">
			<article id="div-comment-600407" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600407"><time datetime="2021-10-03T22:47:21+00:00">October 3, 2021 at 10:47 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>It is worth investigating. My concern is that it makes implementation more difficult. E.g., it might be ugly in Java. So you’d want important benefits.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600407" data-postid="19476" data-belowelement="div-comment-600407" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"600407"}}),comment.focus'>Reply</a></div>			</article>
		</li>
		<li id="comment-600412" class="comment odd alt depth-2 parent">
			<article id="div-comment-600412" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tobin Baker</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600412"><time datetime="2021-10-03T22:57:47+00:00">October 3, 2021 at 10:57 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Pretty much the original Bloom filter strategy, no? (i.e. overlapping the bitmaps for all k hash functions). What’s now called the “partitioned” approach (distinct from the “blocked” approach because it separates the bitmaps for each hash function) is more obvious than Bloom’s approach, I think, but performs a bit worse in theory and a bit better in practice (if you believe “A Case for Partitioned Bloom Filters”).</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600412" data-postid="19476" data-belowelement="div-comment-600412" data-respondelement="respond" data-replyto="Reply to Tobin Baker" aria-label="Reply to Tobin Baker" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tobin Baker","commentParent":"600412"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600421" class="comment even depth-3">
			<article id="div-comment-600421" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">KWillets</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600421"><time datetime="2021-10-03T23:34:47+00:00">October 3, 2021 at 11:34 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>It’s a restriction on the distance between hashes for the same key — it’s a little more work to analyze (basic Bloom filters are easier due to the independence of each bit position).</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600421" data-postid="19476" data-belowelement="div-comment-600421" data-respondelement="respond" data-replyto="Reply to KWillets" aria-label="Reply to KWillets" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to KWillets","commentParent":"600421"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
		<li id="comment-601390" class="comment odd alt depth-2 parent">
			<article id="div-comment-601390" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Jim Apple</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601390"><time datetime="2021-10-09T23:34:11+00:00">October 9, 2021 at 11:34 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>I tried this with split block Bloom filters and byte-level granularity with blocks of size 256 and lanes of size 32 (that is, setting 1 bit in each 32-bit lane inside an 8-lane block). The difference in false positive probability was negligible – less than switching to 512-bit blocks and 64-bit lanes.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601390" data-postid="19476" data-belowelement="div-comment-601390" data-respondelement="respond" data-replyto="Reply to Jim Apple" aria-label="Reply to Jim Apple" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Jim Apple","commentParent":"601390"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-601780" class="comment even depth-3">
			<article id="div-comment-601780" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">KWillets</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601780"><time datetime="2021-10-11T17:16:23+00:00">October 11, 2021 at 5:16 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Interesting — thanks for doing that. I suspect it’s equivalent to the original blocked approach.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601780" data-postid="19476" data-belowelement="div-comment-601780" data-respondelement="respond" data-replyto="Reply to KWillets" aria-label="Reply to KWillets" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to KWillets","commentParent":"601780"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
</ol>
</li>
		<li id="comment-600435" class="comment odd alt thread-even depth-1 parent">
			<article id="div-comment-600435" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="https://cafxx.strayorange.com" class="url" rel="ugc external nofollow">Carlo Alberto Ferraris</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600435"><time datetime="2021-10-04T00:16:06+00:00">October 4, 2021 at 12:16 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>More than word-aligned buckets, wouldn’t it be a good idea to try with cacheline-aligned buckets? Because the buckets are cacheline-aligned, all of the bit tests would hit the same cacheline. And, as long as the bit tests have no dependency with each other, the processor should still be able to execute them in parallel, hiding the latency of loading multiple words from the cache. </p>
<p>The benefit being that, as each bucket would be 8x or 16x times the size of word, false positives ratio would be lower for a given bloom filter size.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600435" data-postid="19476" data-belowelement="div-comment-600435" data-respondelement="respond" data-replyto="Reply to Carlo Alberto Ferraris" aria-label="Reply to Carlo Alberto Ferraris" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Carlo Alberto Ferraris","commentParent":"600435"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600436" class="comment even depth-2 parent">
			<article id="div-comment-600436" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2f0cf9749990f7cf217ead19aaec89a1?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="https://cafxx.strayorange.com" class="url" rel="ugc external nofollow">Carlo Alberto Ferraris</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600436"><time datetime="2021-10-04T00:17:42+00:00">October 4, 2021 at 12:17 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Checked later on <a href="https://www.cs.amherst.edu/~ccmcgeoch/cs34/papers/cacheefficientbloomfilters-jea.pdf" rel="nofollow ugc">https://www.cs.amherst.edu/~ccmcgeoch/cs34/papers/cacheefficientbloomfilters-jea.pdf</a> and it’s precisely what I was referring to.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600436" data-postid="19476" data-belowelement="div-comment-600436" data-respondelement="respond" data-replyto="Reply to Carlo Alberto Ferraris" aria-label="Reply to Carlo Alberto Ferraris" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Carlo Alberto Ferraris","commentParent":"600436"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600442" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
			<article id="div-comment-600442" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600442"><time datetime="2021-10-04T00:36:42+00:00">October 4, 2021 at 12:36 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Yes a cache-line approach works and can be implemented with SIMD instructions. In the GitHub org I link to, there are such implementations. </p>
<p>Note that it is not a good model to assume that processing a whole cache line is the same as processing a single word. It is more complicated.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600442" data-postid="19476" data-belowelement="div-comment-600442" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"600442"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
</ol>
</li>
		<li id="comment-600538" class="comment even thread-odd thread-alt depth-1 parent">
			<article id="div-comment-600538" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/1d70af08e4a97eb82aa2e4086317bd9a?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tim Armstrong</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600538"><time datetime="2021-10-04T05:26:07+00:00">October 4, 2021 at 5:26 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>I’d definitely recommend over the classic bloom filter design for most applications where performance matters.</p>
<p>We had a good experience using blocked bloom filters (256-bit blocks) for query processing in Apache Impala – any speedup in bloom filter query time was a big win. They also got ported to Apache Kudu – there’s a battle tested implementation with AVX2 support in that codebase.</p>
<p>The newer bloom filter support in Apache Parquet also uses a similar design – <a href="https://github.com/apache/parquet-format/blob/master/BloomFilter.md" rel="nofollow ugc">https://github.com/apache/parquet-format/blob/master/BloomFilter.md</a> – which is a big win given the amount of data stored in that format (albeit most without bloom filter indices at this point).</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600538" data-postid="19476" data-belowelement="div-comment-600538" data-respondelement="respond" data-replyto="Reply to Tim Armstrong" aria-label="Reply to Tim Armstrong" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tim Armstrong","commentParent":"600538"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-600639" class="comment odd alt depth-2 parent">
			<article id="div-comment-600639" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tobin Baker</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600639"><time datetime="2021-10-04T18:29:31+00:00">October 4, 2021 at 6:29 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>That last link is very interesting: it’s actually a hybrid of the “blocking” and “partitioning” approaches (blocks are 32 bytes, partitions are 32 bits). It would be interesting to see analytical or simulation results exploring the parameter space of this hybrid approach.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600639" data-postid="19476" data-belowelement="div-comment-600639" data-respondelement="respond" data-replyto="Reply to Tobin Baker" aria-label="Reply to Tobin Baker" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tobin Baker","commentParent":"600639"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-601392" class="comment even depth-3">
			<article id="div-comment-601392" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Jim Apple</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601392"><time datetime="2021-10-09T23:42:29+00:00">October 9, 2021 at 11:42 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Hi Tobin! I did some benchmarking, including false positive probability, here: <a href="https://arxiv.org/abs/2101.01719" rel="nofollow ugc">https://arxiv.org/abs/2101.01719</a></p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601392" data-postid="19476" data-belowelement="div-comment-601392" data-respondelement="respond" data-replyto="Reply to Jim Apple" aria-label="Reply to Jim Apple" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Jim Apple","commentParent":"601392"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
</ol>
</li>
		<li id="comment-600573" class="comment odd alt thread-even depth-1">
			<article id="div-comment-600573" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/f37fbe56f0c9f68fcc98eeb336955062?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f37fbe56f0c9f68fcc98eeb336955062?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/f37fbe56f0c9f68fcc98eeb336955062?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f37fbe56f0c9f68fcc98eeb336955062?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">KJ</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-600573"><time datetime="2021-10-04T09:20:06+00:00">October 4, 2021 at 9:20 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p><a href="https://github.com/kunzjacq/pybloom" rel="nofollow ugc">https://github.com/kunzjacq/pybloom</a></p>
<p>is a python project able to compute the false positive probability of a structure with blocked bloom filters as described in the paper cited above (<a href="https://www.cs.amherst.edu/~ccmcgeoch/cs34/papers/cacheefficientbloomfilters-jea.pdf" rel="nofollow ugc">https://www.cs.amherst.edu/~ccmcgeoch/cs34/papers/cacheefficientbloomfilters-jea.pdf</a> ). It can also optimize a design based on constraints on the false positive probability or on the storage used.</p>
<p>(full disclosure: I a am the author of said project)</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="600573" data-postid="19476" data-belowelement="div-comment-600573" data-respondelement="respond" data-replyto="Reply to KJ" aria-label="Reply to KJ" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to KJ","commentParent":"600573"}}),comment.focus'>Reply</a></div>			</article>
		</li>
		<li id="comment-601065" class="comment even thread-odd thread-alt depth-1 parent">
			<article id="div-comment-601065" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Thomas Müller Graf</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601065"><time datetime="2021-10-07T06:32:51+00:00">October 7, 2021 at 6:32 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>FYI the Java blocked Bloom filter I have written uses a very similar method: two words, and in each word two bits (that might be the same): <a href="https://github.com/FastFilter/fastfilter_java/blob/master/fastfilter/src/main/java/org/fastfilter/bloom/BlockedBloom.java#L60" rel="nofollow ugc">https://github.com/FastFilter/fastfilter_java/blob/master/fastfilter/src/main/java/org/fastfilter/bloom/BlockedBloom.java#L60</a></p>
<pre data-amp-original-style="color:#000000;background:#ffffff;" class="amp-wp-8e07866">    <span data-amp-original-style="color:#800000; font-weight:bold;" class="amp-wp-1f2f7b1">public</span> boolean mayContain(long key) <span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">{</span>
        <span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">long</span> hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> Hash<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">.</span>hash64<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>key<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">,</span> seed<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        <span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">int</span> start <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> Hash<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">.</span>reduce<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">int</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> hash<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">,</span> buckets<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">^</span> <span data-amp-original-style="color:#bb7977; font-weight:bold;" class="amp-wp-4966232">Long</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">.</span>rotateLeft<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>hash<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">,</span> <span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">32</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        <span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">long</span> a <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> data<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">[</span>start<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">]</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        <span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">long</span> b <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> data<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">[</span>start <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">+</span> <span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">1</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">+</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">int</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span> <span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">60</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">]</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        <span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">long</span> m1 <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">1</span><span data-amp-original-style="color:#006600;" class="amp-wp-dd99e5a">L</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span> hash<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">|</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">1</span><span data-amp-original-style="color:#006600;" class="amp-wp-dd99e5a">L</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span> <span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">6</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        <span data-amp-original-style="color:#bb7977;" class="amp-wp-c4362ae">long</span> m2 <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">1</span><span data-amp-original-style="color:#006600;" class="amp-wp-dd99e5a">L</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span> <span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">12</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">|</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">1</span><span data-amp-original-style="color:#006600;" class="amp-wp-dd99e5a">L</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&lt;</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>hash <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&gt;</span> <span data-amp-original-style="color:#008c00;" class="amp-wp-abda1d2">18</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
        <span data-amp-original-style="color:#800000; font-weight:bold;" class="amp-wp-1f2f7b1">return</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>m1 <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&amp;</span> a<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> m1<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&amp;</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&amp;</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">(</span>m2 <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">&amp;</span> b<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span> <span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span><span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">=</span> m2<span data-amp-original-style="color:#808030;" class="amp-wp-f11c74e">)</span><span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">;</span>
    <span data-amp-original-style="color:#800080;" class="amp-wp-eea3810">}</span>
</pre>
<p>(I’m not claiming this is new, but I didn’t copy it.)</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601065" data-postid="19476" data-belowelement="div-comment-601065" data-respondelement="respond" data-replyto="Reply to Thomas Müller Graf" aria-label="Reply to Thomas Müller Graf" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Thomas Müller Graf","commentParent":"601065"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-601066" class="comment odd alt depth-2 parent">
			<article id="div-comment-601066" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/f24a348af91812e0677278655fd8e1e8?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Thomas Müller Graf</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601066"><time datetime="2021-10-07T06:35:35+00:00">October 7, 2021 at 6:35 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Hm there are some copy &amp; paste problems in the code I posted above… Probably the editor saw some XML tags.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601066" data-postid="19476" data-belowelement="div-comment-601066" data-respondelement="respond" data-replyto="Reply to Thomas Müller Graf" aria-label="Reply to Thomas Müller Graf" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Thomas Müller Graf","commentParent":"601066"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-601154" class="comment byuser comment-author-lemire bypostauthor even depth-3">
			<article id="div-comment-601154" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="http://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601154"><time datetime="2021-10-07T21:23:14+00:00">October 7, 2021 at 9:23 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>I fixed your comment.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601154" data-postid="19476" data-belowelement="div-comment-601154" data-respondelement="respond" data-replyto="Reply to Daniel Lemire" aria-label="Reply to Daniel Lemire" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Daniel Lemire","commentParent":"601154"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
</ol>
</li>
		<li id="comment-601484" class="comment odd alt thread-even depth-1 parent">
			<article id="div-comment-601484" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/24f283f61b2d361c1c7bb25597f97d23?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="https://discuss.neuralmagic.com/t/fast-transforms-for-sparsity/41/4" class="url" rel="ugc external nofollow">Sean O'Connor</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601484"><time datetime="2021-10-10T09:34:30+00:00">October 10, 2021 at 9:34 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>I think there is some paper out there about just storing a hash signature in a hash table, no full key and no value.<br>
If the hash signature was seen before of course you get a positive. It is also possible to get a false positive (collision.)<br>
Maybe it needs too many bits.<br>
Anyway an insert only Robin Hood hash table sounds ideal for that, and easy to implement.<br>
Delete operations for the Robin Hood hash table require maintaining a histogram of displacements and the unwind operation is a little tricky.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601484" data-postid="19476" data-belowelement="div-comment-601484" data-respondelement="respond" data-replyto="Reply to Sean O'Connor" aria-label="Reply to Sean O'Connor" on="tap:AMP.setState({&quot;ampCommentThreading&quot;:{&quot;replyTo&quot;:&quot;Reply to Sean O'Connor&quot;,&quot;commentParent&quot;:&quot;601484&quot;}}),comment.focus">Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-601584" class="comment even depth-2 parent">
			<article id="div-comment-601584" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/66c8d98a2aea73d7658688ae78b97c49?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Jim Apple</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601584"><time datetime="2021-10-10T18:23:40+00:00">October 10, 2021 at 6:23 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Yes, exactly. Cuckoo filters store just a signature, as do quotient filters. The former use cuckoo hashing, while the latter use Robin Hood linear probing.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601584" data-postid="19476" data-belowelement="div-comment-601584" data-respondelement="respond" data-replyto="Reply to Jim Apple" aria-label="Reply to Jim Apple" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Jim Apple","commentParent":"601584"}}),comment.focus'>Reply</a></div>			</article>
		<ol class="children">
		<li id="comment-601817" class="comment odd alt depth-3">
			<article id="div-comment-601817" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tobin Baker</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601817"><time datetime="2021-10-11T23:22:16+00:00">October 11, 2021 at 11:22 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>I think quotient filters use the Cleary algorithm (bidirectional linear probing combined with Knuth’s “quotienting” trick), but they’re still an “ordered hash table” like Robin Hood.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601817" data-postid="19476" data-belowelement="div-comment-601817" data-respondelement="respond" data-replyto="Reply to Tobin Baker" aria-label="Reply to Tobin Baker" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tobin Baker","commentParent":"601817"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
		<li id="comment-601819" class="comment even depth-2">
			<article id="div-comment-601819" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn">Tobin Baker</b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-601819"><time datetime="2021-10-11T23:27:06+00:00">October 11, 2021 at 11:27 pm</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Yeah there are many fingerprint table schemes around, which are theoretically superior to Bloom filters (by a factor of 1/ln 2). However, you can also store just hash codes without losing any information, if you’re hashing integers! Just apply a permutation (aka block cipher) instead of a hash function. Instead of block ciphers, I prefer to use a high-quality mixing function like the Murmur3 finalizer. You can see this approach here: <a href="https://github.com/senderista/hashtable-benchmarks" rel="nofollow ugc">https://github.com/senderista/hashtable-benchmarks</a>.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="601819" data-postid="19476" data-belowelement="div-comment-601819" data-respondelement="respond" data-replyto="Reply to Tobin Baker" aria-label="Reply to Tobin Baker" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Tobin Baker","commentParent":"601819"}}),comment.focus'>Reply</a></div>			</article>
		</li>
</ol>
</li>
		<li id="comment-635134" class="comment odd alt thread-odd thread-alt depth-1">
			<article id="div-comment-635134" class="comment-body">
					<div class="comment-author vcard">
						<amp-img alt="" src="https://secure.gravatar.com/avatar/84d26bf7a69814588769b04e69470178?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/84d26bf7a69814588769b04e69470178?s=112&amp;d=mm&amp;r=g 2x" class="avatar avatar-56 photo amp-wp-enforced-sizes i-amphtml-layout-intrinsic i-amphtml-layout-size-defined" height="56" width="56" layout="intrinsic" i-amphtml-layout="intrinsic"><i-amphtml-sizer slot="i-amphtml-svc" class="i-amphtml-sizer"><img alt="" aria-hidden="true" class="i-amphtml-intrinsic-sizer" role="presentation" src="data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9IjU2IiB3aWR0aD0iNTYiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIi8+"></i-amphtml-sizer><noscript><img alt="" src="https://secure.gravatar.com/avatar/84d26bf7a69814588769b04e69470178?s=56&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/84d26bf7a69814588769b04e69470178?s=112&amp;d=mm&amp;r=g 2x" height="56" width="56" loading="lazy" decoding="async"></noscript></amp-img>						<b class="fn"><a href="https://repustate.com/" class="url" rel="ugc external nofollow">Lily</a></b> <span class="says">says:</span>					</div>

					<div class="comment-metadata">
						<a href="https://lemire.me/blog/2021/10/03/word-aligned-bloom-filters/?amp#comment-635134"><time datetime="2022-06-02T06:37:28+00:00">June 2, 2022 at 6:37 am</time></a>					</div>

									</footer>

				<div class="comment-content">
					<p>Thanks for sharing this insightful article.</p>
				</div>

				<div class="reply"><a rel="nofollow" class="comment-reply-link" href="#respond" data-commentid="635134" data-postid="19476" data-belowelement="div-comment-635134" data-respondelement="respond" data-replyto="Reply to Lily" aria-label="Reply to Lily" on='tap:AMP.setState({"ampCommentThreading":{"replyTo":"Reply to Lily","commentParent":"635134"}}),comment.focus'>Reply</a></div>			</article>
		</li>
		</ol>

		
	
	
