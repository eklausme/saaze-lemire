---
date: "2021-10-03 12:00:00"
title: "Word-aligned Bloom filters"
---



Programmers often need to &lsquo;filter out&rsquo; data. Suppose that you are given a database of users where only a small percentage are &lsquo;paying customers&rsquo; (say 5% or less). You can write an SQL query to check whether a given user is indeed a paying customer, but it might require a round trip to your database engine. Instead, you would like to hold a small &lsquo;filter&rsquo; in memory to quickly check whether the given user is a paying customer. When you are pretty sure it might be a paying customer, then, and only then, do you query the database.

Probabilistic filters are ideally suited for such tasks. They return &ldquo;true&rdquo; when the key might be found, and &ldquo;false&rdquo; when the key definitively cannot be found. A probabilistic filter can be fast and concise.

The conventional probabilistic filter is the Bloom filter. We construct a Bloom filter as follows. We start with an array of bits. Initially, all of the bits are set to 0. When a new value is added to the filter, we map it to several &ldquo;random&rdquo; locations in the array of bit. All of the bits at the matching locations are set to 1. The random mapping is done using &ldquo;hash functions&rdquo;. A hash function is a function that returns &ldquo;random-looking&rdquo; values: it is nevertheless a genuine function. That is, a given hash function always return the same output given the same input.

When querying a Bloom filter, we hash the received value to several locations in the array of bits. If all of the corresponding bits are set to 1, then we have that value might be in the corresponding set. If only just one of these bit values is 0, then we know that the value was not previous added to the set.

