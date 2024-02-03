---
date: "2017-08-22 12:00:00"
title: "&#8220;Cracking&#8221; random number generators (xoroshiro128+)"
---



In software, we generate random numbers by calling a function called a &ldquo;random number generator&rdquo;. Such functions have hidden states, so that repeated calls to the function generate new numbers that appear random. If you know this state, you can predict all future outcomes of the random number generators. O&rsquo;Neill, a professor at Harvey Mudd college, [advocates against](http://www.pcg-random.org/posts/on-trivial-predictability.html) using random number generators that make such predictions trivially easy.

I like to call this process &ldquo;cracking&rdquo; because it is akin to getting access to the secret information you are not supposed to have as a user of this function. Also, you could possibly use this approach to win at online poker, if they were silly enough to use a simple random number generator. They are not so stupid, are they?

The JavaScript engine inside the Google Chrome browser uses the XorShift128+ random number generator, created by Vigna. [Douglas Goddard, a security expert, explains how one can &ldquo;crack&rdquo; this generator](https://blog.securityevaluators.com/xorshift128-backward-ff3365dc0c17). He uses it to &ldquo;hack the JavaScript lottery&rdquo;. I&rsquo;m hoping that no online casino relies on XorShift128+. Probably not.

XorShift128+ is a relatively weak random number generator. Blackman and Vigna recommend upgrading to the stronger xoroshiro128+.

You can examine the [xoroshiro128+ function](http://xoroshiro.di.unimi.it/xoroshiro128plus.c). It is simple enough, but it does not look like you could easily &ldquo;crack&rdquo; it at first glance.

Should you use it for your online casino? Maybe not.

I was intrigued by a [blog post where John D. Cook](https://www.johndcook.com/blog/2017/08/16/manipulating-a-random-number-generator/) illustrating how you could &ldquo;crack&rdquo; xoroshiro128+. John used examples provided to him by [O&rsquo;Neill](http://www.pcg-random.org/posts/predictability-party-tricks.html).

O&rsquo;Neill explains that the &ldquo;cracking&rdquo; process is trivial and takes much less than a second. In effect, given two consecutive 64-bit &ldquo;random&rdquo; numbers, you can often completely infer the inner state of the random number generator, and thus predict all future numbers.

O&rsquo;Neill did not tell me how to do it, and yet I managed it in the middle of a busy Monday. So it is not nearly as hard as it may appear at first.

I&rsquo;m not going to reveal O&rsquo;Neill&rsquo;s secret, as it would be no fun, but I can do it in about 5 lines of code. If you &ldquo;crack&rdquo; it, please don&rsquo;t reveal the secret right away. Instead, consider posting simply a proof that you &ldquo;cracked&rdquo; it. (Update: [at least one person did it quickly after reading my blog post](https://gist.github.com/karanlyons/805dbcc9e898dbd17e06f2627d5f9111).)

How can I prove that I can do it? One way to do it is to start with a string of 16 bytes, say one that spells out &ldquo;Daniel Lemire&rdquo; (my name) in ASCII characters with appropriate padding to make it to 16 bytes. From this string, I can infer the original seed necessary to so that the random number generator produces in sequence these 16 bytes.

[I make available the short C code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/blob/master/2017/08/22/name.c). It starts from an apparently random seed for the random number generator, and then calls the xoroshiro128+ function several times. From a bash shell with a C compiler, you can type <tt>cc -o name name.c && ./name|hexdump -C</tt> to execute it. Sure enough, it will display my name.
```C
uint64_t s[2];

static inline uint64_t rotl(const uint64_t x, int k) {
	return (x << k) | (x >> (64 - k));
}

uint64_t next(void) {
	const uint64_t s0 = s[0];
	uint64_t s1 = s[1];
	const uint64_t result = s0 + s1;

	s1 ^= s0;
	s[0] = rotl(s0, 55) ^ s1 ^ (s1 << 14); // a, b
	s[1] = rotl(s1, 36); // c
	return result;
}
int main(int argc, char **argv) {
    freopen(NULL, "wb", stdout);
    s[0] = 0X922AC4EB35B502D9L;
    s[1] = 0XDA3AA4832B8F1D27L;
    for(int k = 0; k < 5; k++) {
        uint64_t value = next();
        fwrite((void*) &value, sizeof(value), 1, stdout);
    }
}
```

```C
$ cc -o name name.c && ./name|hexdump -C
00000000  00 20 44 61 6e 69 65 6c  00 4c 65 6d 69 72 65 20  |. Daniel.Lemire |
00000010  62 c2 f9 75 7d 37 39 99  54 d8 dd a3 08 5e cd a9  |b..u}79.T....^..|
```


I should stress that you cannot &ldquo;brute force&rdquo; this problem. The state space spans 128 bits. That&rsquo;s way too many degrees of freedom!

With some elementary algebra, you can bring down the degrees of freedom to 64 bits, but that&rsquo;s still too many for brute force.

So you need some cleverness to &ldquo;crack&rdquo; it, but not a lot. A smart high school student can do it.

What does it mean?

- It means that if I have access to a few outputs of xoroshiro128+, then I can infer all future and previous random numbers.
- It also means that if I can manipulate the seed of the function, I can make it produce almost anything sequence of 16 bytes I desire.


I should point out that the same is true of most random number generators in widespread use today. [Cryptographic random number generators](https://en.wikipedia.org/wiki/Fortuna_(PRNG)) should probably be used if you want to open a casino.

__Further reading__: Hacking casinos by &ldquo;cracking&rdquo; random number generators is a real issue as explained in [Russians engineer a brilliant slot machine slot](https://www.wired.com/2017/02/russians-engineer-brilliant-slot-machine-cheat-casinos-no-fix/) (Wired). You might also enjoy my post [Testing non-cryptographic random number generators: my results](/lemire/blog/2017/08/22/testing-non-cryptographic-random-number-generators-my-results/). Moreover, James Roper showed in [a series of blog posts](https://jazzy.id.au/2010/09/20/cracking_random_number_generators_part_1.html) how to &ldquo;crack&rdquo; the default random number generator in Java and the Mersenne Twister (a generator part of the C++ standard). &ldquo;Cracking&rdquo; random number generators is not new: see J. Reeds&rsquo;s [&ldquo;Cracking&rdquo; a random number generator](https://pdfs.semanticscholar.org/54af/d43274e496d5e1b5e36faa21ce4e7dbf1340.pdf) (1977).

__Update__: [I have posted my solution on GitHub](https://github.com/lemire/crackingxoroshiro128plus).

