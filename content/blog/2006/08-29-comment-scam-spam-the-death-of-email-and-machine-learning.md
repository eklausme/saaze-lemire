---
date: "2006-08-29 12:00:00"
title: "Scam Spam, the death of email, and Machine Learning"
index: false
---

[3 thoughts on &ldquo;Scam Spam, the death of email, and Machine Learning&rdquo;](/lemire/blog/2006/08-29-scam-spam-the-death-of-email-and-machine-learning)

<ol class="comment-list">
<li id="comment-25741" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/679b720c8058c6579039544232b5e9bb?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/679b720c8058c6579039544232b5e9bb?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://ml.typepad.com/" class="url" rel="ugc external nofollow">Olivier Bousquet</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-08-30T10:03:09+00:00">August 30, 2006 at 10:03 am</time></a> </div>
<div class="comment-content">
<p>Nice post!<br/>
I can only agree with that.<br/>
I would reformulate it (in a weaker form): the power is not in the algorithms but in the features you use. It is very hard to determine which are the right features, or the right representation of an email to be used by a learning algorithm.<br/>
But the question is how users can help here?</p>
<p>Here are a couple of random thoughts:<br/>
One way could be that they suggest high level features (e.g. in the form of rules) that can then be combined.<br/>
Maybe there should be a combination of examples, rules and features.<br/>
Someone may say:<br/>
[examples] this is a good email, this is a bad one<br/>
[rules] when the sender is from @bla.com it is spam<br/>
[features] how many times the term &lsquo;viagra&rsquo; appears is a good feature</p>
<p>Then you can imagine an algorithm that uses this to build its model. But ideally this model should remain understandable to the user (probably using something like rules again) so that he can modify it, or complement it&#8230;.</p>
</div>
</li>
<li id="comment-25780" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">Uccai Siravas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-08-30T13:46:59+00:00">August 30, 2006 at 1:46 pm</time></a> </div>
<div class="comment-content">
<p>Those who are in academia have their e-mails on websites and are easy targets of spammers. One way to avoid is to have an e-mail system for such people is to requires an &ldquo;electronic stamp&rdquo; To send an e-mail to user X, one must access the user X&rsquo;s website and get an &ldquo;electronic stamp.&rdquo;, which involves reading and typing distorted patterns, which machines are not good at. An e-mail received without stamps goes to a junk folder.</p>
</div>
</li>
<li id="comment-25876" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dada9de44173d6c1b13691554ef8e974?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://expert-opinion.blogspot.com/" class="url" rel="ugc external nofollow">Michael Stiber</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-08-30T22:46:19+00:00">August 30, 2006 at 10:46 pm</time></a> </div>
<div class="comment-content">
<p>These sorts of &ldquo;spam fads&rdquo; (spads?) happen every couple months or so; I&rsquo;ve noticed some of these spams leaking through my filters since late spring. I rarely see more than a couple spams a day, despite my email addresses being all over the net (and let&rsquo;s face it, once one spammer has your email address, they all have it). Each of my email addresses sends email through two levels of spam filtering: one either on a forwarding server (e.g, IEEE or ACM) or on the email host (Univ. of Washington) and the second the built-in filter in Apple&rsquo;s Mail program. When a new spad starts, there&rsquo;s a spike in leakage, and then Mail learns the new spam&rsquo;s characteristics and the leakage drops to a trickle.</p>
<p>I don&rsquo;t see it as the death of email; just the email version of fast forwarding through the commercials on a TiVo. Yes, I&rsquo;d rather not have to do it.</p>
</div>
</li>
</ol>
