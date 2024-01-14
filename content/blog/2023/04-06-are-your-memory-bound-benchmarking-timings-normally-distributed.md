---
date: "2023-04-06 12:00:00"
title: "Are your memory-bound benchmarking timings normally distributed?"
---



When optimizing software, we routinely measure the time that takes a given function or task. Our goal is to decide whether the new code is more or less efficient. The typical assumption is that we get a normal distribution of the timings, and so we should therefore report the average time. If the average time goes up, our new code is less efficient.

I believe that the normality assumption is frequently violated in software benchmarks. I recently gave a talk on precise and accurate benchmarking ([video](https://www.youtube.com/watch?v=BFISG3LY9UQ), [slides](https://speakerdeck.com/lemire/accurate-and-efficient-software-microbenchmarks)) at a &ldquo;Benchmarking in the Data Center&rdquo; workshop where I made this point in detail.

Why should it matter? If you have normal distributions, you can mathematically increase the accuracy of the measure by taking more samples. Your error should go down as the square root of the number of measures.

If you ever tried to increase the number of samples in the hope of getting a more accurate result, you may have been severely disappointed. And that is because the timings often more closely ressemble a <em>log normal distribution</em>:

<a href="https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08.png"><img decoding="async" class="alignnone size-medium wp-image-20354" src="https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08-300x185.png" alt width="300" height="185" srcset="https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08-300x185.png 300w, https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08-1024x631.png 1024w, https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08-768x473.png 768w, https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08-1536x946.png 1536w, https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08-825x510.png 825w, https://lemire.me/blog/wp-content/uploads/2023/04/Capture-decran-le-2023-04-06-a-15.28.08.png 1760w" sizes="(max-width: 300px) 100vw, 300px" /></a>

A <em>log normal distribution</em> is asymmetrical, you have mean that is relatively close the minimum, and a long tail&hellip; as you take more and more samples, you may find more and more large values.

You can often show that you do not have a normal distribution because you find 4-sigma, 5-sigma or even 13-sigma events: you measure values that are far above the average compared to your estimated standard deviation. It is not possible, in a normal distribution, to be multiple times the standard deviation away from the mean. However, it happens much more easily with a log normal.

Of course, real data is messy. I am not claiming that your timings precisely follow a log normal distribution. It is merely a model. Nevertheless, it suggests that reporting the average and the standard error is inadequate. I like to measure the minimum and the average. You can then use the distance between the average and the minimum as an easy-to-measure error metric: if the average is far from the minimum, then your real-world performance could differ drastically from the minimum. The minimum value is akin to the friction-less model in Physics: it is the performance you get after taking out all the hard-to-model features of the problem.

People object that they want the real performance but that’s often an ill-posed problem like asking about how fast a real ball rolls down a real slope, with the friction and air resistance: you can measure it, but a ball rolling down a slope does not have inherent, natural friction and air resistance… that’s something that comes out in your specific use case. In other words, a given piece of software code does not have a natural performance distribution… independent from your specific use case… however, it is possible to measure the best performance that a function might have on a given CPU. The function does not have an intrinsic performance distribution but it has a well defined minimum time of execution.

The minimum is easier to measure accurately than the average. I routinely achieve a precision of 1% or better in practice. That is, if I rerun the same benchmark another day on the same machine, I can be almost certain that the result won&rsquo;t vary by much more than 1%. The average is slightly more difficult to nail down. You can verify that it is so with a model: if you generate log-normally distributed samples, you will find it easier to determine the minimum than the average with high accuracy.

What about the median? Let us imagine that I take 30 samples from lognormal distribution. I repeat many times, each time measuring the average, the median and the minimum. Both the median and average will have greater relative standard error. In practice, I also find that the median is both harder to compute (more overhead) and not as precise as the minimum.

I find that under some conditions (fixed data structures/data layout, few system calls, single-core processing, no tiny function, and no JIT compiler) the minimum time elapsed is a good measure.

For my talk, I used a compute-bound routine: the performance of my function was not bound by the speed of the RAM, by the network or by the disk. I took data that was in CPU cache and I generated more data in CPU cache. For these types of problems, I find that timings often ressemble a log normal.

What about other types of tasks? What about memory-bound tasks?

[I took a memory benchmark that I like to use](https://github.com/lemire/testingmlp). It consists of a large array spanning hundreds of megabytes, and the software must jump from location to location in it, being incapable of predicting the next jump before completing the read. It is often called a &ldquo;pointer chasing&rdquo; routine. I can interleave the pointer-chasing routines so that I have several loads in flight at each time: I call this the number of lanes. The more lanes I have, the more &ldquo;bandwidth limited&rdquo; I become, the fewer the lanes, the more &ldquo;memory latency&rdquo; I become. I am never compute bound in these tests, meaning that the number of instructions retired per cycle is always low.

For each fixed number of lanes, I run the benchmark 30 times on an Amazon Intel c6i node running Ubuntu 22. The time elapsed vary between over 3 seconds per run (for one lane) to about 1/6 s (for 30 lanes). I then estimate the standard deviation, I compute the mean, the maximum and the minimum. I then compute the bottom sigma as the gap (in number of standard deviations) between the minimum and the average, and then the gap between the average and the maximum. If the distribution is normal, I should have roughly the same number of sigmas on either side (min and max) and I should not exceed 3 sigmas. I find that one side (the maximum),  easily exceed 3 sigmas, so it is not a normal distribution. It is also clearly not symmetrical.

<img decoding="async" class="alignnone size-medium wp-image-20356" src="https://lemire.me/blog/wp-content/uploads/2023/04/plot.png" alt width="50%" srcset="https://lemire.me/blog/wp-content/uploads/2023/04/plot.png 640w, https://lemire.me/blog/wp-content/uploads/2023/04/plot-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" />

Yet my measures are relatively precise. The relative distance between the minimum and the mean, I get a tiny margin, often under 1%.

<img decoding="async" class="alignnone size-medium wp-image-20359" src="https://lemire.me/blog/wp-content/uploads/2023/04/plotsm.png" alt width="50%" srcset="https://lemire.me/blog/wp-content/uploads/2023/04/plotsm.png 640w, https://lemire.me/blog/wp-content/uploads/2023/04/plotsm-300x225.png 300w" sizes="(max-width: 640px) 100vw, 640px" />

It is interesting that the more lanes I have, the more accurate the results: intuitively, this is not entirely surprising as it breaks down the data dependency and one bad step has less impact on the whole processing.

Thus, for a wide range of performance-related timings, you should not assume that you have a normal distribution without checking first! Computing the distance between the maximum and the mean divided by the standard deviation is a useful indicator. I personally find that a log normal distribution is a better model for my timings, at a high level.

__Further reading__: [Log-normal Distributions across the Sciences: Keys and Clues](https://stat.ethz.ch/~stahel/lognormal/bioscience.pdf). David Gilbertson has a related post: [The mean misleads: why the minimum is the true measure of a function’s run time](https://betterprogramming.pub/the-mean-misleads-why-the-minimum-is-the-true-measure-of-a-functions-run-time-47fa079075b0).

