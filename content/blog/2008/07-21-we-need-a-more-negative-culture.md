---
date: "2008-07-21 12:00:00"
title: "We need a more negative culture"
---



There is a strong bias in science, at least in Computer Science, toward positive results. For example, showing that algorithm A is better than algorithm B, will get you published. Reporting the opposite result is likely to get your paper rejected.

One justification for the value of positive results is that it gives you more information. Indeed, there is infinite number of possibilities. Listing all the cases that are of no interest would take too long. We better focus on what works!

This argument is fallacious since it ignores one of the pillars of science: reproducibility. By taking away the possibility of publishing negative results, we basically throw away the most important reason why we require reproducibility: to verify what others have done.

Times and times again, I come across falsehoods in science. Typically, they occur when reporting experimental results that are either badly interpreted or badly implemented. Here is a typical scenario:

- Researcher A publishes some paper where he makes some false statement.- The statement is compelling. It matches people&rsquo;s intuition.- The work becomes well known and is repeatedly cited.- Other researchers build upon the falsehood. They either do not verify the statement (where is the profit in that?) or if they do, they avoid denouncing the falsehood.


Eventually, the statement because an accepted fact. Anyone who wants to challenge it has the burden of proof, and it is easy to cast doubts on any experimental procedure. I claim that this happens often. As someone who crafts my own experiments, I see it all the time. I am repeatedly unable to reproduce &ldquo;accepted facts&rdquo;. Yet, I never (or almost never) report these problems because trying to do so would ensure that whatever paper I produce is frowned upon. Moreover, I believe few people ever attempt to verify published results. What makes matters worse is that trying to reproduce experiments is never considered serious work in Computer Science. Often, it is quite a difficult task too: either the data or the code is missing or barely available.

What bothers me is not so much the falsehoods, but the fact that it tends to feed into the biases of entire communities. People expect certain things, and they filter out any &ldquo;negative&rdquo; result, and protect &ldquo;positive&rdquo; results even when such results are not solid. Entire fields are therefore being built on shaky foundations.

We have made some progress recently in Computer Science regarding reproducibility. There are more conferences and journals asking researchers to make their data and code available. However, I believe that culturally, we still have a long way to go.

