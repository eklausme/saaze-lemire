---
date: "2021-07-14 12:00:00"
title: "Faster sorted array unions by reducing branches"
---



When designing an index, a database or a search engine, you frequently need to compute the union of two sorted sets. When I am not using fancy low-level instructions, I have most commonly computed the union of two sorted sets using the following approach:
```C
    v1 = first value in input 1
    v2 = first value in input 2
    while(....) {
        if(v1 < v2) {
            output v1
            advance v1
        } else if (v1 > v2) {
            output v2
            advance v2
        } else {
           output v1 == v2
           advance v1 and v2
        }
    }
```


I wrote this code while trying to minimize the load instructions: each input value is loaded exactly once (it is optimal). It is not that load instructions themselves are expensive, but they introduce some latency. It is not clear whether having fewer loads should help, but there is a chance that having more loads could harm the speed if they cannot be scheduled optimally.

One defect with this algorithm is that it requires many branches. Each mispredicted branch comes with a severe penalty on modern superscalar processors with deep pipelines. By the nature of the problem, it is difficult to avoid the mispredictions since the data might be random.

Branches are not necessarily bad. When we try to load data at an unknown address, speculating might be the right strategy: when we get it right, we have our data without any latency! Suppose that I am merging values from [0,1000] with values from [2000,3000], then the branches are perfectly predictable and they will serve us well. But too many mispredictions and we might be on the losing end. You will get a lot of mispredictions if you are trying this algorithm with random data.

Inspired by Andrey Pechkurov, I decided to revisit the problem. Can we use fewer branches?

Mispredicted branches in the above routine will tend to occur when we conditionally jump to a new address in the program. We can try to entice the compiler to favour &lsquo;conditional move&rsquo; instructions. Such instructions change the value of a register based on some condition. They avoid the jump and they reduce the penalties due to mispredictions. Given sorted arrays, with no duplicated element, we consider the following code:
```C
while ((pos1 < size1) & (pos2 < size2)) {
    v1 = input1[pos1];
    v2 = input2[pos2];
    output_buffer[pos++] = (v1 <= v2) ? v1 : v2;
    pos1 = (v1 <= v2) ? pos1 + 1 : pos1;
    pos2 = (v1 >= v2) ? pos2 + 1 : pos2;
 }
```


You can verify by using the assembly output that [compilers are good at using conditional-move instructions](https://godbolt.org/z/sTWzn35Pd) with this sort of code. In particular, LLVM (clang) does what I would expect. There are still branches, but they are only related to the &lsquo;while&rsquo; loop and they are not going to cause a significant number of mispredictions.

Of course, the processor still needs to load the right data. The address only becomes available in a definitive form just as you need to load the value. Yet we need several cycles to complete the load. It is likely to be a bottleneck, even more so in the absence of branches that can be speculated.

Our second algorithm has fewer branches, but it has more loads. Twice as many loads in fact! Modern processors can sustain more than one load per cycle, so it should not be a bottleneck if it can be scheduled well.

Testing this code in the abstract is a bit tricky. Ideally, you&rsquo;d want code that stresses all code paths. In practice, if you just use random data, you will often have that the intersection between sets are small. Thus the branches are more predictable than they could be. Still, it is maybe good enough for a first benchmarking attempt.

I wrote a benchmark and ran it on the recent Apple processors as well as on an AMD Rome (Zen2) Linux box. I report the average number of nanoseconds per produced element so smaller values are better. With LLVM, there is a sizeable benefit (over 10%) on both the Apple (ARM) processor and the Zen 2 processor.  However, GCC fails to produce efficient code in the branchless mode. Thus if you plan to use the branchless version, you definitively should try compiling with LLVM. If you are a clever programmer, you might find a way to get GCC to produce code like LLVM does: if you do, please share.

system                   |conventional union       |&lsquo;branchless&rsquo; union |
-------------------------|-------------------------|-------------------------|
Apple M1, LLVM 12        |2.5                      |2.0                      |
AMD Zen 2, GCC 10        |3.4                      |3.7                      |
AMD Zen 2, LLVM 11       |3.4                      |3.0                      |


I expect that this code retires relatively few instructions per cycle. It means that you can probably add extra functionality for free, such as bound checking, because you have cycles to spare. You should be careful not to introduce extra work that gets in the way of the critical path, however.

As usual, your results will vary depending on your compiler and processor. Importantly, I do not claim that the branchless version will always be faster, or even that it is preferable in the real world. For real-world usage, we would like to test on actual data. [My C++ code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/07/14): you can check how it works out on your system. You should be able to modify my code to run on your data.

You should expect such a branchless approach to work well when you had lots of mispredicted branches to begin with. If your data is so regular that you a union is effectively trivial, or nearly so, then a conventional approach (with branches) will work better. In my benchmark, I merge &lsquo;random&rsquo; data, hence the good results for the branchless approach under the LLVM compiler.

__Further reading__: For high speed, one would like to use SIMD instructions. If it is interesting to you, please see section 4.3 (Vectorized Unions Between Arrays) in [Roaring Bitmaps: Implementation of an Optimized Software Library](https://arxiv.org/abs/1709.07821), Software: Practice and Experience 48 (4), 2018. Unfortunately, SIMD instructions are not always readily available.

