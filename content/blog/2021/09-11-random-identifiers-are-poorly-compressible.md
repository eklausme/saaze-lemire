---
date: "2021-09-11 12:00:00"
title: "Random identifiers are poorly compressible"
---



It is common in data engineering to find that we have too much data. Thus engineers commonly seek compression routines.

At the same time, random identifiers are handy. Maybe you have many users or transactions and you want to assign each one of them a unique identifier. It is not uncommon for people to use wide randomized identifiers, e.g. 64-bit integers.

By definition, if your identifiers are random, they are hard to compress. Compression fundamentally works by finding and eliminating redundancy.

Thus, if you want your identifiers to be compressible, you should make sure that they are not random. For example, you can use local identifiers that are sequential or nearly sequential (1, 2,&hellip;). Or you may try to use as few bits as possible per identifier: if you have only a couple of billions of identifiers, then you may want to limit yourself to 32-bit identifiers.

Often people do not want to design their systems by limiting the identifiers. They start with wide random identifiers (64-bit, 128-bit or worse) and they seek to engineer compressibility back into the system.

If you generate distinct identifiers, some limited compression is possible. Indeed, if the same integer cannot occur twice, then knowing one of them gives you some information on the others. In the extreme case where you have many, many distinct identifiers, then make become highly compressible. For example, if I tell you that I have 2<sup>64</sup> distinct 64-bit integers, then you know exactly what they are (all of them). But you are unlikely to ever have 2<sup>64</sup> distinct elements in your computer.

If you have relatively few distinct 64-bit integers, how large is the possible compression?

We can figure it out with a simple information-theoretical analysis. Let n be the number of identifiers (say 2<sup>64</sup>), and let k be the number of distinct identifiers in your system. There &ldquo;n choose k&rdquo; (the binomial coefficient) different possibilities. You can [estimate](https://math.stackexchange.com/questions/1447296/stirlings-approximation-for-binomial-coefficient) &ldquo;n choose k&rdquo; with n<sup>k</sup>/k! when k is small compared to n and n is large. If I want to figure out how many bits are required to index a value amount n<sup>k</sup>/k!, I need to compute the logarithm. I get k log n &#8211; log k! where the log is in base 2. Without compression, we can trivially use log n bits per entry. We see that with compression, I can save about 1/k log k! bits per entry. By Stirling&rsquo;s approximation, that is no more than log k. So if you have k unique identifiers, you can save about log k bits per identifier with compression.

My analysis is rough, but should be in the right ball park. If you have 10,000 unique 64-bit identifiers then, at best, you should require about per identifier&hellip; so about a 20% saving. It may not be practically useful. With a million unique 64-bit identifiers, things are a bit better and you can reach a saving of about 40%. You probably can get close to this ideal compression ratio with relatively simple techniques (e.g., binary packing).

To get some compression, you need to group many of your identifiers. That is not always convenient. Furthermore, the compression itself may trade some performance away for compression.

