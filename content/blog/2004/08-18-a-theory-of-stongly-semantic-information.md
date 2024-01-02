---
date: "2004-08-18 12:00:00"
title: "A Theory of Strongly Semantic Information"
---



Thanks to my colleague Jean Robillard, I found out that philosophers do Knowledge Management too! Following a request I made, Jean suggested I read an Outline of a Theory of Strongly Semantic Information by L. Floridi.

He starts out by asking how much information is there in a statement? Well, in a finite discrete world (the realm where Floridi appears to live), you can reasonably define &ldquo;information content&rdquo; in terms of how many possibilities the statement rules out. For example, if my world is made of two balls, each of which can be either red or blue, so my world has 4 possible states, and I say that &ldquo;ball 1 is blue&rdquo;, there are only 2 possibilities left (ball 2 is either red or blue) so I could say that I&rsquo;ve ruled out 2 possibilities and so my information content is 2. If I say &ldquo;both balls are blue&rdquo;, my information content is 4. You can see right away that a self-contradictory statement (&ldquo;ball 1 is blue, both balls are red&rdquo;) rules out all possibilities as well, so it has maximal information content. A tautology (&ldquo;ball 1 is either blue or red&rdquo;) has 0 information content. Floridi is annoyed by the fact that a self-contradictory statement has maximal information content.

In section 5, he points out that statements are not only either true or false, but they have a degree of discrepancy. So, for example, I can say that I have some balls. This is a true statement, but with high discrepancy. However, I can say that I have 3 balls when in fact I have 2 balls and while false, this is a statement with lower discrepancy, and maybe a more useful statement. Apparently, he borrows this idea from Popper, but no doubt this is not a new idea.

He comes up with conditions on a possible measure of discrepancy between -1 and 1. -1 means that the statement is totally false and matches no possible situation (&ldquo;I have 2 and 3 balls&rdquo;), 0 means that you have a very precise and true statement (&ldquo;I have 2 balls&rdquo;), and 1 means that I have a true, but maximally vague statement (&ldquo;I have some number of balls&rdquo;). What he is getting at is that both extremes (-1 and 1) are equally unuseful, but that things near zero are equally useful (either false or true). Let&rsquo;s call this value upsilon.

Then, he defines the degree of informativeness as 1-upsilon^2.

This solves the problem we had before. The statement &ldquo;ball 1 is blue, both balls are red&rdquo; will now have an upsilon value somewhere between -1 and 0, so it will have some degree of informativeness, but nothing close to the maximal. The statement &ldquo;ball 2 is either red or blue&rdquo; will upsilon = 1 and so will have a degree of informativeness of 0. Finally, &ldquo;ball 1 is blue&rdquo; will have upsilon positive but less than 1, and possibly close to 0, so that it will have a good degree of informativeness.

