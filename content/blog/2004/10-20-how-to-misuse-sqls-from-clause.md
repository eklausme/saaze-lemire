---
date: "2004-10-20 12:00:00"
title: "How to Misuse SQL´s FROM Clause"
---



I stumbled on an interesting SQL article [on the Misuse of the FROM Clause](http://www.onlamp.com/pub/a/onlamp/2004/09/30/from_clauses.html). The author argues that FROM clauses should refer to only two types of tables:

- those from which you want values returned
- those allowing to join two or more tables in the above category


In other words, if your select is on tables A and B, then you can select from tables A and B, and any table that can be joined with A and B, but no others.

The argument he offers is based on performance concerns. It does seem to me that any query not fulfilling this requirement would have to be relatively complex.

