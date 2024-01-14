---
date: "2020-04-05 12:00:00"
title: "Multiplying backward for profit"
---



Most programming languages have integer types with arithmetic operations like multiplications, additions and so forth. Our main processors support 64-bit integers which means that you can deal with rather large integers. However, you cannot represent everything with a 64-bit integer. What if you need to multiply 5<sup>100</sup> by 37? Programming languages like Python or JavaScript will gracefully handle it. In programming languages like C/C++, you will need to use a library. In Java, you will have to use special classes part of the standard library.

You will almost never need to deal with integers that do not fit in 64 bits, unless you are doing cryptography or some esoteric numerical analysis. Nevertheless, it does happen that you need to work with very large integers.

How does the product 5<sup>100</sup> by 37 gets computed if processors are limited to 64-bit words? Underneath, your software represents such large integers using multiple 64-bit words. The standard approach computes the product starting from the least significant bits. Thus if you are multiplying an integer that requires a single machine word (<em>w</em>) with an integer that requires _n_ machine words, you will use _n_ multiplications starting with a multiplication between the word _w_ and the least significant word of the other integer, going up to the most significant words. The code in C/C++ might look like so:
```C
// multiply w * b where b contains n words, n > 0
p = full_multiplication(w, b[0]); // 64-bit x 64-bit => 128-bit
output[0] = p.low;// least significant 64-bits
uint64_t r = p.high;// most significant 64-bits
for (i = 1; i < n; i++) {
  p = full_multiplication(w, b[i]);
  p.low += r; // add r with carry
  if(p.low < r) p.high++;
  output[i] = p.low; // least significant 64-bits
  r = p.high;
}
```


<br/>
It is akin to how we are taught to multiply in school: start with the least significant digits, and go up. I am assuming that all integers are positive: it is not difficult to generalize the problem to include signed integers.

So far, it is quite boring. So let me add a twist.
// multiply w * b where b contains n words, n &gt; 0<br/>
p = full_multiplication(w, b[0]); // 64-bit x 64-bit =&gt; 128-bit<br/>
output[0] = p.low;// least significant 64-bits<br/>
uint64_t r = p.high;// most significant 64-bits<br/>
for (i = 1; i &lt; n; i++) {<br/>
p = full_multiplication(w, b[i]);<br/>
p.low += r; // add r with carry<br/>
if(p.low &lt; r) p.high++;<br/>
output[i] = p.low; // least significant 64-bits<br/>
r = p.high;<br/>
}<br/>
output[n] = r;

You can also multiply backward, starting from the most significant words. Though you might think it would be less efficient, you can still do the same product using the same _n_ multiplications. The code is going to be a bit more complicated because you have to carry the overflow that you may encounter in the less significant words upward. Nevertheless, you can implement it in C/C++ using only a few extra lines of code. According to my hasty tests, it is only marginally slower (by about 20%).
```C
// multiply w * b where b contains n words, n > 0
p = full_multiplication(w, b[n-1]); // 64-bit x 64-bit => 128-bit
uint64_t r = p.high// least significant 64-bits ;
output[n - 1] = p.low;// most significant 64-bits
output[n] = p.high; 
for (i = n-2; i >=0; i--) {
    p = full_multiplication(w, b[i]);
    output[i] = p.low; // least significant 64-bits 
    // check for overflow
    bool overflow = (output[i + 1] + p.high < output[i + 1]);
    output[i + 1] += p.high;
    for (size_t j = i + 2; overflow; j++) {
      output[j]++; // propagate the carry
      overflow = (output[j] == 0);
    }
}
```

// multiply w * b where b contains n words, n &gt; 0<br/>
p = full_multiplication(w, b[n-1]); // 64-bit x 64-bit =&gt; 128-bit<br/>
uint64_t r = p.high// least significant 64-bits ;<br/>
output[n &#8211; 1] = p.low;// most significant 64-bits<br/>
output[n] = p.high;<br/>
for (i = n-2; i &gt;=0; i&#8211;) {<br/>
p = full_multiplication(w, b[i]);<br/>
output[i] = p.low; // least significant 64-bits<br/>
// check for overflow<br/>
bool overflow = (output[i + 1] + p.high &lt; output[i + 1]);<br/>
output[i + 1] += p.high;<br/>
for (size_t j = i + 2; overflow; j++) {<br/>
output[j]++ // propagate the carry;<br/>
overflow = (output[j] == 0);<br/>
}<br/>
}

Why would computing the multiplication backward ever be useful?

Suppose that you are not interested in the full product. Maybe you just need to check whether the result in within some bounds, or maybe you just need a good approximation of the product. Then starting from the most significant bits could be helpful if you can stop the computation after you have enough significant bits.

It turns out that you can do so, efficiently. You can compute the most significant _k_ words using no more than an expected <em>k </em>+ 0.5 multiplications. Furthermore, if you are careful, you can later resume the computation and complete it.

At each step, after doing _k_ multiplications, and computing _k_ + 1 words, these _k_ + 1 most significant words are possibly underestimating the true _k_ + 1 most significant words because we have not added the carry from the less significant multiplications. However, we can bound the value of the carry: it is less than <em>w</em>. To see that it must be so, let _r_ be the number of remaining words in the multiword integer that we have not yet multiplied by w. The maximal value of these words is 2<sup>64<em>r</em> </sup>&#8211; 1. So we are going to add, at most, (2<sup>64<em>r</em> </sup>&#8211; 1)<em>w</em> to our partially computed integer: the overflow (carry) above the _r_ is at most ((2<sup>64<em>r</em> </sup>&#8211; 1)<em>w</em>)/2<sup>64<em>r </em></sup>a value strictly less than <em>w</em>.

This means that if we add _w_ &#8211; 1 to the least significant of the _k_ + 1 words and it does not overflow, then we know that the _k_ most significant words are exact, and we can stop. This might happen, roughly, half the time, assuming that we are dealing with random inputs. When it does overflow, you can just continue and compute one more product. If, again, adding _w_ &#8211; 1 to the least significant word you computed does not create an overflow, you can stop, confident that the <em>k </em>+ 1 most significant words are exact.

However, you then gain another more powerful stopping condition: if the second least significant word is not exactly 2<sup>64 </sup>&#8211; 1, then you can also stop, confident that _k_ most significant words are exact, because adding w to the least significant word can, at most, translate in a carry of +1 to the second least significant word. Because it is quite unlikely that you will end up with exactly the value 2<sup>64 </sup>&#8211; 1, we know that, probabilistically, you will not need more than _k_ + 1 multiplications to compute exactly the _k_ more significant words. And quite often, you will be able to stop after _k_ multiplications.

My code implementing these ideas is a bit too long for a blog post, but I have published it as its [own GitHub repository](https://github.com/lemire/backward_multiplication), so you can check it out for yourself. It comes complete with tests and benchmarks.

I have restricted my presentation to the case where at least one integer fits in a single word. Generalizing the problem to the case where you have two multiword integers is a fun problem. If you have ideas about it, I&rsquo;d love to chat.

__Implementation notes__: The code is mostly standard C++. The main difficulty is to be able to compute the full multiplication which takes two 64-bit words and generates two 64-bit words to represent the product. To my knowledge, there is no standard way to do it in C/C++ but most compilers offer you some way to do it. At the CPU level, computing the full product is always supported (64-bit ARM and x64) with efficient instructions.

__Credit__: This work is inspired by notes and code from Micheal Eisel.

