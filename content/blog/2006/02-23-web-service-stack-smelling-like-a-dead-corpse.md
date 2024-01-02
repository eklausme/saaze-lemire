---
date: "2006-02-23 12:00:00"
title: "Web Service Stack Smelling like a Dead Corpse?"
---



Tim Bray [wrote this morning](http://www.tbray.org/ongoing/When/200x/2006/02/22/WS-Flurry): &ldquo;I think the WS-stench of something WS-rotting from the WS-head down is becoming increasingly difficult to ignore.&rdquo; This is coming from the inventor of things like XML and Atom: while he might be wrong, he sures knows a lot about XML technologies so maybe we ought to listen to the man.

For a year now, we&rsquo;ve had people realizing the web services are too complex for their own good, Tim Bray even said last year that [the WS-* stack is bloated, opaque, and insanely complex](http://www.tbray.org/ongoing/When/200x/2004/09/18/WS-Oppo). We&rsquo;ve been told to [drop the SOAP](http://www.perl.com/pub/2004/09/30/drop_the_soap.html) because it is not scalable.

Ok. It is complex and poorly scalable, but it works, right? I mean, totally different systems from different vendors like, say, Sun and Microsoft, are made to play together using the WS stack, right? I assumed so up until recently. You see, I&rsquo;ve never touched .NET and I don&rsquo;t have to interact with .NET applications, so how would I know? Well, I can read what experience people have it with it.

To me, the fact that Web Services are based on XML Schema has always been a bad sign, because even very smart people have trouble working with XML Schema, but what I had not realized until now is that XML Schema actually leads to deep and serious interoperability issues, which I find very amusing:

- The main problem with WS-* interop is that vendors decided to treat it as a distributed object programming technology but based it on a data typing language (i.e. XSD) which does not map at all well with traditional object oriented programming languages. (Source.)
- With the benefit of hindsight, we can see it was a bad idea to try and abstract away application protocols using RPC calls tied to verbose, rigid, statically-typed languages mapped with a Rube Goldberg schema language that has a more flexible type system than said languages. (Source.)


What interoperability? Well, on the one hand, we have Java and on the other, we have .NET. Minimally, the WS stack was supposed to get these two technologies to talk to each other easily. It doesn&rsquo;t. It has failed. In practice, you are better off choosing either .NET or Java:

> My recent experience (in which I was shocked how little interoperability, not to mention functionality, has been accomplished in the WSDL and SOAP world over the last several years) tells me that if the target is either dotnet *or* java then your chances are significantly better than targetting both. ([Source](https://patricklogan.blogspot.com/2006/02/rest-and-soap.html).)


So, if WS doesn&rsquo;t buy you interoperability, if it is complex and not scalable, why bother? Oh! Why?

(I have a comment section open. Shoot! Convince me!)

