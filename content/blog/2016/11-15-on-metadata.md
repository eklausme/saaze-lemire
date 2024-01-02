---
date: "2016-11-15 12:00:00"
title: "On metadata"
---



I remember a time, before the Web, when you would look for relevant academic papers by reading large books with tiny fonts that would list all relevant work in a given area published in a given year. Of course, you could have just gone to the shelves and checked the research articles themselves but, by for a slow human being, this would have been just too time consuming. These large volumes contained nothing by &ldquo;metadata&rdquo;: lists of article titles, authors, keywords&hellip; They were tremendously valuable to the researchers.

One of the earliest applications of computers was to help manage document collections. In this sense, the Web and Google are very naturally applications for computers. In the early days, computers could not have access to the books themselves but human experts (librarians) could enter the precious metadata in the computers to make them useful.

This was at a time when many computer scientists were worried that computers would be starved for data. Indeed, there are only so many highly paid experts who will sit quietly at a computer entering valuable data.

Back then was an era when people dreamed of intelligent computers. So they imagined a world where human experts would enter data and rules in computer systems, and that these rules would allow these computers to match or even outmatch human intelligence.

History proved these early artificial-intelligence researchers wrong. This &ldquo;classical&rdquo; approach toward machine intelligence did not bear fruit. It is not, as you might imagine, that these dreamers lacked support. They got billions of dollars in funding from just about every government agency you can think of, including the military. 

