---
date: "2007-12-21 12:00:00"
title: "How to win the Netflix $1,000,000 prize?"
---



[Yahuda Koren](http://www.research.att.com/~yehuda/), one of the winners of the Netflix game so far, was nice enough to send me a pointer to a recent paper he wrote, Chasing $1,000,000: How we won the Netflix progress prize (link is to PDF document, see 4th page and following).

Their approach is based on the linear combination of large number of predictors. Their work is difficult to summarize because it is so sophisticated and complex. Nevertheless, it might be useful to try to see what lessons can be learned.

First, some generic observations that are not very surprising, but nice nevertheless:

- All data distributions are very skewed. A single movie can receive 200,000 ratings whereas a large fraction of the movies is rated fewer than 200 times. Some users have rated 10,000 movies or more whereas most users have rated around 100 movies.
- Ratings on movies with higher variance (you either like it or hate it) are more informative.

Here are some principles I take away from their work:

- Singular Value Decomposition is useful to get overall trends.- Nearest-neighbor methods are better at picking up strong interactions inside small sets of related movies.- Nearest-neighbor methods should discard uninformative neighbors.- If you discard ratings and focus on who rated which movie, you seem to get useful predictors complementing the rating-based predictors.- Regularization is important (they use [ridge regression](https://en.wikipedia.org/wiki/Ridge_regression)) as expected.


There is, in their work, a very clear trade-off from our ability to explain the recommendations, in favor of the accuracy. This is somehow dictated by the rules of the game, I suppose. They acknowledge this fact: &ldquo;when recommending a movie to a user, we don&rsquo;t really care why the user will like it, only that she will.&rdquo; Presumably, neither the engineer or manager running the system, nor the user should care why the recommendation was made. I have argued the [exact opposite](http://arxiv.org/abs/cs/0702144), and so have [others](http://portal.acm.org/citation.cfm?id=358916.358995). I hope we can agree to disagree on this one. (I have said it before, my goal in life is to make people smarter, not to make smarter machines.)

__Note__. They claim that there is no justification found in the literature for the similarity measures, it is all arbitrary. I think Yahuda did not read my paper [Scale And Translation Invariant Collaborative Filtering Systems](http://www.daniel-lemire.com/fr/documents/publications/sti_nrc.pdf). I suggested that the predictions of an algorithm should not change if we transform the data in some sensible way. Of course, this may not be enough to determine what the similarity measures must be, but it allows you to quickly discard some choices.

