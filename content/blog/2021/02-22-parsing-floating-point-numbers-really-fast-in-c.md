---
date: "2021-02-22 12:00:00"
title: "Parsing floating-point numbers really fast in C#"
---



Programmers often write out numbers as strings (e.g., 3.1416) and they want to read back the numbers from the string. If you read and write JSON or CSV files, you do this work all of the time.

Previously, we showed that [we could parse floating-point numbers at a gigabyte per second or better in C++](/lemire/blog/2021/01/29/number-parsing-at-a-gigabyte-per-second/) and in Rust, several times faster than the conventional approach. [In Go 1.16, our approach improved parsing performance by up to a factor of two](https://golang.org/doc/go1.16).

Not everyone programs in C++, Rust or Go. So what about porting the approach to C#? [csFastFloat](https://github.com/CarlVerret/csFastFloat) is the result!

For testing, we rely on two standard datasets, canada and mesh. The mesh dataset is made of &ldquo;easy cases&rdquo; whereas the canada dataset is more difficult. We use .NET 5 and an AMD Rome processor for testing.

parser                   |canada                   |mesh                     |
-------------------------|-------------------------|-------------------------|
<tt>Double.Parse</tt> (standard) |3 million floats/s       |11 million floats/s      |
[csFastFloat](https://github.com/CarlVerret/csFastFloat) (new) |20 million floats/s      |35 million floats/s      |


Importantly, the new approach should give the same exact results. That is, we are accurate.

Can this help in the real world? I believe that the most popular CSV (comma-separate-values) parsing library in C# is probably CSVHelper. We patched CSVHelper so that it would use csFastFloat instead of the standard library. Out of a set of five float-intensive benchmarks, we found gains ranging from 2x to 8%. Your mileage will vary depending on your data and your application, but you should see some benefits. 

Why would you see only an 8% gain some of the time? Because, in that particular case, only about 15% of the total running time has to do with number parsing. The more you optimize the parsing in general, the more benefit you should get out of fast float parsing.

[The package is available on nuget](https://www.nuget.org/packages/csFastFloat/).

__Credit__: The primary author is Carl Verret. We would like to thank Egor Bogatov from Microsoft who helped us improve the speed, changing only a few lines of code, by making use of his deep knowledge of C#.

