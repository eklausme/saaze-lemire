---
date: "2018-06-26 12:00:00"
title: "Data processing on modern hardware"
---



If you had to design a new database system optimized for the hardware we have today, how would you do it? And what is the new hardware you should care about? This was the topic of [a seminar I attended last week in Germany at Dagstuhl](https://www.dagstuhl.de/en/program/calendar/semhp/?semnr=18251).

Here are some thoughts:

- You can try to offload some of the computation to the graphics processor (GPU). This works well for some tasks (hint: deep learning) but not so well for generic data processing tasks. There is an argument that says that if you have the GPU anyhow, you might as well use it even if it is inefficient. I do not like this argument, especially given how expensive the good GPUs are. (Update: Elias Stehle pointed out to me that GPU memory is growing exponentially which could allow GPUs to serve as smart memory subsystems.)
- The problem, in general, with heterogeneous data processing systems is that you must, somehow, somewhen, move the data from one place to the other. Moving lots of data is slow and expensive. However, pushing the processing to the data is appealing. So you can do some of the processing within the memory subsystem (processing in memory or PIM) or within the network interface controllers. I really like the idea of applying a filter within the memory subsystem instead of doing it at the CPU level. It is unclear to me at this point whether this can be made into generically useful technology. [The challenges are great](https://arxiv.org/abs/1802.00320).
- There are more and more storage systems, including persistent memory, solid state drives, and so forth. There is expensive fast storage and cheaper and slower storage. How do you decide where to invest your money? [Jim Gray&rsquo;s 5-minute rule](https://en.wikipedia.org/wiki/Five-minute_rule) is still relevant, though it needs to be updated. What is this 5-minute rule? You would think that slow and inexpensive storage is always cheaper&hellip; but being half as fast and half as expensive is no bargain at all! So you always want to be comparing the price per query. Frequent queries justify more expensive but faster storage.
- There is much talk about [FPGAs](https://en.wikipedia.org/wiki/Field-programmable_gate_array): programmable hardware that can be more power efficient than generic processors at some tasks. Because you have more control over the hardware, you can do nifty things like make use of all processing units at once in parallel, feed the output of one process directly into another process, and so forth. Of course, though it is used more efficiently, the silicon you have in an FPGA costs more. If your application is a great fit (e.g., signal processing), then it is probably a good idea to go the FPGA route&hellip; but it is less obvious to me why data processing, in general, would fit in this case. And if you need to outsource only some of your processing to the FPGA, then you need to pay a price for moving data.
- The networking folks like something called [RDMA (remote direct memory access)](https://en.m.wikipedia.org/wiki/Remote_direct_memory_access). As I understand it, it allows one machine to access &ldquo;directly&rdquo; the memory of another machine, without impacting the remote CPU. Thus it should allow you to take several distinct nodes and make them &ldquo;appear&rdquo; like a multi-CPU machine. Building software on top of that requires some tooling and it is not clear to me how good it is right now. [You can use MPI if it suits you](https://en.m.wikipedia.org/wiki/Message_Passing_Interface).
- There is talk of using &ldquo;[blockchains](https://en.wikipedia.org/wiki/Blockchain)&rdquo; for distributed databases. We have been doing a lot of work to save energy and keep computing green. Yet it is useless because we are burning CPU cycles like madmen for bitcoin and other cryptocurrencies. People talk about all the new possible applications, but details are scarce. I do not own any bitcoin.
- We have cheap and usable machine learning; it can run on neat hardware if you need it to. Meanwhile, databases are hard to tune. It seems that we could combine the two to tune automagically database systems. [People are working on this](https://aws.amazon.com/blogs/machine-learning/tuning-your-dbms-automatically-with-machine-learning/). It sounds a bit crazy, but I am actually excited about it and I plan to do some of my own work in this direction.
- Cloud databases are a big deal. The latest &ldquo;breakthrough&rdquo; appears to be [Amazon Aurora](https://aws.amazon.com/rds/aurora/): you have a cheap, super robust, extendable relational database system. I have heard it described as an &ldquo;Oracle killer&rdquo;. The technology sounds magical. Sadly, most of us do not have the scale that Google and Amazon have, so it is less clear how we can contribute. However, we can all use it.
- Google has fancy tensor processors. Can you use them for things that are not related to [deep learning and low-precision matrix multiplications](https://cloud.google.com/tpu/docs/tensorflow-ops)? It seems that you can. Whether it makes sense is another story.
- People want more specialized silicon, deeper pipelines, more memory requests in-flight. It is unclear whether vendors like Intel are willing to provide any of it. There was some talk about going toward Risc-V; I am not sure why.


I am missing many things, and I am surely misreporting much of what was said. Still, I will write some more about some of these ideas over the next few weeks.

Some subjects that people did not cover much at the seminar I was at, as far as I know:

- Data processing on mobile devices or &ldquo;Internet of things&rdquo; was not discussed.
- I felt that there was relatively little said about large chips made of many, many cores. Vectorization was touched upon, but barely.


The female representation at the event was low in number, but not in quality.

__Credit__: The Dagstuhl seminar I attended was organized by Peter A. Boncz, Goetz Graefe, Bingsheng He, and Kai-Uwe Sattler. The list of participants include Anastasia Ailamaki, Gustavo Alonso, Witold Andrzejewski, Carsten Binnig, Philippe Bonnet, Sebastian BreÃŸ, Holger FrÃ¶ning, Alfons Kemper, Thomas Leich, Viktor Leis, myself (Daniel Lemire), Justin Levandoski, Stefan Manegold, Klaus Meyer-Wegener, Onur Mutlu, Thomas Neumann, Anisoara Nica, Ippokratis Pandis, Andrew Pavlo, Thilo Pionteck, Holger Pirk, Danica Porobic, Gunter Saake, Ken Salem, Kai-Uwe Sattler, Caetano Sauer, Bernhard Seeger, Evangelia Sitaridi, Jan Skrzypczak, Olaf Spinczyk, Ryan Stutsman, JÃ¼rgen Teich, Tianzheng Wang, Zeke Wang, and Marcin Zukowski. The beer was quite good.

