---
date: "2006-06-02 12:00:00"
title: "How to recover &#8220;lost&#8221; changes in CVS"
index: false
---

[3 thoughts on &ldquo;How to recover &#8220;lost&#8221; changes in CVS&rdquo;](/lemire/blog/2006/06-02-how-to-recover-lost-changes-in-cvs)

<ol class="comment-list">
<li id="comment-7275" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/20ad3001cf097c962cfa299e2beaaa08?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/20ad3001cf097c962cfa299e2beaaa08?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Marc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-06-02T21:51:36+00:00">June 2, 2006 at 9:51 pm</time></a> </div>
<div class="comment-content">
<p>I seem to remember that you can also do it by using cvs update -j, which is used for merging. Reverting a checkin is basically like a backwards merge.</p>
</div>
</li>
<li id="comment-7391" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc88fbddf0c18989f5444d3b70ffd402?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc88fbddf0c18989f5444d3b70ffd402?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://accueil.labunix.uqam.ca/~tremblay/" class="url" rel="ugc external nofollow">Guy Tremblay</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-06-03T10:49:14+00:00">June 3, 2006 at 10:49 am</time></a> </div>
<div class="comment-content">
<p>I think the simpler way alluded by Marc would be something like the following:</p>
<p>cvs update -j 1.38 -j 1.39 myfile</p>
</div>
</li>
<li id="comment-9701" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Scott</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-06-16T14:50:25+00:00">June 16, 2006 at 2:50 pm</time></a> </div>
<div class="comment-content">
<p>Better late than never. Is that still true?</p>
<p>For the record, if you use the double -j method, you need to put the revision numbers in the other order. To reverse the changes made by revision 1.39:</p>
<p>cvs update -j 1.39 -j 1.38 myfile</p>
<p>This usage computes the diffs needed to turn the first revision number into the second. If your objective is to turn the later revision back into the earlier one (i.e., to roll back the commit), then the later revision number has to come first.</p>
<p>But is that what you intended, Daniel? Or is the merge step of the three files intended to restore the changes made in -r1.38 without clobbering other changes made in -r1.39? If so, then I don&rsquo;t know of a better way to do it than the one you noted.</p>
</div>
</li>
</ol>
