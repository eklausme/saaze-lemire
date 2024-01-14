---
date: "2006-05-03 12:00:00"
title: "When XML abstraction kills your web services"
---



The writting has been on the wall for quite some time. Dare Obasanjo comments on the misguided efforts of the W3C&rsquo;s XML Schema Patterns for Databinding Working Group:

> The core problem is that every vendor of XML Web Services toolkits pretends they are selling a toolkit for programming with distributed objects and tries their best to make their tool hide the XML-ness of the wire protocols (SOAP), interface description language (WSDL) and data types (XSD). Of course, these toolkits are all leaky abstractions made even leakier than usual by the __impedance mismatch between XSD and the typical statically typed, object oriented programming language that is popular with the enterprise Web services crowd (i.e. Java or C#)__.

The W3C forming a working group to standardize the collection of hacks and kludges that various toolkits use when mapping XSD< ->objects is an attempt to standardize the wrongheaded thinking of the majority of platform vendors selling XML Web Services toolkits.
Reading the charter of the working group is even more disturbing because not only do they want to legitimize bad practices but they also plan to solve problems like how to version classes across programming languages and coming up with XML representations of common data structures for use across different programming languages. Thus the working group plans to invent as well as standardize common practice. Sounds like the kind of conflicting goals which brought us XSD in the first place. I wish them luck.


Myself, I don&rsquo;t think this is funny at all. We all, collectively, waste time and money over this.

