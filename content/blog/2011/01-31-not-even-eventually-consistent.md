---
date: "2011-01-31 12:00:00"
title: "Not even eventually consistent"
---



Many databases engines [ensure consistency](https://en.wikipedia.org/wiki/Database_consistency#Consistency): at any given time, the database state is logically consistent. For example, even if you receive purchase requests by the thousands, you will always have an accurate count of how many products you have sold, and how many remain in stock. Accountants are especially concerned with consistency: they have invented techniques such as the [double-entry](https://en.wikipedia.org/wiki/Double-entry) systems to favor consistency. Inconsistencies cause problems:

- The user bought a product, a purchase record has been added, but the user account has not yet been charged. This could allow a user to buy more than he can afford.
- All items in stock have been sold, but a customer is being told that a few items remain in stock. Thus, a vendor could make sales it cannot fulfill.


Yet, in practice, requiring consistency [means](https://en.wikipedia.org/wiki/CAP_theorem) that your system will become unavailable from time to time. Thus, many NoSQL databases have adopted an [eventual consistency](https://en.wikipedia.org/wiki/Eventual_consistency) approach. That is, while at any point in time the system might be logically inconsistent, it will eventually recover:

- The user account will  be charged prior to the delivery of the product.
- A customer who ordered a product that is no longer in stock will be told prior to finishing his order.


Even though it give headaches to the developers, eventual consistency is good enough. In any case, robust systems have to deal with exceptions. Even if your systems tell you that there enough items on stock, it could be that one item was damaged in the warehouse, or that another vendor is willing to quickly provide you with missing items. That is, at best, the data in your database is a __logically consistent abstraction__. But [all non-trivial abstractions, to some degree, are leaky](https://en.wikipedia.org/wiki/Leaky_abstraction). And that is why we pay accountants: they chase down the leaks.

Maybe we should keep in mind that the largest, most powerful, information system ever designed is logically inconsistent: the Web is full of dangling and misdirected hyperlinks. And it would be extremely hard to debug the Web. Thankfully, we do not need to. My own Web site is probably filled with mistakes. I am sure that I link to pages that no longer exist. Still, it works. The cost of maintaining the integrity would be too high. The errors are acceptable.

As an analogy, security experts rarely try to fully secure systems. Instead, they identify components that must be secured, and they determine the risk tolerance. Complete security is simply too expensive in practice, unless you are willing to live in an isolated bunker.

Thus, maybe the solution will be to accept that information systems that are __not even eventually consistent__. If I run a business, all that matters to me is that my customers are happy, and I am making a healthy profit. Everything else is secondary. I might be willing to tolerate that some customers are never charged for an item they receive. I might be willing to slightly overstock on some items.

Sure, some might describe a not even eventually consistent system as an abomination, something impossible to program for&hellip; but the Web would have been described this way in the 1980s. The key is that the Web is not inconsistent in any random way: it has its own viable logic.

__Further reading__: [The CALM Conjecture: Reasoning about Consistency](https://databeta.wordpress.com/2010/10/28/the-calm-conjecture-reasoning-about-consistency/)

