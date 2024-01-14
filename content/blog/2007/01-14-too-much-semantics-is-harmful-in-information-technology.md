---
date: "2007-01-14 12:00:00"
title: "Too Much Semantics is Harmful in Information Technology"
---



It has become evident that, in the realm of Web Services, the [REST paradigm](https://en.wikipedia.org/wiki/REST) is taking over while the [Service-oriented Architecture Protocol](https://en.wikipedia.org/wiki/Service-oriented_architecture) (SOAP) is progressively being forgotten except in some academic circles and by some companies interested in selling tools to alleviate the pain<sup>[1](#too1)</sup>.
Here is what [Clay Shirky was saying in 2001](http://webservices.xml.com/pub/a/ws/2001/10/03/webservices.html?page=2#wsdluddi):

>This attempt to define the problem at successively higher layers is doomed to fail because it&rsquo;s turtles all the way up: there will always be another layer above whatever can be described, a layer which contains the ambiguity of two-party communication that can never be entirely defined away.

 No matter how carefully a language is described, the range of askable questions and offerable answers make it impossible to create an ontology that&rsquo;s at once rich enough to express even a large subset of possible interests while also being restricted enough to ensure interoperability between any two arbitrary parties.

 The sad fact is that communicating anything more complicated than inches-to-millimeters, in a data space less fixed than stock quotes, will require AI of the sort that&rsquo;s been 10 years away for the past 50 years.



The main reason being put forward is that SOAP is simply too complex. But does complexity means here? The Web is something incredibly complex if you consider how many parts it has, yet, we consider it to be simple.

How to recognize a simple technology? The first criteria any engineer would use is the number of points of failures. SOAP architectures can break in many more ways than REST architectures, and so they are more complex. Meanwhile, theoretical computer science teaches us that something is more complex if it requires more CPU cycles to run. Well, SOAP architectures are also more complex in this light as well, as there is simply a lot more XML going around and the requests are far more verbose.

__I&rsquo;d like to propose that there is another criteria for complexity. And that&rsquo;s semantics. One should always aim for the simplest possible solution&hellip; and providing lots of semantics is not a simple feat.__ SOAP architectures necessarily include semantics to define the meaning of terms used in the description and interfaces of the service. This is totally absent from REST architectures. It is not so much that there is no semantics in the REST paradigm, but it is kept extremely simple: you only need to know about the semantics of the main HTTP operation (POST, GET, PUT and DELETE). In fact, the wikipedia REST entry includes the following citation attributed to Roy Fielding:

> REST&rsquo;s client-server separation of concerns simplifies component implementation, reduces the complexity of connector semantics (&hellip;)


I think this is fundamental. What makes REST simple is that it reduces the amount of semantics the software has to worry about.
Why would semantics be a bad idea? Well, simply because semantics implies coupling, and too much coupling makes a system too complex. Without any coupling, we cannot do anything, but when we throw too much, we harm the system. What type of coupling are we talking about? Well, if I pass the variable <var>x</var> to the function <var>f</var>, there is relatively little coupling. All I do is that I establish a relationship between the function <var>f</var> and the variable <var>x</var>. But what if <var>x</var> is mean to be the cost of a product? Then <var>x</var> must be tied explicitly to the product ID, to some price identifier, and so on. This makes the system harder to maintain, harder to debug, and more failure-prone.

Fundamentally, software design is about communication. But not communication between machines&hellip; rather communication between developers. And communications between distributed folks works much better when the message they need to send to each other is kept very simple. That is why the SOAP philosophy is fundamentally flawed.

So, when you design software, you should include as little semantics as possible as this will make your system simpler, and thus, easier to manage.

This is, of course, contrary to what AI enthusiasts do.

&mdash;

<a name="too1"></a>1. See recent posts by Larry O&rsquo;Brien and [Nick Gall](http://www.w3.org/2007/01/wos-papers/gall).

