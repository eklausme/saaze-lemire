---
date: "2023-10-17 12:00:00"
title: "Randomness in programming (with Go code)"
---



Computer software is typically deterministic on paper: if you run twice the same program with the same inputs, you should get the same outputs. In practice, the complexity of modern computing makes it unlikely that you could ever run twice the same program and get exactly the same result, down to the exact same execution time. For example, modern operating systems randomize the memory addresses as a security precaution: a technique called <em>Address space layout randomization</em>. Thus if you run a program twice, you cannot be guaranteed that the memory is stored at the same memory addresses. In Go, you can print the address of a pointer with the <code>%p</code> directive. The following program will allocate a small array of integers, and print the corresponding address, using a pointer to the first value. If you run this program multiple times, you may get different addresses.
```Go
package main

import (
    "fmt"
)

func main() {
  x := make([]int, 3)
    fmt.Printf("Hello %p", &x[0])
}
```


Thus, in some sense, software programs are already _randomized_ whether we like it or not. Randomization can make programming more challenging. For example, a bad program might behave correctly most of the time and only fail intermittently. Such unpredictable behavior is a challenge for a programmer.

Nevertheless, we can use randomization to produce better software: for example by testing our code with random inputs. Furthermore, randomness is a key element of security routines.

Though randomness is an intuitive notion, defining it requires more care. Randomness is usually tied to a lack of information. For example, it may be measured by our inability to predict an outcome. Maybe you are generating numbers, one every second, and after looking at the last few numbers you generated, I still cannot predict the next number you will generate. It does not imply that the approach you are using to generate numbers is magical. Maybe you are applying a perfectly predictable mathematical routine. Thus randomness is relative to the observer and their knowledge.

In software, we distinguish between pseudo-randomness and randomness. If I run a mathematical routine that generates random-looking numbers, but these numbers are perfectly determined, I will say that they are ‘pseudo-random’. What <em>random looking</em> means is subjective and the concept of pseudo-randomness is likewise subjective.

It is possible, on a computer, to produce numbers that cannot be predicted by the programmer. For example, you might use a temperature sensor in your processor to capture physical ‘noise’ that can serve as a random-looking input. You might use the time of day when a program was started as a _random_ input. We often refer to such values are random (as opposed to pseudo-random). We consider them random in the sense that, even in principle, it is not possible for the software to predict them: they are produced by a process from outside of the software system. ### Hashing Hashing is the process by which we design a function that takes various inputs (for example variable-length strings) and outputs a convenient value, often an integer value. Because hashing involves a function, given the same input, we always get the same output. Typically, hash functions produce a fixed number of bits: e.g., 32 bits, 64 bits, and so forth.

One application of hashing has to do with security: given a file recovered from the network, you may compute a hash value from it. You may then compare it with the hash value that the server provides. If the two hash values match, then it is likely that the file you recovered is a match for the file on the server. Systems such as git rely on this strategy.

Hashing can also be used to construct useful data structures. For example, you can create a hash table: given a set of key values, you compute a hash value representing an index in an array. You can then store the key and a corresponding value at the given index, or nearby. When a key is provided, you can hash it, seek the address in the array, and find the matching value. If the hashing is random-looking, then you should be able to hash N objects into an array of M elements for M slightly larger than N so that a few objects are hashed to the same location in the array. It is difficult to ensure that no two objects are ever mapped to the same array element: it requires that M be much, much larger than N. For M much larger than N, the probability of a collision is about <code>1 - exp(-N*N/(2*M))</code>. Though this probability falls to zero as M grows large, it requires <code>M</code> to be much larger than <code>N</code> for it to be practically zero. Solving for <code>p</code> in <code>1 - exp(-N*N/(2*M)) = p</code>, we get <code>M = -1/2 N*N / ln(1-p)</code>. That is, to maintain a probability <code>p</code>, then <code>M</code> must grow quadratically (proportionally to <code>N*N</code>) concerning <code>N</code>. Thus we should expect that there will be collisions in a hash table even if the hash function appears random. We can handle collisions in various ways. For example, you may use chaining: each element in the array stores a reference to a dynamic container that may contain several keys. You may also use linear probing: if the array location is occupied, you find the next unoccupied value and store the key there. When searching for a key under linear probing, you first access the element indicated by the hash value, and if it is occupied by a different key, you move to the next element and so forth, until you have visited all of the array, or until you have found an unoccupied element. There are many variations on the same theme (linear probing).

