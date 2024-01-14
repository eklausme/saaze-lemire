---
date: "2006-01-06 12:00:00"
title: "FOAF going nowhere?"
index: false
---

[2 thoughts on &ldquo;FOAF going nowhere?&rdquo;](/lemire/blog/2006/01-06-foaf-going-nowhere)

<ol class="comment-list">
<li id="comment-3570" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ce83a8e239c0cfce3488d3fec4d5d8de?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ce83a8e239c0cfce3488d3fec4d5d8de?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.voidstar.com" class="url" rel="ugc external nofollow">Julian Bond</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T12:44:45+00:00">January 6, 2006 at 12:44 pm</time></a> </div>
<div class="comment-content">
<p>Two problems here I think.</p>
<p>1) As you&rsquo;ve highlighted, FOAF is a write only format. There&rsquo;s tons of FOAF out there, but a shortage of lightweight tools to do something with it. And the sheer quantity means that writing a generalised scutter is hard.</p>
<p>2) It&rsquo;s an awkward and incomplete format to work with once you extract the data. I find it amazing that we still don&rsquo;t have a decent standard for describing people. vCard is equally flawed both in the standard and in support.</p>
<p>If you want to try and take this further my own humble attempt at a FOAF PHP library can be found here.<br/>
<a href="http://www.voidstar.com/foafPerson/" rel="nofollow ugc">http://www.voidstar.com/foafPerson/</a></p>
<p>The big requirement that&rsquo;s still unfulfilled isrelated to single signon It&rsquo;s a way of grabbing profile data from one place and using it in another.</p>
</div>
</li>
<li id="comment-3572" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6b0c1dab3d3c85191bbd3aff80d6f093?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6b0c1dab3d3c85191bbd3aff80d6f093?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Kunal</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-01-06T18:28:19+00:00">January 6, 2006 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>Daniel, cheers for the link! In fact I got more interested about FoaF off of your blog (almost a year or so ago), around the time when I was working on a FoaF parser in ColdFusion. </p>
<p>For the movement to catch on, developers need to write something like Feedparser for Python &#8211; basically a comprehensive parser for using FoaF files. This would solve the issue that Julian is addressing in his first point.</p>
<p>We should also talk about collaborative filtering sometime. I&rsquo;ve dabbled a bit with slope-one for some small projects and found success with it (probably one of the better methods that can scale).</p>
</div>
</li>
</ol>
