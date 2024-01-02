---
date: "2018-09-30 12:00:00"
title: "Quickly identifying a sequence of digits in a string of characters"
---



Suppose that you want to quickly determine a sequence of eight characters are made of digits (e.g., &lsquo;9434324134&rsquo;). How fast can you go?

In software, characters are mapped to integer values called the code points. The ASCII and UTF-8 code points for the digits 0, 1,&hellip;, 9 are the consecutive integers 0x30, 0x31, &hellip;, 0x39 in hexadecimal notation. 

Thus you can check whether a character is a digit by comparing with 0x30 and 0x39: <span style="color:#808030; ">(</span><span style="color:#808030; ">(</span>c <span style="color:#808030; ">&lt;</span> <span style="color:#008000; ">0x30</span><span style="color:#808030; ">)</span> <span style="color:#808030; ">|</span><span style="color:#808030; ">|</span> <span style="color:#808030; ">(</span>c <span style="color:#808030; ">></span> <span style="color:#008000; ">0x39</span><span style="color:#808030; ">)</span><span style="color:#808030; ">)</span>. It is even cheaper than it looks because optimizing compilers simply take the code point, subtract 0x30 from it and compare the result with 9. So there is a single comparison!

Given a stream of characters, the conventional approach in C or C-like language is to loop over the sequence of characters and check that each one is a digit.
```C
bool is_made_of_eight_digits(unsigned char * chars) {
    for(size_t j = 0; j < 8; j++) {
          if((chars[j] < 0x30) || (chars[j] > 0x39)) {
              return false;
          }
    }
    return true;
}
```


Can we do better? Instead of doing eight comparisons (one per character), we would like to do only one or two. For this, we can use [SIMD within a register (SWAR)](https://en.wikipedia.org/wiki/SWAR): load the eight characters into a 64-bit integer and do some operations on the result integers.

Here is a simple &ldquo;branchless&rdquo; approach first&hellip; it does a single comparison:
```C
bool is_made_of_eight_digits_branchless(const unsigned char  * chars) {
    uint64_t val;
    memcpy(&val, chars, 8);
    return ( val & (val + 0x0606060606060606) &0xF0F0F0F0F0F0F0F0) 
             == 0x3030303030303030;
}
```


(Credit: Travis Downs simplified and improved the version I had.)

In some instances, it might be faster to do two comparisons instead of one, especially if the results are predictible.
```C
bool is_made_of_eight_digits_branchy(unsigned char  * chars) {
    uint64_t val;
    memcpy(&val, chars, 8);
    return (( val & 0xF0F0F0F0F0F0F0F0 ) == 0x3030303030303030)
      && (( (val + 0x0606060606060606) & 0xF0F0F0F0F0F0F0F0 )
      == 0x3030303030303030); 
}
```


How do they work? One the one hand, they check that the most significant 4 bits of each character is the value 0x3. Once this is done, you know that the characters value must range in 0x30 to 0x3F, but you want to exclude the values from 0x3a to 0x3f. If you add 0x06 to the integers from 0x30 to 0x39 you get the integers 0x36 to 0x3f, but adding 0x06 to 03a gives you 0x40. So you can add 0x06 to each byte and check again that the most significant 4 bits of each character is the value 0x3. 

It is crazily hard to benchmark such routines because their performance is highly sensitive to the data inputs. You really want to benchmark them on your actual data. And compilers matter a lot. Still, we can throw some synthetic data at it and see how well they fare (on a skylake processor). 

compiler                 |conventional             |SWAR 1 comparison        |SWAR 2 comparisons       |
-------------------------|-------------------------|-------------------------|-------------------------|
gcc 8 (-O2)              |11.4 cycles              |3.1 cycles               |2.5 cycles               |
gcc 8 (-O3)              |5.2 cycles               |3.1 cycles               |3 cycles                 |
clang 6 (-O2)            |5.3 cycles               |2.4 cycles               |2.2 cycles               |
clang 6 (-O3)            |5.3 cycles               |2.4 cycles               |2.1 cycles               |


The table reports the average time (throughput) to check that a sequence of eight characters is made of digits. In my tests, the branchless approach is not the fastest. Yet it might be a good bet in practice because it is going to run at the same speed, irrespective of the data.

Let us some consider less regular data where the processors cannot easily guess the result of the comparisons:

compiler                 |conventional             |SWAR 1 comparison        |SWAR 2 comparisons       |
-------------------------|-------------------------|-------------------------|-------------------------|
gcc 8 (-O2)              |12.1 cycles              |3.1 cycles               |5.2 cycles               |
gcc 8 (-O3)              |7.2 cycles               |3.1 cycles               |5.1 cycles               |
clang 6 (-O2)            |7.3 cycles               |2.4 cycles               |4.3 cycles               |
clang 6 (-O3)            |7.1 cycles               |2.4 cycles               |4.5 cycles               |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/09/30).

__Further reading__. After working on this problem a bit, and finding a workable approach, I went on the Internet to check whether someone had done better, and I found an article by my friend [Wojciech MuÅ‚a who has an article on the exact same problem](http://0x80.pl/articles/swar-digits-validate.html). It is a small world. His approach is similar although he has no equivalent to my single-comparison function. 

