---
date: "2013-04-24 12:00:00"
title: "You probably shouldn&#8217;t use a spreadsheet for important work"
index: false
---

[7 thoughts on &ldquo;You probably shouldn&#8217;t use a spreadsheet for important work&rdquo;](/lemire/blog/2013/04-24-you-probably-shouldnt-use-a-spreadsheet-for-important-work)

<ol class="comment-list">
<li id="comment-83145" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a62d14a92e3c156bbb8350b4c4445257?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a62d14a92e3c156bbb8350b4c4445257?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.bart.gov/" class="url" rel="ugc external nofollow">Bart G</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-24T21:19:54+00:00">April 24, 2013 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>Here, here!</p>
<p>As a programmer, I was shocked when I read the Reinhart-Rogoff calculations were done on Excel. As a researcher, however, I was not.</p>
<p>At least tools like Matlab make the algorithms easily verifiable, the idea of writing tests in research is still an anomaly. The research groups that open source their projects do a much better job at this.</p>
</div>
</li>
<li id="comment-83225" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33ba1c6213a1c4eb2ca6181a29fee8e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33ba1c6213a1c4eb2ca6181a29fee8e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://williamtpayne.blogspot.co.uk/" class="url" rel="ugc external nofollow">William Payne</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-25T09:30:17+00:00">April 25, 2013 at 9:30 am</time></a> </div>
<div class="comment-content">
<p>IMHO, the biggest problem with Excel is that it is difficult to place logic in separate plain-text source files. By wrapping the logic and the data up into opaque binary .xls files, standard management tools like &ldquo;diff&rdquo; and &ldquo;blame&rdquo; cannot be used, which makes it extraordinarily and unnecessarily hard to effectively manage and review business critical (not to mention global-economy-critical) logic stored in Excel.</p>
</div>
</li>
<li id="comment-83193" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/be05ceb8ad8e72bcc64ed98e4391e2fe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/be05ceb8ad8e72bcc64ed98e4391e2fe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Thierry LhÃ´te</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-25T07:07:33+00:00">April 25, 2013 at 7:07 am</time></a> </div>
<div class="comment-content">
<p>Two nice blog posts on spreadsheet. </p>
<p>But if we want to manipulate cross-referenced data on an intranet, do you have an idea of the best opensource tools or libraries to substitute to Excel usage ?</p>
</div>
</li>
<li id="comment-83231" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2c9cb1de22e9da153a5e4518010d3a96?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2c9cb1de22e9da153a5e4518010d3a96?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://taint.org/" class="url" rel="ugc external nofollow">Justin Mason</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-25T09:49:34+00:00">April 25, 2013 at 9:49 am</time></a> </div>
<div class="comment-content">
<p>Thanks for posting this.</p>
<p>IMO, everyone who may be in a job where automation via spreadsheet is likely, needs training in SDE fundamentals: unit testing, the important of open source and open data for reproducibility, version control, and code review. We are all computer scientists now.</p>
</div>
</li>
<li id="comment-83238" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f6fb4033f00b8c67a1498842e945ca4c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f6fb4033f00b8c67a1498842e945ca4c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Eloise Pasteur</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-25T10:28:26+00:00">April 25, 2013 at 10:28 am</time></a> </div>
<div class="comment-content">
<p>I haven&rsquo;t used Excel in a few years, but it certainly used to have a control (I think it was Cntl-`) to display the formula in each cell instead of the values.</p>
<p>Now, I agree it&rsquo;s still a nightmare to read and validate pages of cells with crazy formulae in them, but it&rsquo;s slightly better than clicking into each cell and should help spot discrepancies like &ldquo;this cell is doing sum(A10:A50) and the one next to it is doing sum(B10:B35). But just a FYI.</p>
<p>Ironically enough I learnt this when supporting some people doing self-directed learning on Excel at a very low level. It really started from &ldquo;this is how you turn the computer on, this is how you start Excel&rdquo; in lesson 1 and this was in about lesson 3. I&rsquo;d been using Excel for keeping accounts and the like for several years and training people to use it for a few by then. And, as you can, memory of the keystroke clearly lingered because I still never used it!</p>
</div>
</li>
<li id="comment-83406" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b3e2eb2c6923ac0f046fe9c34e71558?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b3e2eb2c6923ac0f046fe9c34e71558?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://mobile.twitter.com/akuhn" class="url" rel="ugc external nofollow">Adrian</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-26T20:01:18+00:00">April 26, 2013 at 8:01 pm</time></a> </div>
<div class="comment-content">
<p>I dare to disagree.</p>
<p>People have good reasons to use spreadsheets, rather than telling them not to use spreadsheets we, as academics, should show how to fix spreadsheets. Or programming languages, for that matter.</p>
<p>The one huge killer feature of spreadsheets is live programming! Spreadsheet are always running, output is immediate and input always has concrete values rather than being abstract variable names. </p>
<p>Telling people to use &ldquo;bona fide&rdquo; programming languages instead of spreadsheets is like telling people to read musical scores rather than listening to recorded concert sessions. Nobody but a few highly skilled experts get the same value out of it.</p>
<p>Here&rsquo;s what we can and should do about it, </p>
<p>â€” Fix spreadsheets to support best practices like testing, code reviews and version control.</p>
<p>â€” Fix programming languages to be live, ie to be always running, having immediate output and concrete input available at all times of the programming activity.</p>
<p>Academics telling people to change their behavior has never worked and will never work. People are not stupid, they are fully aware of the shortcomings of spreadsheets but use them because their added value (ie live programming) is just so much bigger. Where we, as academics, can add value to this is by fixing spreadsheets and programming language.</p>
</div>
</li>
<li id="comment-83687" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/33ba1c6213a1c4eb2ca6181a29fee8e4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/33ba1c6213a1c4eb2ca6181a29fee8e4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://williamtpayne.blogspot.co.uk/" class="url" rel="ugc external nofollow">William Payne</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2013-04-29T10:25:36+00:00">April 29, 2013 at 10:25 am</time></a> </div>
<div class="comment-content">
<p>Ok, yes, fair point. </p>
<p>I agree that both spreadsheets and traditional programming tools are badly, badly broken, although for different reasons.</p>
<p>I totally agree with your &ldquo;liveness&rdquo; argument &#8212; it is a massive feature, and it is something that mainstream software development environments badly need. </p>
<p>I am super excited by the attention that projects like light table are getting, and hope that they spur others onto the same bandwagon.</p>
<p>I also occasionally implement a poor-man&rsquo;s version of &ldquo;live coding&rdquo; when writing python scripts by having my unit tests run every time I save one of my source files.</p>
<p>My main problem with Excel is not the way that people interact with it; I am fine with spreadsheet programming, and would not expect people to have to learn a programming language just to edit a spreadsheet! The main problem that I have is that it is not (out-of-the box) possible to extract the formulae in a spreadsheet into a plain text file, merge it with somebody else&rsquo;s changes, and import the merged document back into the main spreadsheet.</p>
<p>Now, I admit, the .xlsx format does take some steps to address these concerns, but the format is not particularly transparent, well documented, simple or readable.</p>
<p>As for your proposed fixes, I can do nothing else but support them wholeheartedly. I wonder if we should turn to KickStarter to try to fund an Excel alternative that sits on top of Python? (A highly scriptable spreadsheet implemented in the spirit of Sublime Text)?</p>
</div>
</li>
</ol>
