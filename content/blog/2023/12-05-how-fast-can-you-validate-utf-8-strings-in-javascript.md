---
date: "2023-12-05 12:00:00"
title: "How fast can you validate UTF-8 strings in JavaScript?"
---



When you recover textual content from the disk or from the network, you may expect it to be a Unicode string in UTF-8. It is the most common format. Unfortunately, not all sequences of bytes are valid UTF-8 and accepting invalid UTF-8 without validating it is a security risk.

How might you validate a UTF-8 string in a JavaScript runtime?

You might use the valid-8 module:
```JavaScript
import valid8 from "valid-8";
if(!valid8(file_content)) { console.log("not UTF-8"); }

```

Another recommended approach is to use the fact that TextDecoder can throw an exception upon error:
```JavaScript
new TextDecoder("utf8", { fatal: true }).decode(file_content)

```

Or you might use the isUtf8 function which is part of Node.js and Bun.
```JavaScript
import { isUtf8 } from "node:buffer";
if(!isUtf8(file_content)) { console.log("not UTF-8"); }

```

How do they compare? Using Node.js 20 on a Linux server (Intel Ice Lake), I get the following speeds with three files representative of different languages. The Latin file is just ASCII. [My benchmark is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/12/05).



&nbsp;                   |Arabic                   |Chinese                  |Latin                    |
-------------------------|-------------------------|-------------------------|-------------------------|
valid-8                  |0.14 GB/s                |0.17 GB/s                |0.50 GB/s                |
TextDecoder              |0.18 GB/s                |0.19 GB/s                |7 GB/s                   |
node:buffer              |17 GB/s                  |17 GB/s                  |44 GB/s                  |


The current isUtf8 function in Node.js was implemented by [Yagiz Nizipli](https://www.yagiz.co/about). [It uses the simdutf library underneath](https://github.com/simdutf/simdutf). John Keiser should be credited for the UTF-8 validation algorithm.

