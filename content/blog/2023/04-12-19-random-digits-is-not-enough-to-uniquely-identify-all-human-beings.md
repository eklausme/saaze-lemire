---
date: "2023-04-12 12:00:00"
title: "19 random digits is not enough to uniquely identify all human beings"
---



Suppose that you assigned everyone a 19-digit number. What is the probability that two human beings would have the same number? [It is an instance of the Birthday&rsquo;s paradox](/lemire/blog/2019/12/12/are-64-bit-random-identifiers-free-from-collision/).

Assuming that there are 8 billion people, the probability that at least two of them end up with the same number is given by the following table:

digits                   |probability              |
-------------------------|-------------------------|
18                       |99.9%                    |
19                       |96%                      |
20                       |27%                      |
21                       |3%                       |
22                       |0.3%                     |
23                       |0.03%                    |
24                       |0.003%                   |
25                       |0.0003%                  |


If you want the probability to be effectively zero, you should use 30 digits or so.

