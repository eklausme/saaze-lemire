---
date: "2021-05-05 12:00:00"
title: "Constructing arrays of Boolean values in Java"
index: false
---

[5 thoughts on &ldquo;Constructing arrays of Boolean values in Java&rdquo;](/lemire/blog/2021/05-05-constructing-arrays-of-boolean-values-in-java)

<ol class="comment-list">
<li id="comment-583416" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e0f8ec51dc936ad6b9a05db8b7d8ad55?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e0f8ec51dc936ad6b9a05db8b7d8ad55?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Jan-Willem Maessen</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-06T01:33:13+00:00">May 6, 2021 at 1:33 am</time></a> </div>
<div class="comment-content">
<p>Related is the use of a string constant to get runtime initialization cost of nothing – the string constant is stored directly in the class file. So your string might look something like &ldquo;0100111101010&rdquo; and you&rsquo;d just mask off the low-order bit. This ought to have an initialization cost near 0.</p>
</div>
</li>
<li id="comment-583451" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Matthew Wozniczka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-06T14:01:31+00:00">May 6, 2021 at 2:01 pm</time></a> </div>
<div class="comment-content">
<p>private final byte[] FTW</p>
</div>
<ol class="children">
<li id="comment-583452" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/dcddae70351aff62451086cd399801f9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Wozniczka</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-06T14:02:26+00:00">May 6, 2021 at 2:02 pm</time></a> </div>
<div class="comment-content">
<p>Actually, I was thinking boolean[], lol.</p>
</div>
</li>
</ol>
</li>
<li id="comment-583460" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9612c9ac4b113d9b6d771f750e0465c4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9612c9ac4b113d9b6d771f750e0465c4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jean-Marie Gaillourdet</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-06T15:47:19+00:00">May 6, 2021 at 3:47 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
Java is probably smart enough not to store multiple times in memory the string “Found”. It might store it just once.
</p></blockquote>
<p>The Java language spec does guarantee that two strings that are identical and originate from literals in the source, are represented by the same object at runtime. That is called interning in Java, see the documentation of java.lang.String.intern() and <a href="https://docs.oracle.com/javase/specs/jls/se16/jls16.pdf" rel="nofollow ugc">https://docs.oracle.com/javase/specs/jls/se16/jls16.pdf</a> Chapter 12.5, first bullet point). If the same string is read from a file, that string may be a different object instance.</p>
<p>The newer garbage collectors of the JVM even try to find identical strings to merge them into one object.</p>
</div>
<ol class="children">
<li id="comment-583713" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a2728f91bcbe3460f0e15fe4ef263dfe?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a2728f91bcbe3460f0e15fe4ef263dfe?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">anon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2021-05-10T06:52:05+00:00">May 10, 2021 at 6:52 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
The newer garbage collectors of the JVM even try to find identical strings to merge them into one object.
</p></blockquote>
<p>Unfortunately not. They try to merge the underlying storage (morally <code>char[]</code>). They don&rsquo;t try to merge the objects. This is not as good, because in many cases strings are short and the object overhead (14-20 bytes) dominates the size.</p>
<p>Afaiu the jvm cannot merge the objects: The somewhat ill-considered java semantics allow to distinguish whether two strings have equal contents (.equals / .hashCode) or are identical (== / System.identityHashCode), also in context of synchronization.</p>
<p>So there would need to be some change in java semantics in order to permit the JVM to dedup objects. And java never breaks old promises from simpler times 🙁</p>
</div>
</li>
</ol>
</li>
</ol>
