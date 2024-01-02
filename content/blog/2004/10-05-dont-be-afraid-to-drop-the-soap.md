---
date: "2004-10-05 12:00:00"
title: "Don´t Be Afraid to Drop the SOAP"
---



Through [Downes&rsquo;](http://www.downes.ca), I found another article speaking up against SOAP: [Don&rsquo;t Be Afraid to Drop the SOAP](http://www.perl.com/pub/2004/09/30/drop_the_soap.html). Here&rsquo;s a few things it holds against SOAP, all of which are things I can testify to:

> 
- SOAP is difficult to debug. The SOAP message format is verbose even by XML standards, and decoding it by hand is a great way to waste an afternoon. As a result, development took almost twice as long as anticipated.
- The fact that all requests happened live over the network further hampered debugging. Unless the user was careful to log debugging output to a file it was difficult to determine what went wrong.
- SOAP doesn&rsquo;t handle large amounts of data well. This became immediately apparent as we tried to load a large data import in a single request. Since SOAP requires the entire request to travel in one XML document, SOAP implementations usually load the entire request into memory. This required us to split large jobs into multiple requests, reducing performance and making it impossible to run a complete import inside a transaction.
- Network problems affected operations that needed to access multiple machines, such as the program responsible for moving templates and elements. Requests would frequently timeout in the middle, sometimes leaving the target system in an inconsistent state.




