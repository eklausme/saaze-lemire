---
date: "2010-07-19 12:00:00"
title: "Is multiplication slower than addition?"
---



Earlier, I [asked](/lemire/blog/2010/03/12/which-is-fastest-integer-addition-or-xor/) whether integer addition was faster than bitwise exclusive or. My tests showed no difference, and nobody contradicted me.

However, everyone knows that multiplication is slower than addition? Right? In cryptography, there are many papers on how to trade multiplications for additions, to speed up software.

So? Can you predict which piece of code runs faster?

__scalar product (N multiplications):__<br/>
<code><br/>
for(int k =0; k &lt; N ; ++k)<br/>
answer += vector1[k] * vector2[k];<br/>
</code>

__scalar product two-by-two (N multiplications):__<br/>
<code> for(int k =0; k &lt; N ; k+=2)<br/>
answer += vector1[k] * vector2[k]<br/>
+vector1[k+1] * vector2[k+1];</code>

__non-standard scalar product (N/2 multiplications):__<code><br/>
for(int k =0; k &lt; N ; k+=2)<br/>
answer += ( vector1[k] + vector2[k] )<br/>
* ( vector1[k+1] + vector2[k+1] );<br/>
</code>

__just additions (no multiplication):__<code><br/>
for(int k =0; k &lt; N ; ++k)<br/>
answer += vector1[k] + vector2[k];<br/>
</code>

__Answer:__ Merely reducing the number of multiplications has no benefit, in these tests. Hence, simple computational cost models (such as counting the number of multiplications) may not hold on modern [superscalar](https://en.wikipedia.org/wiki/Superscalar) processors.

My results using GNU GCC 4.2.1 on both a desktop and a laptop:

algorithm                |Intel Core i7            |Intel Core 2 Duo         |
-------------------------|-------------------------|-------------------------|
scalar product           |0.30                     |0.39                     |
scalar product (2&#215;2) |0.25                     |0.39                     |
fewer multiplications    |0.25                     |0.39                     |
just additions           |0.16                     |0.23                     |


Times are in seconds. The source code is available [without pointer arithmetics](http://pastebin.com/cdMMLMZm). The same test with pointer arithmetics gives faster results, but the same conclusion. I tried a [similar experiment](http://pastebin.com/YxfVcvue) in Java. It confirms my result.

__Code:__ Source code posted on my blog is available from a [github repository](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog).

