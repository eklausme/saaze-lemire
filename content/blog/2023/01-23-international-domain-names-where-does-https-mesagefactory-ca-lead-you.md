---
date: "2023-01-23 12:00:00"
title: "International domain names: where does https://meßagefactory.ca lead you?"
---



Originally, the domain part of a web address was all ASCII (so no accents, no emojis, no Chinese characters). This was extended a long time ago thanks to something called [internationalized domain name](https://en.wikipedia.org/wiki/Internationalized_domain_name) (IDN).

Today, in theory, you can use any Unicode character you like as part of a domain name, including emojis. Whether that is wise is something else.

What does the standard says? Given a domain name, we should identify its labels. They are normally separated by dots (.) into labels: www.microsoft.com has three labels. But you may also use other Unicode characters as separators (<span class="pl-c"> ., ．, 。, ｡). Each label is further processed. If it is all ASCII, then it is left as is. Otherwise, we must convert it to an ASCII code called &ldquo;punycode&rdquo; after doing the following according to RFC 3454:</span>

- Map characters (section 3 of <span class="pl-c">RFC 3454),</span>
- Normalize (section 4 of <span class="pl-c">RFC 3454),</span>
- Reject forbidden characters,
- <span class="pl-c">Optionally reject based on unassigned code points (section 7).</span>


And then you get to the [punycode algorithm](/lemire/blog/2023/01/04/emojis-in-domain-names-punycode-and-performance/). There are further conditions to be satisfied, such as the domain name in ASCII cannot exceed 255 bytes.

That&rsquo;s quite a lot of work. The goal is to transcribe each Unicode domain name into an ASCII domain name. You would hope that it would be a well-defined algorithm: given a Unicode domain name, there should be a unique output.

Let us choose a common non-ASCII character, the letter ß, called Eszett. Let me create a link with this character:

<li style="list-style-type: none;">

- [https://meßagefactory.ca](https://meßagefactory.ca)



What happens if you click on this link? The result depends on your browser. If you are using Microsoft Edge, Google Chrome or the Brave browser, you may end up at [https://messagefactory.ca/](https://messagefactory.ca/). If you are using Safari or Firefox  you may end up at [https://xn--meagefactory-m9a.ca](https://xn--meagefactory-m9a.ca). Of course, your results may vary depending on your exact system. Under ios (iPhone), I expect that the Safari behaviour will prevail irrespective of your browser.

Not what I expected.

__Update__: We wrote our own library to process international domain names according to the standard: it is called [idna](https://github.com/ada-url/idna) and part of the ada-url project. Our library produces https://xn--meagefactory-m9a.ca which is the non-transitional (and now correct) answer.

