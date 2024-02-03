---
date: "2016-05-23 12:00:00"
title: "The surprising cleverness of modern compilers"
---



I wanted to know how a modern C compiler like clang would process the following C code:
```C
#include <stdint.h>
int count(uint64_t x) {
  int v = 0;
  while(x != 0) {
    x &= x - 1;
    v++;
  }
  return v;
}
```


Can you guess?
```C
popcntq	%rdi, %rax
```


That is right. A fairly sophisticated C function, one that might puzzle many naive programmers compiles down to a single instruction. (Tested with <tt>clang 3.8</tt> using <tt>-O3 -march=native</tt> on a recent x64 processor.)

What does that mean? It means that C is a high-level language. It is not &ldquo;down to the metal&rdquo;. It might have been back when compilers were happy to just translate C into correct binary code&hellip; but these days are gone. One consequence of the cleverness of our compilers is that it gets hard to benchmark &ldquo;algorithms&rdquo;.

In any case, it is another example of externalized intelligence. Most people, most psychologists, assume that intelligence is what happens in our brain. We test people&rsquo;s intelligence in room, disconnected from the Internet, with only a pencil. But my tools should get as much or even more credit than my brain for most of my achievements. Left alone in a room with a pencil, I&rsquo;d be a mediocre programmer, a mediocre scientist. I&rsquo;d be no programmer at all. And this is good news. It is hard to expand or repair the brain, but we have a knack for building better tools.

