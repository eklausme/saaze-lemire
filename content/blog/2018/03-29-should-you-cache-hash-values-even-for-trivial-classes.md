---
date: "2018-03-29 12:00:00"
title: "Should you cache hash values even for trivial classes?"
---



Hash tables are a fundamental data structure in computing, used to implement maps and sets. In software, we use hash values to determine where objects are located within hash tables.

In my [previous blog post](/lemire/blog/2018/03/28/when-accessing-hash-tables-how-much-time-is-spent-computing-the-hash-functions/), I showed that the bulk of the running time when checking values in a hash table could be taken up by the computation of the hash values themselves. I got some pushback because I implemented an array of three integers as a Java <tt>ArrayList&lt;Integer></tt>. This seems fair to me but there are obviously more efficient ways to represent three integers in Java.

So I decided to do as suggested, and use a trivial class:
```C
class Triple {
  int x;
  int y;
  int z;

  public Triple(int mx, int my, int mz) {
    x = mx;
    y = my;
    z = my;
  }

  public int hashCode() {
    return x + 31 * y + 31 * 31 * z;
  }
}
```


I also implemented a version with precomputed hash values:
```C
class BufferedTriple {
  int x;
  int y;
  int z;
  int hashcode;

  public BufferedTriple(int mx, int my, int mz) {
    x = mx;
    y = my;
    z = my;
    hashcode =  x + 31 * y + 31 * 31 * z;
  }

  public int hashCode() {
    return hashcode;
  }
}
```


Given these two classes, I create large hash tables (10 million entries) and I check 100 different target keys.

So is the class with the cached hash value faster? Yes, it is about 25% faster:

Triple                   |BufferedTriple           |
-------------------------|-------------------------|
0.4 us                   |0.3 us                   |


[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/03/29).

I should add that Java&rsquo;s hash tables re-hash the hash values that we provide, so the benefits of the cached hash value are less than they could be.

Moreover, Strings have cached hash values by default in Java. I&rsquo;m definitively not the first to notice that caching hash values can be valuable.

I should add that this was not the point that I wanted to make in my original blog post. I do not particularly care whether you cache your hash values. The point I wanted to make is that even something as cheap as the computation of a hash value can be a limiting factor, even when you have lots of data in RAM.

__Further reading__: [For greater speed, try batching your out-of-cache data accesses](/lemire/blog/2018/04/12/for-greater-speed-try-batching-your-out-of-cache-data-accesses/)

