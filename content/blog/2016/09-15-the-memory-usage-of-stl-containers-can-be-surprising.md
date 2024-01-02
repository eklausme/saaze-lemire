---
date: "2016-09-15 12:00:00"
title: "The memory usage of STL containers can be surprising"
---



C++ remains one of the most popular languages today. One of the benefits of C++ is the built-in STL containers offering the standard data structures like vector, list, map, set. They are clean, well tested and well documented. 

If all you do is program in C++ all day, you might take STL for granted, but more recent languages like Go or JavaScript do not have anything close to STL built-in. The fact that every C++ compiler comes with a decent set of STL containers is just very convenient.

STL containers have a few downsides. Getting the [very best performance out of them](/lemire/blog/2012/06/20/do-not-waste-time-with-stl-vectors/) can be tricky in part because they introduce so much abstraction.

Another potential problem with them is their memory usage. This is a &ldquo;silent&rdquo; problem that will only affect you some of the time, but when it does, it may come as a complete surprise.

I was giving a talk once to a group of developers, and we were joking about the memory usage of modern data structures. I was telling the audience that using close to 32 bits per 32-bit value stored in a container was pretty good sometimes. The organizer joked that one should not be surprised to use 32 bytes per 32-bit integer in Java. Actually, I don&rsquo;t think the organizer was joking&hellip; he was being serious&hellip; but the audience thought he was joking.

[I wrote a blog post showing that each &ldquo;Integer&rdquo; in Java stored in an array uses 20 bytes](/lemire/blog/2015/10/15/on-the-memory-usage-of-maps-in-java/) and that each entry in an Integer-Integer map could use 80 bytes. 

Java is sometimes ridiculous in its memory usage. C++ is better, thankfully. But it is still not nearly as economical as you might expect.

I wrote a [small test](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2016/09/15/stlsizeof.cpp). Results will vary depending on your compiler, standard library, the size of the container, and so forth&hellip; You should run your own tests&hellip; Still, here are some numbers I got on my Mac:

<td colspan="2">Storage cost in bytes per 32-bit entry |

STL container            |Storage                  |
<tt>std::vector</tt>     |4                        |
<tt>std::deque</tt>      |8                        |
<tt>std::list</tt>       |24                       |
<tt>std::set</tt>        |32                       |
<tt>std::unordered_set</tt> |36                       |


(My Linux box gives slightly different numbers but the conclusion is the same.)

So there is no surprise regarding <tt>std::vector</tt>. It uses 4 bytes to store each 4 byte elements. It is very efficient.

However, both <tt>std::set</tt> and <tt>std::unordered_set</tt> use nearly an order of magnitude more memory than would be strictly necessary.

The problem with the level of abstraction offered by C++ is that you can be completly unaware of how much memory you are using.

