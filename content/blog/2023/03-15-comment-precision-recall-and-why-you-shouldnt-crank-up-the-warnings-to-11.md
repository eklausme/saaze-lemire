---
date: "2023-03-15 12:00:00"
title: "Precision, recall and why you shouldn&#8217;t crank up the warnings to 11"
index: false
---

[14 thoughts on &ldquo;Precision, recall and why you shouldn&#8217;t crank up the warnings to 11&rdquo;](/lemire/blog/2023/03-15-precision-recall-and-why-you-shouldnt-crank-up-the-warnings-to-11)

<ol class="comment-list">
<li id="comment-649797" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdceeca7852e18f26b6aac684f2b8f8a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdceeca7852e18f26b6aac684f2b8f8a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://jacobford.com" class="url" rel="ugc external nofollow">Jacob Ford</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T00:03:37+00:00">March 16, 2023 at 12:03 am</time></a> </div>
<div class="comment-content">
<p>I presume there’s also a harmonium between how concise a warning is, versus providing all the valid reasons you might encounter such an error. Such as the example you gave.</p>
</div>
</li>
<li id="comment-649798" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eacfb60b19e7f11f4abee01ac91cbcee?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eacfb60b19e7f11f4abee01ac91cbcee?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://visgean.me" class="url" rel="ugc external nofollow">martin</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T00:11:04+00:00">March 16, 2023 at 12:11 am</time></a> </div>
<div class="comment-content">
<p>I see similar issue with code style checkers, recently I feel the industry has adopted quite dogmatic approach &#8211; more the better.</p>
<p>On one of our projects we have black, isort, flake&#8230; I had quite a few commits dealing with things like long lines with sql queries being rejected.. Like having one tool that is integrated with IDEs makes sense.. but having three that i have to run through docker&#8230;</p>
<p>But regarding the initial situation in the blog post: i think its fine writing something like <code>// noqa: this is safe because blabla</code><br/>
solves the problem of multiple people dealing with the same warning.. Of course if you have million of these your point still stands.</p>
</div>
</li>
<li id="comment-649815" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5e02c014b9ae0d4964d09a998780074f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oren Tirosh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T07:06:31+00:00">March 16, 2023 at 7:06 am</time></a> </div>
<div class="comment-content">
<p>Having a static analyzer in your IDE from the very beginning of the project tuned for your current project has low overhead and excellent ROI. Maintaining near zero warnings is easy.</p>
<p>Checking an existing code base is often counterproductive. Even trying to come up with one set of personal fine-tubed warning settings doesn’t really work. Every project tends to have its own kind of typical false warnings and you don’t want to turn them all off because cumulatively they have a good chance of catching some real issues.</p>
</div>
<ol class="children">
<li id="comment-649836" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ec88587b867c47ffd61c3942dd3ff89a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T15:08:13+00:00">March 16, 2023 at 3:08 pm</time></a> </div>
<div class="comment-content">
<p>many languages also have a &ldquo;Ignore x warning for this region of code&rdquo; pragma/attribute. That way you can get to zero without torturing your code to meet some warning.</p>
</div>
<ol class="children">
<li id="comment-649845" class="comment byuser comment-author-lemire bypostauthor even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T21:02:59+00:00">March 16, 2023 at 9:02 pm</time></a> </div>
<div class="comment-content">
<p>These “Ignore x warning for this region of code” techniques are complex and non portable. They require much code, and code that is relatively complicated.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-649843" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdfc737264206251e4460455b946fac5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdfc737264206251e4460455b946fac5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Richard Yao</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T20:58:38+00:00">March 16, 2023 at 8:58 pm</time></a> </div>
<div class="comment-content">
<p>I noticed that they were moving toward that and thought it was a bad idea to offer additional checks by default based on my own experience with the security-and-quality checks, but I did not say anything.</p>
<p>Last year, I arranged for OpenZFS to start running CodeQL on every commit and it rarely complained, but we had a number of bugs that were being caught that I felt a somewhat more aggressive version would catch. That resulted in the following experimental branch where I have been slowly disabling buggy / pointless queries while filing bug reports about them:</p>
<p><a href="https://github.com/ryao/zfs/blob/codeql-experiments/.github/codeql.yml" rel="nofollow ugc">https://github.com/ryao/zfs/blob/codeql-experiments/.github/codeql.yml</a></p>
<p>Not that long ago, it caught a bug in a patch that reviewers missed, which vindicated my thoughts that a more aggressive analyzer would be useful. However, it is still not quite ready yet for me to open a PR against the main repository, since there is still a fair amount of noise. Some of it comes from tests while the rest comes from our python bindings. Unfortunately, I am not yet well versed enough in python to make judgment calls on those, but I imagine I will eventually.</p>
<p>That said, I often find making code changes to silence false positive reports from static analyzers to be worthwhile since the result is often significantly cleaner code than what was there originally. This is true for Clang&rsquo;s static analyzer&rsquo;s false positives, although I also often find them to be opportunities to add missing assertions. Unfortunately, false positives from CodeQL&rsquo;s security-and-quality checks are an exception to this trend since I find that those checks rarely identify opportunities to improve code cleanliness. I often look at the false positive reports from CodeQL&rsquo;s security-and-quality checks and think &ldquo;the reviewers will think I have gone insane if I submit a patch based on this&rdquo;.</p>
<p>There is one saving grace to GitHub&rsquo;s move. GitHub&rsquo;s code scanning only reports new reports in PRs, so even if you ignore the initial deluge of reports, you can still get useful information from a more noisy static analyzer, so this could be less terrible than it seems. However, getting people into the habit of ignoring reports is not good practice, so I highly suggest anyone deploying those checks to do some tuning to turn off the checks that have the worst signal to noise ratio first.</p>
<p>People could even use what I have done in my codeql-experiments branch as a basis for that, although I suggest at least spot checking reports in that category before turning it off, since maybe by the time you actually do this, CodeQL will have fixed some of the checkers. I plan to separate the checks being disabled into two groups, which are completely pointless checks that we should never enable and broken checks. After I have finished getting that branch ready to be merged and it is merged into OpenZFS, I plan to re-check the broken checks periodically. That would be maybe once or twice a year. That way, when the checks are fixed, we can start using them. That is probably something that others who adopt the security-and-quality checks should do too.</p>
</div>
<ol class="children">
<li id="comment-649844" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdfc737264206251e4460455b946fac5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdfc737264206251e4460455b946fac5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Richard Yao</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-16T21:00:48+00:00">March 16, 2023 at 9:00 pm</time></a> </div>
<div class="comment-content">
<p>In hindsight, I should have written:</p>
<p>&ldquo;we had a number of bugs that were being caught <strong>outside of CodeQL</strong> that I felt a somewhat more aggressive version would catch.&rdquo;</p>
</div>
</li>
</ol>
</li>
<li id="comment-649854" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f256678460c5afe31bdab98049fcde6f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">NRK</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-17T02:57:36+00:00">March 17, 2023 at 2:57 am</time></a> </div>
<div class="comment-content">
<p>Great read as usual. While you talk about false-positives, here&rsquo;s one more (and IMO a bigger) issue to consider: Checks that blindly mark certain pattern/functions without even attempting to check whether the usage was correct or not.</p>
<p>For example, clang-tidy by default will mark any memcpy call (regardless of whether it was correct or not) as &ldquo;unsafe&rdquo; and recommend using the non-portable memcpy_s function.</p>
<p>This is significantly more harmful (especially when enabled by default) because <em>not only</em> is it not catching (or even attempting to catch) any actual bugs, but it&rsquo;s going to trick newbies who don&rsquo;t know any better into writing non-portable code with a false sense of security.</p>
<p>This trend is very unfortunate and concerning because I regularly use clang-tidy (and cppcheck) and even recommend it to others as they have in the past caught real bugs.</p>
</div>
<ol class="children">
<li id="comment-649859" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fdfc737264206251e4460455b946fac5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fdfc737264206251e4460455b946fac5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Richard Yao</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-17T10:30:29+00:00">March 17, 2023 at 10:30 am</time></a> </div>
<div class="comment-content">
<p>I opened an issue with LLVM to request more specific checks and that issue has morphed into a more general complaint about that checker in general:</p>
<p><a href="https://github.com/llvm/llvm-project/issues/61098" rel="nofollow ugc">https://github.com/llvm/llvm-project/issues/61098</a></p>
<p>Hopefully, they will drop that check in favor of more intelligent checks in the future.</p>
<p>That said, there is likely room for someone to open an issue asking for that check to be disabled in clang-tidy by default. It is deeply flawed.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649861" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/29d4a72dcca62f31bf69e11a6a4159fa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/29d4a72dcca62f31bf69e11a6a4159fa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/aegilops" class="url" rel="ugc external nofollow">Paul Hodgkinson</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-17T20:26:18+00:00">March 17, 2023 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>Great to see this frank feedback, and the discussion of the precision/recall trade off is spot on. I like the use of the F1 score.</p>
<p>The problems of precision and recall are well recognised at GitHub, where I work, which is why there are different suites of queries for different precision/recall appetites.</p>
<p>There is also the ability to filter out specific problematic queries (such as the one you describe), modify them or even write your own.</p>
<p>CodeQL is opt-in for repos and can be configured quite a lot &#8211; you can change which “suite” is used (e.g. <code>security-extended</code> ) and you can use “query filters” to further include or exclude specific queries.</p>
<p>The <a href="https://docs.github.com/en/code-security/code-scanning/automatically-scanning-your-code-for-vulnerabilities-and-errors/customizing-code-scanning" rel="nofollow ugc">GitHub docs on configuring Code Scanning with CodeQL are here</a>.</p>
<p>If you find <code>security-and-quality</code> too noisy you can move to <code>security-extended</code> instead, or go back down to the default set, which is tuned to be low false positives &#8211; high precision &#8211; vs the quality set, and the extended set, which increase recall at the expense of precision.</p>
<p>The default set is included in the extended set, and the extended set is included in the quality set.</p>
<p>You can <em>really</em> crank it up to 11 with the <code>security-experimental</code> suite, but that’s for auditing or where you really need a rule that hasn’t been fully tested yet to meet the standards for the other suites &#8211; you can just pick and choose one rule from a suite.</p>
<p>I work in “Field” at GitHub, rather than directly on the product, but a big part of my role is helping get this balance right for customers using Advanced Security (the paid version of what open source get for free). We even have our own set of queries that we maintain (and move into the product, when they are ready) to help customers and demonstrate what’s possible.</p>
<p>If you get in touch with me by email or on Fosstodon I’d be happy to take a look at the repo you’re contributing to and see what can be done about the level of false positives.</p>
</div>
<ol class="children">
<li id="comment-649889" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-20T18:52:55+00:00">March 20, 2023 at 6:52 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. My blog post wasn&rsquo;t a criticism of CodeQL per se.</p>
<blockquote>
<p>If you find security-and-quality too noisy you can move to security-extended instead, or go back down to the default set, which is tuned to be low false positives – high precision – vs the quality set, and the extended set, which increase recall at the expense of precision.</p>
</blockquote>
<p>I removed the security-and-quality setting. Please be mindful that once you promote some level of static analysis, this tends to propagate: &ldquo;I just added your code to my project and CodeQL has found all these bugs&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-649885" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1d9479f90cc655523847909e680e290e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1d9479f90cc655523847909e680e290e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Slavas</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-20T08:46:13+00:00">March 20, 2023 at 8:46 am</time></a> </div>
<div class="comment-content">
<p>And now if you vary your &ldquo;B&rdquo; parameter how is the optimal number of warnings changed? The world is moving towards the hoards of not-so-well-trained programmers cause that model seems to scale better and has a faster response time. And it that world issuing tons of warnings is actually a good thing.</p>
</div>
<ol class="children">
<li id="comment-649888" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-03-20T15:28:35+00:00">March 20, 2023 at 3:28 pm</time></a> </div>
<div class="comment-content">
<p><em>The world is moving towards the hoards of not-so-well-trained programmers</em></p>
<p>Is that true though?</p>
</div>
</li>
</ol>
</li>
<li id="comment-651471" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/555462d31c05cc2d6429e91adeb7eba2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tobin Baker</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-03T21:19:23+00:00">May 3, 2023 at 9:19 pm</time></a> </div>
<div class="comment-content">
<p>Back when I worked on Windows Vista, the Windows team introduced static analysis tools that operated in conjunction with source code annotations. The vast majority of flagged issues were false positives, but the problem wasn&rsquo;t just wasted time from investigating non-issues. Some manager had the brilliant idea of outsourcing all the &ldquo;trivial fixes&rdquo; for issues flagged by static analysis to a large IT contractor in India. You can probably guess how well that went. Novice programmers completely unfamiliar with one of the world&rsquo;s most complex codebases introduced so many bugs (I wish I had statistics), which the Windows developers then had to fix, that I&rsquo;m sure it would have been cheaper to leave the investigation and fixes to the original developers. The original &ldquo;bugs&rdquo; were mostly illusory, but the bugs introduced in the &ldquo;fixes&rdquo; certainly were not. (Not that I have anything against static analysis: the Vista codebase was far more robust than XP as a result. But this was definitely the wrong way to implement it.)</p>
</div>
</li>
</ol>
