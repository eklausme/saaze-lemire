---
date: "2020-06-19 12:00:00"
title: "Computational overhead due to Docker under macOS"
---



For my programming work, I tend to assume that I have a Linux environnement. That is true whether I am under Windows, under macOS or under a genuine Linux.

How do I emulate Linux wherever I go? I use [docker containers](/lemire/blog/2020/05/22/programming-inside-a-container/). Effectively, the docker container gives me a small subsystem where everything is &ldquo;as if&rdquo; I was under Linux.

Containers are a trade-off. They offer a nice sandbox where your code can run, isolated from the rest of your system. However they also have lower performance. Disk and network access is slower. I expect that it is true wherever you run your containers.

However, part of your computing workload might be entirely computational. If you are training a model or filtering data, you may not be allocating memory, writing to disk or accessing the network. In such cases, my tests suggest that you have pretty much the same performance whether you are running your tasks inside a container, or outside of the container&hellip; as long as your host is Linux.

When running docker under Windows or macOS, docker must rely on a virtual machine. Under Windows, it may use VirtualBox or other solutions, depending on your configuration, whereas it appears to use Hyperkit under macOS. These virtual machines are highly efficient, but they still carry an overhead.

Let me benchmark a simple Go program that just repeatedly computes random numbers and compares them with the value 0. It prints out the result at the end.
```C
package main

import (
        "fmt"
        "math/rand"
)

func main() {
        counter := 0
        for n := 0; n < 1000000000; n++ {
                if rand.Int63() == 0 {
                        counter += 1
                }
        }
        fmt.Printf("number of zeros: %d \n", counter)
}
```


It is deliberately simple. I am going to use Go 1.14 (always).

Under macOS, I get that my program takes 11.7 s to run.
```C
$ go build -o myprogram
$ time ./myprogram
number of zeros: 0

real	0m11.911s
user	0m11.660s
sys	0m0.034s
```


I am ignoring the &ldquo;sys&rdquo; time since I only want the computational time (&ldquo;user&rdquo;).

Let me run the same program after starting a docker container (from an ubuntu 20.10 image):
```C
$ go build -o mydockerprogram
$ time ./mydockerprogram
number of zeros: 0

real	0m12.038s
user	0m12.026s
sys	0m0.025s
```


So my program now takes 12 s, so 3% longer. Observe that my methodology is not fool-proof: I do not know that this 3% slowdown is due to the overhead incurred by docker. However, it bounds the overhead.

Let me do something fun. I am going to start the container and run my program in the container, and then shut it down.
```C
$ time run 'bash -c "time ./mydockerprogram"'
number of zeros: 0

real	0m12.012s
user	0m12.003s
sys	0m0.008s

real	0m12.545s
user	0m0.086s
sys	0m0.041s
```


It now takes 0.5 s longer. That is the time it takes for me start a container, do nothing, and then shut it down. Doing it in this manner takes 8% longer than running it natively in macOS.

Of course, if you run many small jobs, the 0.5 s is going to hurt you. It may come to dominate the running time.

If you want to squeeze every ounce of computational performance out your machine, it is likely that you should avoid the docker overhead under macOS. A 3% overhead may prove to be unacceptable. However, for developing and benchmarking your code, it may well be an acceptable trade-off.

