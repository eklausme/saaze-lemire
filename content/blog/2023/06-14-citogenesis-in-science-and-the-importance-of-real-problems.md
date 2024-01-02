---
date: "2023-06-14 12:00:00"
title: "Citogenesis in science and the importance of real problems"
---



Scientists publish papers in refereed journals and conferences: they write up their results and we ask anonymous referees to assess it. If the work is published, presumably because the anonymous referees found nothing objectionable, the published paper joins the &ldquo;literature&rdquo;.

It is not a strict requirement: you can do excellent research without publishing in refereed journals. [Einstein refused to publish in refereed journals](https://mindmatters.ai/2020/05/einsteins-only-rejected-paper/). The famous computer scientist Dijkstra mostly published his work in the form of letters he would send to his friends: today, we would refer to this model as a blog. Dijkstra invited computer scientists [to become independent of peer review](/lemire/blog/2009/10/26/become-independent-of-peer-review/) as he viewed the peer review process as a path toward mediocrity. More recently, [the folks from OpenAI appear to mostly publish unrefereed online papers](https://openai.com/research). Yet OpenAI has probably produced the greatest scientific breakthrough of the decade.

Unfortunately, some people confuse &ldquo;science&rdquo; with the publication of refereed papers. They may also confuse our current knowledge with what is currently published in refereed journals.

Many papers in Computer Science tell the following story:

- There is a pre-existing problem <em>P</em>.
- There are few relatively simple but effective solutions to problem <em>P</em>. Among them is solution <em>X</em>.
- We came up with a new solution <em>X</em>+ which is a clever variation on <em>X</em>. It looks good on paper.
- We ran some experiments and tweaked our results until <em>X</em>+ looked good. We found a clever way to avoid comparing <em>X</em>+ and _X_ directly and fairly, as it might then become obvious that the gains are small, or even negative! They may think: <em>We would gladly report negative results, but then our paper could not be published</em>. Some years ago, I attended a talk by a highly productive research who was providing advice to the students: <em>never run an experiment unless you are sure you can turn it into a positive result</em>.


It seems hard to believe that you can make sure that all your ideas turn out to be correct. But it is not so difficult. A popular approach to get positive results is to use a model as validation. Testing in the real world takes a lot of effort and your results could be negative, so why bother? Even when running experiments in the real world, there are many ways to cheat to ensure you get the result you need.

<a href="http://xkcd.com/978/"><img decoding="async" style="float: right; margin: 5px; width: 200px;" src="http://imgs.xkcd.com/comics/citogenesis.png" /></a>

It looks harmless enough: just people trying to build up their careers. But there might be real harm down the line. Sometimes, especially if the authors are famous and the idea is compelling, the results will spread. People will adopt <em>X</em>+ and cite it in their work. And the more they cite it, the more enticing it is to use <em>X</em>+ as every citation becomes further validation for <em>X</em>+. And why bother with algorithm _X_ given that it is older and <em>X</em>+ is the state-of-the-art?

Occasionally, someone might try both _X_ and <em>X</em>+, and they may report results showing that the gains due to <em>X</em>+ are small, or negative. But they have no incentive to make a big deal of it because they are trying to propose yet another better algorithm (<em>X</em>++).

This process is called [citogenesis](http://xkcd.com/978/). It is what happens when the truth is determined solely by the literature, not by independent experiments. Everyone assumes, implicitly, that <em>X</em>+ is better than <em>X</em>. The beauty of it is that you do not even need for anyone to have claimed so. You simply need to say that <em>X</em>+ is currently considered the best technique.

Some claim that [science is self-correcting](/lemire/blog/2010/09/17/can-science-be-wrong-you-bet/). People will stop using <em>X</em>+ or someone will try to make a name for himself by proving that <em>X</em>+ is no better and maybe worse than <em>X</em>. But in a business of science driven by publications, it is not clear why it should happen. Publishing that <em>X</em>+ is no better than _X_ is an [unimpressive negative result](/lemire/blog/archives/2008/10/28/when-in-doubts-prefer-unimpressive-negative-results/) and those are rarely presented in prestigious venues.

Of course, the next generation of scientist may have an incentive to displace old ideas. There is an intergenerational competition. If you are young and you want to make a name for yourself, displacing the ideas of the older people is a decent strategy. So it is credible that science may self-correct, one funeral at a time:

> A new scientific truth does not triumph by convincing its opponents and making them see the light, but rather because its opponents eventually die (&hellip;) An important scientific innovation rarely makes its way by gradually winning over and converting its opponents (&hellip;) What does happen is that its opponents gradually die out, and that the growing generation is familiarized with the ideas from the beginning: another instance of the fact that the future lies with the youth.
— <cite>Max Planck, Scientific autobiography, 1950, p. 33, 97</cite>


There are cases where self-correction does happen: if there is a free market and the scientific result can make a difference by offering a better product or a better service. That is why computer science has made so much progress, so rapidly: we have clients that will adopt our ideas if they are worthwhile. Once your new idea is in the smartphones, it is hard to deny that it works. Similarly, we know that Physics work because we have nuclear bombs and space exploration. What keeps us honest are the <em>real problems</em>.


John Regehr made a similar point about [our inability to address mistakes](http://blog.regehr.org/archives/667) in the literature:

> In many cases an honest retrospective would need to be a bit brutal, for example to indicate which papers really just were not good ideas (of course some of these will have won best paper awards). In the old days, these retrospectives would have required a venue willing to publish them, (&hellip;), but today they could be uploaded to arXiv. I would totally read and cite these papers if they existed (&hellip;)


But there is hope! If problem _P_ is a real problem, for example, a problem that engineers are trying to solve, then you can get actual and reliable validation. Good software engineers do not trust research papers: they run experiments. Is this algorithm faster, really? They verify.

We can actually see this effect. Talk to any Computer Scientist and he will tell you of clever algorithms that have never been adopted by the industry. Most often, there is an implication that industry is backward and that it should pay more attention to academic results. However, I suspect that in a lot of cases, the engineers have voted against <em>X</em>+ and in favor of _X_ after assessing them, fairly and directly. That is what you do when you are working on real problems and really need good results.

It gets trickier in fields such a medicine because success may not ever be measured. Do you know if your doctor is more likely to cure you than another doctor? They may not even know themselves. So you need to work on problems where people measure the results, and where they have an incentive to  adopt ideas that work. In effect, you need real problems with people who have [skin in the game](https://en.wikipedia.org/wiki/Skin_in_the_game_(phrase)).

<span data-offset-key="dmfui-0-0">We fall too often for the [reification fallacy](https://en.wikipedia.org/wiki/Reification_(fallacy))</span><span data-offset-key="dmfui-2-0">. </span>A science paper is a like a map. You can create a map of a whole new territory, even if you have never been there. The new territory might exist or it might not exist, or it could be quite different from what you have described. If you never visit the territory, if nobody visits the territory in question, then you may never find out about your mistake. In effect, we need actual explorers, not just map makers.


<span data-offset-key="7onh3-0-0"> </span>


<span data-offset-key="23ouj-0-0">And adding more map makers, and more maps, does not help. In some sense, it makes things harder. Who is going to compare all these maps? We need more explorers.</span>


