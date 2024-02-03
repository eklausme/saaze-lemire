---
date: "2023-10-23 12:00:00"
title: "Appending to an std::string character-by-character: how does the capacity grow?"
---



In C++, suppose that you append to a string one character at a time:
```C
while(my_string.size() <= 10'000'000) {
  my_string += "a";
}

```


In theory, it might be possible for the C++ runtime library to implement this routine as the creation of a new string with each append: it could allocate a new memory region that contains just one extra character, and copy to the new region. It would be very slow in the worst case. Of course, the people designing the runtime libraries are aware of such potential problem. Instead of allocating memory and copying with each append, they will typically grow the memory usage in bulk. That is, every time new memory is needed, they double the memory usage (for example).

Empirically, we can measure the allocation. Starting with an empty string, we may add one character at a time. I find that GCC 12 uses capacities of size 15 × 2 <sup><em>k</em></sup> for every increasing integers <em>k</em>, so that the string capacities are 15, 30, 60, 120, 240, 480, 960, 1920, etc. Under macOS (LLVM 15), I get that clang doubles the capacity and add one, except for the initial doubling, so you get capacities of 22, 47, 95, 191, 383, 767, etc. So the string capacity grows by successively doubling in all cases.

If you omit the cost of writing the character, what is the cost of these allocations and copy for long strings? Assume that allocating _N_ bytes costs you _N_ units of work. Let us consider the GCC 12 model : they both lead to the same conclusion. To construct a string of size up to 15 × 2<sup><em>n</em></sup>, it costs you 15 + 15 × 2<sup><em>1</em></sup> + 15 × 2<sup><em>2</em></sup> + &hellip; + 15 × 2<sup><em>n</em></sup> which is a geometric series with value 15 × (2<sup><em>n</em> + 1</sup> &#8211; 1). Generally speaking, you find that this incremental doubling approach costs you no more than 2<em>N</em> units of work to construct a string of size <em>N</em>, after rounding N up to a power of two.  In computer science parlance, the <em>complexity is linear</em>. Insertion in a dynamic array with capacity that is expanded by a constant factor ensures that inserting an element is constant time (amortized). In common sense parlance, it scales well.

In the general case, where you replace 2 by another value (e.g., 1.5), you still get a geometric series but it is in a different basis, 1 +  <em>b</em><sup><em>1</em></sup> + <em>b</em><sup><em>2</em></sup> + &hellip; +  <em>b</em><sup><em>n</em></sup>  which sums up to  (<em>b</em><sup><em>n</em>+1</sup>-1)/(<em>b</em> &#8211; 1). The ratio 2, becomes  <em>b</em>/(<em>b</em> &#8211; 1) asymptotically, so for a basis of 1.5, you get 3<em>N</em> units of work instead of 2<em>N</em>. So a smaller scaling factor _b_ leads to more work, but it is still just a constant factor.

If I benchmark the following function for various values of &lsquo;volume&rsquo;, I get a practically constant time-per-value:
```C
std::string my_string;
while (my_string.size() <= volume) {
  my_string += "a";
}

```


On my laptop, I get the following results. [You can run my benchmark yourself.](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/10/23)

volume                   |time/entry (direct measure) |
-------------------------|-------------------------|
100                      |5.83 ns                  |
1000                     |5.62 ns                  |
10000                    |5.47 ns                  |
100000                   |5.62 ns                  |
1000000                  |5.68 ns                  |
10000000                 |5.69 ns                  |
100000000                |5.80 ns                  |


A consequence of how strings allocate memory is that you may find that many of your strings have excess capacity if you construct them by repeatedly appending characters. To save memory, you may call the method shrink_to_fit() to remove this excess capacity. If you are using a temporary string, it is not a concern since the memory is recovered immediately.

