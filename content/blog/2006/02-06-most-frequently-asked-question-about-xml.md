---
date: "2006-02-06 12:00:00"
title: "Most frequently asked question about XML"
---



I teach XML. It is neither a glorious nor a prestigious task, but it is fun. I must admit that I am quite a bit of a hacker. While I&rsquo;m a trained mathematician and some of my papers contain highly non trivial mathematical results, I also enjoy the elegance and the simplicity of something like XML because, when viewed in the perpective of everything that came before it, it is simply a very nice solution. Yes, developers do respect elegance and, to a large extend, are driven to it.

Anyhow, XML is not hard. Actually, it is very hard to come up with hard questions about XML. XSLT has the reputation to be very hard, but most students learn it rather easily, which is why, I think, it is not worth your time to learn easier, less powerful, languages (such as XQuery).

Here&rsquo;s a challenge to you my reader: if you had to write an exam question for an XML class, a really difficult one, but one where you can express the answer in simple terms, what would it be? You are not allowed to take a hard problem from, say, graph theory, and put it in XML terms. Your problem must be a naturally occuring XML problem. You cannot also extend the realm of XML to include Web Services.

Most semi-difficult problem I found have to do with XSLT programming. In particular, aggregation (sums, averages and so on) problems are not trivial in XSLT, though, once you&rsquo;ve solved one hard one, you&rsquo;ve solved all of them. Some of them are interesting, like automatically extracting data (say Dublin Core) from documents (say XHTML) and formatting it appropriatedly (say XML/RDF). Topics like AJAX are mostly difficult because of the JavaScript-in-the-browser issue: that&rsquo;s not really worthy of a university-level course, in my humble opinion. Interacting with XML from other languages is slightly interesting, but it grows boring after a while: while XOM is much better than DOM, how much mileage can you get from such an issue at the university-level?

Maybe we can derive the hard questions with what puzzles the students the most? So I thought at first. The most often asked question has to do with the fact that the Firefox browser is a non validating browser. What this means is that when loading XML, Firefox doesn&rsquo;t process the DTD. If you spent a lot of time crafting crazy DTDs, you basically wasted your time as far as Firefox is concerned. Note that this doesn&rsquo;t mean Firefox can&rsquo;t read DTDs: it will process the internal part of the DTD (the one contained in your XML document). Alas, I don&rsquo;t see how I can exploit the fact that it causes a surprise among the student to derive a hard question from it.

In fact, with experience, you learn that DTDs are not very useful. If the XML document is well formed and contain the tags you need, then why would you care about the DTD? A good example is XHTML. Most browsers will do just fine with well formed but slightly invalid XHTML and that&rsquo;s the right behavior to have. Why should the browser or any application choke because I have extra attributes? Or a missing element who content can be safely assumed to be empty?

So, in an XML course, you begin by teaching students who to define a formal grammar for their XML vocabulary, and then, you hope that they will learn on their own that formal grammars are not so useful in practice. Of course, you can&rsquo;t quite put it this why because you&rsquo;ll always find a colleague to object that, surely, you don&rsquo;t mean it. But I do.

