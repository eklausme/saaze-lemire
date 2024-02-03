---
date: "2017-05-09 12:00:00"
title: "Signed integer division by a power of two can be expensive!"
---



Remember when you learned the long division algorithm in school? It was painful, right?

It turns out that even on modern processors, divisions are expensive. So optimizing compilers try to avoid them whenever possible. An easy case is the division by a power of two. If a compiler sees <tt>x / 2</tt> when `x` is an unsigned integer then it knows that it can simply &ldquo;shift&rdquo; the bits of the variable `x` by 1 because data is represented in binary. A shift is a relatively inexpensive operation: it completes in a single CPU cycle on most processors&hellip;

Some programmers cannot resist and they will write <tt>x >> 1</tt> instead of <tt>x / 2</tt>. That&rsquo;s mostly wasted time, however. Optimizing compilers can be counted to be smart enough to figure it out.

What if `x` is a signed integer? Sadly, [a simple shift is no longer sufficient and several instructions must be used](http://stackoverflow.com/questions/39691817/divide-a-signed-integer-by-a-power-of-2). Most compilers seem to generate about 4 to 5 instructions. Some versions of the Intel compiler generate three separate shifts.

This means that, some of the time, if we use <tt>x >> 1</tt> (or <tt>x >>> 1</tt> in Java) instead of <tt>x / 2</tt>, we might get a different performance even if the actual value stored in `x` is positive.

We might think that it is no big deal. It is still going to be super fast, right?

Let us consider a generally useful algorithm: the binary search. It finds the location of a value in a sorted array. At the core of the algorithm is the need to divide a length by two repeatedly. Looking at Java&rsquo;s source code, we find how the Java engineers implemented the binary search in the standard library:
```C
public static int BinarySearch(int[] array, int ikey) {
    int low = 0;
    int high = array.length - 1;
    while (low <= high) {
        final int middleIndex = (low + high) >>> 1;
        final int middleValue = array[middleIndex];

        if (middleValue < ikey)
            low = middleIndex + 1;
        else if (middleValue > ikey)
            high = middleIndex - 1;
        else
            return middleIndex;
    }
    return -(low + 1);
}
```


Notice the shift? Let us rewrite the function with an integer division instead:
```C
public static int BinarySearch(int[] array, int ikey) {
    int low = 0;
    int high = array.length - 1;
    while (low <= high) {
        final int middleIndex = (low + high) / 2;
        final int middleValue = array[middleIndex];

        if (middleValue < ikey)
            low = middleIndex + 1;
        else if (middleValue > ikey)
            high = middleIndex - 1;
        else
            return middleIndex;
    }
    return -(low + 1);
}
```


It is nearly the same function. You may expect that it will have nearly the same performance.

Maybe surprisingly, that&rsquo;s not true at all.

[I wrote a little Java benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/05/09). It shows that the version with integer division runs at 2/3 the speed of the version with a shift. That&rsquo;s a severe performance penalty.

The result is not specific to Java, [it also holds in C](https://github.com/RoaringBitmap/CRoaring/issues/98#issuecomment-299071374).

The lesson?

When working with signed integer, do not assume that the compiler will turn divisions by powers of twos into code that nearly as efficiently as a single shift.

__Credit__: The observation is based on work by Owen Kaser.

