---
date: "2023-03-10 12:00:00"
title: "Trimming spaces from strings faster with SVE on an Amazon Graviton 3 processor"
---



Programmers sometimes need to trim, or remove, characters, such as spaces from strings. It might be a surprising expensive task. In C/C++, the following function is efficient:
```C
size_t trimspaces(const char *s, size_t len, char *out) {
  char * init_out{out};
  for(size_t i = 0; i < len; i++) {
    *out = s[i];
    out += (s[i] != ' ');
  }
  return out - init_out;
}

```


Basically, we write all characters from the input, but we only increment the pointer if the input is not a space.

Amazon makes available new ARM-based systems relying on their Graviton 3 processors. These processors support advanced instructions called &ldquo;SVE&rdquo;. One very nice family of instructions to &lsquo;compact&rsquo; values (effectively, remove unwanted values). I put it to good use [when filtering out integer values from arrays](/lemire/blog/2022/07/14/filtering-numbers-faster-with-sve-on-amazon-graviton-3-processors/).

Unfortunately, the SVE compact instructions cannot be directly applied to the problem of pruning spaces in strings, because they only operate on larger words (e.g., 32-bit words). But, fortunately, it is possible to load bytes directly into 32-bit values so that each byte value occupies 32-bit in memory using intrinsics functions such as <tt>svld1sb_u32</tt>. As you would expect, you can also do the reverse, and take an array of 32-bit values, and automatically convert it to a byte array (e.g., using <tt>svst1b_u32</tt>).

Thus I can take my byte array (a string), load it into temporary 32-bit vectors, prune these vectors, and then store the result as a byte array, back to a string. The following C code is a reasonable implementation of this idea:
```C
size_t sve_trimspaces(const char *s, size_t len, char *out) {
  uint8_t *out8 = reinterpret_cast<uint8_t *>(out);
  size_t i = 0;
  for (; i + svcntw() <= len; i += svcntw()) {
   svuint32_t input = svld1sb_u32(svptrue_b32(), (const int8_t *)s + i);
   svbool_t matches = svcmpne_n_u32(svptrue_b32(), input, 32);
   svuint32_t compressed = svcompact_u32(matches, input);
   svst1b_u32(svptrue_b32(), out8, compressed);
   out8 += svcntp_b32(svptrue_b32(), matches);
  }
  if (i < len) {
   svbool_t read_mask = svwhilelt_b32(i, len);
   svuint32_t input = svld1sb_u32(read_mask, (const int8_t *)s + i);
   svbool_t matches = svcmpne_n_u32(read_mask, input, 32);
   svuint32_t compressed = svcompact_u32(matches, input);
   svst1b_u32(read_mask, out8, compressed);
   out8 += svcntp_b32(read_mask, matches);
  }
  return out8 - reinterpret_cast<uint8_t *>(out);
}

```


Is it faster? Using GCC 12 on a Graviton 3, I get that the SVE approach is 3.6 times faster and it uses 6 times fewer instructions. The SVE code is not six times faster, because it is retiring fewer instructions per cycle. [My code is available.](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/03/10)

conventional code        |1.8 cycles/bytes         |7 instructions/byte      |
-------------------------|-------------------------|-------------------------|
SVE code                 |0.5 cycles/bytes         |1.1 instructions/byte    |


You can achieve a similar result with ARM NEON, but you require large tables to emulate the compression instructions. Large tables lead to code bloat which, at the margin, is not desirable.

