---
date: "2018-10-23 12:00:00"
title: "Is WebAssembly faster than JavaScript?"
---



Most programs running on web sites are written in JavaScript. There are still a few Java applets and other plugins hanging around, but they are considered obsolete at this point.

While JavaScript is superbly fast, some people feel that we ought to do better. That&rsquo;s where WebAssembly comes in. It is a binary (&ldquo;pre-compiled&rdquo;) format that is made to load quickly. It still needs to get compiled or interpreted, but, at least, you do not need to parse JavaScript source code.

The general idea is that you write your code in C, C++ or Rust, then you compile it to WebAssembly. In this manner, you can port existing C or C++ programs so that they run on Web pages. That&rsquo;s obviously useful if you already have the C and C++ code, but less appealing if you are starting a new project from scratch. It is far easier to find JavaScript front-end developers in almost any industry, except maybe gaming.

[You should not expect WebAssembly to have native performance](https://www.usenix.org/system/files/atc19-jangda.pdf). That is, WebAssembly is, at this time, no match for a good old C program.

I think it is almost surely going to be more labor intensive to program web applications using WebAssembly.

In any case, I like speed so I was interested so I asked a student of mine (M. Fall) to work on the problem. We picked small problems with hand-crafted code in C and JavaScript.

Here are the preliminary conclusions:

1. In all cases we considered, the total WebAssembly files were larger than the corresponding JavaScript source code, even without taking into account that the JavaScript source code can be served in compressed form. This means that if you are on a slow network connection, JavaScript programs will start faster.The story may change if you build large projects. Moreover, we compared against human-written JavaScript, and not automatically generated JavaScript.
1. Once the WebAssembly files are in the cache of the browser, they load faster than the corresponding JavaScript source code, but the difference is small. Thus if you are frequently using the same application, or if the web application resides on your machine, WebAssembly will start faster. However, the gain is small. One reason why the gain is small is that JavaScript loads and starts very quickly.
1. WebAssembly (compiled with full optimization) is not always faster than JavaScript during execution, and when WebAssembly is faster, the gain can be small. Browser support is also problematic: while Firefox and Chrome have relatively fast WebAssembly execution (with Firefox being better), we found Microsoft Edge to be quite terrible. WebAssembly on Edge is really slow.Our preliminary results contradict several reports, so you should take them with a grain of salt. However, benchmarking is ridiculously hard especially when a language like JavaScript is involved. Thus anyone reporting systematically better results with WebAssembly should look into how well optimized the JavaScript really is.


While WebAssembly might be a compelling platform if you have a C++ game you need to port to the Web, I would bet good money that WebAssembly is not about to replace JavaScript for most tasks. Simply put, JavaScript is fast and convenient. It is going to be quite difficult to do better in the short run.

It is still deserving of attention since the uptake on WebAssembly has been fantastic. For online games, it has surely a bright future.

__More content__: [WebAssembly and the Death of JavaScript](https://youtu.be/pBYqen3B2gc) (video) by Colin Eberhardt

__Further reading__: Egorov&rsquo;s [Maybe you don&rsquo;t need Rust and WASM to speed up your JS](https://mrale.ph/blog/2018/02/03/maybe-you-dont-need-rust-to-speed-up-your-js.html); Haas et al., [Bringing the Web up to Speed with WebAssembly](https://www.cs.tufts.edu/~nr/cs257/archive/andreas-rossberg/webassembly.pdf); Herrera et al., [WebAssembly and JavaScript Challenge: Numerical program performance using modern browser technologies and devices](http://www.sable.mcgill.ca/publications/techreports/2018-2/techrep.pdf).

