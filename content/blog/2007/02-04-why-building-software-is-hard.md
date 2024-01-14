---
date: "2007-02-04 12:00:00"
title: "Why building software is hard"
---



Why is building software difficult? Why do so many projects fail? I recently had an argument with a colleague who thinks that the problem is that the software industry is unable to follow due process&hellip; to take the requirements, make up a plan and follow it.
Well. There is no such thing as &ldquo;a project with system requirements and promised characteristics.&rdquo; The engineers at Google or Microsoft are not given out a sheet of requirements in 2005 and told to deliver a new product meeting these requirements in 2007. The requirements change __every__ week and they poorly define the expectations of whoever is paying you.
There are boring software projects where the requirements are static, for example, making available a MySQL database through a web interface, adding a tool to the intranet where people can submit documents, and so on. Those can be managed pretty well and they are actually. Failure rates are small.

Making analogies with other industries, you should observe that pharmaceutical companies who design new medications typically fail most of the time. What Boeing sells is an already designed and prototyped airplane. They design very few new ones that are not minor variants on existing planes, and when they do have to build a new airplane from scratch, it is tricky and I can assure you that they hire the very best engineers they can for the job.

And before you think that these are bad analogies&hellip; Read the story of how Microsoft Vista came about:

>Microsoft started work on their plans for &ldquo;Longhorn&rdquo; in May 2001, prior to the release of Windows XP. It was originally expected to ship sometime late in 2003 as a minor step between Windows XP (codenamed &ldquo;Whistler&rdquo;) and &ldquo;Blackcomb&rdquo; (now known as Windows &ldquo;Vienna&rdquo;). Gradually, &ldquo;Longhorn&rdquo; assimilated many of the important new features and technologies slated for &ldquo;Blackcomb,&rdquo; resulting in the release date being pushed back a few times. Many of Microsoft&rsquo;s developers were also re-tasked with improving the security of Windows XP. Faced with ongoing delays and concerns about feature creep, Microsoft announced on August 27, 2004 that it was making significant changes. &ldquo;Longhorn&rdquo; development basically started afresh, building on the Windows Server 2003 codebase, and re-incorporating only the features that would be intended for an actual operating system release. Some previously announced features, such as WinFS and NGSCB, were dropped or postponed, and a new software development methodology called the &ldquo;Security Development Lifecycle&rdquo; was incorporated in an effort to address concerns with the security of the Windows codebase. (Source: wikipedia)


So, you see that the model where the engineers are given a set of requirements, fully describing the product the be built, and then they go out to build it, is very, very far from reality. And do not blame whoever runs Microsoft. It is simply an utopia to think that you can specify the requirements of a new software product. Could you have specified the requirements for the Google search engine back in 1995? Software is designed, it is not built like a house. Programming is a craft, not a science.

Yes, there are programming techniques to be learned, and there are tricks to help you keep a large software project on its rails. Unit testing, computational complexity, all these things are very important. But saying that software projects fail for lack of engineering is like saying that the latest Stephen King&rsquo;s novel is boring because he forgot to draw a UML diagram of the book.

