---
date: "2021-03-24 12:00:00"
title: "Counting cycles and instructions on the Apple M1 processor"
---



When benchmarking software, we often start by measuring the time elapsed. If you are benchmarking data bandwidth or latency, it is the right measure. However, if you are benchmarking computational tasks where you avoid  disk and network accesses and where you only access a few pages of memory, then the time elapsed is often not ideal because it can vary too much from run to run and it provides too little information.

Most processors will adjust their frequency in response to power and thermal constraints. Thus you should generally avoid using a laptop. Yet even if you can get stable measures, it is hard to reason about your code from a time measurement. Processors operate in cycles, retiring instructions. They have branches, and sometimes they mispredict these branches. These are the measures you want!

You can, of course, translate the time in CPU cycles if you know the CPU frequency. But it might be harder than it sounds because even without physical constraints, processors can vary their frequency during a test. You can [measure the CPU frequency using predictable loops](/lemire/blog/2019/05/19/measuring-the-system-clock-frequency-using-loops-intel-and-arm/). It is a little bit awkward.

Most people then go to a graphical tool like Intel VTune or Apple Instruments. These are powerful tools that can provide fancy graphical displays, run samples, record precise instruction counts and so forth. They also tend to work across a wide range of programming languages.

These graphical tools use the fact that processor vendors include &ldquo;performance counters&rdquo; in their silicon. You can tell precisely how many instructions were executed between two points in time.

Sadly, these tools can be difficult to tailor to your needs and to automate. Thankfully, the Linux kernel exposes performance counters, on most processors. Thus if you write code for Linux, you can rather easily query the performance counters for yourself. Thus you can put markers in your code and find out how many instructions or cycles were spent between these markers. We often refer to such code as being &ldquo;instrumented&rdquo;. It requires you to modify your code and it will not work in all programming languages, but it is precise and flexible. It even works under Docker if you are into containers. You may need privileged  access to use the counters. Surely you can also access the performance counters from your own program under Windows, but I never found any documentation nor any example.

My main laptop these days is a new Apple macbook with an M1 processor. This ARM processor is remarkable. In many ways, it is more advanced that comparable Intel processors. Sadly, until recently, I did not know how to instrument my code for the Apple M1.

Recently, one of the readers of my blog (Duc Tri Nguyen) showed me how, inspired by code from Dougall Johnson. [Dougall has been doing interesting research on Apple&rsquo;s processors](https://github.com/dougallj/applecpu). As far as I can tell, it is entirely undocumented and could blow up your computer. Thankfully, to access the performance counters, you need administrative access (<tt>wheel</tt> group). In practice, it means that you could start your instrumented program in a shell using <code>sudo</code> so that your program has, itself, administrative privileges.

To illustrate the approach, [I have posted a full C++ project](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/03/24) which builds an instrumented benchmark. You need administrative access and an Apple M1 system. I assume you have installed the complete developer kit with command-line utilities provided by Apple.

I recommend measuring both minimal counters as well as the average counters. When the average is close to the minimum, you usually have reliable results. The maximum is less relevant in computational benchmarks. Observe that measures taken during a benchmark are not normally distributed: they are better described as following a log-normal distribution.

[The core of the benchmark looks like the following C++ code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/03/24):
```C
  performance_counters agg_min{1e300};
  performance_counters agg_avg{0.0};
  for (size_t i = 0; i < repeat; i++) {
    performance_counters start = get_counters();
    my_function();
    performance_counters end = get_counters();
    performance_counters diff = end - start;
    agg_min = agg_min.min(diff);
    agg_avg += diff;
  }
  agg_avg /= repeat;
```


Afterward, it is simply a matter of printing the results. [I decided to benchmark floating-point number parsers](/lemire/blog/2021/01/29/number-parsing-at-a-gigabyte-per-second/) in C++. I get the following output:
```C
# parsing random numbers
model: generate random numbers uniformly in the interval [0.000000,1.000000]
volume: 10000 floats
volume = 0.0762939 MB
model: generate random numbers uniformly in the interval [0.000000,1.000000]
volume: 10000 floats
volume = 0.0762939 MB
    strtod    375.92 instructions/float (+/- 0.0 %)
                75.62 cycles/float (+/- 0.1 %)
                4.97 instructions/cycle
                88.93 branches/float (+/- 0.0 %)
                0.6083 mis. branches/float

fastfloat    162.01 instructions/float (+/- 0.0 %)
                22.01 cycles/float (+/- 0.0 %)
                7.36 instructions/cycle
                38.00 branches/float (+/- 0.0 %)
                0.0001 mis. branches/float
oat
```


As you can see, I get the average  number of instructions, branches and mispredicted branches for every floating-point number. I also get the number of instructions retired per cycle. It appears that on this benchmark, the Apple M1 processor gets close to 8 instructions retired per cycle when parsing numbers with the [fast_float library](https://github.com/fastfloat/fast_float). That is a score far higher than anything possible on an Intel processor.

You should note how precise the results are: the minimum and the average number of cycles are almost identical. It is quite uncommon in my experience to get such consistent numbers on a laptop. But these Apple M1 systems seem to show remarkably little variation. It suggests that there is little in the way of thermal constraints. I usually avoid benchmarking on laptops, but I make an exception with these laptops.

You should be mindful that the &lsquo;number of instructions&rsquo; is an ill-defined measure. Processors can fuse or split instructions, and they can decide to count or not the number of speculative instructions. In my particular benchmark, there are few mispredicted branches so that the difference between speculative instructions and actually retired instructions is not important.

To my knowledge, none of this performance-counter access is documented by Apple. Thus my code should be viewed with suspicion. It is possible that these numbers are not what I take them to be. However, the numbers are generally credible.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/03/24).

__Note__: Though my code only works properly under the Apple M1 processor, I believe it could be fixed to support Intel processors.

__Update__. [I have new code which supports more recent Apple systems.](/lemire/blog/2023/03/21/counting-cycles-and-instructions-on-arm-based-apple-systems/)

