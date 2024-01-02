---
date: "2019-01-30 12:00:00"
title: "What is the space overhead of Base64 encoding?"
---



Many Internet formats from email (MIME) to the Web (HTML/CSS/JavaScript) are text-only. If you send an image or executable file by email, it often first gets encoded using [base64](https://en.wikipedia.org/wiki/Base64). The trick behind base64 encoding is that we use 64 different ASCII characters including all letters, upper and lower case, and all numbers.

Not all non-textual documents are shared online using base64 encoding. However, it is quite common. Load up google.com or bing.com and look at the HTML source code: you will base64-encoded images. On my blog, I frequently embed figures using base64: it is convenient for me to have the blog post content be one blob of data.

Base64 is apparently wasteful because we use just 64 different values per byte, whereas a byte can represent 256 different characters. That is, we use bytes (which are 8-bit words) as 6-bit words. There is a waste of 2 bits for each 8 bits of transmission data. To send three bytes of information (3 times 8 is 24 bits), you need to use four bytes (4 times 6 is again 24 bits). There might be some overhead because we often separate the base64 text into lines. Thus the base64 version of a file is at least 4/3 larger than the the original: we use at least 33% more storage than the original file size when encoding a file as base64.

That sounds bad. How can engineers tolerate such wasteful formats?

It is common for web servers to provide the content in compressed form. Compression partially offset the wasteful nature of base64.

To assess the effect of base64 encoding, I picked a set of images used in a recent research paper. There are different compression formats, but an old format is gzip. I encode the images using base64 and then I compress them with gzip. I report the number of bytes. [I make the files available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2019/01/30).

File name                |Size                     |Base64 size              |Base64 gzip size         |
-------------------------|-------------------------|-------------------------|-------------------------|
bing.png                 |1355                     |1832                     |1444                     |
googlelogo.png           |2357                     |3186                     |2477                     |
lena_color_512.jpg       |105764                   |142876                   |108531                   |
mandril_color.jpg        |247222                   |333970                   |253868                   |
peppers_color.jpg        |9478                     |12807                    |9798                     |


As you can see, the gzip sizes are within 5% of the original sizes. And for larger files, the difference is closer to 2.5%.

Thus you can safely use base64 on the Web without too much fear.

In some instances, base64 encoding might even improve performance, because it avoids the need for distinct server requests. In other instances, base64 can make things worse, since it tends to defeat browser and server caching. Privacy-wise, base64 encoding can have benefits since it hides the content you access in larger encrypted bundles.

__Further reading__. [Faster Base64 Encoding and Decoding using AVX2 Instructions](https://arxiv.org/abs/1704.00605), ACM Transactions on the Web 12 (3), 2018. See also [Collaborative Compression](http://richardstartin.uk/collaborative-compression/) by Richard Startin.

