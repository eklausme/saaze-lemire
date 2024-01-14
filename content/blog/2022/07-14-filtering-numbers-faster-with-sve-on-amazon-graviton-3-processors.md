---
date: "2022-07-14 12:00:00"
title: "Filtering numbers faster with SVE on Graviton 3 processors"
---



Processors come, roughly, in two large families x64 processors from Intel and AMD, and ARM processors from Apple, Samsung, and many other vendors. For a long time, ARM processors occupied mostly the market of embedded processors (the computer running your fridge at home) with the &lsquo;big processors&rsquo; being almost exclusively the domain of x64 processors.

Reportedly, the Apple CEO (Steve Jobs) went to see Intel back when Apple was designing the iPhone to ask for a processor deal. Intel turned Apple down. So Apple went with ARM.

Today, we use ARM processors for everything: game consoles (Nintendo Switch), powerful servers (Amazon and Google), mobile phones, embedded devices, and so forth.

Amazon makes available its new ARM-based processors (Graviton 3). These processors have sophisticated SIMD instructions (SIMD stands for Single Instruction Multiple Data) called SVE (Scalable Vector Extensions). With these instructions, we can greatly accelerate software. It is a form of single-core parallelism, as opposed to the parallelism that one gets by using multiple cores for one task. The SIMD parallelism, when it is applicable, is often far more efficient than multicore parallelism.

Amazon&rsquo;s Graviton 3 appears to have 32-byte registers, since it is based on the [ARM Neoverse V1 design](https://developer.arm.com/documentation/PJDOC-466751330-9685/0101/). You can fit eight 32-bit integers in one register. Mainstream ARM processors (e.g., the ones that Intel uses) have SIMD instructions too (NEON), but with shorter registers (16 bytes). Having wider registers and instructions capable of operating over these wide registers allows you reduce the total number of instructions. Executing fewer instructions is a very good way to accelerate code.

To investigate SVE, I looked at a simple problem where you want to remove all negative integers from an array. That is, you read and array containing signed random integers and you want to write out to an output array only the positive integers. Normal C code might look as follows:
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


&nbsp;

[Replacing this code with new code that relies on special SVE functions made it go much faster (2.5 times faster)](/lemire/blog/2022/06/23/filtering-numbers-quickly-with-sve-on-amazon-graviton-3-processors/). At the time, I suggested that my code was probably not nearly optimal. It processed 32 bytes per loop iteration, using 9 instructions. A sizeable fraction of these 9 instructions have to do with managing the loop, and few do the actual number crunching.  A reader, Samuel Lee, proposed to effectively unroll my loop. He predicted much better performance (at least when the array is large enough) due to lower loop overhead. I include his proposed code below.

Using a graviton 3 processor and GCC 11 on my benchmark, I get the following results:

&nbsp;                   |cycles/int               |instr./int               |instr./cycle             |
-------------------------|-------------------------|-------------------------|-------------------------|
scalar                   |9.0                      |6.000                    |0.7                      |
branchless scalar        |1.8                      |8.000                    |4.4                      |
SVE                      |0.7                      |1.125                    |~1.6                     |
unrolled SVE             |0.4385                   |0.71962                  |~1.6                     |


The new unrolled SVE code uses about 23 instructions to process 128 bytes (or 32 32-bit integers), hence about 0.71875 instructions per integer. That&rsquo;s about 10 times fewer instructions than scalar code and roughly 4 times faster than scalar code in terms of CPU cycles.

The number of instructions retired per cycle is about the same for the two SVE functions, and it is relatively low, somewhat higher than 1.5 instructions retired per cycle.

Often the argument in favour of SVE is that it does not require special code to finish the tail of the processing. That is, you can process an entire array with SVE instructions, even if its length is not divisible by the register size (here 8 integers). I find Lee&rsquo;s code interesting because it illustrates that you might actually need to handle the end of long array differently, for efficiency reasons.

Overall, I think that we can see that SVE works well for the problem at hand (filtering out 32-bit integers).

__Appendix__: Samuel Lee&rsquo;s code.
```C
void remove_negatives(const int32_t *input, int64_t count, int32_t *output) {
  int64_t j = 0;
  const int32_t* endPtr = input + count;
  const uint64_t vl_u32 = svcntw();

  svbool_t all_mask = svptrue_b32();
  while(input <= endPtr - (4*vl_u32))
  {
      svint32_t in0 = svld1_s32(all_mask, input + 0*vl_u32);
      svint32_t in1 = svld1_s32(all_mask, input + 1*vl_u32);
      svint32_t in2 = svld1_s32(all_mask, input + 2*vl_u32);
      svint32_t in3 = svld1_s32(all_mask, input + 3*vl_u32);

      svbool_t pos0 = svcmpge_n_s32(all_mask, in0, 0);
      svbool_t pos1 = svcmpge_n_s32(all_mask, in1, 0);
      svbool_t pos2 = svcmpge_n_s32(all_mask, in2, 0);
      svbool_t pos3 = svcmpge_n_s32(all_mask, in3, 0);

      in0 = svcompact_s32(pos0, in0);
      in1 = svcompact_s32(pos1, in1);
      in2 = svcompact_s32(pos2, in2);
      in3 = svcompact_s32(pos3, in3);

      svst1_s32(all_mask, output + j, in0);
      j += svcntp_b32(all_mask, pos0);
      svst1_s32(all_mask, output + j, in1);
      j += svcntp_b32(all_mask, pos1);
      svst1_s32(all_mask, output + j, in2);
      j += svcntp_b32(all_mask, pos2);
      svst1_s32(all_mask, output + j, in3);
      j += svcntp_b32(all_mask, pos3);

      input += 4*vl_u32;
  }

  int64_t i = 0;
  count = endPtr - input;

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


