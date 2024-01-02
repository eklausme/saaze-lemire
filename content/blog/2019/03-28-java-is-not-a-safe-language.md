---
date: "2019-03-28 12:00:00"
title: "Java is not a safe language"
---



The prime directive in programming is to write correct code. Some programming languages make it easy to achieve this objective. We can qualify these languages as &lsquo;safe&rsquo;.

If you write in C++ without good tools, you are definitively in the &lsquo;unsafe&rsquo; camp. The people working on the Rust programming language are trying to build a &lsquo;safe language&rsquo;.

Where does Java lie?

Back when Java was still emerging, I had been tasked with building a new image compression library. I designed a dual Java/C++ library. My client was a company providing medical services, but they had no use for the Java code. To this day, I think that they only use the C++ code.

When I tried to sell them a license to the Java code, I stressed that Java was safer, had automatic memory management and the like. Their top engineer looked at my Java code and spotted a potential memory leak. Yes, [Java has memory leaks](https://stackoverflow.com/a/6548647). You may have been told that it does not happen, but it happens all the time in real systems. We had a beer and a good laugh about it. Meanwhile, he had been able to prove that my C++ code was safe and did not have memory leaks.

In any case, most people would agree that Java is &lsquo;safer&rsquo; than C++, but as my story illustrates, it is more of a statistical statement than a black-and-white one.

Is Java a safe language in 2019?

It is a time-dependent culturally-loaded question, but I do not think of Java as a safe language today. If &lsquo;safety&rsquo; is your primary concern, then you have better options.

Let me review some examples:

1. Java does not trap overflows. That is, if you are trying to count how many human beings there are on Earth using a Java &lsquo;int&rsquo;, incrementing the counter by one each time, the counter will overflow silently and give you a nonsensical result. Languages like Rust and Swift catch overflow. The Java standard library has some functions to guard against overflows, but they are not part of the language. As a related issue, Java promotes and convert types silently and implicitly. Can you guess what the following code will print out?
```C
short x = Short.MAX_VALUE;
short y = 2;
System.out.println(x+y);
int ix = Integer.MAX_VALUE;
int iy = 2;
System.out.println(ix+iy);
```


This type of behaviour leads to hard-to-catch bugs.
1. Java allows data races, that is, it is possible in Java to have several threads accessing the same object in memory at the same &lsquo;time&rsquo; with one thread writing to the memory location. Languages like Rust do not allow data races. Almost anyone who has programmed non-trivial Java programs has caused or had to debug a data race. It is a real problem.
1. Java lacks null safety. When a function receives an object, this object might be null. That is, if you see &lsquo;String s&rsquo; in your code, you often have no way of knowing whether &lsquo;s&rsquo; contains an actually String unless you check at runtime. Can you guess whether programmers always check? They do not, of course, In practice, mission-critical software does crash without warning due to null values. We have two decades of examples. In Swift or Kotlin, you have safe calls or optionals as part of the language. Starting with Java 8, you have Optional objects in the standard library, but they are an afterthought.
1. Java lacks named arguments. Given a function that takes two integer values, you have to write &lsquo;f(1,2)&rsquo;. But is it instead &lsquo;f(2,1)&rsquo;? How do you know that you got the parameters in the right order? Getting confused in the argument order is a cause of hard-to-debug problems. Many modern programming languages have named arguments.


Ultimately, I believe that while some programming languages make it easier to produce correct code than others, much of it comes down to good engineering practices. I would never go as far as saying that programming languages do not matter, but I bet that &lsquo;who&rsquo; writes the software is a lot more important.

