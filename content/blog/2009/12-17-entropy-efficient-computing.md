---
date: "2009-12-17 12:00:00"
title: "Entropy-efficient Computing"
---



Microprocessors and storage devices are subject to the [second law of thermodynamics](https://en.wikipedia.org/wiki/Second_law_of_thermodynamics): using them turn usable energy (oil, hydrogen) into unusable energy (heat). Data centers are already limited by their power usage and heat production. Moreover, many new devices need to operate for a long time with little power: (1)&nbsp;smart phones (2)&nbsp;powerful computing devices inserted into our bodies (3)&nbsp;robots shipped in space.

Our approach to entropic efficiency remains crude. We improve power supply. We shut down disks and CPUs when they are idle. Deeper questions arise however:

- Except maybe for [embarrassingly parallel](https://en.wikipedia.org/wiki/Embarrassingly_parallel) problems (such as serving web pages), [parallel computing](https://en.wikipedia.org/wiki/Parallel_computing) trades entropic efficiency for short running times. If entropic efficiency is your goal, will you stay away from non-trivial parallelism?
- We analyze algorithms by considering their running time. For example, shuffling an array takes time O(<em>n</em>) whereas sorting it takes time O(<em>n</em> log <em>n</em>). Yet, unlike sorting, I expect that shuffling an array should be possible without any entropy cost (heat generation)!


Suppose I give you a problem, and I ask you to __solve it using as little entropy as possible__. How would you go about it?

__Further reading__:

- M. P. Frank, [Physical Limits of Computing](http://www.cise.ufl.edu/research/revcomp/physlim/plpaper.html), Computing in Science and Engineering, vol. 4 (3), May/June 2002, p. 16-25.- R. Landauer, [Irreversibility and Heat Generation in the Computing Process](http://domino.research.ibm.com/tchjr/journalindex.nsf/c469af92ea9eceac85256bd50048567c/8a9d4b4e96887b8385256bfa0067fba2?OpenDocument), IBM. Journal of Research and Development, vol. 5, no 3, 1961.- __(Updated)__ C. H. Bennett, [Logical reversibility of computation](http://www.dna.caltech.edu/courses/cs191/paperscs191/bennett1973.pdf), IBM journal of Research and Development, 1973.

