---
date: "2007-01-27 12:00:00"
title: "Duck Typing, Artificial Intelligence and Philosophy"
---


<img decoding="async" src="http://farm1.static.flickr.com/29/56499498_9f9f58bd2d_m.jpg" /><br/><small>([source](http://www.flickr.com/photos/archeon/))</small>

[Duck typing](https://en.wikipedia.org/wiki/Duck_typing) is the concept in programming by which an object is interchangeable with any other object as long as it can run through the same code while providing a sufficiently complete interface<sup>[1](#duck1)</sup>. It is a direct application of a popular idea: <q>If it walks like a duck and quacks like a duck, it must be a duck.</q> That is, you do not try to obtain proof that you have a duck, you just observe and see that, for the limited time your observation lasted, it appeared to be a duck. It might not be a duck, but you do not care. It is present in popular programming languages like Ruby, JavaScript and Python. Considering that Python is the prototyping language of choice of companies such as Google and JavaScript is ubiquitous on the Web, duck typing has become quite a common paradigm among programmers.

For the non programmers&hellip; Imagine you run a routine meant for ducks. First you weight the object, if it is over 2 kilograms, then you check the color of the feathers, if not you terminate the routine (because the duck is not ready to be eaten yet). Then you continue the routine based on the color of the feathers. Now, in this routine, a small rock will pass off as a duck, because you never check its feathers, but if you have a larger rock, then you will encounter a problem in your routine because you can&rsquo;t check the color of the feathers of a large rock.

Comparatively<sup>[2](#duck2)</sup>, many languages (Java, C#, C++, C) first check whether the object is a duck. They may allow it to be a special type of duck, but before the routine even runs, you need to prove you have duck first.

I have come to realize recently that duck typing is a central concept in artificial intelligence and philosophy. [Peter Turney](http://www.apperceptual.com/) argues again and again for the application of this principle, though he would not care to call it duck typing. What is the [Turing test](https://en.wikipedia.org/wiki/Turing_test), if not an example of duck typing? If you can substitute the human being by a machine, and things still work, then, you might as well say that the machine is human (for the purposes of determining whether it has human intelligence). If you can replace part of my brain by a computer, then isn&rsquo;t a computer as good as neural matter?

Imagine a similar problem in programming. You are a Python, JavaScript or Ruby programmer and you are asked whether this object can replace this other object. Or, to simplify the task, whether this function is a substitute to this other function. Specifically, you want to know if, once you have made the substitution, you will encounter any missing attributes.

How would you do it? Well, I might try switching one function for the other in some program. And if it works, I might be happy, but I have not really shown that one function can pass for the other, have I? It could still fail in another piece of code. I can falsify the question, but never get a truly positive answer. And no, in general, I cannot exhaust all possible tests to prove my case.

Strongly typed programming languages like Java, C++, C, C#, on the other hand, provide you a way to make sure, at compile-time, before the code even runs, that the interface is complete. And that is why duck typing is fundamentally different from static-typed polymorphism<sup>[3](#duck3)</sup>.

This brings about a few questions. In other words, how long must the machine fool the human being before we conclude that the Turing test is a success?

This is not just a theoretical concern. For example, my life is made slightly miserable because of all the spam I receive. For a time, the combined spam filters ACM and Google Mail made it ok. I was pleased with the result and I would have rated the filtering on par with what a bored human assistant could do. As of a few months ago, these spam filters no longer pass my little Turing test.

This is very common in Machine Learning and Artificial Intelligence. You see the textbook example and you think to yourself <q>wow! this is extraordinary!</q> But then, any long term, real-life exposure with the technique, and you realize how stupid it is. Sometimes it can remain useful (I wouldn&rsquo;t go without spam filters!), but it no longer fools you into thinking it is &ldquo;intelligent.&rdquo;

Similarly, if you use a large collection of text to determine the semantics of a word or a phrase, or to study analogies, you might get decent results for a time, but when the conditions change, things might go to hell. The Semantic Web is similarly plagued: you can never demonstrate that you have an accurate representation, but you can hope to eventually falsify it. 

(This reminds me of the [No Free Lunch](https://en.wikipedia.org/wiki/No_free_lunch_theorem) theorems. The best solutions are always local and contextual. )

I&rsquo;m sure that this is a very common objection to the Turing test or to Natural Language processing: there is no possible exhaustive testing. I think that the only remaining option is to limit the scope of these tests. That is, instead of using the somewhat ill-defined Turing test, you describe a very specific experiment, a very narrow one that can be reproduced exactly. The problem with this approach is that machines already pass such narrow tests.

In other words, as far as duck typing goes, there are many instances where you can already replace a human being by a machine.

Ah! So, I would argue that the Turing test is not a scientific test, really, but just a rather general paradigm, no different than duck typing.

Well, there is something even deeper, I think. Suppose that a machine could pass all my specific Turing tests, except for one of them. But I have an infinite number of tests, and only one of them could show the machine for what it really is. Then what? I have a probability of 0% of discovering the problem considering that the universe will not be around forever, let alone the human race. Would we conclude that the machine has human intelligence then?

To this [Stevan Harnad might answer](http://users.ecs.soton.ac.uk/harnad/Papers/Harnad/harnad92.turing.html) that <q>it is arbitrary to ask for more from a machine than I ask from a person, just because it&rsquo;s a machine.</q> I do not buy this argument. I am not certain whether I am the only intelligent person in the universe and you are all part of a conspiracy to fool me into thinking there are several of me. Yes, I&rsquo;m not insane and I tend to believe that other human beings roughly think and feel the way I do. But this is not arbitrary: human beings look a lot like me, down to their inner workings.

Another objection might come from relating the problem to the physical sciences. How do I know that gravity works? Yes, it has worked for many years, but how do I know that gravity always hold true. Well, I do not. It could be that there are part of the universe where gravity is absent or it could weaken one day. Why not?

All I know is that Newton&rsquo;s laws are useful. All I know is that my spam filters are useful. Going from &ldquo;this is a useful spam filter&rdquo; to &ldquo;this spam filter has human intelligence&rdquo; is a step I am not yet ready to make, even in principle. And why is that even a useful step to take? Even if we create machines that can pass the Turing test, will we know what intelligence is? It does not necessarily follow. People were able to create highly radioactive materials before they understood what it was. Will these machines be more useful that other machines? Would a machine that can pass 100,000 different Turing tests, necessarily be more useful that the machine that can only pass 99,000 Turing tests?

This has very concrete consequences if you accept my ideas. Research in Computer Science should therefore be focused on making machines useful. Whether or not they can pass some specific Turing tests, even a large number, seems totally secondary to me. Bring me a machine that can filter my spam mail with human-like ability, and I will be happy. Don&rsquo;t bother me by trying to prove to me that this machine is actually &ldquo;intelligent.&rdquo; I do not see why this is a useful concept. 

Hence, Computer Science should focus on usefulness criteria and reject other criteria.

(Yes, I am fishing for your objections.)

&mdash;

<a name="duck1">1</a>&#8211; Duck typing is a bit more complicated to define than what I did here. There is no specific interface to check. For example, consider this function:

<code><br/>
def f(o):<br/>
if(o.hasLegs):<br/>
o.danceWithMe()<br/>
</code>

In this instance, any object o not having the attribute &ldquo;hasLegs&rdquo; will fail. But any object having the attribute &ldquo;hasLegs&rdquo; with value false whenever it gets passed to this function will also do (whether it has the danceWithMe method or not). You see how it can be complicated to determine if a given object can be used with function f. It is probably equivalent to the [halting problem](https://en.wikipedia.org/wiki/Halting_problem). 

It is not the same thing as [polymorphism](https://en.wikipedia.org/wiki/Polymorphism_%28computer_science%29) because it requires that there be no static typing: the interface does not have to be complete, only sufficiently complete to run through the parts of the code that apply.

<a name="duck2">2</a>&#8211; As an aside, languages supporting duck typing are far more powerful than others in my opinion. Languages with static typing are based on the assumption that catching bugs earlier is better. They were largely influenced by the belief that we should prove our code to be correct. That is, that programming is like proving theorems. Except that they got it wrong. Designing algorithms is like proving theorems; programming is like sketching the plans of a building. Architects do not prove that their buildings are pretty and work. Architects design their buildings to be pretty and functional. There is a huge difference in spirit between proving and designing, but both are hard work.

<a name="duck2">3</a>&#8211; &hellip; and a poor model for reality.

