---
date: "2020-01-08 12:00:00"
title: "How I teach database design"
---



Most software runs on top of databases. These databases are organized logically, with a schema, that is a formal description. You have entities (your user), attributes (your user&rsquo;s name) and relationships between them.

Typical textbook database design comes from an era when it was possible to believe that you knew, at the start of the project, what the data would be like. And you could believe that it would not change. You could certainly believe that your 200-page design document would be updated and maintained, and it would be compulsory reading for computer folks in your company for decades. When building an accounting application, you would query the databases using SQL. All of the data was accessed through the databases. The database was the interface. And the same set of centralized databases running on a single computer would serve the entire operation. And everyone would know what the field &ldquo;name&rdquo; meant, exactly, in the table &ldquo;user&rdquo;. There would not be mergers between companies, or corporate pivots taking you into a new direction. You could believe that your conceptual and logical principles were independent from physical implementation principles. There would be no need to ever duplicate data for performance.

Quite often, it is not how systems are built today, if they ever were built this way. You organize functions in your organization in terms of services. And the services communicate between themselves. People who do not have to work directly on your service do not need to know how the data is organized or even if the organization is publicly documented at all. You have to provide them an interface, and that is all that they should need. On your end, you cannot rely on the database engine alone to ensure that the data remains usable. &ldquo;But my data follows a strict schema&rdquo; is not an excuse for failure. Your users do not want to know about your data layout, they do not want to have to know.

When organizing your data, you will probably get it wrong. If not today, then next week or next year. Life is fast changing and your knowledge is always incomplete. The [waterfall model](https://en.wikipedia.org/wiki/Waterfall_model) is naive to the point of being actively harmful. So you want to isolate the data layout from its use as much as you can.

In textbooks, the core principle of database design is often &ldquo;do not duplicate data&rdquo;. The logic is sound: if you duplicate data, at some point these values may go out of sync and what do you do then? If I see a programmer duplicating data all over his code, I know he lacks experience. However, it is also the case that deliberate duplication is essential. Sometimes you need duplication for performance and performance matters. Sometimes you need duplication to avoid unwieldy complexity, and managing complexity matters. And you need duplication because your information system runs on more than one processor.

You want to store everything in one giant system so that there is no duplication and everything is consistent? This thinking does not scale. It does not scale with respect to complexity or performance. And it does not even achieve consistency in the real world.

The data you will be receiving and maintaining is not pristine. In fact, it is full of errors and unknowns. Marketing thinks that John Smith&rsquo;s phone number if something whereas accounting thinks that it is something else? You know what? Maybe they are both right or maybe they are both wrong. And it is worse than you think because there are unknown unknowns: nothing in your database can be regarded without suspicion. And the minute you have incomplete or uncertain data, your dream of enforcing the relationships between entities may just become naive.

Does that mean that anything goes and that you don&rsquo;t need to worry about database design? Quite the opposite: you ought to be agonizing over every decision and making sure that you never locking yourself into a corner. Because you will have duplication and multiple systems, you will have inconsistency and you will need to deal with them, and a single strategy won&rsquo;t work for all cases.

So how do I teach database design? I ask students to be critical about the textbook material, and I expose them as much as possible to real-world example where things are not perfectly neat. Begin by looking under the hood of your favorite open-source project.

__Further reading__: [On Desirable Semantics of Functional Dependencies over Databases with Incomplete Information](https://arxiv.org/abs/1703.08198), Fundamenta Informaticae 158 (2018); [Functional dependencies with null markers](https://arxiv.org/abs/1404.4963), Computer Journal 58 (2015); [A Call to Arms: Revisiting Database Design](https://arxiv.org/abs/1105.6001), SIGMOD Record 40 (2011).

