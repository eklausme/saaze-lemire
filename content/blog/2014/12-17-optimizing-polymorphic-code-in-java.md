---
date: "2014-12-17 12:00:00"
title: "Optimizing polymorphic code in Java"
---



Oracle&rsquo;s Java is a fast language&hellip; sometimes just as fast as C++. In Java, we commonly use [polymorphism](https://en.wikipedia.org/wiki/Polymorphism_(computer_science)) through interfaces, inheritance or wrapper classes to make our software more flexible. Unfortunately, when [polymorphism](https://en.wikipedia.org/wiki/Polymorphism_(computer_science)) is involved with lots of function calls, Java&rsquo;s performance can go bad. Part of the problem is that Java is shy about fully inlining code, even when it would be entirely safe to do so. (Though this problem might be alleviated in the latest Java revisions, see my update at the end of this blog post.)

Consider the case where we want to abstract out integer arrays with an interface:
```C

public interface Array {
    public int get(int i);
    public void set(int i, int x);
    public int size();
}
```


Why would you want to do that? Maybe because your data can be in a database, on a network, on disk or in some other data structure. You want to write your code once, and not have to worry about how the array is implemented.
 It is not difficult to produce a class that is effectively equivalent to a standard Java array, except that it implements this interface:
```C

public final class NaiveArray implements Array {
    protected int[] array;
    
    public NaiveArray(int cap) {
        array = new int[cap];
    }
    
    public int get(int i) {
        return array[i];
    }
    
    public void set(int i, int x) {
        array[i] = x;  
    }
    
    public int size() {
        return array.length;
    }
}
```


At least in theory, this NaiveArray class should not cause any performance problem. The class is final, all methods are short.

Unfortunately, on a [simple benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/12/17/Benchmark.java), you should expect NaiveArray to be over 5 times slower than a standard array when used as an Array instance, as in this example:
```C

public int compute() {
   for(int k = 0; k < array.size(); ++k) 
      array.set(k,k);
   int sum = 0;
   for(int k = 0; k < array.size(); ++k) 
      sum += array.get(k);
   return sum;
}
```


You can alleviate the problem somewhat by [using NaiveArray as an instance of NaiveArray](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2014/12/17/FixedSummer.java) (avoiding polymorphism). Unfortunately, the result is still going to be more than 3 times slower, and you just lost the benefit of polymorphism.

So how do you force Java to inline function calls?

A viable workaround is to inline the functions by hand. You can to use the keyword instanceof to provide optimized implementations, falling back on a (slower) generic implementation otherwise. For example, if you use the following code, NaiveArray does become just as fast as a standard array:
```C

public int compute() {
     if(array instanceof NaiveArray) {
        int[] back = ((NaiveArray) array).array;
        for(int k = 0; k < back.length; ++k) 
           back[k] = k;
        int sum = 0;
        for(int k = 0; k < back.length; ++k) 
           sum += back[k];
        return sum;
     }
     //...
}
```


Of course, I also introduce a maintenance problem as the same algorithm needs to be implemented more than once&hellip; but when performance matters, this is an acceptable alternative.
As usual, my benchmarking code is [available online](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2014/12/17).

To summarize:

- Some Java versions may fail to fully inline frequent function calls even when it could and should. This can become a serious performance problem.
- Declaring classes as final does not seem to alleviate the problem.
- A viable workaround for expensive functions is to optimize the polymorphic code by hand, inlining the function calls yourself. Using the instanceof keyword, you can write code for specific classes and, thus, preserve the flexibility of polymorphism.


__Update__

Erich Schubert ran [a similar benchmark](http://www.vitavonni.de/blog/201412/2014122201-java-sum-of-array-comparisons.html) with double arrays that appeared to contradict my results. In effect, he sees no difference between the various implementations. I was able to confirm his results by updating to the very latest OpenJDK revision. The next table gives the number of nanoseconds required to process 10 million integers:

&nbsp;Function&nbsp;     |&nbsp;Oracle JDK 8u11&nbsp; |&nbsp;OpenJDK 1.8.0_40&nbsp; |&nbsp;OpenJDK 1.7.0_65&nbsp; |
-------------------------|-------------------------|-------------------------|-------------------------|
straight arrays          |0.92                     |0.71                     |0.87                     |
with interface           |5.9                      |0.70                     |6.3                      |
with manual inlining     |0.98                     |0.71                     |0.93                     |


As one can sees, the latest OpenJDK is much smarter and makes the performance overhead of polymorphism go away (1.8.0_40). If you are lucky enough to be using this JDK, you do not need to worry about the problems of this blog post. However, the general idea is still worthwhile become in more complicated scenarios, the JDK might still fail to give you the performance you expect.

