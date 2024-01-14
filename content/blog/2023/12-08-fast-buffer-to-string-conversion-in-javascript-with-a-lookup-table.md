---
date: "2023-12-08 12:00:00"
title: "Fast Buffer-to-String conversion in JavaScript with a Lookup Table"
---



When programming in a JavaScript environment such as Node.js, you might recover raw data from the network and need to convert the bytes into strings. In a system such as Node.js, you may represent such raw bytes using a Buffer instance.

You can conveniently convert a Buffer instance into a JavaScript (<tt>mybuffer.toString()</tt>). But, maybe surprisingly, creating new strings can be a bottleneck. Thus a worthwhile optimization might be to try to recognize that your incoming bytes are one out of a list of known strings. This is not a problem unique to JavaScript.

One example of such a problem occurs when parsing HTTP headers. These headers contain common strings such as  &lsquo;accept&rsquo;, &lsquo;accept-encoding&rsquo;, &lsquo;content-encoding&rsquo;, &lsquo;content-language&rsquo;, &lsquo;content-length&rsquo;, &lsquo;from&rsquo;, &lsquo;host&rsquo;, etc. If we can recognize the bytes as one of these strings, we can just point at the existing strings. To make things more complicated, we might want to ignore the case, so that both inputs &lsquo;Accept&rsquo; and &lsquo;ACCEPT&rsquo; should be mapped to accept&rsquo;.

