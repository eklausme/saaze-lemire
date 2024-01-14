---
date: "2022-04-21 12:00:00"
title: "An overview of version control in programming"
index: false
---

[4 thoughts on &ldquo;An overview of version control in programming&rdquo;](/lemire/blog/2022/04-21-an-overview-of-version-control-in-programming)

<ol class="comment-list">
<li id="comment-628839" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/216c1db53d752f87dd8176a6ba0c2190?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/216c1db53d752f87dd8176a6ba0c2190?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Keith Thompson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-22T21:55:09+00:00">April 22, 2022 at 9:55 pm</time></a> </div>
<div class="comment-content">
<p>I saw a link to your article via Hacker news:<br/>
<a href="https://news.ycombinator.com/item?id=31113011" rel="nofollow ugc">https://news.ycombinator.com/item?id=31113011</a></p>
<p>I&rsquo;ve been using multiple version control systems for many years, and I&rsquo;d like to make some observations.</p>
<p>&gt; In the early 1980s, Tichy proposed the RCS (Revision Control System), which innovated with respect to SCCS by storing only the differences between the different versions of a file, as opposed to complete files. RCS is faster and uses less disk space than SCCS.</p>
<p>As I recall, SCCS also stores differences between files. One difference between SCCS and RCS is that SCCS stores the initial version of a file plus diffs for later versions, while RCS stores the latest version plus reverse diffs for older versions. Thus RCS is optimized for retrieving the latest version; in SCCS this would require retrieving the initial version and then applying an arbitrary number of patches.</p>
<p>&gt; Lines are separated by a sequence of special characters that identify the beginning of a line.</p>
<p>The LF and CRLF sequences are end-of-line markers, not beginning-of-line markers. Typically every line has an end-of-line marker. Some systems tolerate a missing marker on the last line.</p>
<p>Your code sample starting with func difference has &rdquo; Tags often take the form of three numbers separated by dots: MAJOR.MINOR.PATCH (for example, 1.2.3).</p>
<p>Sure, but tags can be anything. The MAJOR.MINOR.PATCH format is just one convention for version numbers, and a tag can be used to mark a version that might not correspond to a release. Semantic Versioning is great, but it&rsquo;s generally independent of the version control system.</p>
</div>
</li>
<li id="comment-628991" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://bannister.us" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-23T14:16:00+00:00">April 23, 2022 at 2:16 pm</time></a> </div>
<div class="comment-content">
<p>Two comments (with sub-comments):</p>
<p>First, with CVS we *first* got the notion of a collection of files as a single entity. With a simple &ldquo;cvs diff&rdquo; we could see *all* the changes across all the files in the repository. This was quite powerful compared to prior (like RCS), which only operated on one file at a time. </p>
<p>As an aside, CVS was backwards compatible with RCS. This meant I could point CVS at an existing collection of RCS files, and gain considerable function over folk just using RCS. (Also, I made some small contributions to CVS in the early 1990s.)</p>
<p>Second, I would suggest excising or reducing the bit about version numbers as tags. Like often true, the practice and conventions around version numbering is not inherent in source code version control. </p>
<p>You could write a distinct article about practices in version-numbering (particularly around product-versions), but do not be surprised if this generates more discussion than you might expect. At more than one job this topic ate weeks. :/</p>
</div>
<ol class="children">
<li id="comment-648957" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9087622186f0fe01571cfd0add715302?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://bannister.us/" class="url" rel="ugc external nofollow">Preston L. Bannister</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-01-16T03:26:18+00:00">January 16, 2023 at 3:26 am</time></a> </div>
<div class="comment-content">
<p>Also, fearless refactoring is aided by version control. Version control even in individual work is an accelerator. </p>
<p>(This just popped up as new in my RSS feed&#8230;)</p>
</div>
</li>
</ol>
</li>
<li id="comment-631188" class="pingback odd alt thread-even depth-1">
<div class="comment-body">
Pingback: <a href="https://renormalizetheworld.wordpress.com/2022/05/03/links-from-april-2022/" class="url" rel="ugc external nofollow">Links from April 2022 | Renormalize the World</a> </div>
</li>
</ol>
