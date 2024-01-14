---
date: "2021-04-22 12:00:00"
title: "Some useful regular expressions for programmers"
index: false
---

[9 thoughts on &ldquo;Some useful regular expressions for programmers&rdquo;](/lemire/blog/2021/04-22-some-useful-regular-expressions-for-programmers)

<ol class="comment-list">
<li id="comment-582687" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/0a28b1cc0896cf25787a074ed51d5740?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/0a28b1cc0896cf25787a074ed51d5740?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">dsernst</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T07:06:48+00:00">April 23, 2021 at 7:06 am</time></a> </div>
<div class="comment-content">
<p>You might like prettier: <a href="https://prettier.io" rel="nofollow ugc">https://prettier.io</a>.</p>
<p>It handles all this and more automatically for you, for almost every language. It&rsquo;s like magic.</p>
</div>
<ol class="children">
<li id="comment-582763" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1cd07b37a5e0c119ea7cfa4964ac2368?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1cd07b37a5e0c119ea7cfa4964ac2368?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jennifer</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-24T07:34:51+00:00">April 24, 2021 at 7:34 am</time></a> </div>
<div class="comment-content">
<p>As I understand the idea of the article is to helps and teach useful regular expressions and uses code formatting as an example.</p>
</div>
</li>
</ol>
</li>
<li id="comment-582688" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/53112ec662c90924b2375990782ba612?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/53112ec662c90924b2375990782ba612?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://kai-wolf.me/" class="url" rel="ugc external nofollow">Kai</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T07:14:47+00:00">April 23, 2021 at 7:14 am</time></a> </div>
<div class="comment-content">
<p>Assuming that most of your research is done in C or C++, I wonder why you&rsquo;re not considering using clang-format for these tasks as regular expressions will only get you so far?</p>
</div>
<ol class="children">
<li id="comment-582696" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T12:29:02+00:00">April 23, 2021 at 12:29 pm</time></a> </div>
<div class="comment-content">
<p>I program using a wide range of programming languages, including C and C++. I do use clang-format and other code reformatters.</p>
</div>
</li>
</ol>
</li>
<li id="comment-582703" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36e76f8dd0ef8b3a36ebd28819b3f86a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36e76f8dd0ef8b3a36ebd28819b3f86a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://shivjm.blog/" class="url" rel="ugc external nofollow">Shiv</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T15:54:05+00:00">April 23, 2021 at 3:54 pm</time></a> </div>
<div class="comment-content">
<p>Nice tips. You can use <code>\S</code> instead of <code>[^\s]</code> to shorten some of these.</p>
<blockquote><p>
To delete the extra space, I can select it with look-ahead and look-behind expressions such as <code>&lt;(?&lt;=^(\s\s)*)\s(?=[^\s])</code>.
</p></blockquote>
<p>I think you’ve got an extra <code>&lt;</code> in there, unless that’s some sort of new metacharacter.</p>
<blockquote><p>
I do not want a space after the opening parenthesis nor before the closing parenthesis. I can check for such a case with <code>(\(\s|\s\))</code>. If I want to remove the spaces, I can detect them with a look-behind expression such as <code>(?&lt;=\()\s</code>.
</p></blockquote>
<p>This is probably the desired behaviour, but just to note, <code>\s</code> will also match newlines. If you wanted to preserve those, you could use <code>[ \t]</code> instead.</p>
<p>Your use of lookbehind &amp; lookahead is interesting. When I’m doing search-and-replace on code, I always include the prefix and suffix in capturing groups and account for those in the replacement.</p>
<p>…on further consideration, that’s probably because I’m doing it in Emacs, whose native regex engine is rather primitive.</p>
</div>
<ol class="children">
<li id="comment-582705" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T16:13:08+00:00">April 23, 2021 at 4:13 pm</time></a> </div>
<div class="comment-content">
<blockquote>
<p>This is probably the desired behaviour, but just to note, \s will also match newlines.</p>
</blockquote>
<p>It depends on whether the regular expression is applied to the whole documents or to lines. Many editors match regular expressions on a line-by-line basis by default.</p>
</div>
<ol class="children">
<li id="comment-582706" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/36e76f8dd0ef8b3a36ebd28819b3f86a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/36e76f8dd0ef8b3a36ebd28819b3f86a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://shivjm.blog/" class="url" rel="ugc external nofollow">Shiv</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T16:41:53+00:00">April 23, 2021 at 4:41 pm</time></a> </div>
<div class="comment-content">
<p>Oh, my mistake! I don’t think I’ve ever used one like that. Thanks, learnt something new. 😊</p>
</div>
</li>
</ol>
</li>
<li id="comment-582722" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a1240953d48ea069b77d5f62036bf7ca?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a1240953d48ea069b77d5f62036bf7ca?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Greg</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-23T19:18:00+00:00">April 23, 2021 at 7:18 pm</time></a> </div>
<div class="comment-content">
<p>Your habit to use capture groups instead of lookarounds is good. A lot of regex engines don&rsquo;t support variable-length lookarounds.</p>
</div>
</li>
</ol>
</li>
<li id="comment-582877" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://blog.lbs.ca" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-04-26T17:32:17+00:00">April 26, 2021 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>These are some really useful regular expressions. I use some all the time, but I used your blog as an opportunity to delete all the annoying trailing spaces in our code base (like really, who does that?).</p>
</div>
</li>
</ol>
