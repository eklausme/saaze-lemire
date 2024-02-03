---
date: "2022-07-08 12:00:00"
title: "Go generics are not bad"
---



When programming, we often need to write &lsquo;generic&rsquo; functions where the exact data type is not important. For example, you might want to write a simple function that sums up numbers.

Go lacked this notion until recently, but it was recently added (as of version 1.18). So I took it out for a spin.

In Java, generics work well enough as long as you need &ldquo;generic&rdquo; containers (arrays, maps), and as long as stick with functional idioms. But Java will not let me code the way I would prefer. Here is how I would write a function that sums up numbers:
```Go
    int sum(int[] v) {
        int summer = 0;
        for(int k = 0; k < v.length; k++) {
            summer += v[k];
        }
        return summer;
    }
```


What if I need to support various number types? Then I would like to write the following generic function, but Java won&rsquo;t let me because Java generics only work with classes not primitive types.
```Go
    // this Java code won't compile
    static <T extends Number>  T sum(T[] v) {
        T summer = 0;
        for(int k = 0; k < v.length; k++) {
            summer += v[k];
        }
        return summer;
    }
```


Go is not object oriented per se, so you do not have a &lsquo;Number&rsquo; class. However, you can create your own generic &lsquo;interfaces&rsquo; which serves the same function. So here is how you solve the same problem in Go:
```Go
type Number interface {
  uint | int | float32 | float64
}


func sum[T Number](a []T) T{
    var summer T
    for _, v := range(a) {
        summer += v
    }
   return summer
}

```


So, at least in this one instance, Go generics are more expressive than Java generics. What about performance?

If I apply the above code to an array of integers, I get the following tight loop in assembly:
```Go
pc11:
        MOVQ    (AX)(DX*8), SI
        INCQ    DX
        ADDQ    SI, CX
        CMPQ    BX, DX
        JGT     pc11
```



As far as Go is concerned, this is as efficient as it gets.

So far, I am giving an A to Go generics.

