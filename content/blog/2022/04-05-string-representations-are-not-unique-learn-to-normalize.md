---
date: "2022-04-05 12:00:00"
title: "String representations are not unique: learn to normalize!"
---



Most strings in software today are represented using the unicode standard. The unicode standard can represent most human readable strings. Unicode works by representing each &lsquo;character&rsquo; as a numerical value (called a code point) between 0 and 1 114 112.

Thus the character é is typically represented as the numerical value 233 (or 0xe9 in hexadecimal). Thus in Python, JavaScript and many other programming languages, you get the following:
```C
>>> "\u00e9"
'é'
```


Unfortunately, unicode does not ensure that there is a unique way to achieve every visual character. For example, you can combine the letter &lsquo;e&rsquo; (code point 0x65) with &lsquo;acute accent&rsquo; (code point 0x0301):
```C
>>> "\u0065\u0301"
'é'
```


Unfortunately, in most programming languages, these strings will not be considered to be the same even though they look the same to us:
```C
>>> "\u0065\u0301"=="\u00e9"
False
```


For obvious reason, it can be a problem within a computer system. What if you are doing some search in a database for name with the character &lsquo;é&rsquo; in it?

The standard solution is to _normalize_ your strings. In effect, you transform them so that strings that are semantically equal are written with the same code points. In Python, you may do it as follows:
```C
>>> import unicodedata
>>> unicodedata.normalize('NFC',"\u00e9") == unicodedata.normalize('NFC',"\u0065\u0301")
True
```


There are multiple ways to normalize your strings, and there are nuances.

In JavaScript and other programming languages, there are equivalent functions:
```C
> "\u0065\u0301".normalize() == "\u00e9".normalize()
true
```


Though you should expect normalization to be efficient, it is unlikely to be computationally free. Thus you should not repeatedly normalize your strings, as I have done. Rather you should probably normalize the strings as they enter your system, so that each string is normalized only once.

Normalization alone does not solve all of your problems, evidently. There are multiple complicated issues with internalization, but if you are at least aware of the normalization problem, many perplexing issues are easily explained.

__Further reading__: [Internationalization for Turkish:](http://www.i18nguy.com/unicode/turkish-i18n.html)<br/>
Dotted and Dotless Letter &ldquo;I&rdquo;

