---
date: "2019-04-17 12:00:00"
title: "Parsing short hexadecimal strings efficiently"
---



It is common to represent binary data or numbers using the hexadecimal notation. Effectively, we use a base-16 representation where the first 10 digits are 0, 1, 2, 3, 5, 6, 7, 8, 9 and where the following digits are A, B, C, D, E, F, with the added complexity that we can use either lower or upper case (A or a).

We sometimes want to convert strings of hexadecimal characters into a numerical value. For simplicity, let us assume that we have sequences of four character. This is a common use case due to [unicode escape sequences](https://en.wikipedia.org/wiki/Escape_sequences_in_C#endnote_Note4) in C, JavaScript, C# and so forth.

Each character is represented as a byte value using its corresponding ASCII code point. So &lsquo;0&rsquo; becomes 48, &lsquo;1&rsquo; is 49, &lsquo;A&rsquo; is 65 and so forth.

The most efficient approach I have found is to simply rely on memoization. Build a 256-byte array where 48 (or &lsquo;0&rsquo;) is mapped to 0, 65 (or &lsquo;A&rsquo;) is mapped to 10 and so forth. As an extra feature, map all disallowed values to -1 so we can detect them. Then just lookup the four values and combine them.
```C
uint32_t hex_to_u32_lookup(const uint8_t *src) {
  uint32_t v1 = digittoval[src[0]];
  uint32_t v2 = digittoval[src[1]];
  uint32_t v3 = digittoval[src[2]];
  uint32_t v4 = digittoval[src[3]];
  return v1 << 12 | v2 << 8 | v3 << 4 | v4;
}
```


What else could you do?

You could replace the table lookup with a fancy mathematical function:
```C
uint32_t convertone(uint8_t c) {
  return (c & 0xF) + 9 * (c >> 6);
}
```


How do they compare? I implemented both of these and I find that the table lookup approach is more than twice as fast when the function is called frequently. I report the number of instructions and the number of cycles to parse 4-character sequences on a Skylake processor (code compiled with GNU GCC 8).

&nbsp;                   |Instruction count        |Cycle count              |
-------------------------|-------------------------|-------------------------|
lookup                   |18                       |4.3                      |
math                     |38                       |9.6                      |


I am still frustrated by the cost of this operation. Using 4 cycles to convert 4 characters to a number feels like too much of an expense.

[My source code is available (run it under Linux).](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/04/17)

__Further reading__: [Fast hex number string to int](https://johnnylee-sde.github.io/Fast-hex-number-string-to-int/) by Johnny Lee; [Using PEXT to convert from hexadecimal ASCII to number](http://0x80.pl/notesen/2014-10-09-pext-convert-ascii-hex-to-num.html) by Mula.

