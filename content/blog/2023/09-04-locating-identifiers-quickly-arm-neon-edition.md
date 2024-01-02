---
date: "2023-09-04 12:00:00"
title: "Locating `identifiers´ quickly (ARM NEON edition)"
---



A common problem in parsing is that you want to find all identifiers (e.g., variable names, function names) in a document quickly. There are typically some fixed rules. For example, it is common to allow ASCII letters and digits as well as characters like &lsquo;_&rsquo; in the identifier, but to forbid some characters at the beginning of the identifier (such as digits). E.g., ab123 is an identifier but 123ab might not be.

An efficient way to proceed is to use a 256-element table where allowed leading characters have a set value (say 255), non-identifier characters have the value 0, and all other characters have a non-zero, non-255 value.

In C, you might be about to count identifiers using the following routine:
```C
while (source < end) {
  uint8_t c = identifier_map[*source++];
  if(c) {
    count += (c == 255);
    while (source < end && identifier_map[*source]) {
      source++;
    }
  }
}

```


Can you do better?

Suppose that you have an ARM-based machine (such as a recent macBook). Then you have access to Single instruction, multiple data (SIMD) instructions which can process up to 16 bytes at a time. ARM has several types of SIMD instructions but ARM NEON are the most well known.

We can apply vectorized classification to the problem (see [Parsing Gigabytes of JSON per Second](https://arxiv.org/abs/1902.08318), The VLDB Journal, 28(6), 2019). I am not going to review the technique in details but the gist of it is that we replace the table lookup with a vectorized (or SIMD-based) table lookup. The relevant component of the code, using ARM instrinsic functions, looks as follows:
```C
uint8x16_t low_nibble_mask = (uint8x16_t){
42, 62, 62, 62, 62, 62, 62, 62, 62, 62, 60, 20, 20, 20, 20, 21};
uint8x16_t high_nibble_mask =
(uint8x16_t){0, 0, 0, 2, 16, 33, 4, 8, 0, 0, 0, 0, 0, 0, 0, 0};
uint8x16_t chars = vld1q_u8((const uint8_t *)source);
uint8x16_t low =
vqtbl1q_u8(low_nibble_mask, vandq_u8(chars, vdupq_n_u8(0xf)));
uint8x16_t high = vqtbl1q_u8(high_nibble_mask, vshrq_n_u8(chars, 4));
uint8x16_t v = vtstq_u8(low, high);
uint8x16_t v_no_number = vtstq_u8(low, vandq_u8(high, vdupq_n_u8(61)));

```


The register `v` contains a non-zero byte value where there is an identifier character, and the `v_no_number` contains a non-zero byte value where there is a non-digit identifier character. We can map these SIMD registers into bitmaps from which we can identify the location of the identifier using regular C code.

We need to do a few logical operations and bit shifting. Counting the number of identifiers is a simple as the following:
```C
while (source <= end16) {
  auto m = identifier_neon(source);
  uint16_t mask =
   m.leading_identifier_mask & ~(m.identifier_mask << 1 | lastbit);
  count += popcount(mask);
  lastbit = m.identifier_mask >> 15;
  source += 16;
}

```


ARM NEON is not particularly powerful, not compared with AVX-512 on Intel Ice Lake or AMD Zen 4 processors, but it is still quite good by historical standards, and the Apple implementation is fine. You can extend this approach to go to 64 bytes.

So how does the SIMD approach compares to the conventional approach? I am using a script that generate a large document. We want to count the number of identifiers as quickly as possible. The file is 10 MB and it contains half a million identifiers.

SIMD (simdjson-like, 16 bytes) |10 GB/s                  |2 ns/identifier          |
-------------------------|-------------------------|-------------------------|
SIMD (simdjson-like, 64 bytes) |17 GB/s                  |1.1 ns/identifier        |
conventional (table-based) |0.5 GB/s                 |25 ns/identifier         |


So the SIMD-based approach over 10 times faster in this instance. My Apple-based M2 processor runs at 3.6 GHz. Using the SIMD-based code, it retires over 5 instructions per cycle. The conventional table-based approach retires far few instructions, and it is bound by load latencies.

For context, my macBook has a disk that can read at well over 2 GB/s. So the conventional routine is not fast.

On AVX-512, it should be possible to reach even higher speeds.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/09/03).

__Credit__: This problem was suggested to me by Kevin Newton (Shopify). He provided the test file. The 64-byte implementation was provided by reader Perforated Blob.

