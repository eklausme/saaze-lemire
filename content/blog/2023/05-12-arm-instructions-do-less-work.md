---
date: "2023-05-12 12:00:00"
title: "ARM instructions do &#8220;less work&#8221;?"
---



Modern processors can execute several instructions per cycle. Because processors cannot easily run faster (in terms of clock speed), vendors try to get their processors to do more work per cycle.

Apple processors are wide in the sense that they can retire many more instructions per cycle than comparable Intel or AMD processors. However, some people argue that it is unfair because ARM instructions are less powerful and do less work than x64 (Intel/AMD) instructions so that we have performance parity.

Let us verify.

I have a [number parsing benchmark](https://github.com/lemire/simple_fastfloat_benchmark) that records the number of cycles, instructions and nanosecond spent parsing numbers on average. The number of instructions and cycles is measured using performance counters, as reported by Linux. I parse a standard dataset of numbers (canada.txt), I keep the fast_float numbers (ASCII mode).

system                   |instructions per float   |cycles per float         |instructions per cycle   |
-------------------------|-------------------------|-------------------------|-------------------------|
Intel Ice Lake, GCC 11   |302                      |64                       |4.7                      |
Apple M1, LLVM 14        |299                      |45                       |6.6                      |


Of course, that&rsquo;s a single task, but number parsing is fairly generic as a computing task.

Looking the assembly output often does not reveal a massive benefit for x64. Consider the following simple routine:
```C
// parses an integer of length 'l'
// into an int starting with value
// x.
for(int i = 0; i < l; i++) {
  x = 10 * x + (c[i]-'0');
}
return x;

```


LLVM 16 compiles this to the following optimized ARM assembly:
```C
start:
 ldrb w10, [x1], #1
 subs x8, x8, #1
 madd w10, w0, w9, w10
 sub w0, w10, #48
 b.ne start

```


Or the following x64 assembly&hellip;
```C
start:
  lea eax, [rax + 4*rax]
  movsx edi, byte ptr [rsi + rdx]
  lea eax, [rdi + 2*rax]
  add eax, -48
  inc rdx
  cmp rcx, rdx
  jne start
```


Though your mileage will vary, I find that for the tasks that I benchmark, I often see as many ARM instructions being retired than x64 instructions. There are differences, but they are small.

For example, in [a URL parsing benchmark](https://github.com/ada-url/ada/pull/402), I find that ARM requires 2444 instructions to parse a URL on average, against 2162 instructions for x64: a <em>13% benefit</em> for x64. That&rsquo;s not zero but it is not a massive benefit that overrides other concerns.

However, Apple processors definitively retire more instructions per cycle than Intel processors.

