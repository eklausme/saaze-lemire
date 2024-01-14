---
date: "2005-08-18 12:00:00"
title: "Don´t touch XML Schema"
---



A year or two ago, talking against XML Schema meant talking about what W3C touted as the one thing that would replace DTDs.

Now the cat is out of the bag, __XML Schema is a complete failure.__ Among other testimonies, I found the following quote on [Cafe con Leche XML:](http://cafeconleche.org/)

>I wrote an XML Schema for SVG Full 1.1, and another for SVG Tiny 1.1. Doing so taught me a number of things:

- 85% of XML Schema is thoroughly useless and without value;
- the few useful features are weak and without honour;
- creating a modularized XML Schema is easier than with DTDs, but nowhere near as simple as with RNG;
- while a zillion useless features have been included in the spec, anything useful such as making attributes part of the content model has obviously been weeded out with great care, basically leaving one with DTDs supporting namespaces, a few cardinality bits, no entities, and loads of cruft;
- tools like XML Spy that are supposed to help one write schemata will produce very obviously wrong instances, meanwhile the syntax of XML Schema was obviously produced by someone who grew up at the bottom of a deep well in the middle of a dark, wasteful moor where he was tortured daily by abusive giant squirrels and wishes to share his pain with the world;
- the resulting schema is mostly useless anyway as there is no tool available that will process it correctly.


&#8211;Robin Berjon on the xml-dev mailing list, Sunday, 09 Jun 2005 11:59:45


This is very interesting for deeper reasons. This tells us that W3C, which was doing a reasonable job up to now, has fallen in a big way and, among the good things they still do, produces crap. They are no longer __the__ reference as far as the web is concerned.

