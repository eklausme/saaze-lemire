---
date: "2020-10-20 12:00:00"
title: "Ridiculously fast unicode (UTF-8) validation"
---



One of the most common &ldquo;data type&rdquo; in programming is the text string. When programmers think of a string, they imagine that they are dealing with a list or an array of characters. It is often a &ldquo;good enough&rdquo; approximation, but reality is more complex.

The characters must be encoded into bits in some way. Most strings on the Internet, including this blog post, are encoded using a standard called UTF-8. The UTF-8 format represents &ldquo;characters&rdquo; using 1, 2, 3 or 4 bytes. It is a generalization of the ASCII standard which uses just one byte per character. That is, an ASCII string is also an UTF-8 string.

It is slightly more complicated because, technically, what UTF-8 describes are code points, and a visible character, like emojis, can be made of several code points&hellip; but it is a pedantic distinction for most programmers.

There are other standards. Some older programming languages like C# and Java rely on UTF-16. In UTF-16, you use two or four bytes per character. It seemed like a good idea at the time, but I believe that the consensus is increasingly moving toward using UTF-8 all the time, everywhere.

What most character encodings have in common is that they are subject to constraints and that these constraints must be enforce. To put it another way, not any random sequence of bits is UTF-8. Thus you must validate that the strings you receive are valid UTF-8.

Does it matter? It does. For example, Microsoft&rsquo;s web server had a security vulnerability whereas one could send URIs that would appear to the security checks as being valid and safe, but once interpreted by the server, would allow an attacker to navigate on the disk of the server. Even if security is not a concern, you almost surely want to reject invalid strings before you store them in your database as it is a form of corruption.

So your programming languages, your web servers, your browsers, your database engines, all validate UTF-8 all of the time.

If your strings are mostly just ASCII strings, then checks are quite fast and UTF-8 validation is no issue. However, the days when all of your strings were reliably ASCII strings are gone. We live in the world of emojis and international characters.

Back in 2018, I started wondering&hellip; [How fast can you validate UTF-8 strings?](/lemire/blog/2018/05/09/how-quickly-can-you-check-that-a-string-is-valid-unicode-utf-8/) The answer I got back then is a few CPU cycles per character. That may seem satisfying, but I was not happy.

It took years, but I believe we have now arrived at what might be close to the best one can do: the lookup algorithm. It can be more than ten times faster than common fast alternatives. We wrote a research paper about it: [Validating UTF-8 In Less Than One Instruction Per Byte](https://arxiv.org/pdf/2010.03090.pdf) (to appear at Software: Practice and Experience). [We have also published our benchmarking software](https://github.com/lemire/validateutf8-experiments).

Because we have a whole research paper to explain it, I will not go into the details, but the core insight is quite neat. Most of the UTF-8 validation can be done by looking at pairs of successive bytes. Once you have identified all violations that you can detect by looking at all pairs of successive bytes, there is relatively little left to do (per byte).

Our processors all have fast SIMD instructions. They are instructions that operate on wide registers (128 bits, 256 bits, and so forth). Most of them have a &ldquo;vectorized lookup&rdquo; instruction that can take, say, 16 byte values (in the range 0 to 16) and look them up in a 16-byte table. Intel and AMD processors have the `pshufb` instruction that match this description. A value in the range 0 to 16 is sometimes called a nibble, it spans 4 bits. A byte is made of two nibbles (the low and high nibble).

In the lookup algorithm, we call a vectorized lookup instruction three times: once on the low nibble, once on the high nibble and once on the high nibble of the next byte. We have three corresponding 16-byte lookup tables. By choosing them just right, the bitwise AND of the three lookups will allow us to spot any error.

[Refer to the paper for more details](https://arxiv.org/pdf/2010.03090.pdf), but the net result is that you can validate almost entirely a UTF-8 string using roughly 5 lines of fast C++ code without any branching&hellip; and these 5 lines validate blocks as large as 32 bytes at a time&hellip;
```C
simd8 classify(simd8 input, simd8 previous_input) {
  auto prev1 = input.prev<1>(previous_input);
  auto byte_1_high = prev1.shift_right <4>().lookup_16(table1);
  auto byte_1_low = (prev1 & 0x0F).lookup_16(table2);
  auto byte_2_high = input.shift_right <4>().lookup_16(table3); 
  return (byte_1_high & byte_1_low & byte_2_high);
}
```


It is not immediately obvious that this would be sufficient and 100% safe. [But it is](https://arxiv.org/pdf/2010.03090.pdf). You only need a few inexpensive additional technical steps.

The net result is that on recent Intel/AMD processors, you need just under an instruction per byte to validate even the worse random inputs, and because of how streamlined the code is, you can retire more than three such instructions per cycle. That is, we use a small fraction of a CPU cycle (less than 1/3) per input byte in the worst case on a recent CPU. Thus we consistently achieve speeds of over 12 GB/s.

The lesson is that while lookup tables are useful, vectorized lookup tables are fundamental building blocks for high-speed algorithms.

If you need to use the fast lookup UTF-8 validation function in a production setting, we recommend that you go through the [simdjson library](https://github.com/simdjson/simdjson/blob/master/doc/basics.md#utf-8-validation-alone) (version 0.5 or better). It is well tested and has features to make your life easier like runtime dispatching. Though the simdjson library is motivated by JSON parsing, you can use it to just validate UTF-8 even when there is no JSON in sight. The simdjson supports 64-bit ARM and x64 processors, with fallback functions for other systems. We package it as a single header file along with a single source file; so you can pretty much just drop it into your C++ project.

__Credit__: Muła popularized more than anyone the vectorized classification technique that is key to the lookup algorithm. To my knowledge, Keiser first came up with the three-lookup strategy. To my knowledge, the first practical (non hacked) SIMD-based UTF-8 validation algorithm was crafted by K. Willets. Several people, including Z. Wegner showed that you could do better. Travis Downs also provided clever insights on how to accelerate conventional algorithms.

__Further reading__: If you like this work, you may like [Base64 encoding and decoding at almost the speed of a memory copy](https://arxiv.org/abs/1910.05109) (Software: Practice and Experience 50 (2), 2020) and [Parsing Gigabytes of JSON per Second](https://arxiv.org/abs/1902.08318) (VLDB Journal 28 (6), 2019).