An ideal hash function might take each possible input and assign it to a purely random value given by an Oracle. Unfortunately, such hash functions are often impractical. They require the storage of large tables of input values and matching random values. In practice, we aim to produce hash functions that behave as if they were purely random while still being easy to implement efficiently.

A reasonable example to hash non-zero integer values is the murmur function. The murmur function consists of two multiplications and and three shift/xor operations. The following Go program will display random-looking 64-bit integers, using the murmur function:
```Go
package main

import (
    "fmt"
    "math/bits"
)

func murmur64(h uint64) uint64 {
    h ^= h >> 33
    h *= 0xff51afd7ed558ccd
    h ^= h >> 33
    h *= 0xc4ceb9fe1a85ec53
    h ^= h >> 33
    return h
}

func main() {

    for i := 0; i < 10; i++ {
        fmt.Println(i, murmur64(uint64(i)))
    }
}
```


It is a reasonably fast function. One downside of the <code>murmur64</code> function is that zero is mapped to zero, so some care is needed.

In practice, your values might not be integers. If you want to hash a string, you might use a <em>recursive function</em>. You process the string character by character. At each character, you combine the character value with the hash value computed so far, generating a new hash value. Once the function is completed, you may then apply murmur to the result:
```Go
package main

import (
    "fmt"
)

func murmur64(h uint64) uint64 {
    h ^= h >> 33
    h *= 0xff51afd7ed558ccd
    h ^= h >> 33
    h *= 0xc4ceb9fe1a85ec53
    h ^= h >> 33
    return h
}

func hash(s string) (v uint64) {
    v = uint64(0)
    for _, c := range s {
        v = uint64(c) + 31*v
    }
    return murmur64(v)
}

func main() {
    fmt.Print(hash("la vie"), hash("Daniel"))
}
```


There are better and faster hash functions, but the result from recursive hashing with a murmur finalizer is reasonable.

Importantly, it is reasonably easy to generate two strings that hash to the same values, i.e., to create a collision. For example, you can verify that the strings <code>"Ace"</code>, <code>"BDe"</code>, <code>"AdF"</code>, <code>"BEF"</code> all have the same hash value:
```Go
fmt.Print(hash("Ace"), hash("BDe"), hash("AdF"), hash("BEF"))
```


When hashing arbitrarily long strings, collisions are always possible. However, we can use more sophisticated (and more computationally expensive) hash functions to reduce the probability that we encounter a problem.

An interesting characteristic of the provided <code>murmur64</code> function is that it is invertible. If you consider the steps, you have two multiplication by odd integers. A multiplication by an odd integer is always invertible: the multiplicative inverse of 0xff51afd7ed558ccd is 0x4f74430c22a54005 and the multiplicative inverse of 0xc4ceb9fe1a85ec53 is 0x9cb4b2f8129337db, as 64-bit unsigned integers. It may be slightly less obvious that <code>h ^= h &gt;&gt; 33</code> is invertible. But if <code>h</code> is a 64-bit integer, we have that <code>h</code> and <code>h ^ (h &gt;&gt; 33)</code> are identical in their most significant 33 bits, by inspection. Thus if we are given <code>z = h ^ (h &gt;&gt; 33)</code>, we have that <code>z &gt;&gt; (64-33) == h &gt;&gt; (64-33)</code>. That is, we have identified the most significant 33 bits of <code>h</code> from <code>h ^ (h &gt;&gt; 33)</code>. Extending this reasoning, we have that <code>g</code> is the inverse of <code>f</code> in the following code, in the sense that <code>g(f(i)) == i</code>.
```Go
func f(h uint64) uint64 {
    return h ^ (h >> 33)
}

func g(z uint64) uint64 {
    h := z & 0xffffffff80000000
    h = (h >> 33) ^ z
    return h
}
```


We often need hash values to fit within an interval starting at zero. E.g., you might want to get a hash value in <code>[0,max)</code>, you might use the following function:
```Go
func toIntervalBias(random uint64, max uint64) uint64 {
    hi,_ := bits.Mul64(random, max)
    return hi
}
```


