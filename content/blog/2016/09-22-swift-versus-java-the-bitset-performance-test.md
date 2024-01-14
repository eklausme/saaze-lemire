---
date: "2016-09-22 12:00:00"
title: "Swift versus Java : the bitset performance test"
---



I claimed online that the performance of Apple&rsquo;s Swift was not yet on par with Java. People asked me to back my claim with numbers.

I decided to construct one test based on bitsets. A bitset is a fast data structure to implement sets of integers.
Java comes with its own bitset class called <tt>java.util.BitSet</tt>. [I wrote three tests for it](https://github.com/lemire/microbenchmarks/blob/master/src/main/java/me/lemire/microbenchmarks/bitset/Bitset.java): the time it takes to add a million integers in sequence to a bitset, the time it takes to count how many integers are present in the bitset, and the time it takes to iterate through the integers.

Here are the results in Java :```C
git clone https://github.com/lemire/microbenchmarks.git
cd microbenchmarks
mvn clean install
java -cp target/microbenchmarks-0.0.1-jar-with-dependencies.jar me.lemire.microbenchmarks.bitset.Bitset

Benchmark Mode Samples Score Error Units
m.l.m.b.Bitset.construct avgt 5 0.008 ± 0.002 s/op
m.l.m.b.Bitset.count avgt 5 0.001 ± 0.000 s/op
m.l.m.b.Bitset.iterate avgt 5 0.005 ± 0.001 s/op
```


So all tests take at most a few milliseconds. Good.

Next [I did my best to reproduce the same tests in Swift](https://github.com/lemire/SwiftBitset/blob/master/Tests/BitsetTests/BitsetTests.swift):
```C
git clone https://github.com/lemire/SwiftBitset.git
cd SwiftBitset

swift test -Xswiftc -Ounchecked -s BitsetTests.BitsetTests/testAddPerformance
Test Case '-[BitsetTests.BitsetTests testAddPerformance]' measured [Time, seconds] average: 0.019

swift test  -Xswiftc -Ounchecked -s BitsetTests.BitsetTests/testCountPerformance
Test Case '-[BitsetTests.BitsetTests testCountPerformance]' measured [Time, seconds] average: 0.004

swift test  -Xswiftc -Ounchecked  -s BitsetTests.BitsetTests/testIteratorPerformance
Test Case '-[BitsetTests.BitsetTests testIteratorPerformance]' measured [Time, seconds] average: 0.010
```


These tests are rough. I got these numbers of my laptop, without even trying to keep various noise factors in check. Notice however that I disable bound checking in Swift, but not in Java, thus giving something of an unfair advantage to Swift.

But as is evident, [SwiftBitset](https://github.com/lemire/SwiftBitset) can be 2 times slower than Java&rsquo;s BitSet. Not a small difference.

[SwiftBitset](https://github.com/lemire/SwiftBitset) is brand new whereas Java&rsquo;s BitSet underwent thorough review over the years. It is likely that [SwiftBitset](https://github.com/lemire/SwiftBitset) leaves at least some performance on the table. So we could probably close some of the performance gap with better code.

Nevertheless, it does not make me hopeful regarding Swift&rsquo;s performance compared to Java, at least for the type of work I care about. But Swift hopefully uses less memory which might be important on mobile devices.

Some people seem to claim that Swift gives iOS an advantage over android and its use of Java. I&rsquo;d like to see the numbers.

__Update__. I decided to add a [Go benchmark](https://github.com/willf/bitset) and a [C benchmark](https://github.com/lemire/cbitset/blob/master/benchmarks/lemirebenchmark.c). Here are my results:

language                 |create                   |count                    |iterate                  |
-------------------------|-------------------------|-------------------------|-------------------------|
Java&rsquo;s BitSet      |8 ms                     |1 ms                     |5 ms                     |
[C&rsquo;s cbitset](https://github.com/lemire/cbitset) |11 ms                    |0 ms                     |4 ms                     |
[SwiftBitset](https://github.com/lemire/SwiftBitset) |19 ms                    |4 ms                     |10 ms                    |
[Go&rsquo;s bitset](https://github.com/willf/bitset) |18 ms                    |3 ms                     |13 ms                    |


It might seem surprising to some, but Java can be a fast language. (The C implementation suffers from my Mac&rsquo;s poor &ldquo;malloc&rdquo; performance. Results would be vastly different under Linux.)

Note that the release 1.9 of Go improves performance substantially.

