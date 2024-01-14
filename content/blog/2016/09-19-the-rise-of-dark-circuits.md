---
date: "2016-09-19 12:00:00"
title: "The rise of dark circuits"
---



The latest iPhone 7 from Apple has more computing peak power than [most laptops](http://daringfireball.net/linked/2016/09/14/geekbench-android-a10). Apple pulled this off using a technology called [ARM big.LITTLE](https://en.wikipedia.org/wiki/ARM_big.LITTLE) where half of the processor is only used when high performance is needed, otherwise it remains idle.

That&rsquo;s hardly the sole example of a processor with parts that remain idle most of the time. For example, all recent desktop Intel processors come with an &ldquo;Intel processor graphics&rdquo; that can process video, replace a graphics card and so forth. It uses roughly [half the silicon of your core processor](https://software.intel.com/sites/default/files/managed/c5/9a/The-Compute-Architecture-of-Intel-Processor-Graphics-Gen9-v1d0.pdf) but in many PCs where there is either no display or where there is a graphics card, most of this silicon is unused most of the time.

If you stop to think about it, it is somewhat remarkable. Silicon processors have gotten so cheap that we can afford to leave much of the silicon unused.
In contrast, much of the progress in computing has to do with miniaturization. Smaller transistors use less power, are cheaper to mass-produce and can enable processors running at a higher frequency. Yet transistors in the CPU of your computer are already only dozens of atoms in diameters. Intel has thousands of smart engineers, but none of them can make a silicon-based transistor with less than one atom. So we are about to hit a wall&hellip; a physical wall. Some would argue that this wall is already upon us. We can create wider processors, processors with fancier instructions, processors with more cores&hellip; specialized processors&hellip; but we have a really hard time squeezing out more conventional performance out of single cores.

You can expect companies like Intel to provide us with more efficient processors the conventional manner (by miniaturizing silicon transistors) up till 2020, and maybe at the extreme limit up till 2025&hellip; but then it is game over. We may buy a few extra years by going beyond silicon&hellip; but nobody is talking yet about subatomic computing.

I should caution you against excessive pessimism. Currently, for $15, you can buy a Raspberry Pi 3 computer which is probably closer than you imagine to the power of your laptop. In five years, the successor of the Raspberry Pi might still sell for $15 but be just as fast as the iPhone 7&hellip; and be faster than most laptops sold today. This means that a $30 light bulb might have the computational power of a small server in today&rsquo;s terms. So we are not about to run out of computing power&hellip; not yet&hellip;

Still&hellip; where is the next frontier?

We can build 3D processors, to squeeze more transistors into a smaller area&hellip; But this only helps you so much if each transistor still uses the same power. We can&rsquo;t pump more and more power into processors.

You might argue that we can cool chips better or use more powerful batteries&hellip; but none of this helps us if we have to grow the energy usage exponentially. Granted, we might be able to heat our homes with computers, at least those of us living in cold regions&hellip; but who wants an iPhone that burns through your skin?

How does our brain work despite these limitations? Our neurons are large and we have many of them&hellip; much more than we have transistors in any computer. The total computing power of our brain far exceeds the computing power of most powerful silicon processor ever made&hellip; How do we not burst into flame? The secret is that our neurons are not all firing at the same time billions of times per second.
You might have heard that we only use 10% of our brain. Then you have been told that this is a myth. There is even [a Wikipedia page about this &ldquo;myth&rdquo;](https://en.wikipedia.org/wiki/Ten_percent_of_the_brain_myth). But it is not a myth. At any one time, you are probably using less than 1% of your brain:

> The cost of a single spike is high, and this severely limits, possibly to fewer than 1%, the number of neurons that can be substantially active concurrently. The high cost of spikes requires the brain not only to use representational codes that rely on very few active neurons, but also to allocate its energy resources flexibly among cortical regions according to task demand. (Lennie, 2003)


So, the truth is that you are not even using 10% of your brain&hellip; more like 1%&hellip; Your brain is in constant power-saving mode.

This, I should add, can make us optimistic about intelligence enhancement technologies. It seems entirely possible to force the brain into a higher level of activity, with the trade-off that it might use more energy and generate more heat. For our ancestors, energy was scarce and the weather could be torrid. We can afford to control our temperature, and we overeat.

But, even so, there is no way you could get half of your neurons firing simultaneously. Our biology could not sustain it. We would go into shock.

It stands to reason that our computers must follow the same pattern. We can build ever larger chips, with densely packed transistors&hellip; but most of these circuits must remain inactive most of the time&hellip; that&rsquo;s what they call &ldquo;[dark silicon](https://en.wikipedia.org/wiki/Dark_silicon)&ldquo;. &ldquo;Dark silicon&rdquo; assumes that our technology has to be &ldquo;silicon-based&rdquo;, clearly something that may change in the near future, so let us use the term &ldquo;dark circuits&rdquo; instead.

Pause to consider: it means that in the near future, you will buy a computer made of circuits that remain mostly inactive most of the time. In fact, we might imagine a law of the sort&hellip;

> The percentage of dark circuits will double every two years in commodity computers.


That sounds a bit crazy. This means that one day, we might use only 1% of the circuits in your processors at any one time&mdash;not unlike our brain. Though it sounds crazy, we will see our first effect of this &ldquo;law&rdquo; with the rise of [non-volatile memory](https://en.wikipedia.org/wiki/Non-volatile_memory). Your current computer relies on volatile memory made of transistors that must be constantly &ldquo;charged&rdquo; to remain active. As the transistors stop shrinking, this means that the energy usage of RAM per byte will plateau. Hence, the energy usage due to memory will start growing exponentially, assuming that the amount of memory in systems grows exponentially. Exponentially growing energy usage is not good. So we will switch, in part or in full, to non-volatile memory, and that&rsquo;s an example of &ldquo;dark circuits&rdquo;. It is often called &ldquo;dark memory&rdquo;.

You may assume that memory systems in a computer do not use much energy, but by several accounts, they often account for half of the energy usage because moving data is expensive. If we are to have computers with gigantic memory capacities, we cannot keep moving most of the data most of the time.

In this hypothetical future, what might programming look like? You have lots and lots of fast memory. You have lots and lots of efficient circuits capable of various computations. But we must increasingly &ldquo;budget&rdquo; our memory transfers and accesses. Moving data takes energy and creates heat. Moreover, though you might have gigantic computational power, you cannot afford to keep it on for long, because you will either run out of energy or overheat your systems.

Programming might start to sound a lot like biology.

__Credit__: This blog post benefited from an email exchange with Nathan Kurz.

