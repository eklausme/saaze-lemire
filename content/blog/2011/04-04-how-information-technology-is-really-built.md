---
date: "2011-04-04 12:00:00"
title: "How information technology is really built"
---



One of my favorite stories is how [Greg Linden](https://plus.google.com/+GregLinden) invented the famous Amazon recommender system, after [after being forbidden to do so](https://glinden.blogspot.com/2006/04/early-amazon-shopping-cart.html). The story is fantastic because what Greg did is contrary to everything textbooks say about good design. You just do not bypass the chain of command! How can you meet your budget and deadline?

In college, we often tell students a story about how software and systems are built. We gather requirements, we design the system, we get a budget, and then we run the project, eventually finishing within budget and while respecting the agreed upon time frame.

This tale makes a lot of sense to people who build bridges, apparently. It not like they can afford to build three different bridge prototypes and then ask people to choose which one they prefer, after checking that all of them are structurally sound.

But software systems are different.

Consider Facebook. Everyone knows Facebook. It is a robust system. It serves 600 million users with only 2000 employees. Surely, they are excessively careful. Maybe they are, but they do not build Facebook the way we might build bridges.

Facebook relies on distributed MySQL. But don&rsquo;t expect any 3 Normal Forms. No join anywhere in sight (Agarwal, 2008). No schema either: MySQL is used as a key-value store, in what is a total perversion of a relational database. Oh! And engineers are given direct access to the data: no DBA to preserve the data from the evil and careless developers.

Because they don&rsquo;t appear to like formal conceptual methodologies, I expect you won&rsquo;t find any entity-relationship (ER) diagram at Facebook. But then, maybe you will find them in large Fortune 100 companies? After all, that is what people like myself have been teaching for years! Yet no ER diagram was found in ten Fortune 100 companies (Brodie &amp; Liu, 2010). And it is not because large companies have simple problems. The average Fortune 100 has ten thousand information systems, of which 90% are relational. A typical relational database has between 100 and 200 tables with dozens of attributes per table.

In a very real way, we have entered a post-methodological era as far as the design of information systems is concerned (Avison and G. Fitzgerald, 2003). The emergence of the web has coincided with the death of the dominant methods based on the analytic thought and lead to the emergence of sensemaking as a primary paradigm.

This is no mere coincidence. At least, two factors have precipitated the fall of the methodologies designed in the seventies:

- __The rise of the sophisticated user.__ These days, the average user of an information system knows just as much about how to use the systems than the employees of the information technology department. The gap between the experts and the users has fallen. Oh! The gap is only apparent: few users even understand how the web work. But they know (or think they do) what it can do and how it can work. Yet, we continue to see <em>users as mere faceless objects for who the systems are designed</em> (Iivari, 2010). The result? 93% of accounts are never used in enterprise business intelligence systems (Meredith and O&rsquo;Donnell, 2010). Users now expect to participate in the design of their tools. For example, Twitter is famous for its hashtags which are used to mine trends, and which are the primary source of semantic metadata on Twitter. Yet did you know that they were invented by a random user, Chris Messina, in a modest tweet back in 2007? It is only after users started adopting hashtags that Twitter, the company, adopted it. Hence, Twitter is really a system which is co-designed by the users and the developers. If your design methodology cannot take this into account, it might be obsolete. Recognizing this, Facebook is not content to test new software in the abstract, using unit tests. In fact, code is tested during the deployment for __user reactions__. If people react badly to an upgrade, the upgrade is pulled back. In some real way, engineers must please users, not merely satisfy formal requirements representing what someone thought the users might want.
- __The exploding number of computers.__ According to Garner, Google had 1 million servers in 2007. Using cloud computing, any company (or any individual) can run software on thousands of servers worldwide without breaking the bank. Yet Brewer&rsquo;s theorem says that, in practice, you cannot have both consistency and availability (Gilbert and Lynch, 2002). Can your design methodology deal with inconsistent data? Yet, that is what many NoSQL database systems (such as Cassandra or MongoDB) offer. Maybe you think that you will just stick with strong consistency. JPMorgan tried it and they ended up freezing $132 million and losing thousands of loan applications during a service outage (Monash, 2010). Most likely, you cannot afford to have strong consistency throughout without sacrificing availability. As they say, it is mathematically impossible. Brewer&rsquo;s theorem is only the tip of the iceberg though: what works for one mainframe, does not work for thousands of computers. Not anymore than a human being is a mere collection of thousands of cells. There is a qualitative difference in how systems with thousands (or millions) of computers must be designed compared with a mainframe system. Problems like data integration are just not on your radar when you have a single database. We have moved from unicellular computers to information ecosystems. If your design methodology was conceived for mainframe computers, it is probably obsolete in 2011.


Building great systems is more art than science right now. The painter must create to understand: the true experts build systems, not diagrams. You learn all the time or you die trying. You innovate without permission or you become obsolete.

__Credit__: The mistakes and problems are mine, but I stole many good ideas from Antonio Badia.

__References__:

- Agarwal, A. [Facebook: Science and the Social Graph](http://www.infoq.com/presentations/Facebook-Software-Stack). QCon 2008.
- Brodie &amp; Liu, The Power and Limits of Relational Technology in the Age of Information Ecosystems, On The Move Federated Conferences, 2010
- D. E. Avison and G. Fitzgerald, [Where now for development methodologies?](http://dl.acm.org/citation.cfm?id=602423) Communications of the ACM, 2003.
- J. Iivari, H. IsomÃ¤ki, S. Pekkola, [The user â€“ the great unknown of systems development: reasons, forms, challenges, experiences and intellectual contributions of user involvement](http://onlinelibrary.wiley.com/doi/10.1111/j.1365-2575.2009.00336.x/abstract), Information Systems Journal, 2010.
- Meredith and O&rsquo;Donnell, [A Functional Model of Social Media and its Application to Business Intelligence](http://dl.acm.org/citation.cfm?id=1860761), DSS &rsquo;10, 2010.
- Gilbert, S. and Lynch, N., [Brewer&rsquo;s conjecture and the feasibility of consistent, available, partition-tolerant web services](http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.67.6951&amp;rep=rep1&amp;type=pdf). 2002
- Curt Monash, [Details of the JPMorgan Chase Oracle database outage](http://www.dbms2.com/2010/09/17/jp-morgan-chase-oracle-database-outage/), 2010. (published online)


