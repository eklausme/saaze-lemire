---
date: "2022-04-05 12:00:00"
title: "String representations are not unique: learn to normalize!"
index: false
---

[6 thoughts on &ldquo;String representations are not unique: learn to normalize!&rdquo;](/lemire/blog/2022/04-05-string-representations-are-not-unique-learn-to-normalize)

<ol class="comment-list">
<li id="comment-625597" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3aefd8879773a7d1afabfd02d2a47b1d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3aefd8879773a7d1afabfd02d2a47b1d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Djamé</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-05T16:00:52+00:00">April 5, 2022 at 4:00 pm</time></a> </div>
<div class="comment-content">
<p>i wish this could be done at the OS clipboard level 🙁</p>
</div>
</li>
<li id="comment-625611" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/665b5f11dfc1fa01685d95dbee607d7b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">mischa sandberg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-05T21:30:28+00:00">April 5, 2022 at 9:30 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s also a pain dealing with api&rsquo;s that flip a coin to decide, do I reject an invalid &ldquo;utf8&rdquo; sequence with an error, or do I emit (ascii!) SUB? And maybe multiple adjacent erroneous sequences become multiple SUBs. Or not. Then some other system does a binary comparison of the equivalent (?!) strings. Gah.</p>
<p>Likewise: overlong encodings are errors? subbed? mapped? passed through to be someone else&rsquo;s problem?</p>
</div>
</li>
<li id="comment-626127" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9a8baea34599fac161ba576fbb7d2699?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9a8baea34599fac161ba576fbb7d2699?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Nick Nolan</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-08T08:14:19+00:00">April 8, 2022 at 8:14 am</time></a> </div>
<div class="comment-content">
<p>It is important to recognize that what the user thinks of as a “character”—a basic unit of a writing system for a language—may not be just a single Unicode code point. Instead, that basic unit may be made up of multiple Unicode code points. To avoid ambiguity with the computer use of the term character, this is called a user-perceived character. For example, “G” + grave-accent is a user-perceived character: users think of it as a single character, yet is actually represented by two Unicode code points. These user-perceived characters are approximated by what is called a grapheme cluster, which can be determined programmatically. </p>
<p>Grapheme cluster boundaries are important for collation, regular expressions, UI interactions, segmentation for vertical text, identification of boundaries for first-letter styling, and counting “character” positions within text. Word boundaries, line boundaries, and sentence boundaries should not occur within a grapheme cluster: in other words, a grapheme cluster should be an atomic unit with respect to the process of determining these other boundaries.</p>
<p><a href="https://www.unicode.org/reports/tr29/#Grapheme_Cluster_Boundaries" rel="nofollow ugc">https://www.unicode.org/reports/tr29/#Grapheme_Cluster_Boundaries</a></p>
</div>
</li>
<li id="comment-629424" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Markus Schaber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-25T15:01:59+00:00">April 25, 2022 at 3:01 pm</time></a> </div>
<div class="comment-content">
<p>One specific problem with normalization is that the concatenation of two normalized strings is not necessarily a normalized string, so normalization only during input is not necessarily sufficient.</p>
</div>
<ol class="children">
<li id="comment-629427" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-25T15:15:19+00:00">April 25, 2022 at 3:15 pm</time></a> </div>
<div class="comment-content">
<p>Interesting. Can you give me an example?</p>
</div>
<ol class="children">
<li id="comment-629436" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77e4428df13e21425afb490a7e2098cd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Markus Schaber</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-04-25T15:56:06+00:00">April 25, 2022 at 3:56 pm</time></a> </div>
<div class="comment-content">
<p>There are some in the Unicode TR 15:</p>
<p><a href="https://unicode.org/reports/tr15/#Concatenation" rel="nofollow ugc">https://unicode.org/reports/tr15/#Concatenation</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
