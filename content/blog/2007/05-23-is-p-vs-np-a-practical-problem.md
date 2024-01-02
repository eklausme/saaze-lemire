---
date: "2007-05-23 12:00:00"
title: "Is P vs. NP a practical problem?"
---



Here&rsquo;s a recent quote from ACM TechNews:

> The ACM&rsquo;s Special Interest Group on Algorithms and Computing Theory honored Rudich and Razborov for their contributions to addressing the P vs. NP problem, which involves the computational complexity behind the security of ATM cards, computer passwords, and electronic commerce. 


The implication here is that the P vs. NP problem is important for computer security. This seems like saying that General Relativity is important to establish a mining operation on the Moon.

This may be a naÃ¯ve question, but would proving that P=NP (or disproving it) change anything in computer security?

Yes, I can appreciate the fundamental nature of the P vs. NP problem. But does it have any practical consequences?

Note that whether a problem requires 2<sup>n</sup> or n<sup>150</sup> time will not make much difference: both are intractable.

As a database researcher, anything requiring n<sup>4</sup> time is already intractable. Don&rsquo;t believe me? If n is 1 million and a computer can do 10<sup>12</sup> operations per second, it takes 30 thousand years to solve a n<sup>4</sup> time problem. I am not even going to get in the constants: what if your complexity is 10<sup>120</sup> n?

Oh yes! Please, give prizes to anyone who makes progress toward the P vs. NP problem, but I am still waiting for the practical implications.

(If I am making a crucial mistake here, please tell me! I want to know.)

__Update__. André [pointed me to a web site](http://world.std.com/~reinhold/p=np.txt) that pretty much says that P vs. NP is not so important for cryptography.

