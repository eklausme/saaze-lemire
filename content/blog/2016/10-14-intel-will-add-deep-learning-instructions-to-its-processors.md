---
date: "2016-10-14 12:00:00"
title: "Intel will add deep-learning instructions to its processors"
---



Some of the latest Intel processors support the AVX-512 family of vector instructions. These instructions operate on blocks of 512 bits (or 64 bytes). The benefit of such wide instructions is that even without increasing the processor clock speed, systems can still process a lot more data. Most code today operators over 64-bit words (8 bytes). In theory, keeping everything else constant, you could go 8 times faster by using AVX-512 instructions instead.

Of course, not all code can make use of vector instructions&hellip; but that&rsquo;s not relevant. What matters is whether your &ldquo;hot code&rdquo; (where the processor spends much of its time) can benefit from them. In many systems, the hot code is made of tight loops that need to run billions of times. Just the kind of code that can benefit from vectorization!

The hottest trend in software right now is &ldquo;deep learning&rdquo;. It can be used to classify pictures, recognize speech or play the game of Go. Some say that the quickest &ldquo;get rich quick&rdquo; scheme right now is to launch a deep-learning venture, and get bought by one of the big players (Facebook, Google, Apple, Microsoft, Amazon). It is made easier by the fact that companies like Google have open sourced their code such as [Tensorflow](https://github.com/tensorflow/).

Sadly for Intel, it has been mostly left out of the game. Nvidia graphics processors are the standard off-the-shelf approach to running deep-learning code. That&rsquo;s not to say that Intel lacks good technology. But for the kind of brute-force algebra that&rsquo;s required by deep learning, Nvidia graphics processors are simply a better fit.

However, Intel is apparently preparing a counter-attack, of sort. In September of this year, they have discreetly revealed that their future processors will support [dedicated deep-learning instructions](https://software.intel.com/sites/default/files/managed/69/78/319433-025.pdf). Intel&rsquo;s AVX-512 family of instructions is decomposed in sub-families. There will be two new sub-families for deep-learning: AVX512_4VNNIW and AVX512_4FMAPS.