[This problem has been addressed recently in a library called undici](https://github.com/nodejs/undici/pull/2501). This library provides Node.js with an HTTP/1.1 client. GitHub user `tsctx` initially proposed solving this problem using a trie implemented with JavaScript objects. A trie is a type of data structure that is used to store and search for strings in an efficient way. In its simplest implementation (sometimes called a digital search tries), we first branch out on the first character, and each possible character becomes a new tree based on the second character and so forth. The last node of each string is marked as the end of the word, and may also store some additional information, such as a point to a desired output. The problem with such an approach is that it can use much memory. And, indeed, I estimated that <tt>tsctx</tt>&lsquo;s implementation might cost between 1 MB to 2 MB of memory. Whether that is a concern depends on your priorities. Following my comments, user `tsctx` opted for a new strategy that may be less time efficient, but that is significantly more economical memory-wise: a ternary. A ternary tree is similar to a binary tree, but each node can have up to three children, usually called left, mid, and right.

I think that <tt>tsctx</tt>&lsquo;s is excellent, but it is sometimes important to compare with a few competitors.

I decided to implement my own approach based the observation that it is fairly easy to quickly identify a candidate using solely the length of the input. For example, there is only one candidate string of length 2: &lsquo;TE&rsquo;. So it makes sense to write code like this:
```JavaScript
function toLowerCase(s) {
 var len = s.length;
  switch (len) {
   case 2:
    // check that the buffer is equal to te and return it if so
    if ((s[0] == 116 || s[0] == 84) && (s[1] == 101 || s[1] == 69)) {
     return "te";
    }

```


This code is a function that takes a string as an input and returns a lowercased version of it. The function works as follows: It declares a variable called len and assigns it the value of the length of the input string s. It uses a switch statement to check the value of len and execute different code blocks depending on the case.<br/>
In this example, the function only has one case, which is 2. In the case of 2, the function checks that the input string is equal to &ldquo;te&rdquo; or &ldquo;TE&rdquo; or &ldquo;Te&rdquo; or &ldquo;tE&rdquo;. It does this by comparing the ASCII codes of the characters in the string. The ASCII code of t is 116, the ASCII code of T is 84, the ASCII code of e is 101, and the ASCII code of E is 69. The function uses the logical operators || (or) and &amp;&amp; (and) to combine the conditions. If the input string matches any of these four combinations, the function will return &ldquo;te&rdquo;. Here is an example of how the function works: If the input string is &ldquo;te&rdquo;, the function will return &ldquo;te&rdquo;. If the input string is &ldquo;TE&rdquo;, the function will return &ldquo;te&rdquo;. If the input string is &ldquo;Te&rdquo;, the function will return &ldquo;te&rdquo;. If the input string is &ldquo;tE&rdquo;, the function will return &ldquo;te&rdquo;. If the input string is &ldquo;ta&rdquo;, the function will continue.

If the buffer has length 3, then I have four possible candidate strings (age, ect, rtt, via). I can differentiate them by looking only at the first character. The logic is much the same:
```JavaScript
case 3:
  switch (s[0]) {
   case 97: case 65:
    // check that the buffer is equal to age and return it if so
    if ((s[1] == 103 || s[1] == 71) && (s[2] == 101 || s[2] == 69)) {
      return "age";
    }
    break;
   case 101:case 69:
    // check that the buffer is equal to ect and return it if so
    if ((s[1] == 99 || s[1] == 67) && (s[2] == 116 || s[2] == 84)) {
     return "ect";
    }
    break;
   case 114:case 82:
    // check that the buffer is equal to rtt and return it if so
    if ((s[1] == 116 || s[1] == 84) && (s[2] == 116 || s[2] == 84)) {
      return "rtt";
    }
    break;
   case 118:case 86:
    // check that the buffer is equal to via and return it if so
    if ((s[1] == 105 || s[1] == 73) && (s[2] == 97 || s[2] == 65)) {
     return "via";
    }
    break;
   default:
    break;
   }

```


It is easy enough to do it by hand, but it gets tedious, so I wrote a little Python script. It is not complicated&hellip; I just repeat the same logic in a loop.

Pay attention to the fact that the switch key is made of nearly continuous integers from 2 to 35&hellip; It means that a good compiler will almost surely use a jump table and not a series of comparisons.

First let us compare the memory usage of the four approaches: the original (simple) code used by undici, the [naive switch-case approach](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2023/12/07/switch.js), the ternary tree and the digital search trie. I use various recent versions of Node.js on a Linux server. I wrote scripts that simply include the function, and only the function, and I print the memory usage. I repeat five times and report the lowest figure. When using Node.js, I call the garbage collector and pause to try to minimize the memory usage.

&nbsp;                   |Node.js 21               |Node.js 20               |Node.js 19               |Bun 1.0                  |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
original                 |43.3 MB                  |42.4 MB                  |44.9 MB                  |20.2 MB                  |
naive switch             |43.3 MB                  |42.9 MB                  |42.9 MB                  |23.8 MB                  |
ternary tree             |43.5 MB                  |44.2 MB                  |45.2 MB                  |29.3 MB                  |
digital search trie      |45.1 MB                  |44.6 MB                  |47.0 MB                  |26.7 MB                  |


Thus only the digital search trie appears to bring a substantial memory usage with Node.js 21. If you use a different version of Node.js or a different operating system, results will differ&hellip; but I verified that the conclusion is the same on my macBook.

What about performance? I use an Intel Ice Lake processor running at 3.2 GHz. I wrote a small benchmark that parses a few headers. I rely on a well-known JavaScript benchmark framework (mitata).

&nbsp;                   |Node.js 21               |Node.js 20               |Node.js 19               |Bun 1.0                  |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
original                 |15 µs                   |14 µs                   |15 µs                   |12 µs                   |
naive switch             |7.8 µs                  |7.9 µs                  |7.8 µs                  |8.2 µs                  |
ternary tree             |9.4 µs                  |9.4 µs                  |9.0 µs                  |8.8 µs                  |
digital search trie      |12 µs                   |12 µs                   |11 µs                   |10 µs                   |


I am not quite certain why the digital search trie does poorly in this case. I also ran the same experiment on my 2022 macBook (Apple M2 processor). I am usually against benchmarking on laptops, but these macBooks tend to give very stable numbers.

&nbsp;                   |Node.js 21               |Node.js 20               |Node.js 19               |Bun 1.0                  |
-------------------------|-------------------------|-------------------------|-------------------------|-------------------------|
original                 |8.5 µs                  |9.1 µs                  |8.5 µs                  |8.2 µs                  |
naive switch             |5.0 µs                  |4.9 µs                  |4.7 µs                  |5.3 µs                  |
ternary tree             |5.8 µs                  |5.8 µs                  |5.6 µs                  |6.1 µs                  |
digital search trie      |5.3 µs                  |5.5 µs                  |5.4 µs                  |5.5 µs                  |


Thus I would conclude that both the naive switch and the ternary tree are consistently faster than the original. The original implementation is about 1.8 times slower than the naive switch when using Node.js 21.

One approach I did not try is [perfect hashing](/lemire/blog/2023/07/14/recognizing-string-prefixes-with-simd-instructions/). I am concerned that it might be difficult to pull off because JavaScript might not compile the code efficiently. One benefit of perfect hashing is that it can be nearly branchless so it provides consistent performance. We could use the perfect hashing strategy with the switch case approach: we would have just one hash computation, and then we would end up straight to single buffer-to-target comparison. It would like a C/C++ implementation in spirit, although it would generate more code.

We rely on the fact that this function was identified as a bottleneck. We ran a microbenchmark, but it would be useful to see whether these functions make a difference in a realistic application.

[My source code and benchmark is online](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/12/07). It can be improved, pull requests invited.

