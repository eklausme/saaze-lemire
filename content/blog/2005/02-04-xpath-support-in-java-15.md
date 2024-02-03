---
date: "2005-02-04 12:00:00"
title: "XPath support in Java 1.5"
---



Things are getting somewhat better in Java land. You can no do some XPath work in Java, see this sample code I wrote this morning (it is not standalone though):
```C

    String xpathexpression = "//xdoc[dtd!='']/fname/text()";
    XPath xpath = XPathFactory.newInstance().newXPath();
    InputSource indexname_input = new InputSource(indexname);
    NodeList nl = (NodeList) xpath.evaluate(xpathexpression,
                              indexname_input, XPathConstants.NODESET);
    for (int i = 0; i < nl.getLength(); ++i) {
      System.out.println("loading document " + (i + 1) + " of " + nl.getLength());
      System.out.println("It uses DTD: "+xpath.evaluate("../../dtd",nl.item(i)));
      String xmlfile = nl.item(i).getNodeValue();
      String xmlPath = baseurl + datadir + xmlfile;
    }
```


However, I was disappointed to see that the new &ldquo;foreach&rdquo; construct in Java doesn&rsquo;t apply to NodeList objects&hellip; I&rsquo;m sorry, but I getting more and more convinced, with every version, that Java is an ugly hack. I mean, you have a collection of nodes, a standard one at that, and you can&rsquo;t &ldquo;foreach&rdquo; it&hellip; what gives?

__What is the &ldquo;foreach&rdquo; construct:__ Java 1.5 introduces the idea, well known in many languages, of the &ldquo;foreach&rdquo; construct. In effect, if you have a set of elements and want to go through them one at a time, using &ldquo;for(int i=0; i &lt; length; ++i)&rdquo; is ugly and error-prone. It is much better to do &rdquo; for (element in set) &ldquo;. Java 1.5 now has this as &ldquo;for (type element : set)&rdquo;. This being said, I was under the impression that the Java people had been careful to make sure that the &ldquo;foreach&rdquo; construct would work with all standard collections of objects&hellip; not so, alas.

