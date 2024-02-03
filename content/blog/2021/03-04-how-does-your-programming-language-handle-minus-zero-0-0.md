---
date: "2021-03-04 12:00:00"
title: "How does your programming language handle &#8220;minus zero&#8221; (-0.0)?"
---



The ubiquitous IEEE floating-point standard defines two numbers to represent zero, the positive and the negative zeros. You also have the positive and negative infinity. If you compute the inverse of the positive zero, you get the positive infinity. If you compute the inverse of the negative zero, you get the negative infinity.

It seems that programming languages handle these values in vastly different ways.

Though the C++ standard probably says very little about negative zeros, in practice I am getting the results I would expect. In C++ (GNU GCC and LLVM clang), the following code prints out (-inf, inf, -inf) :
```C
double minus_zero = -0.0;
double plus_zero = +0.0;
double parsed = strtod("-0.0", nullptr);
std::cout <<  1.0/minus_zero << std::endl;
std::cout <<  1.0/plus_zero << std::endl;
std::cout <<  1.0/parsed << std::endl;
```


Java also produces what I expect (-Infinity, Infinity, -Infinity) from the following code sample:
```C
double minus_zero = -0.0;
double plus_zero = +0.0;
double parsed = Double.valueOf("-0.0");
System.out.println(1/minus_zero);
System.out.println(1/plus_zero);
System.out.println(1/parsed);
```


Swift also seems to do what I expect (-inf, inf, -inf) :
```C
var minus_zero = -0.0
var plus_zero = +0.0
var parsed = Double("-0.0")!
print(1/minus_zero)
print(1/plus_zero)
print(1/parsed)
```


The Go programming language seems to be unaware of negative zeros when parsing literal constants. Thus the following code will print out +Inf, +Inf.
```C
var minus_zero = -0.0
var plus_zero = 0.0
fmt.Println(1/minus_zero)
fmt.Println(1/plus_zero)
```


C# is aware of negative infinity, but when parsing strings the behaviour depends on your version. With .NET 5, the following code prints out what I expect (-infinity, infinity, -infinity) but with previous versions you may get -infinity, infinity, infinity.
```C
double minus_zero = -0.0;
double plus_zero = +0.0;
double parsed = Double.Parse("-0.0");
Console.WriteLine(1/minus_zero);
Console.WriteLine(1/plus_zero);
Console.WriteLine(1/parsed);
```


