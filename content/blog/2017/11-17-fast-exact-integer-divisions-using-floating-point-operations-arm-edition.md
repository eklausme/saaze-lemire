---
date: "2017-11-17 12:00:00"
title: "Fast exact integer divisions using floating-point operations (ARM edition)"
---



In my [latest post](/lemire/blog/2017/11/16/fast-exact-integer-divisions-using-floating-point-operations/), I explained how you could accelerate 32-bit integer divisions by transforming them into 64-bit floating-point divisions. Indeed, 64-bit floating-point numbers can represent accurately all 32-bit integers on most processors.

It is a strange result: Intel processors seem to do a lot better with floating-point divisions than integer divisions.

Recall the numbers that I got for the throughput of division operations:

64-bit integer division  |25 cycles                |
-------------------------|-------------------------|
32-bit integer division (compile-time constant) |2+ cycles                |
32-bit integer division  |8 cycles                 |
32-bit integer division via 64-bit float |4 cycles                 |


I decided to run the same test on a 64-bit ARM processor (AMD A1100):

64-bit integer division  |7 ns                     |
-------------------------|-------------------------|
32-bit integer division (compile-time constant) |2 ns                     |
32-bit integer division  |6 ns                     |
32-bit integer division via 64-bit float |18 ns                    |


These numbers are rough, my benchmark is naive ([see code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/11/16)). Still, on this particular ARM processor, 64-bit floating-point divisions are not faster (in throughput) than 32-bit integer divisions. So ARM processors differ from Intel x64 processors quite a bit in this respect.

