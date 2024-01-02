---
date: "2008-09-06 12:00:00"
title: "Cool software design insight #5"
---



OO helps us hide away the routine problems and the makes the code easier to use. Among the first things you learn with class-based object-oriented (OO) languages like Java and C++ is how to use inheritance. Inheritance is a form of [taxonomy](https://en.wikipedia.org/wiki/Taxonomy) for programmers. It makes great-looking diagrams. Pedagogically, it makes [type polymorphism](https://en.wikipedia.org/wiki/Type_polymorphism) easy to understand.

However, I will tell you a little secret: __cool programmers do not use inheritance__, except maybe to derive new classes from the standard classes provided by the language. Inheritance tends to make code more difficult to maintain. In some cases, inheritance makes software slower.

The better alternatives are:
<dl>
<dt>C++ :</dt>
<dd>Use templates, they are both faster and easier to maintain than class inheritance.</dd>
<dt>Java :</dt>
<dd>Use interfaces. Java interfaces are a bit annoying to maintain, but they do not contribute any bugs.</dd>
<dt>Python, Ruby, Objective-C, Perl, JavaScript/ECMAScript :</dt>
<dd>Use [duck typing](https://en.wikipedia.org/wiki/Duck_typing).</dd>
</dl>

