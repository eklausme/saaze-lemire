---
date: "2012-06-18 12:00:00"
title: "On the quality of academic software"
---



Software is eating the world. Despite a poor year, Facebook has a market capitalization of $65 billion. This little company with barely 2000 developers is worth as much as a car marker.

Students should take notice. I would expect countless students to come to college demanding top-notch software training. I would expect graduate students to produce gorgeous software programs.

Yet software produced in universities and colleges is awful, and it is not getting better. I have an explanation:

- Most professors spent little time programming. And because they don&rsquo;t program, they do not enforce good practices such as [code reviews](https://plus.google.com/+PhilippeBeaudoin/posts/QhaqUF7N7My) and unit testing. Don&rsquo;t believe me? Try to look up your favorite professor on [GitHub](https://github.com/). Does he proudly display the code he produced? 
- Because few professors program, it should not come as a surprise that there are few, if any, publication outlets for academic researchers who want to present their software products. In turn, it means that if you produce high quality software, few of your academic peers will even know about it.
- Most academic software is written by students who lack the experience and the incentives to produce good software. You would think that after spending four years in college and attending countless classes where they have programming assignments, most computer science and engineering students would be decent programmers. That is not my experience. And part of the reason is that schooling is a process by which you emulate your teachers. I am sure that if you attend four years of schooling with [Linus Torvalds](https://en.wikipedia.org/wiki/Linus_Torvalds), you would become a decent kernel programmer. However, Linus is not, nor is he ever likely to be, a college professor. College professors don&rsquo;t spend much time programming and neither do their students. 


So, academic software is awful because academic folks aren&rsquo;t that great at programming. But there are also other factors involved:

- Programming can be as easy as cooking eggs or building a bird house. That is, it is not very difficult to write a PHP script to display the content of a database inside a browser. But producing novel software requires the programmer to act as [creator](https://www.nczonline.net/blog/2012/06/12/the-care-and-feeding-of-software-engineers-or-why-engineers-are-grumpy/). While your programming classes might teach you how to cook an egg (metaphorically speaking), they fall short of teaching you how to design a new dish for a 4-star restaurant.

And the bar for novelty is lower than you might expect. Given an algorithm taken out from a research paper, dozens of implementations are possible, most of them inefficient. It takes a lot of work and experience to come up with the right design __even if the full pseudo-code is provided to you__. And making sure you implemented it properly can be much harder than one expects. 

There is very little appreciation for this fact among theoreticians who often believe that the hard part is designing an algorithm with nice theoretical properties. They fail to recognize that there might be orders of magnitude differences in speed between two algorithms having the same computational complexity.

In effect, suppose you were provided a summary of Stephen King&rsquo;s next novel. Could you beat King to it and produce as good a novel? Doubtful. Software is similar. Execution is everything. A clever plot is worthless.
- Most academic researchers write software for themselves. As [Cook put it](http://www.johndcook.com/blog/2012/05/30/writing-software-for-someone-else/): &ldquo;People who have only written software for their own use have no idea how much work goes into writing software for others.&rdquo; Cooking your own food is a lot easier than being a chef in a restaurant. The difference between the two is at least an order of magnitude, if not two.

There is very little appreciation for this fact in academia. The default is to write throw-away code: you write the code, you use it and you forget about it. Issues like maintenance and documentation are discussed at length in some classes, but it is rarely put in practice within academia.


So, what about the future? I remain pessimistic regarding academic software. There will always be exceptions, but as a rule, I expect mediocrity to remain. Hence, when I review a research paper or a thesis, I expect the software supporting it to be awful. And I expect whoever hires new programmers to think the same. And there is a practical consequence to my pessimism: perhaps if you hope to get a job as a Facebook engineer, you ought to spend more time on [GitHub](https://github.com/) and less time in the classroom. If you are lucky, you might convince your school to grant you a few credits for your open source work.

__Further reading__: In a recent blog post, Google&rsquo;s [Matt Welsh states that he wasted millions of dollars](http://matt-welsh.blogspot.ca/2012/06/startup-university.html) as a Harvard professor. How? By producing software prototypes that were later thrown away. Maybe his code could have stood the test of time if only the university had better supported its commercialization. I have my doubts.

You might also want to read [In the long run&hellip;](http://blog.geomblog.org/2012/05/in-long-run.html) by Suresh Venkat for a description of the distance between software practice and theoretical computer science.

