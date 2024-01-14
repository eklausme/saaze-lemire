---
date: "2018-10-16 12:00:00"
title: "Validating UTF-8 bytes (Java edition)"
---



Strings are just made of bytes. We send and receive bytes over the network all the time. If you know that the bytes you are receiving form a string, then chances are good that it is encoded as UTF-8. Sadly not all streams of bytes can be valid UTF-8 strings. Thus you should check that your bytes can be safely parsed as strings.

In earlier work, [I showed that you needed as little as 0.7 cycles per byte to do just that validation](/lemire/blog/2018/05/16/validating-utf-8-strings-using-as-little-as-0-7-cycles-per-byte/). That was in C using fancy instructions.

What about Java?

Designing a good benchmark is difficult. I keep things simple. I generate 1002-byte UTF-8 string made of random (non-ASCII) characters. Then I try to check how quickly different functions validate it.

Here are the contenders:

1. You can use the standard Java API to entirely decode the bytes, and report false when there is an error:
```C
CharsetDecoder decoder = 
  StandardCharsets.UTF_8.newDecoder();
try {
  decoder.decode(
       ByteBuffer.wrap(mydata));		           
} catch (CharacterCodingException ex) {		        
      return false;
} 
return true;
```

1. [You can try a branchless finite-state-machine approach](http://bjoern.hoehrmann.de/utf-8/decoder/dfa/):
```C
boolean isUTF8(byte[] b) {
    int length = b.length;
    int s = 0;
    for (int i = 0; i < length; i++) {
      s = utf8d_transition[
             (s + (utf8d_toclass[b[i] & 0xFF])) 
             & 0xFF];
    }
    return s == 0;
}
```


&hellip; where `utf8d_transition` and `utf8d_toclass` are some arrays where the finite-state machine is coded.
1. Finally, you can use the `isWellFormed` from the Guava library. It simply tries to find the first non-ASCII character and then it engages into what is a straight-forward series of if/then/else.


Here are the timings in nanoseconds per 1002-byte strings. I estimate that my processor runs at about 3.4 GHz on average during the test (verified with <tt>perf</tt>).

Java API                 |6.7 cycles per byte      |
-------------------------|-------------------------|
branchless               |6.0 cycles per byte      |
Guava&rsquo;s if/then/else |2.6 cycles per byte      |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/10/16).

The most obvious limitation in my benchmark is that Guava&rsquo;s if/then/else approach is sensitive to branch mispredictions while my benchmark might not be rich enough to trigger difficult-to-predict branches.
__Credit__: The finite-state-machine code was improved by Travis Downs, shaving 1.5 cycles per byte.
__Update__: Travis Downs has shown that, indeed, Guava&rsquo;s approach is much worse than my benchmark implies. The reason it does so well is that the processor learns to predict all branches perfectly well. If you increase the size of the string, or if you use many more strings, then its performance becomes worse. Meanwhile, the finite-state machine can be accelerated by processing the strings in two halves, effectively doubling the processing speed. Yet the Guava might still be the right choice in practice because when you expect the input to be mostly just ASCII characters, it will do well.