This function outputs a value in <code>[0,max)</code> using a single multiplication. There are alternatives such as <code>random % max</code>, but an integer remainder operation may compile to a division instruction, and a division is typically more expensive than a multiplication. Whenever possible, you should avoid division instructions when performance is a factor.

Importantly, the <code>toIntervalBias</code> function introduces a slight bias: we start with <span class="math inline">2<sup>64</sup></span> distinct values and we map them to <code>N</code> distinct values. This means that out of <span class="math inline">2<sup>64</sup></span> original values, about <span class="math inline">2<sup>64</sup>/<em>N</em></span> values correspond to each output value. Let <span class="math inline">⌈<em>x</em>⌉</span> be the smallest integer no smaller than <span class="math inline"><em>x</em></span> and <span class="math inline">⌊<em>x</em>⌋</span> be the larger integer no larger than <span class="math inline"><em>x</em></span>. When <span class="math inline">2<sup>64</sup>/<em>N</em></span> is not an integer, then some output values match <span class="math inline">⌈2<sup>64</sup>/<em>N</em>⌉</span> original values, whereas others match <span class="math inline">⌊2<sup>64</sup>/<em>N</em>⌋</span> original values. When <span class="math inline"><em>N</em></span> is small, it may be negligible, but as <span class="math inline"><em>N</em></span> grows, the bias is relatively more important. In some sense, it is the smallest possible bias if we are starting from original values that are uniformly distributed over a set of <span class="math inline">2<sup>64</sup></span> possible values.

Putting it all together, the following program will hash a string into a value in the interval <code>[0,10)</code>.
```Go
package main

import (
    "fmt"
    "math/bits"
)

func murmur64(h uint64) uint64 {
    h ^= h >> 33
    h *= 0xff51afd7ed558ccd
    h ^= h >> 33
    h *= 0xc4ceb9fe1a85ec53
    h ^= h >> 33
    return h
}

func hash(s string) (v uint64) {
    v = uint64(0)
    for _, c := range s {
        v = uint64(c) + 31*v
    }
    return murmur64(v)
}

func toIntervalBias(random uint64, max uint64) uint64 {
    hi,_ := bits.Mul64(random, max)
    return hi
}

func main() {
    fmt.Print(toIntervalBias(hash("la vie"),10))
}
```


Though the <code>toIntervalBias</code> function is generally efficient, it is unnecessarily expensive when the range is a power of two. If <code>max</code> is a power of two (e.g., 32), then <code>random % max == random &amp; (max-1)</code>. A bitwise AND with the decremented maximum is faster than even just a multiplication, typically. Thus the following function is preferable.
```Go
func toIntervalPowerOfTwo(random uint64, max uint64) uint64 {
    return random & (max-1)
}
```

<h3 id="estimating-cardinality">Estimating cardinality</h3>

One use case for hashing is to estimate the cardinality of the values in an array or stream of values. Suppose that your software receives billions of identifiers, how many distinct identifiers are there? You could build a database of all identifiers, but it could use a lot of memory and be relatively expensive. Sometimes, you only want a crude approximation, but you want to compute it quickly.

There are many techniques to estimate cardinalities using hashing: Probabilistic Counting, LOGLOG Probabilistic Counting, and so forth. We can explain the core idea and even produce a useful function without any advanced mathematics. If you hash all values (e.g., identifiers), and if the hash function is of good quality, you would expect that all distinct values will be hash to a random-looking value within the set of all values.

The space between distinct hash values should be about <span class="math inline">2<sup>64</sup>/(<em>N</em>+1)</span> where <span class="math inline"><em>N</em></span> is the number of distinct values. If we find the small hash value <span class="math inline"><em>m</em></span>, then we should have approximately <span class="math inline"><em>m</em> = 2<sup>64</sup>/(<em>N</em>+1)</span> or <span class="math inline"><em>N</em> = 2<sup>64</sup>/<em>m</em> − 1</span>. When <span class="math inline"><em>N</em></span> is much larger than 1 but much smaller than <span class="math inline">2<sup>64</sup></span>, this is approximatively <span class="math inline"><em>N</em> = (2<sup>64</sup>−1)/<em>m</em></span>. The following function applies this formula to estimate the cardinality:
```Go
// estimateCardinality estimates the number of distinct values
func estimateCardinality(values []uint64) int {
    if len(values) < 2 {
        return len(values)
    }
    mi1 := murmur64(values[0])

    for i := 1; i < len(values); i++ {
        t := murmur64(values[i])
        if t < mi1 {
            mi1 = t
        }
    }
    return int(math.MaxUint64 / mi1)
}
```


