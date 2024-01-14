---
date: "2005-02-04 12:00:00"
title: "XPath support in Java 1.5"
index: false
---

[10 thoughts on &ldquo;XPath support in Java 1.5&rdquo;](/lemire/blog/2005/02-04-xpath-support-in-java-15)

<ol class="comment-list">
<li id="comment-1089" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/953577bfc776e164bbd8a4db76b2a421?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/953577bfc776e164bbd8a4db76b2a421?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">didier</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-07T02:00:21+00:00">February 7, 2005 at 2:00 am</time></a> </div>
<div class="comment-content">
<p>Hey Daniel, check your rss feed (<a href="http://www.daniel-lemire.com/blog/feed/rss2/" rel="nofollow ugc">http://www.daniel-lemire.com/blog/feed/rss2/</a>). It seems to mal-formed and the cultprit seem to be the code section in sthis post.</p>
</div>
</li>
<li id="comment-1090" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-02-07T10:24:13+00:00">February 7, 2005 at 10:24 am</time></a> </div>
<div class="comment-content">
<p>Thanks. WordPress is still a bit weak as far as enforcing well formedness of the XHTML output.</p>
</div>
</li>
<li id="comment-1634" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://ostermiller.org/utils/" class="url" rel="ugc external nofollow">Java Utilities</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-03-05T17:13:52+00:00">March 5, 2005 at 5:13 pm</time></a> </div>
<div class="comment-content">
<p>It probably would not be that hard to write a iterator for the NodeList object or even extend NodeList to implement Iterator. If you did that, foreach should work just fine.</p>
</div>
</li>
<li id="comment-1635" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Daniel Lemire</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-03-06T10:01:16+00:00">March 6, 2005 at 10:01 am</time></a> </div>
<div class="comment-content">
<p>The problem is that the Sun engineers should have made the foreach construct work with their API. </p>
<p>Basically, I think that Sun&rsquo;s leadership with regard to Java is damaging, we don&rsquo;t have a the benefit of a community-based approach (Sun keeps on reinventing what other people have done) and we have the drawbacks of a community-based approach (an heterogeneous API).</p>
</div>
</li>
<li id="comment-2339" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-05-13T14:59:08+00:00">May 13, 2005 at 2:59 pm</time></a> </div>
<div class="comment-content">
<p>John, did I promote .NET? No I did not. Life is not a choice between Java and C#. There are many other languages out there&#8230; Python, PHP, Lisp, Scheme, Haskell, Prolog, BASIC, Delphi&#8230; </p>
<p>Some, like Python, implement iterators in an elegant and consistent fashion.</p>
<p>In fact, using Jython, under a JVM, you get iterators that work well. So the problem is not with the Java architecture, but rather with the fact that the Java language itself is a bit of a hack and it is certainly not as good as it could have been.</p>
<p>I don&rsquo;t use .NET. I don&rsquo;t use C#. I don&rsquo;t care about these technologies and I&rsquo;m never comparing Java to C# or VB.net.</p>
</div>
</li>
<li id="comment-2338" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">John Samson</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-05-13T13:59:33+00:00">May 13, 2005 at 1:59 pm</time></a> </div>
<div class="comment-content">
<p>A little missing like forEach is far out-wieghed by the rest of the advantages that java offers. You&rsquo;re obviously acutely ignorant. Why don&rsquo;t you go use .Net and see if your code still runs when .Net2 comes out.</p>
</div>
</li>
<li id="comment-2365" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-06-15T09:33:05+00:00">June 15, 2005 at 9:33 am</time></a> </div>
<div class="comment-content">
<p>I don&rsquo;t know how invalid my criticism is, but you make a good point &ldquo;Anonymous&rdquo;.</p>
</div>
</li>
<li id="comment-2364" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Anonymous</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-06-15T09:10:38+00:00">June 15, 2005 at 9:10 am</time></a> </div>
<div class="comment-content">
<p>NodeList has nothign to do with Sun. Is is a w3c dom API. And of course, the DOM API has to catch up to Java 1.5 to offer an iterable NodeList. So your accusation of Sun and Java is plain invalid.</p>
</div>
</li>
<li id="comment-2369" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9c8641f1aebb6763ecf07d31107db2c6?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/blog/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2005-06-16T21:30:58+00:00">June 16, 2005 at 9:30 pm</time></a> </div>
<div class="comment-content">
<p>However, while NodeList doesn&rsquo;t belong to Sun, several other objects belonging to Sun don&rsquo;t support foreach. For example, you cannot use foreach with an iterator (why not?).</p>
</div>
</li>
<li id="comment-5392" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo avatar-default" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sid</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2006-05-15T12:51:44+00:00">May 15, 2006 at 12:51 pm</time></a> </div>
<div class="comment-content">
<p>FYI &#8230; This is from the 1.5 tutorial and explains when the for each construct is used in java:</p>
<p>Traversing Collections<br/>
There are two ways to traverse collections: (1)with the for-each construct and (2) by using Iterators.<br/>
for-each Construct<br/>
The for-each construct allows you to concisely traverse a collection or array using a for loop â€” see The for Statement. The following code uses the for-each construct to print out each element of a collection on a separate line.<br/>
for (Object o : collection)<br/>
System.out.println(o);</p>
<p>Iterators<br/>
An Iterator is an object that enables you to traverse through a collection and to remove elements from the collection selectively, if desired. You get an Iterator for a collection by calling its iterator method. The following is the Iterator interface.<br/>
public interface Iterator {<br/>
boolean hasNext();<br/>
E next();<br/>
void remove(); //optional<br/>
}</p>
<p>The hasNext method returns true if the iteration has more elements, and the next method returns the next element in the iteration. The remove method removes the last element that was returned by next from the underlying Collection. The remove method may be called only once per call to next and throws an exception if this rule is violated.<br/>
Note that Iterator.remove is the only safe way to modify a collection during iteration; the behavior is unspecified if the underlying collection is modified in any other way while the iteration is in progress. </p>
<p>Use Iterator instead of the for-each construct when you need to: </p>
<p>Remove the current element. The for-each construct hides the iterator, so you cannot call remove. Therefore, the for-each construct is not usable for filtering.<br/>
Replace elements in a list or array as you traverse it.<br/>
Iterate over multiple collections in parallel.<br/>
The following method shows you how to use an Iterator to filter an arbitrary Collection â€” that is, traverse the collection removing specific elements.<br/>
static void filter(Collection c) {<br/>
for (Iterator i = c.iterator(); i.hasNext(); )<br/>
if (!cond(i.next()))<br/>
i.remove();<br/>
}</p>
<p>This simple piece of code is polymorphic, which means that it works for any Collection regardless of implementation. This example demonstrates how easy it is to write a polymorphic algorithm using the Java Collections Framework.</p>
</div>
</li>
</ol>
