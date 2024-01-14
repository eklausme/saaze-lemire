---
date: "2010-01-04 12:00:00"
title: "Database Questions for 2010: What´s On My Mind"
---



I started 2009 with an interest in [Web  2.0 OLAP](http://arxiv.org/abs/0905.2657) and [collaborative data processing](http://arxiv.org/abs/0906.0910). The field of collaborative data processing has progressed tremendously. Last year, we got [Google Fusion Tables](https://support.google.com/fusiontables/answer/2571232) and data warehousing products are [getting more collaborative](http://www.dbms2.com/2009/12/27/introduction-to-gooddata/).

In 2010, my research might focus more on database theoryâ€”while maintaining a strong experimental bias. Specifically, I am currently thinking about:

- __Lightweight compression__. The goal of lightweight compression is save CPU cyclesâ€”not storage! Of course, the CPU architecture is critical. Thus, you have to worry about instruction-level parallelism. __Measuring the quality of the compression by the compression ratio is wrong.__
- __Row reordering__. Some compression formats, such as run-length encoding, are sensitive to the order of the objects in a database. Reordering them is NP-hard. The efficiency of the heuristics depends on the compression format. I will continue [my earlier work](http://arxiv.org/abs/0901.3751) on this topic.
- __Concurrency and parallelism__. Some believe that multicore CPUs can be used to compress data even more aggressively. It might be misguided. Instead, we must focus on embarrassingly parallel problems. Already, we can scan a large in-memory table using several CPU cores quite fast. In 2010, we should empower our users so that they can explore their data more freely.
- __String hashing__. I have argued on this blog that [universal hashing of long strings is impossible](/lemire/blog/2009/10/02/sensible-hashing-of-variable-length-strings-is-impossible/). While hashing strings is textbook material, our understanding of hashing can be improved further.


__Further reading__: [Search Questions for 2010: What&rsquo;s On My Mind](http://thenoisychannel.com/2010/01/03/search-questions-for-2010-whats-on-my-mind) by Daniel Tunkelang

