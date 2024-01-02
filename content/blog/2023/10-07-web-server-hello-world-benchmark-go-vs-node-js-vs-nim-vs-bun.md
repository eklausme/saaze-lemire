---
date: "2023-10-07 12:00:00"
title: "Web server `hello world´ benchmark : Go vs Node.js vs Nim vs Bun"
---



The Web is a convenient interface to your software. Many times, if you have an existing application, you may want to allow Web access to it using HTTP. Or you may want to build a small specialized Web application. In such instances, you do not want to use an actual Web server (e.g., Apache or IIS).

There are many popular frameworks for writing little web applications. Go and JavaScript (Node.js) are among the most popular choices. Reportedly, Netflix runs on Node.js; [Uber moved from Node.js to Go for better performance](https://yalantis.com/blog/golang-vs-nodejs-comparison/). There are also less popular options such as [Nim](https://nim-lang.org).

An [in-depth review of their performance characteristics](https://www.techempower.com/benchmarks/) would be challenging.  But I just write a little toy web application, will I see the difference? A minimalist application gives you a reference since more complex applications are likely to run slower.

Let us try it out. I want the equivalent of &lsquo;hello world&rsquo; for web servers. I also do not want to do any fiddling: let us keep things simple.

A minimalist Go server might look as follows:
```Go
package main
import (
  "io"
  "fmt"
  "log"
  "net/http"
)
func main() {
  http.HandleFunc("/simple", func(w http.ResponseWriter, r *http.Request){
    io.WriteString(w, "Hello!")
  })
  fmt.Printf("Starting server at port 3000\n")
  if err := http.ListenAndServe(":3000", nil); err != nil {
    log.Fatal(err)
  }
}

```


A basic JavaScript (Node.js) server might look like this:
```Go
const f = require('fastify')()
f.get('/simple', async (request) => {
  return "hello"
})
f.listen({ port: 3000})
  .then(() => console.log('listening on port 3000'))
  .catch(err => console.error(err))

```


It will work as-is in an alternative runtime such as Bun, but to get the most of the Bun runtime, you may need to write Bun-specific code:
```Go
const server = Bun.serve({
  port: 3000,
  fetch(req) {
   let url = new URL(req.url);
   let pname = url.pathname;
   if(pname == '/simple'){
     return Response('Hello');
   }
   return new Response("Not Found.");
  }
});

```


Nim offers a nice way to achieve the same result:
```Go
import options, asyncdispatch
import httpbeast
proc onRequest(req: Request): Future[void] =
  if req.httpMethod == some(HttpGet):
    case req.path.get()
    of "/simple":
      req.send("Hello World")
    else:
      req.send(Http404)
run(onRequest, initSettings(port=Port(3000)))

```


An interesting alternative is to [use uWebSockets.js with Node](https://github.com/uNetworking/uWebSockets.js):
```Go
const uWS = require('uWebSockets.js')
const port = 3000;
const app = uWS.App({
}).get('/simple', (res, req) => {
  res.end('Hello!');
}).listen(port, (token) => {
  if (token) {
    console.log('Listening to port ' + port);
  } else {
    console.log('Failed to listen to port ' + port);
  }
});

```


We can also use C++ with the lithium library:
```Go
#include <lithium_http_server.hh>
int main() {
  li::http_api my_api;
  my_api.get("/simple") =
    [&](li::http_request& request, li::http_response& response) {
      response.write("hello world.");
    };
  li::http_serve(my_api, 3000);
}

```


[I wrote a benchmark, my source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/10/07). I ran it on a powerful IceLake-based server with 64 cores. As is typical, such big servers have relatively low clock speeds (base frequency of 2 GHz, up to 3.2 GHz). I use a simple bombardier command as part of the benchmark:
```Go
bombardier -c 10 http://localhost:3000/simple
```


You can increase the number of concurrent connections to 1000 (<tt>-c 1000</tt>). My initial tests used autocannon which is a poor choice for this task.

My result indicates that Nim is doing quite well on this toy example.

system                   |requests/second (10 connections) |requests/second (1000 connections) |
-------------------------|-------------------------|-------------------------|
Nim 2.0 and httpbeast    |315,000 +/- 18,000       |350,000 +/- 60,000       |
GCC12 (C++) + lithium    |190,000 +/- 60,000       |385,000 +/- 80,000       |
Go 1.19                  |95,000 +/- 30,000        |250,000 +/- 45,000       |
Node.js 20 and uWebSockets.js |100,000 +/- 25,000       |100,000 +/- 35,000       |
Bun 1.04                 |80,000 +/- 15,000        |65,000 +/- 20,000        |
Node.js 20 (JavaScript)  |45,000 +/- 7,000         |41,000 +/- 10,000        |
Bun + fastify            |40,000 +/- 6,000         |35,000 +/- 9,000         |


*Jarred Sumner, the author of Bun, said on X that <em>fastify is not fast in bun right now but that Bun.serve() is more than twice faster than node:http in bun</em>.

My web server does very little work, so it is an edge case. I have also not done any configuration: it is &lsquo;out of the box&rsquo; performance. Furthermore, the server is probably more powerful than anything web developers will use in practice.

There is considerable noise in this results, and you should not trust my numbers entirely. [I recommend you try running the benchmark for yourself.](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/10/07)

I reviewed some blog posts, all concluding that Go is faster :

- In [Http Server Performance: NodeJS vs. Go](https://betterprogramming.pub/http-server-performance-nodejs-vs-go-397751e8d275), Sunavec finds that Go can be up to 34% faster than Node.js. Their benchmark is more involved and possibly more realistic.
- In [Server-side I/O Performance: Node vs. PHP vs. Java vs. Go](https://www.toptal.com/back-end/server-side-io-performance-node-php-java-go), Peabody finds that Go scale much better than Node.js and Java, with PHP coming last. In stress tests, they find that Java and Node.js are on par, while Go is twice as fast.
- In [Performance Benchmarking: Bun vs. C# vs. Go vs. Node.js vs. Python](https://www.wwt.com/blog/performance-benchmarking-bun-vs-c-vs-go-vs-nodejs-vs-python), they found that Bun and Go were winners, while Node.js ran at about half the speed. C# provided intermediate performance while Python came last.


It would be interesting to add [C](https://github.com/h2o/h2o), Rust and Zig to this benchmark.

Regarding the C++ solution, I initially encountered many difficulties. Using Lithium turned out to be simple: the most difficult part is to ensure that you have installed OpenSSL and Boost on your system. My solution is just as simple as the alternatives. The author of Lithium has a nice twist where he explains how to run a Lithium server using a docker container with a script. Doing it in this manner means that you do not have to worry about installing libraries on your system. Running a server in a docker container is perfectly reasonable but there is a performance overhead, so I did not use this solution in my benchmark.

While preparing this blog post, I had the pleasure of compiling software written in the Nim language for the first time. I must say that it left a good impression. The authors state that Nim was inspired by Python. It does feel quite like Python. I will revisit nim later.

