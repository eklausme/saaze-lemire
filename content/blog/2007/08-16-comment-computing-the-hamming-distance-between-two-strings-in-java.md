---
date: "2007-08-16 12:00:00"
title: "Computing the Hamming distance between two strings in Java?"
index: false
---

[4 thoughts on &ldquo;Computing the Hamming distance between two strings in Java?&rdquo;](/lemire/blog/2007/08-16-computing-the-hamming-distance-between-two-strings-in-java)

<ol class="comment-list">
<li id="comment-49439" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8b70790f2d886a2568bf35f10a3af9b1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://www.entish.org/willwhim/" class="url" rel="ugc external nofollow">Will</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-16T12:31:21+00:00">August 16, 2007 at 12:31 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s very easy to compute &#8212; it&rsquo;s just the number of differences, right?</p>
<p>def hamming(s1 ,s2)<br/>
dist = 0<br/>
Range.new(0,s1.length-1).each {|i| dist += 1 unless s1[i] == s2[i] }<br/>
dist<br/>
end</p>
</div>
</li>
<li id="comment-49440" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-16T12:41:12+00:00">August 16, 2007 at 12:41 pm</time></a> </div>
<div class="comment-content">
<p>Right. </p>
<p>I got as far as this:<br/>
<code><br/>
int hamming (String s1, String s2) {<br/>
if(s1.size() != s2.size()) return -1;// not sure whether there is someting better to do<br/>
int counter = 0;<br/>
for (int k = 0; k < s1.size();++k)
if(s1.at(k) != s2.at(k)) ++counter;
return counter;
}
</code></p>
<p>But that's a tad ugly.</p>
</div>
</li>
<li id="comment-49441" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebec6abd2b9f1eb4de865aed01242171?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebec6abd2b9f1eb4de865aed01242171?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://mendicantbug.com" class="url" rel="ugc external nofollow">Jason</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2007-08-16T14:15:52+00:00">August 16, 2007 at 2:15 pm</time></a> </div>
<div class="comment-content">
<p>As ugly as it may look, that&rsquo;s the standard for Java. A quick Google code search only pulls up things similar to what you have.</p>
</div>
</li>
<li id="comment-284381" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/42b2ee5de35930cf9a8fbc5499768b1d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/42b2ee5de35930cf9a8fbc5499768b1d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">lyrachord</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-08-19T06:51:34+00:00">August 19, 2017 at 6:51 am</time></a> </div>
<div class="comment-content">
<p>There is a blog:<br/>
<a href="https://blogs.ucl.ac.uk/chime/2010/06/28/java-example-code-of-common-similarity-algorithms-used-in-data-mining/" rel="nofollow ugc">https://blogs.ucl.ac.uk/chime/2010/06/28/java-example-code-of-common-similarity-algorithms-used-in-data-mining/</a></p>
<p>And the project contains other distances: <a href="http://alias-i.com/lingpipe/index.html" rel="nofollow ugc">http://alias-i.com/lingpipe/index.html</a></p>
<p>Odd:) I&rsquo;m tring to apply distance to compression</p>
</div>
</li>
</ol>
