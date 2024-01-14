---
date: "2008-07-31 12:00:00"
title: "Given up on Eclipse, now with NetBeans"
---



I write most of my code using [vim](https://en.wikipedia.org/wiki/Vim_(text_editor)). This winter, Kamel made me discover [Eclipse](http://www.eclipse.org/ ).
I dislike IDEs in general because they have a tendency to force me to work in certain ways that are suboptimal. For example, if I need to remember to go to menu X and set option Y to build my project correctly, then that is simply not portable. Everytime I will go to a new machine, I will need to remember these precise steps. Moreover, if I cannot build my code without a GUI, then I cannot test my code on a remote machine under low bandwidth conditions. Finally, IDEs tend to do several operations _silently_ and when things go wrong, you have layers and layers of abstraction before you can correct the problem.
However, Eclipse allowed me to import my project using subversion and use my very own Makefile! What a great idea. And it worked too!

Up until two days ago. For some reason, Eclipse stopped building my code. Hitting the &ldquo;build&rdquo; button simply does nothing. I never changed anything in the settings, but playing with the options did not help. I have no way of knowing what went wrong and after hours spent on the Web chasing the problem, I gave up.

I just downloaded [NetBeans](https://netbeans.org/), and surprise, surpise! There is a C/C++ NetBeans that will use your makefiles too! Wow!

Not everything is rosy however:

- Under MacOS NetBeans is much uglier than Eclipse. I guess NetBeans must be using Swing or some other horrible Java GUI system. It really feel like a cheap application.
- NetBeans was unable to detect my subversion binary. It allowed me to tell it where to find subversion but I had to reboot the application for this setting to work! What?!? Eclipse worked right out of the box with subversion.


My main concern is just how ugly and unprofessional NetBeans look. In comparison, vim is great looking! Sun software people need to learn a thing or two about design.

