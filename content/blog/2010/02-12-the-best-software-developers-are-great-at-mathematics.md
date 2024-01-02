---
date: "2010-02-12 12:00:00"
title: "The best software developers are great at Mathematics?"
---



One of the upsides of working for a university are the stimulating academic discussions. Yesterday, a philosopher challenged me a question:

> Beyond the fact that software is expressed in Mathematics artefacts (bits, algorithms), __are Information Systems fundamentally Mathematical__?


For my convenience, I temporarily rephrase the question to something simpler and more concrete:

> __How are Software Developers limited by their mathematical weaknesses?__


I plan several blog posts around this question, but let me start with an example.

A common and powerful language to process XML is [XPath](https://en.wikipedia.org/wiki/XPath). XPath is used within web applications, scripts, databases, and so on. I often ask students the following question about XPath. Are these two expressions equivalent?

> <tt>$x="some string"</tt>


and

> <tt>not($x!="some string")</tt>.


(The symbol &ldquo;<tt>!=</tt>&rdquo; means &ldquo;different from&rdquo;.)

Invariably, most students conclude that they are equivalent. __Wrong!__

Let us examine the semantics.

- The expression <tt>$x="some string"</tt> means that at least one element of <tt>$x</tt> is equal to <tt>"some string"</tt>.
- The expression <tt>$x!="some string"</tt> means that some element of <tt>$x</tt> is different from <tt>"some string"</tt>.
- The __negation__ of <tt>$x!="some string"</tt> is that all elements of <tt>$x</tt> are equal to <tt>"some string"</tt>. (Sorry if it sounds confusing.)


Thus, the expression <tt>not($x!="some string")</tt> is a  more restrictive condition than the expression <tt>$x="some string"</tt>.

Great software developers routinely think through far more complex mathematical problems. Yet, they do not think of them as being Mathematics.

