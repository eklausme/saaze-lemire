---
date: "2017-07-07 12:00:00"
title: "Are your strings immutable?"
index: false
---

[11 thoughts on &ldquo;Are your strings immutable?&rdquo;](/lemire/blog/2017/07-07-are-your-strings-immutable)

<ol class="comment-list">
<li id="comment-282962" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cdbd04afdb5401d1cbbd390416f3c1e3?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Leonid Boytsov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-07T21:20:15+00:00">July 7, 2017 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>Not immutable, but at least they can&rsquo;t be copy-on-write anymore: <a href="https://stackoverflow.com/questions/12199710/legality-of-cow-stdstring-implementation-in-c11" rel="nofollow ugc">https://stackoverflow.com/questions/12199710/legality-of-cow-stdstring-implementation-in-c11</a></p>
</div>
</li>
<li id="comment-282969" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bc88fbddf0c18989f5444d3b70ffd402?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bc88fbddf0c18989f5444d3b70ffd402?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Guy Tremblay</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-08T03:22:48+00:00">July 8, 2017 at 3:22 am</time></a> </div>
<div class="comment-content">
<p>Concerning: &ldquo;There is no programming language where you can redefine the value â€œ3â€ to be equal to â€œ5â€.&rdquo;</p>
<p>Well, there was such a programming language where you might have been able to do so: Fortran-77. </p>
<p>I don&rsquo;t know if it is still like this (I wrote a program with this bug in 1985), but here is a &ldquo;bug&rdquo; I once had, written in pseudo-FORTRAN code:</p>
<p>DEF INC( X )<br/>
X = X + 1<br/>
END</p>
<p>INC( 0 )<br/>
PRINT *, 0</p>
<p>This program prints &ldquo;1&rdquo; on stdout (*)!</p>
<p>Why? Because in Fortran-77, all arguments are passed by reference. When 0 is used as argument in the call to INC, what is passed as real argument is a reference to the location in the *constant table* where 0 is stored. The location&rsquo;s content is then increased by 1 in INC, an so 0 becomes 1.</p>
</div>
<ol class="children">
<li id="comment-282981" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-08T11:07:52+00:00">July 8, 2017 at 11:07 am</time></a> </div>
<div class="comment-content">
<p>As I understand it, that was non-conformant compiler behavior, not part of the Fortran specification. See <a href="http://computer-programming-forum.com/49-fortran/c1e8b7d194d9f46a.htm" rel="nofollow ugc">http://computer-programming-forum.com/49-fortran/c1e8b7d194d9f46a.htm</a> for elaboration, where one commentor quotes from the FORTRAN 66 specification then adds &ldquo;All Fortran standards have required that actual arguments be<br/>
definable if they are associated with dummy arguments that<br/>
change during the execution of the procedure. It is not, however,<br/>
a violation that&rsquo;s required to be detected or reported by compliant<br/>
implementations.&rdquo;.</p>
</div>
</li>
</ol>
</li>
<li id="comment-283080" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6d633a9adb678ae58ba053b521b41844?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://llogiq.github.io" class="url" rel="ugc external nofollow">llogiq</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T21:59:07+00:00">July 10, 2017 at 9:59 pm</time></a> </div>
<div class="comment-content">
<p>Regarding the &ldquo;redefining the value of 3 to be 5&rdquo;, in Java and C#, you can use an Aspect Weaver to do this. In addition, in Java, you can mess with the Integer constant pool (using reflection + trickery) to set the third value to 5, which means Integer.valueOf(3) will return an Integer instance with a value of 5. Finally, observe the following forth code:</p>
<p>:3 5;</p>
<p>Regarding String immutability, in Rust, Strings are mutable, but one often uses a mutable &amp;str slice instead of the raw value.</p>
</div>
<ol class="children">
<li id="comment-283081" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-10T22:00:33+00:00">July 10, 2017 at 10:00 pm</time></a> </div>
<div class="comment-content">
<p>Are strings mutable or immutable in Rust?</p>
</div>
<ol class="children">
<li id="comment-283171" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2489e1bbb7b21422d28f3cec3192257f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2489e1bbb7b21422d28f3cec3192257f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">dmitry_vk</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-12T10:23:40+00:00">July 12, 2017 at 10:23 am</time></a> </div>
<div class="comment-content">
<p>There are different types of strings in Rust: some of them are mutable.<br/>
std::string::String is like C++&rsquo;s std::string &#8211; an owned mutable buffer.<br/>
&amp;str is a immutable view of a (sub-)string (Rust&rsquo;s type system also guarantees that noone can change the string while you inspect it through &amp;str).</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-283670" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2017-07-26T16:49:15+00:00">July 26, 2017 at 4:49 pm</time></a> </div>
<div class="comment-content">
<p>Keep in mind that casting-away constness of values in C and C++ is undefined behavior if the value was originally defined as const. This means that, for example, casting away constness inside a function where you don&rsquo;t really know the origin of all the arguments may be unsafe.</p>
<p>This isn&rsquo;t just a language-ism that has no practical consequence: modern compilers are putting objects (including const char* values and string objects) inside the &ldquo;read only&rdquo; section (e.g., .rodata) of the executable, which are mapped read-only into the process, and so actually cannot be written. This applies also to string literals in both languages.</p>
<p>So as a practical matter, your program will probably crash if you try to write a string literal or a string declared as const.</p>
</div>
</li>
<li id="comment-353672" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">nicol biden</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-10-02T10:47:25+00:00">October 2, 2018 at 10:47 am</time></a> </div>
<div class="comment-content">
<p>Why are Python strings immutable? Which means a string value cannot be updated . Immutability is a clean and efficient solution to concurrent access. Having immutable variables means that no matter how many times the method is called with the same variable/value, the output will always be the same. Having mutable variables means that calling the same method with the same variables may not guarantee the same output, because the variable can be mutated at any time by another method or perhaps, another thread, and that is where you start to go crazy debugging.</p>
</div>
<ol class="children">
<li id="comment-423546" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f986d14c506fae8524d62a3bc8c9081a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f986d14c506fae8524d62a3bc8c9081a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Oleh</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-08-13T09:27:29+00:00">August 13, 2019 at 9:27 am</time></a> </div>
<div class="comment-content">
<p>Variable is called so because its value can vary. Have you ever heard of visibility scopes?</p>
</div>
</li>
</ol>
</li>
<li id="comment-426078" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/100d17095ef15d2417940be80e549fb7?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/100d17095ef15d2417940be80e549fb7?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://net-informations.com/" class="url" rel="ugc external nofollow">markfilan</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-09-03T06:33:11+00:00">September 3, 2019 at 6:33 am</time></a> </div>
<div class="comment-content">
<p>Everything in Python is an object . You have to understand that Python represents all its data as objects. An object’s mutability is determined by its type. Some of these objects like lists and dictionaries are mutable , meaning you can change their content without changing their identity. Other objects like integers, floats, strings and tuples are objects that can not be changed.</p>
<p>Strings are <a href="http://net-informations.com/python/iq/immutable.htm" rel="nofollow">Immutable</a></p>
<p>Strings are immutable in Python, which means you cannot change an existing string. The best you can do is create a new string that is a variation on the original.</p>
</div>
<ol class="children">
<li id="comment-633494" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/570e2a7fd59545f60758ff9159c79206?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/570e2a7fd59545f60758ff9159c79206?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">grid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-05-20T00:52:07+00:00">May 20, 2022 at 12:52 am</time></a> </div>
<div class="comment-content">
<p>You could use the StringIO Module which is pretty much the same as the Java StringBuffer Class. Such objects are mutable.</p>
</div>
</li>
</ol>
</li>
</ol>
