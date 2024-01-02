---
date: "2012-10-29 12:00:00"
title: "Is reading memory faster than writing on a PC?"
---



For human beings, reading is much faster than writing. The same is often true for computers: adding a record to a database may take an order of magnitude longer than reading it. But the speed differential can often be explained by the overhead of concurrency. For example, writing to a database may involve some form of locking where the database systems must first acquire the exclusive writing rights over a section of memory.

If you minimize the overhead, by writing straight C/C++ code, it is less obvious that reading and writing to memory should have different speeds. And, indeed, in my tests, the `memset` instruction in C which initializes a range of bytes with a given value, takes exactly half the running time of `memcpy` which reads data from one location and writes it to another. Because `memset` involves just writing to memory, and `memcpy` does as much reading as it does writing, we can conclude that these tests show symmetry: reading is as fast as writing.

However, these tests (with `memset` and <tt>memcpy</tt>) are maybe not representative of how writing and reading is done most commonly. Thus I designed a second batch of tests. In these tests, I have two arrays:

- A small array (32KB or less) that fits easily in fast L1-L2 CPU cache. It has size <em>M</em>. 
- A larger array (between 1MB to 512MB) that might not fit in CPU cache. It has size _M_ times _N_ so that the small array fits _N_ times in the larger array.


Then I consider two tests that should run at the same speed if reading and writing are symmetrical:

1. I copy the small array over the large one N times so that all of the larger array is overwritten. In theory, this test reads and writes _M_ times _N_ elements. In practice, we expect the computer to read the small array only once and to keep its data in close proximity with the CPU afterward. Hence, we only need to read the _M_ elements of the small array once and then write N times M elements in the large array. Hence, this test measures mostly writing speed. The simplified source code of this test is as follows:
```C
for(size_t x = 0; x<N; ++x) {
    memcpy(bigdata,data,M*sizeof(int));
    bigdata += M;
}
```

1. I copy N segments from the large array to the small array so that at the end, all of the large array has been read. Again, this test reads and writes _M_ times _N_ elements. However, we can expect the processor to delay copying the short array to memory: it might keep it in fast CPU cache instead. So that, in effect, this second tests might be measuring mostly reading speed. The simplified source code is:
```C
for(size_t x = 0; x<N; ++x) {
    memcpy(data,bigdata,M*sizeof(int));
    bigdata += M;
}
```



Notice how similar the source codes are!

Can you predict which code is faster? I ran these tests on a desktop Intel core i7 processor:

&nbsp;&nbsp;M&nbsp;&nbsp; |&nbsp;&nbsp;N&nbsp;&nbsp; |test 1 (time)/ test 2 (time) |
-------------------------|-------------------------|-------------------------|
2048                     |32 <em>M</em>            |3.4                      |
8192                     |16384 <em>M</em>         |1.6                      |


__Analysis__: The test 1 (writing test) is significantly slower than test 2 (reading test). That is, it is slower to take a small array (located near the CPU) and repeatedly write it to slower memory regions, than doing the reverse. That is, reading is faster than writing.

&ldquo;But Daniel! That&rsquo;s only one test and 4 lines of code, it proves nothing!&rdquo;

Ok. Let us consider another example example. In C/C++, boolean values (<tt>bool</tt>) are stored using at least one byte. That&rsquo;s rather wasteful! So it is common to pack the boolean values. For example, you can store 8 boolean values in one byte using code such as this one:
```C
void pack(bool * d, char * compressed, size_t N) {
  for(size_t i = 0; i < N/8; ++i) {
    size_t x = i * 8;
    compressed[i] = d[x] | 
                    d[x+1]<<1 |
                    d[x+2]<<2 |
                    d[x+3]<<3 |
                    d[x+4]<<4 |
                    d[x+5]<<5 |
                    d[x+6]<<6 |
                    d[x+7]<<7 ;
  }
}
```


The reverse operation is not difficult:
```C
void unpack(char * compressed, bool * d, size_t N) {
  for(size_t i = 0; i < N/8; ++i) {
    size_t x = i * 8;
    d[x] = compressed[i] & 1;
    d[x+1] = compressed[i] & 2;
    d[x+2] = compressed[i] & 4;
    d[x+3] = compressed[i] & 8;
    d[x+4] = compressed[i] & 16;
    d[x+5] = compressed[i] & 32;
    d[x+6] = compressed[i] & 64;
    d[x+7] = compressed[i] & 128;
  }
}
```


These two pieces of code (pack and unpack) are similar. The main difference is that the pack function reads 8 bools (1 byte each) and writes one byte whereas unpack function reads one byte and writes 8 bools. That is, the pack function is a reading test whereas the unpack function is a writing test.

Can you guess which one is faster? In my tests, unpacking is 30% slower than packing. This is consistent with the result of my other analysis: it seems that reading is faster than writing.

Of course, you should only expect to see a relative slowdown if you write much more than you would otherwise read (say by a factor of 8). Also, I expect the results of these tests to vary depending on the compiler and the machine you use. Always run your own tests!

__Source code__: As usual, you can find [my source code online](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2012/10/29). 

__Further reading__: [I know why DRAM is slower to write than to read, but why is the L1 &#038; L2 cache RAM slower to write?](http://electronics.stackexchange.com/questions/17549/i-know-why-dram-is-slower-to-write-than-to-read-but-why-is-the-l1-l2-cache-ra) via [Reverend Eric Ha](https://plus.google.com/+ReverendEricHa/posts)

__Update__: [NathanaÃ«l Schaeffer](https://users.isterre.fr/nschaeff/?) points out that the latency of the MOV operation differs depending on whether you are copying data from memory to a register, or from a register to memory. On my test machine, it takes at least 3 cycles to copy data from a register to memory, but possibly only 2 cycles to copy data from memory to a register ([Fog, 2012](http://www.agner.org/optimize/instruction_tables.pdf)). 

__Credit__: Thanks to L. Boystov, S. H Corey, R. Corderoy, N. Howard and others for discussions leading up to this blog post.

