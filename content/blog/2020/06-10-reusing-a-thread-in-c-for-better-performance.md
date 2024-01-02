---
date: "2020-06-10 12:00:00"
title: "Reusing a thread in C++ for better performance"
---



In a previous post, I measured the time necessary to start a thread, execute a small job and return.
```C
auto mythread = std::thread([] { counter++; });
mythread.join();
```


The answer is thousands of nanoseconds. Importantly, that is the time as measured by the main thread. That is, sending the query, and getting back the result, takes thousands of nanoseconds and thousands of cycles. The work in my case is just incrementing a counter: any task more involved will increase the overall cost. The C++ standard API also provides an async function to call one function and return: it is practically equivalent to starting a new thread and joining it, as I just did.

Creating a new thread each time is fine if you have a large task that needs to run for milliseconds. However, if you have tiny tasks, it won&rsquo;t do.

What else could you do? Instead of creating a thread each time, you could create a single thread. This thread loops and periodically sleep, waiting to be notified that there is work to be done. I am using the C++11 standard approach.
```C
  std::thread thread = std::thread([this] {
    while (!exiting) {
      std::unique_lock<std::mutex> lock(locking_mutex);
      cond_var.wait(lock, [this]{return has_work||exiting;});
      if (exiting) {
        break;
      }
      counter++;
      has_work = false;
      lock.unlock();
      cond_var.notify_all();
    }
  });
```


It should be faster and overall more efficient. You should expect gains ranging from 2x to 5x. If you use a C++ library with thread pools and/or workers, it is likely to adopt such an approach, albeit with more functionality and generality. However, the operating system is in charge of waking up the thread and may not do so immediately so it is not likely to be the fastest approach.

What else could you do? You could simply avoid as much as possible system dependencies and just loop on an atomic variable. The downside of the tight loop (spin lock) approach is that your thread might fully use the processor while it waits. However, you should expect it to get to work much quicker.
```C
  std::thread thread = std::thread([this] {
    thread_started.store(true);
    while (true) {
      while (!has_work.load()) {
        if (exiting.load()) {
          return;
        }
      }
      counter++;
      has_work.store(false);
    }
  });
```


The results will depend crucially on your processor and on your operation system. Let me report the rough numbers I get with an Intel-based linux box and GNU GCC 8.

new thread each time     |9,000 ns                 |
-------------------------|-------------------------|
async call               |9,000 ns                 |
worker with mutexes      |5,000 ns                 |
worker with spin lock    |100 ns                   |


[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2020/06/10).

