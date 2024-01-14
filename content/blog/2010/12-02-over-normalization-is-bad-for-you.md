---
date: "2010-12-02 12:00:00"
title: "Over-normalization is bad for you"
---



I took a real beating with my [previous post](/lemire/blog/2010/11/29/why-do-we-need-database-joins/) where I argued against excessive normalization on the grounds that it increases complexity and inflexibility, and thus makes the application design more difficult. Whenever people get angry enough to post comments on a post of mine, I conclude that I am onto something. So, let&rsquo;s go at it again.

On the physical side, developers use [normalization](https://en.wikipedia.org/wiki/Database_normalization) to avoid storing redundant data. While this might be adequate with modern data database systems, I do not think this is well founded, in principle. Consider this Java code:

<code>String x1="John Smith";

String x2="Lucy Smith";

String x3="John Smith";</code><br/>
Is this code inefficient? Won&rsquo;t the Java compiler create 3 strings whereas only 2 are required? Not at all. Java is smart enough to recognize that it needs to store only 2 strings. Thus, there is no reason for this non-normalized table to be inefficient storage-wise even though Jane Wright appears twice:

Customer ID              |First Name               |Surname                  |Telephone Number         |
-------------------------|-------------------------|-------------------------|-------------------------|
123                      |Robert                   |Ingram                   |555-861-2025             |
456                      |Jane                     |Wright                   |555-403-1659             |
456                      |Jane                     |Wright                   |555-776-4100             |
789                      |Maria                    |Fernandez                |555-808-9633             |


Nevertheless, the [ First normal form](https://en.wikipedia.org/wiki/First_normal_form) article on wikipedia suggests normalizing the data into two tables:

Customer ID              |Telephone Number         |
-------------------------|-------------------------|
123                      |555-861-2025             |
456                      |555-403-1659             |
456                      |555-776-4100             |
789                      |555-808-9633             |


Customer ID              |First Name               |Surname                  |
-------------------------|-------------------------|-------------------------|
123                      |Robert                   |Ingram                   |
456                      |Jane                     |Wright                   |
789                      |Maria                    |Fernandez                |


Pros of the normalized version:

- It does look like the normalized version uses less storage. However, the database engine could compress the non-normalized version so that both use the same space (in theory).
- We can enforce the constraint that a customer can have a single name by requiring that the Customer ID is a [unique key](https://en.wikipedia.org/wiki/Unique_key) (in the second table). The same constraint can be enforced on the non-normalized table, but less elegantly.


Pros of the non-normalized version:

- A customer could have different names depending on the phone number. For example, Edward Buttress could use his real name for his work phone number, but he could report the name Ed Butt for his home phone number. The power to achieve this is entirely in the hands of the software developer: there is no need to change the schema to add such a feature.
- If you start with existing data or try to merge user accounts, the non-normalized version might be the only sane possibility.
- The database schema is simpler. We have a single table! You can understand the data just by reading it. Most of your queries will be shorter and more readable (no join!).


To a large extent, it seems to me that the question of whether to normalize or not is similar to the debate of [static versus dynamic typing](https://en.wikipedia.org/wiki/Type_system). It is also related to the debate between the proponents of the [waterfall method](https://en.wikipedia.org/wiki/Waterfall_method) versus the [agile crowd](https://en.wikipedia.org/wiki/Agile_software). Some might say that working with a non-normalized table is [cowboy coding](https://en.wikipedia.org/wiki/Cowboy_coding). In any case, there is a trade-off. Flexibility versus safety. But to my knowledge, the trade-off is largely undocumented. What are the opportunity costs of complex database schemas? How many databases do get unusable by lack of normalization?

I think that part of the [NoSQL](https://en.wikipedia.org/wiki/NoSQL) appeal for many developers is strong [data independence](https://en.wikipedia.org/wiki/Data_independence). Having to redesign your schema to add a feature to your application is painful. It may even kill the feature in question because the cost of trying it out is too high. Normalization makes constraints easier, but it also reduces flexibility. We should, at least, be aware of this trade-off.

__Note:__ Yes, my example goes against the current practice and what is taught in all textbooks. But that is precisely my intent.

__Update:__ Database views can achieve a related level of data independence.

