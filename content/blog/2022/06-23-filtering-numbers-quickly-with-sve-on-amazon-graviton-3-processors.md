---
date: "2022-06-23 12:00:00"
title: "Filtering numbers quickly with SVE on Amazon Graviton 3 processors"
---



I have had access to Amazon&rsquo;s latest ARM processors (graviton 3) for a few weeks. To my knowledge, these are the first widely available processors supporting Scalable Vector Extension (<em>SVE</em>).

SVE is part of the Single Instruction/Multiple Data paradigm: a single instruction can operate on many values at once. Thus, for example, you may add N integers with N other integers using a single instruction.

What is unique about SVE is that you work with vectors of values, but without knowing specifically how long the vectors are. This is in contrast with conventional SIMD instructions (ARM NEON, x64 SSE, AVX) where the size of the vector is hardcoded. Not only do you write your code without knowing the size of the vector, but even the compiler may not know. This means that the same binary executable could work over different blocks (vectors) of data, depending on the processor. The benefit of this approach is that your code might get magically much more efficient on new processors.

It is a daring proposal. It is possible to write code that would work on one processor but fail on another processor, even though we have the same instruction set.

But is SVE on graviton 3 processors fast? To test it out, I wrote a [small benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/06/23). Suppose you want to prune out all of the negative integers out of an array. A textbook implementation might look as follows:
```C
void remove_negatives_scalar(const int32_t *input,
        int64_t count, int32_t *output) {
  int64_t i = 0;
  int64_t j = 0;
  for(; i < count; i++) {
    if(input[i] >= 0) {
      output[j++] = input[i];
    }
  }
}
```


However, the compiler will probably generate a branch and if your input has a random distribution, this could be inefficient code. To help matters, you may rewrite your code in a manner that is more likely to generate a branchless binary:
```C
  for(; i < count; i++) {
    output[j] = input[i];
    j += (input[i] >= 0);
  }
```


Though it looks less efficient (because every input value in written out), such a branchless version is often practically faster.

I ported this last implementation to SVE using ARM intrinsic functions. At each step, we load a vector of integers (<tt>svld1_s32</tt>), we compare them with zero (<tt>svcmpge_n_s32</tt>), we remove the negative values (<tt>svcompact_s32</tt>) and we store the result (<tt>svst1_s32</tt>). During most iterations, we have a full vector of integers&hellip; Yet, during the last iteration, some values will be missing but we simply ignore them with the `while_mask` variable which indicates which integer values are &lsquo;active&rsquo;.  The entire code sequence is done entirely using SVE instructions: there is no need to process separately the end of the sequence, as would be needed with conventional SIMD instruction sets.
```C
#include <arm_sve.h>
void remove_negatives(const int32_t *input, int64_t count, int32_t *output) {
  int64_t i = 0;
  int64_t j = 0;
  svbool_t while_mask = svwhilelt_b32(i, count);
  do {
    svint32_t in = svld1_s32(while_mask, input + i);
    svbool_t positive = svcmpge_n_s32(while_mask, in, 0);
    svint32_t in_positive = svcompact_s32(positive, in);
    svst1_s32(while_mask, output + j, in_positive);
    i += svcntw();
    j += svcntp_b32(while_mask, positive);
    while_mask = svwhilelt_b32(i, count);
  } while (svptest_any(svptrue_b32(), while_mask));
}
```


Using a graviton 3 processor and GCC 11 on my benchmark, I get the following results:

&nbsp;                   |cycles/integer           |instructions/integer     |instructions/cycle       |
-------------------------|-------------------------|-------------------------|-------------------------|
scalar                   |9.0                      |6.000                    |0.7                      |
branchless scalar        |1.8                      |8.000                    |4.4                      |
SVE                      |0.7                      |1.125                    |1.6                      |


The SVE code uses far fewer instructions. In this particular test, SVE is 2.5 times faster than the best competitor (branchless scalar). Furthermore, it might use even fewer instructions on future processors, as the underlying registers get wider.

Of course, my code is surely suboptimal, but I am pleased that the first SVE benchmark I wrote turns out so well. It suggests that SVE might do well in practice.

__Credit__: Thanks to Robert Clausecker for the related discussion.

