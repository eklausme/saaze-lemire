---
date: "2010-03-12 12:00:00"
title: "Which is faster: integer addition or XOR?"
---



The [bitwise exclusive or](https://en.wikipedia.org/wiki/Exclusive_or#Bitwise_operation) (e.g., 1110 XOR 1001 = 0111) looks simpler to compute than [integer addition](https://en.wikipedia.org/wiki/Addition#Performing_addition) (e.g., 2 + 9 = 11). Some research articles claim that XOR is faster. It appears to be Computer Science folklore. But is it true?

Which line runs faster? (The symbol &ldquo;^&rdquo; is the XOR.)

<code>for(int k = 0; k &lt; N; ++k) sum+= k;</code>

<code>for(int k = 0; k &lt; N; ++k) sum^= k;</code>

__My result: <span style="font-weight: normal;">In C++ and Java, both run at the same speed (within 1%).</span>__

__Code__: My [source code is on github](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2010/03/12).

