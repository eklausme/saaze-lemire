---
date: "2011-04-21 12:00:00"
title: "Ten things Computer Science tells us about bureaucrats"
---



Originally, the term computer applied to human beings. These days, it is increasingly difficult to distinguish reliably machines from human beings: we require ever more challenging [CAPTCHAs](https://en.wikipedia.org/wiki/CAPTCHA).

Machines are getting so good that I now prefer dealing with computers than bureaucrats. I much prefer to pay my taxes electronically, for example. Bureaucrats are rarely updated, and they tend to require constant attention like aging servers.

In any case, a bureaucracy is certainly an information processing &ldquo;machine&rdquo;. If each bureaucrat is a computer, then the bureaucracy is a computer network. What does Computer Science tell us about bureaucrats?

1. Bureaucracies are subject to the [halting problem](https://en.wikipedia.org/wiki/Halting_problem). That is, when facing a new problem, it is impossible to know whether the bureaucracy will ever find a solution. Have you ever wondered when the meeting would end? It may never end.
1. [Brewer&rsquo;s theorem](https://en.wikipedia.org/wiki/CAP_theorem) tell us that you cannot have consistency, availability and partition tolerance in a bureaucracy. For example, accounting departments freeze everything once a year. This unavailability is required to achieve yearly consistency.
1. [Parallel computing](https://en.wikipedia.org/wiki/Parallel_computing) is hard. You may think that splitting the work between ten bureaucrats would make it go ten times faster, but you are lucky if it goes faster at all.
1. One the cheapest way to improve the speed of a bureaucracy is caching. Keep track of what worked in the past. Keep your old forms and modify them instead of starting from scratch.
1. [Pipelining](https://en.wikipedia.org/wiki/Pipelining) is another great trick to improve performance. Instead of having bureaucrats finish the entire processing before they pass on the result, have them pass on their completed work as they finish it. If you have a long chain of bureaucrats, you can drastically speed up the processing.
1. Code refactoring often fails to improve efficiency. Correspondingly, shuffling a bureaucracy is just for show: it often fails to improve productivity.
1. Bureaucratic processes spend 80% of their time with 20% of the bureaucrats. Optimize them out.
1. Know your data structures: a good [organigram](https://en.wikipedia.org/wiki/Organigram) should be a balanced tree.
1. When an exception occurs, it goes back the ranks until a manager can handle it. If the CEO cannot handle it, then the whole organization will crash.
1. The computational complexity is often determined by looking at the loops. That is where your code will spend most of its time. In a bureaucracy, most of the work is repetitive.


__Update__: [Neal Lathia](http://www0.cs.ucl.ac.uk/staff/n.lathia/) commented that neither bureaucrats nor computers understand humor.

__Update:__ &ldquo;This is a fairly well-known model, and no it isn&rsquo;t computer science that is at the root of what you are noticing. It is early operations research. Taylorism in fact. There was a conscious effort in the 20s and 30s to bring Taylorist style a&hellip;ssembly line/operations research thinking into white collar work, starting with organizing pools of typists, secretaries and other office workers the same way banks of machine tools were organized into flow shops and assembly lines. The exact same Taylorist time-and-motion study tools were applied (in fact, in the 30s this was so popular that women&rsquo;s magazines carried articles about time-and-motion in the kitchen. Example: puzzles like &ldquo;what&rsquo;s the fastest way to toast 3 slices of bread on a pan that can hold 2 and toast 1 side at a time?) Computer science itself was initially strongly influenced by shopfloor OR&hellip; that&rsquo;s where metaphors like queues come from after all.&rdquo; ([Venkatesh Rao](http://www.ribbonfarm.com/about/))

