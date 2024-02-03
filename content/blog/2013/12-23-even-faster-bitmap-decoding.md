---
date: "2013-12-23 12:00:00"
title: "Even faster bitmap decoding"
---



Bitmaps are a simple data structure used to represent sets of integers. For example, you can represent all sets of integers in [0,64) using a single 64-bit integer. When they are applicable, bitmaps are very efficient compared to the alternatives (e.g., a hash set).

Unfortunately, extracting the bit sets in a bitmap can be expensive. Suppose I give you the integer 27 (written as 0b011011 in binary notation), you would want to recover the integers 0, 1, 3 and 4. Of course, you can check the value of each bit (by computing <tt>v &amp; (1&lt;&lt;bit)</tt>) but this can be atrociously slow. To do it faster, you can use the fact that you can quickly find the least significant bit set:
```C
int pos = 0;
for(int k = 0; k < bitmaps.length; ++k) {
  long data = bitmaps[k];
  while (data != 0) {
    int ntz = Long.numberOfTrailingZeros(data);
    output[pos++] = k * 64 + ntz;
    data ^= (1l << ntz);
  }
}
```


In C or C++, the call to numberOfTrailingZeros can be mapped directly some assembly instructions (e.g., bit scan forward or BSF). Though it looks like `numberOfTrailingZeros` is implemented using several branches in Java, the compiler is smart enough to compile it down similar machine instructions. (Note: thanks to Erich Schubert for pointing out that Java is so smart.)

Up until recently, I did not think we could do better than relying on <tt>Long.numberOfTrailingZeros</tt>, but I stumbled on a [blog post](http://www.steike.com/code/bits/debruijn/) by Erling Ellingsen where he remarked that the function <tt>Long.bitCount</tt> (reporting the number of bit sets in a word) was essentially branch-free. (As it turns out, Java also converts `bitCount` to efficient machine instructions like it does for <tt>numberOfTrailingZeros</tt>.) This suggests an alternative to decode the set bits from a bitmap:
```C
int pos = 0;
for(int k = 0; k < bitmaps.length; ++k) {
   long bitset = bitmaps[k];
   while (bitset != 0) {
     long t = bitset & -bitset;
     output[pos++] = k * 64 +  Long.bitCount(t-1);
     bitset ^= t;
   }
}
```


Experimentally, I find that the approach based on Long.bitCount can be 10% slower when there are few bit sets. However, it can also be significantly faster (e.g., 30% or even 70% faster) in some instances. Here are the decoding speeds in millions of integers per second on a recent Intel core i7 processor (in Java);

&nbsp;Density&nbsp;      |&nbsp;Naive&nbsp;        |&nbsp;Long.numberOfTrailingZeros&nbsp; |&nbsp;Long.bitCount&nbsp; |
-------------------------|-------------------------|-------------------------|-------------------------|
1/64                     |15                       |143                      |131                      |
2/64                     |27                       |196                      |202                      |
4/64                     |45                       |213                      |252                      |
8/64                     |68                       |261                      |350                      |
16/64                    |90                       |281                      |431                      |
32/64                    |115                      |285                      |480                      |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2013/12/23).

On the whole, the approach based on Long.bitCount is probably better unless you expect very sparse bitmaps.

__Update__: I have created a [C++ version](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2013/12/23/bitextract.cpp) and in this case, both techniques have the same speed. So Java particularly loves bitCount for this problem.

