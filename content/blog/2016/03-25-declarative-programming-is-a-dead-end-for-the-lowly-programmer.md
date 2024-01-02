---
date: "2016-03-25 12:00:00"
title: "Declarative programming is a dead-end for the lowly programmer"
---



Most programmers focus on software execution. We want to understand what the computer is actually doing. Java, C, JavaScript, PHP, Python&hellip; all these languages make it easy to build any software you like. In these languages, even at the very beginning, you are truly in charge. They are like hammers, screwdrivers, nails and screws&hellip; they don&rsquo;t know how to do much, but if you are skilled, you can do what you want.

Opposed to this view are declarative programming languages. SQL is maybe the best known. On the web, we have HTML and CSS. Folks who work with XML a lot know about XSLT. And you have regular expressions. These languages are more like entrepreneurs. They won&rsquo;t let you touch the tools directly. They are telling you &ldquo;tell me what is needed, I&rsquo;ll do it&rdquo;.

That&rsquo;s why people who only do HTML and CSS, or only SQL, are often not considered &ldquo;programmers&rdquo;.

Nevertheless, I think we can agree that HTML and SQL are pretty useful ideas. But like all declarative programming languages, they are dead-ends for the lowly programmer. I use the term &ldquo;lowly programmer&rdquo; to distinguish regular programmers from PhDs with IQs above 200 and teams of highly paid Google engineers.

For most programmers, with declarative languages like SQL and XSLT, what you see is what you get. It is hard to extend them meaningfully. I don&rsquo;t mean that they can&rsquo;t be extended, but they are typically only extended by people with enormous resources like browser makers or database vendors. This makes sense in the spirit of these languages: you are meant to delegate to the language itself.

When you first learn a language, say JavaScript, you might realize that it has missing features that you need for your domain. For example, JavaScript does not know anything about video games. Neither does SQL. JavaScript does not really have a concept of &ldquo;library&rdquo; or &ldquo;extension package&rdquo;, but people have still written lots of software libraries to make it easier to write video games in JavaScript. No such luck with SQL.

HTML and SQL have become enormously sophisticated over the years. They are truly powerful tools. But they mostly are as they are.

It is a problem because interesting programming projects are about new unsolved problems. And these mostly get solved by people using non-declarative languages.

If you are interested in a newly emerging discipline like data science, and you know how to program in Python, Java or R, you can build useful software packages. If you publish them, others might use them and extend them. But if all you know is SQL or HTML, you are stuck with what these languages provide you.

Of course, you can write the new great data-science platform in Prolog, SQL or XSLT. In theory you can. But for most people, it is not reasonable. These languages are dead-ends.

__Credit__: This blog post was inspired by an offline exchange with Antonio Badia. The opinion stated here is mine alone, however.

__Reference__: [MADlib](http://madlib.net/) is a library for analytics that started out with a few SQL scripts. It quickly outgrew SQL however.

__Rebuttals__:

- Many people object that HTML is not a declarative language. Others object that SQL is also not a declarative language. [I defer to Wikipedia](https://en.wikipedia.org/wiki/Declarative_programming).
- Some people think that instead of &ldquo;declarative&rdquo;, I should have written &ldquo;non-Turing complete&rdquo;. But SQL is Turing complete. So is CSS. So is XSTL. And so forth.
- Some people think that some declarative languages are easily and commonly extended by the lowly programmer. Though I will concede that it is indeed possible, I must point out that nobody was able to give me a concrete example.


__Relevant link__: [Growing a Language, by Guy Steele](https://www.youtube.com/watch?v=_ahvzDzKdB0)

