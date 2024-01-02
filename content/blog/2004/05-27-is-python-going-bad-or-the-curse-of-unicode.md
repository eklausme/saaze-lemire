---
date: "2004-05-27 12:00:00"
title: "Is Python going bad? or The curse of unicode&#8230;."
---



I&rsquo;ve wasted a considerable amount of time in the last two days upgrading my [RSS aggregate](https://lemire.me/lemire.html) so that it will have better support for atom feeds. I use the feedparser library.

One thing that gets to me is how unintuitive unicode is under Python. For example, the following is a string&hellip;<br/>
<code><br/>
t="éee"<br/>
</code><br/>
Just copy this in your [python](https://www.python.org/) interpreter, and it will work nicely. For example,

<code><br/>
>>> t='éee'<br/>
>>> print t<br/>
ï¿½ee<br/>
</code>

However, for some reason, if I just type &ldquo;t&rdquo;, then it can&rsquo;t print it properly&hellip;<br/>
<code><br/>
>>> t<br/>
'xe9ee'<br/>
</code>

See how it is already confusing? (And we haven&rsquo;t used unicode yet!)

Next, we can map this string to unicode&hellip;<br/>
<code><br/>
r=unicode(t)<br/>
</code>

which has the following result&hellip;<br/>
<code><br/>
>>> r=unicode(t)<br/>
Traceback (most recent call last):<br/>
File "&lt;stdin&gt;", line 1, in ?<br/>
UnicodeDecodeError: 'ascii' codec can't decode byte 0xe9 in position 0: ordinal not in range(128)<br/>
&lt;/stdin&gt;</code>

Ah&hellip; so it tries to interpret t as ascii&hellip; fair enough, we know it is &ldquo;latin-1&rdquo; or &ldquo;iso8859-1&rdquo;. It is already quite strange that &ldquo;print&rdquo; knows what to do with my string, but nothing else in Python seems to know&hellip; so we do

<code><br/>
>>> r=unicode(t,'latin-1')<br/>
>>> r<br/>
u'xe9ee'<br/>
>>> print r<br/>
Traceback (most recent call last):<br/>
File "&lt;stdin&gt;", line 1, in ?<br/>
UnicodeEncodeError: 'ascii' codec can't encode character u'xe9' in position 0: ordinal not in range(128)<br/>
&lt;/stdin&gt;</code>

because, see, you can&rsquo;t print unicode to the string&hellip; but you can do the following&hellip;

<code><br/>
>>> print r.encode('latin-1')<br/>
éee<br/>
>>> print r.encode('iso-8859-1')<br/>
éee<br/>
</code>

but also

<code><br/>
>>> r.encode('latin-1')<br/>
'xe9ee'<br/>
>>> r.encode('iso-8859-1')<br/>
'xe9ee'<br/>
</code>

What is my beef?

- If &lsquo;print&rsquo; assumes &lsquo;latin-1&rsquo; then shouldn&rsquo;t everything else? Why is this not consistent? If it is unsafe to assume &lsquo;latin-1&rsquo;, then why does print do it?
- The encode, decode thing is a mess. We had a perfectly valid construct for converting things to strings, and that&rsquo;s &lsquo;str&rsquo;. Now, we have a new one called &lsquo;encode&rsquo;. So that, given some unicode, I can do either t.encode(&lsquo;ascii&rsquo;) or str(t) for the same result. Bad. Now, I&rsquo;m stuck forever in a world where I have to figure out whether I encode or decode a string, and which is which. This is hard. This is confusing.
- A string object should know its encoding so I don&rsquo;t have to. What happens if I receive a string from some library and I need to convert it to unicode? How am I supposed to know what the encoding of the string is? There is no sensible way to communicate this right now which makes debugging a pain. The only excuse I see is that sometimes it is impossible for python to know the encoding&hellip; well, then it should just fail and require the programmer to specify the encoding. There are way too many things that can go wrong when you expect the programmer to keep tracks of his strings and which is encoded how&hellip;


