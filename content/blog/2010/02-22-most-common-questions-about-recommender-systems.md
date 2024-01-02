---
date: "2010-02-22 12:00:00"
title: "Most common questions about recommender systems&#8230;"
---



I get ten to fifteen questions a week on recommender systems from entrepreneurs and engineers. Sometimes, I help people find their way in the literature. On occasionâ€”for a consulting feeâ€”I get my hands dirty and evaluate, design or code specific algorithms.  But mostly, I answer the same questions again and again:

__1. How much data do I need? __

Given your data, you can use [cross-validation](https://en.wikipedia.org/wiki/Cross-validation_(statistics)) or [A/B testing](https://en.wikipedia.org/wiki/A/B_testing) to measure objectively the effectiveness of a recommender system.

__2. We have this system in place, how do we know whether it is sane?__

See previous question.

__3. My online recommender system is slow!__

Laziness is your friend: don&rsquo;t recompute the recommendations each time you have new data.

__4. My customers don&rsquo;t like the recommendations!__

- Keep expectations in check: recommending products is difficult and even human beings have trouble doing it,
- Explain the recommendations: nobody trusts a black box,
- Allow your users to freely explore your data and products in convenient and exciting ways.


__5. Which algorithm is best?__

You should start with [simple algorithms](https://en.wikipedia.org/wiki/Slope_One): it worked well enough for Amazon. To do better, a mix of different algorithms is probably best. You can combine them using [ensemble methods](https://en.wikipedia.org/wiki/Ensemble_learning).

