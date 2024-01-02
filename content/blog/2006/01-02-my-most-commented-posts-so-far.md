---
date: "2006-01-02 12:00:00"
title: "My most commented posts so far"
---



Following on my earlier post about wordpress statistics, I decided to pull out my most frequently commented posts:

<code>select count(comment_id) as cnt,post_title,guid<br/>
from wp_posts, wp_comments<br/>
where comment_post_id=id<br/>
group by post_title having cnt>12 order by cnt desc;<br/>
</code>

post                     |number of comments       |
-------------------------|-------------------------|
[Winfixer got to me, but I had the last word](/lemire/blog/2005/09/02/winfixer-got-to-me-but-i-had-the-last-word/) |26                       |
[An Amazon Web Services (AWS) 4.0 application in just a few lines ](/lemire/blog/2004/09/26/an-amazon-web-services-aws-40-application-in-just-a-few-lines/) |24                       |
[How Technology Will Destroy Schools ](/lemire/blog/2004/09/30/how-technology-will-destroy-schools/) |22                       |
[Programming and college CS education ](/lemire/blog/2005/06/20/programming-and-college-cs-education/) |22                       |
[Are you an IT-empower worker or an old school worker? ](/lemire/blog/2005/03/29/are-you-an-it-empower-worker-or-an-old-school-worker/) |21                       |
[Death of the invisible adjunct ](/lemire/blog/2004/05/18/death-of-the-invisible-adjunct/) |18                       |
[Implementing a Rating-Based Item-to-Item Recommender System in PHP/SQL ](/lemire/blog/2005/01/24/implementing-a-rating-based-item-to-item-recommender-system-in-phpsql/) |16                       |
[Will there be universities in 20 years? ](/lemire/blog/2004/05/16/will-there-be-universities-in-20-years/) |15                       |
[Slope One Predictors for Online Rating-Based Collaborative Filtering (SDM&rsquo;05 / April 20-23th 2005) ](/lemire/blog/2005/01/09/slope-one-predictors-for-online-rating-based-collaborative-filtering/) |14                       |
[What constitutes research blogging? ](/lemire/blog/2005/04/06/what-constitutes-research-blogging/) |14                       |
[Sébastien Paquet on blogs and wikis ](/lemire/blog/2004/11/14/sebastien-paquet-on-blogs-and-wikis/) |12                       |
[What will be the next Web? A prediction ](/lemire/blog/2005/03/23/what-will-be-the-next-web-a-prediction/) |12                       |
[Current state of affairs in the XML world (according to me)](/lemire/blog/2005/01/02/current-state-of-affairs-in-the-xml-world-according-to-me/) |12                       |
[Managing stress: I want to live past 50 ](/lemire/blog/2005/04/18/managing-stress-i-want-to-live-past-50/) |12                       |
What would you put in a Computer Science Curriculum?  |12                       |


It seems that often commented posts fall in one of these categories:

- offer some help regarding a very common technical problem (winfixer);
- have a controversial title/content;
- present or discuss a definition (blogging/CS education/&hellip;);
- present recent research results people can possibly use right away (collaborative filtering).


Topics that are especially popular seem to be:

- what are universities doing, what should they teach and how should they teach it?;
- useful, nice and __simple__ programming tricks;
- how can I use social software (blogging) to get ahead?


I should point out that my goal is not to get more comments. I don&rsquo;t write this blog to get comments, though please, do comment away!