A Bloom filter can be remarkably efficient. But can you do better? [There are many other probabilistic filters](https://github.com/FastFilter), but let us say that you want to remain close to Bloom filters.

One way to improve on the Bloom filter is to avoid mapping your values all over the array of bits. Instead, you might first map the value to a small block of bits, and then check the bits within a limited range. It can make processing much faster because you do not need multiple data loads in an array. This approach is known under the name of &ldquo;blocked Bloom filter&rdquo;. It is much less popular than conventional Bloom filters. One reason why it might be less popular is that blocked Bloom filters require more storage.

I suspect that another reason people might prefer Bloom filters to alternatives such as blocked Bloom filters has to do with implementation. Bloom filters are mature and it is easy to pick up a library. E.g., [there is a mature Bloom filter library in Go](https://github.com/bits-and-blooms/bloom).

What is the simplest blocked Bloom filter you could do? Instead of doing something fanciful, let us say that the &ldquo;block&rdquo; is just a single machine word. On current hardware, a machine word span 64 bits. You have wider registers for SIMD operations, but let us keep things simple. I am going to take my values and map them to a 64-bit word, and I will set a number of bits to 1 within this word, and only within this word. Such a word might be called a fingerprint. Thus, at query time, I will only need to check a single word and compare it with the fingerprint (a bitwise AND followed by a compare). It should be really fast and easy to implement.

Probabilistic filters, as their name implies, have a small probability of getting it wrong: they can claim that a value is in the set while it is not. We call this error margin the &ldquo;false-positive rate&rdquo;. You might think that you want this error to be as small as possible, but there is a tradeoff. For a false-positive rate of 1/2<em><sup>p</sup></em>, you need at least _p_ bits per entries. Conventional Bloom filters have an overhead of 44% in the best case scenario, so you actually need 1.44 _p_ bits per entries.

A reasonable choice might be to pick a false-positive rate of 1%. To achieve such a low rate, you need at least 10 bits per entry with a conventional Bloom filter.

It turns out that I can achieve roughly the same false-positive rate while using 2 extra bits per entry for a total of 12 bits per entry. Assume that you take your input values and hash them to a random-looking 64-bit outputs. From such 64-bit ouputs, you can select a location and generate a 64-bit word with 5 bits set. To do so, I can just select 5 bits locations in [0,64), using 6 of the input bits per location. I can create the word using a function such as this one&hellip;
```C
std::function<uint64_t(uint64_t)> fingerprint5 = [](uint64_t x) {
       return (uint64_t(1) << (x&63))
            | (uint64_t(1) << ((x>>6)&63))
            | (uint64_t(1) << ((x>>12)&63))
            | (uint64_t(1) << ((x>>18)&63))
            | (uint64_t(1) << ((x>>24)&63));
    };
```


Though it is in C++, the concept is portable to most languages. You might be concerned that such code could be inefficient. [Yet the LLVM clang compiler has no trouble producing code that looks efficient](https://godbolt.org/#z:OYLghAFBqd5QCxAYwPYBMCmBRdBLAF1QCcAaPECAMzwBtMA7AQwFtMQByARg9KtQYEAysib0QXACx8BBAKoBnTAAUAHpwAMvAFYTStJg1DIApACYAQuYukl9ZATwDKjdAGFUtAK4sGIM1ykrgAyeAyYAHI%2BAEaYxCDSAA6oCoRODB7evv6ByamOAqHhUSyx8dJ2mA7pQgRMxASZPn4Btpj2BQy19QRFkTFxCbZ1DU3ZrQojvWH9pYOSAJS2qF7EyOwcAPSbANQAKgCeiZg7ByvEO2hYOwhxmKQ7JDu0qEzoO4Y7mKqsifQAdCYNABBcwAZjCyG81xMYLcYmAJEICBYsOwQNBZghDChXhhcOQk3wgjRGPBkOhJ1hbioXhxnTEpJBGKJIBAtPp6WpXjCBAAbJIAPoECA8wQC4ULNE7GhGOKJYi8gCsO1hABFVUqrEq1aLeRKCDtVAtVQB2CyqkE7a0263ETAEVYMHZ68VCkVcE3U6ku1TmPl8sELL1W21h60mU1uF1i/nuiCe1Vwn1QP1g9HpvlSswBoMh4Hh8OR6OuuPChNe5Nwl0QNMZ7BcMzZ3PBy0Fwu24sx/XxxPe6up0nprgADmbgeDGI7naj3bd5b7VZLtaH2DMi39E6lYKsoYjprVsIsHCWtE4St4fg4WlIqE4bms1h2CnO61VWJ4pAImhPSwA1v4kj/HySoaAAnHyI5YqappgiOYFgqa%2BicJIl4/renC8AoIAaF%2BP5LHAsBIGgLCJHQcTkJQJFkfQ8T1CwABuI4ALRQoYwDMQQxB0n%2BfB0AQcTYRA0TodEYT1AcnCfiRbCCAA8gwtCSdevBYCw7HiCppD4Pa1QMZg2Fad8VReAJUm8Ly7TobQeDRMQEkeFg6FcXgLDmUsVAGMACgAGp4JgADucnHFen78IIIhiOwUgyIIigqOoWm6IEBhGCgj6WPotnYZASyoIknSGcxclglh7RVJ0LgMO4njNHoIQzCUZR6HkaQCGMfi5CkbUMH0TWDIElTVAI3SjLV2SDeVw1dFMfUDPEg1TB1eiTD0c1zAtSwvqs6x6FxmAbDwp7nmhWl3hw9FMcxTCXKlwAulxPEmhAD6WNYDy4IQTzgoEOweKR5EXD9Cy8N%2BKnBqQAEBP8kgaKaZimmBMFKiOkgI8hHCoaQV43udWE4Xh4OkIRiAoKgAO0ZREDUYDIDAFwDN8bQAnEEJIlaWJzDEMp0nk7JBAKUp6FqRpGw3jpFV4Pphk3sZyCmYdFmCFZWk2XZDkYGLoOKm53AnnwXm%2Bf5QUheZsXCKI4gxeF8hKGo6G6GY%2Bjselb2ZWrOUQHlBXpEVJU7MxRLqqYbsWFwpplR06RVTVWSdUE1Xrc1XX5Oky0pz1ScDW0UcjUt43x0NnSjdMxTzSt%2BdxxXa2NeXnrLDt0VfvaivHRwF7Y%2Bh52qCOfLMQKOzAMgyA7Az/xcC6r1WJlOyfUQQMfg8/00XE75gk2oP4f%2BOT/BBYHh2Y%2B8jiOSpcBoKUoaduOYbYBNg1oBEwKTNOUxQ1Pkyv8RsUYjbn0zLNs1EuJbmZsZKMAFopZS4tMDqSMJpcWeBdKOGluhOWCszaWTPKrWy9luaOS1s3Vy7kDZMG8n5QKwVGBmxtpFK20gbbxXtklEAYJnZpRDtPGwHt4De0KpwYqYIA5BzBGqDh1hw6R0ls4CArh04J3QFnBapBWqdDkSo9IiiVpTWLpXOqk1c4zRrmXDa1cxpV0WkY2YyctqvibvtVuGMO4414N3Xu/dJC3XYqPMw/wNDj0nhlGws98DzzXr9ZegM15Bk3uDbeYIuC73hkqRGGg%2BSmiVGksESoMZY2cRhDg%2BNcL31/BjMwV8XE32KRDfSrNo6SCAA) (x64 assembly):
```C
        shr     rcx, 6
        mov     eax, 1
        shl     rax, cl
        bts     rax, rdx
        mov     rcx, rdx
        shr     rcx, 12
        bts     rax, rcx
        mov     rcx, rdx
        shr     rcx, 18
        bts     rax, rcx
        shr     rdx, 24
        bts     rax, rdx
```


Other compilers could possibly be less efficient. Checking for a match is as simple as the following pseudocode:
```C
    uint64_t print = fingerprint(key);
    if( (buffer[location(key,buffer.size())] & print) == print ) {
       // match
    }
```


I did not write a benchmark yet, but my expectation is that such a word-based Bloom filter would provide excellent performance.

[I have published prototypical code on GitHub](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2021/10/02). In the future, I will provide some benchmarks. There is also a natural extension of this idea where instead of checking a single word, you pick two or more words.

__Important__: I do not claim that this is a &ldquo;new&rdquo; idea. I merely feel that it is an under-appreciated one.

