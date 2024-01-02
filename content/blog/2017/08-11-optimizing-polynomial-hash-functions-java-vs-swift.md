---
date: "2017-08-11 12:00:00"
title: "Optimizing polynomial hash functions (Java vs. Swift)"
---



In software, hash functions are ubiquitous. They map arbitrary pieces of data (strings, arrays, &hellip;) to fixed-length integers. They are the key ingredient of hash tables which are how we most commonly implement maps between keys and values (e.g., between someone&rsquo;s name and someone&rsquo;s phone number).

A couple of years ago, I pointed out that you could almost [double the speed of the default hash functions in Java](/lemire/blog/2015/10/22/faster-hashing-without-effort/) with a tiny bit of effort. I find it remarkable that you can double the performance of standard ubiquitous functions so easily. 

[Richard Startin showed that this remains true today with Java 9](http://richardstartin.uk/still-true-in-java-9-handwritten-hash-codes-are-faster/). I used String hashing as an example, Richard makes the same demonstration using the <tt>Arrays.hashCode</tt> function, but the idea is the same.

You might object that, maybe, the performance of hash functions is irrelevant. That might be true for your application, but it gives you a hint as to how much you can speed up your software by tweaking your code.

In any case, I decided to used to experiment as a comparison point with Apple&rsquo;s Swift language. Swift is the default language when building iOS applications whereas Java is the default language when building Android applications&hellip; and, in this sense, they are competitors.

I am not, for example, trying to determine whether Swift is better than Java. This sort of question is meaningless. However, I am trying to gain some perspective on the problem.

Whereas Java offers <tt>Arrays.hashCode</tt> as a way to hash arrays, I believe that Swift flat out abstains from helping. If you need to hash arrays, you have to roll your own function.

So let us write something in Swift that is equivalent to Java, a simple polynomial hash function:
```C
func simpleHash(_ array : [Int]) -> Int {
  var hash = 0
  for x in array {
    hash = hash &* 31 &+ x
  }
  return hash
}
```


There are ampersands everywhere because Swift crashes on overflows. So if you have a 64-bit system and you write <tt>(1&lt;&lt;63)*2</tt>, then your program halts. This is viewed as being safer. You need to prefix your operators with the ampersand to keep the code running.

We can &ldquo;unroll&rdquo; the loop, that is process the data in blocks of four&nbsp;values. You can expect larger blocks to provide faster performance, albeit with diminishing returns. 

Of course, if you are working with tiny arrays, this optimization is useless, but in such cases, you probably do not care too much about the performance of the hash function.

The code looks a bit more complicated, but what we have done is not sophisticated:
```C
func unrolledHash(_ array : [Int]) -> Int {
  var hash = 0
  let l = array.count/4*4
  for i in stride(from:0,to:l,by:4) {
    hash = hash &* 31  &* 31  &* 31  &* 31  
           &+ array[i]  &* 31  &* 31  &* 31 
           &+ array[i + 1]  &* 31  &* 31    
           &+ array[i + 2]  &* 31  
           &+ array[i + 3]
  }
  for i in stride(from:l,to:array.count,by:1) {
      hash = hash &* 31 &+ array[i]
  }
  return hash
}
```


I have designed a little benchmark that hash a large array using Swift 3.0. I run it on a Linux box with a recent processor (Intel Skylake) running at 3.4 GHz. Like in the Java experiments, the unrolled hash function is nearly twice as fast:

simple hash              |0.9 ns/element           |
-------------------------|-------------------------|
unrolled hash            |0.5 ns/element           |


In the unrolled case, we are using about 1.7 CPU cycles per element value, against 3 CPU cycles in the simple case.

Swift 4.0 is around the corner and I tried running the benchmark with a pre-release version of Swift 4.0, but the performance difference remained.

[As usual, my code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/08/11/swift). It should run under Linux and macOS. It might possibly run under Windows if you are the adventurous type.

So, at a glance, Swift does not differ too much from Java: the relative performance gap between hand-tuned hash functions and naive hash functions is the same.

Obviously, it might be interesting to extend these investigations beyond Java and Swift. My current guess is that the gap will mostly remain. That is, I conjecture that while some optimizing compilers will be able to unroll the loop, none of them will do as well as the simple manual unrolling. In effect, I conjecture Java and Swift are not being particularly dumb.

