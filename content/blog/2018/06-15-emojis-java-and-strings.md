---
date: "2018-06-15 12:00:00"
title: "Emojis, Java and Strings"
---



Emojis are funny characters that are becoming increasingly popular. However, they are probably not as simple as you might thing when you are a programmer. For a basis of comparison, let me try to use them in Python 3. I define a string that includes emojis, and then I access the character at index 1 (the second character):
```C
>>> x= "&#x1f602;&#x1f60d;&#x1f389;&#x1f44d;"
>>> len(x)
4
>>> x[1]
'&#x1f60d;'
>>> x[2]
'&#x1f389;'
```


This works well. This fails with Python 2, however. So please upgrade to Python 3 (it came out ten years ago).

What about Java and JavaScript? They are similar but I will focus on Java. You can define the string just fine&hellip;
```C
String emostring ="&#x1f602;&#x1f60d;&#x1f389;&#x1f44d;";
```


However, that&rsquo;s where troubles begin. If you try to find the length of the string (<tt>emostring.length()</tt>), Java will tell you that the string contains 8 characters. To get the proper length of the string in terms of &ldquo;unicode code points&rdquo;, you need to type something like <tt>emostring.codePointCount(0, emostring.length())</tt> (this returns 4, as expected). Not only is this longer, but I also expect it to be much more computationally expensive.

What about accessing characters? You might think that <tt>emostring.charAt(1)</tt> would return the second character (&#x1f60d;), but it fails. The problem is that Java uses UTF-16 encoding which means, roughly, that unicode characters can use one 16-bit word or two 16-bits, depending on the character. Thus if you are given a string of bytes, you cannot tell without scanning it how long the string is. Meanwhile, the character type in Java (<tt>char</tt>) is a 16-bit word, so it cannot represent all Unicode characters. You cannot represent an emoji, for example, using Java&rsquo;s <tt>char</tt>. In Java, to get the second character, you need to do something awful like&hellip;
```C
new StringBuilder().appendCodePoint(
  emostring.codePointAt(emostring.offsetByCodePoints(0, 1))).toString()
```


I am sure you can find something shorter, but that is the gist of it. And it is far more expensive than <tt>charAt</tt>.

If your application needs random access to unicode characters in a long string, you risk performance problems.

Other language implementations like PyPy use UTF-32 encoding which, unlike Java&rsquo;s UTF-16 encoding, supports fast random access to individual characters. The downside is increased memory usage. In fact, it appears that PyPy wants to move to UTF-8, the dominant format on the Web right now. In UTF-8, characters are represented using 1, 2, 3 or 4 bytes.

There are different trade-offs. If memory is no object, and you expect to use emojis, and you want fast random access in long strings, I think that UTF-32 is superior. You can still get some good performance with a format like UTF-8, but you will probably want to have some form of indexing for long strings. That might be difficult to implement if your language does not give you direct access to the underlying implementation.

More annoying than performance is just the sheer inconvenience to the programmer. It is 2018. It is just unacceptable that accessing the second emoji in a string of emojis would require nearly undecipherable code.

__Appendix__: Yes. I am aware that different code points can be combined into one visible character so that I am simplifying matters by equating &ldquo;character&rdquo; and &ldquo;code point&rdquo;. I am also aware that different sequences of code points can generate the same character. But this only makes the current state of programming even more disastrous.

