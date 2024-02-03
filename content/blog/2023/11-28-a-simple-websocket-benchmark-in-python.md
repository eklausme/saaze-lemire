---
date: "2023-11-28 12:00:00"
title: "A simple WebSocket benchmark in Python"
---



Modern web applications often use the http/https protocols. However, when the server and client needs to talk to each other in a symmetrical fashion, the WebSocket protocol might be preferable. For example, if you want to program a multiplayer video game, the WebSocket protocol is almost surely better than http. In [A simple WebSocket benchmark in JavaScript](/lemire/blog/2023/11/25/a-simple-websocket-benchmark-in-javascript-node-js-versus-bun/), I showed that JavaScript (through Node.js) can produce efficient WebSocket servers, at least in the simplest cases.

My benchmark is what I call a ping-pong. Client 1 sends a message to the server.The server receives the message and broadcasts it to the second client. Client 2 receives the message from the server. Client 2 replies back to the server. Client 1 receives the message. And so forth.

I want to know how many roundtrips I can generate per second. For Node.js (JavaScript), the answer is about 20,000. If you use a faster JavaScript engine (bun), you might get twice as many.

What about Python? I wrote my client using standard code, without any tweaking:
```Python
import asyncio
import websockets
async def client1():
  async with websockets.connect('ws://localhost:8080') as websocket:
    message = 'client 1!'
    await websocket.send(message)
    while True:
      response = await websocket.recv()
      await websocket.send(message)

async def client2():
  async with websockets.connect('ws://localhost:8080') as websocket:
    message = 'client 2!'
    while True:
      response = await websocket.recv()
      await websocket.send(message)

async def main():
  task1 = asyncio.create_task(client1())
  task2 = asyncio.create_task(client2())
  await asyncio.gather(task1, task2)

asyncio.run(main())


```


Python has several different frameworks to build WebSocket servers. I picked three that looked popular and mature: sanic, blacksheep, and aiohttp. By default, a module like sanic should use good optimizations like the uvloop module.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/11/27). I run the benchmark on a Linux machine with Python 3.9. The packets are local, they don&rsquo;t go out to the Internet. There is no docker container involved.

&nbsp;                   |Python client            |Node.js 20 client        |
-------------------------|-------------------------|-------------------------|
sanic server             |3700                     |5200                     |
blacksheep server        |3000                     |200                      |
aiohttp server           |3600                     |270                      |
Node.js 20 server        |6000                     |19,000                   |


Mixing the blacksheep and aiohttp servers I wrote with the Node.js server gives terrible results: I have not investigated the cause, but it would be interesting to see if others can reproduce it, or diagnose it.

Otherwise, I get that the sanic server is nearly 4 times slower than the Node.js server. Writing the client in Python appears to cut the performance significantly (except for the blacksheep and aiohttp servers anomaly).

JavaScript shines in comparison with Python in these tests. My implementations are surely suboptimal, and there might be mistakes. Nevertheless, I believe that it is as expected: the standard Python interpreter is not very fast. Node.js has a great Just-in-Time compiler. It would be interesting to switch to faster implementation of Python such as pypy.

This being said, 3000 roundtrips per second might be quite sufficient for several applications. Yet, a real-world WebSocket server would be assuredly slower: it would go through the Internet, it would do non-trivial work, and so forth.

