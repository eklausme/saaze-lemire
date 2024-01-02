---
date: "2021-04-22 12:00:00"
title: "Some useful regular expressions for programmers"
---



In my blog post, [My programming setup](/lemire/blog/2021/04/04/my-programming-setup/), I stressed how important regular expressions are to my programming activities.

Regular expressions can look intimidating and outright ugly. However, they should not be underestimated.

Someone asked for examples of regular expressions that I rely upon. Here a few.

1. It is commonly considered a <em>faux pas</em> to include &lsquo;trailing white space&rsquo; in code. That is, your lines should end with the line-return control characters and nothing else. In a regular expression, the end of the string (or line) is marked by the &lsquo;$&rsquo; symbol, and a white-space can be indicated with &lsquo;\s&rsquo;, and a sequence of one or more white space is &lsquo;\s+&rsquo;. Thus if I search for &lsquo;<tt>\s+$</tt>&lsquo;, I will locate all offending lines.
1. It is often best to avoid non-ASCII characters in source code. Indeed, in some cases, there is no standard way to tell the compiler about your character encoding, so non-ASCII might trigger problems. To check all non-ASCII characters, you may do <tt>[^\x00-\x7F]</tt>.
1. Sometimes you insert too many spaces between a variable or an operator. Multiple spaces are fine at the start of a line, since they can be used for indentation, but other repeated spaces are usually in error. You can check for them with the expression <tt>\b\s{2,}</tt>. The <tt>\b</tt> indicate a word boundary.
1. I use spaces to indent my code, but I always use an even number of spaces (2, 4, 8, etc.). Yet I might get it wrong and insert an odd number of spaces in some places. To detect these cases, I use the expression <tt>^(\s\s)*\s[^\s]</tt>. To delete the extra space, I can select it with look-ahead and look-behind expressions such as <tt>(?&lt;=^(\s\s)*)\s(?=[^\s])</tt>.
1. I do not want a space after the opening parenthesis nor before the closing parenthesis. I can check for such a case with <tt>(\(\s|\s\))</tt>. If I want to remove the spaces, I can detect them with a look-behind expression such as <tt>(?&lt;=\()\s</tt>.
1. Suppose that I want to identify all instances of a variable, I can search for <tt>\bmyname\b</tt>. By using word boundaries, I ensure that I do not catch instances of the string inside other functions or variable names. Similarly, if I want to select all variable that end with some expression, I can do it with an expression like <tt>\b\w*myname\b</tt>.


The great thing with regular expressions is how widely applicable they are.

Many of my examples have to do with code reformatting. Some people wonder why I do not simply use code reformatters. I do use such tools all of the time, but they are not always a good option. If you are going to work with other people who have other preferences regarding code formatting, you do not want to trigger hundreds of formatting changes just to contribute a new function. It is a major <em>faux pas</em> to do so. Hence you often need to keep your reformatting in check.

