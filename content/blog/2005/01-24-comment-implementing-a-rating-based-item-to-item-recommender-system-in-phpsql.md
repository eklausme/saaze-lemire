---
date: "2005-01-24 12:00:00"
title: "Implementing a Rating-Based Item-to-Item Recommender System in PHP/SQL"
index: false
---

[10 thoughts on &ldquo;Implementing a Rating-Based Item-to-Item Recommender System in PHP/SQL&rdquo;](/lemire/blog/2005/01-24-implementing-a-rating-based-item-to-item-recommender-system-in-phpsql)

<ol class="comment-list">
<li id="comment-980" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24f866ee4a06bb70054b962ff09295b3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24f866ee4a06bb70054b962ff09295b3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Seb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-01-24T21:09:00+00:00">January 24, 2005 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>Tu devrais l&rsquo;annoncer sur le nouveau groupe <a href="http://groups.yahoo.com/group/RecommenderSystems/" rel="nofollow ugc">http://groups.yahoo.com/group/RecommenderSystems/</a> (qui compte déjÃ  45 membres)</p>
</div>
</li>
<li id="comment-981" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/24f866ee4a06bb70054b962ff09295b3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/24f866ee4a06bb70054b962ff09295b3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Seb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-01-24T21:09:52+00:00">January 24, 2005 at 9:09 pm</time></a> </div>
<div class="comment-content">
<p>Peut-Ãªtre aussi fournir le code en text file&#8230;</p>
</div>
</li>
<li id="comment-982" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-01-24T21:14:30+00:00">January 24, 2005 at 9:14 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Great idea.</p>
</div>
</li>
<li id="comment-3264" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/890519b1dc5a92a50645d63dc193d123?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/890519b1dc5a92a50645d63dc193d123?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Harris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-04T04:51:30+00:00">November 4, 2005 at 4:51 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,</p>
<p>I have implemented your algorithms and created a dev table using the MovieLens 100k database. Is there any way to return similar items to item 1 rather than just items that are rated higher than it? </p>
<p>If I use say: </p>
<p>SELECT dev.itemid1 , dev.sum, dev.count, dev.sum / dev.count AS average, movies.movietitle<br/>
FROM dev, movies<br/>
WHERE dev.count &gt; 5 AND dev.itemid2 = 98 AND dev.itemid1 = movies.movieid<br/>
ORDER BY average DESC;</p>
<p>(item 98 is One Flew Over the Cuckoo&rsquo;s Nest, query takes 0.0388s) I get 3 Wallace and Grommit movies in the top 5. I presume this is because people who liked Wallace and Grommit did not like One Flew Over the Cuckoo&rsquo;s Nest. </p>
<p>Also, you mention in your paper that you can initialize your dev table with 0 default values for all entries and then use the predict_all function. I use the following query for that:</p>
<p>SELECT dev.itemID1, movies.movietitle, sum(dev.sum + dev.count*rating.ratingvalue) / sum(dev.count) as avgrat<br/>
FROM dev, rating, movies<br/>
WHERE rating.userid = 1<br/>
AND dev.count &gt; 30<br/>
AND dev.itemID1 &lt; > rating.itemid<br/>
AND dev.itemID2 = rating.itemid<br/>
AND dev.itemID1 = movies.movieid<br/>
GROUP BY dev.itemID1, movies.movietitle<br/>
ORDER BY avgrat DESC<br/>
LIMIT 100;</p>
<p>(that query takes about 5 seconds with a MyISAM table, almost 200 seconds with an InnoDB table! (there are 1,967,832 rows in the dev table)). But I can&rsquo;t see any reason to pre-populate with 0 values. </p>
<p>I initially tried this with PostgreSQL but it was way too slow (even with triggers and functions.) I am currently writing stored procedures for MySQL 5 and hopefully they will make things even faster. What do you use on your site?</p>
<p>Thanks for all the work you&rsquo;ve put into this!</p>
<p>Chris</p>
</div>
</li>
<li id="comment-3269" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-04T14:59:58+00:00">November 4, 2005 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>May I ask what you are working on Chris?</p>
<p> <em>I have implemented your algorithms and created a dev table using the MovieLens 100k database. Is there any way to return similar items to item 1 rather than just items that are rated higher than it?</em></p>
<p>Actually, what I suggest people do is to return items that people liked even more than the current item. You could cook up a similarity measure, but most often, isn&rsquo;t your goal to help people find items they will like rather than items similar to what they&rsquo;ve found already? Of course, you could argue that if they&rsquo;ve found a musical and they like musicals, we should suggest other musicals, but slope one is only focused on *rating-based* collaborative filtering.</p>
<p>Obviously, you could throw in a correlation measure between two items in the database. Myself, I believe you should rather send people see items they are likely to like at least as much as the current item.</p>
<p><em><br/>
If I use say:</p>
<p> SELECT dev.itemid1 , dev.sum, dev.count, dev.sum / dev.count AS average, movies.movietitle</p>
<p> FROM dev, movies</p>
<p> WHERE dev.count &gt; 5 AND dev.itemid2 = 98 AND dev.itemid1 = movies.movieid</p>
<p> ORDER BY average DESC;</p>
<p> (item 98 is One Flew Over the Cuckoo&rsquo;s Nest, query takes 0.0388s) I get 3 Wallace and Grommit movies in the top 5. I presume this is because people who liked Wallace and Grommit did not like One Flew Over the Cuckoo&rsquo;s Nest.<br/>
</em><br/>
First of all, in collaborative filtering, when someone rates an item, they, most often, like it. Rating something is a positive reaction. If you hate &ldquo;Flew Over the Cuckoo&rdquo;, you won&rsquo;t bother to rate it, most of the time. So, what your result means is that people who rated &ldquo;Flew Over the Cuckoo&rsquo;s Nest&rdquo; preferred &ldquo;Wallace and Grommit&rdquo;. In other words, people who cared enough about &ldquo;Flew Over the Cuckoo&rsquo;s Nest&rdquo; to rate it, actually preferred &ldquo;Wallace and Grommit&rdquo;.</p>
<p>If you think &ldquo;oh, but I don&rsquo;t want movies of different genres to be recommended this way&rdquo;, then the best bet is to throw in some content-based techniques. For example, when the user is browsing a drama, only recommend drama. You can achieve this result by having one dev table per genre.</p>
<p><em> Also, you mention in your paper that you can initialize your dev table with 0 default values for all entries and then use the predict_all function. I use the following query for that:</p>
<p> SELECT dev.itemID1, movies.movietitle, sum(dev.sum + dev.count*rating.ratingvalue) / sum(dev.count) as avgrat</p>
<p> FROM dev, rating, movies</p>
<p> WHERE rating.userid = 1</p>
<p> AND dev.count &gt; 30</p>
<p> AND dev.itemID1 &lt; &gt; rating.itemid</p>
<p> AND dev.itemID2 = rating.itemid</p>
<p> AND dev.itemID1 = movies.movieid</p>
<p> GROUP BY dev.itemID1, movies.movietitle</p>
<p> ORDER BY avgrat DESC</p>
<p> LIMIT 100;</p>
<p> (that query takes about 5 seconds with a MyISAM table, almost 200 seconds with an InnoDB table! (there are 1,967,832 rows in the dev table)). But I can&rsquo;t see any reason to pre-populate with 0 values.<br/>
</em></p>
<p>Now that you ask, I cannot see why on Earth one would need to populate the table with zeroes. This is very puzzling to me as I always assumed you needed to have a dense matrix for this particular trick to work, but I don&rsquo;t see why it is needed now. I will add a note in the <a href="https://lemire.me/fr/abstracts/TRD01.html" rel="nofollow">tech. report</a> to reflect this realization.</p>
<p><em> I initially tried this with PostgreSQL but it was way too slow (even with triggers and functions.) I am currently writing stored procedures for MySQL 5 and hopefully they will make things even faster. What do you use on your site?<br/>
</em></p>
<p><a href="http://www.indiscover.net" rel="nofollow">inDiscover.net</a> uses MySQL 4.x I believe. </p>
</div>
</li>
<li id="comment-3272" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-04T23:08:43+00:00">November 4, 2005 at 11:08 pm</time></a> </div>
<div class="comment-content">
<p>Looking forward to hear from you Chris!</p>
</div>
</li>
<li id="comment-3271" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/890519b1dc5a92a50645d63dc193d123?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/890519b1dc5a92a50645d63dc193d123?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Harris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-04T20:27:54+00:00">November 4, 2005 at 8:27 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the reply, Daniel. I am currently working on a top-secret project 😉 Details will be revealed soon&#8230; </p>
<p>I think the problem of W&amp;G being recommended when you look at One Flew Over&#8230; could also be due to there being such a few number of moview in the ML database. If there were say 100,000 movies, members&rsquo; ratings would be better &ldquo;grouped&rdquo; into similar items because then people would only rate the movies they liked, as you said, by searching for them rather than being presented a list to rate. But 100,000^2 makes a pretty big dev table!</p>
<p>I have a few more suggestions for your paper that I will post in a few days. Still trying to get the damn stored procedures working in MySQL! Their cursor implementation seems very strange to me.</p>
</div>
</li>
<li id="comment-3281" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/890519b1dc5a92a50645d63dc193d123?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/890519b1dc5a92a50645d63dc193d123?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Harris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-11-09T06:44:15+00:00">November 9, 2005 at 6:44 am</time></a> </div>
<div class="comment-content">
<p>This is just something I though about over the weekend regarding similar items. If there was a &ldquo;genre&rdquo; column it would be even better (&ldquo;and r.genre = r2.genre&rdquo;):</p>
<p>select count(r.itemid), r.itemid, m.movietitle<br/>
from rating r, rating r2, movies m<br/>
where r.userid = r2.userid<br/>
and r2.itemid = 168<br/>
and r.itemid 168<br/>
and r2.ratingvalue = 5<br/>
and r.ratingvalue = 5<br/>
and r.itemid = m.movieid<br/>
group by r.itemid<br/>
order by count(r.itemid) desc</p>
</div>
</li>
<li id="comment-426814" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/91f33955ebd2cc038bd3a2d621e9ed9e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/91f33955ebd2cc038bd3a2d621e9ed9e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Vincent Gagnon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-10T10:17:54+00:00">September 10, 2019 at 10:17 am</time></a> </div>
<div class="comment-content">
<p>Hi Daniel,<br/>
I just found your article as I am trying to build a user-based recommender system myself. As the article is quite old now, do you think there are some new and/or better solutions to this problem with the technology we have today? Or do you think this solution is still relevant? After all, php and mysql are still widely used. I would be interested to hear your thoughts on this. Thank you</p>
</div>
<ol class="children">
<li id="comment-426824" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-10T11:57:27+00:00">September 10, 2019 at 11:57 am</time></a> </div>
<div class="comment-content">
<p>PHP and mysql are not obsolete, certainly.</p>
</div>
</li>
</ol>
</li>
</ol>
