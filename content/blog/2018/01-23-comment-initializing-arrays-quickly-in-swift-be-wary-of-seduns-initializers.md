---
date: "2018-01-23 12:00:00"
title: "Initializing arrays quickly in Swift: be wary of Sadun&#8217;s initializers"
index: false
---

[3 thoughts on &ldquo;Initializing arrays quickly in Swift: be wary of Sadun&#8217;s initializers&rdquo;](/lemire/blog/2018/01-23-initializing-arrays-quickly-in-swift-be-wary-of-seduns-initializers)

<ol class="comment-list">
<li id="comment-295619" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7a98e174ca52f696ac788f3460cdae59?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7a98e174ca52f696ac788f3460cdae59?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="http://mobilyakenti.com" class="url" rel="ugc external nofollow">mobilya kenti</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-25T21:18:13+00:00">January 25, 2018 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>thanks for sharing and narration</p>
</div>
</li>
<li id="comment-295659" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a623be7f5b198878ff90eda8646b7daa?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a623be7f5b198878ff90eda8646b7daa?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Dennis</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2018-01-26T21:01:26+00:00">January 26, 2018 at 9:01 pm</time></a> </div>
<div class="comment-content">
<p>Hey Daniel, great tips for initializing arrays with Swift. I am just getting started with programming <a href="http://www.thedigitalbridges.com/5-top-signs-that-you-need-cloud-collaboration-tools/" rel="nofollow">collaboration tools</a> for the iPhone. It&rsquo;s great to know that you can optimize performance by avoiding appended elements. Your source code is very helpful.</p>
</div>
</li>
<li id="comment-496676" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ba330e4a4bcef42c1c8251dc8688caad?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ba330e4a4bcef42c1c8251dc8688caad?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Michael</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2020-03-17T19:38:56+00:00">March 17, 2020 at 7:38 pm</time></a> </div>
<div class="comment-content">
<p>Swift recently (in version 5.1) added a way to implement this initializer better. <a href="https://developer.apple.com/documentation/swift/array/3200717-init" rel="nofollow ugc"><code>Array.init(unsafeUninitializedCapacity: initializingWith:)</code> </a> It gives direct access to the backing memory buffer of the array, so it can be dangerous if used incorrectly.</p>
<p>Here is a fast and correct implementation of Erica&rsquo;s generator using this new feature:</p>
<p><code>extension Array {<br/>
@inlinable<br/>
public init(count: Int, generator generate: () throws -&gt; Element) rethrows {<br/>
try self.init(unsafeUninitializedCapacity: count) { buffer, initializedCount in<br/>
for i in 0..&lt;count {<br/>
try buffer[i] = generate()<br/>
// initializedCount must be updated in the happy<br/>
// path for the generated objects to be properly<br/>
// deallocated if an error is thrown.<br/>
initializedCount += 1<br/>
}<br/>
}<br/>
}<br/>
}<br/>
</code></p>
<p>This generates much better code than using a lazy map. <a href="https://godbolt.org/z/dSW_wM" rel="nofollow ugc">As shown here.</a></p>
</div>
</li>
</ol>
