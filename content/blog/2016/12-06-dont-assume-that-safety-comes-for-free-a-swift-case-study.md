---
date: "2016-12-06 12:00:00"
title: "Don´t assume that safety comes for free: a Swift case study"
---



Most modern languages try to be &ldquo;safer&rdquo; by checking runtime values in the hope of producing more secure and less buggy software. Sadly, it makes it harder to reason about the performance of the code. And, sometimes, the cost can be far from negligible.

Let me illustrate it through a story using Swift programming (Apple&rsquo;s new programming language).

How do you sum the values in an array? If you are an idiot like myself, you might use a `for` loop:
```C
var s = 0
for i in array {
    s += i
}
```


According to my benchmark, this runs at a speed of 0.4 ns per array element. My Skylake processor runs at a flat speed of 3.4GHz, so that we are using a bit over one CPU cycle per array element (1.36 to be precise). Not bad, but we know we could do better. How could Swift get something so simple &ldquo;wrong&rdquo;? We shall come back to this issue.

We can get fancier and compute the sum using &ldquo;functional programming&rdquo; with a call to <tt>reduce</tt>. It is slightly shorter and more likely to get you a job interview:
```C
array.reduce(0,{$0 + $1})
```


For extra obfuscation and even better luck during interviews, you can even use an equivalent and even shorter syntax: 
```C
array.reduce(0,+)
```


Though it is more scientific-sounding, this function is actually 50% slower (clocking at 0.6 ns per element). Why is it slower? We are evidently paying a price for the higher level of abstraction.

Can we do better? 

Swift&rsquo;s integers (Int) are 64-bit integers on 64-bit platforms. What happens if the sum of the values cannot be represented using a 64-bit integer (because it is too large)? Swift helpfully checks for an overflow and crashes if it occurs (instead of silently continuing as Java, C or C++ would). You can disable this behavior by prefixing your operators with the ampersand as in this code&hellip;
```C
var s = 0
for i in array {
    s &+= i
}
```


or this one&hellip;
```C
array.reduce(0,{$0 &+ $1})
```


These are &ldquo;unsafe&rdquo; functions in the sense that they might silently overflow. 

On my Skylake processor, the silent-overflow (&ldquo;unsafe&rdquo;) approach can be twice as fast:

technique                |clock cycles per value   |
-------------------------|-------------------------|
<tt>simple loop</tt>     |1.36                     |
<tt>reduce</tt>          |2                        |
<tt>"unsafe" simple loop (&amp;+)</tt> |0.65                     |
<tt>"unsafe" reduce (&amp;+)</tt> |1.87                     |


So between the &ldquo;safe&rdquo; reduce and the &ldquo;unsafe&rdquo; simple loop, there is a factor of 3. I consider such a difference quite significant. The &ldquo;unsafe&rdquo; simple loop has the same speed as a C function: that&rsquo;s what we want, ideally.

All these functions achieve nearly the same best performance if you disable safety checks at build time (<tt>swift build --configuration release -Xswiftc -Ounchecked</tt>). This means, in particular, that we get the fancy abstraction (the `reduce` approach) for free, as long as we disable safety checks. That makes performance a lot easier to understand.

So why the large performance difference? With regular checked arithmetic in a for loop, Swift generates add instructions (<tt>addq</tt>) followed by a condition jump (<tt>jo</tt>). Without checked arithmetic, it is able to vectorize the sum (using `paddq` instructions). (Thanks to John Regher for putting me down on this path of analysis.) To paraphrase Steve Canon, &ldquo;overflow checking itself isn&rsquo;t very expensive, but it inhibits other optimizations.&rdquo;

You might notice that I am using quotes around the terms &ldquo;safe&rdquo; and &ldquo;unsafe&rdquo;. That&rsquo;s because I do not think it is universally a good thing that software should crash when an overflow occurs. Think about the software that runs in your brain. Sometimes you experience bugs. For example, an optical illusion is a fault in your vision software. Would you want to fall dead whenever you encounter an optical illusion? That does not sound entirely reasonable, does it? Moreover, would you want this &ldquo;fall dead&rdquo; switch to make all of your brain run at half its best speed? In software terms, this means that a mission-critical application could crash because an unimportant function in a secondary routine overflows. This is not a merely hypothetical scenario: [an overflow in an unnecessary software component halted the software of the Ariane 5 rocket leading to a catastrophe](http://www.math.umn.edu/~arnold/disasters/ariane5rep.html).

[My Swift and C code is freely available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/12/05).

__Further reading__: [We Need Hardware Traps for Integer Overflow](http://blog.regehr.org/archives/1154) and [Understanding Integer Overflow in C/C++](http://www.cs.utah.edu/~regehr/papers/overflow12.pdf)

__Appendix__: Overflow checks are not unique to Swift. You can compile your C and C++ with runtime overflow checks using LLVM clang (<tt><br/>
-fsanitize=undefined</tt>) or GNU GCC (<tt><br/>
-fsanitize=signed-integer-overflow</tt>). The Rust language [checks for overflow in debug mode](http://huonw.github.io/blog/2016/04/myths-and-legends-about-integer-overflow-in-rust/) (but not in release mode). 

__Update__: A HackerNews user commented on the performance issues:

> Looking at the generated code, we have a couple issues that prevent full optimization. One of them I already knew about (https://bugs.swift.org/browse/SR-2926) &#8212; as a debugging aid, we guard every trap we emit with the equivalent of an `asm volatile(&ldquo;&rdquo;)` barrier, because LLVM will otherwise happily fold all the traps together into one trap. We really want every trap to have a distinct address so that the debugger can map that trap back to the source code that emitted it, but the asm barrier prevents other optimizations as well. As for `reduce`, it looks like the compiler does inline away the closure and turn the inner loop into what you would expect, but for some reason there&rsquo;s more pre-matter validation of the array than there is with a for loop. That&rsquo;s a bug; by all means, reduce is intended to optimize the same.


__Update 2__: Nathan Kurz ran additional tests using arrays of different sizes&hellip;
```C
$ swift build --configuration release
$ cset proc -s nohz -e .build/release/reduce

# count  (basic, reduce, unsafe basic, unsafe reduce)
1000      (0.546, 0.661, 0.197, 0.576)
10000     (0.403, 0.598, 0.169, 0.544)
100000    (0.391, 0.595, 0.194, 0.542)
1000000   (0.477, 0.663, 0.294, 0.582)
10000000  (0.507, 0.655, 0.337, 0.608)
100000000 (0.509, 0.655, 0.339, 0.608)
1000000000(0.511, 0.656, 0.345, 0.611)

$ swift build --configuration release  -Xswiftc -Ounchecked
$ cset proc -s nohz -e .build/release/reduce

# count  (basic, reduce, unsafe basic, unsafe reduce)
1000      (0.309, 0.253, 0.180, 0.226)
10000     (0.195, 0.170, 0.168, 0.170)
100000    (0.217, 0.203, 0.196, 0.201)
1000000   (0.292, 0.326, 0.299, 0.252)
10000000  (0.334, 0.337, 0.333, 0.337)
100000000 (0.339, 0.339, 0.340, 0.339)
1000000000(0.344, 0.344, 0.344, 0.344)
```


