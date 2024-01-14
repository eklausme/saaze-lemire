---
date: "2023-10-07 12:00:00"
title: "Web server &#8216;hello world&#8217; benchmark : Go vs Node.js vs Nim vs Bun"
index: false
---

[34 thoughts on &ldquo;Web server &#8216;hello world&#8217; benchmark : Go vs Node.js vs Nim vs Bun&rdquo;](/lemire/blog/2023/10-07-web-server-hello-world-benchmark-go-vs-node-js-vs-nim-vs-bun)

<ol class="comment-list">
<li id="comment-655186" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d3b309bf5de626f5c43f78c78db7ad63?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d3b309bf5de626f5c43f78c78db7ad63?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">forked_franz</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T06:56:09+00:00">October 7, 2023 at 6:56 am</time></a> </div>
<div class="comment-content">
<p>I have already explained my point on what&rsquo;s the expected performance for simple Vs complex cases for this, but I suggest as well to run something to be sure all the framework are using the available CPU resources. They often doesn&rsquo;t come with decent ergonomics and default for it. Furthermore, If the load gen run on the same machine, isolated the cores of the twos trying hard to make the server the bottleneck, constraining its resources.</p>
</div>
</li>
<li id="comment-655188" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2f181f478023da84323be48a8d9a4429?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2f181f478023da84323be48a8d9a4429?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" decoding="async" /> <b class="fn">Alex</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T08:25:50+00:00">October 7, 2023 at 8:25 am</time></a> </div>
<div class="comment-content">
<p>Not a fair comparison at all. Why did you a slow third party library for bun/nodejs? Seemed like you did not know what you were doing. Try HyperExpress or uWebsockets.js</p>
</div>
<ol class="children">
<li id="comment-655208" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T16:35:12+00:00">October 7, 2023 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>I have updated the numbers with uWebsockets.js. See updated blog post.</p>
</div>
</li>
<li id="comment-655229" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/31103a47f017f04b1a54f169d69c5b68?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/31103a47f017f04b1a54f169d69c5b68?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J.C.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-08T11:24:52+00:00">October 8, 2023 at 11:24 am</time></a> </div>
<div class="comment-content">
<p>Node fanboy detected. 🤡</p>
</div>
</li>
</ol>
</li>
<li id="comment-655193" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/20748958ca7e4e44958f1e4a83ed654a?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/20748958ca7e4e44958f1e4a83ed654a?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">J</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T10:02:13+00:00">October 7, 2023 at 10:02 am</time></a> </div>
<div class="comment-content">
<blockquote><p>
An interesting question is whether one can get better performance by using servers written entirely in a language like C, C++, Rust or Zig. I tried building the equivalent in C++, but it was so painful that I eventually gave up.
</p></blockquote>
<p>Indeed, it is an interesting question. So why not check it? 🙂</p>
<p>This doesn&rsquo;t look painful to me:</p>
<p><a href="https://github.com/tokio-rs/axum/blob/main/examples/hello-world/src/main.rs" rel="nofollow ugc">https://github.com/tokio-rs/axum/blob/main/examples/hello-world/src/main.rs</a></p>
</div>
</li>
<li id="comment-655194" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/86e0618b4f1f1c78b83d9e8a5df95b55?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/86e0618b4f1f1c78b83d9e8a5df95b55?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sandros94</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T10:41:52+00:00">October 7, 2023 at 10:41 am</time></a> </div>
<div class="comment-content">
<p>Those numbers are hiding something interesting. I never used <code>bombardier</code>.<br/>
Could you clarify how much time the benchmark has run for? This would let us know at how much real connection/s each one as capped and if any reached the 10/10000 marks.</p>
</div>
<ol class="children">
<li id="comment-655209" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T16:35:50+00:00">October 7, 2023 at 4:35 pm</time></a> </div>
<div class="comment-content">
<p>bombardier runs for 10 seconds by default.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655197" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/fd31ec80478a31167be81b9e81add45c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/fd31ec80478a31167be81b9e81add45c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Calling Out The BS</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T12:19:10+00:00">October 7, 2023 at 12:19 pm</time></a> </div>
<div class="comment-content">
<p>Only Nim is using a third-party library built for speed—it&rsquo;s only 777 lines of code, and it doesn&rsquo;t even support HTTP2.</p>
<p>For shame!</p>
</div>
<ol class="children">
<li id="comment-655218" class="comment even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d4272ead584859ae382386e06f16601d?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d4272ead584859ae382386e06f16601d?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Calling out the BS caller</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T19:29:53+00:00">October 7, 2023 at 7:29 pm</time></a> </div>
<div class="comment-content">
<p>httpbeast is not a 3rd party lib but by a Nim core team member. And btw. it&rsquo;s not pimping up the speed but rather using Nim&rsquo;s async &lsquo;s quite speedy performance. Its task isn&rsquo;t speed per se but rather to provide http related functionality.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655200" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5d109eafc0efd7fe6e5ef707c0a75fa4?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://fexl.com" class="url" rel="ugc external nofollow">Patrick</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T13:57:25+00:00">October 7, 2023 at 1:57 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I tried building the equivalent in C++, but it was so painful that I eventually gave up.
</p></blockquote>
<p>I hear you. Just to capture some of the knowledge I&rsquo;ve built up I wrote a server entirely in C, which I call &ldquo;sloop&rdquo; (server loop):</p>
<p><a href="https://github.com/chkoreff/sloop/tree/main#readme" rel="nofollow ugc">https://github.com/chkoreff/sloop/tree/main#readme</a></p>
<p>It does the necessary buffering so it can print the &ldquo;Content-length&rdquo; header. At some point I could change it to chunked transfer encoding.</p>
<p>The servers I actually use now are written in Fexl, so I can just call run_server with an arbitrary Fexl program to interact with clients, e.g.:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/test/server.fxl" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/test/server.fxl</a></p>
<p>That Fexl code ultimately calls this &ldquo;type_start_server&rdquo; routine written in C:</p>
<p><a href="https://github.com/chkoreff/Fexl/blob/master/src/type_run.c#L355" rel="nofollow ugc">https://github.com/chkoreff/Fexl/blob/master/src/type_run.c#L355</a></p>
</div>
</li>
<li id="comment-655204" class="comment even thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eed002652e14040cb39de737190786b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eed002652e14040cb39de737190786b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rene Kaufmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T15:44:34+00:00">October 7, 2023 at 3:44 pm</time></a> </div>
<div class="comment-content">
<p>Interesting that the numbers are so low given that you use such a big server.</p>
<p>On an AMD Ryzen 9 5900HX i get the following numbers for go1.21.1 and nim 2.0.0</p>
<p>go 1.21.1</p>
<p><code>bombardier -c 10 http://localhost:3000/simple<br/>
Reqs/sec 246226.18<br/>
bombardier -c 1000 http://localhost:3000/simple<br/>
Reqs/sec 451854.02<br/>
</code></p>
<p>nim 2.0.0</p>
<p><code>bombardier -c 10 http://localhost:3000/simple<br/>
Reqs/sec 440969.81<br/>
bombardier -c 1000 http://localhost:3000/simple<br/>
Reqs/sec 799546.14<br/>
</code></p>
<p>I also testet this with fasthttp for go:</p>
<p><code>package main</p>
<p>import (<br/>
"io"<br/>
"log"</p>
<p> "github.com/valyala/fasthttp"<br/>
)</p>
<p>func main() {</p>
<p> h := requestHandler<br/>
if err := fasthttp.ListenAndServe(":3000", h); err != nil {<br/>
log.Fatalf("Error in ListenAndServe: %v", err)<br/>
}<br/>
}</p>
<p>func requestHandler(ctx *fasthttp.RequestCtx) {<br/>
io.WriteString(ctx, "Hello World")<br/>
}</p>
<p>bombardier -c 10 http://localhost:3000<br/>
Reqs/sec 351120.08<br/>
bombardier -c 1000 http://localhost:3000<br/>
Reqs/sec 601480.20<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-655210" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T16:39:54+00:00">October 7, 2023 at 4:39 pm</time></a> </div>
<div class="comment-content">
<p>Your processor has a significantly higher clock speed, which could be a factor.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655207" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/eed002652e14040cb39de737190786b8?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/eed002652e14040cb39de737190786b8?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Rene Kaufmann</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T16:24:47+00:00">October 7, 2023 at 4:24 pm</time></a> </div>
<div class="comment-content">
<p>I also tried zig (i am not an zig expert).</p>
<p>Its based on the simple http example from <a href="https://github.com/zigzap/zap" rel="nofollow ugc">https://github.com/zigzap/zap</a></p>
<p><a href="https://github.com/zigzap/zap/blob/master/examples/hello/hello.zig" rel="nofollow ugc">example</a></p>
<p><code>const std = @import("std");<br/>
const zap = @import("zap");</p>
<p>fn on_request_minimal(r: zap.SimpleRequest) void {<br/>
r.sendBody("Hello World!") catch return;<br/>
}</p>
<p>pub fn main() !void {<br/>
var listener = zap.SimpleHttpListener.init(.{<br/>
.port = 3000,<br/>
.on_request = on_request_minimal,<br/>
.log = false,<br/>
.max_clients = 100000,<br/>
});<br/>
try listener.listen();</p>
<p> std.debug.print("Listening on 0.0.0.0:3000\n", .{});</p>
<p> // start worker threads<br/>
zap.start(.{<br/>
.threads = 16,<br/>
.workers = 16,<br/>
});<br/>
}<br/>
</code></p>
<p>Results:</p>
<p><code>bombardier -c 10 http://localhost:300<br/>
Reqs/sec 312406.93</p>
<p>bombardier -c 1000 http://localhost:3000<br/>
Reqs/sec 470699.26<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-655243" class="comment odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7e1f1a225e4402303b85f00fc21f189?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7e1f1a225e4402303b85f00fc21f189?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kassane.github.io" class="url" rel="ugc external nofollow">Matheus Catarino</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-08T17:35:15+00:00">October 8, 2023 at 5:35 pm</time></a> </div>
<div class="comment-content">
<p><strong>Note</strong>: ZAP is zig wrapper of <a href="https://facil.io" rel="nofollow ugc">facil.io</a> (C Web Framework).</p>
<p>Zig only: <a href="https://github.com/karlseguin/http.zig" rel="nofollow ugc">https://github.com/karlseguin/http.zig</a></p>
<p>Both do not have TLS support on the server.</p>
<p><strong><em>std.http.Server</em></strong> is unstable being redesigned with each change since 0.11.0, but <strong><em>std.http.Client</em></strong> has TLS support only.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655213" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/28254755c400275becdc79e190b6c3ea?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/28254755c400275becdc79e190b6c3ea?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Sean</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T17:40:53+00:00">October 7, 2023 at 5:40 pm</time></a> </div>
<div class="comment-content">
<p>As always brilliant content from Daniel</p>
</div>
</li>
<li id="comment-655215" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/604de60a22e1e63dd03037478275a70c?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/604de60a22e1e63dd03037478275a70c?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Niek</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T17:47:52+00:00">October 7, 2023 at 5:47 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
I tried building the equivalent in C++, but it was so painful that I eventually gave up
</p></blockquote>
<p>Did you ever try Seastar? (a c++ server framework)</p>
</div>
<ol class="children">
<li id="comment-655216" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-07T17:56:39+00:00">October 7, 2023 at 5:56 pm</time></a> </div>
<div class="comment-content">
<p>I will be checking it out. Thanks.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655232" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/b48a8b5f2bbf384c5ee27cab4bf2f3be?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/b48a8b5f2bbf384c5ee27cab4bf2f3be?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Alexander Yastrebov</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-08T12:47:52+00:00">October 8, 2023 at 12:47 pm</time></a> </div>
<div class="comment-content">
<p>Would be nice for all servers to return exactly the same response.</p>
</div>
<ol class="children">
<li id="comment-655238" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-08T14:21:03+00:00">October 8, 2023 at 2:21 pm</time></a> </div>
<div class="comment-content">
<p>Indeed, but a few different bytes in the string should not impact performance.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655235" class="comment odd alt thread-odd thread-alt depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/e78944d6ee4eb7d47776b24984da7e20?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/e78944d6ee4eb7d47776b24984da7e20?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">ANIL CHALIL</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-08T13:52:12+00:00">October 8, 2023 at 1:52 pm</time></a> </div>
<div class="comment-content">
<p>In the mean time it is remarkable that high level language like Nim achieve such a performance and scale. Also impl in Nim seems very ideomatic.</p>
</div>
</li>
<li id="comment-655245" class="comment even thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d7e1f1a225e4402303b85f00fc21f189?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d7e1f1a225e4402303b85f00fc21f189?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://kassane.github.io" class="url" rel="ugc external nofollow">Matheus Catarino</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-08T17:44:29+00:00">October 8, 2023 at 5:44 pm</time></a> </div>
<div class="comment-content">
<blockquote><p>
The C++ solution, I initially encountered many difficulties. Using<br/>
Lithium turned out to be simple: the most difficult part is to ensure<br/>
that you have installed OpenSSL and Boost on your system
</p></blockquote>
<p>Since you are using boost::context, it means that you are using the stackful coroutine instead of the stackless C++20.</p>
<p>If you want to reduce system dependency, you could opt for asio-standalone (without boost) which will allow you to couple it with co_* and awaitable (C++20 &#8211; stackless only).</p>
</div>
</li>
<li id="comment-655353" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/d04c5945dd4173a69cc4720eafed5d76?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/d04c5945dd4173a69cc4720eafed5d76?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Darryl Pye</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-12T23:22:19+00:00">October 12, 2023 at 11:22 pm</time></a> </div>
<div class="comment-content">
<p>You may find the following benchmarks interesting.</p>
<p><a href="https://www.techempower.com/benchmarks/#section=data-r21&#038;test=plaintext" rel="nofollow ugc">https://www.techempower.com/benchmarks/#section=data-r21&#038;test=plaintext</a></p>
</div>
<ol class="children">
<li id="comment-655365" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-13T15:30:12+00:00">October 13, 2023 at 3:30 pm</time></a> </div>
<div class="comment-content">
<p>Thanks. Note that I link to techempower early on in the blog post.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655413" class="comment odd alt thread-even depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed89ad8f70cf405fee4730948e813e89?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed89ad8f70cf405fee4730948e813e89?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">Cihad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T10:29:57+00:00">October 15, 2023 at 10:29 am</time></a> </div>
<div class="comment-content">
<p>Please compare with Nginx. Just curious.</p>
</div>
<ol class="children">
<li id="comment-655428" class="comment byuser comment-author-lemire bypostauthor even depth-2 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T18:36:57+00:00">October 15, 2023 at 6:36 pm</time></a> </div>
<div class="comment-content">
<p>Can you illustrate how you&rsquo;d build a small specialized web server similar to the examples above using Nginx? Suppose you have already your software, and you want to add a small HTTP server to it, how do you link to Nginx as a software library?</p>
</div>
<ol class="children">
<li id="comment-655429" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5a3b3f7dedc73c39e13c8fe3975a2996?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5a3b3f7dedc73c39e13c8fe3975a2996?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://copious.world" class="url" rel="ugc external nofollow">richard leddy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T19:06:16+00:00">October 15, 2023 at 7:06 pm</time></a> </div>
<div class="comment-content">
<p>This might be of interest: <a href="https://openresty.org/en/" rel="nofollow ugc">https://openresty.org/en/</a><br/>
But, there is another which turns out to be in widespread use. I have lost the reference&#8230; used more in China.</p>
</div>
<ol class="children">
<li id="comment-655433" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T20:31:11+00:00">October 15, 2023 at 8:31 pm</time></a> </div>
<div class="comment-content">
<p>Do you have code samples on how I can use openresty to embed a web server in my application?</p>
<p>If you have an Apache, IIS or Nginx server, you can build web applications <em>on top of it</em> but that is not what my blog post was about. My blog post was about building small web applications (in different programming languages) using existing software libraries.</p>
<p>I am considering the scenario where you have a program, when you launch the program, you launch a web server.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655439" class="comment odd alt depth-3 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ed89ad8f70cf405fee4730948e813e89?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ed89ad8f70cf405fee4730948e813e89?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">cihad</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T23:11:38+00:00">October 15, 2023 at 11:11 pm</time></a> </div>
<div class="comment-content">
<p>Just install nginx. <code>/etc/nginx/sites-enabled/default</code> with:</p>
<p><code>http {<br/>
server {<br/>
listen 3000;<br/>
location /simple {<br/>
return 200 'Hello';<br/>
}<br/>
}<br/>
}<br/>
</code></p>
<p>Save file.</p>
<p><code>sudo service nginx restart<br/>
bombardier -c 10 http://localhost:3000/simple<br/>
</code></p>
</div>
<ol class="children">
<li id="comment-655440" class="comment byuser comment-author-lemire bypostauthor even depth-4">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-16T00:08:06+00:00">October 16, 2023 at 12:08 am</time></a> </div>
<div class="comment-content">
<p>Let me restate what I wrote in the comment you are replying to:</p>
<blockquote>
<p>If you have an Apache, IIS or Nginx server, you can build web<br/>
applications on top of it but that is not what my blog post was about.</p>
</blockquote>
</div>
</li>
</ol>
</li>
</ol>
</li>
</ol>
</li>
<li id="comment-655424" class="comment odd alt thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5c707672f157d85209a49302acab78d0?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5c707672f157d85209a49302acab78d0?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://validscience.substack.com" class="url" rel="ugc external nofollow">Joe Duarte</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T17:18:10+00:00">October 15, 2023 at 5:18 pm</time></a> </div>
<div class="comment-content">
<p>Nim compiles to either C or LLVM IR right? I don&rsquo;t see any details in the nimble code – what became of your code? Are each of these solutions building executables?</p>
<p>It&rsquo;s impressive that Nim wins given that there isn&rsquo;t serious optimization energy going into it yet, but I&rsquo;m not clear on the validity of this benchmark yet.</p>
<p>You might also include actual web servers to compare, like nginx (written in C) and Microsoft&rsquo;s <a href="https://www.infoworld.com/article/3670792/kestrel-the-microsoft-web-server-you-should-be-using.html" rel="nofollow ugc">Kestrel</a> (maybe written in C++, possibly C#).</p>
<p>I&rsquo;d switch to HTTP/2 or HTTP/3, since those are dominant now on the web. For example, lemire.me defaults to HTTP/3.</p>
</div>
<ol class="children">
<li id="comment-655427" class="comment byuser comment-author-lemire bypostauthor even depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T18:28:40+00:00">October 15, 2023 at 6:28 pm</time></a> </div>
<div class="comment-content">
<p>The use cases here are to add a web server to your application (whether it is written in JavaScript, C, C++, Nim), or to build a small specialized web server.</p>
<p>Would you share your code&#8230; e.g., how do I do the equivalent of my C++ application (see code in the blog post), say in C, using nginx as a library?</p>
<p>Or do you mean the reverse&#8230; You have a web server, and you integrate your code inside it (e.g., use CGI calls). That&rsquo;s a whole other paradigm, and not really comparable.</p>
</div>
</li>
</ol>
</li>
<li id="comment-655431" class="comment odd alt thread-even depth-1">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/5a3b3f7dedc73c39e13c8fe3975a2996?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/5a3b3f7dedc73c39e13c8fe3975a2996?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="http://copious.world" class="url" rel="ugc external nofollow">richard leddy</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-15T19:19:41+00:00">October 15, 2023 at 7:19 pm</time></a> </div>
<div class="comment-content">
<p>So, I just read on the uWebSockets.js github page, that they are the default server for bun. So, I am curious as to why the node.js would be faster (maybe margin of error)?</p>
<p>My stack is supposed to wrap the HTTP service. See <a href="https://github.com/orgs/copious-world/repositories?language=&amp;page=1&amp;q=&amp;sort=&amp;type=all" rel="nofollow ugc">copious-world repositories</a>. E.g. in copious-transitions, one is supposed to be able to create a subclass of the lib/general-express.js and then run without changing much else. Otherwise, I am using JSON messaging on micro-services, and those are set up for TLS, UDP, etc. So, &ldquo;just working&rdquo; is a goal that has gone through a few renditions, but optimization paths into other languages is an eventual goal.</p>
<p>So, one possibility is to work with components that are all about intrinsics. Perhaps the ones found at <a href="https://github.com/kostya/benchmarks" rel="nofollow ugc">benchmarks (warning about brainf** and language)</a>. So, plugging in JSON and base64 libs might be good (maybe bun ffi is better than luajit). Also, Sha256 intrinsics are out there and blake3 is nice to have when not but more mute with them. You may see that V remains viable given they did work on MatMul.</p>
</div>
</li>
<li id="comment-655581" class="comment even thread-odd thread-alt depth-1 parent">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/ddb51d3866bfa7615a8bbe0e0f32ef13?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/ddb51d3866bfa7615a8bbe0e0f32ef13?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn">O.M.</b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T12:39:25+00:00">October 20, 2023 at 12:39 pm</time></a> </div>
<div class="comment-content">
<p>Unfair benchmark: an obvious difference in the implementations is that only 2 of them return &ldquo;Hello!&rdquo; in the body while others each return their own variation.</p>
<p>If the implementers didn&rsquo;t even ensure this simple comparison of the implementations, how serious is this work?</p>
</div>
<ol class="children">
<li id="comment-655583" class="comment byuser comment-author-lemire bypostauthor odd alt depth-2">
<div class="comment-author vcard">
<img alt src="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=56&#038;d=mm&#038;r=g" srcset="https://secure.gravatar.com/avatar/2ca999bef9535950f5b84281a4dab006?s=112&#038;d=mm&#038;r=g 2x" class="avatar avatar-56 photo" height="56" width="56" loading="lazy" decoding="async" /> <b class="fn"><a href="https://lemire.me/en/" class="url" rel="ugc">Daniel Lemire</a></b> <span class="says">says:</span> </div>
<div class="comment-metadata"><time datetime="2023-10-20T14:22:31+00:00">October 20, 2023 at 2:22 pm</time></a> </div>
<div class="comment-content">
<p>Can you explain your rationale? Why would you think that the performance would depend on the exact content of the string?</p>
</div>
</li>
</ol>
</li>
</ol>
