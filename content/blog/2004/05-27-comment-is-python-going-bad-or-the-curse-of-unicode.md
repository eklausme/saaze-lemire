---
date: "2004-05-27 12:00:00"
title: "Is Python going bad? or The curse of unicode&#8230;."
index: false
---

[3 thoughts on &ldquo;Is Python going bad? or The curse of unicode&#8230;.&rdquo;](/lemire/blog/2004/05-27-is-python-going-bad-or-the-curse-of-unicode)

<ol class="comment-list">
<li id="comment-3237" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a9536185010ebb0532403aea9419b98e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a9536185010ebb0532403aea9419b98e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://file-folder-ren.sourceforge.net/" class="url" rel="ugc external nofollow">ianarÃ© sÃ©vi</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-10-17T00:53:55+00:00">October 17, 2005 at 12:53 am</time></a> </div>
<div class="comment-content">
<p>I totally agree with you, this whole encoding thing is a real pain. I am in the process of writing an application that will, amongst other things, rename an mp3 file according to its id3 tag. This is how I got into the horribly confusing world of python encoding, as so far all the mp3&rsquo;s I&rsquo;ve come across are in latin-1, and turning that into something I can manipulate has been problematic. The fact that I&rsquo;m going cross platform with this doesn&rsquo;t help. I also want to add support for other encodings (utf-16,utf8, etc&#8230;). Like you said, how am I supposed to know what encoding was used in the mp3? I&rsquo;m thinking about a series of try: except:, or maybe a loop that tries each encoding ?!? It&rsquo;ll get done eventually, but for now latin1 will have to do &#8211; at least I can rename my Brassens titles without crashing my app.<br/>
Anyway I would like to say that this page was informative by giving me a list of things to try out all in one conveniant package, rather than searching through cryptic python doc pages. Merci l&rsquo;ami !</p>
<p>&#8211; ianaré</p>
</div>
</li>
<li id="comment-3642" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn">jbalague</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-08T09:01:59+00:00">February 8, 2006 at 9:01 am</time></a> </div>
<div class="comment-content">
<p>I agree with you as well.<br/>
I&rsquo;m going mad reading and writing XML Unicoded files!!!<br/>
&#8212; jbalague</p>
</div>
</li>
<li id="comment-3686" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/8ceb34ec3a0570185714c48305a29aa6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/8ceb34ec3a0570185714c48305a29aa6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">kent sin</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-02-28T18:19:08+00:00">February 28, 2006 at 6:19 pm</time></a> </div>
<div class="comment-content">
<p>Sometimes, for example, when reading RSS feeds, even the programmer do not known what is the encoding. </p>
<p>I agree with you that unicode is very bad support in python, but that is the best scripting language support we can find.</p>
</div>
</li>
</ol>
