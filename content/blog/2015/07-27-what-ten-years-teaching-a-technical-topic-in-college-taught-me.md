---
date: "2015-07-27 12:00:00"
title: "What ten years teaching a technical topic in college taught me&#8230;"
---



Over ten years ago, XML was all the rage in information technology. XML was what the cool kids used to store, exchange and process data. By 2005, all the major computer science conferences featured papers on XML technology. Today, XML might safely be considered a legacy technology&hellip;
In any case, back in 2005, I decided to offer a course on XML that I still offer today. I got criticized a lot for this choice of topic by other professors. Some felt that the subject was too technical. Other felt that it was too easy.

Though the course is technical at times, I think it is fair to say that very few students felt that it is an &ldquo;easy&rdquo; course. And here I come to my first realization:

__1. Technical depth is hard.__

Give me any technical topic&hellip; how to build a compiler, how to process XML, how to design an application in JavaScript&hellip; and I can make a very hard course out of it. In fact, that is a common comment from my students: &ldquo;I thought the course would be easy&hellip; I was wrong.&rdquo;

And it is not just hard for the students&hellip; it is hard for the teacher too. Every year, some student comes up with an example that challenges my understanding. It is a bit like playing Chess&hellip; you can play for many years, and still learn new tricks.

A pleasant realization is that despite how hard the course ended up being, most students rate it very favourably. That is my second realization&hellip;

__2. Many students enjoy technical topics.__

You would not think that this true given how few technical courses you find on campus. And I must say that I am slightly biased against technical courses myself&hellip; they sound boring&hellip; But I think that the reason the students end up finding them interesting is that they get to solve problems that they feel are relevant. I found that the ability to work hard on a problem depends very much on how relevant it seems to the student.

I also find practical topics more satisfying as a teacher because I have an easier time coming up with fun and useful examples. I do not struggle to make the course feel relevant to the students.

I was heavily criticized by academics when I first launched the course for mostly sticking with the core XML technologies (XSLT 1.0, XPath 1.0, DOM, DTD). This turned out to be a wise choice. In fact, in the sense that my course has evolved over ten years, it goes deeper into the core topics rather than covering more ground. Many of the topics that academics felt were important ten years ago have never picked up steam.

__3. Academics view the future as ever more complex whereas practice often prunes unnecessary complexities.__

Most technical subjects follow a Pareto law: 80% of the applications require the use of only 20% of the specifications. Thus, when teaching a technical topic, you can safely focus on the 20% that makes up the core of the subject. And that is a good thing because it allows you to dig deeply.

If you go around and check resumes, you will find plenty of people who list XML as a skill. Typically, this means that they are familiar with most of the basics. However, unless they have taken time to specialize in the topic, their understanding is probably quite shallow as any interview may reveal.

My favorite example is CSS. CSS is used on most web sites to format the HTML. However, 99% of the users of CSS treat it as a voodoo technology: use trial and error until the CSS does what you want. With complicated applications, this becomes problematic. Taking the time to really understand how CSS works can make a big difference.

Another example is performance&hellip; again, many people try to improve processing speed through trial and error&hellip; this works well in simple cases, but once the problem becomes large, it fails to scale up. That is why companies pay the big bucks to engineers with a deep understanding of the technology.

In fact, I suspect that professional status depends a lot more on how deep your understanding is than how broad it is. Anyhow can pick up ten books and skim them&hellip; but really understanding what is going on is much more difficult. For one thing, it is often not quite spelled out in books&hellip; real understanding often requires real practice. So challenging students to go deep is probably the best way to help them.

So I think that the best thing you can do for students is to encourage them to go deep in the topic.

__4. With technical topics, depth is better than breadth.__

One objection to this strategy is that companies like Google openly favour &ldquo;generalists&rdquo; ([1](http://www.forbes.com/sites/georgeanders/2014/10/21/googles-people-chief-laszlo-bock-explains-how-to-hire-right/), [2](http://whenihavetime.com/2014/10/22/how-google-manages-talent-generalists-vs-specialists/)), but I do not think it contradicts my view: I hope to encourage my students to learn the basics really well rather than to get bogged down with many specific technologies. But even if my view does contradict Google&rsquo;s recruiting standards, there is still a practical aspect: you can collect lots of expertise in many things, but chances that most of this expertise will be obsolete in a few years.

In my case, I was lucky: XML remains an important piece of technology in 2015. But that is not entirely a matter of luck: by the time I decided to make a course out of it, XML was already deeply integrated in databases, web applications and so on. Moreover, it was supported by its similarity with HTML. So I felt confident it would still be around in ten years. Now, in 2015, I can confidently say that XML is there for the long haul: all your ebooks are in XML, all your Office documents are in XML&hellip;
However, how we view XML has changed a lot. Back in 2005, XML was a standard data interchange format. There was also a huge industry around it. Much of it has collapsed. In many ways, support for XML is stagnating. We still have pesky configuration files in XML, but that is no longer considered automatically to be a good thing. We prefer to exchange data using JSON, a much simpler format.

When I started out, some students blamed me for not covering specific XML technologies&hellip; like particular libraries offered by XML. Professors wanted me to cover exoteric web services. Most of what I was asked to cover years ago has become obsolete.

More critically, I was forced to revisit many times the material offered to the students. But that keeps the course fun for me: I like learning about new technologies&hellip; so when JSON came about, I enjoyed having to learn about it. I probably went deeper in the topic than most.

__5. If you are a technology enthusiast, keeping a technical course up-to-date can be fun.__

Another piece of contention with technical courses is that they are not &ldquo;the real thing&rdquo;. College is supposed to teach you the grand ideas&hellip; and everything else is just straight applications. So if you know about data structures and Turing machines, learning to write a spreadsheet in XSLT is just monkey work.

But I have found the students quite easily cope with more theory once they have practical experience. For example, it is quite easy to discuss Turing-completeness once you have covered XSLT, XPath, CSS&hellip; and then you can have fun pointing out that most of these do end up being Turing-complete (albeit, in a contrive way sometimes).

__6. Going from a deep technical knowledge to theory is relatively easy for many students.__

Though I am probably biased, I find that it is a lot harder to take students from a theoretical understanding to a practical one&hellip; than to take someone with practical skills and teach him the theory. My instinct is that most people can more easily acquire an in-depth practical knowledge through practice (since the content is relevant) and they then can build on this knowledge to acquire the theory.

To put it another way, it is probably easier to first teach someone how to build an engine and then teach thermodynamics, than to do it in reverse. It helps that it is the natural order: we first built engines and then we came up with thermodynamics.

To put it differently, a good example, well understood, is worth a hundred theorems. And that is really the core lesson I have learned. Teaching a technical topic is mostly about presenting elaborate and relevant examples from which students can infer more general ideas.

So my next course is going to be a deeply technical course about advanced programming techniques. I am not going to shy away from getting students to study technical programming techniques. Yes, the course will pay lip service to the big ideas computer science is supposed to be teaching&hellip; but the meat of the course will be technical examples and practice.

