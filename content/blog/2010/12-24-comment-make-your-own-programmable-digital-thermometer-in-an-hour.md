---
date: "2010-12-24 12:00:00"
title: "Make your own programmable digital thermometer in an hour"
index: false
---

[14 thoughts on &ldquo;Make your own programmable digital thermometer in an hour&rdquo;](/lemire/blog/2010/12-24-make-your-own-programmable-digital-thermometer-in-an-hour)

<ol class="comment-list">
<li id="comment-54049" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b2237a2979d4a4e5665342d5f92365d2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b2237a2979d4a4e5665342d5f92365d2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/adbarbaresi" class="url" rel="ugc external nofollow">Adrien Barbaresi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-25T13:14:14+00:00">December 25, 2010 at 1:14 pm</time></a> </div>
<div class="comment-content">
<p>112 F is 44 C, not 34. So that people who will now try to make yogurt using the Celsius scale don&rsquo;t get disappointed&#8230;<br/>
Nice idea for educational purpose by the way !<br/>
(I looked at the bottom of the page to submit my comment, clicked on the validator and saw there are two errors in your XHTML.)</p>
</div>
</li>
<li id="comment-54047" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4611f83b6c5b6360f5f75084e9ee1919?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.downes.ca" class="url" rel="ugc external nofollow">Stephen Downes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-25T10:59:20+00:00">December 25, 2010 at 10:59 am</time></a> </div>
<div class="comment-content">
<p>So&#8230; what you&rsquo;re saying here is that you didn&rsquo;t have a thermometer around the house, and you didn&rsquo;t want to go out to get one&#8230;</p>
</div>
</li>
<li id="comment-54048" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">OC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-25T12:21:57+00:00">December 25, 2010 at 12:21 pm</time></a> </div>
<div class="comment-content">
<p>Do you have any reason to believe it is safe to put this particular sensor inside warm food? Plastics contain all kinds of nasty ingredients, I would be very hesitant to put any industrial plastic not made for food in contact with what I eat.</p>
<p>I use a normal glass thermometer for making yoghurt.</p>
<p>An Arduino is of course big overkill for this project. It&rsquo;s easy to set up an attiny on a breadboard. Drop the LCD and you can do this with less than $10 for all parts except the sensor.</p>
</div>
</li>
<li id="comment-54050" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-26T00:27:11+00:00">December 26, 2010 at 12:27 am</time></a> </div>
<div class="comment-content">
<p>@Downes</p>
<p>(1) I could <strong>not</strong> buy a comparable thermometer from a store. </p>
<p>(2) I like making my own stuff, from yogourt to wine, from software to electronics.</p>
<p>@OC</p>
<p>I have a glass thermometer too. In fact, I must have five different kitchen thermometers. But does your glass thermometer have a programmable alarm? Moreover, in my experience, the air bubble inside a glass thermometer makes you &ldquo;overshoot&rdquo; your target. (By the time it indicates 112F, the milk is already warmer.)</p>
<p>I would argue that Arduinos are pretty good for these types of hobby projects where saving $30 would be irrelevant. But yes, it would be neat to streamline the design and use only what is needed. Maybe for another blog post? Or do you have a design you&rsquo;d be willing to share?</p>
<p>As for food safety issues, this is merely a standard wire with the end coated in epoxy. None of this is actually &ldquo;hot&rdquo;, just warm. And it is only briefly exposed to the milk. Comparatively, the interior of food cans is often coated with epoxy which is exposed to food for months or years. But your point is well taken. I could coat the wire with some other material. In any case, the wire is a bit flimsy and I&rsquo;m concerned for long term durability. Any proposal? It needs to conduct heat well, and it must be waterproof. </p>
<p>@Barbaresi </p>
<p>I fixed the typo, thanks!</p>
</div>
</li>
<li id="comment-54051" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">OC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-26T04:47:47+00:00">December 26, 2010 at 4:47 am</time></a> </div>
<div class="comment-content">
<p>Sure, Arduinos are great for this. But since you put &ldquo;less than $80&rdquo; in bold, I thought it&rsquo;s worthwhile saying that it can actually be done for $15 or so.</p>
<p><a href="http://www.sparkfun.com/tutorials/93" rel="nofollow ugc">http://www.sparkfun.com/tutorials/93</a> shows how to set up an AVR atmega on a breadboard. I would rather use an attiny45 ($2), which has only 8 pins, and needs one external component (10k resistor for reset). Just connect power, sensor, and buzzer, and that&rsquo;s the hardware.</p>
<p>There are many plastics that are meant to be used with food. But<br/>
those are tested and certified, and made in factories that do not also process the other industrial plastics that typically include heavy metals and softeners.</p>
<p>This sensor is made using industrial black epoxy. What makes it black? Lead? Also I guess you do have part of the wire hanging in the milk as well? What plastic is the wire coated with?</p>
<p>I know too little about plastic chemistry to know if there really is a problem, but personally I would not do this unless I got a sensor from a reputable source that explicitly told me that it is safe for food use. There are plenty of toy plastics being recalled because a child might lick it.</p>
<p>I didn&rsquo;t want to sound negative &#8211; I think it&rsquo;s a great project, and I build my own little tea timers etc using AVR chips. I&rsquo;m not a plastic expert and it&rsquo;s of course your own choice what you put in your food.</p>
</div>
</li>
<li id="comment-54052" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-26T11:40:23+00:00">December 26, 2010 at 11:40 am</time></a> </div>
<div class="comment-content">
<p>@OC</p>
<p><em>There are many plastics that are meant to be used with food. But those are tested and certified, and made in factories that do not also process the other industrial plastics that typically include heavy metals and softeners.</em></p>
<p>I guess you are thinking about Chinese regulations? They cover the life cycle of a product like a digital thermometer? </p>
<p><em>This sensor is made using industrial black epoxy. What makes it black? Lead?</em></p>
<p>I just checked it with my Homax Lead Check kit, and its surface is lead-free. For fun, I checked all of my Arduino it also appears lead-free (on its surface at least).</p>
<p><em>There are plenty of toy plastics being recalled because a child might lick it.</em></p>
<p>Not just toys. Kitchenware is recalled all the time. Mugs and glasses tested by US congresswoman Jackie Speier were found to contain lead. (<a href="http://blogs.sfweekly.com/thesnitch/2010/12/lead_jackie_speier.php" rel="nofollow ugc">http://blogs.sfweekly.com/thesnitch/2010/12/lead_jackie_speier.php</a>) The same lady famously reported that 12 million glasses distributed in McDonald&rsquo;s restaurants were toxic due to Cadmium. They were recalled.</p>
</div>
</li>
<li id="comment-54053" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">OC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-26T15:53:36+00:00">December 26, 2010 at 3:53 pm</time></a> </div>
<div class="comment-content">
<p>RoHS (<a href="https://en.wikipedia.org/wiki/Restriction_of_Hazardous_Substances_Directive" rel="nofollow ugc">http://en.wikipedia.org/wiki/Restriction_of_Hazardous_Substances_Directive</a>) mostly forbids lead for electronic products, so that was not the most likely problem.</p>
<p>Perhaps you could ask someone in the chemistry department for an opinion on how safe it is to hang an industrial sensor in your milk for a few minutes? (I doubt you can test for all the possible substances commonly used in plastics.)</p>
</div>
</li>
<li id="comment-54054" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-26T21:07:46+00:00">December 26, 2010 at 9:07 pm</time></a> </div>
<div class="comment-content">
<p>@OC</p>
<p>On a related note, we could discuss whether the way I make yogourt is &ldquo;safe&rdquo;. This could open an entirely similar debate, as I am not following the usual guidelines. And, when asked, many medical doctors will argue against making fermented food at home. So, if I trusted &ldquo;experts&rdquo;, I wouldn&rsquo;t be making my own yogourt in the first place. Did you think about it? Warm milk for hours without any bacterial testing???</p>
<p>You have an interesting stance which raises a much larger question underlying this blog post. I do my own stuff because I think it leads to safer and better living. (It is a dogma. I have no evidence that this is true.) I also think that it is self-thinkers who are responsible for much of our progress.</p>
<p>The very spirit of <a href="https://en.wikipedia.org/wiki/Diy" rel="nofollow">DIY</a> is that individuals can make their own stuff without having to depend on large stores and government agencies. It does not mean that we are reckless. And indeed, I did check the sensor for lead. (And I bet I am one of the few who actually has a lead test kit at home.) However, I do not and will not seek approval from experts, government agencies or large corporations before I do my projects. In particular, large corporations and government agencies have incentives to discourage DIY projects as it undercuts them. </p>
<p>I do not live by the pretense that only large corporations (like McDonald&rsquo;s) or Chemistry professors (or medical doctors) know what is safe for me. McDonald&rsquo;s has been handing out leaded toys and, more recently, toxic glasses. Did they go ask a Chemistry professor about safety before distributing millions of toxic glasses? Probably not. But they have their own highly paid experts.</p>
<p> We were recently told by most medical experts that we had to get vaccinated for the flu whereas the whole thing was an industry-lead farce. I didn&rsquo;t get vaccinated, but many did. The net result: huge surge in profits for pharmaceuticals, and an increased debt for governments.</p>
<p>For now, I have decided that a standard electrical wire (there is no such thing as a non-industrial wire) is quite safe in liquid as long as it is not heated too much. I am also not worried about the epoxy because it is not heated and has been used extensively to cover the interior of food cans. The dye does not contain lead. All of this is good enough for me, for now. I do not conclude that it is safe&#8230; but it is certainly safer than putting any odd plastic container in a microwave, as most people do.</p>
<p>Many people want us to feel unable to think for ourselves. We are conditioned to trust the experts. And this is precisely this type of conditioning that has lead us to one of the worse financial collapse in 100 years. How could all of the banking and finance expertsv be wrong at the same time? Well. They were. They all shared the same incentives.</p>
<p>The solution, quite clearly, is not to rely on university professors (I am one of them) or on government agencies (I worked for one). Instead, we have to think for ourselves. Is this safe? You listen to the arguments, seek out the facts, you make the checks, and then you make up your own mind.</p>
<p>Don&rsquo;t trust me that this thermometer will work. Don&rsquo;t trust that it will be safe. Don&rsquo;t trust my recipe for making yogourt. Please don&rsquo;t. But please, also, don&rsquo;t trust the Chinese kitchenware industry or the government agencies. Doubt. Verify. Investigate.</p>
</div>
</li>
<li id="comment-54055" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f00fd13956fb84308e75c35aaa8c1a10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">OC</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-27T02:52:52+00:00">December 27, 2010 at 2:52 am</time></a> </div>
<div class="comment-content">
<p>I am afraid I do not see your point. People have been making yoghurt for millenia. People have not been hanging possibly toxic substances used industrially for only a few years into warm milk.</p>
<p>If the whole point of DIY is not to have to rely on big corporations, then how come you need to talk at length about what big corporations do wrong to justify that what you do is right?</p>
<p>If big corporations expose millions of children to toxic substances, does that justify me exposing my own children knowingly to toxic substances of my own making, when the alternative is simply a bit of inconvenience in using a glass thermometer? I think that is the question for me before I build such a thermometer, and your argument doesn&rsquo;t answer that for me at all.</p>
</div>
</li>
<li id="comment-54056" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-27T08:20:52+00:00">December 27, 2010 at 8:20 am</time></a> </div>
<div class="comment-content">
<p>@OC</p>
<p>I talk about government agencies and corporations because you are implying that what I do is dangerous as I lack explicit approval from such an organization or experts. That&rsquo;s precisely against the spirit of DIY.</p>
<p>As for the rest of your comment&#8230; By the gods! Don&rsquo;t use plastic and other industrial materials with your food! They leak BPAs in your food. Glass, as long as it is not fancy lead-based glass, is probably much safer. Avoiding plastic is a perfectly fine stance. </p>
<p>As for putting your kids in danger by using my design for a thermometer, please don&rsquo;t! But I am confident that your kids are more in danger health-wise if you bring them to McDonald&rsquo;s.</p>
</div>
</li>
<li id="comment-54057" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-28T03:52:25+00:00">December 28, 2010 at 3:52 am</time></a> </div>
<div class="comment-content">
<p>@Daniel<br/>
<i>&ldquo;I like making my own stuff, from yogourt to wine, from software to electronics.&rdquo;</i></p>
<p>So you are an autodidact in tinkering? 😉</p>
</div>
</li>
<li id="comment-54058" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-28T18:23:27+00:00">December 28, 2010 at 6:23 pm</time></a> </div>
<div class="comment-content">
<p>@jld</p>
<p>I am most certainly an autodidact. Thanks for the link to your blog. Interesting.</p>
</div>
</li>
<li id="comment-54059" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jld</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2010-12-29T02:14:17+00:00">December 29, 2010 at 2:14 am</time></a> </div>
<div class="comment-content">
<p>This isn&rsquo;t my blog, this is Sam Alexander&rsquo;s, a pretty weird math nerd who comments on Dick Lipton&rsquo;s blog.</p>
</div>
</li>
<li id="comment-54951" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45efc96032aba6af8c31c75f5aae68ba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45efc96032aba6af8c31c75f5aae68ba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Mari</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2012-01-31T12:55:15+00:00">January 31, 2012 at 12:55 pm</time></a> </div>
<div class="comment-content">
<p>I am so very thankful you put this out, I was looking for a thermometer that I was able to set to a specific number and it make a buzz or noise when it passed that number, and buying one just does not do it for me, I love learning how to make my own whatever . Many thanks!!!!</p>
</div>
</li>
</ol>
