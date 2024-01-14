---
date: "2019-01-31 12:00:00"
title: "My blog can&#8217;t keep up: 500 errors all over"
index: false
---

[53 thoughts on &ldquo;My blog can&#8217;t keep up: 500 errors all over&rdquo;](/lemire/blog/2019/01-31-my-blog-cant-keep-up-500-errors-all-over)

<ol class="comment-list">
<li id="comment-385837" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T03:16:14+00:00">January 31, 2019 at 3:16 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know if this comment will show up, but one thing you could consider is to take one or two years worth of the $50 WP hosting fee (so $600 or $1200) and offer it on contract to someone who knows what they are doing with WP, for them to:</p>
<p>1) Move to a hosting provider that costs say only $10 or $20 per month maximum.<br/>
2) Fix the performance problems through caching and/or identifying the offending code.</p>
<p>Since step one means you save $30 to $40 a month, this would have a very high return on investment. Of course, you face the challenge of verifying what they&rsquo;ve done, etc.</p>
</div>
<ol class="children">
<li id="comment-385928" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:59:43+00:00">January 31, 2019 at 5:59 pm</time></a> </div>
<div class="comment-content">
<p>Your comment did make it through.</p>
<p><em>1) Move to a hosting provider that costs say only $10 or $20 per month maximum.</em></p>
<p>I think that the $10 to $20 price range is for unmanaged instances. I would need to handle security, SSL, updates, configuration, backups. I like that someone other than me is doing backups and securing Apache/PHP.</p>
<p>When I write that csoft.net has been professional, I mean that I haven&rsquo;t lost any data in 15 years. They also locked things down for me when I was being hacked.</p>
<p><em>2) Fix the performance problems through caching and/or identifying the offending code.</em></p>
<p>I&rsquo;d be willing to pay someone for that, but given that I have a managed instance right now, this person could only do so much. You can&rsquo;t reconfigure Apache, for example, or switch to another server. It seems to come down to installing and configure wordpress plugins, but I am skeptical that it is much help when things go to hell, because at that point, anything php will randomly fail. The .htaccess things is more interesting, of course. There might be some magic hacking there. But by the time you hit php, it is all over.</p>
<p>Moving to an unmanaged instance and paying someone to help me manage is certainly an option. I think it will cost more in the end, but that might be the solution.</p>
</div>
<ol class="children">
<li id="comment-385945" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T22:19:32+00:00">January 31, 2019 at 10:19 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I&rsquo;d be willing to pay someone for that, but given that I have a<br/>
managed instance right now, this person could only do so much. You<br/>
can&rsquo;t reconfigure Apache, for example, or switch to another server
</p></blockquote>
<p>To be clear, I meant that (1) and (2) have to come together. Basically get someone who knows what they are doing with WP, <em>and</em> that comes with a recommended hosting solution in that price range (yes, I suspect they start at way under $50). This person would migrate your existing WP setup and ensure it all works great in a &ldquo;pushbutton&rdquo; fashion before handing it off.</p>
</div>
</li>
<li id="comment-387410" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b104cdd9182dbb7a2962d30831604577?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b104cdd9182dbb7a2962d30831604577?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Paul</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T18:35:43+00:00">February 9, 2019 at 6:35 pm</time></a> </div>
<div class="comment-content">
<p>â€¦ based on that response this whole post seems like an exercise for venting.</p>
<p>You don&rsquo;t seem to want change or improvement or lower costs.</p>
<p>There are definitely better &amp; at the same less expensive hosting options.</p>
<p>There are definitely worthwhile plugins (WP Super Cache, S3 integrations, etc).</p>
<p>15 years is a lot of posts, fortunately WordPress it self makes it very easy to export all that data, you could very very easily do that and set up a second website where you could validate data integrity and start exploring ways to save money, harrden WordPress (for security), and take measures necessary to improve performance. You could also offload Commenting to a 3rd party like Disqus that exists solely to make commenting easy from a spam &amp; performance perspective.</p>
<p>But it seems like with all these options you&rsquo;re content to be malcontent.</p>
</div>
<ol class="children">
<li id="comment-387591" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-10T14:52:33+00:00">February 10, 2019 at 2:52 pm</time></a> </div>
<div class="comment-content">
<p>Paul: If you read the next post after this one, you will learn that I have moved to a different host (SiteGround). This happened within a week of writing this post. It is a managed instance, so I get server security, backups and all that. It is also quite fast. It is not, generally speaking, cheaper, but &ldquo;high cost&rdquo; was not my concern. (SiteGround is &ldquo;affordable&rdquo;, I&rsquo;d say.)</p>
<p>The mistake I made was to underestimate how bad csoft.net hosting was. Simply switching host solved my problems.</p>
<p>Some specific comments:</p>
<ul>
<li>
<p>Once your PHP scripts start failing more or less randomly, using plugins like WP Super Cache is not going to save you. These plugins rely on PHP working properly. I had used WP Super Cache for many years, but it did not help the stability of the setup in my experience. In a follow-up blog post I describe how WP Super Cache relies on 3 seconds caching&#8230; So it is not going to do a good job, even when it works well, at preventing your wordpress scripts from being hit (hard?).</p>
</li>
<li>
<p>Disqus is not appealing to me, as an independent blogger. I want to own and control my platform. I don&rsquo;t want to offload comment data and the corresponding user information to a third party that may then possibly resell this data. Reading about disqus (which has, effectively, a monopoly on this type of service) brings many complains having to do with bloat and low performance, sudden changes as to how things work and as to how they are displayed. And, of course, the service may cost money (reasonably enough): I see $9 a month.</p>
</li>
<li>
<p>Moving software to a different setup is not free. The move was much less painful that I expected (took 1h to 2h), but weeks later I am still solving problems related to the move. Some tiny problems that came up took hours to solve, as I needed to research the problems. Avoiding an unnecessary move is rational.</p>
</li>
<li>
<p>Several commenters pointed out that I could just drop WordPress and use something else. I fear that they greatly underestimate how hard this would be. Yes, I know about things like Hugo. My relatively simple home page is built using Hugo&#8230; and it took me nearly took weeks of hacking to get it to be how I want. Porting my blog to something like Hugo would be a major disruption, might imply moving to disqus (see point above) and so forth.</p>
</li>
<li>
<p>In my comment above I was answering Travis who was basically recommending that &ldquo;I pay someone&rdquo; and go to an unmanaged instance (if I understand correctly). Given that it took me less than one hour to get a clue that performance would be better at SiteGround&#8230; It is unclear whether paying someone would have worked. There are transaction costs: you need to setup a job description, you need to agree on the terms, you need to select the person. Then if you go to an unmanaged instance, there are going to be ongoing support costs to make sure things keep on working. It is possible that Travis was right and that I have been wrong, but I think that my own approach to stick with managed instances and mostly do it myself is probably reasonable.</p>
</li>
</ul>
<p>As someone said, geeks like change, as long as it is change that they cause, otherwise they hate it. Reasonably, I try to maintain stability in my tools and workflow. In this instance, I admit that I was too conservative, I should have moved off csoft.net years go. However, I think that wordpress is probably going to serve me well for years to come. It may be old tech, but the benefits that come from its maturity are probably underrated.</p>
</div>
<ol class="children">
<li id="comment-387905" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-12T17:38:18+00:00">February 12, 2019 at 5:38 pm</time></a> </div>
<div class="comment-content">
<p>To be clear I was never recommending to go unmanaged. I was recommending that you pay someone who was familiar with the ecosystem to solve your WordPress headache. Since csoft gives you almost zero knobs to turn, this would most likely involve the selection of and migration to another managed instance.</p>
<p>If you are willing to do it yourself, that could be a good option and in this case it turned out to be a great one since the effort migrate was small (a fraction of what I would have guessed &#8211; but that&rsquo;s why I&rsquo;m not a WP expert) and you were willing to attempt it yourself.</p>
<p>I doubt paying someone permanently to handle an unmanaged WP instance makes much economic sense except in unusual scenarios so I wasn&rsquo;t suggesting that.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-385849" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38c467a8b11ef0dde2bc97919502a047?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38c467a8b11ef0dde2bc97919502a047?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Walmsley</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T05:39:01+00:00">January 31, 2019 at 5:39 am</time></a> </div>
<div class="comment-content">
<p>Consider moving away from a CMS like WordPress. It&rsquo;s great at what it does but I think you&rsquo;ve out grown it. Static content generators might help here. They let you edit off line and compile to a static version of the web content you currently serve. I&rsquo;d suggest looking at Hugo or one of the many specialised for blogging.<br/>
<a href="https://opensource.com/article/18/3/start-blog-30-minutes-hugo" rel="nofollow ugc">https://opensource.com/article/18/3/start-blog-30-minutes-hugo</a></p>
<p>You can then push the content to something Amazon&rsquo;s s3 and put cloudfront in front to speed things up.</p>
<p>You&rsquo;ll have to then offload the comments to a service but that is relatively easy and cheap. A service like discus is only $9 a month. Moving to s3 you&rsquo;ll save that in hosting. (I run two sites like this and pay $0.07 on average per month). Not to mention those services are pretty good at filtering spam.</p>
<p>There are some other options around too. <a href="https://darekkay.com/blog/static-site-comments/" rel="nofollow ugc">https://darekkay.com/blog/static-site-comments/</a></p>
<p>WordPress is nice but it will never out perform static content.</p>
</div>
</li>
<li id="comment-385850" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/242f49eaeac8b4a51f4b11550f345b34?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/242f49eaeac8b4a51f4b11550f345b34?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.appblit.com" class="url" rel="ugc external nofollow">Laurent</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T05:46:35+00:00">January 31, 2019 at 5:46 am</time></a> </div>
<div class="comment-content">
<p>You would get a free hosting with google app engine. And never any 500.<br/>
I host appblit.com on it since 2010 and never worry about a thing. Python, NodeJS or Java. I use python.</p>
</div>
</li>
<li id="comment-385851" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/189c1d560f90f6117de3324864b77045?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/189c1d560f90f6117de3324864b77045?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sumit Gupta</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T05:46:43+00:00">January 31, 2019 at 5:46 am</time></a> </div>
<div class="comment-content">
<p>With just 30K user, and $50 hosting I don&rsquo;t think your blog should fail. It means your hosting is way too expensive for quality they are providing. I am using VPS from digital ocean and any $40 server from them if done write will give much better performance to your blog. You need to find another host for sure and possibly with VPS. wordpress only hosting are good too, but they get too complex at time.</p>
</div>
</li>
<li id="comment-385858" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/253139dd9bc1e911c7a0be5415c16378?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sagar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T06:33:56+00:00">January 31, 2019 at 6:33 am</time></a> </div>
<div class="comment-content">
<p>Host a static site on GitHub or Amazon S3 (+Cloudfront/flare). Comments can be with Disqus or just link to a post in your own sub reddit / HN.</p>
</div>
<ol class="children">
<li id="comment-385864" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/41a52e0ecbf01b45310414868201df0d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/41a52e0ecbf01b45310414868201df0d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mebas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T07:23:20+00:00">January 31, 2019 at 7:23 am</time></a> </div>
<div class="comment-content">
<p>+++ This is the way to go</p>
</div>
</li>
<li id="comment-385881" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/89812f9e98f013d6cf71e84dee398bf0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/89812f9e98f013d6cf71e84dee398bf0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dodgyb</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T10:46:25+00:00">January 31, 2019 at 10:46 am</time></a> </div>
<div class="comment-content">
<p>I second Sagar. There are some straightforward guides on migrating from WordPress to Jekyll, e.g.</p>
<p><a href="https://www.toptal.com/github/unlimited-scale-web-hosting-github-pages-cloudflare" rel="nofollow">Unlimited Scale and Free Web Hosting with GitHub Pages and Cloudflare</a></p>
<p><a href="https://blog.webjeda.com/wordpress-to-jekyll-migration/" rel="nofollow">4 Steps To Migrate From WordPress To Jekyll</a></p>
<p>You could use the savings to commission a poor student to do it for you</p>
</div>
<ol class="children">
<li id="comment-385922" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:36:11+00:00">January 31, 2019 at 5:36 pm</time></a> </div>
<div class="comment-content">
<p>I am skeptical that I can port over my blog to Jekyll and its thousands of comments, posts and everything without break a lot of content.</p>
</div>
<ol class="children">
<li id="comment-385965" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8f114cd76a1718fc0fae94ab8d26281a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8f114cd76a1718fc0fae94ab8d26281a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Zoran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-01T08:25:31+00:00">February 1, 2019 at 8:25 am</time></a> </div>
<div class="comment-content">
<p>you can try with Publii static CMS at getpublii.com<br/>
it&rsquo;s a great piece of software, it&rsquo;s FREE, runs on Windows, Mac and Linux as desktop app, so you don&rsquo;t need to login in order to post, you can write while offline and when online just push the update. also has a very nice WordPress importer option, so you can import your WP posts etc&#8230;<br/>
and finally you can upload directly from the app to Github pages, Gitlab, Netlify, Amazon S3, or where ever you want thru built-in FTP, SFTP</p>
</div>
</li>
<li id="comment-386107" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b9728e308ff8c3f8533a544cf67c0f84?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b9728e308ff8c3f8533a544cf67c0f84?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.lonecpluspluscoder.com" class="url" rel="ugc external nofollow">Timo</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-02T12:48:08+00:00">February 2, 2019 at 12:48 pm</time></a> </div>
<div class="comment-content">
<p>As someone who&rsquo;s been slowly trying to move his much smaller blog (lot fewer articles, couple of orders of magnitude less traffic) from WordPress to Jekyll, I can confirm that it&rsquo;s not as easy as it&rsquo;s sometimes made out.</p>
<p>Transferring the blog posts is relatively easy, migrating the comments is a little harder &#8211; especially if you want to self host them like I do. Getting the details right like RSS feeds working transparently so your subscribers only notice minimal, if any, disruption is a surprising amount of work.</p>
<p>That said, I personally still see benefit in moving away from WordPress. WP has a big target on its back security-wise as it&rsquo;s running so many sites, and I&rsquo;ve had to recreate a few too many blog posts because the online editor ate them.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-385927" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:49:26+00:00">January 31, 2019 at 5:49 pm</time></a> </div>
<div class="comment-content">
<p>Yes. I would do this if I were starting anew today. When I started this blog, GitHub and AWS did not exist.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385859" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8a4da5f0e0596f77680772c19f187bfd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8a4da5f0e0596f77680772c19f187bfd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://rich.liebling.us" class="url" rel="ugc external nofollow">rich</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T06:38:47+00:00">January 31, 2019 at 6:38 am</time></a> </div>
<div class="comment-content">
<p>Regarding:</p>
<blockquote><p>
Cloudfare reports 45,000 uncached requests for the day, and most of them are in the last couple of hours.
</p></blockquote>
<p>I believe the issue is that when CloudFlare caches your page(s), it does so &ldquo;locally&rdquo; &#8211; whether that means only at that particular CloudFlare datacenter or, more likely, narrowly than that. At least I am pretty sure that Cloudflare does <em>not</em> take the cached response and widely distribute it among its servers.</p>
</div>
</li>
<li id="comment-385862" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e312aa64c69b7023bbf33275682e568b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e312aa64c69b7023bbf33275682e568b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://bilalbudhani.com" class="url" rel="ugc external nofollow">Bilal Budhani</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T07:02:54+00:00">January 31, 2019 at 7:02 am</time></a> </div>
<div class="comment-content">
<p>I would say move to managed WordPress hosting like WPEngine or Kinsta. They will take care of all the heavy lifting of scaling so you can focus on writing.</p>
</div>
<ol class="children">
<li id="comment-385926" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:48:47+00:00">January 31, 2019 at 5:48 pm</time></a> </div>
<div class="comment-content">
<p>Yes, but I have a pre-existing, large and complex blog. I believe that these wordpress hosting services work better for people starting new blogs.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385863" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/741b8e52cb5ade820f9292326ead8460?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/741b8e52cb5ade820f9292326ead8460?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sasa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T07:20:27+00:00">January 31, 2019 at 7:20 am</time></a> </div>
<div class="comment-content">
<p>Move the blog from wordpress to static site, then you can serve the blog on a free server to that number of users easily.</p>
</div>
</li>
<li id="comment-385866" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/94d92ce930eca942143f9303a353cf4c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/94d92ce930eca942143f9303a353cf4c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://www.michelebologna.net" class="url" rel="ugc external nofollow">Michele Bologna</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T07:49:05+00:00">January 31, 2019 at 7:49 am</time></a> </div>
<div class="comment-content">
<p>There are WordPress plugins to convert your existing posts to static site generators (to name a few: Jekyll and Hugo). Jekyll can be hosted by GitHub Pages.<br/>
As said above, you then have to convert every comment to Disqus.</p>
</div>
</li>
<li id="comment-385870" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b6b1c2c000b5e36a035cc78ff8f071d3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://zeuxcg.org" class="url" rel="ugc external nofollow">Arseny Kapoulkine</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T08:45:09+00:00">January 31, 2019 at 8:45 am</time></a> </div>
<div class="comment-content">
<p>FWIW my blog gets roughly the same amount of traffic, and I don&rsquo;t think it&rsquo;s ever been down. I pay $0 for this, it&rsquo;s hosted using GitHub Pages &#8211; they use Cloudflare internally I believe.</p>
<p>I&rsquo;ve migrated away from WordPress after realizing I really hate using their editor and this makes me hate the process of writing blog posts. Unfortunately it took some time to migrate and preserve all contents, but I&rsquo;ve been very happy with the setup since. Some people I know use Hugo, I use vanilla Jekyll that GitHub Pages generate for me.</p>
</div>
<ol class="children">
<li id="comment-385925" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:44:28+00:00">January 31, 2019 at 5:44 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. When I started my blog, GitHub did not exist. Facebook did not exist. So there is path dependence involved. I now have to deal with things as they are. I can start anew, of course&#8230; but that&rsquo;s a choice that would cost me.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385875" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bd6dcf3e308335b4905c49cec593d1fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bd6dcf3e308335b4905c49cec593d1fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T09:29:27+00:00">January 31, 2019 at 9:29 am</time></a> </div>
<div class="comment-content">
<p>Discussion on hacker news: <a href="https://news.ycombinator.com/item?id=19041956" rel="nofollow ugc">https://news.ycombinator.com/item?id=19041956</a></p>
</div>
</li>
<li id="comment-385876" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ae3cf3de83d21c1574149814346a109?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ae3cf3de83d21c1574149814346a109?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefano Costa</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T09:29:49+00:00">January 31, 2019 at 9:29 am</time></a> </div>
<div class="comment-content">
<p>One of the sites I monitor has an active user base greater than yours and hasn&rsquo;t experienced your problems (the setup is pretty pretty powerful though).</p>
<p>He too uses WP, and this is the list of plugin in site deploy:</p>
<p><a href="https://css-tricks.com/wordpress-plugins-we-use-3rd-edition/" rel="nofollow ugc">https://css-tricks.com/wordpress-plugins-we-use-3rd-edition/</a></p>
<p>hope it gives you some insights.</p>
</div>
<ol class="children">
<li id="comment-385923" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:39:08+00:00">January 31, 2019 at 5:39 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. In my case, the php scripts themselves fail, so I am doubtful that adding more plugins can help. Plugins tend to hurt more than they help when they can&rsquo;t be expected to run without failure.</p>
<p>Over the years, I tried dozens and dozens of plugins, and I have been consistently disappointed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385882" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7cdd41def58a5dfd50af6eba43dc4376?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7cdd41def58a5dfd50af6eba43dc4376?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://csvjson.com" class="url" rel="ugc external nofollow">Martin Drapeau</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T11:05:49+00:00">January 31, 2019 at 11:05 am</time></a> </div>
<div class="comment-content">
<p>Bonjour Daniel,</p>
<p>I write on Medium and the editor is wonderful. Some articles get featured for extra distribution.</p>
<p>If you stick with WordPress install the classic editor plugin to remove Gutenberg.</p>
<p>GitHub pages is also a great free option as mentioned.</p>
<p>Bonne chance,</p>
<p>â€”Martin</p>
</div>
<ol class="children">
<li id="comment-385921" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:34:40+00:00">January 31, 2019 at 5:34 pm</time></a> </div>
<div class="comment-content">
<p><em>I write on Medium and the editor is wonderful.</em></p>
<p>A blog on Medium is certainly nice, but it is no longer an independent blog. Someone else decides how it looks and how it is organized, and monetized.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385883" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Catherine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T11:09:30+00:00">January 31, 2019 at 11:09 am</time></a> </div>
<div class="comment-content">
<p>First, Gutenberg is terrible. Install the WordPress Classic Editor (<a href="https://wordpress.org/plugins/classic-editor/" rel="nofollow ugc">https://wordpress.org/plugins/classic-editor/</a>) as soon as possible and disable Gutenberg.</p>
<p>For your hosting problems, it seems you&rsquo;re paying an awful lot just to host a WP blog. Normally a WP blog, with that kind of traffic should be fine<br/>
on a 5-10$ month VPS without any special tinkering. There&rsquo;s something wrong here.</p>
<p>If you don&rsquo;t want to waste your time by fixing your WordPress install (have you tried to export your data and do a clean reinstall ?), you could go with <a href="https://wordpress.com/pricing/" rel="nofollow ugc">https://wordpress.com/pricing/</a> (note the .com) the Premium plan should work fine. You&rsquo;ll still need to migrate your data.</p>
</div>
<ol class="children">
<li id="comment-385889" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T13:04:01+00:00">January 31, 2019 at 1:04 pm</time></a> </div>
<div class="comment-content">
<p>I tried installing the classic-editor plugin, and then enabling it, but the Gutenberg editor sticks and won&rsquo;t go away. It is frustratingly hard to debug such issues.</p>
</div>
<ol class="children">
<li id="comment-385894" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T13:37:16+00:00">January 31, 2019 at 1:37 pm</time></a> </div>
<div class="comment-content">
<p>I should point out that I get frequent 500 errors, so I am not sure whether I should be expecting any given plugin to work properly.</p>
</div>
</li>
<li id="comment-385900" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/afe4c934b2064530d24db56b458c6de7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Catherine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T14:12:24+00:00">January 31, 2019 at 2:12 pm</time></a> </div>
<div class="comment-content">
<p>Have you disabled the Gunteberg editor? It&rsquo;s listed among your plugins.</p>
</div>
<ol class="children">
<li id="comment-385911" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:01:49+00:00">January 31, 2019 at 5:01 pm</time></a> </div>
<div class="comment-content">
<p>I can&rsquo;t find a gutenberg plugin and there seems to be nothing like it in wp-content/plugins so I think it is intrinsic to wordpress (not a plugin).</p>
</div>
</li>
</ol>
</li>
<li id="comment-385917" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:29:12+00:00">January 31, 2019 at 5:29 pm</time></a> </div>
<div class="comment-content">
<p>The issue was finally resolved after my blog stopped crashing.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385920" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:33:48+00:00">January 31, 2019 at 5:33 pm</time></a> </div>
<div class="comment-content">
<p><em>If you don&rsquo;t want to waste your time by fixing your WordPress install </em></p>
<p>I don&rsquo;t think that the problem is with my installation.</p>
<p><em>you could go with wordpress.com</em></p>
<p>I expect I would not be able to bring my blog over without breaking things, and I would do away with my independence.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385884" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7cdd41def58a5dfd50af6eba43dc4376?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7cdd41def58a5dfd50af6eba43dc4376?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Martin Drapeau</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T11:10:51+00:00">January 31, 2019 at 11:10 am</time></a> </div>
<div class="comment-content">
<p>AWS Lightsail offers bitnami LAMPs for 10$/mo. WordPress ready with caching and all. I migrated many WordPress blogs there and its fast. I get about 50,000 monthly visits and no performance issues at all. Check it out.</p>
</div>
<ol class="children">
<li id="comment-385919" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:32:17+00:00">January 31, 2019 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I am aware than unmanaged instances are cheaper, but I am not sure I want to handle configuration, update, security and all that.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385888" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/78b315ac36bae6a97dabdab07f3ae628?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Francois Saint-Jacques</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T12:58:54+00:00">January 31, 2019 at 12:58 pm</time></a> </div>
<div class="comment-content">
<p>Give any static site generator a try, blog posts are markdown document which you commit. Statically generated, you&rsquo;ll never get 500 if you front it with CloudFlare. As Arseny said, hosting it on github pages will be almost free. The true downside is maybe comments, but then you can move to Discuss and never worry about spam again.</p>
<p>My personnal preference would be Hugo because the installation process is trivial compared to the other.</p>
</div>
<ol class="children">
<li id="comment-385918" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:31:29+00:00">January 31, 2019 at 5:31 pm</time></a> </div>
<div class="comment-content">
<p>Here the issue is that there is path dependence. My home page is built using Hugo (<a href="https://lemire.me/en/" rel="ugc">https://lemire.me/en/</a>), but it was redone entirely (I threw away my old page). It was a major undertaking to make it look the way I want. I fear it would be weeks of work to port my blog over. Certainly, it would be doable and more efficient, but the cost might be substantial.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385893" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4124254de5d3f21cccd0d70f96d873a6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4124254de5d3f21cccd0d70f96d873a6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Ryland</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T13:16:45+00:00">January 31, 2019 at 1:16 pm</time></a> </div>
<div class="comment-content">
<p>From my notes:</p>
<p>Changed all MaxClients settings (prefork MPM, worker MPM, event MPM) in /etc/apache2/apache2.conf to 40 from 150, on the theory that, with 2GB of physical RAM, and WP_MAX_MEMORY_LIMIT (default) 40M, it&rsquo;ll use a max 1.6G of RAM which will stop the thrashing &ldquo;fall over&rdquo; behavior we&rsquo;re seeing. (free -m gives 1.7G free when apache&rsquo;s stopped.)</p>
<p>The main thing to be sure is that Apache (if you have any control over that at your ISP) isn&rsquo;t forking more processes than will fit in memory, or else you&rsquo;ll start thrashing.</p>
</div>
<ol class="children">
<li id="comment-385915" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:20:40+00:00">January 31, 2019 at 5:20 pm</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t think I have control over Apache, as I am using a managed instance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385898" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b7612263f0c62d716c6dee0fe7ecb76?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b7612263f0c62d716c6dee0fe7ecb76?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.maketimeforsports.com" class="url" rel="ugc external nofollow">Linus Fernandes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T14:09:19+00:00">January 31, 2019 at 2:09 pm</time></a> </div>
<div class="comment-content">
<p>Have you considered moving to a WordPress.com hosted blog?</p>
</div>
<ol class="children">
<li id="comment-385912" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:05:04+00:00">January 31, 2019 at 5:05 pm</time></a> </div>
<div class="comment-content">
<p>I have created new blogs there, for side projects, but I am concerned about my existing, self-hosted blog.</p>
</div>
</li>
<li id="comment-385914" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:19:11+00:00">January 31, 2019 at 5:19 pm</time></a> </div>
<div class="comment-content">
<p>I have two concerns with that. One is that moving to a blogging platform breaks my independence. The second one is that I don&rsquo;t think I can realistically port over my existing blog. I will unavoidably break things in the process.</p>
</div>
<ol class="children">
<li id="comment-385946" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b7612263f0c62d716c6dee0fe7ecb76?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b7612263f0c62d716c6dee0fe7ecb76?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://quiteaquote.in" class="url" rel="ugc external nofollow">Linus Fernandes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T23:18:14+00:00">January 31, 2019 at 11:18 pm</time></a> </div>
<div class="comment-content">
<p>You&rsquo;re probably right. I&rsquo;ve used WordPress.com throughout for my blogs and have not moved to a self-hosted site as yet.<br/>
I&rsquo;ve exported posts to new blogs so that each site has its own focused niche. But obviously I couldn&rsquo;t take the existing number of impressions to the new blog. Since the blogs aren&rsquo;t commercial, it didn&rsquo;t matter to me. Comments were easily ported as well. This, of course, is only for the free blogs WP.com offers. I haven&rsquo;t tried any of the professional packages WP.com offers. Ads are displayed on free blogs irrespective if you&rsquo;ve signed up for WordAds or not.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-385903" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T14:32:58+00:00">January 31, 2019 at 2:32 pm</time></a> </div>
<div class="comment-content">
<p>Just a note on cloudflare: it didn&rsquo;t save your blog from the &ldquo;hug of death&rdquo; because by default it only caches static resources. In the case of this blog that&rsquo;s only a few mostly inconsequential files. The main page, rendered by WordPress (which is the thing that falls over) isn&rsquo;t cached cloudflare more or less does nothing.</p>
</div>
<ol class="children">
<li id="comment-385913" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:18:06+00:00">January 31, 2019 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>Yes. It seems that you are entirely correct. To make matters worse, wordpress deliberately defeats caching by appending a query string to static ressources like css or js files. And even when WordPress does not do it, sites like Facebook append their own query strings, again defeating caching. Thankfully, you can tell Cloudflare to ignore that.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385932" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2aacafa76beb78c7beb2f8f58417935d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2aacafa76beb78c7beb2f8f58417935d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://majid.info/" class="url" rel="ugc external nofollow">Fazal Majid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T18:37:51+00:00">January 31, 2019 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p>I would also advise moving to a static site generator like Hugo but the traffic we&rsquo;re talking about is not something that should cause even a RaspberryPi to break a sweat.</p>
<p>Turn PHP&rsquo;s opcache on, or APC if it&rsquo;s an older version of PHP. The MySQL configuration probably needs tuning as well. Some plugins may need to be disabled.</p>
<p>A good tool to figure out what is going on is the Xdebug profiler <a href="https://xdebug.org/index.php" rel="nofollow ugc">https://xdebug.org/index.php</a></p>
</div>
<ol class="children">
<li id="comment-385937" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T19:29:09+00:00">January 31, 2019 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. I think that to turn PHP opcache, I need to tweak the server configuration. I am on a managed instance and I cannot configure the server.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385936" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc18b12fff11c8b1a20841a377076505?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc18b12fff11c8b1a20841a377076505?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mmaton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T19:07:46+00:00">January 31, 2019 at 7:07 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m edge caching anonymous (cookieless) requests using cloudflare&rsquo;s workers &amp; not having to pay for a business account: <a href="https://www.mmaton.com/2018/07/02/cloudflare-cache-anonymous-requests/" rel="nofollow ugc">https://www.mmaton.com/2018/07/02/cloudflare-cache-anonymous-requests/</a></p>
</div>
<ol class="children">
<li id="comment-385938" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T19:30:33+00:00">January 31, 2019 at 7:30 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s an interesting hack.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385940" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/595b77527ee705d3c9eff565caceb9c1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/595b77527ee705d3c9eff565caceb9c1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stefanos</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T19:58:09+00:00">January 31, 2019 at 7:58 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, I could help you in any way possible if you like. Feel free to email me so we could start a thorough investigation. I don&rsquo;t plan to charge you or anything, so don&rsquo;t you worry about it.</p>
</div>
<ol class="children">
<li id="comment-385942" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T21:33:18+00:00">January 31, 2019 at 9:33 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Stefanos.</p>
</div>
</li>
</ol>
</li>
</ol>
