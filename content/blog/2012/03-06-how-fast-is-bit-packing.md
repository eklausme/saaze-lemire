---
date: "2012-03-06 12:00:00"
title: "How fast is bit packing?"
---



Integer values are typically stored using 32 bits. Yet if you are given an array of integers between 0 and 131&nbsp;072, you could store these numbers using as little as 17 bits each&mdash;a net saving of almost 50%. 

Programmers nearly never store integers in this manner despite the obvious compression benefits. Indeed, bit packing and unpacking is expensive. How expensive? Intuitively, you might think that recovering 32-bit integers from a stream of packed integers must be at least as expensive as copying the 32-bit integers, and possibly much more expensive. If that is your intuition, then you might be wrong. It can be cheaper to recover 32-bit integers from packed 4-bit integers because you only need to load one 32-bit word to unpack 8 integers. 

Clearly, packing integers in units of 17 bits is not especially convenient. Indeed, 17 and 32 are [coprime](https://en.wikipedia.org/wiki/Coprime). We expect that it would be much faster to pack and unpack integers in units of 4, 8 or 16 bits, than in units of 17 bits. Indeed it is but the difference is maybe not as large as you might think.

I have implemented [efficient packing and unpacking routines](http://pastebin.com/ugGnk00p) in C++. To simplify the implementation, we pack and unpack integers in sets of 32 numbers. I have optimized the code using the GNU GCC 4.6.2 compiler. 

On my macbook air (Intel core i7), I get that the _unpacking_ speed is not very sensitive to the specific number of bits: generally, the smaller the bit width, the faster the unpacking. The _packing_ speed is much faster when the bit width is 8 or 16. Even so, the difference is only by a factor of two or so. The results are presented in the next figure. On the y axis, you have the time (smaller is better). On the the x axis, we have the number of bits we packed to. For example, when bit is 1, we pack 32 integers into a single 32-bit word. When the number of bits is set to 32 bits, we have a regular copy.

I also provide the raw numbers behind the figure in the next table. 

bits                     |pack (ms)                |unpack (ms)              |
-------------------------|-------------------------|-------------------------|
1                        |219                      |211                      |

2                        |215                      |216                      |

3                        |210                      |205                      |

4                        |198                      |194                      |

5                        |222                      |214                      |

6                        |229                      |218                      |

7                        |242                      |222                      |

8                        |167                      |202                      |

9                        |252                      |240                      |

10                       |243                      |225                      |

11                       |255                      |235                      |

12                       |246                      |231                      |

13                       |276                      |244                      |

14                       |279                      |245                      |

15                       |304                      |255                      |

16                       |183                      |223                      |

17                       |292                      |252                      |

18                       |297                      |256                      |

19                       |316                      |266                      |

20                       |300                      |256                      |

21                       |329                      |280                      |

22                       |321                      |274                      |

23                       |332                      |278                      |

24                       |299                      |257                      |

25                       |341                      |289                      |

26                       |340                      |298                      |

27                       |352                      |295                      |

28                       |336                      |284                      |

29                       |367                      |311                      |

30                       |357                      |299                      |

31                       |384                      |319                      |

32                       |256                      |261                      |



__Conclusion__: Bit packing and unpacking can be quite fast. In particular, it can be cheaper to unpack integers from a small number of bits to 32-bit integers than to copy the same 32-bit integers. Exact results will vary depending on your compiler and CPU.

__Note__: Strictly speaking my implementation packs the first bits of each integer: it is not assumed that the integers are between 0 and 2<sup>bit</sup>. By adding this assumption, you can improve the packing speed somewhat (at least when the number of bits is not 8 or 16).

__Further reading__ : We have written recent research papers that survey related schemes for this problem. Please see:

- Daniel Lemire and Leonid Boytsov, [Decoding billions of integers per second through vectorization](http://arxiv.org/abs/1209.2137), Software: Practice &#038; Experience 45 (1), 2015.
- Daniel Lemire, Nathan Kurz, Leonid Boytsov, [SIMD Compression and the Intersection of Sorted Integers]( http://arxiv.org/abs/1401.6399), Software: Practice and Experience (to appear)


They include an extensive experimental evaluation. You can find a complete implementation of all techniques in C++11 online:<br/>
<a href="https://github.com/lemire/FastPFor" title="FastPFor">FastPFor</a> and <a href="https://github.com/lemire/SIMDCompressionAndIntersection" title="SIMDCompressionAndIntersection">SIMDCompressionAndIntersection</a>. There are also C libraries: [simdcomp](https://github.com/lemire/simdcomp) and <a href="https://github.com/lemire/MaskedVByte" title="MaskedVByte">MaskedVByte</a>. If you prefer Java, please see [JavaFastPFOR](https://github.com/lemire/JavaFastPFOR).

