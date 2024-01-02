---
date: "2006-01-02 12:00:00"
title: "My wordpress statistics"
---



Following [Mauro](http://www.i-cherubini.it/mauro/blog/2006/01/01/happy-new-year-2006-some-consideration-about-blogging-and-summary-of-2005/), here are my blogging statistics&hellip; While we are at it, why not explore a bit how wordpress stores its data?

First, I had to do some cleaning up of the comments to ensure I do not miscount them, let&rsquo;s remove the spam:<br/>
<code>mysql> delete from wp_comments where comment_approved = "spam";<br/>
Query OK, 703 rows affected (2.40 sec)<br/>
</code>

Wow! There was a lot comments marked as spam. Because I marked a lot of them as spam manually, and because I now have a reverse Turing test, I&rsquo;m not especially interested in the statistics of it all.

Ok, what about some comment statistics already&hellip; here&rsquo;s an interesting query&hellip;<br/>
<code>select month(comment_date), year(comment_date), count(*) from wp_comments<br/>
group by month(comment_date),year(comment_date)<br/>
order by year(comment_date),month(comment_date);<br/>
</code>

May 2004                 |32                       |
-------------------------|-------------------------|
June 2004                |39                       |
July 2004                |24                       |
August 2004              |10                       |
September 2004           |44                       |
October 2004             |42                       |
November 2004            |29                       |
December 2004            |17                       |
January 2005             |34                       |
February 2005            |26                       |
March 2005               |66                       |
April 2005               |43                       |
May 2005                 |15                       |
June 2005                |42                       |
July 2005                |12                       |
August 2005              |36                       |
September 2005           |37                       |
October 2005             |25                       |
November 2005            |53                       |
December 2005            |20                       |


Now, what about some posting statistics? When am I most active?

<code>select month(post_date), year(post_date), count(*) from wp_posts group by month(post_date),year(post_date) order by year(post_date),month(post_date);<br/>
</code>

May 2004                 |24                       |
-------------------------|-------------------------|
June 2004                |24                       |
July 2004                |21                       |
August 2004              |21                       |
September 2004           |27                       |
October 2004             |21                       |
November 2004            |34                       |
December 2004            |17                       |
January 2005             |41                       |
February 2005            |25                       |
March 2005               |36                       |
April 2005               |19                       |
May 2005                 |14                       |
June 2005                |22                       |
July 2005                |23                       |
August 2005              |46                       |
September 2005           |36                       |
October 2005             |25                       |
November 2005            |30                       |
December 2005            |32                       |


So, interestingly, there are about as many comments as there are posts and I seem to post, on average, every day.

Then, I started to wonder when people comment on my post? Do they comment the same day or do they comment weeks later? Is the distribution a long tail? Here&rsquo;s my SQL query&hellip;

<code>select round((to_days(post_date)-to_days(comment_date))/10)*10 as di,count(*)<br/>
from wp_posts,wp_comments where comment_ID=ID group by di;</code>

And the result is interesting, most comments are made within 90 days, with quite a number of comments made several weeks after I post!

delay before comment (in days) |total number             |0 &#8211; 10             |23                       |
-------------------------|-------------------------|-------------------------|-------------------------|
10-20                    |24                       |
20-30                    |18                       |
30-40                    |15                       |
40-50                    |2                        |
60-70                    |28                       |
70-80                    |27                       |
80-90                    |8                        |
90-100                   |33                       |
100-110                  |1                        |
110-120                  |6                        |
120-130                  |1                        |
130-140                  |1                        |
150-160                  |4                        |
160-170                  |1                        |
skipping zeros           |
210-220                  |6                        |
skipping zeros           |
260-270                  |6                        |
270-280                  |2                        |
skipping zeros           |
310-320                  |1                        |
skipping zeros           |
400-420                  |3                        |


This puts a dent in the theory that blogging is a synchronous conversation. I suspect that most of my comments are made by people who found my blog by accident, not by fervent readers. Maybe because few people read me on a regular basis.

