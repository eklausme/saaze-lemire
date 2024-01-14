---
date: "2018-04-04 12:00:00"
title: "Caching hash values for speed (Swift-language edition)"
---



In my posts [Should you cache hash values even for trivial classes?](/lemire/blog/2018/03/29/should-you-cache-hash-values-even-for-trivial-classes/) and [When accessing hash tables, how much time is spent computing the hash functions?](/lemire/blog/2018/03/28/when-accessing-hash-tables-how-much-time-is-spent-computing-the-hash-functions/), I showed that caching hash values could accelerate operations over hash tables, sets and maps&hellip; even when the hash tables do not fit in CPU cache.
To be clear, I do not mean to say that it is necessarily the computation of the hash values that is the bottleneck, however the whole computation, including the latency of the operations, slows you down more than you would think, even when dealing with out-of-cache data structures.

In my earlier posts, I used the Java programming language. Java already relies on precomputed hash values in its standard library. Indeed, Java strings have precomputed hash values.

It is always prudent to check observations using different programming languages. So I decided to reproduce a similar test using the Swift programming language.
I create a trivial class containing three integer values just like I did in Java:
```C
class Triple :  Hashable, Equatable {
      let x, y, z : Int
      init(x: Int, y:Int, z:Int) {
        self.x = x
        self.y = y
        self.z = z
      }
      final var hashValue: Int {
          return x + 31 &* y + 961 &* z
      }
}
```


Then I recreate a slightly different version where the value of the hash value is precomputed:
```C
class BufferedTriple :  Hashable, Equatable {
      let x, y, z : Int
      private let hash : Int
      init(x: Int, y:Int, z:Int) {
        self.x = x
        self.y = y
        self.z = z
        hash =  x + 31 &* y + 961 &* z
      }
      final var hashValue: Int {
          return hash
      }
}
```


My benchmark involves creating a large set of these points, and checking how many of 100 other points are in this set. The code is simple:
```C
for i in a {
          if bs.contains(i) {
            counter += 1
          }
}
```


I ran this benchmark using Linux, Swift 4.1 and a Skylake processor. Roughly speaking, in my tests, the buffered version (that precomputes the hash values) is about twice as fast:

Triple                   |BufferedTriple           |
-------------------------|-------------------------|
20 us                    |12 us                    |


But maybe it takes much longer creating BufferedTriple instances? In fact, no. It takes about 1.5 us to construct the 100 instances, whether they are Triple and BufferedTriple. It takes slightly more time to construct the BufferedTriple instances but the difference is less than 0.2 us.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/04/04).

My point is not that you should always or often precompute hash values. There are obvious downsides to this memoization approach even if it did not stop the Java engineers from doing it for all strings. Consider this instead: if you think that when working with large, out-of-cache, data structures, computational speed is not important, your mental model of software performance is incomplete.

__Further reading__: [For greater speed, try batching your out-of-cache data accesses](/lemire/blog/2018/04/12/for-greater-speed-try-batching-your-out-of-cache-data-accesses/)
