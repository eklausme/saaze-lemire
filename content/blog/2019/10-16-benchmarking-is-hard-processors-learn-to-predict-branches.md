---
date: "2019-10-16 12:00:00"
title: "Benchmarking is hard: processors learn to predict branches"
---



A lot of software is an intricate of branches (<tt>if</tt>&#8211;<tt>then</tt> clauses). For performance reasons, modern processors predict the results of these branches.

[In my previous post](/lemire/blog/2019/10/15/mispredicted-branches-can-multiply-your-running-times/), I showed how the bulk of your running time could be due to mispredicted branches. My benchmark consisted in writing 64 million random integers to an array. When I tried to only write odd random integers, the performance became much worse, due to the mispredictions.
```C
while (howmany != 0) {
    val = random();
    if( val is an odd integer ) {
      out[index] =  val;
      index += 1;
    }
    howmany--;
}
```


Why 64 million integers and not, say, 2000? If you run just one test, then it should not matter. However, what if you are running multiple trials? Quickly, the number of mispredicted branches falls to zero. The numbers on an Intel Skylake processor speaks for themselves:

trial                    |mispredicted branches (Intel Skylake) |
-------------------------|-------------------------|
1                        |48%                      |
2                        |38%                      |
3                        |28%                      |
4                        |22%                      |
5                        |14%                      |


The &ldquo;learning&rdquo; keeps on going as the following plots shows&hellip; Eventually, the fraction of mispredicted branches falls to about 2%.

<a href="https://lemire.me/blog/wp-content/uploads/2019/10/results.png"><img decoding="async" class="size-full wp-image-17913" src="https://lemire.me/blog/wp-content/uploads/2019/10/results.png" alt width="640" height="480" srcset="https://lemire.me/blog/wp-content/uploads/2019/10/results.png 640w, https://lemire.me/blog/wp-content/uploads/2019/10/results-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" /></a>

That is, as you keep measuring how long the same task takes, it gets faster and faster because the processor learns to better predicts the outcome. The quality of the &ldquo;learning&rdquo; depends on your exact processor, but I would expect that better, newer processors should learn better. Importantly, from run to run, we generate the same random integers.

The latest server processors from AMD learn to predict the branch perfectly (within 0.1%) in under 10 trials.

trial                    |mispredicted branches (AMD Rome) |
-------------------------|-------------------------|
1                        |52%                      |
2                        |18%                      |
3                        |6%                       |
4                        |2%                       |
5                        |1%                       |
6                        |0.3%                     |
7                        |0.15%                    |
8                        |0.15%                    |
9                        |0.1%                     |


This perfect prediction on the AMD Rome falls apart if you grow the problem from 2000 to 10,000 values: the best prediction goes from a 0.1% error rate to a 33% error rate.

You should probably avoid benchmarking branchy code over small problems.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/10/15).

__Credit__: The AMD Rome numbers were provided by Velu Erwan.

__Further reading__: [A case for (partially) TAgged GEometric history length branch prediction](http://www.irisa.fr/caps/people/seznec/JILP-COTTAGE.pdf) (Seznec et al.)

