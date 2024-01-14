---
date: "2019-05-03 12:00:00"
title: "Really fast bitset decoding for &#8220;average&#8221; densities"
---



Suppose I give you a word and you need to determine the location of the 1-bits. For example, given the word 0b100011001, you would like to get 0,3,4,8.

You could check the value of each bit, but that would take too long. A better approach is use the fact that modern processors have fast instructions to count the number of &ldquo;trailing zeros&rdquo; (on x64 processors, you have <tt>tzcnt</tt>). Given 0b100011001, this instruction would give you 0. Then you if you set this first bit to zero (getting 0b100011000), the trailing-zero instruction gives you 3, and so forth. Conveniently enough, many processors can set the least significant 1-bit to zero using a single instruction (<tt>blsr</tt>); you can implement the desired operation in most programming languages like C as a bitwise AND: <tt>word &amp; (word - 1)</tt>.

Thus, the following loop should suffice and it is quite efficient&hellip;
```C
  while (word != 0) {
    result[i] = trailingzeroes(word);
    word = word & (word - 1);
    i++;
  }
```


How efficient is it exactly?
To answer this question, we first need to better define the problem. If the words you are receiving have few 1-bits (say less than one 1-bit per 64-bit words), then you have the sparse regime, and it becomes important to detect quickly zero inputs, for example. If half of your bits are set, you have the dense regime and it is best handled using using vectorization and lookup tables.

But what do you do when your input data is neither really sparse (that is, you almost never have zero inputs) nor really dense (that is, most of your bits are set to zero)? In such cases, the fact that the instructions in your loop are efficient does not help you as much as you&rsquo;d like because you have another problem: almost every word will result in at least one mispredicted branch. That is, your processor has a hard time predicting when the loop will stop. This prevent your processor from doing a good job retiring instructions.

You can try to have fewer branches at the expense of more instructions:
```C
  while (word != 0) {
    result[i] = trailingzeroes(word);
    word = word & (word - 1);
    result[i+1] = trailingzeroes(word);
    word = word & (word - 1);
    result[i+2] = trailingzeroes(word);
    word = word & (word - 1);
    result[i+3] = trailingzeroes(word);
    word = word & (word - 1);
    i+=4;
  }
```


The downside of this approach is that you need an extra step to count how many 1-bit there are in your words. Thankfully, it is a cheap operation that can be resolved with a single instruction on x64 processors.

This &lsquo;unrolled&rsquo; approach can void more than half of the mispredicted branches, at the expense of a few fast instructions. It results in a substantial reduction in the number of CPU cycles elapsed (GNU GCC 8, Skylake processor):

&nbsp;                   |cycles / 1-bit           |instructions / 1-bit     |branch misses / word     |
-------------------------|-------------------------|-------------------------|-------------------------|
conventional             |4.7                      |8.2                      |0.68                     |
fast                     |3.4                      |8.2                      |0.41                     |


So we save about 1.3 cycles per 1-bit with the fast approach. Can the mispredicted branches explain this gain? There about 6 bits set per input word, so the number of mispredicted branches per 1-bit is either 0.15 or 0.065. If you multiply these fractions by 15 cycles (on the assumption that each mispredicted branch costs 15 cycles), you get 2.25 cycles and 1 cycles; or a difference of 1.25 cycles. It does seem credible that the mispredicted branches are an important factor.

[I offer my source code, it runs under Linux](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/05/03).

We use this decoding approach in [simdjson](https://github.com/lemire/simdjson).

How close are we to the optimal scenario? We are using one instruction per 1-bit to count the number of trailing zeros, one instruction to zero the least significant 1-bit, one instruction to advance a pointer where we write, one store instruction. Let us say about 5 instructions. We are getting 9.8 instructions. So we probably cannot reduce the instruction count by most than a factor of two without using a different algorithmic approach.

Still, I expect that further gains are possible, maybe you can go faster by a factor of two or so.
__Futher reading__: [Parsing Gigabytes of JSON per Second](https://arxiv.org/abs/1902.08318) and [Bits to indexes in BMI2 and AVX-512](https://branchfree.org/2018/05/22/bits-to-indexes-in-bmi2-and-avx-512/).

__Credit__: Joint work with Geoff Langdale. [He has a blog](https://branchfree.org).

