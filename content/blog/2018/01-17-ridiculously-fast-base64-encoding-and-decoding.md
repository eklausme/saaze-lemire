---
date: "2018-01-17 12:00:00"
title: "Ridiculously fast base64 encoding and decoding"
---



Computers store data as streams of bits. Binary files like image, audio or video files are allowed to contain just about any sequence of bits.

However, we also often use text formats; for example, web pages and emails are required to be text. So how do we send images by email? How do we embed images within web pages? One possibility is to point to a distinct binary file. Another common approach is to directly embed the binary data within the web page or the email using [base64](https://en.wikipedia.org/wiki/Base64). Base64 is just a standard text format that can be used to code any binary input. To be precise, a base64 code is always a valid ASCII text (and thus, it is also valid UTF-8). Each byte of base64 code contains 6 bits of data. Thus we &ldquo;waste&rdquo; about 2 bits per byte. Hence the base64 equivalent of a binary file is about 33% larger. In practice, this size increase is rarely a source of concern. As far as I know, email attachments are almost always encoded as base64.

When writing HTML, I find it handy to encode my images directly in the HTML using a [data URI](https://en.wikipedia.org/wiki/Data_URI_scheme). For example, [in a recent post](/lemire/blog/2018/01/16/microbenchmarking-calls-for-idealized-conditions/), I included a PNG file within my HTML code. Major websites like Google use data URIs all the time. It has a small downside in that the web pages are larger (obviously) and they cannot benefit from image caching. On the upside, you save the browser a separate network request.

If you are a web developer, you can use [Web Storage](https://en.wikipedia.org/wiki/Web_storage) to create a client-side database for your application. This client-side database can contain images and arbitrary data, but it must be all base64-encoded.

Most database engines support binary data, but several require that it be encoded as base64 at some point: MongoDB, Elasticsearch, Amazon SimpleDB, and Amazon DynamoDB. I am probably missing a few.

Base64 is commonly used in cryptography to exchange keys. A form of base64 is also used to pass arbitrary data as part of a URI.

Thankfully, encoding and decoding base64 is fast. Yet there are cases where it can become a problem. [Matt Crane and Jimmy Lin found that decoding binary attributes from base64 in Amazon DynamoDB is slow](https://cs.uwaterloo.ca/~jimmylin/publications/Crane_Lin_ICTIR2017.pdf).

How fast can you decode base64 data? On a recent Intel processor, it takes roughly 2 cycles per byte (from cache) when using a fast decoder like the one from the Chrome browser. This fast decoder is basically doing table lookups. That&rsquo;s much slower than copying data within the cache (which takes less 0.05 cycles per byte).
Is this the best you can do?

[Alfred Klomp showed a few years ago that you could do much better using vector instructions](http://www.alfredklomp.com/programming/sse-base64/). Wojciech MuÅ‚a, myself and a few others (i.e., Howard and Kurz) decided the seriously revisit the problem. [MuÅ‚a has a web page on the topic](http://0x80.pl/notesen/2016-01-12-sse-base64-encoding.html).

We found that, in the end, you could speed up the problem by a factor of ten and use about 0.2 cycles per byte on recent Intel processors using vector instructions. That&rsquo;s still more than a copy, but much less likely to ever be a bottleneck. I should point out that this 0.2 cycles per byte includes error handling: the decoder must decode and validate the input (e.g., if illegal characters are found, the decoding should be aborted).

[Our research code is available](https://github.com/lemire/fastbase64) so you can reproduce our results. Our paper is available from arXiv and has been accepted for publication by ACM Transactions on the Web.
My understanding is that our good results have been integrated in [Klomp&rsquo;s base64 library](https://github.com/aklomp/base64).

__Further reading__:
- Wojciech MuÅ‚a, Daniel Lemire, [Faster Base64 Encoding and Decoding Using AVX2 Instructions](https://arxiv.org/abs/1704.00605), ACM Transactions on the Web (to appear)


