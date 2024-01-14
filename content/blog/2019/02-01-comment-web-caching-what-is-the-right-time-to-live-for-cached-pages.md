---
date: "2019-02-01 12:00:00"
title: "Web caching: what is the right time-to-live for cached pages?"
index: false
---

[6 thoughts on &ldquo;Web caching: what is the right time-to-live for cached pages?&rdquo;](/lemire/blog/2019/02-01-web-caching-what-is-the-right-time-to-live-for-cached-pages)

<ol class="comment-list">
<li id="comment-385992" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7efd1a7e3f4d2e73f63b58868e62738?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7efd1a7e3f4d2e73f63b58868e62738?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Santi Diez</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-01T22:50:57+00:00">February 1, 2019 at 10:50 pm</time></a> </div>
<div class="comment-content">
<p>I have some experience building and managing some quite big WordPress sites. Using WP Super Cache is usually a bad idea, especially when there are dedicated pieces of really nice software already available.</p>
<p>The reason behind the &ldquo;A3&rdquo; setting is that WP Super Cache is storing &ldquo;rendered&rdquo; HTML pages. These pages are served without executing WordPress or any PHP code, so any HTTP header must be set by the web server. If a post is modified, the HTML version must be regenerated. The short time-to-live setting is there to prevent client caching and to force your readers&rsquo; browsers to fetch always the content from your server. This is not a very good idea.</p>
<p>If you have the time try to use Varnish. Varnish is a really fast caching HTTP reverse proxy and there are some nice plugins to make it work with WordPress.</p>
</div>
</li>
<li id="comment-386120" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bca9869462b1493d6be5bae8c67ef5a2?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bca9869462b1493d6be5bae8c67ef5a2?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn"><a href="https://cldellow.com" class="url" rel="ugc external nofollow">cldellow</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-02T15:55:44+00:00">February 2, 2019 at 3:55 pm</time></a> </div>
<div class="comment-content">
<p>In my experience, the right TTL for a web resource is basically &ldquo;forever&rdquo; (or very close to it) or &ldquo;never&rdquo; (or very close to it).</p>
<p>The forever case is suitable when you identify the resource by a hash of its contents &#8211; when you want to change it, you publish a new file with a different name, and change the pages that refer to it to use the new file name.</p>
<p>The never case is suitable for top-level resources whose names must be stable, eg a blog post URL. You want a very short TTL so that changes will be visible promptly.</p>
<p>However, this is in tension with the fact that you want to serve things quickly. Often the solution here is to cache things internally, but serve them to the world with a short TTL. WP Super Cache may be doing this. Presumably, because it&rsquo;s hooked in to the WP architecture, it can invalidate its internal cache when you revise a post or receive a new comment. Thus, when the 3 second external TTL expires, the cost of re-rendering the page is still relatively cheap, because it&rsquo;s just checking to see if its internal copy is stale, determining that it&rsquo;s not, and serving it from a file cache (which hopefully is itself warm in the kernel&rsquo;s buffer cache). Particularly good systems will serve a stale page and regenerate the page in the background to ensure consistently low latencies.</p>
<p>I don&rsquo;t have personal knowledge of how WP Super Cache works, but I&rsquo;ve done high-performance web stuff with other tools and this is the commonly accepted approach. I wouldn&rsquo;t be too suprised if WP Super Cache doesn&rsquo;t do this, or if it&rsquo;s easy to misconfigure it such that it does it poorly, though.</p>
</div>
</li>
<li id="comment-386136" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/6a3b2b2e3e34161724b478f8202ecd4e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/6a3b2b2e3e34161724b478f8202ecd4e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://skandhurkat.com" class="url" rel="ugc external nofollow">Skand Hurkat</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-02T17:46:40+00:00">February 2, 2019 at 5:46 pm</time></a> </div>
<div class="comment-content">
<p>I used to set my webcache to 7 days for HTML, and a month for CSS, JS, images, etc. <a href="https://developers.google.com/web/tools/lighthouse/audits/cache-policy" rel="nofollow">Google recommends a year.</a> Now, my website is hosted on <a href="https://pages.github.com/" rel="nofollow">github pages</a>, which is surprisingly fast and has good defaults. I use <a href="https://gohugo.io" rel="nofollow">Hugo</a> to generate static HTML, which works like a charm for blogs and other content that changes infrequently. You may want to look into this solution, even if you are going the self-hosted route.</p>
<p>Check out <a href="https://developers.google.com/speed/pagespeed/insights/" rel="nofollow">Google pagespeed insights</a>, it gives you real suggestions for performance optimisations, along with code snippets and other howtos. For example, running it on your website shows that, on a mobile device, you could save up to 2.7 seconds by deferring loading non-critical CSS and JS, and another 1.5 seconds by not serving CSS that is not used by your website.</p>
</div>
</li>
<li id="comment-386172" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/18c0b9388e2e80793e903f1b9f5eb957?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/18c0b9388e2e80793e903f1b9f5eb957?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sayed</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-02T21:18:45+00:00">February 2, 2019 at 9:18 pm</time></a> </div>
<div class="comment-content">
<p>Just try varnish</p>
</div>
</li>
<li id="comment-387291" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9f2a4f4e1ca8df9d678ff234a63ef191?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9f2a4f4e1ca8df9d678ff234a63ef191?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://wasthat.me" class="url" rel="ugc external nofollow">Brian H</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T07:01:04+00:00">February 9, 2019 at 7:01 am</time></a> </div>
<div class="comment-content">
<p>Hey Daniel, I was reading your post on computing remainders and decided to see what else you&rsquo;ve written. Anyways, I used to maintain one of the busiest websites on the internet for a living, and while I&rsquo;m merely a consultant now, I may still remember a thing or two about how the internet works.</p>
<p>The three second cache is what&rsquo;s called a microcache. If a page gets slashdotted (remember that term?), even though it may be receiving thousands of requests per second- say 300,000 per minute, your web server with only render the page 20 times in that minute, with it being served from cache the remainder of the time (whether that be a CDN, Apache&rsquo;s cache, a Varnish or NGINX cache, etc). Anyways, if your performance is how you want it to be, my hat is off to you! If not, feel free to shoot me an email and I&rsquo;d be more than happy to offer some suggestions tailored to your needs from my experience (for free, of course- it would be an honor to work with anyone that&rsquo;s bested the GCC, and you&rsquo;d be doing the implementation anyways).</p>
</div>
</li>
<li id="comment-387325" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7efeeb0d9fe2a53e84d0d77e2ab7e44e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7efeeb0d9fe2a53e84d0d77e2ab7e44e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Christopher Smith</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-09T10:37:28+00:00">February 9, 2019 at 10:37 am</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the old joke about cache invalidation being one of the hardest problems in computer science? Honestly, particularly for content driven tools like WordPress, Etags are probably the right tool, not TTL based cache expiry. I don&rsquo;t know why frameworks don&rsquo;t embrace them more.</p>
</div>
</li>
</ol>
