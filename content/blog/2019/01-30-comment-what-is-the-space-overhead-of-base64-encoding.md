---
date: "2019-01-30 12:00:00"
title: "What is the space overhead of Base64 encoding?"
index: false
---

[25 thoughts on &ldquo;What is the space overhead of Base64 encoding?&rdquo;](/lemire/blog/2019/01-30-what-is-the-space-overhead-of-base64-encoding)

<ol class="comment-list">
<li id="comment-385760" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bb524e38c68944df9eaff8ba449f637e?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bb524e38c68944df9eaff8ba449f637e?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Mike Leist</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-30T21:25:29+00:00">January 30, 2019 at 9:25 pm</time></a> </div>
<div class="comment-content">
<p>How about using base91?</p>
</div>
</li>
<li id="comment-385786" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/7b84387af0bfbe8ed054cac23456a63f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/7b84387af0bfbe8ed054cac23456a63f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">magnus</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T00:35:25+00:00">January 31, 2019 at 12:35 am</time></a> </div>
<div class="comment-content">
<p>Thank you for the interesting post. What do you mean by â€žPrivacy-wise, base64 encoding can have benefits since it hides the content you access in larger encrypted bundles.â€œ?</p>
<p>Base64 itself is an encoding scheme and not an encryption algorithm. Therefore it does not provide secrecy, but merely obscurity. Do I miss something here?</p>
</div>
<ol class="children">
<li id="comment-385797" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T00:59:45+00:00">January 31, 2019 at 12:59 am</time></a> </div>
<div class="comment-content">
<p>Each HTTP request, even if encrypted, leaks information about what you are doing. I know which server you queried, how often and how big the payloads were.</p>
</div>
</li>
</ol>
</li>
<li id="comment-385823" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/a95954886808baa0c66a515e62ea5ca1?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/a95954886808baa0c66a515e62ea5ca1?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">mati</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T02:03:40+00:00">January 31, 2019 at 2:03 am</time></a> </div>
<div class="comment-content">
<p>lmao ur a proffesor? it&rsquo;s all obvious</p>
</div>
<ol class="children">
<li id="comment-385929" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T18:00:14+00:00">January 31, 2019 at 6:00 pm</time></a> </div>
<div class="comment-content">
<p>A &ldquo;proffesor&rdquo;?</p>
</div>
</li>
</ol>
</li>
<li id="comment-385843" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/38c3a8fd843af77dbc7831a61e4a5953?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/38c3a8fd843af77dbc7831a61e4a5953?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Jon</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T04:21:02+00:00">January 31, 2019 at 4:21 am</time></a> </div>
<div class="comment-content">
<p>What&rsquo;s the original file size after gzip? In other words gzip(original) compared to gzip(base64(original)) and gzip(base64(gzip(original)))</p>
<p>Jon</p>
</div>
<ol class="children">
<li id="comment-385930" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T18:14:12+00:00">January 31, 2019 at 6:14 pm</time></a> </div>
<div class="comment-content">
<p>The files are available for download. bing.png.gz is 1387 bytes.</p>
</div>
<ol class="children">
<li id="comment-385939" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T19:34:14+00:00">January 31, 2019 at 7:34 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. My guess is that most servers will not try to compress a PNG file with gzip.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-385844" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/bad3a238402594cc5e987ade1c884c4d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/bad3a238402594cc5e987ade1c884c4d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/johnissington" class="url" rel="ugc external nofollow">John Issington</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T04:54:13+00:00">January 31, 2019 at 4:54 am</time></a> </div>
<div class="comment-content">
<p>Thanks for the good primer, easy to follow.</p>
<p>For clarity though, would you consider adding a column which shows the gzipped version of the original? Given most servers and browsers enable this transparently by default these days it might be misleading for some to omit it.</p>
<p>Also, if you&rsquo;re thinking of a follow-up it would be great to compare typical CPU cycles for each approach. With IoT all the rage, storage and bandwidth often gives way to processing budget.</p>
</div>
</li>
<li id="comment-385868" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/278764f4cefc97b94f5748f722ecf53b?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/278764f4cefc97b94f5748f722ecf53b?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Matthew Self</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T08:12:55+00:00">January 31, 2019 at 8:12 am</time></a> </div>
<div class="comment-content">
<p>Why would you use Base64 and <em>then</em> gzip? The point of using Base64 is so that the output only uses a safe subset of ASCII. But gzip will turn that into binary. If you&rsquo;re going to compress a file, there is no value in using Base64 first.</p>
<p>A more common use case is to compress the file first (using gzip, JPEG, or whatever is appropriate for the file) and then use Base64 to make the compressed file safe for transmission via email.</p>
</div>
<ol class="children">
<li id="comment-385874" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2347544b19ccc5a0cda91de67cb9a961?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2347544b19ccc5a0cda91de67cb9a961?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Tom Ribbens</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T09:18:34+00:00">January 31, 2019 at 9:18 am</time></a> </div>
<div class="comment-content">
<p>The author was speaking about web servers. In current HTTP traffic, most content is automatically gzip compressed when sent out from a webserver.</p>
<p>However, that means that the comparison should be done between the binary compressed and the base64 compressed. That&rsquo;s the true comparison for real world situations.</p>
</div>
<ol class="children">
<li id="comment-385892" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/9bc286af6678a63ceb881eaf9e966f5f?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/9bc286af6678a63ceb881eaf9e966f5f?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://darkwiiplayer.com" class="url" rel="ugc external nofollow">DarkWiiPlayer</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T13:13:31+00:00">January 31, 2019 at 1:13 pm</time></a> </div>
<div class="comment-content">
<p>That&rsquo;s what I was thinking too; you can&rsquo;t just say &ldquo;Oh, but compressed Base64 is almost as small as <em>uncompressed</em> binary&rdquo;. That&rsquo;s beside the point. That being said, many binary formats like JPEG are already compressed, so gzipping those may not help much, but after reducing the entropy by base64 encoding the data, it makes sense that it becomes easier to compress again.</p>
<p>Ultimately I don&rsquo;t see much of a point though, as images easily get much larger than text-based formats like HTML. And the more of your data is static content, the more you can profit by caching it.</p>
<p>Also base64 wastes 1/4 of the bits, not 1/3, plus a few bits depending on how the data aligns. So for large amounts of data, it&rsquo;s essentially 25% of wasted bits.</p>
</div>
<ol class="children">
<li id="comment-385916" class="comment byuser comment-author-lemire bypostauthor even depth-4 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:28:46+00:00">January 31, 2019 at 5:28 pm</time></a> </div>
<div class="comment-content">
<p><em>Also base64 wastes 1/4 of the bits, not 1/3</em></p>
<p>My blog post is explicit as to what I mean: the base64 version of a file is 4/3 larger than it might be. You send 4 bytes for 3 bytes of actual information.</p>
</div>
<ol class="children">
<li id="comment-647255" class="comment odd alt depth-5 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2868b632cf5b19518a86acf578f6fdf9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2868b632cf5b19518a86acf578f6fdf9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">José</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-31T10:16:04+00:00">October 31, 2022 at 10:16 am</time></a> </div>
<div class="comment-content">
<p>Hello, thank you for the article, it is very clear. I think you have an error in the sentence &ldquo;So we use 33% more storage than we could.&rdquo;. It should be a 25%, because you are using 8 bits for each 6 bits. In fact, the &ldquo;eficciency&rdquo; of Base64 is 75%.</p>
</div>
<ol class="children">
<li id="comment-647256" class="comment even depth-6">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2868b632cf5b19518a86acf578f6fdf9?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2868b632cf5b19518a86acf578f6fdf9?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">José</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2022-10-31T11:28:55+00:00">October 31, 2022 at 11:28 am</time></a> </div>
<div class="comment-content">
<p>[Correction] Hello, thank you for the article, it is very clear. I think you have an error in the sentence “So we use 33% more storage than we could.”, it should be &ldquo;So we use at least 33% more storage than we could.&rdquo; The increase may be larger if the encoded data is small. For example, the string &ldquo;b&rdquo; with length === 1 is encoded as &ldquo;Yg==&rdquo; with length === 4 — a 300% increase.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-385924" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T17:43:10+00:00">January 31, 2019 at 5:43 pm</time></a> </div>
<div class="comment-content">
<p>How certain are you that images are commonly served with gzip compression?</p>
</div>
</li>
</ol>
</li>
<li id="comment-385890" class="comment even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2d3e32506243224474e7292fab5fddba?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Andrew Dalke</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T13:11:00+00:00">January 31, 2019 at 1:11 pm</time></a> </div>
<div class="comment-content">
<p>The test here approximates the result of Base64 encoding to place an image in an HTML document, then using (negotiated) HTTP compression when exchanging the document.</p>
<p>That is, for various reasons people may want to embed an image in an HTML document rather than provide a hypertext reference to the image. Most image formats contain binary data. HTML does not support embedding arbitrary binary objects, so the data must be encoded. Most people embed images as a data URI for the &lsquo;img&rsquo; element. The data URI supports &ldquo;base64&rdquo; as the only available encoding scheme, so most people embed using Base64 encoding.</p>
<p>The HTTP document is then transferred over HTTP. HTTP supports automatic compression, if the client/server can agree on a compression scheme. The most widely used scheme is &lsquo;gzip&rsquo;, which is the same method used in the gzip command-line program.</p>
<p>Thus, it is reasonable to approximate the payload overhead of base64-escaped data URIs followed by gzip HTTP compression, by taking the image file, Base64-encoding it, and using gzip to compress the result.</p>
<p>This was described in the text as &ldquo;look at the HTML source&rdquo; and &ldquo;It is common for web servers to provide the content in compressed form&rdquo;. This is a well-known topic that typically doesn&rsquo;t deserve the level of detail I just gave.</p>
</div>
<ol class="children">
<li id="comment-385895" class="comment byuser comment-author-lemire bypostauthor odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T13:38:52+00:00">January 31, 2019 at 1:38 pm</time></a> </div>
<div class="comment-content">
<p>Thanks Andrew for the detailed explanation.</p>
</div>
<ol class="children">
<li id="comment-385931" class="comment even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/331059294e89906fef3d785f06820025?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">KWillets</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-01-31T18:28:48+00:00">January 31, 2019 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>Since the bitstream is already compressed, you&rsquo;re probably seeing entropy compression for 64 uniformly distributed values. You might try inlining the images into a typical document (with more skew) to see if the compression holds up, i.e. their mutual information.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-385959" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/c6937532928911c0dae3c9c89b658c09?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Travis Downs</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-01T02:20:00+00:00">February 1, 2019 at 2:20 am</time></a> </div>
<div class="comment-content">
<p>You compare the size of the original content to the size of the base64 + gzipped result, but isn&rsquo;t a more interesting comparison the one between the only-gzipped original content vs base64 + gzipped content? After all, we expect that independently from whether base64 is needed in the protocol, compression will be applied.</p>
<p>For your corpus of .png and .jpeg files, I don&rsquo;t expect you to see much of a difference, since both png and jpeg are already backed by at-least-as-good-as-deflate coding, so re-compression is generally minimal. So all gzip is doing is undoing (via entropy coding, as the matching portion is probably useless) specifically the base64 inflation (and the fact that it still has a 5% overhead shows that it isn&rsquo;t a particularly efficient entropy coder).</p>
<p>For files that actually <em>can</em> be compressed, however, the results may be very different &#8211; and in realistic cases I think the result could be a penalty larger than 33% for base64, as the encoding can interfere with the compression.</p>
</div>
</li>
<li id="comment-386710" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Twirrim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-06T00:58:51+00:00">February 6, 2019 at 12:58 am</time></a> </div>
<div class="comment-content">
<p>It&rsquo;s worth noting that good practice has more recently tended to favour not gzip&rsquo;ing content when hosting via TLS, due to compression + TLS enabling BREACH attacks: <a href="https://en.wikipedia.org/wiki/BREACH" rel="nofollow ugc">https://en.wikipedia.org/wiki/BREACH</a></p>
<p>That actually makes the base64 inefficiencies even more glaring.</p>
</div>
<ol class="children">
<li id="comment-386789" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-06T15:25:48+00:00">February 6, 2019 at 3:25 pm</time></a> </div>
<div class="comment-content">
<p>Do we have any statistics on gzip usage? I have tried a few well-known sites, and they all appear to serve the content in compressed form. For example, GMail uses gzip. You would think that Google would be on top of things, security-wise. Or is that a security issue that is specific to some form of secure layers and not others?</p>
</div>
<ol class="children">
<li id="comment-386818" class="comment even depth-3">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/423a1a4f867f2773f553579fa721552c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Twirrim</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-06T21:24:55+00:00">February 6, 2019 at 9:24 pm</time></a> </div>
<div class="comment-content">
<p>Interesting question. So far as I understand it, it applies to all layers, but I&rsquo;m not an expert in that type of thing.</p>
<p>I don&rsquo;t have access to the Alexa top 500 list, but Moz has a list of 500, <a href="https://moz.com/top500" rel="nofollow ugc">https://moz.com/top500</a>. I wrote some very rough code (<a href="https://gist.github.com/twirrim/877bcaf373aa1fec99c102b7c84ea1ce" rel="nofollow ugc">https://gist.github.com/twirrim/877bcaf373aa1fec99c102b7c84ea1ce</a>), using python3 and the requests library, to go through and check for Content-Encoding appearing in the headers of responses for them:</p>
<p>{False: 53, True: 390, &lsquo;Unknown&rsquo;: 57}</p>
<p>Unknown is a catchall for &ldquo;Something didn&rsquo;t go right&rdquo; rather than indicative of any confusion about if compression is enabled.</p>
<p>So more use it than don&rsquo;t, by a good margin.</p>
</div>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-386800" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/69b368f1ce68bead1174517a3ed99c17?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/69b368f1ce68bead1174517a3ed99c17?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://twitter.com/murmosh" class="url" rel="ugc external nofollow">Mark</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-06T17:52:07+00:00">February 6, 2019 at 5:52 pm</time></a> </div>
<div class="comment-content">
<p>Just don&rsquo;t rely on size estimations to limit ingress traffic: Some base64 encodings allow comments, which can be used to amplify ratio bytes_in/bytes_decoded.</p>
</div>
<ol class="children">
<li id="comment-386811" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2019-02-06T19:57:59+00:00">February 6, 2019 at 7:57 pm</time></a> </div>
<div class="comment-content">
<p>ASCII spaces are certainly possible within base64 encoded text, but I have never seen comments. Do you have an example in the wild or a reference to the part of the specification that allows comments?</p>
</div>
</li>
</ol>
</li>
</ol>
