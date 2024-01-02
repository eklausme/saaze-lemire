---
date: "2021-03-17 12:00:00"
title: "Apple´s M1 processor and the full 128-bit integer product"
---



If I multiply two 64-bit integers (having values in [0, 2<sup>64</sup>)), the product requires 128 bits. Intel and AMD processors (x64) can compute the full (128-bit) product of two 64-bit integers using a single instruction (<tt>mul</tt>). ARM processors, such as those found in your mobile phone, require two instructions to achieve the same result: `mul` computes the least significant 64 bits while `mulh` computes the most significant 64 bits.

I believe that it has often meant that computing the full 128-bit product was more expensive, everything else being equal, on ARM processors than on x64 (Intel) processors. However, the instruction set does not have to determine the performance. For example, ARM processors can recognize that I am calling both instructions (<tt>mul</tt>  and <tt>mulh</tt>) and process them more efficiently. Or they may simply have very inexpensive multipliers.

To explore the problem, let us pick two pseudo-random number generators, splitmix and wyhash:
```C
uint64_t <b>splitmix</b>() {
    uint64_t z = (state += UINT64_C(0x9E3779B97F4A7C15));
    z = (z ^ (z >> 30)) * UINT64_C(0xBF58476D1CE4E5B9);
    z = (z ^ (z >> 27)) * UINT64_C(0x94D049BB133111EB);
    return z ^ (z >> 31);
}
```

```C
uint64_t <b>wyhash</b>() {
    state += 0x60bee2bee120fc15ull;
    __uint128_t tmp = (__uint128_t)(state)*0xa3b195354a39b70dull;
    uint64_t m1 = (tmp >> 64) ^ tmp;
    tmp = (__uint128_t)m1 * 0x1b03738712fad5c9ull;
    return (tmp >> 64) ^ tmp;
 }
```



[As I reported earlier](/lemire/blog/2019/03/20/arm-and-intel-have-different-performance-characteristics-a-case-study-in-random-number-generation/), wyhash should almost always be faster on an Intel or AMD processor as it is only two multiplications with an addition whereas the splitmix function is made of two multiplications with several other operations. However, wyhash requires two full multiplications whereas splitmix requires only two 64-bit products. If the two full multiplications in wyhash are equivalent two four multiplications, then wyhash becomes more expensive.


[I wrote a small C++ benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/03/17) to measure the time (in nanoseconds) that it takes to compute a random value using Apple&rsquo;s new M1 processor (ARM, 3.2 GHz). The compiler is Apple clang version 12 which comes by default on the new Apple Silicon laptops.

&nbsp;                   |Apple M1                 |
-------------------------|-------------------------|
wyhash                   |0.60 ns/value            |
splitmix                 |0.85 ns/value            |


My test suggests that it takes a bit under 3 cycles to generate a number with splitmix and a bit under 2 cycles to generate a number with wyhash. The wyhash generator is much faster than splitmix on the Apple M1 processor (by about 40% to 50%) which suggests that Apple Silicon is efficient at computing the full 128-bit product of two 64-bit integers. It would be nicer to be able to report the number of instructions and cycles, but I do not know how to instrument code under macOS for such measures.

__Further reading__: [Apple M1 Microarchitecture Research by Dougall Johnson](https://dougallj.github.io/applecpu/firestorm.html)

__Credit__: Maynard Handley suggested this blog post.

__Update__: The numbers were updated since they were off by a factor of two due to a typographical error in the code.

__Update 2__: An interested reader provided me with the means to instrument the code. The precise number of cycles per value is a bit over 2.8 for splitmix and exactly 2 for wyhash. [Please see my repository for the corresponding code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/03/17/withcounters).

__Appendix__. Some readers are demanding assembly outputs. The splitmix function compiles to 9 assembly instructions
```C
LBB7_2:                                 ; =>This Inner Loop Header: Depth=1
	eor	x12, x9, x9, lsr #30
	mul	x12, x12, x10
	eor	x12, x12, x12, lsr #27
	mul	x12, x12, x11
	eor	x12, x12, x12, lsr #31
	str	x12, [x0], #8
	add	x9, x9, x8
	subs	x1, x1, #1              ; =1
	b.ne	LBB7_2
```


while the wyhash function compiles to 10 assembly instructions
```C
LBB8_2:                                 ; =>This Inner Loop Header: Depth=1
	mul	x12, x9, x10
	umulh	x13, x9, x10
	eor	x12, x13, x12
	mul	x13, x12, x11
	umulh	x12, x12, x11
	eor	x12, x12, x13
	str	x12, [x0], #8
	add	x9, x9, x8
	subs	x1, x1, #1              ; =1
	b.ne	LBB8_2
```


