---
date: "2006-05-11 12:00:00"
title: "How do people balance out precision and recall?"
---



In Information Retrieval, you can&rsquo;t have both great recall and great precision, so you have to balance the two. What are the possible criteria to pick the best recall/precision?

What I found so far, on wikipedia of all places, is the so-called F-measure or balanced F-score, and it is merely the harmonic mean of the recall and the precision. This seems to have almost no theoretical foundation?

Anyone out there has proposed an exciting way to pick your recall and precision?

I don&rsquo;t want to be too critical of the field of Information Retrieval, but sometimes, when I read papers from the 1950&rsquo;s, it feels like they knew everything there was to know. I sure hope that people came up with more exciting ideas than just &ldquo;use the harmonic mean&rdquo; to pick the best recall?

__Update__: I found this related paper:<br/>
Cyril Goutte and Eric Gaussier, [A Probabilistic Interpretation of Precision, Recall and F-score, with Implication for Evaluation](http://www.xrce.xerox.com/Research-Development/Publications/2004-058), but it is only a partial answer to my question.

