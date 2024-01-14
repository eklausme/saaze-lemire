---
date: "2017-01-30 12:00:00"
title: "Maps and sets can have quadratic-time performance"
---



Swift is a new programming language launched by Apple slightly over two years ago. Like C and C++, it offers ahead-of-time compilation to native code but with many new modern features. It is available on Linux and macOS.

Like C++, Swift comes complete with its own data structures like dictionaries (key-value or associative maps) and sets. It seems that Apple is simply reusing its Objective-C data structures.

How do you implement dictionaries and sets? We typically use sets. The general idea is simple:

- We map values to &ldquo;random&rdquo; integers, a process called hashing. We call the random integer a &ldquo;hash value&rdquo;. The key fact is that whenever we have identical values, they should generate the same hash value. This is usually achieved using a funny-looking function that is carefully crafted to generate numbers that look random.
- We store the values at the location indicated by the hash value.


This latter step is critical. At high level you can just build a large array and store the values with hash value `x` at index <tt>x</tt>. This does not quite work because different values might share the same hash value. You get &ldquo;collisions&rdquo;.

How do we resolve this problem? There are two popular techniques. One of them is called chaining. In effect, at each location in the big array, we have a pointer to a container where the values are actually stored. This is called chaining. Many popular languages use chaining (Java, Go&hellip;). The theory of chaining is simple and the implementation is not difficult.

In Swift, they use linear probing. Linear probing is also simple to implement: if you try to store a value at an occupied slot, you just move to the next available slot. When you seek a value, you start from the index indicated by the hash value, and move forward until you either find your value or an empty slot.

Suppose that you want to insert a new element, and you get a collision. With chaining, this means that you need to append a value to a container (typically an array). Before you do so, you need to check whether your value is already present in the container&hellip; This means that if you repeatedly insert to the same container, you will have quadratic-time complexity. That is, it gets very slow very fast. You have to be quite unlucky for this to happen.
Things get somewhat worse with linear probing. In linear probing, not only can you collide with values that have the same hash value, but you also tend to collide with other values to have nearby hash values! This means that the performance of linear probing can be quite a bit worse than the performance of chaining, in the worst case.

In several languages, such as PHP and JavaScript, maps preserve the &ldquo;insertion order&rdquo; which means that when iterating through the values stored, you do so in the order in which they were inserted. So if you first inserted a key having to do with &ldquo;John&rdquo; and then one having to do with &ldquo;Mary&rdquo;, the map will remember and default in this order. However, Swift does not appear to keep track of the insertion order by default. This creates a performance trap.

Let me illustrate it with code. Suppose that I have a set that stores all values between 1 and some large number. My point does not rely on the data taking this exact form, but it is the simplest example I could think of&hellip; (It does not matter that I am using integers!)
```C
var d = Set<Int>()
for i in 1...size {
  d.insert(i)
}
```


Next, maybe I have another set with a few values in it&hellip;
```C
var dcopy = Set<Int>()
dcopy.insert(1000)
```


&hellip; and then I want to dump all of the big set into the small set like so&hellip;
```C
for i in d {
    dcopy.insert(i)
}
```


Ah! You have fallen into a performance trap!

You think: &ldquo;Surely not! I was taught that insertion in a hash table takes constant time&hellip;&rdquo; To this, I object that you were taught no such thing. Or, rather, that you failed to read the small prints!

Basically, in both instances, I am building a hash table starting from nothing. The only difference is the order in which I build the hash table. It turns out that the order in which you insert elements matters.

Let us look at the number. Let us start with a small set made of a million elements&hellip; I time the results on my laptop&hellip;

- Build time: 130 ns/element
- Reinsertion: 670 ns/element


Ok. So reinserting the data from the big set to the small set takes 5 times longer. &ldquo;No big deal&rdquo;, you think, &ldquo;I have CPU cycles to spare.&rdquo;

Let us grow the set a bit more, to 16 million elements:
- Build time: 180 ns/element
- Reinsertion: 3400 ns/element


You see where I am going with this? Roughly speaking, the reinsertion time has quadratic complexity where the build time has linear complexity.

We can run a simulation and count the number of collisions generated on average using either a random insertion, or an adversarial insertion as illustrated by my code example. When we do so, we observe that the number of collisions grows very fast in the adversarial setting.

<a href="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/01/30/gnuplot/data.png?raw=true"><img decoding="async" src="https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/01/30/gnuplot/data.png?raw=true" style="width:50%" /></a>

So the performance issue can be explained entirely due to the fast rising number of collisions with adversarial insertions on larger and larger sets.

Where does the problem come from? When we resize the hash table, we have to reinsert the values into a larger array. Normally, the values would spread out nicely, but our adversarial insertion order is not at all random, and it facilitates expensive collisions.

(As Tim points out in the comments, you can get around this problem by creating Sets having a large capacity. Or you can use a different data structure.)

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/01/30/linearprobing).

__Further reading__: [Rust hash iteration+reinsertion](https://accidentallyquadratic.tumblr.com/post/153545455987/rust-hash-iteration-reinsertion) (same problem as I describe, but in Rust)

