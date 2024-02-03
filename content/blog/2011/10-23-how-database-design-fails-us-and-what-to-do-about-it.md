---
date: "2011-10-23 12:00:00"
title: "How database design fails us, and what to do about it"
---




Good database design is crucial to obtain a sound, consistent database, and â€” in turn â€” good database design methodologies are the best way to achieve the right design. These methodologies are taught to most Computer Science undergraduates, as part of any Introduction to database class. They can be considered part of the â€œcanonâ€, and indeed, the overall approach to database design has been unchanged for years. Should we conclude that database design is a solved problem?

The problem of database design is difficult, and it encompasses issues that may not be amenable to formalization. Hence, any method is likely to have some limitations and drawbacks. However, this is not a reason to ignore the serious problems that the traditional approach is running into:

- the traditional approach is not followed in practice;
- we ask practitioners to follow a model that is demanding and yields, in return, some very limited results.


Why does it fail us? Because we make the following assumptions:


- Users are faceless objects for whom the systems are designed.  It&rsquo;s â€œeverything for the people, but without the peopleâ€. (IT people, like communists, love central planning.)
- The information system is strongly consistent. (There is no such thing in practice.)
- Our semantics is absolute. There is a single valid point of view. (Maybe if you live in a cave&hellip;)
- Our models are static. Changes are uncommon. (Nonsense. The world is changing at a break-neck pace.)


Instead, data design methodologies should encourage us to design for


- a distributed world and
- imperfect knowledge.



What do you think?

__Further reading__: I wrote a long-form paper on this topic with Antonio Badia: A Call to Arms: Revisiting Database Design, SIGMOD Record 40 (3), 2011. ACM makes the [PDF](http://www.sigmod.org/publications/sigmod-record/1109/pdfs/10.openforum.badia.pdf) freely available. We back all our observations with  references.

