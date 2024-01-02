---
date: "2023-08-15 12:00:00"
title: "How accurate is the birthday´s paradox formula?"
---



Given a set of r random values from a large set (of size N), [I have been using the formula 1-exp(-r**2/(2N))](/lemire/blog/2019/12/12/are-64-bit-random-identifiers-free-from-collision/) to approximate the probability of a collision. It assumes that r is much smaller than N. The formula suggests that if you have hundreds of millions of random 64-bit numbers, you will start getting collisions with non-trivial probabilities, meaning that at least two values will be equal. At the one billion range, the probability of a collision is about 3% according to this formula.

It is somewhat unintuitive because if I give you two random 64-bit values, the probability of a collision is so low that it might as well be zero.

Though it is a textbook formula, we should still test it out to make sure that it is reasonable. Let us generate 32-bit random values for speed. I use a simple frequentist approximation: I generate many sets of 32-bit random values, I count the number of sets with a collision, and I divide this number by the total number of sets.

My results are as follows. The formula agrees with my results: I get a maximal error of 23%. The exact measured output depends on the random number generation and will vary depending on how you set it up. Nevertheless, it looks good! As you can see, if you even only 51,200 32-bit random values, the probability of a collision reaches 25%. [My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/08/15).

number                   |theory                   |measured                 |relative error           |
-------------------------|-------------------------|-------------------------|-------------------------|
100                      |0.000001                 |0.000001                 |error: 23%               |
200                      |0.000005                 |0.000005                 |error: 13%               |
400                      |0.000019                 |0.000014                 |error: 23%               |
800                      |0.000075                 |0.000073                 |error: 2%                |
1600                     |0.000298                 |0.000254                 |error: 15%               |
3200                     |0.001191                 |0.001079                 |error: 9%                |
6400                     |0.004757                 |0.004700                 |error: 1%                |
12800                    |0.018893                 |0.017570                 |error: 7%                |
25600                    |0.073456                 |0.071261                 |error: 3%                |
51200                    |0.263006                 |0.240400                 |error: 9%                |


