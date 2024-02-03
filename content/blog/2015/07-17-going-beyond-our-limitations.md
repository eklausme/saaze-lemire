---
date: "2015-07-17 12:00:00"
title: "Going beyond our limitations"
---



The nerds online are (slightly) panicking: it looks like [Moore&rsquo;s law](https://en.wikipedia.org/wiki/Moore%27s_law) is coming to an end. Moore&rsquo;s law is the observation that microprocessors roughly double in power every two years. The actual statement of the law, decades ago, had to do with the number of transistors&hellip; and there are endless debates about what the law should be exactly&hellip; but let us set semantics aside to examine the core issue.

When computers were first invented, one might have thought that to make a computer more powerful, one would make it bigger. If you open up your latest laptop, you might notice that the CPU is actually quite small. The latest Intel CPUs (Broadwell) have a die size of 82 mm<sup>2</sup>. Basically, it is 1 cm by 1 cm for well over 1 billion transistors. Each transistor is only a few nanometers wide. It is an astonishingly small unit of measure. Our white cells are micrometers wide&hellip; this means that you could cram maybe a million transistors in any one cell.

Why are chips getting smaller? If you think about the fact that the speed of the light is a fundamental limit, and you want information to go from any one part of the chip to any other part of the chip in one clock cycle, then the smaller the chip, the shorter the clock cycle can be. Hence, denser chips can run at a faster clock rate. They can also use less power.

We can build chips on [a 7-nanometer scale in laboratories](http://www.nytimes.com/2015/07/09/technology/ibm-announces-computer-chips-more-powerful-than-any-in-existence.html?_r=4). That is pretty good. The Pentium 4 in 2000 was built on a 180-nanometer scale. That is 25 times better. But the Pentium 4 was in production back in 2000 whereas the 7-nanometer chips are in laboratories. And 25 times better represents only 4 or 5 doublings&hellip; in 15 years. That is quite a bit short of the 7 doublings Moore&rsquo;s law would predict.

So scaling down transistors is becoming difficult using our current technology.

This is to be expected. In fact, the size of transistors cannot go down forever. The atoms we are using are 0.2 nanometers wide. So a 7-nanometer transistors is only about 35 atoms wide. Intuition should tell you that we probably will never make transistors 1-nanometer wide. I do not know where the exact limit lies, but we are getting close.

Yet we need to go smaller. We should not dismiss the importance of this challenge. We want future engineers to build robots no larger than a white cell that can go into our bodies and repair damages. We want paper-thin watches that have the power of our current desktops.

On the short term, however, unless you are a processor nerd, there is no reason to panic. For one thing, the processors near you keep on getting more and more transistors. Remember that the Pentium 4 had about 50 million transistors. Your GPU from 2000 had probably a similar transistor count. My current tablet has 3 billion transistors, that is 30 times better. Nerds will point out that my tablet is nowhere near 30 times as powerful as a Pentium 4 PC, but, again, no reason to panic.

As a reference point, you have about 20 billion neurons in your neocortex. Apple should have no problem matching this number in terms of transistors in a few years. No particular breakthrough is needed, no expensive R&#038;D. (Of course, having 20 billion transistors won&rsquo;t make your phone as smart as you, but that is another story.)

&nbsp;Processor&nbsp;    |&nbsp;Year&nbsp;         |&nbsp;Billions of transistors&nbsp; |
-------------------------|-------------------------|-------------------------|
Apple A6                 |2012                     |0.5                      |
Apple A7                 |2013                     |1                        |
Apple A8                 |2014                     |2                        |
Apple A8X                |2014                     |3                        |


Another reason not to panic is that chips can get quite a bit wider. By that I mean that chips can have many more cores, running more or less independently, and each core can run wider instructions (affecting more bits). The only problem we face in this direction is that heat and power usage go up too&hellip; but chip makers are pretty good at scaling down inactive circuits and preserving power.

We are also moving from two dimensions to three. Most chips a few years ago were flat. By thickening our chips, we multiply the power per unit area without having to lower the clock speed. One still needs to dissipate heat somehow, but there is plenty of room for innovation without having to defeat the laws of physics.

And finally, we live in an increasingly networked world where computations can happen anywhere. Your mobile phone does not need to become ever more powerful as long as it can offload the computations to the cloud. Remember my dream of having white-cell size robots inside my body? These robots do not need to be fully autonomous, they can rely on each other and on computers located outside your body.

Still, how do we go smaller and faster?

I still think that the equivalent of Moore&rsquo;s law will continue for many decades&hellip; however, we will have to proceed quite differently. If you think back about the introduction of trains at the start of the industrial revolution, we quickly saw faster and faster trains&hellip; until we hit limits. But transportation kept on getting better and more sophisticated. Today, I can have pretty much anything delivered to my door, cheaply, within a day. I can order something from China and get it the same week. Soon, we will have robots doing the delivery. Of course, driving in traffic is hardly any faster than it was decades ago, but we have better tools to avoid it.

So, since we cannot scale down our CPU circuits much further, we will have to come up with molecular computers. In this manner, we could get the equivalent of a 1-nanometer transistor. In fact, we already do some molecular computing: George Church&rsquo;s team at Harvard showed how to cram [700 TB in one gram](http://www.extremetech.com/extreme/134672-harvard-cracks-dna-storage-crams-700-terabytes-of-data-into-a-single-gram). To put it in context: if we reduce the size of Intel&rsquo;s latest processors by a factor of 20, we would have something the size of an amoeba. That is only about 4 doublings of the density! That does not sound insurmountable if we replace transistors by something else (maybe nucleotides). And at that point, you can literally put chips into a nanobot small enough to fit in your arteries.

&nbsp;object&nbsp;       |&nbsp;Physical width (approximate)&nbsp; |
-------------------------|-------------------------|
hydrogen atom            |0.0001 micrometers       |
silicon atom             |0.0002 micrometers       |
nucleotides (DNA)        |0.0006 micrometers       |
transistor (2020s)       |0.005 micrometers        |
transistor (2015)        |0.02 micrometers         |
transistor (2000)        |0.2 micrometers          |
red blood cell           |8 micrometers            |
white blood cell         |12 micrometers           |
neuron                   |100 micrometers          |
amoeba                   |500 micrometers          |
arteries                 |1 000 micrometers        |
CPU chip (2015)          |10 000 micrometers       |


