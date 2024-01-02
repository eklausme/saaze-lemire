---
date: "2022-07-20 12:00:00"
title: "How quickly can you convert floats to doubles (and back)?"
---



Many programming languages have two binary floating-point types: float (32-bit) and double (64-bit). It reflects the fact that most general-purpose processors supports both data types natively.

Often we need to convert between the two types. Both ARM and x64 processors can do in one inexpensive instructions. For example, ARM systems may use the `fcvt` instruction.

The details may differ, but most current processors can convert one number (from float to double, or from double to float) per CPU cycle. The latency is small (e.g., 3 or 4 cycles).

A typical processor might run at 3 GHz, thus we have 3 billion cycles per second. Thus we can convert 3 billion numbers per second. A 64-bit number uses 8 bytes, so it is a throughput of 24 gigabytes per second.

It is therefore unlikely that the type conversion can be a performance bottleneck, in general. If you would like to measure the speed on your own system: [I have written a small C++ benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/07/20).

