---
date: "2019-11-06 12:00:00"
title: "Adding a (predictable) branch to existing code can increase branch mispredictions"
---



Software is full of &ldquo;branches&rdquo;. They often take the form of if-then clauses in code. Modern processors try to predict the result of branches often long before evaluating them. Hard-to-predict branches are a challenge performance-wise because when a processor fails to predict correctly a branch, it does useless work that must be thrown away.

A convenient illustration is an algorithm that generates a random number and then only appends it to a list if the random number is odd<sup>*</sup>. When the numbers are genuinely random, half of the branches will be mispredicted. However, if we generate the same 2000 numbers using a pseudo-random number generator, the processor might learn to predict more accurately which number is odd.
```C
while (howmany != 0) {
    randomval = random();
    if (randomval is odd)
      append randomval to array
    howmany--;
 }
```


What if we add a predictable branch? Let us say that we check whether the random 64-bit value is some arbitrary number. This new branch will be easily predicted as false.
```C
while (howmany != 0) {
    randomval = random();
    if (randomval is 12313132)
       generate error
    if (randomval is odd)
      append randomval to array
    howmany--;
 }
```


Since the new branch is predictable, maybe it comes nearly for free?

Let us run 10 trials of the first algorithm, then 10 trials of the second, and so forth repeatedly, until the branch predictor is practically stable.

Let us count the number of mispredicted branches per loop iteration. We added an easy-to-predict branch, so it should not contribute directly to the number of mispredicted branches. I get the following numbers&hellip;

processor                |one hard branch          |one hard, one easy branch |
-------------------------|-------------------------|-------------------------|
Intel Skylake processor  |4% to 9%                 |30% to 40%               |
ARM A72                  |24% to 26%               |49% to 51%               |


So at least in this particular test, the mere addition of an easy-to-predict branch increased substantially the number of mispredicted branches.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/11/05).

Note: The loop itself is an easily-predicted branch since the processor must determine whether it continues for another iteration or not at the end of each iteration.
<p style="font-size: small;">*- It is a not a practical algorithm, it only serves to illustrate my point.

