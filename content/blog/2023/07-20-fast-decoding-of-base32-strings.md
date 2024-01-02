---
date: "2023-07-20 12:00:00"
title: "Fast decoding of base32 strings"
---



We often need to encode binary data into ASCII strings (e.g., email). The standards to do so include base16, base32 and base64.

There are some research papers on fast base64 encoding and decoding: [Base64 encoding and decoding at almost the speed of a memory copy](https://arxiv.org/abs/1910.05109) and [Faster Base64 Encoding and Decoding using AVX2 Instructions](https://arxiv.org/abs/1704.00605).

For the most parts, these base64 techniques are applicable to base32. Base32 works in the following manner: you use 8 ASCII characters to encode 5 bytes. Each ASCII characters carries 5 bits of information: it can be one of 32 characters. For reference, base64 uses 64 different ASCII characters so each character carries more information. However, base64 requires using both upper case and lower case letters and other special characters, so it is less portable. Base32 can be case invariant.

There are different variations, but we can consider [Base 32 Encoding with Extended Hex Alphabet](https://www.rfc-editor.org/rfc/rfc4648#page-10) which uses the letters 0 to 9 for the values 0 to 9 and the letters A to V for the numbers from 10 to 31. So each character represents a value between 0 to 31. If required, you can pad the coding with the &lsquo;=&rsquo; character so that it is divisible by 8 characters. However, that is not always required. Instead, you may simply stop decoding as soon as an out-of-range character is found.

&lsquo;0&rsquo;          |0                        |
-------------------------|-------------------------|
&lsquo;1&rsquo;          |1                        |
&lsquo;2&rsquo;          |2                        |
&hellip;                 |&hellip;                 |
&lsquo;4&rsquo;          |4                        |
&lsquo;9&rsquo;          |9                        |
&lsquo;A&rsquo;          |10                       |
&hellip;                 |&hellip;                 |
&lsquo;V&rsquo;          |31                       |


A conventional decoder might use branchy code:
```C
if (ch >= '0' && ch <= '9')
  d = ch - '0';
else if (ch >= 'A' && ch <= 'V')
  d = ch - 'A' + 10;
else if (ch >= 'a' && ch <= 'v')
  d = ch - 'a' + 10;
else
  return -1;

```


Though that&rsquo;s not going to be fast, it can be convenient. You can do better with tables. For example, you may populate a 256-long table (one for each character byte value) with the values from the table above, and use a special error code when the value is out of range (e.g., 32). That can produce efficient code:
```C
uint64_t r = 0;
for (size_t i = 0; i < 8; i++) {
  uint8_t x = table[*src++];
  if (x > 31) {
    r <<= (5 * (8 - i));
    break;
  }
  r <<= 5;
  r |= x;
}

```


You can also program a version using SIMD instructions. I am not going to present the code, [it is similar to the code described in a base64 pape](https://arxiv.org/abs/1704.00605)r.

I wrote a benchmark focused on short inputs (32 bytes). My benchmark makes function inlining difficult, thus the function call overhead and the population of the constant is a non-negligible cost.

I run it on an Ice Lake server, and the code is compiled with GCC11 (targeting an old processor, Haswell). We can use either 128-bit SIMD registers or 256-bit SIMD registers.

technique                |CPU cycles/string        |instructions/string      |
-------------------------|-------------------------|-------------------------|
branchy                  |500                      |1400                     |
table                    |43                       |230                      |
SIMD (128 bits)          |15                       |70                       |
SIMD (256 bits)          |13                       |61                       |


In this instance, the table-based approach is reasonable and is only about three times slower than the SIMD-based approaches. Because I am using small inputs, the 256-bit SIMD code has only marginal benefits, but I expect it would do better over longer strings. The branchy code is terrible performance-wise, but it is more flexible and can easily deal with skipping white space characters and so forth.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/07/20).

__Credit__: The work was motivated by the simdzone project by NLnetLabs. The initial base32 decoder implementation was provided by GitHub user @aqrit.

