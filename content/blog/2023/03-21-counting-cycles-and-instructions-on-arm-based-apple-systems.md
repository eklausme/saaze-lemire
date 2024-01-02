---
date: "2023-03-21 12:00:00"
title: "Counting cycles and instructions on ARM-based Apple systems"
---



In my blog post [Counting cycles and instructions on the Apple M1 processor](/lemire/blog/2021/03/24/counting-cycles-and-instructions-on-the-apple-m1-processor/), I showed how we could have access to &ldquo;performance counters&rdquo; to count how many cycles and instructions a given piece of code took on ARM-based mac systems. At the time, we only had access to one Apple processor, the remarkable M1. Shortly after, Apple came out with other ARM-based processors and my current laptop runs on the M2 processor. Sadly, my original code only works for the M1 processor.

Thanks to the <a href="https://twitter.com/ibireme/status/1476802948160442368">reverse engineering work of <em>ibireme</em></a>, a software engineer, we can generalize the approach. We have further extended my original code so that it works under both Linux and on ARM-based macs. The code has benefited from contributions from Wojciech Muła and John Keiser.

For the most part, you setup a global event_collector instance, and then you surround the code you want to benchmark by collector.start() and collector.end(), pushing the results into an event_aggregate:
```C
#include "performancecounters/event_counter.h"

event_collector collector;

void f() {
  event_aggregate aggregate{};
  for (size_t i = 0; i < repeat; i++) {
   collector.start();
   function(); // benchmark this function
   event_count allocate_count = collector.end();
   aggregate << allocate_count;
  }
}

```


And then you can query the aggregate to get the average or best performance counters:
```C
aggregate.elapsed_ns() // average time in ns
aggregate.instructions() // average # of instructions
aggregate.cycles() // average # of cycles
aggregate.best.elapsed_ns() // time in ns (best round)
aggregate.best.instructions() // # of instructions (best round)
aggregate.best.cycles() // # of cycles (best round)

```


[I updated my original benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/03/21) which records the cost of parsing floating-point numbers, comparing the [fast_float library](https://github.com/fastfloat/fast_float) against the C function strtod:
```C
# parsing random numbers
model: generate random numbers uniformly in the interval [0.000000,1.000000]
volume: 10000 floats
volume = 0.0762939 MB
                           strtod     33.10 ns/float    428.06 instructions/float
                                      75.32 cycles/float
                                       5.68 instructions/cycle
                        fastfloat      9.53 ns/float    193.78 instructions/float
                                      27.24 cycles/float
                                       7.11 instructions/cycle
```


[The code is freely available for research purposes.](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/03/21)

