---
date: "2018-11-17 12:00:00"
title: "Simple table size estimates and 128-bit numbers (Java Edition)"
---



Suppose that you are given a table. You know the number of rows, as well as how many distinct value each column has. For example, you know that there are two genders (in this particular table). Maybe there are 73 distinct age values. For a concrete example, take the standard [Adult data set](https://archive.ics.uci.edu/ml/datasets/adult) which is made of 48842 rows.

How many distinct entries do you expect the table to have? That is, if you remove all duplicate rows, what is the number of rows left?

There is a standard formula for this problem: Cardenas&rsquo; formula. It uses the simplistic model where there is no relationship between the distinct columns. In practice, it will tend to overestimate the number of rows. However, despite it is simplicity, it often works really well.

Let p be the product of all column cardinalities, and let n be number of rows, then the Cardenas estimate is p * (1 &#8211; (1 &#8211; 1/p)<sup>n</sup>). Simple right?

You can implement in Java easily enough&hellip;
```C
double cardenas64(long[] cards, int n) {
    double product = 1;
    for(int k = 0;  k < cards.length; k++) {
      product *= cards[k];
    }
    return product
         * (1- Math.pow(1 - 1.0/product,n));
 }
```


So let us put in the numbers&hellip; my column cardinalities are 16,16,15,5,2,94,21648,92,42,7,9,2,6,73,119; and I have 48842 rows. So what is Cardenas&rsquo; prediction?

Zero.

At least, that&rsquo;s what the Java function returns.

Why is that? The first problem is that 1 &#8211; 1/p is 1 when p is that large. And even if you could compute 1 &#8211; 1/p accurately enough, taking it to the power of 48842 is a problem.

So what do you do?

You can switch to something more accurate than double precision, that is quadruple precision (also called binary128). There is no native 128-bit floats in Java, but you can emulate them using the [BigDecimal class](https://docs.oracle.com/javase/7/docs/api/java/math/BigDecimal.html). The code gets much uglier. Elegance aside, I assumed it would be a walk in the park, but I found that the implementation of the power function was numerically unstable, so I had to roll my own (from multiplications).

The core function looks like this&hellip;
```C
double cardenas128(long[] cards, int n) {
    BigDecimal product = product(cards);
    BigDecimal oneover = BigDecimal.ONE.divide(product,
       MathContext.DECIMAL128);
    BigDecimal proba = BigDecimal.ONE.subtract(oneover,
    MathContext.DECIMAL128);
    proba = lemirepower(proba,n);
    return product.subtract(
       product.multiply(proba, MathContext.DECIMAL128),
        MathContext.DECIMAL128).doubleValue();
    }
```


It scales up to billions of rows and up to products of cardinalities that do not fit in any of Java&rsquo;s native type. Though the computation involves fancy data types, it is probably more than fast enough for most applications.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2018/11/16).

__Update__: You can avoid 128-bit numbers by using the log1p(x) and expm1(x) functions; they compute log(x + 1) and exp(x) &#8211; 1 in a numerically stable manner. The updated code is as follow:
```C
 double cardenas64(long[] cards, int n) {
  double product = 1;
  for(int k = 0;  k < cards.length; k++) {
    product *= cards[k];
  }
  return product *
    -Math.expm1(Math.log1p(-1.0/product) * n);
}
```


(Credit: Harold Aptroot)

