---
date: "2009-02-03 12:00:00"
title: "Compressed bitmaps in Java"
---



A bitmap is an efficient array of boolean values. They are commonly used in [bitmap indexes](https://en.wikipedia.org/wiki/Bitmap_index). The Java language has a bitmap class: BitSet.

Unfortunately, the Java BitSet class __will not scale__ to large sparse bitmapsâ€”the Sun implementation does not use compression.

I published a new free alternative: [JavaEWAH](https://code.google.com/p/javaewah/).

__References__:

- The library contains the 64-bit EWAH algorithm describedâ€”among other placesâ€”in one of [my recent research papers](http://arxiv.org/abs/0901.3751).
- It is a Java port of some of my [C++ Bitmap Index library](https://github.com/lemire/ewahboolarray).


__Credit__:

- Glen Newton gave me the idea for this project.


