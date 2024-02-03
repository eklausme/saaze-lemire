---
date: "2017-08-31 12:00:00"
title: "Parsing comma-separated integers in Java"
---



We often encounter lists of integers (e.g., &ldquo;1,2,3,10,1000&rdquo;) stored in strings. Parsing these strings for the integer values can become a performance bottleneck if you have to scan thousands of those strings.

The standard Java approach is to use the Scanner class, as follows:
```C
Scanner sc = new Scanner(input).useDelimiter(",");
ArrayList<Integer> al = new ArrayList<Integer>();
while (sc.hasNextInt()) {
    al.add(sc.nextInt());
}
```


Another sensible approach is to use the String.split method:
```C
String[] p = input.split(",");
 int[] ans = new int[p.length];
 for (int i = 0; i < p.length; i++) {
    ans[i] = Integer.parseInt(p[i]);
 }
```


Which is fastest? I tested with a string made of 2048 random integers. My results indicate that splitting the strings is much faster:

Scanner                  |800 ops/s                |
-------------------------|-------------------------|
Split                    |8000 ops/s               |


It is pathetic. If all my machine had to do was serve requests to split strings of 2048 integers, it would top at 800 queries per second when using the Scanner method.

Is this the best you can do? Not by a long shot. I threw together a manual solution that is twice as fast as the split method described above. But that, itself, is probably not even close to being optimal. My guess is that it ought to be possible to be at least 10 times faster than the Split method. And it is entirely possible that I am being pessimistic.

[My code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2017/08/31).

