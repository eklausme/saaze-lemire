---
date: "2010-11-17 12:00:00"
title: "You probably misunderstand XML"
---



When I took my current position, I was invited to teach a course on <em>[unstructured data](https://en.wikipedia.org/wiki/Unstructured_data)</em>. It is a sensible topic for a course: some say that between 80% to 90% of all enterprise data is unstructured. But I objected to the title for marketing reasons. How many students would take a course on unstructured data? I can hear the students asking &ldquo;what&rsquo;s that course about?&rdquo; Thus, I proposed a better title for the course: <em>information retrieval and filtering</em>. Indeed, everyone wants to filter and retrieve data, right?

Meanwhile, there were already courses on __structured data__ (that is, on databases and information systems). However, there was no course on [semi-structured data](https://en.wikipedia.org/wiki/Semi-structured_data). So I proposed one. But I couldn&rsquo;t call it <em>semi-structured data</em> as hardly any student would know what the title meant. Instead, I proposed a course which, roughly translated, is called &ldquo;Information Management with XML.&rdquo;

Immediately, I got into trouble: how could I dare omit  [SOAP](https://en.wikipedia.org/wiki/SOAP) and web services from a course on XML? I was annoyed by these comments. With some sense of irony, I decided to start dumping on my students some SOAP examples so that they could see the &ldquo;beauty&rdquo; [I&rsquo;m being ironic] of using XML for data exchange on the web. So, there I was, trying to teach my students about semi-structured data, and I was asked to tell them about [remote procedure calls](https://en.wikipedia.org/wiki/Remote_Procedure_Call), an irrelevant topic for my purposes.

Thankfully, it appears that history is on my side. Developers got tired of getting these annoying XML payloads. In time, they  started using [JSON](https://en.wikipedia.org/wiki/JSON), a much more appropriate format for passing small loads of structured data between a server and an ECMAScript client. It uses fewer bytes and, more importantly, __JSON is an order of magnitude faster than XML__. When you ask on Stack Overflow [whether you should be using SOAP](http://stackoverflow.com/questions/76595/soap-or-rest-for-web-services) you are being told to avoid SOAP at all costs. The developers have spoken. And as a result, the organization behind the SOAP stack [decided to close shop](http://blogs.msdn.com/b/interoperability/archive/2010/11/10/ws-i-completes-web-services-interoperability-standards-work.aspx).

Where does that leave XML at? Precisely where it started. __XML is a great meta-example on how to deal with semi-structured data__. And it is just as useful as ever. Want to deal with documents? [DocBook](https://en.wikipedia.org/wiki/Docbook) and[ OpenDocument](https://en.wikipedia.org/wiki/Odf) are great formats. Want to add semantic information to web pages? [Microformats](https://en.wikipedia.org/wiki/Microformats) can do it. You want to exchange complex business data? The [Universal Business Language](https://en.wikipedia.org/wiki/Universal_Business_Language) probably does what you need. Some people are having luck with the [SVG image format](https://en.wikipedia.org/wiki/Svg). You want to subscribe to my blog? Grab my [atom feed](http://feeds.feedburner.com/daniel-lemire/atom). For these applications, you couldn&rsquo;t easily replace XML by flat files or JSON. Nor should you try.

Alas, we ended up torturing XML by applying it to ill-suited purposes. We must learn how to select the best format. Does your data look like a table? Can a [flat file](https://en.wikipedia.org/wiki/Flat_file#Flat_files) do the job? Do you need a key-value format like [JSON](https://en.wikipedia.org/wiki/JSON)? Or maybe a simple text file? Or is your data more like an XML document? Take a good look at your data before picking a format for it.

__Further reading__: [Indexing XML](/lemire/blog/2010/06/16/indexing-xml/) and [Native XML databases: have they taken the world over yet?](/lemire/blog/2008/12/04/native-xml-databases-have-they-taken-the-world-over-yet/)

__Update__: I don&rsquo;t include configuration files in my list of proper XML applications.

