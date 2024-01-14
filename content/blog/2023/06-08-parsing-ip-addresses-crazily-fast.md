---
date: "2023-06-08 12:00:00"
title: "Parsing IP addresses crazily fast"
---



Most of us are familiar with IP addresses: they are strings typically of the form &ldquo;ddd.ddd.ddd.ddd&rdquo; where ddd is a decimal number of up to three digits in the range 0 to 255. For example, 127.0.0.1 or 192.168.0.2.

Each of the four number is a byte value, and the address is an IPv4 network address that fits in 32 bits. There is a more recent extension (IPv6) that spans 128 bits, but the conventional IPv4 addresses are common. They can be part of URLs (e.g., http://127.0.0.1/home).

I have a blog post on how you can go from the 32-bit binary value to the string quickly: [Serializing IPs quickly in C++](/lemire/blog/2023/02/01/serializing-ips-quickly-in-c/). It turns out that you can write the strings very, very fast.

[For our fast URL parsing library](https://www.ada-url.com), I also wrote the counterpart, where we go from the string to the 32-bit value. Our URL parsing library supports various IP address formats and lengths. However, I did not optimize it particularly well because there are many other challenges in efficient URL parsing.

Recently, Jeroen Koekkoek brought to my attention that my friend Wojciech has a recent article on the [parsing of IP addresses](http://0x80.pl/notesen/2023-04-09-faster-parse-ipv4.html). As usual, it is brillant. Koekkoek is working on accelerating DNS record parsing in his [simdzone project](https://fosdem.org/2023/schedule/event/dns_parsing_zone_files_really_fast/) and we expect to parse a lot of IP addresses.

Wojciech&rsquo;s results are slightly depressing, however. He suggests that you can beat a standard approach by a factor of 2 or 2.5 in speed, which is excellent, but at the cost of relatively large tables.

Let summarize the strategy developed by Wojciech:

1. Identify the location of the dots.
1. Construct an integer (a dot &ldquo;mask&rdquo;) which has its bits set according to the location of the dots (if a dot is present as the second character, we set the second bit to 1). You can check that there are only 81 possible masks, after adding a virtual dot at the end of the address.
1. Build a function which maps this dot mask to precomputed values which can be used to reorganize the digits and process them with [single instruction, multiple data (SIMD)](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data) instructions.


Wojciech implemented many variations. Generally, he distinguishes between the case where we have no 3-digit numbers (e.g., 12.1.0.1), and so forth. I don&rsquo;t expect that this optimization is very useful in practice. He came up with two different mapping functions, one that is slow but requires little memory, and one that is faster but requires a fair amount of memory. After some effort, I was able to compute with a compromise that is nearly as fast as his fastest approach, but without using much more memory than his slow routine. I end up using about 255 bytes for the mapping function, which is reasonable.

He has also separate steps to validate the input: i.e., ensure that we are only dealing with digits and dots. I feel that this can be accomplished as part of the computation. He loads the expected dot mask as part of the validation, but I expect that you can more simply validate the input by comparing the expected length of the address (which we get in any case). Overall, I only need 81 times sixteen bytes of data to do the main processing. All in all, I use nearly only half as much storage as Wojciech&rsquo;s fastest routine with the expectation that I can go faster because I have simplified a few steps.

A standard C function (under Linux and similar system) to parse IP addresses is <tt>inet_pton</tt>. It is similar in performance to the routines that Wojciech tested against. I called my own function (coded in C), <tt>sse_inet_aton</tt>. Unlike the standard function, mine will always read sixteen  bytes, though it will only process the specified number of bytes. This means that the input string must either be part of a large string or you must overallocate. This limitation was already there in Wojciech&rsquo;s code, and I could not find a good way around it. If you have a fancy new processors with advanced SIMD instructions (AVX-512 or SVE), there are [masked load and store instructions](/lemire/blog/2022/11/08/modern-vector-programming-with-masked-loads-and-stores/) which solve this problem nicely. But like Wojciech, I decided to stick with old school SIMD instructions.

For my benchmark, I just generate a lot of random IP addresses, and I try to parse them as quickly as possible. I use an Intel IceLake server with GCC 11 and clang (LLVM 16). [My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/06/08).

&nbsp;                   |instructions/address     |speed                    |addresses per s          |
-------------------------|-------------------------|-------------------------|-------------------------|
<tt>inet_pton</tt>       |300                      |0.38 GB/s                |35 million               |
<tt>sse_inet_aton</tt> (LLVM 16) |52                       |2.7 GB/s                 |200 million              |
<tt> sse_inet_aton</tt> (GCC 11) |63                       |2.3 GB/s                 |170 million              |


So the optimized function is six times faster than the standard one using GCC. Switching to clang (LLVM), you go seven times faster. The fact that LLVM has such an edge over GCC warrants further examination.

I suspect that my code is not nearly optimal, but it is definitively worth it in some cases in its current state. I should stress that the optimized function includes full validation: we are not cheating.

__Future work__: The code has the hard-coded assumption that you have a Linux or macOS system with an SSE 4.1 compatible processor: that&rsquo;s virtually all Intel and AMD processors in operation today. The code could be faster on AVX-512 machines, but I leave this for future work. I have also not included support for ARM (through NEON instructions), but it should be easy. Furthermore, I only support the conventional IPv4 addresses in its most common format (ddd.ddd.ddd.ddd) and I do not support IPv6 at all.

