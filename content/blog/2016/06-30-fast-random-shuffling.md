---
date: "2016-06-30 12:00:00"
title: "Fast random shuffling"
---



In a random shuffle, you want to take the elements of a list and reorder them randomly. In a &ldquo;fair&rdquo; random shuffle, all possible permutations must be equally likely. It is surprisingly hard to come up with a fair algorithm. Thankfully, there is a fast and easy-to-implement algorithm: [the Fisher-Yates shuffle](https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle). It is a rather intuitive algorithm and there are YouTube videos about it&hellip; so, I will just point you at a piece of C code:
```C
for (i=size; i>1; i--) {
   int p = random_bounded(i); // number in [0,i)
   swap(array+i-1, array+p); // swap the values at i-1 and p
}
```


What can we expect to limit the speed of this algorithm? Let me assume that we do not use fancy SIMD instructions or parallelization.

If the input array is not in the cache, and we cannot fetch it in time or it is just too large, then cache faults will dominate the running time. So let us assume that the array is in the CPU&rsquo;s cache.

If we have _N_ input words, we go through the loop _N_ &#8211; 1 times. At each iteration of the loop, you need to read two values and write two other values. A recent x64 processor can only store one value to memory per cycle, so we cannot do better than two cycles per input word. In the very next iteration, you may need to read one of the recently written values. So, two cycles per input word is probably optimistic.

What else could be the problem? The generation of the random numbers could hurt us. Let us assume that we are given a random number generation routine that we cannot change. For this blog post, I will stick with [PCG](http://www.pcg-random.org/).
What remains? Notice how the Fisher-Yates shuffle requires numbers in a range. The typical techniques to generate random numbers in a range involve frequent divisions.

For example, you might want to look at how the Go language [handles it](https://github.com/golang/go/blob/51b08d511e8b42eace59588a7eea73c4d21d222d/src/math/rand/rand.go#L91-L104):
```C
func (r *Rand) Int31n(n int32) int32 {
	max := int32((1 << 31) - 1 - (1<<31)%uint32(n))
	v := r.Int31()
	for v > max {
		v = r.Int31()
	}
	return v % n
}
```


This function always involves two divisions. Java, the PCG library&hellip; all involve at least one division per function call, often many more than one. Sadly, divisions are many times more expensive than any other operation, even on recent processors.

 In an earlier [blog post](/lemire/blog/2016/06/27/a-fast-alternative-to-the-modulo-reduction/), I showed how to (mostly) get around divisions.

In general, no map from all 32-bit integers to a range can be perfectly fair. In practice, the effect is quite small unless your range is close to the maximal value of an integer. Thus you can simply use the following function:```C
uint32_t random_bounded(uint32_t range) {
  uint64_t random32bit =  random32(); //32-bit random number 
  multiresult = random32bit * range;
  return multiresult >> 32;
}
```


Maybe you feel bad about introducing a slight bias. You probably should not since the random-number generation itself is unlikely to be perfect.
Still, we can correct the bias. Recall that some of the values are mapped ceil(4294967296/range) times whereas others are mapped floor(4294967296/range) times. By sometimes redrawing a new random value, we can avoid entirely the bias (this technique is called [rejection sampling](https://en.wikipedia.org/wiki/Rejection_sampling)):
```C
uint32_t random_bounded(uint32_t range) {
  uint64_t random32bit =  random32(); //32-bit random number 
  multiresult = random32bit * range;
  leftover = (uint32_t) multiresult;
  if(leftover < range ) {
      threshold = -range % range ;
      while (leftover < threshold) {
            random32bit =  random32();
            multiresult = random32bit * range;
            leftover = (uint32_t) multiresult;
      }
   }
  return multiresult >> 32;
}
```


This looks quite a bit worse, but the &ldquo;if&rdquo; clause containing divisions is very rarely taken. Your processor is likely to mostly ignore it, so the overhead of this new function is smaller than it appears.

So how do we fare? I have implemented these functions in C, using them to compute a random shuffle. Before each shuffle, I ensure that the array is in the cache. I report the number of clock cycle used per input words, on a recent Intel processor (Skylake). As usual, [my code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2016/06/29).

<td colspan="2">Random shuffle timings, varying the range function |

range function           |cycles per input word    |
PCG library              |18.0                     |
Go-like                  |20.1                     |
Java-like                |12.1                     |
no division, no bias     |7                        |
no division (with slight bias) |6                        |


Avoiding divisions makes the random shuffle runs twice as fast.

Could we go faster? Yes. If we use a cheaper/faster random number generator. However, keep in mind that without SIMD instructions or multi-core processing, we cannot realistically hope to reach the lower bound of 2 cycles per input words. That is, I claim that no function can be 3 times faster than the fastest function we considered.
You can save a little bit (half a cycle per input word) if you replace the 32-bit PCG calls by 64-bit calls, processing input words in pairs. Using SIMD instructions, we could go even faster, but I do not have access to a SIMD-accelerated PCG implementation&hellip; We could, of course, revisit the problem with different random-number generators.

__Further reading__: Daniel Lemire, [Fast Random Integer Generation in an Interval](https://arxiv.org/abs/1805.10941), ACM Transactions on Modeling and Computer Simulation (to appear)

