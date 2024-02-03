---
date: "2021-08-21 12:00:00"
title: "The big-load anti-pattern"
---



When doing data engineering, it is common for engineers to want to first load all of the data in memory before processing the data. If you have sufficient memory and the loaded data is not ephemeral or you have small volumes, it is a sensible approach. After all, that is how a spreadsheet typically works: you load the whole speadsheet in memory.

But what if your application falls in the &ldquo;extract-transform-load&rdquo; category: as you scan the data, you discard it? What if you have large volumes of data? Then I consider the &ldquo;load everything in memory at once&rdquo; a performance anti-pattern when you are doing high performance data engineering.

The most obvious problem with a big load is the scalability. As your data inputs get larger and larger, you consume more and more memory. Though it is true that over time we get more memory, we also tend to get more processing cores, and RAM is a shared ressource. Currently, in 2021, some of the most popular instance types on the popular cloud system AWS have 4 GB per virtual CPU. If you have the means, AWS will provide you with memory-optimized virtual nodes that have 24 TB of RAM. However, these nodes have 448 logical processors sharing that memory.

Frequent and large memory allocations are somewhat risky. A single memory allocation failure may force an entire process to terminate. On a server, it might be difficult to anticipate what other processes do and how much memory they use. Thus each process should seek to keep its memory usage predictable, if not stable. Simply put, it is nicer to build your systems so that, as much as possible, they use a constant amount of memory irrespective of the input size. If you are designing a web service, and you put a hard limit on the size of a single result, you will help engineers build better clients.

You may also encounter various limits which reduce your portability. Not every cloud framework will allow you to upload a 40 GB file at once, without fragmentation. And, of course, on-device processing in a mobile setting becomes untenable if you have no bound on the data inputs.

But what about the performance? If you have inefficient code (maybe written in JavaScript or bad C++), then you should have no worries. If you are using a server that is not powerful, then you will typically have little RAM and a big load is a practical problem irrespective of the performance: you may just run out of memory. But if you are concerned with performance and you have lots of ressources, the story gets more intricate.

If you are processing the data in tiny increments, you can keep most of the data that you are consuming in CPU cache. However, if you are using a big-load, then you need to allocate a large memory region, initialize it, fill it up and then read it again. The data goes from the CPU to the RAM and back again.

The process is relatively expensive. [To illustrate the point, I wrote a little benchmark](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/08/20). I consider a function which allocates memory and populates an array of integer with the values 0,1,2&hellip;
```C
  int * content = new int[volume/sizeof(int)];
  init(content, volume);
  delete[] content;
```


It is a silly function: everything you would do that involves memory allocation is likely far slower. So how fast is this fast function? I get the following numbers on two of my machines. I pick the best results within each run.

&nbsp;                   |1 MB                     |1 GB                     |
-------------------------|-------------------------|-------------------------|
alloc-init (best) &#8211; AMD Rome Linux |33 GB/s                  |7 GB/s                   |
alloc-init (best) &#8211; Apple M1 |30 GB/s                  |9 GB/s                   |


Simply put, allocating memory and pushing data into it gets slower and slower with the volume. We can explain it in terms of CPU cache and RAM, but the principle is entirely general.

You may consider 7 GB/s or 9 GB/s to be a good speed, and indeed these processors and operating systems are efficient. However, consider that it is actually your starting point. We haven&rsquo;t read the data yet. If you need to actually &ldquo;read&rdquo; that data, let alone transform it or do any kind of reasoning over it, you must then bring it back from RAM to cache. So you have the full cache to RAM and RAM to cache cycle. In practice, it is typically worse: you load the whole huge file into memory. Then you allocate memory for an in-memory representation of the content. You then rescan the file and put it in your data structure, and then you scan again your data structure. Unavoidably, your speed will start to fall&hellip; 5 GB/s, 2 GB/s&hellip; and soon you will be in the megabytes per second.

Your pipeline could be critically bounded because it is built out of slow software (e.g., JavaScript code) or because you are relying on slow networks and disk. To be fair, if the rest of your pipeline runs in the megabytes per second, then memory allocation might as well be free from a speed point of view. That is why I qualify the big-load to be an anti-pattern <em>for high-performance data engineering</em>.

In a high-performance context, for efficiency, you should stream through the data as much as possible, reading it in chunks that are roughly the size of your CPU cache (e.g., megabytes). The best chunk size depends on many parameters, but it is typically not tiny (kilobytes) nor large (gigabytes). If you bypass such an optimization as part of your system&rsquo;s architecture, you may have hard limits on your performance later.

It is best to view the processor as a dot at the middle of a sequence of concentric circles. The processor is hard of hearing: they can only communicate with people in the inner circle. But there is limited room in each circle. The further you are from the processor, the more expensive it is for the processor to talk to you because you first need to move to the center, possibly pushing out some other folks. The room close to the processor is crowded and precious. So if you can, you should have your guests come into the center once, and then exit forever. What a big load tends to do is to get people into the inner circle, and then out to some remote circle, and then back again into the inner circle. It works well when there are few guests because everyone gets to stay in the inner circle or nearby, but as more and more people come in, it becomes less and less efficient.

It does not matter how your code looks: if you need to fully deserialize all of a large data file before you process it, you have a case of big load. Whether you are using fancy techniques such as memory file mapping or not, does not change the equation. Some parameters like the size of your pages may help, but they do not affect the core principles.

Adding more memory to your system is likely to make the problem relatively worse. Indeed, systems with lots of memory can often pre-empt or buffer input/output accesses. It means that their best achievable throughput is higher, and thus the big-load penalty relatively worse.

How may you avoid the big-load anti-pattern?

<li style="list-style-type: none;">

- Within the files themselves, you should have some kind of structure so that you do not need to consume the whole file at once when it is large. It comes naturally with popular formats such as [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) where you can often consume just one line at a time. If you are working with JSON data files, you may want to adopt to [JSON streaming](https://en.wikipedia.org/wiki/JSON_streaming) for an equivalent result. Most data-engineering formats will support some concept of chunk or page to help you.
- Consider splitting your data. If you have a database engine, you may consider [sharding](https://en.wikipedia.org/wiki/Shard_(database_architecture)). If you are working with large files, you may want to use smaller files. You should be cautious not to fall for the <em>small-load anti-pattern</em>. E.g., do not store only a few bytes per file and do not fragment your web applications into 400 loadable ressources.
- When compressing data, try to make sure you can uncompress small usable chunks (a few megabytes).



&nbsp;

__Note__: If you are an experienced data engineer, you might object that everything I wrote is obvious. I would agree. This post is not meant to be controversial.

