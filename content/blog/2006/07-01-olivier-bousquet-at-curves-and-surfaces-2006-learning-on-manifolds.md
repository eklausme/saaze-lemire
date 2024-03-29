---
date: "2006-07-01 12:00:00"
title: "Olivier Bousquet at Curves and Surfaces 2006: Learning on Manifolds"
---



Yesterday, I attended [Olivier](http://ml.typepad.com/)&lsquo;s talk at the Curves and Surfaces conference. Olivier is a fellow blogger and researcher. Alas, I was too tired after an afternoon of talks and went to sleep, so I did not hunt Olivier.

In any case, he presented one of the most interesting talk so far in the conference. While quite possibly extremely expensive (sounds like his algorithms are bound to be O(n^2)?!?), the approach he proposed, Learning on Manifolds, seems well grounded for practical problems. Among the key idea is that you draw a graph where there are vertices between close data points, and then you compute some Laplacian. By computing the eigenvectors of the Laplacian, you can &ldquo;cluster&rdquo; the data in different manifolds, assuming you know how many clusters you want. There are some hidden assumptions, like the fact that you have rather uniform density, and that all components of all data points are known (no missing data!).

Naturally, Olivier was asked &ldquo;where are your analytical results?&rdquo; I felt that while he correctly answered, Olivier was a bit shy. Basically, I would have answered &ldquo;where are your experimental results?&rdquo; Because, they have none. They claim that their analytical results are measures of goodness, but that&rsquo;s only a claim. A theorem is not, necessarily, a valuable thing. Just the right theorems at the right times, are valuable. Olivier had experimental evidence on his side, at least on toy problems. But Olivier was probably wise not to answer the way I would have, because, no doubt, I would have been booed out of the room.

In this kind of work, there are two measures of how good something is. It can work well in practice, which you can verify by trying to solve some real-world problem, or, at least, a toy problem&hellip; or else, you can produce analytical results, or theorems, and claim that these theoretical results are an adequate measure of &ldquo;goodness&rdquo;. Well, guess what, theory alone is not enough, just like experimental evidence alone is not enough. If you come up with a theorem that says &ldquo;if the solution is in C<sup>1</sup> then this and this will happen&rdquo;, and, no solution is ever in C<sup>1</sup>, what then? Anyone who has tried to work on industrial problems know that while theory can (and not <em>is</em>) be very helpful, it can be equally deceiving. Also, few real problems meet smoothness conditions such as C<sup>k</sup> classes. And I say this as someone who has a Ph.D. in Mathematics!

An earlier talk in the conference discussed the problem of computing PageRank when the damping (or regularization) factor goes to zero. No, I don&rsquo;t know what it had to do with Curves and Surfaces, but it was enjoyable anyhow. When I asked the author why he was assuming that removing the damping factor would improve search on the Internet, he clearly did not grasp my question. His answer was basically equivalent to saying &ldquo;I don&rsquo;t know that it will be better, but it can&rsquo;t hurt.&rdquo; Maybe it is true, maybe it isn&rsquo;t, though I feel that he might have missed a few papers on the topic, since I don&rsquo;t think researchers think that the damping factor is a harmful hack to achieve fast numerical convergence. I was annoyed that despite all his fancy algorithms he didn&rsquo;t bother to present us with some experimental evidence, so we could see if his algorithms did a good job or not. He did not even present results over toy cases. Surely, he thought, presenting the mathematics is sufficient?

I wish we could change the culture and get people to work more often on real industrial problems.

