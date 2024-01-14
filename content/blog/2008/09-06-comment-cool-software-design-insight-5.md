---
date: "2008-09-06 12:00:00"
title: "Cool software design insight #5"
index: false
---

[8 thoughts on &ldquo;Cool software design insight #5&rdquo;](/lemire/blog/2008/09-06-cool-software-design-insight-5)

<ol class="comment-list">
<li id="comment-50133" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ab82fd8b5ffe4d09c2bb5f9c14d34b09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Parand</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-06T16:45:12+00:00">September 6, 2008 at 4:45 pm</time></a> </div>
<div class="comment-content">
<p>The Javascript object model is quite different and interesting, definitely worth a look if only to see what an alternative to traditional OO looks like. Check out prototypal and parasitic inheritance.</p>
</div>
</li>
<li id="comment-50134" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/880cbab435f00197613c9cc2065b4f5a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Daniel Haran</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-06T17:32:20+00:00">September 6, 2008 at 5:32 pm</time></a> </div>
<div class="comment-content">
<p>Amen! Duck Typing is awesome. It took me a while to figure out that objects don&rsquo;t all have to inherit from a class or implement some interface.</p>
<p>[Duck.new, Dog.new, Visitor.new].each {|e| puts e.some_method_they_all_declare }</p>
<p>Some related advice is &ldquo;Favor composition over inheritance&rdquo;. Deep inheritance graphs are a code smell.</p>
</div>
</li>
<li id="comment-50135" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dc20f7fc7b7dab70033b2a9d86c70144?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ww38.conflate.net/inductio" class="url" rel="ugc external nofollow">Mark Reid</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-06T18:15:49+00:00">September 6, 2008 at 6:15 pm</time></a> </div>
<div class="comment-content">
<p>I think part of the reason inheritance gets overused is that too much emphasis is placed on it when OO programming is taught. The ubiquitous Shape inheritance diagram springs to mind.</p>
<p>Java&rsquo;s analogue to C++&rsquo;s templates is generics. That&rsquo;s a whole different can o&rsquo; worms but, used sparingly, can also help avoid large, smelly inheritance diagrams.</p>
<p>I&rsquo;ve heard Daniel&rsquo;s advice phrased slightly differently: &ldquo;Prefer has-a over is-a&rdquo;. The main advantage of composition over inheritance is that you are more free to modify the implementation of a class that uses another class. Delegation methods and adaptors are easy to write and make your code modular and maintainable.</p>
<p>If you extend from a class you&rsquo;re pretty much stuck with the parent&rsquo;s class implementation unless you start overriding everything which defeats the purpose of inheritance anyway.</p>
<p>My rule of thumb when considering `B extends A` is to pause and ask, &ldquo;is B really an A under all possible interpretations or am I just trying to be &lsquo;clever&rsquo; and avoid writing a few extra lines of code?&rdquo;.</p>
</div>
</li>
<li id="comment-50136" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a1b4506558020fb526179783bf0b5630?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a1b4506558020fb526179783bf0b5630?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Manuel Simoni</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-07T05:49:17+00:00">September 7, 2008 at 5:49 am</time></a> </div>
<div class="comment-content">
<p>I consider myself a cool programmer and well, I sometimes do use inheritance, even though I agree that it is a somewhat problematic language feature.</p>
<p>As an example, I recently wrote a web app that produced, among other things, a lot of different Atom feeds.</p>
<p>There, it made sense to create a Feed superclass, that provides some Atom-specific functionality and then derive Feed subclasses that implement the meat of the functionality.</p>
<p>In this case, inheritance is nothing more than a mechanism for code reuse, and I think its use is warranted.</p>
<p>OTOH, if I had used a language with generic procedures (methods outside classes), I probably wouldn&rsquo;t have used inheritance, but rather simple, duck-typed generic procedures.</p>
</div>
</li>
<li id="comment-50138" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/988ac6d9ab01c62c26ca83981a0e5e9a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Kevembuangga</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-08T12:52:52+00:00">September 8, 2008 at 12:52 pm</time></a> </div>
<div class="comment-content">
<p>In some cases I still favor &ldquo;cowboy programming&rdquo; on bare metal 🙂<br/>
Depends on what kind of job of course but anyway I think functional programming (Haskell) has more potential than OO though I am not really used to it.<br/>
I always found that OO was a half baked idea.</p>
</div>
</li>
<li id="comment-50137" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d85d14bde9896007ed3b6b2d9731c14d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d85d14bde9896007ed3b6b2d9731c14d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://thesearemyfeet.blogspot.com/" class="url" rel="ugc external nofollow">Mike</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-08T11:02:37+00:00">September 8, 2008 at 11:02 am</time></a> </div>
<div class="comment-content">
<p>I think i only half agree with you on this one. I think most professional programmers discover that it&rsquo;s too hard to create and maintain deep type hierarchies, but i also think there are certain cases where classic OO polymorphism is pretty &ldquo;cool&rdquo;.</p>
</div>
</li>
<li id="comment-50158" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6518c23aacab4c42dd2c5b9b57b79fb5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-09-19T19:23:40+00:00">September 19, 2008 at 7:23 pm</time></a> </div>
<div class="comment-content">
<p><i>Java&rsquo;s analogue to C++&rsquo;s templates is generics</i></p>
<p>Java generics may look like C++ templates, but they are very different maintenance and performance-wise.</p>
</div>
</li>
<li id="comment-50254" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/4d102649ca02e45a9b0ed6a00ff84804?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/4d102649ca02e45a9b0ed6a00ff84804?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wozniak.ca/" class="url" rel="ugc external nofollow">Geoff Wozniak</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2008-11-14T05:40:09+00:00">November 14, 2008 at 5:40 am</time></a> </div>
<div class="comment-content">
<p>I agree that inheritance isn&rsquo;t cool, but sometimes it&rsquo;s necessary. This is especially true when you want to override some behaviour and the language you are using doesn&rsquo;t have a meta-object protocol.</p>
</div>
</li>
</ol>
