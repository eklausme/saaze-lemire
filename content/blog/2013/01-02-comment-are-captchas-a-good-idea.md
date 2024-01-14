---
date: "2013-01-02 12:00:00"
title: "Are CAPTCHAs a good idea?"
index: false
---

[30 thoughts on &ldquo;Are CAPTCHAs a good idea?&rdquo;](/lemire/blog/2013/01-02-are-captchas-a-good-idea)

<ol class="comment-list">
<li id="comment-63754" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T16:47:42+00:00">January 2, 2013 at 4:47 pm</time></a> </div>
<div class="comment-content">
<p>On spammers paying humans to break CAPTCHAs, there was a great paper on that a while back by Stefan Savage, Geoffrey Voelker, and other folks at UCSD CS. Definitely worth a read if you have a chance, here it is:</p>
<p><a href="http://cseweb.ucsd.edu/~klevchen/mlkmvs-usesec10.pdf" rel="nofollow ugc">http://cseweb.ucsd.edu/~klevchen/mlkmvs-usesec10.pdf</a></p>
<p>Note this line: &ldquo;Today, there are many service providers that can solve large numbers of CAPTCHAs via on-demand services with retail prices as low as $1 per thousand.&rdquo;</p>
</div>
</li>
<li id="comment-63757" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26e0963e76bf85cb06c8c2fbce2f06df?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://kynosarges.wordpress.com/" class="url" rel="ugc external nofollow">Chris Nahr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T17:03:09+00:00">January 2, 2013 at 5:03 pm</time></a> </div>
<div class="comment-content">
<p>Thank you for removing the CAPTCHA, I hate those things with a passion. Much like intrusive DRM it hurts legitimate users more than those it&rsquo;s designed to keep out. Obligatory comic: <a href="http://geek-and-poke.com/captcha/" rel="nofollow ugc">http://geek-and-poke.com/captcha/</a></p>
</div>
</li>
<li id="comment-63785" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T20:25:48+00:00">January 2, 2013 at 8:25 pm</time></a> </div>
<div class="comment-content">
<p>@Daniel Lemire, that&rsquo;s an interesting point, that the cost CAPTCHAs put on users is much higher now than the cost they put on spammers.</p>
<p>From that 2010 USENIX paper, the cost on spammers appears to be a mere $.001 per captcha. The cost on users, back of the envelope, might be roughly 300 times higher ($20/hour average wage, 1 minute spent on the captcha, equals $.333 as the user cost per captcha).</p>
<p>That&rsquo;s not very efficient, is it?</p>
</div>
</li>
<li id="comment-63755" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7d2b9df5f64f169546c0c0ce257caa1b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7d2b9df5f64f169546c0c0ce257caa1b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.weaselhat.com" class="url" rel="ugc external nofollow">Michael Greenberg</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T16:57:55+00:00">January 2, 2013 at 4:57 pm</time></a> </div>
<div class="comment-content">
<p>I think xkcd has this one best: <a href="http://xkcd.com/810/" rel="nofollow ugc">http://xkcd.com/810/</a> .</p>
</div>
</li>
<li id="comment-63759" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T17:08:40+00:00">January 2, 2013 at 5:08 pm</time></a> </div>
<div class="comment-content">
<p>@Greg Linden</p>
<p>Thanks for the great reference.</p>
<p>I would argue however that this otherwise excellent paper makes little of the cost to users. I find CAPTCHAs to be increasingly annoying&#8230; just consider the fact that I routinely fail them one, twice and sometimes three times. I know that I am not alone. They have gotten hard. I think that they are bound to get harder and harder so this problem is not going away. So I am much less confident than these authors that history will remember CAPTCHAs as a success.</p>
</div>
</li>
<li id="comment-63764" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/45ba3e4c7b0d534226e2e2431b4be55d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/45ba3e4c7b0d534226e2e2431b4be55d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://sergiocruz.codigofuerte.net" class="url" rel="ugc external nofollow">Sergio Cruz</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T17:30:12+00:00">January 2, 2013 at 5:30 pm</time></a> </div>
<div class="comment-content">
<p>As always Daniel, a clarifier post. Getting things on ground. Thanks for your clear point of view.</p>
</div>
</li>
<li id="comment-63769" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24fbe6cbfec5f69fefad27583ce77d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24fbe6cbfec5f69fefad27583ce77d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aram</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T18:04:49+00:00">January 2, 2013 at 6:04 pm</time></a> </div>
<div class="comment-content">
<p>Once I attempted to post a comment on your blog, but was foiled by your captcha. I was able to figure out the correct answer 🙂 but I think there was a bug in the web form, and my comment didn&rsquo;t seem important enough to email you about.</p>
</div>
</li>
<li id="comment-63771" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f24fbe6cbfec5f69fefad27583ce77d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f24fbe6cbfec5f69fefad27583ce77d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">aram</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T18:05:48+00:00">January 2, 2013 at 6:05 pm</time></a> </div>
<div class="comment-content">
<p>On the other hand, I wonder whether a captcha combined with other methods of spam detection would be more effective, since otherwise there is no cost for the spammer to try to leave billions of comments on your site.</p>
</div>
</li>
<li id="comment-63773" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T18:15:51+00:00">January 2, 2013 at 6:15 pm</time></a> </div>
<div class="comment-content">
<p>@aram</p>
<p>I&rsquo;m all for making spammers pay, but we should not make them pay at the expense of users.</p>
</div>
</li>
<li id="comment-63774" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.blackwasp.co.uk/" class="url" rel="ugc external nofollow">Richard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T18:20:45+00:00">January 2, 2013 at 6:20 pm</time></a> </div>
<div class="comment-content">
<p>I went through the same sort of decision a few months ago. Unfortunately, as soon as I removed the CAPTCHA I was inundated with emails from bots. I went with a really simple home-spun method based upon single digit maths (and no hard to read text) and 99% of the spam disappeared overnight.</p>
</div>
</li>
<li id="comment-63776" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T18:31:58+00:00">January 2, 2013 at 6:31 pm</time></a> </div>
<div class="comment-content">
<p>@Richard</p>
<p>You clearly can&rsquo;t use nothing. I use Askimet together with simple rules. This gets rid of 90% of all spam.</p>
</div>
</li>
<li id="comment-63780" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.blackwasp.co.uk/" class="url" rel="ugc external nofollow">Richard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T19:16:26+00:00">January 2, 2013 at 7:16 pm</time></a> </div>
<div class="comment-content">
<p>I thought about a spam filter but I like to get my email on the move on an iPad, which doesn&rsquo;t filter the spam. My hosted email can filter but I don&rsquo;t quite trust it not to lose something. Of course, 75% of my email seems to be spam anyway but when I had nothing filtering my contact form I that would increase to probably 98%. Finding that one good message in a sea of crud wasn&rsquo;t fun!</p>
</div>
</li>
<li id="comment-63781" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.blackwasp.co.uk/" class="url" rel="ugc external nofollow">Richard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T19:17:20+00:00">January 2, 2013 at 7:17 pm</time></a> </div>
<div class="comment-content">
<p>&#8230;should have said. I don&rsquo;t have comments feeding directly to my web site but I do have a contact form that emails me.</p>
</div>
</li>
<li id="comment-63783" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3ccaf45d7ab8ecc0e412fe911c9b9d10?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cs.utah.edu/~regehr/" class="url" rel="ugc external nofollow">John Regehr</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-02T19:29:36+00:00">January 2, 2013 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>Thanks for the post!</p>
<p>I used to not really mind captchas but then during the last few years they got so difficult or obscure that now I often don&rsquo;t get them on the first try. It&rsquo;s hard to express how infuriating this is.</p>
<p>For me Akismet has a success rate well over 99%. Out of ~2400 non-spam comments on my blog it has misclassified about 3 as spam (I skim the spam before deleting it). It has failed to classify less than about 50 spams as spam.</p>
</div>
</li>
<li id="comment-63813" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c71711062c1eea90e0f64c678ba1519b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c71711062c1eea90e0f64c678ba1519b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://tachyondecay.net/" class="url" rel="ugc external nofollow">Ben Babcock</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T01:53:00+00:00">January 3, 2013 at 1:53 am</time></a> </div>
<div class="comment-content">
<p>I think it&rsquo;s a matter of importance as well. CAPTCHAs might be appropriate for something that is a highly significant form submission (such as registering a new account), whereas for the more common occurrence of submitting a comment, it might be overkill. I would hate to have to fill out a CAPTCHA every time I tweet!</p>
<p>I had a similar CAPTCHA to the one you used to use on my own blog. A few days ago, I disabled comments entirely on my blog because I was receiving so much spam that the spammers actually managed to consume my bandwidth for the month! (I chose to disable comments instead of adding some kind of moderation because it was the most economical decision for me. I receive almost zero legitimate comments as it is, so it&rsquo;s not worth my time to rework the comment form right now. I&rsquo;ll leave that for the summer.)</p>
</div>
</li>
<li id="comment-63822" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0816fd92c11a1dd7ad3ff35796a2c80b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0816fd92c11a1dd7ad3ff35796a2c80b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kumar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T03:19:40+00:00">January 3, 2013 at 3:19 am</time></a> </div>
<div class="comment-content">
<p>Another good one is the NLP Captcha:</p>
<p><a href="http://www.nlpcaptcha.in/en/index.html" rel="nofollow ugc">http://www.nlpcaptcha.in/en/index.html</a></p>
<p>It is used a lot these days on Indian websites. They use various colours and spread social messages to its users.</p>
</div>
</li>
<li id="comment-63826" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e990dd0ff6dc7e285e4e4426a114782?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e990dd0ff6dc7e285e4e4426a114782?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cs.ucsd.edu/~savage/" class="url" rel="ugc external nofollow">Stefan Savage</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T04:01:20+00:00">January 3, 2013 at 4:01 am</time></a> </div>
<div class="comment-content">
<p>So I think that people are taking the wrong conclusion from our paper. That you can get get 1k CAPTCHAs solved for $1k (or less if you are willing to exit the retail market) is not important in and of itself. Sure it sounds cheap in isolation, but the key question is how it fits into the overall cost structure for the spammer. Thus, the $0.001 you paid is only cheap if the value reaped by solving that CAPTCHA is higher still. To put it another way, what is the ROI on posting spam on this blog? How much traffic will it drive (either via PR or direct clicks) and how much of that traffic will convert and what is the marginal revenue per conversion? Only after you know this do you understand if the cost-per-sale (the CPTCHA solving premium) was cheap or perhaps expensive. What CAPTCHAs do, and tend to do relatively cheaply, is filter out those scammers with inefficient business models. </p>
<p>That said, blogs are not an ideal setting for CAPTCHAs because since they don&rsquo;t maintain account state, they don&rsquo;t allow you to amortize the solve over the lifetime of an account (although I&rsquo;ve seen some people try to fake this by eliminating the CAPTCHA requirement from IP addresses with successful solves in the past).</p>
</div>
</li>
<li id="comment-63862" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Dominic Amann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T09:01:48+00:00">January 3, 2013 at 9:01 am</time></a> </div>
<div class="comment-content">
<p>I am in full agreement that captchas are a failure. I am somewhat colourblind, and there is nothing more annoying than having to make 4 or 5 attempts to post a comment. Here I am trying to make a contribution to debate, and the system is trying to prevent my engagement.</p>
<p>As noted, Askimet is pretty effective. I think I would also add a &ldquo;user flag&rdquo; system, let comments go through directly, and have a flag that e-mails me immediately, to use &ldquo;crowd power&rdquo; to detect spam or other abuses. That way I could allow comments to flow through directly.</p>
</div>
</li>
<li id="comment-63832" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cec996e712a41b5cda46840d6a4bf23e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cec996e712a41b5cda46840d6a4bf23e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://williamhartmann.wordpress.com" class="url" rel="ugc external nofollow">William Hartmann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T04:51:03+00:00">January 3, 2013 at 4:51 am</time></a> </div>
<div class="comment-content">
<p>I used to get annoyed with CAPTCHAs until I learned about reCAPTCHA (<a href="https://www.google.com/recaptcha" rel="nofollow ugc">http://www.google.com/recaptcha</a>); it uses the results to help the OCR of books. I love the idea of using the results of something many people are doing anyway for a useful application.</p>
</div>
</li>
<li id="comment-63837" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f09de455e45b9deae8342aa5c838067c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f09de455e45b9deae8342aa5c838067c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.codeproject.com/Members/Muigai-Mwaura" class="url" rel="ugc external nofollow">Muigai</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T05:19:02+00:00">January 3, 2013 at 5:19 am</time></a> </div>
<div class="comment-content">
<p>I suppose manual filtering can&rsquo;t be all that onerous &#8211; Assuming you were going to read all the legitimate comments posted to your blog and that Askimet is reasonably efficient.</p>
</div>
</li>
<li id="comment-63917" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f9066aabfbe4756a4b22f401c7fcf5e8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://glinden.blogspot.com/" class="url" rel="ugc external nofollow">Greg Linden</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T14:41:02+00:00">January 3, 2013 at 2:41 pm</time></a> </div>
<div class="comment-content">
<p>@Stefan Savage, I think there are two issues: (1) Are captchas effective? (2) Are they efficient?</p>
<p>As you said, to be effective, they only have to increase the costs to the point that the dumbest attempts at spam are no longer lucrative. They do appear to do that.</p>
<p>However, you don&rsquo;t address whether they are efficient, which is what I was trying to get at. Back of the envelope, it appears they are not &#8212; costs on users are roughly x300 costs on spammers, as I said earlier &#8212; and it&rsquo;s something that would be interesting to explore further.</p>
<p>Efficiency of anti-spam and security measures in general is starting to get more attention. It&rsquo;s a topic Bruce Schneier touches on sometimes as well as a couple people at MSR (e.g. Cormac Herley&rsquo;s &ldquo;So Long, and No Thanks for the Externalities: the Rational Rejection of Security Advice by Users&rdquo;). Would love to see even more on it.</p>
</div>
</li>
<li id="comment-63896" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T11:43:59+00:00">January 3, 2013 at 11:43 am</time></a> </div>
<div class="comment-content">
<p>@Muigai </p>
<p>As @John Regehr wrote, Askimet is now very good. It catches most spam. </p>
<p>@Stefan Savage</p>
<p>I think you need to factor in the cost to the users somewhere in the modelling though. After all, we could simply ask users to pass through 100 different CAPTCHAs. We would magically make CAPTCHAs 100x more expensive for the spammers.</p>
<p>Reducing usability can have a tremendous cost. I think that @Greg Linden&rsquo;s analysis is right: the cost to users can dwarf any other cost.</p>
<p>Of course, Google has invested a lot in CAPTCHAs by buying reCAPTCHA so they have an incentive to using them, but even so, they rarely use them. Many other popular online services do not require CAPTCHAs.</p>
<p>The question of whether CAPTCHAs are a success or a failure is somewhat subjective here since I have no hard data, and that&rsquo;s why I concluded the title of my blog post with a question mark.</p>
<p>@William Hartmann</p>
<p>You can contribute to the Gutenberg Project directly by reviewing OCR texts. I am not sure we should justify CAPTCHAs because of their contribution to the Gutenberg Project.</p>
</div>
</li>
<li id="comment-63934" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8e990dd0ff6dc7e285e4e4426a114782?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8e990dd0ff6dc7e285e4e4426a114782?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.cs.ucsd.edu/~savage/" class="url" rel="ugc external nofollow">Stefan Savage</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T16:01:32+00:00">January 3, 2013 at 4:01 pm</time></a> </div>
<div class="comment-content">
<p>I think there are two different issues here. One is a very pragmatic one around using CAPTCHAs for transactional activities (i.e., a single blog comment) where the mechanism cost is proportional to the number of transactions. This is not an ideal use of the technology and one might be better served pushing out a cookie with the CAPTCHA solve that allowed subsequent transactions to bypass the test. Alternatively (as per some of the original uses of CAPTCHAs) one could use an even cheaper filter (e.g., known-bad IP address range, past history, posts a URL, etc) to predicate CAPTCHA use.<br/>
However, I think the larger issue is how to structure thinking about how one evaluates security mechanisms such as CAPTCHAs. One question is indeed effectiveness, but this is not a binary issue. All security mechanisms are filters â€“ for a given cost (in overhead, false positives, time, etc) â€“ they filter out a class of attackers for whom the cost structure of the attack now exceeds the value of the attack itself. In many large-scale scenarios (account signup, blogs, etc) the marginal value of most successful attacks is quite small and thus small incremental changes to the cost structure can render the vast majority of potential attacks unprofitable. Does that mean someone can&rsquo;t defeat the CAPTCHA? No, it doesn&rsquo;t. Does it mean that there aren&rsquo;t spammers for whom it is worth paying for CAPTCHA solving service? No again. In fact, if you didn&rsquo;t have CAPTCHAs in front of account signups at places like Yahoo, Google, Microsoft, etc you would see much more abuse than you do now.<br/>
I&rsquo;m sympathetic to the question about cost to normal users. Our group tends to focus on criminal motivations so this wasn&rsquo;t something we looked at (but I think it would be a great empirical study for someone to doâ€¦. Anecdotally I understand that CAPTCHA-based turnaways are rare, but I&rsquo;ve never seen a real study on this, in part I suspect because it&rsquo;s very difficult to account for user motivation). However, I don&rsquo;t think you can look at this as simply as multiplying prevailing wages by 10 seconds and comparing against solving prices. Using this structure, one might conclude for example that it would be better not to have passwords because if you multiply the time we all have to type them in by our prevailing wages it is very likely to outstrip the value of stolen accounts on the open market. Back to the question at hand, if you truly care about total utility, then there are more variables to account for. For example, you either need to model the amount of time wasted by users having to read the spam that would otherwise be eliminated, or you need to model the cost of the alternative (e.g., having a human moderate the posts individually :-). The reason CAPTCHAs have been so successful for account signups is that they can significantly reduce abuse volume at extremely low operational expense, when compared with alternative solutions (and, anecdotally at least, the use of CAPTCHAs has not kept people from signing up for Gmail, Yahoo Mail, Hotmail, etcâ€¦). The real threat to CAPTCHAs ultimately is the extent to which automated solvers can be generalized such that the cost to create new automated solvers is significantly reduced (or, considering it conversely, that improvements in vision, audio processing, etc, will increase the time/cost to develop new CAPTCHA algorithms that are acceptable to users and not easily solvable using off-the-shelf automated tools)</p>
</div>
</li>
<li id="comment-63936" class="comment byuser comment-author-lemire bypostauthor odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T16:07:09+00:00">January 3, 2013 at 4:07 pm</time></a> </div>
<div class="comment-content">
<p>@Stefan Savage</p>
<p><em>The real threat to CAPTCHAs ultimately is the extent to which automated solvers can be generalized such that the cost to create new automated solvers is significantly reduced (&#8230;)</em></p>
<p>Yes. Human beings at their keyboards are not getting better over time at image processing. Software, however, is getting better.</p>
<p>I could even imagine the day when people use software to help them pass CAPTCHAs. 😉</p>
</div>
</li>
<li id="comment-63955" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c57013f8aa17f2fa3c82b53bf9401357?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c57013f8aa17f2fa3c82b53bf9401357?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Marijane White</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-03T19:55:30+00:00">January 3, 2013 at 7:55 pm</time></a> </div>
<div class="comment-content">
<p>Another good reason to dump CAPTCHA is that it&rsquo;s not very accessible. Here&rsquo;s what Matt May, one of the authors of _Universal Design_, wrote about it for W3C:<br/>
<a href="http://www.w3.org/TR/turingtest/" rel="nofollow ugc">http://www.w3.org/TR/turingtest/</a></p>
</div>
</li>
<li id="comment-64122" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b9d0e45454e33d79f6b164667f4d8c7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://Www.blackwasp.co.uk" class="url" rel="ugc external nofollow">Richard</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-05T03:25:39+00:00">January 5, 2013 at 3:25 am</time></a> </div>
<div class="comment-content">
<p>I am not sure that the cost to reward ratio is linked to the price you can pay to low paid workers to solve them on your behalf. The cost has to be related to the cost to the owner of the web site or blog.</p>
<p>I was often receiving enough spam emails from my contact form to take an hour or two per week of my time to deal with. Aside from the cost of my time, which is essentially zero as the site is my hobby, this is a couple of hours that I am unable to create new content.</p>
<p>The original captcha removed the vast majority of emails. Presumably, for me at least, the benefit of sending spam to me did not warrant paying people to solve captchas. However, it became gradually more difficult for people to solve as the text became more adjusted to try to avoid algorithm solutions. The simpler solution performs almost as well but hopefully annoys people less.</p>
</div>
</li>
<li id="comment-64604" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/937655a75eb3f0fd943151f4e5ab5167?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/937655a75eb3f0fd943151f4e5ab5167?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anton</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-08T14:15:26+00:00">January 8, 2013 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>It is Akismet (A-kis-met), not Â«AskimetÂ».</p>
</div>
</li>
<li id="comment-64860" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c7cc54c39e4a1fabdf05f0f44e0a8a0c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c7cc54c39e4a1fabdf05f0f44e0a8a0c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.joshuanewnham.com" class="url" rel="ugc external nofollow">Josh</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-10T04:35:26+00:00">January 10, 2013 at 4:35 am</time></a> </div>
<div class="comment-content">
<p>Just to re-iterate what William Hartmann mentioned; I think the concept of harnessing &lsquo;human idle time&rsquo; is a fantastic idea which reCAPTCHA (and others) leverage. For that reason alone I think they&rsquo;re a worthy &lsquo;feature&rsquo;.</p>
</div>
</li>
<li id="comment-64893" class="comment byuser comment-author-lemire bypostauthor even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-01-10T08:17:46+00:00">January 10, 2013 at 8:17 am</time></a> </div>
<div class="comment-content">
<p>@Josh</p>
<p>It is great if you want to spend some of your free time (&ldquo;idle time&rdquo;) contributing to projects like Gutenberg, but when I am trying to get something done and someone throws a hard CAPTCHA at me, I would not say that it is harnessing â€˜human idle time&rsquo;.</p>
<p>Like everyone, I think that the concept behind reCAPTCHA is brilliant&#8230; but I can&rsquo;t seem to pass these tests&#8230; not on the first attempt at least&#8230; I find that it is a usability nightmare. I&rsquo;m not having any fun at all. It frustrates me.</p>
<p>Maybe I am particularly bad at this or impatient, but I don&rsquo;t think I am alone.</p>
</div>
</li>
<li id="comment-75449" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8fbefc8e2f5503d56d1c28b3eb4361cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8fbefc8e2f5503d56d1c28b3eb4361cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.bish.co.uk" class="url" rel="ugc external nofollow">Richard Bishop</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-03-13T04:06:19+00:00">March 13, 2013 at 4:06 am</time></a> </div>
<div class="comment-content">
<p>I found that despite using Akismet, I was getting spam comments on my blog. I switched to using the &ldquo;Are you a human&rdquo; CAPTCHA replacement and I&rsquo;m very happy with the results so far, I just don;t seem to get SPAM comments anymore. </p>
<p><a href="http://bish.co.uk/2013/02/08/are-you-a-human-captch-replacement/" rel="nofollow ugc">http://bish.co.uk/2013/02/08/are-you-a-human-captch-replacement/</a></p>
</div>
</li>
</ol>
