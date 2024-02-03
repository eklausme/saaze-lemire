---
date: "2007-02-14 12:00:00"
title: "Would you pass my XML course?"
---



Some people will love this. I prepared a mockup exam for my INF 6450 students. See if you can [pass it](https://lemire.me/inf6450/mod5/examenfactice.pdf) (in French, but you can probably grok most of it if only you know the basic XML vocabulary). I&rsquo;m generally impressed how well my students get by in this course. The [full XML course is online](https://lemire.me/inf6450/), but requires you to have Firefox (warning: sometimes my server is slow).

According to &ldquo;highly reputable&rdquo; (well&hellip;) people, this is a __Mickey Mouse course__. But do not take their word for it, [go see yourself](https://lemire.me/inf6450/) (with Firefox 2.0 or better). Indeed, there is no Software Engineering. No real Computer Science (as in, algorithms, data structures, and so on). Well, I do offer a real Computer Science course, but I still think that teaching XML is <em>way cool</em> and fully justified. It is a programming and IT course. Programming is fun. Getting by with crazy declarative languages like XSLT is hilarious. Figuring out how to do aggregations in XSLT is really a nasty problem (with several elegant and simple solutions). Figuring out how to intersect sets in XSLT, given that all you have is a union operator, is really fun too. And you never have a student ask you why he needs to learn this. Students see immediately why this is required to be a top-notch Web developer.

I still do not cover very well XQuery or XSLT 2.0. I&rsquo;m starting to cover CSS 3.0, but barely. MathML is poorly supported so I do not go far in it.

XQuery seemed nice, but I&rsquo;m still waiting for the real cool applications. So far, XQuery is still, to me, a poor man&rsquo;s XSLT.

XSLT 2.0 looks good, but support for it is still rare and I still do not have a good use case. Certainly, XSLT 2.0 cleaned up a few things, but I was carefully not to introduce my students to the nasty parts of XSLT 1.0 which is good since they go away now. Regular expressions in XSLT 2.0 is a nice feature but it almost seems like this requires not special introduction: if you know both regular expressions and XSLT, then there is nothing special happening. Being able to generate several documents might be nice, but I still do not see the use case and it seems a trivial addition anyhow.

XLink? Badly supported, not exciting. Still useful in, say, SVG, but trivially so.

SVG? Might be nice, but it is painful to do by hand. In theory, you could have data being transformed to SVG through XSLT, but do people really do that?

XSLFO? No use case. DocBook does fine if you need to generate PDF technical reports. Want to generate bills in PDF? I cannot imagine doing it in XSLFO. Do people really do that?

AJAX is nice and it is a great DOM API use case. But the cross-browser issues are so terrible that you can only go so far.

Java-wise, I now try to show that there are several ways to tackle XML. For example, the iterative approach is rarely included and I think it is very nice.

J2EE, web services? I cover REST (quickly done), I cover some SOA. For the rest, my course is already packed and I do not want to get into enterprise computing which I think is boring and totally lacking of real innovation.

Ontologies? I cover RDF which is barely useful, but still has good use cases (Dublin Core and 3 or 4 others), but anything beyond that is probably a waste of my (undergraduate) students.

DTD, Relax NG&hellip; these are the good guys, but they are barely useful. XML is at its best as an extensible language which is not a very schema-friendly concept. Very, very few people need to write DTDs or Relax NG schemas. You sometimes need to read them to figure out what you have to output, and it is useful to check that you are producing good XML, but validating is usually a waste of time unless you have problems. XML Schema? Please! Let us not waste time with this pitiful excuse of a spec.

(Disagree with my statements? Please comment!)

