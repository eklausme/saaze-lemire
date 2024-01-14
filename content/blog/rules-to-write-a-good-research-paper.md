---
title: "Write good papers"
index: false
---



> bb<img decoding="async" src="http://farm2.static.flickr.com/1249/852253335_6c40c8dc09_m.jpg" alt /><br/>
<small>([Source](http://www.flickr.com/photos/saar_cmd/))</small>



__1. Picking a topic, an idea__

My friend Peter Turney has a key piece of advice: be __ambitious__. Imagine each new paper you write as a lasting reference for your peers. Aim to have a lasting impact on your field.

I know of three strategies to write an ambitious paper:

- Pick a new problem. Define the problem. Be the first to propose a solution. The problem should be simple and concrete. This is the best way to get highly cited and become famous.
- Try to explain something significant nobody has managed to explain.
- Improve by a wide margin what others have done. Can you reduce the error rate by half? Can you double the speed? Don&rsquo;t waste our time with incremental gains (e.g., 10% faster).


__2. Before you ever pick up your pen&hellip;__

- What is your message? What point are you making? Most papers should make a single point.
- Why is this message important? Why should the reader take his precious time to read your paper?
- How are you going to make your point? What experiments can you run? What theorems can you prove?
- Has this point been made before? How is your contribution different from what has been said a thousand times before?


__3. What a good paper should contain__

- A sexy start: tell the reader early why he should read your paper. Don&rsquo;t summarize, sell! A good abstract tells us __why we should read this paper__, it does not summarize the paper. Convince us early that your paper is important. For example, the Kent Beck recipe for a good 4-sentence abstract is: (1) state the problem (2) say why it is interesting (3) say what your solution achieves (4) say what follows from your solution.
- You should clearly say what your contribution is. Reviewers are lazy, they do not want to have to figure out what your message is. Spend some time telling us exactly what your contribution is. Spell it out, do not assume we will read the paper carefully.
- A review of related work in the introduction:  you can relate your own contribution to all of the related work.
- A large reference section: people like to be cited, so make sure you cite every paper that might have some relevance.
- Experimental evidence: you need to confront your idea with the real world and report on how well it fares. Compare explicitly your results with the best results elsewhere.
- Acknowledge the limitations of your work.
- Relevant and non-obvious theoretical results: it is easier for people to build on your work if there is some theory.
- Pictures! Really, even if you feel silly doing it or that you think you can&rsquo;t draw. A picture can help tremendously in communicating difficult ideas.
- Original examples over original data sets.
- A conclusion telling us about future work and summarizing (again) the strong points of the paper.


__5. What a good paper should not contain__

- Remove [Chekhov&rsquo;s gun](https://en.wikipedia.org/wiki/Chekhov's_gun): if it is not useful to the reader, take it out!
- Weak unnecessary results: if you derived ten theorems but only one is necessary, throw the rest of them in your drawers. I do not want to know about useless results!
- Technical details: technical papers made of several small ideas are usually uninteresting. If you must include a lot of software code or technical specifications, try to provide it in an appendix, or use as few compact figures or tables as you can. Avoid lengthy and complicated formulas.


__6. Good pedagogy and style__

- Use strong verbs (replace &ldquo;we made use of categorization&rdquo; by &ldquo;we categorized&rdquo;).
- Always give the example first, and the result next.
- Use as few parenthesis, footnotes and bold characters as you can.
- Use a spell checker. Just do it.
- Learn about [significant digits](/lemire/blog/2012/04/20/computer-scientists-need-to-learn-about-significant-digits/).
- Use a tool such as [style-check.rb](http://www.cs.umd.edu/~nspring/software/style-check-readme.html) to spot verbose phrases and other common mistakes.
- Learn about and use unbreakable spaces.
- Do not use negations&hellip;
- Avoid UA (useless acronyms).
- DUAT: Do not use acronyms in titles.
- Your writing will be in an active voice&hellip;
- Employ uncomplicated terms.
- Learn to use the [em-dash](https://en.wikipedia.org/wiki/Emdash#Em_dash)&mdash; it is a good friend.
- Short sentences&mdash;”no more than 15 words”&mdash;are better.
- Make your research papers [easy to skim](/lemire/blog/2009/05/27/make-your-research-papers-easy-to-skim/) by using meaningful section headers, bullet points and simple figures.


__7. Words you can do without__

- Temporal words such as &ldquo;now&rdquo;, &ldquo;next&rdquo; are either useless or a sign of a bad structure. Avoid the future tense (the word &ldquo;will&rdquo; in English) to refer to something coming up in the document.
- Similarly, avoid reference other content with words such as &ldquo;below&rdquo; or &ldquo;above&rdquo;.
- Most adverbs such as &ldquo;very&rdquo; are useless in a research paper.
- Keep your emotions in check: the reader may not care for your surprise, pleasure and sadness. Prefer _unfortunately_ to <em>alas</em>.
- Avoid the expression &ldquo;so called&rdquo;. It might not mean what you think it means.


__8. Run through this check list before submission__
- Are section headers consistent with respect to case? (&ldquo;Our Methodology&rdquo; versus &ldquo;Our algorithm&rdquo;)
- Do the figures look nice? Are the fonts in your figures large enough for easy browsing? Are the figures readable once printed out in black-and-white? Can we see any compression artifacts? Prefer [vector graphics](https://en.wikipedia.org/wiki/Vector_graphics) for your figures. Avoid screen shots unless absolutely necessary. Each figure and each table should fit in a single page, be numbered and referenced in the text.
- If the page limit is _x_ pages, do you have an _x_ pages long paper? Some reviewers feel you should use all the pages you were granted.
- Do you have at least one figure?
- Is the layout of each page elegant?
- Do you have widows or orphans? (You do know what they are, right?)
- Did you spell check? (Really! Please do it!)
- Do you have a step-by-step toy example for every new algorithm being introduced? Present your examples early.
- Can you replace some mathematical notation by plain English?
- Are all terms defined?
- Is the mathematical notation consistent? (If you use _t_ for time in the first section, do you use _t_ to note the term in the second section?)
- Are names consistent? If you called an algorithm Bozo3 in the introduction, don&rsquo;t call it BOZO-3 in the conclusion.
- Do the title and the abstract invite the reader to read the rest of the paper?
- Do you summarize your contribution in the introduction?
- Is the bibliography consistent? (If you abbreviate first names once, do it all the way through. If you have page numbers once, have page numbers throughout.)
- Is the spelling of all proper names correct? You would hate to get your paper reviewed by someone who would find his name misspelt in your paper.
- Are the captions correct? Do you put the table caption before or after the table? Do you put the figure caption before or after the figure? Do you center captions or not?
- Do you refer to a figure as &ldquo;Fig. 1&rdquo; or as &ldquo;Figure 1&rdquo;? Which one is correct?
- Are all internal references correct? If you refer to Fig. 10, does Figure 10 exists? (Some LaTeX package can mess this up, so always check!) Are all tables and figures referenced in the text?
- If this is a recurring conference or a journal, have you compared your paper with ten or so other articles to make sure that yours is consistent with how these other papers look and feel? For example, if all published articles use 10 pages for the introduction, make sure you do too.
- Do you use the right fonts? Be watchful: sometimes the font for the section header can differ from the font used in the main text.
- Avoid unnecessary lines and borders. Tools like Excel tend to put black borders around figures: get rid of it.
- It is a great idea to use color where appropriate, especially when you expect your readers to read the electronic version of your document. However, you should not use color unnecessarily: tools like Microsoft Word tend to put all hyperlinks in blue, is this really necessary? Moreover, you should make sure that people can print your paper (in black ink) and still understand the content.
- If you have collected data or written software, have you tried making it available online?


__9. How to write more than one good paper__

Write daily for at least 15 to 30 minutes, ideally two hours. Studies show this is the key to becoming a prolific writer.

__10. Further reading__

- [I wrote some slides based on this post](http://www.slideshare.net/lemire/write-good-papers)
- [Hints for New PhD students on How to Write Papers](http://www.findaphd.com/students/life2.asp) by Shahn Majid
- [50 writing tips](http://www.lifehack.org/articles/lifehack/fifty-50-tools-which-can-help-you-in-writing.html)
- [How to make sure your paper will be rejected](/lemire/blog/2007/11/12/how-to-make-sure-your-paper-will-be-rejected/)
- [How to Write a Lot: A Practical Guide to Productive Academic Writing](https://www.amazon.ca/gp/product/1591477433/ref=s9_asin_image_1?pf_rd_m=A3DWYIK6Y9EEQB&amp;pf_rd_s=center-1&amp;pf_rd_r=1CMW0Q22F1M79GJ9TW40&amp;pf_rd_t=101&amp;pf_rd_p=290291901&amp;pf_rd_i=915398) (book)


