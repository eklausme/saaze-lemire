---
date: "2005-08-20 12:00:00"
title: "Hitflip DVD recommender is using Slope One collaborative filtering algorithm"
---



Jan Miczaika from the Otto Beisheim Graduate School of Management just sent me an email. Their movie (DVD) recommender system hitflip (German site) is using the [Slope One collaborative filtering algorithm I presented at SIAM Data Mining 2005](https://lemire.me/fr/abstracts/SDM2005.html). I believe he found useful the technical report I wrote about it ([Implementing a Rating-Based Item-to-Item Recommender System in PHP/SQL](https://lemire.me/fr/abstracts/TRD01.html)).

Jan had interesting comments:

- Instead of working live, you can replace the INSERTs to your DMBS by some INSERT DELAYED and do batch processing. We had thought about this option with [inDiscover](http://www.indiscover.net), but it proved to be unnecessary for us, even using MySQL which has relatively slow INSERTs. Batch processing is an ok alternative when ressources are limited, but, myself, I prefer true online systems.
- Brand new DVDs that have not been rated a sufficient number of times (say twice) are not recommended and one trick you can use is to recommend new DVDs which are _similar_ to DVDs the user might like. This is a form of <em>cold start</em> problem and Jan&rsquo;s solution appears pretty generic and sensible.
- In his experience, it is useful to precompute recommendations for users, only updating them when this particular user enters new data. Of course, in theory, you should invalidate these recommendations continuously as new data (form other users) is entered. But Jan felt it was &ldquo;close enough&rdquo; I suspect.


