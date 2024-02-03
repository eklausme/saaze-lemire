---
date: "2019-12-11 12:00:00"
title: "Amazon´s new ARM servers: Graviton 2"
---



Most servers on the Internet run on x64 processors, mostly made by Intel. Meanwhile, most smartphones run ARM processors.

From a business perspective, these are different technologies. The x64 processors are mostly designed by only two companies (Intel and AMD), with one very large dominant player (Intel). In contrast, ARM processors come in many different flavours. Apple, Qualcomm, Samsung and others design their own ARM processors. This diversity can be either a blessing or a curse. The blessing is that you get a lot of direct competition and many custom solutions. The curse is that it is harder to support ARM systems because there are so many variations.

Amazon is the largest public cloud providers and they are large enough to design their own servers and even their own silicon. Some time ago, they launched a service (Graviton) based on their own ARM-based servers. I tested them out, but the performance just was not there. [Amazon just announced a second iteration of these servers called Graviton 2](https://aws.amazon.com/about-aws/whats-new/2019/12/announcing-new-amazon-ec2-m6g-c6g-and-r6g-instances-powered-by-next-generation-arm-based-aws-graviton2-processors/) and they claim a 7-fold performance increase over their previous ARM servers. [They are based on processor designs made for servers called Neoverse](https://en.wikipedia.org/wiki/Arm_Holdings#Arm_Neoverse_infrastructure). I do not yet have access to these servers, but Matthew Wilson from Amazon was kind enough to run my standard JSON parsing benchmark (using [simdjson](https://github.com/lemire/simdjson/) and the twitter.json data file).

Compiling the results in a table suggests that these new Amazon servers have processors that are nearly as good as those in a flagship smartphone.

iPhone XR                |A12                      |2.5 GHz                  |1.3 GB/s                 |
-------------------------|-------------------------|-------------------------|-------------------------|
Graviton 2               |[Neoverse N1](https://fuse.wikichip.org/news/2075/arm-launches-new-neoverse-n1-and-e1-server-cores/2/) |2.5 GHz                  |1.1 GB/s                 |
Ampere (first generation)  |Skylark                  |3.2 GHz                  |0.37 GB/s                |
Rockpro64                |Cortex-A72               |1.8 GHz                  |0.32 GB/s                |


My fast JSON parsing benchmark is just something I happen to care about. It is probably not representative of whatever you care about. In particular, it is CPU intensive whereas servers have many other bottlenecks.

Nevertheless, I find these results quite encouraging. If I normalize the speed by the frequency, I get that the new Neoverse N1 processor is 2.5 times faster than the Cortex-A72. When they come out, they may be the fastest publicly accessible ARM servers.

Amazon is claiming that these Graviton 2 servers offer much better performance than Intel-based servers ([EC2 M5](https://aws.amazon.com/ec2/instance-types/m5/)) and that they will be slightly cheaper. My expectation is that the better performance will be due in large part of a higher number of cores.

__Update__: Matthew Wilson reports 1.3 GB/s following some optimization work.