We can apply this function in the following program. The approximation is rather crude, but it can be good enough in some practical cases.
```Go
package main

import (
    "fmt"
    "math"
)

func mu(h uint64, step uint64) uint64 {
    return h * step
}

func murmur64(h uint64) uint64 {
    h ^= h >> 33
    h *= 0xff51afd7ed558ccd
    h ^= h >> 33
    h *= 0xc4ceb9fe1a85ec53
    h ^= h >> 33
    return h
}

// fillArray fills the array with up to howmany distinct values
func fillArray(arr []uint64, howmany int) {
    for i := 0; i < len(arr); i++ {
        // careful not to include zero because murmur64(0) == 0
        arr[i] = 1 + uint64(i%howmany)
    }
}

// estimateCardinality estimates the number of distinct values
func estimateCardinality(values []uint64) int {
    if len(values) < 2 {
        return len(values)
    }
    m := murmur64(values[0])

    for i := 1; i < len(values); i++ {
        t := murmur64(values[i])
        if t < mi1 {
            m = t
        }
    }
    return int(math.MaxUint64 / m)
}

func main() {
    values := make([]uint64, 5000000) // 50 M
    distinct := 2200000               // 1.2 M
    fillArray(values, distinct)
    fmt.Println(estimateCardinality(values), distinct)

}
```

<h3 id="integers">Integers</h3>

There are many ways to generate random integers, but a particularly simple approach is to rely on hashing. For example, we could start from an integer (e.g., 10) and return the random integer <code>murmur64(10)</code> and then increment the integer (e.g, to 11) and next return the integer <code>murmur64(10)</code>.

