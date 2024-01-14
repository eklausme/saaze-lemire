---
date: "2015-07-03 12:00:00"
title: "Would an artificial intelligence &#8220;grow old&#8221;?"
---



Old software tends to fail. If you upgrade to the last version of Windows, your old applications may fail to run. This is typically caused by a lack of update and commonly called bit rot. That is, if you stop maintaining software, it loses its usefulness because it is no longer in sync with current environments. There are many underlying causes of bit rot: e.g., companies that stop supporting software let it fall to bit rot.

To the contrary, [Robin Hanson](https://en.wikipedia.org/wiki/Robin_Hanson), a famous economist, [believes that software becomes increasingly inflexible as we update it](https://mobile.twitter.com/robinhanson/status/616425480279982080). That is, the more software engineers work on a piece of software, the worse it becomes until we have no choice but to throw it away. To put it another way, you only can modify a given piece of software a small number of times before it crumbles.

Let me state Hanson&rsquo;s conjecture more formally.

> __Hanson&rsquo;s law of computing__: Any software system, including advanced intelligences, is bound to decline over time. It becomes less flexible and more fragile.


The matter could be of consequence in the far future&hellip; For example, would an artificial intelligence &ldquo;grow old&rdquo;? If you could somehow make human beings immortal, would their minds grow old?

We could justify this law by analogy with human beings. As we grow older, we become less mentally flexible and our fluid intelligence diminishes. The reduced flexibility could be explained in terms of economics alone: there is less benefit in acquiring new skills when you can already make a living with what you know. So we expect, using economics alone, new fields to be populated by the young. But, in human beings, we also know that the brain undergoes physical damages. The [connectome](https://en.wikipedia.org/wiki/Connectome) degrades. Important hormones become lacking. The brain becomes inflamed and possibly infected. We lose neurons. All of this damage makes our brain more fragile over time. Indeed, if you make it to 90 years old, you have a chance out of three to suffer from dementia. None of these physical problems are likely to affect an artificial intelligence. And there is strong evidence that [all this physical damage to our brain could be stopped or ever reversed](https://www.youtube.com/watch?v=9D1AwQ0lTsg) in the next twenty years if medical progress continues at high speed.

Hanson proposes that the updates themselves damage any software system. So, to live a long time, an artificial intelligence might need to limit how much it learns.

I am arguing back that the open source framework running the Internet, and serving as a foundation for companies like Google and Apple, is a counterexample. Apache, the most important web server software today, is an old piece of technology whose name is a play on words (&ldquo;a patched server&rdquo;) indicating that it has been massively patched. The Linux kernel itself runs much of the Internet, and has served as the basis for the Android kernel. It has been heavily updated&hellip; Linus Torvalds wrote the original Linux kernel as a tool to run Unix on 386 PCs&hellip; Modern-day Linux is thousands of times more flexible.

So we have evolved from writing everything from scratch (in the seventies) to massively reusing and updated pre-existing software. And yet, the software industry is the most flexible, fast-growing industry on the planet. In my mind, the reason software is eating the world is that we can build upon existing software and thus, improve what we can do at an exponential rate. If every start-up had to build its own database engine, its own web server&hellip; it would still cost millions of dollars to do anything. And that is exactly what would happen if old software grew inflexible: to apply Apache or MySQL to the need of your start-up, you would need to rewrite them first&hellip; a costly endeavor.

The examples do not stop with open source software. Oracle is very old, but still trusted by corporations worldwide. Is it &ldquo;inflexible&rdquo;? It is far more flexible than it ever was&hellip; Evidently, Oracle was not built from the ground up to run on thousands of servers in a cloud environment. So some companies are replacing Oracle with more recent alternatives. But they are not doing so because Oracle has gotten worse, or that Oracle engineers cannot keep up.

When I program in Java, I use an API that dates back to 1998 if not earlier. It has been repeatedly updated and it has become more flexible as a result&hellip; Newer programming languages are often interesting, but they are typically less flexible at first than older languages. Everything else being equal, older languages perform better and are faster. They improve over time.

Hanson does not provide a mechanism to back up his bit-rot conjecture. However, it would seem, intuitively, that more complex software becomes more difficult to modify. Applying any one change is more likely to create trouble in more complex projects. But, just like writers of non-fiction still manage to write large volumes without ending with an incoherent mass, software programmers have learned to cope with very large and very complex endeavors. For example, the Linux kernel has over 20 million lines of code contributed by over 14,000 programmers. Millions of new codes are added every year. These millions of lines of code far exceed the memory capacity of any one programmer.

How is this possible?

- One ingredient is modularity. There are pieces of code responsible some actions and not others. For example, if you cannot get sound out of your mobile phone, the cause likely does not lie in any one of millions of lines of code but can be quickly narrowed down to, say, the sound driver, which may only have a few thousand lines of code.We have strong evidence that the brain works in a similar way. There is neuroplasticity, but even so, given tasks as assigned to given neurons. So a stroke (that destroys neurons) could make you blind or prevent you from walking, but maybe not both things at once. And someone who forgets how to read, due to loss of neurons, might not be otherwise impaired.
- Another important element is abstraction which is a sophisticated form of modularity. For example, the software the plays a song on your computer is distinct from the software that interfaces with the sound chip. There are high and low-level functions. The human mind works this way as well. When you play football, you can think about the strategy without getting bogged down in the ball throwing techniques.


Software engineers have learned many other techniques to make sure that software gets better, not worse with updates. We have extensive test frameworks, great IDEs, version control, and so on.

However, there are concepts related to Hanson&rsquo;s notion of bit rot.

<li style="list-style-type: none;">

- Programmers, especially young programmers, often prefer to start from scratch. Why learn to use a testing framework? Write your own! Why learn to use a web server? Write your own! Why do programmers feel that way? In part, because it is much more fun to write code than to read code, while both are equally hard.That taste for fresh code is not an indication that starting from scratch is a good habit. Quite the opposite!

Good programmers produce as little new code as they can. They do not write their own database engines, they do not write their own web servers&hellip;

I believe our brains work the same way. As much as possible, we try to reuse routines. For example, I probably use many of the same neurons whether I write in French or English.
- Software evolves through competition and selection. For example, there are probably hundreds of software libraries to help you with any one task. New ones get written all the time, trying to outcompete the older ones by building on new ideas.The brain does that all the time. For example, I had self-taught myself a way to determine if a number could be divided by 7. There was a part of my brain that could run through such computations. While teaching my son, I learned a much better way to do it. Today I can barely remember how I used to do it. I have switched to the new mode. Similarly, the Linux kernel routine switches drivers of components for new ones.
- A related issue is that of &ldquo;technical debt&rdquo;. When programmers complain of crippling growing pain with software&hellip; that is often what they allude to. In effect, it is a scenario whereas the programmers have quickly adapted to new circumstances, but without solid testing, documentation, and design. The software is known to be flawed and difficult, but it is not updated because it &ldquo;works&rdquo;. Brains do experience this same effect. For example, if you take a class and learn just enough to pass the tests&hellip; you have accumulated technical debt: if you ever need your knowledge for anything else, you will have to go back and relearn the material. You have made the assumption that you will not need to build on this new expertise. But that is as likely to affect young software and young brains.A corporation without a strong software culture often suffers from &ldquo;technical debt&rdquo;. The software is built to spec&hellip; and does what it must do, and not much else. That is like &ldquo;knowing just enough to pass the test&rdquo;.

With people, we detect technical debt by experience: if the young accounting graduate cannot cope with the real-world, he probably studied too closely to the tests. With software, we use the same criterion: good software is software that has been used repeatedly in different contexts. In some sense, therefore, technical debt is flushed out by experience.
- What about having to search through an ever-expanding memory bank? That assumes that people, as they grow older, pursue exhaustive searches. But that is how intelligence has to work, and I do not think that is how human being works. When faced with a new case, we do not mentally review all related cases. Instead, we maintain a set of useful heuristics. And, over time, we let go of rarely used data and heuristics. For example, I once learned to play the flute, nearly forty years ago. Some of these memories are with me, but it is very unlikely that they are slowing me down for non-flute-related activities. Again, here we can exploit modularity&hellip; one can forget to play the flute without forgetting<br/>
everything else.Search algorithms do not get slower proportionally with the size of the databank. If this were so, Google&rsquo;s search engine would slow to a crawl. We have built lots of expertise on how to search efficiently.



Abstraction leaks: to make our software, we use high-level functions that run other functions and then more functions&hellip; down to processor instructions. Over time we use higher and higher levels of abstraction. A single mistake or undefined behavior at any one level, and we produce an erroneous or unexpected result.

That might be a rather fundamental limitation of software systems. That is, any sufficiently advanced system might produce erroneous and unexpected results. This probably puts a limit to how much abstraction one can do without much effort given the same &ldquo;brain&rdquo;.

In any case, for Hanson&rsquo;s conjecture to hold, one should be able to measure &ldquo;software age&rdquo;. We should be able to measure the damage done by the programmers as they work on the software. There would be some kind of limit to the number of modifications we can make to a piece of software. There would be a limit to what an artificial intelligence could learn&hellip; And we would need to observe that software being aggressively developed (e.g., the Linux kernel) grows old faster than software that is infrequently modified. But I believe the opposite is true: software that has been aggressively developed over many years is more likely to be robust and flexible.

Of course, the range of problems we can solve with software is infinite. So people like me keep on producing more and more software. Most of it will hardly be used, but the very best projects end up receiving more &ldquo;love&rdquo; (more updates) and they grow more useful, more robust and more flexible as a result.

I see no reason for why an artificial intelligence could not, for all practical purposes, be immortal. It could keep on learning and expanding nearly forever. Of course, unless the environment changes, it would hit diminishing returns&hellip; still, I expect older artificial intelligences to be better at most things than younger ones.

