---
date: "2019-11-20 12:00:00"
title: "Cloud computing: a story of incentives"
index: false
---

[9 thoughts on &ldquo;Cloud computing: a story of incentives&rdquo;](/lemire/blog/2019/11-20-cloud-computing-a-story-of-incentives)

<ol class="comment-list">
<li id="comment-448383" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b9405b1940c3ac5c61372e6ecb13e8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b9405b1940c3ac5c61372e6ecb13e8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Ludovic Pénet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-20T22:34:07+00:00">November 20, 2019 at 10:34 pm</time></a> </div>
<div class="comment-content">
<p>Cut the red tape ? I am not sure, Daniel, given the many tools available or in development to control how those resources are available according to ruled, most of the times budget rules.</p>
<p>&ldquo;Cloud&rdquo;, on demand, resources also cost much much more. Running your standard operations this way is very costly. It can have an interest for &ldquo;spot&rdquo; tasks, but they are not that many real cases.</p>
<p>You would think that &ldquo;private cloud&rdquo; is a good option, but it remains difficult today. Installing a system is ok. Dealing with the problems happening with those highly complex tasks require large teams of highly skilled people. Most big companies fail.</p>
<p>So, well, I am quite surprised by the enthusiasm for those on demand cloud solutions.</p>
<p>And I do not even discuss other aspects, like storing sensitive data</p>
</div>
<ol class="children">
<li id="comment-448388" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-20T23:03:45+00:00">November 20, 2019 at 11:03 pm</time></a> </div>
<div class="comment-content">
<p><em>“Cloud”, on demand, resources also cost much much more. Running your standard operations this way is very costly.</em></p>
<p>It might be, but it is still very popular. Whenever I meet developers these day who are not part of a super large organization (e.g., not from the government), and I ask them whether they use the public cloud, the answer is almost always positive. And the answer is typically &ldquo;we use AWS&rdquo;.</p>
<p><em>Cut the red tape ? I am not sure, Daniel</em></p>
<p>Can you elaborate on your counterpoint? If you work for a company that says &ldquo;start as many instances as you&rsquo;d like, you don&rsquo;t need approval&rdquo;, then clearly, you can have as much fun as you&rsquo;d like. Compare this with the burden of having to request additional servers, something that assuredly requires many levels of approval at most places.</p>
</div>
<ol class="children">
<li id="comment-448611" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b9405b1940c3ac5c61372e6ecb13e8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b9405b1940c3ac5c61372e6ecb13e8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ludovic Pénet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-21T19:41:29+00:00">November 21, 2019 at 7:41 pm</time></a> </div>
<div class="comment-content">
<p>Well, like the other commentator, I do not know many companies where dev can use the credit card without control&#8230; And so called on demand, cloud services are not at all free.</p>
<p>So, most companies I know of have an authorisation process for this kind of service. And it is legit: it is a spending.<br/>
And most of them use software to implement their policies.</p>
<p>Those who don&rsquo;t have or will have bad surprises. Those services are full of cost traps.</p>
<p>Do not be mistaken: I use them, for personnal projects. I love GCE. I love to be able to rent a server being billed per minute of use. I love to use this server to prepare an ML model, then plug 4 on demand high end GPU to do some stuff.<br/>
But, if that was my daily use, it would cost me much less to buy this hardware.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-448459" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e032576b53d842d4f5c510e0ec93e812?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">-.-</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-21T02:33:10+00:00">November 21, 2019 at 2:33 am</time></a> </div>
<div class="comment-content">
<p>I do see it often that cloud services do make it easier to have resources provisioned, compared with more traditional approaches, but this may only last until companies realise that giving developers unfettered access to the credit card has never been a great idea.</p>
<p>Don&rsquo;t forget traditional server hosting, which has been around for a very long time (much longer than &ldquo;cloud hosting&rdquo;), and does handle stuff like managing hardware for clients. What makes &ldquo;cloud hosting&rdquo; attractive over &ldquo;regular hosting&rdquo;, from what I can tell is:</p>
<p>near instant provisioning of resources, and hourly billing<br/>
resource management via APIs (somewhat related to the above)<br/>
hosted or &ldquo;managed&rdquo; services<br/>
cargo-cult hype</p>
<p>Non &ldquo;cloud&rdquo; hosts adopt some of the above, so the lines are blurring a bit between the two these days.</p>
<p>Many web service developers like to think that they should be &ldquo;scalable&rdquo; (insert &ldquo;webscale&rdquo; meme here) in the sense that servers should automatically scale up if load increases. The prospect is attractive, particularly to startups which will experience viral growth (because all startups believe that this will happen), as their service won&rsquo;t go down even if millions of visitors suddenly show up. Of course, such scalability is often not necessary if sufficient overprovisioning is employed, but I can only say that from experience &#8211; many don&rsquo;t have such experience, and the notion of scalability that cloud services provide can help provide an answer to an unknown, so makes people feel safer I guess.</p>
<p>The &ldquo;managed&rdquo; services can help further speed up provisioning. Note that I use managed in quotes as I think they&rsquo;re mostly a misnomer (to the benefit of cloud providers) &#8211; they aren&rsquo;t managed (beyond hardware/network management that any server host provides), rather, they&rsquo;re <em>pre-configured</em>.<br/>
Pre-configured services do mean that those not versed in configuration can quickly have something set up, and can help avoid common pitfalls (like forgetting to set up backups). Personally, as someone who likes to have full control over everything, these pre-configured services aren&rsquo;t attractive to me, but many developers simply don&rsquo;t care about all the nitty gritty details, so I can see their point.</p>
<p>I see a lot of &ldquo;tech envy&rdquo; in developers. There&rsquo;s plenty of blog posts about people being incredibly successful using the latest tech stacks or applications (or cloud, for that matter), which glamorises these sorts of things. Instead of sticking with old and boring technologies (e.g. relational databases), developers like to always change things around, try new stuff (e.g. &ldquo;managed NoSQL databases&rdquo;) and create new things. This also often helps with career prospects (professional experience in the latest tech), so you can see why there&rsquo;s an incentive to adopt the latest trends.<br/>
I suppose many web apps aren&rsquo;t that exciting, if you break down the requirements. Many are basically &ldquo;CRUD&rdquo; (create/read/update/delete) apps which are essentially fancy wrappers to a database. So developers invent complexity to keep things interesting, such as adopting complicated architectures (microservices, message queues, orchestration, multiple data stores etc etc). It&rsquo;s often easy to justify these designs/changes (&ldquo;we need to be webscale&rdquo;, &ldquo;separate concerns&rdquo;), and they often sound attractive to management (who like to tout all the changes/improvements they&rsquo;ve helped drive (whilst downplaying the downsides introduced with the changes)).</p>
<p>In a sense, these sorts of &ldquo;fashion trends&rdquo; aren&rsquo;t just limited to developers &#8211; you see this in various other industries too. There&rsquo;s reasons to adopt cloud, but there&rsquo;s also a lot of unnecessary hype around it.</p>
<p>Another thing to consider is that &ldquo;cloud&rdquo; is considered industry standard these days (i.e. &ldquo;if you&rsquo;re not on cloud, then why not?&rdquo;). Furthermore, names like AWS, Google and Microsoft have credibility behind them. If you use AWS, and it goes down, then Amazon is just having a bad day. However, if you go with a lesser known provider, and it goes down, you&rsquo;ll be forever justifying why you didn&rsquo;t go with AWS.</p>
<p>In terms of efficiency, hardware is cheap and developers are expensive. As hardware increasingly becomes more powerful, this relationship becomes truer by the day. Effects this has on our environment is rarely a concern unless it has much of an effect on the company&rsquo;s bottom line (PR could be another angle, but it&rsquo;s often not hard to manage in this regard).</p>
<p>Cloud hosting does have various downsides. Compared to traditional server hosting, cloud hosting is ridiculously expensive, for what you get. For example, it&rsquo;s not unusual to get 5-10x more bang for your buck at places like OVH compared to AWS, and that&rsquo;s ignoring what they charge for bandwidth (which is even more crazy). Unless you can <em>really</em> make use of dynamic scaling (i.e. have workloads which vary greatly), cloud will almost certainly cost more than regular server hosting. However, in most organisations, developers don&rsquo;t really care about what it costs, as it&rsquo;s rarely their concern.<br/>
(some places adopt a hybrid approach &#8211; baseline load is handled by dedicated servers, and dynamic load handled by cloud)</p>
<p>Also, many of the services provided are proprietary/non-standard to an extent, and there&rsquo;s some element of vendor lock-in. This, however, is rarely a concern when starting out.<br/>
(personally, I have a suspicion that the absurd bandwidth costs that cloud providers charge, may be to encourage customers to keep all their services on the same platform, rather than simply pick and match the most cost effective solution)</p>
<p>Because everything is billed, mistakes can be costly (for example, a rouge script which uses too many resources), whereas on traditional hosting, your server would just slow down and it&rsquo;d be obvious that there was a problem. Cloud providers do often enable you to set up warnings if you&rsquo;d get charged too much, but you have to notice and react to the warning, and also remember to set it up in the first place.</p>
<p>Complexity is also an element. AWS, for example, offers many services (often with undescriptive names) and can require some knowledge to understand.<br/>
This may seem a little contradictory to some extent, as cloud services are supposed to remove complexity with setting up services &#8211; I suppose it does to some extent, but it does add its own set of complexities on top.</p>
<p>As for your examples of photos, I don&rsquo;t really think this is a property of cloud. If you&rsquo;re given limited storage space in the cloud, then you&rsquo;d still have to manage what gets stored there. On the other hand, if you have a big harddrive at home, you&rsquo;d be less inclined to delete stuff.</p>
</div>
<ol class="children">
<li id="comment-448626" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-21T21:27:29+00:00">November 21, 2019 at 9:27 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>As for your examples of photos, I don’t really think this is a<br/>
property of cloud. If you’re given limited storage space in the cloud,<br/>
then you’d still have to manage what gets stored there.</p>
</blockquote>
<p>I would not argue that it is &ldquo;a property of the cloud&rdquo;. I was just making an analogy.</p>
</div>
</li>
</ol>
</li>
<li id="comment-448585" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1f0e3c7200701bf1d1243cf16c8dfbb6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1f0e3c7200701bf1d1243cf16c8dfbb6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">JF Grenier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-21T14:43:51+00:00">November 21, 2019 at 2:43 pm</time></a> </div>
<div class="comment-content">
<p>The main advantage of cloud computing is not really around cost nor performance. It&rsquo;s about time and humans.</p>
<p>Having anything right now is always better than having the same result tomorrow. Spinning a couple of instances to do something new is not a problem, if it cost more than the dev hours that will require optimization, do it at this time, never before. Doing it before imply you&rsquo;re not doing some other task that could bring more value.</p>
<p>Needing no humans on your side to do it is better than having to find, hire and keep a team to manage stuff internally. Cloud providers are essentially &rdquo;all those devops guys that cost a bunch that we can&rsquo;t find anyway&rdquo; as a service. Hiring is getting hard in tech, real hard.</p>
<p>As deliveries need to go faster and faster and we have less and less people to do it, it&rsquo;s inevitable that something that&rsquo;s mainly just a cost will get outsourced if it means we can go faster with less people. No one cares if the shops you go to own or rent their spaces, it&rsquo;s pretty much the same in tech.</p>
</div>
</li>
<li id="comment-448660" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bca9869462b1493d6be5bae8c67ef5a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bca9869462b1493d6be5bae8c67ef5a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://cldellow.com/" class="url" rel="ugc external nofollow">Colin Dellow</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-22T04:20:28+00:00">November 22, 2019 at 4:20 am</time></a> </div>
<div class="comment-content">
<p>It is absolutely true that the cloud enables sloppiness. See, e.g. Frank McSherry&rsquo;s paper &ldquo;Scalability! But at what COST?&rdquo; which compares &ldquo;big data&rdquo; distributed systems to the performance of a well-engineered program running on a single thread.</p>
<p>At the same time, if one uses the cloud thoughtfully, it can be freeing. If a service is melting due to load issues, you <em>could</em> allocate a bunch of developers to optimizing it right now and maybe assessing whether the increased scale merits a wholly new architecture). But this introduces uncertainty and schedule risk into whatever project they were currently working on. It also hurts morale &#8211; no one wants to be interrupted to fight fires. It also risks making poor decisions in the heat of the moment.</p>
<p>Instead, the cloud lets you buy time&#8211;simply pay for a larger server (or servers), and schedule the optimization work for the next sprint, in two weeks time. Thus, even though you are nominally paying for compute flexibility, you are actually buying flexibility at the developer level &#8212; and the developers are the most costly asset in many companies.</p>
<p>The last place I worked was an 80-person software firm. Everyone in engineering had permission to launch new AWS resources. If it was for a transient thing, no sign off needed. If it was for an ongoing project, give a heads up to your manager and make sure it aligned with the overall architecture. No big deal.</p>
<p>Everyone also had access to a dashboard that showed the company&rsquo;s daily revenue vs its (not insubstantial) daily AWS expenses. Perhaps that was key, too.</p>
</div>
<ol class="children">
<li id="comment-448696" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b9405b1940c3ac5c61372e6ecb13e8d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b9405b1940c3ac5c61372e6ecb13e8d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Ludovic Pénet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-22T07:27:31+00:00">November 22, 2019 at 7:27 am</time></a> </div>
<div class="comment-content">
<p>We always come back with to some kind of &ldquo;debt&rdquo;. Independently from the on demand / autoscale vs on premise, there is an old debate on carefully engineered vs quick and dirty.</p>
<p>Which is the best ? IMHO, it depends&#8230; What matters the most is to make a thoughtful decision, with no belief in a magic solution.</p>
</div>
</li>
</ol>
</li>
<li id="comment-448954" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/213f53565c2bea45dda7ad8cc361ccce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/213f53565c2bea45dda7ad8cc361ccce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kaartics.wordpress.com/" class="url" rel="ugc external nofollow">Kaartic Sivaraam</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-11-23T10:15:48+00:00">November 23, 2019 at 10:15 am</time></a> </div>
<div class="comment-content">
<p>A possibly relevant blog post.</p>
<p><a href="https://blog.codinghorror.com/the-cloud-is-just-someone-elses-computer/" rel="nofollow ugc">https://blog.codinghorror.com/the-cloud-is-just-someone-elses-computer/</a></p>
</div>
</li>
</ol>