[Steele et al. (2014)](https://doi.org/10.1145/2714064.2660195) propose a similar strategy which they call SplitMix: it is part of the Java standard library. It works much like what we just described but instead of incrementing the counter by one, they increment it by a large odd integer. They also use a slightly different version of the <code>murmur64</code> version. The following function prints 10 different random values, following the SplitMix formula:
```Go
package main

import "fmt"

func splitmix64(seed *uint64) uint64 {
    *seed += 0x9E3779B97F4A7C15
    z := *seed
    z = (z ^ (z >> 30))
    z *= (0xBF58476D1CE4E5B9)
    z = (z ^ (z >> 27))
    z *= (0x94D049BB133111EB)
    return z ^ (z >> 31)
}

func main() {
    seed := uint64(1234)
    for z := 0; z < 10; z++ {
        r := splitmix64(&seed)
        fmt.Println(r)
    }
}
```


Each time the <code>splitmix64</code> function is called, the hidden <code>seed</code> variable is advanced by a constant (<code>0x9E3779B97F4A7C15</code>). If you start from the same seed, you always get the same random values.

The function then performs a series of bitwise operations on z. First, it performs an XOR operation between z and z shifted right by 30 bits. It then multiplies the result by the constant value 0xBF58476D1CE4E5B9. Next, it performs another XOR operation between the result and the result shifted right by 27 bits. Finally, it multiplies the result by the constant value 0x94D049BB133111EB and returns the result XORed with the result shifted right by 31 bits.

It produces integers using the full 64-bit range. If one needs a random integer in an interval (e.g., <code>[0,N)</code>), then more work is needed. If the size of the interval is a power of two (e.g., <code>[0,32)</code>), then we may simply use the same technique as for hashing:
```Go
// randomInPowerOfTwo -> [0,max)
func randomInPowerOfTwo(seed *uint64, max uint64) uint64 {
    r := splitmix64(seed)
    return r & (max-1)
}
```


However, when the bound is arbitrary (not a power of two) and we want to avoid biases, a slightly more complicated algorithm is needed. Indeed, if we assume that the 64-bit integers are truly random, then all values are equally likely. However, if we are not careful, we can introduce a bias when converting the 64-bit integers to values in <code>[0,N)</code>. It is not a concern when <code>N</code> is a power of two, but it becomes a concern when <code>N</code> is arbitrary. A fast routine was described by [Lemire (2019)](https://arxiv.org/abs/1805.10941) to solve this problem:
```Go
func toIntervalUnbiased(seed *uint64, max uint64) uint64 {
    x := splitmix64(seed)
    hi, lo := bits.Mul64(x, max)
    if lo < max {
        t := (-max) % max // division!!!
        for lo < t {
            x := splitmix64(seed)
            hi, lo = bits.Mul64(x, max)
        }
    }
    return hi
}
```


The toIntervalUnbiased function takes two arguments: a pointer to a 64-bit unsigned integer seed and a 64-bit unsigned integer max. It returns a 64-bit unsigned integer. The function first calls the splitmix64 function with the seed pointer as an argument to generate a random 64-bit unsigned integer x. It then multiplies x with max using the bits.Mul64 function, which returns the product of two 64-bit unsigned integers as two 64-bit unsigned integers. The higher 64 bits of the product are stored in the variable hi, and the lower 64 bits are stored in the variable lo. If lo is less than max, the function enters a loop that generates new random numbers using splitmix64 and recalculates the product of x and max until lo is greater than or equal to -max % max. This is done to ensure that the distribution of random numbers is unbiased.

The general strategy used by this function is called the rejection method: we repeatedly try to generate a random integer until we can produce an unbias result. However, when the interval is much smaller than <span class="math inline">2<sup>64</sup></span> (a common case), then we are very unlikely to use the rejection method or to even have to compute an integer remainder. Most of the time, the function never enters in the rejection loop.

Testing that a random generator appears random is challenging. We can use many testing strategies, and each testing strategy can be more or less extensive. Thankfully, it is not difficult to think of some tests we can apply. For example, we want the distribution of values to be uniform: the probability that any one value is generated should be 1 over the number of possible values. When generating 2 to the 64 possible values, it is technically challenging to test for uniformity. However, we can conveniently restrict the size of the output with a function such as <code>toInterval</code>.

The following program computes the relative standard deviation of a frequency histogram based on 100 million values. The relative standard deviation is far smaller than 1% (0.05655%) which suggests that the distribution is uniform.
```Go
package main

import (
    "fmt"
    "math"
    "math/bits"
)

func splitmix64(seed *uint64) uint64 {
    *seed += 0x9E3779B97F4A7C15
    z := *seed
    z = (z ^ (z >> 30))
    z *= (0xBF58476D1CE4E5B9)
    z = (z ^ (z >> 27))
    z *= (0x94D049BB133111EB)
    return z ^ (z >> 31)
}

func toIntervalUnbiased(seed *uint64, max uint64) uint64 {
    x := splitmix64(seed)
    hi, lo := bits.Mul64(x, max)
    if lo < max {
        t := (-max) % max // division!!!
        for lo < t {
            x := splitmix64(seed)
            hi, lo = bits.Mul64(x, max)
        }
    }
    return hi
}

func meanAndStdDev(arr []int) (float64, float64) {
    var sum, sumSq float64
    for _, val := range arr {
        sum += float64(val)
        sumSq += math.Pow(float64(val), 2)
    }
    n := float64(len(arr))
    mean := sum / n
    stdDev := math.Sqrt((sumSq / n) - math.Pow(mean, 2))
    return mean, stdDev
}

func main() {
    seed := uint64(1234)
    const window = 30
    var counter [window]int

    for z := 0; z < 100000000; z++ {
        counter[toIntervalUnbiased(&seed, window)] += 1
    }
    moyenne, ecart := meanAndStdDev(counter[:])
    fmt.Println("relative std ", ecart/moyenne*100, "%")
}
```

<h3 id="random-shuffle">Random shuffle</h3>

Sometimes, you are given an array that you want to randomly shuffle. An elegant algorithm described by Knuth is the standard approach. The algorithm works by iterating over the array from the last element to the first element. At each iteration, it selects a random index between 0 and the current index (inclusive) and swaps the element at the current index with the element at the randomly generated index.

The following program shuffles randomly an array based on a seed. Changing the seed would change the order of the array. For large arrays, the number of possible permutations is likely to exceed the number of possible seeds: it implies that not all possible permutations are possible with such an algorithm using a simple fixed-length seed.
```Go
package main

import (
    "fmt"
    "math/bits"
)

func splitmix64(seed *uint64) uint64 {
    *seed += 0x9E3779B97F4A7C15
    z := *seed
    z = (z ^ (z >> 30))
    z *= (0xBF58476D1CE4E5B9)
    z = (z ^ (z >> 27))
    z *= (0x94D049BB133111EB)
    return z ^ (z >> 31)
}

func toIntervalUnbiased(seed *uint64, max uint64) uint64 {
    x := splitmix64(seed)
    hi, lo := bits.Mul64(x, max)
    if lo < max {
        t := (-max) % max // division!!!
        for lo < t {
            x := splitmix64(seed)
            hi, lo = bits.Mul64(x, max)
        }
    }
    return hi
}

func shuffle(seed *uint64, arr []int) {
    for i := len(arr)-1; i >= 1; i-- {
        j := toIntervalUnbiased(seed, uint64(i+1))
        arr[i], arr[j] = arr[j], arr[i]
    }
}

func main() {
    seed := uint64(1234)
    numbers := []int{1, 2, 3, 4, 5, 6, 7, 8, 9, 10}
    shuffle(&seed, numbers)
    fmt.Println(numbers)
}
```

<h3 id="floats">Floats</h3>

It is often necessary to generate random floating-point numbers. Software systems typically use IEEE 754 floating-point numbers.

To generate 32-bit floating-point numbers in the interval <code>[0,1)</code>, it may seem that we could generate a 32-bit integer (in <span class="math inline">[0, 2<sup>32</sup>)</span>) and divide it by <span class="math inline">2<sup>32</sup></span> to get a random floating-point value in <span class="math inline">[0, 1)</span>. That’s certainly “approximately true”, but we are making an error when doing so. How much of an error?

Floating-point (normal* numbers are represented as a sign bit, a mantissa, and an exponent as follows:

- There is a single sign bit. Because we only care about positive numbers, this bit is fixed and can be ignored.
- The mantissa of a 32-bit floating point number is 23 bits. It is implicitly preceded by the number 1.
- There are eight bits dedicated to the exponent. For normal numbers, the exponent ranges from -126 to 127. To represent zero, you need an exponent value of -127 and zero mantissa.


So how many normal non-zero numbers are there between 0 and 1? The negative exponents range from -1 to -126. In each case, we have <span class="math inline">2<sup>23</sup></span> distinct floating-point numbers because the mantissa is made of 23 bits. So we have 126 x <span class="math inline">2<sup>23</sup></span> normal floating-point numbers in <code>[0,1)</code>. If you don’t have a calculator handy, that’s 1,056,964,608. If we want to add the numbers 0 and 1, that’s <span class="math inline">126 × 2<sup>23</sup> + 2</span> slightly over a billion distinct values. There are <span class="math inline">2<sup>32</sup></span> 32-bit words or slightly over 4 billion, so about a quarter of them are in the interval <code>[0,1]</code>. Of all the float-pointing point numbers your computer can represent, a quarter of them lie in <code>[0,1]</code>. By extension, half of the floating-point numbers are in the interval <code>[-1,1]</code>.

The number <span class="math inline">2<sup>32</sup></span> is not divisible by <span class="math inline">126 × 2<sup>23</sup> + 2</span>, so we can’t take a 32-bit non-negative integer, divide it by <span class="math inline">2<sup>32</sup></span> and hope that this will generate a number in <code>[0,1]</code> or <code>[0,1)</code> in an unbiased way.

We can use the fact that the mantissa uses 23 bits. This means in particular that you pick any integer in <span class="math inline">[0, 2<sup>24</sup>)</span>, and divide it by <span class="math inline">2<sup>24</sup></span>, then you can recover your original integer by multiplying the result again by <span class="math inline">2<sup>24</sup></span>. This works with <span class="math inline">2<sup>24</sup></span> but not with <span class="math inline">2<sup>25</sup></span> or any other larger number. For 64-bit floating-point numbers, you have greater accuracy as you can replace <span class="math inline">24</span> with <span class="math inline">53</span>.

So you can pick a random integer in <span class="math inline">[0, 2<sup>24</sup>)</span>, divide it by <span class="math inline">2<sup>24</sup></span> and you will get a random number in <code>[0,1)</code> without bias, meaning that for every integer in <code>[0,2^{24})</code>, there is one and only one number in <code>[0,1)</code>. Moreover, the distribution is uniform in the sense that the possible floating-point numbers are evenly spaced (the distance between them is a flat <span class="math inline">2<sup>−24</sup></span>).

So even though single-precision floating-point numbers use 32-bit words, and even though your computer can represent about 230 distinct and normal floating-point numbers in <span class="math inline">[0, 1)</span>, chances are good that your random generator only produces <span class="math inline">2<sup>24</sup></span> distinct 32-bit floating-point numbers in the interval <span class="math inline">[0, 1)</span>, and only <span class="math inline">2<sup>53</sup></span> distinct 64-bit floating-point numbers.

A common way to generate random integers in an interval <code>[0,N)</code> is to first generate a random floating-point number <code>[0,1)</code> and then multiply the result by <code>N</code>. Should <code>N</code> exceeds <span class="math inline">2<sup>24</sup></span> (or <span class="math inline">2<sup>53</sup></span>), then you are unable to generate all integers in the interval <code>[0,N)</code>. Similarly, to generate numbers in <code>[a,b)</code>, you would generate a random floating-point number <code>[0,1)</code> and then multiply the result by <code>b-a</code> and add <code>a</code>. The result may not be ideal in general.

The following program generates random floating-point numbers:
```Go
package main

import (
    "fmt"
)

func splitmix64(seed *uint64) uint64 {
    *seed += 0x9E3779B97F4A7C15
    z := *seed
    z = (z ^ (z >> 30))
    z *= (0xBF58476D1CE4E5B9)
    z = (z ^ (z >> 27))
    z *= (0x94D049BB133111EB)
    return z ^ (z >> 31)
}

// toFloat32 -> [0,1)
func toFloat32(seed *uint64) float32 {
    x := splitmix64(seed)
    x &= 0xffffff // %2**24
    return float32(x)/float32(0xffffff)
}


// toFloat64 -> [0,1)
func toFloat64(seed *uint64) float64 {
    x := splitmix64(seed)
    x &= 0x1fffffffffffff // %2**53
    return float64(x)/float64(0x1fffffffffffff)
}

func main() {
    seed := uint64(1231114)
    fmt.Println(toFloat32(&seed))
    fmt.Println(toFloat64(&seed))
}
```


An amusing application of floating-point is to estimate the value of pi. If we generate two floating-point numbers <span class="math inline"><em>x</em>, <em>y</em></span> in <span class="math inline">[0, 1), [0, 1)</span>, then out of an area of 1 (the unit square), then the area was <code>x*x+y*y &lt;= 1</code> should be pi/4. The following program prints an estimate of the value of pi.
```Go
package main

import (
    "fmt"
)

func splitmix64(seed *uint64) uint64 {
    *seed += 0x9E3779B97F4A7C15
    z := *seed
    z = (z ^ (z >> 30))
    z *= (0xBF58476D1CE4E5B9)
    z = (z ^ (z >> 27))
    z *= (0x94D049BB133111EB)
    return z ^ (z >> 31)
}

// toFloat64 -> [0,1)
func toFloat64(seed *uint64) float64 {
    x := splitmix64(seed)
    x &= 0x1fffffffffffff // %2**53
    return float64(x) / float64(0x1fffffffffffff)
}

func main() {
    seed := uint64(1231114)
    N := 100000000
    circle := 0
    for i := 0; i < N; i++ {
        x := toFloat64(&seed)
        y := toFloat64(&seed)
        if x*x+y*y <= 1 {
            circle += 1
        }

    }
    fmt.Println(4 * float64(circle)/float64(N))
}
```


Of course, practical algorithms might require other distributions such as the normal distribution. We can generate high quality normally distributed floating-point values at high speed using the The Ziggurat Method [Marsaglia &amp; Tsang, 2000](http://www.jstatsoft.org/v05/i08/paper). The implementation is not difficult, but it is technical. In particular, it requires a precomputed table. Typically, we generate normally distributed values with a mean of zero and a standard deviation of one: we often multiply the result by the square root of the desired standard deviation, and we add the desired mean.
<h3 id="discrete-distributions">Discrete distributions</h3>

Sometimes we are given a collection of possible values and each value has a corresponding probability. For example, we might pick at random one of three colors (red, blue, green) with corresponding probabilities (20%, 40%, 40%). If there are few such values (for example three), a standard approach is a roulette wheel selection. We divide the interval from 0 to 1 into three distinct components, one for each colour: from 0 to 0.2, we pick red, from 0.2 to 0.6, we pick blue, from 0.6 to 1.0, we pick green.

The following program illustrates this algorithm:
```Go
package main

import (
    "fmt"
    "math/rand"
    "time"
)

func splitmix64(seed *uint64) uint64 {
    *seed += 0x9E3779B97F4A7C15
    z := *seed
    z = (z ^ (z >> 30))
    z *= (0xBF58476D1CE4E5B9)
    z = (z ^ (z >> 27))
    z *= (0x94D049BB133111EB)
    return z ^ (z >> 31)
}

func toFloat64(seed *uint64) float64 {
    x := splitmix64(seed)
    x &= 0x1fffffffffffff // %2**53
    return float64(x) / float64(0x1fffffffffffff)
}

func rouletteWheelSelection(seed *uint64, colors []string, probabilities []float64) string {
    rand.Seed(time.Now().UnixNano())

    // Create a slice of cumulative probabilities
    cumulativeProbabilities := make([]float64, len(probabilities))
    cumulativeProbabilities[0] = probabilities[0]
    for i := 1; i < len(probabilities); i++ {
        cumulativeProbabilities[i] = cumulativeProbabilities[i-1] + probabilities[i]
    }

    // Generate a random number between 0 and 1
    randomNumber := toFloat64(seed)

    // Select the color based on the random number and cumulative probabilities
    if randomNumber < cumulativeProbabilities[0] {
        return colors[0]
    }
    for i := 1; i < len(cumulativeProbabilities); i++ {
        if randomNumber >= cumulativeProbabilities[i-1] && randomNumber < cumulativeProbabilities[i] {
            return colors[i]
        }
    }

    return colors[len(colors)-1]
}

func main() {
    seed := uint64(1231114)

    colors := []string{"red", "blue", "green"}
    probabilities := []float64{0.2, 0.4, 0.4}

    fmt.Println(rouletteWheelSelection(&seed, colors, probabilities))
}
```


If you have to pick a value out of a large set, a roulette-wheel selection approach can become inefficient. In such cases, we may use the [alias method](https://en.wikipedia.org/wiki/Alias_method).
<h3 id="cryptographic-hashing-and-random-number-generation">Cryptographic hashing and random number generation</h3>

We do not typically reimplement cryptographic functions. It is preferable to use well-tested implementations. They are typically reserved for cases where security is a concern because they often use more resources.

Cryptographic hashing of strings is designed so that it is difficult to find two strings that collide (have the same hash value). Thus if you receive a message, and you were given its hash value ahead of time, and you check that the hash value and the message correspond, there are good chances that the message has not been corrupted. It is difficult (but not impossible) for an attacker to produce a message that matches the hash value you were given. To hash a string in Go cryptographically, you may use the following code:
```Go
package main

import (
    "crypto/sha256"
    "fmt"
)

func main() {
    message := "Hello, world!"
    hash := sha256.Sum256([]byte(message))
    fmt.Printf("Message: %s\nHash: %x\n", message, hash)
}
```


Similarly, you may want to generate random numbers in a cryptographical manner: in such cases, the produced random numbers are difficult to predict. Even if I were to give you the ten last numbers, it would be difficult to predict the next one. If you were to implement software for an online casino, you should probably use cryptographic random numbers.
```Go
package main

import (
    "crypto/rand"
    "fmt"
    "math/big"
)

func main() {
    nBig, err := rand.Int(rand.Reader, big.NewInt(100))
    if err != nil {
        panic(err)
    }
    n := nBig.Int64()
    fmt.Printf("Here is a random %T between 0 and 99: %d\n", n, n)
}
```


