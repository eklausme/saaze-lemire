---
date: "2013-03-05 12:00:00"
title: "Do NULL markers in SQL cause any harm?"
---



The relational model, and by extension, the language SQL supports the notion of NULL marker. It is commonly used to indicate that some attribute is unknown or non applicable. NULL markers are a bit strange because they are not values per se. Hence, the predicate 1 = NULL is neither true nor false. Indeed, the inventor of the relational model, [E. F. Codd](https://en.wikipedia.org/wiki/Edgar_F._Codd), proposed a 3-value logic model: predicates are true, false or unknown. This lives on even today. Our entire civilization runs on database systems using an unintuitive 3-value logic. Isn&rsquo;t that something!

Unfortunately, in real life, predicates either evaluate to true, or they don&rsquo;t. [C. J. Date](https://en.wikipedia.org/wiki/C._J._Date) [showed that NULL markers end up giving you inconsistent semantics](http://www09.sigmod.org/sigmod/record/issues/0809/p23.grant.pdf). So our civilization runs on database systems that can be inconsistent!
Yet the NULL markers were introduced for a reason: some things do remain unknown or are non applicable. We can handle these issues with more complicated schemas, but it is not practical. So database designers do allow NULL markers.

How did Codd react when it was pointed out to him that NULL markers make his model inconsistent? He essentially told us that NULL markers are in limbo:

> (&hellip;) the normalization concepts do NOT apply, and should NOT be applied, globally to those combinations of attributes and tuples containing marks. (&hellip;) The proper time for the system to make this determination is when an attempt is made to replace the pertinent mark by an actual db-value.



So the mathematical rigor does not apply to NULL markers. Period.

This sounds pretty bad. I am rather amazed that Codd could get away with this.

But how bad is it in real life?
Let us consider WordPress, the blog engine I am using. As part of the core database schema, only the tables wp_postmeta, wp_usermeta and wp_commentmeta allow NULL markers. These tables are exclusively used to store metadata describing blog posts, users and comments. If this metadata is somehow inconsistent, the blog engine will not fall apart. It may hurt secondary features, such as advanced navigation, but the core data (posts, users and comments) will remain unaffected.

Date was repeatedly asked to prove that NULL markers were indeed a problem. I do not think that he ever conclusively showed that they were a real problem. Anyhow, our civilization has not collapsed yet.

Does anyone has any evidence that NULL markers are a bona fide problem in practice? Oh! Sure! Incompetent people will always find a way to create problems. So let us assume we are dealing with reasonably smart people doing reasonable work.

__Credit__: This post is motivated by an exchange with A. Badia from Louisville University.

__Example of SQL&rsquo;s inconsistency:__

>We are given two tables: Suppliers (sno,city) and Parts(pno,city). The tables have both a single row; (S1,&rsquo;London&rsquo;) and (P1,null) respectively. That is, we have one supplier in London as well as one part for which the location is left unspecified (hence the null marker).

We have the following query:

Select sno, pno<br/>
From Suppliers, Parts<br/>
Where Parts.city &lt;> Suppliers.city<br/>
Or Parts.city &lt;> &lsquo;Paris&rsquo;;

In SQL, this query would return nothing due to Codd&rsquo;s 3-value logic because the where clause only selects row when the predicate is true.
Yet we know that if a physical part is actually located somewhere, it is either not in London or not in Paris. So the answer is wrong.

Let us consider another interpretation: maybe the part P1 is fictitious. It is not physically available anywhere. In such a case, the SQL query still fails to return the correct answer as the part P1 is not in London.
Maybe we could assume instead that the part P1 is available everywhere: this later interpretation is also incorrect<br/>
because the query
Select * from Parts where Parts.city = &lsquo;Paris&rsquo;

will return nothing.



