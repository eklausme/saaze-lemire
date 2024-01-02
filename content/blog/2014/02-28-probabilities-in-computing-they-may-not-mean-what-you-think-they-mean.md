---
date: "2014-02-28 12:00:00"
title: "Probabilities in computing: they may not mean what you think they mean"
---



I like to throw off my academic colleagues outside of computer science by pointing out that much of our software relies on probabilities&hellip; down to the ubiquitous [hash table](https://en.wikipedia.org/wiki/Hash_table). They often expect software to be mostly designed around deterministic ideas. But probabilities are everywhere.

One common problem in software is to distribute objects evenly into buckets. Think about a manager who needs to assign files to one of 60 clerks. Maybe these files are customer complaints. He wants to keep all clerks busy, so he wants to give a roughly equal number of files to each clerk. He could, of course, just pick the next file and give it to the idle clerk, but this would force the manager to have some additional system to keep track of which file went to which clerk. Instead, he notices that all files are identified with a time stamp, and the stamp is precise down the second. He figures he will just assign a number to each clerk from 0 to 60 and match the second figure in the time stamp with the clerk. In this manner, all clerks are likely to be equally busy, and the manager can very quickly find which clerk was assigned which file if he is given the time stamp.

This is called hashing. You take objects and you map them to integers (called hash values) in a way that appears random. What do we mean by &ldquo;random&rdquo;? Specifically, we often require that any two objects are likely to have different hash value (a property called universality).

In the problem with the clerks and the files, where does the randomness come from? From one point of view, there is absolutely no randomness. Customers could file their complaints at a one minute interval. Thus a single clerk would get all of the files.

Much of hashing in computing works this way. It is not at all random. This lack of randomness is a problem as it leaves software open to attacks. If the adversary knows your hash function, he can create trouble. It is not just a theoretical idea, but something hackers actually exploit.

So computer scientists have proposed the introduction of randomness at the level of the hash functions. For example, our manager could ask his clerks to propose ways to map the time stamp to numbers from 0 to 60. Each day he could pick one such approach.

It is used in practice: Ruby and Java have introduced random hashing. This makes these languages more secure. And, yes, this means that the hash value a string takes on Monday can be different from the hash value a string took on Friday.

To be clear, once you have picked one hash function, you have to stick with it. If you kept on changing the hash function, the manager would lose track of his files. So, for a given time period, you use one specific hash function.

So, what do we mean then by &ldquo;given two distinct objects, they are unlikely to have the same hash value&rdquo;&hellip;? We mean that give two fixed objects, there will be relatively few hash functions mapping these two objects to the same hash value.

It would seem that universality solves all your problem, doesn&rsquo;t it? Given two customer complaints, they are unlikely to go to the same clerk.

But what if, on Monday, the manager picked the hash function that maps time stamps to seconds, and, on that day, the customers decide to file in their complaints at a one-second interval? Then, on that day, the manager is in trouble.

It is only on the long run, after picking many hash functions, that the manager is ok __on average__. Any single hash function could be terrible.

There is another probabilistic interpretation that is entirely different. Maybe one can fairly expect the filing times to be random. For example, maybe the customers have little control on when the complaint is actually filed. Then the time stamps themselves can be assumed to be random. In such a case, there may not be any need to change the hash functions.

But how do we know that our hash function is good enough that it does not require changing? 

Suppose that the manager picks a new hash function every day. He hired a theoretical computer scientist as a consultant, and the computer scientist proved that the way the hash functions are picked is &ldquo;universal&rdquo;. 

Further, the manager feels confident that the time stamp are random, and has this proof of universality. So he picks one hash function and sticks with it, figuring that he is now pretty safe.

Ah! The manager just made a critical mistake. It is entirely possible that the manager just picked a very bad hash function (say one that allocates all files to one clerk). 

If he wants to stick with one hash function, and work on the assumption that the time stamps are random, he needs to go back to the theoretician with this specific model. In such a case, the theoretician might check whether the chosen hash function is <em>regular</em>, an entirely different property from universality.

Probability is a hard concept to deal with. You absolutely need to keep track of where the randomness comes from. It makes no sense to just say that a given piece of software is likely to run fast or securely. You have to make your probabilistic model explicit. 

__Further reading__: [Use random hashing if you care about security?](/lemire/blog/2012/01/17/use-random-hashing-if-you-care-about-security/)

