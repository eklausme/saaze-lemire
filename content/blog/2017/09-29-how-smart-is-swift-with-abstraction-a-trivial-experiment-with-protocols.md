---
date: "2017-09-29 12:00:00"
title: "How smart is Swift with abstraction? A trivial experiment with protocols"
---



Apple&rsquo;s Swift programming language has the notion of &ldquo;protocol&rdquo; which is similar to an interface in Java or Go. So we can define a protocol that has a single function.
```C
public protocol Getter {
 func get(_ index : Int) -> Int
}
```


We need to define at least one class that has the prescribed &ldquo;get&rdquo; method. For good measure, I will define two of them.
```C
public final class Trivial1 : Getter {
  public func get(_ index : Int) -> Int {
    return 1
  }
}
```

```C
public final class Trivial7 : Getter {
  public func get(_ index : Int) -> Int {
    return 7
  }
}
```


If you are familiar with Java, this should look very familiar.

Then we can define functions that operate on the new protocol. Let us sum 100 values:
```C
public func sum(_ g : Getter) -> Int {
  var s = 0
  for i in 1...100 {
     s += g.get(i)
  }
  return s
}
```


Clearly, there are possible optimizations with the simple implementations I have designed. Is Swift smart enough?

Let us put it to the test:
```C
public func sum17(_ g1 : Trivial1, _ g7 : Trivial7) 
            -> Int {
  return sum(g1) + sum(g7)
}
```


This compiles down to```C

  mov eax, 800
```


That is, Swift is smart enough to figure out, at a compile time, the answer.

To be clear, this is exactly what you want to happen. Anything less would be disappointing. This is no better than C and C++.

Still, we should never take anything for granted as programmers.

What is nice, also, is that you can [verify this answer with a trivial script](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/09/29):
```C

wget https://raw.githubusercontent.com/lemire/SwiftDisas/master/swiftdisas.py
swiftc -O prot.swift
python swiftdisas.py prot sum17
```


Compared to Java where code disassembly requires praying for the gods under a full moon, this is really nice.

