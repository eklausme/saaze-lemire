---
date: "2023-11-25 12:00:00"
title: "A simple WebSocket benchmark in JavaScript: Node.js versus Bun"
---



Conventional web applications use the http protocol (or the https variant). The http protocol is essentially asymmetrical: a client application such as a browser issues requests and the server responds. It is not possible for the server to initiate communication with the client. Certain types of applications are therefore more difficult to design. For example, if we wanted to design a multiplayer video game using the http protocol, such as a chess game, we could have one server, and two browsers connected to the server. When one of the players moves a piece within its browser, the browser can inform the server via an http request. But how do you inform the second browser? One solution is to have the browsers make requests to the server at regular intervals. A better solution is to use another protocol, the WebSocket protocol.

WebSocket is a network protocol for creating bidirectional communication channels between browsers and web servers. Most browsers support WebSocket, although the standard is relatively recent (2011). It enables the client to be notified of a change in server status, without having to make a request.

You expect WebSocket to be relatively efficient. [I wrote an elementary WebSocket benchmark in JavaScript](https://github.com/lemire/jswebsocket_bench). I use [the standard module ws](https://www.npmjs.com/package/ws). In my benchmark, I have one server. The server takes whatever messages it receives, and it sends them to other clients. Meanwhile I create two clients. Both clients initiate a connection to the server, so we have two connections. The clients then engage in a continual exchange:

1. Client 1 sends a message to the server.
1. The server receives the message and broadcasts it to the second client.
1. Client 2 receives the message from the server.
1. Client 2 replies back to the server.
1. Client 1 receives the message.


My code is as simple as possible. I do not do any trick to go faster. It is &lsquo;textbook&rsquo; code.

Importantly, this benchmark has a strong data dependency: there is only just one connection active while the other one is stalling. So we are measuring the latency (how long the trips take) rather than how many requests we can support simultaneously.

How fast can it go? I run my benchmark locally on a Linux server with a server processor (Xeon Gold). The tests are local so that they do no go through the Internet, they do not use docker or a VM, etc. Obviously, if you run these benchmark on the Internet, you will get slower results due to the network overhead. Furthermore, my benchmark does not do any processing, it just sends simple messages. But I am interested in how low the latency can get.

I use Node.js as a runtime environment (version 20). There is an alternative JavaScript runtime environment called Bun which I also use for comparison (1.0.14). Because I have two JavaScript processes, I four possibilities: the two processes may run Node.js, or they may run bun, or a mixed of those.

Can we do better? Bun has its own WebSocket API. I wrote a script specifically for it. I am keeping the clients unchanged (i.e., I am not using a bun-specific client).

I measure the number of roundtrips per second in steady state.

&nbsp;                   |Node.js 20 (client)      |Bun 1.0 (client)         |
-------------------------|-------------------------|-------------------------|
Node.js 20 (server with ws) |19,000                   |23,000                   |
Bun 1.0 (server with ws) |15,000                   |27,000                   |
Bun 1.0 (bun-specific server) |44,000                   |50,000                   |


It seems fair to compare the pure Node.js configuration (19,000) with the pure Bun configuration (27,000) when using the ws module. At least in my tests, I am getting that Node.js clients are faster when using a Node.js server. I am not sure why that is. Bun is 40% faster than Node.js in this one test. Once you switch to the bun-specific JavaScript code, then bun is twice as fast.

In a [simple http benchmark](/lemire/blog/2023/10/07/web-server-hello-world-benchmark-go-vs-node-js-vs-nim-vs-bun/), I got that Node.js could support about 45,000 http queries per second while bun while nearly twice as capable. However, to get these high numbers, we would have multiple requests in flight at all times. So while I am not making a direct comparison, it seems likely that WebSocket is more efficient than repeatedly polling the servers from both clients.

Importantly, [all of my source code is available](https://github.com/lemire/jswebsocket_bench). The benchmark should be fully reproducible.

