---
date: "2016-04-29 12:00:00"
title: "Is software a neutral agent?"
---



We face an embarrassing amount of information but when we feel overwhelmed, as Clay Shirky said, â€œIt&rsquo;s not information overload. It&rsquo;s filter failure.â€ Unavoidably, we rely heavily on recommender systems as filters. Email clients increasingly help you differentiate the important email from the routine ones, and they regularly hide from your sight what qualifies as junk. Netflix and YouTube work hard so that you are mostly presented with content you want to watch.

Unsurprisingly, YouTube, Facebook, Netflix, Amazon and most other big Internet players have heavily invested in their recommender systems. Though it is a vast field with many possible techniques, one key ingredient is collaborative filtering, a term first coined in 1992 by David Goldberg (now at eBay but then at Xerox Parc). It has become known through, in part, the work done at Amazon by Greg Linden on the item-to-item collaborative filtering (&ldquo;people who liked this book also liked these other books&rdquo;) (patented in 1998). The general _theorem_ underlying collaborative filtering is that if people who are like you like something, then you are more likely to like such a thing. Thus, we should not be mistaken and think that the recommender systems are sets of rules inputted by experts. They are in fact an instance of <em>machine learning</em> where the software learns to predict us by watching us.

But this also means that these filters, these algorithms, are in part a reflection of what we are, how we act. And these algorithms know us better than we may think. And that&rsquo;s true even if you share nothing about yourself. For example, Jernigan and Mistree showed in 2009 that based solely on the profiles of the people who declared to be your friends, an algorithm can determine your sexual orientation. Using minute traces that you unavoidably leave online, we can determine your sexual orientation, ethnicity, religious and political views, your age, and your gender. There is an entire data-science industry that is dedicated to tracking what we buy, what we watch&hellip; Whether they do it directly or not, intentionally or not, recommender systems in YouTube, Facebook, Netflix, Amazon take into account your personal and private attributes in selecting content for you. 

We should not be surprised that we are tracked so easily. The overwhelming majority of the Internet players are effectively marketing agents, paid to provide you with relevant content. It is their core business to track you.

However, though polls are also a reflection of our opinions, it has long been known that they influence the vote, even when pollsters are as impartial as they can be. Recommender systems therefore not neutral, they affect our behavior. For example, some researchers have observed that recommender systems tend to favor blockbusters over the long tail. This can be true even as, at the individual level, the system makes you discover new content&hellip; seemingly increasing your reach&hellip; while leaving the small content producers in the cold. 

Some algorithms might be judged unfair or &ldquo;biased&rdquo;. For example, it has been shown that if you self-identify as a woman, you might see online fewer ads for high paying jobs than if you are a man. This could be explained, maybe, by a natural tendency for men to click on jobs for higher paying jobs, compared to women. If the algorithm seeks to maximize content that it believes is interesting to you based on your recorded behavior, then there is no need to imagine a nefarious ad agency or employer.

In any case, we have to accept software as an active agent that helps shape our views and our consumption rather than a mere passive tool. And that has to be true even when the programmers are as impartial as they can be. Once we set aside the view of software as an impartial object, we can no longer remain oblivious to its effect on our behavior. At the same time, it may become increasingly difficult to _tweak_ this software, even for its authors, as it grows in sophistication. 

How do you check how the algorithms work? The software code is massive, ever-changing, on remote servers, and very sophisticated. For example, the YouTube recommender system relies on deep learning, the same technique that allowed Google to defeat the world champion at Go. It is a complex collection of weights that mimics our own brain. Even the best engineers might struggle to verify that the algorithm behaves as it should in all cases. And government agencies simply cannot read the code as if it were recipes, assuming that they can even legally access it. But can governments at least measure the results or enable the providers to give verifiable measures? Of course, if governments have complete access to our data, they can, but is that what we want? 

The Canadian government has tried to regulate what kind of personal data companies can store and how the can store it ([PIPEDA](https://en.wikipedia.org/wiki/Personal_Information_Protection_and_Electronic_Documents_Act)). In a globalized world, such laws are hard to enforce but even if they could be enforced, would they be effective? Recall that from minute traces, software can tell more about you than you might think&hellip; and, ultimately, people do want to receive personalized services. We do want Netflix to know which movies we really like.

Evidently, we cannot monitor Netflix the same way we monitor a TV station. We can study the news coverage that newspapers and TV shows provide, but what can we say about how Facebook paints the world for us?

We must realize that even if there is no conspiracy to change our views and behavior, software, even brutally boring statistics-based software, is having this effect. And the effect is going to get ever stronger and harder to comprehend.

__Further reading__:

- Datta, A., Tschantz, M. C., &#038; Datta, A. (2015). Automated experiments on Ad privacy settings. Proceedings on Privacy Enhancing Technologies, 2015(1), 92-112.
- Goldberg, D., Nichols, D., Oki, B. M. , and Terry, D. 1992. Using collaborative filtering to weave an information tapestry. Commun. ACM 35, 12 (December 1992), 61-70. 
- Fleder, D., &#038; Hosanagar, K. (2009). Blockbuster culture&rsquo;s next rise or fall: The impact of recommender systems on sales diversity. Management science,55(5), 697-712.
- Jernigan, C., &#038; Mistree, B. F. (2009). Gaydar: Facebook friendships expose sexual orientation. First Monday, 14(10).
- Kosinski, M., Stillwell, D., &#038; Graepel, T. (2013). Private traits and attributes are predictable from digital records of human behavior. Proceedings of the National Academy of Sciences, 110(15), 5802-5805.
- Linden, G., Smith, B., &#038; York, J. (2003). Amazon. com recommendations: Item-to-item collaborative filtering. Internet Computing, IEEE, 7(1), 76-80.
- Statt, N., [YouTube redesigns its mobile apps with improved recommendations Using &lsquo;deep neural networks&rsquo;](http://www.theverge.com/2016/4/26/11511330/google-youtube-ios-android-app-redesign-ai), April 26th, 2016 
- Tutt, A., [An FDA for Algorithms](http://ssrn.com/abstract=2747994) (March 15, 2016). 

