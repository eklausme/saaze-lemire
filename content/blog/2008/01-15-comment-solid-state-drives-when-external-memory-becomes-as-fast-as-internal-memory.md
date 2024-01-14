---
date: "2008-01-15 12:00:00"
title: "Solid-state drives: when external memory becomes as fast as internal memory"
index: false
---

[6 thoughts on &ldquo;Solid-state drives: when external memory becomes as fast as internal memory&rdquo;](/lemire/blog/2008/01-15-solid-state-drives-when-external-memory-becomes-as-fast-as-internal-memory)

<ol class="comment-list">
<li id="comment-49689" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/730267beb135f5c28860b280e631cb66?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/730267beb135f5c28860b280e631cb66?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://jarche.com/" class="url" rel="ugc external nofollow">Harold Jarche</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-15T21:21:53+00:00">January 15, 2008 at 9:21 pm</time></a> </div>
<div class="comment-content">
<p>Zonbu (linux based and much cheaper) uses a solid state drive as well, though you only have 4 GB onboard.</p>
</div>
</li>
<li id="comment-49695" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3f322b1d5add87ae016967212a2067ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3f322b1d5add87ae016967212a2067ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kevin Burton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-23T01:51:43+00:00">January 23, 2008 at 1:51 am</time></a> </div>
<div class="comment-content">
<p>The biggest barrier to entry is the write speed.</p>
<p>To date most of the SSDs we&rsquo;ve looked at have lied about their write speed by saying the drive can do 100MB/s but when you benchmark it can only do about 20MB/s write throughput. It can still do 100MB/s reads but that&rsquo;s not too great if you&rsquo;re 100% write bound like we are.</p>
<p>We&rsquo;re going to be getting some to play with shortly and I&rsquo;m very excited by this 🙂</p>
</div>
</li>
<li id="comment-49696" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-23T09:02:00+00:00">January 23, 2008 at 9:02 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the comment Kevin&#8230;.</p>
<p>Are those sequential writes&#8230; as in&#8230; you need to dump one large contiguous stream of data&#8230; or is it random access like building an external memory hash table?</p>
<p>SSD are apparently very bad at random writes&#8230; but they do ok at sequential writes&#8230; because of their data block structure&#8230;</p>
</div>
</li>
<li id="comment-49699" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65e52d9e5b88abcd8648d581db1bf606?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65e52d9e5b88abcd8648d581db1bf606?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevin Burton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-23T13:59:21+00:00">January 23, 2008 at 1:59 pm</time></a> </div>
<div class="comment-content">
<p>Dan,</p>
<p>Well, *some* of the SSDs are bad at random writes. </p>
<p>HDDs are perfectly good at sequential writes. The HDDs we&rsquo;re using now are GREAT at them. Nearly 100MB/s. </p>
<p>More modern SSDs can do fine at random writes. The mtron SSDs can so fully random 4k writes @ 80MB/s.</p>
<p>In fact, the prime reason we&rsquo;re going with SSD is that they can do random writes at this speed.</p>
<p>In fact, they&rsquo;re great at random reads too.</p>
<p>You can do fully random 4k reads at up to 100MB/s 🙂</p>
<p>In fact, you can read the whole drive, randomly, in 32 seconds 🙂</p>
</div>
</li>
<li id="comment-49700" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-23T14:10:40+00:00">January 23, 2008 at 2:10 pm</time></a> </div>
<div class="comment-content">
<p>Thanks, for the comments. </p>
<p>> Well, *some* of the SSDs are bad at random writes.</p>
<p>My impression was that the current breed of high-capacity SSDs are bad at random writes.</p>
<p>> HDDs are perfectly good at sequential writes. The HDDs we&rsquo;re using now are GREAT at them. Nearly 100MB/s.<br/>
> More modern SSDs can do fine at random writes. The mtron SSDs can so fully random 4k writes @ 80MB/s.</p>
<p>Wow. I find it odd that you have nearly no penalty for the random writes. What is the trade-off? Cost? Capacity?</p>
<p>> In fact, they&rsquo;re great at random reads too.<br/>
> You can do fully random 4k reads at up to 100MB/s 🙂<br/>
> In fact, you can read the whole drive, randomly, in 32 seconds 🙂</p>
<p>So the drive has a 4 GB capacity?</p>
</div>
</li>
<li id="comment-49701" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/65e52d9e5b88abcd8648d581db1bf606?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/65e52d9e5b88abcd8648d581db1bf606?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevin Burton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-01-23T14:30:54+00:00">January 23, 2008 at 2:30 pm</time></a> </div>
<div class="comment-content">
<p>Read this:</p>
<p><a href="http://www.nextlevelhardware.com/storage/battleship/" rel="nofollow ugc">http://www.nextlevelhardware.com/storage/battleship/</a></p>
<p>and this:</p>
<p><a href="http://feedblog.org/2007/12/13/ssd-vs-memory-the-end-is-nigh/" rel="nofollow ugc">http://feedblog.org/2007/12/13/ssd-vs-memory-the-end-is-nigh/</a></p>
<p>These drives can do a HIGH number of iops which is why they can do the high write rate.</p>
<p>The trade off is capacity.</p>
<p>The drives we&rsquo;re looking at are only 32GB.</p>
<p>We should have the drives this week so I&rsquo;m hoping to have mysql benchmarks soon.</p>
<p>Kevin</p>
</div>
</li>
</ol>
