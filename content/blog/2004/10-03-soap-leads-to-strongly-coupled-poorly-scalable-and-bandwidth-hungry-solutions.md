---
date: "2004-10-03 12:00:00"
title: "SOAP leads to strongly coupled, poorly scalable, and bandwidth hungry solutions?"
---



Here&rsquo;s some comments by Joe Walnes on his experience with SOAP. The scary thing is that he comes to exactly the same conclusions as I did on my own&hellip; Any SOAP supporter out there wants to answer these:

> On the last system I worked on, we were struggling with SOAP and switched to a simpler REST approach. It had a number of benefits.

Firstly, it simplified things greatly. With REST there was no need for complicated SOAP libraries on either the client or server, just use a plain HTTP call. This reduced coupling and brittleness. We had previously lost hours (possibly days) tracing problems through libraries that were outside of our control.

Secondly, it improved scalability. Though this was not the reason we moved, it was a nice side-effect. The web-server, client HTTP library and any HTTP proxy in-between understood things like the difference between GET and POST and when a resource has not been modified so they can offer effective caching &#8211; greatly reducing the amount of traffic. This is why REST is a more scalable solution than XML-RPC or SOAP over HTTP.

Thirdly, it reduced the payload over the wire. No need for SOAP envelope wrappers and it gave us the flexibility to use formats other than XML for the actual resource data. For instance a resource containing the body of an unformatted news headline is simpler to express as plain text and a table of numbers is more concise (and readable) as CSV.



