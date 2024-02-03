---
date: "2022-12-30 12:00:00"
title: "Quickly checking that a string belongs to a small set"
---



Suppose that I give you a set of reference strings (&ldquo;ftp&rdquo;, &ldquo;file&rdquo;, &ldquo;http&rdquo;, &ldquo;https&rdquo;, &ldquo;ws&rdquo;, &ldquo;wss&rdquo;). Given a new string, you want to quickly tell whether it is part of this set.

You might use a regular expression but it is unlikely to be fast in general:
```C
const std::regex txt_regex("https?|ftp|file|wss?");
// later...
bool match = std::regex_match(v.begin(), v.end(), txt_regex);
```


A sensible solution might be to create a set and then to ask whether the string is in the set. In C++, a default set type is the unordered_set thus your code might look as follows:
```C
static const std::unordered_set<std::string_view> special_set = {
    "ftp", "file", "http", "https", "ws", "wss"};

bool hash_is_special(std::string_view input) {
  return special_set.find(input) != special_set.end();
}
```



You can also use a tool like [gperf](https://www.gnu.org/software/gperf/) which constructs a perfect-hash function for you.

You might also be more direct about it, and just do several comparisons:
```C
bool direct_is_special(std::string_view input) {
  return (input == "https") || (input == "http") || (input == "ftp") ||
         (input == "file") || (input == "ws") || (input == "wss");
}
```



I call it a branchy version because of the &lsquo;||&rsquo; operator which suggests to the compiler that you want to evaluate the comparisons one by one, exiting once one is true; if you replace the &lsquo;||&rsquo; operator with the operator &lsquo;|&rsquo; then you the result is &lsquo;branchless&rsquo; in the sense that you entice the compiler to evaluate all comparisons.

If you look at how the code gets compiled, you may notice that the compiler is forced to do comparisons and jumps, because it is not allowed to read in the provided string beyond its reported size.

You might be able to do slightly better if you can tell your compiler that the string you receive is &lsquo;padded&rsquo; so that you can read eight bytes safely from it. I could not find a very elegant way to do it, but the following code works:
```C
static inline uint64_t string_to_uint64(std::string_view view) {
  uint64_t val;
  std::memcpy(&val, view.data(), sizeof(uint64_t));
  return val;
}

uint32_t string_to_uint32(const char *data) {
  uint32_t val;
  std::memcpy(&val, data, sizeof(uint32_t));
  return val;
}


bool fast_is_special(std::string_view input) {
  uint64_t inputu = string_to_uint64(input);
  if ((inputu & 0xffffffffff) == string_to_uint64("https\0\0\0")) {
    return input.size() == 5;
  }
  if ((inputu & 0xffffffff) == string_to_uint64("http\0\0\0\0")) {
    return input.size() == 4;
  }
  if (uint32_t(inputu) == string_to_uint32("file")) {
    return input.size() == 4;
  }
  if ((inputu & 0xffffff) == string_to_uint32("ftp\0")) {
    return input.size() == 3;
  }
  if ((inputu & 0xffffff) == string_to_uint32("wss\0")) {
    return input.size() == 3;
  }
  if ((inputu & 0xffff) == string_to_uint32("ws\0\0")) {
    return input.size() == 2;
  }
  return false;
}
```



Though I did not do it, you can extend the comparison so that it is case-insensitive (simply AND the input with the bytes 0xdf instead of the bytes 0xff).

You can use a faster approach if you can assume that the input string has been padded with zeros:
```C
  uint64_t inputu = string_to_uint64(input);
  uint64_t https = string_to_uint64("https\0\0\0");
  uint64_t http = string_to_uint64("http\0\0\0\0");
  uint64_t file = string_to_uint64("file\0\0\0\0");
  uint64_t ftp = string_to_uint64("ftp\0\0\0\0\0");
  uint64_t wss = string_to_uint64("wss\0\0\0\0\0");
  uint64_t ws = string_to_uint64("ws\0\0\0\0\0\0");
  if((inputu == https) | (inputu == http)) {
    return true;
  }
  return ((inputu == file) | (inputu == ftp)
          | (inputu == wss) | (inputu == ws));
```


Observe how I have selected what I believe are the two most common cases (among URL protocols).

Finally, we must use a hash function to solve the problem with a single comparison:
```C
static const uint8_t shiftxor_table[128] = {
    'w', 's', 0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   'f', 'i', 'l', 'e', 0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   'f', 't', 'p', 0,   0,   0,   0,   0,
    'w', 's', 's', 0,   0,   0,   0,   0,   'h',
    't', 't', 'p', 0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   'h', 't', 't',
    'p', 's', 0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   0,   0,   0,   0,   0,   0,   0,   0,
    0,   0};

bool shiftxor_is_special(std::string_view input) {
  uint64_t inputu = string_to_uint64(input);

  return string_to_uint64(
             shiftxor_table +
             (((inputu >> 28) ^ (inputu >> 14)) &
              0x78)) == inputu;
}
```


If you do not want to assume that the strings are padded (i.e., no cheating), then you can do it the &ldquo;gperf way&rdquo; (it is my own code, but it is based on gpref):
```C
std::string_view table_hashnocheat_is_special[] = {"http", "", "https",
  "ws", "ftp", "wss", "file", ""};

bool hashnocheat_is_special(std::string_view input) {
  if(input.empty()) { return false; }
  int hash_value = (2*input.size() + (unsigned)(input[0])) & 7;
  const std::string_view target = table_craftedhash_is_special[hash_value];
  return (target[0] == input[0]) && (target.substr(1) == input.substr(1));
}
```


I am sure that there are faster and more clever alternatives!

In any case, how fast are my alternatives? Using GCC 11 on an Intel Ice Lake server, I get the following results:

gperf7.1 ns/string

regex                    |360 ns/string            |
-------------------------|-------------------------|
std::unordered_map       |19 ns/string             |
direct                   |16 ns/string             |
direct (branchy)         |13 ns/string             |
direct (branchless)      |18 ns/string             |
hashnocheat_is_special   |7.0 ns/string            |
fast                     |2.6 ns/string            |
faster                   |1.9 ns/string            |
hashing (shiftxor_is_special) |1.1 ns/string            |


On an Apple M2 with LLVM 12, I get similar (but better) results:

regex                    |450 ns/string            |
-------------------------|-------------------------|
std::unordered_map       |15 ns/string             |
direct (branchy)         |7.5 ns/string            |
direct (branchless)      |4.8 ns/string            |
gperf                    |8.0 ns/string            |
hashnocheat_is_special   |7.2 ns/string            |
fast                     |1.1 ns/string            |
faster                   |0.8 ns/string            |
hashing (shiftxor_is_special) |0.4 ns/string            |


Care is needed when optimizing such small functions: whether and how the function gets inlined can be critical to the good performance. The results will depend also on the data source and on the compiler.

The hashing method (e.g., shiftxor_is_special) has the benefit of being essentially branch-free which makes its performance having little dependency on the distribution of the input. It is also fastest in these tests.

If you cannot safely pad your strings, I recommend the hashnocheat_is_special function. Having to deal with variable-length strings is significantly slower, but it is sometimes necessary.

[My source code is available](https://github.com/lemire/Code-used-on-Daniel-Lemire-s-blog/tree/master/2022/12/29).

__Further reading__: I was later informed that my friend Wojciech Muła [had looked at the problem](http://0x80.pl/notesen/2022-01-29-http-verb-parse.html) earlier in 2022. He did not look at string padding, but for the version with no-cheating (variable-length strings), he comes up with the same conclusion that I do.

