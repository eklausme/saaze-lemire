---
date: "2008-08-12 12:00:00"
title: "Cool software design insight #3"
---



In a comment to my [unit testing post](/lemire/blog/2008/08/03/cool-software-design-insight-2/), David suggested using property testing. Languages like Java, C and C++ have formalized this very idea as [assert instructions](https://en.wikipedia.org/wiki/Assert). Other languages have the equivalent under different names. You can also manually implement asserts by throwing exceptions or logging errors and warnings.

My experience has been that __you should use asserts relatively generously in your code__ for the following reasons:

- While some fancy tools allow you to run through a program in debug mode and check the values of the variables, asserts help you fix bugs happening remotely.- Asserts are a great way to document your code. They tell the reader about your expectations.


However, asserts are not as useful as unit testing. Whereas you can write thousands of tests to test your software, adding thousands of asserts to your software may be a bad idea. It makes the code less readable and slower.