More recently, this classical artificial-intelligence approach has lead to the semantic web (1998) and its idea of &ldquo;linked data&rdquo;. The thesis of this approach is to supplement the existing web with a thick layer of &ldquo;[RDF](https://en.wikipedia.org/wiki/RDF)&rdquo; that describes the resources and enables advanced machine reasoning.

There are a few problems that make classical artificial intelligence a bad approach:

Collecting, curating and interpreting a large volume of predicates in an open world is a fundamentally intractable problem. If you must track the list of authors, the publication date and the topic of a set of books, and you have enough highly trained librarians, it will work. But the system fails to scale up.

If you have enough time and money, you can build things up, to a point. Walmart, the world&rsquo;s largest private employer, has an extensive supply chain that needs to track precise and accurate metadata about a vast range of products. It works. And it made Walmart very rich and powerful.

But we should not underestimate the difficulty. When the American retailer Target tried to enter the Canadian market, they ended up with empty shelves. These empty shelves lead to poor business and to a massive failure that will be a subject of study for years to come. Why were the shelves empty? Because Target tried to build a new inventory management system and failed. What does an inventory management system do? Essentially, it is a metadata system. To build it up quickly, they had their employees work at collecting and entering the data, days after days&hellip; And then they face reality: when the metadata was there at all, it was often badly wrong. This made it difficult if not impossible to keep the shelves filled up.

Walmart has a worldwide distribution and supply-chain system, with well-oiled computing systems. But getting it to work is not a secondary or trivial activity. It is Walmart&rsquo;s core business. It takes enormous effort for everyone involved to keep it going. We know because it is hard for other people to reproduce it, even when they have tremendous resources.

Even the simplest things can become headaches. Creative Commons allows you to specify a license for you work. A population choice is to allow &ldquo;noncommercial&rdquo; use. But does that mean? Reasonable people can disagree. Is a class given at a public college a &ldquo;commercial&rdquo; or &ldquo;noncommercial&rdquo; activity? Dublin core aims at specifying simple things like the author and title of a piece of work, but when you examine the generated metadata, there is widespread disagreement about what the various attributes mean. 

In the early days of the web, Yahoo! was the standard search engine. It worked through a taxonomy of websites. You looked for a taxidermist in your town by drilling down to the right category. But despite billions in revenues, Yahoo! could not keep this system going. It collapsed under its own weight. 

This should not be underestimated. Most metadata is unreliable. Maintaining high-quality data is simply hard work. And even when people have good intentions, it takes more mental acuity than you might think. For example, in the Target Canada case, product dimensions were sometimes entered in inches, sometimes in centimeters. You might dismiss such errors as the result of hiring poorly trained employees&hellip; but the NASA Mars Climate Orbiter crashed because highly paid engineers got confused and used English units instead of metric units.

One of the problems with metadata in the real world is that you are in an adversarial setting. So assuming that the people entering the metadata are motivated and highly trained, you still have to worry that they are going to lie to you. That&rsquo;s what happened with Yahoo!, and what happens with a lot of metadata. Suppose that I am a book editor and I am asked to classify the book&hellip; and I know that customers will browse the content according to my classification&hellip; my incentive is strong to fit my product in the most popular categories.

To make matters worse, metadata systems are not objectively neutral entities on their own. They were designed by people with biases. There is no such thing as an objective oracle in the real world. If you have ever had to reconcile different databases, data stored in different formats, you know how painful it can be. There are simply different and equally valid ways to describe the world.

You would think that errors can be objectively assessed&hellip; and certainly a box measures about 12 inches or it does not. However, the level and type of determinism in natural languages has evolved and reached a sweet spot. We are neither fully pedantic nor entirely vague in our use of a natural language. There is plenty of room for reasonable people to disagree about the meaning of the words, about how to categorize things. Is Pluto a planet? Well. It is a dwarf planet. Is that like a small planet or not a planet at all?

We silently make some assumptions. One of them is that the world can be understood in a top-down fashion&hellip; we start from abstract concepts and work our way to concrete cases. Peter Turney [argues](http://blog.apperceptual.com/logical-atoms) that though we think that &ldquo;red&rdquo; and &ldquo;ball&rdquo; are the fundamental logical atoms, the opposite might be true. We first get a &ldquo;red ball&rdquo; as the core logical atom, and the most abstract notions, such as &ldquo;red&rdquo; or &ldquo;ball&rdquo; are derived from the more concrete ones.

So far, I have been addressing the case of simple metadata. The kind that can help you determine whether a book was published in June or July of this year. But if you want to build &ldquo;intelligent&rdquo; software, you need a lot more than that. You need to represent your knowledge about the world in a formal form.

How hard is that? Let us turn to mathematicians. Surely representing mathematics formally is the easiest thing. If you can&rsquo;t formalize mathematics, what chances do you have in the real world? So for many decades, a collection of super smart mathematicians (under the pseudonym Bourbaki) attempted to give mathematics a formal foundation. It was interesting and challenging, but, ultimately, it just proved too difficult to pursue. 

But wait! Isn&rsquo;t Google able to go through your pictures and find all pictures of a cat? Isn&rsquo;t Google able to take a picture of your house and find out your street address? 

Yes. But this muscle behind these feats has little to do with the prowesses of metadata. You see, just as classical artificial intelligence folks pursued their dream of cataloging all knowledge and achieving intelligence in this manner&hellip; Other people thought that intelligence was more like a probabilistic engine. It is more about statistics than reasoning. We usually refer to this approach as &ldquo;machine learning&rdquo; meaning that the knowledge enters the machine through &ldquo;learning&rdquo;, and not through the wisdom of human experts.

The opposition between the two points of views has been entitled &ldquo;[Neats and scruffies](https://en.wikipedia.org/wiki/Neats_and_scruffies)&ldquo;. The metadata and formal reasoning people are in the &ldquo;neat&rdquo; camp, while others are in the scruffies.

Google is the child of the scruffies. Google does not hire large sets of experts to catalog knowledge, the overwhelming majority of their effort is invested in machine learning. Of course, given a web page, Google has metadata&hellip; but the bulk of this metadata was derived by the machine. 

Suppose you needed to build a representation of the world&hellip; would you recruit thousands of people who would fill out forms? How would you build software that can parse textbooks, Wikipedia, reference manuals&hellip;? The latter approach has to deal directly with ambiguity and contradictions, but it is also the only way to scale up to billions of facts.

So, at this point, if anyone asks you to invest a lot of time entering metadata in a system&hellip; you really ought to be skeptical. That&rsquo;s not the approach that has taken over the world. It is the approach that has failed again, and again to deliver the promised goods.

Let me summarize. Representing knowledge formally is hard. Harder than intuition dictates. It is really expensive. It does not fare well once adversarial interests come in. You usually end up with faulty, barely usable data, either because people did not make the effort, because they gamed the system or because they made honest mistakes. And that&rsquo;s for simple data such as maintaining an address book of your customers. Intelligent applications need finer representations, and then it gets really hard and expensive to get right. Meanwhile, approaches based on machine learning are getting better and better every year. They can defeat the best human players at most games, they can classify your pictures automatically, they can translate books for you&hellip; We have to embrace machine intelligence. The last thing we want our highly paid experts to do is to be filling out forms.

__Further study__: [Everything is Miscellaneous](https://www.youtube.com/watch?v=WHeta_YZ0oE) by David Weinberger.

__Credit__: Thanks to Andre Vellino and Antonio Badia for their valuable feedback and contributions.

