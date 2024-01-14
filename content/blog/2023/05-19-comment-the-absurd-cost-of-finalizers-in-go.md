---
date: "2023-05-19 12:00:00"
title: "The absurd cost of finalizers in Go"
index: false
---

[26 thoughts on &ldquo;The absurd cost of finalizers in Go&rdquo;](/lemire/blog/2023/05-19-the-absurd-cost-of-finalizers-in-go)

<ol class="comment-list">
<li id="comment-651713" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/f1ab554d1c68bb6730f880b7dd90320f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/f1ab554d1c68bb6730f880b7dd90320f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Omari Omarov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T16:47:24+00:00">May 19, 2023 at 4:47 pm</time></a> </div>
<div class="comment-content">
<p>I&rsquo;m not sure about Go&rsquo;s GC, but in .NET and Java finalizers are run during GC. No CPU cycles are spent before that.</p>
</div>
<ol class="children">
<li id="comment-651715" class="comment odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/3d999b86173d9c996436e7c60b530525?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/3d999b86173d9c996436e7c60b530525?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://ales.rocks" class="url" rel="ugc external nofollow">Aleš Najmann</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T19:19:07+00:00">May 19, 2023 at 7:19 pm</time></a> </div>
<div class="comment-content">
<p>In never incarnations of Java finalizers may not even be called. Finalizers should be replaced with try-finally or AutoClosables. It&rsquo;s really a bad idea to depend on finalizers.</p>
</div>
<ol class="children">
<li id="comment-651719" class="comment byuser comment-author-lemire bypostauthor even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T20:38:00+00:00">May 19, 2023 at 8:38 pm</time></a> </div>
<div class="comment-content">
<p>What is the alternative?</p>
</div>
<ol class="children">
<li id="comment-651736" class="comment odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/40d9bb2e8df635f2f598b7577c5b3eb9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/40d9bb2e8df635f2f598b7577c5b3eb9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://github.com/ben-manes/caffeine" class="url" rel="ugc external nofollow">Ben Manes</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-20T03:54:31+00:00">May 20, 2023 at 3:54 am</time></a> </div>
<div class="comment-content">
<p>Phantom references, e.g. by using <a href="https://docs.oracle.com/en/java/javase/11/docs/api/java.base/java/lang/ref/Cleaner.html" rel="nofollow ugc">Cleaner</a>. Finalizers are <a href="https://docs.oracle.com/en/java/javase/20/docs/api/java.base/java/lang/Object.html#finalize%28%29" rel="nofollow ugc">deprecated</a> for removal in Java.</p>
</div>
</li>
<li id="comment-651794" class="comment even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/16f22ec87b976711a875a505e248c215?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/16f22ec87b976711a875a505e248c215?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Yawar</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-22T18:37:38+00:00">May 22, 2023 at 6:37 pm</time></a> </div>
<div class="comment-content">
<p>In Go? <code>io.Closer</code> and <code>defer</code>. Or at least just <code>defer</code>. E.g.:</p>
<p><code>func whatever() {<br/>
c := C.allocate()<br/>
defer C.free_allocated(c)</p>
<p> // my code<br/>
} // c is deallocated<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-653861" class="comment odd alt depth-5">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9b6d2117767f638dbadbc85f5e8ba380?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9b6d2117767f638dbadbc85f5e8ba380?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">gc</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-08-11T01:41:05+00:00">August 11, 2023 at 1:41 am</time></a> </div>
<div class="comment-content">
<p>your sample only works for block-scoped lifetimes.<br/>
it is insufficient for allocating functions.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651716" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/1fee087d7a1ca17c8ad348271819a8d5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Antoine</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T19:40:39+00:00">May 19, 2023 at 7:40 pm</time></a> </div>
<div class="comment-content">
<p>Have you tried measuring a dummy finalizer that does not call into C? The title says &ldquo;the absurd cost of finalizers&rdquo; but, judging by your profiling results, it might be the absurd code of CGo function calls (CGo is well-known to be slow, though by how much I don&rsquo;t know).</p>
</div>
<ol class="children">
<li id="comment-651718" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T20:26:53+00:00">May 19, 2023 at 8:26 pm</time></a> </div>
<div class="comment-content">
<p>Blog post updated: it is really the finalizer.</p>
</div>
<ol class="children">
<li id="comment-651721" class="comment even depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/edbd5f1c2f535b14165ae883fa7c3f37?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/edbd5f1c2f535b14165ae883fa7c3f37?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jens Alfke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:02:26+00:00">May 19, 2023 at 9:02 pm</time></a> </div>
<div class="comment-content">
<p>I don’t see anything about sanitizers in the post?</p>
</div>
<ol class="children">
<li id="comment-651726" class="comment byuser comment-author-lemire bypostauthor odd alt depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:26:29+00:00">May 19, 2023 at 9:26 pm</time></a> </div>
<div class="comment-content">
<p><strong>Finalizer</strong>, not sanitizer.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651720" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/cba1f2d695a5ca39ee6f343297a761a4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/cba1f2d695a5ca39ee6f343297a761a4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">User</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T20:39:58+00:00">May 19, 2023 at 8:39 pm</time></a> </div>
<div class="comment-content">
<p>Go finalizers are not guaranteed to be run when a value is GC&rsquo;d.</p>
</div>
<ol class="children">
<li id="comment-651724" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:20:00+00:00">May 19, 2023 at 9:20 pm</time></a> </div>
<div class="comment-content">
<p>As long as the process terminates, then it is fine.</p>
</div>
</li>
</ol>
</li>
<li id="comment-651722" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/74d262aa646a4f9369e939b80c98f238?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/74d262aa646a4f9369e939b80c98f238?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stuart Marks</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:13:41+00:00">May 19, 2023 at 9:13 pm</time></a> </div>
<div class="comment-content">
<p>How are finalizers run if garbage collection is disabled? If Go is anything like Java, then finalizers are called by GC when it determines the object is no longer in use. The Go docs seem to back this up. (But I&rsquo;m not a Go expert so something else may be going on.)</p>
<p><a href="https://pkg.go.dev/runtime#SetFinalizer" rel="nofollow ugc">https://pkg.go.dev/runtime#SetFinalizer</a></p>
</div>
<ol class="children">
<li id="comment-651723" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:17:58+00:00">May 19, 2023 at 9:17 pm</time></a> </div>
<div class="comment-content">
<p>It is setting up the finalizer that is expensive. The garbage collection is not the issue.</p>
</div>
<ol class="children">
<li id="comment-651729" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/74d262aa646a4f9369e939b80c98f238?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/74d262aa646a4f9369e939b80c98f238?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Stuart Marks</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:34:04+00:00">May 19, 2023 at 9:34 pm</time></a> </div>
<div class="comment-content">
<p>Ah, I see, you are benchmarking only the setup of the finalizer, not waiting for the object&rsquo;s finalizer to be called. Yes that overhead is surprising. I believe that the scenario from <em>Effective Java</em> includes includes time waiting for finalizer to be called, which includes GC latency, so it isn&rsquo;t directly comparable.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651727" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ca396610db61346df76b5b1ed4e8410e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ca396610db61346df76b5b1ed4e8410e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Karl Meissner</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:27:34+00:00">May 19, 2023 at 9:27 pm</time></a> </div>
<div class="comment-content">
<p>In Go, a typical pattern is</p>
<p>r := createMyResource()<br/>
// could check errors if thats a thing for r<br/>
defer closeMyResource(r)<br/>
// use the resource r without fears of leaks for the scope of the function</p>
<p>Defer called used to be expensive but they were optimized a few years back. It would interesting to see how they compare to finalizers for your use case. I expect they would be more expensive then the manual call but safer in the face of panics or multiple return points in the using code.</p>
</div>
<ol class="children">
<li id="comment-651728" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T21:29:09+00:00">May 19, 2023 at 9:29 pm</time></a> </div>
<div class="comment-content">
<p>I know about defers, but they are not functionally equivalent because I cannot force the caller to use a defer in Go.</p>
</div>
<ol class="children">
<li id="comment-651737" class="comment odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c4bd2b9532911f70246be99343c823b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c4bd2b9532911f70246be99343c823b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexey Sharov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-20T04:47:20+00:00">May 20, 2023 at 4:47 am</time></a> </div>
<div class="comment-content">
<p>Big part of stdlib in go already designed to be used in &ldquo;defer close()&rdquo; pattern: file.Close(), bufio.Flush(), httpResponse.Body.Close(), mutex.Unlock(), close(chanel), &#8230; So, devs getting use to it anyway.<br/>
Can&rsquo;t force caller to check error returned by your function. Doesn&rsquo;t mean it&rsquo;s &ldquo;not functional equivalent for exceptions&rdquo; &#8211; it&rsquo;s &ldquo;enough equivalent&rdquo;. And all go devs know what to do with &ldquo;err&rdquo; (even if beginners doing mistakes). I think &ldquo;if err != nil&rdquo; is conceptually same thing with &ldquo;defer close()&rdquo; &#8211; no compiler guaranties, need manual work, fine.<br/>
We force devs to add &ldquo;defers dbTransaction.Rollback()&rdquo; by custom linter: <a href="https://github.com/ledgerwatch/erigon/blob/devel/rules.go#L31" rel="nofollow ugc">https://github.com/ledgerwatch/erigon/blob/devel/rules.go#L31</a></p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-651731" class="comment even thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423ad87f36b852abe811ecdd58da2ae5?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423ad87f36b852abe811ecdd58da2ae5?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T22:35:12+00:00">May 19, 2023 at 10:35 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
In Go, a typical pattern is<br/>
this was also my first thought. Why not just <code>defer C.free_allocated(c)</code>?</p>
<p> I cannot force the caller to use a defer in Go<br/>
can you maybe give an example where this is a problem?
</p></blockquote>
</div>
</li>
<li id="comment-651732" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/07e6d498e889740bc3144e4361826412?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/07e6d498e889740bc3144e4361826412?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Chris</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-19T22:37:31+00:00">May 19, 2023 at 10:37 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
In Go, a typical pattern is &#8230; defer
</p></blockquote>
<p>this was also my first thought. Why not just defer C.free_allocated(c)?</p>
<blockquote><p>
I cannot force the caller to use a defer in Go
</p></blockquote>
<p>can you maybe give an example where this is a problem?</p>
</div>
<ol class="children">
<li id="comment-651733" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-20T00:28:06+00:00">May 20, 2023 at 12:28 am</time></a> </div>
<div class="comment-content">
<p>Sure.</p>
<p>Looks at this library:</p>
<p><a href="https://github.com/ada-url/goada" rel="nofollow ugc">https://github.com/ada-url/goada</a></p>
<p>It returns a URL parsed from C.</p>
<p>Here is another library which returns a bitmap, stored in C:</p>
<p><a href="https://github.com/RoaringBitmap/gocroaring" rel="nofollow ugc">https://github.com/RoaringBitmap/gocroaring</a></p>
<p>In both cases, the Go version can be much slower than the Python equivalent when creating new values. By much, I mean, several times (at least two times).</p>
</div>
</li>
</ol>
</li>
<li id="comment-651734" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/43b98f8119f22e58791a57950145b051?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/43b98f8119f22e58791a57950145b051?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">The Alchemist</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-20T00:57:33+00:00">May 20, 2023 at 12:57 am</time></a> </div>
<div class="comment-content">
<p>For some content, Java&rsquo;s <code>Object.finalize()</code> has been deprecated since ~Java 9, 2018, and not recommended for usage for years before then. It was removed entirely ~last year in <a href="https://openjdk.org/jeps/421" rel="nofollow ugc">Java 18</a>. Performance and non-determinism are just reasons why.</p>
<p>There&rsquo;s a very detailed description of this issue at <a href="https://openjdk.org/jeps/421" rel="nofollow ugc">https://openjdk.org/jeps/421</a>, not just from a Java perspective but a more generic VM and GC perspective.</p>
<p>For Java specifically, though, <code>try-with-resources</code> and <a href="https://docs.oracle.com/en/java/javase/17/docs/api/java.base/java/lang/ref/Cleaner.html" rel="nofollow ugc"><code>java.lang.ref.Cleaner</code></a>&lsquo;s are two of the recommendations for replacement.</p>
</div>
</li>
<li id="comment-651739" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ebb2d101d96280b8b245ccb34d444dce?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ebb2d101d96280b8b245ccb34d444dce?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">me</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-20T08:24:18+00:00">May 20, 2023 at 8:24 am</time></a> </div>
<div class="comment-content">
<p>The quotes Java measurement likely is apples and oranges, similar may apply to the Go code.<br/>
Such languages live from inlining small objects to lessen the cost of memory management.<br/>
Very likely the use of finalizers kills the inline ability (because one does not really need finalizes in cases where small obejects can be inlined), as they will be put in a memory management queue.<br/>
IMHO a more realistic benchmark would be to allocate a list of 1000 such objects, then free them, so you don&rsquo;t measure &ldquo;boxing + finalizer&rdquo; when you want to measure finalizers only.</p>
</div>
</li>
<li id="comment-651766" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/26ded23dee6c9e64cbdd8a88c3797a24?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/26ded23dee6c9e64cbdd8a88c3797a24?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">RICHARD HUDSON</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-21T16:19:50+00:00">May 21, 2023 at 4:19 pm</time></a> </div>
<div class="comment-content">
<p>Finalizers should be the last option. If a design finds itself reaching for finalizers then perhaps the design needs rethought to use defer or to avoid using C to manage resources. I&rsquo;m not saying finalizers (or something similar) aren&rsquo;t needed sometimes but as the blog points out there is a cost.</p>
</div>
</li>
<li id="comment-651787" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/77616392012639d743a0e9a05563ddbd?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">jerch</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-22T09:19:46+00:00">May 22, 2023 at 9:19 am</time></a> </div>
<div class="comment-content">
<p>(Slightly offtopic)</p>
<p>Imho this illustrates a more fundamental issue we have bought into with high level programming languages &#8211; while they allow more easy/convenient programming by abstracting many goodies, these goodies come to a price and increase the distance to the machine and a proper comprehension of its real work. Or to say it differently &#8211; if Go offers a finalizer, it will get used, no matter how bad it is.</p>
<p>To illustrate that further, imho the broad adoption of GCs into languages led to a programming style, where devs dont care much about memory anymore, resulting in overly moving data around (e.g. copy constructors, hire&amp;forget memory).</p>
<p>There was a paper from google years ago stating that memcopy actions account for a very high percentage of their server load (dont remember the exact numbers anymore, I think it was &gt;30%). Imho this will only get worse with the ongoing broader adoption of languages, that heavily rely on that hire&amp;forget memory model, like Javascript/NodeJS and Python.</p>
</div>
</li>
<li id="comment-651795" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a4b17fc7e3ad7855192ff1af2bb7a95f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a4b17fc7e3ad7855192ff1af2bb7a95f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://appliedgo.net" class="url" rel="ugc external nofollow">Christoph</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-05-22T19:34:37+00:00">May 22, 2023 at 7:34 pm</time></a> </div>
<div class="comment-content">
<p>The article &ldquo;<a href="https://utcc.utoronto.ca/~cks/space/blog/programming/GoFinalizerCostsNotes" rel="nofollow ugc">Some notes on the cost of Go finalizers (in Go 1.20)</a>&rdquo; by Chris Siebenmann digs a bit deeper into the behavior of the finalizer.</p>
</div>
</li>
</ol>
