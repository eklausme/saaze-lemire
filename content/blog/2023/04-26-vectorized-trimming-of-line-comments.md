---
date: "2023-04-26 12:00:00"
title: "Vectorized trimming of line comments"
---



A French graduate student reached out by email yesterday with the following problem. Consider a [format such as TOML](https://toml.io/en/) which has line comments: when a &lsquo;#&rsquo; character is encountered, the rest of the line is omitted. Let us look at an example:
```C
[build-system] # use this to indicate the name of the project
  requires = ["setuptools>=61.0"]
  build-backend = "setuptools.build_meta"
[tool.setuptools]
  package-dir = {"" = "pylib"}
  packages = ["gyp", "gyp.generator"] # looks good
# end of the file

```


The lines with &lsquo;#&rsquo; characters have comments.

We want to process such a scenario in a purely vectorized manner, as we do within simdjson, [the fast JSON parser](https://github.com/simdjson/simdjson). That is, we want to avoid branching as much as possible.

We can construct bitmaps which indicate where the end of lines are (checking for the character &lsquo;\n&rsquo;) and where the &lsquo;#&rsquo; is. Effectively, we turn all blocks of, say, 64 characters into two 64-bit words. Each bit in the 64-bit words correspond to one character. The bit is set to 1 in the first 64-bit word if and only if the matching character is &lsquo;\n&rsquo; and similarly for the second 64-bit word. These pairs of words are &lsquo;bitsets&rsquo;. They can be computed efficiently using [SIMD instructions](https://en.wikipedia.org/wiki/Single_instruction,_multiple_data) or other means.

From these bitsets, we can then compute a mask of bitsets (a stream of 64-bit words corresponding each to blocks of 64 characters) where the corresponding bits are set to 0 if and only the character is commented out.

Effectively, considering both streams of bitsets (for end-of-lines and for hashes) as big integers, we just need to subtract the hash &ldquo;big integer&rdquo; from the end-of-line &ldquo;big integer&rdquo;. And then we need to make sure to remove all hashes, and put back the line endings. There is no clean way to subtract the big integers, but compilers like GCC and LLVM/clang have intrinsics for this purpose (__builtin_usubll_overflow). It is quite ugly and requires an overflow variable, but it compiles to highly efficient code. You can achieve much the same effect within Visual Studio with Microsoft intrinsics (left as an exercise for the reader). In Rust, you might call <tt>u64::overflowing_sub</tt>.
```C
bool overflow = 1;
for (size_t i = 0; i < b.line_end.size(); i++) {
  // We subtract b.line_end from b.hash, with overflow handling.
  overflow = __builtin_usubll_overflow(b.hash[i],
            b.line_end[i] + overflow,
            &b.comment[i]);
  b.comment[i] &=~b.hash[i]; // when there is more than one #,
                             //we want to remove it.
  b.comment[i] |= b.line_end[i]; // we want to keep the line start bits.
}

```


From there, I was able to write a function that can prune (remove) the comments from the input file, using vectorized (branchless) routines. My C++ code has only a fast path for ARM NEON currently (otherwise, there is a fallback), but it works. I assume that have Linux or macOS.

[Check the full code out if you would like](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/04/25). It is only a prototype is it not going to be especially fast even on ARM NEON. To make it run fast, I should avoid the unnecessary materialization of the whole bitset indexes: there is no need to map out the whole content. We can process block-by-block and avoid memory allocations.

Furthermore, I did not handle &lsquo;#&rsquo; characters found inside strings. I suppose that they should be omitted. I have also simplified slightly the code above, in practice you need to be concerned with the case where you have a long streams of line ending characters &lsquo;\n&rsquo;, ending with a line containing a comment. [Please see my full code](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2023/04/25).

I think that is a convincing proof-of-principle demonstration that you can identify and possibly remove line comments from a piece of code. I invite contributions and efforts toward turning this into something useful!

