---
date: "2013-01-14 12:00:00"
title: "XML for databases: a dead idea"
---



One of my colleagues is teaching an artificial intelligence class. In his class, he uses old videos where experts from the early eighties make predictions about where AI is going. These experts come from the best schools such as Stanford. 

These videos were not meant as a joke. When you watch them today, they are properly hilarious however. One of the predictions by a famous AI researcher was that the software industry would be dominated by expert systems by year 2000. This was a reasonable prediction: [Wikipedia](https://en.wikipedia.org/wiki/Expert_system) says that in the early 1980s, two thirds of the Fortune 1000 companies used expert systems in their daily business activities.

I believe that the majority of software programmers today would describe the importance of expert systems in their work to be&hellip; negligible. Of course, the researchers have not given up: the Semantic Web initiative can be viewed as a direct descendant of expert systems. And there are still some specific applications where an expert system is the right tool, I am sure. However, to put it bluntly, expert systems were a failure, by the standards set forth by their proponents.

Did you ever notice how much energy people put into promoting (their) new idea, and how little you hear about failures? That&rsquo;s because there is little profit in calling something a failure and much risk: there are always people in denial who will fight you to the death. 

I think it is unfortunate that we never dare look at our mistakes. What did Burke they say? &ldquo;Those who don&rsquo;t know history are destined to repeat it.&rdquo; 

When XML was originally conceived, it was meant for document formats. And by that standard&hellip; boy! did it succeed! Virtually all word processing and e-book formats are in XML today. The only notable failure is HTML. They tried to make HTML and XML work together, but it was never a good fit (except maybe within e-books). In a sense, the inventors of XML could not have succeeded more thoroughly. 

Then, unfortunately, the data people took XML and decided that it solved their problems. So we got configuration files in XML, databases in XML, and so on. Some of these applications did ok. Storing data in XML for long-term interoperability is an acceptable use of XML. Indeed, XML is supported by virtually all programming languages and that is unlikely to change. 

However, XML as a technology for databases was supposed to solve new problems. All major database vendors added support for XML. DBAs were told to learn XML or else&hellip; We also got handfuls of serious XML databases. More critically, the major database research conferences were flooded with XML research papers. 

And then it stopped. For fun I estimated the number of research papers focused on XML in a major conference like VLDB: [2003](http://www.vldb.org/conf/2003/homepage/uni_hro/proceedings.html#P2): 27; [2008](http://www.informatik.uni-trier.de/~ley/db/journals/pvldb/pvldb1.html): 14; [2012](http://www.informatik.uni-trier.de/~ley/db/journals/pvldb/pvldb5.html): 3. That is, it went from a very popular topic for researchers to a niche topic. Meanwhile, the [International XML Database Symposium](http://www.informatik.uni-trier.de/~ley/db/conf/xsym/index.html) ran from 2003 to 2010, missing only year 2008. It now appears dead.

That is not to say that there is no valid research focused on XML today. The few papers on XML accepted in major database journals and conferences are solid. In fact, the papers from 2003 were probably mostly excellent. Just last week, I reviewed a paper on XML for a major journal and I recommended acceptance. I have been teaching a course on XML every year since 2005 and I plan to continue to teach it. Still, it is undeniable that XML databases have failed as anything but a niche topic.

I initially wanted to write an actual research article to examine why XML for databases failed. I was strongly discouraged: this will be unpublishable because too many people will want to argue against the failure itself. This is probably a great defect of modern science: we are obsessed with success and we work to forget failure.

