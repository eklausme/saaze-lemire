---
date: "2023-07-07 12:00:00"
title: "Packing a string of digits into an integer quickly"
---



Suppose that I give you a short string of digits, containing possibly spaces or other characters (e.g., <tt>"20141103 012910"</tt>). We would like to pack the digits into an integer (e.g., <tt>0x20141103012910</tt>) so that the lexicographical order over the string matches the ordering of the integers.

We can use the fact that in ASCII, the digits have byte values 0x30, 0x31 and so forth. Thus as a sequence of bytes, the string <tt>"20141103 012910"</tt> is actually 0x32, 0x30, 0x31&hellip; so we must select the least significant 4 bits of each byte, discarding the rest. Intel and AMD processors have a convenient instruction which allows us to select any bits from a word to construct a new word (<tt>pext</tt>).

A problem remains: Intel and AMD processors are little endian, which means that if I load the string in memory, the first byte becomes the least significant, not the most significant. Thankfully, Intel and AMD can handle this byte order during the load process.

In C, the desired function using Intel intrinsics might look like this:
```C
#include <x86intrin.h> // Windows: <intrin.h>
#include <string.h>

// From "20141103 012910", we want to get
// 0x20141103012910
uint64_t extract_nibbles(const char* c) {
  uint64_t part1, part2;
  memcpy(&part1, c, sizeof(uint64_t));
  memcpy(&part2 , c + 7, sizeof(uint64_t));
  part1 = _bswap64(part1);
  part2 = _bswap64(part2);
  part1 = _pext_u64(part1, 0x0f0f0f0f0f0f0f0f);
  part2 = _pext_u64(part2, 0x0f000f0f0f0f0f0f);
  return (part1<<24) | (part2);
}
```


It compiles to relatively few instructions: only 4 non-load instructions. The memcpy calls in my code translate into 64-bit load instructions. The register loading instructions (<tt>movabs</tt>) are nearly free in practice.
```C
movbe rax, QWORD PTR [rdi]
movbe rdx, QWORD PTR [rdi+7]
movabs rcx, 1085102592571150095
pext rax, rax, rcx
movabs rcx, 1080880467920490255
sal rax, 24
pext rdx, rdx, rcx
or rax, rdx

```


Prior to the AMD Zen 3 processors, `pext` had terrible performance on AMD processors. Recent AMD processors have performance on par with Intel, meaning that `pext` has a latency of about 3 cycles, and can run once per cycle. So it is about as expensive as a multiplication. Not counting the loads, the above function could nearly be complete in about 5 cycles, which is quite fast.

For ARM processors, you can do it with ARM NEON like so: mask the high nibbles, shuffle the bytes, then shift/or, then narrow (16-&gt;8), extract to general register.
```C
#include <arm_neon.h>
// From "20141103 012910", we want to get
// 0x20141103012910
uint64_t extract_nibbles(const char *c) {
  const uint8_t *ascii = (const uint8_t *)(c);
  uint8x16_t in = vld1q_u8(ascii);
  // masking the high nibbles,
  in = vandq_u8(in, vmovq_n_u8(0x0f));
  // shuffle the bytes
  const uint8x16_t shuf = {14, 13, 12, 11, 10, 9, 7, 6,
    5, 4, 3, 2, 1, 0, 255, 255};
  in = vqtbl1q_u8(in, shuf);
  // then shift/or
  uint16x8_t ins =
    vsraq_n_u16(vreinterpretq_u16_u8(in),
    vreinterpretq_u16_u8(in), 4);
  // then narrow (16->8),
  int8x8_t packed = vmovn_u16(ins);
  // extract to general register.
  return vget_lane_u64(vreinterpret_u64_u16(packed), 0);
}

```


It might compile to something like this:
```C
adrp x8, .LCPI0_0
ldr q1, [x0]
movi v0.16b, #15
ldr q2, [x8, :lo12:.LCPI0_0]
and v0.16b, v1.16b, v0.16b
tbl v0.16b, { v0.16b }, v2.16b
usra v0.8h, v0.8h, #4
xtn v0.8b, v0.8h
fmov x0, d0

```


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/07/07).

