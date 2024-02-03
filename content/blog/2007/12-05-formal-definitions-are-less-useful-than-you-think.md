---
date: "2007-12-05 12:00:00"
title: "Formal definitions are less useful than you think"
---



There is a widely held belief that shared formal definitions improve collaboration. Certainly, most scientists share several unambiguous definitions. For example, there cannot be a disagreement as to what 2+2 is.

In crafting a research paper, it is important to keep ambiguities to a minimum. You do not want the reader to keep on wondering what you mean. Yet many highly useful research papers contain few, if any, formal definitions. In fact, entire fields exist without shared formal definitions. One such field is [OLAP](https://en.wikipedia.org/wiki/OLAP): the craft of multidimensional databases. The term was coined by [Codd](https://en.wikipedia.org/wiki/Ted_Codd) in 1993, yet, as of 2007, I have no yet seen a formal definition, shared or not, of what OLAP is! But it gets more interesting: even the common terms in the field, such as <em>dimension</em>, are fuzzy. What is a dimension in OLAP depends very much on who is holding the pen. Yet there is no crisis lurking and people do get along.

In short, you do not need shared formal definitions to be productive as a group. A good research paper does not need to introduce formal definitions. Your research papers will be slightly ambiguous.

There are fundamental reasons why that is. For one thing, formal definitions are often intractable!

Let us consider an example. You might think that the equality between two numbers is one such &ldquo;fact&rdquo; that is well defined and poses no problem.

Really? How do you check if two numbers are equal? Computers tend to use [floating point numbers](https://en.wikipedia.org/wiki/Floating_point_numbers). My computer is telling me, right now, that 8/9 = 0.88888888888888884. Does this equality hold? Formally, it does not. Yet, a computer cannot represent 8/9 exactly using floating point numbers, so most software will say that two numbers are equal if they differ by a small amount (the tolerance factor) to account for the numerical error. Two scientists might have a different tolerance factors, and so, the __equality of two floating point numbers is not subject to a shared formal definition__. Ah! But you may object that computers can represent numbers symbolically. However, checking the equality of two symbolic expressions is intractable in general.

So, we cannot even share a common, tractable definition of what it means for two numbers to be equal. This should entice us to be quite modest in our attempts to &ldquo;formalize our knowledge.&rdquo;

__Update__: Our modern civilization relies on relational database. They are everywhere, from bank account to this web site. [Yet relational databases are logically inconsistent](/lemire/blog/2013/03/05/do-null-markers-in-sql-cause-harm/). Does it matter? Apparently, it matters very little.

__Further Reading__: [&ldquo;I don&rsquo;t believe in word senses&rdquo;](https://arxiv.org/abs/cmp-lg/9712006)

