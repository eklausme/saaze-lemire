---
date: "2017-10-31 12:00:00"
title: "Synthesized hash functions in Swift 4.1 (and why Java programmers should be envious)"
---



When programming, we often rely on maps from keys to values. This is most often implemented using a [hash table](https://en.wikipedia.org/wiki/Hash_table), which implies that our keys must be &ldquo;hashable&rdquo;. That is, there must be a function from key objects to hash values. A hash value is a &ldquo;random-looking integer&rdquo; that is determined by the object value. Thus a given string (e.g., &ldquo;232&rdquo;) should always have the same hash value within a given context (typically within the program&rsquo;s life). It should be &ldquo;random&rdquo; in the sense that it should be improbable that any two distinct keys have the same hash value (e.g., &ldquo;232&rdquo; and &ldquo;231&rdquo; should not hash to the same integer).

In many programming languages like Java and C++, you are expected to implement and design your own hash functions when coming up with your own classes or structs. In Java, if you do not provide a hash function (by overriding the `hashCode` function), then you inherit some `hashCode` function which is tied to the particular object instance. That&rsquo;s problematic. Let me illustrate the problem. Suppose I create my own user identifier class:
```C
public class UserID {
  int x;
  public UserID(int X) {x = X;}
}
```


That sounds reasonable, right?

Let me store some information corresponding to one such user identifier:
```C
HashMap<UserID,String> h = new HashMap<UserID,String>();
h.put(new UserID(32321),"Your name is John");
```


What happens if I try to retrieve it?
```C
System.out.println(h.get(new UserID(32321)));
```


Most likely, this will give a <tt>null</tt>, as in &ldquo;we don&rsquo;t have such a user identifier&rdquo;.

So you have to remember to override `hashCode` properly or risk having buggy software. Annoying.

It is especially annoying because most people do not know how to design a hash function! You are lucky if you got a single class in college on the topic.

Swift, the new programming language designed by Apple is in the same boat. It is slightly better in that it will not generate a potentially misleading hash function by default. For your class or struct to be &ldquo;hashable&rdquo;, you need to provide a hash function.

However, [Swift 4.1 fixes this annoyance](https://github.com/apple/swift-evolution/blob/master/proposals/0185-synthesize-equatable-hashable.md) by generating sensible default hash functions. These hash functions are probably not perfect but they are likely better than whatever bored programmers can conjure up.

Swift 4.1 has not yet been released, so I suppose the details could change, but here is the gist of it. Suppose that you define your own class:
```C
struct Point:Hashable {
     var x : Int
     var y : Int
     public init(_ x:Int,_ y:Int) {
         self.x = x
         self.y = y
     }
 }
```


Notice that I declared that it is &ldquo;Hashable&rdquo; but I did not provide any hash-function implementation. On current Swift (e.g., Swift 4.0), this will not compile, but if you get early builds of Swift 4.1, it will work fine.

So what does it do? Well, the Swift compiler looks at the values stored in your class and struct, and it automagically hashes them together.

A point worth noting: the hash value only depends on the values being stored. So suppose you create a new class called `MyPoint` (instead of <tt>Point</tt>):
```C
struct MyPoint:Hashable {
     var x : Int
     var y : Int
     public init(_ x:Int,_ y:Int) {
         self.x = x
         self.y = y
     }
 }
```


It will hash in the same manner so you can be sure that the following is always true:
```C
Point(1,2).hashValue == MyPoint(1,2).hashValue
```


How does it compute the hash? It takes the hash value of each value in the struct or class (let me assume that they are hashable themselves) and it combines them using the function <tt>_mixForSynthesizedHashValue</tt>. This mysterious function could change but for the time being, it is just the following linear polynomial in simplified code:
```C
function _mixForSynthesizedHashValue(x,y) {
  return 31 * x + y
}
```


It often called a compression function because it takes two values, and combines them into a single one (we go from two times 64 bits to 64 bits). For more &ldquo;randomness&rdquo;, the Swift compiler uses a `_mixInt` function which takes a 64-bit value and returns another 64-bit value with the &ldquo;bits mixed&rdquo; (it is just a function that appears to generate random outputs). Thus the following should print the same value twice:
```C
print(Point(1,1).hashValue);
print(_mixInt(_mixForSynthesizedHashValue(1,1)))
```


What if you have more than two values in your struct or class? Let me consider a tridimensional point:
```C
struct Point3D:Hashable {
     var x : Int
     var y : Int
     var z : Int
     public init(_ x:Int,_ y:Int, _ z:Int) {
         self.x = x
         self.y = y
         self.z = z
     }
 }
```


Then the result is similar except that we need to call the compression function twice, so that the following two lines will print the same value:
```C
print(Point3D(32,45,66).hashValue);
print(_mixInt(_mixForSynthesizedHashValue(
  _mixForSynthesizedHashValue(32,45),66)))
```


I alluded to the fact that these automatically generated hash functions might not be perfect&hellip; In the current implementation, we get that tridimensional points can trivially collide with bidimensional points, the following being always true:
```C
Point3D(0,32,45).hashValue == Point(32,45).hashValue
```


If this ends up being a problem for your application, you can always roll out your own hash functions, of course.

I did not elaborate on the <tt>_mixInt</tt>, but one nice thing that I noticed in the Swift&rsquo;s source code is that they are planning for it to be randomized, that is, you will not get the same hash value for the same object or struct instance for every run of your project. This is an important security feature which [I alluded to in an older blog post](/lemire/blog/2012/01/17/use-random-hashing-if-you-care-about-security/).

Indeed, the problem with the current implementation is that I can trivially construct lots of values that will collide (have the same hash value), thus rendering the performance of hash tables and other algorithms quite bad. So it is good to randomize the hash functions by default, to make the job of an attacker more difficult.

__Further reading__: If you are interested in the science of hashing, you might like the following papers&hellip;

- Ivanchykhin et al., [Regular and almost universal hashing: an efficient implementation](https://arxiv.org/abs/1609.09840), Software: Practice and Experience
- Lemire and Kaser, [Faster 64-bit universal hashing using carry-less multiplications](https://arxiv.org/abs/1503.03465), Journal of Cryptographic Engineering
- Kaser and Lemire, [Strongly universal string hashing is fast](https://arxiv.org/abs/1202.4961), Computer Journal
- Lemire, [The universality of iterated hashing over variable-length strings](https://arxiv.org/abs/1008.1715), Discrete Applied Mathematics
- Lemire and Kaser, [Recursive n-gram hashing is pairwise independent, at best](https://arxiv.org/abs/0705.4676), Computer Speech &amp; Language


__Note about cryptography__:<br/>
There is a whole different field called cryptographic hashing which seeks to map values to hash values in such a way that it is very difficult for you to ever guess what the original value was given the hash value and such that it is very hard to create a key that maps to a specific hash value. For example, passwords can be hashed so that if I only give you the hash value, you would need to work for years to find the matching password. Yet, as a system, it is enough for me to just store the hash value. But for what Swift does, this type of security is irrelevant because you are not trying to hide the information being stored, you are just trying to ensure that it is processed quickly.

