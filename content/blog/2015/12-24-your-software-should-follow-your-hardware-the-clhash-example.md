---
date: "2015-12-24 12:00:00"
title: "Your software should follow your hardware: the CLHash example"
---



The new Intel Skylake processors released this year (2015) have been met with disappointment. It is widely reported that they improved over the two years old Haswell (2013) processors by a mere 5%. Intel claims that it is more like 10%.

Intel is able to cram many more transistors per unit area in Skylake. The Skylake die size is about 50% smaller. It also uses less power per instruction and can maybe execute more instructions per cycle.

Still. A 5% to 10% gain in two years is hardly exciting, is it?

A few weeks ago, I [reported on a new family of hash functions (CLHash)](/lemire/blog/2015/10/26/crazily-fast-hashing-with-carry-less-multiplications/) designed to benefit from the new instructions available in recent processors to compute the &ldquo;carryless multiplication&rdquo; (or &ldquo;polynomial multiplications&rdquo;). This multiplication used to be many times slower than the regular integer multiplications, and required sophisticated software libraries. It was something that only cryptographers cared about. Today, it is a single cheap CPU instruction that anyone who cares about high performance should become familiar with.

I had not had a chance to test it out with Skylake processors earlier, but today I did. A Haswell processor is able to execute one carryless multiplication every two cycles, the Skylake throughput is double: one instruction per cycle.

What does it mean? It means that hash functions based on carryless multiplications can &ldquo;smoke&rdquo; conventional hash functions. For example, the following tables gives us the CPU cycles per input byte when hashing 4kB inputs:

&nbsp;                   |Haswell                  |Skylake                  |Progress (Skylake vs. Haswell) |
-------------------------|-------------------------|-------------------------|-------------------------|
__CLHash__               |__0.16__                 |__0.096__                |__1.7Ã— faster__      |
CityHash                 |0.23                     |0.23                     |no faster                |
SipHash                  |2.1                      |2.0                      |5% faster                |


So if you stick with your old generic code, there might not be anything exciting for you in the new hardware. Minute gains every few years. To really benefit from new hardware, we need to change our software.

Your software should follow your hardware.

__Reference__: The [clhash C library](https://github.com/lemire/clhash).

