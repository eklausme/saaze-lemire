---
date: "2016-09-06 12:00:00"
title: "Function signature: how do you order parameters?"
index: false
---

[11 thoughts on &ldquo;Function signature: how do you order parameters?&rdquo;](/lemire/blog/2016/09-06-function-signature-how-do-you-order-parameters)

<ol class="comment-list">
<li id="comment-251757" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1b5f40ec7c1e07935001188ea498d188?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://blog.lbs.ca/technology" class="url" rel="ugc external nofollow">Dominic Amann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-06T18:26:22+00:00">September 6, 2016 at 6:26 pm</time></a> </div>
<div class="comment-content">
<p>I could be wrong, but I think in C and C++ we pass variable parameters, then const parameters, then optional parameters.</p>
<p>Some friendly languages allow us to re-order parameters in the call, if we use something like CopyObject(source = s, dest = d, len = l).</p>
</div>
<ol class="children">
<li id="comment-251758" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-06T18:34:26+00:00">September 6, 2016 at 6:34 pm</time></a> </div>
<div class="comment-content">
<p><em>I could be wrong, but I think in C and C++ we pass variable parameters, then const parameters, then optional parameters.</em></p>
<p>Here is the <tt>fwrite</tt> function signature: <tt>fwrite(const void *ptr, size_t size, size_t nmemb, FILE *stream);</tt>.</p>
<p><em>Some friendly languages allow us to re-order parameters in the call, if we use something like CopyObject(source = s, dest = d, len = l).</em></p>
<p>As wikipedia points out, it is even possible in C if you pass a struct:</p>
<p><a href="https://en.wikipedia.org/wiki/Named_parameter" rel="nofollow ugc">https://en.wikipedia.org/wiki/Named_parameter</a></p>
</div>
</li>
</ol>
</li>
<li id="comment-251761" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e2235dec7378abc2a23d8a76c2efba02?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">davetweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-06T18:47:21+00:00">September 6, 2016 at 6:47 pm</time></a> </div>
<div class="comment-content">
<p>Personally, my &ldquo;trumps everything else&rdquo; rule is: order parameters in such a way that parameters of the same (or same family, such as uint8_t and uint32_t) are well separated so there&rsquo;s no tendency to confuse them in a way that still compiles. The classic example of how NOT to do an API is memset: it takes essentially [if you unpick the char &amp; size_t typedefs) (void*, uint8_t, uint32_t) with the second parameter being the one to set the bytes to while the second is the size, but in the wild you still see code that has very clearly got it the wrong way around, yet somehow hasn&rsquo;t been detected yet. Given that I always follow an &ldquo;array ptr&rdquo; immediately by the length, I&rsquo;d choose to structure memset as (uint8_t valueToSetTo, void* ptr, size_t length).</p>
</div>
<ol class="children">
<li id="comment-251763" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-06T19:20:46+00:00">September 6, 2016 at 7:20 pm</time></a> </div>
<div class="comment-content">
<p><em>(&#8230;) in the wild you still see code that has very clearly got it the wrong way around, yet somehow hasn&rsquo;t been detected yet</em></p>
<p>Hopefully, people will test their code&#8230;</p>
</div>
<ol class="children">
<li id="comment-251861" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Tweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-07T20:20:50+00:00">September 7, 2016 at 8:20 pm</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s amazing how many bugs testing, particularly testing that&rsquo;s not zealously nasty trying to break stuff, doesn&rsquo;t find, such as memsetting to 0 and swapping the args: it won&rsquo;t directly cause a crash, but might leak security info:</p>
<p><a href="https://www.redhat.com/archives/rhl-devel-list/2009-November/msg01963.html" rel="nofollow ugc">https://www.redhat.com/archives/rhl-devel-list/2009-November/msg01963.html</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-251766" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c0d4021675140729a0809f1ad9824134?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c0d4021675140729a0809f1ad9824134?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chloe Lewis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-06T20:11:59+00:00">September 6, 2016 at 8:11 pm</time></a> </div>
<div class="comment-content">
<p>`Nobody says â€œI copied to x the value yâ€œ.&rsquo;</p>
<p>Though we might say &ldquo;I made an x with the value of y&rdquo;, or &ldquo;I made an x by copying y&rdquo;.</p>
</div>
</li>
<li id="comment-251769" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40853ee016c1f1b05c32c63054c55762?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40853ee016c1f1b05c32c63054c55762?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jan Mikkelsen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-06T21:03:28+00:00">September 6, 2016 at 9:03 pm</time></a> </div>
<div class="comment-content">
<p>John Lakos specifies something similar in &ldquo;Large Scale C++&rdquo; from 1997 &#8211; arguments being modified come first in the parameter list. He also specifies they should be pointers so that it is obvious at the calling site they will be modified &#8211; this makes them different to the const-references elsewhere. not as fashionable these days but still a convention we follow. </p>
<p>(Your C++ example should be &ldquo;type&amp; x&rdquo;)</p>
</div>
</li>
<li id="comment-251794" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eb2d858a6ccea692bf677ad2c66623ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://www.apperceptul.com" class="url" rel="ugc external nofollow">Peter Turney</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-07T02:37:19+00:00">September 7, 2016 at 2:37 am</time></a> </div>
<div class="comment-content">
<p>Ideally a good editor would prompt you as you write your code. As soon as you type the function name, it should tell you the expected arguments.</p>
</div>
<ol class="children">
<li id="comment-251831" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/656e05d084448337fb49459225dc525e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">David Tweed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-07T12:39:04+00:00">September 7, 2016 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>That works on the writing side. The ogher issue is reading call sites (where obviously the variable names may be be based on their complete usage and not just what it means in this function call). I suppose you do a mouseover tooltip.</p>
</div>
</li>
</ol>
</li>
<li id="comment-251887" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4c0f4854be6f042ff500057d07c10ad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4c0f4854be6f042ff500057d07c10ad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris Matheson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-08T09:10:36+00:00">September 8, 2016 at 9:10 am</time></a> </div>
<div class="comment-content">
<p>i can&rsquo;t talk for C / C++ etc, but in JS the order or params can become really important if your trying to use a functional programming approach.</p>
<p>eg. `copy(from, to) ` may read well, but when using bind because one of those params is &ldquo;constant&rdquo; for your program `copyThing = copy.bind(copy, thing);` i would take a lot of time to try and choose the common case and arrange params in the order that it would make sense to bind them.</p>
</div>
</li>
<li id="comment-252219" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1ab45418072762e4f2df338672d2d8c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1ab45418072762e4f2df338672d2d8c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://programmingideaswithjake.com" class="url" rel="ugc external nofollow">Jacob Zimmerman</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2016-09-12T16:26:12+00:00">September 12, 2016 at 4:26 pm</time></a> </div>
<div class="comment-content">
<p>&ldquo;More generally, when acting on a data structure, I would argue that the data structure being modified (if any) should be the first parameter.&rdquo;<br/>
In functional programming that has partial calls and composition, this is the opposite. To build up a more complex operation, you compose functions together, leaving the last argument to be filled by the result of the previous function in the chain. The last thing passed in the thing being acted upon (at least by the first function in the chain), which is often the data structure.</p>
<p>In an OO world, you&rsquo;d be correct, though.</p>
</div>
</li>
</ol>
