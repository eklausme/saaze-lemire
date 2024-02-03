---
date: "2012-03-20 12:00:00"
title: "From counting citations to measuring usage (help needed!)"
---



We sometimes measure the caliber of a researcher by how many research papers he wrote. This is silly. While there is some correlation between quantity and quality &mdash; people like Einstein tend to publish a lot &mdash; it can be gamed easily. Moreover, several major researchers have published relatively few papers: [John Nash](https://en.wikipedia.org/wiki/John_Forbes_Nash,_Jr.) has about two dozens papers in Scopus. Even if you don&rsquo;t know much about science, I am sure you can think of a few writers who have written only a couple of books but are still world famous.

A better measure is the number of citations a researcher has received. [Google Scholar profiles](https://scholar.google.com/citations?user=q1ja-G8AAAAJ) display the citation record of researchers prominently. It is a slightly more robust measure, but it is still silly because 90% of citations are shallow: most authors haven&rsquo;t even read the paper they are citing. We tend to cite famous authors and famous venues in the hope that some of the prestige will get reflected.

But why stop there? We have the technology to measure the usage made of a cited paper. Some citations are more significant: for example it can be an extension of the cited paper. Machine learning techniques can measure the impact of your papers based on how much following papers build on your results. Why isn&rsquo;t it done?

People object that defining a metric based on machine learning is troublesome. However, we rely daily on spam filters, search engines and recommender systems that we do not fully understand. Measures that are beyond our ability to compute by hand have repeatedly proven useful. Moreover, identifying important citations can have other applications:

- Google Scholar says that I am cited about 160 times a year. On average, a paper citing me comes out every two days. What does it mean? I don&rsquo;t know. I would be interested in identifying quickly which papers make non-trivial use of my ideas. I am sure many researchers would be interested too!
- I sometimes stumble on older highly cited papers. I want to quickly identify the significant follow-up papers. Yet I am often faced with a sea of barely relevant papers that merely cited the reference in passing. It would be tremendously useful for me to know which papers have cited the reference meaningfully.


Hence, I surveyed the machine learning literature on classifying citations. I found high quality work, but I feel it is an under-appreciated problem. So I got in touch with [Peter Turney](http://nova.apperceptual.com/) and [Andre Vellino](http://web.ncf.ca/andre/) and we decided to promote this problem further.

Our first step is to collect a data set of papers together with their most important references. We believe that the best experts to determine what are the crucial references are the authors themselves!

So, if you are a published researcher, we ask you to contribute by [filling out our short online form](https://docs.google.com/spreadsheet/viewform?formkey=dHlDalFfR1AzTXpaRXA2WEVlRUF5b0E6MA#gid=0). On this form, you will be asked for your name and a few papers together with an identification of the crucial references for each paper. The form can take less than 30 seconds to fill out.

In exchange, we will publish the data we collect under the [ODC Public Domain Dedication and Licence](http://opendatacommons.org/licenses/pddl/1-0/). If you leave us your email, we will even tell you when the data is publicly available. Such a public high-quality data set should entice a few researchers to write papers. And, of course, I might contribute to such a paper myself.

My long-term goal is simple: I hope that in a couple of years, Google Scholar will differentiate between citations and &ldquo;meaningful&rdquo; citations.

Now go fill out the [form](https://docs.google.com/spreadsheet/viewform?formkey=dHlDalFfR1AzTXpaRXA2WEVlRUF5b0E6MA#gid=0)!

__Note__: I have [an earlier version of this post](https://plus.google.com/105888615414982242080/posts/P5afw9AU5FD) on Google+ with several insightful comments.

__Further reading__: [Building a Better Citation Index](http://synthese.wordpress.com/2012/03/20/building-a-better-citation-index/) by Andre Vellino

__Update__: [The dataset is available](https://lemire.me/citationdata/).

