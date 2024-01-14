---
date: "2018-11-05 12:00:00"
title: "Measuring the memory-level parallelism of a system using a small C++ program?"
---



Our processors can issue several memory requests at the same time. In a multicore processor, each core has an upper limit on the number of outstanding memory requests, which is reported to be 10 on recent Intel processors. In this sense, we would like to say that the level of memory-level parallelism of an Intel processor is 10.
To my knowledge, there is no portable tool to measure memory-level parallelism so I took fifteen minutes to throw together a C++ program. The idea is simple: we visit N random locations in a big array. We make sure that the processor cannot tell which location we will visit next before the previous location has been visited. There is a data dependency between memory accesses. We can break this memory dependency by dividing up the task between different &ldquo;lanes&rdquo;. Each lane is independent (a bit like a thread). The total number of data accesses is fixed. Up to some point, having more lane should speed things up due to memory-level parallelism. I used the term &ldquo;lane&rdquo; so that there is no confusion with &ldquo;threads&rdquo; and multicore processing: my code is entirely single-threaded.
```C
  size_t howmanyhits_perlane 
         = howmanyhits / howmanylanes;
  for (size_t counter = 0; 
      counter < howmanyhits_perlane; counter++) {
    for (size_t i = 0; i < howmanylanes; i++) {
      size_t laneindexes = hash(lanesums[i] + i);
      lanesums[i] += bigarray[laneindexes];
    }
  }
```


Methodologically, I increase the number of lanes until adding one more benefits the overall speed by less than 5%. Why 5%? No particular reason: I needed a threshold of some kind. I suspect that I slightly underestimate the maximal amount of memory-level parallelism: it would take a finer analysis to make a more precise measure.

I run the test three times and check that it gives three times the same integer value. Here are my (preliminary) results:

Intel Haswell            |7                        |
-------------------------|-------------------------|
Intel Skylake            |9                        |
ARM Cortex A57           |5                        |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/11/05).

On a multicore systems, there is more memory-level parallelism, so a multithreaded version of this test could deliver higher numbers.

__Credit__: The general idea was inspired by an email from Travis Downs, though I take all of the blame for how crude the implementation is.
